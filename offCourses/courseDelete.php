<?php
include 'partials/header.php';
$userType = $academyType;
include 'partials/validateLogin.php';


$course_id = $_GET['course_id'];

// get the course data
if(!isset($_GET['course_id']))
  header("Location: index.php");

// check if the user is the owner
$course_id = $_GET['course_id'];
if(! Courses::isThisCourseForThisAcademy($course_id, $_SESSION['user']['id']))
  header("Location: index.php");

$result = Courses::delete($course_id);
if($result['status'] == true)
{
	header("Location: index.php");
}
else
{
	echo'<script>
		alert("error in deleting");
		document.location = "index.php";
	</script>';
}
?>
