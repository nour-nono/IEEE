<?php
// Include the database connection file
require_once 'db.php';

// Get the ID from the URL parameters
$id = $_GET['id'];

// Prepare the SQL statement to delete the record with the specified ID
$stmt = $db->prepare("DELETE FROM ".$table_name." WHERE id = ".$id);

// Execute the SQL statement
$stmt->execute();

// Redirect to the index page after deletion
// header("Location: index.php");

// it is a good practice to exit after a redirect to prevent further execution
// exit();
?>