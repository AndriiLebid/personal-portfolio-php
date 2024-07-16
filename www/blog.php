<?php include 'inc/header.php';
include 'inc/dbConnection.php';
?>

<?php include 'inc/nav.php'; ?>

<main>
    <div class="notice">



        <div class="search-box">
            <form method="post" action="">
                <label>
                    <input class="search-txt" type="text" name="keywords" autocomplete="off" placeholder="Search">
                </label>
                <select name="filter_skills">
                    <option value=0>--- SKILLS ---</option>
                    <?php
                    $keywords = trim($_POST['keywords']);
                    $skillsId = 0;
                    if (!empty($_POST['filter_skills'])) {
                        $skillsId = $_POST['filter_skills'];
                    }
                    $sql = "SELECT id, name FROM skillset";
                    $result = $conn->query($sql);
                    while ($row = $result->fetch_assoc()) {
                    ?>
                        <option value="<?php echo $row['id']; ?>"><?php echo $selected ?><?php echo $row['name']; ?>
                        </option>
                    <?php
                    }
                    $result->close();
                    ?>
                </select>
                <select name="filter_tech">
                    <option value=0>--- TECHNOLOGY ---</option>
                    <?php
                    $techId = 0;
                    if (!empty($_POST['filter_tech'])) {
                        $techId = $_POST['filter_tech'];
                    }
                    $sql = "SELECT id, name FROM technology";
                    $result = $conn->query($sql);
                    while ($row = $result->fetch_assoc()) {
                    ?>
                        <option value="<?php echo $row['id']; ?>"><?php echo $selected ?><?php echo $row['name']; ?>
                        </option>
                    <?php
                    }
                    $result->close();
                    ?>
                </select>
                <select name="filter_user">
                    <option value=0>--- AUTHOR ---</option>
                    <?php
                    $userId = 0;
                    if (!empty($_POST['filter_user'])) {
                        $userId = $_POST['filter_user'];
                    }
                    $sql = "SELECT id, userName FROM user";
                    $result = $conn->query($sql);
                    while ($row = $result->fetch_assoc()) {
                    ?>
                        <option value="<?php echo $row['id']; ?>"><?php echo $selected ?><?php echo $row['userName']; ?>
                        </option>
                    <?php
                    }
                    $result->close();
                    ?>
                </select>
                <input type="submit" value="FILTER" class="search-btn">
            </form>
        </div>


        <?php
        $sql = "SELECT blog.id, blog.post, blog.title, blog.date, 
                user.userName, 
                technology.name, image.link 
        FROM blog INNER JOIN user ON blog.userId = user.id 
        INNER JOIN technology ON technology.id = blog.technology
        LEFT JOIN image ON image.id = blog.imageId ";

        $params = [];
        $types = '';


        if (isset($keywords) && $keywords != "") {
            $sql .= "WHERE (blog.post LIKE ?";
            $params[] = "%".$keywords."%";
            $types .= 's'; 
        } else {
            $sql .= "WHERE (blog.post LIKE '%'";
        }

        if (isset($keywords) && $keywords != "") {
            $sql .= " OR blog.title LIKE ?)";
            $params[] = "%".$keywords."%";
            $types .= 's'; 
        } else {
            $sql .= " OR blog.title LIKE '%')";
        }


        if (isset($skillsId) && $skillsId != 0) {
            $sql .= "AND blog.skillsId = ? ";
            $params[] = $skillsId;
            $types .= 'i'; 
        }

        if (isset($techId) && $techId != 0) {
            $sql .= " AND blog.technology = ? ";
            $params[] = $techId;
            $types .= 'i'; 
        }

        if (isset($userId) && $userId != 0) {
            $sql .= "AND blog.userId = ?";
            $params[] = $userId;
            $types .= 'i'; 
        }

        $sql .= " ORDER BY blog.date DESC";
        $stmt = $conn->prepare($sql);

        if (!empty($params)) {
            $stmt->bind_param($types, ...$params);
        }

        $stmt->execute();

        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo  "<hr>";
                echo "<div class = 'postimage'>";
                if ($row["link"] !== null) {
                    echo '<div class="postitem"><img src="' . $row["link"] . '" alt="Blog Post Image" width=80%></div>';
                }
                $url = ($_SERVER['HTTPS'] ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . "/post.php?id=" . $row["id"];
                echo "<div class='postitem'>";
                echo "<div>";
                echo "<h2>", $row["title"], "</h2> <br>";
                echo  '<p>', substr($row["post"], 0, 255),
                "... <a href='$url'>Read more</a></p></div>";
                echo "</div>";
                echo "</div>";

                echo  "<h5>Tag: ", $row["name"], "<br>";
                echo   "Wrote by: ", $row["userName"], " </h5>";
                echo  "<h5>Date: ", $row["date"], "</h5><br>";
        
            }
        } else {
            echo "<center>No posts found</center>";
        }

        $result->close();
        $stmt->close();
        $conn->close();
        ?>

</main>


<?php include 'inc/footer.php'; ?>