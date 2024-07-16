<?php

if (!isset($_SESSION['username'])) {
    header("Location: login.php?error=Login please.");
}

include 'inc/dbFunctions.php';

$PostId;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['post'])) {
        $PostId = $_POST['post'];
        if (deletePost($conn, $PostId)) {
            header("Location: blog.php");
            exit;
           // echo "Post delete succesfully";
        }
    } else {
        header("Location: error.php?error=<h4><a href='deletePost.php'>Go back and enter all fields.</a></h4>");
    }
}


?>