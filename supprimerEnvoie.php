<?php
require_once 'connexion.php';

$co = new Connexion();
$bdd = $co->initConnexion();

    if(isset($_GET['idMessage']) AND !empty($_GET['idMessage']) AND $_GET['jeton'] == $_SESSION['jeton']) {
            $id_message = intval($_GET['idMessage']);
            $msg = $bdd->prepare('DELETE FROM Message WHERE idMessage = ? AND idUtilisateur = ?');
            $msg->execute(array($id_message, $_SESSION['idUtilisateur']));
            header('Location:index.php?module=message&action=envoie');
    }