<?php
require_once 'db.php';
$task = $_POST['input'];
$stmt = $db->prepare("INSERT INTO " . $table_name . " (`todo_tasks`) VALUES ( ? )");
$stmt->execute([$task]);
header("Location: index.php");
exit();
?>
