<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <?php
     if (isset($_GET['error'])) {
        echo '<div class="error">'.$_GET['error'].'</div>';
    }
    ?>

    <form action="../backend/loginController.php" method="POST">
        <h2>Login</h2>
        <input type="hidden" name="action" value="login">
        <label for="username">Username:</label>
        <input type="text" id="user" name="user" required>
        <label for="pass">Wachtwoord:</label>
        <input type="password" id="pass" name="pass" required>
        <input type="submit" value="Login">
    </form>

</body>
</html>