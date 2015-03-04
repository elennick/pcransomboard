<?php
	include '../model/ransom.php';
	include '../model/ship.php';
	include '../dao/base_dao.php';
	include '../dao/ransoms_dao.php';
	include '../utils/utils.php';
	include '../config.php';

	$utils = new PCRBUtils();
	
	if($_GET['password'] == PCRBConfig::$submitPassword) {
		$ransom = new Ransom();
	
		$ransom->victim_name = $_GET['victimName'];
		$ransom->system = $_GET['system'];
		$ransom->amount = $utils->stripCommasFromNumber($_GET['amount']);
		$ransom->pilots_involved = $_GET['pilotsInvolved'];
		$ransom->activity = $_GET['activity'];
		$ransom->comments = $_GET['comments'];
		$ransom->link = $_GET['relatedLink'];
		
		$ship = new Ship();
		$ship->ship_name = $_GET['shipType'];
		$ransom->ship = $ship; 

		$unformattedDate = $_GET['realDate'];
		$month = intval(substr($unformattedDate, 3, 2));
		$day = intval(substr($unformattedDate, 0, 2));
		$year = intval(substr($unformattedDate, 6, 4));
		$formattedDate = date("Y-m-d H:i:s", mktime(0, 0, 0, $month, $day, $year));

		$ransom->date = $formattedDate;
	
		$ransomDao = new RansomsDao();
		$ransom = $ransomDao->saveRansom($ransom);

		echo 'Ransom Saved Succesfully! Forwarding to Ransom Details...';
		echo '<META HTTP-EQUIV="Refresh" CONTENT="1; URL=../ransom_details.php?ransom_id=' . $ransom->id . '">';
	}
	else {
		echo 'Incorrect Password - Ransom NOT Saved!';
	}
?>
