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

$query = "SELECT * FROM users";
$statement = $conn->prepare($query);
$statement->execute();
$users = $statement->fetchAll(PDO::FETCH_ASSOC);
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

            <label for="creator">Creator:</label>
            <input type="text" id="creator" name="creator" value="<?php echo htmlspecialchars($task['creator']); ?>" disabled>

            <label for="worker">Worker:</label>
            <select name="worker" id="worker">
                <option value="<?php echo $task['worker']; ?>"><?php echo $task['worker']; ?></option>
                <?php foreach($users as $user) :?>
                    <option value="<?php echo $user['user'] ?>"><?php echo $user['user'] ?></option>
                <?php endforeach; ?>
            </select>

            <div class="form-group">
    <label for="deadline">Deadline: </label>
    <input type="date" name="deadline" id="deadline" value="<?php echo $task['Date']?>" required>
</div>

            <label for="status">Status:</label>
            <select id="status" name="status" required>
                    <option value="To Do">To Do</optio>
                    <option value="inprogress">In Progress</option>
                    <option value="Done">Done</option>
            </select>

            <label for="department">department:</label>
            <select id="department" name="department" required>
                <option value="Internal" <?php echo $task['department'] === 'Internal' ? 'selected' : ''; ?>>Internal</option>
                <option value="External" <?php echo $task['department'] === 'External' ? 'selected' : ''; ?>>External</option>
                <option value="IT" <?php echo $task['department'] === 'IT' ? 'selected' : ''; ?>>IT</option>
            </select>
            <input type="submit" value="Save Changes">
        </form>

    
    </div>
</body>
</html>