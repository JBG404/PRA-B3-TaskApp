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
    $creator = $_SESSION['user_name'];
    $worker = $_POST['worker']; // Worker wordt geselecteerd in het formulier
    $date = $_POST['deadline'];
    $status = "To Do";
    $department = $_SESSION['department'];

    //1. Verbinding
    require_once 'conn.php';

    //2. Query
    $query = "INSERT INTO `tasks` (taskname, description, creator, worker, status, department, Date) VALUES (:taskname , :description, :creator, :worker, :status, :department, :date)";
    //3. Prepare
    $statement = $conn->prepare($query);
    //4. Execute
    $statement->execute([
        ":taskname" => $taskname,
        ":description" => $description,
        ":creator" => $creator,
        ":worker" => $worker,
        ":status" => $status,
        ":department" => $department,
        ":date" =>$date
    ]);
    header("location: ../task/index.php?msg=task opgeslagen");
}
if ($action == "update") {
    require_once 'conn.php';

    $id = $_POST['id'];
    $name = $_POST['taskname'];
    $description = $_POST['description'];
    $creator = $_SESSION['user_name'];
    $worker = $_POST['worker'];
    $date = $_POST['deadline'];
    $status = $_POST['status'];
    $department = $_POST['department'];

    $query = "UPDATE `tasks` SET taskname = :taskname,  description = :description, creator = :creator, worker = :worker, Date = :date, status = :status, department = :department WHERE id = :id";
    $statement = $conn->prepare($query);
    $statement->execute([
        ":id" => $id,
        ":taskname" => $name,
        ":description" => $description,
        ":creator" => $creator,
        ":worker" => $worker,
        ":date" => $date,
        ":status" => $status,
        ":department" => $department,
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