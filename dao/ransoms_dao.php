<?php
class RansomsDao extends BaseDao {
	function getPilotsListForRansom($ransomId) {
		$result = mysql_query("SELECT pilot_name FROM ransoms_pilots WHERE ransom_id=" . $ransomId);

		$pilotsArray = array();
		for ($i = 0; $row = mysql_fetch_array($result); $i++) {
			$pilotName = $row['pilot_name'];
			$pilotsArray[$i] = $pilotName;
		}

		return $pilotsArray;
	}

	function getRelatedLinkForRansom($ransomId) {
		$result = mysql_query("SELECT link_text FROM ransoms_links WHERE ransom_id=" . $ransomId);

		$row = mysql_fetch_array($result);
		return $row['link_text'];
	}

	function saveRansom($ransom) {
		$con = parent :: getConnection();		

		//insert ransom info
		if(!mysql_query("INSERT INTO ransoms (pilot_name, ship_name, system_name, ransom_amount, date, comments, ransomee_activity) VALUES('" . $ransom->victim_name . "', '" . $ransom->ship->ship_name . "', '" . $ransom->system . "', '" . $ransom->amount . "', '" . $ransom->date . "', '" . $ransom->comments . "', '" . $ransom->activity. "')")) {
			echo mysql_error();
			return false;	
		}

		$result = mysql_query("SELECT ransom_id FROM ransoms WHERE ransom_id=(SELECT max(ransom_id) FROM ransoms)");
		$row = mysql_fetch_array($result);
		$thisRansomId = $row['ransom_id'];
		$ransom->id = $thisRansomId;

		$pilotsList = explode(",", $ransom->pilots_involved);
		for($i = 0; $i < sizeof($pilotsList); $i++) {
			$thisPilotName = trim($pilotsList[$i]);
			if(!mysql_query("INSERT INTO ransoms_pilots(pilot_name, ransom_id) VALUES('" . $thisPilotName . "', " . $thisRansomId . ")")) {
				echo mysql_error();
			}

			mysql_query("INSERT INTO pilots(pilot_name) VALUES('" . $thisPilotName . "')");
		}

		!mysql_query("INSERT INTO ransoms_links(ransom_id, link_text) VALUES(" . $thisRansomId . ", '" . $ransom->link . "')");


		parent::closeConnection($con);

		return $ransom;
	}

	function getRansoms($maxNumberOfResults) {
		$con = parent :: getConnection();

		$result = mysql_query("SELECT ransom_id, pilot_name, ship_name, system_name, ransom_amount, date, comments, ransomee_activity FROM ransoms ORDER BY date DESC LIMIT " . $maxNumberOfResults);

		$ransomsArray = array();
		for ($i = 0; $row = mysql_fetch_array($result); $i++) {
			$ransom = new Ransom();

			$ransom->id = $row['ransom_id'];
			$ransom->victim_name = $row['pilot_name'];
			$ransom->system = $row['system_name'];
			$ransom->amount = $row['ransom_amount'];
			$ransom->date = $row['date'];
			$ransom->comments = $row['comments'];
			$ransom->activity = $row['ransomee_activity'];

			$ransom->pilots_involved = $this->getPilotsListForRansom($ransom->id);
			$ransom->link = $this->getRelatedLinkForRansom($ransom->id);
			
			$ransom->ship = new Ship();
			$ransom->ship->ship_name = $row['ship_name'];

			$ransomsArray[$i] = $ransom;
		}

		parent::closeConnection($con);

		return $ransomsArray;
	}

	function getRansomById($ransomId) {
		$con = parent :: getConnection();

		$result = mysql_query("SELECT ransom_id, pilot_name, ship_name, system_name, ransom_amount, date, comments, ransomee_activity FROM ransoms WHERE ransom_id=" . $ransomId);
		$row = mysql_fetch_array($result);

		$ransom = new Ransom();
		$ransom->id = $row['ransom_id'];
		$ransom->victim_name = $row['pilot_name'];
		$ransom->system = $row['system_name'];
		$ransom->amount = $row['ransom_amount'];
		$ransom->activity = $row['ransomee_activity'];
		$ransom->date = $row['date'];
		$ransom->comments = $row['comments'];
		
		$ransom->pilots_involved = $this->getPilotsListForRansom($ransom->id);
		$ransom->link = $this->getRelatedLinkForRansom($ransom->id);

		$ransom->ship = new Ship();
		$ransom->ship->ship_name = $row['ship_name'];

		parent::closeConnection($con);

		return $ransom;
	}

	function getRansomsByPilot($pilotName, $maxNumberOfResults) {
		$con = parent :: getConnection();
		
		$result = mysql_query("SELECT ransoms.ransom_id, ransoms.pilot_name, ship_name, system_name, ransom_amount, date, comments, ransomee_activity FROM ransoms INNER JOIN ransoms_pilots ON ransoms.ransom_id=ransoms_pilots.ransom_id WHERE ransoms_pilots.pilot_name='" . $pilotName . "' ORDER BY date DESC LIMIT " . $maxNumberOfResults);

		$ransomsArray = array();
		for ($i = 0; $row = mysql_fetch_array($result); $i++) {
			$ransom = new Ransom();

			$ransom->id = $row['ransom_id'];
			$ransom->victim_name = $row['pilot_name'];
			$ransom->system = $row['system_name'];
			$ransom->amount = $row['ransom_amount'];
			$ransom->date = $row['date'];
			$ransom->comments = $row['comments'];
			$ransom->activity = $row['ransomee_activity'];

			$ransom->pilots_involved = $this->getPilotsListForRansom($ransom->id);
			$ransom->link = $this->getRelatedLinkForRansom($ransom->id);			

			$ransom->ship = new Ship();
			$ransom->ship->ship_name = $row['ship_name'];

			$ransomsArray[$i] = $ransom;
		}
		parent::closeConnection($con);

		return $ransomsArray;
	}

	function deleteRansom($ransomId) {
		$con = parent :: getConnection();

		mysql_query("DELETE FROM ransoms WHERE ransom_id=" . $ransomId);
		mysql_query("DELETE FROM ransoms_pilots WHERE ransom_id=" . $ransomId);
		mysql_query("DELETE FROM ransoms_links WHERE ransom_id=" . $ransomId);
		mysql_query("DELETE FROM ransoms_comments WHERE ransom_id=" . $ransomId);

		parent::closeConnection($con);
	}
}
?>