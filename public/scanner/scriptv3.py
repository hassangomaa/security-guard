import subprocess
import json
import os
import requests
import sys

def check_tool_installed(tool_name):
    """Check if a tool is installed and available in the system PATH."""
    try:
        subprocess.check_output([tool_name, '--version'])
    except FileNotFoundError:
        print(f"Error: {tool_name} is not installed or not found in the system PATH.")
        exit(1)

def gather_endpoints(domain):
    common_endpoints = [
        "/login",
        "/register",
        "/admin",
        "/search",
        "/contact",
        "/index",
        "/home",
        "/dashboard",
        "/profile",
        "/settings",
        "/api"
    ]
    
    gobuster_cmd = ["gobuster", "dir", "-u", domain, "-w", "/usr/share/wordlists/dirb/common.txt"]
    try:
        result = subprocess.check_output(gobuster_cmd).decode()
        for line in result.splitlines():
            if "Status: 200" in line:
                endpoint = line.split()[0]
                common_endpoints.append(endpoint.replace(domain, ''))
    except Exception as e:
        print(f"Error running Gobuster: {e}")

    return [f"{domain}{endpoint}" for endpoint in set(common_endpoints)]

def run_nikto_scan(target):
    check_tool_installed('nikto')
    print(f"Running Nikto scan on {target}")
    nikto_cmd = ["nikto", "-h", target]
    result = subprocess.check_output(nikto_cmd).decode()
    return result

def run_sqlmap_scan(target):
    check_tool_installed('sqlmap')
    print(f"Running SQLMap scan on {target}")
    sqlmap_cmd = ["sqlmap", "-u", target, "--batch", "--crawl=2", "--level=5", "--risk=3"]
    result = subprocess.check_output(sqlmap_cmd).decode()
    return result

def run_xss_scan(target):
    check_tool_installed('python3')
    xsstrike_path = os.path.expanduser('~/XSStrike/xsstrike.py')
    print(f"Running XSStrike scan on {target}")
    xsstrike_cmd = ["python3", xsstrike_path, "-u", target]
    result = subprocess.check_output(xsstrike_cmd).decode()
    return result

def check_threat_intelligence(domain, api_key):
    print(f"Checking threat intelligence for {domain}")
    headers = {
        'X-OTX-API-KEY': api_key
    }
    url = f"https://otx.alienvault.com/api/v1/indicators/domain/{domain}/general"
    response = requests.get(url, headers=headers)
    if response.status_code == 200:
        return response.json()
    else:
        return {"error": f"Failed to fetch data from OTX: {response.status_code}"}

def generate_report(domain, endpoints, nikto_results, sqli_results, xss_results, threat_intel):
    report = {
        "domain": domain,
        "endpoints": endpoints,
        "vulnerabilities": [],
        "threat_intelligence": threat_intel
    }

    for line in nikto_results.splitlines():
        if "OSVDB" in line:
            report["vulnerabilities"].append({
                "name": "Nikto Finding",
                "type": "Server Configuration",
                "description": line,
                "endpoint": domain,
                "fix": "Review and address the server configuration."
            })

    if "SQL injection" in sqli_results:
        report["vulnerabilities"].append({
            "name": "SQL Injection",
            "type": "SQLi",
            "description": "Potential SQL Injection vulnerability detected.",
            "endpoint": domain,
            "fix": "Sanitize and validate all user inputs."
        })

    if "XSS" in xss_results:
        report["vulnerabilities"].append({
            "name": "Cross-Site Scripting",
            "type": "XSS",
            "description": "Potential XSS vulnerability detected.",
            "endpoint": domain,
            "fix": "Sanitize and encode user inputs."
        })

    with open("report.json", "w") as report_file:
        json.dump(report, report_file, indent=4)

    print("Report generated: report.json")

if __name__ == "__main__":
    if len(sys.argv) != 3:
        print("Usage: python3 scriptv3.py <domain> <otx_api_key>")
        sys.exit(1)
    domain = sys.argv[1]
    otx_api_key = sys.argv[2]
    # domain = input("Enter the domain to scan: ")
    domain = "http://127.0.0.1/DVWA/login.php"
    # domain = "google.com"
    # # otx_api_key = input("Enter your AlienVault OTX API key: ")
    # otx_api_key = "9cba3bfba5af5903b0f2936248831d654a6b04d0f22532ac78e1ff800edc9e08"
    #domain = input("Enter the domain to scan: ")
    #otx_api_key = input("Enter your AlienVault OTX API key: ")
    

    # Step 1: Gather endpoints
    endpoints = gather_endpoints(domain)

    # Step 2: Run Nikto scan
    nikto_results = run_nikto_scan(domain)

    # Step 3: Run SQLMap scan on each endpoint
    sqli_results = ""
    for endpoint in endpoints:
        sqli_results += run_sqlmap_scan(endpoint)

    # Step 4: Run XSStrike scan on each endpoint
    xss_results = ""
    for endpoint in endpoints:
        xss_results += run_xss_scan(endpoint)
    domain2 = "google.com"
    # Step 5: Fetch threat intelligence data
    threat_intel = check_threat_intelligence(domain2, otx_api_key)

    # Step 6: Generate report
    generate_report(domain, endpoints, nikto_results, sqli_results, xss_results, threat_intel)
