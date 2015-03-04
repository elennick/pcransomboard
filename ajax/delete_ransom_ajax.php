<?
	include '../model/ship.php';
	include '../model/ransom.php';
	include '../dao/base_dao.php';
	include '../dao/ransoms_dao.php';
	include '../config.php';

	$ransomId = $_POST['ransomId'];

	$ransomsDao = new RansomsDao();
	$ransomsDao->deleteRansom($ransomId);
?>