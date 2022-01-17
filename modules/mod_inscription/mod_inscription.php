
<?php

require_once 'cont_inscription.php';
require_once 'modele_inscription.php';
require_once 'mod_inscription.php';
require_once 'vue.php';

class ModInscription{

    public $controleurr;
    public $modele;
    public $mod;
    public $vue;
    public function __construct(){
		$this->controleurr = new ContInscription();
        $this->modele = new ModeleInscription();
        $this->vue = new Vue();
        switch($this->controleurr->action){
            case "inscription":
              $this->controleurr->inscription();
              $this->controleurr->form_inscription();
                break;
              case "deconnexion" :
                $this->controleurr->deconnexion();
               // header('Location:index.php');


        }
		
	}
}
 
?>
