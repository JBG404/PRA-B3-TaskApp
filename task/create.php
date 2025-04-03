<head>
    <title>Taskapp / Tasks / Create</title>
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/login.css">
</head>
</head>
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    $msg = "Jemoeteerstinloggen!";
    header("Location:../login/login.php?msg=$msg");
    exit;
} //login heebeejeebies i dont understand
?>

<body>
    <!-- headuh -->
    <?php require_once '../header.php'; ?>

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
                <label for="description">description:</label>
                <textarea type="text" name="description" id="description" line=50 rows=10></textarea>
            </div>
            <div class="form-group">
                    <!-- sets creator -->
                <label for="creator">creator:</label>
                <input type="text" name="creator" id="creator">
            </div>
            <div class="form-group">
                <!-- sets worker -->
                <label for="worker">current worker(s):</label>
                <input type="text" name="worker" id="worker">
            </div>
            <div class="form-group">
                <!-- sets status (OMG FINALLY NOT A TEXT) -->
                <label for="status">status:</label>
                <select name="status" id="status">
                    <option value="todo">to do</option>
                    <option value="inprogress">in progress</option>
                    <option value="done">done</option>
                </select>
            </div>
            <!-- actually adds the thingy -->
            <input type="submit" value="Add Task">

        </form>
    </div>  

</body>

</html>