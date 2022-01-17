<?php
require_once 'modules/mod_recherches/modele_recherche.php';
require_once 'connexion.php';
class VueRecherche{

	public function __construct(){
		
	}
   
 
	function form_recherche(){
			
  $co = new Connexion();
  $bdd = $co->initConnexion();
  $users = $bdd->query('SELECT * FROM Utilisateurs ORDER BY idUtilisateur DESC LIMIT 10');
if(!$_SESSION['email']) header('Location:../index.php?module=form&action=connexion');
if (isset($_GET['searc']) AND !empty($_GET['searc'])) {
    $searc = htmlspecialchars($_GET['searc']);
	$users = $bdd->query('SELECT * FROM Utilisateurs Where nom LIKE "%'.$searc.'%" ORDER BY idUtilisateur DESC ');
	//$users = $users->fetchAll();
}
if (isset($_GET['annonce']) AND !empty($_GET['annonce'])){
	header('Location:index.php');
 }
?>
<!DOCTYPE html>

<!-- PAGE ACCUEIL COLSOLUTION -->

<HTML>
	<HEAD>
		<TITLE> Colsolution </TITLE>
		<META CHARSET="UTF-8">
		<link href="css/recherche.css" rel="stylesheet" type="text/css" />
	</HEAD>
	<BODY>
		<!-- en tête de page-->
		<p id="pp"> Vous recherchez un colocataire? Vous êtes au bon endroit </p> 
		<HEADER>
			<a href="index.php"> <img class="logo" src="images/COL.png" alt="Logo du site"/> </a>
			<form id="searchbar" method = "GET">
			<input id="searchbar" type="search" name="annonce" placeholder="Rechercher une annonce..." />
			</form>
	
		</HEADER>
		
		<!-- menu de navigation -->
		
		<NAV id="mainNav">
			<nav id="menusMessage">
				<a class="menuLink" href="index.php?module=message&action=message">  <img class="icons" src="images/icons/messa.png" alt=""/>Messages </a>
			</nav>
			<nav id="Annonce">			
				<a class="menuLink" href="index.php?module=annonce&action=depotAnnonce"> <img class="icons" src="images/icons/map-marker.png" alt=""/> Deposer Annonce </a>
                <a class="menuLink" href="index.php?module=recherche&action=Users"> <img class="icons" src="images/sr.png" alt=""/> Rechercher Annonce </a>				
            </nav>
			<nav id="menusCompte">
				<a class="menuLink" href="index.php?module=form&action=connexion"> <img class="icons" src="images/icons/favicon.ico" alt=""/> Mon Compte </a>
			</nav>
		</NAV>
		<!-- corps de page -->
		<MAIN>
        <form method = "GET">
        <input  type="text" id ="searc" name="searc" placeholder="Rechercher un utilisateur..." >
	    <input  type="submit" name="ok" value="Valider" >

		<div style ="margin-top:20px">
			<div id="result"></div>
		</div>

        </form>
	
			<SECTION>
                <?php
           if($users->rowCount() > 0) {
                ?>
				<h2> Utilisateurs </h2>

                    <?php while($user = $users->fetch()) {
                    ?>
				 <div id="liste"> 
						<div id="liste_pic">
						<?php if($user['avatar'] != NULL) {?>
							<a href="index.php?module=compte&action=compte&idUtilisateur=<?=$user['idUtilisateur']; ?>" > <img class="an" src="public/avatars/<?=$user['avatar'] ;?>" alt="photo de profil"/> </a>
						<?php } if($user['avatar'] == NULL) { ?> <a href="index.php?module=compte&action=compte&idUtilisateur=<?=$user['idUtilisateur']; ?>" > <img class="an" src="public/avatars/defaults/pp.png" alt="photo de profil"/> </a>
						<?php } ?>
						</div>
                        <div id="liste_text">
							<h3>@<?= $user['nom']; ?> </h3>
							<p> <?= $user['description']; ?> </p> <a href="index.php?module=compte&action=compte&idUtilisateur=<?=$user['idUtilisateur'] ; ?>" >  </a>
						</div>
					</div>
                    <?php
					} }?>
           
		   	<script src="js/jquery.js"></script> 
			<script src="ajax/scriptRecherche.js"></script>
             
					
			</SECTION>
		</MAIN>


		<!-- footer -->
		<FOOTER>
			<a href="index.php"> <img src="images/COL.png" alt="Logo du site"/> </a>
			<p> 2021 - COLSOLUTION - Creative Common Licence</p>
		</FOOTER>

	</BODY>
</HTML>
<?php
	}

