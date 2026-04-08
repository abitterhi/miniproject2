<?php
    include "config.php";
    include "header.php";

    $sql = "INSERT INTO courses (course_code, course_name, info) VALUES ('$CCode', '$cname', '$info')";
    if(mysqli_query($conn, $sql)) {
        echo "Update successful";
        header ("Location: modules.php"); 
    } else {
        echo "Error:" .mysqli_error($conn);
    }
?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>Update PCRS</title>
</head>
<body>
    <div class = "container">
        <h2 class="text-center">Update Courses</h2>
        <div class ="container-lg">
            <form onsubmit="return validateform()">
                <div class="form-floating">
                    <input type="text" class="form-control" id="matrix" placeholder="Matrix No">
                    <label for="matrix">Matrix No</label>
                </div>
                <br>
                <div class="form-floating">
                    <input type="text" class="form-control" id="CCode" placeholder="Course Code">
                    <label for="CCode">Course Code</label>
                </div>
                <br>
                <div class="form-floating">
                    <input type="text" class="form-control" id="cname" placeholder="Course Name">
                    <label for="cname">Course Name</label>
                </div>
                <br>
                <br>
                <div class="form-floating">
                    <label for="info">Course Information</label>
                </div>

                <div class="text-center mt-3">
                    <a href="add.php" class="btn-add">Update</a> 
                </div>
            </form>
        </div>
    </div>
</body>
</html>
<?php
    include "footer.php";
?>