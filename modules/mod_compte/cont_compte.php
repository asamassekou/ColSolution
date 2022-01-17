<?php

require_once 'modele_compte.php';
require_once 'vue_compte.php';
require_once 'mod_compte.php';

class ContCompte{

    public $modele;
	public $vue;
	public $action;

	public function __construct(){
		$this->modele = new ModeleCompte();
		$this->vue = new VueCompte();
		if(isset($_GET['action'])){
			$this->action = $_GET['action'];
		}
		else{
			$this->action = "connexion";
		}
	}

    
	function form_compte(){
		$this->vue->form_compte();
	}

	function form_admin(){
		$this->vue->form_admin();
	}

	function form_signalement(){
		$this->vue->form_signalement();
	}

	function form_signaler(){
		$this->vue->form_signaler();
	}

	function signaler(){
		$this->modele->signaler();
	}

	function bannir(){
		$this->modele->bannir();
	}
}

?>