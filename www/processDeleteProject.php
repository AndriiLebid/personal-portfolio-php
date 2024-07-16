<?php

if (!isset($_SESSION['username'])) {
    header("Location: login.php?error=Login please.");
}

include 'inc/dbFunctions.php';

$PostId;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['project'])) {
        $PostId = $_POST['project'];
        if (deleteProject($conn, $PostId)) {
            header("Location: projects.php");
            exit;
           // echo "Post delete successfully";
        }
    } else {
        header("Location: error.php?error=<h4><a href='deleteProject.php'>Go back and enter all fields.</a></h4>");
    }
}


?>