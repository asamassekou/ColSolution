<?php

require_once 'connexion.php';
class ModeleAccueil{


    public function __construct() { 
    
    }
    function cookie() {
        if(isset($_GET['cookie'])) { 
       $cookie = new Connexion();
       $cookie -> cookies();
        }
    }
}

?>