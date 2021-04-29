<?php
require "../include/connectDB.php";

if(isset($_FILES['thumbnail']) && isset($_FILES['poster']) && isset($_POST['title']) && isset($_POST['summary']) && isset($_POST['director'])){
    $error = null;
    $title = $_POST['title'];
    $summary = $_POST['summary'];
    $director = $_POST['director'];

    $requete1 = $db->prepare("select idMovie from movie where titleMovie = :title and director = :director");
    $requete1->bindParam(":title",$title);
    $requete1->bindParam(":director",$director);
    $requete1->execute();

    $movieExists = $requete1->fetchAll();

    if(empty($movieExists)){

        $ext_autorisees = array('png', 'jpg', 'jpeg');

        $fichier1 = $_FILES['thumbnail'];
        $data_fichier1 = pathinfo($fichier1['name']);
        $ext_fichier1 = $data_fichier1['extension'];


        $fichier2 = $_FILES['poster'];
        $data_fichier2 = pathinfo($fichier2['name']);
        $ext_fichier2 = $data_fichier2['extension'];
            $fichier3 = $_FILES['header'];
            if($fichier3['name'] != "") {
                $data_fichier3 = pathinfo($fichier3['name']);
                $ext_fichier3 = $data_fichier3['extension'];
            }else {
            $fichier3 = null;
        }
        // vérifications du fichier
        if (($fichier1['size'] <= 8000000 && in_array($ext_fichier1, $ext_autorisees)) && ($fichier2['size'] <= 8000000 && in_array($ext_fichier2, $ext_autorisees)) && ($fichier2['size'] <= 8000000 && in_array($ext_fichier2, $ext_autorisees)))
        {
            // upload du fichier
            $target1 = "images/miniatures/". basename($fichier1['name']);
            $target2 = "images/posters/". basename($fichier2['name']);
            if($fichier3 != null){
                $target3 = "images/headers/".basename($fichier3['name']);
                $infosImg3 = getimagesize($fichier3['tmp_name']);
            }else {
                $target3 = null;
                $infosImg3 = null;
            }

            $infosImg1 = getimagesize($fichier1['tmp_name']);
            $infosImg2 = getimagesize($fichier2['tmp_name']);

            $isImage1Ok = true;
            $isImage2Ok = true;
            $isImage3Ok = true;
            

        if (($infosImg1[0] == 400) && ($infosImg1[1] == 225)) {
                move_uploaded_file($fichier1['tmp_name'], "../".$target1);
            
        }else {
                $error[0] = "Les dimensions de la miniature ne conviennent pas.";
                $isImage1Ok = false;
        }
            if (($infosImg2[0] == 900) && ($infosImg2[1] == 400)) {
                move_uploaded_file($fichier2['tmp_name'], "../".$target2);
        }else {
                $error[1] = "Les dimensions de l'affiche ne conviennent pas.";
                $isImage2Ok = false;
        }
        if (($infosImg3[0] == 2000) && ($infosImg3[1] == 500)) {
                move_uploaded_file($fichier3['tmp_name'], "../".$target3);
        }else if($infosImg3 != null) {
                $error[2] = "Les dimensions du header ne conviennent pas.";
                $isImage3Ok = false;

        }
    
        }



        if($isImage1Ok && $isImage2Ok && $isImage3Ok) {
            $requete2 = $db->prepare("insert into movie (titleMovie, summaryMovie, director, poster, header, thumbnail) values (:title,:summary,:director,:poster,:header,:thumbnail)");

            $requete2->bindParam(":title",$title);
            $requete2->bindParam(":summary",$summary);
            $requete2->bindParam(":director",$director);
            $requete2->bindParam(":poster",$target2);
            $requete2->bindParam(":header",$target3);
            $requete2->bindParam(":thumbnail",$target1);

            $requete2->execute();
        }

    }else {
        $error[3] = "Ce film est déjà présent dans la base de donnée.";
    }

    $error = utf8_encode(json_encode($error));
    echo $error;

}

?>
