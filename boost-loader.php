<?php
/**
 * This file automatically loads the classes called in the app
 *
 * @package    BOOST AD SERVER
 * @subpackage Loader
 * @author     Nicolás Seijas <nicolas@dinvaders.com>
 * @version    0.1
 */

// If ABSPATH isn't defined, boost-config.php is loaded
if( !defined( 'ABSPATH' ) )
	require 'boost-config.php';

// LOADER is defined as security measure
define( 'LOADER', true );

/**
 * Loads the required class if exists
 *
 * @param  string $className The class name
 */
function class_autoloader( $className ) {
	$names = explode('\\', $className );

	$path = false;

	if( count( $names ) > 1 ) :

		$path = APPPATH;

		for( $i = 0; $i < count( $names ); $i++ ) :
			$path .= DIRECTORY_SEPARATOR . $names[$i];
		endfor;

		$path .= '.php';

	else :

		$path = APPPATH . $className . '.php';

	endif;

	if( file_exists( $path ) )
		require_once $path;
}

// Register the function
spl_autoload_register( 'class_autoloader' );
