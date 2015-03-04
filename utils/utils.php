<?php
class PCRBUtils {
	function generateCommaDelimitedPilotsListFromArray($array) {
		$displayString = '';

		for($i = 0; $i < sizeof($array); $i++) {
			if($i > 0) {
				$displayString = $displayString . ", ";
			}

			$displayString = $displayString . "<a href='pilot_details.php?pilot_name=" . $array[$i] . "'>" . $array[$i] . "</a>";
		}

		return $displayString;
	}

	function stripCommasFromNumber($number) {
		$numArray = str_split($number);
		$fixedNumber = '';

		for($i = 0; $i < sizeof($numArray); $i++) {
			if($numArray[$i] != ',') {
				$fixedNumber = $fixedNumber . $numArray[$i];
			} 
		}
		
		return $fixedNumber;
	}
}
?>