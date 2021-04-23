<?php header('Content-Type: text/html; charset=utf-8');
require "../include/connectDB.php";

//verifie si la requête est bien de l'ajax.
function isAjax() {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
}

if(isAjax()){
$dateS = $_POST['dateS'];
$heureS = $_POST['heureS'];
$idMovie  = $_POST['idMovie'];

    // Préparation de la requête
    $requete=$db->prepare("select idSession from session where date_format(dateSession,'%d/%m/%Y') like :dateSession and timeSession like :timeSession and idMovie = :idMovie;");

    $requete->bindParam(':dateSession', $dateS);
    $requete->bindParam(':timeSession', $heureS);
    $requete->bindParam(':idMovie', $idMovie);
    $requete->execute();

    $result = $requete->fetchObject();
   // $requete->closeCursor();

    $idSession = $result->idSession;
    $idClient = $_POST['idClient'];
    $idPrice = $_POST['idPrice'];
    $quant = $_POST['quant'];

    if($quant > 0){
        $requete2 =$db->prepare("select idTicket from ticket where idSession = :idSession and idPrice = :idPrice");
        $requete2->bindParam(':idSession', $idSession);
        $requete2->bindParam(':idPrice', $idPrice);
        $requete2->execute();

        $result2 = $requete2->fetchObject();
        $requete2->closeCursor();

        if(empty($result2->idTicket)){
            $requete3=$db->prepare("insert into ticket (idClient,idSession,idPrice,quant) values (:idClient, :idSession, :idPrice , :quant);");
            $requete3->bindParam(':idClient', $idClient);
            $requete3->bindParam(':idSession', $idSession);
            $requete3->bindParam(':idPrice', $idPrice);
            $requete3->bindParam(':quant', $quant);
            $requete3->execute();

        }else {
            $requete4=$db->prepare("update ticket set quant = quant + :quant where idTicket = :idTicket;");
            $requete4->bindParam(':idTicket', $result2->idTicket);
            $requete4->bindParam(':quant', $quant);
            $requete4->execute();
        }
    }




}else {
    header('location: ../.');
}

?>