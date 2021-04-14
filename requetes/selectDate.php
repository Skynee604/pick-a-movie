<?php header('Content-Type: text/html; charset=utf-8');
require "../include/connectDB.php";

//verifie si la requête est bien de l'ajax.
function isAjax() {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
}

if(isAjax()){

    // Préparation de la requête
    $requete=$db->prepare("select date_format(dateSession,'%d/%m/%Y') as dateSession,timeSession,idMovie,adultPrice,childPrice,studentPrice from session where idMovie = :idMovie");

    $requete->bindParam(':idMovie', $_GET['idMovie']);
    $requete->execute();

    $result = $requete->fetchAll(PDO::FETCH_ASSOC);

    $result = utf8_encode(json_encode($result));

    // Affichage sur la page.php
    echo $result;

}else {
    header('location: ../.');
}

?>