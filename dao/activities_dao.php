<?php
class ActivitiesDao extends BaseDao {
	function getActivitiesList() {
		$con = parent :: getConnection();

		$result = mysql_query("SELECT activity FROM activities");

		$activitiesArray = array();
		for ($i = 0; $row = mysql_fetch_array($result); $i++) {
			$activity = $row['activity'];
			$activitiesArray[$i] = $activity;
		}

		parent::closeConnection($con);

		return $activitiesArray;
	}
}
?>