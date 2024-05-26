<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>IP Result</title>
    <style>
        .high-risk {
            background-color: #f8d7da;
        }
        .medium-risk {
            background-color: #fff3cd;
        }
        .low-risk {
            background-color: #d1ecf1;
        }
        .info-risk {
            background-color: #cce5ff;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3">Guard Report</h1>
            <div>
                <a href="{{ route('home') }}" class="btn btn-primary mr-2">Home</a>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Domain: {{ $report['domain'] }}</h5>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header">
                Vulnerabilities
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th>Risk Level</th>
                                <th>CVE</th>
                                <th>Vulnerability</th>
                                <!-- <th>Description</th> -->
                                <th>Recommendation</th>
                                <th>Affected Software</th>
                                <th>Endpoint</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($report['vulnerabilities'] as $vulnerability)
                                <tr class="{{ 
                                    strpos($vulnerability['risk_level'], 'High') !== false ? 'high-risk' : (
                                    strpos($vulnerability['risk_level'], 'Medium') !== false ? 'medium-risk' : (
                                    strpos($vulnerability['risk_level'], 'Low') !== false ? 'low-risk' : 'info-risk')) 
                                }}">
                                    <td>{{ $vulnerability['risk_level'] }}</td>
                                    <td>{{ $vulnerability['cve'] }}</td>
                                    <!-- <td>{{ $vulnerability['name'] }}</td> -->
                                    <td>{{ $vulnerability['description'] }}</td>
                                    <td>{{ $vulnerability['recommendation'] }}</td>
                                    <td>{{ $vulnerability['affected_software'] }}</td>
                                    <td>{{ $vulnerability['endpoint'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header">
                Threat Intelligence
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th>Source</th>
                                <th>Message</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($report['threat_intelligence']['validation'] as $intel)
                                <tr>
                                    <td>{{ ucfirst($intel['source']) }}</td>
                                    <td>{{ $intel['message'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="text-center mb-4">
            <button class="btn btn-success" onclick="downloadReport()">Download Report</button>
        </div>
    </div>

    <script>
        function downloadReport() {
            const element = document.createElement('a');
            const htmlContent = document.documentElement.outerHTML;
            const file = new Blob([htmlContent], { type: 'text/html' });
            element.href = URL.createObjectURL(file);
            element.download = 'report.html';
            document.body.appendChild(element);
            element.click();
            document.body.removeChild(element);
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
