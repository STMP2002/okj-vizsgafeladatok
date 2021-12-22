<?php
$eleres = 'localhost';
$fnev = 'root';
$jelszo = '';
$adatbazis = 'fogado';
$mysqli = new mysqli($eleres, $fnev, $jelszo, $adatbazis) or die("Nem sikerült csatlakozni az adatbázishoz");