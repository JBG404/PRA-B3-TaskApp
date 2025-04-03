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
</body>