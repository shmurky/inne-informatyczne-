<?php
if (isset($_COOKIE['number']) && isset($_COOKIE['word'])) {
   echo "Liczba: " . $_COOKIE['number'] . "<br>";
   echo "Wyraz: " . $_COOKIE['word'] . "<br>";
} else {
   echo "Brak zapisanych zmiennych w ciasteczkach.<br>";
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   setcookie("number", "", time() - 3600, "/");
   setcookie("word", "", time() - 3600, "/");
   echo "Ciasteczka zostały usunięte.<br>";
}
?>
<form method="post">
<button type="submit">Usuń ciasteczka</button>
</form>
<br>
<a href="cookie_set.php">kliknij aby przejsc do strony z ustawianiem ciasteczek</a>