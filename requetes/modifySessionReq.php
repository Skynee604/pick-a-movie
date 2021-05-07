<?php
require "../include/connectDB.php";

function isAjax()
{
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
}

if (isAjax()) {
    if ( isset($_POST['idMovie']) && isset($_POST['dateSeance']) && isset($_POST['heureSeance']) && isset($_POST['dateSession']) && isset($_POST['hourSession']) ) {
        $error = null;
        // current infos
        $idMovie = htmlentities($_POST['idMovie']);
        $currentDate = htmlentities($_POST['dateSeance']);

        $currentDateFormatted = date('Y-d-m', strtotime($currentDate));
        $currentDate = $currentDateFormatted;
        
        $currentHour = htmlentities($_POST['heureSeance']);
        $currentHour = date('H:i:s', strtotime($currentHour));
        // new infos
        $newDate = htmlentities($_POST['dateSession']);
        $newHour = htmlentities($_POST['hourSession']);

        $rqUpdate = $db->prepare("UPDATE session SET dateSession = :newDate, timeSession = :newHour WHERE (idMovie = :idMovie AND dateSession = :currentDate AND timeSession = :currentHour );");

        $rqUpdate->bindParam(":idMovie", $idMovie);
        $rqUpdate->bindParam(":currentDate", $currentDate);
        $rqUpdate->bindParam(":currentHour", $currentHour);
        
        $rqUpdate->bindParam(":newDate", $newDate);
        $rqUpdate->bindParam(":newHour", $newHour);
        
        $rqUpdate->execute();
    } else {
        $error = "Une valeur est manquante";
    }
    $error = utf8_encode(json_encode($error));
        echo $error;
} else {
    header('location: ../.');
}
