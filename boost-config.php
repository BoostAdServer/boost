<?php
/**
 * This file contains critical elements for the system configuration,
 * so be careful when you edit something.
 *
 * @package    BOOST AD SERVER
 * @subpackage Configuration
 * @author     Nicolás Seijas <nicolas@dinvaders.com>
 * @version    0.1
 */

/**
 * Setting up the database connection
 */

# Database Name
define( 'DB_NAME', 'owladserver' );

# MySQL username
define( 'DB_USER', 'root' );

# MySQL password
define( 'DB_PASSWORD', '' );

# MySQL host
define( 'DB_HOST', 'localhost' );

// ----------------------------------------------------------

/**
 * Setting up some useful paths
 *
 * This constants will be used in key elements of the code, so BE CAREFUL
 * and do not change constant names!
 */

# Absolute path of the parent directory
if( !defined( 'ABSPATH' ) )
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );

# The Template path
if( !defined( 'TEMPLATEPATH' ) )
	define( 'TEMPLATEPATH', ABSPATH . 'front-end' );

# The App path
if( !defined( 'APPPATH' ) )
	define( 'APPPATH', ABSPATH . 'App/' );

// ----------------------------------------------------------

/**
 * Calling the loader of required files
 * DO NOT REMOVE!
 */

require ABSPATH . 'boost-loader.php';

// ----------------------------------------------------------

$route          = new Route;
$GLOBALS['odb'] = new Database;
$table          = new Table;
$table->build();
