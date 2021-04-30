<?php header('Content-Type: text/html; charset=utf-8');
session_start();
require "../include/connectDB.php";

//verifie si la requête est bien de l'ajax.
function isAjax() {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
}

if(isAjax()){

    $idClient = $_GET['idClient'];
    $requete = $db->prepare("select idTicket, movie.thumbnail, movie.titleMovie, date_format(session.dateSession,'%d/%m/%Y') as dateSession, date_format(session.timeSession, '%H:%i') as timeSession, price.namePrix, price.prix, quant from price, ticket inner join session using(idSession) inner join movie using(idMovie) where ticket.idPrice = price.idPrix and idClient = :idClient order by session.dateSession asc, session.timeSession asc;");

    $requete->bindParam(':idClient', $idClient);
    $requete->execute();

    $result = $requete->fetchAll(PDO::FETCH_ASSOC);

    $result = utf8_encode(json_encode($result));

    // Affichage sur la page.php
    echo $result;

}else {
    header('location: ../.');
}
?>