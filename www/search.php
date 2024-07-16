<?php include 'inc/header.php';
include 'inc/dbConnection.php';
?>

<?php include 'inc/nav.php'; ?>

<main>
    <div class="notice">

    <div class="search-box">
        <form method="post" action="">
            <label>
                <input class="search-txt" type="text" name="keywords" autocomplete="off" placeholder="Search" required on>
            </label>
            <label>
                <select name="filter_type">
                    <option value="title">Blog</option>
                    <option value="description">Project</option>
                </select>
                <select name="filter_field">
                    <option value="title">Title</option>
                    <option value="description">Description</option>
                </select>
            </label>
            <input type="submit" value="Search" class="search-btn">
        </form>
    </div>







        <?php
        $result = $conn->query("SELECT blog.id, blog.post, blog.title, blog.date, 
                                            user.userName, 
                                            technology.name, image.link 
                                            FROM blog INNER JOIN user ON blog.userId = user.id 
                                            INNER JOIN technology ON technology.id = blog.technology
                                            LEFT JOIN image ON image.id = blog.imageId
                                            ORDER BY blog.date DESC;");
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo  "<hr><br><br>";
                echo "<div class = 'postimage'>";
                if ($row["link"] !== null) {
                    echo '<div class="postitem"><img src="' . $row["link"] . '" alt="Blog Post Image" width="200"></div>';
                }
                $url = ($_SERVER['HTTPS'] ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . "/post.php?id=" . $row["id"];
                echo "<div class='postitem'>";
                echo "<h2 style='padding: 1em 0 0 2em'>", $row["title"], "</h2> <br>";
                echo  '<p style="width: 80%">', substr($row["post"], 0, 255),
                "... <a href='$url'>Read more</a></p></div><br><br>";

                echo "</div>";

                echo  "<h5>Tag: ", $row["name"], "<br>";
                echo   "Wrote by: ", $row["userName"], " </h5>";
                echo  "<h5>Date: ", $row["date"], "</h5><br>";
            }
        } else {
            echo "0 results";
        }

        $result->close();
        $conn->close();

        ?>
</main>


<?php include 'inc/footer.php'; ?>