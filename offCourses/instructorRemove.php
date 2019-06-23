<?php
include 'partials/header.php';
$userType = $academyType;
include 'partials/validateLogin.php';



// get the course data
if(!isset($_GET['instructor_id']))
  header("Location: index.php");

// check if the user is the owner
$instructor_id = $_GET['instructor_id'];
if(! Academies::isOneOfUs($_SESSION['user']['id'],$instructor_id ))
  header("Location: index.php");

$result = Academies::removeInstructor($_SESSION['user']['id'], $instructor_id );
if($result['status'] == true)
{

	header("Location: index.php");
}
else
{
	echo $result['message'];
	die();
	echo'<script>
		alert("error in deleting");
		document.location = "index.php";
	</script>';
}
?>
