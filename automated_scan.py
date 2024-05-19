import subprocess
import json
import os
import time

def check_tool_installed(tool_name):
    """Check if a tool is installed and available in the system PATH."""
    try:
        subprocess.check_output([tool_name, '--version'])
    except FileNotFoundError:
        print(f"Error: {tool_name} is not installed or not found in the system PATH.")
        exit(1)

def gather_subdomains(domain):
    check_tool_installed('amass')
    print(f"Gathering subdomains for {domain}")
    subdomains = subprocess.check_output(['amass', 'enum', '-d', domain]).decode().splitlines()
    return subdomains

def gather_directories(domain):
    check_tool_installed('gobuster')
    print(f"Gathering directories for {domain}")
    directories = subprocess.check_output(['gobuster', 'dir', '-u', domain, '-w', '/path/to/wordlist']).decode().splitlines()
    return directories

def run_openvas_scan(target):
    check_tool_installed('omp')
    print(f"Running OpenVAS scan on {target}")
    openvas_cmd = f"omp -u admin -w admin --xml='<create_task><name>Scan {target}</name><comment>Automated scan</comment><config id=\"daba56c8-73ec-11df-a475-002264764cea\"/><target id=\"{target}\"/></create_task>'"
    result = subprocess.check_output(openvas_cmd, shell=True).decode()
    return result

def run_zap_scan(target):
    check_tool_installed('zap-cli')
    print(f"Running ZAP scan on {target}")
    zap_start_cmd = ["zap-cli", "start", "--start-options", "daemon"]
    subprocess.run(zap_start_cmd)
    time.sleep(10)  # Give ZAP time to start
    
    zap_scan_cmd = ["zap-cli", "quick-scan", "--spider", "--scanners", "xss,sqli", target]
    result = subprocess.check_output(zap_scan_cmd).decode()
    zap_stop_cmd = ["zap-cli", "stop"]
    subprocess.run(zap_stop_cmd)
    return result

def generate_report(domain, subdomains, directories, openvas_results, zap_results):
    report = {
        "domain": domain,
        "subdomains": subdomains,
        "directories": directories,
        "vulnerabilities": []
    }
    
    # Parse OpenVAS results (simplified for demo)
    openvas_vulns = json.loads(openvas_results)
    for vuln in openvas_vulns:
        report["vulnerabilities"].append({
            "name": vuln["name"],
            "type": vuln["type"],
            "description": vuln["description"],
            "endpoint": vuln["endpoint"],
            "fix": vuln["solution"]
        })

    # Parse ZAP results (simplified for demo)
    zap_vulns = json.loads(zap_results)
    for vuln in zap_vulns:
        report["vulnerabilities"].append({
            "name": vuln["name"],
            "type": vuln["type"],
            "description": vuln["description"],
            "endpoint": vuln["endpoint"],
            "fix": vuln["solution"]
        })
    
    with open("report.json", "w") as report_file:
        json.dump(report, report_file, indent=4)
    
    print("Report generated: report.json")

if __name__ == "__main__":
    # domain = input("Enter the domain to scan: ")
    domain = "http://bwapp.test/"
    #DVWA
    # domain = "http://dvwa.test/"


    # Subdomians enum Example :bwapp.test
    # A.bwapp.test
    # B.bwapp.test
    # C.bwapp.test
    
    # Directories enum Example :bwapp.test
    # /admin
    # /login
    # /register
    
    
    
    
    
    

    # Step 1: Gather subdomains and directories
    subdomains = gather_subdomains(domain)
    print(subdomains)
    directories = gather_directories(domain)
    print(directories)

    # Step 2: Run OpenVAS scan
    openvas_results = run_openvas_scan(domain)
    print(openvas_results)

    # Step 3: Run ZAP scan
    zap_results = run_zap_scan(domain)
    print(zap_results)

    # Step 4: Generate report
    generate_report(domain, subdomains, directories, openvas_results, zap_results)
