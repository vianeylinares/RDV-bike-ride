<?php

 //Exit if accessed directly
 if(!defined('ABSPATH')){
 	exit;
 }


function RDV_event_enable_disable_metabox(){

	add_meta_box(

		'RDV_meta_for_event_enable',
		'Event registration details',
		'RDV_event_enable',
		'event_registers'

	);

}
add_action('add_meta_boxes', 'RDV_event_enable_disable_metabox');


function RDV_event_enable($post){
		
	wp_nonce_field(basename(__FILE__), 'RDV_enable_disable_nonce');
		
	$RDV_enable_disable_stored_meta = get_post_meta($post->ID);
	
	$args = array(
		    'post_type' => 'event_registers',
		    'order' => 'DESC',
		    'posts_per_page' => 1,
		    'post_status' => array('publish'),
		    'meta_key' => 'event_id',
		    'meta_value' =>  $post->ID		    				    
		);
		
	$query = new WP_Query($args);
			
	$event_enable = isset( $RDV_enable_disable_stored_meta['event_checked'] ) ? esc_attr( $RDV_enable_disable_stored_meta['event_checked'][0] ) : 0;
	$event_checked = (strpos($event_enable, (string)$post->ID))? "checked" : "" ;
	
	$image = get_post_meta($post->ID, 'wp_custom_attachment', true);
	
	if(isset($image['url'])){ ?>
		<div style='margin-top: 15px;'>
			<label for = "event_checked"></label>
			<input type = "checkbox" value = "<?php echo $post->ID; ?>" name = "event_checked[]" <?php echo $event_checked; ?> />Enable						
		</div>			
	<?php }
					
	$html = '<p style="margin-top: 15px;" class="description">';
        $html .= 'Upload your PNG image here.';
    $html .= '</p>';
    $html .= '<input type="file" id="wp_custom_attachment" name="wp_custom_attachment" value="" size="25" />';
     
    echo $html;
		
	if(isset($image['url'])){

		?>
		
		<script>
		
			home_url = "<?php echo home_url(); ?>";			
				
		</script>
	
		<?php
	
			$firstNameX = isset( $RDV_enable_disable_stored_meta['firstNameX'][0] ) ? esc_attr( $RDV_enable_disable_stored_meta['firstNameX'][0] ) : 1;
			$firstNameY = isset( $RDV_enable_disable_stored_meta['firstNameY'][0] ) ? esc_attr( $RDV_enable_disable_stored_meta['firstNameY'][0] ) : 30;
			$lastNameX = isset( $RDV_enable_disable_stored_meta['lastNameX'][0] ) ? esc_attr( $RDV_enable_disable_stored_meta['lastNameX'][0] ) : 1;
			$lastNameY = isset( $RDV_enable_disable_stored_meta['lastNameY'][0] ) ? esc_attr( $RDV_enable_disable_stored_meta['lastNameY'][0] ) : 33;
			$maleX = isset( $RDV_enable_disable_stored_meta['maleX'][0] ) ? esc_attr( $RDV_enable_disable_stored_meta['maleX'][0] ) : 1;
			$maleY = isset( $RDV_enable_disable_stored_meta['maleY'][0] ) ? esc_attr( $RDV_enable_disable_stored_meta['maleY'][0] ) : 36;
			$femaleX = isset( $RDV_enable_disable_stored_meta['femaleX'][0] ) ? esc_attr( $RDV_enable_disable_stored_meta['femaleX'][0] ) : 1;
			$femaleY = isset( $RDV_enable_disable_stored_meta['femaleY'][0] ) ? esc_attr( $RDV_enable_disable_stored_meta['femaleY'][0] ) : 39;
			$dateX = isset( $RDV_enable_disable_stored_meta['dateX'][0] ) ? esc_attr( $RDV_enable_disable_stored_meta['dateX'][0] ) : 1;
			$dateY = isset( $RDV_enable_disable_stored_meta['dateY'][0] ) ? esc_attr( $RDV_enable_disable_stored_meta['dateY'][0] ) : 42;
			$emailX = isset( $RDV_enable_disable_stored_meta['emailX'][0] ) ? esc_attr( $RDV_enable_disable_stored_meta['emailX'][0] ) : 1;
			$emailY = isset( $RDV_enable_disable_stored_meta['emailY'][0] ) ? esc_attr( $RDV_enable_disable_stored_meta['emailY'][0] ) : 45;
			$phoneX = isset( $RDV_enable_disable_stored_meta['phoneX'][0] ) ? esc_attr( $RDV_enable_disable_stored_meta['phoneX'][0] ) : 1;
			$phoneY = isset( $RDV_enable_disable_stored_meta['phoneY'][0] ) ? esc_attr( $RDV_enable_disable_stored_meta['phoneY'][0] ) : 48;
			$addressX = isset( $RDV_enable_disable_stored_meta['addressX'][0] ) ? esc_attr( $RDV_enable_disable_stored_meta['addressX'][0] ) : 1;
			$addressY = isset( $RDV_enable_disable_stored_meta['addressY'][0] ) ? esc_attr( $RDV_enable_disable_stored_meta['addressY'][0] ) : 51;
			$cityX = isset( $RDV_enable_disable_stored_meta['cityX'][0] ) ? esc_attr( $RDV_enable_disable_stored_meta['cityX'][0] ) : 1;
			$cityY = isset( $RDV_enable_disable_stored_meta['cityY'][0] ) ? esc_attr( $RDV_enable_disable_stored_meta['cityY'][0] ) : 54;
			$stateX = isset( $RDV_enable_disable_stored_meta['stateX'][0] ) ? esc_attr( $RDV_enable_disable_stored_meta['stateX'][0] ) : 1;
			$stateY = isset( $RDV_enable_disable_stored_meta['stateY'][0] ) ? esc_attr( $RDV_enable_disable_stored_meta['stateY'][0] ) : 57;
			$zipCodeX = isset( $RDV_enable_disable_stored_meta['zipCodeX'][0] ) ? esc_attr( $RDV_enable_disable_stored_meta['zipCodeX'][0] ) : 1;
			$zipCodeY = isset( $RDV_enable_disable_stored_meta['zipCodeY'][0] ) ? esc_attr( $RDV_enable_disable_stored_meta['zipCodeY'][0] ) : 60;
		
		?>
		
		<div style='margin-top: 15px;'>Image Source for Registration Form:</div>

		<div>

			<div style="width: 100%; border: 1px solid grey; position: relative;" style="top: 20%;">

				<img class="source_image" style="width: 100%; height: 100%" src="<?php echo $image['url']; ?>" />

				<div id="firstName" class="set_box length_one" style="top: <?php echo $firstNameY; ?>px; left: <?php echo $firstNameX; ?>%;">
					First Name
					<div id="firstNamePos">
						<input type='hidden' name='firstNameX' value='<?php echo $firstNameX; ?>' />
						<input type='hidden' name='firstNameY' value='<?php echo $firstNameY; ?>' />
						<input type='hidden' name='length' value='' />
						<input type='hidden' name='height' value='' />
					</div>
				</div>

				<div id="lastName" class="set_box length_one" style="top: <?php echo $lastNameY; ?>px; left: <?php echo $lastNameX; ?>%;">
					Last Name
					<div id="lastNamePos">
						<input type='hidden' name='lastNameX' value='<?php echo $lastNameX; ?>' />
						<input type='hidden' name='lastNameY' value='<?php echo $lastNameY; ?>' />
						<input type='hidden' name='length' value='' />
						<input type='hidden' name='height' value='' />
					</div>
				</div>

				<div id="male" class="set_box length_two" style="top: <?php echo $maleY; ?>px; left: <?php echo $maleX; ?>%;">	
					M
					<div id="malePos">
						<input type='hidden' name='maleX' value='<?php echo $maleX; ?>' />
						<input type='hidden' name='maleY' value='<?php echo $maleY; ?>' />
						<input type='hidden' name='length' value='' />
						<input type='hidden' name='height' value='' />
					</div>
				</div>

				<div id="female" class="set_box length_two" style="top: <?php echo $femaleY; ?>px; left: <?php echo $femaleX; ?>%;">		
					F
					<div id="femalePos">
						<input type='hidden' name='femaleX' value='<?php echo $femaleX; ?>' />
						<input type='hidden' name='femaleY' value='<?php echo $femaleY; ?>' />
						<input type='hidden' name='length' value='' />
						<input type='hidden' name='height' value='' />
					</div>
				</div>

				<div id="date" class="set_box length_one" style="top: <?php echo $dateY; ?>px; left: <?php echo $dateX; ?>%;">		
					Birth Date
					<div id="datePos">
						<input type='hidden' name='dateX' value='<?php echo $dateX; ?>' />
						<input type='hidden' name='dateY' value='<?php echo $dateY; ?>' />
						<input type='hidden' name='length' value='' />
						<input type='hidden' name='height' value='' />
					</div>
				</div>

				<div id="email" class="set_box length_three" style="top: <?php echo $emailY; ?>px; left: <?php echo $emailX; ?>%;">	
					Email
					<div id="emailPos">
						<input type='hidden' name='emailX' value='<?php echo $emailX; ?>' />
						<input type='hidden' name='emailY' value='<?php echo $emailY; ?>' />
						<input type='hidden' name='length' value='' />
						<input type='hidden' name='height' value='' />
					</div>
				</div>

				<div id="phone" class="set_box length_three" style="top: <?php echo $phoneY; ?>px; left: <?php echo $phoneX; ?>%;">	
					Emergency Phone
					<div id="phonePos">
						<input type='hidden' name='phoneX' value='<?php echo $phoneX; ?>' />
						<input type='hidden' name='phoneY' value='<?php echo $phoneY; ?>' />
						<input type='hidden' name='length' value='' />
						<input type='hidden' name='height' value='' />
					</div>
				</div>

				<div id="address" class="set_box length_three" style="top: <?php echo $addressY; ?>px; left: <?php echo $addressX; ?>%;">	
					Address
					<div id="addressPos">
						<input type='hidden' name='addressX' value='<?php echo $addressX; ?>' />
						<input type='hidden' name='addressY' value='<?php echo $addressY; ?>' />
						<input type='hidden' name='length' value='' />
						<input type='hidden' name='height' value='' />
					</div>
				</div>

				<div id="city" class="set_box length_one" style="top: <?php echo $cityY; ?>px; left: <?php echo $cityX; ?>%;">	
					City
					<div id="cityPos">
						<input type='hidden' name='cityX' value='<?php echo $cityX; ?>' />
						<input type='hidden' name='cityY' value='<?php echo $cityY; ?>' />
						<input type='hidden' name='length' value='' />
						<input type='hidden' name='height' value='' />
					</div>
				</div>

				<div id="state" class="set_box length_four" style="top: <?php echo $stateY; ?>px; left: <?php echo $stateX; ?>%;">	
					State
					<div id="statePos">
						<input type='hidden' name='stateX' value='<?php echo $stateX; ?>' />
						<input type='hidden' name='stateY' value='<?php echo $stateY; ?>' />
						<input type='hidden' name='length' value='' />
						<input type='hidden' name='height' value='' />
					</div>
				</div>

				<div id="zipCode" class="set_box length_five" style="top: <?php echo $zipCodeY; ?>px; left: <?php echo $zipCodeX; ?>%;">	
					Zip Code
					<div id="zipCodePos">
						<input type='hidden' name='zipCodeX' value='<?php echo $zipCodeX; ?>' />
						<input type='hidden' name='zipCodeY' value='<?php echo $zipCodeY; ?>' />
						<input type='hidden' name='length' value='' />
						<input type='hidden' name='height' value='' />
					</div>
				</div>

			</div>
			
			
		</div> 
		
		<?php 

	} 

	if(!isset($image['url'])){
		
		echo "<div style='margin-top: 15px;'>There is no source image for registration form.</div>";
		
	}	
		
}


