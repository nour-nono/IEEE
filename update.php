<?php
require_once 'db.php';
$col_name = "todo_tasks";
$task = $_POST['input'];
$id = $_POST['id'];
$query = "UPDATE " . $table_name . " SET " . $col_name . " = ? WHERE id = ?";
$stmt = $db->prepare($query);
$stmt->execute([$task,$id]);
header("Location: index.php");
exit();
?>