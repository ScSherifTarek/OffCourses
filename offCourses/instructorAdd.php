<?php
$title = "Add Instructor";
$moreInHeader = '<link rel="stylesheet" href="assets/css/Add Instructors.css">';
include 'partials/header.php';
  
$userType = $academyType;
include 'partials/validateLogin.php';

$academy_id = $_SESSION['user']['id'];

if (isset($_POST['save'])) {
    $emails = $_POST['emails'];
    foreach( $emails as $instructor_email ) {
      $result = academies::addInstructor($academy_id, $instructor_email);
      if (isset($result['status']) && $result['status'] == false) {
        break;
      }
    }
/*
    $result = Courses::create($academy_id, $_POST['instructor_email'], $_POST['name'], $_POST['description'], $_POST['start_date'], $_POST['finish_date'], $_POST['price'], $image);
*/
}


if (isset($result['status']) && $result['status'] == true) {
      header("Location: index.php");
} 

?>




  <section>
    <div class="container">
      <div class="row">
        <div class="control-group" id="fields">
          <h3 class="control-label" for="field1">Add Instructors</h3>
          <div class="controls">
            <form action="" method="post" name="instructorAddForm" onsubmit="return instructorAddFormValidation()" role="form" id="addInstructor" autocomplete="off">
                <div  id="er">
                <?php
                if (isset($result['status']) && $result['status'] == false) {
                    echo messages::error($result['message'],0).'<br>';
                }
                ?>
              </div>
              
                <input name="emails[]" class="form-control" list="Emails" type="text" placeholder="Instructor email" >

                <span class="input-group-btn">
                  &nbsp;
                  <button class="btn btn-success btn-add" type="button">
                     <span class="glyphicon glyphicon-plus">add</span>
                  </button>
                </span>
                <datalist id="Emails">
                  <?php 
                  $data = Instructors::getAllData();
                  foreach ($data as $row) {
                  ?>

                  <option value="<?= $row['email'] ?>">
                    <?= $row['first_name'] .' '. $row['last_name'] ?>
                  </option>
                

                  <?php  }?>
                </datalist>
              </div>
              <div class="clearfix"></div>

            </form>
            <br>
            <input  form="addInstructor" name="save" type="submit" style="" class="btn btn-primary">
          </div>
        </div>
      </div>
      
    </div>

  </section>




<?php 
$moreInFooter = '<script src="assets/js/Addins.js"></script>';
include 'partials/footer.php'; 
?>