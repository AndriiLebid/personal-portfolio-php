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
        <form action="processDeleteProject.php" id="deleteProject" method="POST" name="deleteProject" class="login-form">
            <div class="input-group">
                <select name="project" id="project">
                    <option value="0">Select Project</option>
                    <?php
                    if (!empty($_POST['project'])) {
                        $id = $_POST['project'];
                    }
                    $sql = "SELECT id, title FROM project WHERE userId = ".$_SESSION['id'];
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

                <input type="hidden" name="deleteThisProject" value="<?php echo $id ?>">
                <button type="submit" class="alertButton">DELETE PROJECT</button>
        </form>
    </div>

</main>

<?php
include 'inc/footer.php';
?>