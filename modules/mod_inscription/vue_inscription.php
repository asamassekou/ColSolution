<?php
require_once 'connexion.php';
class VueInscription{
    function __construct() {

    }
	function form_inscription(){
        if(isset($_SESSION['idUtilisateur'])) {
            header('Location:index.php?module=compte&action=compte&idUtilisateur='. $_SESSION['idUtilisateur']);
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

	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/inscription.css">
	</HEAD>
	
	<BODY>
	
		<!-- en tête de page-->
		<p id="pp"> Vous recherchez un colocataire? Vous êtes au bon endroit </p> 

		<HEADER>
			<a href="index.php"> <img class="logo" src="images/COL.png" alt="Logo du site"/> </a>
            <form id="searchbar" method = "GET">
			<input id="searchbar" type="search" name="annonce" placeholder="Rechercher une annonce..." />
			</form>
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
			
				<a class="menuLink" href="index.php?module=inscription&action=inscription"> <img class="icons" src="images/icons/favicon.ico" alt=""/> Mon Compte </a>
			
			</nav>
		</NAV>		
		<!-- corps de page -->
		<MAIN>

        <h2> Inscription </h2>

        <form class="login100-form validate-form" method="POST" action="">
				<form class="login100-form validate-form">
                <div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
						<span class="label-input100">nom</span>
						<input class="input100" type="text" name="nom" value = "<?php if(isset($nom)) echo $nom  ?>" placeholder="Entrez votre nom">
						<span class="focus-input100"></span>
				</div>

                <div class="wrap-input100 validate-input m-b-26" data-validate="first name is required">
						<span class="label-input100">prenom</span>
						<input class="input100" type="text" name="prenom" value = "<?php if(isset($prenom)) echo $prenom  ?>" placeholder="Entrez votre prénom">
						<span class="focus-input100"></span>
					</div>

                    <div class="wrap-input100 validate-input m-b-26" data-validate="Age is required">
						<span class="label-input100">Age</span>
						<input class="input100" type="text" name="age"value = "<?php if(isset($age)) echo $age  ?>" placeholder="Entrez votre Age">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-26" data-validate="email is required">
						<span class="label-input100">email</span>
						<input class="input100" type="text" name="mail" value = "<?php if(isset($mail)) echo $mail  ?>" placeholder="Entrez votre email">
						<span class="focus-input100"></span>
					</div>
               
					<div class="wrap-input100 validate-input m-b-18" data-validate = "Password is required">
						<span class="label-input100">Mot de passe</span>
						<input class="input100" type="password" name="pwd" placeholder="Entrez un mot de passe">
						<span class="focus-input100"></span>
					</div>

                    <div class="wrap-input100 validate-input m-b-18" data-validate = "Password is required">
						<span class="label-input100">Confirmez votre mot de passe</span>
						<input class="input100" type="password" name="pwd2" placeholder="Entrez un mot de passe">
						<span class="focus-input100"></span>
					</div>

					<div class="flex-sb-m w-full p-b-30">
						<div class="contact100-form-checkbox">
							<input class="input-checkbox100" id="ckb1" type="checkbox" name="man">
							<label class="label-checkbox100" for="ckb1">
								homme
							</label>
    </br>
                            <input class="input-checkbox100" id="ckb2" type="checkbox" name="girl">
							<label class="label-checkbox100" for="ckb2">
								femme
							</label>
    </br>
				          <a href="index.php?module=form&action=connexion"> J'ai déjà un compte </a>
					</div>
    </div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" name = "inscription">
							Inscription
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>


		<!--<div class="container">
		<form >
			<div class="form-group">
				<label for="email"> Email </label>
				<input type="email" name="email" id="email" class="form-control" placeholder="">
			</div>

			<div class="form-group">
				<label for="email"> Email </label>
				<input type="email" name="email" id="email" class="form-control" placeholder="">
			</div>

			<div class="form-check">
				<input type="checkbox" name="email" id="email" class="form-control" placeholder="">
				<label for="email"> Email </label>

			</div>



		</form>

<div> -->






        
        <?php  if (isset($erreur)) {echo '<font color="red">'.$erreur."</font>";} ?>
                           
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