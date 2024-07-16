<?php
include 'dbConnection.php';

function selectByCategory($conn, $userId)
{
    try {

        $sql = "SELECT blog.post, blog.title, blog.date, 
                user.userName, 
                technology.name 
                FROM blog INNER JOIN user ON blog.userId = user.id 
                INNER JOIN technology ON technology.id = blog.technology
                WHERE blog.userId = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            echo "<h3>", $row["title"], "</h3> <br>";
            echo  "<p>", $row["post"], "</p> <br><br>";
            echo  "<h6>Tag: ", $row["name"], "<br>";
            echo   "Wrote by: ", $row["userName"], " </h6>";
            echo  "<h6>Date: ", $row["date"], "</h6><br>";
            echo  "<hr>";
        }
        $result->close();
    } catch (Exception $ex) {
        echo "An error occured " . $ex->getMessage();
    }
}

function login($conn, $formPass, $username)
{

    $UserName = htmlentities($username);
    $userPass = htmlentities($formPass);

    $sql = "SELECT * FROM user WHERE username = ?";
    $stmt = $conn->prepare($sql) or die("Problem with query");
    $stmt->bind_param('s', $UserName);
    $stmt->execute();
    $result = $stmt->get_result(); 

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        if ($row["password"] == $formPass) {
            $result->close();
            $conn->close();
            header("Location: login.php?error=The password is weak and must be updated. You have NOT been logged in.");
            exit;
        } else {
            if (password_verify($userPass, $row["password"])) {
                $_SESSION['id'] = $row["id"];
                $_SESSION['username'] = $row["firstName"] . " " . $row["lastName"];
                $result->close();
                $conn->close();
                return true;
            } else {
                $result->close();
                $conn->close();
                return false;
            }
        }
    } else {
        header("Location: login.php?error=A SQL Error heppend.");
        $result->close();
        $conn->close();
        return false;
    }
}


function insertPost($conn, $title, $post, $userId, $technologyId, $skillid, $imageId)
{
    try {

        $sql = "INSERT INTO blog ( title, post, userId, technology, skillsId, imageId) VALUES (?,?,?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssiiii', $title, $post, $userId, $technologyId, $skillid, $imageId);
        $stmt->execute();

        $success = $stmt->affected_rows;
        $stmt->close();

        if ($success) {
            header("Location: blog.php");
            exit;
        }
    } catch (Exception $ex) {
        return "Error " . $ex->getMessage();
    }
}

function updatePost($conn, $title, $post, $userId, $technologyId, $skillId, $imageId, $blogId)
{
    try {
        $sql = "UPDATE blog SET title = ?, post = ?, userId=?, technology = ?, skillsId = ?, imageId = ? WHERE id = ?";
        $stmt = $conn->prepare($sql) or die("Problem with query");
        $stmt->bind_param('ssiiiii', $title, $post, $userId, $technologyId, $skillId, $imageId, $blogId);
        $stmt->execute();

        $result = $conn->affected_rows;
        $stmt->close();
        if ($result > 0) {
            return true;
        }
        return false;
    } catch (Exception $ex) {
        echo "An error occurred " . $ex->getMessage();
    }
}

function deletePost($conn, $postId)
{
    try {
        $sql = "DELETE FROM blog WHERE ID = ?";
        $stmt = $conn->prepare($sql) or die("Problem with query");
        $stmt->bind_param('i', $postId);
        $stmt->execute();

        $result = $conn->affected_rows;
        $stmt->close();
        if ($result > 0) {
            return true;
        }
        return false;
    } catch (Exception $ex) {
        echo "An error occured " . $ex->getMessage();
    }
}


function insertImage($conn, $name, $link, $altText)
{
    try {

        $sql = "INSERT INTO image (name, link, AltText) VALUES (?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sss', $name, $link, $altText);
        $stmt->execute();

        $success = $stmt->affected_rows;
        $stmt->close();

        if ($success) {
            header("Location: gallery.php");
            exit;
        }
    } catch (Exception $ex) {
        return "Error " . $ex->getMessage();
    }
}


function updateProject($conn, $title, $description, $userId, $technologyId, $skillsId, $image, $projectId)
{
    try {
        $sql = "UPDATE project SET title = ?, description = ?, userId=?, technologies = ?, skills = ?, images = ? WHERE id = ?";
        $stmt = $conn->prepare($sql) or die("Problem with query");
        $stmt->bind_param('ssiiisi', $title, $description, $userId, $technologyId, $skillsId, $image, $projectId);
        $stmt->execute();

        $result = $conn->affected_rows;
        $stmt->close();
        if ($result > 0) {
            return true;
        }
        return false;
    } catch (Exception $ex) {
        echo "An error occurred " . $ex->getMessage();
    }
}

function insertProject($conn, $title, $description, $userId, $technologyId, $skillsId, $image)
{
    try {

        $sql = "INSERT INTO project (title, description, userId, technologies, skills, images) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql) or die("Problem with query");
        $stmt->bind_param('ssiiis', $title, $description, $userId, $technologyId, $skillsId, $image);
        $stmt->execute();

        $result = $conn->affected_rows;
        $stmt->close();
        if ($result > 0) {
            return true;
        }
        return false;
    } catch (Exception $ex) {
        echo "An error occured " . $ex->getMessage();
    }
}

function deleteProject($conn, $postId)
{
    try {
        $sql = "DELETE FROM project WHERE ID = ?";
        $stmt = $conn->prepare($sql) or die("Problem with query");
        $stmt->bind_param('i', $postId);
        $stmt->execute();

        $result = $conn->affected_rows;
        $stmt->close();
        if ($result > 0) {
            return true;
        }
        return false;
    } catch (Exception $ex) {
        echo "An error occured " . $ex->getMessage();
    }
}
