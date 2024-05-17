<!DOCTYPE html>
<html>
<head>
    <title>Device Width and Height Viewport</title>
    <script>
        window.addEventListener('DOMContentLoaded', function() {
            var widthViewport = window.innerWidth;
            var heightViewport = window.innerHeight;
            document.getElementById('viewport-width').textContent = widthViewport + 'px';
            document.getElementById('viewport-height').textContent = heightViewport + 'px';
        });
    </script>
</head>
<body>
    <h1>Device Width and Height Viewport</h1>
    <p>The width viewport of your device is: <span id="viewport-width"></span></p>
    <p>The height viewport of your device is: <span id="viewport-height"></span></p>
</body>
</html>
