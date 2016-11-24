<?php
/**
 * Template handles the data and display it to the user
 *
 * The Template class render the given predifined tags to real data
 *
 * @package    BOOST AD SERVER
 * @subpackage Template
 * @author     Nicolás Seijas <nicolas@dinvaders.com>
 * @version    0.1
 */

class Mockup {

    /**
     *
     *
     */
    public function header() {
        # Expected tags in header.html
        $search = [
            '{{site.name}}',
            '{{site.description}}',
            '{{site.generator}}'
        ];

        $replace = [
            'The Place',
            'Lalala',
            'Boost Adserver'
        ];

        return array( 'search' => $search, 'replace' => $replace );

    }

    /**
     *
     *
     */
    function gather( $data ) {

        if( is_array( $data ) ) :

            if( isset( $data[1] ) ) :

            endif;

        endif;

    }

    /**
     *
     *
     */
    function dispatch( $data ) {

        $content = array( 'search' => '', 'replace' => '' );

        if( $data == 'header.html' ) :
            $content = $this->header();
        elseif( $data == 'footer.html' ) :

        else :

        endif;

        return $content;

    }

}
