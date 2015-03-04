<html>

<header>

<script type="text/javascript" src="scripts/ext-2.1/adapter/ext/ext-base.js"></script>
<script type="text/javascript" src="scripts/ext-2.1/ext-all.js"></script>
<link rel="stylesheet" type="text/css" href="scripts/ext-2.1/resources/css/ext-all.css">
<? include 'config.php'; ?>
<? include 'version.php'; ?>

</header>

<body link="<? echo PCRBConfig::$linkColor; ?>" vlink="<? echo PCRBConfig::$visitedLinkColor; ?>" style="font-family: verdana;">

<center>

<? 	
	/*
	if(PCRBConfig::$passwordProtectAccess && $_COOKIE["accessPassword"] != PCRBConfig::$submitPassword) {
		echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=site_password.php">';
	}
	*/
?>

<table style="border: 0; margin: 0; padding: 0; border-collapse: collapse;">
	<tr style="border: 0; margin: 0; padding: 0;">
		<td colspan="5" style="border: 0; margin: 0; padding: 0;">
			<center><a href="<? PCRBConfig::$home; ?>"><img src="media/header/pcrb_title_top.jpg"></a></center>
		</td>
	</tr>
	<tr style="border: 0; margin: 0; padding: 0;">
		<td style="border: 0; margin: 0; padding: 0;">
			<a href="index.php"><img src="media/header/pcrb_home_button.jpg" style="border: 0"></a>
		</td>
		<td style="border: 0; margin: 0; padding: 0;">
			<a href="ransom_stats.php"><img src="media/header/pcrb_stats_button.jpg" style="border: 0"></a>
		</td>
		<td style="border: 0; margin: 0; padding: 0;">
			<a href="ransom_submit.php"><img src="media/header/pcrb_submitransom_button.jpg" style="border: 0"></a>
		</td>
		<td style="border: 0; margin: 0; padding: 0;">
			<a href="search.php"><img src="media/header/pcrb_search_button.jpg" style="border: 0"></a>
		</td>
		<td style="border: 0; margin: 0; padding: 0;">
			<a href="admin.php"><img src="media/header/pcrb_admin_button.jpg" style="border: 0"></a>
		</td>
	</tr>
</table>

<div id="siteBody" style="background: <? echo PCRBConfig::$bodyColor; ?>; padding-top: 10px; padding-bottom: 10px; width: 1024px;">