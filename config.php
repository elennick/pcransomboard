<?php
class PCRBConfig {
	//the name to use for this site
	public static $corpName = 'The Python Cartel';
	public static $corpLink = 'http://python.griefwatch.net/';
	public static $home = 'http://www.pcransomboard.com/python/';

	//the hex value of the colors of the body background and the links/vlinks
	public static $linkColor = '#003DF5';
	public static $visitedLinkColor = '#003DF5';
	public static $bodyColor = '#EDEDED';

	//the general password that will be used when submitting a new ransom
	public static $submitPassword = 'magnet';

	//the more privledged password that will be used to access administrative functions on the board
	public static $adminPassword = 'archon';

	//the number of ransom entries to show on the main list
	public static $numOfRansomEntries = 25;

	//the database address, name, user and password
	public static $dbLocation = 'db1577.perfora.net';
	public static $dbName = 'db252280320';
	public static $dbUser = 'dbo252280320';
	public static $dbPassword = '8HZWugG2';
}
?>