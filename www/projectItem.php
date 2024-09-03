<?php include 'inc/header.php'; ?>
<?php include 'inc/nav.php'; ?>

<main>

    <div class="notice">

        <?php
        include_once 'inc/dbConnection.php';
        $sql = "SELECT project.title, project.description, user.userName, project.skills, technology.name, project.images 
                    FROM project INNER JOIN user ON project.userId = user.id 
                    INNER JOIN technology ON technology.id = project.technologies WHERE project.id = ?";


        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $_GET["id"]);
        $stmt->execute();

        $result = $stmt->get_result();


        if ($result->num_rows > 0) {
            
            while ($row = $result->fetch_assoc()) {

                echo "<hr>";
                echo "<div class = 'postimage postimageitemdirection'>";
                echo "<div class='postitem postitemminsize'>";
                if ($row["images"] !== null) {
                    echo  '<div class="carousel">';
                    $arrayImage = explode(", ", $row["images"]);
                    foreach ($arrayImage as $arr) {
                        echo '<div class="carousel-item">';
                        echo '<img src="' . $arr . '" alt="Project Post Image">';
                        echo "</div>";
                    }
                    echo "</div>";
                }
                echo "</div>";

                echo "<div class='postitem'>";
                echo "<div>";
                echo "<h2>", $row["title"], "</h2> <br>";
                echo '<p>', $row["description"], "</p></div></div></div>";

                echo "<h5>Tag: ", $row["name"], "<br>";
                echo "Wrote by: ", $row["userName"], " </h5>";
            }
        } else {
            echo "<center>There are no projects added at the moment</center>";
        }
        // Close result set
        $result->close();
        // Close connection
        $conn->close();

        ?>

</main>

<?php include 'inc/footer.php'; ?>