<?php include 'header.php' ?>

<?
	include 'model/pilot_stats.php';
	include 'model/ship.php';
	include 'model/ransom.php';
	include 'dao/base_dao.php';
	include 'dao/pilot_stats_dao.php';
	include 'dao/ransoms_dao.php';
	
	$pilotName = $_GET['pilot_name'];

	$pilotStatsDao = new PilotStatsDao();
	$pilotStats = $pilotStatsDao->getPilotStats($pilotName);

	$ransomsDao = new RansomsDao();
	$ransomsByThisPilot = $ransomsDao->getRansomsByPilot($pilotName, 12);

echo '<center><div style="font-size: 18pt; font-weight: bold; padding-top: 10px;">' . $pilotName . '</div></center>

<br>

<table style="margin: 10px;">
	<tr>
		<td style="width: 400px;">
			<div>
				<center>

				<b>Total Ransom Involvement:</b>
				<br>	
				' . $pilotStats->ransoms_involved . ' Ransom(s)
				
				<br>
				<br>

				<b>Total Gang Ransom ISK Made:</b>
				<br>	
				' . number_format($pilotStats->ransoms_involved_isk) . ' ISK

				<br>
				<br>

				<b>Total Personal Ransom ISK Made:</b>
				<br>	
				' . number_format($pilotStats->ransoms_money_made) . ' ISK

				<br>
				<br>

				<b>Largest Ransom Value Obtained:</b>
				<br>
				' . number_format($pilotStats->largest_ransom) . ' ISK

				<br>
				<br>

				<b>Average Ransom Value Obtained:</b>
				<br>
				' . number_format($pilotStats->avg_ransoms_value) . ' ISK

				<br>
				<br>

				<b>Average Number Of Ransoms Per Day:</b>
				<br>
				' . $pilotStats->avg_ransoms_per_day . ' Ransoms

				</center>
			</div>
		</td>

		<td style="width: 600px; border: 1px dotted black; padding: 10px; height: 100%; vertical-align: top;">
			<center><b><i>Recent Ransoms By This Pilot</i></b></center>

			<br>

			<table style="width: 100%;">
';

			for ($i = 0; $i < sizeof($ransomsByThisPilot); $i++) {
				$thisRansom = $ransomsByThisPilot[$i];
				echo '<tr>';
				echo '<td style="text-align: left; width: 25%;">' . substr($thisRansom->date, 0, 10) . '</td>';
				echo '<td style="text-align: center; width: 25%;"><a href="ransom_details.php?ransom_id=' . $thisRansom->id . '">' . $thisRansom->victim_name . '</a></td>';
				echo '<td style="text-align: center; width: 25%;">' . $thisRansom->ship->ship_name . '</td>';
				echo '<td style="text-align: right; width: 25%; font-style: italic;">' . number_format($thisRansom->amount) . ' ISK</td>';
				echo '</tr>';
			}

echo '
			</table>
		</td>		
	</tr>
</table>';
?>

<?php include 'footer.php' ?>