import json
import os
import re
import logging

# Set up logging
logging.basicConfig(level=logging.DEBUG, format='%(asctime)s - %(levelname)s - %(message)s')

def safe_search(pattern, text, group=1):
    match = re.search(pattern, text)
    return match.group(group) if match else ""

def method1(raw_content):
    vulnerabilities = []
    lines = raw_content.split('\n')
    vulnerability = None
    inside_vulnerability = False

    for line in lines:
        line = line.strip()

        if line.startswith("[") and "Vulnerabilities found" in line:
            if vulnerability:
                vulnerabilities.append(vulnerability)
            inside_vulnerability = True
            vulnerability = {
                "name": "Unknown",
                "type": "Unknown",
                "title": "",
                "details": "",
                "risk_level": "",
                "cvss": "",
                "cve": "",
                "summary": "",
                "description": "",
                "recommendation": "",
                "endpoint": "Unknown"
            }
        elif inside_vulnerability:
            if line.startswith("- CVE-") and vulnerability is not None:
                vulnerability["cve"] = line.split(':')[0].strip()
                vulnerability["summary"] = line.split(':', 1)[1].strip()
            elif line.startswith("Risk Level:") and vulnerability is not None:
                vulnerability["risk_level"] = line.split(':')[1].strip()
            elif line.startswith("CVSS:") and vulnerability is not None:
                vulnerability["cvss"] = line.split(':')[1].strip()
            elif line.startswith("Summary:") and vulnerability is not None:
                vulnerability["summary"] = line.split(':', 1)[1].strip()
            elif line.startswith("Description:") and vulnerability is not None:
                vulnerability["description"] = line.split(':', 1)[1].strip()
            elif line.startswith("Recommendation:") and vulnerability is not None:
                vulnerability["recommendation"] = line.split(':', 1)[1].strip()
            elif line.startswith("URL:") and vulnerability is not None:
                vulnerability["endpoint"] = line.split(':', 1)[1].strip()

    if vulnerability:
        vulnerabilities.append(vulnerability)

    return vulnerabilities

def method2(raw_content):
    vulnerabilities = []
    pattern = re.compile(r'- CVE-\d{4}-\d{4,7}:.*?Description:.*?(?=\n\n|$)', re.DOTALL)
    matches = pattern.findall(raw_content)

    for match in matches:
        cve = safe_search(r'- (CVE-\d{4}-\d{4,7}):', match)
        summary = safe_search(r':\s*(.*?)\n', match)
        risk_level = safe_search(r'Risk Level:\s*(.*?)\n', match)
        cvss = safe_search(r'CVSS:\s*(.*?)\n', match)
        description = safe_search(r'Description:\s*(.*?)\n', match)
        recommendation = safe_search(r'Recommendation:\s*(.*?)\n', match)

        vulnerability = {
            "name": "Unknown",
            "type": "Unknown",
            "title": "",
            "details": "",
            "risk_level": risk_level,
            "cvss": cvss,
            "cve": cve,
            "summary": summary,
            "description": description,
            "recommendation": recommendation,
            "endpoint": "Unknown"
        }
        vulnerabilities.append(vulnerability)

    return vulnerabilities

def method3(raw_content):
    vulnerabilities = []
    lines = raw_content.split('\n')
    vulnerability = {}
    collecting_vuln = False

    for line in lines:
        line = line.strip()
        if line.startswith("["):
            if "Vulnerabilities found" in line:
                if vulnerability:
                    vulnerabilities.append(vulnerability)
                vulnerability = {
                    "name": "Unknown",
                    "type": "Unknown",
                    "title": "",
                    "details": "",
                    "risk_level": "",
                    "cvss": "",
                    "cve": "",
                    "summary": "",
                    "description": "",
                    "recommendation": "",
                    "endpoint": "Unknown"
                }
                collecting_vuln = True
        elif collecting_vuln:
            if line.startswith("- CVE-"):
                vulnerability["cve"] = line.split(':')[0].strip()
                vulnerability["summary"] = line.split(':', 1)[1].strip()
            elif "Risk Level:" in line:
                vulnerability["risk_level"] = line.split(':', 1)[1].strip()
            elif "CVSS:" in line:
                vulnerability["cvss"] = line.split(':', 1)[1].strip()
            elif "Description:" in line:
                vulnerability["description"] = line.split(':', 1)[1].strip()
            elif "Recommendation:" in line:
                vulnerability["recommendation"] = line.split(':', 1)[1].strip()

    if vulnerability:
        vulnerabilities.append(vulnerability)

    return vulnerabilities

