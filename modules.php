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
                <th>Update</th>
                <th>Drop</th>
            </tr>

            <?php
            $result = mysqli_query($conn, "SELECT * FROM registration");
            $no = 1;

            $row = mysqli_fetch_assoc($result)
            ?>

            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['matrixno']; ?></td>
                <td><?php echo $row['course_code']; ?></td>
                <td><?php echo $row['course_name']; ?></td>
                <td><?php echo $row['info']; ?></td>
                <td><a href="edit.php?id=<?php echo $row['id']; ?>">Update</a></td>
                <td><a href="drop.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure?')">Drop</a></td>
            </tr>
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