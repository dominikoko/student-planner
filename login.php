<?php
    require_once "header.php";
    isLogged();

	if (isset($_POST['login'])) {
		$email = trim(htmlspecialchars($_POST['email']));
		$password = trim(htmlspecialchars($_POST['password']));
		$hashPassword = md5(sha1($password));
		$sql = "Select * FROM user u WHERE u.email = '". $email ."' AND u.password = '". $hashPassword ."' ";

		$pdo->query("SET NAMES utf8");
		$result = $pdo->query($sql);

		$row = $result->fetch();
		if (!empty($row)) {
			$_SESSION['email'] = $row["email"];
			$_SESSION['userId'] = $row["id"];

			header("Location: index.php");

		} else {
			echo 'Niepoprawne dane <br>';
		}
	}
?>

	<h2>Zaloguj się</h2>
	<form action="" method="post">

		<label for="email">Email</label>
		<input type="email" name="email" placeholder="Email"><br>

		<label for="password">Hasło</label>
		<input type="password" name="password" placeholder="Hasło"><br>


		<input type="submit" name="login" value="Zaloguj się">
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