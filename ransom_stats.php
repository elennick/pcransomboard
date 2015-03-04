<?php include 'header.php' ?>

<?
	include 'model/pilot_stats.php';
	include 'dao/base_dao.php';
	include 'dao/pilot_stats_dao.php';

	$totalRansomInvolvementEntriesToShow = 15;
	$totalRansomInvolvementIskEntriesToShow = 15;

	$pilotStatsDao = new PilotStatsDao();
	$overallRansomsInvolvedArray = $pilotStatsDao->getTopPilotsRansomsInvolved($totalRansomInvolvementEntriesToShow);
	$overallRansomsInvolvedIskArray = $pilotStatsDao->getTopPilotsRansomsInvolvedIsk($totalRansomInvolvementIskEntriesToShow);
?>

<center><div style="font-size: 16pt; font-weight: bold; margin-bottom: 8px;">Top Pilots</div></center>

<table style="width: 100%;">
	<tr>
		<td style="width: 33%;">
			<center>Total Ransom Involvement</center>
			<table id="overallRansomsInvolvedTable" style="width: 95%; margin: 10px; padding: 5px; border: 1px dotted black;">
				<?
					for($i = 0; $i < $totalRansomInvolvementEntriesToShow; $i++) {
						echo '<tr>';
						echo '<td style="width: 1%; padding-right: 5px; font-weight: bold;">' . ($i + 1) . '</td>';
						echo '<td><a href="pilot_details.php?pilot_name=' . $overallRansomsInvolvedArray[$i]->pilot_name . '">' . $overallRansomsInvolvedArray[$i]->pilot_name . '</a></td>';
						echo '<td style="width: 1%; font-size: 10pt; text-align: right;">' . $overallRansomsInvolvedArray[$i]->ransoms_involved . '</td>';
						echo '</tr>';
					}
				?>
			</table>
		</td>
		<td style="width: 33%;">
			<center>Total Ransom ISK Value</center>
			<table id="overallRansomsInvolvedIskTable" style="width: 95%; margin: 10px; padding: 5px; border: 1px dotted black;">
				<?
					for($i = 0; $i < $totalRansomInvolvementIskEntriesToShow; $i++) {
						echo '<tr>';
						echo '<td style="width: 1%; padding-right: 5px; font-weight: bold;">' . ($i + 1) . '</td>';
						echo '<td><a href="pilot_details.php?pilot_name=' . $overallRansomsInvolvedIskArray[$i]->pilot_name . '">' . $overallRansomsInvolvedIskArray[$i]->pilot_name . '</a></td>';
						echo '<td style="width: 1%; font-size: 10pt; text-align: right;">' . number_format($overallRansomsInvolvedIskArray[$i]->ransoms_involved_isk) . '</td>';
						echo '</tr>';
					}
				?>
			</table>
		</td>
		<td style="width: 33%;">
			<center>Total Ransom ISK Made</center>
			<table id="overallRansomsIskMadeTable" style="width: 95%; margin: 10px; padding: 5px; border: 1px dotted black;">
				<?
					for($i = 0; $i < 15; $i++) {
						echo '<tr>';
						echo '<td style="width: 1%; padding-right: 5px; font-weight: bold;">' . ($i + 1) . '</td>';
						echo '<td ><a href="#"></a></td>';
						echo '<td style="width: 1%; font-size: 10pt; text-align: right;"></td>';
						echo '</tr>';
					}
				?>
			</table>
		</td>
	</tr>
	<tr>
		<td style="width: 33%; padding-top: 10px;">
			<center>Largest Ransoms Ever</center>
			<table id="largestRansomsEverTable" style="width: 95%; margin: 10px; padding: 5px; border: 1px dotted black;">
				<?
					for($i = 0; $i < 15; $i++) {
						echo '<tr>';
						echo '<td style="width: 1%; padding-right: 5px; font-weight: bold;">' . ($i + 1) . '</td>';
						echo '<td ><a href="#"></a></td>';
						echo '<td style="width: 1%; font-size: 10pt; text-align: right;"></td>';
						echo '</tr>';
					}
				?>
			</table>
		</td>
		<td style="width: 33%;">
			<center>Average Ransom Value</center>
			<table id="averageRansomValueTable" style="width: 95%; margin: 10px; padding: 5px; border: 1px dotted black;">
				<?
					for($i = 0; $i < 15; $i++) {
						echo '<tr>';
						echo '<td style="width: 1%; padding-right: 5px; font-weight: bold;">' . ($i + 1) . '</td>';
						echo '<td ><a href="#"></a></td>';
						echo '<td style="width: 1%; font-size: 10pt; text-align: right;"></td>';
						echo '</tr>';
					}
				?>
			</table>
		</td>
		<td style="width: 33%;">
			<center>Ransoms Per Day</center>
			<table id="averageRansomsPerDayTable" style="width: 95%; margin: 10px; padding: 5px; border: 1px dotted black;">
				<?
					for($i = 0; $i < 15; $i++) {
						echo '<tr>';
						echo '<td style="width: 1%; padding-right: 5px; font-weight: bold;">' . ($i + 1) . '</td>';
						echo '<td ><a href="#"></a></td>';
						echo '<td style="width: 1%; font-size: 10pt; text-align: right;"></td>';
						echo '</tr>';
					}
				?>
			</table>
		</td>
	</tr>
</table>

<?php include 'footer.php' ?>