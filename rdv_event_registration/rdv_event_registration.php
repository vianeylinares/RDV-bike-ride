<?php
/*
 * Plugin name: RDV Event Registration
 * Plugin URI: rdvsite.com
 * Description: Event Registration
 * Author: RDV
 * Version: 1.0.0
 * License: Open
 * 
 */

 //Exit if accessed directly
 if(!defined('ABSPATH')){
 	exit;
 }


include( plugin_dir_path( __FILE__ ) . 'post-types/post-types.php' );
include( plugin_dir_path( __FILE__ ) . 'post-types/meta-boxes.php' );
include( plugin_dir_path( __FILE__ ) . 'functions.php' );
include( plugin_dir_path( __FILE__ ) . 'register.php' );