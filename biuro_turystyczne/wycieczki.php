<?php
    $conn = new mysqli("localhost","root","","biuro");
?>

<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Wycieczki po Europie</title>
        <link rel="stylesheet" href="styl4.css">
    </head>
    <body>
        <header>
            <h1>BIURO TURYSTYCZNE</h1>
        </header>

        <div id="dane">
            <h3>Wycieczki, na które są wolne miejsca</h3>
            <?php
                // Skrypt #1

                $sql = "SELECT id, dataWyjazdu, cel, cena FROM wycieczki WHERE dostepna = TRUE;";
                $result = $conn->query($sql);

                echo "<ul>";
                while($row = $result -> fetch_array()) {
                    echo "<li>".$row[0].". dnia ".$row[1]." jedziemy do ".$row[2].", cena: ".$row[3]."</li>";
                }
                echo "</ul>";
            ?>
        </div>

        <div id="lewy">
            <h2>Bestselery</h2>
            <table>
                <tr>
                    <td>Wenecja</td>
                    <td>kwiecień</td>
                </tr>

                <tr>
                    <td>Londyn</td>
                    <td>lipiec</td>
                </tr>

                <tr>
                    <td>Rzym</td>
                    <td>wrzesień</td>
                </tr>
            </table>
        </div>

        <div id="srodkowy">
            <h2>Nasze zdjęcia</h2>
            <?php

                $sql = "SELECT nazwaPliku, podpis FROM zdjecia ORDER BY podpis DESC;";
                $result = $conn->query($sql);

                while($row = $result -> fetch_array()) {
                    echo "<img src='".$row[0]."' alt='".$row[1]."'>";
                }
            ?>
        </div>

        <div id="prawy">
            <h2>Skontaktuj się</h2>
            <a href="mailto:turysta@wycieczki.pl">napisz do nas</a>
            <p>telefon: 111222333</p>
        </div>

        <footer>
            <p>Stronę wykonał: <a target="_blank" style="text-decoration: unset;color: #fff;font-weight: bold;">Pascal Kardach</a></p>
        </footer>
    </body>
</html>

<?php
    $conn -> close();
?>