def method4(raw_content):
    vulnerabilities = []
    blocks = re.split(r'\n\n+', raw_content)
    
    for block in blocks:
        lines = block.split('\n')
        if any("CVE-" in line for line in lines):
            vulnerability = {
                "name": "Unknown",
                "type": "Unknown",
                "title": "",
                "details": "",
                "risk_level": "",
                "cvss": "",
                "cve": "",
                "summary": "",
                "description": "",
                "recommendation": "",
                "endpoint": "Unknown"
            }
            for line in lines:
                if line.startswith("- CVE-"):
                    vulnerability["cve"] = line.split(':')[0].strip()
                    vulnerability["summary"] = line.split(':', 1)[1].strip()
                elif "Risk Level:" in line:
                    vulnerability["risk_level"] = line.split(':', 1)[1].strip()
                elif "CVSS:" in line:
                    vulnerability["cvss"] = line.split(':', 1)[1].strip()
                elif "Description:" in line:
                    vulnerability["description"] = line.split(':', 1)[1].strip()
                elif "Recommendation:" in line:
                    vulnerability["recommendation"] = line.split(':', 1)[1].strip()
            vulnerabilities.append(vulnerability)

    return vulnerabilities

def method5(raw_content):
    vulnerabilities = []
    sections = re.findall(r'(Vulnerability Details:\s*- CVE-.*?Recommendation:.*?)(?=\n\n|\Z)', raw_content, re.DOTALL)
    
    for section in sections:
        vulnerability = {
            "name": "Unknown",
            "type": "Unknown",
            "title": "",
            "details": "",
            "risk_level": safe_search(r'Risk Level:\s*(.*?)\n', section),
            "cvss": safe_search(r'CVSS:\s*(.*?)\n', section),
            "cve": safe_search(r'- (CVE-\d{4}-\d{4,7})', section),
            "summary": safe_search(r'- (CVE-\d{4}-\d{4,7}):\s*(.*?)\n', section, 2),
            "description": safe_search(r'Description:\s*(.*?)\n', section),
            "recommendation": safe_search(r'Recommendation:\s*(.*?)\n', section),
            "endpoint": "Unknown"
        }
        vulnerabilities.append(vulnerability)
    
    return vulnerabilities

def method6(raw_content):
    vulnerabilities = []
    blocks = re.split(r'\n\n+', raw_content)
    
    for block in blocks:
        if "Vulnerability Details:" in block:
            vulnerability = {
                "name": "Unknown",
                "type": "Unknown",
                "title": "",
                "details": "",
                "risk_level": safe_search(r'Risk Level:\s*(.*)', block),
                "cvss": safe_search(r'CVSS:\s*(.*)', block),
                "cve": safe_search(r'- (CVE-\d{4}-\d{4,7})', block),
                "summary": safe_search(r'- (CVE-\d{4}-\d{4,7}):\s*(.*)', block, 2),
                "description": safe_search(r'Description:\s*(.*)', block),
                "recommendation": safe_search(r'Recommendation:\s*(.*)', block),
                "endpoint": "Unknown"
            }
            vulnerabilities.append(vulnerability)
    
    return vulnerabilities

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
                "endpoint": "Unknown"
            }
            vulnerabilities.append(vulnerability)
    
    return vulnerabilities

