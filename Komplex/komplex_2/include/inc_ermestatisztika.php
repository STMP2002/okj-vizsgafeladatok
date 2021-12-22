<?php
require_once 'inc_kapcsolat.php';
$lekerdezes = mysqli_query(
    $mysqli,
   "SELECT erme.cimlet, (SUM(erme.tomeg * erme.darab) / 1000) AS 'ossztomeg', tervezo.nev AS 'tervezo' FROM erme
    INNER JOIN tkod ON tkod.ermeid = erme.ermeid
    INNER JOIN tervezo ON tkod.tervezoid = tervezo.tid
    GROUP BY erme.cimlet, tervezo.nev
    ORDER BY ossztomeg ASC;"
    );
echo "
    <table class=\"table table-borderless table-striped mb-2\">
    <thead>
        <th>Érmecímlet:</th>
        <th>Össztömeg:</th>
        <th>Tervező neve:</th>
    </thead>
    <tbody>
";
while ($erme = mysqli_fetch_assoc($lekerdezes)) {
    $ermecimlet = $erme['cimlet'];
    $ermeOssztomeg = $erme['ossztomeg'];
    $ermeTervezo = $erme['tervezo'];
    echo "
    <tr>
        <td>$ermecimlet Ft</td>
        <td>$ermeOssztomeg kg</td>
        <td>$ermeTervezo</td>
    </tr>
    ";
}
echo "  
    </tbody>
    </table>
";