function RDV_meta_save($post_id){

	$is_autosave = wp_is_post_autosave($post_id);
	$is_revision = wp_is_post_revision($post_id);
	$is_valid_nonce = (isset($_POST['RDV_enable_disable_nonce']) && wp_verify_nonce($_POST['RDV_enable_disable_nonce'], basename(__FILE__)) ) ? "true" : "false";
	
	if($is_autosave || $is_revision || !$is_valid_nonce){
		return;
	}
	
	$image = get_post_meta($post_id, 'wp_custom_attachment', true);
			
	if(isset($image['url'])){
				
		update_post_meta($post_id, 'firstNameX', $_POST['firstNameX']);
		update_post_meta($post_id, 'firstNameY', $_POST['firstNameY']);
		update_post_meta($post_id, 'lastNameX', $_POST['lastNameX']);
		update_post_meta($post_id, 'lastNameY', $_POST['lastNameY']);
		update_post_meta($post_id, 'maleX', $_POST['maleX']);
		update_post_meta($post_id, 'maleY', $_POST['maleY']);
		update_post_meta($post_id, 'femaleX', $_POST['femaleX']);
		update_post_meta($post_id, 'femaleY', $_POST['femaleY']);		
		update_post_meta($post_id, 'dateX', $_POST['dateX']);
		update_post_meta($post_id, 'dateY', $_POST['dateY']);
		update_post_meta($post_id, 'emailX', $_POST['emailX']);
		update_post_meta($post_id, 'emailY', $_POST['emailY']);
		update_post_meta($post_id, 'phoneX', $_POST['phoneX']);
		update_post_meta($post_id, 'phoneY', $_POST['phoneY']);
		update_post_meta($post_id, 'addressX', $_POST['addressX']);
		update_post_meta($post_id, 'addressY', $_POST['addressY']);
		update_post_meta($post_id, 'cityX', $_POST['cityX']);
		update_post_meta($post_id, 'cityY', $_POST['cityY']);
		update_post_meta($post_id, 'stateX', $_POST['stateX']);
		update_post_meta($post_id, 'stateY', $_POST['stateY']);
		update_post_meta($post_id, 'zipCodeX', $_POST['zipCodeX']);
		update_post_meta($post_id, 'zipCodeY', $_POST['zipCodeY']);
		
	}
	
	
	 // Make sure the file array isn't empty
    if(!empty($_FILES['wp_custom_attachment']['name'])) {
         
        // Setup the array of supported file types. In this case, it's just PNG.
        $supported_types = array('image/png');
         
        // Get the file type of the upload
        $arr_file_type = wp_check_filetype(basename($_FILES['wp_custom_attachment']['name']));
        $uploaded_type = $arr_file_type['type'];
         
        // Check if the type is supported. If not, throw an error.
        if(in_array($uploaded_type, $supported_types)) {
 
            // Use the WordPress API to upload the file
            $upload = wp_upload_bits($_FILES['wp_custom_attachment']['name'], null, file_get_contents($_FILES['wp_custom_attachment']['tmp_name']));
     
            if(isset($upload['error']) && $upload['error'] != 0) {
                wp_die('There was an error uploading your file. The error is: ' . $upload['error']);
            } else {
                update_post_meta($post_id, 'wp_custom_attachment', $upload);     
            }
            
            
            require_once(WP_CONTENT_DIR . '/plugins/rdv_event_registration/fpdf/fpdf.php');
			
			$image_uploaded = get_post_meta($post_id, 'wp_custom_attachment', true);
			
			$image = $image_uploaded['file'];
			$pdf = new FPDF();
			$pdf->AddPage();
			$pdf->Image($image, 0, 0, 210, 300);
			$pdf->Output(WP_CONTENT_DIR . '/plugins/rdv_event_registration/temp-files/label.pdf','F');
		            
 			update_post_meta($post_id, 'event_pdf_document', WP_CONTENT_DIR . '/plugins/rdv_event_registration/temp-files/label.pdf');     
			
        } else {

            wp_die("The file type that you've uploaded is not PNG.");

        }
         
    }	
	
	if($_POST['event_checked'] == NULL){ $_POST['event_checked'] = 0; }
	
	update_post_meta($post_id, 'event_checked', $_POST['event_checked']);
	
}
add_action('save_post', 'RDV_meta_save');


