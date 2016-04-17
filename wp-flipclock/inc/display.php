<?php
/* FUNCTION FOR GETTING TIMEZONE OFFSET */
function wp_flipclock_get_timezone_offset($timezone="UTC"){
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
// (BA) Add safety default for $name in case function is called from other than the shortcode handler
function wp_flipclock_display_clock($name = "wpflipclock", $countdown = "", $datestring = "", $clockface = "hours", $lang="english", $timezone="UTC", $seconds=1, $hidelabel = "false")
{


	$countdown = strtolower( $countdown );

	if ( $countdown == "false" ) {
		$countdown = FALSE;
	}

	$clock_string = "";
	$clock_string .= '<div class="'.$name.'"></div>';

	$clock_js_string = "";
	$clock_js_string .= '<script type="text/javascript">
	var clock;';

	$phptime = "";




	if ( $datestring ) {
		$phptime = strtotime($datestring);
		$javascripttime = date('r', $phptime);
	}
	// (BA) Replace dash with underscore in Javascript vars
	$calc_name = str_replace('-', '_', $name);
	// (BA) Tidy up by removing console debug logging in below code
	if ($datestring && $countdown) {

		$timeOffset = wp_flipclock_get_timezone_offset($timezone);
		$clock_js_string .= "var currentDate".$calc_name." = new Date().getTime() + new Date().getTimezoneOffset()*0 - ". $timeOffset .";";
		$clock_js_string .= "var futureDate".$calc_name."  = Date.parse('".$javascripttime."');";

		$clock_js_string .= 'var diff'.$calc_name.' = futureDate'.$calc_name.' / 1000 - currentDate'.$calc_name.' / 1000;';
		$clock_js_string .= 'if (diff'.$calc_name.' < 0) { diff'.$calc_name.' = 0; }';
		//$clock_js_string .= 'console.log(diff'.$calc_name.');';

	} elseif ($datestring && !$countdown) {

		$timeOffset = wp_flipclock_get_timezone_offset($timezone);
		$clock_js_string .= "var currentDate".$calc_name." = new Date().getTime() + new Date().getTimezoneOffset()*60000 - ". $timeOffset .";";
		$clock_js_string .= "var pastDate".$calc_name." 	= Date.parse('".$javascripttime."');";
		$clock_js_string .= 'var diff'.$calc_name.' = currentDate'.$calc_name.' / 1000 - pastDate'.$calc_name.' / 1000;';
		//$clock_js_string .= 'console.log(Date.parse("'.$javascripttime.'"));';
		//$clock_js_string .= 'console.log();';
	}
	
	$clock_js_string .= "jQuery(document).ready(function() {
		clock = jQuery('.".$name."').FlipClock(";

			if ($datestring) {
				$clock_js_string .= "diff".$calc_name.", {";
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
				case "12h":
				$clock_js_string .= "clockFace: 'TwelveHourClock'";
				break;
				case "24h":
				$clock_js_string .= "clockFace: 'TwentyFourHourClock'";
				break;
				default:
				break;
			}


			$clock_js_string .= "});
});
</script>";

$clock_css_string = "";
	// (BA) $hidelabel is string so check for 'true'
	// (BA) Add clock main class desendant dependency for hide of label
	// (BA) Remove test for empty name ($name will always be set to something now)
	if ( $hidelabel == "true" ) {
	$clock_css_string = '<style>
	.'.$name.' .flip-clock-label {
		display: none;
	}
	</style>';
}

$clock_total_string = $clock_string . $clock_js_string . $clock_css_string;

return $clock_total_string;
}






/** SHORTCODE FUNCTION **/
function wp_flipclock_shortcode($atts)
{
	extract( shortcode_atts( array(
		'name' => '', // (BA) If not in shortcode params then use empty string
		'countdown' => '',
		'date' => '',
		'lang' => 'english',
		'timezone' => 'UTC',
		'face' => 'hours',
		'seconds' => '1',
		'hidelabel' => 'false'
		), $atts ) );
		
		if( empty($name) )
			// (BA) If the name is not set create a random one
			$name = uniqid("wpflipclock-");
	return wp_flipclock_display_clock($name, $countdown, $date, strtolower($face), $lang, $timezone, intval($seconds), $hidelabel);
}

add_shortcode('flipclock','wp_flipclock_shortcode');

?>
