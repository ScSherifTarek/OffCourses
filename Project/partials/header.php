
<?php
session_start();

$pageTitle = "OffCourses";
if(isset($title))
    $pageTitle = $title;

$path = "";
if(isset($moreInPath))
    $path = $moreInPath;

?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href=<?php echo '"' . $path . 'assets/css/normalize.css"' ; ?> >
        <link rel="stylesheet" href=<?php echo '"' . $path . 'assets/css/bootstrap.min.css"' ; ?> >
        <link rel="stylesheet" href=<?php echo '"' . $path . 'assets/css/font-awesome.min.css"'; ?> >
        <?php 
            if(isset($moreInHeader)) echo $moreInHeader;
        ?>
        <title><?= $pageTitle; ?></title>
    </head>
    <body>