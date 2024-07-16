<?php include 'inc/header.php'; 
include 'inc/dbConnection.php';
?>

<?php include 'inc/nav.php'; ?>

<main>
    <div class="notice">

        <?php

            $sql = "SELECT blog.post, blog.title, blog.date, user.userName, technology.name, image.link 
            FROM blog INNER JOIN user ON blog.userId = user.id 
            INNER JOIN technology ON technology.id = blog.technology 
            LEFT JOIN image ON image.id = blog.imageId WHERE blog.id = ?;";

            $stmt = $conn->prepare($sql);
            $stmt->bind_param('i', $_GET["id"]);
            $stmt->execute();

            $result = $stmt->get_result();


            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo  "<hr>";
                    echo "<div class = 'postimage'>";
                    if($row["link"] !== null){
                        echo '<div class="postitem"><img src="' . $row["link"] . '" alt="Blog Post Image"></div>';
                    }
                    echo "<div class='postitem'>";
                    echo "<div>";
                    echo "<h2>", $row["title"], "</h2>";
                    echo  '<p>', $row["post"], "</p></div>";
                    echo "</div>";
                    echo "</div>";

                    echo  "<h5>Tag: ", $row["name"], "<br>";
                    echo   "Wrote by: ", $row["userName"], " </h5>";
                    echo  "<h5>Date: ", $row["date"], "</h5><br>";
                 
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