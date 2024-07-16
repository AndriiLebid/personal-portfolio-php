<?php session_start();

function confirmLoggedIn()
{
    if (!isset($_SESSION['username'])) {
        redirectTo('login.php');
    }
}
?>