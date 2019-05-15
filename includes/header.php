<?php
    include("includes/config.php");
    include("includes/classes/Artist.php");
    include("includes/classes/Album.php");
    include("includes/classes/Song.php");

    if(isset($_SESSION['userLoggedIn'])) {
        $userLoggedIn = $_SESSION['userLoggedIn'];
        echo "<script>userLoggedIn = '$userLoggedIn';</script>";
    }
    else {
        header("Location: register.php");
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Musify App</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/style.css">
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/script.js"></script>
</head>
<body>

    <div class="mainContainer">

        <div class="topContainer">
            <?php include("includes/navBarContainer.php"); ?>

            <div class="mainViewContainer">
                <div class="mainContent">