<?php
namespace Core;

class Controller
{
    protected $connecter;
    protected $view_path=null;
    protected $template='index';

    

    public function render($view, $variable = []) {
        $this->view_path = ROOT . '/view/';
        ob_start();
        $this->views($view,$variable); // le laouy et Les variables 
        $content_template = ob_get_clean(); // Contenu dans la partie contrôleur
        $this->templates($content_template); // Ajouter les données issue de la partie contrôleur dans la vue
    }

    protected function views($view, $valiable = null) {
        
        extract($valiable);
        $file = $this->view_path. str_replace('.', '/', $view) . '.php';

        if (file_exists($file)) {
            require_once($file);
        } else {
            echo '<span class="col-md-12">';
            echo '<p>Zo Vous n\'avez pas mis le bon chemain "'.$file.'" </p>';
            echo '</span>';
            
        }
    }
    
    protected function templates($content_template) {
        $file = $this->view_path . 'templates/'. str_replace('.', '/', $this->template) . '.html';
        if (file_exists($file)) {
            require_once($file);
        } else {
            var_dump('Votre Layout n\'est pas encore pris en charge '. $file);
        }
    }

    public function setLayout($tamplate)
    {
        $this->template = $tamplate;

    }


}
