<style> 
input[type!=submit]{
    width: 170px;
	height: 17px;
    padding: 12px 20px;
    margin: 8px 0;
    box-sizing: border-box;
    border: 1px solid #555;
    outline: none;
	border-radius: 2px;
	border-color: white;
	transition: all 1s linear;
}

input[type]:focus {
    background-color: #bc90ff;
	border:1px solid #00008B;
	border-radius: 6px;
	transition: all .5s linear;
	
	
}
</style>
<?php
    require_once "functions.php";
?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8"/>

	<title>Planer studencki</title>
	<meta name="description" content="Zaplanuj swój dzień, swoje życie i miej wszystko pod kontrolą!" />
	<meta name="keywords" content="organizacja, planer, studia, studencki, planowanie"/>
	<meta http-equiv="X-UA-Compatibile" content ="IE=edge.chrome=1" />

	<!-- ZALACZENIE ARKUSZA STYLOW -->
	<link rel="stylesheet" href="css/kalendarz.css" type="text/css">
	<link rel="stylesheet" href="style.css" type="text/css" />
	<link rel="stylesheet" href="css/fontello.css" type="text/css" />
	<link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

	<script type="text/javascript">
        function przycisk_alert(){
            alert("Dodano!");
        }
	</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
	

</head>
<body>

<div class="container">


	<!-- LOGO -->
	<div class="logo"><a href="index.php" class="tilelink">Twój Planer</a></div>
	
	<!-- MENU BOCZNE -->
	<div class="nav">
	
		
        <?php
            //Menu dla zalogowanego usera
            if (isset($_SESSION["email"])) :
        ?>
			<a href="wyszukaj.php" class="tilelink">
                <div class="tile">Wyszukaj</div>
            </a>
			<br></br>
            <a href="historia.php" class="tilelink">
                <div class="tile">Historia</div>
            </a>
            <br></br>
			<a href="nowydochod.php" class="tilelink">
                <div class="tile">Dodaj dochód</div>
            </a>
            <br></br>
			<a href="nowywydatek.php" class="tilelink">
                <div class="tile">Dodaj wydatek</div>
            </a>
			<br></br>
<div style = "margin-bottom: 5px;" class="tile" id = "single-normal" >kalendarz
<script src="js/add2calendar.js"></script>
<script>

var startDate,
  endDate;

var tmp = new Date();
tmp.setDate(tmp.getDate() + 7); 
startDate = tmp.toString();

tmp.setDate(tmp.getDate() + 1); 
endDate = tmp.toString();

var singleEventArgs = {
  title       : 'Nazwa czynności',
  start       : startDate,
  end         : endDate,
  location    : 'Poland, Kielce',
  description : 'Witaj, zaplanuj swój dzień!'
};
var singleEvent = new Add2Calendar(singleEventArgs);

singleEvent.createWidget('#single-normal', function() {
  console.log('#single-normal widget has been created');
});
</script>
</div>
			<br></br>
            <a href="logout.php" class="tilelink">
                <div class="tile">Wyloguj się</div>
            </a>
        <?php
            endif;
        ?>

		<?php
            //Menu dla nie zalogowanego usera
            if (!isset($_SESSION["email"])) :
		?>
            <a href="login.php" class="tilelink">
                <div class="tile">Zaloguj się</div>
            </a>
			<br></br>
            <a href="register.php" class="tilelink">
                <div class="tile">Rejestracja</div>
            </a>
        <?php
		    endif;
		?>

	</div>
    <!-- ZAWARTOSC STRONY -->
    <div class="content">
	