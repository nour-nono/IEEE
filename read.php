<?php
require_once 'db.php';
// Prepare and execute the SQL query to fetch all records from the table

$stmt = $db->prepare("SELECT * FROM ".$table_name);
$stmt->execute();
// Loop through each row in the result set

while ($row = $stmt->fetch()) {
    // Check if the current row's ID matches the ID from the GET request
    if (isset($_GET['id']) && $_GET['id'] == $row['id']) {
        // Display a form to update the current task
        echo <<<HEREDOC
            <form action="update.php" method="POST">
            <input name='input' value="{$row['todo_tasks']}"/>
            <input hidden name='id' value="{$row['id']}"/>
            <input type="submit" value="Save" />
            </form>
        HEREDOC;
    } else {
        // Display the task with options to update or delete
        echo <<<HEREDOC
        <li class=" w-3/4 flex items-center justify-between m-2 p-2">
        <div>
        {$row['todo_tasks']}
        </div>
        <div class=" flex items-center justify-center gap-2">
        <button class="shake">
        <a href="index.php?id={$row['id']}">Update</a>
        </button>
        <a href="delete.php?id={$row['id']}" class="trash">
        <svg viewBox="0 0 448 512" class="svgIcon"><path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"></path></svg>
        </a>
        </div>
        </li>
        HEREDOC;
    }
}
?>