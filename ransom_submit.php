<?php include 'header.php' ?>

<script type='Text/JavaScript' src='scripts/scw.js'></script>

<center>

<?php
include 'model/ship.php';
include 'dao/base_dao.php';
include 'dao/ships_dao.php';
include 'dao/activities_dao.php';

$shipsDao = new ShipsDao();
$shipsList = $shipsDao->getShipsList();

$activitiesDao = new ActivitiesDao();
$activitiesList = $activitiesDao->getActivitiesList();
?>

<center><div style="font-size: 16pt; font-weight: bold; margin-bottom: 16px;">Submit Ransom</div></center>

<form name="ransomSubmitForm" id="ransomSubmitForm" action="ajax/ransom_submit_ajax.php">

<table>
	<tr>
		<td style="width: 500px; text-align: right; padding-right: 10px; font-weight: bold;">Victim Name:</td>
		<td style="width: 500px;"><input type="text" name="victimName"></td>
	</tr>
	<tr>
		<td style="width: 500px; text-align: right; padding-right: 10px; font-weight: bold;">Ship Type:</td>
		<td style="width: 500px;">
			<select name="shipType">
				<?
					for ($i = 0; $i < sizeof($shipsList); $i++) {
						$ship = $shipsList[$i]->ship_name;
						echo "<option value='" . $ship . "'>" . $ship . "</option>";
					}	
				?>
			</select>
		</td>
	</tr>
	<tr>
		<td style="width: 500px; text-align: right; padding-right: 10px; font-weight: bold;">System Name:</td>
		<td style="width: 500px;"><input type="text" name="system"></td>
	</tr>
	<tr>
		<td style="width: 500px; text-align: right; padding-right: 10px; font-weight: bold;">Amount Ransomed For:</td>
		<td style="width: 500px;"><input type="text" name="amount">&nbsp;ISK</td>
	</tr>
	<tr>
		<td style="width: 500px; text-align: right; padding-right: 10px; font-weight: bold;">Pilots Involved:</td>
		<td style="width: 500px;"><input type="text" name="pilotsInvolved"><span style="font-size: 8pt; color: red; vertical-align: middle;">&nbsp;*Comma Delimited List</span></td>
	</tr>
	<tr>
		<td style="width: 500px; text-align: right; padding-right: 10px; font-weight: bold;">Victims Activity:</td>
		<td style="width: 500px;">
			<select name="activity">
				<?
					for ($i = 0; $i < sizeof($activitiesList); $i++) {
						echo "<option value='" . $activitiesList[$i] . "'>" . $activitiesList[$i] . "</option>";
					}	
				?>
			</select>
		</td>
	</tr>
	<tr>
		<td style="width: 500px; text-align: right; padding-right: 10px; font-weight: bold;">Date:</td>
		<td style="width: 500px;">
			<input type="text" name="date" id="date" disabled="true">
			<a href="#" onclick="scwShow(scwID('date'), event); return false;"><img src="media/calendar-icon.jpg" style="vertical-align: bottom;"></a>
			<input type="hidden" name="realDate" id="realDate">
		</td>
	</tr>
	<tr>
		<td style="width: 500px; text-align: right; padding-right: 10px; font-weight: bold;">Killboard Link:</td>
		<td style="width: 500px;"><input type="text" name="relatedLink" style="width: 200px;"><span style="font-size: 8pt; color: red; vertical-align: middle;">&nbsp;*Optional</span></td>
	</tr>
</table>

<br>

<span style="font-weight: bold;">Ransom Chat or Additional Comments</span>
<span style="font-size: 8pt; color: red; vertical-align: middle;">*Optional</span>

<br>

<textarea id="comments" name="comments" cols="50" rows="5"></textarea>

<br>
<br>

<b>Password:</b>&nbsp;<input type="password" name="password" id="password">

<br>
<br>

<input type="button" id="submitRansomButton" value="Submit Ransom" style="width: 250px; height: 30px;" onclick="submitRansom();">

</form>

</center>

<script type="text/javascript">
var monthNames = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];

function submitRansom() {
	var params = {
		victimName : document.ransomSubmitForm.victimName.value,
        	shipType : document.ransomSubmitForm.shipType.value,
                system : document.ransomSubmitForm.system.value,
                amount : document.ransomSubmitForm.amount.value,
                pilotsInvolved : document.ransomSubmitForm.pilotsInvolved.value,
		activity : document.ransomSubmitForm.activity.value,
                date : convertDateToInts(document.ransomSubmitForm.date.value),
		relatedLink : document.ransomSubmitForm.relatedLink.value,
                comments : document.ransomSubmitForm.comments.value,
		password : document.ransomSubmitForm.password.value
        }

	if(validateRansomForm(params)) {
		document.ransomSubmitForm.realDate.value = params.date;
		document.ransomSubmitForm.submit();
/*
		var submitMsgDiv = Ext.get('submitMessageDiv');
		submitMsgDiv.load({
			url: 'ajax/ransom_submit_ajax.php' , 
			params: params,
			method: 'POST',
			text: 'Saving...'
		});
*/
	}
}

function validateRansomForm(params) {
	var errorMsg;

	if(params.victimName.length <= 0) {
		errorMsg = 'Victim\'s Name Cannot Be Blank!';	
	}
	else if(params.victimName.length > 32) {
		errorMsg = 'Victim\'s Name Cannot Be Longer Than 32 Characters!';
	}
	else if(params.system.length <= 0) {
		errorMsg = 'System Name Cannot Be Blank!';
	}
	else if(params.system.length > 16) {
		errorMsg = 'System Name Cannot Be Longer Than 16 Characters!';
	}
	else if(params.amount.length <= 0) {
		errorMsg = 'Ransom Amount Cannot Be Blank!';
	}
	else if(!parseInt(params.amount)) {
		errorMsg = 'Ransom Amount Must Be A Valid Number!';
	}
	else if(params.pilotsInvolved.length <= 0) {
		errorMsg = 'Pilots Involved Cannot Be Blank!';
	}
	else if(params.relatedLink.length > 1024) {
		errorMsg = 'Links Cannot Be Longer Than 1024 Characters!';
	}
	else if(params.comments.length > 2048) {
		errorMsg = 'Comments Cannot Be Longer Than 2048 Characters!';
	}
	else if(params.password.length <= 0) {
		errorMsg = 'Password Cannot Be Blank!';
	}

	if(errorMsg) {
		Ext.Msg.alert('Validation Error', errorMsg);
		return false;
	}

	return true;
}

function setDateField() {
	var dateNow = new Date(Date.parse(new Date().toDateString()));

	var dateNowDay = dateNow.getDate();
	if(dateNowDay < 10) {
		dateNowDay = '0' + dateNow.getDate();
	}

	var dateNowString = dateNowDay + ' ' + monthNames[dateNow.getMonth()] + ' ' + dateNow.getFullYear();
	document.ransomSubmitForm.date.value = dateNowString;
}

function convertDateToInts(dateString) {
	var year = dateString.substring(dateString.lastIndexOf(' ') + 1, dateString.length);
	var day = dateString.substring(0, dateString.indexOf(' '));
	var monthString = dateString.substring(dateString.indexOf(' ') + 1, dateString.lastIndexOf(' '));
	var month;

	for(var i = 0; i < monthNames.length; i++) {
		if(monthString == monthNames[i]) {
			month = i + 1;
			if(month < 10) {
				month = '0' + month;
			}
			break;
		}
	}

	return day + '-' + month + '-' + year;
}

Ext.onReady(function() {
	setDateField();
});
</script>

<?php include 'footer.php' ?>