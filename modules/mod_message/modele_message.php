<?php
require_once 'connexion.php';


class ModeleMessage extends Connexion{

    public function __construct(){
		
	}

function message(){
	$co = new Connexion();
    $bdd = $co->initConnexion();
    
    if(isset($_POST['envoie'])) {
        if(isset($_POST['destinataire'], $_POST['message'], $_POST['objet']) AND !empty($_POST['destinataire']) AND !empty($_POST['message']) AND !empty($_POST['objet'])) {
            $destinataire = htmlspecialchars($_POST['destinataire']);
            $message = htmlspecialchars($_POST['message']);
            $objet = htmlspecialchars($_POST['objet']);

            $idDes = $bdd->prepare('SELECT idUtilisateur FROM Utilisateurs WHERE email = ?');
            $idDes->execute(array($destinataire));
            $idDes = $idDes->fetch();
            $idDes = $idDes['idUtilisateur'];

            $ins = $bdd->prepare('INSERT INTO Message(idUtilisateur,ObjetMessage,ContenuMessage,idDestinataire) VALUES (?,?,?,?)');
            $ins->execute(array($_SESSION['idUtilisateur'],$objet,$message,$idDes));
            ?>
            <script type="text/javascript">
            alert("Message envoyé");
            </script>
            <?php

        }
    }
}

function reception(){
	$co = new Connexion();
    $bdd = $co->initConnexion();
    
  $msg = $bdd->prepare('SELECT * FROM Message WHERE idDestinataire = ?');
  $msg->execute(array($_SESSION['idUtilisateur']));
}

function supprimer() {
    $co = new Connexion();
    $bdd = $co->initConnexion();
    
    if(isset($_SESSION['idUtilisateur']) AND !empty($_SESSION['idUtilisateur']) AND $_GET['jeton'] == $_SESSION['jeton']){

        if(isset($_GET['idMessage']) AND !empty($_GET['idMessage'])) {
                $id_message = intval($_GET['idMessage']);
                $msg = $bdd->prepare('DELETE * FROM Message WHERE idMessage = ? AND idDestinataire = ?');
                $msg->execute(array($_GET['idMessage'], $_SESSION['idDestinataire']));

        header('Location:index.php?module=message&action=envoie');


        }
    }

}


}

?>