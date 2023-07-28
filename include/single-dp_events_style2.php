<?php 
get_header();
$dem_themename = dem_theme_name();
$success_msg = '';
global $et_fb_processing_shortcode_object;
$global_processing_original_value = $et_fb_processing_shortcode_object;
$dp_event_page_booking_en_ds 	= get_post_meta(get_the_ID(), 'dp_event_page_booking_en_ds', true );
if ( $dp_event_page_booking_en_ds == 'default' ){
	$divi_dem_hide_form 			= et_get_option($dem_themename.'_dem_hide_form','off');
}else if( $dp_event_page_booking_en_ds == 'Yes' ){
	$divi_dem_hide_form 			= 'off';
}else if( $dp_event_page_booking_en_ds == 'No' ){
	$divi_dem_hide_form 			= 'on';
}else{
	$divi_dem_hide_form 			= et_get_option($dem_themename.'_dem_hide_form','off');
}
	$divi_dem_multi_lan 			= et_get_option($dem_themename.'_dem_multi_lan','off');
	if ( $divi_dem_multi_lan == 'on'){
		$divi_dem_evt_suc_msg 			= __( 'Your Booking Order Placed Successfully!', 'dpevent' );
		$divi_dem_evt_fail_msg 			= __('Your Booking Order Placed Fail!', 'dpevent' );
		$divi_dem_evt_inq_suc_msg 		= __('Your Inquiry Submitted Successfully!', 'dpevent' );
		$divi_dem_evt_inq_fail_msg 		= __('Your Inquiry Is Fail!', 'dpevent' );
		$dem_evt_to 					= __('to', 'dpevent' , 'dpevent' );
		$divi_dem_evt_info 					=  __('Event Information', 'dpevent' );
		$divi_dem_evt_start 				=  __('Start', 'dpevent' );
		$divi_dem_evt_end 					=  __('End', 'dpevent' );
		$divi_dem_evt_cost 					=  __('Cost', 'dpevent' );
		$divi_dem_evt_categories 			=  __('Categories', 'dpevent' );
		$divi_dem_evt_tags 					=  __('Tags', 'dpevent' );
		$divi_dem_evt_rm_tickets 			=  __('Remaining Tickets', 'dpevent' );
		$divi_dem_evt_org 					=  __('Event Organizer', 'dpevent' );
		$divi_dem_evt_organizername 		=  __('Organizer Name', 'dpevent' );
		$divi_dem_evt_email 				=  __('Email', 'dpevent' );
		$divi_dem_evt_venue 				=  __('Event Venue', 'dpevent' );
		$divi_dem_evt_address 				=  __('Address', 'dpevent' );
		$divi_dem_evt_phoneno 				=  __('Phone No.', 'dpevent' );
		$divi_dem_evt_website 				=  __('Website', 'dpevent' );
		$divi_dem_evt_location 				=  __('Event Location', 'dpevent' );
		$divi_dem_evt_share 				=  __('Share event', 'dpevent' );
		$divi_dem_evt_gallery 				=  __('Event Venue Gallery', 'dpevent' );
		$divi_dem_frm_name 					=  __('Name', 'dpevent' );
		$divi_dem_frm_emailaddress 			=  __('Email Address', 'dpevent' );
		$divi_dem_frm_telno					=  __('Telephone no', 'dpevent' );
		$divi_dem_frm_no_of_tickets 		=  __('Number of Tickets', 'dpevent' );
		$divi_dem_frm_price_tickets 		=  __('Ticket Price', 'dpevent' );
		$divi_dem_evt_tickets 				=  __('Get Tickets', 'dpevent' );
		$divi_dem_evt_rm_tickets 			=  __('Remaining Tickets', 'dpevent' );
		$divi_dem_evt_btn 					=  __('Pay with PayPal!', 'dpevent' );
		$dem_evt_fully_booked_msg 			=  __('This Event is fully booked.Please contact to website Owner', 'dpevent' );
		$dem_evt_expired_msg 				=  __('This Event is Expired.Please contact to website Owner', 'dpevent' );
	}else{
		$divi_dem_evt_suc_msg 						= et_get_option($dem_themename.'_dem_evt_suc_msg','Your Booking Order Placed Successfully!');
		$divi_dem_evt_fail_msg 						= et_get_option($dem_themename.'_dem_evt_fail_msg','Your Booking Order Placed Fail!');
		$divi_dem_evt_inq_suc_msg 					= et_get_option($dem_themename.'_dem_evt_inq_suc_msg','Your Inquiry Submitted Successfully!');
		$divi_dem_evt_inq_fail_msg 					= et_get_option($dem_themename.'_dem_evt_inq_fail_msg','Your Inquiry Is Fail!');
		$dem_evt_to 								= et_get_option($dem_themename.'_dem_evt_to','to');	
		$divi_dem_evt_info 					= et_get_option($dem_themename.'_dem_evt_info','Event Information');
		$divi_dem_evt_start 				= et_get_option($dem_themename.'_dem_evt_start','Start');
		$divi_dem_evt_end 					= et_get_option($dem_themename.'_dem_evt_end','End');
		$divi_dem_evt_cost 					= et_get_option($dem_themename.'_dem_evt_cost','Cost');
		$divi_dem_evt_categories 			= et_get_option($dem_themename.'_dem_evt_categories','Categories');
		$divi_dem_evt_tags 					= et_get_option($dem_themename.'_dem_evt_tags','Tags');
		$divi_dem_evt_rm_tickets 			= et_get_option($dem_themename.'_dem_evt_rm_tickets','Remaining Tickets');
		$divi_dem_evt_org 					= et_get_option($dem_themename.'_dem_evt_org','Event Organizer');
		$divi_dem_evt_organizername 		= et_get_option($dem_themename.'_dem_evt_organizername','Organizer Name');
		$divi_dem_evt_email 				= et_get_option($dem_themename.'_dem_evt_email','Email');
		$divi_dem_evt_venue 				= et_get_option($dem_themename.'_dem_evt_venue','Event Venue');
		$divi_dem_evt_address 				= et_get_option($dem_themename.'_dem_evt_address','Address');
		$divi_dem_evt_phoneno 				= et_get_option($dem_themename.'_dem_evt_phoneno','Phone No.');
		$divi_dem_evt_website 				= et_get_option($dem_themename.'_dem_evt_website','Website');
		$divi_dem_evt_location 				= et_get_option($dem_themename.'_dem_evt_location','Event Location');
		$divi_dem_evt_share 				= et_get_option($dem_themename.'_dem_evt_share','Share event');
		$divi_dem_evt_gallery 				= et_get_option($dem_themename.'_dem_evt_gallery','Event Venue Gallery');
		$divi_dem_frm_name 					= et_get_option($dem_themename.'_dem_frm_name','Name');
		$divi_dem_frm_emailaddress 			= et_get_option($dem_themename.'_dem_frm_emailaddress','Email Address');
		$divi_dem_frm_telno					= et_get_option($dem_themename.'_dem_frm_telno','Telephone no');
		$divi_dem_frm_no_of_tickets 		= et_get_option($dem_themename.'_dem_frm_no_of_tickets','Number of Tickets');
		$divi_dem_frm_price_tickets 		= et_get_option($dem_themename.'_dem_frm_price_tickets','Ticket Price');
		$divi_dem_evt_tickets 				= et_get_option($dem_themename.'_dem_evt_tickets','Get Tickets');
		$divi_dem_evt_rm_tickets 			= et_get_option($dem_themename.'_dem_evt_rm_tickets','Remaining Tickets');
		$divi_dem_evt_btn 					= et_get_option($dem_themename.'_dem_evt_btn','Pay with PayPal!');
		$dem_evt_fully_booked_msg 			= et_get_option($dem_themename.'_dem_evt_fully_booked_msg','This Event is fully booked.Please contact to website Owner');
		$dem_evt_expired_msg 				= et_get_option($dem_themename.'_dem_evt_expired_msg','This Event is Expired.Please contact to website Owner');
}

