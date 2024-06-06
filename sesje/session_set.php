<?php
session_start();
$_SESSION['number'] = 123;
$_SESSION['word'] = "linusek";
echo "sesja.";
?>
<br>
<a href="session_get.php">kliknij aby przejsc do strony z zapisaną sesją</a>