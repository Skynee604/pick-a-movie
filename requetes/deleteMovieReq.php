<?php
require "../include/connectDB.php";

function isAjax()
{
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
}

if (isAjax()) {
    $error = null;
    $idMovie = $_POST['idMovie'];
    $requete = $db->prepare("delete from movie where idMovie = :idMovie;");
    $requete->bindParam(":idMovie", $idMovie);
    $requete->execute();
    $error = utf8_encode(json_encode($error));
    echo $error;
} else {
    header('location: ../.');
}
