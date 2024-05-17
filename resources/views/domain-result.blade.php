<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style/domain-result.css">
    <title>Domain_Result</title>
</head>
<body style="margin: 0;background-image: url('assets/background.jpg'); background-size: cover; background-position: center; background-attachment: fixed;">
    <div class="word">Guard</div>
    <img src="assets/big-shield.png" alt="shield" width="50" height="50" class="big">
    <a href="index" class="home">Home</a>
    <a href="settings" class="usr"><img src="assets/user.png" alt="user" class="user"></a>
    <br><br><br><br><br>
    <div class="result">
        <input type="URL" id="ip" name="ip_address" placeholder="Domain">
         
         <button type="submit">Run</button>
        <br><br>
    <table class="service-table">
        <tr>
          <th>Risk</th>
          <th>Vulnerability</th>
          <th>State</th>
        </tr>
        <tr>
          <td> <div class="red-circle"></div> </td>
          <td>SQL injection</td>
          <td>Open</td>
        </tr>
        <tr>
          <td><div class="yellow-circle"></div></td>
          <td>Cross-Site-Scripting</td>
          <td>Open</td>
        </tr>
        <tr>
          <td><div class="blue-circle"></div></td>
          <td>PHP error enabled</td>
          <td>Open</td>
        </tr>
      </table>
      <br><br><b><br>
    </div>
      
</body>
</html>
