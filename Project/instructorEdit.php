<?php
$title = "Edit Profile";
$moreInHeader = '<link rel="stylesheet" href="assets/css/InstructorPS-he-edit.css">';
include 'partials/header.php';

$userType = $instructorType;
include 'partials/validateLogin.php';

?>

<?php 
$id = $_SESSION['user']['id'];

if (isset($_POST['save'])) {

    $image = null;
    if ($_FILES['image']['name'] != '')
        $image = $_FILES['image'];
    $result = Instructors::updateProfile($id, $_POST['first_name'], $_POST['last_name'], $_POST['password'], $_POST['previous_experience'], $_POST['phone_no'],  $image);
}


?>
<?php

if (isset($result['status']) && $result['status'] == true) {
      $_SESSION['user'] = Instructors::getById($id);
      header("Location: index.php");
} 

$first_name = $_SESSION['user']['first_name'];
$last_name =  $_SESSION['user']['last_name'];
$phone_no = $_SESSION['user']['phone_no'];
$previous_experience = $_SESSION['user']['previous_experience'];
$profile_image_url =  $_SESSION['user']['profile_image_url'];

?>          

  <section>
    <div class="container profile">
        <div class="course-title">
            <div class="photo">
              <img src="images/<?= $_SESSION['userType'] ?>/<?= ($profile_image_url != null) ? $profile_image_url : $defaultUserImage ?>" alt="">
            </div>
            <h1><?= ($first_name != null && $last_name != null) ? $first_name.' '.$last_name : "Instructor name" ?></h1>
      
          </div>
        
        <form id="form" action="" method="post" autocomplete="off" enctype="multipart/form-data">
        <?php
          if (isset($result['status']) && $result['status'] == false) {
              echo messages::error($result['message'],0);
          }
          ?>
            <div class="row">
                <div class="col">
                  <input name="first_name" value="<?= ($first_name != null) ? $first_name : '' ?>" type="text" class="form-control" placeholder="First name">
                </div>
                <div class="col">
                  <input name="last_name" value="<?= ($last_name != null) ? $last_name : '' ?>" type="text" class="form-control" placeholder="Last name">
                </div>
              </div>
          <div class="form-group">
              <input name="phone_no" value="<?= ($phone_no != null) ? $phone_no : '' ?>" type="text" class="form-control"  placeholder="Phone number" autocomplete="off">
            </div>
          <div class="form-group">
              <input name="password" type="password" class="form-control" placeholder="Password">
            </div>
           
          <div class="form-group">
              <div class="form-group">
                  <label for="fileInput">Choose a Photo :</label>
                  <input name="image" type="file" class="form-control-file" id="fileInput">
                </div>
            <textarea name="previous_experience" placeholder="Previous experiences" rows="6" cols="70"><?= ($previous_experience != null) ? $previous_experience : '' ?> </textarea>
          </div>

          <input name="save" type="submit" value="submit" class="btn btn-primary" >

        </form>
      
    </div>


  </section>


<?php 
include 'partials/footer.php'; 
?>