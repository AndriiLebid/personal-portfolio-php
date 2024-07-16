<?php

//include 'inc/session.php';
include 'inc/dbFunctions.php';
include 'inc/functions.php';
include 'inc/header.php';
include 'inc/nav.php';
?>
<main>
        <?php

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['username']) && !empty($_POST['password'])) {
            if (login($conn, $_POST['password'], $_POST['username'])) {
                header("Location: login.php");
                exit;
            } else {
                header("Location: login.php?error=Invalid login credentials, try again?");
                exit;
            }
        } else {
            echo '<h4> User and Password required, try again?</h4>';
            echo loginForm();
        }
        ?>
</main>
<?php
include 'inc/footer.php';
?>