<?php

require_once 'modele_modifCompte.php';
require_once 'vue_modifCompte.php';
require_once 'mod_modifCompte.php';

class ContModifCompte{

    public $modele;
	public $vue;
	public $action;

	public function __construct(){
		$this->modele = new ModeleModifCompte();
		$this->vue = new VueModifCompte();
		if(isset($_GET['action'])){
			$this->action = $_GET['action'];
		}
		else{
			$this->action = "connexion";
		}
	}

    
	function form_modifCompte(){
		$this->vue->form_modifCompte();
	}

	function form_modifAnnonce(){
		$this->vue->form_modifAnnonce();
	}

}

?>