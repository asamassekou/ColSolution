<?php
    require_once 'modules/mod_connexion/modele_connexion.php';
class Connexion {
	static protected $bdd;

	static function initConnexion(){
		$dns="mysql:host=database-etudiants.iut.univ-paris8.fr;dbname=dutinfopw201628";
		$user="dutinfopw201628";
		$password="bumuqasy";
		$bdd = new PDO($dns, $user, $password);
        return $bdd;
	}
	
	static function cookies() {
            setcookie('accepter',true,time() + 365*24*3600);
            header('Location:./'); 
    }

	static function token() {
		if (!isset($_SESSION['jeton'])) {
		   $_SESSION['jeton'] = bin2hex(openssl_random_pseudo_bytes(6));
		}	
	}
}

?>