$divi_dem_display_social_icon_section 		= dem_general_view_op_get_value('divi_dem_display_social_icon_section','Yes');
$divi_dem_display_event_gallery_section 	= dem_general_view_op_get_value('divi_dem_display_event_gallery_section','Yes');
$divi_dem_display_event_location_section 	= dem_general_view_op_get_value('divi_dem_display_event_location_section','Yes');
$divi_dem_display_event_image_section 		= dem_general_view_op_get_value('divi_dem_display_event_image_section','Yes');
$dp_event_form_type      					= get_post_meta(get_the_ID(), 'dp_event_form_type', true);
$divi_dem_hide_tel_no_frm 				    = et_get_option($dem_themename.'_dem_hide_tel_no_frm','off');
$divi_dem_price_inquiry_form		        = et_get_option($dem_themename.'_dem_price_inquiry_form','off');
$dem_event_fully_booked 					= et_get_option($dem_themename.'_dem_event_fully_booked','on');	
$dem_event_hide_expired_booked 					= et_get_option($dem_themename.'_dem_event_hide_expired_booked','on');
$dem_display_time = et_get_option($dem_themename.'_dem_display_time','twhr');
if ( $dp_event_form_type != '' ){ $form_type = $dp_event_form_type ;}else{$form_type = 'default';}	
	if ( $divi_dem_hide_form != 'on' ){
			$divi_dem_paypal_mode = et_get_option($dem_themename.'_dem_paypal_mode','Live');
			$divi_dem_paypal_email_address = et_get_option($dem_themename.'_dem_paypal_email_address','');
			$divi_dem_display_form = et_get_option($dem_themename.'_dem_display_form','Booking');
			if ( $form_type == 'default' ){
				$divi_dem_display_form = $divi_dem_display_form ;
			}else if ( $form_type == 'free' ){
				$divi_dem_display_form = 'Inquiry' ;
			}else if ( $form_type == 'paid' ){ 
				$divi_dem_display_form = 'Booking' ;
			}else{
				$divi_dem_display_form = $divi_dem_display_form ;
			}
			global $wpdb;
			$table = $wpdb->prefix.'dem_order';
					
			if($divi_dem_display_form == 'Booking'){
				if ( isset( $_GET['_wpnonce'] ) && !wp_verify_nonce( sanitize_key( $_GET['_wpnonce'] ), 'dem_response_verify' ) ) {
						$success_msg = $divi_dem_evt_fail_msg;
				}else{
					if ( isset($_REQUEST['payment_status']) && $_REQUEST['payment_status'] == 'Completed'){
						$dem_order_id = isset( $_REQUEST["oid"] ) ? intval( $_REQUEST["oid"] ) : '';
						if ( !empty ( $dem_order_id ) ){
							$payment_status = isset( $_REQUEST["payment_status"] ) ? sanitize_key( $_REQUEST["payment_status"] ) : '';
							$item_number = isset( $_REQUEST["item_number"] ) ?  intval( $_REQUEST["item_number"] ) : ( isset( $_REQUEST["item_number1"] ) ?  intval( $_REQUEST["item_number1"] ) : '' );
							$buy_ticket = isset( $_REQUEST["quantity"] ) ? intval( $_REQUEST["quantity"] ) : ( isset( $_REQUEST["quantity1"] ) ?  intval( $_REQUEST["quantity1"] ) : '' );
							$wpdb->update($table, array('dem_booking_status'=>$payment_status ), array('dem_booking_id' =>$dem_order_id));
							$dpevent_noticket     = get_post_meta($item_number,'dpevent_noticket', true );
							$remaining_ticket 	  = $dpevent_noticket - $buy_ticket;
							update_post_meta( $item_number, 'dpevent_noticket', esc_attr ( $remaining_ticket ) );
							
							$order_detail = $wpdb->get_row( $wpdb->prepare( "SELECT  *  FROM {$wpdb->prefix}dem_order WHERE  dem_booking_id= %d ",$dem_order_id), ARRAY_A  ); 
							if ( ! empty($order_detail) ){
							$dem_detail_name 							= $order_detail['dem_user_name'];
							$dem_detail_email_id 						= $order_detail['dem_user_email'];
							$dem_detail_phone_no 						= $order_detail['dem_user_tel'];
							$dem_detail_event_id 						= $order_detail['dem_event_id'];
							$dem_detail_event_title 					= $order_detail['dem_event_title'];
							$dem_detail_ticket_currency_symbol_name 	= $order_detail['dem_event_currency'];
							$dem_detail_ticket_currency_symbol_position = $order_detail['dem_event_cu_pos'];
							$dem_detail_single_ticket_prices 			= $order_detail['dem_event_ticket_price'];
							$dem_detail_no_of_ticket 					= $order_detail['dem_event_no_of_ticket'];
							$dem_detail_total_ticket_price 				= $order_detail['dem_event_total_price'];
							$dem_booking_date 							= $order_detail['dem_booking_date'];
							$dem_booking_status 						= $order_detail['dem_booking_status'];
							
							$enable_email_customization 	= dem_email_customization_op_get_value('enable_email_customization','No');
							$cc_email_customization 		= dem_email_customization_op_get_value('cc_email_customization','');
							
							$useremail_content   			= dem_email_customization_op_get_value('b_useremail','');
							$adminemail_content   			= dem_email_customization_op_get_value('b_adminemail','');
							$admin_subject_email_customization = dem_email_customization_op_get_value('b_admin_subject_email_customization',''); 
							$user_subject_email_customization  = dem_email_customization_op_get_value('b_user_subject_email_customization','');
							
							$field_custom_field1 		= get_post_meta( $dem_detail_event_id, 'dpevent_custom_field1', true );
							$field_custom_field2 		= get_post_meta( $dem_detail_event_id, 'dpevent_custom_field2', true );
							$field_custom_field3 		= get_post_meta( $dem_detail_event_id, 'dpevent_custom_field3', true );
							
							$event_start_date               =  get_post_meta($dem_detail_event_id, 'dp_event_start_date',true);
							$event_end_date                 =  get_post_meta($dem_detail_event_id, 'dp_event_end_date',true);
							$event_start_time               =  get_post_meta($dem_detail_event_id, 'dp_event_start_time',true);
							$event_end_time                 =  get_post_meta($dem_detail_event_id, 'dp_event_end_time',true);
							
							if ( $enable_email_customization == 'Yes' && $admin_subject_email_customization != '' && $adminemail_content != '' && $user_subject_email_customization != '' && $useremail_content !='' ){
							
								$subject_items_for_replacement = array('{field_email_name}', '{field_email_eventname}' );
								$subject_replacement_items = array($dem_detail_name,$dem_detail_event_title );
								
								 $items_for_replacement = array('{field_email_name}',
								 '{field_email_emailaddress}',
								 '{field_email_phone}',
								 '{field_email_eventname}',
								 '{field_email_eventid}',
								 '{field_email_price}',
								 '{field_email_nooftickets}',
								 '{field_email_totalprice}',
								 '{field_email_status}',
								 '{field_email_date}',
								 '{field_custom_field1}',
								 '{field_custom_field2}',
								 '{field_custom_field3}',
								 '{field_email_event_start_date}',
								 '{field_email_event_end_date}',
								 '{field_email_event_start_time}',
								 '{field_email_event_end_time}'
								 );
								 $replacement_items = array($dem_detail_name,
								 $dem_detail_email_id,
								 $dem_detail_phone_no,
								 $dem_detail_event_title,
								 $dem_detail_event_id,
								 $dem_detail_ticket_currency_symbol_name." ".$dem_detail_single_ticket_prices,
								 $dem_detail_no_of_ticket,
								 $dem_detail_total_ticket_price,
								 $dem_booking_status,
								 $dem_booking_date,
								 $field_custom_field1,
								 $field_custom_field2,
								 $field_custom_field3,
								 esc_html(date_i18n('d F,Y l', esc_attr( $event_start_date ))),
								 esc_html(date_i18n('d F,Y l', esc_attr( $event_end_date ))),
								 esc_html(date_i18n("h:i a",  strtotime(esc_attr( $event_start_time )))),
								 esc_html(date_i18n("h:i a",  strtotime(esc_attr( $event_end_time ))))
								 );
								 $adminemail_content_msg = '';$useremail_content_msg= '';
								 //Admin Email
								 $admin_subject_email_customization_msg = str_replace($subject_items_for_replacement, $subject_replacement_items, $admin_subject_email_customization);
								 $adminemail_content_msg .= str_replace($items_for_replacement, $replacement_items, $adminemail_content);
								 
								 $enable_admin_email_customization = dem_email_customization_op_get_value('enable_admin_email_customization','No');
								 $dpevent_admin_email_id_value 		= get_post_meta( $dem_detail_event_id, 'dpevent_admin_email_id', true );
								 if ( $enable_admin_email_customization == 'Yes' && !empty($dpevent_admin_email_id_value ) ){
									 $admin_to = $dpevent_admin_email_id_value;
								 }else{
									$admin_to = get_option('admin_email');
								 }
								 $admin_from = $dem_detail_name." <".$dem_detail_email_id.">";
								 $admin_subject = $admin_subject_email_customization_msg;
								 $admin_txt = $adminemail_content_msg;
								 $plain_txt = $adminemail_content_msg;
								 
								 # Setup mime boundary
								$mime_boundary = 'Multipart_Boundary_x'.md5(time()).'x';
								
								# Setup header
								$headers  = "From: {$from}\n";
								if ( $cc_email_customization != '' ){
								$headers .= "Cc: {$cc_email_customization}\n";
								}
								$headers .= "MIME-Version: 1.0\n";
								$headers .= "Content-Type: multipart/alternative; boundary=\"{$mime_boundary}\"\r\n";
								$headers .= "Content-Transfer-Encoding: 7bit\r\n";
								
								$message  = "This is a multi-part message in mime format.\n\n";
									
								# Add in plain text version
								$message.= "--{$mime_boundary}\n";
								$message.= "Content-Type: text/plain; charset=\"charset=us-ascii\"\n";
								$message.= "Content-Transfer-Encoding: 7bit\n\n";
								$message.= $plain_txt;
								$message.= "\n\n";
								
								# Add in HTML version
								$message.= "--{$mime_boundary}\n";
								$message.= "Content-Type: text/html; charset=\"UTF-8\"\n";
								$message.= "Content-Transfer-Encoding: 7bit\n\n";
								$message.= $admin_txt;
								$message.= "\n\n";
								
								# End email
								$message .= "--{$mime_boundary}--\n";;
						
								$result = mail($admin_to, $admin_subject, $message, $headers);
								 
								 // User Email
								$user_subject_email_customization_msg = str_replace($subject_items_for_replacement, $subject_replacement_items, $user_subject_email_customization);
								$useremail_content_msg .= str_replace($items_for_replacement, $replacement_items, $useremail_content);
								$email_to = $dem_detail_email_id;
								$email_from = "<".get_option('admin_email').">";
								$email_subject = $user_subject_email_customization_msg;
								$email_txt = $useremail_content_msg;
								$email_plain_txt = $useremail_content_msg;
							
								# Setup mime boundary
								$email_mixed_boundary = 'Multipart_Boundary_x'.md5(time()).'x';
								
								# Setup header
								$email_headers  = "From: {$email_from}\n";
								$email_headers .= "MIME-Version: 1.0\n";
								$email_headers .= "Content-Type: multipart/alternative; boundary=\"{$email_mixed_boundary}\"\n";
								$email_headers .= "Content-Transfer-Encoding: 7bit\n";
								
								$email_message  = "This is a multi-part message in mime format.\n\n";
									
								# Add in plain text version
								$email_message .= "--{$email_mixed_boundary}\n";
								$email_message .= "Content-Type: text/plain; charset=\"charset=us-ascii\"\n";
								$email_message .= "Content-Transfer-Encoding: 7bit\n\n";
								$email_message .= $email_plain_txt;
								$email_message .= "\n\n";
								
								# Add in HTML version
								$email_message .= "--{$email_mixed_boundary}\n";
								$email_message .= "Content-Type: text/html; charset=\"UTF-8\"\n";
								$email_message .= "Content-Transfer-Encoding: 7bit\n\n";
								$email_message .= $email_txt;
								$email_message .= "\n\n";
								
								# End email
								$email_message .= "--{$email_mixed_boundary}--\n";
								$resultr = mail($email_to, $email_subject, $email_message, $email_headers);
								
							}
						}	
							$success_msg = $divi_dem_evt_suc_msg;
							 ?>
							 <script>
								setTimeout(function(){  window.location.href = "<?php echo esc_url( get_permalink( get_the_ID() ).'?suc=1#dem_detail_ticket_booking' ); ?>"; }, 500);
							</script>
				<?php 	} 
					}
				}
			}
			if($divi_dem_display_form == 'Inquiry'){
				if ( isset( $_GET['_wpnonce'] ) && !wp_verify_nonce( sanitize_key( $_GET['_wpnonce'] ), 'dem_response_verify' ) ) {
						$success_msg = $divi_dem_evt_inq_fail_msg;
				}else{
					if ( isset($_REQUEST['Inquiry']) && $_REQUEST['Inquiry'] == 'verify'  && (isset( $_REQUEST["InquiryId"] ) && is_numeric( $_REQUEST['InquiryId'] )) ){
					$dem_rt_if_form = et_get_option($dem_themename.'_dem_rt_if_form','off');
					if (  $dem_rt_if_form == 'on' ){
						$dem_order_id = isset( $_REQUEST["InquiryId"] ) ? intval( $_REQUEST["InquiryId"] ) : '';
						$InquiryEventId = isset( $_REQUEST["InquiryEventId"] ) ? intval( $_REQUEST["InquiryEventId"] ) : '';
						$buy_ticket = isset( $_REQUEST["InquiryTicketQty"] ) ? intval( $_REQUEST["InquiryTicketQty"] ) : '';
						$dpevent_noticket     = get_post_meta($InquiryEventId ,'dpevent_noticket', true );
						$remaining_ticket 	  = $dpevent_noticket - $buy_ticket;
						update_post_meta( $InquiryEventId, 'dpevent_noticket', esc_attr ( $remaining_ticket ) );
					}
					$success_msg = $divi_dem_evt_inq_suc_msg;
					?>
					<script>
							setTimeout(function(){  window.location.href = "<?php echo esc_url( get_permalink( get_the_ID() ).'?suc=1#dem_detail_ticket_booking' ); ?>"; }, 500);
					</script>
					<?php
					}
				}
			}
			if( isset($_REQUEST['suc']) && $_REQUEST['suc'] == '1' && is_numeric($_REQUEST['suc']) ){
				if($divi_dem_display_form == 'Booking'){
					$success_msg = $divi_dem_evt_suc_msg;
				}else{
					$success_msg = $divi_dem_evt_inq_suc_msg;
				}
			}
}//end if
while ( have_posts() ) : the_post(); 
	$et_fb_processing_shortcode_object = false;
	$post_content 					= et_strip_shortcodes( et_delete_post_first_video( get_the_content() ), true );
	$event_content 					= apply_filters( 'the_content', $post_content );
	$et_fb_processing_shortcode_object = $global_processing_original_value;
	$event_thumbnail_image_url 		= get_the_post_thumbnail_url( get_the_ID(),'full' );
	$event_permalink 				= get_the_permalink(get_the_ID());
	$event_title 					= get_the_title(get_the_ID());
	$event_start_date 				= get_post_meta(get_the_ID(), 'dp_event_start_date',true);
	$event_end_date 				= get_post_meta(get_the_ID(), 'dp_event_end_date',true);
	$event_start_time 				= get_post_meta(get_the_ID(), 'dp_event_start_time',true);
	$event_end_time 				= get_post_meta(get_the_ID(), 'dp_event_end_time',true);
	$event_venue					= get_post_meta(get_the_ID() ,'dpevent_address', true );
	$event_city						= get_post_meta(get_the_ID() ,'dpevent_city', true );
	$event_country					= get_post_meta(get_the_ID() ,'dpevent_country', true );
	$event_state					= get_post_meta(get_the_ID() ,'dpevent_state', true );
	$event_pincode					= get_post_meta(get_the_ID() ,'dpevent_pincode', true );
	$event_phone_number				= get_post_meta(get_the_ID() ,'dpevent_phone_number', true );
	$event_website 					= get_post_meta(get_the_ID(), 'dpevent_website', true);
	$event_organizer_name 			= get_post_meta(get_the_ID(), 'dpevent_organizer_name', true);
	$event_cost_name                = get_post_meta(get_the_ID(), 'dpevent_cost_name', true);
    $event_currency_prefix_suffix   = get_post_meta(get_the_ID(), 'dp_event_currency_prefix_suffix', true);
    $event_currency_symbol_name     = get_post_meta(get_the_ID(), 'dp_event_currency_symbol_name', true);
	$event_email_id 				= get_post_meta(get_the_ID(), 'dpevent_email_id', true);
	$event_ticket_cost_currency		= get_post_meta(get_the_ID(), 'dp_event_currency_symbol_name', true);
	$event_ticket_currency_position	= get_post_meta(get_the_ID(), 'dp_event_currency_prefix_suffix', true);
	$event_tags 					= get_the_terms( get_the_ID(), 'event_tag' ) ;
	$event_facebook_url             = get_post_meta(get_the_ID() ,'dpevent_facebook_url', true );
    $event_instagram_url            = get_post_meta(get_the_ID() ,'dpevent_instagram_url', true );
    $event_pinterest_url            = get_post_meta(get_the_ID() ,'dpevent_pinterest_url', true );
    $event_twitter_url              = get_post_meta(get_the_ID() ,'dpevent_twitter_url', true );
    $event_googleplus_url           = get_post_meta(get_the_ID() ,'dpevent_googleplus_url', true );
    $event_linkedin_url             = get_post_meta(get_the_ID() ,'dpevent_linkedin_url', true );
    $event_noticket               	= get_post_meta(get_the_ID() ,'dpevent_noticket', true );
	$google_map_value 				= get_post_meta( get_the_ID(), 'dpevent_google_map', true );
	$event_tag_meta	= [];
	if ( ! empty( $event_tags ) ) {
	    foreach ( $event_tags as $event_tag ) {
	        $event_tag_meta[] = $event_tag->name;
	    }
	}
	if ( ! empty( $event_tag_meta ) ) {
	    $event_tag_string = implode( ', ', $event_tag_meta );
	} else {
	    $event_tag_string = '';
	}
	$event_cats		= get_the_terms( get_the_ID(), 'event_category' );
	$event_cat_meta = [];
	if ( ! empty( $event_cats ) ) {
	    foreach ( $event_cats as $event_cat ) {
	        $event_cat_meta[] = $event_cat->name;
	    }
	}
	if ( ! empty( $event_cat_meta ) ) {
	    $event_cat_string = implode( ', ', $event_cat_meta );
	} else {
	    $event_cat_string = '';
	}
	$event_categories	= $event_cat_string;
	$event_venue_address = '';
	if( ! empty( $event_venue ) ){
		$event_venue_address .= esc_attr ( $event_venue ).', ';
	}
	if( ! empty( $event_city ) ){
		$event_venue_address .= esc_attr ( $event_city ).', ';
	}
	if( ! empty( $event_pincode ) ){
		$event_venue_address .= esc_attr ( $event_pincode ).', ';
	}
	if( ! empty( $event_state ) ){
		$event_venue_address .= esc_attr ( $event_state ).', ';
	}
	if( ! empty( $event_country ) ){
		$event_venue_address .= esc_attr ( $event_country ).', ';
	}
