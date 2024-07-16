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

        <form action="" id="selectPost" method="POST" name="selectPost" class="input-group">
            <select name="post" id="post" onchange="this.form.submit()">
                <option value="0">Select Post</option>
                <?php
                $postid = 0;
                if (!empty($_POST['post'])) {
                    $postid = $_POST['post'];
                }
                if (isset($_SESSION['id'])) {
                    $idUser = " WHERE userId = " . $_SESSION['id'];
                } else {
                    $idUser = "";
                }
                $sql = "SELECT id, title FROM blog " . $idUser;
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
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['post']) && !empty($_POST['post'])) {
            try {
                $sql = "Select * FROM blog Where id = " . $_POST['post'];
                $result = $conn->query($sql);

                $title;
                $post;
                $userId;
                $technologyId;
                $skillsId;
                $imageId;

                while ($row = $result->fetch_assoc()) {
                    $title = $row['title'];
                    $post = $row['post'];
                    $userId = $row['userId'];
                    $technologyId = $row['technology'];
                    $skillsId = $row['skillsId'];
                    $imageId = $row['imageId'];
                }
            } catch (Exception $ex) {
                echo "An error occured " . $ex->getMessage();
            }
        }
        ?>

        <!-- Sending via POST -->
        <form action="processUpdate.php" id="updatePostForm" method="POST" class="login-form">
            <fieldset <?php echo $disabled ?>>
                <input type="hidden" value="<?php echo $postid; ?>" name="postId" id="postId">
                <div class="input-group">
                    <label for="title">Title</label>
                    <input type="text" id="title" name="title" value="<?php echo !empty($title) ? $title : ''; ?>">
                </div>
                <div class="input-group">
                    <label for="post">Post</label>
                    <textarea style="resize: vertical;" id="post" name="post" rows="10"><?php echo !empty($post) ? $post : ''; ?></textarea>
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
                    <select name="image" id="image">
                        <option value="0">Select Image</option>
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
                            <option value="<?php echo $row['id']; ?>" <?php echo $selected ?>><?php echo $row['name']; ?></option>
                        <?php
                        }
                        $result->close();
                        ?>
                    </select>
                </div>






            </fieldset>
            <button type="submit">Update POST</button>
            <button type="reset">Clean Form</button>
        </form>
    </div>
</main>




<?php include 'inc/footer.php'; ?>