<?php
// Include the database connection file
require_once 'db.php';

// Get the task from the POST request
$task = $_POST['input'];

// Prepare the SQL statement to insert the task into the database
$stmt = $db->prepare("INSERT INTO " . $table_name . " (`todo_tasks`) VALUES ( ? )");

// Execute the statement with the task as a parameter
$stmt->execute([$task]);

// Redirect to the index page after insertion
header("Location: index.php");

// it is a good practice to exit after a redirect to prevent further execution
exit();
?>
