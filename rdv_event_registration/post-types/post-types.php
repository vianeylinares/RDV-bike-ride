<?php

 //Exit if accessed directly
 if(!defined('ABSPATH')){
 	exit;
 }
 
function rdv_event_register_post_type(){
 	
	$singular = 'Event Register';
	$plural = 'Event Registers';
	
	$labels = array(
		'name' => $plural,
		'singular_name' => $singular,
		'add_name' => 'Add New ',
		'add_new_item' => 'Add New ' . $singular,
		'edit' => 'Edit ',
		'edit_item' => 'Edit ' . $singular,
		'new_item' => 'New ' . $singular,
		'view' => 'View ' . $singular,
		'view_item' => 'View ' . $singular,
		'search_term' => 'Search ' . $plural,
		'parent' => 'Parent ' . $singular,
		'not_found' => 'No ' . $plural . ' found',
		'not_found_in_trash' => 'No ' . $plural . ' in Trash',
		
	);
	
	
	$args = array (
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'exclude_from_search' => false,
		'show_in_nac_menus' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_admin_bar' => true,
		'menu_position' => 10,
		'menu_icon' => 'dashicons-images-alt',
		'can_export' => true,
		'delete_with_user' => false,
		'hierarchical' => false,
		'has_archive' => true,
		'query_var' => true,
		'capability_type' => 'post',
		'map_meta_cap' => true,
		'capabilities' => array(
				//'create_posts' => false
			),
		'rewrite' => array(
			'slug' => 'event_registers',
			'with_front' => true,
			'pages' => true,
			'feeds' =>  false,		
		),
		'supports' => array(
			'title',
			//'editor',
			//'author',
			'custom_fields',
			//'thumbnail'
		)
		
	);
	
	register_post_type('event_registers', $args);
		
	
 } 
add_action('init', 'rdv_event_register_post_type');


function rdv_participants_register_post_type(){
 	
	$singular = 'Registered Participant';
	$plural = 'Registered Participants';
	
	$labels = array(
		'name' => $plural,
		'singular_name' => $singular,
		'add_name' => 'Add New ',
		'add_new_item' => 'Add New ' . $singular,
		'edit' => 'Edit ',
		'edit_item' => 'Edit ' . $singular,
		'new_item' => 'New ' . $singular,
		'view' => 'View ' . $singular,
		'view_item' => 'View ' . $singular,
		'search_term' => 'Search ' . $plural,
		'parent' => 'Parent ' . $singular,
		'not_found' => 'No ' . $plural . ' found',
		'not_found_in_trash' => 'No ' . $plural . ' in Trash',
		
	);
	
	
	$args = array (
		'labels' => $labels,
		'public' => false,
		'publicly_queryable' => false,
		'exclude_from_search' => false,
		'show_in_nac_menus' => false,
		'show_ui' => true,
		'show_in_menu' => false,
		'show_in_admin_bar' => false,
		'menu_position' => 10,
		'menu_icon' => 'dashicons-images-alt',
		'can_export' => true,
		'delete_with_user' => false,
		'hierarchical' => false,
		'has_archive' => true,
		'query_var' => true,
		'capability_type' => 'post',
		'map_meta_cap' => true,
		'capabilities' => array(
				'create_posts' => false
			),
		'rewrite' => array(
			'slug' => 'participants',
			'with_front' => true,
			'pages' => true,
			'feeds' =>  false,		
		),
		'supports' => array(
			'title',
			//'editor',
			//'author',
			'custom_fields',
			//'thumbnail'
		)
		
	);
	
	register_post_type('participants', $args);
		
	
 } 
add_action('init', 'rdv_participants_register_post_type');