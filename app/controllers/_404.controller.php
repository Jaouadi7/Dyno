<?php

// NAMESPACE
namespace Controller;

// PREVENT THE ACCESS FROM THE USER BROWSER
defined('BASEPATH') OR exit('Access Denied!');

class _404 extends Controller {

    public function __construct ( ) {

    } 

    public function index ( ) {

        // LOAD VIEW PAGE
        $this->view( '404' );
        
    }

}
