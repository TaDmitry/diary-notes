<?php

$task = isset($_POST["task"]) ? $_POST["task"] : '';
$description = isset($_POST["description"]) ? $_POST["description"] : '';

if (empty($task)) {
	exit();
}

$dsn = 'mysql:host=localhost;dbname=userTasks';
$pdo = new PDO($dsn, 'root', '');

$sql = 'INSERT INTO userTasks(task, description) VALUES(:task, :description)';
$query = $pdo->prepare($sql);

$query->execute(['task' => $task, 'description' => $description]);

header("Location: ./office.php");
