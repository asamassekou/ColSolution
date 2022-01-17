<?php

require_once 'modele_recherche.php';
require_once 'vue_recherche.php';
require_once 'mod_recherche.php';

class ContRecherche{

    public $modele;
	public $vue;
	public $action;
	public $ok;

	public function __construct(){
		$this->modele = new ModeleRecherche();
		$this->vue = new VueRecherche();

		if(isset($_GET['action'])){
			$this->action = $_GET['action'];
		}
		else{
			$this->action = "connexion";
		}

		if(isset($_GET['ok'])){
			$this->ok = $_GET['ok'];
		}
	}

    
	function form_compte(){
		$this->vue->form_recherche();
	}

	function form_zone(){
		$this->vue->form_rechercheZone();
	}
}

?>