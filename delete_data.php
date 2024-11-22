<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e7edf7;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            text-align: center;
            background-color: #f9f9f9;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        h2 {
            color: #e74c3c;
            margin-bottom: 20px;
        }
        button {
            font-family: Arial, sans-serif;
            border-radius: 4px;
            background-color: #ffbf00;
            border: none;
            color: black;
            padding: 15px 32px;
            font-size: 16px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            margin-top: 20px;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #e5ac00;
        }
    </style>
</head>
<body>

    <div class="container">
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
        if (isset($_GET['stu_id'])) {
            $stu_id = intval($_GET['stu_id']);
            $conn->begin_transaction();
            try {
                $stmt1 = $conn->prepare("DELETE FROM register WHERE stu_id = ?");
                $stmt1->bind_param("i", $stu_id);
                $stmt1->execute();
                $stmt1->close();
                $stmt2 = $conn->prepare("DELETE FROM student WHERE stu_id = ?");
                $stmt2->bind_param("i", $stu_id);
                if ($stmt2->execute()) {
                    $conn->commit();
                    echo "<h2>Data deletion complete</h2>";
                } else {
                    throw new Exception("Error deleting record: " . $stmt2->error);
                }
                $stmt2->close();
            } catch (Exception $e) {
                $conn->rollback();
                echo "<h2>" . $e->getMessage() . "</h2>";
            }
        } else {
            echo "<h2>No student ID provided.</h2>";
        }
        $conn->close();
    ?>


        <button onclick="window.location.href='show_all_data.php'">Go back</button>
    </div>

</body>
</html>
