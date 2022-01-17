<?php

require_once 'connexion.php';

class ModeleCompte {

	public function __construct(){
		
	}

	function signaler() {
		if(isset($_POST['confirmer'])) {
			if(!empty($_POST['raison']) AND !empty($_POST['signaler'])) {
				$raison = htmlspecialchars($_POST['raison']);
				$email = htmlspecialchars($_POST['signaler']);
					$co = new Connexion();
					$bdd = $co->initConnexion();
					$check = $bdd->prepare("SELECT * FROM Utilisateurs WHERE email = ? ");
					$check->execute(array($email));
					$check = $check->fetch();
					$idSignaler = $check['idUtilisateur'];
					$sql = $co->initConnexion();
					$ins = $sql->prepare("INSERT INTO Signaler (idSignaleur, idSignaler, raison) VALUES (?,?,?)");
					$ins->execute(array($_SESSION['idUtilisateur'],$idSignaler,$raison));
					?>
					<script type="text/javascript">
					alert("Merci d'avoir signaler <?= $email ?>");
					</script>
					<?php
			}
		}
	}

	function bannir() {
		if(isset($_GET['idSignalement'])){
		$idSignaler = htmlspecialchars($_GET['idSignalement']);
		$co = new Connexion();
		$bdd = $co->initConnexion();
		$del = $bdd->prepare("DELETE FROM Utilisateurs WHERE idUtilisateur = ? ");
		$del->execute(array($idSignaler));
		?>
					<script type="text/javascript">
					alert("Vous venez de Bannir l'utilisateur #<?= $idSignaler ?>");
					</script>
		<?php
		}
		header("Location:index.php?module=compte&action=signalement");
	}
}


?>