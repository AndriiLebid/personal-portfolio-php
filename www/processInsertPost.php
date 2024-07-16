<?php

if (!isset($_SESSION['username'])) {
    header("Location: login.php?error=Login please.");
}

include 'inc/dbFunctions.php';

$title;
$post;
$userId;
$technologyId;
$skillsId;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (
        !empty($_POST['title']) && !empty($_POST['post'])
        && !empty($_POST['userid']) && !empty($_POST['techid']) && !empty($_POST['skills']) && !empty($_POST['image'])
    ) {

        $title = $_POST['title'];
        $post = $_POST['post'];
        $userId = intval($_POST['userid']);
        $technologyId = intval($_POST['techid']);
        $skillsId = intval($_POST['skills']);
        $imageId = intval($_POST['image']);


            echo insertPost($conn, $title, $post, $userId, $technologyId, $skillsId, $imageId);
            
    } else {
        header("Location: error.php?error=<h4><a href='insertPost.php'>Go back and enter all fields.</a></h4>");
    }
}



?>