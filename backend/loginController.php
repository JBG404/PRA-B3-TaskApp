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
        header("Location: $base_url/login/index.php?error=Account+Not+Found");
        exit;
    }

    if (password_verify($pass, $user['password'])) {
        session_start();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['user'];
        header("Location: $base_url/index.php");
    } else {
        header("Location: $base_url/login/index.php?error=Incorrect+Password");
        exit;
    }
}
if ($action == 'create') { 
    $user = $_POST['user'];
    $pass = $_POST['pass'];
    $pass = password_hash($pass, PASSWORD_DEFAULT);

    
    $query = "INSERT INTO users (user, password) VALUES (:user, :pass)";

    $statement = $conn->prepare($query);

    $statement->execute([
        ':user' => $user,
        ':pass' => $pass
    ]);
    header("Location: $base_url/login/accountCreate.php?msg=Account+made");
}
?>