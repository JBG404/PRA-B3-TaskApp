<?php
session_start();
if(!isset($_SESSION['user_id'])){
    $msg="Je moet eerst inloggen!";
    header("Location:../login/login.php?msg=$msg");
    exit;
} //login heebeejeebies i dont understand
?>