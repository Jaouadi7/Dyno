<?php

// NAMESPACE
namespace Controller;

// PREVENT THE ACCESS FROM THE USER BROWSER
defined('BASEPATH') OR exit('Access Denied!');

class Home extends Controller {

    public function __construct ( ) {

    } 

    public function index ( ) {

        // LOAD VIEW PAGE
        $this->view( 'home' );
        
    }

}
