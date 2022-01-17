<?php

require_once 'connexion.php';

class ModeleModifCompte {

	public function __construct(){
		
	}
function modifCompte() {
    if (isset($_POST['modif'])) 
    {
    $newmail = htmlspecialchars($_POST['maill']);
    $newmdp = sha1($_POST['mdp']);
    $newmdp2 = sha1($_POST['mdp2']);
    $des = htmlspecialchars($_POST['story']);
    $num = htmlspecialchars($_POST['num']);

    $co = new Connexion();
    $bdd = $co->initConnexion();
    $check = $bdd->prepare('SELECT * FROM Utilisateurs WHERE email = ?');
    $check->execute(array($newmail));
    $data = $check->fetch();
    $sql = $co->initConnexion();
    if((isset($_POST['maill']) AND !empty($_POST['maill']) AND $_POST['maill'] != $data['email'])) {
           
            $sql = ("UPDATE Utilisateurs SET email = ? WHERE idUtilisateur = ?");
            $req = $bdd->prepare($sql);
            $req->execute(array($newmail, $_SESSION['idUtilisateur']));
            $_SESSION['email'] = $newmail;
            header('Location:index.php?module=compte&action=compte&idUtilisateur='.$_SESSION['idUtilisateur']);
        }
        if((isset($_POST['story']) AND !empty($_POST['story']))) {
            $sql = ("UPDATE Utilisateurs SET description = ? WHERE idUtilisateur = ?");
            $req = $bdd->prepare($sql);
            $req->execute(array($des, $_SESSION['idUtilisateur']));
            $_SESSION['description'] = $des;
            header('Location:index.php?module=compte&action=compte&idUtilisateur='.$_SESSION['idUtilisateur']);

        }

        if((isset($_POST['num']) AND !empty($_POST['num']) AND $_POST['num'] != $data['NUMTEL'])) {
           
            $sql = ("UPDATE Utilisateurs SET NUMTEL = ? WHERE idUtilisateur = ?");
            $req = $bdd->prepare($sql);
            $req->execute(array($num, $_SESSION['idUtilisateur']));
            $_SESSION['NUMTEL'] = $num;
            header('Location:index.php?module=compte&action=compte&idUtilisateur='.$_SESSION['idUtilisateur']);
        }

        if((isset($_POST['mdp']) AND !empty($_POST['mdp']) AND isset($_POST['mdp2']) AND !empty($_POST['mdp2']))) {
    
            if ($mdp == $mdp2) 
            {
               
                $sql = ("UPDATE Utilisateurs SET mdp = ? WHERE idUtilisateur = ?");
                $req = $bdd->prepare($sql);
                $req->execute(array($newmdp, $_SESSION['idUtilisateur']));
                $_SESSION['mdp'] = $newmdp;
                header('Location:index.php?module=compte&action=compte&idUtilisateur='.$_SESSION['idUtilisateur']);
            }
            else 
            {
                $msg = "Vos deux mots de passe ne correspondent pas";
            }
        }

        if(isset($_FILES['avatar']) AND !empty($_FILES['avatar']['name']))
        {
            $tailleMax = 2097152;  // 2Mo
            $extensionsValides = array('jpg','jpeg','gif','png');
            if($_FILES['avatar']['size'] <= $tailleMax)
            {
                $extensionUpload = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 1)); //Ignore le premier caractere de la chaine et renvoie l'extension du fichier avec le point 
                if(in_array($extensionUpload,$extensionsValides))
                {
                    $chemin = "public/avatars/".$_SESSION['idUtilisateur']. "." .$extensionUpload;
                    $resultat = move_uploaded_file($_FILES['avatar']['tmp_name'], $chemin);
                    if($resultat)
                    {
                        $updateAvatar = $bdd->prepare("UPDATE Utilisateurs SET avatar = :avatar WHERE idUtilisateur = :idUtilisateur");
                        $updateAvatar->execute(array(
                            'avatar' => $_SESSION['idUtilisateur']. ".".$extensionUpload,
                            'idUtilisateur' => $_SESSION['idUtilisateur']
                        ));
                        $_SESSION['avatar'] = $_SESSION['idUtilisateur'].".".$extensionUpload ;
                        header('Location:index.php?module=compte&action=compte&idUtilisateur='.$_SESSION['idUtilisateur']);
                    }
                     else 
                    {
                        $msg = "Erreur durant l'imporation de votre photo" ;

                    }
                }
                else 
                {
                    $msg = "Votre photo de profil doit être au format jpg, jpeg, gif ou png" ;

                }


            }
            else 
            {
                $msg = "Votre photo de profil ne doit pas dépasser 2 Mo" ;

            }

        }


    }
}
}

?>