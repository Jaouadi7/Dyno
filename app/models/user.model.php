<?php

// PREVENT THE ACCESS FROM THE USER BROWSER
defined('BASEPATH') OR exit('Access Denied!');

class User {

    use Model;

    protected $table = 'users';

    // ALLOWED COLUMNS ON DB TABLE TO INSERT OR UPDATE QUERIES
    protected $allowed_columns = [ 'name', 'age' ];

    public function __construct ( ) {

        echo 'User Modal';

    }

}