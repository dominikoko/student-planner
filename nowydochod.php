<?php
    require_once "header.php";

    isNotLogged();
?>
	
    <h2>Dodaj nowy dochod</h2>
    <form action="dochodplik.php" method="post">
        <div>
            Nazwa: <input type="text" name="nazwa" /><br/>
            Kwota: <input type="number" name="kwota" /><br/>
            Data: <input type="date" name="data" /> <br/>

            <p>Kategoria</p>
            <input type="radio" name="kategoria" value="praca" />wypłata<br />
            <input type="radio" name="kategoria" value="stypendium" />stypendium<br />
            <input type="radio" name="kategoria" value="prezent" />prezent<br />
            <input type="radio" name="kategoria" value="inne" />inne (podaj jaka):<br />
            <input type="text" name="kategoriaText" />

            <p>Komentarz:</p>
            <textarea name="komentarz" cols="50" rows="5"></textarea><br />
            <!--PRZYCIK WYSYŁAJĄCY FORMULARZ -->

            <input style="width: 70px;" type="submit" name="button" onclick="przycisk_alert()" onsubmit="return sprawdzFormularz(this)" value="Dodaj" />
        </div>
    </form>

<?php
    include_once "footer.php";
?>