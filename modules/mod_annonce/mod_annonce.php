<?php

require_once 'cont_annonce.php';
require_once 'modele_annonce.php';
require_once 'mod_annonce.php';
require_once 'vue.php';

class ModAnnonce{

    public $controleur;
    public $modele;
    public $mod;
    public $vue;
    public function __construct(){
		$this->controleur = new ContAnnonce();
        $this->modele = new ModeleAnnonce();
        $this->vue = new Vue();
        switch($this->controleur->action){
            case "depotAnnonce":
              $this->modele->annonce();
              $this->controleur->form_depotAnnonce();
                break;
            case "consultAnnonce":
              $this->controleur->consulterAnnonce();
              break;
        }
	}
}
 
?>
