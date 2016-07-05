'use strict';

var generators = require('yeoman-generator');
var chalk = require('chalk');

module.exports = generators.Base.extend({
  // The name `constructor` is important here
  constructor: function () {
    // Calling the super constructor is important so our generator is correctly set up
    generators.Base.apply(this, arguments);

    console.log(chalk.bold.green("   ____                                        "));
    console.log(chalk.bold.green("  / ___|  ___  __ _ _   _  ___ _ __   ___ ___  "));
    console.log(chalk.bold.green("  \\___ \\ / _ \\/ _' | | | |/ _ \\ '_ \\ / __/ _ \\ "));
    console.log(chalk.bold.green("   ___) |  __/ (_| | |_| |  __/ | | | (_|  __/ "));
    console.log(chalk.bold.green("  |____/ \\___|\\__, |\\__,_|\\___|_| |_|\\___\\___| "));
    console.log(chalk.bold.green("                 |_|                           "));

  },
  prompts: function () {
    return this.prompt([{
        type: 'input',
        name: 'ProjectName',
        message: 'What is the name of the project?',
        default: 'Sample Web Site'
    },{
        type: 'input',
        name: 'DatabaseName',
        message: 'What is the name of the database?',
        default: 'wordpress_db'
    },{
        type: 'input',
        name: 'DatabaseUser',
        message: 'What name should be used for accessing the database?',
        default: 'wordpress_user'
    },{
        type: 'input',
        name: 'DatabasePassword',
        message: 'What password should be used for accessing the database?',
        default: 'password'
    },{
        type: 'input',
        name: 'ThemeName',
        message: 'What is the name of the theme?',
        default: 'Sample Theme'
    }]).then(function (answers) {
      var finderSpace       = new RegExp(' ', 'g');
      var finderDash        = new RegExp('-', 'g');
      this.ProjectName      = answers.ProjectName;
      this.ProjectFolder    = answers.ProjectName.replace(finderSpace, "-").toLowerCase();
      this.DatabaseName     = answers.DatabaseName;
      this.DatabaseUser     = answers.DatabaseUser;
      this.DatabasePassword = answers.DatabasePassword;
      this.ThemeName        = answers.ThemeName;
      this.ThemeFolder      = answers.ThemeName.replace(finderSpace, "-").toLowerCase();
      this.ThemeUnderscores = answers.ThemeName.replace(finderSpace, "_").replace(finderDash, "_").toLowerCase();
    }.bind(this));
  },
  vagrantFiles: function() {
    this.template('Vagrantfile', 'Vagrantfile');
    this.template('README.md', 'README.md');
    this.template('.gitignore', '.gitignore');
    this.template('./ops', './ops');
  },
  themeFiles: function() {
    var destination = './wp-content/themes/' + this.ThemeFolder;
    this.template('./theme', destination);
  }
});