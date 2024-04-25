CREATE TABLE komis (
    id INT AUTO_INCREMENT PRIMARY KEY,
    marka VARCHAR(255) NOT NULL,
    kolor VARCHAR(50) NOT NULL,
    paliwo ENUM('Benzyna', 'Diesel', 'Elektryk') NOT NULL,
    skrzynia ENUM('Manual', 'Automat') NOT NULL,
    cena DECIMAL(10, 2) NOT NULL
);
