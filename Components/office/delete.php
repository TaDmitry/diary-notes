<?php

$dsn = 'mysql:host=localhost;dbname=userTasks';
$pdo = new PDO($dsn, 'root', '');

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
	$id = $_GET['id'];

	// Подготовленный запрос для удаления записи по id
	$sql = 'DELETE FROM userTasks WHERE id = :id';
	$query = $pdo->prepare($sql);
	$query->bindParam(':id', $id, PDO::PARAM_INT);

	if ($query->execute()) {
		header("Location: ./office.php");
	}
}
