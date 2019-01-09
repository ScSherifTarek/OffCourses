<?php

$title = "Instructor Profile";

$moreInHeader = '<link rel="stylesheet" href="assets/css/creative.min.css"><link rel="stylesheet" href="assets/css/InstructorPS-he.css">';
include 'partials/header.php';


// get the id of the course
if(!isset($_GET['instructor_id']))
  header("Location: index.php");
$instructor_id = $_GET['instructor_id'];

// get the course data
$result = Instructors::checkAndGetById($instructor_id);
if($result['status'] == false)
  header("Location: index.php");

// academy data
$instructor_ = $result['data'];
$first_name = $instructor_['first_name'];
$last_name = $instructor_['last_name'];
$email  = $instructor_['email'];
$phone_no = $instructor_['phone_no'];
$previous_experience = $instructor_['previous_experience']; 
$profile_image_url = $instructor_['profile_image_url'];


$isTheOwner = isset($_SESSION['userType']) && $_SESSION['userType'] == $instructorType && isset($_SESSION['user']['id']) && $_SESSION['user']['id'] == $instructor_['id'] ;
?>

   <section class="section1">
    <!-- <h6> About the instructor <span class="arrow"></span> </h6> -->
    <div class="container flex-container profile">
              <!-- Start Edit buttons -->
       <?php
         if($isTheOwner)
            echo'<div class="edit">
              <button onclick="goTo(\'instructorEdit.php\')" type="button" class="btn btn-primary btn-lg">Edit</button>
          </div>';
      
      ?>
        <div class="course-title">
            <div class="photo">
              <img src="images/instructors/<?= ($profile_image_url != null) ? $profile_image_url : $defaultUserImage ?>" alt="">
            </div>
            <h1><?= ($first_name != null &&  $last_name != null ) ? $first_name.' '.$last_name : "Instructor name" ?></h1>
      
          </div>
         
          <div class="obvin">
              <h5>Previous experience: <span><?= ($previous_experience != null ) ? $previous_experience : "Academy address" ?></span></h5>
              <br>
              <br>
              <br>
              <h5>Phone no: <span><?= ($phone_no != null) ? $phone_no : '011----' ?></span></h5>
           </div>
      
    </div>
    <br>
    <br>
    <br>

    <section class="p-0" id="portfolio">
      <div class="container-fluid p-0">
    <?php 
    $courses = Courses::getAllCoursesForInstructor($instructor_id);
      if(!$courses['status'])
      {
      }
      else
      {
        echo'<h2 style="text-align: center; font-size: 60px;padding-bottom:40px">Courses</h2>';
        foreach ($courses['data'] as $row) {
              ?>

              <div class="col-lg-4 col-sm-6">
                <?php if($isTheOwner) echo'
            <a class="portfolio-box" href="javascript:deleteOrGo('.'\'courseDelete.php?course_id='.$row['id'].'\',\'courseProfile.php?course_id='.$row['id'].'\')">
              ';
              else
                echo'
            <a class="portfolio-box" href="javascript:goTo(\'courseProfile.php?course_id='.$row['id'].'\')">
              ';?>
              <img width="100%" class="img-fluid" src="images/courses/<?= ($row['image'] != null) ? $row['image'] : $defaultUserImage ?>" alt="">
              <div class="portfolio-box-caption">
                <div class="portfolio-box-caption-content">
                  
                  <div class="project-name">
                    <?= ($row['name'] != null) ? $row['name'] : 'course name' ?>
                  </div>
                  <div class="project-category text-faded">
                    $<?=  ($row['price'] != null) ? $row['price'] : 'course name' ?>
                  </div>
                </div>
              </div>
            </a>
          </div>
        </div>
            
              
              

      <?php  }
      }
    ?>
      </div>
    </section>
    
       <br>
       <br>
       <br>
    <section class="p-0" id="portfolio">
      <div class="container-fluid p-0">
    <?php 
    $academies = Academies::getAllAcademiesForInstructorWithId($instructor_id);
      if(!$academies['status'])
      {
      }
      else
      {
        echo'<h2 style="text-align: center; font-size: 60px;padding-bottom:40px">Academies</h2>';
        foreach ($academies['data'] as $row) {
              ?>

              <div class="col-lg-4 col-sm-6">
                <?php echo'
            <a class="portfolio-box" href="javascript:goTo(\'academyProfile.php?academy_id='.$row['id'].'\')">
              ';?>
              <img width="100%" class="img-fluid" src="images/academies/<?= ($row['profile_image_url'] != null) ? $row['profile_image_url'] : $defaultUserImage ?>" alt="">
              <div class="portfolio-box-caption">
                <div class="portfolio-box-caption-content">
                  
                  <div class="project-name">
                    <?= ($row['name'] != null ) ? $row['name'].' '.$row['name'] : 'academy name' ?>
                  </div>
                  <div class="project-category text-faded">
                    <?=  ($row['phone_no'] != null) ? $row['phone_no'] : 'phone number' ?>
                  </div>
                </div>
              </div>
            </a>
          </div>
        </div>
            
              
              

      <?php  }
      }
    ?>
      </div>
    </section>

<?php 
  include 'partials/footer.php'; 
?>