<?php

include_once 'vue_accueil.php';

include_once 'modele_accueil.php';

class ContAccueil{

    private $modele;
    private $vue;

    public function __construct() { 
        $modele = new ModeleAccueil();
        $vue = new VueAccueil();
    
    }

    function getCookie() {
        $this->modele->cookie();
    }
}


?>