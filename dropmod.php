<?php
session_start();
include "config.php";

$username = $_GET['username'] ?? '';

//prepared statement
$stmt = $conn->prepare("DELETE FROM registration WHERE username = ?");
$stmt->bind_param("s", $username);

if ($stmt->execute()) {
    if ($stmt->affected_rows > 0) {
    header("Location: modules.php");
    } else {
        echo "Tiada data dijumpai dengan No Matrix tersebut.";
        header("Location: view.php");
    }
} else {
    echo "Error: " . $stmt->error;
}
?>