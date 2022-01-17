
<?php

require_once 'cont_message.php';
require_once 'modele_message.php';
require_once 'mod_message.php';
require_once 'vue_message.php';

class ModMessage{

    public $controleurrr;
    public $modele;
    public $mod;
    public $vue;
    public function __construct(){
		$this->controleurrr = new ContMessage();
        $this->modele = new ModeleMessage();
        $this->vue = new VueMessage();
        switch($this->controleurrr->action){
            case "message": // Envoyer des messages 
              $this->controleurrr->message();
              $this->controleurrr->form_message();
                break;
            case "lecture" : // Page affichant un message au complet 
                $this->controleurrr->form_lecture();
                break;
            case "reception" : // Page contenant tous les messages reçu 
                $this->controleurrr->form_reception();
                break;
            case "envoie" : // Page contenant tous les messages reçu 
                $this->controleurrr->form_envoie();
                break;
            case "supprimer" : // Supprimer un message 
                $this->controleurrr->supprimer();
                break;
            default :
             break;
        }
		
	}
}
 
?>
