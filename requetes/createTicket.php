<?php header('Content-Type: text/html; charset=utf-8');
require "../include/connectDB.php";

//verifie si la requête est bien de l'ajax.
/*function isAjax() {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
}

if(isAjax()){*/
$dateS = $_POST['dateS'];
$heureS = $_POST['heureS'];
$idMovie  = $_POST['idMovie'];

    // Préparation de la requête
    $requete=$db->prepare("select idSession from session where date_format(dateSession,'%d/%m/%Y') like :dateSession and timeSession like :timeSession; and idMovie = :idMovie");

    $requete->bindParam(':dateSession', $dateS);
    $requete->bindParam(':timeSession', $heureS);
    $requete->bindParam(':idMovie', $idMovie);
    $requete->execute();

    $result = $requete->fetchObject();
    $requete->closeCursor();

    $idSession = $result->idSession;
    $idClient = $_POST['idClient'];
    $idPrice = $_POST['idPrice'];
    $quant = $_POST['quant'];

    $requete2=$db->prepare("insert into ticket (idClient,idSession,idPrice,quant) values (:idClient, :idSession, :idPrice , :quant);");

    $requete2->bindParam(':idClient', $idClient);
    $requete2->bindParam(':idSession', $idSession);
    $requete2->bindParam(':idPrice', $idPrice);
    $requete2->bindParam(':quant', $quant);
    $requete2->execute();


   //$result = utf8_encode(json_encode($result));

    // Affichage sur la page.php
    echo $idSession;

/*}else {
    header('location: ../.');
}*/

?>