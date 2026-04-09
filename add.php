<?php
    include "config.php";
    include "header.php";

    //check with sanitization to prevent injection
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $CCode = mysqli_real_escape_string($conn, $_POST['CCode']);
        $cname = mysqli_real_escape_string($conn, $_POST['cname']);
        $info  = mysqli_real_escape_string($conn, $_POST['info']);

        //insert into table in database
        $sql = "INSERT INTO courses (course_code, course_name, info) VALUES ('$CCode', '$cname', '$info')";
        if(mysqli_query($conn, $sql)) {
            echo "Update successful";
            header ("Location: modules.php"); 
        } else {
            echo "Error:" .mysqli_error($conn);
        }
    }
?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>Update PCRS</title>
    <style>
    .container{
        max-width: 400px
        transition: 0.3s;
        border-radius: 5px;
        padding: 20px;
    }
    .btn-add {
        margin: 50px;
        padding: 8px 15px;
        background: purple;
        color: white;
        border-radius: 5px;
    }
    .btn-update {
        margin: 50px;
        padding: 8px 15px;
        background: purple;
        color: white;
        border-radius: 5px;
    }
    </style>
</head>
<body>
    <div class = "container">
        <h2 class="text-center">Update Courses</h2>
        <div class ="container-lg">
            <form method="POST" onsubmit="return validateform()">
                <div class="form-floating">
                    <input type="text" class="form-control" id="CCode" name="CCode" placeholder="Course Code">
                    <label for="CCode">Course Code</label>
                </div>
                <br>
                <div class="form-floating">
                    <input type="text" class="form-control" id="cname" name="cname" placeholder="Course Name">
                    <label for="cname">Course Name</label>
                </div>
                <br>
                <div class="form-floating">
                    <textarea class="form-control" id="info" name="info" placeholder="Course Information"></textarea>
                    <label for="info">Course Information</label>
                </div>
                <div class="text-center mt-3">
                    <button type="submit" class="btn-update">Update</button>
                    <a href="modules.php" class="btn-add">Cancel</a> 
                </div>
            </form>
        </div>
    </div>
</body>
</html>
<?php
    include "footer.php";
?>