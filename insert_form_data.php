<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mitr:wght@200;300;400;500;600;700&family=Sarabun:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e7edf7;
            margin: 50px;
        }
        h1{
            font-family: "Sarabun", sans-serif;
            font-weight: 500;
            font-style: normal;
        }
        button {
            font-weight: bold;
            font-family: Arial, sans-serif;
            border-radius: 4px;
            background-color: #d9cfde;
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
        }
        a {
            text-decoration: none;
            color: black;
        }
        form {
            padding: 20px;
            border-radius: 8px; 
            max-width: 500px;
            width: 100%;
        }
        form div {
            margin-bottom: 15px;
        }
        form label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        form input[type="text"], form textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }
        form input[type="submit"] {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 15px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        form input[type="submit"]:hover {
            background-color: #45a049;
        }
        form input[type="button"] {
            font-family: Arial, sans-serif;
            border-radius: 4px;
            background-color: red;
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
        }
        .btn {
            font-weight: bold;
            font-family: Arial, sans-serif;
            border-radius: 4px;
            background-color: white;
            border: none;
            color: black;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            margin-left: 20px;
        }
        .alert {
            padding: 20px;
            background-color: #4CAF50;
            color: white;
            border-radius: 0;
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            display: none;
            text-align: center;
            z-index: 1;
        }
    </style>
</head>
<body>  
    <button><a href="show_all_data.php">Home</a></button>
    <br><br>
    <h1>เพิ่มรายชื่อนักศึกษา</h1>
    
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $servername = "localhost";
        $username = "sirinaj-w";
        $password = "RY@2Eyan";
        $dbname = "sirinaj-w";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $conn->set_charset('utf8mb4');
        $stu_fname = $_POST['stu_fname'];
        $stu_lname = $_POST['stu_lname'];
        $stu_home = $_POST['stu_home'];
        $stu_pay = $_POST['stu_pay'];

        $sql = "SELECT stu_fname, stu_lname, stu_home, stu_pay FROM student WHERE stu_fname='$stu_fname'";
        $query = mysqli_query($conn, $sql);
        $row = mysqli_num_rows($query);

        if ($row > 0) {
            echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    showAlert('error', 'Error please try again!');
                });
                </script>";
        } else {
            $default_gpa = 0.00;
            $default_birthday = 000000;
            $stmt = $conn->prepare("INSERT INTO student (stu_fname, stu_lname, stu_home, stu_pay, gpa, birthday) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssds", $stu_fname, $stu_lname, $stu_home, $stu_pay, $default_gpa, $default_birthday);
            
            if ($stmt->execute()) {
                echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        showAlert('success', 'เพิ่มข้อมูลสำเร็จ', true);
                    });
                    </script>";
            } else {
                echo "Error: " . $stmt->error;
            }
            
            $stmt->close();
        }
        
        $conn->close();
    }
    ?>
    
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <div>
            <label for="stu_fname">First Name:</label>
            <input type="text" id="stu_fname" name="stu_fname" required>
        </div>
        <div>
            <label for="stu_lname">Last Name:</label>
            <input type="text" id="stu_lname" name="stu_lname" required>
        </div>
        <div>
            <label for="stu_home">Hometown:</label>
            <textarea id="stu_home" name="stu_home"></textarea>
        </div>
        <div>
            <label for="stu_pay">Pays per month:</label>
            <input type="text" id="stu_pay" name="stu_pay" required>
        </div>
        <input type="submit" value="Submit">
        <input type="button" value="Cancel" onclick="window.location.href='show_all_data.php'">
    </form>

    <div class="alert" id="alert">
        <strong id="alert-message"></strong>
        <button class="btn" id="ok-button" onclick="redirectToPage()">OK</button>
    </div>

    <script>
        function showAlert(type, message, showOkButton = false) {
            const alertDiv = document.getElementById('alert');
            const alertMessage = document.getElementById('alert-message');
            const okButton = document.getElementById('ok-button');
            
            alertDiv.style.display = 'block';
            alertDiv.style.backgroundColor = type === 'success' ? '#4CAF50' : '#f44336';
            alertMessage.textContent = message;

            if (showOkButton) {
                okButton.style.display = 'inline-block';
            } else {
                okButton.style.display = 'none';
            }
        }

        function redirectToPage() {
            window.location.href = 'show_all_data.php';
        }
    </script>
</body>
</html>
