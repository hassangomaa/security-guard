<!DOCTYPE html>
<html lang="en">
<head>
    
    <title>Profile information</title>
    <link rel="stylesheet" href="/style/edit-profile.css">
</head>
<body style="margin: 0;background-image: url('/assets/background.jpg'); background-size: cover; background-position: center; background-attachment: fixed;">
    <div class="word">Guard</div>
    <img src="/assets/big-shield.png" alt="shield" width="50" height="50" class="big">
    <a href="index" class="home">Home</a>
    <a href="settings" class="usr"><img src="/assets/user.png" alt="user" class="user"></a>

    

      <div class="form">
    <form class="form-bod" method="POST" action="{{ route('updateProfile') }}">
      @csrf
      <h1 class="contact">Profile information changing</h1>
        <label for="username" class="user">Username</label> <br>
        <input
        class="username"
          type="username"
          id="username"
          name="name"
          value="{{auth()->user()->name}}"
          placeholder="Enter your new Username"
        /> <br>

        <label for="username" class="user">Email</label> <br>
        <input
        class="username"
          type="email"
          id="username"
          name="email"
          value="{{auth()->user()->email}}"
          placeholder="Enter your Email"
        /> <br>


        <label for="phone" class="pass">Phone</label> <br>
        <input
                class="username"

          type="text"
          id="phone"
          name="phone"
          value="{{auth()->user()->phone}}"
          placeholder="Enter your new number"
        /> <br>
        <label class="date">Password</label> <br>
        <input
        type="password"
          id="date"
          name="password"
          placeholder="Enter your current password"
        /> <br>
          <button>
        <a  class="button3">Send</a>
          </button> 
     </button>
</body>
</html>