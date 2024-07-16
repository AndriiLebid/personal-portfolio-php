<?php

if (!isset($_SESSION['username'])) {
    header("Location: login.php?error=Login please.");
}

include 'inc/dbFunctions.php';

$title;
$project;
$userId;
$technologyId;
$skillsId;
$description;
$projectId;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (
        !empty($_POST['title'])
        && !empty($_POST['description'])
        && !empty($_POST['userid'])
        && !empty($_POST['techid']
        && !empty($_POST['skills']))
    ) {

        $title = $_POST['title'];
        $description = $_POST['description'];
        $userId = intval($_POST['userid']);
        $technologyId = intval($_POST['techid']);
        $skillsId = intval($_POST['skills']);;
        if(!empty($_POST['image'])) {
            $image = implode(", ",($_POST['image']));
        } else {
            $image ="";
        };

        $result = insertProject($conn, $title, $description, $userId, $technologyId, $skillsId, $image);
        if ($result) {

            header("Location: projects.php");
        }
    } else {
        header("Location: error.php?error=<h4><a href='insertProject.php'>Go back and enter all fields.</a></h4>");
    }
}
