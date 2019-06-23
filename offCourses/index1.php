<?php 

$title = "OffCourses";
$moreInPath = "";
$moreInHeader = '';
include 'partials/header.php'; 
include 'partials/validateLogin.php';


?>
<style >
	.col-sm-1
	{
		width: 8%;
	}
	.col-sm-11
	{
		width:92%;
	}
	.col-sm-3
	{
		width:25%;
	}
	.col
	{
		float: left;
	}
	.clearfix
	{
		clear: both;
	}
</style>


<div class="loggedIn">
	<div class="col col-sm-1">
		<img  alt="" style="padding-top: 20px"  width="100%"  class="img-responsive" src="images/<?= $_SESSION['userType'] ?>/<?= ($_SESSION['user']['profile_image_url'] != null) ? $_SESSION['user']['profile_image_url'] : $defaultUserImage ?>" />
	</div>
	<div class="col col-sm-11" style="padding-top: 20px">
		<div>
			<h5 >
				<?php 
				if($_SESSION['userType'] == $instructorType)
				{
					if(isset($_SESSION['user']['first_name']) && $_SESSION['user']['last_name'] )
						echo $_SESSION['user']['first_name'].' '.$_SESSION['user']['last_name'];
					echo '<br><a href="instructorEdit.php">edit profile</a>';
				}
				else
				{
					echo $_SESSION['user']['name'];
					echo '<br><a href="academyEdit.php">edit profile</a>';
					echo '<br> <a href="courseCreate.php" > add new course</a>';
					echo '<br> <a href="instructorAdd.php" > add new instructor</a>';
				}
				?>
			</h5>	

			<a href="logout.php">logout</a>
		</div>
	</div>
	<div class="clearfix"></div>
</div> 




<br>
<br>
<br>


<div class="users">
	<div class="container">
		<h1 style="text-align: center;">Instructors </h1>
		<br>
		<br>
<?php
	
	$data = Instructors::getAllData();
	foreach ($data as $row) {

		?>
		
		<div class="col col-sm-3">
			<img alt=""  style="min-height:255px;" width="100%" src="images/instructors/<?= ($row['profile_image_url'] != null) ? $row['profile_image_url'] : $defaultUserImage ?>" class="img-responsive" />
			<h3><?= $row['first_name'].' '.$row['last_name'] ?></h3>
			<h4><?= $row['email'] ?></h4>
			<h4><?= $row['phone_no'] ?></h4>
			<p><?=  $row['previous_experience'] ?></p>
		</div>
			
	<?php } ?>
	<div class="clearfix"></div>
	</div>
</div>		

<br>
<br>
<br>

<div class="users">
	<div class="container">
		<h1 style="text-align: center;">Academies </h1>
		<br>
		<br>
<?php

	$data = Academies::getAllData();
	foreach ($data as $row) {

		?>
		
		<div class="col col-sm-3">
			<img alt="" width="100%" src="images/academies/<?= ($row['profile_image_url'] != null) ? $row['profile_image_url'] : $defaultUserImage ?>" class="img-responsive" />
			<h3><?= $row['name'] ?></h3>
			<h4><?= $row['email'] ?></h4>
			<h4><?= $row['phone_no'] ?></h4>
			<p><?=  $row['address'] ?></p>
		</div>
			
	<?php } ?>
	<div class="clearfix"></div>
	</div>
</div>		


<br>
<br>

<div class="users">
	<div class="container">
		<h1 style="text-align: center;">Courses</h1>
		<br>
		<br>
<?php

	$data = courses::getAllData();
	foreach ($data as $row) {

		?>
		
		<div class="col col-sm-3">
			<img alt=""  style="min-height:255px;" width="100%" src="images/courses/<?= ($row['image'] != null) ? $row['image'] : $defaultUserImage ?>" class="img-responsive" />
			<h3><?= $row['name'] ?></h3>
			<h4><?= $row['description'] ?></h4>
			<h5><?= $row['price'] ?></h5>
			
		</div>
			
	<?php } ?>
	<div class="clearfix"></div>
	</div>
</div>		

<br>
<br>


<div class="users">
	<div class="container">
		<h1 style="text-align: center;" >Instructor for academy with id <?= $_SESSION['user']['id'] ?> </h1>
		<br>
		<br>
<?php

	$data = Instructors::getAllInstructrosForAcademyWithId($_SESSION['user']['id']);
	foreach ($data as $row) {

		?>
		
		<div class="col col-sm-3">
			<img alt=""  style="min-height:255px;" width="100%" src="images/instructors/<?= ($row['profile_image_url'] != null) ? $row['profile_image_url'] : $defaultUserImage ?>" class="img-responsive" />
			<h3><?= $row['first_name'].' '.$row['last_name'] ?></h3>
			<h4><?= $row['email'] ?></h4>
			<h4><?= $row['phone_no'] ?></h4>
			<p><?=  $row['previous_experience'] ?></p>
		</div>
			
	<?php } ?>
	</div>
</div>		



<br>
<br>
<br>

<!-- <div class="users">
	<div class="container">
		<h1 style="text-align: center;">Courses </h1>
		<br>
		<br>
<?php

	$data = courses::getAllData();
	foreach ($data as $row) {

		?>
		
		<div class="col-sm-3">
			<img alt="" width="100%" src="images/instructors/<?= ($row['profile_image_url'] != null) ? $row['profile_image_url'] : $defaultUserImage ?>" class="img-responsive" />
			<h3><?= $row['first_name'].' '.$row['last_name'] ?></h3>
			<h4><?= $row['email'] ?></h4>
			<h4><?= $row['phone_no'] ?></h4>
			<p><?=  $row['previous_experience'] ?></p>
		</div>
			
	<?php } ?>
	</div>
</div>		
 --><br>

<!-- Some Content -->
<?php 

include 'partials/footer.php'; 
?>