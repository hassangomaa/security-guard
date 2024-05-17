<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Login</title>
    <link rel="stylesheet" href="/style/login.css" />
  </head>
  <body
    style="
      margin: 0;
      background-image: url('/assets/background.jpg');
      background-size: cover;
      background-position: center;
      background-attachment: fixed;
    "
  >
    <div class="word">Guard</div>
    <img src="/assets/big-shield.png" alt="shield" width="50" height="50" class="big">
    <a href="index" class="home">Home</a>
    <div class="log">
    <div class="container">
      <div class="square">
        <img src="/assets/big-user.png" alt="sign" />
   <form class="form-bod" method="POST" action="{{ route('login') }}">
            @csrf <!-- Include CSRF token for security -->
            <label for="username" class="user">Username:</label>
          <input
            type="username"
            id="username"
            name="email"
            placeholder="name@example.com"
          />

          <label for="password" class="pass">Password:</label>
          <input
            type="password"
            id="password"
            name="password"
            placeholder="********"
          />

          <button>
            <a href="URL-option" style="color: white"> Log In </a>
          </button>

           {{-- <div class="cell-actions">
                <div class="Reg-cell">
                    <a href="{{ route('register') }}" class="register-link">Sign Up</a>
                </div> --}}
        </form>
      </div>
    </div>
  </div>
  </body>
</html>
