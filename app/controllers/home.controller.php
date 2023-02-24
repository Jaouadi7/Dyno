<?php

class Home extends Controller {

    public function __construct ( ) {

    } 

    public function index ( ) {

        // LOAD USER MODEL
        $user =  $this->load_model( 'user' );

        print_r ( $user->get_all( ) );

        // LOAD VIEW PAGE
        $this->view( 'home' );
        
    }

}