?>
<div class="dem_detail_style2_header_title">
	<section class="et_pb_module et_pb_fullwidth_header et_pb_text_align_left dem_hd" >		
		<div class="et_pb_fullwidth_header_container">
			<div class="header-content-container center">
				<div class="header-content">
					<h2 class="et_pb_module_header dem-detail-style2-header"><?php echo esc_attr ( get_the_title() );?></h2>
					<div class="et_pb_header_content_wrapper">
						<h4>
							<?php
							if ( $dem_display_time == 'twhr' ){
								$event_start_time = esc_html(date_i18n("h:i a",  strtotime(esc_attr( $event_start_time ))));
								$event_end_time = esc_html(date_i18n("h:i a",  strtotime(esc_attr( $event_end_time ))));
							}else{
								$event_start_time = esc_html(date_i18n("H:i",strtotime(esc_attr( $event_start_time ))));
								$event_end_time = esc_html(date_i18n("H:i",strtotime(esc_attr( $event_end_time ))));
							}
							 if ( ! empty( $event_start_date ) && ! empty( $event_start_time ) ){?>
							<span class="dem_event_date_start">
								<?php echo esc_html (date_i18n('F d,Y', esc_attr ( $event_start_date) )).' @ '.esc_attr ( $event_start_time ); ?>
							</span> 
							<?php } if ( $event_end_date && $event_end_time ){?>
							<span class="dem_event_date_end">&nbsp;&nbsp; <?php echo esc_attr($dem_evt_to);?> &nbsp;&nbsp;<?php echo esc_html (date_i18n('F d,Y', esc_attr ( $event_end_date ) )); ?> @ <?php echo esc_attr ( $event_end_time ); ?>
							</span>
							<?php } ?>
							<span class="dem_event_cost">
								<?php
								if ( ! empty( $event_cost_name ) && ! empty( $event_currency_symbol_name ) ){
									if( $event_currency_prefix_suffix == 'suffix' ){  ?>
										<i class="et-pb-icon icon_wallet">&#xe0d8;</i>
									<?php echo ' '. esc_attr ( $event_cost_name.$event_currency_symbol_name ); ?>
									<?php } else { ?>
										<i class="et-pb-icon icon_wallet">&#xe0d8;</i>
									<?php echo ' '. esc_attr ( $event_currency_symbol_name.$event_cost_name ); ?>
									<?php }
								} ?>
							</span>
						</h4>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
