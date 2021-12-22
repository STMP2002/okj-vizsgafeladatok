<!DOCTYPE html>
<?php
include_once 'include/connect.php';
?>

<html lang="hu">

<head>
  <title>Fogadó</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/bootstrap.css">
  <link rel="stylesheet" href="./fogado.css">
  <script src="./js/bootstrap.js"></script>
</head>

<body>
  <div class="container jumbotron bg-fej"></div>
  <div class="container">
    <div class="row">
      <div class="col-md-4 bg-torzs">
        <h3>Napraforgós Nemzeti Tanúsító Védjegy célja</h3>
        <p>A falusi szálláshelyek napraforgós Nemzeti Tanúsító Védjegye a FATOSZ által több mint tíz éve létrehozott, és működtetett minősítési rendszer alapjaira épülve 2011 óta a minőségi falusi turizmus szimbóluma. A védjegy alapvető célja, hogy – összhangban az egyes szálláshelyek működtetéséről szóló 239/2009. Korm. rendeletben foglaltakkal – garanciát nyújtson a szálláshely szolgáltatás minőségének megfelelő színvonalára. A falusi vendégházak 1-4 napraforgós besorolást nyerhetnek el a külső, belső megjelenés, a felszereltség, a szolgáltatások színvonala, valamint a szállásadó személyes felkészültségének, szakmai képzettségének függvényében.
          <br>
          <a href="https://falusiturizmus.eu/" target="_blank" rel="noopener noreferrer">Tájékoztató oldal</a>
          <br>
          <img src="./img/logo.png" class="bg-transparent">
        </p>
        <br>
        <p>
          <img src="./img/holloko_masolata.jpg" class="img-thumbnail">
        </p>
      </div>
      <div class="col-md-4">
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
          <img src="./img/ketagyas.jpg" class="img-thumbnail">
        </p>
      </div>
      <div class="col-md-4 bg-torzs">
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
      <div class="col-md-5">
        <h3>A vendégszobák foglalatsága</h3>
        <form action="include/inc_foglaltsag.php" method="POST">
          <label for="f_szobak">Válassza ki, melyik szoba adatait szeretné látni:</label>
          <select name="f_szobak" class="form-control">
            <?php
            $lekerdezes = mysqli_query($mysqli, "SELECT DISTINCT sznev FROM szobak");
            while ($sortomb = mysqli_fetch_assoc($lekerdezes)) {
              $szobanev = $sortomb['sznev'];
              echo "
                    <option value='$szobanev'>$szobanev</option>
                  ";
            }
            ?>
          </select>
          <br>
          <button type="submit" name="f_submit" id="kalkgomb">Adatok</button>
        </form>
      </div>
      <div class="col-md-7">
        <h3>A szobák kihasználtsága:</h3>
        <table class="table table-striped">
          <thead>
            <th>Szoba neve</th>
            <th>Vendégek száma</th>
            <th>Vendégéjszakák száma</th>
          </thead>
          <tbody>
            <?php
            $lekerdezes = mysqli_query(
              $mysqli,
              "SELECT szobak.sznev, SUM(foglalasok.fo) AS 'vendegek', SUM((foglalasok.tav - foglalasok.erk) * foglalasok.fo) AS 'vendegejszakak' FROM foglalasok 
                   INNER JOIN szobak ON foglalasok.szoba = szobak.szazon
                   GROUP BY szobak.sznev 
                   ORDER BY vendegek ASC, vendegejszakak ASC"
            );
            while ($sortomb = mysqli_fetch_assoc($lekerdezes)) {
              $szobanev = $sortomb['sznev'];
              $vendegek = $sortomb['vendegek'];
              $vendegejszakak = $sortomb['vendegejszakak'];
              echo "
                      <tr>
                        <td>$szobanev</td>
                        <td>$vendegek fő</td>
                        <td class='text-right'>$vendegejszakak éjszaka</td>
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