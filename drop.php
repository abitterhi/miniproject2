<?php
    include "config.php";

    $id = $_GET['matrixno'];

    mysqli_query($conn, "DELETE FROM registration WHERE matrixno ='$id'");

    header("Location: view.php");
?>