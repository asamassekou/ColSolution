<?php

require_once 'modele_annonce.php';
require_once 'vue_annonce.php';
require_once 'mod_annonce.php';

class ContAnnonce{

    public $modele;
	public $vue;
	public $action;

	public function __construct(){
		$this->modele = new ModeleAnnonce();
		$this->vue = new VueAnnonce();
		if(isset($_GET['action'])){
			$this->action = $_GET['action'];
		}
		else{
			$this->action = "connexion";
		}
	}

	function form_depotAnnonce(){
		$this->vue->form_depotAnnonce();
	}

	function annonce(){
		$this->modele->annonce();
	}

	public function consulterAnnonce() {
		if(!isset($_SESSION['email'])) {header('Location:index.php?module=form&action=connexion');}
		if(isset($_GET['idAnnonce']) AND !empty($_GET['idAnnonce'])){
			$idAnnonce = intval($_GET['idAnnonce']);

			// INFO IMAGE
			$tabImage = $this->modele->getInfoImage($idAnnonce);
			$image = $tabImage[0]["nomImage"];

			// INFO ANNONCE
			$tabAnnonce = $this->modele->getInfoAnnonce($idAnnonce);			
			$titre = $tabAnnonce[0]["titre"];
			$desc = $tabAnnonce[0]["description"];

			// INFO COMMENTAIRE
			$commentaire = $this->modele->getCommentaire($idAnnonce);
		//	$avatar = $commentaire["avatar"];
			//$nomCom = $commentaire["nom"];
			//$prenomCom = $commentaire["prenom"];
			//$prenomCom = $commentaire["contenu"];

			
			// INFO LOGEMENT
			$tabLogement = $this->modele->getInfoLogement($idAnnonce);

			$prix = $tabLogement[0]["prix"];
			$type = $tabLogement[0]["type"];
			$superficie = $tabLogement[0]["superficie"];
			$nbChambre = $tabLogement[0]["nbChambre"];

			// INFO LOCALISATION
			$tabLocalisation = $this->modele->getInfoLocalisation($idAnnonce);

			$metro = $tabLocalisation[0]["presMetro"] == 1 ? "oui" : "non";
			$bus = $tabLocalisation[0]["presBus"] == 1 ? "oui" : "non";
			$train = $tabLocalisation[0]["presTrain"] == 1 ? "oui" : "non";
			$tram = $tabLocalisation[0]["presTram"] == 1 ? "oui" : "non";
			$commerce = $tabLocalisation[0]["presCommerce"] == 1 ? "oui" : "non";

			// INFO USER
			$tabUser = $this->modele->getInfoUser($idAnnonce);

			$prenom = $tabUser[0]["prenom"];
			$num = $tabUser[0]["NUMTEL"];

				// INFO USER COM
				$tabUserCom = $this->modele->getInfoCommentaire($idAnnonce);
			//	$avatar = $tabUserCom["avatar"];
				//$nomCom = $tabUserCom["nom"];
				//$prenomCom = $tabUserCom["prenom"];

        	$this->vue->consulterAnnonce($idAnnonce, $titre, $desc, $prix, $type, $superficie, $nbChambre, $metro, $bus, $train, $tram, $commerce, $prenom, $num, $image,$commentaire);
		}
    }

}

    ?>