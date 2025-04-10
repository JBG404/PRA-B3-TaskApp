<head>
    <title>Taskapp / Tasks / Edit</title>
    <?php require_once '../head.php'; ?>
</head>
<?php
if(!isset($_SESSION['user_id'])){
    $msg="Jemoeteerstinloggen!";
    header("Location:login.php?msg=$msg");
    exit;
}
?>
<body>
    <?php 

    if(!isset($_GET['id'])){
        echo "Geef in je aanpaslink op de index.php het id van betreffende item mee achter de URL in je a-element om deze pagina werkend te krijgen na invoer van je vijfstappenplan";
        exit;

    }
    ?>
    <?php
        require_once '../header.php'; ?>

    <div class="container">
        <h1>task aanpassen</h1>

        <?php
        //Haal het id uit de URL:
        $id = $_GET['id'];

        //1. Haal de verbinding erbij
        require_once '../backend/conn.php';

        //2. Query
         $query = "SELECT * FROM tasks WHERE id = :id";        

        //3. Van query naar statement
        $statement = $conn->prepare($query);

        $statement->execute([
        ':id' => $id,
        ]);

        
        $task = $statement->fetch(PDO::FETCH_ASSOC);
        ?>

        <form action="../backend/taskController.php" method="POST">
            <input type="hidden" name="action" value="update">
            <input type="hidden" name="id" value="<?php echo $id;?>">


                <label>Taskname:</label>
                <?php echo $task['taskname']; ?>

           

                <label>Creator:</label>
                <?php echo $task['creator'];?>




                <!-- sets description -->
                <label for="description">description:</label>
                <textarea type="text" name="description" id="description" line=50 rows=10><?php echo $task['description']; ?></textarea>
            </div>

            <div class="form-group">
                <!-- sets worker -->
                <label for="worker">current worker(s):</label>
                <input type="text" name="worker" id="worker" value="<?php echo $task['worker']; ?>">
            </div>
            <div class="form-group">
                <!-- sets group (OMG FINALLY NOT A TEXT) -->
                <label for="groupid">group:</label>
                <select name="groupid" id="groupid">
                    <option value="A">Group A</option>
                    <option value="B">Group B</option>
                    <option value="C">Group C</option>
                </select>
            </div>
            <div class="form-group">
                <!-- sets status (THERE IS ANOTHER) -->
                <label for="status">status:</label>
                <select name="status" id="status">
                    <option value="todo">to do</option>
                    <option value="inprogress">in progress</option>
                    <option value="done">done</option>
                </select>
            </div>

            
            <input type="submit" value="save task">

        </form>
        <div class="container_delete">
    <form action="../backend/taskenController.php" method="POST">
            <input type="hidden" name="action" value="delete">
            <input type="hidden" name="id" value="<?php echo $id;?>">
            <input type="submit" value="task verwijderen" onclick="return confirm('Weet je zeker dat je de task wilt verwijderen?')">
        </form>
    </div>

    </div>  
   

</body>

</html>