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

        <!-- Sending via POST -->
        <form action="processInsertPost.php" id="insertPostForm" method="POST" class="login-form" enctype="multipart/form-data">
            <fieldset <?php echo $disabled ?>>
            <div class="input-group">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" placeholder="Title" />
            </div>
            <div class="input-group">
                <label for="post">Post</label>
                <textarea style="resize: vertical;" id="post" name="post" rows="10"></textarea>
            </div>

            <div class="input-group">
                <select name="userid" id="userid">
                    <?php   
                    $sql = "SELECT id, username FROM user WHERE id = ".$_SESSION['id'];
                        $result = $conn->query($sql);
                        $row = $result->fetch_assoc();
                    ?>
                        <option value="<?php echo $row['id']; ?>"><?php echo $selected ?><?php echo $row['username']; ?></option>
                    <?php
                    $result->close();
                    ?>
                </select>
            </div>
            <div class="input-group">
                <select name="techid" id="techid">
                    <option value="0">Select Technology</option>
                    <?php
                    $id = 0;
                    if (!empty($_POST['tech'])) {
                        $id = $_POST['tech'];
                    }

                    $sql = "SELECT id, name FROM technology";
                    $result = $conn->query($sql);
                    while ($row = $result->fetch_assoc()) {
                        $selected = "";
                        if ($row['id'] == $id) {
                            $selected = "selected";
                        }
                    ?>
                        <option value="<?php echo $row['id']; ?>"><?php echo $selected ?><?php echo $row['name']; ?></option>
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
                    $id = 0;
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
                        <option value="<?php echo $row['id']; ?>"><?php echo $selected ?><?php echo $row['name']; ?></option>
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
                    $id = 0;
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
                        <option value="<?php echo $row['id']; ?>"><?php echo $selected ?><?php echo $row['name']; ?></option>
                    <?php
                    }
                    $result->close();
                    ?>
                </select>
            </div>

            </fieldset>
        
                <button type="submit">Submit POST</button>
                <button type="reset">Clean Form</button>
        
        </form>
    </div>
</main>


<?php include 'inc/footer.php'; ?>