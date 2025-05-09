<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    $msg = "Je moet eerst inloggen!";
    header("Location:../login/login.php?error=$msg");
    exit;
}

// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include database connection
require_once '../backend/conn.php';

// Fetch tasks from the database

    // $user_id = $_SESSION['user_id'];
    // $query = "SELECT * FROM tasks ";
    // $statement = $conn->prepare($query);
    // $statement->execute([':user_id' => $user_id]);
    // $tasks = $statement->fetchAll(PDO::FETCH_ASSOC);

    $user_id = $_SESSION['user_id'];
    $user_name = $_SESSION['user_name'];
    $user_group_id = $_SESSION['department'];

    if(empty($_GET['status'])) {
        $query = "SELECT * FROM tasks WHERE department = :user_group_id OR creator = :user_name ORDER BY date ASC";
        $statement = $conn->prepare($query);
        $statement->execute([
            ':user_group_id' => $user_group_id,
            ":user_name" => $user_name
        ]);
    } else {
        $query = "SELECT * FROM tasks WHERE department = :user_group_id AND status = :status OR creator = :user_name AND status = :status ORDER BY date ASC";
        $statement = $conn->prepare($query);
        $statement->execute([
            ':user_group_id' => $user_group_id,
            ":status" => $_GET['status'],
            ":user_name" => $user_name
        ]);
    }

    $tasks = $statement->fetchAll(PDO::FETCH_ASSOC);

?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <title>Taskapp / Tasks</title>
</head>
<body>
    <div class="wrapper">
        <?php require_once '../header.php'; ?>
    </div>

    <!-- Add Buttons -->
    <div class="button-container">
        <a href="./create.php" class="btn">Create New Task</a>
    </div>

    <!-- Display Current Tasks -->
    <div class="task-list">
        <h2>Your Current Tasks</h2>
        <form action="" method="GET">
            <select name="status">
                <option value=""> - Kies de status om de filtern -</option>
                <option value="To Do">To Do</option>
                <option value="inprogress">In Progress</option>
                <option value="Done">Done</option>
            </select>
            <input type="submit" value="filter">
        </form>
        <?php if (!empty($tasks)): ?>
            <table class="styled-table">
                <thead>
                    <tr>
                        <th>Task Name</th>
                        <th>Description</th>
                        <th>Worker</th>
                        <th>department</th>
                        <th>Deadline</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tasks as $task): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($task['taskname']); ?></td>
                            <td><?php echo htmlspecialchars($task['description']); ?></td>
                            <td><?php echo htmlspecialchars($task['worker']); ?></td>
                            <td><?php echo $task['department'] ?></td>
                            <td><?php echo $task['Date']?></td>
                            <td><?php echo htmlspecialchars($task['status']); ?></td>
                            <td>
                                <a href="edit.php?id=<?php echo $task['id']; ?>" class="btn edit-btn">Edit</a>
                                <form action="../backend/taskcontroller.php" method="POST" style="display:inline;">
                                    <input type="hidden" name="action" value="delete">
                                    <input type="hidden" name="id" value="<?php echo $task['id']; ?>">
                                    <button type="submit" class="btn delete-btn">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="no-tasks">No tasks found. Create a new task to get started!</p>
        <?php endif; ?>
    </div>

    <div class="banner">
        <div class="banner-img">
            <img src="../img/logo-big-fill-only.png" alt="placeholder" height="200" width="200">
            <a>Good Luck!<br>You can do this!</br></a>
        </div>
    </div>
</body>
</html>