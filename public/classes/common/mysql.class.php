<?php
	/**
	 * mysql Database operations lib
	 */
class mysql {
	
	public $fetch_mode=MYSQL_BOTH;//MYSQL_BOTH;//Take the record set the mode used when
	public $record=array();//An array of records

	function __construct() {
		$this->connect();
	}

	//Establish a database connection
	function connect() {
		$link = mysql_connect(DB_HOST, DB_USER, DB_PASS) or die("Database configuration error：" . mysql_error());
		mysql_query("SET NAMES ".CodeM."");
		mysql_select_db(DB_DATABASE, $link) or die("Could not find database：" . DB_DATABASE);
	}

	//Execute SQL statements
	function query($sql) {
		return mysql_query($sql);
	}

	//The number of rows in the result obtained
	function num_rows($result) {
		return mysql_num_rows($result);
	}

	//Impact on the operation of a database to obtain the number of articles
	function affected_rows() {
		return mysql_affected_rows();
	}

	//The results of the field to obtain the number of
	function num_fields($result) {
		return mysql_num_fields($result);
	}

	//Release the results of memory
	function free_result($result) {
		return mysql_free_result($result);
	}

	//INSERT operation to obtain the ID generated step
	function insert_id() {
		return mysql_insert_id();
	}

	//Close result set
	function close() {
		return mysql_close();
	}

	//Fetch a result row as an array
	function fetch_array($result) {
		if($result){
			return mysql_fetch_array($result, $this->fetch_mode);
		}else{
			return null;
		}		
	}

	//Remove a record
	function fetch_row($rs){
		$this->record=mysql_fetch_array($rs,$this->fetch_mode);
		return $this->record;
	}

	//Remove all records
	function fetch_all($rs){
		$arr=array();
		while($this->record=mysql_fetch_array($rs,$this->fetch_mode)){
			$arr[]=$this->record;
		}
		return $arr;
	}
}
?>
