<?php
    require_once "header.php";

    isNotLogged();

    $userId = $_SESSION["userId"];
?>


    <h2>Historia</h2>

    <div id="canvas-holder" style="width:40%; margin: 20px auto;">
        <canvas id="chart-area" />
    </div>


    <table width="700" align="center" border="1" bordercolor="#d5d5d5" cellpadding="0" cellspacing="0">
            <?php

            if(!isset($_GET['case'])){
                echo '
                <tr style = "color: black;">
            <td width="100" align="center"  bgcolor="e5e5e5">Rodzaj</td>
            <td width="100" align="center" bgcolor="e5e5e5">Nazwa</td>
            <td  width="100" align="center" bgcolor="e5e5e5" ><a style="text-decoration:none;" href="historia.php?case=1">Kwota</a></td>
            <td width="100" align="center" bgcolor="e5e5e5"><a style="text-decoration:none;" href="historia.php?case=3">Data</a></td>
            <td width="100" align="center" bgcolor="e5e5e5">Kategoria</td>
            <td width="100" align="center" bgcolor="e5e5e5">Komentarz</td>
        </tr>
                ';
                $sql = 'SELECT * FROM baza b WHERE b.userId = "'. $userId .'"';
            }else if($_GET['case'] == 1){
                echo '
                <tr style = "color: black;">
            <td width="100" align="center" bgcolor="e5e5e5">Rodzaj</td>
            <td width="100" align="center" bgcolor="e5e5e5">Nazwa</td>
            <td width="100" align="center" bgcolor="e5e5e5"><a style="text-decoration:none;" href="historia.php?case=2">Kwota</a></td>
            <td width="100" align="center" bgcolor="e5e5e5"><a style="text-decoration:none;" href="historia.php?case=3">Data</a></td>
            <td width="100" align="center" bgcolor="e5e5e5">Kategoria</td>
            <td width="100" align="center" bgcolor="e5e5e5">Komentarz</td>
        </tr>
                ';
                $sql = 'SELECT * FROM baza b WHERE b.userId = "'. $userId .'" ORDER BY b.kwota ASC';
            }else if($_GET['case'] == 2) {
                echo '
                <tr style = "color: black;">
            <td width="100" align="center" bgcolor="e5e5e5">Rodzaj</td>
            <td width="100" align="center" bgcolor="e5e5e5">Nazwa</td>
            <td width="100" align="center" bgcolor="e5e5e5"><a style="text-decoration:none;" href="historia.php?case=1">Kwota</a></td>
            <td width="100" align="center" bgcolor="e5e5e5"><a style="text-decoration:none;" href="historia.php?case=3">Data</a></td>
            <td width="100" align="center" bgcolor="e5e5e5">Kategoria</td>
            <td width="100" align="center" bgcolor="e5e5e5">Komentarz</td>
        </tr>
                ';
                $sql = 'SELECT * FROM baza b WHERE b.userId = "'. $userId .'" ORDER BY b.kwota DESC';
            }else if($_GET['case'] == 3) {
                echo '
                <tr style = "color: black;" >
            <td width="100" align="center" bgcolor="e5e5e5">Rodzaj</td>
            <td width="100" align="center" bgcolor="e5e5e5">Nazwa</td>
            <td width="100" align="center" bgcolor="e5e5e5"><a style="text-decoration:none;" href="historia.php?case=1">Kwota</a></td>
            <td width="100" align="center" bgcolor="e5e5e5"><a style="text-decoration:none;" href="historia.php?case=4">Data</a></td>
            <td width="100" align="center" bgcolor="e5e5e5">Kategoria</td>
            <td width="100" align="center" bgcolor="e5e5e5">Komentarz</td>
        </tr>
                ';
                $sql = 'SELECT * FROM baza b WHERE b.userId = "'. $userId .'" ORDER BY b.data ASC';
            }else if($_GET['case'] == 4) {
                echo '
                <tr style = "color: black;">
            <td width="100" align="center" bgcolor="e5e5e5">Rodzaj</td>
            <td width="100" align="center" bgcolor="e5e5e5">Nazwa</td>
            <td width="100" align="center" bgcolor="e5e5e5"><a style="text-decoration:none;" href="historia.php?case=1">Kwota</a></td>
            <td width="100" align="center" bgcolor="e5e5e5"><a style="text-decoration:none;" href="historia.php?case=3">Data</a></td>
            <td width="100" align="center" bgcolor="e5e5e5">Kategoria</td>
            <td width="100" align="center" bgcolor="e5e5e5">Komentarz</td>
        </tr>
                ';
                $sql = 'SELECT * FROM baza b WHERE b.userId = "'. $userId .'" ORDER BY b.data DESC';
            }

            $pdo->query('SET NAMES utf8');

            $stmt = $pdo->query($sql);
            foreach($stmt as $row)
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
            $stmt->closeCursor();

            ?>
    </table>
<?php
	$sqlWydatki = 'SELECT sum(b.kwota) as amount FROM baza b WHERE b.rodzaj = "WYDATEK" AND b.userId = "'. $userId .'"';
	
	echo'
	<form rodzaj="f1" method="get" action="skrypt.php">
   <select rodzaj="s1">
      <option value="1">strona 1</option>
      <option value="2">strona 2</option>
   </select>
   <br />
   <input type="submit" value="Zmień stronę"/>
</form>
'
?>  
  <?php
        $sqlWydatki = 'SELECT sum(b.kwota) as amount FROM baza b WHERE b.rodzaj = "WYDATEK" AND b.userId = "'. $userId .'"';
        $resultWydatki = $pdo->query($sqlWydatki);
        $rowWydatki = $resultWydatki->fetch();

        $sqlDochod = 'SELECT sum(b.kwota) as amount FROM baza b WHERE b.rodzaj = "DOCHOD" AND b.userId = "'. $userId .'"';
        $resultDochod = $pdo->query($sqlDochod);
        $rowDochod = $resultDochod->fetch();

        $amountWydatki = $rowWydatki['amount'];
        $amountDochod  = $rowDochod['amount'];
?>

    <script>
        var config = {
            type: 'polarArea',
            data: {
                datasets: [
				{
					
                    data: [
	                    <?php echo $amountDochod;  ?>,
                        <?php echo $amountWydatki; ?>
                    ],
                    backgroundColor: [
                        'rgb(0, 250, 255)',
                        'rgb(200, 50, 120)'
                    ],
                    label: 'Historia transakcji',
				
					
                }
				],
                labels: [
				
                    "Dochód",
                    "Wydatki",
				
                ]
            },
            options: {
                responsive: true,
			legend: {
             labels: {
                  fontColor: 'white'
                 }
              },				
            }
        };

        window.onload = function() {
            var ctx = document.getElementById("chart-area").getContext("2d");
            window.myPie = new Chart(ctx, config);
        };

    </script>

<?php
    include_once "footer.php";
?>