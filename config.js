export default {
  config: {
    port: 8080,
  },
  paths: {
    root: './public',
    src: {
      base: './public/front-end/src',
      css: './public/front-end/src/scss',
      js: './public/front-end/src/js',
      img: './public/front-end/src/images',
      fonts: './public/front-end/src/fonts',
    },
    dist: {
      base: './public/front-end/dist',
      css: './public/front-end/dist/css',
      js: './public/front-end/dist/js',
      img: './public/front-end/dist/img',
      fonts: './public/front-end/dist/fonts',
    },
  },
};
