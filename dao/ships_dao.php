<?php
class ShipsDao extends BaseDao {
	function getShipsList() {
		$con = parent :: getConnection();

		$result = mysql_query("SELECT ship_name, ship_base_value FROM ships");

		$shipsArray = array();
		for ($i = 0; $row = mysql_fetch_array($result); $i++) {
			$ship = new Ship();

			$ship->ship_name = $row['ship_name'];
			$ship->ship_base_value = $row['ship_base_value'];

			$shipsArray[$i] = $ship;
		}

		parent::closeConnection($con);

		return $shipsArray;
	}
}
?>