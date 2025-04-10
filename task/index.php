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
try {
    $user_id = $_SESSION['user_id'];
    $query = "SELECT * FROM tasks WHERE id = :user_id";
    $statement = $conn->prepare($query);
    $statement->execute([':user_id' => $user_id]);
    $tasks = $statement->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error fetching tasks: " . $e->getMessage());
}
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
        <?php if (!empty($tasks)): ?>
            <table class="styled-table">
                <thead>
                    <tr>
                        <th>Task Name</th>
                        <th>Description</th>
                        <th>Worker</th>
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