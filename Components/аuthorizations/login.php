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
	<link rel="stylesheet" href="../../../../Css/Register.css" />
	<title>Error</title>
</head>

<body class="error">
	<?php

	require_once('db.php');

	$login = $_POST['login'];
	$password = $_POST['password'];

	if (empty($login) || empty($password)) {
		echo "<h1>Заполните все поля.</h1>";
		echo '<div><a href="../../../../index.html">Попытаться снова.</a></div>';
	} else {
		// Используйте подготовленное выражение, чтобы предотвратить SQL-инъекции
		$sql = "SELECT * FROM users WHERE login = ? AND password = ?";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param("ss", $login, $password);
		$stmt->execute();
		$result = $stmt->get_result();
	}

	if ($result->num_rows > 0) {
		header("Location: ../../../../Components/office/office.php");
	} else {
		echo "<h1>Неправильный логин или пароль.</h1>";
		echo '<div><a href="../../../../index.html">Попытаться снова.</a></div>';
	}
	$conn->close();
	?>
</body>

</html>