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
     * @var array
     */
    private $routes = [
        'advertiser-campaigns',
        'advertiser',
        'campaign-edit',
        'campaign-banners',
        'stats'
    ];

    function __construct() {

        $request_uri   = @parse_url( $_SERVER['REQUEST_URI'] );
        $path          = $request_uri['path'];
        $regex         = '/\/dashboard\/([A-Za-z\-]+)\/([0-9]+)?/';

        if( preg_match( $regex, $path, $match ) ) :

            $this->get( $match );

        endif;

    }

    function get( array $match ) {

        $routes = $this->routes;
        var_dump( $routes );

    }

}
