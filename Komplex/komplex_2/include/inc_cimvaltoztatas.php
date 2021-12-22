<?php
$oldal = basename($_SERVER['PHP_SELF']);
$cim;
switch ($oldal) {
    case 'index.php':
        $cim = 'Kezdőoldal';
        break;
    case 'ujnyersanyag.php':
        $cim = 'Új nyersanyag felvétele';
        break;
    case 'ermekadatai.php':
        $cim = 'Érmék adatainak kilistázása';
        break;
    case 'ermestatisztika.php':
        $cim = 'Érmék össztömeg szerinti statisztikája';
        break;
    default:
        $cim = 'Forint';
        break;
}
