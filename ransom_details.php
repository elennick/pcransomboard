<?php include 'header.php' ?>

<?
	include 'model/ship.php';
	include 'model/ransom.php';
	include 'dao/base_dao.php';
	include 'dao/ransoms_dao.php';
	include 'utils/utils.php';

	$utils = new PCRBUtils();

	$ransomId = $_GET['ransom_id'];
	
	$ransomsDao = new RansomsDao();
	$ransom = $ransomsDao->getRansomById($ransomId);
	
	if(strlen($ransom->comments) <= 0) {
		$ransom->comments = 'None';
	}

	$thisRansomUrl = PCRBConfig::$home . 'ransom_details.php?ransom_id=' . $ransomId; 


echo '<center><div style="font-size: 16pt; font-weight: bold; margin-bottom: 16px;">Ransom Details</div></center>

	<table>
	<tr>
		<td style="font-weight: bold; text-align: right;">Victim Name:</td><td>' . $ransom->victim_name . '</td>
	</tr>
	<tr>
		<td style="font-weight: bold; text-align: right;">Ship Type:</td><td>' . $ransom->ship->ship_name . '</td>
	</tr>
	<tr>
		<td style="font-weight: bold; text-align: right;">System Name:</td><td>' . $ransom->system . '</td>
	</tr>
	<tr>
		<td style="font-weight: bold; text-align: right;">Ransom Amount:</td><td style="font-style: italic;">' . number_format($ransom->amount) . ' ISK</td>
	</tr>
	<tr>
		<td style="font-weight: bold; text-align: right;">Victim Activity:</td><td>' . $ransom->activity . '</td>
	</tr>
	<tr>
		<td style="font-weight: bold; text-align: right;">Date of Ransom:</td><td>' . $ransom->date . '</td>
	</tr>
	<tr>
		<td colspan="2" style="font-weight: bold; text-align: center; padding-top: 10px;"">Related Killboard Link:</td>
	</tr>
	<tr>
		<td colspan="2" style="text-align: center; width: 640px;"><a href="' . $ransom->link . '">' . $ransom->link . '</a></td>
	</tr>
	<tr>
		<td colspan="2" style="font-weight: bold; text-align: center; padding-top: 10px;">Pilots Involved:</td>
	</tr>
	<tr>
		<td colspan="2" style="text-align: center; width: 640px;">' . $utils->generateCommaDelimitedPilotsListFromArray($ransom->pilots_involved) . '</td>
	</tr>
	<tr>
		<td colspan="2" style="font-weight: bold; text-align: center; padding-top: 10px;">Additional Comments/Notes:</td>
	</tr>
	<tr>
		<td colspan="2" style="text-align: center; width: 640px;">' . $ransom->comments . '</td>
	</tr>
	<tr>
		<td colspan="2" style="font-weight: bold; text-align: center; padding-top: 10px;">Link to this ransom:</td>
	</tr>
	<tr>
		<td colspan="2" style="text-align: center; width: 640px;"><a href="' . $thisRansomUrl . '">' . $thisRansomUrl . '</a></td>
	</tr>
</table>';

?>

<?php include 'footer.php' ?>