<?php
    session_start();
    include "config.php";
    $error = "Please fill in all fields";
    $invalid = "Invalid username or password";

    if ($_SERVER["REQUEST_METHOD"]== "POST") {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = $_POST['password'];

        //show error message when user leaves field empty
        if (empty($username) || empty($password)){
            echo $error;
            exit();
        } 

        //check if admin is the one logging in then directing to modules page if yes
        if($username == "admin" || $password == "admin123") {
                        header ("Location: modules.php"); 
                    } else {
                        echo $error;
                    }
        $result = mysqli_query($conn, "SELECT * FROM registration WHERE username='$username'");
        $row = $result->fetch_assoc();
        
        //verify password 
        if ($row && password_verify($password, $row['password'])) {
        $_SESSION['username'] = $username;
        header("Location: view.php");

        
        } else {
            echo $invalid;
        }

        //preapred statement to prevent injection
        $stmt = $conn->prepare("SELECT * FROM registration WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
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
        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
        transition: 0.3s;
        border-radius: 5px;
        padding: 20px;
        background-color: #8de0f8;
    }
    </style>
</head>
<body>
    <div class = "container">
        <h2 class="text-center mb-4" style = "font-weight: bold;">Login</h2>
        <div class = "container-sm"> 
            <?php if (isset($error)); ?>
            <div class = "alert alert-danger text-center"><?php echo $error; ?></div>
        
            <form method="POST" onsubmit="return validateform()">
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
                <div class = "text-center">
                    <button class="btn btn-primary">Login</button>
                    <p>Don't have an account? <a href="registration.php">Register here</a></p>  
                </div>
            </form>
        </div>
        <p calss="text-center" id="error"></p>
    </div>
    <script>
       //validate form on client-side  
    function validateform(){
        let username = document.getElementById("username").value;
        let password = document.getElementById("password").value;

        if(username === "" || password === "" ){
            document.getElementById("error").innerHTML = "Please fill in all fields.";
            return false;
        }
        return true;
    }
    </script>
</body>
</html>