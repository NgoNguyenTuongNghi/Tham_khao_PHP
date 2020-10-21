<?php

class AJAX {

	private $database = NULL;
	private $_query   = NULL;
	private $_fields  = array();
	public  $_index   = NULL;

	// database access
	/* const DB_HOST     = "localhost";
	const DB_USER     = "delivery";
	const DB_PASSWORD = "delivery";
	const DB_NAME     = "delivery"; */

	public function __construct(){

		include '../../includes/config/config.php';
		$this->db_connect($host, $user, $pass, $bd);					// Initiate Database connection
		$this->process_data();
	}

	/*
	 *  Connect to database
	 */
	private function db_connect($host, $user, $pass, $bd){

		//$this->database = mysql_connect(self::DB_HOST,self::DB_USER,self::DB_PASSWORD);
		$this->database = mysql_connect($host, $user, $pass);
		if($this->database){
			//$db =  mysql_select_db(self::DB_NAME,$this->database);
			$db =  mysql_select_db($bd, $this->database);
		} else {
			echo mysql_error();die;
		}
	}

	private function process_data(){
		$this->_index = ($_REQUEST['index'])?$_REQUEST['index']:NULL;
		$id = ($_REQUEST['id'])?$_REQUEST['id']:NULL;
		switch($this->_index){
			case 'country':
				$this->_query = "SELECT * FROM tb_paises";
				$this->_fields = array('id','nome');
				break;
			case 'state':
				$this->_query = "SELECT * FROM tb_estados WHERE pais=$id";
				$this->_fields = array('id','nome');
				break;
			case 'city':
				$this->_query = "SELECT * FROM tb_cidades WHERE estado=$id";
				$this->_fields = array('id','nome');
				break;
			default:
				break;
		}
		$this->show_result();
	}

	public function show_result(){
		echo '<option value="">Select '.$this->_index.'</option>';
		$query = mysql_query($this->_query);
		while($result = mysql_fetch_array($query)){
			$entity_id = $result[$this->_fields[0]];
			$enity_name = $result[$this->_fields[1]];
			echo "<option value='$entity_id'>$enity_name</option>";
		}
	}
}
$obj = new AJAX;
?>
