<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/style/readBlog1.css">
</head>
<body style="
margin: 0;
background-image: url('/assets/background.jpg');
background-size: cover;
background-position: center;
background-attachment: fixed; ">
 <div class="word">Shield</div>
 <img src="/assets/big-shield.png" alt="shield" width="50" height="50" class="big">
 <a href="index" class="home">Home</a>
 <div class="image1"><img src="{{$blog->image}}" ></div>
 <div class="contact-Blog1"> <h2 style="font-size:40px;">{{ $blog->title}}</h2>
    <span style="font-size: 30px;">
        
    {{$blog->content}}
    
    
    </span>
  </div>    
    
</body>
</html>