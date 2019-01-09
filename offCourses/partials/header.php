
<?php
session_start();

// the types of the users
$instructorType = "instructors";
$academyType = "academies";


$pageTitle = "OffCourses";
if(isset($title))
    $pageTitle = $title;
$path = "";
if(isset($moreInPath))
    $path = $moreInPath;

$defaultUserImage = "avatar_user.png";

include 'partials/messages.php';
include 'partials/validator.php';
include 'models/instructors.php';
include 'models/courses.php';
include 'models/academies.php';

?>
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href=<?php echo '"' . $path . 'assets/css/normalize.css"' ; ?> >
        <link rel="stylesheet" href=<?php echo '"' . $path . 'assets/css/bootstrap.min.css"' ; ?> >
        <link rel="stylesheet" href=<?php echo '"' . $path . 'assets/css/font-awesome.min.css"'; ?> >
        <link rel="stylesheet" href=<?php echo '"' . $path . 'assets/css/NavStyle.css"'; ?> >
        <link rel="stylesheet" href=<?php echo '"' . $path . 'assets/css/FooterS.css"'; ?> >
        <link rel="stylesheet" href=<?php echo '"' . $path . 'assets/css/all-mine.css"'; ?> >
        <?php 
            if(isset($moreInHeader)) echo $moreInHeader;
        ?>
        
        <title><?= $pageTitle; ?></title>
    </head>
    <body>
        <?php
            if(isset($_SESSION['user']))
                include 'partials/Nav-After.php';
            else
                include 'partials/Nav-Before.php';

        ?>