<div class="dem_detail_style2_image_content">
	<div class="et_pb_row dem_event_image">
		<div class="et_pb_column et_pb_column_4_4  et-last-child">
			<div class="et_pb_module et_pb_image ">
				<?php if ( $divi_dem_display_event_image_section == 'Yes' ) {?>
				<span class="et_pb_image_wrap">
					<?php $dp_posts_slider_thumb = wp_get_attachment_image_src(get_post_thumbnail_id(), 'dem_detail_1080_608');	?>
					<img src="<?php echo esc_url( $dp_posts_slider_thumb[0] ) ; ?>"  alt="<?php echo esc_attr ( get_the_title() );?>" >
				</span>
				<?php } ?>
				<span>
					<div class="et_pb_column et_pb_column_4_4 dem_detail_style2_event_content">
						<div class="et_pb_module et_pb_text et_pb_text_align_left">
							<div class="dem_style2_description">
								<p>	<?php echo et_core_intentionally_unescaped( apply_filters( 'the_content', $event_content ), 'html' );  ?></p>
							</div>
						</div>
        			</div> <!-- .et_pb_column -->    
    			</span>
			</div>
		</div> <!-- .et_pb_column -->
	</div> <!-- .et_pb_row -->
</div>
<div class="et_pb_row dem_event_detail_style2_table">
	<div class="et_pb_column et_pb_column_1_2 ">
		<div class="et_pb_module et_pb_text et_pb_text_align_left">
			<div class="et_pb_text_inner">
				<h3>
					<?php 
						esc_attr_e( $divi_dem_evt_info, 'dpevent' ); 
					 ?>
				</h3>
				<table cellpadding="8">
					<?php if( ! empty( $event_start_date ) && ! empty( $event_start_time ) ) { ?>
					<tr>	
						<th>
							<label for="Start">
								<?php 
								esc_attr_e( $divi_dem_evt_start, 'dpevent' ); 
								?> :
							</label>
						</th>
						<td><?php echo esc_html (date_i18n('F d,Y', esc_attr ( $event_start_date ) )); ?> @ <?php echo esc_attr ( $event_start_time ); ?></td>			
					</tr>
					<?php } if( ! empty( $event_end_date ) && ! empty( $event_end_time ) ) { ?>
					<tr>	
						<th>
							<label for="End">
								<?php 
								esc_attr_e( $divi_dem_evt_end, 'dpevent' ); 
								?> :
							</label>
						</th>
						<td><?php echo esc_html (date_i18n('F d,Y', esc_attr ( $event_end_date ) )); ?> @ <?php echo esc_attr ( $event_end_time ); ?></td>
					</tr>
					<?php }  if( ! empty( $event_ticket_cost_currency ) && ! empty( $event_cost_name ) ) { ?>
					<tr>	
						<th>
							<label for="Cost">
								<?php 
								esc_attr_e( $divi_dem_evt_cost, 'dpevent' ); 
								?> :
							</label>
						</th>
						<?php if( $event_ticket_currency_position == 'suffix' ){
								echo '<td>'.esc_attr ( $event_cost_name.$event_ticket_cost_currency ).'</td>';
							}else{
								echo '<td>'.esc_attr ( $event_ticket_cost_currency.$event_cost_name ).'</td>';
							} ?>
					</tr>
					<?php } if( ! empty($event_categories ) ){ ?>
					<tr>	
						<th>
							<label for="Event Category">
								<?php 
								esc_attr_e( $divi_dem_evt_categories, 'dpevent' ); 
								?> :
							</label>
						</th>
						<td><?php echo esc_attr ( $event_categories ); ?></td>			
					</tr>
					<?php } if( ! empty( $event_tag_string ) ) { ?>
					<tr>	
						<th>
							<label for="Event Tags">
								<?php 
								esc_attr_e( $divi_dem_evt_tags, 'dpevent' ); 
								?> :
							</label>
						</th>
						<td><?php echo esc_attr ( $event_tag_string ); ?></td>			
					</tr>
					<tr>	
						<th>
							<label for="Remaininng Tickets">
								<?php 
									esc_attr_e( $divi_dem_evt_rm_tickets, 'dpevent' ); ?>
							</label>
						</th>
						<td><?php echo esc_attr ( $event_noticket ); ?></td>			
					</tr>
					<?php } ?>
				</table>
			</div>
		</div> <!-- .et_pb_text -->
	</div> <!-- .et_pb_column -->
	<div class="et_pb_column et_pb_column_1_2  ">
		<div class="et_pb_module et_pb_text  et_pb_text_align_left">
			<div class="et_pb_text_inner">
				<h3>
					<?php 
					 esc_attr_e( $divi_dem_evt_org, 'dpevent' ); ?>
				 </h3>
				<table cellpadding="8">
					<?php if( ! empty( $event_organizer_name ) ){ ?>
					<tr>	
						<th>
							<label for="Organizer Name">
								<?php 
								esc_attr_e( $divi_dem_evt_organizername, 'dpevent' ); 
								?> :
							</label>
						</th>
						<td><?php echo esc_attr ( $event_organizer_name ); ?></td>			
					</tr>
					<?php } if( ! empty( $event_email_id ) ){ ?>
					<tr>	
						<th>
							<label for="Email">
								<?php 
								esc_attr_e( $divi_dem_evt_email, 'dpevent' ); 
								?> :
							</label>
						</th>
						<td><a href="mailto:<?php echo esc_attr ( $event_email_id ); ?> "><?php echo esc_attr ( $event_email_id ); ?> </a></td>			
					</tr>
					<?php } ?>
				</table>
			</div>
		</div> <!-- .et_pb_text -->
	</div> <!-- .et_pb_column -->
