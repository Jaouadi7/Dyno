<?php

// PREVENT THE ACCESS FROM THE USER BROWSER
defined('BASEPATH') OR exit('Access Denied!');

// SHOW DATA FOR DEVELOPMENT
function show_data ( $data ) {

    echo '<pre>';
    print_r( $data );
    echo '</pre>';

}

// REDIRECT TO HOMEPAGE
function redirect ( ) {

    header( 'Location: '. ROOT );
    exit;

}