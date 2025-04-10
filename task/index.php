<?php
session_start();
if(!isset($_SESSION['user_id'])){
    $msg="Je moet eerst inloggen!";
    header("Location:../login/login.php?error=$msg");
    exit;
} //login heebeejeebies i dont understand
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/login.css">
    <title>Taskapp / Tasks </title>
</head>
<body>
    <div class="wrapper">
        <?php require_once '../header.php'; ?>
    </div>

    <!-- Add Buttons -->
    <div class="button-container">
        <a href="create.php" class="btn">Create New Task</a>
    </div>
    <div class="banner">
            <div class="banner-img">
                <img src="../img/logo-big-fill-only.png" alt="placeholder" height="200" width="200">
                <a>Start your task!</a></li>
            </div>
        </div>
</body>
</html>