def method8(raw_content):
    vulnerabilities = []
    pattern = re.compile(r'- CVE-\d{4}-\d{4,7}:.*?Recommendation:.*?(?=\n\n|$)', re.DOTALL)
    matches = pattern.findall(raw_content)

    for match in matches:
        cve = safe_search(r'- (CVE-\d{4}-\d{4,7}):', match)
        summary = safe_search(r':\s*(.*?)\n', match)
        risk_level = safe_search(r'Risk Level:\s*(.*?)\n', match)
        cvss = safe_search(r'CVSS:\s*(.*?)\n', match)
        description = safe_search(r'Description:\s*(.*?)\n', match)
        recommendation = safe_search(r'Recommendation:\s*(.*?)\n', match)

        vulnerability = {
            "name": "Unknown",
            "type": "Unknown",
            "title": "",
            "details": "",
            "risk_level": risk_level,
            "cvss": cvss,
            "cve": cve,
            "summary": summary,
            "description": description,
            "recommendation": recommendation,
            "endpoint": "Unknown"
        }
        vulnerabilities.append(vulnerability)

    return vulnerabilities

def method9(raw_content):
    vulnerabilities = []
    blocks = raw_content.split('Vulnerability Details:')

    for block in blocks:
        if '- CVE-' in block:
            vulnerability = {
                "name": "Unknown",
                "type": "Unknown",
                "title": "",
                "details": "",
                "risk_level": safe_search(r'Risk Level:\s*(.*)', block),
                "cvss": safe_search(r'CVSS:\s*(.*)', block),
                "cve": safe_search(r'- (CVE-\d{4}-\d{4,7})', block),
                "summary": safe_search(r'- (CVE-\d{4}-\d{4,7}):\s*(.*)', block, 2),
                "description": safe_search(r'Description:\s*(.*)', block),
                "recommendation": safe_search(r'Recommendation:\s*(.*)', block),
                "endpoint": "Unknown"
            }
            vulnerabilities.append(vulnerability)
    
    return vulnerabilities

def method10(raw_content):
    vulnerabilities = []
    blocks = re.split(r'(\[.*?\])', raw_content)
    
    for block in blocks:
        if 'Vulnerability Details:' in block:
            vulnerability = {
                "name": "Unknown",
                "type": "Unknown",
                "title": "",
                "details": "",
                "risk_level": safe_search(r'Risk Level:\s*(.*)', block),
                "cvss": safe_search(r'CVSS:\s*(.*)', block),
                "cve": safe_search(r'- (CVE-\d{4}-\d{4,7})', block),
                "summary": safe_search(r'- (CVE-\d{4}-\d{4,7}):\s*(.*)', block, 2),
                "description": safe_search(r'Description:\s*(.*)', block),
                "recommendation": safe_search(r'Recommendation:\s*(.*)', block),
                "endpoint": "Unknown"
            }
            vulnerabilities.append(vulnerability)
    
    return vulnerabilities

def write_json_report(method_num, vulnerabilities):
    output_data = {
        "domain": "http://127.0.0.1/DVWA/login.php",
        "endpoints": [],
        "vulnerabilities": vulnerabilities
    }
    output_path = os.path.join(os.path.dirname(__file__), f'reportV{method_num}.json')
    with open(output_path, 'w') as file:
        json.dump(output_data, file, indent=4)
    logging.info(f"Successfully wrote output to {output_path}.")

def main():
    try:
        # Read the input text file
        path = os.path.join(os.path.dirname(__file__), "ptt_report.json")
        logging.info(f"Reading input file from: {path}")

        with open(path, 'r') as file:
            raw_content = file.read()
            logging.debug(f"Raw content of the file:\n{raw_content}")

        methods = [method1, method2, method3, method4, method5, method6, method7, method8, method9, method10]
        
        for i, method in enumerate(methods, start=1):
            vulnerabilities = method(raw_content)
            write_json_report(i, vulnerabilities)

        print("Conversion complete. The output is saved in respective reportVx.json files.")

    except json.JSONDecodeError as e:
        logging.error(f"JSON decode error: {e}")
    except FileNotFoundError as e:
        logging.error(f"File not found: {e}")
    except Exception as e:
        logging.error(f"An unexpected error occurred: {e}")

if __name__ == "__main__":
    main()
