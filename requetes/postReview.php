<?php header('Content-Type: text/html; charset=utf-8');
require "../include/connectDB.php";

//verifie si la requête est bien de l'ajax.
function isAjax() {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
}

if(isAjax()){

    if(!empty($_POST['textReview']) && !empty($_POST['noteReview']) && !empty($_POST['idClient']) && !empty($_POST['idMovie'])) {

        if($_POST['noteReview'] <= 5 && $_POST['noteReview'] >= 1) {

            $textReview = htmlentities($_POST['textReview']);

            // Préparation de la requête
            $requete=$db->prepare("insert into review (textReview,dateReview,noteReview,idClient,idMovie) values (:textReview, now(), :noteReview , :idClient , :idMovie);");

            $requete->bindParam(':textReview', $textReview );
            $requete->bindParam(':noteReview', $_POST['noteReview']);
            $requete->bindParam(':idClient', $_POST['idClient']);
            $requete->bindParam(':idMovie', $_POST['idMovie']);
            $requete->execute();

            $idReview = $db->lastInsertID();

            $requete2=$db->prepare("select review.textReview, date_format(date(review.dateReview),'%d/%m/%Y') as 'dateReview',review.noteReview, client.nickNameClient from review inner join client using(idClient) where idReview = :idReview");

            $requete2->bindParam(':idReview', $idReview);
            $requete2->execute();

            $result = $requete2->fetchAll(PDO::FETCH_ASSOC);
            $result = utf8_encode(json_encode($result));

            // Affichage sur la page.php
            echo $result;

        }
    }

}else {
    header('location: ../.');
}

?>