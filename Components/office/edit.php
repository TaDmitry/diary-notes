<?php
$dsn = 'mysql:host=localhost;dbname=userTasks';
$pdo = new PDO($dsn, 'root', '');

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
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="apple-touch-icon" sizes="57x57" href="../../Source/Img/Favicon/apple-icon-57x57.png" />
	<link rel="apple-touch-icon" sizes="60x60" href="../../Source/Img/Favicon/apple-icon-60x60.png" />
	<link rel="apple-touch-icon" sizes="72x72" href="../../Source/Img/Favicon/apple-icon-72x72.png" />
	<link rel="apple-touch-icon" sizes="76x76" href="../../Source/Img/Favicon/apple-icon-76x76.png" />
	<link rel="apple-touch-icon" sizes="114x114" href="../../Source/Img/Favicon/apple-icon-114x114.png" />
	<link rel="apple-touch-icon" sizes="120x120" href="../../Source/Img/Favicon/apple-icon-120x120.png" />
	<link rel="apple-touch-icon" sizes="144x144" href="../../Source/Img/Favicon/apple-icon-144x144.png" />
	<link rel="apple-touch-icon" sizes="152x152" href="../../Source/Img/Favicon/apple-icon-152x152.png" />
	<link rel="apple-touch-icon" sizes="180x180" href="../../Source/Img/Favicon/apple-icon-180x180.png" />
	<link rel="icon" type="image/png" sizes="192x192" href="../../Source/Img/Favicon/android-icon-192x192.png" />
	<link rel="icon" type="image/png" sizes="32x32" href="../../Source/Img/Favicon/favicon-32x32.png" />
	<link rel="icon" type="image/png" sizes="96x96" href="../../Source/Img/Favicon/favicon-96x96.png" />
	<link rel="icon" type="image/png" sizes="16x16" href="../../Source/Img/Favicon/favicon-16x16.png" />
	<link rel="manifest" href="./Source/Img/Favicon/manifest.json" />
	<meta name="msapplication-TileColor" content="#ffffff" />
	<meta name="msapplication-TileImage" content="../../Source/Img/Favicon/ms-icon-144x144.png" />
	<meta name="theme-color" content="#ffffff" />
	<link rel="stylesheet" href="../../../../Css/Office.css" />
	<title>Личный кабинет</title>
</head>

<body class="edit">

	<head>
		<header>
			<nav class="container">
				<ul class="header-ul">
					<li class="header-li__logo">Лого</li>
					<li class="header-li__login"><a href="../../index.html">Выйти</a></li>
				</ul>
			</nav>
		</header>
	</head>

	<main>
		<h1>Список дел</h1>
		<div class="container-form">
			<section class="section-form">
				<form action="./editCode.php" method="post" class='form'>
					<input type="hidden" name="id" value="<?php echo $id; ?>">
					<input class='form-input' type="text" name="task" value="<?php echo $task; ?>" required>
					<textarea class='form-textarea' name="description"><?php echo $description; ?></textarea>
					<button class='form-button' type="submit">Сохранить</button>
				</form>
			</section>
		</div>
	</main>
</body>

</html>