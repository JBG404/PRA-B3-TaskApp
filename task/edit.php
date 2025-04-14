<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    $msg = "Je moet eerst inloggen!";
    header("Location: ../login/login.php?msg=$msg");
    exit;
}

if (!isset($_GET['id'])) {
    echo "Geen taak-ID opgegeven. Ga terug naar de takenlijst.";
    exit;
}

require_once '../backend/conn.php';

// Haal het ID uit de URL
$id = $_GET['id'];

// Haal de taakgegevens op uit de database
try {
    $query = "SELECT * FROM tasks WHERE id = :id";
    $statement = $conn->prepare($query);
    $statement->execute([':id' => $id]);
    $task = $statement->fetch(PDO::FETCH_ASSOC);

    if (!$task) {
        echo "Taak niet gevonden.";
        exit;
    }
} catch (PDOException $e) {
    die("Fout bij het ophalen van de taak: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <title>Taskapp / Edit Task</title>
</head>
<body>
    <?php require_once '../header.php'; ?>

    <div class="container">
        <h1>Edit Task</h1>
        <form action="../backend/taskcontroller.php" method="POST">
            <input type="hidden" name="action" value="update">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($task['id']); ?>">

            <label for="taskname">Task Name:</label>
            <input type="text" id="taskname" name="taskname" value="<?php echo htmlspecialchars($task['taskname']); ?>" required>

            <label for="description">Description:</label>
            <textarea id="description" name="description" rows="5"><?php echo htmlspecialchars($task['description']); ?></textarea>

            <label for="worker">Worker:</label>
            <input type="text" id="worker" name="worker" value="<?php echo htmlspecialchars($task['worker']); ?>" required>

            <label for="creator">Creator:</label>
            <input type="text" id="creator" name="creator" value="<?php echo htmlspecialchars($task['creator']); ?>" required>

            <label for="status">Status:</label>
            <select id="status" name="status" required>
                <option value="Pending" <?php echo $task['status'] === 'Pending' ? 'selected' : ''; ?>>Pending</option>
                <option value="In Progress" <?php echo $task['status'] === 'In Progress' ? 'selected' : ''; ?>>In Progress</option>
                <option value="Completed" <?php echo $task['status'] === 'Completed' ? 'selected' : ''; ?>>Completed</option>
            </select>

            <label for="groupid">Group ID:</label>
            <select id="groupid" name="groupid" required>
                <option value="A" <?php echo $task['groupid'] === 'A' ? 'selected' : ''; ?>>A</option>
                <option value="B" <?php echo $task['groupid'] === 'B' ? 'selected' : ''; ?>>B</option>
                <option value="C" <?php echo $task['groupid'] === 'C' ? 'selected' : ''; ?>>C</option>
            </select>
            <input type="submit" value="Save Changes">
        </form>

    
    </div>
</body>
</html>