<?php

/* ENQUEUE SCRIPTS */
function wp_flipclock_enqueue_script() {
	wp_enqueue_script(
		'flipclock',
		plugins_url( '/js/flipclock.min.js' , __FILE__ ),
		array( 'jquery' ), '0.5.5'
	);
	wp_enqueue_style( 'flipclock', plugins_url( '/css/flipclock.css' , __FILE__ ) );
	wp_enqueue_style( 'flipclock-added', plugins_url( '/css/added.css' , __FILE__ ) );
}

add_action( 'wp_enqueue_scripts', 'wp_flipclock_enqueue_script' );

?>