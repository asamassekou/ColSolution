<?php
require_once 'connexion.php';


class ModeleAnnonce extends Connexion{

    public function __construct(){
		
	}

    function annonce(){
        $co = new Connexion();
        $bdd = $co->initConnexion();

        if(isset($_POST['publier'])) {
        if(isset($_POST['titre'], $_POST['description'])) {
                if(isset($_POST['ville'], $_POST['quartier'], $_POST['rue'], $_POST['codePostal'])) {
                    if(!empty($_POST['titre']) AND !empty($_POST['superficie']) AND !empty($_POST['type']) AND !empty($_POST['nbChambre']) AND !empty($_POST['prix']) AND !empty($_POST['ville'])  AND !empty($_POST['quartier']) AND !empty($_POST['rue']) AND !empty($_POST['codePostal']) AND !empty($_POST['description'])){
                        $titre = htmlspecialchars($_POST['titre']);
                        $description = htmlspecialchars($_POST['description']);
                        $ville = htmlspecialchars($_POST['ville']);
                        $quartier = htmlspecialchars($_POST['quartier']);
                        $rue = htmlspecialchars($_POST['rue']);
                        $codePostal = htmlspecialchars($_POST['codePostal']);
                        $superficie = htmlspecialchars($_POST['superficie']);
                        $type = htmlspecialchars($_POST['type']);
                        $nbChambres = htmlspecialchars($_POST['nbChambre']);
                        $prix = htmlspecialchars($_POST['prix']);
                        
                        //date et heure de l'annonce
                        $date= date("Y-m-d");
                        $time=date("H:m");
                        $datetime=$date."T".$time;

                        //insertion localisation
                        $insLocalisation = $bdd->prepare('INSERT INTO Localisation(ville,quartier,rue,codePostal) VALUES (?,?,?,?)');
                        $insLocalisation->execute(array($ville,$quartier,$rue,$codePostal));

                        // selection de l'id de la localisation dans une variable
                        $idLocalisation = $bdd->prepare('SELECT idLocalisation FROM Localisation WHERE ville = ? ORDER BY idLocalisation DESC');
                        $idLocalisation->execute(array($ville));
                        $idLocalisation = $idLocalisation->fetch();
                        $idLocalisation = $idLocalisation['idLocalisation'];

                        // insertion du logement
                        $insLogement = $bdd->prepare('INSERT INTO Logement(superficie,type,nbChambre,prix,idLocalisation) VALUES (?,?,?,?,?)');
                        $insLogement->execute(array($superficie,$type,$nbChambres,$prix,$idLocalisation));


                        // selection de l'id du logement dans une variable
                        $idLogement = $bdd->prepare('SELECT idLogement FROM Logement WHERE idLocalisation = ? ');
                        $idLogement->execute(array($idLocalisation));
                        $idLogement = $idLogement->fetch();
                        $idLogement = $idLogement['idLogement'];

                        // insertion annonce
                        $insAnnonce = $bdd->prepare('INSERT INTO Annonce(titre,dateCreation,description,idUtilisateur,idLogement) VALUES (?,?,?,?,?)');
                        $insAnnonce->execute(array($titre,$datetime,$description,$_SESSION['idUtilisateur'],$idLogement));

                        // selection de l'id de l'Annonce dans une variable
                        $idAnnonce = $bdd->prepare('SELECT idAnnonce FROM Annonce WHERE idUtilisateur = ? ORDER BY idAnnonce DESC');
                        $idAnnonce->execute(array($_SESSION['idUtilisateur']));
                        $idAnnonce = $idAnnonce->fetch();
                        $idAnnonce = $idAnnonce['idAnnonce'];
                        $_SESSION['idAnnonce'] = $idAnnonce ;

                        // insertion image
                        $insImage = $bdd->prepare('INSERT INTO Image(idAnnonce) VALUES (?)');
                        $insImage->execute(array($idAnnonce));

                        // selection de l'id de l'image dans une variable
                        $idImage = $bdd->prepare('SELECT idImage FROM Image WHERE idAnnonce = ? ORDER BY idImage DESC');
                        $idImage->execute(array($idAnnonce));
                        $idImage = $idImage->fetch();
                        $idImage = $idImage['idImage'];
                        
                        $_SESSION['idImage'] = $idImage ;

                        // insertion idImage dans Annonce
                        $insidImage = $bdd->prepare('UPDATE Annonce SET idImage = ? WHERE idAnnonce = ?');
                        $insidImage->execute(array($idImage,$idAnnonce));


                        if(isset($_FILES['annonce']) AND !empty($_FILES['annonce']['name']))
                        {
                            $tailleMax = 2097152;  // 2Mo
                            $extensionsValides = array('jpg','jpeg','gif','png');
                            if($_FILES['annonce']['size'] <= $tailleMax)
                            {
                                $extensionUpload = strtolower(substr(strrchr($_FILES['annonce']['name'], '.'), 1)); //Ignore le premier caractere de la chaine et renvoie l'extension du fichier avec le point 
                                if(in_array($extensionUpload,$extensionsValides))
                                {
                                    $chemin = "public/annonces/".$_SESSION['idAnnonce']. "." .$extensionUpload;
                                    $resultat = move_uploaded_file($_FILES['annonce']['tmp_name'], $chemin);
                                    if($resultat)
                                    {
                                        $updateAvatar = $bdd->prepare("UPDATE Image SET nomImage = :nomImage WHERE idAnnonce = :idAnnonce");
                                        $updateAvatar->execute(array(
                                            'nomImage' => $_SESSION['idAnnonce']. ".".$extensionUpload,
                                            'idAnnonce' => $_SESSION['idAnnonce']
                                        ));
                                        $_SESSION['nomImage'] = $_SESSION['idAnnonce'].".".$extensionUpload ;
                                    // header('Location:index.php');
                                    }

                                }
                            }
                        }
                        header('Location:index.php');

                    }
                }    

            }
        }
    }


    
	/* CONSULTER ANNONCE */


