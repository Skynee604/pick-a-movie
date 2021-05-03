<?php
require "../include/connectDB.php";

function isAjax()
{
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
}

if (isAjax()) {
    if (isset($_POST['dateSession']) && isset($_POST['timeSession']) && isset($_POST['idMovie'])) {

        $error = null;

        $dateSession = htmlentities($_POST['dateSession']);
        $timeSession = htmlentities($_POST['timeSession']);
        $idMovie = htmlentities($_POST['idMovie']);

        $requete1 = $db->prepare("select idSession from session where date_format(dateSession,'%d/%m/%Y') like :dateSession and date_format(timeSession,'%H:%i:%s') like :timeSession and idMovie = :idMovie");

        $requete1->bindParam(":dateSession", $dateSession);
        $requete1->bindParam(":timeSession", $timeSession);
        $requete1->bindParam(":idMovie", $idMovie);
        $requete1->execute();

        $sessionExists = $requete1->fetch();
        $idSession = $sessionExists[0];

        if (isAjax()) {
            $requete2 = $db->prepare("delete from session where idSession = :idSession;");
            $requete2->bindParam(":idSession", $idSession);
            $requete2->execute();
            $error = utf8_encode(json_encode($error));
            echo $error;
        } else {
            header('location: ../.');
        }
    }
} else {
    header('location: ../.');
}
