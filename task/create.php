<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    $msg = "Je moet eerst inloggen!";
    header("Location:../login/login.php?error=$msg");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taskapp / Tasks / Create</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>

<body>
    <!-- headuh -->
    <?php require_once '../header.php'; ?>

    <?php
    require_once '../backend/conn.php';
    $query = "SELECT * FROM `users`";
    $statement = $conn->prepare($query);
    $statement->execute();

    $users = $statement->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <div class="container">
        <h1>Create Task</h1>
        <!-- FORMETH MAKETH -->
        <form action="../backend/Taskcontroller.php" method="POST">
            <input type="hidden" name="action" value="create">
            <!-- sets task name -->
            <div class="form-group">
                <label for="taskname">Task Name:</label>
                <input type="text" name="taskname" id="taskname">
            </div>
            <div class="form-group">
                <!-- sets description -->
                <label for="description">Description:</label>
                <textarea name="description" id="description" rows="10"></textarea>
            </div>
            <div class="form-group">
                <!-- sets creator -->
                <label for="creator">Creator:</label>
                <input type="text" name="creator" id="creator" value="<?php echo $_SESSION['user_name'] ?>" disabled>
            </div>
            <div class="form-group">
                <!-- sets worker -->
                <label for="worker">Current Worker  :</label>

                <select name="worker" id="worker">

                    <?php foreach ($users as $user): ?>
                        <option value="<?php echo $user['user']; ?>"><?php echo $user['user']; ?></option>
                    <?php endforeach; ?>

                </select>
            </div>
<div class="form-group">
    <label for="deadline">Deadline: </label>
    <input type="date" name="deadline" id="deadline" required>
</div>

            <div class="form-group">
                <!-- sets group -->
                <label for="department">Group:</label>
                <select name="department" id="department" required>
                <option value="Internal">Internal</option>
                    <option value="External">External</option>
                    <option value="IT">IT</option>
                </select>
            </div>
            <div class="form-group">
                <!-- sets status -->
                <label for="status">Status:</label>
                <select name="status" id="status" disabled>
                    <option value="To Do">To Do</option>
                    <option value="inprogress">In Progress</option>
                    <option value="Done">Done</option>
                </select>
            </div>
            <!-- actually adds the thingy -->
            <input type="submit" value="Add Task">
        </form>
    </div>
</body>

</html>