ECTA - International Association of Business Communicators
===

This theme is built off of  `_s`/`underscores`. The theme has been altered to allow for richer theming experience.

Tools and Setup
---------------
Below are the tools needed to theme:

* [Gulp](https://gulpjs.com/) Used to compile all things.
* [NPM](https://www.npmjs.com/) Used to manage packages.

Gulp and NPM can be ran locally, but can also be run in the container. Good practice is to run in the container.

To run locally.
1. `npm install` should only need to be run once, or when adding new packages.
1. When developing, run `gulp watch`.
1. To just compile run `gulp build`.
1. Running `gulp` should also just run the watch tasks and associated tasks.

To run in the container.
1. `fin npm install` should only need to be run once, or when adding new packages.
1. All commands should be run from the root of the project. Not from within this theme.
1. When developing, run `fin gulp watch`.
1. To just compile run `fin gulp build`.
1. Running `fin gulp` should also just run the watch tasks and associated tasks.


Must Knows
---------------

1. We are using BEM naming conventions. To get familiar [CSSTricks has a pretty decent article](https://css-tricks.com/bem-101/) on it.
1. All scss files are globbed together. When you add a new partial, it will automatically be compiled.
1. All CSS or SCSS from packages should be imported into our main `styles.scss` file
1. No JS files should be added in the functions.php file.
    1. JS files are Globbed together. To add new custom JS added them to the JS directory.
    2. Functionality should be separated into their own files.
    3. Any JS from packages.Instead the paths to the JS files should be added to the `gulp/config/_paths.js` file in the JS array.
1.  We are using a few great mixin packages/libraries. Breakpoint-sass and toolkit.
    1. Use [Breakpoint-sass](http://breakpoint-sass.com/) for declaring all breakpoints. We have a breakpoint variable partial that can/will be used to define our breakpoints. All breakpoints should be nested under a ruleset, no rulesets should be nested within a breakpoint. You can create a breakpoint by using the mixin `@include breakpoint(bear($variable)) {}`
    1. Review the mixin, variable, and functions partial before theming.

Continuous Integration and Tests
--------------------------------
1. This project is set up with a `phpcs.xml.dist` file that should be utilized to check PHP version/WordPress PHP compatibility locally. This same file is utilized by CircleCI to test on feature branch push.
2. For these checks to work [PHPCompatibilityWP](https://github.com/PHPCompatibility/PHPCompatibilityWP) and the [WordPress Coding Standards](https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards) need to be installed via composer globally on your local machine as follows:
    1. `composer global require squizlabs/php_codesniffer=* wp-coding-standards/wpcs phpcompatibility/phpcompatibility-wp`
    1. Make sure that `phpcs` is in your $PATH on Mac. From terminal, `echo $PATH`. If `/Users/{username}/.composer/vendor/bin` is not in your path enter `PATH=$PATH:/Users/{username}/.composer/vendor/bin` in the terminal to add it, after which point `which phpcs` should give you that value.
    1. `phpcs --config-set installed_paths /Users/[username]/.composer/vendor/phpcompatibility/php-compatibility/PHPCompatibility/,/Users/[username]/.composer/vendor/phpcompatibility/phpcompatibility-wp/PHPCompatibilityWP,/Users/[username]/.composer/vendor/phpcompatibility/phpcompatibility-paragonie/PHPCompatibilityParagonieRandomCompat,/Users/[username]/.composer/vendor/wp-coding-standards/wpcs` (replace [username] with your own from your machine)
    1. Once complete run `phpcs` in the project root against a theme file to test, for example: `phpcs --standard=phpcs.xml.dist wp-content/themes/ecta/functions.php`. The file must have `phpcs` errors to show any results.



Sweet Functions
	--------------------------------

1. Use `function get_ecta_color_class( $pre, $slug )` to help manage color selection
2. Use `function ecta_primary_term( $id, $taxonomy )` in conjunction with `function ecta_associated_slug( $primaryterm )` to leverage color selection in post loops
