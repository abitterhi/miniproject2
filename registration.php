<?php
  include "config.php";

  $error = "Please fill in all fields.";


  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $matrixno = mysqli_real_escape_string($conn, $_POST['matrixno']);
    $course_selected = mysqli_real_escape_string($conn, $_POST['course_code']);

    //password hashing for encryption
    $password = password_hash ($_POST['password'], PASSWORD_DEFAULT);
    //check if fields are empty
    if(empty($username) || empty($_POST['password'])) {
      echo "Error:" .mysqli_error($conn);
    } else { 
        //insert data into registration table 
        $sql = "INSERT INTO registration (username, password, matrixno, course_code) VALUES ('$username', '$password', '$matrixno', '$course_selected')";
        if(mysqli_query($conn, $sql)) {
          //insert data into users table as well if first register is successful
          $sql = "INSERT INTO users (username, matrixno, course_code) VALUES ('$username', '$matrixno', '$course_selected')";
          //if registration is successful, user is redirected to login page
          echo "Registration successful";
          header ("Location: login.php"); 
        } else {
          //error message display if registration is unsuccessful
          echo "Error:" .mysqli_error($conn);
        }
    }
  }

  //array list of courses code and name
  $Cname_list = [
    "DFK40063" => "SERVER ADMINISTRATION",
    "DFP40434" => "BUSINESS INTELLIGENCE",
    "DFP40443" => "FULL STACK WEB DEVELOPMENT",
  ];
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
            <input type="text" class="form-control" id="username" name="username" placeholder="Username">
            <label for="username">Username</label>
          </div>
      </div>
      <div class="form-floating">
        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
        <label for="password">Password</label>
      </div>
<br>
      <div class="form-floating"> 
        <input type="text" class="form-control" id="matrixno" name="matrixno" placeholder="Matrix No">
        <label for="matrixno">Matrix No</label>
      </div>
<br>
      <div>
        <select name="course_code" id="course_code" class="form-select">
          <option value="" disabled selected class ="text-center">-- CHOOSE COURSE --</option>
                <?php
                    foreach($Cname_list as $code => $display) {
                        echo "<option value='$code'>$display</option>";
                    }
                ?>
            </select>
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
      //validate form on client side
    function validateform(){
      let username = document.getElementById("username").value;
      let password = document.getElementById("password").value;
      let matrix = document.getElementById("matrixno").value;
      let course_code = document.getElementById("course_code").value;

      if(username === "" || password === "" || matrixno === "" || course_code === ""){
          document.getElementById("error").innerHTML = "Please fill in all fields.";
          return false;
      } else {
        return true;
      }
    }

    //ajax func to allow communication with server without refreshing the page 
    function showHint(str) {

  if (str.length == 0) {
    document.getElementById("txtHint").innerHTML = "";
    return;
  }
  
  //create obj to communicate with server
  const xmlhttp = new XMLHttpRequest();
  //what to do after server's response
  xmlhttp.onload = function() {
    document.getElementById("txtHint").innerHTML = this.responseText;
  };
  //get request to gethint file
  xmlhttp.open("GET", "gethint.php?q=" + str);
  xmlhttp.send();
}

//func that is called when user clicks on a suggestion
function fillInput(val) {
  document.getElementById("courseInput").value = val;
  document.getElementById("txtHint").innerHTML = "";
  }
  </script>
</body>
</html>