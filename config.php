<?php
    $conn = new mysqli("localhost", "root", "", "course_reg", 3308);

    if($conn -> connect_error) {
        die("Connection failed: ".$conn -> connect_error);
    }
?>