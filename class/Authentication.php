<?php

class Authentication {

    private $session;
    private $options = [
        'restiction_msg' => "Cette zone est interdite"
    ];

    public function __construct($session){
        $this->session = $session;
    }

    /**
     * Cree une nouvelle variable session auth 
     * @param $user
     */
    public function connect($user){
        $this->session->set('auth',$user);
    }

    public function connectAdmin($user){
        $this->session->set('auth', $user);
        $this->session->set('admin',$user);
    }

    /**
     * restreint l'utilisateur si la session auth n'existe pas
     * @param $url
     */
    public function restrict($url){
        if($this->session->get('auth') == null){
            header("Location : $url");
            exit();
        }
    }

    /**
     * permet de s'enregistrer sur le site
     * 
     * @param $db
     * @param $pseudo
     * @param $nom
     * @param $prenom
     * @param $mdp
     * @param $mdpVerif
     * @param $email
     * 
     * @return boolean
     */
    public function register($db,$pseudo,$nom,$prenom,$mdp,$mdpVerif,$email){

        $requete = $db->prepare("SELECT idClient FROM client WHERE emailClient = :email");
        $requete->bindParam('email', $_POST['email'], PDO::PARAM_STR_CHAR);
        $requete->execute();

        $existingEmail = $requete->fetchObject();

        if ($mdp == $mdpVerif && $existingEmail == null) {

            //hashage du mot de passe
            $hashMdp = password_hash($_POST['mdp'], PASSWORD_DEFAULT);

            $pseudo = htmlentities($pseudo);
            $nom = htmlentities($nom);
            $prenom = htmlentities($prenom);
            $email = htmlentities($email);

            $requete = $db->prepare("INSERT INTO client (nickNameClient,nameClient,firstNameClient,pwdClient,emailClient) VALUES (:pseudo,:nom,:prenom,:mdp,:email)");
            $requete->bindParam(':pseudo',$pseudo);
            $requete->bindParam(':nom',$nom);
            $requete->bindParam(':prenom',$prenom);
            $requete->bindParam(':mdp',$hashMdp);
            $requete->bindParam(':email',$email);

            $requete->execute();

            $connexion = $this->login($db, $_POST['email'], $_POST['mdp']);
            header("Location:.");
            return $connexion;
        }
        return false;
    }

    /**
     * permet de se connecter en tant que client simple
     * @param $db
     * @param $mail
     * @param $pwd
     */
    public function login($db,$mail,$pwd){

        $this->loginAdmin($db,$mail,$pwd);

        $client = null;
        
        $requete = $db->prepare("SELECT * FROM Client WHERE emailClient = :mail");
        $requete->bindParam('mail', $mail, PDO::PARAM_STR,50);
        $requete->execute();

        $client = $requete->fetchObject();

        if($client != null ){
            if(password_verify($pwd,$client->pwdClient)){
                $this->connect($client);
                return true;
            }else 
                return false;
        }
        return false;
    }

    /**
     * Permet de se connecter en tant qu'admin
     * @param $db
     * @param $mail
     * @param $pwd
     */
    public function loginAdmin($db,$mail,$pwd){
        $admin = null;
        
        $requete = $db->prepare("SELECT Client.* FROM Client INNER JOIN Admin USING(idClient) WHERE emailClient = :mail");
        $requete->bindParam('mail', $mail);
        $requete->execute();

        $admin = $requete->fetchObject();

        if($admin != null ){
            if(password_verify($pwd,$admin->pwdClient)){
                $this->connectAdmin($admin);
                return true;
            }else 
                return false;
        }
        return false;
    }

    /**
     * Déconnecte l'utilisateur
     * @param $url
     */
    public function logout($url){
       $this->session->delete('auth');
       $this->session->delete('admin');
       header("Location:$url");
       exit();
    }
}