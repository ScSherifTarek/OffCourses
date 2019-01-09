<?php
$title = "Course edit";
$moreInHeader = '<link rel="stylesheet" href="assets/css/CoursePS-he-edit.css">';
include 'partials/header.php';
  
$userType = $academyType;
include 'partials/validateLogin.php';

$academy_id = $_SESSION['user']['id'];

if(!isset($_GET['course_id']))
  header("Location: index.php");


$course_id = $_GET['course_id'];
if(! Courses::isThisCourseForThisAcademy($course_id, $academy_id))
  header("Location: index.php");


if (isset($_POST['save'])) {

    $image = null;
    if ($_FILES['image']['name'] != '')
        $image = $_FILES['image'];
    
    $result = Courses::update($course_id, $academy_id, $_POST['instructor_email'], $_POST['name'], $_POST['description'], $_POST['start_date'], $_POST['finish_date'], $_POST['price'], $image);
}


if (isset($result['status']) && $result['status'] == true) {
      header("Location: index.php");
} 


$course = Courses::getById($course_id);
$name = $course['name'];
$description = $course['description'];
$start_date = $course['start_date'];
$finish_date = $course['finish_date'];
$price = $course['price'];
$image = $course['image'];
$instructor_id = $course['instructor_id'];
$instructor_email = Instructors::getEmailForId($instructor_id);


?>

  <section>
    <div class="container profile">
        <div class="course-title">
            <div class="photo">
              <img src="images/courses/<?= ($image != null) ? $image : $defaultUserImage ?>" alt="">
            </div>
            <h1><?= ($name != null) ? $name : 'Course Name' ?></h1>
      
          </div>
        
      <form id="form" name="CoursesUpdateForm" onsubmit="return validateCourseUpdateForm()" action="" method="post" autocomplete="off" enctype="multipart/form-data" >
        <div id="err">
          <?php
          if (isset($result['status']) && $result['status'] == false) {
              echo messages::error($result['message'],0);
          }
          ?>
        </div>
          <div class="form-group">
            <input name="name" value="<?= ($name != null) ? $name : '' ?>" type="text" class="form-control" id="" placeholder="Name">
          </div>
       
          <div class="form-group">
              <input name="instructor_email" value="<?= ($instructor_email != null) ? $instructor_email : '' ?>" class="form-control" list="Emails" type="text" placeholder="Instructor email" >
              <datalist id="Emails">
                <?php 
                  $data = Instructors::getAllInstructrosForAcademyWithId($academy_id);
                  foreach ($data as $row) {
                  ?>

                  <option value="<?= $row['email'] ?>">
                    <?= $row['first_name'] .' '. $row['last_name'] ?>
                  </option>
                

                  <?php  }?>
                </datalist>
            </div>
         
          <div class="form-group">
              <input name="start_date" value="<?= ($start_date != null) ? $start_date : '' ?>" type="text" class="form-control" id="" placeholder="Start date" onfocus="(this.type='date')"
              focusout="(this.type='text')">
            </div>
            <div class="form-group">
                <input name="finish_date" value="<?= ($finish_date != null) ? $finish_date : '' ?>" type="text" class="form-control"  placeholder="End date" onfocus="(this.type='date')"
                focusout="(this.type='text')">
              </div>
            <div class="form-group">
                <input name="price" value="<?= ($price != null) ? $price : '' ?>" type="number" class="form-control"  placeholder="Price">
              </div>
          <div class="form-group">
              <div class="form-group">
                  <label for="exampleFormControlFile1">Choose Photo for course :</label>
                  <input name="image" type="file" class="form-control-file" id="exampleFormControlFile1">
                </div>
            <textarea name="description" rows="6" cols="71"><?= ($description != null) ? $description : 'Course\'s syllabus, description.' ?> </textarea>
          </div>

          <input name="save" type="submit" class="btn btn-primary">

        </form>
      
    </div>


  </section>



<?php 

include 'partials/footer.php'; 
?>