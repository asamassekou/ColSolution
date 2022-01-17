<?php 
require_once 'modele_accueil.php';
class VueAccueil {

	public function __construct() {
		$modele = new ModeleAccueil();
		$modele->cookie();
		$this->affichage();
	}

	public function affichage() {
	
		$co = new Connexion();
		$bdd = $co->initConnexion();
		$annonce = $bdd->query('SELECT * FROM Annonce ORDER BY idAnnonce DESC LIMIT 4');
		//$annonce = $bdd->query('SELECT * FROM Annonce natural join Image WHERE Annonce.idImage=Image.idImage ORDER BY idAnnonce DESC LIMIT 4');

		$images = $bdd->query('SELECT * FROM Image natural join Annonce WHERE Image.idAnnonce=Annonce.idAnnonce ORDER BY idImage DESC');		

		if (isset($_GET['annonce']) AND !empty($_GET['annonce'])) {
			$search = htmlspecialchars($_GET['annonce']);
			$annonce = $bdd->query('SELECT * FROM Annonce Where titre LIKE "%'.$search.'%" ORDER BY idAnnonce DESC LIMIT 4 ');
	
			$images = $bdd->query('SELECT * FROM Image inner join Annonce using(idAnnonce) WHERE Annonce.titre LIKE "%'.$search.'%" ORDER BY idAnnonce DESC LIMIT 4');		

		}

		if(isset($_GET['rec']) AND !empty($_GET['rec'])) {
			//$rec = $bdd->query('SELECT * FROM Localisation inner join Logement using(idLogement) inner join Annonce using(idAnnonce)')
			$annonce = $bdd->query('SELECT * FROM Annonce Where titre LIKE "%'.$rec.'%" ORDER BY idAnnonce DESC LIMIT 4 ');
	
			$images = $bdd->query('SELECT * FROM Image inner join Annonce using(idAnnonce) WHERE Annonce.titre LIKE "%'.$rec.'%" ORDER BY idAnnonce DESC LIMIT 4');		

		}


		?>
		
		<!-- PAGE ACCUEIL COLSOLUTION -->
		<HTML>
			<HEAD>
				<TITLE> Colsolution </TITLE>
				<META CHARSET="UTF-8">
			<!--	<link href="vendor/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />-->
				<link href="css/accueil.css" rel="stylesheet" type="text/css" />

			</HEAD>
		

			<BODY>

				<!-- en tête de page-->
				</br>
				<p id="pp"> Vous recherchez un colocataire ? Vous êtes au bon endroit </p> 
				<HEADER>
					<a href="index.php"> <img class="logo" src="images/COL.png" alt="Logo du site"/> </a>
					<form id="searchbar" method = "GET">
					<input id="searchbar" type="search" name="annonce" placeholder="Rechercher une annonce ..." />
					</form>
					<form method="POST">
				<div id = "menu">
				<h2>FILTRES</h2>
				<div class="button_Composant" >
					<div id="b1">
					<a class="cb" id="cb1" href="index.php?module=recherche&action=zone">ZONE</a>
					<input class="input-checkbox100" id="ckb1" type="checkbox" name="appt">
							<label class="appt" for="appt" >
								appartement
							</label>
							<input class="maison" id="maison" type="checkbox" name="maison">
							<label class="maison" for="maison" >
								Maison
							</label>
					</div>
					<div id="b2">
					<a class="cb" id="cb2" href="index.php?rec=true">Proximité</a>
					<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember">
							<label class="label-checkbox100" for="ckb1" >
								bus
							</label>
							<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember">
							<label class="label-checkbox100" for="ckb1" >
								metro
							</label>
							<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember">
							<label class="label-checkbox100" for="ckb1" >
								train
							</label>	
				</div>
				<input type="button" class ="cb" id="filtreBtn" name="valider" value="Confirmer"/>

				</div>
				</div>
				</form>
				</HEADER>
				
				<!-- menu de navigation -->
				
				<NAV id="mainNav">
				
					<nav id="menusMessage">
					
						<a class="menuLink" href="index.php?module=message&action=message">  <img class="icons" src="images/icons/messa.png" alt=""/>Messages </a>
					
					</nav>
					<nav id="Annonce">
					
						<a class="menuLink" href="index.php?module=annonce&&action=depotAnnonce"> <img class="icons" src="images/icons/map-marker.png" alt=""/> Deposer Annonce </a>
						<a class="menuLink" href="index.php?module=recherche&action=Users"> <img class="icons" src="images/sr.png" alt=""/> Utilisateurs </a>				
					</nav>
					<nav id="menusCompte">
					
						<a class="menuLink" href="index.php?module=inscription&action=inscription"> <img class="icons" src="images/icons/favicon.ico" alt=""/> Mon Compte </a>
					</nav>
				</NAV>

		


				<!-- corps de page -->
				<MAIN>
					<SECTION>
					
						<ARTICLE>
							<?php
						if (empty($_GET['annonce'])) { ?>
							<h2> DERNIERES ANNONCES </h2>
						<?php } else {?> <h2> RESULTAT POUR "<?= $search ?>" </h2> 
					<?php
							}if($annonce->rowCount() > 0) {
                ?>
                    <?php while($annonces = $annonce->fetch() AND $image = $images->fetch()) {
                    ?>
				 <div id="an1">
						<div id="an1_pic"> 
							<?php
							if($image['nomImage'] == null ) { ?>
						<a href="index.php?module=annonce&action=consultAnnonce&idAnnonce=<?= $annonces['idAnnonce']; ?>"> <img class="an" src="images/annoncee.png" alt="annonce"/> </a>
							<?php } ?>
						<?php
						if($image['nomImage'] != null ) { ?>
							<a href="index.php?module=annonce&action=consultAnnonce&idAnnonce=<?= $annonces['idAnnonce']; ?>"> <img class="an" src="../public/annonces/<?php echo $image['nomImage'];?>" alt="annonce"/> </a>
							<?php } ?>
						</div>
                        <div id="an1_text">
							<h3><?= $annonces['titre']; ?> </h3>
							<p> <?= $annonces['description']; ?> </p> <a href="index.php?module=annonce&action=depotAnnonce" >  </a>
						</div>
					</div>
                    <?php
					} }?>
						</ARTICLE>
					</SECTION>
				</MAIN>


				<!-- footer -->
				<FOOTER> 				
					<a href="index.php"> <img src="images/COL.png" alt="Logo du site"/> </a>				
					<p id ="fp" > 2021 - COLSOLUTION - Creative Common Licence </p>;

				<?php
					if(!isset($_COOKIE['accepter'])) {
				?>
					<div class = "banniere">
							 <div class = "text_banniere">
							 <p> Bienvenue sur COLSOLUTION, notre site utilise des cookies pour une meilleure expérience </p>
							 </div>
							<div class="button_banniere" >
								<a id="tb" href="index.php?cookie=accepter">Tout accepter et continuer</a> 
							</div>
							</div>
					<?php
					 }
					 ?>
				
				</FOOTER> 
			</BODY>
		</HTML>

<?php
	}
}
?>