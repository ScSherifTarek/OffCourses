<?php

if (!isset($_SESSION['user'])) {
    session_destroy();
    header("Location: login.php");
    exit();
}

// just set the user type only if you want a specific type of users
if(isset($userType) && $userType != $_SESSION['userType'])
{
    header("Location: index.php");
    exit();
}

