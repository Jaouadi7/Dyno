<?php 

// PREVENT THE ACCESS FROM THE USER BROWSER
defined('BASEPATH') OR exit('Access Denied!');

Class Controller {

    public function __construct ( ) {

    }

    public function view ( $path, $data = [] ) {


        // CHECK IF THE PATH OF THE VIEW IS EXISTS IN VIEWS FOLDER
        if ( file_exists( '../app/views/'  . THEME_TEMPLATE_DIR . strtolower($path) . '.view.php' ) ) {
            
            require_once  '../app/views/'  . THEME_TEMPLATE_DIR  . strtolower($path)  . '.view.php';

        } else {

            // SHOW 404 ERROR PAGE
            require_once  '../app/views/'. THEME_TEMPLATE_DIR . '404.view.php';

        }

    }

    public function view_layout ( $path, $data = [ ] ) {

        // CHECK IF THE PATH OF THE VIEW IS EXISTS IN VIEWS FOLDER
        if ( file_exists( '../app/views/layout/'  . THEME_TEMPLATE_DIR . strtolower($path) . '.layout.php' ) ) {
            
            require_once  '../app/views/layout'  . THEME_TEMPLATE_DIR  . strtolower($path)  . '.layout.php';

        } else {

            // SHOW 404 ERROR MESSAGE
            echo 'The ' . $path . 'file not found please check again!';

        }
        
    }

    public function load_model ( $model ) {


        // CHECK IF THE PATH OF THE MODAL IS EXISTS IN MODALS FOLDER
        if ( file_exists( '../app/models/' . strtolower($model)  . '.model.php' ) ) {
            
            require_once  '../app/models/' . strtolower($model)  . '.model.php';
            return $mod = new $model( ); 
        }

        return false;
    }

}