<?php

// APPLICATION CLASS
Class Application  {

    // DEFAULT
    protected $controller = 'home'; 
    protected $method = 'index';
    protected $params;

    public function __construct ( ) {

        $this->loadController( );

    }

    private function loadController ( ) {

        $url = $this->parseURL( );

        // CHECK URL CONTROLLER IF EXISTS IN CONTROLLERS FOLDER
        if ( file_exists( '../app/controllers/' . strtolower( $url[0] ) . '.controller.php' ) ) {
                        
            $this->controller = strtolower( $url[0] );
            unset( $url[0] );

        } else {

            // 404 NOT FOUND
            $this->controller = '_404';

        }

        require_once '../app/controllers/' . $this->controller . '.controller.php';
        $this->controller = new $this->controller;

        // CHECK URL METHOD
        if ( isset( $url[1] ) ) {

            // CHECK URL METHOD FUNCTION IF SET IN CONTROLLER CLASS
            if ( method_exists( $this->controller, strtolower( $url[1] ) )) {
 
                $this->method = strtolower( $url[1] );
                unset( $url[1] );

            } 

        } 

        // CHECK IF URL ARRAY IF NOT EMPTY
        $this->params = ( count( $url ) > 0  ) ? $url : ['home'];

        call_user_func_array([$this->controller, $this->method], $this->params );

    }

    // WE START ALL APPLICATION LOGIC FROM HERE $_GET REQUEST ON .htaccess 
    private function parseURL ( ) {

        // CHECK AND CLEAN URL
        $url = isset( $_GET['url'] ) ? $_GET['url'] : 'home';
        return explode( '/', filter_var( trim($url, '/' ), FILTER_SANITIZE_URL ) );

    }

}