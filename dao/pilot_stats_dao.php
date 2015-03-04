<?php
class PilotStatsDao extends BaseDao {
	function getPilotStats($pilotName) {
		$con = parent :: getConnection();

		$pilotStats = new PilotStats();
		
		$pilotStats->pilot_name = $pilotName;

		$ransomsInvolvedResult = mysql_query("SELECT COUNT(*) AS ransoms_involved FROM ransoms INNER JOIN ransoms_pilots ON ransoms.ransom_id = ransoms_pilots.ransom_id WHERE ransoms_pilots.pilot_name = '" . $pilotName . "'");
		$ransomsInvolvedRow = mysql_fetch_array($ransomsInvolvedResult);
		$pilotStats->ransoms_involved = $ransomsInvolvedRow['ransoms_involved'];

		$ransomsInvolvedIskResult = mysql_query("SELECT SUM(ransom_amount) AS ransom_involved_isk FROM ransoms INNER JOIN ransoms_pilots ON ransoms.ransom_id=ransoms_pilots.ransom_id WHERE ransoms_pilots.pilot_name='" . $pilotName . "'");
		$ransomsInvolvedIskRow = mysql_fetch_array($ransomsInvolvedIskResult);
		$pilotStats->ransoms_involved_isk = $ransomsInvolvedIskRow['ransom_involved_isk'];

		//$ransomsMoneyMadeResult = mysql_query();
		//$ransomsMoneyMadeRow = mysql_fetch_array($ransomsMoneyMadeResult);
		//$pilotStats->ransoms_money_made =$ransomsMoneyMadeRow['ransom_made_isk'];
		$pilotStats->ransoms_money_made = 0;

		$largestRansomInvolvementResult = mysql_query("SELECT MAX(ransom_amount) AS largest_ransom FROM ransoms INNER JOIN ransoms_pilots ON ransoms.ransom_id=ransoms_pilots.ransom_id WHERE ransoms_pilots.pilot_name='" . $pilotName . "'");
		$largestRansomInvolvementRow = mysql_fetch_array($largestRansomInvolvementResult);
		$pilotStats->largest_ransom = $largestRansomInvolvementRow['largest_ransom'];

		$averageRansomValueResult = mysql_query("SELECT AVG(ransom_amount) AS avg_ransom FROM ransoms INNER JOIN ransoms_pilots ON ransoms.ransom_id=ransoms_pilots.ransom_id WHERE ransoms_pilots.pilot_name='" . $pilotName . "'");
		$averageRansomValueRow = mysql_fetch_array($averageRansomValueResult);
		$pilotStats->avg_ransoms_value = $averageRansomValueRow['avg_ransom'];

		$pilotStats->avg_ransoms_per_day = 0;

		parent::closeConnection($con);

		return $pilotStats;	
	}

	function getTopPilotsRansomsInvolved($numberOfResults) {
		$con = parent :: getConnection();

		$result = mysql_query("SELECT ransoms_pilots.pilot_name, COUNT(*) AS ransoms_involved FROM ransoms INNER JOIN ransoms_pilots ON ransoms.ransom_id = ransoms_pilots.ransom_id GROUP BY pilot_name ORDER BY ransoms_involved DESC LIMIT " . $numberOfResults);

		$topPilotsRansomsInvolvedArray = array();
		for($i = 0; $row = mysql_fetch_array($result); $i++) {
			$topPilotsRansomsInvolvedArray[$i] = new PilotStats();
			$topPilotsRansomsInvolvedArray[$i]->pilot_name = $row['pilot_name'];
			$topPilotsRansomsInvolvedArray[$i]->ransoms_involved = $row['ransoms_involved'];
		}

		parent::closeConnection($con);
		
		return $topPilotsRansomsInvolvedArray;
	}

	function getTopPilotsRansomsInvolvedIsk($numberOfResults) {
		$con = parent :: getConnection();

		$result = mysql_query("SELECT ransoms_pilots.pilot_name, SUM(ransom_amount) AS ransoms_involved_isk FROM ransoms INNER JOIN ransoms_pilots ON ransoms.ransom_id = ransoms_pilots.ransom_id GROUP BY pilot_name ORDER BY ransoms_involved_isk DESC LIMIT " . $numberOfResults);

		$topPilotsRansomsInvolvedIskArray = array();
		for($i = 0; $row = mysql_fetch_array($result); $i++) {
			$topPilotsRansomsInvolvedIskArray[$i] = new PilotStats();
			$topPilotsRansomsInvolvedIskArray[$i]->pilot_name = $row['pilot_name'];
			$topPilotsRansomsInvolvedIskArray[$i]->ransoms_involved_isk = $row['ransoms_involved_isk'];
		}

		parent::closeConnection($con);
		
		return $topPilotsRansomsInvolvedIskArray;
	}
}
?>