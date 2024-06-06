<?php
setcookie("number", 123, time() + 3600, "/"); 
setcookie("word", "linusek", time() + 3600, "/");
echo "ciastka mniam";
?>
<br>
<a href="cookie_get.php">kliknij aby przejsc do strony z zapisanym ciasteczkiem</a>