<?php
$eleres = 'localhost';
$felhasznalo = 'root';
$jelszo = '';
$adatbazis = 'forint';
$port = 3306;
$mysqli = new mysqli($eleres, $felhasznalo, $jelszo, $adatbazis, $port);
if ($mysqli->connect_error) {
    die("Nem sikerült csatlakozni az adatbázishoz!");
}