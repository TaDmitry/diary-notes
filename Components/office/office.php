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

<body class="office">

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
				<form action="./add.php" method="post" class='form'>
					<input class='form-input' type="text" name="task" placeholder="Нужно сделать..." required>
					<textarea class='form-textarea' name="description" placeholder="Описание..."></textarea>
					<button class='form-button' type="submit">Добавить</button>
				</form>
			</section>

			<section class="section-list">
				<ul class="list-ul">
					<?php
					$dsn = 'mysql:host=localhost;dbname=userTasks';
					$pdo = new PDO($dsn, 'root', '');

					$query = $pdo->query('SELECT * FROM userTasks');
					while ($row = $query->fetch(PDO::FETCH_OBJ)) {
						echo '<li class="list-li">
										<div class="list-descriptions"><p>' . $row->task . '</p><p>' . $row->description . '</p></div>
										<div class="list-management" >
											<a class="form-button__edit" href="./edit.php?id=' . $row->id . '">Редактировать</a>
											<a class="form-button__remove" href="./delete.php?id=' . $row->id . '">Удалить</a>
										</div>
									</li>';
					}
					?>
				</ul>
			</section>
		</div>
	</main>
</body>

</html>