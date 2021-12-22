<?php
if (isset($_POST['f_submit'])) {
    require_once './inc_kapcsolat.php';

    $nyersanyagID = mysqli_real_escape_string($mysqli, $_POST['f_nyersanyagID']);
    $nyersanyagNev = mysqli_real_escape_string($mysqli, $_POST['f_nyersanyagNev']);

    $IDEllenorzes = mysqli_prepare($mysqli, "SELECT * FROM anyag WHERE femid = ?");
    mysqli_stmt_bind_param($IDEllenorzes, 'i', $nyersanyagID);
    mysqli_stmt_execute($IDEllenorzes);
    $IDTalalat = mysqli_num_rows(mysqli_stmt_get_result($IDEllenorzes));

    $nyersanyagEllenorzes = mysqli_prepare($mysqli, "SELECT * FROM anyag WHERE femnev = ?");
    mysqli_stmt_bind_param($nyersanyagEllenorzes, 's', $nyersanyagNev);
    mysqli_stmt_execute($nyersanyagEllenorzes);
    $nyersanyagTalalat = mysqli_num_rows(mysqli_stmt_get_result($nyersanyagEllenorzes));

    if (empty($nyersanyagID) || empty($nyersanyagNev)) {
        header("location: ../nezet/ujnyersanyag.php?hiba=uresMezok");
        exit;
    } else if ($nyersanyagTalalat != 0) {
        header("location: ../nezet/ujnyersanyag.php?hiba=nyersanyagMarLetezik");
        exit;
    } else if ($IDTalalat != 0) {
        header("location: ../nezet/ujnyersanyag.php?hiba=nyersanyagIDMarLetezik");
        exit;
    } else {
        $beillesztes = mysqli_prepare($mysqli, "INSERT INTO anyag (femid, femnev) VALUES (?, ?)");
        mysqli_stmt_bind_param($beillesztes, "is", $nyersanyagID, $nyersanyagNev);
        if (mysqli_stmt_execute($beillesztes)) {
            header("location: ../nezet/ujnyersanyag.php?info=nyersanyagHozzaadva");
            exit;
        } else {
            header("location: ../nezet/ujnyersanyag.php?hiba=sikertelenHozzaadas");
        }
    }
}