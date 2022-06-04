<?php

//Exit if accessed directly
if(!defined('ABSPATH')){
	exit;
}


function rdv_register_shortcode(){

	ob_start();

	// Form validation for preliminar data
	if(isset($_POST['send_preliminar'])){
		
		$count = 0;
		
		if($_POST['first_name'] == "" || preg_match('/[\'^£$%&*()}{#~?<>,|=+¬]/', $_POST['first_name'])){
			$first_name_error = "Error. Enter your first name. Don't use special characters: ' ^ £ $ % & * ( ) } { # ~ ? < > , | = + ¬";
			$count++;
		}
		
		if($_POST['last_name'] == "" || preg_match('/[\'^£$%&*()}{#~?<>,|=+¬]/', $_POST['last_name'])){
			$last_name_error = "Error. Enter your last name. Don't use special characters: ' ^ £ $ % & * ( ) } { # ~ ? < > , | = + ¬";
			$count++;
		}
		
		if($_POST['email'] == "" || preg_match('/[\'^£$%&*()}{#~?<>,|=+¬]/', $_POST['email'])){
			$email_error = "Error. Enter your email. Don't use special characters: ' ^ £ $ % & * ( ) } { # ~ ? < > , | = + ¬";
			$count++;
		}
		
		if($_POST['email_confirm'] == "" || preg_match('/[\'^£$%&*()}{#~?<>,|=+¬]/', $_POST['email_confirm'])){
			$email_confirm_error = "Error. Enter your email confirmation. Don't use special characters: ' ^ £ $ % & * ( ) } { # ~ ? < > , | = + ¬";
			$count++;
		}
		
		if($_POST['email'] != $_POST['email_confirm']){
			$email_error = "Error. Email confirmation failed.";
			$count++;
		}
		
		if($_POST['email'] == $_POST['email_confirm']){
			
			$event_id = getCurrentEventID();			
			
			$args2 = array(
				    'post_type' => 'participants',
				    'posts_per_page' => -1,
				    'post_status' => array('publish'),
					'meta_query' => array(
						array(
	                        'relation' => 'AND',
	                        array(
	                                'key' => 'email',
	                                'value' => $_POST['email'],
	                                'compare' => '=',
	                        ),
	                        array(
	                                'key' => 'event_id',
	                                'value' => $event_id,
	                                'compare' => '=',
	                        ),
						),
					),
				    				    
				);
				
			$query2 = new WP_Query($args2);
			$num = $query2->post_count;
			
			if($num > 0){
				$email_error = "Error. Email is already registered.";
				$count++;
												
			}
		}
		
		if($count != 0){	
			unset($_POST['send_preliminar']);
		}
		
	}
	
	// Form validation for preliminar data
	if(isset($_POST['send_print'])){
		
		if($_POST['email_print'] == "" || preg_match('/[\'^£$%&*()}{#~?<>,|=+¬]/', $_POST['email_print'])){
			$email_print_error =  "Error. Enter your email. Don't use special characters: ' ^ £ $ % & * ( ) } { # ~ ? < > , | = + ¬";
			unset($_POST['send_print']);
		}
		
		if($_POST['email_print'] != ""){
			
			$event_id = getCurrentEventID();			
			
			$args2 = array(
				    'post_type' => 'participants',
				    'posts_per_page' => -1,
				    'post_status' => array('publish'),
					'meta_query' => array(
						array(
	                        'relation' => 'AND',
	                        array(
	                                'key' => 'email',
	                                'value' => $_POST['email_print'],
	                                'compare' => '=',
	                        ),
	                        array(
	                                'key' => 'event_id',
	                                'value' => $event_id,
	                                'compare' => '=',
	                        ),
						),
					),
				    				    
				);
				
			$query2 = new WP_Query($args2);
			$num = $query2->post_count;
			
						
			if($num == 0){
				$email_print_error =  "Error. This email has not been registered.";
				$count++;
				unset($_POST['send_print']);
								
			} else if($num > 0){
				
				while($query2 -> have_posts()) : $query2 -> the_post();
					
					$first_name = get_post_meta(get_the_ID(), 'first_name', true);
					$last_name = get_post_meta(get_the_ID(), 'last_name', true);
					$email = get_post_meta(get_the_ID(), 'email', true);
					$gender = get_post_meta(get_the_ID(), 'gender', true);
					$date_of_birth = get_post_meta(get_the_ID(), 'date_of_birth', true);
					$street_and_number = get_post_meta(get_the_ID(), 'street_and_number', true);
					$colony = get_post_meta(get_the_ID(), 'colony', true);
					$city = get_post_meta(get_the_ID(), 'city', true);
					$state = get_post_meta(get_the_ID(), 'state', true);
					$zip_code = get_post_meta(get_the_ID(), 'zip_code', true);
					$emergency_phone = get_post_meta(get_the_ID(), 'emergency_phone', true);
					$id = get_the_ID();
					
				endwhile;
				
				registrationFormGeneration($first_name, $last_name, $email, $gender, $date_of_birth, $street_and_number, $colony, $city, $state, $zip_code, $emergency_phone, $id);
				
				emailFormToParticipant($email, $first_name, $last_name, $id);
					
				unset($_POST['send_print']);

				unlink( WP_CONTENT_DIR . '/plugins/rdv_event_registration/temp-files/FormaDeRegistro-' . $id . '.pdf');

				wp_redirect( home_url() );
				exit;
				
			}						
			
		}			
		
	}

	// Form validation for full registration data
	if(isset($_POST['send_full_details'])){
		
		$count = 0;
		
		if($_POST['date_of_birth'] == "" || preg_match('/[\'^£$%&*()}{#~?<>,|=+¬]/', $_POST['date_of_birth'])){
			$date_of_birth_error = "Error. Enter your birthdate. Don't use special characters: ' ^ £ $ % & * ( ) } { # ~ ? < > , | = + ¬";
			$count++;
		}
		
		if($_POST['street_and_number'] == "" || preg_match('/[\'^£$%&*()}{~?<>,|=+¬]/', $_POST['street_and_number'])){
			$street_and_number_error = "Error. Enter street and number. Don't use special characters: ' ^ £ $ % & * ( ) } { # ~ ? < > , | = + ¬";
			$count++;
		}
		
		if($_POST['colony'] == "" || preg_match('/[\'^£$%&*()}{#~?<>,|=+¬]/', $_POST['colony'])){
			$colony_error = "Error. Enter suburb. Don't use special characters: ' ^ £ $ % & * ( ) } { # ~ ? < > , | = + ¬";
			$count++;
		}
		
		if($_POST['city'] == "" || preg_match('/[\'^£$%&*()}{#~?<>,|=+¬]/', $_POST['city'])){
			$city_error = "Error. Enter city. Don't use special characters: ' ^ £ $ % & * ( ) } { # ~ ? < > , | = + ¬";
			$count++;
		}
		
		if($_POST['state'] == "" || preg_match('/[\'^£$%&*()}{#~?<>,|=+¬]/', $_POST['state'])){
			$state_error = "Error. Enter state. Don't use special characters: ' ^ £ $ % & * ( ) } { # ~ ? < > , | = + ¬";
			$count++;
		}
		
		if($_POST['zip_code'] == "" || preg_match('/[\'^£$%&*()}{#~?<>,|=+¬]/', $_POST['zip_code'])){
			$zip_code_error = "Error. Enter ZIP code. Don't use special characters: ' ^ £ $ % & * ( ) } { # ~ ? < > , | = + ¬";
			$count++;
		}
		
		if($_POST['emergency_phone'] == "" || preg_match('/[\'^£$%&*()}{#~?<>,|=+¬]/', $_POST['emergency_phone'])){
			$emergency_phone_error = "Error. Enter emergency phone. Don't use special characters: ' ^ £ $ % & * ( ) } { # ~ ? < > , | = + ¬";
			$count++;
		}
		
		// Full registration in system and form sent to participant
		if($count == 0){
			
			$args = array(
				'post_title' => wp_strip_all_tags( $_POST['first_name'] . " " . $_POST["last_name"] ),
			  	'post_type' => 'participants',
			  	'post_status' => 'publish'
			);
			 
			// Insert the post into the database
			$post_id = wp_insert_post( $args );
			
			$event_id = getCurrentEventID();
			
			date_default_timezone_set('America/Los_Angeles');
			
			$register_date = date("m-d-Y");
			$register_time = date("h:i:sa");
			
			update_post_meta($post_id, 'first_name', esc_attr($_POST['first_name']));
			update_post_meta($post_id, 'last_name', esc_attr($_POST['last_name']));
			update_post_meta($post_id, 'email', $_POST['email']);
			update_post_meta($post_id, 'gender', $_POST['gender']);
			update_post_meta($post_id, 'date_of_birth', esc_attr($_POST['date_of_birth']));
			update_post_meta($post_id, 'street_and_number', esc_attr($_POST['street_and_number']));
			update_post_meta($post_id, 'colony', esc_attr($_POST['colony']));
			update_post_meta($post_id, 'city', esc_attr($_POST['city']));
			update_post_meta($post_id, 'state', esc_attr($_POST['state']));
			update_post_meta($post_id, 'zip_code', esc_attr($_POST['zip_code']));
			update_post_meta($post_id, 'emergency_phone', esc_attr($_POST['emergency_phone']));
			update_post_meta($post_id, 'register_date', $register_date);
			update_post_meta($post_id, 'register_time', $register_time);
			update_post_meta($post_id, 'event_id', $event_id);
			
			
			registrationFormGeneration($_POST['first_name'], $_POST["last_name"], $_POST['email'], $_POST['gender'], $_POST['date_of_birth'], $_POST['street_and_number'], $_POST['colony'], $_POST['city'], $_POST['state'], $_POST['zip_code'], $_POST['emergency_phone'], $post_id);
			
			emailFormToParticipant($_POST['email'], $_POST['first_name'], $_POST['last_name'], $post_id);						
				
			unset($_POST['send_full_details']);

			unlink( WP_CONTENT_DIR . '/plugins/rdv_event_registration/temp-files/FormaDeRegistro-' . $id . '.pdf');
			
			wp_redirect( home_url() );
			exit;
			
		}		
		
	}

	// Form preliminary cancel
	if($_POST['cancel_preliminar']){
		unset($_POST['cancel_preliminar']);
	}
	
	// Form full registration cancel
	if($_POST['cancel_full_details']){
		unset($_POST['cancel_full_details']);
	}

	?>
	
	<div class="content_wrapper">

		<div class="inscription_presale_box">
				
			<div class="item_title_first" style="margin-bottom: 20px; display: none;">				
				ONLINE REGISTER			
			</div>
		
			<?php
				
				$event_enable = isCurrentEventEnable();
				
				if($event_enable != 0){

					if((!isset($_POST['send_preliminar']) && !isset($_POST['send_print'])) && !isset($_POST['send_preliminar']) && !isset($_POST['send_full_details'])){ 

						// Registration form for preliminary data

						?>

							<div class="individual_content">
								
								<div class="online-registration-form-title">Register to attend</div>
								
								<div class="online-registration-form-box">

									<form method="post" action="">

										<label for="first_name">First name *</label>
										<input class = "form_name online-registration-data" type="text" name="first_name" required /><br/>
										<?php
											if(isset($first_name_error)){ ?>
												<div class="error"><?php echo $first_name_error; ?></div> 
											<?php }
										?>
										
										<label for="last_name">Last name *</label>
										<input class = "form_name online-registration-data" type="text" name="last_name" required /><br/>
										<?php
											if(isset($last_name_error)){ ?>
												<div class="error"><?php echo $last_name_error; ?></div> 
											<?php }
										?>
										
										<label for="email">Email *</label>
										<input class = "form_email online-registration-data" type="email" name="email" required /><br/>
										<?php
											if(isset($email_error)){ ?>
												<div class="error"><?php echo $email_error; ?></div> 
											<?php }
										?>
										
										<label for="email_confirm">Confirm email *</label>
										<input class = "form_email online-registration-data" type="email" name="email_confirm" required /><br/>
										<?php
											if(isset($email_confirm_error)){ ?>
												<div class="error"><?php echo $email_confirm_error; ?></div> 
											<?php }
										?>
										
										<input class="online-registration-button" type="submit" name="send_preliminar" value="Send" />
										<input class="online-registration-button" type="submit" name="cancel_preliminar" value="Cancel" />

									</form>

								</div>		
								
							</div>	

						<?php

					} 

					if((!isset($_POST['send_preliminar']) && !isset($_POST['send_print'])) && !isset($_POST['send_preliminar']) && !isset($_POST['send_full_details'])){ 

						 // Form for printing

						?>

							<div class="individual_content" style="margin-top: 30px;">
								
								<div class="online-registration-form-title">If you have already registered and need to print your participation form, enter your email</div>
								
								<div class="online-registration-form-box">

									<form method="post" action="">
										
										<label for="email_print">Email *</label>
										<input class = "form_email online-registration-data" type="email" name="email_print" required /><br/>
										<?php
											if(isset($email_print_error)){ ?>
												<div class="error"><?php echo $email_print_error; ?></div> 
											<?php }
										?>										
									
										<input class="online-registration-button" type="submit" name="send_print" value="Send" />
								
									</form>

								</div>		
								
							</div>
					
						<?php

					} 

					if(isset($_POST['send_preliminar']) || isset($_POST['send_full_details'])){ 

						// Registration form for additional details 

						?>

							<div class="individual_content">
								
								<div class="online-registration-form-title">Thank you very much for your interest in participating with us!</div>
								
								<div class="online-registration-form-subtitle">Complete your registration by providing the following information:</div>
								
								<div class="online-registration-form-box">
									<form method="post" action="">
										<input value="<?php echo $_POST['first_name']; ?>" type="hidden" name="first_name" />
										
										<input value="<?php echo $_POST['last_name']; ?>" type="hidden" name="last_name" />
										
										<input value="<?php echo $_POST['email']; ?>" type="hidden" name="email" />
										
										<label for="gender">Gender *</label>
										<select name="gender" class = "form_email online-registration-data">
											<option value="male">Male</option>
											<option value="female">Female</option>
										</select><br/>
										
										<label for="date_of_birth">Birthdate * (dd/mm/aaaa)</label>
										<input class = "form_email online-registration-data" type="text" name="date_of_birth" required /><br/>
										<?php
											if(isset($date_of_birth_error)){ ?>
												<div class="error"><?php echo $date_of_birth_error; ?></div> 
											<?php }
										?>
										
										<div style="margin-bottom: 10px;">Address:</div>
										
										<label for="street_and_number">Street and number *</label>
										<input class = "form_email online-registration-data" type="text" name="street_and_number" required /><br/>
										<?php
											if(isset($street_and_number_error)){ ?>
												<div class="error"><?php echo $street_and_number_error; ?></div> 
											<?php }
										?>
										
										<label for="colony">Suburb *</label>
										<input class = "form_email online-registration-data" type="text" name="colony" required /><br/>
										<?php
											if(isset($colony_error)){ ?>
												<div class="error"><?php echo $colony_error; ?></div> 
											<?php }
										?>
										
										<label for="city">City *</label>
										<input class = "form_email online-registration-data" type="text" name="city" required /><br/>
										<?php
											if(isset($city_error)){ ?>
												<div class="error"><?php echo $city_error; ?></div> 
											<?php }
										?>
										
										<label for="state">State *</label>
										<input class = "form_email online-registration-data" type="text" name="state" required /><br/>
										<?php
											if(isset($state_error)){ ?>
												<div class="error"><?php echo $state_error; ?></div> 
											<?php }
										?>
										
										<label for="zip_code">ZIP code *</label>
										<input class = "form_email online-registration-data" type="text" name="zip_code" required /><br/>
										<?php
											if(isset($zip_code_error)){ ?>
												<div class="error"><?php echo $zip_code_error; ?></div> 
											<?php }
										?>
										
										<label for="emergency_phone">Emergency phone *</label>
										<input class = "form_email online-registration-data" type="text" name="emergency_phone" required /><br/>
										<?php
											if(isset($emergency_phone_error)){ ?>
												<div class="error"><?php echo $emergency_phone_error; ?></div> 
											<?php }
										?>							
										
										<input class="online-registration-button" type="submit" name="send_full_details" value="Send" />
										<input class="online-registration-button" type="submit" name="cancel_full_details" value="Cancel" />
									</form>
								</div>		
								
							</div>

						<?php

					} 

				}

				if($event_enable == 0){
				
					echo "<div style='margin-left: 5%;'>Online register isn't available right now.</div>";
					
				}

			?>
													
		</div>		
		
	</div>
	
	<?php

	return ob_get_clean();

}
add_shortcode('rdv_register', 'rdv_register_shortcode');