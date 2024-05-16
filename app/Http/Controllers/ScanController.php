<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class ScanController extends Controller
{
    // Display the form view
    public function showForm()
    {
        return view('URL-option'); // Assuming 'URL-option' is your form view
    }

    // Handle form submission and execute appropriate scan
    public function scan(Request $request)
    {
        // return $request->all();
        $scanType = $request->input('scan_type');
        $ip = $request->input('ip');
        $port = $request->input('port');
        $url = $request->input('url');

        switch ($scanType) {
            case 'light':
                if (!empty($ip) && filter_var($ip, FILTER_VALIDATE_IP)) {
                    // return "light ip scan";
                    $result = $this->executeLightIPScan($ip, $port);
                    // return $result;
                    return view('ip-result', ['result' => $result, 'ipAddress' => $ip]);
                } elseif (!empty($url)) {
                    $result = $this->executeLightDomainScan($url);
                    return view('domain-result', ['result' => $result]);
                }
                break;
            case 'deep':
                if (!empty($ip) && filter_var($ip, FILTER_VALIDATE_IP)) {
                    $result = $this->executeDeepIPScan($ip, $port);
                    return view('ip-result', ['result' => $result, 'ipAddress' => $ip]);
                } elseif (!empty($url)) {
                    $result = $this->executeDeepDomainScan($url);
                    return view('domain-result', ['result' => $result]);
                }
                break;
            default:
                $result = []; // Default result if no valid scan type is specified
                break;
        }

        return view('scan-result', ['result' => $result]);
    }

    private function executeLightIPScan($ip, $port = null)
    {
        $command = "nmap -T4 -F";
        if ($port !== null) {
            $command .= " -p $port";
        }
        $command .= " $ip";

        return $this->executeCommand($command);
    }

    private function executeDeepIPScan($ip, $port = null)
    {
        $command = "nmap -sV -sS -sC -A";
        if ($port !== null) {
            $command .= " -p $port";
        }
        $command .= " $ip";

        return $this->executeCommand($command);
    }

    private function executeLightDomainScan($domain)
    {
        $command = "nmap -T4 -F $domain";
        return $this->executeCommand($command);
    }

    private function executeDeepDomainScan($domain)
    {
        $command = "nmap -sV -sS -sC -A $domain";
        return $this->executeCommand($command);
    }

    private function executeCommand($command)
    {
        $process = new Process(explode(' ', $command));
        $process->setTimeout(3600); // Set a reasonable timeout if needed
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        // Return the command output
        return $this->parseScanResults($process->getOutput());
        //  $process->getOutput();


    }

    // private function executeCommand($command)
    // {
    //     $process = new Process(explode(' ', $command));
    //     $process->setTimeout(3600); // Set a reasonable timeout if needed
    //     $process->run();

    //     if (!$process->isSuccessful()) {
    //         throw new ProcessFailedException($process);
    //     }

    //     // Return the command output
    //     return $process->getOutput();
    // }

    //scan the IP address for vulnerabilities


    public function ip_result()
    {

        // $ipAddress = $request->input('ip_address');

        $ipAddress = "192.168.56.101";


        // Execute nmap command to scan the provided IP address for vulnerabilities
        $process = new Process(['nmap', '-sV', $ipAddress]);
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        // Parse the nmap scan results to extract vulnerabilities

        // Parse the nmap scan results to extract vulnerabilities
        $ports = $this->parseScanResults($process->getOutput());


        // Execute a command to scan the IP address for vulnerabilities
        // Example command: Replace with actual command to scan the IP
        // $command = "nmap -sV $ipAddress"; // Example using nmap tool
        // $scanResult = shell_exec($command);
        return   view('ip-result', ['ports' => $ports, 'ipAddress' => $ipAddress]);
    }

    //domain_result
    public function domain_result()
    {
        return   view('domain-result');
    }


    //port_result
    public function port_result()
    {
        return   view('port-result');
    }


    private function parseScanResults(string $scanOutput)
    {
        $vulnerabilities = [];

        // Split the scan output into lines
        $lines = explode(PHP_EOL, $scanOutput);

        foreach ($lines as $line) {
            // Example line from nmap output: "22/tcp   open  ssh"
            if (preg_match('/^(\d+\/tcp)\s+(\w+)\s+(\w+)/', $line, $matches)) {
                $port = $matches[1];
                $state = $matches[2];
                $protocol = $matches[3];

                // Construct vulnerability entry
                $vulnerability = [
                    'port' => $port,
                    'state' => $state,
                    'protocol' => $protocol,
                ];

                // Add vulnerability to the list
                $vulnerabilities[] = $vulnerability;
            }
        }

        return $vulnerabilities;
    }
}
