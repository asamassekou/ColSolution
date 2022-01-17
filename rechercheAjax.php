<?php

require_once 'connexion.php';

$co = new Connexion();
$bdd = $co->initConnexion();


if(isset($_GET['user'])) {
    $user =  $_GET['user'];

    $req = $bdd->query('SELECT * FROM Utilisateurs WHERE nom LIKE "%'.$user.'%" LIMIT 10');

    $req = $req->fetchAll();

    foreach($req as $r) {
    ?>
    <div style="width: 400px; background-color:rgb(108, 158, 187); margin-top:10px; margin-bottom:10px; border-bottom:2px solid #ccc">

     <a href="index.php?module=compte&action=compte&idUtilisateur=<?=$r['idUtilisateur']?>" style="text-decoration:none; color:black">   <?= $r['nom']. " " . $r['prenom'] ?> </a>
    </div>
    <?php

    }
}

//echo 'OK';
?>