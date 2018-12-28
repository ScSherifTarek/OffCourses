<?php 

$title = "OffCourses";
$moreInPath = "";
$moreInHeader = '';
include 'partials/header.php'; 
include 'partials/validateLogin.php';
include 'partials/messages.php';


?>


<?php
	if(isset($_SESSION['user']))
		echo 'Logged in';
	
?>
<br>
<a href="logout.php">logout</a>
<!-- Some Content -->


<?php 

include $path.'partials/footer.php'; 
?>