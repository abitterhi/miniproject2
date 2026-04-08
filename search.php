<?php
include "config.php"
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search Course</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow rounded-4">
        <div class="card-body">

            <h4 class="text-primary mb-3">Search Course</h4>

            <input type="text" 
                   class="form-control form-control-lg mb-3"
                   placeholder="Search course name"
                   onkeyup="showHint(this.value)">

            <div id="txtHint" class="list-group"></div>

        </div>
    </div>
</div>


<script>
function showHint(str) {

  if (str.length == 0) {
    document.getElementById("txtHint").innerHTML = "";
    return;
  } 

    const xmlhttp = new XMLHttpRequest();
    xmlhttp.onload = function() {
      document.getElementById("txtHint").innerHTML = this.responseText;
    };
  xmlhttp.open("GET", "gethint.php?q=" + str);
  xmlhttp.send();
  }

</script>