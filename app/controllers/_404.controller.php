<?php

class _404 extends Controller {

    public function __construct ( ) {

    } 

    public function index ( ) {

        // LOAD VIEW PAGE
        $this->view( '404' );
        
    }

}
