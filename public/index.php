<?php

// START A NEW SESSION
session_start( );

// MAKE THE PUBLIC DIRECTORY AS BASE PATH FOR THE APPLICATION
define( 'BASEPATH', __DIR__ . DIRECTORY_SEPARATOR );

// LOAD APP CORE FILES
require_once '../app/core/init.php';

// INIT THE APPLICATION
$app = new Application();
