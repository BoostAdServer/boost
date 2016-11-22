<?php
/**
 * This Class is used to manage all the elements related to the Database
 *
 * @package    BOOST AD SERVER
 * @subpackage Route
 * @author     Nicolás Seijas <nicolas@dinvaders.com>
 * @version    0.1
 */

if( !defined( 'ABSPATH' ) )
    define('ABSPATH', realpath(__DIR__ . '/..') . '/' );

if( !defined( 'DB_NAME' ) )
    require ABSPATH . 'config.php';

# Setting up the BOOST AD SERVER version
define('BOOST_AD_SERVER_VERSION', '0.1');

class Database {
	# This variables contains the info to connect with the DB
	private static $db_host = DB_HOST;
	private static $db_user = DB_USER;
	private static $db_pass = DB_PASSWORD;
	protected $db_name      = DB_NAME;

	protected $rows         = array();
	# This var will contain the query send by the user
	var $querystr;
	# This var includes the elements to sanitize the info given by the user
	var $bindValue          = array();
	private $db;

	/**
	 * Database connection
	 *
	 * @access private
	 * @return 			Return the connection if success.
	 *                  Error message in case that connection fails
	 */
	private function connect() {

		try {
			return $this->db = new PDO( 'mysql:host=' . self::$db_host . ';dbname=' . $this->db_name . ';charset=utf8', self::$db_user, self::$db_pass );
		} catch( PDOException $e ) {
			die("Error: " . $e->getMessage());
		}

	}

	// ----------------------------------------------------------

	/**
	 * @access private
	 * Kills the DB connection
	 */
	private function disconnect() {
		$this->db = null;
	}

	// ----------------------------------------------------------

	/**
	 * This function interacts with the DB. Is used to insert, delete,
	 * update, etc. elements in the DB.
	 *
	 * @access protected
	 * @return int       Return the affected row ID
	 */
	public function query() {
		$this->connect();

		if( preg_match("/^(insert|delete|update|replace|truncate|drop|create|alter|set|lock|unlock)\s+/i", $this->querystr ) ) :

			try {

				$query = $this->db->prepare( $this->querystr );

				if( count( $this->bindValue ) > 0 ) :

					foreach( $this->bindValue as $param => $value ) :
						$query->bindValue( $param, $value );
					endforeach;

				endif;

				$query->execute();

				return $this->db->lastInsertId();

			} catch( PDOException $e ) {
				print 'Error: ' . $e->getMessage();
			}

		endif;

		$this->disconnect();

	}

	// ----------------------------------------------------------

	/**
	 * Return the query result from row
	 *
	 * @access protected
	 * @return array    Return the selected row data
	 */
	public function get_row() {

		$this->connect();

		$row = $this->db->prepare( $this->querystr );

		if( count( $this->bindValue ) > 0 ) :
			foreach( $this->bindValue as $param => $value ) :
				$row->bindValue( $param, $value );
			endforeach;
		endif;

		$row->execute();

		$result = $row->fetch();

		$this->disconnect();

		return $result;

	}

	// ----------------------------------------------------------

	/**
	 * Return all the results found in the query
	 *
	 * @access protected
	 * @return array    Return all the info found
	 */
	public function get_results() {
		$this->connect();

		$results = $this->db->prepare( $this->querystr );

		if( count( $this->bindValue ) > 0 ) :

			foreach( $this->bindValue as $param => $value ) :
				// Determina el tipo de data (Si es Int o String)
				$data_type = $this->define_data_type( $value );

				$results->bindValue( $param, $value, $data_type );
			endforeach;

		endif;

		$results->execute();

		$return = $results->fetchAll(PDO::FETCH_ASSOC);

		$this->disconnect();

		return $return;
	}

	// ----------------------------------------------------------

	/**
	 * Define if value is int or string and return the necesary element
	 * for bindValue or bindParam
	 *
	 * @access protected
	 * @return Constant
	 */

	protected function define_data_type( $value ) {

		if( is_int( $value ) )
			$type = PDO::PARAM_INT;
		else
			$type = PDO::PARAM_STR;

		return $type;

	}


}
