<?php

require_once 'connexion.php';

class ModeleRecherche extends Connexion{
    public $row ;
  // public $fetch ;
	public function __construct(){
		$this->row = 0;
	}

	function getUtilisateurs(){
		$laPreparation = self::$bdd->prepare('SELECT * FROM Utilisateurs');
		$laPreparation->execute();
		$testFetch = $laPreparation->fetchAll();
		return $testFetch;
	}
    function getRecherche() {
        $co = new Connexion();
        $bdd = $co->initConnexion();
        $users = $bdd->query('SELECT * FROM Utilisateurs ORDER BY idUtilisateur DESC LIMIT 10');
      if(!$_SESSION['email']) header('Location:../index.php?module=form&action=connexion');
      if (isset($_GET['searc']) AND !empty($_GET['searc'])) {
          $searc = htmlspecialchars($_GET['searc']);
          $users = $bdd->query('SELECT * FROM Utilisateurs Where nom LIKE "%'.$searc.'%" ORDER BY idUtilisateur DESC ');
      }       
    }

 function getRowCount() {
        $co = new Connexion();
        $bdd = $co->initConnexion();
        if (isset($_GET['searc']) AND !empty($_GET['searc'])) {
        $searc = htmlspecialchars($_GET['searc']);
        $users = $bdd->prepare('SELECT * FROM Utilisateurs Where nom LIKE "%'.$searc.'%" ORDER BY idUtilisateur DESC ');
        $users->execute();
        $row = $users->rowCount();
        return $row ;
        }

 }

function getfetch() {
        $co = new Connexion();
        $bdd = $co->initConnexion();
        if (isset($_GET['searc']) AND !empty($_GET['searc'])) {
        $searc = htmlspecialchars($_GET['searc']);
        $users = $bdd->query('SELECT * FROM Utilisateurs Where nom LIKE "%'.$searc.'%" ORDER BY idUtilisateur DESC LIMIT 10');
       // $users->execute();
        $fetch = $users->fetch();
        return $fetch;
        }
    }

    function recherche() {
        $co = new Connexion();
		$bdd = $co->initConnexion();
        $users = $bdd->query('SELECT * FROM Utilisateurs ORDER BY idUtilisateur DESC');

       
        if (isset($_GET['searc']) AND !empty($_GET['searc'])) {
            $searc = htmlspecialchars($_GET['searc']);
            $users = $bdd->query('SELECT email FROM Utilisateurs Where email LIKE "%'.$searc.'%" ORDER BY idUtilisateur DESC');
            
            
            ?>

                <form method = "GET">
                <input id="searchbar" type="search" name="searc" placeholder="Recherche..." />
			    <input id="euh" type="submit" value="Valider" />
                </form>
            <?php
            if($users->rowCount() > 0) {
                ?>
                <ul>
                    <?php while ($a = $users->fetch()) {
                    ?>
                    <li> <?= $a['email'] ?> </li>
                    <?php } ?>
                </ul>
                    <?php } else { ?>
                    Aucun Résultat...
                    <?php } 
            } 
            
        }
}

?>