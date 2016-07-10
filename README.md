# Sequence WordPress Generator

At Sequence we often find ourselves taking on marketing sites that need to be powered by WordPress. The decision to use WordPress is sometimes driven by familiarity, sometimes by cost, sometimes by features and plugin support. Regardless of the decision drivers, there is a common development environment setup process that we find ourselves repeating over and over. This Yeoman generator is an attempt at automating the creation of a new WordPress project.

This Generator will:
#. Set up the files for provisioning a Vagrant virtual environment to host the WordPress site.
#. Set up a bare bones theme that can be used to start development.

The Vagrant provisioning scripts will set up NGINX. PHP, MySQL, and the WP-CLI command line tool. The script also downloads and installs the latest version of WordPress.

A '.gitignore' file is created that will exclude the core WordPress files and the default themes.

## Dependencies

## Usage

## Sample Theme
