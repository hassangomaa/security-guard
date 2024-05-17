<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style/ip-result.css">
    <title>IP_Result</title>
</head>
<body style="margin: 0;background-image: url('assets/background.jpg'); background-size: cover; background-position: center; background-attachment: fixed;">
    <div class="word">Guard</div>
    <img src="assets/big-shield.png" alt="shield" width="50" height="50" class="big">
    <a href="index" class="home">Home</a>
    <a href="settings" class="usr"><img src="assets/user.png" alt="user" class="user"></a>
    <br><br><br><br><br>
    <div class="result">
        <input type="text" id="ip" name="ip_address" 
        
        placeholder="{{$ipAddress}}"
        value="{{$ipAddress}}"
        
        disabled

        pattern="^((25[0-5]|2[0-4][0-9]|[0-1]?[0-9][0-9]?)\.){3}(25[0-5]|2[0-4][0-9]|[0-1]?[0-9][0-9]?)$">
        <button disabled type="submit">Run</button>
        <br><br>
        <table class="service-table">
            <tr>
                <th>Port</th>
                <th>Service </th>
                <th>Status</th>
            </tr>
            @foreach ($result as $port)
            <tr>
                <td>
                    {{ ucfirst($port['port']) }}
                    <!-- Define logic to set risk color based on protocol -->
                    {{-- @switch($port['protocol'])
                        @case('ftp')
                            <div class="red-circle"></div>
                            @break
                        @case('http')
                            <div class="blue-circle"></div>
                            @break
                        @default
                            <div class="yellow-circle"></div>
                    @endswitch --}}
                </td>
                <td> {{ ucfirst($port['protocol']) }}  </td>
                <td>{{ ucfirst($port['state']) }}</td>
            </tr>
            @endforeach
        </table>
        <br><br><br>
    </div>
</body>
</html>
