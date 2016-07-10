# Sequence WordPress Generator

At Sequence we often find ourselves taking on marketing sites that need to be powered by WordPress. The decision to use WordPress is sometimes driven by familiarity, sometimes by cost, sometimes by features and plugin support. Regardless of the decision drivers, there is a common development environment setup process that we find ourselves repeating over and over. This Yeoman generator is an attempt at automating the creation of a new WordPress project.

This Generator will:

1. Set up the files for provisioning a Vagrant virtual environment to host the WordPress site.
2. Set up a bare bones theme that can be used to start development.

The Vagrant provisioning scripts will set up NGINX. PHP, MySQL, and the WP-CLI command line tool. The script also downloads and installs the latest version of WordPress.

A '.gitignore' file is created that will exclude the core WordPress files and the default themes. This setup allows for git based deployment support.

## Dependencies

The following must be installed on your local workstation for this generator to work.

* [NodeJS](https://nodejs.org/en/)
* [Ruby](https://www.ruby-lang.org/en/)
* [VirtualBox](https://www.virtualbox.org)
* [Vagrant](https://www.vagrantup.com)
* [Yeoman](http://yeoman.io)

## Usage

## Sample Theme
