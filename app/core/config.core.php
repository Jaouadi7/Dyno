<?php

// PREVENT THE ACCESS FROM THE USER BROWSER
defined('BASEPATH') OR exit('Access Denied!');

// SET GLOBAL VARIABLES

// ON DEVELOPMENT STAGE
if ( $_SERVER['SERVER_NAME'] === 'localhost' ) :

    // DB INFO LOCALHOST
    define( 'DB_HOST', 'localhost' );
    define( 'DB_NAME', 'mvc_db' );
    define( 'DB_USER', 'root' );
    define( 'DB_PASS', '' );
    define( 'DB_CHARSET', 'utf8mb4' );

else :

    // FOR PRODUCTION STAGE
    // DB INFO ON WEBSIE SERVER
    define( 'DB_HOST', 'localhost' );
    define( 'DB_NAME', 'mvc_db' );
    define( 'DB_USER', 'root' );
    define( 'DB_PASS', '' );
    define( 'DB_CHARSET', 'utf8mb4' );

endif;

// DEFINE PATHS
$https = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ? 'https' : 'http';
$_SERVER['REQUEST_SCHEME'] = isset($_SERVER['REQUEST_SCHEME']) ? $_SERVER['REQUEST_SCHEME'] : $https;
$root = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['SERVER_NAME'] . str_replace( 'index.php', '', $_SERVER['PHP_SELF'] );
define( 'ROOT', $root);
define( 'THEME_TEMPLATE_DIR', 'default-template/' );
define( 'CSS_DIR_PATH', ROOT . 'front-end/dist/css/' );
define( 'JS_DIR_PATH', ROOT . 'front-end/dist/js/' );
define( 'IMAGES_DIR_PATH', ROOT . 'front-end/dist/img/' );
define( 'FONTS_DIR_PATH', ROOT . 'front-end/dist/fonts/' );

// APPLICATION INFORMATION
define('APPLICATION_NAME', 'PHP MVC CUSTOM FRAMEWORK');

// DEBUG MODE FOR DEVELOPMENT ONLY
define( 'DEBUG_MODE', true );
DEBUG_MODE ? ini_set( 'display_errors', 1 ) : ini_set( 'display_errors', 0 );
