<?php

require_once "conn.php";
$action = $_POST['action'];
if ($action == 'login') {
    $user = $_POST['user'];
    $pass = $_POST['pass'];

    $query = "SELECT * FROM users WHERE user = :user";

    $statement = $conn->prepare($query);

    $statement->execute([
        ':user' => $user
    ]);

    $user = $statement->fetch();

    if ($statement->rowCount() < 1) {
        header("Location: $base_url/login/login.php?error=Account+Not+Found");
        exit;
    }

    if (password_verify($pass, $user['password'])) {
        session_start();
        $_SESSION['user_id'] = $user['id']; 
        $_SESSION['user_name'] = $user['user'];
        $_SESSION['groupid'] = $user['groupid'];
        header("Location: $base_url/index.php");
    } else {
        header("Location: $base_url/login/login.php?error=Incorrect+Password");
        exit;
    }
}
if ($action == 'create') { 
    $user = $_POST['user'];
    $pass = $_POST['pass'];
    $groupid = $_POST['groupid'];

    $queryCheck = 'SELECT * FROM users WHERE user = :user';

    $statementCheck = $conn->prepare($queryCheck);

    $statementCheck->execute([
        ':user' => $user
    ]);

    $userCheck = $statementCheck->fetch();

    if ($statementCheck->rowCount() > 0) {
        header("Location: $base_url/login/accountCreate.php?error=Account+already+exist");
        exit;
    }

    $pass = password_hash($pass, PASSWORD_DEFAULT);
    
    $query = "INSERT INTO users (user, password, groupid) VALUES (:user, :pass, :groupid)";

    $statement = $conn->prepare($query);

    $statement->execute([
        ':user' => $user,
        ':pass' => $pass,
        ':groupid' => $groupid
    ]);
    header("Location: $base_url/login/accountCreate.php?msg=Account+made");
}
?>