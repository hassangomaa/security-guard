import json
import os
import re
import logging

# Set up logging
logging.basicConfig(level=logging.DEBUG, format='%(asctime)s - %(levelname)s - %(message)s')

def safe_search(pattern, text, group=1):
    match = re.search(pattern, text)
    return match.group(group) if match else ""

def method7(raw_content):
    vulnerabilities = []
    vuln_sections = re.split(r'\[.*?\]', raw_content)
    
    for section in vuln_sections:
        if 'Vulnerability Details:' in section:
            # Initialize the vulnerability dictionary
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

        # Only run method7 as per your request
        vulnerabilities = method7(raw_content)
        write_json_report(7, vulnerabilities)

        print("Conversion complete. The output is saved in reportV7.json.")

    except json.JSONDecodeError as e:
        logging.error(f"JSON decode error: {e}")
    except FileNotFoundError as e:
        logging.error(f"File not found: {e}")
    except Exception as e:
        logging.error(f"An unexpected error occurred: {e}")

if __name__ == "__main__":
    main()
