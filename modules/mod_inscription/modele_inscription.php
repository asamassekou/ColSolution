<?php
require_once 'connexion.php';
Class ModeleInscription extends Connexion {

     function __construct() {

    }


    function inscription() {
        $co = new Connexion();
        $bdd = $co->initConnexion();

        if (isset($_POST['inscription'])) 
        {
            $nom = htmlspecialchars($_POST['nom']);
            $prenom = htmlspecialchars($_POST['prenom']);
            $mail = htmlspecialchars($_POST['mail']);
            $mdp = sha1($_POST['pwd']);
            $mdp2 = sha1($_POST['pwd2']);
            $age = htmlspecialchars($_POST['age']);
            if(!empty($_POST['nom']) AND !empty($_POST['prenom']) AND !empty($_POST['mail']) AND !empty($_POST['pwd']) AND !empty($_POST['pwd2']) AND !empty($_POST['age']))
            {
                $nomlength = strlen($nom);
                $prenomlength = strlen($prenom);
                echo "OK";

                if ($nomlength <= 30 AND $prenomlength <= 30)
                {
                    if(filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                        $check = $bdd->prepare('SELECT * FROM Utilisateurs WHERE email = ?');
			            $check->execute(array($mail));
			            $data = $check->fetch();
			            $row = $check->rowCount();
                    if($row == 0) 
                    {
                    if($mdp = $mdp2)
                    {
                        if (!empty($_POST['man']) AND empty($_POST['girl']))
                        {
                        $sexe = "homme";
                        $sql = $co->initConnexion();
                        $sql = ("INSERT  INTO Utilisateurs(nom,prenom,age,email,mdp,sexe) VALUES(?,?,?,?,?,?)"); 
                        $req = $bdd->prepare($sql);
                        $req->execute(array($nom,$prenom,$age,$mail,$mdp,$sexe));
                     
                        $_SESSION['idUtilisateur'] = $data['idUtilisateur'];
                        $_SESSION['email'] = $mail;
                        $_SESSION['nom'] = $nom;
                        $_SESSION['prenom'] = $prenom;
                        $_SESSION['age'] = $age;
                        $_SESSION['sexe'] = $sexe;
                        $_SESSION['NUMTEL'] = $data['NUMTEL'];
                        $_SESSION['avatar'] = $data['avatar'];
                        $_SESSION['description'] = $data['description'];
                        $erreur = "COMPTE CREER";
                        header("Location:index.php?module=form&action=connexion");   
                    }
                        else if (empty($_POST['man']) AND !empty($_POST['girl']))
                            {
                                $sexe = "femme";
                                $sql = $co->initConnexion();
                                $sql = ("INSERT INTO Utilisateurs(nom,prenom,age,email,mdp,sexe) VALUES(?,?,?,?,?,?)"); 
                                $req = $bdd->prepare($sql);
                                $req->execute(array($nom,$prenom,$age,$mail,$mdp,$sexe));
                                $_SESSION['idUtilisateur'] = $data['idUtilisateur'];
                                $_SESSION['email'] = $mail;
                                $_SESSION['nom'] = $nom;
                                $_SESSION['prenom'] = $prenom;
                                $_SESSION['age'] = $age;
                                $_SESSION['sexe'] = $sexe;
                                $_SESSION['NUMTEL'] = $data['NUMTEL'];
                                $_SESSION['avatar'] = $data['avatar'];
                                $_SESSION['description'] = $data['description'];
                                $erreur = "COMPTE CREER";
                                header("Location:index.php?module=form&action=connexion");                               }
                            else 
                            {
                                $erreur =  "Vous devez choisir un sexe";   
                            }

                    }else
                        {
                            $erreur =  "LES MOTS DE PASSES NE CORRESPONDENT PAS";
 
                        }
                    
                    }else {
                        $erreur =  "EMAIL EXISTE DEJA";

                    }  
                }else 
                    {
                        $erreur =  "EMAIL NON VALIDE";
                    }

            }else 
                {
                    $erreur = "NOM ET PRENOM NE DOIT PAS DEPASSER 250 CARACTERES";
                }

        }else
            {
                $erreur =  "TOUS LES CHAMPS DOIVENT ETRE COMPLETER";

            }

        }
    }

    function deconnexion(){
        session_start(); // demarrage de la session
        session_destroy(); // on détruit la/les session(s), soit si vous utilisez une autre session, utilisez de préférence le unset()
        header('Location:index.php'); // On redirige
        die();
	}

}
