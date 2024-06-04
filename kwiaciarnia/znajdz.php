<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Kwiaty</title>
        <link rel="stylesheet" href="styl3.css">
    </head>
    <body>
        <header>
            <h1>Grupa Polskich Kwiaciarni</h1>
        </header>

        <div id="lewy">
            <h2>Menu</h2>
            <ol>
                <li><a href="index.html">Strona główna</a></li>
                <li><a href="https://www.kwiaty.pl/" target="_blank">Rozpoznaj kwiaty</a></li>
                <li><a href="znajdz.php">Znajdź kwiaciarnię</a></li>
                <ul>
                    <li>w Warszawie</li>
                    <li>w Malborku</li>
                    <li>w Poznaniu</li>
                </ul>
            </ol>
        </div>

        <div id="prawy">
            <h2>Znajdź kwiaciarnię</h2>
            <form action="znajdz.php" method="post">
                <label for="miasto">Podaj nazwę miasta:</label>
                <input type="text" name="miasto" id="miasto">
                <button type="submit" name="check">SPRAWDŹ</button>
            </form>

            <?php
                if(isset($_POST["check"])) {
                    $miasto = $_POST["miasto"];

                    $conn = new mysqli("localhost","root","","kwiaciarnia");

                    $sql = "SELECT nazwa, ulica FROM kwiaciarnie WHERE miasto = '$miasto';";
                    $result = $conn->query($sql);
    
                    while($row = $result -> fetch_array()) {
                        echo "<h3>".$row[0].", ".$row[1]."</h3>";
                    }
    
                    $conn -> close();
                }
            ?>
        </div>

        <footer>
            <p>Stronę opracował: <a target="_blank" style="color: #fff;text-decoration: none;">Pascal Kardach</a></p>
        </footer>
    </body>
</html>