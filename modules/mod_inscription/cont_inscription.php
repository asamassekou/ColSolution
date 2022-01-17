<?php

require_once 'modele_inscription.php';
require_once 'vue_inscription.php';
require_once 'mod_inscription.php';

class ContInscription{

    public $modele;
	public $vue;
	public $action;

	public function __construct(){
		$this->modele = new ModeleInscription();
		$this->vue = new VueInscription();
		if(isset($_GET['action'])){
			$this->action = $_GET['action'];
		}
		else{
			$this->action = "connexion";
		}
	}


	function form_inscription(){
		$this->vue->form_inscription();
	}

	function inscription(){
		$this->modele->inscription();
	}
	function deconnexion(){
		$this->modele->deconnexion();
	}

}

?>