<?
	include '../model/ship.php';
	include '../model/ransom.php';
	include '../dao/base_dao.php';
	include '../dao/ransoms_dao.php';
	include '../utils/utils.php';
	include '../config.php';

	$ransomsDao = new RansomsDao();
	$ransomsList = $ransomsDao->getRansoms(1000);
	$utils = new PCRBUtils();
	
	if($_POST['password'] == PCRBConfig::$adminPassword) {
		echo '
			<center><div style="font-size: 16pt; font-weight: bold; margin-bottom: 16px;">Admin</div></center>

			<table style="width: 1000px;">
				<tr style="font-style: bold; font-size: 14pt; text-decoration: underline; height: 30px;">
					<td style="width: 100px; text-align: center;">Action</td>
					<td style="width: 125px; text-align: center;">Date</td>
					<td style="width: 150px; text-align: center;">Victim Name</td>
					<td style="width: 150px; text-align: center;">Ship</td>
					<td style="width: 100px; text-align: center;">System</td>
					<td style="width: 150px; text-align: center;">Amount Made</td>
					<td style="width: 300px; text-align: center;">Pilots Involved</td>
				</tr>';

				for ($i = 0; $i < sizeof($ransomsList); $i++) {
					$thisRansom = $ransomsList[$i];		

					echo '<tr style="height: 30px;">';
					echo '<td style="text-align: center; width: 125px;">
						<span><input type="button" name="Edit" value="Edit" onclick="editButtonClicked(' . $thisRansom->id . ')" style="width: 40px;">&nbsp;<input type="button" name="Delete" value="Delete" onclick="deleteButtonClicked(' . $thisRansom->id . ')" style="width: 55px;"></span>
					</td>';
					echo '<td style="text-align: center;">' . substr($thisRansom->date, 0, 10) . '</td>';
					echo '<td style="text-align: center;"><a href="ransom_details.php?ransom_id=' . $thisRansom->id . '">' . $thisRansom->victim_name . '</a></td>';
					echo '<td style="text-align: center;">' . $thisRansom->ship->ship_name . '</td>';
					echo '<td style="text-align: center; text-align: center;">' . $thisRansom->system . '</td>';
					echo '<td style="font-style: italic; text-align: center;">' . number_format($thisRansom->amount) . '</td>';
					echo '<td style="font-size: 9pt; text-align: center;">' . $utils->generateCommaDelimitedPilotsListFromArray($thisRansom->pilots_involved) . '</td>';
					echo '</tr>';
				}

			echo '</table>';
	}
	else {
		echo 'Incorrect Admin Password! Unable to Load Admin Page.';
	}
?>