<?php
require "../include/connectDB.php";

function isAjax()
{
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
}

if (isAjax()) {
    if(isset($_POST['dateSession']) && isset($_POST['timeSession']) && isset($_POST['idMovie'])){
        $error = null;
        $time = htmlentities($_POST['timeSession']);
        $date = htmlentities($_POST['dateSession']);
        $idMovie = htmlentities($_POST['idMovie']);
        
        $requete1 = $db->prepare("insert into session (dateSession, timeSession, idMovie) values (:dateSession,:timeSession,:idMovie)");
        $requete1->bindParam(":dateSession",$date);
        $requete1->bindParam(":timeSession",$time);
        $requete1->bindParam(":idMovie",$idMovie);
        $requete1->execute();

    }else {
        $error = "Cette séance est déjà présente dans la base de donnée.";
    }
    $error = utf8_encode(json_encode($error));
        echo $error;
}else {
    header('location: ../.');
}
?>
