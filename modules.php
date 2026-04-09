<?php
    include 'config.php';
    include 'header.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Polytechnic Course Registration System (PCRS)</title>
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

        a {
            text-decoration: none;
            color: purple;
        }

        .btn-add {
            margin: 50px;
            padding: 8px 15px;
            background: purple;
            color: white;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <h2 class = "text-center" style = "margin-top: 30px; font-weight: bold;">WELCOME</h2>

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
            //use join to get data from both registration and courses table
            $result = mysqli_query($conn, "SELECT registration.username, registration.matrixno, courses.course_code, courses.course_name, courses.info FROM registration INNER JOIN courses ON registration.course_code = courses.course_code");
            $no = 1;

            //show result for each row
            while($row = mysqli_fetch_assoc($result)) {
            ?>

            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo htmlspecialchars($row['username']); ?></td>
                <td><?php echo htmlspecialchars($row['matrixno']); ?></td>
                <td><?php echo htmlspecialchars($row['course_code']); ?></td>
                <td><?php echo htmlspecialchars($row['course_name']); ?></td>
                <td><?php echo htmlspecialchars($row['info']); ?></td>
                <td><a href="dropmod.php?username=<?php echo $row['username']; ?>" onclick="return confirm('Are you sure?')">Drop</a></td>
            </tr>
            <?php } ?>
        </table>
    </div>

    <div class="text-center mt-3">
       <a href="add.php" class="btn-add">Add Course</a> 
    </div>
</body>
</html>
<?php
    include 'footer.php';
?>