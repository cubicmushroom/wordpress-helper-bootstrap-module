Bootstrap Module for CM WordPres Helper
=======================================

Adds support for Twitter's Bootstrap for cubicmushroom/wordpress-helper


Basic Usage
-----------

Load the module in the usual way

	$plugin = CM_WP_Plugin::register( '<plugin>', __FILE__ );
    $plugin->register_module( 'bootstrap' );
    
To automatically include the bootstrap files on every (front-end) page…

    $plugin->autoload(); // Loads CSS & JS on every page
-
    $plugin->autoload( array( 'css' ) ); // Loads CSS on every page
-
    $plugin->autoload( array( 'js' ) ); // Loads JS on every page