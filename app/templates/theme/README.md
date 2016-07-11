# <%= ThemeName %> Theme

This is a starter theme based off [underscores](http://underscores.me/). The CSS has been moved to SASS files, [bootstrap](getbootstrap.com) has been incorporated, and gulp tasks have been created to handle compiling the SASS, combining and minifying the JavaScript files. This is a very basic theme with not much here, it's meant as a launch pad to building a fully customized theme.

## Theme Dependencies

* [Ruby](https://www.ruby-lang.org/en/): Recommend ruby-2.2.0. May want to install rvm to manage versions.
* [NodeJS](https://nodejs.org/)
* [Gulp](http://gulpjs.com/)
* [Bower](https://bower.io/)

## Theme Development

Front end dependencies are managed using [Bower](http://bower.io/).

The theme uses [Gulp](http://gulpjs.com/) to:
* Compile SASS files into CSS.
* Combine JS files into one file.
* Import fonts from bower dependencies.

To make updates to the <%= ThemeName %> theme, you need to:

```bash
  $ cd wp-content/themes/<%= ThemeFolder %>
  $ bundle install
  $ npm install
  $ bower install
  $ gulp build
```

You can use `gulp` without any options to compile assets and then watch for changes.

