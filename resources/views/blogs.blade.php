<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
    <link rel="stylesheet" href="/style/Blog.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
     <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet"> ">
   

</head>
<body  style="
margin: 0;
background-image: url('assets/background.jpg');
background-size: cover;
background-position: center;
background-attachment: fixed;
">
    
    <div class="word">Guard</div>
    <img src="assets/big-shield.png" alt="shield" width="50" height="50" class="big">
    <a href="index" class="home">Home</a>
    

    <!-------------------------------------------------------------------------------------------------------->
    <section id="Blog">
        <!-- heading----->
        <div class="Blog-heading">
            <span>
                
                <h3>Blog</h3>
            </span>
        </div>
        <!--Blog-container-->
        <div class="Blog-container">
            <!--box1--->
            @foreach($blogs as $blog)
            <div class="Blog-box">
                <div class="Blog-img">
                    <img src="{{$blog->image}}" alt="Blog">
                </div>
                <div class="Blog-text">
                    <span>

                        <h3>{{$blog->title}}</h3>

                    </span>
                    <a href="{{ route('blogs.showOneBlog', $blog) }}">Read More</a>
                </div>
            </div>
            @endforeach
           
        </div>

    </section>
    
</body>
</html>