<?php
$title = "Create course";
$moreInHeader = '<link rel="stylesheet" href="assets/css/CreatecourseS.css">';
include 'partials/header.php';

$userType = $academyType;
include 'partials/validateLogin.php';

$academy_id = $_SESSION['user']['id'];
if (isset($_POST['save'])) {

    $image = null;
    if ($_FILES['image']['name'] != '')
        $image = $_FILES['image'];
    $result = Courses::create($academy_id, $_POST['instructor_email'], $_POST['name'], $_POST['description'], $_POST['start_date'], $_POST['finish_date'], $_POST['price'], $image);
}


if (isset($result['status']) && $result['status'] == true) {
      header("Location: index.php");
} 

?>
  <section>
    
    <div class="container profile">
        <div class="course-title">
            <div class="photo">
              <img src="images/courses/avatar_user.png" alt="">
            </div>
            <h1>Course name</h1>
      
          </div>
        <form id="form" name="createCourseForm" onsubmit="return validateCreateCourseForm()"  action="" method="post" autocomplete="off" enctype="multipart/form-data" >
          <div id="err">
          <?php
          if (isset($result['status']) && $result['status'] == false) {
              echo messages::error($result['message'],0);
          }
          ?>
          </div>
          <div class="form-group">
            <input name="name" type="text" class="form-control" id="" placeholder="Name">
          </div>
          <div class="form-group">
              <input name="instructor_email" class="form-control" list="Emails" name="Email" type="text" placeholder="Instructor email" >
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
              <input name="start_date" type="text" class="form-control" placeholder="Start date" onfocus="(this.type='date')"
              focusout="(this.type='text')">
            </div>
            <div class="form-group">
                <input name="finish_date" type="text" class="form-control" placeholder="End date" onfocus="(this.type='date')"
                focusout="(this.type='text')">
              </div>
            <div class="form-group">
                <input name="price" type="number" class="form-control" placeholder="Price">
              </div>
          <div class="form-group">
              <div class="form-group">
                  <label for="exampleFormControlFile1">Choose Photo for course :</label>
                  <input name="image" type="file" class="form-control-file" id="exampleFormControlFile1">
                </div>
            <textarea name="description" rows="6" cols="70"> Course's syllabus, description.</textarea>
          </div>

          <input type="submit" name="save" class="btn btn-primary"  value="Create">

        </form>
      
    </div>


  </section>




<?php 

include 'partials/footer.php'; 
?>