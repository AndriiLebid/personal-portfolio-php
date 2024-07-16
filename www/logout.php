<?php

include "inc/session.php";
include "inc/functions.php";

$_SESSION = array();

if(isset($_COOKIE[session_name()])){
    setcookie(session_name(), "", time()-42000, "/");
}

redirectTo("login.php?logout=1");
?>