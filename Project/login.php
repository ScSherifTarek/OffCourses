<?php 
$title = "Login";
$moreInHeader = '<link rel="stylesheet" href="assets/css/signUp.css">';
include 'partials/header.php'; 
include 'partials/messages.php';
include 'models/instructors.php';
include 'models/academies.php';


$loginPath = $path."index.php";

if(isset($_SESSION['user']))
        header("Location: ".$loginPath);

if (isset($_POST['instructorSignIn'])) {
    $result = instructors::login($_POST['inMail'], $_POST['inPass']);
    if ($result['status'] == true) {
        $_SESSION['user'] = $result['data'];
        header("Location: ".$loginPath);
        exit();
        
    } else {
        $error = 'Wrong email or password.';
    }
}
if (isset($_POST['academySignIn'])) {
    $result = Academies::login($_POST['acMail'], $_POST['acPass']);
    if ($result['status'] == true) {
        $_SESSION['user'] = $result['data'];
        header("Location: ".$loginPath);
        exit();
        
    } else {
        $error = 'Wrong email or password.';
    }
}
if (isset($_POST['instructorSignUp'])) {
    $result = instructors::create($_POST['fname'], $_POST['lname'], $_POST['email'], $_POST['pass'], $_POST['cfPass'] );
    if ($result['status'] == true) {
        $_SESSION['user'] = $result['data'];
        header("Location: ".$loginPath);
        exit();
        
    } else {
        $error = 'Wrong email.';
    }
}
if (isset($_POST['academySignUp'])) {
    $result = Academies::create($_POST['name'], $_POST['email'], $_POST['pass'], $_POST['address'] );
    if ($result['status'] == true) {
        $_SESSION['user'] = $result['data'];
        header("Location: ".$loginPath);
        exit();
        
    } else {
        $error = 'Wrong email.';
    }
}


?>

    <div>
        <div class="login-container">
            <div class="login-page">
                
                <div class="mo">
                    <button id="sign-insttructor-btn" class="sign-or">Instructor</button>
                    <button id="sign-academy-btn" class="sign-or">Academy</button>
                    <div class="clearfix"></div>
                </div>

                <div class="forms-container">
                    <?php
                        if (isset($error)) {
                            echo messages::error($error);
                        }
                        ?>
                    <div id="sign-insttructor">
                        <div class="form">

                            <form name="instructorSignUpForm" action="" onsubmit="return validateSignUpInstructorForm()" class="register-form" method="post">
                                <h1>Sign Up</h1>
                                <div id="nam">
                                    <input type="text" name="fname" placeholder="First name" class="name">
                                    <input type="text" name="lname" placeholder="Last name" class="name">
                                    </div>
                                    <input type="text" name="email" placeholder="Email">
                                    <input type="password" name="pass" placeholder="Password">
                                    <input type="password" name="cfPass" placeholder="Confirm Password">
                                    <div class="agree">
                                </div>
                                <input type="submit" name="instructorSignUp" value="Sign Up" id="btncheck">
                                <p class="message">Already have an account? <a href="#">Sign In</a></p>
                            </form>
                            <form name="instructorSignInForm" action="" onsubmit="return validateSignInInsructorForm()"  class="login-form" method="post"> 
                                <h1>Sign In</h1>
                                  <input type="text" name="inMail" placeholder="Email">
                                <input type="password" name="inPass" placeholder="Password">
                                <input type="submit" name="instructorSignIn" value="Sign In">
                                <p class="message">Don't have an account? <a href="#">Sign Up</a></p>
                            </form>
                        </div>
                    </div>

                    <div id="sign-academy">
                        <div class="form">
                            <form name="academySignUpForm" action="" onsubmit="return validateSignUpAcademyForm()" class="register-form" method="post">
                                <h1>Sign Up</h1>

                                <input type="text" name="name" placeholder="Name" >
                                <input type="text" name="email" placeholder="Email">
                                <input type="text" name="address" placeholder="Address">
                                <input type="password" name="pass" placeholder="Password">
                                <input type="password" name="cfPass" placeholder="Confirm Password">
                                
                                <input type="submit" name="academySignUp" value="Sign Up">
                                <p class="message">Already have an account? <a href="#">Sign In</a></p>
                            </form>
                            <form name="academySignInForm" action="" onsubmit="return validateSignInAcademyForm()"  class="login-form" method="post">
                                <h1>Sign In</h1>
                                <input type="text" name="acMail" placeholder="Email-Academy">
                                <input type="password" name="acPass" placeholder="Password-Academy">
                                <input type="submit" name="academySignIn" value="Sign In">
                                <p class="message">Don't have an account? <a href="#">Sign Up</a></p>
                            </form>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>

        <div class="po">
            <img src="images/policy.png" alt="">
        </div>
        <div class="clearfix">
    </div>
<?php
$moreInFooter = '
<script type="text/javascript" src="assets/js/register.js"></script>
<script type="text/javascript" src="assets/js/form_validation.js"></script>
';
include 'partials/footer.php'; ?>