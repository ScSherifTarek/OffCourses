<?php

$title = "Academy Profile";

$moreInHeader = '<link rel="stylesheet" href="assets/css/creative.min.css">';
include 'partials/header.php';



?>
    <section class="p-0" id="portfolio">
      <div class="container-fluid p-0">
    <?php 
    $courses = Courses::getAllData();
        echo'<h2 style="text-align: center; font-size: 60px;padding-bottom:40px">Courses</h2>';
        foreach ($courses as $row) {
              ?>

              <div class="col-lg-4 col-sm-6">
                <?php 
                if(isset($_SESSION['userType']) && $_SESSION['userType'] == $academyType && isset($_SESSION['user']['id']) && $_SESSION['user']['id'] == $row['academy_id']){
                  echo'
            <a class="portfolio-box" href="javascript:deleteOrGo('.'\'courseDelete.php?course_id='.$row['id'].'\',\'courseProfile.php?course_id='.$row['id'].'\')">
              '; 
                }
              else
                {
                  echo' <a class="portfolio-box" href="javascript:goTo(\'courseProfile.php?course_id='.$row['id'].'\')">
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
    ?>
      </div>
    </section>
    
   
    <?php 
  include 'partials/footer.php'; 
?>