</div> <!-- .et_pb_row -->
<div class="et_pb_row dem_event_detail_style2_table">
	<div class="et_pb_column et_pb_column_1_2 ">
		<div class="et_pb_module et_pb_text et_pb_text_align_left">
			<div class="et_pb_text_inner">
				<h3>
					<?php 
					esc_attr_e( $divi_dem_evt_venue, 'dpevent' ); ?>
				</h3>
				<table cellpadding="8">
					<?php if( ! empty( $event_venue ) && ! empty( $event_city ) && ! empty( $event_state ) ) { ?>
					<tr>		
						<th>
							<label for="Address">
								<?php 
								esc_attr_e( $divi_dem_evt_address, 'dpevent' ); 
								?> :
							</label>
						</th>
						<td><?php echo   esc_attr(rtrim($event_venue_address,', '));?></td>			
					</tr>
					<?php } if( ! empty( $event_phone_number ) && $divi_dem_hide_tel_no_frm != 'on'  ){ ?>
					<tr>
						<th>
							<label for="Phone">
								<?php 
								esc_attr_e( $divi_dem_evt_phoneno, 'dpevent' ); 
								?> :
							</label>
						</th>
						<td><?php echo esc_attr ( $event_phone_number ); ?></td>			
					</tr>
					<?php } if( ! empty( $event_website ) ){  ?>
					<tr>		
						<th>
							<label for="website">
								<?php 
								esc_attr_e( $divi_dem_evt_website, 'dpevent' ); 
								?> :
							</label>
						</th>
						<td><a href="<?php echo esc_url ( $event_website ); ?>" target="_blank"><?php echo esc_url ( $event_website ); ?></a></td>			
					</tr>
					<?php } ?>
				</table>
			</div>
		</div> <!-- .et_pb_text -->
	</div> <!-- .et_pb_column -->
	<?php if ( $divi_dem_display_event_location_section == 'Yes' ) {  
			if ( $google_map_value == "yes" ){?>
	<div class="et_pb_column et_pb_column_1_2 dem_detail_style2_google_map">
		<div class="et_pb_module et_pb_text et_pb_text_align_left">
			<div class="et_pb_text_inner dem_detail_style2_google_map_location">
				<h3><?php 
				esc_attr_e( $divi_dem_evt_location, 'dpevent' ); ?> </h3>
				<?php $seach_data = rtrim($event_venue_address,", "); ?>
                    <iframe id="map"  frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.it/maps?q=<?php echo esc_attr ( $seach_data ); ?>&output=embed"></iframe>
			</div>
		</div> <!-- .et_pb_text -->
	</div> <!-- .et_pb_column -->
	<?php }
	}  ?>
