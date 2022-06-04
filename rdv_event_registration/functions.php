<?php

//Exit if accessed directly
if(!defined('ABSPATH')){
	exit;
}


function RDV_admin_css_and_js(){

	$plugin_url = plugin_dir_url( __FILE__ );

	/* Admin custom CSS */
    wp_enqueue_style( 'admin-style', $plugin_url . '/css-js/admin-style.css' );    

    /* jQuery */
    wp_enqueue_script( 'jquery' );

    /* jQuery Draggable */
    wp_enqueue_script( 'jquery-ui-draggable' );

    /* Admin custom JS */
    wp_register_script( 'admin-custom', plugin_dir_url( __FILE__ ) . '/css-js/admin-js.js', array('jquery'), '1', true );
    wp_enqueue_script( 'admin-custom' );

}
add_action( 'admin_enqueue_scripts', 'RDV_admin_css_and_js' );


function RDV_frontend_css_and_js() {

	$plugin_url = plugin_dir_url( __FILE__ );

    /* Frontend custom CSS */
    wp_enqueue_style( 'frontend-style', $plugin_url . '/css-js/style.css' );

}
add_action( 'wp_enqueue_scripts', 'RDV_frontend_css_and_js' );


function getCurrentEventID(){
	
	$args = array(
	    'post_type' => 'event_registers',
	    'order' => 'DESC',
	    'posts_per_page' => 1,
	    'post_status' => array('publish')	    				    
	);
		
	$query = new WP_Query($args);
	
	while($query -> have_posts()) : $query -> the_post();

		$event_id = get_the_ID();

	endwhile;
	
	return $event_id;	
	
}


function isCurrentEventEnable(){
	
	$args = array(
	    'post_type' => 'event_registers',
	    'order' => 'DESC',
	    'posts_per_page' => 1,
	    'post_status' => array('publish')
	);
		
	$query = new WP_Query($args);
	
	while($query -> have_posts()) : $query -> the_post();

		$event_enable = get_post_meta(get_the_ID(), 'event_checked', true);

	endwhile;
	
	return $event_enable;
	
}


