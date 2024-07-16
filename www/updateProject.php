<?php
include 'inc/header.php';
include 'inc/nav.php';
include 'inc/dbFunctions.php';
?>

<main>
    <div class="login-cont">
        <?php
        $disabled = 'disabled';
        if (!isset($_SESSION['username'])) {
            header("Location: login.php?error=Login please.");
        }else{
            $disabled = "";
        }
        ?>

        <form action="" id="selectProject" method="POST" name="selectProject" class="input-group">
            <select name="project" id="project" onchange="this.form.submit()">
                <option value="0">Select Project</option>
                <?php
                $postid = 0;
                if (!empty($_POST['project'])) {
                    $postid = $_POST['project'];
                }
                if (isset($_SESSION['id'])) {
                    $idUser = " WHERE userId = " . $_SESSION['id'];
                } else {
                    $idUser = "";
                }
                $sql = "SELECT id, title FROM project " . $idUser;
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                    $selected = "";
                    if ($row['id'] == $postid) {
                        $selected = "selected";
                    }
                    echo "<option value='" . $row['id'] . "'$selected>" . $row['title'] . " </option>";
                }
                $result->close();
                ?>
            </select><br>
        </form>


        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['project']) && !empty($_POST['project'])) {
            try {
                $sql = "Select * FROM project Where id = " . $_POST['project'];
                $result = $conn->query($sql);

                $title;
                $description;
                $userId;
                $technologyId;
                $skillsId;
                $imageId;

                while ($row = $result->fetch_assoc()) {
                    $title = $row['title'];
                    $description = $row['description'];
                    $userId = $row['userId'];
                    $technologyId = $row['technologies'];
                    $skillsId = $row['skills'];
                    $imageId = $row['imageId'];
                }
            } catch (Exception $ex) {
                echo "An error occured " . $ex->getMessage();
            }
        }
        ?>

        <!-- Sending via POST -->
        <form action="processPrUpdate.php" id="updateProjectForm" method="POST" class="login-form">
            <fieldset <?php echo $disabled ?>>
                <input type="hidden" value="<?php echo $postid; ?>" name="projectId" id="projectId">
                <div class="input-group">
                    <label for="title">Title</label>
                    <input type="text" id="title" name="title" value="<?php echo !empty($title) ? $title : ''; ?>">
                </div>
                <div class="input-group">
                    <label for="post">Project</label>
                    <textarea style="resize: vertical;" id="description" name="description" rows="10"><?php echo !empty($description) ? $description : ''; ?></textarea>
                </div>

                <div class="input-group">
                    <select name="userid" id="userid">
                        <!-- <option value="0">Select User</option> -->
                        <?php
                        $sql = "SELECT id, username FROM user WHERE id = ".$_SESSION['id'];
                        $result = $conn->query($sql);
                        $row = $result->fetch_assoc();
                        ?>

                            <option value="<?php echo $row['id']; ?>" <?php echo $selected ?>><?php echo $row['username']; ?></option>

                        <?php
                      //  }
                        $result->close();
                        ?>
                    </select>
                </div>

                <div class="input-group">
                    <select name="techid" id="techid">
                        <option value="0">Select Technology</option>
                        <?php
                        //$id = 0;
                        $id = $technologyId;
                        if (!empty($_POST['technology'])) {
                            $id = $_POST['technology'];
                        }

                        $sql = "SELECT id, name FROM technology";
                        $result = $conn->query($sql);
                        while ($row = $result->fetch_assoc()) {
                            $selected = "";
                            if ($row['id'] == $id) {
                                $selected = "selected";
                            }
                        ?>
                            <option value="<?php echo $row['id']; ?>" <?php echo $selected ?>><?php echo $row['name']; ?></option>
                        <?php
                        }
                        $result->close();
                        ?>
                    </select>
                </div>

                <div class="input-group">
                    <select name="skills" id="skills">
                        <option value="0">Select Skill</option>
                        <?php
                        $id = $skillsId;
                        if (!empty($_POST['skill'])) {
                            $id = $_POST['skill'];
                        }

                        $sql = "SELECT id, name FROM skillset";
                        $result = $conn->query($sql);
                        while ($row = $result->fetch_assoc()) {
                            $selected = "";
                            if ($row['id'] == $id) {
                                $selected = "selected";
                            }
                        ?>
                            <option value="<?php echo $row['id']; ?>" <?php echo $selected ?>><?php echo $row['name']; ?></option>
                        <?php
                        }
                        $result->close();
                        ?>
                    </select>
                </div>

                <div class="input-group">
                    <select id="image" name="image[]" multiple>
                        <?php
                   
                        $id = $imageId;
                        if (!empty($_POST['image'])) {
                            $id = $_POST['image'];
                        }

                        $sql = "SELECT id, name FROM image";
                        $result = $conn->query($sql);
                        while ($row = $result->fetch_assoc()) {
                            $selected = "";
    
                            if ($row['id'] == $id) {
                                $selected = "selected";
                            }
                        ?>
                            <option value="<?php echo "gallery/".$row['name']; ?>" <?php echo $selected ?>><?php echo $row['name']; ?></option>
                        <?php
                        }
                        $result->close();
                        ?>
                    </select>
                </div>

            </fieldset>
            <button type="submit">Update Project</button>
            <button type="reset">Clean Form</button>
        </form>
    </div>
</main>


<?php include 'inc/footer.php'; ?>