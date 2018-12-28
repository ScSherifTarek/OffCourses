<?php

$titlePage = 'Logout';
include 'partials/header.php';


session_destroy();
header("Location: login.php");
exit();
?>

<?php include 'partials/footer.php'; ?>

