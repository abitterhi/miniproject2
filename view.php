<?php
    include "config.php";
    include "header.php";
?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>View PCRS</title>
    <style>
        body {
            text-align: center;
            font-family: Arial;
        }

        h1 {
            margin-top: 30px;
        }

        h2 {
            padding-left: 50px;
        }

        table {
            margin: auto;
            border-collapse: collapse;
            width: 80%;
            background: white;
        }

        table, th, td {
            border: 1px solid black;
            padding: 8px;
        }

        th {
            background: #f2f2f2;
        }
</style>
</head>
<body>
    <div class="container-fluid">
        <table>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Matrix No</th>
                <th>Course Code</th>
                <th>Course Name</th>
                <th>Course Information</th>
                <th>Drop</th>
            </tr>

            <?php
            $result = mysqli_query($conn, "SELECT registration.*, courses.course_name, courses.info,courses.course_code FROM registration JOIN courses ON registration.course_code = courses.course_code");

            if($result -> num_rows > 0) {
                $no = 1;
                while($row = $result -> fetch_assoc()) {
                    //echo "<pre>"; print_r($row); echo "</pre>";
            ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $row['username']; ?></td>
                <td><?php echo $row['matrixno']; ?></td>
                <td><?php echo $row['course_code']; ?></td>
                <td><?php echo $row['course_name']; ?></td>
                <td><?php echo $row['info']; ?></td>
                <td><a href="drop.php?id=<?php echo $row['matrixno']; ?>" onclick="return confirm('Are you sure?')">Drop</a></td>
            </tr>
            <?php } } else { ?>
                <tr>
                    <td colspan="7">No courses registered.</td>
                </tr>
                <?php } ?>
        </table>
    </div>
</body>
</html>
<?php
    include "footer.php";
?>