function update_edit_form() {

    echo ' enctype="multipart/form-data"';

}
add_action('post_edit_form_tag', 'update_edit_form');

 
function RDV_add_registered_people_metabox(){

	add_meta_box(

		'RDV_meta_for_registered_participants',
		'Registered Attendees',
		'RDV_list_registered_participants',
		'event_registers'

	);

}
add_action('add_meta_boxes', 'RDV_add_registered_people_metabox');


function RDV_list_registered_participants($post){
	
	$post_id = ( isset($_GET['post']) )? $_GET['post'] : 0 ;
	
	$args = array(
		    'post_type' => 'participants',
		    'order' => 'DESC',
		    'posts_per_page' => -1,
		    'post_status' => array('publish'),
		    'meta_key' => 'event_id',
		    'meta_value' =>  $post_id		    
		);
		
	$query = new WP_Query($args);
	
	if ( $query->have_posts() ){
		
		$fp = fopen(WP_CONTENT_DIR . '/plugins/rdv_event_registration/temp-files/file.csv', 'w+');
									
		date_default_timezone_set("America/Los_Angeles");
		$today_date = date("m-d-Y");
		$current_time = date("H:i:s");	
											
		$array = array
		(
			"Bike Ride",
		);
		$array2 = array
		(
			"Attendees report",
		
		);
		$array3 = array
		(
			"Date: " . $today_date,
		
		);
		$array4 = array
		(
			"Time: " . $current_time,
		);
		$array5 = array
		(
			"First name",
			"Last name",
			"Email",
			"Gender",
			"Birthdate",
			"Street and number",
			"Suburb",
			"City",
			"State",
			"ZIP code",
			"Phone",
		);	
		
		
		fputcsv($fp, $array);
		fputcsv($fp, $array2);
		fputcsv($fp, $array3);
		fputcsv($fp, $array4);
		fputcsv($fp, $array5);
		
		while($query -> have_posts()) : $query -> the_post();
										
			$array = array
				(
					get_post_meta(get_the_ID(), 'first_name', true),
					get_post_meta(get_the_ID(), 'last_name', true),
					get_post_meta(get_the_ID(), 'email', true),
					get_post_meta(get_the_ID(), 'gender', true),
					get_post_meta(get_the_ID(), 'date_of_birth', true),
					get_post_meta(get_the_ID(), 'street_and_number', true),
					get_post_meta(get_the_ID(), 'colony', true),
					get_post_meta(get_the_ID(), 'city', true),
					get_post_meta(get_the_ID(), 'state', true),
					get_post_meta(get_the_ID(), 'zip_code', true),
					get_post_meta(get_the_ID(), 'emergency_phone', true)
				);
					
			fputcsv($fp, $array);
				
	
		endwhile;
		
		fclose($fp);
				
		?>	
	
		<div style="margin-bottom: 10px;">
			<a style = "height: 30px; display: inline-block; line-height: 30px; text-decoration: none; background-color: lightgrey; color: black; border: 1px solid #F1F1F1; padding-left: 20px; padding-right: 20px;" href="<?php site_url() ?>/wp-content/plugins/rdv_event_registration/temp-files/file.csv">Download Event Registers</a>
		</div>
		
		<table style="width: 100%;">

			<tr style="text-align: left;">
				<th>Name</th>
				<th>Email</th>
				<th>Gender</th>
				<th>Register Date</th>
				<th>Register Time</th>
				
			</tr>
				
			<?php while($query -> have_posts()) : $query -> the_post(); ?>
									
					<tr>
						<td><a href="<?php home_url(); ?>post.php?post=<?php echo get_the_ID();?>&action=edit"><?php the_title();  ?></a></td>
						<td><?php echo get_post_meta(get_the_ID(), 'email', true); ?></td>
						<td><?php echo (get_post_meta(get_the_ID(), 'gender', true) == "female")? "female" : "male"; ?></td>
						<td><?php echo get_post_meta(get_the_ID(), 'register_date', true); ?></td>
						<td><?php echo get_post_meta(get_the_ID(), 'register_time', true); ?></td>
					
					</tr>
		
			<?php endwhile; ?>
				
		</table>

		<div id="the_div">
			
		</div>

		<?php
		
	} else {		
	
		echo "<i>There are no registers available.</i>";

	}	
	
}