</div> <!-- .et_pb_row -->
 <?php  if ( $divi_dem_display_social_icon_section == 'Yes' ) { ?>   
    <div class="et_pb_row dem_detail_style2_social">
        <div class="et_pb_column et_pb_column_4_4 ">
            <div class="et_pb_module et_pb_text   et_pb_text_align_left">
                <div class="et_pb_text_inner">
                    <h3 class= "dem_detail_style2_social_title"><?php 
					esc_attr_e( $divi_dem_evt_share, 'dpevent' ); ?></h3>
                </div>
                <ul class="et_pb_module et_pb_social_media_follow">
                   <li> <a target="blank" href="http://www.facebook.com/share.php?u=<?php echo esc_url( get_permalink() ); ?>&title=<?php echo esc_attr ( get_the_title() ); ?>"><i class="et-pb-icon social-icon facebook-icon event_social_icon" >&#xe0aa;</i></a></li>
                   <li> <a target="blank" href="https://twitter.com/share?text=<?php echo rawurlencode(esc_attr ( get_the_title() )); ?>&url=<?php echo esc_url( get_permalink()  ); ?>"><i class="et-pb-icon social-icon twitter-icon event_social_icon" >&#xe0ab;</i></a></li>
                  <li><a target="blank" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo esc_url( get_permalink() ); ?>&title=<?php echo rawurlencode(esc_attr ( get_the_title() )); ?>&source=<?php echo esc_url(home_url('/')); ?>"><i class="et-pb-icon social-icon linkedin-icon event_social_icon" >&#xe0b4;</i></a> </li>
                 </ul>    
            </div> <!-- .et_pb_text -->
        </div> <!-- .et_pb_column -->
    </div> <!-- .et_pb_row -->
<?php } if ( $divi_dem_display_event_gallery_section == 'Yes' ) { ?>   
<div class="et_pb_row dem_detail_style2_image_gallery">
	<div class="et_pb_column et_pb_column_4_4 ">
		<div class="et_pb_module et_pb_text et_pb_text_align_left">
			<div class="et_pb_text_inner">
				<h3 class= 'dem_detail_style2_image_gallery_title'><?php 
				esc_attr_e( $divi_dem_evt_gallery, 'dpevent' ); ?></h3>
			</div>
			<div class="dem-event-single-event-footer dem-event clearfix">
                <div class="popup-gallery">
                    <?php 
                        global $post;
                        $values = get_post_custom( $post->ID );
                        $dpevent_cust_imagebox = isset( $values['dpevent_cust_image_id'] ) ? esc_attr( $values['dpevent_cust_image_id'][0] ) : "0";
                        $i = 1;
                        for($i=0; $i<$dpevent_cust_imagebox+1; $i++ ):
                            $dpevent_cust_gallery_upload_attach_id = isset( $values['dpevent_cust_imagebox'.$i] ) ? esc_attr( $values['dpevent_cust_imagebox'.$i][0] ) : "";
                            $dpevent_cust_gallery_upload_image_src = wp_get_attachment_image_src( $dpevent_cust_gallery_upload_attach_id, 'thumbnail' );
                            	 $dpevent_cust_gallery_upload_image_src_large = wp_get_attachment_image_src( $dpevent_cust_gallery_upload_attach_id, 'large');
                            $dpevent_cust_galleryCheckImg = "none";
                            if ( !empty($dpevent_cust_gallery_upload_image_src[0]))
                            {
                                $dpevent_cust_galleryCheckImg = "inline-block";
                            }
                    ?>
                    <a href="<?php echo esc_url( $dpevent_cust_gallery_upload_image_src_large[0] ); ?>" title="<?php echo esc_attr ( get_the_title() ); ?>">
                    	<img src="<?php echo esc_url( $dpevent_cust_gallery_upload_image_src[0] ); ?>" >
                	</a>
                    <?php endfor; ?>
                </div>
            </div>
		</div> <!-- .et_pb_text -->
	</div> <!-- .et_pb_column -->
</div> <!-- .et_pb_row -->
<?php 
}
	if($event_currency_prefix_suffix == 'suffix'){ 
		$ticket_prices = esc_attr ( $event_cost_name.' '.$event_currency_symbol_name );
	} else { 
		$ticket_prices = esc_attr ( $event_currency_symbol_name.' '.$event_cost_name ); 
	}
