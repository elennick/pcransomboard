<?php
abstract class BaseDao {
	function getConnection() {
		$con = mysql_connect(PCRBConfig::$dbLocation, PCRBConfig::$dbUser, PCRBConfig::$dbPassword);
		if (!$con) {
			die('Could not connect: ' . mysql_error());
		}

		mysql_select_db(PCRBConfig::$dbName, $con);

		return $con;
	}
	
	function closeConnection($con) {
		mysql_close($con);	
	}
}
?>