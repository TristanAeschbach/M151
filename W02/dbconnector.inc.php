<?php
$host     = 'localhost';       // host
$username = 'tester';            // username
$password = '1234';        // Passwort (brauchen Sie nie dieses Passwort)
$database = 'm151';   // database

// Verbindung herstellen
$conn = mysqli_connect($host, $username, $password, $database);

// Verbindung prüfen
if (!$conn) {
    die("Verbindung misslungen: " . mysqli_connect_error());
}
echo "Verbindung erfolgreich";
