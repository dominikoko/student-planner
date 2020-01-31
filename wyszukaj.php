<?php
    require_once "header.php";

    isNotLogged();

    $userId = $_SESSION["userId"];
?>
<style> 
input[type=text] {
    width: 130px;
    box-sizing: border-box;
    border: 10px solid #155cff;
    border-radius: 4px;
    font-size: 20px;
    background-color: white;
    background-image: url('searchicon.png');
    background-position: 10px 10px; 
    background-repeat: no-repeat;
    padding: 12px 20px 12px 40px;
    -webkit-transition: width 0.4s ease-in-out;
    transition: width 0.4s ease-in-out;
	text-align: center;
	}

input[type=text]:focus {
    width: 80%;
	background-color: rgb(180, 250, 255);
}
input[type=submit]{
    width:80px;
	font-size:20px;
	border: 2px solid black;
	background-color: rgb(10, 220, 175);
}

ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #333;
	}

li {
    float: left;
}

li a, .dropbtn {
    display: inline-block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
	background-color: #00cc99;
}

li a:hover, .dropdown:hover .dropbtn {
    background-color: red;
}

li.dropdown {
    display: inline-block;
	
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}

.dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    text-align: left;
}

.dropdown-content a:hover {background-color: #f1f1f1}

.dropdown:hover .dropdown-content {
    display: block;
}
</style>
<?php
    require_once "header.php";

    isNotLogged();

    $userId = $_SESSION["userId"];
?>


    <!-- WYSZUKIWARKA -->
    <h2>Wyszukiwarka</h2>
    <form action="wyszukaj.php" align="center" method="post">
        <input type="text"  name="szukaj">
        <input type="submit" value="Szukaj">
    </form>
	
	<ul>
	<div style = "color: white; text-align: center;">Wyszukaj po:</div>
  <li class="dropdown">
   </li>
 
</ul>

<?php 
$pdo->query('SET NAMES utf8');
$sqlKategoria = 'SELECT DISTINCT kategoria FROM baza b WHERE  b.userId = "'. $userId .'"';
$resultKategoria = $pdo->query($sqlKategoria);
$sqlRodzaj = 'SELECT DISTINCT rodzaj FROM baza b WHERE  b.userId = "'. $userId .'"';
$resultRodzaj = $pdo->query($sqlRodzaj);
$sqlWszystko = 'SELECT * FROM baza b WHERE  b.userId = "'. $userId .'"';
$result = $pdo->query($sqlWszystko);
?> <table width="700" align="center" border="1" bordercolor="#d5d5d5" cellpadding="0" cellspacing="0"  class="js-dynamitable">
	<thead>
                <tr style = "color: black;">
            <th width="100" align="center" bgcolor="e5e5e5">
				Rodzaj
				<select class="js-filter  form-control">
				  <option value=""></option>
				  <option value="DOCHOD">DOCHOD</option>
				  <option value="WYDATEK">WYDATEK</option>
				</select>
			</th>
            <th width="100" align="center" bgcolor="e5e5e5">Nazwa</th>
            <th width="100" align="center" bgcolor="e5e5e5">Kwota</th>
             <th width="100" align="center" bgcolor="e5e5e5">Data</th>
            <th width="100" align="center" bgcolor="e5e5e5">
			Kategoria
			<select class="js-filter  form-control">
				<option value=""></option>
			<?php
				foreach($resultKategoria as $row)
			   {
					//$link = '<a "href="#" style="font-size: 15px;" name = "'.$row['kategoria'].'">'.$row['kategoria'].'</a>';
					//echo '<a "href="#" style="font-size: 15px;" name = "'.$row['kategoria'].'">'.$row['kategoria'].'</a>';
					echo '<option>'.$row['kategoria'].'</option>';
			   }
			?>
		
			</select>
			</th>
            <th width="100" align="center" bgcolor="e5e5e5">Komentarz</th>
        </tr>
		</thead>
        <tbody>     
		
<?php 

   foreach($result as $row)
            {
                echo '
                <tr>
                <td>' . $row['rodzaj'] . '</td>
                <td>' . $row['nazwa'] . '</td>
                <td>' . $row['kwota'] . 'zł'.'</td>
                <td>' . $row['data'] . '</td>
                <td>' . $row['kategoria'] . '</td>
                <td>' . $row['komentarz'] . '</td>
                </tr>
                ';
            }
	echo '</tbody></table>';		
   /*echo '<li class="dropdown">';
   echo' <a href="javascript:void(0)" class="dropbtn">Kategoria</a>';
   echo'<div class="dropdown-content">';
   foreach($resultKategoria as $row)
   {
		//$link = '<a "href="#" style="font-size: 15px;" name = "'.$row['kategoria'].'">'.$row['kategoria'].'</a>';
		echo '<a "href="#" style="font-size: 15px;" name = "'.$row['kategoria'].'">'.$row['kategoria'].'</a>';
	/*	
   }
  
  /*   	 if (isset($_GET['$link'])) {
			 echo ' <table width="700" align="center" border="1" bordercolor="#d5d5d5" cellpadding="0" cellspacing="0">';
    echo '
                <tr style = "color: black;">
            <td width="100" align="center"  bgcolor="e5e5e5">Rodzaj</td>
            <td width="100" align="center" bgcolor="e5e5e5">Nazwa</td>
            <td  width="100" align="center" bgcolor="e5e5e5" >Kwota</td>
            <td width="100" align="center" bgcolor="e5e5e5">Data</td>
            <td width="100" align="center" bgcolor="e5e5e5">Kategoria</td>
            <td width="100" align="center" bgcolor="e5e5e5">Komentarz</td>
        </tr>
';
   
   
   foreach($result as $row)
            {
                echo '
                <tr>
                <td>' . $row['rodzaj'] . '</td>
                <td>' . $row['nazwa'] . '</td>
                <td>' . $row['kwota'] . 'zł'.'</td>
                <td>' . $row['data'] . '</td>
                <td>' . $row['kategoria'] . '</td>
                <td>' . $row['komentarz'] . '</td>
                </tr>
                ';
            }
			
}

   */
   //if('<a href="#" style="font-size: 15px;">'.$row['kategoria'].'</a>'){   
   //}
     
   
   
  /* echo'</li>';
   //echo'<br>';
      echo '<li class="dropdown">';
   echo' <a href="javascript:void(0)" class="dropbtn">Rodzaj</a>';
   echo'<div class="dropdown-content">';
   foreach($resultRodzaj as $row)
   {
		echo '<a href="#" style="font-size: 15px;">'.$row['rodzaj'].'</a>';
   }
   
   echo'</li>';
   */
   
?> 


    <br/>

        <?php if(isset($_POST['szukaj'])) : ?>
            <table width="700" align="center" border="1" bordercolor="#d5d5d5" cellpadding="0" cellspacing="0">

        <?php
            $pdo->query('SET NAMES utf8');
            $sql = 'Select * From baza where kategoria = "' . $_POST['szukaj'] . '"';
        ?>
            <tr style="color:black">
                <td  width="100" align="center" bgcolor="e5e5e5">Rodzaj</td>
                <td width="100" align="center" bgcolor="e5e5e5">Nazwa</td>
                <td width="100" align="center" bgcolor="e5e5e5">Kwota</td>
                <td width="100" align="center" bgcolor="e5e5e5">Data</td>
                <td width="100" align="center" bgcolor="e5e5e5">Kategoria</td>
                <td width="100" align="center" bgcolor="e5e5e5">Komentarz</td>
            </tr>

        <?php
                $stmt = $pdo->query($sql);
                foreach($stmt as $row)
                {
                echo '
                    <tr style="color:black">
                    <td>' . $row['rodzaj'] . '</td>
                    <td>' . $row['nazwa'] . '</td>
                    <td>' . $row['kwota'] . '</td>
                    <td>' . $row['data'] . '</td>
                    <td>' . $row['kategoria'] . '</td>
                    <td>' . $row['komentarz'] . '</td>
                    </tr>
                ';
                }
                $stmt->closeCursor();

        endif;
        ?>



<?php
    include_once "footer.php";
?>