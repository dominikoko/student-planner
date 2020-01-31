<?php
require_once "header.php";

isLogged();


if (isset($_POST['register'])) {
	$name = trim(htmlspecialchars($_POST['name']));
	$surname = trim(htmlspecialchars($_POST['surname']));
	$email = trim(htmlspecialchars($_POST['email']));
	$plain_email = trim(htmlspecialchars($_POST['plain-email']));
	$password = trim(htmlspecialchars($_POST['password']));
	$plain_password = trim(htmlspecialchars($_POST['plain-password']));

	//prosta walidacja
	$errorMsg = "";
	if (strlen($name) < 3) {
		$errorMsg .= "BŁĄD! Imie za krotkie! <br>";
	}

	if (strlen($surname) < 3) {
		$errorMsg .= "BŁĄD! Nazwisko za krotkie! <br>";
	}

	if (strlen($email) <= 3) {
		$errorMsg .= "BŁĄD! Email za krotki! <br>";
	}

	if (strlen($plain_email) <= 3) {
		$errorMsg .= "BŁĄD! Email za krotki! <br>";
	}

	if (strlen($password) <= 5) {
		$errorMsg .= "BŁĄD! Hasło za krotkie! <br>";
	}

	if (strlen($plain_password) <= 5) {
		$errorMsg .= "BŁĄD! Haslo za krotkie! <br>";
	}

	if (strcmp($email, $plain_email)) {
		$errorMsg .= "BŁĄD! Email nie pasuje!<br>";
	}

	if (strcmp($password, $plain_password)) {
		$errorMsg .= "BŁĄD! Haslo nie pasuje!<br>";
	}

	$sql = 'SELECT * FROM user u WHERE u.email = "'. $email .'"';
	$result = $pdo->query($sql);

	if ($result->fetchColumn() > 0) {
		$errorMsg .= "Wybrana nazwa użytkownika jest zajęta<br>";

	}

	if (strlen($errorMsg) > 0) {
		echo $errorMsg;
	} else {
		$hashPassword  = md5(sha1($password));

		$sql = 'INSERT INTO user (name, surname, email, password) VALUES ("'. $name .'", "'. $surname .'", "'. $email .'", "'. $hashPassword .'")';

		$pdo->query ('SET NAMES utf8');
		$result = $pdo->exec($sql);

		if ($result > 0 ) {
			echo 'Pomyślnie zarejestrowano! <a href="login.php">Zaloguj się</a>';
		} else {
			echo 'Błąd podczas rejestracji';
		}
	}
}

?>

	<h2>Zarejestruj się</h2>
	<form action="" method="post" >
		<label for="name">Imie</label>
		<input type="text" name="name" placeholder="Imie" ><br>

		<label for="surname">Nazwisko</label>
		<input type="text" name="surname" placeholder="Nazwisko"><br>

		<label for="email">Email</label>
		<input type="email" name="email" placeholder="Email"><br>

		<label for="plain-email">Powtórz email</label>
		<input type="text" name="plain-email" placeholder="Powtórz email"><br>

		<label for="password">Hasło</label>
		<input type="password" name="password" placeholder="Hasło"><br>

		<label for="plain-password">Powtórz hasło</label>
		<input type="password" name="plain-password" placeholder="Powtórz hasło"><br>

		<input type="submit" name="register" value="Dodaj">
	</form>
	<br>
	<div>
	<img src="zdj.png" 
	style = "width: 780px;
	height: 370px;
	 position: relative;
	 right: 40px;
	 bottom: 40px;
	
	">
<?php
	include_once "footer.php";
?>