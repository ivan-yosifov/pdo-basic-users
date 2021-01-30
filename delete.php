<?php
session_start();
require_once('./includes/db.php');

if(!isset($_GET['id'])){
	header('Location: index.php');
	exit();
}

$id = $_GET['id'];

$sql = "DELETE FROM users WHERE id = :id LIMIT 1";

$stmt = $pdo->prepare($sql);

$stmt->execute([":id" => $id]);

$_SESSION['msg'] = array();
array_push($_SESSION['msg'], [
	'class' => 'success',
	'text' => 'User successfully deleted'
]);

header('Location: index.php');
exit();