function RDV_add_participant_data_metabox(){

	add_meta_box(

		'RDV_meta_for_participants_details',
		'Attendee data',
		'RDV_display_participant_data',
		'participants'

	);

}
add_action('add_meta_boxes', 'RDV_add_participant_data_metabox');


function RDV_display_participant_data($post){
	
	$args = array(
		    'post_type' => 'participants',
		    'post_status' => array('publish'),
		    'p' => $post->ID
		    
		);
		
	$query = new WP_Query($args);
	
	if ( $query->have_posts() ){
		
		?>
				
		<table style="width: 100%;">
			<tr style="text-align: left;">
				<th>Name</th>
				<th>Email</th>
				<th>Gender</th>
				<th>Register Date</th>
				<th>Register Time</th>
			</tr>	
								
			<?php while($query -> have_posts()) : $query -> the_post(); ?>
		
					<tr>
						<td><?php the_title(); ?></td>
						<td><?php echo get_post_meta(get_the_ID(), 'email', true);  ?></td>
						<td><?php echo (get_post_meta(get_the_ID(), 'gender', true) == "female")? "female" : "male"; ?></td>
						<td><?php echo get_post_meta(get_the_ID(), 'register_date', true); ?></td>
						<td><?php echo get_post_meta(get_the_ID(), 'register_time', true); ?></td>
					</tr>
					<tr>	
						<td colspan="5">
							<br />
							<b>Date of birth: </b><?php echo get_post_meta(get_the_ID(), 'date_of_birth', true); ?><br/><br/>
							<b>Address:</b><br/>
							<?php echo get_post_meta(get_the_ID(), 'street_and_number', true);  ?><br />
							<?php echo get_post_meta(get_the_ID(), 'colony', true);  ?><br />
							<?php echo get_post_meta(get_the_ID(), 'city', true);  ?><br />
							<?php echo get_post_meta(get_the_ID(), 'state', true);  ?><br />
							<?php echo get_post_meta(get_the_ID(), 'zip_code', true);  ?><br /><br/>
							<b>  Emergency Phone: </b><?php echo get_post_meta(get_the_ID(), 'emergency_phone', true);  ?><br /><br />
							<b>  Registered Events: </b>
														
							<?php
						
								$args3 = array(
								    'post_type' => 'participants',
								    'order' => 'ASC',
								    'post_status' => array('publish'),
								    'meta_key' => 'email',
								    'meta_value' => get_post_meta(get_the_ID(), 'email', true)									    
								);
										
								$query3 = new WP_Query($args3);
							
								while($query3 -> have_posts()) : $query3 -> the_post();
							
									$args2 = array(
										    'post_type' => 'event_registers',
										    'post_status' => array('publish'),
										    'p' => get_post_meta(get_the_ID(), 'event_id', true)								   
										    
										);
										
									$query2 = new WP_Query($args2);
									
									while($query2 -> have_posts()) : $query2 -> the_post();

										echo the_title() . ", ";

									endwhile;
								
								endwhile;

							?>

						</td>
							
					</tr>
		
			<?php endwhile; ?>

		</table>
		
		<?php
		
	}
	
}