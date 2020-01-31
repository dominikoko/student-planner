<?php
    require_once "header.php";

    isNotLogged();
?>

    <h2>Dodaj nowy wydatek</h2>
    <form action="dodajwydatek.php" method="post">

        Nazwa: <input type="text" name="nazwa" /><br/>
        Kwota: <input type="number" name="kwota" /><br/>
        Data: <input type="date" name="data"/> <br/> <br/>
   
        Kategoria:
        <select name="kategoria">
            <option selected="selected">Rachunki</option>
            <option>Dom</option>
            <option>Samochód</option>
            <option>Ważne</option>
            <option>Ubrania</option>
            <option>Kosmetyki</option>
            <option>Uroda</option>
            <option>Rozrywka</option>
            <option>Podróże</option>
            <option>Inne</option>
        </select> <br/><br/>

        Komentarz:<br/>
        <textarea name="komentarz" cols="50" rows="5"></textarea><br />
        <input style="width: 70px;" type="submit" name="button" onsubmit="return sprawdzFormularz(this)"  onclick="przycisk_alert()" value="Dodaj"/>

    </form>

<?php
    include_once "footer.php";
?>