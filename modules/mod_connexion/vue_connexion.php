<?php
class VueConnexion{

	function form_connexion(){
		if(isset($_SESSION['idUtilisateur'])) {
            header('Location:index.php?module=compte&action=compte&idUtilisateur='.$_SESSION['idUtilisateur']);
        }
		if (isset($_GET['annonce']) AND !empty($_GET['annonce'])){
			header('Location:index.php');
		 }
?>  

<!DOCTYPE html>
<html lang="en">
<head>
	<title>COLSOLUTION</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/connexion.css">
</head>
	</br>
	</br>
<p id="pp"> Bienvenue sur COLSOLUTION </p>
<body>
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
			
				<a class="menuLink" href="index.php?module=form&action=connexion"> <img class="icons" src="images/icons/favicon.ico" alt=""/> Mon Compte </a>
			
			</nav>
		</NAV>		
		<!-- corps de page -->
		<MAIN>
			<h2> CONNEXION </h2>
				<form class="login100-form validate-form" method="POST" action="">
				<form class="login100-form validate-form">
					<div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
						<span class="label-input100">email</span>
						<input class="input100" type="text" name="email" placeholder="Enter email">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-18" data-validate = "Password is required">
						<span class="label-input100">Password</span>
						<input class="input100" type="password" name="pass" placeholder="Enter password">
						<span class="focus-input100"></span>
					</div>

					<div class="flex-sb-m w-full p-b-30">
						<div class="contact100-form-checkbox">
							<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember">
							<label class="label-checkbox100" for="ckb1" >
								Remember me
							</label>
					</div>
						<div>
							<a href="#" class="txt1">
								Forgot Password?
							</a>
						</div>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" name = "submit">
							Connexion
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	
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