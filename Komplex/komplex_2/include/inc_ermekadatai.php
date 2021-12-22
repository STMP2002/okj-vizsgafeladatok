<?php
if (isset($_POST['f_submit'])) {
    $valasztottCimlet = $_POST['f_valasztottCimlet'];
    if (empty($valasztottCimlet)) {
        header("location: ../nezet/ermekadatai.php?hiba=nincsKivalasztottCimlet");
        exit;
    }
    else {
        header("location: ../nezet/ermekadatai.php?cimlet=$valasztottCimlet");
        exit;
    }
}