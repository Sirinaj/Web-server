<?php include 'banner.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mitr:wght@200;300;400;500;600;700&family=Sarabun:wght@100;200;300;400;500;600;700;800&display=swap" rel="stylesheet">
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
            border: 2px solid #ccc;
            background-color: #d9cfde;
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
    </style>
</head>
<body>
    <?php
    $servername = "localhost";
    $username = "sirinaj-w";
    $password = "RY@2Eyan";
    $dbname = "sirinaj-w";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $conn->set_charset('utf8mb4');
    $message = '';
    $rows = [];

    if (isset($_POST['save'])) {
        $stu_id = $_POST['stu_id'];
        $sid = $_POST['sid'];
        $sgrade = $_POST['sgrade'];

        $sql_check = "SELECT * FROM student WHERE stu_id = '$stu_id'";
        $result_check = $conn->query($sql_check);

        if ($result_check->num_rows > 0) {
            $sql_check_subject = "SELECT * FROM subject WHERE sid = '$sid'";
            $result_check_subject = $conn->query($sql_check_subject);

            if ($result_check_subject->num_rows > 0) {

                $sql_check_duplicate = "SELECT * FROM register WHERE stu_id = '$stu_id' AND sid = '$sid'";
                $result_check_duplicate = $conn->query($sql_check_duplicate);

                if ($result_check_duplicate->num_rows > 0) {
                    $message = "มีการใส่ข้อมูลแล้ว";
                } else {
                    $sql_insert = "INSERT INTO register (stu_id, sid, sgrade) VALUES ('$stu_id', '$sid', '$sgrade')";
                    if ($conn->query($sql_insert) === TRUE) {
                        $sql_select = "SELECT register.regid, register.stu_id, student.stu_fname, student.stu_lname, register.sid, subject.sname, register.sgrade
                                       FROM register
                                       INNER JOIN student ON student.stu_id = register.stu_id
                                       INNER JOIN subject ON subject.sid = register.sid
                                       ORDER BY register.regid DESC LIMIT 10";
                        $result = $conn->query($sql_select);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $rows[] = $row;
                            }
                        } else {
                            $message = "ไม่มีข้อมูลแสดงผล";
                        }
                    } else {
                        $message = "เกิดข้อผิดพลาดในการบันทึกข้อมูล: " . $conn->error;
                    }
                }
            } else {
                $message = "ไม่พบวิชานี้ในฐานข้อมูล";
            }
        } else {
            $message = "ไม่พบนักเรียนนี้ในฐานข้อมูล";
        }
    }
    $sql_select = "SELECT register.regid, register.stu_id, student.stu_fname, student.stu_lname, register.sid, subject.sname, register.sgrade
                   FROM register
                   INNER JOIN student ON student.stu_id = register.stu_id
                   INNER JOIN subject ON subject.sid = register.sid
                   ORDER BY register.regid DESC LIMIT 10";
    $result = $conn->query($sql_select);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
    }

    $conn->close();
    ?>
    <center>
    <div><h2>ลงทะเบียนเรียน</h2></div>
    <form action="" method="post">
        <div>
            <label for="stu_id">รหัสนักศึกษา</label>
            <input type="text" id="stu_id" name="stu_id" required>
        </div>
        <div>
            <label for="sid">รหัสวิชา</label>
            <input type="text" id="sid" name="sid" required>
        </div>
        <div>
            <label for="sgrade">เกรด (A-F)</label>
            <select id="sgrade" name="sgrade" required>
                <option value="" disabled selected>เลือกเกรด</option>
                <option value="A">A</option>
                <option value="B+">B+</option>
                <option value="B">B</option>
                <option value="C+">C+</option>
                <option value="C">C</option>
                <option value="D+">D+</option>
                <option value="D">D</option>
                <option value="F">F</option>
            </select>
        </div>
        <input type="submit" value="บันทึก" name="save">
        <input type="reset" value="เคลียร์">
    </form>
    </center>
    <?php if ($message): ?>
        <div class="message"><?php echo $message; ?></div>
    <?php endif; ?>

    <?php if (!empty($rows)): ?>
    <table>
        <thead>
            <tr>
                <th>ลำดับที่</th>
                <th>รหัสนักศึกษา</th>
                <th>ชื่อ นามสกุล</th>
                <th>รหัสวิชา</th>
                <th>ชื่อวิชา</th>
                <th>เกรด</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rows as $row): ?>
            <tr>
                <td><?php echo $row['regid']; ?></td>
                <td><?php echo $row['stu_id']; ?></td>
                <td><?php echo $row['stu_fname'] . ' ' . $row['stu_lname']; ?></td>
                <td><?php echo $row['sid']; ?></td>
                <td><?php echo $row['sname']; ?></td>
                <td><?php echo $row['sgrade']; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif; ?>
</body>
</html>
