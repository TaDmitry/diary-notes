<?php

require_once('../../Components/аuthorizations/dbOffice.php');


$task = $_POST["task"];
$description = $_POST["description"];


$sql = 'INSERT INTO userTasks(task, description) VALUES(:task, :description)';
$query = $pdo->prepare($sql);

header("Location: ./office.php");
