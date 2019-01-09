<?php

$title = "Academy Profile";

$moreInHeader = '<link rel="stylesheet" href="assets/css/creative.min.css"><link rel="stylesheet" href="assets/css/AcademyPS-he.css">';
include 'partials/header.php';


// get the id of the course
if(!isset($_GET['academy_id']))
  header("Location: index.php");
$academy_id = $_GET['academy_id'];

// get the course data
$result = Academies::checkAndGetById($academy_id);
if($result['status'] == false)
  header("Location: index.php");

// academy data
$academy = $result['data'];
$address = $academy['address'];
$email  = $academy['email'];
$name = $academy['name'];
$phone_no = $academy['phone_no'];
$profile_image_url = $academy['profile_image_url'];


$isTheOwner = isset($_SESSION['userType']) && $_SESSION['userType'] == $academyType && isset($_SESSION['user']['id']) && $_SESSION['user']['id'] == $academy['id'] ;
?>

 
  <section class="section1">
    <!-- <h6> About the instructor <span class="arrow"></span> </h6> -->
    <div class="container flex-container profile">
              <!-- Start Edit buttons -->
       <?php
          if($isTheOwner)
          {
            echo'<div class="edit">
              <button onclick="goTo(\'academyEdit.php\')" type="button" class="btn btn-primary btn-lg">Edit</button>
              <button onclick="goTo(\'courseCreate.php\')" type="button" class="btn btn-primary btn-lg">Create course</button>
              <br>
              <br>
              <button onclick="goTo(\'instructorAdd.php\')" type="button" class="btn btn-primary btn-lg">Add instructors</button>
          </div>';
      
          }
      ?>
        <div class="course-title">
            <div class="photo">
              <img src="images/academies/<?= ($profile_image_url != null) ? $profile_image_url : $defaultUserImage ?>" alt="">
            </div>
            <h1><?= ($name != null ) ? $name : "Academy name" ?></h1>
      
          </div>
         
          <div class="obvin">
              <h5>Address: <span><?= ($address != null ) ? $address : "Academy address" ?></span></h5>
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
    $courses = Courses::getAllCoursesForAcademy($academy_id);
      if(!$courses['status'])
      {
      }
      else
      {
        echo'<h2 style="text-align: center; font-size: 60px;padding-bottom:40px">Courses</h2>';
        foreach ($courses['data'] as $row) {
              ?>

              <div class="col-lg-4 col-sm-6">
                <?php if($isTheOwner)
                {
                  echo'
            <a class="portfolio-box" href="javascript:deleteOrGo('.'\'courseDelete.php?course_id='.$row['id'].'\',\'courseProfile.php?course_id='.$row['id'].'\')">
              ';
                  }
                  else
                  {
                    echo '<a class="portfolio-box" href="javascript:goTo(\'courseProfile.php?course_id='.$row['id'].'\')">
              ';
                  } 
                  ?>
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
    $instructors = Instructors::getAllInstructrosForAcademyWithId($academy_id);
      if(!$instructors['status'])
      {
      }
      else
      {
        echo'<h2 style="text-align: center; font-size: 60px;padding-bottom:40px">Instructors</h2>';
        foreach ($instructors['data'] as $row) {
              ?>

              <div class="col-lg-4 col-sm-6">
                <?php if($isTheOwner) echo'
            <a class="portfolio-box" href="javascript:deleteOrGo('.'\'instructorRemove.php?instructor_id='.$row['id'].'\',\'instructorProfile.php?instructor_id='.$row['id'].'\')">
              ';
              else
                  {
                    echo '<a class="portfolio-box" href="javascript:goTo(\'instructorProfile.php?instructor_id='.$row['id'].'\')">';
                  } ?>
              <img width="100%" class="img-fluid" src="images/instructors/<?= ($row['profile_image_url'] != null) ? $row['profile_image_url'] : $defaultUserImage ?>" alt="">
              <div class="portfolio-box-caption">
                <div class="portfolio-box-caption-content">
                  
                  <div class="project-name">
                    <?= ($row['first_name'] != null && $row['last_name'] != null) ? $row['first_name'].' '.$row['last_name'] : 'instructor name' ?>
                  </div>
                  <div class="project-category text-faded">
                    <?=  ($row['previous_experience'] != null) ? $row['previous_experience'] : 'instructor preveious experience' ?>
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