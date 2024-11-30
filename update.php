<?php
// Include the database connection file
require_once 'db.php';

// Define the column name to be updated
$col_name = "todo_tasks";

// Get the task and id from the POST request
$task = $_POST['input'];
$id = $_POST['id'];

// Prepare the SQL query to update the task
$query = "UPDATE " . $table_name . " SET " . $col_name . " = ? WHERE id = ?";
$stmt = $db->prepare($query);

// Execute the query with the provided task and id
$stmt->execute([$task, $id]);

// Redirect to the index page after updating
header("Location: index.php");

// it is a good practice to exit after a redirect to prevent further execution
exit();
?>