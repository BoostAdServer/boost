<?php
/**
 * Route handles the pretty URL of the APP
 *
 * The Route class is executed in the index file to handle the url requests
 *
 * @package    BOOST AD SERVER
 * @subpackage Route
 * @author     Nicolás Seijas <nicolas@dinvaders.com>
 * @version    0.1
 */

class Route {

    /**
     * List of allowed access to the app
     * @var    array
     * @access private
     */
    private $routes = [
        'advertiser-campaigns' => 'advertiser-campaigns/{advertiser}',
        'advertiser-edit'      => 'advertiser-edit/{advertiser}',
        'advertiser'           => 'advertiser',
        'campaign-edit'        => 'campaign-edit/{campaign}/',
        'campaign-banners'     => 'campaign-banners',
        'banner-edit'          => 'banner-edit/{banner}/',
        'stats'                => 'stats'
    ];

    function __construct() {

        $request_uri   = @parse_url( $_SERVER['REQUEST_URI'] );
        $path          = $request_uri['path'];
        /**
         * Set the regex to check if the URL matches with the BOOST standards
         * @todo Fix the regex, it's sloppy
         */
        $regex         = '/\/dashboard\/([A-Za-z\-]+)\/?([0-9]+)?\/?/';

        if( preg_match( $regex, $path, $match ) ) :
            $this->render( $match );
        else :
            $this->render( 'home' );
        endif;

    }

    /**
     *
     *
     */
    function render( $match ) {
        # Calling the default routes
        $routes = $this->routes;
        # Gather the page info
        $mockup = new Mockup;
        $mockup->gather( $match );

        $template = new Template;

        echo $template->render( 'header.html' );

        if( is_array( $match ) && array_key_exists( $match[1], $routes ) ) :
            echo $template->render( "{$match[1]}.html" );
        else :
            echo $template->render( 'index.html' );
        endif;

        echo $template->render( 'footer.html' );

    }


}
