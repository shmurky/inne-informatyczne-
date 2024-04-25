<?php
// Połączenie z bazą danych MySQL
$host = 'localhost'; // adres hosta
$uzytkownik = 'root'; // nazwa użytkownika bazy danych
$haslo = ''; // hasło użytkownika bazy danych
$baza = 'komis'; // nazwa bazy danych

// Nawiązanie połączenia z bazą danych
$polaczenie = new mysqli($host, $uzytkownik, $haslo, $baza);

// Sprawdzenie połączenia
if ($polaczenie->connect_error) {
    die("Connection failed: " . $polaczenie->connect_error);
}

// Pobranie danych z formularza
$marka = $_POST['marka'];
$kolor = $_POST['kolor'];
$paliwo = $_POST['paliwo'];
$skrzynia = $_POST['skrzynia'];
$cena = $_POST['cena'];

// Przygotowanie zapytania SQL
$sql = "INSERT INTO komis (marka, kolor, paliwo, skrzynia, cena) VALUES ('$marka', '$kolor', '$paliwo', '$skrzynia', '$cena')";

// Wykonanie zapytania
if ($polaczenie->query($sql) === TRUE) {
    echo "Pojazd dodany pomyślnie";
} else {
    echo "Błąd: " . $sql . "<br>" . $polaczenie->error;
}

// Zamknięcie połączenia z bazą danych
$polaczenie->close();
?>
