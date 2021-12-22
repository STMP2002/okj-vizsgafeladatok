<!DOCTYPE html>
<?php
include_once '../include/connect.php';
?>

<html lang="hu">

<head>
    <title>Fogadó</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../fogado.css">
    <script src="../js/bootstrap.js"></script>
</head>

<body>
    <div class="container jumbotron bg-fej"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h3>Falusi szálláshely fajtái</h3>
                <p>
                <ul>
                    <li>Vendégszoba: a vendégek rendelkezésére bocsátható önálló lakóegység, amely egy lakóhelyiségből, és a minősítéstől függően a hozzátartozó mellékhelyiségekből áll.</li>
                    <li>Lakrész: önálló épület kettő, illetve több szobából álló lehatárolt része a minősítéstől függően hozzátartozó mellékhelyiségekkel együtt</li>
                    <li>Vendégház: önálló épület, több szobával, mellékhelyiségekkel és főzési lehetőséggel rendelkező lakó-, illetve üdülőegység, családok vagy kisebb csoportok elszállásolására.</li>
                    <li>Sátorozóhely: csak valamelyik falusi szálláshely típus mellett, mintegy azt kiegészítve üzemeltethető az előírt feltételek megléte esetén. Pl.: falusi vendégház sátorozóhellyel.</li>
                </ul>
                </p>
                <p>
                    <img src="../img/ketagyas.jpg" class="img-thumbnail">
                </p>
            </div>
            <div class="col-md-6 bg-torzs">
                <h3>A hét törpe fogadó</h3>
                <table class="table table-striped">
                    <thead>
                        <th>Szoba neve</th>
                        <th>Ágyak száma</th>
                    </thead>
                    <tbody>
                        <?php
                        $lekerdezes =  mysqli_query($mysqli, "SELECT sznev, agy FROM szobak");
                        $szummaFo = 0;
                        while ($sortomb = mysqli_fetch_assoc($lekerdezes)) {
                            $szobanev = $sortomb['sznev'];
                            $agyakszama = $sortomb['agy'];
                            $szummaFo += $agyakszama;
                            echo "
                                <tr>
                                  <td>$szobanev</td>
                                  <td>$agyakszama ágyas</td>
                                </tr>
                            ";
                        }
                        ?>
                    </tbody>
                </table>
                <?php echo "<span class=\"font-weight-bold\">A házban összesen $szummaFo fő fér el.</span><br>" ?>
                <span class="font-weight-bold">Felszereltségük:</span>
                <ol>
                    <li>Ruhásszekrény</li>
                    <li>Saját fürdőszoba zuhanytálca</li>
                    <li>WC (fürdőszobával egyben)</li>
                </ol>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-center">A választott szoba foglaltsága: <?php echo $_GET['szoba']; ?></h3>
                <table class="table table-striped mx-auto w-50">
                    <thead>
                        <th>Vendég neve</th>
                        <th>Érkezés dátuma</th>
                        <th>Távozás dátuma</th>
                    </thead>
                    <tbody>
                        <?php
                        $szoba = mysqli_real_escape_string($mysqli, $_GET['szoba']);
                        $lekerdezes = "SELECT vendegek.vnev, foglalasok.erk, foglalasok.tav FROM vendegek INNER JOIN foglalasok ON foglalasok.vendeg = vendegek.vsorsz INNER JOIN szobak ON szobak.szazon = foglalasok.szoba WHERE szobak.sznev = ?";
                        $stmt = mysqli_prepare($mysqli, $lekerdezes);
                        mysqli_stmt_bind_param($stmt, "s", $szoba) and mysqli_stmt_execute($stmt);
                        $eredmeny = mysqli_stmt_get_result($stmt);
                        while ($sortomb = mysqli_fetch_assoc($eredmeny)) {
                            $vendegnev = $sortomb['vnev'];
                            $erkezes = $sortomb['erk'];
                            $tavozas = $sortomb['tav'];
                            echo "
                      <tr>
                        <td>$vendegnev</td>
                        <td>$erkezes</td>
                        <td class='text-right'>$tavozas</td>
                      </tr>
                    ";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>