import subprocess
import json
import os
import requests
import sys
import re
import logging

def check_tool_installed(tool_name):
    """Check if a tool is installed and available in the system PATH."""
    try:
        subprocess.check_output([tool_name, '--help'])
    except FileNotFoundError:
        print(f"Error: {tool_name} is not installed or not found in the system PATH.")
        exit(1)
    except subprocess.CalledProcessError:
        print(f"Error: {tool_name} --help returned a non-zero exit status.")
        exit(1)

def run_ptt_scan(target):
    """Run PTT scan on the target and return the results."""
    check_tool_installed('ptt')
    print(f"Running PTT scan on {target}")
    ptt_cmd = ["ptt", "run", "website_scanner", target]
    result = subprocess.check_output(ptt_cmd).decode()
    print("PTT scan results:")
    print(result)
    return result

def fetch_http_headers(domain):
    """Fetch HTTP headers from the domain to get server type, content type, etc."""
    try:
        response = requests.head(f"http://{domain}")
        headers = response.headers
        return {
            "server": headers.get("Server", ""),
            "content_type": headers.get("Content-Type", ""),
            "etag": headers.get("ETag", ""),
            "response_code": response.status_code
        }
    except requests.RequestException as e:
        logging.error(f"Failed to fetch HTTP headers: {e}")
        return {}

def check_threat_intelligence(domain, api_key):
    logging.info(f"Checking threat intelligence for {domain}")
    headers = {'X-OTX-API-KEY': api_key}
    url = f"https://otx.alienvault.com/api/v1/indicators/domain/{domain}/general"
    try:
        response = requests.get(url, headers=headers)
        response.raise_for_status()
        threat_intel_data = response.json()
        
        # Fetch additional HTTP header information
        http_headers = fetch_http_headers(domain)
        threat_intel_data.update(http_headers)
        
        logging.info("Threat intelligence data fetched successfully.")
        return threat_intel_data
    except requests.RequestException as e:
        logging.error(f"Failed to fetch data from OTX: {e}")
        return {"error": f"Failed to fetch data from OTX: {e}"}


def save_ptt_results(ptt_results):
    report_path = os.path.join(os.path.dirname(__file__), "ptt_report2.json")
    with open(report_path, "w") as report_file:
        report_file.write(ptt_results)
    print(f"PTT results saved to {report_path}")
    return report_path

def safe_search(pattern, text, group=1):
    match = re.search(pattern, text)
    return match.group(group) if match else ""

def method7(raw_content):
    vulnerabilities = []
    vuln_sections = re.split(r'\[.*?\]', raw_content)
    
    for section in vuln_sections:
        if 'Vulnerability Details:' in section:
            vulnerability = {
                "name": "Unknown",
                "type": "Unknown",
                "title": "",
                "details": "",
                "risk_level": safe_search(r'Risk Level:\s*(.*)', section),
                "cvss": safe_search(r'CVSS:\s*(.*)', section),
                "cve": safe_search(r'- (CVE-\d{4}-\d{4,7})', section),
                "summary": safe_search(r'- (CVE-\d{4}-\d{4,7}):\s*(.*)', section, 2),
                "description": safe_search(r'Description:\s*(.*)', section),
                "recommendation": safe_search(r'Recommendation:\s*(.*)', section),
                "endpoint": safe_search(r'Evidence.*- URL:\s*(.*)', section),
                "affected_software": safe_search(r'Affected software:\s*(.*)', section)
            }
            
            # Clean the summary field
            if vulnerability["summary"].startswith('- Risk Level:'):
                vulnerability["summary"] = vulnerability["summary"].replace('- Risk Level:', '').strip()
            
            # If no endpoint is found in Evidence section, try to find any URL mentioned
            if not vulnerability["endpoint"]:
                vulnerability["endpoint"] = safe_search(r'- URL:\s*(.*)', section)

            vulnerabilities.append(vulnerability)
    
    return vulnerabilities

def parse_ptt_results(ptt_report_path):
    with open(ptt_report_path, 'r') as file:
        raw_content = file.read()
    return method7(raw_content)

def generate_report(domain, parsed_vulns, threat_intel):
    report = {
        "domain": domain,
        "endpoints": [],  # Assuming endpoints are to be collected differently if needed
        "vulnerabilities": parsed_vulns,
        "threat_intelligence": threat_intel
    }
    
    report_path = os.path.join(os.path.dirname(__file__), "reportV7_2.json")
    with open(report_path, "w") as report_file:
        json.dump(report, report_file, indent=4)
    print(f"Report generated: {report_path}")

if __name__ == "__main__":
    if len(sys.argv) != 3:
        print("Usage: python3 script3.py <domain> <otx_api_key>")
        sys.exit(1)
    
    domain = sys.argv[1]
    otx_api_key = sys.argv[2]

    # Step 1: Run PTT scan
    ptt_results = run_ptt_scan(domain)

    # Save PTT scan results to a file
    ptt_results_path = save_ptt_results(ptt_results)

    # Step 2: Fetch threat intelligence data
    # domain2 = "google.com"
    threat_intel = check_threat_intelligence(domain, otx_api_key)

    # Step 3: Parse PTT scan results
    parsed_vulns = parse_ptt_results(ptt_results_path)

    # Step 4: Generate final report
    generate_report(domain, parsed_vulns, threat_intel)
