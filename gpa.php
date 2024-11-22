<?php include 'banner.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mitr:wght@200;300;400;500;600;700&family=Sarabun:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e7edf7;
            margin: 50px;
            font-family: "Sarabun", sans-serif;
            font-weight: 500;
            font-style: normal;
        }
        h1,h3 {
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
        table {
            border-collapse: collapse;
            margin-bottom: 20px;
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
        $stu_id = isset($_GET['stu_id']) ? $_GET['stu_id'] : '';

        if (!empty($stu_id)) {
            $sql_student = "SELECT stu_id, CONCAT(stu_fname, ' ', stu_lname) AS student_name FROM student WHERE stu_id = '$stu_id'";
            $result_student = $conn->query($sql_student);

            $sql_subjects = "SELECT sb.sid, sb.sname, sb.scredit, r.sgrade,
                                CASE r.sgrade
                                    WHEN 'A' THEN 4.00
                                    WHEN 'B+' THEN 3.50
                                    WHEN 'B' THEN 3.00
                                    WHEN 'C+' THEN 2.50
                                    WHEN 'C' THEN 2.00
                                    WHEN 'D+' THEN 1.50
                                    WHEN 'D' THEN 1.00
                                    WHEN 'F' THEN 0.00
                                    ELSE NULL
                                END AS grade_point
                            FROM register r 
                            INNER JOIN subject sb ON r.sid = sb.sid 
                            WHERE r.stu_id = '$stu_id'
                            ORDER BY sb.sid";
            $result_subjects = $conn->query($sql_subjects);

            $sql_gpa_calculation = "SELECT SUM(sb.scredit * 
                CASE r.sgrade
                    WHEN 'A' THEN 4.00
                    WHEN 'B+' THEN 3.50
                    WHEN 'B' THEN 3.00
                    WHEN 'C+' THEN 2.50
                    WHEN 'C' THEN 2.00
                    WHEN 'D+' THEN 1.50
                    WHEN 'D' THEN 1.00
                    WHEN 'F' THEN 0.00
                    ELSE NULL
                END) / SUM(sb.scredit) AS cumulative_gpa,
                SUM(sb.scredit) AS total_credits
                FROM register r
                INNER JOIN subject sb ON r.sid = sb.sid
                WHERE r.stu_id = '$stu_id'";
            $result_gpa_calculation = $conn->query($sql_gpa_calculation);
            $gpa_row = $result_gpa_calculation->fetch_assoc();
            $gpa = $gpa_row['cumulative_gpa'];
            $total_credits = $gpa_row['total_credits'];

            $sql_update_gpa = "UPDATE student SET gpa = '$gpa' WHERE stu_id = '$stu_id'";
            $conn->query($sql_update_gpa);
        }
    ?>

    <?php if (!empty($stu_id)): ?>
        <h1>ข้อมูลนักศึกษา</h1>
        <table style="width: 50%;">
            <tr>
                <th>รหัสนักศึกษา</th>
                <th>ชื่อนักศึกษา</th>
            </tr>
            <?php if ($result_student->num_rows > 0): ?>
                <?php while($row = $result_student->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['stu_id']; ?></td>
                        <td><?php echo $row['student_name']; ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php endif; ?>
        </table>

        <h1>ข้อมูลวิชาและเกรด</h1>
        <table style="width: 70%;">
            <tr>
                <th>รหัสวิชา</th>
                <th>ชื่อวิชา</th>
                <th>หน่วยกิต</th>
                <th>เกรด</th>
            </tr>
            <?php if ($result_subjects->num_rows > 0): ?>
                <?php while($row = $result_subjects->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['sid']; ?></td>
                        <td><?php echo $row['sname']; ?></td>
                        <td><?php echo $row['scredit']; ?></td>
                        <td><?php echo $row['sgrade']; ?></td>
                    </tr>
                <?php endwhile; ?>
                <tr>
                    <th colspan="2">หน่วยกิตรวม <?php echo number_format($total_credits, 2); ?></th>
                    <th colspan="2">เกรดเฉลี่ยสะสม: <?php echo number_format($gpa, 2); ?></th>
                </tr>
            <?php endif; ?>
        </table>
    <?php else: ?>
        <p>กรุณาเลือกนักศึกษาจากลิงก์เพื่อดูข้อมูลเกรด.</p>
    <?php endif; ?>

    <?php
    $conn->close();
    ?>
</body>
</html>
