<?php
session_start();
include "config.php";

$username = $_GET['username'] ?? '';

//prepared statement to prevent injection
$stmt = $conn->prepare("DELETE FROM registration WHERE username = ?");
$stmt->bind_param("s", $username);

if ($stmt->execute()) {
    //check if any row is deleted
    if ($stmt->affected_rows > 0) {
    header("Location: view.php");
    } else {
        echo "Tiada data dijumpai dengan No Matrix tersebut.";
        header("Location: view.php");
    }
} else {
    echo "Error: " . $stmt->error;
}
?>