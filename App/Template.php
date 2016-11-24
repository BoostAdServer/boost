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

class Template {

    function render( $filename ) {

        $mockup = new Mockup;
        $data   = $mockup->dispatch( $filename );

        $content = str_replace( $data['search'], $data['replace'], $this->get( $filename ) );

        echo $content;

    }

    function get( string $filename ) {

        $filename = "Template/{$filename}";

        if( is_file( $filename ) ) :
            ob_start();
            include $filename;
            $content = ob_get_contents();
            ob_end_clean();
            return $content;
        endif;

    }

    function pattern( $route ) {

    }

}
