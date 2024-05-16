<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Sign UP</title>
    <link rel="stylesheet" href="style/sign-up.css" />
  </head>
  <body
    style="
      margin: 0;
      background-image: url('assets/background.jpg');
      background-size: cover;
      background-position: center;
      background-attachment: fixed;
    "
  > 
  <div class="word">Shield</div>
  <img src="assets/big-shield.png" alt="shield" width="50" height="50" class="big">
  <a href="index" class="home">Home</a>
    <div class="sign">
    <div class="container">
      <div class="square">
        <img src="assets/sign-up.png" alt="sign" />
       <form class="form-bod" method="POST" action="{{ route('register') }}">
            @csrf
            <label for="username" class="user">Name:</label>
          <input
            type="username"
            id="username"
            name="name"
            placeholder="Name"
          />
          <label for="email" class="mail">Email:</label>
          <input type="email" id="email" name="email" placeholder="Email" />
          <label for="password" class="pass">Password:</label>
          <input
            type="password"
            id="password"
            name="password"
            placeholder="*********"
          />
          <label for="phone" class="phone">phone Number:</label>
          <input
            type="phone"
            id="phone"
            name="phone"
            placeholder="+1-000-000-000"
          />

          <button>
            <a  
            style="color: white;"
            > Submit </a>
          </button>

          <div class="Reg-cell" style="justify-content: space-between !important;">
                <p class="c-alt">Already have an account?</p>
                <a href="{{ route('login') }}" class="register-link">Log in</a>
            </div>
        </form>
      </div>
    </div>
  </div>
  </body>
</html>
