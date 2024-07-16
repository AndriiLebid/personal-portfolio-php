<?php
include 'inc/functions.php';
include 'inc/header.php';
include 'inc/nav.php';
?>

<main>
    <?php
    if (isset($_SESSION['username'])) {
        echo '<h4 class="text-center m-4">';
        echo "Welcome " . $_GET['error'];
        echo $_SESSION['username'];
        echo '</h4>';
    } else {
        echo '<h4 class="text-center text-danger m-4">';
        echo $_GET['error'];
        echo '</h4>';
    }

    if (!isset($_SESSION['username'])) {
        echo loginForm();
    }
    ?>
</main>

<?php

include 'inc/footer.php';
?>