if ( $divi_dem_hide_form != 'on' ){

?>    
<div class="et_pb_row  dem_detail_style2_ticket_booking" id="dem_detail_ticket_booking">
        <div class="et_pb_module et_pb_text dem_detail_style2_ticket_booking_title et_pb_text_align_left">
            <div class="et_pb_text_inner">
                <h3 class= "dem_detail_style2_ticket_booking_title_text"><?php 
				esc_attr_e( $divi_dem_evt_tickets, 'dpevent' ); ?>
				 </h3>
            </div>
        </div>
 		<div id="dem_detail_style2_contact_form">
			<div class="et-pb-contact-message"><?php  if($success_msg){ echo "<p>".esc_html($success_msg)."</p>";}?></div>
			<div class="et_pb_contact">
              <h6 class="dem_avilable_ticket"><?php 
				esc_attr_e( $divi_dem_evt_rm_tickets, 'dpevent' ); ?>
				: <strong><?php echo esc_attr( $event_noticket ); ?></strong>
			   </h6>
                <?php if($divi_dem_display_form == 'Booking'){
                        $get_action_option = "https://www.sandbox.paypal.com/cgi-bin/webscr";
                        if ( $divi_dem_paypal_mode == 'Live'){
                            $get_action_option = "https://www.paypal.com/cgi-bin/webscr";
                       }
				 ?>     
                  <form id="dem_ticket_booking_paypal" class=" clearfix" method="post" action="<?php echo esc_url ( $get_action_option ); ?>">
                        <?php   $book_nonce = wp_create_nonce( 'dem_ticket_booking_paypal_nonce' );  ?>
                        <p class="et_pb_contact_field dem_ticket_booking_left">
                            <label for="dem_detail_name" class="et_pb_contact_form_label"><?php esc_html_e( $divi_dem_frm_name, 'dpevent' ); ?></label>
                            <input type="text" id="dem_detail_name" class="input" value="" name="dem_detail_name"  placeholder="<?php esc_html_e( $divi_dem_frm_name, 'dpevent' ); ?>" required>
                        </p>

                        <p class="et_pb_contact_field dem_ticket_booking_left" >
                            <label for="dem_detail_email_id" class="et_pb_contact_form_label"><?php esc_html_e( $divi_dem_frm_emailaddress, 'dpevent' ); ?></label>
                            <input type="email" id="dem_detail_email_id" class="input" value="" name="dem_detail_email_id"  placeholder="<?php esc_html_e( $divi_dem_frm_emailaddress, 'dpevent' ); ?>" required>
                        </p>
						<?php if ( $divi_dem_hide_tel_no_frm == 'on' ){?>
							<input type="hidden" id="dem_detail_phone_no" class="input" value="1111111111" name="dem_detail_phone_no" placeholder="<?php esc_html_e( $divi_dem_frm_telno, 'dpevent' ); ?>" maxlength="15" minlength="10" required>
							<?php }else{ ?>
                        <p class="et_pb_contact_field dem_ticket_booking_left" >
                            <label for="dem_detail_phone_no" class="et_pb_contact_form_label"><?php esc_html_e( $divi_dem_frm_telno, 'dpevent' ); ?></label>
                            <input type="text" id="dem_detail_phone_no" class="input" value="" name="dem_detail_phone_no" placeholder="<?php esc_html_e( $divi_dem_frm_telno, 'dpevent' ); ?>"  maxlength="10" minlength="10" required>
                        </p>
						<?php } ?>
                       <p class="et_pb_contact_field dem_ticket_booking_left" >
                            <label for="dem_detail_no_of_ticket" class="et_pb_contact_form_label"><?php esc_html_e( $divi_dem_frm_no_of_tickets, 'dpevent' ); ?></label>
                            <select id="dem_detail_no_of_ticket" class="et_pb_contact_select input" name="dem_detail_no_of_ticket" >
                                <?php 
									$dpevent_noticket_allowtobook   = get_post_meta(get_the_ID(), 'dpevent_noticket_allowtobook', true);
									$dpevent_noticket_allowtobook_qty 	= ( $dpevent_noticket_allowtobook != '' ) ? $dpevent_noticket_allowtobook : '10';
									$x = 1;$max_no_tickets = esc_attr($dpevent_noticket_allowtobook_qty);
                                     for ($x = 1; $x<= $max_no_tickets; $x++) {   ?>
                                    <option value="<?php echo esc_attr( $x ); ?>"><?php echo esc_attr( $x ); ?></option>
                                <?php  } ?>
                            </select>
                        </p>                  
                        <p class="et_pb_contact_field   et_pb_contact_field_half dem_ticket_booking_left" data-id="ticket_price" data-type="ticket_price">
                            <label for="dem_detail_ticket_price" class="et_pb_contact_form_label"><?php esc_html_e( $divi_dem_frm_price_tickets, 'dpevent' ); ?></label>
                            <input type="text" id="dem_detail_total_ticket_price" class="input" value="<?php echo esc_attr( $ticket_prices ); ?>" name="dem_detail_total_ticket_price" readonly>
                        </p>
                             <input type="hidden" id="dem_detail_single_ticket_prices" name="dem_detail_single_ticket_prices" value="<?php echo esc_attr( $event_cost_name ); ?>">
                            <input type="hidden" id="dem_detail_ticket_currency_symbol_position" name="dem_detail_ticket_currency_symbol_position" value="<?php echo esc_attr( $event_currency_prefix_suffix ); ?>">
                            <input type="hidden" id="dem_detail_ticket_currency_symbol_name" name="dem_detail_ticket_currency_symbol_name" value="<?php echo esc_attr( $event_currency_symbol_name ); ?>">
                            <input type="hidden" id="dem_detail_event_id" name="dem_detail_event_id" value="<?php echo esc_attr ( get_the_ID() ); ?>">
                            <input type="hidden" id="dem_detail_event_title" name="dem_detail_event_title" value="<?php echo esc_attr ( get_the_title() ); ?>">
                            <input type="hidden" id="dem_detail_event_order_date" name="dem_detail_event_order_date" value="<?php echo esc_attr( gmdate("Y-m-d") ); ?>">
                            <input type='hidden' value='<?php echo esc_attr ($book_nonce); ?>' name='dem_ticket_booking_paypal' id="dem_ticket_booking_paypal_nonce"/>
                            <input type="hidden" name="cmd" value="_xclick">
                            <input type="hidden" name="rm" value="2" />
                            <input type="hidden" name="charset" value="utf-8"/>
                            <input type="hidden" name="business" value="<?php echo esc_attr( $divi_dem_paypal_email_address ); ?>">
                            <input type="hidden" name="item_name" value="<?php echo esc_attr ( get_the_title() ); ?>">
                            <input type="hidden" name="item_number" value="<?php echo esc_attr( get_the_ID() ); ?>">
                            <input type="hidden" name="amount" value="<?php echo esc_attr( $event_cost_name ); ?>"><!-- Rs -->
                            <input type="hidden" name="quantity" value="1"><!-- number of ticket --> 
                            <input type="hidden" name="currency_code" value="<?php echo esc_attr( $event_currency_symbol_name ); ?>">
                            <input type="hidden" name="no_shipping" value="0">
                            <input type="hidden" name="no_note" value="1">
                            <input type="hidden" name="lc" value="US">
							<?php $dem_paypal_return_url = et_get_option($dem_themename.'_dem_paypal_return',esc_url ( get_permalink(get_the_ID()) ));
								if ( $dem_paypal_return_url != '' ){$dem_paypal_return_url = esc_url ($dem_paypal_return_url);}else{$dem_paypal_return_url = esc_url ( get_permalink(get_the_ID()) );}
								?>
                            <input name = "return" value = "<?php echo esc_url ( $dem_paypal_return_url ); ?>" type = "hidden">   
                            <input name = "cancel_return" value = "<?php echo esc_url ( get_permalink(get_the_ID()) ); ?>" type = "hidden">
                        <div>
						<?php 
							if ( $dem_event_fully_booked == 'on' && $event_noticket == 0 ){
								 echo esc_html_e( $dem_evt_fully_booked_msg, 'dpevent' ); 
							}else{
								$dem_current_date = gmdate('d-m-Y');
								if ( $dem_event_hide_expired_booked == 'on' &&  strtotime($dem_current_date) > $event_end_date ){
									 echo esc_html_e( $dem_evt_expired_msg, 'dpevent' ); 
									
								}else{
								?>
								<input type="submit" class="et_pb_contact_submit dem_events_paypal_button" value="<?php esc_html_e( $divi_dem_evt_btn, 'dpevent' );?>" >
								<?php
								}
							 } ?>
                        </div>
                    </form>
                <?php } else{ ?>
                   <form id="dem_ticket_inquiry" class=" clearfix" method="post" action="#" >
                        <?php 
                            $book_nonce = wp_create_nonce( 'dem_ticket_booking_paypal_nonce' );
                        ?>
                        <p class="et_pb_contact_field dem_ticket_booking_left">
                            <label for="dem_detail_name" class="et_pb_contact_form_label"><?php esc_html_e( $divi_dem_frm_name, 'dpevent' ); ?></label>
                            <input type="text" id="dem_detail_name" class="input" value="" name="dem_detail_name"  placeholder="<?php esc_html_e( $divi_dem_frm_name, 'dpevent' ); ?>" required>
                        </p>

                        <p class="et_pb_contact_field dem_ticket_booking_left" >
                            <label for="dem_detail_email_id" class="et_pb_contact_form_label"><?php esc_html_e( $divi_dem_frm_emailaddress, 'dpevent' ); ?></label>
                            <input type="email" id="dem_detail_email_id" class="input" value="" name="dem_detail_email_id"  placeholder="<?php esc_html_e( $divi_dem_frm_emailaddress, 'dpevent' ); ?>" required>
                        </p>
						<?php if ( $divi_dem_hide_tel_no_frm == 'on' ){?>
							<input type="hidden" id="dem_detail_phone_no" class="input" value="1111111111" name="dem_detail_phone_no" placeholder="<?php esc_html_e( $divi_dem_frm_telno, 'dpevent' ); ?>" maxlength="15" minlength="10" required>
						<?php }else{ ?>
                        <p class="et_pb_contact_field dem_ticket_booking_left" >
                            <label for="dem_detail_phone_no" class="et_pb_contact_form_label"><?php esc_html_e( $divi_dem_frm_telno, 'dpevent' ); ?></label>
                            <input type="text" id="dem_detail_phone_no" class="input" value="" name="dem_detail_phone_no" placeholder="<?php esc_html_e( $divi_dem_frm_telno, 'dpevent' ); ?>"  maxlength="15" minlength="10" required>
                        </p>
						<?php } ?>
						 <?php  $dem_rt_if_form = et_get_option($dem_themename.'_dem_rt_if_form','off');
						if (  $dem_rt_if_form == 'on' ){ ?>
						<p class="et_pb_contact_field dem_ticket_booking_left" >
                            <label for="dem_detail_no_of_ticket" class="et_pb_contact_form_label"><?php esc_html_e( $divi_dem_frm_no_of_tickets, 'dpevent' ); ?></label>
                            <select id="dem_detail_no_of_ticket" class="et_pb_contact_select input" name="dem_detail_no_of_ticket" >
                                <?php 
                                    $dpevent_noticket_allowtobook   = get_post_meta(get_the_ID(), 'dpevent_noticket_allowtobook', true);
									$dpevent_noticket_allowtobook_qty 	= ( $dpevent_noticket_allowtobook != '' ) ? $dpevent_noticket_allowtobook : '10';
									 $x = 1;$max_no_tickets = esc_attr($dpevent_noticket_allowtobook_qty);
                                     for ($x = 1; $x<= $max_no_tickets; $x++) {  
                                ?>
                                    <option value="<?php echo esc_attr ( $x ); ?>"><?php echo esc_attr ( $x ); ?></option>
                                <?php
                                     }
                                ?>
                            </select>
                        </p> 
						 <?php } if (  $divi_dem_price_inquiry_form == 'on' && $dem_rt_if_form == 'on' ){ ?>
						 <p class="et_pb_contact_field   et_pb_contact_field_half dem_ticket_booking_left" data-id="ticket_price" data-type="ticket_price">
                            <label for="dem_detail_ticket_price" class="et_pb_contact_form_label"><?php esc_html_e( $divi_dem_frm_price_tickets, 'dpevent' ); ?></label>
                            <input type="text" id="dem_detail_total_ticket_price" class="input" value="<?php echo esc_attr( $ticket_prices ); ?>" name="dem_detail_total_ticket_price" readonly>
                        </p>
                             <input type="hidden" id="dem_detail_single_ticket_prices" name="dem_detail_single_ticket_prices" value="<?php echo esc_attr($event_cost_name); ?>">
                            <input type="hidden" id="dem_detail_ticket_currency_symbol_position" name="dem_detail_ticket_currency_symbol_position" value="<?php echo esc_attr( $event_currency_prefix_suffix ); ?>">
                            <input type="hidden" id="dem_detail_ticket_currency_symbol_name" name="dem_detail_ticket_currency_symbol_name" value="<?php echo esc_attr($event_currency_symbol_name ); ?>">
							<?php } ?>
                            <input type="hidden" id="dem_detail_event_id" name="dem_detail_event_id" value="<?php echo esc_attr ( get_the_ID() ); ?>">
                            <input type="hidden" id="dem_detail_event_title" name="dem_detail_event_title" value="<?php echo esc_attr ( get_the_title() ); ?>">
                            <input type="hidden" id="dem_detail_event_order_date" name="dem_detail_event_order_date" value="<?php echo esc_attr( gmdate("Y-m-d") ); ?>">
                            <input type='hidden' value='<?php echo esc_attr ($book_nonce); ?>' name='dem_ticket_booking_paypal' id="dem_ticket_booking_paypal_nonce"/>
                            <?php $dem_paypal_return_url = et_get_option($dem_themename.'_dem_paypal_return',esc_url ( get_permalink(get_the_ID()) ));
								if ( $dem_paypal_return_url != '' ){$dem_paypal_return_url = esc_url ($dem_paypal_return_url);}else{$dem_paypal_return_url = esc_url ( get_permalink(get_the_ID()) );}
							?>
								<input name="return" value= "<?php echo esc_url ( $dem_paypal_return_url ); ?>" type = "hidden"> 
                            <div>
							<?php 
							if ( $dem_event_fully_booked == 'on' && $event_noticket == 0 ){
								 echo esc_html_e( $dem_evt_fully_booked_msg, 'dpevent' ); 
							}else{
								$dem_current_date = gmdate('d-m-Y');
								if ( $dem_event_hide_expired_booked == 'on' &&  strtotime($dem_current_date) > $event_end_date ){
									 echo esc_html_e( $dem_evt_expired_msg, 'dpevent' ); 
									
								}else{
								?>
								<input type="submit" class="et_pb_contact_submit dem_events_paypal_button" value="<?php esc_html_e( $divi_dem_evt_btn, 'dpevent' );?>" >
								<?php
								}
							} ?>
                        </div>  
                    </form>
                  <?php } ?>    
                </div>
		</div>
 </div> 			 
<?php 
}
	endwhile;
	get_footer();
?>