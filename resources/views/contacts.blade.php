<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home</title>
    <link rel="stylesheet" href="style/welcome.css">
</head>
<body style="margin: 0;background-image: url('assets/background.jpg'); background-size: cover; background-position: center; background-attachment: fixed;">
    
    <div class="container">
        <div class="word">Shield</div>
        <img src="assets/big-shield.png" alt="shield" width="50" height="50" class="big">
        <a href="login" class="button1">Login</a>
        <a href="{{route('register')}}" class="button2">Register</a>
        <a href="/blogs" class="Blogcontent"> Blogs</a>

    </div>
    
 
      
        <br><br><br><br><br><br><br><br><br><br><br><br><br>
      <div class="form">
        <h1 class="contact">Contact Us</h1>
      <form>
        <input
        class="username"
          type="username"
          id="username"
          name="username"
          placeholder="Enter your name"
        /> <br>

        
        <input
          type="username"
          id="password"
          name="pasword"
          placeholder="Enter your Email"
        /> <br>
        
        <input
        type="date"
          id="date"
          name="date"
          placeholder="Enter the date and time"
        /> <br>
        
          <select id="selector">
              <option value="option1">Penetration testing </option>
              <option value="option2">Cyber risk assessment </option>
              <option value="option3">Cyber ​​security design</option>
              <option value="option3">Network security</option>
              <option value="option3">Website security</option>
          </select><br>
         
          <select id="meet">
            <option value="option1">Chatting </option>
            <option value="option2">Meeting</option>
        </select> <br>
        
        <a href=# class="button3">Send</a>
        
      </form>
      <br><br><br>
    </div>
    
</body>
</html>