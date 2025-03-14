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
     if (isset($_GET['msg'])) {
        echo '<div class="msg">'.$_GET['msg'].'</div>';
    }
    ?>

    <form action="../backend/loginController.php" method="POST">
        <h2>Create Account</h2>
        <input type="hidden" name="action" value="create">
        <label for="username">Username:</label>
        <input type="text" id="user" name="user" required>
        <label for="pass">Wachtwoord:</label>
        <input type="password" id="pass" name="pass" required>
        <input type="submit" value="Create Account">
    </form>

</body>
</html>