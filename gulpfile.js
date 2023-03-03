//---------------------------------------
//        INSTALLED NPM PLUGINS       ---
//---------------------------------------

import gulp from 'gulp';
const { src, dest, parallel, series, watch } = gulp;

import connect from 'gulp-connect-php';
const { server } = connect;

import BrowserSync from 'browser-sync';
const browserSync = BrowserSync.create();

//-----------------------------------
//        SET FRONTEN ROUTES      ---
//-----------------------------------

import options from './config.js';

//---------------------------------------
//     SETUP THE PROJECT ROUTES       ---
//---------------------------------------

const development = options.paths.src;
const production = options.paths.dist;
const node_modules = './node_modules/';

//----------------------------------------------
//     SETUP THE PROJECT STATIC SERVER       ---
//----------------------------------------------

// START THE DEVELOPEMNT PHP SERVER TASK
const start_server = () => {
  server(
    {
      base: options.paths.root,
      port: options.config.port,
      keepalive: true,
      // USEFUL IF USE MULTI VERSIONS OF PHP ON YOUR MACHINE
      bin: '/Applications/XAMPP/xamppfiles/bin/php', // XAMPP MAC PATH FOLDER
      ini: '/Applications/XAMPP/xamppfiles/etc/php.ini', // XAMPP MAC PATH FOLDER
      debug: true,
    },
    () => {
      browserSync.init({
        proxy: '127.0.0.1:8080',
      });
    }
  );
};

// RELOAD THE BROWSER
const reload = () => {
  browserSync.reload();
};

//---------------------------------------------
//   SETUP DEVELOPMENT TASK  ( WATCH TASK)  ---
//---------------------------------------------

const dev = () => {
  watch('*/**/*.*.php').on('change', () => browserSync.reload());
};

//------------------------------------
//            DEFINE TASKS         ---
//------------------------------------

export const watch_task = parallel(start_server, dev);

export default parallel(start_server, dev);
