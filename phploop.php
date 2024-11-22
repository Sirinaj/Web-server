<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>phploop</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">

</head>
<style>
    h3{
        font-family: "Sarabun", sans-serif;
        font-weight: 400;
        font-style: normal;
    }
</style>
<body>
    <center>
    <h3>ศิรินาจ วิจิตรบรรจง ปคพ.65/1 056550405104-8</h3>
    <h3>พันธู์ธัช บุนนาค ปคพ.65/1 056550405130-3</h3>
    </center>
    <?php
        $i = 1;
        while ($i <= 100) {
        echo "บรรทัดที่ " , $i , "<br>";
        $i++;
        }
    ?>
</body>
</html>