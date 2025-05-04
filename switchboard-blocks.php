<?php
/*
Plugin Name: Switchboard Blocks
Plugin URI: https://yourwebsite.com/plugin
Description: A plugin to clone and display GitHub repositories.
Version: 1.0.0
Author: Your Name
Author URI: https://yourwebsite.com/
License: GPL2
Text Domain: switchboard-blocks
*/

define( 'SWITCHBOARD_BLOCKS_VERSION', '1.0.0' );
define( 'SWITCHBOARD_BLOCKS_PLUGIN_FILE', __FILE__ );

/**
 * Enqueue plugin-wide styles and scripts.
 */
function switchboard_blocks_enqueue_global_assets() {
	wp_enqueue_style(
		'switchboard-blocks-global-style',
		plugins_url( 'assets/style.css', __FILE__ ),
		array(),
		SWITCHBOARD_BLOCKS_VERSION
	);

}
add_action( 'wp_enqueue_scripts', 'switchboard_blocks_enqueue_global_assets', 20 );

/**
 * Registers all block assets for the plugin.
 */
function switchboard_blocks_register_blocks() {

	$block_dir = plugin_dir_path( __FILE__ ) . 'build/kickstarter-home';

	// Register the Kickstarter Promo block
	register_block_type(
		$block_dir,
		[
			'render_callback' => 'GLD\\Blocks\\render_kickstarter_promo',

		]
	);

	// Include the render callback if the file exists
	$render_file = trailingslashit( $block_dir ) . 'render.php';
	if ( file_exists( $render_file ) ) {
		include_once $render_file;
	}
}
add_action( 'init', 'switchboard_blocks_register_blocks' );

