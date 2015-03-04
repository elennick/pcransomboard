<?php
class PilotStats {
	public $pilot_name;

	//the number of ransoms this pilot has ever been involved in
	public $ransoms_involved;

	//the total amount of money made from all ransoms this pilot has ever been involved in BEFORE it was split among all pilots involved
	public $ransoms_involved_isk;

	//the total amount of money this pilot is estimated to have made from all the ransoms he has ever been involved in
	public $ransoms_money_made;

	//largest ransom this pilot has ever been a part of
	public $largest_ransom;

	//the average value of ransoms this pilot has obtained
	public $avg_ransoms_value;

	//the average number of ransoms this pilot successfuly obtains per day
	public $avg_ransoms_per_day;
}
?>
