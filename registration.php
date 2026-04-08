<?php
  include "config.php";

  $error = "Please fill in all fields.";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $matrix = $_POST['matrixno'];
    $CCode = $_POST['course_code'];
    $cname = $_POST['course_name'];

    $password = password_hash ($_POST['password'], PASSWORD_DEFAULT);
    $sql = "INSERT INTO registration (username, password, matrixno, course_code, course_name) VALUES ('$username', '$password', '$matrix', '$CCode', '$cname')";
    if(mysqli_query($conn, $sql)) {
      echo "Registration successful";
      header ("Location: login.php"); 
    } else {
        echo "Error:" .mysqli_error($conn);
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Polytechnic Course Registration System (PCRS)</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <style>
    body {
      min-height: 100vh;
      display: flex;
      align-items: center; 
      justify-content: center;
      background-color: #9bbcdd; 
    }
    .container{
      max-width: 400px
      box-shadow: 0 5px 10px 0 rgba(0,0,0,0.2);
      transition: 0.3s;
      border-radius: 5px;
      padding: 20px;
      background-color: #8ed0f8;
    }
    </style>
</head>
<body>
<div class = "container">
  <h2 class="text-center" style = "font-weight: bold;">Register</h2>
  <div class ="container-lg">
    <?php
        if (isset($error)):
        ?>
        <div class = "alert alert-danger text-center"><?php echo $error;?></div>
        <?php endif; ?>
    <form method = "POST"onsubmit="return validateform()">
      <div class="input-group mb-3">
        <span class="input-group-text">@</span>
          <div class="form-floating">
            <input type="text" class="form-control" id="username" placeholder="Username">
            <label for="username">Username</label>
          </div>
      </div>
      <div class="form-floating">
        <input type="password" class="form-control" id="password" placeholder="Password">
        <label for="password">Password</label>
      </div>
<br>
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
      <p class = "text-danger" id="error"></p>
      <br>
      <div class = "text-center">
        <button  class="btn btn-primary">Register</button>
        <p>Already have an account? <a href="login.php">Login here</a></p>  
      </div>
    </form>
  </div>
</div>
  

  <script>
    function validateform(){
      let username = document.getElementById("username").value;
      let password = document.getElementById("password").value;
      let matrix = document.getElementById("matrix").value;
      let CCode = document.getElementById("CCode").value;
      let cname = document.getElementById("cname").value;

      if(username === "" || password === "" || matrix === "" || CCode === "" || cname === ""){
          document.getElementById("error").innerHTML = "Please fill in all fields.";
          return false;
      } else {
        return true;
      }
    }
  </script>
</body>
</html>