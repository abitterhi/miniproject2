<?php
include "config.php";

//get search query
$q = $_GET['q'] ?? '';

if ($q !== "") {
    //sanitization of inpu tto prevent injection
    $q = mysqli_real_escape_string($conn, $q);

    //select both course_name and course_code
    $sql = "SELECT course_code, course_name FROM courses WHERE course_name LIKE '$q%' LIMIT 5";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        //start loop to process each data row that matches search
        while ($row = mysqli_fetch_assoc($result)) {
            $name = $row['course_name'];
            $code = $row['course_code'];

            //pass input to fillinput func
            echo "<a href='javascript:void(0)' 
                     class='list-group-item list-group-item-action course-item' 
                     onclick=\"fillInput('$name', '$code')\">" 
                     . $name . 
                 "</a>";
        }
    } else {
        echo "<div class='list-group-item text-muted'>No matches found</div>";
    }
}
?>