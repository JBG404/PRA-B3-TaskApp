<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/login.css">
    <title>Login</title>
</head>
<?php require_once '../header.php'; ?>
<body>
    <?php
     if (isset($_GET['error'])) {
        echo '<div class="error">'.$_GET['error'].'</div>';
    }
    ?>
        <?php
     if (isset($_GET['msg'])) {
        echo '<div class="msg">'.$_GET['msg'].'</div>';
    }
    ?>
    <div class="container">

    <form action="../backend/loginController.php" method="POST">
        <div class="containerContent">
    <h2>Login</h2>
        <input type="hidden" name="action" value="login">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" id="user" name="user" required>
        </div>
        <div class="form-group">
            <label for="pass">Wachtwoord:</label>
            <input type="password" id="pass" name="pass" required>
        </div>
        <input type="submit" value="Login">
        </div>
    </form>
</div>
</body>
</html>