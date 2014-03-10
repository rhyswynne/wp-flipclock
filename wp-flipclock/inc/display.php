<?php

/** FUNCTION FOR DISPLAYING THE CLOCK **/
function wp_flipclock_display_clock($name, $countdown = "", $datestring = "", $clockface = "hours")
{
	$clock_string = "";
	$clock_string .= '<div class="'.$name.'"></div>';

	$clock_js_string = "";
	$clock_js_string .= '<script type="text/javascript">
			var clock;';


	if ($datestring && $countdown) {

		$phptime = strtotime($datestring);
		$clock_js_string .= 'var currentDate = new Date();';
		$clock_js_string .= 'var futureDate  = new Date('.$phptime.' * 1000);';

		$clock_js_string .= 'var diff = futureDate.getTime() / 1000 - currentDate.getTime() / 1000;';

	} elseif ($datestring && !$countdown) {

		$phptime = strtotime($datestring);
		$clock_js_string .= 'var currentDate = new Date();';
		$clock_js_string .= 'var pastDate  = new Date('.$phptime.' * 1000);';
		$clock_js_string .= 'var diff = currentDate.getTime() / 1000 - pastDate.getTime() / 1000;';

	}
			
	$clock_js_string .= "

	jQuery(document).ready(function() {
		clock = jQuery('.".$name."').FlipClock(";

	if ($datestring) {
		$clock_js_string .= "diff, {";
	} else {
		$clock_js_string .= "{";
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
	      'face' => 'hours'
     ), $atts ) );
    return wp_flipclock_display_clock($name, $countdown, $date, strtolower($face));
}

add_shortcode('flipclock','wp_flipclock_shortcode');

?>