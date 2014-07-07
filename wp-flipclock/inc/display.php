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
		$clock_js_string .= 'var currentDate'.$name.' = new Date();';
		$clock_js_string .= 'var futureDate'.$name.'  = new Date('.$phptime.' * 1000);';

		$clock_js_string .= 'var diff'.$name.' = futureDate'.$name.'.getTime() / 1000 - currentDate'.$name.'.getTime() / 1000;';

	} elseif ($datestring && !$countdown) {

		$phptime = strtotime($datestring);
		$clock_js_string .= 'var currentDate'.$name.' = new Date();';
		$clock_js_string .= 'var pastDate'.$name.'  = new Date('.$phptime.' * 1000);';
		$clock_js_string .= 'var diff'.$name.' = currentDate'.$name.'.getTime() / 1000 - pastDate'.$name.'.getTime() / 1000;';

	}
			
	$clock_js_string .= "

	jQuery(document).ready(function() {
		clock = jQuery('.".$name."').FlipClock(";

	if ($datestring) {
		$clock_js_string .= "diff".$name.", {";
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