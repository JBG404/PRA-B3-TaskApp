<?php
if(!isset($_SESSION['user_id'])){
    $msg="Jemoeteerstinloggen!";
    header("Location:../login/login.php?msg=$msg");
    exit;
} //login heebeejeebies i dont understand
?>