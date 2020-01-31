<?php
	require_once "functions.php";

	isNotLogged();
	$userId = $_SESSION["userId"];

    if($_POST['kategoria'] == "inne"){
        $sql = 'INSERT INTO baza(rodzaj, nazwa, kwota, data, kategoria, komentarz, userId) VALUES ("DOCHOD", "' . $_POST['nazwa'] . '", "' . $_POST['kwota'] . '", "' . $_POST['data'] . '", "' . $_POST['kategoriaText'] . '", "' . $_POST['komentarz'] . '" , "'. $userId . '")';
    }else{
        $sql = 'INSERT INTO baza(rodzaj, nazwa, kwota, data, kategoria, komentarz, userId) VALUES ("DOCHOD", "' . $_POST['nazwa'] . '", "' . $_POST['kwota'] . '", "' . $_POST['data'] . '", "' . $_POST['kategoria'] . '", "' . $_POST['komentarz'] . '", "'. $userId . '")';
    }

    $pdo->query ('SET NAMES utf8');

    $number = $pdo->exec($sql);

    if ($number > 0) {
        echo 'Dodano: ' . $number . ' rekordow';
    } else {
        echo 'Wystąpił błąd podczas dodawania rekordów!';
    }



	header("Location: nowydochod.php");
?>
