
<?php

require_once 'cont_modifCompte.php';
require_once 'modele_modifCompte.php';
require_once 'vue.php';

class ModModifCompte{

    public $controlerr;
    public $modele;
    public $mod;
    public $vue;
    public function __construct(){
		$this->controlerr = new ContModifCompte();
        $this->modele = new ModeleModifCompte();
        $this->vue = new Vue();
        switch($this->controlerr->action){
            case "compte":
                $this->modele->modifCompte();
                $this->controlerr->form_modifCompte();
                break;
                case "annonce":
                 // $this->modele->modifAnnonce();
                  $this->controlerr->form_modifAnnonce();
                  break;
              case "deconnexion" :
                $this->controlerr->deconnexion();

        }
		
	}
}
 
?>
