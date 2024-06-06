<?php
session_start();
if (isset($_SESSION['number']) && isset($_SESSION['word'])) {
   echo "Liczba: " . $_SESSION['number'] . "<br>";
   echo "Wyraz: " . $_SESSION['word'] . "<br>";
} else {
   echo "Brak zapisanych zmiennych w sesji.<br>";
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   session_unset();
   session_destroy();
   echo "Sesja została usunięta.<br>";
}
?>
<form method="post">
<button type="submit">Usuń sesję</button>
</form>
<br>
<a href="session_set.php">kliknij aby przejsc do strony z ustawianiem sesji</a>