<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{ asset('style/ip-result.css') }}">
    <title>IP Result</title>
</head>
<body style="margin: 0;background-image: url('{{ asset('assets/background.jpg') }}'); background-size: cover; background-position: center; background-attachment: fixed;">
    <div class="word">Guard</div>
    <img src="{{ asset('assets/big-shield.png') }}" alt="shield" width="50" height="50" class="big">
    <a href="{{ route('home') }}" class="home">Home</a>
    <a href="{{ route('showProfile') }}" class="usr"><img src="{{ asset('assets/user.png') }}" alt="user" class="user"></a>
    <br><br><br><br><br>
    <div class="result">
        <input type="url" id="ip" name="ip_address" placeholder="{{ $report['domain'] }}" value="{{ $report['domain'] }}" readonly>
        <button disabled type="submit">Run</button>
        <br><br>
        <table class="service-table">
            <thead>
                <tr>
                    <th>Risk</th>
                    <th>Vulnerability</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($report['vulnerabilities'] as $vulnerability)
                    <tr>
                        <td>
                            <div class="{{ $vulnerability['type'] === 'SQLi' ? 'red-circle' : ($vulnerability['type'] === 'XSS' ? 'yellow-circle' : 'blue-circle') }}"></div>
                        </td>
                        <td>{{ $vulnerability['name'] }}</td>
                        <td>{{ $vulnerability['description'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <br><br>
        <input type="url" id="ip" name="ip_address" placeholder="Threat Intelligence" value=" Threat Intelligence  " readonly>
        <br><br>
        <table class="service-table">
            <thead>
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
        <br><br><br>
    </div>
</body>
</html>
