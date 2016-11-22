<?php
/**
 * Table creates the database information of BOOST Ad Server
 *
 *
 *
 * @package    BOOST AD SERVER
 * @subpackage Table
 * @author     Nicolás Seijas <nicolas@dinvaders.com>
 * @version    0.1
 */

class Table {

    function build() {

        global $odb;

        $odb->querystr = "CREATE TABLE IF NOT EXISTS options (
			id           bigint(20) NOT NULL AUTO_INCREMENT,
			option_name  varchar(100) NOT NULL,
			option_value longtext NOT NULL,
			PRIMARY KEY (id)
        );";

        $odb->query();

    }

}
