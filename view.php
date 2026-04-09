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
                <th>Name</th>
                <th>Matrix No</th>
                <th>Course Code</th>
                <th>Course Name</th>
                <th>Course Information</th>
                <th>Drop</th>
            </tr>

            <?php
            //retrieve data from both registration and courses teable 
            $result = mysqli_query($conn, "SELECT registration.username, registration.matrixno, courses.course_code, courses.course_name, courses.info FROM registration INNER JOIN courses ON registration.course_code = courses.course_code");

            //fetch row and store in row array
            $row = mysqli_fetch_assoc($result)
            ?>

            <tr>
                <td><?php echo htmlspecialchars($row['username']); ?></td>
                <td><?php echo htmlspecialchars($row['matrixno']); ?></td>
                <td><?php echo htmlspecialchars($row['course_code']); ?></td>
                <td><?php echo htmlspecialchars($row['course_name']); ?></td>
                <td><?php echo htmlspecialchars($row['info']); ?></td>
                <td><a href="drop.php?username=<?php echo $row['username']; ?>" onclick="return confirm('Are you sure?')">Drop</a></td>
            </tr>
        </table>
    </div>
</body>
</html>
<?php
    include "footer.php";
?>