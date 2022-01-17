
<?php

require_once 'cont_connexion.php';

require_once 'modele_connexion.php';
require_once 'mod_connexion.php';
require_once 'vue.php';

class ModConnexion{

    public $controleurr;
    public $modele;
    public $mod;
    public $vue;
    
    public function __construct(){
		    $this->controleurr = new ContConnexion();
        $this->modele = new ModeleConnexion();
        $this->vue = new Vue();
        switch($this->controleurr->action){
            case "connexion":
              $this->controleurr->connexion();
              $this->controleurr->form_connexion();
                break;
              case "deconnexion" :
                $this->controleurr->deconnexion();
        }
		
	}
}
 
?>
