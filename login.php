<?php include 'banner.php'; ?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>Search</title>
</head>
    <style>
        body {
            font-family: "Sarabun", sans-serif;
            background-color: #e7edf7;
            margin: 50px;
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
        form {
            padding: 20px;
            border-radius: 8px; 
            max-width: 500px;
            width: 100%;
        }
        form div {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }
        form label {
            font-weight: bold;
            min-width: 120px;
            margin-right: 10px;
        }
        form input[type="text"], form select, form textarea {
            flex-grow: 1;
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
            background-color: #f9f9f9;
            transition: background-color 0.3s ease;
        }
        form input[type="text"]:focus, form select:focus, form textarea:focus {
            background-color: #eef2f7;
            outline: none;
        }
        form input[type="submit"], form input[type="reset"] {
            font-family: Arial, sans-serif;
            border-radius: 4px;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        form input[type="submit"] {
            background-color: #4CAF50;
            border: none;
            color: white;
        }
        form input[type="submit"]:hover {
            background-color: #45a049;
        }
        form input[type="reset"] {
            background-color: red;
            border: none;
            color: white;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            background-color: #f9f9f9;
            border-radius: 15px;
            overflow: hidden;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
            word-wrap: break-word;
        }
        th {
            background-color: #d9cfde;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 20px;
            text-align: center;
        }
        .message {
            color: red;
            font-weight: bold;
        }
        a {
            text-decoration: none;
            color: black;
        }
    </style>
<body>
   
    <h1>Search GPA</h1>
    <form action="" method="post">
        <label for="stu_id">รหัสนักศึกษา:</label>
        <input type="text" id="stu_id" name="stu_id" required><br><br>
        
        <label for="birthday">วันเกิด:</label>
        <input type="text" id="birthday" name="birthday" required><br><br>
        
        <input type="submit" name="submit" value="ค้นหา">
        <input type="reset" value="รีเซ็ต">
    </form>
    
    <?php
    if (isset($_POST['submit'])) {
        $servername = "localhost";
        $username = "sirinaj-w";
        $password = "RY@2Eyan";
        $dbname = "sirinaj-w";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("การเชื่อมต่อล้มเหลว: " . $conn->connect_error);
        }

        $conn->set_charset('utf8mb4');
        $stu_id = $conn->real_escape_string($_POST['stu_id']);
        $birthday = $conn->real_escape_string($_POST['birthday']);

        $sql = "SELECT stu_id FROM student WHERE stu_id='$stu_id' AND birthday='$birthday'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            ?>
            <script type="text/javascript">
                window.location.href = "gpa.php?stu_id=<?php echo $stu_id; ?>";
            </script>
            <?php
            exit();
        } else {
            echo "<script>alert('รหัสนักศึกษาหรือวันเกิดไม่ถูกต้อง');</script>";
        }

        $conn->close();
    }
    ?>
</body>
</html>
