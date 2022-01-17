<?php

require_once 'cont_compte.php';
require_once 'modele_compte.php';
require_once 'vue.php';

class ModCompte{

    public $controlerr;
    public $modele;
    public $mod;
    public $vue;
    public function __construct(){
		$this->controlerr = new ContCompte();
        $this->modele = new ModeleCompte();
        $this->vue = new Vue();
        switch($this->controlerr->action){
            case "compte":
                $this->controlerr->form_compte();
                break;
            case "admin":
                  $this->controlerr->form_admin();
                  break;
            case "signaler":
                   $this->controlerr->signaler();
                   $this->controlerr->form_signaler();
                   break;  
            case "signalement":
                    $this->controlerr->form_signalement();
                    break;
            case "bannir":
                    $this->controlerr->bannir();
                    break;
            case "deconnexion" :
                $this->controlerr->deconnexion();
            default:
                    break;
        }
		
	}
}
 
?>