	/*** récupère les informations d'une annonce : ***/

	// - dans la table annonce
	public function getInfoAnnonce($idAnnonce) {
		
		$co = new Connexion();
		$bdd = $co->initConnexion();

		$selectPrep = $bdd->prepare("select titre, description from Annonce where idAnnonce = ?");	
		$selectPrep->execute(array($idAnnonce));
		$tab = $selectPrep->fetchAll();

		return $tab;
	}

    	// - dans la table image
	public function getInfoImage($idAnnonce) {
		
		$co = new Connexion();
		$bdd = $co->initConnexion();

		$selectPrep = $bdd->prepare("SELECT nomImage from Image WHERE idAnnonce = ?");	
		$selectPrep->execute(array($idAnnonce));
		$tab = $selectPrep->fetchAll();

		return $tab;
	}

	// - dans la table Logement
	public function getInfoLogement($idAnnonce){

		$co = new Connexion();
		$bdd = $co->initConnexion();

		// On récupère l'idLogment depuis l'id de l'annonce que l'on consulte
		$idLogement = $this->getIdLogement($idAnnonce);

		$selectPrep = $bdd->prepare("select prix, type, superficie, nbChambre from Logement where idLogement = ?");	
		$selectPrep->execute(array($idLogement));
		$tab = $selectPrep->fetchAll();

		return $tab;
	}

	// - dans la table Localisation
	public function getInfoLocalisation($idAnnonce){
		$co = new Connexion();
		$bdd = $co->initConnexion();

		$idLocalisation = $this->getIdLocalisation($idAnnonce);

		$selectPrep = $bdd->prepare("select presMetro, presBus, presTrain, presTram, presCommerce from Localisation where idLocalisation = ?");	
		$selectPrep->execute(array($idLocalisation));
		$tab = $selectPrep->fetchAll();

		return $tab;
	}

	// - dans la table Utilisateur
	public function getInfoUser($idAnnonce){
		$co = new Connexion();
		$bdd = $co->initConnexion();

		$idUser = $this->getIdUser($idAnnonce);

		$selectPrep = $bdd->prepare("select prenom, NUMTEL from Utilisateurs where idUtilisateur = ?");	
		$selectPrep->execute(array($idUser));
		$tab = $selectPrep->fetchAll();

		return $tab;
	}

    	// - dans la table Commentaire
	public function getCommentaire($idAnnonce){
		$co = new Connexion();
		$bdd = $co->initConnexion();

		$idUser = $this->getIdUser($idAnnonce);

		//$selectPrep = $bdd->prepare("SELECT contenu FROM Commentaire WHERE idAnnonce = ?");	
		$selectPrep = $bdd->prepare("SELECT * FROM Commentaire natural join Utilisateurs WHERE Commentaire.idAnnonce = ?");	
		$selectPrep->execute(array($idAnnonce));
	//	$tab = $selectPrep->fetch();

		return $selectPrep;
	}

        	// - dans la table Users
	public function getInfoCommentaire($idAnnonce){
		$co = new Connexion();
		$bdd = $co->initConnexion();
		$a = $idAnnonce;
        $idUser = $this->getIdUserCom($a);

		$selectPrep = $bdd->prepare("SELECT * FROM Utilisateurs inner join Commentaire using(idCommentaire) WHERE Commentaire.idAnnonce = ? AND Utilisateurs.idUtilisateur = ?");	
		$selectPrep->execute(array($idAnnonce, $idUser));

		$tab = $selectPrep->fetch();

		return $tab;
	}



	//récupère l'idLogement a partir d'une annonce
	private function getIdLogement($idAnnonce){

		$co = new Connexion();
		$bdd = $co->initConnexion();

		$selectPrep = $bdd->prepare("select idLogement from Annonce where idAnnonce = ?");	
		$selectPrep->execute(array($idAnnonce));
		$tabResult = $selectPrep->fetch();
		$idLogement = $tabResult['idLogement'];
		return $idLogement;
	}

	//récupère l'idLocalisation a partir d'une annonce
	private function getIdLocalisation($idAnnonce){
		
		$co = new Connexion();
		$bdd = $co->initConnexion();

		$idLogement = $this->getIdLogement($idAnnonce);
		
		$selectPrep = $bdd->prepare("select idLocalisation from Logement where idLogement = ?");	
		$selectPrep->execute(array($idLogement));
		$tabResult = $selectPrep->fetch();
		$idLocalisation = $tabResult['idLocalisation'];
		return $idLocalisation;
	}
	
	//récupère l'idUser a partir d'une annonce
	private function getIdUser($idAnnonce){

		$co = new Connexion();
		$bdd = $co->initConnexion();

		$selectPrep = $bdd->prepare("select idUtilisateur from Annonce where idAnnonce = ?");	
		$selectPrep->execute(array($idAnnonce));
		$tabResult = $selectPrep->fetch();
		$idUtilisateur = $tabResult['idUtilisateur'];
		return $idUtilisateur;
	}

	private function getIdUserCom($idAnnonce){

		$co = new Connexion();
		$bdd = $co->initConnexion();

		$selectPrep = $bdd->prepare("select idUtilisateur from Commentaire where idAnnonce = ?  ");	
		$selectPrep->execute(array($idAnnonce));
		$tabResult = $selectPrep->fetch();
		$idUtilisateur = $tabResult['idUtilisateur'];  
		return $idUtilisateur;
	}

}
?>
