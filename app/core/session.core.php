<?php

// PREVENT THE ACCESS FROM THE USER BROWSER
defined('BASEPATH') OR exit('Access Denied!');


class Session {

    public $mainkey = 'MVC';
    public $secondrykey = 'USER';

    public function __construct ( ) {

    }

    // START A NEW SESSION FUNCTION
    public function start ( ) {

        // CHECK SESSION IF NOT EXISTS
        if ( session_status( ) === PHP_SESSION_NONE ):

            // START A NEW SESSION
            session_start( );

        endif;

    }

    // GET SPECIFIC DATA FROM SESSION
	public function get( $key = '' ) {

       	if( isset($_SESSION[$this->mainkey][$this->secondrykey][$key]) ):

			return $_SESSION[$this->mainkey][$this->secondrykey][$key];
		
        endif;

        return;

	}

}

// CHECK & INIT A NEW SESSION ONCE THE APPLICATION RUN
$session = new Session( );
$session->start( );