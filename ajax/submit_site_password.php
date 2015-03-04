<?php
	include '../config.php';

	if($_POST['password'] == PCRBConfig::$submitPassword) {
		session_register("accessPassword");
		setcookie("accessPassword", $_POST['password'], time() + (3600 * 24));

		echo $_COOKIE["accessPassword"];
		echo '<a href="index.php">Click To Continue</a>';
	}
	else {
		echo 'You Do Not Have Permission To View This Ransom Board!';
	}
?>
