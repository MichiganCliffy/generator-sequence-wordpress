# <%= ProjectName %>

This sets up a local WordPress development environment using Vagrant. The provisioning is automated so the development team does not need to worry
about configuring their local environments.

## Local Development Environment

### Requirements

* [Ruby](https://www.ruby-lang.org/en/): Recommend ruby-2.2.0. May want to install rvm to manage versions.
* [VirtualBox](https://www.virtualbox.org/)
* [Vagrant](https://www.vagrantup.com/)
* [NodeJS](https://nodejs.org/)
* [Gulp](http://gulpjs.com/)

### Set Up

If you are using Mac OS or Linux install the bindfs vagrant plugin 

```bash
  $ vagrant plugin install vagrant-bindfs
```

Pull the latest revision from github, cd (change directroy) to you're local repo and execute.

```bash
  $ git clone git@github.com:SequenceLLC/repository-name.git
  $ cd repository-name
  $ vagrant up
```

After the *vagrant up* is done, go to http://192.168.33.33 with your browser and enjoy wordpress.

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

You can read more on theme development by viewing the readme located at wp-content/themes/<%= ThemeFolder %>/readme.md