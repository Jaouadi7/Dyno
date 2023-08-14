<?php

// NAMESPACE
namespace Core;

// PREVENT THE ACCESS FROM THE USER BROWSER
defined('BASEPATH') OR exit('Access Denied!');

// DATABASE CLASS
trait Database {

    // SETUP AND CONNECT TO THE DATABASE
    public function connect ( ) {

        
        try {
            
            $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME;
            $connection = new PDO ( $dsn, DB_USER, DB_PASS, [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES " . DB_CHARSET]);
            return $connection;

        } catch ( PDOException $error ) {

            // SHOW ERROR
            die ( $error->getMessage( ) );

        }

    }

    // READ FROM DATABASE
    public function readDB ( $query, $data = [] ) {

        $connection = $this->connect( );
        $statement = $connection->prepare( $query );
        $statement->execute( $data );

        if ( $statement->rowCount( ) ) :

            $data = $statement->fetchAll( PDO::FETCH_OBJ );

            if ( is_array( $data ) ) :

                return $data;

            endif;

        endif;

        return false;

    }

    // WRITE TO DATABASE
    public function writeDB ( $query, $data = [] ) {

      
        $connection = $this->connect( );
        $statement = $connection->prepare( $query );
        $statement->execute( $data );

        if ( $statement->rowCount(  ) ) :

            return true;

        endif;

        return false;

    }

}