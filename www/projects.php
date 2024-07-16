<?php include 'inc/header.php'; ?>
<?php include 'inc/nav.php'; ?>
<?php include 'inc/dbConnection.php'; ?>

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

        $sql = "SELECT project.id, project.title, project.description, 
                        user.userName, project.skills, 
                        technology.name, project.images 
        FROM project INNER JOIN user ON project.userId = user.id 
        INNER JOIN technology ON technology.id = project.technologies ";

        $params = [];
        $types = '';


        if (isset($keywords) && $keywords != "") {
            $sql .= "WHERE (project.description LIKE ?";
            $params[] = "%".$keywords."%";
            $types .= 's';
        } else {
            $sql .= "WHERE (project.description LIKE '%'";
        }

        if (isset($keywords) && $keywords != "") {
            $sql .= " OR project.title LIKE ?)";
            $params[] = "%".$keywords."%";
            $types .= 's';
        } else {
            $sql .= " OR project.title LIKE '%')";
        }


        if (isset($skillsId) && $skillsId != 0) {
            $sql .= "AND project.skills = ? ";
            $params[] = $skillsId;
            $types .= 'i'; 
        }

        if (isset($techId) && $techId != 0) {
            $sql .= " AND project.technologies = ? ";
            $params[] = $techId;
            $types .= 'i';
        }

        if (isset($userId) && $userId != 0) {
            $sql .= "AND project.userId = ?";
            $params[] = $userId;
            $types .= 'i';
        }

   
        $stmt = $conn->prepare($sql);


        if (!empty($params)) {
            $stmt->bind_param($types, ...$params);
        }

        $stmt->execute();


        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                
                echo "<hr>";
                echo "<div class = 'postimage'>";
                echo "<div class='postitem'>";
                if ($row["images"] !== null) {
                    $arrayImage = explode(", ", $row["images"]);

                    echo '<img src="' . $arrayImage[0] . '" alt="Project Post Image" width=80%>';
                }
                $url = ($_SERVER['HTTPS'] ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . "/projectItem.php?id=" . $row["id"];
                echo "</div>";


                echo "<div class='postitem'>";
                echo "<div>";
                echo "<h2>", $row["title"], "</h2>";
                echo '<p>', substr($row["description"], 0, 500), "... <a href='$url'>Read more</a>", "</p></div> <br><br>";
                echo "</div>";
                echo "</div>";

                echo "<h5>Tag: ", $row["name"], "<br>";
                echo "Wrote by: ", $row["userName"], " </h5>";
            
            }
        } else {
            echo "<center>There are no projects added at the moment</center>";
        }


        $result->close();
        $stmt->close();

        $conn->close();
        ?>


</main>

<?php include 'inc/footer.php'; ?>