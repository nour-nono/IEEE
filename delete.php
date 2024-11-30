<?php
// require 'db.php';
// $id = $_GET['id'];
// $stmt = $db->prepare('DELETE FROM `todos` WHERE `id` = ?');
// $stmt->execute([$id]);
// header('Location: index.php');
// exit();









require_once 'db.php';
$id = $_GET['id'];
$stmt = $db->prepare("DELETE FROM ".$table_name." WHERE id = ".$id);
$stmt->execute();
header("Location: index.php");
exit();



























?>