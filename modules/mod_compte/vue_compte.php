<?php
require_once 'connexion.php';
class VueCompte{

	public function __construct(){
		
	}

	function form_compte(){
	?>  
<?php
if(!$_SESSION['email'] ) header('Location:../index.php?module=form&action=connexion');
if(isset($_GET['idUtilisateur']) AND $_GET['idUtilisateur'] > 0)
{
	$co = new Connexion();
	$bdd = $co->initConnexion();
	$getid = intval($_GET['idUtilisateur']);
	$requser = $bdd->prepare('SELECT * FROM Utilisateurs WHERE idUtilisateur = ?');
	$requser->execute(array($getid));
	$userinfo = $requser->fetch();
	$signalement = $userinfo['email'];

if(isset($_GET['compte']) AND !empty($_GET['compte'])){
	$compte = htmlspecialchars($_GET['compte']);
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
		<link href="../css/compte.css" rel="stylesheet" type="text/css" />
	</HEAD>
	<BODY>


		<!-- en tête de page-->
		<p id="pp"> Vous recherchez un colocataire ? Vous êtes au bon endroit </p> 
		<HEADER>
			<a href="index.php"> <img class="logo" src="../images/COL.png" alt="Logo du site"/> </a>
            <form id="searchbar" method = "GET">
			<input id="searchbar" type="search" name="annonce" placeholder="Rechercher une annonce..." />
			</form>
		</HEADER>



		<!-- menu de navigation -->	

		<NAV id="mainNav">
			<nav id="menusMessage">
				<a class="menuLink" href="index.php?module=message&action=message"> <img class="icons" src="../images/icons/messa.png" alt=""/>Message</a>
				<?php
				if(isset($_SESSION['idUtilisateur']) ) {
					if($_GET['idUtilisateur'] == $_SESSION['idUtilisateur']){
						?>
					<a class="menuLink" href="index.php?&module=modif&action=compte&idUtilisateur=<?=$getid?>">  <img class="icons" src="../images/icons/messa.png" alt=""/>Modifier</a>  
				<?php
					}else {
				?>
					<a class="menuLink" href="index.php?&module=compte&action=signaler&compte=<?=$signalement?>">  <img class="icons" src="../images/icons/messa.png" alt=""/>Signaler</a>  
				<?php
				} }
				?>
			</nav>

			<nav id="Annonce">
				<a class="menuLink" href="index.php?module=annonce&action=depotAnnonce"> <img class="icons" src="../images/icons/map-marker.png" alt=""/> Deposer Annonce </a>
                <a class="menuLink" href="../index.php?module=recherche&action=Users" > <img class="icons" src="../images/sr.png" alt=""/> Rechercher Annonce </a>				
            </nav>

			<nav id="menusCompte">
			<?php
					if(isset($_SESSION['idUtilisateur'])) {
					if($_GET['idUtilisateur'] == $_SESSION['idUtilisateur']){
						?>
				<a class="menuLink" href="../index.php?module=form&action=deconnexion"> <img class="icons" src="../images/icons/favicon.ico" alt=""/>Deconnexion</a>
				<?php
					}else {
				?>
				<a class="menuLink" href="../index.php?module=compte&action=compte&idUtilisateur=<?=$_SESSION['idUtilisateur'] ?>"> <img class="icons" src="../images/icons/favicon.ico" alt=""/>Mon Compte</a>
				<?php
				}} else{ ?> <a class="menuLink" href="../index.php?module=compte&action=bannir&idUtilisateur=<?=$getid?>"> <img class="icons" src="../images/icons/favicon.ico" alt=""/>Bannir</a> <?php
				}
				?>
			</nav>
		</NAV>

        <MAIN>
			<SECTION>
				<ARTICLE>
					<div id="informations"> 
						<div id="photoProfil">
						<h2 id= "pt"> <?= $userinfo['nom'] ; ?> </h2>
						</div>
						<div id="ppImg" >
						<?php 
						if($userinfo['avatar'] != null) { 
						?>
						<a href="index.php?module=modif&action=compte&idUtilisateur=<?=$userinfo['idUtilisateur']?>"> <img class="an" src="../public/avatars/<?php echo $userinfo['avatar'];?>" alt="Photo de profil"/> </a>
						<?php	
						}
						?>
						<?php
						if($userinfo['avatar'] == null){
						?>
							<a href="index.php?module=modif&action=compte"> <img class="an" src="../public/avatars/defaults/pp.png" alt="Photo de profil"/> </a>
						<?php
						}
						?>
						</div>
                        <div id="info">
						<h2 id= "ptt"> INFORMATIONS </h2>
						<p>	<?php echo "Email : ". $userinfo['email'] ; ?> </p>
						<p>	<?php echo "Nom : ". $userinfo['nom'] ; ?> </p>
						<p>	<?php echo "Prenom : ". $userinfo['prenom'] ; ?> </p>
						<p>	<?php echo "Age : ". $userinfo['age'] ; ?> </p>
						<p>	<?php echo "Sexe : ". $userinfo['sexe'] ; ?> </p>
						<p>	<?php echo "Contact : ". $userinfo['NUMTEL'] ; ?> </p>
						</div>
					</div>

                    <div id="Description"> 
					<h2 id= "text"> DESCRIPTION </h2>
                        <p id="Desc" ><?php echo $userinfo['description']; ?> </p>
					</div>

					</ARTICLE>
			</SECTION>
</MAIN>
                    <!-- footer -->
		    <FOOTER>
			<a href="index.php"> <img src="../images/COL.png" alt="Logo du site"/> </a>
			<p> 2021 - COLSOLUTION - Creative Common Licence</p>
		    </FOOTER>
	</BODY>
</HTML>

<?php

	}
	}
function form_signaler() {

	if(isset($_GET['compte']) AND !empty($_GET['compte'])){
		$compte = htmlspecialchars($_GET['compte']);
	}
?>
	<!DOCTYPE html>

	<!-- PAGE ACCUEIL COLSOLUTION -->
	<HTML>
		<HEAD>
			<TITLE> Colsolution </TITLE>
			<META CHARSET="UTF-8">
			<link href="../css/util.css" rel="stylesheet" type="text/css" />
			<link href="../css/main.css" rel="stylesheet" type="text/css" />
			<link href="../css/compte.css" rel="stylesheet" type="text/css" />

		</HEAD>
		<BODY>
			<!-- en tête de page-->
			<p id="pp"> Vous recherchez un colocataire ? Vous êtes au bon endroit </p> 
			<HEADER>
				<a href="index.php"> <img class="logo" src="../images/COL.png" alt="Logo du site"/> </a>
				<input id="searchbar" type="text" name="annonce" placeholder="Rechercher une annonce..." />
			</HEADER>
			<!-- menu de navigation -->	
			<NAV id="mainNav">
				<nav id="menusMessage">
					<a class="menuLink" href="index.php?module=message&action=message"> <img class="icons" src="../images/icons/messa.png" alt=""/>Message</a>
						<a class="menuLink" href="index.php?&module=compte&action=compte">  <img class="icons" src="../images/icons/messa.png" alt=""/>users</a>  
				</nav>
				<nav id="Annonce">
					<a class="menuLink" href="index.php?module=annonce&action=depotAnnonce"> <img class="icons" src="../images/icons/map-marker.png" alt=""/> Deposer Annonce </a>
					<a class="menuLink" href="../index.php?module=recherche&action=Users" > <img class="icons" src="../images/sr.png" alt=""/> Rechercher Annonce </a>				
				</nav>
				<nav id="menusCompte">
					<a class="menuLink" href="../index.php?module=compte&action=compte&idUtilisateur=<?=$_SESSION['idUtilisateur'] ?>"> <img class="icons" src="../images/icons/favicon.ico" alt=""/>Mon Compte</a>
				
				</nav>
			</NAV>
	
			<MAIN>
				<SECTION>
					<ARTICLE>
						<h2> SIGNALEMENT </h2>
				 <form class="login100-form validate-form" method="POST" action="">
				<form class="login100-form validate-form">
                <div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
						<span class="label-input100">email</span>
						<input class="input100" type="text" name="signaler" value = "<?php if(isset($compte)) echo $compte ;?>">
						<span class="focus-input100"></span>
				</div>
				<div class="wrap-input100 validate-input m-b-18" data-validate = "Raison is required">
						<span class="label-input100">Raison de votre signalement</span>
						<textarea id="mess" name="raison"
                        rows="5" cols="77">
                        ...
                        </textarea>
						<span class="focus-input100"></span>
					</div>
					<div class="container-login100-form-btn">
						<button class="login100-form-btn" name = "confirmer">
							Confirmer
						</button>
					</div>		
</form>	
							</div>
					 	</ARTICLE>
				</SECTION>
	</MAIN>
						<!-- footer -->
				<FOOTER>
				<a href="index.php"> <img src="../images/COL.png" alt="Logo du site"/> </a>
				<p> 2021 - COLSOLUTION - Creative Common Licence</p>
				</FOOTER>
		</BODY>
	</HTML>

<?php
}
function form_admin(){
	?>  
<?php
if(!$_SESSION['email']) header('Location:../index.php?module=form&action=connexion');
if($_SESSION['email'] != "admin@admin.fr" ) header('Location:../index.php?module=form&action=connexion');
if(isset($_GET['idUtilisateur']) AND $_GET['idUtilisateur'] > 0)
{
	$co = new Connexion();
	$bdd = $co->initConnexion();
$getid = intval($_GET['idUtilisateur']);
$requser = $bdd->prepare('SELECT * FROM Utilisateurs WHERE idUtilisateur = ?');
$requser->execute(array($getid));
$userinfo = $requser->fetch();
$signalement = $userinfo['email'];
}
if(isset($_GET['compte']) AND !empty($_GET['compte'])){
	$compte = htmlspecialchars($_GET['compte']);
}
?>
<!DOCTYPE html>

<!-- PAGE ACCUEIL COLSOLUTION -->
<HTML>
	<HEAD>
		<TITLE> Colsolution </TITLE>
		<META CHARSET="UTF-8">
		<link href="../css/compte.css" rel="stylesheet" type="text/css" />
	</HEAD>
	<BODY>
		<!-- en tête de page-->
		<p id="pp"> Vous recherchez un colocataire ? Vous êtes au bon endroit </p> 
		<HEADER>
			<a href="index.php"> <img class="logo" src="../images/COL.png" alt="Logo du site"/> </a>
            <input id="searchbar" type="text" name="annonce" placeholder="Rechercher une annonce..." />
		</HEADER>
		<!-- menu de navigation -->	
		<NAV id="mainNav">
			<nav id="menusMessage">
				<a class="menulinkk" href="index.php?module=message&action=message"> <img class="icons" src="../images/icons/messa.png" alt=""/>Message</a>	
			</nav>
			<nav id="Annonce">
			<a class="menulinkk" href="index.php?&module=recherche&action=Users">  <img class="icons" src="../images/icons/messa.png" alt=""/>Utilisateurs</a>  
			<a class="menulinkk" href="index.php?&module=compte&action=signalement">  <img class="icons" src="../images/icons/messa.png" alt=""/>Signalement</a>  
            </nav>
			<nav id="menusCompte">
				<a class="menulinkk" href="../index.php?module=form&action=deconnexion"> <img class="icons" src="../images/icons/favicon.ico" alt=""/>Deconnexion</a>
			</nav>
		</NAV>

        <MAIN>
			<SECTION>
				<ARTICLE>
						<div id="adminpp">
						<h2 id= "ptA"> COMPTE ADMINISTRATEUR </h2>
						<p> Bienvenue dans le compte administrateur, vous pouvez désormais consulter les signalements bannir les utilisateurs ne respectant pas les règles </p>
							<a href="DepoAnnonce.php"> <img class="an" src="../public/avatars/defaults/pp.png" alt="Photo de profil"/> </a>
						</div>
						</ARTICLE>
			</SECTION>
</MAIN>
                    <!-- footer -->
		    <FOOTER>
			<a href="index.php"> <img src="../images/COL.png" alt="Logo du site"/> </a>
			<p> 2021 - COLSOLUTION - Creative Common Licence</p>
		    </FOOTER>
	</BODY>
</HTML>

<?php
	}
	function form_signalement(){
			
		$co = new Connexion();
		$bdd = $co->initConnexion();
		$s = $bdd->query('SELECT * FROM Signaler ORDER BY idSignalement DESC LIMIT 10');

	  if(!$_SESSION['email']) header('Location:../index.php?module=form&action=connexion');
	  if (isset($_GET['searc']) AND !empty($_GET['searc'])) {
		  $searc = htmlspecialchars($_GET['searc']);
		  $s = $bdd->query('SELECT * FROM Signaler Where raison LIKE "%'.$searc.'%" INNER JOIN Signaler using(idSignalement) ORDER BY idUtilisateur DESC ');
		  //$users = $users->fetchAll();
	  }
	  ?>
	  <!DOCTYPE html>
	  
	  <!-- PAGE ACCUEIL COLSOLUTION -->
	  
	  <HTML>
		  <HEAD>
			  <TITLE> Colsolution </TITLE>
			  <META CHARSET="UTF-8">
			  <link href="css/signaler.css" rel="stylesheet" type="text/css" />
		  </HEAD>
		  <BODY>
			  <!-- en tête de page-->
			  <p id="pp"> Vous recherchez un colocataire? Vous êtes au bon endroit </p> 
			  <HEADER>
				  <a href="index.php"> <img class="logo" src="images/COL.png" alt="Logo du site"/> </a>
				  <input id="searchbar" type="text" name="search" placeholder="Rechercher une annonce..." />
				  <!-- <input id="euh" type="submit" value="Valider" /> -->
		  
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
					  <a class="menuLink" href="index.php?module=compte&action=admin"> <img class="icons" src="images/icons/favicon.ico" alt=""/> Mon Compte </a>
				  </nav>
			  </NAV>
			  <!-- corps de page -->
			  <MAIN>
			  <form method = "GET">
			  <input  type="search" id ="searc" name="searc" placeholder="Recherche..." >
			  <input  type="submit" name="ok" value="Valider" >
			  </form>
			  <div style ="margin-top:20px">
				  <div id="result"></div>
			  </div>
				  <SECTION>
					  <?php
				
				 if($s->rowCount() > 0) {
					$verif = $bdd->prepare('SELECT idUtilisateur FROM Utilisateurs WHERE idUtilisateur = $s["idSignaler"]');
					  ?>
					  <h2> Signalements récentes </h2>
						  <?php while($info = $s->fetch()) {
						  ?>
	  						<div id="signalement">
							  <div id="liste_signalement">
								  <h3> L'utilisateur <a href="index.php?module=compte&action=compte&idUtilisateur=<?=$info['idSignaleur'];?>" >#<?=$info['idSignaleur']; ?> </a> a signaler l'utilisateur <a href="index.php?module=compte&action=compte&idUtilisateur=<?=$info['idSignaler'];?>" >#<?=$info['idSignaler']; ?> </a> </h3>
						  		</div>
								  <div id="ban">
								  <a class="menuLink" id="sup" href="index.php?module=compte&action=bannir&idSignalement=<?= $info['idSignaler'];?>?>">Bannir</a>
                            	</div>
							  </div>
						  <?php
						  } 
						  }else{
							?> <p> Aucun Signalement </p> <?php } ?>
				 
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