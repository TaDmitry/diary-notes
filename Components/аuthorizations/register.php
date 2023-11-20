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
	$email = $_POST['email'];
	$password = $_POST['password'];

	// Проверка на пустые поля
	if (empty($login) || empty($email) || empty($password)) {
		echo "<h1>Все поля (логин, email и пароль) должны быть заполнены.</h1>";
		echo '<div><a href="../../../../index.html">Попытаться снова.</a></div>';
	} elseif (strpos($login, ' ') !== false || strpos($email, ' ') !== false || strpos($password, ' ') !== false) {
		echo "<h1>Логин, email и пароль не должны содержать пробелы.</h1>";
		echo '<div><a href="../../../../index.html">Попытаться снова.</a></div>';
	} else {
		// Проверка на минимальную длину логина и пароля (3 символа)
		if (strlen($login) < 3 || strlen($password) < 3) {
			echo "<h1>Логин и пароль должны содержать как минимум 3 символа.</h1>";
			echo '<div><a href="../../../../index.html">Попытаться снова.</a></div>';
		} else {
			// Проверка, существует ли пользователь с таким именем
			$checkExistingUser = "SELECT * FROM users WHERE login = ?";
			$stmt = $conn->prepare($checkExistingUser);
			$stmt->bind_param("s", $login);
			$stmt->execute();
			$result = $stmt->get_result();

			if ($result->num_rows > 0) {
				// Пользователь с таким именем уже существует
				echo "<h1>Пользователь с таким логином уже существует.</h1>";
				echo '<div><a href="../../../../index.html">Попытаться снова.</a></div>';
			} else {
				// Проверка, существует ли пользователь с таким email
				$checkExistingEmail = "SELECT * FROM users WHERE email = ?";
				$stmt = $conn->prepare($checkExistingEmail);
				$stmt->bind_param("s", $email);
				$stmt->execute();
				$result = $stmt->get_result();

				if ($result->num_rows > 0) {
					// Пользователь с таким email уже существует
					echo "<h1>Пользователь с таким email уже существует.</h1>";
					echo '<div><a href="../../../../index.html">Попытаться снова.</a></div>';
				} else {
					// Создаем нового пользователя
					$sql = "INSERT INTO users (login, password, email) VALUES (?, ?, ?)";
					$stmt = $conn->prepare($sql);

					if ($stmt) {
						$stmt->bind_param("sss", $login, $password, $email);
						$result = $stmt->execute();

						if ($result) {
							header("Location: ../../../../index.html");
							if (mysqli_query($conn, $sql_create_table)) {
								echo "Table created successfully";
							} else {
								echo "Error creating table: " . mysqli_error($conn);
							}

							mysqli_close($conn);
						} else {
							echo "<h1>Ошибка при выполнении запроса: $stmt->error</h1>";
							echo '<div><a href="../../../../index.html">Попытатся снова</a></div>';
						}

						$stmt->close();
					} else {
						echo "<h1>Ошибка при подготовке запроса: $conn->error</h1>";
						echo '<div><a href="../../../../index.html">Попытаться снова.</a></div>';
					}
				}
			}
		}
	}

	$conn->close();
	?>
</body>

</html>