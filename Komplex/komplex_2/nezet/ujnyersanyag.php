<?php include_once '../fejlec.php'; ?>
<section class="mt-5">
    <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-xl-9">
                <h1 class="text-white mb-4 text-center"><?php echo "$cim"; ?></h1>
                <div class="card" style="border-radius: 15px;">
                    <div class="card-body">
                        <form action="../include/inc_ujnyersanyag.php" method="POST">
                            <div class="row align-items-center pt-4 pb-3">
                                <div class="col-md-5 ps-5">
                                    <h6 class="mb-0 text-right">Nyersanyag azonosítója:</h6>
                                </div>
                                <div class="col-md-4 pe-5">
                                    <input type="number" name="f_nyersanyagID" class="form-control form-control-lg" min="1"/>
                                </div>
                            </div>
                            <div class="row align-items-center pt-4 pb-3">
                                <div class="col-md-5 ps-5">
                                    <h6 class="mb-0 text-right">Nyersanyag neve:</h6>
                                </div>
                                <div class="col-md-4 pe-5">
                                    <input type="text" name="f_nyersanyagNev" class="form-control form-control-lg"/>
                                </div>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-center mt-4 mb-4">
                                <button type="submit" name="f_submit" class="btn btn-secondary btn-block btn-lg">Új nyersanyag felvétele az adatbázisba</button>
                            </div>
                        </form>
                        <?php
                            if (isset($_GET['hiba'])) {
                                $hiba = $_GET['hiba'];
                                switch ($hiba) {
                                    case 'uresMezok':
                                        echo "<h6 class=\"text-center text-danger\">Hiba: Nincs minden mező kitöltve!</h6>";
                                        break;
                                    case 'nyersanyagIDMarLetezik':
                                        echo "<h6 class=\"text-center text-danger\">Hiba: A megadott nyersanyag azonosító már létezik az adatbázisban!</h6>";
                                        break;
                                    case 'nyersanyagMarLetezik':
                                        echo "<h6 class=\"text-center text-danger\">Hiba: A megadott nyersanyag már létezik az adatbázisban!</h6>";
                                        break;
                                    case 'sikertelenHozzaadas': 
                                        echo "<h6 class=\"text-center text-danger\">Hiba: Ismeretlen okokból nem sikerült hozzáadni a megadott nyersanyagot!</h6>";
                                        break;
                                }
                            }
                            if (isset($_GET['info'])) {
                                $info = $_GET['info'];
                                switch ($info) {
                                    case 'nyersanyagHozzaadva':
                                        echo "<h6 class=\"text-center text-success\">Sikerült hozzáadni a megadott nyersanyagot az adatbázishoz!</h6>";
                                        break;
                                }
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include_once '../lablec.php'; ?>