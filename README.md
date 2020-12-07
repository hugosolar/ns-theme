# Code test for [North Star Marketing](https://www.northstarmarketing.com/)

This theme is a code test for applying to North Star Marketing
is not intended to be used as a real theme as it is

## Features
- Use of WordPress partials files
- Nav menu Walker to match Bootstrap navigation layout
- Singleton class on `functions.php` initializing basic theme functionality
- Component class to render post cards
- Helper functions to render excerpts 
- Simple Page & Single template


## Sass
the sass files lives in the `front/src/styles` folder. The styles are built on top of [Bootstrap](https://getbootstrap.com/).

For installing dependencies you need to go to `front` folder and
```
npm install
```

To compile the styles:

```
npm run build
```

To watch & compile:

```
npm run watch
```