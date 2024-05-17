<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style/port-result.css">
    <title>IP-Port_Result</title>
</head>
<body style="margin: 0;background-image: url('assets/background.jpg'); background-size: cover; background-position: center; background-attachment: fixed;">
    <div class="word">Guard</div>
    <img src="assets/big-shield.png" alt="shield" width="50" height="50" class="big">
    <a href="index" class="home">Home</a>
    <a href="settings" class="usr"><img src="assets/user.png" alt="user" class="user"></a>
    <br><br><br><br><br>
    <div class="result">
        <input type="text" id="ip" name="ip_address" placeholder="IP Address" pattern="^((25[0-5]|2[0-4][0-9]|[0-1]?[0-9][0-9]?)\.){3}(25[0-5]|2[0-4][0-9]|[0-1]?[0-9][0-9]?)$">
         <input type="number" id="port" name="port" placeholder="Ports">
         <button type="submit">Run</button>
        <br><br>
    <table class="service-table">
        <tr>
          <th>Risk</th>
          <th>Port</th>
          <th>Protocol</th>
          <th>State</th>
          <th>Services</th>
        </tr>
        <tr>
          <td> <div class="red-circle"></div> </td>
          <td>8080</td>
          <td>TCP</td>
          <td>open</td>
          <td>HTTP Proxy</td>
        </tr>
        <tr>
          <td><div class="yellow-circle"></div></td>
          <td>123</td>
          <td>UDP</td>
          <td>open</td>
          <td>NTP</td>
        </tr>
        <tr>
          <td><div class="blue-circle"></div></td>
          <td>3389</td>
          <td>TCP</td>
          <td>Open</td>
          <td>RDP</td>
        </tr>
      </table>
      <br><br><b><br>
    </div>
      
</body>
</html>
