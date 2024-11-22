<?php include 'banner.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e7edf7;
            margin: 50px;
        }
        table {
            width: 100%;
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
        .btn {
            margin-left: 25%;
            font-weight: bold;
            font-family: Arial, sans-serif;
            border-radius: 4px;
            background-color: #ffbf00;
            border: none;
            color: black;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
        }
        .btn-delete {
            background-color: #e74c3c;
            color: white;
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
        $sql = "SELECT * FROM student";
        $result = $conn->query($sql);
    ?>
    <h1>Student Table</h1>
    <button><a href="insert_form_data.php">Add+</a></button>
    <br><br>
    <table>
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Hometown</th>
            <th>Pays per month</th>
            <th>GPA</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
        ?>
            <tr>
                <td><?php echo $row['stu_id']; ?></td>
                <td><?php echo $row['stu_fname']; ?></td>
                <td><?php echo $row['stu_lname']; ?></td>
                <td><?php echo $row['stu_home']; ?></td>
                <td><?php echo number_format($row['stu_pay'], 2); ?></td>
                <td><a href="gpa.php?stu_id=<?php echo $row['stu_id']; ?>" style="text-decoration: underline;">GPA</a><?php echo "&nbsp;" . $row['gpa']; ?></td>
                <td><button class="btn" onclick="window.location.href='edit_form_data.php?stu_id=<?php echo $row['stu_id']; ?>'">Edit</button></td>
                <td>
                    <button class="btn btn-delete" onclick="confirmDelete('<?php echo $row['stu_id']; ?>')">Delete</button>
                </td>
            </tr>
        <?php
            }
        } else {
            echo "<tr><td colspan='8'>0 results</td></tr>";
        }
        $conn->close();
        ?>
    </table>

    <script>
        function confirmDelete(stu_id) {
            var message = "คุณแน่ใจหรือไม่ว่าจะลบข้อมูลนี้? ID: " + stu_id;
            if (confirm(message)) {
                window.location.href = "delete_data.php?stu_id=" + stu_id;
            }
        }        
    </script>
</body>
</html>
