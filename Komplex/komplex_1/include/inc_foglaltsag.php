<?php
if (isset($_POST['f_submit'])) {
    $szobanev = $_POST['f_szobak'];
    header("location: ../nezet/foglaltsag.php?szoba=$szobanev");
}