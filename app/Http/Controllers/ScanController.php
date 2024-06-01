<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use Illuminate\Support\Facades\Log;


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
            try {
                sleep(5);
                // $url = $request->input('url');
                // $otxApiKey = env('OTX_API_KEY'); // Ensure this is set in your .env file
                
                $reportPath = public_path('scanner/reportV7_2.json');
                // $pttReportPath = public_path('scanner/ptt_report2.json');
        
                // // Delete the existing reports if they exist
                // if (file_exists($reportPath)) {
                //     unlink($reportPath);
                // }
                // if (file_exists($pttReportPath)) {
                //     unlink($pttReportPath);
                // }
                
                // // Call the Python script
                // $scriptPath = public_path('scanner/scriptv3.py');
                // $command = escapeshellcmd("python3 $scriptPath $url $otxApiKey");
                // Log::info("Executing command: $command");
                // $output = shell_exec($command . " 2>&1");
                // Log::info("Command output: $output");
        
                // // Initialize variables for file existence check
                // $maxRetries = 50; // Maximum number of retries
                // $retryDelay = 2; // Delay between retries in seconds
                // $reportExists = false;
        
                // // Loop to check if the report file exists
                // for ($i = 0; $i < $maxRetries; $i++) {
                //     if (file_exists($reportPath)) {
                //         $reportExists = true;
                //         break;
                //     }
                //     sleep($retryDelay);
                // }
                
                // If the report does not exist after retries, return with an error
                // if (!$reportExists) {
                //     return response()->json(['error' => 'Report generation failed.'], 500);
                // }
        
                // Read the report JSON file
                $report = json_decode(file_get_contents($reportPath), true);
        
                return view('domain-result', ['report' => $report]);
        
            } catch (\Exception $e) {
                Log::error('Error during scan execution: ' . $e->getMessage());
                return response()->json(['error' => $e->getMessage()], 500);
            }
        }
        
        
    // Handle form submission and execute appropriate scan
    // public function scan(Request $request)
    // {
    //     try {
    //         $url = $request->input('url');
    //         $otxApiKey = env('OTX_API_KEY'); // Ensure this is set in your .env file
            
    //         $reportPath = public_path('scanner/reportV7_2.json');
    //                 // Delete the existing report.json if it exists
    //     if (file_exists($reportPath)) {
    //         unlink($reportPath);
    //     }
        
    //         // Call the Python script
    //         $command = escapeshellcmd("python3 /home/ubuntu/Downloads/security-guard/public/scanner/scriptv3.py $url $otxApiKey");
    //         shell_exec($command);
    //         //sleep(60);
    
    //         // Initialize variables for file existence check
    //         $maxRetries = 50; // Maximum number of retries
    //         $retryDelay = 2; // Delay between retries in seconds
    //         $reportExists = false;
    
    //         // Loop to check if the report file exists
            
    //         for ($i = 0; $i < $maxRetries; $i++) {
    //             if (file_exists($reportPath)) {
    //                 $reportExists = true;
    //                 break;
    //             }
    //             sleep($retryDelay);
    //         }
            
    
    //         // If the report does not exist after retries, return with an error
    //         if (!$reportExists) {
    //             return response()->json(['error' => 'Report generation failed.'], 500);
    //         }
            
    
    //         // Read the report JSON file
    //         $report = json_decode(file_get_contents($reportPath), true);
    
    //         return view('domain-result', ['report' => $report]);
    
    //     } catch (\Exception $e) {
    //         return response()->json(['error' => $e->getMessage()], 500);
    //     }
    // }
    
    public function downloadReport()
{
    $reportPath = public_path('scanner/reportV7_2.json'); // Adjust the path as needed
    return response()->download($reportPath, 'report.json', [
        'Content-Type' => 'application/json',
        'Content-Disposition' => 'attachment; filename="report.json"',
    ]);
}

}
