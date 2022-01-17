<?php
require_once 'connexion.php';

$co = new Connexion();
$bdd = $co->initConnexion();

    if(isset($_GET['idMessage']) AND !empty($_GET['idMessage']) AND isset($_SESSION['token']) AND !empty($_SESSION['token'])) {
            $id_message = intval($_GET['idMessage']);
            $msg = $bdd->prepare('DELETE FROM Message WHERE idMessage = ? AND idDestinataire = ?');
            $msg->execute(array($id_message, $_SESSION['idUtilisateur']));
            header('Location:index.php?module=message&action=reception');
    }