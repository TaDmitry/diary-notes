<?php
$dsn = 'mysql:host=localhost;dbname=userTasks';
$pdo = new PDO($dsn, 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$id = "";
$task = "";
$description = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	if (!isset($_GET["id"])) {
		header("Location: ./office.php");
		exit;
	}
	$id = $_GET["id"];

	$sql = "SELECT * FROM userTasks WHERE id = :id";
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(':id', $id, PDO::PARAM_INT);
	$stmt->execute();
	$row = $stmt->fetch(PDO::FETCH_ASSOC);

	if (!$row) {
		header("Location: ./office.php");
		exit;
	}

	$task = $row["task"];
	$description = $row["description"];
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$id = isset($_POST["id"]) ? $_POST["id"] : null;
	$task = isset($_POST["task"]) ? $_POST["task"] : null;
	$description = isset($_POST["description"]) ? $_POST["description"] : null;

	if (!empty($id) && isset($task)) {
		try {
			$sql = "UPDATE userTasks SET task = :task, description = :description WHERE id = :id";
			$stmt = $pdo->prepare($sql);
			$stmt->bindValue(':id', $id, PDO::PARAM_INT);
			$stmt->bindValue(':task', $task, PDO::PARAM_STR);
			$stmt->bindValue(':description', $description, PDO::PARAM_STR);

			if ($stmt->execute() && $stmt->rowCount() > 0) {
				header("Location: ./office.php");
				exit;
			} else {
				header("Location: ./office.php");
			}
		} catch (PDOException $e) {
			// Обработка ошибок базы данных
			echo "Ошибка выполнения запроса: " . $e->getMessage();
		}
	}
}
