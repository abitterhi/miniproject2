<?php
session_start();
include 'config.php';

if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit();
}

if(isset($_POST['registration'])){
    $username = $_SESSION['username'];
    $CCode = $_POST['course_code'];

    if(empty($course_code)){
        echo "<div class='alert alert-danger text-center'>Please select a course.</div>";
    } else {
        
        $check = $conn->prepare("SELECT * FROM registration WHERE username = ? AND course_code = '$CCode'");
        $check->bind_param("ii", $username, $CCode);
        $check->execute();
        $result = $check->get_result();

        if($result->num_rows > 0){
            echo "<div class='alert alert-warning text-center'>You already registered this course!</div>";
        } else {
            $stmt = $conn->prepare("INSERT INTO registration (username, course_code) VALUES (?, ?)");
            $stmt->bind_param("ii", $username, $CCode);
            $stmt->execute();

            echo "<div class='alert alert-success text-center'>Course registered successfully!</div>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Course Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow rounded-4">
            <div class="card-body">
                <h4 class="text-secondary mb-3">Course Registration</h4>

                <input type="text" id="courseInput" class="form-control mb-3"placeholder="Search course..." onkeyup="showHint(this.value)">

                <div id="txtHint" class="list-group"></div>

                <form method="POST">
                    <input type="hidden" name="CCode" id="CCode">
                    <div class="mb-3">
                        <label>Selected Course:</label>
                        <input type="text" id="selected_course" class="form-control" readonly>
                    </div>

                    <button type="submit" name="register" class="btn btn-success w-100" href="view.php">Register Course</button>
                </form>
            </div>
        </div>
    </div>
    <script>
    function showHint(str){

        if(str.length == 0){
            document.getElementById("txtHint").innerHTML = "";
            return;
        }

        const xmlhttp = new XMLHttpRequest();

        xmlhttp.onload = function(){
            document.getElementById("txtHint").innerHTML = this.responseText;
        };

        xmlhttp.open("GET", "ajax/get_courses.php?q=" + encodeURIComponent(str), true);
        xmlhttp.send();
    }

    document.addEventListener("click", function(e){
        if(e.target.classList.contains("course-item")){

            let id = e.target.getAttribute("data-id");
            let name = e.target.innerText;

            document.getElementById("CCode").value = id;
            document.getElementById("selected_course").value = name;

            document.getElementById("txtHint").innerHTML = "";
        }
    });

    function fillInput(val) {
        document.getElementById("courseInput").value = val;
        document.getElementById("txtHint").innerHTML = "";
    }
    </script>
</body>
</html>