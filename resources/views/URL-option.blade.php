<!DOCTYPE html>
<html lang="en">
<head>
    <title>URL option</title>
    <link rel="stylesheet" href="/style/URL-option.css" />
    <script>
        function validateForm() {
            var urlInput = document.getElementById("url");
            var ipInput = document.getElementById("ip");

            // Check if either URL or IP Address is filled
            if (urlInput.value.trim() === "" && ipInput.value.trim() === "") {
                alert("Please fill either URL or IP Address");
                return false;
            }

            // Check if both URL and IP Address are filled
            if (urlInput.value.trim() !== "" && ipInput.value.trim() !== "") {
                alert("Please fill either URL or IP Address, not both");
                return false;
            }

            return true;
        }
    </script>
</head>
<body style="
      margin: 0;
      background-image: url('/assets/background.jpg');
      background-size: cover;
      background-position: center;
      background-attachment: fixed;
    ">
    <div class="word">Guard</div>
    <img src="/assets/big-shield.png" alt="shield" width="50" height="50" class="big" />
    <a href="index" class="home">Home</a>
    <!-- <a href="settings" class="usr">
        <img src="/assets/user.png" alt="user" class="user" />
    </a> -->

    <div class="url">
        <div class="container">
            <div class="square">
                <form action="{{ route('scan') }}" method="POST" onsubmit="return validateForm()">
    @csrf
    <label for="url" class="light">Domain</label>
    <input type="url" id="url" name="url" placeholder="Enter URL" />



    <button type="submit" style="color: white;">Run</button>
</form>

            </div>
        </div>
    </div>
</body>
</html>
