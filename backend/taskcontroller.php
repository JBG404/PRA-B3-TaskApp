<?php
session_start();
if(!isset($_SESSION['user_id'])){
    $msg="Je moet eerst inloggen!";
    header("Location:login.php?msg=$msg");
    exit;
}

$action = $_POST['action'];

if ($action == 'create') {

    //Variabelen vullen
    $taskname = $_POST['taskname'];
    $description = $_POST['description'];
    $creator = $_SESSION['user_id']; // De ingelogde gebruiker is de creator
    $worker = $_POST['worker']; // Worker wordt geselecteerd in het formulier
    $status = $_POST['status'];
    $groupid =$_POST['groupid'];

    //1. Verbinding
    require_once 'conn.php';

    //2. Query
    $query = "INSERT INTO `tasks` (taskname, description, creator, worker, status, groupid) VALUES (:taskname , :description, :creator, :worker, :status, :groupid)";
    //3. Prepare
    $statement = $conn->prepare($query);
    //4. Execute
    $statement->execute([
        ":taskname" => $taskname,
        ":description" => $description,
        ":creator" => $creator,
        ":worker" => $worker,
        ":status" => $status,
        ":groupid" => $groupid,
    ]);
    header("location: ../task/index.php?msg=task opgeslagen");
}
if ($action == "update") {
    require_once 'conn.php';

    $id = $_POST['id'];
    $creator = $_SESSION['user_id']; // Use the logged-in user's ID as the creator
    $worker = $_POST['worker'];
    $status = $_POST['status'];
    $groupid = $_POST['groupid'];

    $query = "UPDATE `tasks` SET creator = :creator, worker = :worker, status = :status, groupid = :groupid WHERE id = :id";
    $statement = $conn->prepare($query);
    $statement->execute([
        ":id" => $id,
        ":creator" => $creator,
        ":worker" => $worker,
        ":status" => $status,
        ":groupid" => $groupid,
    ]);
    header("location: ../task/index.php?msg=task Geupdated");
}

if ($action == "delete") {
    require_once 'conn.php';
    $id = $_POST['id'];
    $query = "DELETE FROM `tasks` WHERE id = :id";
    $statement = $conn->prepare($query);
    $statement->execute([
        ":id" => $id,
    ]);
    header("location:../task/index.php?msg=task Verwijderd");
} 
else
{
    echo "Something is wrong";
}