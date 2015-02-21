<?php
/* FUNCTION FOR GETTING TIMEZONE OFFSET */
function get_timezone_offset($timezone="UTC"){
 if($timezone=="UTC"){
	return 0;
 } else {
	$dateTimeOfZone = new DateTimeZone($timezone);
	$dateTimeInZone = new DateTime("now", $dateTimeOfZone);
	$dateTimeOfUTC = new DateTimeZone("UTC");
	$dateTimeInUTC = new DateTime("now", $dateTimeOfUTC);
	return 1000*($dateTimeOfUTC->getOffset($dateTimeInUTC)-$dateTimeOfZone->getOffset($dateTimeInZone));	
 }
}

/** FUNCTION FOR DISPLAYING THE CLOCK **/
function wp_flipclock_display_clock($name, $countdown = "", $datestring = "", $clockface = "hours", $lang="english", $timezone="UTC", $seconds=1)
{



	$clock_string = "";
	$clock_string .= '<div class="'.$name.'"></div>';

	$clock_js_string = "";
	$clock_js_string .= '<script type="text/javascript">
			var clock;';


	if ($datestring && $countdown) {

		$timeOffset = get_timezone_offset($timezone);
		$clock_js_string .= "var currentDate = new Date().getTime() + new Date().getTimezoneOffset()*60000 - $timeOffset;";
		$clock_js_string .= "var futureDate  = Date.parse('$datestring');";

		$clock_js_string .= 'var diff = futureDate / 1000 - currentDate / 1000;';

	} elseif ($datestring && !$countdown) {

		$timeOffset = get_timezone_offset($timezone);
		$clock_js_string .= "var currentDate = new Date().getTime() + new Date().getTimezoneOffset()*60000 - $timeOffset;";
		$clock_js_string .= "var pastDate  = Date.parse('$datestring');";
		$clock_js_string .= 'var diff = currentDate / 1000 - pastDate / 1000;';

	}
			
	$clock_js_string .= "

	jQuery(document).ready(function() {
		clock = jQuery('.".$name."').FlipClock(";

	if ($datestring) {
		$clock_js_string .= "diff, {";
	} else {
		$clock_js_string .= "{";
	} 

	if ($lang)
	{

		$clock_js_string .= "language: '".$lang."', ";

	}
	
	if ($countdown)
	{

		$clock_js_string .= "countdown: true";

	}


	if ($countdown && $clockface && $clockface != "hours") {
		$clock_js_string .= ", ";
	}

	switch ($clockface) {
		case "days":
			if(!$seconds) $clock_js_string .= "showSeconds: false, ";
			$clock_js_string .= "clockFace: 'DailyCounter'";
			break;
		case "minutes":
			$clock_js_string .= "clockFace: 'MinuteCounter'";
			break;
		default:
			break;
	}


	$clock_js_string .= "});
	});
	</script>";

	$clock_total_string = $clock_string . $clock_js_string;

	return $clock_total_string;
}






/** SHORTCODE FUNCTION **/
function wp_flipclock_shortcode($atts)
{
	extract( shortcode_atts( array(
	      'name' => 'wpflipclock',
	      'countdown' => '',
	      'date' => '',
	      'lang' => 'english',
	      'timezone' => 'UTC',
	      'face' => 'hours',
	      'seconds' => '1'
     ), $atts ) );
    return wp_flipclock_display_clock($name, $countdown, $date, strtolower($face), $lang, $timezone, intval($seconds));
}

add_shortcode('flipclock','wp_flipclock_shortcode');

?>
