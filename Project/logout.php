<?php

$titlePage = 'Logout';
include 'partials/header.php';


session_destroy();
header("Location: Login");
exit();
?>

<?php include 'partials/footer.php'; ?>

