//---------------------------------------
//        INSTALLED NPM PLUGINS       ---
//---------------------------------------

import gulp from 'gulp';
const { src, dest, parallel, series, watch, task } = gulp;

import connect from 'gulp-connect-php';
const { server } = connect;

import BrowserSync from 'browser-sync';
const browserSync = BrowserSync.create();

import sassCompiler from 'sass';
import gulpSass from 'gulp-sass';

const sass = gulpSass(sassCompiler);

import autoPrefixer from 'gulp-autoprefixer';
import sourceMaps from 'gulp-sourcemaps';
const { init, write } = sourceMaps;

import optimizeImages from 'gulp-image';

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

//---------------------------------------
//         SETUP CSS TASK             ---
//---------------------------------------

const buildCSS = (done) => {
  src(`${development.scss}/core.scss`)
    .pipe(init())
    .pipe(sass().on('error', sass.logError))
    .pipe(autoPrefixer({ cascade: false }))
    .pipe(write('.'))
    .pipe(dest(production.css))
    .pipe(browserSync.reload({ stream: true }));
  done();
};

//---------------------------------------
//         SETUP JS TASK            ---
//---------------------------------------

const buildJS = (done) => {
  src(`${development.js}/script.js`)
    .pipe(dest(`${production.js}/`))
    .pipe(browserSync.reload({ stream: true }));
  done();
};

//---------------------------------------
//         SETUP IMAGES TASK          ---
//---------------------------------------

const compressImages = (done) => {
  src(`${development.img}/*`)
    .pipe(optimizeImages())
    .pipe(dest(`${production.img}/`));
  done();
};

//---------------------------------------
//          SETUP FONTS TASK          ---
//---------------------------------------

const fonts = (done) => {
  src(`${development.fonts}/**/*`)
    .pipe(dest(production.fonts))
    .pipe(browserSync.reload({ stream: true }));
  done();
};

//---------------------------------------------
//   SETUP DEVELOPMENT TASK  ( WATCH TASK)  ---
//---------------------------------------------

const dev = () => {
  watch('*/**/*.*.php').on('change', () => browserSync.reload());
  watch(`${development.scss}/core.scss`, series(buildCSS, reload));
  watch(`${development.js}/**/*.js`, series(buildJS, reload));
  watch(`${development.img}/**/*`, series(optimizeImages, reload));
  watch(`${development.fonts}/**/*`, series(fonts, reload));
};

//------------------------------------
//            DEFINE TASKS         ---
//------------------------------------

task('css', buildCSS);
task('js', buildJS);
task('images', compressImages);
task('fonts', fonts);
task('watch', parallel(start_server, dev));
export default parallel(start_server, dev);
