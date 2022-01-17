<?php
class VueModifCompte{

	public function __construct(){
		
	}

	function form_modifCompte(){
	?>  
<?php
if(!$_SESSION['email']) header('Location:../index.php?module=form&action=connexion');
if(isset($_GET['idUtilisateur']) AND $_GET['idUtilisateur'] > 0)
{
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

	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link href="css/modifCompte.css" rel="stylesheet" type="text/css" />
	
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
				<a class="menuLink" href="../index.php?module=message&action=message">  <img class="icons" src="../images/icons/messa.png" alt=""/>Messages </a>
			</nav>
			<nav id="Annonce">
				<a class="menuLink" href="../index.php?module=annonce&action=depotAnnonce"> <img class="icons" src="../images/icons/map-marker.png" alt=""/> Deposer Annonce </a>
                <a class="menuLink" href="../index.php?module=recherche&action=Users"> <img class="icons" src="../images/sr.png" alt=""/> Rechercher Annonce </a>				
            </nav>
			<nav id="menusCompte">
				<a class="menuLink" href="../index.php?module=form&action=deconnexion"> <img class="icons" src="../images/icons/favicon.ico" alt=""/> Deconnexion </a>
			</nav>
		</NAV>

        <MAIN>
        
            <h2> Modification de mon profil </h2>

            <form class="login100-form validate-form" method="POST" action="" enctype="multipart/form-data">
				<form class="login100-form validate-form">
					<div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
						<span class="label-input100">Nouveau mail</span>
						<input class="input100" type="text" name="maill" placeholder="<?php echo $_SESSION['email'] ;?>">
						<span class="focus-input100"></span>
					</div>

                    <div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
						<span class="label-input100">Numero de Telephone</span>
						<input class="input100" type="text" name="num" placeholder="<?php if(isset($num)) echo $_SESSION['NUMTEL'] ;?>">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-18" data-validate = "Password is required">
						<span class="label-input100">Nouveau mot de passe </span>
						<input class="input100" type="password" name="mdp" placeholder="mot de passe">
						<span class="focus-input100"></span>
					</div>

                    <div class="wrap-input100 validate-input m-b-18" data-validate = "Password is required">
						<span class="label-input100">Confirmation</span>
						<input class="input100" type="password" name="mdp2" placeholder="Confirmation de mot de passe">
						<span class="focus-input100"></span>
					</div>
                   
                </div>
                    <div class="wrap-input100 validate-input m-b-18" data-validate = "Message is required">
						<span class="label-input100">Description </span>
						<textarea id="mess" name="story"
                        rows="5" cols="77">
                        <?= $_SESSION['description'] ?>
                        </textarea>
						<span class="focus-input100"></span>
					</div>
                
                      <p> Ajouter une photo </p>
                    <div class="flex-sb-m w-full p-b-30">
						<div class="flex-sb-m w-full p-b-30">
							<input type="file" name="avatar" />		
					</div>
                    </div>
					<div class="container-login100-form-btn">
						<button class="login100-form-btn" name = "modif">
							Modifier
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	
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

function form_modifAnnonce(){
	?>  
<?php
if(!$_SESSION['email']) header('Location:../index.php?module=form&action=connexion');
if(isset($_GET['idUtilisateur']) AND !empty($_GET['idUtilisateur']) AND isset($_GET['idAnnonce']) AND !empty($_GET['idAnnonce']))
{
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

	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link href="css/modifCompte.css" rel="stylesheet" type="text/css" />
	
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
				<a class="menuLink" href="../index.php?module=message&action=message">  <img class="icons" src="../images/icons/messa.png" alt=""/>Messages </a>
			</nav>
			<nav id="Annonce">
				<a class="menuLink" href="../index.php?module=annonce&action=depotAnnonce"> <img class="icons" src="../images/icons/map-marker.png" alt=""/> Deposer Annonce </a>
                <a class="menuLink" href="../index.php?module=recherche&action=Users"> <img class="icons" src="../images/sr.png" alt=""/> Rechercher Annonce </a>				
            </nav>
			<nav id="menusCompte">
				<a class="menuLink" href="../index.php?module=form&action=deconnexion"> <img class="icons" src="../images/icons/favicon.ico" alt=""/> Deconnexion </a>
			</nav>
		</NAV>

        <MAIN>
        
            <h2> Modification de mon Annonce </h2>
			<form class="login100-form validate-form" method="POST" action="">
				<form class="login100-form validate-form">
                    <div class="wrap-input100 validate-input m-b-18" data-validate = "Message is required">
						<span class="label-input100">Nouvelle Description </span>
						<textarea id="mess" name="desAnnonce"
                        rows="5" cols="100">
                        <?= $_SESSION['description'] ?>
                        </textarea>
						<span class="focus-input100"></span>
					</div>			
					<p> A Proximité du domicile </p>
		

					<div class="flex-sb-m w-full p-b-30">
						<div class="contact100-form-checkbox">
							<input class="input-checkbox100" id="ckb1" type="checkbox" name="metro">
							<label class="label-checkbox100" for="ckb1">
								Metro
							</label>
   							 </br>
                            <input class="input-checkbox100" id="ckb2" type="checkbox" name="bus">
							<label class="label-checkbox100" for="ckb2">
								Bus
							</label>
    						</br>
							<input class="input-checkbox100" id="ckb3" type="checkbox" name="train">
								<label class="label-checkbox100" for="ckb3">
								Train
								</label>
							</br>
								<input class="input-checkbox100" id="ckb4" type="checkbox" name="tram">
								<label class="label-checkbox100" for="ckb4">
								Tram
								</label>
							</br>
							<input class="input-checkbox100" id="ckb5" type="checkbox" name="commerce">
							<label class="label-checkbox100" for="ckb5">
								Commerce
							</label>
					</div>
    </div>
	      
				<img id="mdf" src="../public/annonces/<?=$_GET['idAnnonce'];?>" alt=""/> 
                    <div class="flex-sb-m w-full p-b-30">
						<div class="flex-sb-m w-full p-b-30">
							<input type="file" name="annonce"  />	
					</div>
				</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" name = "modifAnnonce">
							Modifier
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	
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
}
?>