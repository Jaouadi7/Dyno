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

      // SET AND CREATE SPECIFIC DATA TO SESSION
      public function set ( $data = [ ] ) {


        // CHECK DATA IS FOUND AND TYPE IS ARRAY
        if ( ! empty( $data ) && is_array( $data) ):

            // LOOP DATA KEY AND VALUE
            foreach ( $data as $key => $value ):
               
                // STORE DATA IN SESSION
                $_SESSION[$this->mainkey][$this->secondrykey][$key] = $value;
                
            endforeach;
           
        endif;

    }

}

// CHECK & INIT A NEW SESSION ONCE THE APPLICATION RUN
$session = new Session( );
$session->start( );