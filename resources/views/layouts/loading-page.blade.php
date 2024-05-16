<!-- In your HTML file -->
<!DOCTYPE html>
<html>
<head>
    <!-- Your head content goes here -->
    <style>
        /* In your CSS file */
        .loading-container {
            display: flex;
            justify-content: center;
            align-items: center;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.8); /* Optional overlay to make it visible */
            z-index: 9999; /* Ensure it's above other content */
        }

        .loading-animation {
            border: 5px solid #f3f3f3; /* Light gray */
            border-top: 5px solid #3498db; /* Blue */
            border-radius: 50%;
            width: 200px;
            height: 200px;
            animation: spin 2s linear infinite; /* Add rotation animation */
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }
    </style>
</head>
<body>
<div class="loading-container" id="loadingContainer">
    <div class="loading-animation"></div>
</div>
</body>

{{--<script>--}}
{{--    window.addEventListener('load', function () {--}}
{{--        const loadingContainer = document.getElementById('loadingContainer');--}}
{{--        loadingContainer.style.display = 'none';--}}
{{--    });--}}
{{--</script>--}}

<script>
    const loadingContainer = document.getElementById('loadingContainer');
    loadingContainer.style.display = 'flex';
    window.addEventListener('load', function () {
        const delayDuration = 2000; // 2000 milliseconds = 2 seconds
        setTimeout(function () {
            loadingContainer.style.display = 'none';
        }, delayDuration);
    });
</script>

</html>
