<?php include 'inc/header.php'; ?>
<?php include 'inc/nav.php'; ?>

<main>

    <div class="notice">

        <?php
        include_once 'inc/dbConnection.php';
        $sql = "SELECT project.title, project.description, user.userName, project.skills, technology.name, project.images FROM project INNER JOIN user ON project.userId = user.id INNER JOIN technology ON technology.id = project.technologies;";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo  "<hr>";
                echo "<div class = 'postimage'>";

                echo "<div class='gallery-container'>";
                echo "<div class='gallery'>";

                if($row["images"] !== null){
                    $arrayImage = explode(", ", $row["images"]);
                    foreach ($arrayImage as $image){
                        echo '<div class="postitem"><img src="' . $image . '" alt="Project Post Image" width="600" height="400"></div>';
                    }
                }

                echo "</div>";
                echo "</div>";

                echo "<div class='postitem'>";
                echo "<h3 style='padding: 1em 0 0 2em'>", $row["title"], "</h3> <br>";
                echo  '<p>', $row["description"], "</p></div> <br><br>";
                echo "</div>";

                echo  "<h6>Tag: ", $row["name"], "<br>";
                echo   "Wrote by: ", $row["userName"], " </h6>";


            }
        } else {
            echo "0 results";
        }
        // Close result set
        $result->close();
        // Close connection
        $conn->close();

        ?>

</main>

<?php include 'inc/footer.php'; ?>