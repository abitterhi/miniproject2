<?php
include "config.php"

$q = $_GET['q'] ?? '';

if ($q !== ""){
    $q = mysqli_real_escape_string($conn, $q);

    $sql = "SELECT username FROM registration WHERE username LIKE '$q%'";

    $result = mysqli_query($conn, $sql);

    $suggestion="";

    while($row = mysqli_fetch_assoc($result)) {
        if($suggestion == ""){
            $suggestion = $row['name'];
        }
    }

    echo $suggestion ?: "No suggestion";
    
}
?>