	function form_rechercheZone(){
			
		$co = new Connexion();
		$bdd = $co->initConnexion();
		$zones = $bdd->query("SELECT * FROM Annonce natural join Logement natural join Localisation Where Localisation.ville = 'paris'");
	  if(!$_SESSION['email']) header('Location:../index.php?module=form&action=connexion');
	  if (isset($_GET['zone']) AND !empty($_GET['zone'])) {
		  $zoneV = htmlspecialchars($_GET['zone']);
		  $zones = $bdd->query('SELECT * FROM Annonce natural join Logement natural join Localisation Where Localisation.ville LIKE "%'.$zoneV.'%" ORDER BY idLocalisation DESC' );
	  }
	  ?>
	  <!DOCTYPE html>
	  
	  <!-- PAGE ACCUEIL COLSOLUTION -->
	  
	  <HTML>
		  <HEAD>
			  <TITLE> Colsolution </TITLE>
			  <META CHARSET="UTF-8">
			  <link href="css/recherche.css" rel="stylesheet" type="text/css" />
		  </HEAD>
		  <BODY>
			  <!-- en tête de page-->
			  <p id="pp"> Vous recherchez un colocataire? Vous êtes au bon endroit </p> 
			  <HEADER>
				  <a href="index.php"> <img class="logo" src="images/COL.png" alt="Logo du site"/> </a>
				  <input id="searchbar" type="text" name="search" placeholder="Recherche..." />
		  
			  </HEADER>
			  
			  <!-- menu de navigation -->
			  
			  <NAV id="mainNav">
				  <nav id="menusMessage">
					  <a class="menuLink" href="index.php?module=message&action=message">  <img class="icons" src="images/icons/messa.png" alt=""/>Messages </a>
				  </nav>
				  <nav id="Annonce">			
					  <a class="menuLink" href="index.php?module=annonce&action=depotAnnonce"> <img class="icons" src="images/icons/map-marker.png" alt=""/> Deposer Annonce </a>
					  <a class="menuLink" href="index.php?module=recherche&action=Users"> <img class="icons" src="images/sr.png" alt=""/> Rechercher Annonce </a>				
				  </nav>
				  <nav id="menusCompte">
					  <a class="menuLink" href="index.php?module=form&action=connexion"> <img class="icons" src="images/icons/favicon.ico" alt=""/> Mon Compte </a>
				  </nav>
			  </NAV>
			  <!-- corps de page -->
			  <MAIN>
			  <form method = "GET">
			  <input  type="search" id ="zone" name="zone" placeholder="Recherche..." >
			  <input  type="submit" name="ok" value="Valider" >
			  </form>
			  <div style ="margin-top:20px">
				  <div id="result"></div>
			  </div>
				  <SECTION>
					  <?php
				 if($zones->rowCount() > 0) {
					 
					  if(empty($_GET['zone'])){
					  ?>
					  <h2> ANNONCES SUR PARIS </h2>
					  <?php }if(!empty($_GET['zone'])) {?> <h2> ANNONCES SUR <?= $zoneV ; }?> </h2>
						  <?php
						   while($zone = $zones->fetch()) {
						  ?>
				 <div id="liste"> 
						<div id="liste_pic">
						<a href="DepoAnnonce.php"> <img class="an" src="images/annoncee.png" alt="annonce"/> </a>
						</div>
                        <div id="liste_text">
							<h3><?= $zone['titre']; ?> </h3>
							<p> <?= $zone['description']; ?> </p> <a href="index.php?module=annonce&action=depotAnnonce" >  </a>
						</div>
					</div>
                    <?php
					} } 
					?>
					<div id="carte" style="width:300px; height:300px"></div>
					<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false&language=fr">
				  </SECTION>
			  </MAIN>
			  <!-- footer -->
			  <FOOTER>
				  <a href="index.php"> <img src="images/COL.png" alt="Logo du site"/> </a>
				  <p> 2021 - COLSOLUTION - Creative Common Licence</p>
			  </FOOTER>
	  
		  </BODY>
	  </HTML>
	  <?php
		  }
	  
	  }


?>
 /* */