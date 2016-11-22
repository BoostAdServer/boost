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
        'campaign-edit'        => 'campaign-edit/{advertiser}/{campaign}',
        'campaign-banners'     => 'campaign-banners',
        'banner-edit'          => 'banner-edit/{advertiser}/{campaign}/{banner}',
        'stats'                => 'stats'
    ];

    function __construct() {

        $request_uri   = @parse_url( $_SERVER['REQUEST_URI'] );
        $path          = $request_uri['path'];
        $regex         = '/\/dashboard\/([A-Za-z\-]+)\/?([0-9]+)?/';

        if( preg_match( $regex, $path, $match ) ) :

            $this->get( $match );

        else :

            $this->get( 'home' );

        endif;

    }

    /**
     *
     *
     */
    function get( array $match ) {

        $routes = $this->routes;

        if( array_key_exists( $match[1], $routes ) ) :
            require "Template/header.html";
            require "Template/{$match[1]}.html";
            require "Template/footer.html";
        endif;

    }

    /**
     *
     *
     */
    private function parse( $element ) {

    }

}
