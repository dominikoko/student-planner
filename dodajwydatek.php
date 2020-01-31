<?php
	require_once "functions.php";

	isNotLogged();

	$userId = $_SESSION["userId"];

	$sql = 'INSERT INTO baza(rodzaj, nazwa, kwota, data, kategoria, komentarz, userId) VALUES ("WYDATEK", "' . $_POST['nazwa'] . '", "' . $_POST['kwota'] . '", "' . $_POST['data'] . '", "' . $_POST['kategoria'] . '", "' . $_POST['komentarz'] . '" , "'. $userId . '")';

    $pdo-> query ('SET NAMES utf8');

    $number = $pdo->exec($sql);

    if ($number > 0) {
        echo 'Dodano: ' . $number . ' rekordow';
    } else {
        echo 'Wystąpił błąd podczas dodawania rekordów!';
    }

	header("Location: nowywydatek.php");
?>
