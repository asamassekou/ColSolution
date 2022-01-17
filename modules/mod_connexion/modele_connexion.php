<?php
session_start();
require_once 'connexion.php';


class ModeleConnexion extends Connexion{

    public function __construct(){
		
	}

function connexion(){
		$a = new Connexion();
		$bdd = $a->initConnexion();
		if (isset($_POST['submit'])) {
			
			if(!empty($_POST['email']) AND !empty($_POST['pass']))
			{	
				$adminMAIL = "admin@admin.fr" ;
				$adminPASS = sha1("admin");
				$email = htmlspecialchars($_POST['email']);
				$pass = sha1($_POST['pass']);
				$check = $bdd->prepare("SELECT * FROM Utilisateurs WHERE email = ? AND mdp = ?");
				$check->execute(array($email,$pass));
				$row = $check->rowCount();
				$data = $check->fetch();

				if($email == $adminMAIL AND $pass == $adminPASS) {
					$_SESSION['email'] = $adminMAIL;
					$_SESSION['mdp'] = $adminPASS;
					header("Location:index.php?module=compte&action=admin");
				} 
				
			else {

			if ($row > 0)
			{
				if(filter_var($email, FILTER_VALIDATE_EMAIL))
				{
					if(isset($_POST['remember'])) {
						$cookie = new connexion();
						$cookie ->cookies();
						setcookie('email',$email,time() + 365*24*3600,null,null,false,true);
						setcookie('pass',$pass,time() + 365*24*3600,null,null,false,true);
					}
					$_SESSION['idUtilisateur'] = $data['idUtilisateur'];
					$_SESSION['nom'] = $data['nom'];
					$_SESSION['prenom'] = $data['prenom'];
					$_SESSION['age'] = $data['age'];
					$_SESSION['email'] = $data['email'];
					$_SESSION['sexe'] = $data['sexe'];
					$_SESSION['NUMTEL'] = $data['NUMTEL'];
					$_SESSION['avatar'] = $data['avatar'];
					$_SESSION['description'] = $data['description'];
					$_SESSION['idCommentaire'] = null;

					//création de token 
					unset($_SESSION['jeton']);
					$_SESSION['token'] = md5(bin2hex(openssl_random_pseudo_bytes(6)));

					//redirection compte
					header("Location:index.php?module=compte&action=compte&idUtilisateur=".$_SESSION['idUtilisateur']);	 
				} 
			}
			else 
			{			
				header('Location:index.php?module=inscription&action=inscription'); 			
			}
		}
			}
	}
	}

	function deconnexion(){
        session_start(); // demarrage de la session
		setcookie('email','',time()-3600);
		setcookie('pass','',time()-3600);
		session_destroy(); // on détruit la/les session(s)
        header('Location:index.php'); // On redirige
        die();
	}

}

?>