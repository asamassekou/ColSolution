<?php
class VueMessage {
	public function __construct(){
		
	}

	function form_message(){
	if(isset($_SESSION['idUtilisateur']) AND !empty($_SESSION['idUtilisateur'])){

        if (isset($_GET['annonce']) AND !empty($_GET['annonce'])){
           header('Location:index.php');
        }

        if(isset($_GET['destinataire']) AND !empty($_GET['destinataire'])){
            $destinataire = htmlspecialchars($_GET['destinataire']);
        }
        if(isset($_GET['objet']) AND !empty($_GET['objet'])){
            $objet = htmlspecialchars($_GET['objet']);
            if(substr($objet,0,3) != 'RE:')
            {
                $objet = "RE:".$objet;
            }
        } 
?>  

<!-- PAGE ACCUEIL COLSOLUTION -->
<HTML>
			<HEAD>
				<TITLE> Colsolution </TITLE>
				<META CHARSET="UTF-8">


	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
    <link href="css/message.css" rel="stylesheet" type="text/css" />

			</HEAD>
			
			<BODY>
			
				<!-- en tête de page-->
				</br>
				<p id="pp"> Vous recherchez un colocataire ? Vous êtes au bon endroit </p> 
				<HEADER>
					<a href="index.php"> <img class="logo" src="images/COL.png" alt="Logo du site"/> </a>
                    <form id="searchbar" method = "GET">
					<input id="searchbar" type="search" name="annonce" placeholder="Rechercher une annonce..." />
					</form>
                    <div style ="margin-top:20px">
					<div id="result"></div>
					</div>
					
                
				</HEADER>
				
				<!-- menu de navigation -->
				
				<NAV id="mainNav">
				
					<nav id="menusMessage">
					
						<a class="menuLink" href="index.php">  <img class="icons" src="images/icons/messa.png" alt=""/>Accueil</a>
					
					</nav>
					<nav id="Annonce">
					
						<a class="menuLink" href="index.php?module=message&action=reception"> <img class="icons" src="images/icons/map-marker.png" alt=""/>Boîte de réception </a>
						<a class="menuLink" href="index.php?module=message&action=envoie"> <img class="icons" src="images/sr.png" alt=""/>Message Envoyés</a>				
					
					</nav>
					
					<nav id="menusCompte">
					
						<a class="menuLink" href="index.php?module=inscription&action=inscription"> <img class="icons" src="images/icons/favicon.ico" alt=""/>Mon compte</a>
					</nav>
				</NAV>
				<!-- corps de page -->
				<MAIN>
					<SECTION>
					
						<ARTICLE>
						
							<h2 id="haha" >ENVOYE UN MESSAGE</h2>
							
                            <form class="login100-form validate-form" method="POST" action="">
				<form class="login100-form validate-form">
					<div class="wrap-input100 validate-input m-b-26" data-validate="Recipient is required">
						<span class="label-input100">Destinataire</span>
						<input class="input100" type="text" name="destinataire" value="<?php if(isset($destinataire)) echo $destinataire?>" >
						<span class="focus-input100"></span>
					</div>

                    <div class="wrap-input100 validate-input m-b-26" data-validate="Object is required">
						<span class="label-input100">Objet</span>
						<input class="input100" type="text" name="objet" placeholder="Entrez un objet"  <?php if(isset($objet)) echo 'value = "'.$objet.'"'; ?>>
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-18" data-validate = "Message is required">
						<span class="label-input100">Votre Message </span>
						<textarea id="mess" name="message"
                        rows="5" cols="77">
                        Votre message...
                        </textarea>
						<span class="focus-input100"></span>
					</div>

                    <div class="container-login100-form-btn">
						<button class="login100-form-btn" name = "envoie">
							Envoyé
						</button>
					</div>
							
							</div>

						</ARTICLE>
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

function form_reception(){
    if(isset($_SESSION['idUtilisateur']) AND !empty($_SESSION['idUtilisateur'])){
        if (isset($_GET['annonce']) AND !empty($_GET['annonce'])){
            header('Location:index.php');
         }
        $co = new Connexion();
        $bdd = $co->initConnexion();
        $msg = $bdd->prepare('SELECT * FROM Message WHERE idDestinataire = ? ORDER BY idMessage DESC');
        $msg->execute(array($_SESSION['idUtilisateur']));
        $nbreMessage = $msg->rowCount();
?>
    <!-- PAGE ACCUEIL COLSOLUTION -->
    <HTML>
                <HEAD>
                    <TITLE> Colsolution </TITLE>
                    <META CHARSET="UTF-8">
    
        <link rel="stylesheet" type="text/css" href="css/util.css">
        <link rel="stylesheet" type="text/css" href="css/main.css">
    <link href="css/message.css" rel="stylesheet" type="text/css" />
    
                </HEAD>
                
                <BODY>
                
                    <!-- en tête de page-->
                    </br>
                    <p id="pp"> Vous recherchez un colocataire ? Vous êtes au bon endroit </p> 
                    <HEADER>
                        <a href="index.php"> <img class="logo" src="images/COL.png" alt="Logo du site"/> </a>
                    <form id="searchbar" method = "GET">
					<input id="searchbar" type="search" name="annonce" placeholder="Rechercher une annonce..." />
					</form>
                    <div style ="margin-top:20px">
                        <div id="result"></div>
                        </div>
                        
                    
                    </HEADER>
                    
                    <!-- menu de navigation -->
                    
                    <NAV id="mainNav">
                    
                        <nav id="menusMessage">
                        
                            <a class="menuLink" href="index.php">  <img class="icons" src="images/icons/messa.png" alt=""/>Accueil</a>
                        
                        </nav>
                        <nav id="Annonce">
                        
                            <a class="menuLink" href="index.php?module=message&action=envoie"> <img class="icons" src="images/icons/map-marker.png" alt=""/>Message Envoyés</a>
                            <a class="menuLink" href="index.php?module=message&action=reception"> <img class="icons" src="images/sr.png" alt=""/>Nouveaux Messages</a>				
                        
                        </nav>
                        
                        <nav id="menusCompte">
                        
                            <a class="menuLink" href="index.php?module=inscription&action=inscription"> <img class="icons" src="images/icons/favicon.ico" alt=""/>Mon compte</a>
                        </nav>
                    </NAV>
                    <!-- corps de page -->
                    <MAIN>
                        <SECTION>
                        
                            <ARTICLE>
                            
                                <h2 id="haha" >BOITE DE RECEPTION</h2>
                                
                            <?php  
                            if($nbreMessage == 0) echo "Vous n'avez aucun message..."; 
                            ?>  <?php
                            while($m = $msg->fetch()) {
                                $co = new Connexion();
                                $bdd = $co->initConnexion(); 
                                $exp = $bdd->prepare('SELECT email FROM Utilisateurs WHERE idUtilisateur = ? ');
                                $exp->execute(array($m['idUtilisateur']));
                                $exp = $exp->fetch();
                                $exp = $exp['email'];
                                ?>

                            <div id = "rec" >
                            <div id="recAA">
                            <a href= "index.php?module=message&action=lecture&idMessage=<?= $m['idMessage']?>"> <b> <?= $exp ?> </b> vous a envoyé un message: <br />  </a>
                            </div>
                            <div id="recBB">
                            <a class="menuLink" href="index.php?module=message&action=lecture&idMessage=<?= $m['idMessage']?>">Consulter</a>
                            </div>
                            <div id="recC">
                            <a class="menuLink" id="sup" href="supprimerRecep.php?idMessage=<?= $m['idMessage']?>&token=<?= $_SESSION['token']?>">Supprimer</a>
                            </div>
                        </div>

                                <?php  } ?> 

                        <script src="js/jquery.js"></script> 
	                    <script src="ajax/scriptSupprimer.js"></script>
                        
                            </ARTICLE>
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
        $lu = $bdd->prepare('UPDATE Message SET lu = 1 WHERE idMessage = ?');
        $lu->execute(array($m['idMessage']));
    }
}
function form_mesEvois(){
    if(isset($_SESSION['idUtilisateur']) AND !empty($_SESSION['idUtilisateur'])){
        if (isset($_GET['annonce']) AND !empty($_GET['annonce'])){
            header('Location:index.php');
         }
        $co = new Connexion();
        $bdd = $co->initConnexion();
        $msg = $bdd->prepare('SELECT * FROM Message WHERE idUtilisateur = ? ORDER BY idMessage DESC');
        $msg->execute(array($_SESSION['idUtilisateur']));
        $nbreMessage = $msg->rowCount();
?>
    <!-- PAGE ACCUEIL COLSOLUTION -->
    <HTML>
                <HEAD>
                    <TITLE> Colsolution </TITLE>
                    <META CHARSET="UTF-8">
    
        <link rel="stylesheet" type="text/css" href="css/util.css">
        <link rel="stylesheet" type="text/css" href="css/main.css">
    <link href="css/message.css" rel="stylesheet" type="text/css" />
    
                </HEAD>
                
                <BODY>
                
                    <!-- en tête de page-->
                    </br>
                    <p id="pp"> Vous recherchez un colocataire ? Vous êtes au bon endroit </p> 
                    <HEADER>
                        <a href="index.php"> <img class="logo" src="images/COL.png" alt="Logo du site"/> </a>
                        <form id="searchbar" method = "GET">
					    <input id="searchbar" type="search" name="annonce" placeholder="Rechercher une annonce..." />
					    </form>
                     <div style ="margin-top:20px">
                        <div id="result"></div>
                        </div>
                        
                    
                    </HEADER>
                    
                    <!-- menu de navigation -->
                    
                    <NAV id="mainNav">
                    
                        <nav id="menusMessage">
                        
                            <a class="menuLink" href="index.php">  <img class="icons" src="images/icons/messa.png" alt=""/>Accueil</a>
                        
                        </nav>
                        <nav id="Annonce">
                        
                            <a class="menuLink" href="index.php?module=message&action=envoie"> <img class="icons" src="images/icons/map-marker.png" alt=""/>Message Envoyés</a>
                            <a class="menuLink" href="index.php?module=message&action=reception"> <img class="icons" src="images/sr.png" alt=""/>Nouveaux Messages</a>				
                        
                        </nav>
                        
                        <nav id="menusCompte">
                        
                            <a class="menuLink" href="index.php?module=inscription&action=inscription"> <img class="icons" src="images/icons/favicon.ico" alt=""/>Mon compte</a>
                        </nav>
                    </NAV>
                    <!-- corps de page -->
                    <MAIN>
                        <SECTION>
                        
                            <ARTICLE>
                            
                                <h2 id="haha" >MES ENVOIS</h2>
                                
                            <?php  
                            if($nbreMessage == 0) echo "Vous n'avez envoyé aucun message..."; 
                            ?>  <?php
                            while($m = $msg->fetch()) {
                                $co = new Connexion();
                                $bdd = $co->initConnexion(); 
                                $exp = $bdd->prepare('SELECT email FROM Utilisateurs WHERE idUtilisateur = ? ');
                                $exp->execute(array($m['idDestinataire']));
                                $exp = $exp->fetch();
                                $exp = $exp['email'];
                                ?>
                        <div id = "rec" >
                            <div id="recA">
                         <a href= "index.php?module=message&action=lecture&idMessage=<?= $m['idMessage']?>">  vous avez envoyé un message à <b> <?= $exp ?> </b> <br />  </a>
                            </div>
                            <div id="recB">
                            <a class="menuLink" id="sup" href="supprimerEnvoie.php?idMessage=<?= $m['idMessage']?>&token=<?= $_SESSION['token']?>">Supprimer</a>
                            </div>
                        </div>

                        <script src="js/jquery.js"></script> 
	                    <script src="ajax/scriptSupprimer.js"></script>


                                <?php  } ?> 
                            </ARTICLE>
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
        $lu = $bdd->prepare('UPDATE Message SET lu = 1 WHERE idMessage = ?');
        $lu->execute(array($m['idMessage']));
    }
}
function form_lecture(){
    if(isset($_SESSION['idUtilisateur']) AND !empty($_SESSION['idUtilisateur'])){
        if (isset($_GET['annonce']) AND !empty($_GET['annonce'])){
            header('Location:index.php');
         }
        if(isset($_GET['idMessage']) AND !empty($_GET['idMessage'])){
            $id_message = intval($_GET['idMessage']);
        $co = new Connexion();
        $bdd = $co->initConnexion();
        $msg = $bdd->prepare('SELECT * FROM Message WHERE idMessage = ? AND idDestinataire = ?');
        $msg->execute(array($_GET['idMessage'], $_SESSION['idUtilisateur']));
        $nbreMessageD = $msg->rowCount();

        $msgE = $bdd->prepare('SELECT * FROM Message WHERE idMessage = ? AND idUtilisateur = ?');
        $msgE->execute(array($_GET['idMessage'], $_SESSION['idUtilisateur']));

        $nbreMessageE = $msgE->rowCount();
        $m = $msg->fetch();
        $e = $msgE->fetch();
        $co = new Connexion();
            $bdd = $co->initConnexion(); 
            $exp = $bdd->prepare('SELECT * FROM Utilisateurs WHERE idUtilisateur = ? ');
            $exp->execute(array($m['idUtilisateur']));
            $exp2 = $exp->fetch();
            $exp = $exp2['email'];
        

?>
    <!-- PAGE ACCUEIL COLSOLUTION -->
    <HTML>
                <HEAD>
                    <TITLE> Colsolution </TITLE>
                    <META CHARSET="UTF-8">

        <link rel="stylesheet" type="text/css" href="css/util.css">
        <link rel="stylesheet" type="text/css" href="css/main.css">
        <link href="css/message.css" rel="stylesheet" type="text/css" />
    
                </HEAD>
                
                <BODY>
                
                    <!-- en tête de page-->
                    </br>
                    <p id="pp"> Vous recherchez un colocataire ? Vous êtes au bon endroit </p> 
                    <HEADER>
                        <a href="index.php"> <img class="logo" src="images/COL.png" alt="Logo du site"/> </a>
                        <form id="searchbar" method = "GET">
					    <input id="searchbar" type="search" name="annonce" placeholder="Rechercher une annonce..." />
					    </form>
                        <div style ="margin-top:20px">
                        <div id="result"></div>
                        </div>
                        
                    
                    </HEADER>
                    
                    <!-- menu de navigation -->
                    
                    <NAV id="mainNav">
                    
                        <nav id="menusMessage">
                        
                            <a class="menuLink" href="index.php">  <img class="icons" src="images/icons/messa.png" alt=""/>Accueil</a>
                        
                        </nav>
                        <nav id="Annonce">
                        
                            <a class="menuLink" href="index.php?module=message&action=supprimer&idMessage=<?=$m['idMessage']?>&token=<?=$_SESSION['token']?>"> <img class="icons" src="images/icons/map-marker.png" alt=""/>Supprimer</a>
                            <a class="menuLink" href="index.php?module=annonce&action=depotAnnonce"> <img class="icons" src="images/sr.png" alt=""/>Déposer une annonce</a>				
                        
                        </nav>
                        
                        <nav id="menusCompte">
                        
                            <a class="menuLink" href="index.php?module=inscription&action=inscription"> <img class="icons" src="images/icons/favicon.ico" alt=""/>Mon compte</a>
                        </nav>
                    </NAV>
                    <!-- corps de page -->
                    <MAIN>
                        <SECTION>
                        
                            <ARTICLE>
                          
                                <h2 id="haha" >BOITE DE RECEPTION</h2>
                                
                            <?php  
                            if($nbreMessageD == 0){ echo "ERROR";} 
                            else {
                            ?> 
                            <div id = "lec" >
                            <div id="photo">
                        <?php
                            if($exp2['avatar'] != null) { 
						?>
						<a href="index.php?module=compte&action=compte&idUtilisateur=<?=$exp2['idUtilisateur']?>"> <img id="imgDes" src="../public/avatars/<?php echo $exp2['avatar'];?>" alt="Photo de profil"/> </a>
						<?php	
						}
						?>
						<?php
						if($exp2['avatar'] == null){
						?>
							<a href="index.php?module=compte&action=compte&idUtilisateur=<?=$exp2['idUtilisateur']?>"> <img id="imgDes" src="../public/avatars/defaults/pp.png" alt="Photo de profil"/> </a>
						<?php
						}
						?>
                        </div>
                             <div id="message">
                                 <div class="mess">
                               Expéditeur : <b> <?= $exp ?> </b>  <br />
                    </div>
                    <div class="mess">
                               Objet : <?= $m['ObjetMessage'] ?> <br/>
                    </div>
                    <div class="mess">
                        <?= $m['ContenuMessage'] ?>  <br/>
                    <div>
                            </div>
                         <div id="btn_message">
                         <a class="menuLink" href="index.php?module=message&action=message&destinataire=<?=$exp?>&objet=<?=$m['ObjetMessage']?>">Répondre</a>
                        </div>
                            </div>
                                <?php  } ?> </div>
                            </ARTICLE>
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
}
}       

?>
