<?php
include 'config.php';
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
      <input type="text" id="courseInput" class="form-control form-control-lg mb-3" placeholder="Search course name" onkeyup="showHint(this.value)">
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

function fillInput(val) {
  document.getElementById("courseInput").value = val;
  document.getElementById("selected_course").value = val;
  document.getElementById("CCode").value = val;
  document.getElementById("txtHint").innerHTML = "";
}
</script>