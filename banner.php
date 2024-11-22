<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .banner {
            background-color: #800080;
            color: white;
            padding: 15px 0;
            text-align: center;
            font-size: 16px;
            position: sticky;
            top: 0;
            width: 100%;
            z-index: 1000;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            margin: 0;
            box-sizing: border-box; /* ทำให้ padding และ border อยู่ในขนาดของ element */
        }
        .banner a {
            color: white;
            margin: 0 20px;
            text-decoration: none;
            font-weight: bold;
            font-size: 16px;
            transition: color 0.3s ease;
        }
        .banner a:hover {
            color: #ffcc00;
            text-decoration: underline;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0;
            text-align: center;
        }
        img {
            width: 100%;
            height: 500px;
            margin: 0;
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="rmutp.jpg" alt="RMUTP Logo">
    </div>
    <div class="banner">
        <a href="home.php">Home</a>
        <a href="regis_page.php">Register</a>
        <a href="show_all_data.php">GPA</a>
        <a href="graph.php">Graph</a>
        <a href="login.php">Online</a>
    </div>
</body>
</html>
