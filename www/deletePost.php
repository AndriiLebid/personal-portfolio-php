<?php
include 'inc/header.php';
include 'inc/nav.php';
include 'inc/dbConnection.php';

$id = 0;

if (!isset($_SESSION['username'])) {
    $disabled = "";
    header("Location: login.php?error=Login please.");
}
?>
<main>
    <div class="login-cont">
        <form action="processDeletePost.php" id="deletePost" method="POST" name="deletePost" class="login-form">
            <div class="input-group">
                <select name="post" id="post">
                    <option value="0">Select post</option>
                    <?php
                    if (!empty($_POST['post'])) {
                        $id = $_POST['post'];
                    }
                    $sql = "SELECT id, title FROM blog WHERE userId = ".$_SESSION['id'];
                    $result = $conn->query($sql);
                    while ($row = $result->fetch_assoc()) {
                        $selected = "";
                        if ($row['id'] == $id) {
                            $selected = "selected";
                        }
                        echo "<option value='" . $row['id'] . "'$selected>" . $row['title'] . " </option>";
                    }
                    $result->close();
                    ?>
                </select><br>

                <input type="hidden" name="deleteThisPost" value="<?php echo $id ?>">
                <button type="submit" class="alertButton">DELETE POST</button>
        </form>
    </div>
    </div>
</main>

<?php
include 'inc/footer.php';
?>