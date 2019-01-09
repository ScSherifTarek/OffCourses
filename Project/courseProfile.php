<?php

$title = "Course Profile";

$moreInHeader = '<link rel="stylesheet" href="assets/css/CoursePS-he.css">';
include 'partials/header.php';

// get the id of the course
if(!isset($_GET['course_id']))
  header("Location: index.php");
$course_id = $_GET['course_id'];


// get the course data
$result = Courses::checkAndGetById($course_id);
if($result['status'] == false)
  header("Location: index.php");

// course data
$course = $result['data'];
$name = $course['name'];
$description = $course['description'];
$price = $course['price'];
$image = $course['image'];


// duration
$start_date = date_create($course['start_date']);
$finish_date = date_create($course['finish_date']);
$diff=date_diff($start_date,$finish_date);
$duration = $diff->format("%R%a days");

// instructor data
$instructor = Instructors::getById($course['instructor_id']);
$instructor_id = $course['instructor_id'];
$instructor_first_name = $instructor['first_name'];
$instructor_last_name =  $instructor['last_name'];
$instructor_phone_no = $instructor['phone_no'];
$instructor_previous_experience = $instructor['previous_experience'];
$instructor_profile_image_url =  $instructor['profile_image_url'];

// academy data
$academy_id = $course['academy_id'];
$academy_name = Academies::getNameById($academy_id);


$isTheOwner = isset($_SESSION['userType']) && $_SESSION['userType'] == $academyType && isset($_SESSION['user']['id']) && $_SESSION['user']['id'] == $course['academy_id'] ;
?>

  <section class="section1">
    <div class="container flex-container profile">
      <?php
          if($isTheOwner)
          {
            echo'<div class="edit btn-group">
              <button onclick="goTo('.'\'courseEdit.php?course_id='.$course_id.'\')" type="button" class="btn btn-primary btn-lg">Edit</button>
              <button onclick="confirmDelete('.'\'courseDelete.php?course_id='.$course_id.'\')" type="button" class="btn btn-danger btn-lg">Delete</button>
          </div>';
      
          }
      ?>
              <!-- Start Edit buttons -->
        
                    <!-- End Edit buttons -->
      <div class="course-title">
        <div class="photo">
          <img src="images/courses/<?= ($image != null) ? $image : $defaultUserImage ?>" alt="">
        </div>
        <h1><?= ($name != null) ? $name : 'Course Name' ?></h1>

      </div>

      <div class="obvin">
        <a href="academyProfile.php?academy_id=<?= $academy_id ?>"> <div class="info" id="Academy"><?= ($academy_name != null) ? $academy_name : 'Academy' ?></div></a>
        <div class="info" id="Date"><?= ($start_date != null) ? $course['start_date'] : 'Date' ?></div>
        <div class="info" id="Duration"><?= ($duration != null) ? $duration : 'Duration' ?></div>
        <div class="info" id="Price">$<?= ($price != null) ? $price : 'Price' ?></div>
      </div> 
      
      <div class="desc">
          <h3>About the course</h3>
          <p>
            <?= ($description != null) ? $description : 'Description' ?>
            </p>
      </div>
      
      <div class="show">
          <h3>About the instructor</h3>
        <a href="instructorProfile.php?instructor_id=<?= $instructor_id ?>">
          <div class="instructor-panel">
            <div class="Iimg">
              <img src="images/instructors/<?= ($instructor_profile_image_url != null) ? $instructor_profile_image_url : $defaultUserImage ?>" alt="">
            </div>
            <h5><?= ($instructor_first_name != null && $instructor_last_name) ? $instructor_first_name.' '.$instructor_last_name : 'Instructor Name' ?></h5>
          </div>
        </a>
        <div class="knew">        <p><?= ($instructor_previous_experience != null) ? $instructor_previous_experience : 'Description' ?> </p>
        </div>

      </div>
      </div>
  </section>
<?php 
  include 'partials/footer.php'; 
?>





















