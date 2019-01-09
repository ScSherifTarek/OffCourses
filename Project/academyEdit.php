<?php
$title = "Edit profile";
$moreInHeader = '<link rel="stylesheet" href="assets/css/AcademyPS-he-edit.css">';
include 'partials/header.php';

$userType = $academyType;
include 'partials/validateLogin.php';
 ?>

<?php 
$id = $_SESSION['user']['id'];

if (isset($_POST['save'])) {

    $image = null;
    if ($_FILES['profile_image_url']['name'] != '')
        $image = $_FILES['profile_image_url'];
    $result = Academies::updateProfile($id, $_POST['name'], $_POST['password'], $_POST['phone_no'], $_POST['address'],  $image);
}


?>
<?php

if (isset($result['status']) && $result['status'] == true) {
      $_SESSION['user'] = Academies::getById($id);
      header("Location: index.php");
} 

$name = $_SESSION['user']['name'];
$phone_no = $_SESSION['user']['phone_no'];
$address = $_SESSION['user']['address'];
$profile_image_url =  $_SESSION['user']['profile_image_url'];
?>          

  <section>
    <div class="container profile">
        <div class="course-title">
            <div class="photo">
              <img src="images/<?= $_SESSION['userType'] ?>/<?= ($profile_image_url != null) ? $profile_image_url : $defaultUserImage ?>" alt="">
            </div>
            <h1><?= ($name != null ) ? $name : "Academy name" ?></h1>
      
          </div>
         
        <form id="form" action="" method="post" autocomplete="off" enctype="multipart/form-data" >
          <?php
          if (isset($result['status']) && $result['status'] == false) {
              echo messages::error($result['message'],0);
          }
          ?>

          <div class="form-group">
              <input name="name" value="<?= ($name != null) ? $name : '' ?>" type="text" class="form-control"  placeholder="Name">
          </div>
          
          <div class="form-group">
              <input name="phone_no" value="<?= ($phone_no != null) ? $phone_no : '' ?>" type="text" class="form-control"  placeholder="Phone number">
            </div>
            <div class="form-group">
                <input name="address" value="<?= ($address != null) ? $address : '' ?>" type="text" class="form-control" placeholder="Address">
              </div>
        
          <div class="form-group">
              <input name="password" type="password" class="form-control" placeholder="Password">
            </div>
           
          <div class="form-group">
              <div class="form-group">
                  <label for="exampleFormControlFile1">Choose a Photo :</label>
                  <input name="profile_image_url" type="file" class="form-control-file" id="exampleFormControlFile1">
                </div>
            
          </div>

          <input name="save" type="submit" value="submit" class="btn btn-primary" >

        </form>
      
    </div>


  </section>



<?php 

include 'partials/footer.php'; 
?>