function registrationFormGeneration($first_name, $last_name, $email, $gender, $date_of_birth, $street_and_number, $colony, $city, $state, $zip_code, $emergency_phone, $attendee_id){
	
	require_once('fpdf/fpdf.php');
	require_once('fpdi/fpdi.php');
	
	$args = array(
	    'post_type' => 'event_registers',
	    'order' => 'DESC',
	    'posts_per_page' => 1,
	    'post_status' => array('publish')
	);
		
	$query = new WP_Query($args);
	
	while($query -> have_posts()) : $query -> the_post();
		
		$event_pdf_document = get_post_meta(get_the_ID(), 'event_pdf_document', true);
		$firstNameX = get_post_meta(get_the_ID(), 'firstNameX', true);
		$firstNameY = get_post_meta(get_the_ID(), 'firstNameY', true);
		$lastNameX = get_post_meta(get_the_ID(), 'lastNameX', true);
		$lastNameY = get_post_meta(get_the_ID(), 'lastNameY', true);
		$maleX = get_post_meta(get_the_ID(), 'maleX', true);
		$maleY = get_post_meta(get_the_ID(), 'maleY', true);
		$femaleX = get_post_meta(get_the_ID(), 'femaleX', true);
		$femaleY = get_post_meta(get_the_ID(), 'femaleY', true);		
		$dateX = get_post_meta(get_the_ID(), 'dateX', true);
		$dateY = get_post_meta(get_the_ID(), 'dateY', true);
		$emailX = get_post_meta(get_the_ID(), 'emailX', true);
		$emailY = get_post_meta(get_the_ID(), 'emailY', true);
		$phoneX = get_post_meta(get_the_ID(), 'phoneX', true);
		$phoneY = get_post_meta(get_the_ID(), 'phoneY', true);
		$addressX = get_post_meta(get_the_ID(), 'addressX', true);
		$addressY= get_post_meta(get_the_ID(), 'addressY', true);
		$cityX = get_post_meta(get_the_ID(), 'cityX', true);
		$cityY = get_post_meta(get_the_ID(), 'cityY', true);
		$stateX = get_post_meta(get_the_ID(), 'stateX', true);
		$stateY = get_post_meta(get_the_ID(), 'stateY', true);
		$zipCodeX = get_post_meta(get_the_ID(), 'zipCodeX', true);
		$zipCodeY = get_post_meta(get_the_ID(), 'zipCodeY', true);		
		
	endwhile;
	
	
	// Initiate FPDI
	$pdf =& new FPDI();

	// Add a page
	$pdf->AddPage();

	// Set the sourcefile
	$pdf->setSourceFile($event_pdf_document);

	// Import page 1
	$tplIdx = $pdf->importPage(1);
	
	$pdf->useTemplate($tplIdx, 0, 0, 210, 290);
	
	// Write text on the imported page
	$pdf->SetFont('Arial');
	$pdf->SetTextColor(13, 26, 129);
	
	$pdf->SetXY(($firstNameX*210)/100, ($firstNameY*297)/100);
	$pdf->Write(0, $first_name);

	$pdf->SetXY(($lastNameX*210)/100, ($lastNameY*297)/100);
	$pdf->Write(0, $last_name);
	
	if($gender == "male"){
		$pdf->SetXY(($maleX*210)/100, ($maleY*297)/100);
		$pdf->Write(0, "X");
	}
	
	if($gender == "female"){
		$pdf->SetXY(($femaleX*210)/100, ($femaleY*297)/100);
		$pdf->Write(0, "X");
	}
	
	$pdf->SetXY(($dateX*210)/100, ($dateY*297)/100);
	$pdf->Write(0, $date_of_birth); 

	$pdf->SetXY(($emailX*210)/100, ($emailY*297)/100);
	$pdf->Write(0, $email);

	$pdf->SetXY(($phoneX*210)/100, ($phoneY*297)/100);
	$pdf->Write(0, $emergency_phone);

	$pdf->SetXY(($addressX*210)/100, ($addressY*297)/100);
	$pdf->Write(0, $street_and_number . " " . $colony);

	$pdf->SetXY(($cityX*210)/100, ($cityY*297)/100);
	$pdf->Write(0, $city);

	$pdf->SetXY(($stateX*210)/100, ($stateY*297)/100);
	$pdf->Write(0, $state);

	$pdf->SetXY(($zipCodeX*210)/100, ($zipCodeY*297)/100);
	$pdf->Write(0, $zip_code);	
	
	$pdf->Output( WP_CONTENT_DIR . '/plugins/rdv_event_registration/temp-files/FormaDeRegistro-' . $attendee_id . '.pdf', 'F' );
	
}


function emailFormToParticipant($email, $first_name, $last_name, $attendee_id){
	
	$body = '<p>¡<strong>RDV Bike Ride</strong> registration form!</p>';

	$attachments = array( WP_CONTENT_DIR . '/plugins/rdv_event_registration/temp-files/FormaDeRegistro-' . $attendee_id . '.pdf' );

	$headers = array('Content-Type: text/html; charset=UTF-8','From: info@xdwx.xyz');
	 
	wp_mail($email, 'RDV Bike Ride - Registration form for ' . $first_name . ' ' . $last_name, $body, $headers, $attachments);
	
}


function set_content_type( $content_type ) {

	return 'text/html';

}
add_filter( 'wp_mail_content_type', 'set_content_type' );


function RDV_remove_publish_box() {

    remove_meta_box( 'submitdiv', 'participants', 'side' );

}
add_action( 'admin_menu', 'RDV_remove_publish_box' );


function getXYPositions(){
		
	$xPos = ($_POST['data']['x']/$_POST['data']['length']) * 100;
	$yPos = ($_POST['data']['y']/$_POST['data']['height']) * 100;
	$length = $_POST['data']['length'];
	$height = $_POST['data']['height'];
	$item = $_POST['data']['item'];
	
	$XYPositions = "<input type='hidden' name='" . $item . "X' value='" . $xPos . "' /><input type='hidden' name='" . $item . "Y' value='" . $yPos . "' />";	
	
	$XYPositions .= "<input type='hidden' name='length' value='" . $length . "' /><input type='hidden' name='height' value='" . $height . "' />";
	
	echo $XYPositions;
		
	die();

}
add_action( 'wp_ajax_getXY', 'getXYPositions' );