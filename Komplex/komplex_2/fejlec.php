<?php require_once 'include/inc_cimvaltoztatas.php' ?>
<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $cim; ?></title>
    <link rel="stylesheet" href="<?php echo $oldal !== 'index.php' ? '../css/bootstrap.css' :  './css/bootstrap.css'; ?>">
    <link rel="stylesheet" href="<?php echo $oldal !== 'index.php' ? '../alap.css' : 'alap.css'; ?>">
</head>

<body>
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <a class="navbar-brand" href="<?php echo $oldal !== 'index.php' ? '../index.php' : '#'; ?>">Forint</a>
        <div class="collapse navbar-collapse">
            <div class="navbar-nav mx-auto">
                <?php
                if ($oldal !== 'ujnyersanyag.php') {
                    $atiranyit = $oldal == 'index.php' ? "./nezet/ujnyersanyag.php" : "./ujnyersanyag.php";
                    echo "<a class=\"nav-item nav-link\" href=\"". $atiranyit ."\">Új nyersanyag felvétele</a>";
                }
                if ($oldal !== 'ermekadatai.php') {
                    $atiranyit = $oldal == 'index.php' ? "./nezet/ermekadatai.php" : "./ermekadatai.php";
                    echo "<a class=\"nav-item nav-link\" href=\"". $atiranyit ."\">Érmék adatainak kilistázása</a>";
                }
                if ($oldal !== 'ermestatisztika.php') {
                    $atiranyit = $oldal == 'index.php' ? "./nezet/ermestatisztika.php" : "./ermestatisztika.php";
                    echo "<a class=\"nav-item nav-link\" href=\"". $atiranyit ."\">Érmék össztömeg szerinti statisztikája</a>";
                }
                ?>
            </div>
        </div>
    </nav>