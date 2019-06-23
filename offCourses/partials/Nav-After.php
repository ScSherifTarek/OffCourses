  <section id="nav" class="nav-sec">
    <div class="container">
      <nav class="navbar navbar-transparent navbar-expand-lg ">
        <div>

          <a class="navbar-brand" href="index.php">OFFCOURSES</a>
        </div>

        <div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          
        </div>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto ">
            <li class="nav-item ">
              <a class="nav-link" href="allCourses.php">Explore <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item ">
              <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
            </li>
            

            <li class="nav-item">
              <a class="nav-link" href="logout.php">Log out</a>
            </li>

          </ul>

        </div>

        <div class="logged">
          <a href="">
          <div class="photolog line">
            <img src="images/<?= $_SESSION['userType'] ?>/<?= ($_SESSION['user']['profile_image_url'] != null) ? $_SESSION['user']['profile_image_url'] : $defaultUserImage ?>" alt="">
          </div>
          <div class="line">
            <?php
            if(isset($_SESSION['user']))
            {
              if(isset($_SESSION['user']['first_name']) && isset($_SESSION['user']['last_name']))
                echo'<h6>'.$_SESSION['user']['first_name'].' '.$_SESSION['user']['last_name'].'</h6>';
            }
            ?>
          </div>
        </a>
        </div>
      </nav>
    </div>


  </section>
