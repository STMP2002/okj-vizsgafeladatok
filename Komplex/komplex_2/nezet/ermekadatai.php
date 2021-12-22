<?php include_once '../fejlec.php'; ?>
<section class="mt-5">
    <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-xl-9">
                <h1 class="text-white mb-4 text-center"><?php echo "$cim"; ?></h1>
                <div class="card" style="border-radius: 15px;">
                    <div class="card-body">
                        <form action="../include/inc_ermekadatai.php" method="POST">
                            <div class="form-group">
                                <label class="floating-label font-weight-bold" for="f_valasztottCimlet">Válasszon az alábbi érmecímletek közül:</label>
                                <select class="form-select form-control" name="f_valasztottCimlet">
                                    <option selected disabled></option>
                                    <?php
                                    require_once '../include/inc_kapcsolat.php';
                                    $cimletLekerdezes = mysqli_query($mysqli, "SELECT DISTINCT cimlet FROM erme;");
                                    while ($erme = mysqli_fetch_assoc($cimletLekerdezes)) {
                                        $ermecimlet = $erme['cimlet'];
                                        echo "<option value=\"$ermecimlet\">$ermecimlet Ft</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="d-flex justify-content-center mt-4">
                                <button type="submit" name="f_submit" class="btn btn-secondary btn-block btn-lg">Érmecímlettel kapcsolatos adatok kilistázása</button>
                            </div>
                        </form>
                        <?php
                        if (isset($_GET['hiba'])) {
                            $hiba = $_GET['hiba'];
                            switch ($hiba) {
                                case 'nincsKivalasztottCimlet':
                                    echo "<h6 class=\"text-center text-danger mt-4\">Hiba: Nincs kiválasztva érmecímlet!</h6>";
                                    break;
                            }
                        }
                        if (isset($_GET['cimlet'])) {
                            $cimlet = mysqli_real_escape_string($mysqli, $_GET['cimlet']);
                            $cimletAdatokLekerdezes = mysqli_prepare($mysqli, "SELECT erme.cimlet, erme.darab, erme.tomeg, YEAR(erme.kiadas) AS 'kiadasEv' FROM erme WHERE cimlet = ? ORDER BY erme.darab DESC;");
                            mysqli_stmt_bind_param($cimletAdatokLekerdezes, "i", $cimlet);
                            mysqli_stmt_execute($cimletAdatokLekerdezes);
                            $adatok = mysqli_stmt_get_result($cimletAdatokLekerdezes);
                            echo "
                            <table class=\"table table-borderless table-striped mt-4\">
                            <caption>Kiválasztott érmecímlet: $cimlet Ft</caption>
                            <thead>
                                <th>Címlet:</th>
                                <th>Darabszám:</th>
                                <th>Tömeg:</th>
                                <th>Kiadás éve:</th>
                            </thead>
                            <tbody>
                            ";
                            while ($erme = mysqli_fetch_assoc($adatok)) {
                                $ermecimlet = $erme['cimlet'];
                                $darabszam = $erme['darab'];
                                $tomeg = $erme['tomeg'];
                                $kiadasEv = $erme['kiadasEv'];
                                echo "
                                <tr>
                                    <td>$ermecimlet Ft</td>
                                    <td>$darabszam</td>
                                    <td>$tomeg gramm</td>
                                    <td>$kiadasEv</td>
                                </tr>
                                ";
                            }
                            echo "
                            </tbody>
                            </table>
                            ";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include_once '../lablec.php'; ?>