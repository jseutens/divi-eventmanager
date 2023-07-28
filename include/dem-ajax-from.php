<?php
// Paypal
function dem_makeBooking(){
	global $wpdb;
	$json_result = array();
	$dem_themename = dem_theme_name();
	$divi_dem_hide_tel_no_frm 					= et_get_option($dem_themename.'_dem_hide_tel_no_frm','off');
	if ( isset( $_POST['book_nonce_data'] ) && !wp_verify_nonce( sanitize_key( $_POST['book_nonce_data'] ), 'dem_ticket_booking_paypal_nonce' ) ) {
		 $json_result['success'] = 0;
		 wp_die();
	}	
  	$dem_book_data 				= isset($_POST['book_data']) ? dem_unserializeForm(urldecode(sanitize_text_field($_POST['book_data']))) : '';
	if ( empty($dem_book_data) ) { 
		 $json_result['success'] = 0;
		 wp_die(); 
	}
	$book_return_url = isset( $_POST["book_return_url"] ) ? esc_url_raw( $_POST["book_return_url"] ) : '';
	$book_email_data = isset( $_POST["book_email_data"] ) ? sanitize_email ( $_POST["book_email_data"] ) : '';
	
  	$dem_detail_name   							= sanitize_text_field( $dem_book_data ["dem_detail_name"] );
    $dem_detail_email_id 						= sanitize_email( $book_email_data );
    $dem_detail_phone_no 						= sanitize_text_field( $dem_book_data ["dem_detail_phone_no"] );
    $dem_detail_no_of_ticket 					= sanitize_text_field( $dem_book_data ["dem_detail_no_of_ticket"] );
    $dem_detail_total_ticket_price				= sanitize_text_field( $dem_book_data ["dem_detail_total_ticket_price"] );
	$dem_detail_ticket_currency_symbol_position = sanitize_text_field( $dem_book_data ["dem_detail_ticket_currency_symbol_position"] );
	$dem_detail_ticket_currency_symbol_name		= sanitize_text_field( $dem_book_data ["dem_detail_ticket_currency_symbol_name"] );
	$dem_detail_single_ticket_prices			= sanitize_text_field( $dem_book_data ["dem_detail_single_ticket_prices"] );
	$dem_detail_event_id						= sanitize_text_field( $dem_book_data ["dem_detail_event_id"] );
	$dem_detail_event_title						= sanitize_text_field( $dem_book_data ["dem_detail_event_title"] );
	$dem_detail_event_order_date				= sanitize_text_field( $dem_book_data ["dem_detail_event_order_date"] );
	$return										= esc_url( $book_return_url );
	$table = $wpdb->prefix.'dem_order';
	if ( ! wp_verify_nonce( sanitize_key( $dem_book_data['dem_ticket_booking_paypal'] ), 'dem_ticket_booking_paypal_nonce' ) ) {
		 $json_result['success'] = 0;
		 wp_die();

	}elseif( ($dem_detail_name == '') || ($dem_detail_email_id == '') || ($dem_detail_phone_no == '') ){
			$json_result['success'] = 0;
			 wp_die();
	}else{

	  	$dem_order_data =  array(
					        'dem_user_name'				=>	$dem_detail_name,
					        'dem_user_email'			=>	$dem_detail_email_id,
					        'dem_user_tel'				=>	$dem_detail_phone_no,
					        'dem_event_id'				=> 	$dem_detail_event_id,
					        'dem_event_title'			=> 	$dem_detail_event_title,
					        'dem_event_currency'		=>	$dem_detail_ticket_currency_symbol_name,
					        'dem_event_cu_pos'			=> 	$dem_detail_ticket_currency_symbol_position,
					        'dem_event_ticket_price'	=> 	$dem_detail_single_ticket_prices,
					        'dem_event_no_of_ticket'	=>	$dem_detail_no_of_ticket,
					        'dem_event_total_price'		=> 	$dem_detail_total_ticket_price,
					        'dem_booking_date'			=>	date_i18n('Y-m-d', strtotime($dem_detail_event_order_date)),
					        'dem_booking_status'		=> 'Pending',
	     				 );
		$wpdb->insert($table,$dem_order_data );

		$dem_booking_lastid = $wpdb->insert_id;
		
		$dem_email_msg1 				= __('Booking/Inquiry Information','dpevent');
		$dem_email_msg2 				= __('Dear Site Administrator, Following booking/inquiry enquiry has been received.','dpevent');
		$dem_email_name 				= __('Name','dpevent');
		$dem_email_email 				= __('Email','dpevent');
		$dem_email_phone 				= __('Phone','dpevent');
		$dem_email_event_name 			= __('Event Name','dpevent');
		$dem_email_event_id 			= __('Event ID','dpevent');
		$dem_email_price 				= __('Price','dpevent');
		$dem_email_noft 				= __('No of Tickets','dpevent');
		$dem_email_tp 					= __('Total Price','dpevent');
		$dem_email_status				= __('Booking Status','dpevent');
		$dem_email_bookingdate 			= __('Booking/Inquiry Date','dpevent');
		$dem_email_subject 				= __('Booking/Inquiry From .','dpevent');
	
		$enable_email_customization 	= dem_email_customization_op_get_value('enable_email_customization','No');
		$cc_email_customization 		= dem_email_customization_op_get_value('cc_email_customization','');
		
		$useremail_content   			= dem_email_customization_op_get_value('useremail','');
		$adminemail_content   			= dem_email_customization_op_get_value('adminemail','');
		$admin_subject_email_customization = dem_email_customization_op_get_value('admin_subject_email_customization',''); 
		$user_subject_email_customization  = dem_email_customization_op_get_value('user_subject_email_customization','');
		
		$enable_admin_email_customization = dem_email_customization_op_get_value('enable_admin_email_customization','No');
		
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
			 'Pending Review',
			 date_i18n('Y-m-d', strtotime($dem_detail_event_order_date)),
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
			 $dpevent_admin_email_id_value 		= get_post_meta( $dem_email_event_id, 'dpevent_admin_email_id', true );
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
			$headers  = "From: {$admin_from}\n";
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
			
		}else{
		$cc_email_customization 		= dem_email_customization_op_get_value('cc_email_customization','');

		$content = "<table width='500' border='1' cellspacing='0' cellpadding='0'><tr><td><table width='100%'><tr>";
		$content .= "<td align='center'>".$dem_email_msg1."</td>";
		$content .=	"</tr></table></td></tr><tr><td>
							<table width='100%' border='0' cellspacing='5' cellpadding='2' align='center'>
								<tr><td colspan='2'>".$dem_email_msg2."</td></tr>
								<tr><td width='50%'></td></tr>
								<tr><td align='left' valign='top'>".$dem_email_name.": </td><td valign='top'>".$dem_detail_name."</td></tr>
								<tr><td align='left' valign='top'>".$dem_email_email.": </td><td valign='top'>".$dem_detail_email_id."</td></tr>";
								if ( $divi_dem_hide_tel_no_frm != 'on'  ){
									$content .=	"<tr><td align='left' valign='top'>".$dem_email_phone.": </td><td valign='top'>".$dem_detail_phone_no."</td></tr>";
								}
								$content .=	"<tr><td align='left' valign='top'>".$dem_email_event_name.": </td><td valign='top'>".$dem_detail_event_title."</td></tr>
								<tr><td align='left' valign='top'>".$dem_email_event_id.": </td><td valign='top'>".$dem_detail_event_id."</td></tr>
								<tr><td align='left' valign='top'>".$dem_email_price.": </td><td valign='top'>".$dem_detail_ticket_currency_symbol_name." ".$dem_detail_single_ticket_prices."</td></tr>
								<tr><td align='left' valign='top'>".$dem_email_noft.": </td><td valign='top'>".$dem_detail_no_of_ticket."</td></tr>
								<tr><td align='left' valign='top'>".$dem_email_tp.": </td><td valign='top'>".$dem_detail_total_ticket_price."</td></tr>
								<tr><td align='left' valign='top'>".$dem_email_status.": </td><td valign='top'>Pending Review</td></tr>
								<tr><td align='left' valign='top'>".$dem_email_bookingdate.": </td><td valign='top'>".date_i18n('Y-m-d', strtotime($dem_detail_event_order_date))."</td></tr>
							</table></td></tr><tr>
						<td></td></tr></table>";
		
		$plain_content  = $dem_email_msg2.".\n\n";		
		$plain_content .= $dem_email_name.": ".$dem_detail_name."\n";		
		$plain_content .= $dem_email_email.": ".$dem_detail_email_id."\n";
		if ( $divi_dem_hide_tel_no_frm != 'on'  ){
		$plain_content .= $dem_email_phone.": ".$dem_detail_phone_no."\n";
		}
		$plain_content .= $dem_email_event_name.": ".$dem_detail_event_title."\n";
		$plain_content .= $dem_email_event_id.": ".$dem_detail_event_id."\n";
		$plain_content .= $dem_email_price.": ".$dem_detail_ticket_currency_symbol_name." ".$dem_detail_single_ticket_prices."\n";
		$plain_content .= $dem_email_noft.": ".$dem_detail_no_of_ticket."\n";
		$plain_content .= $dem_email_tp.": ".$dem_detail_total_ticket_price."\n";
		$plain_content .= $dem_email_status.": Pending Review \n";
		$plain_content .= $dem_email_bookingdate.": ".date_i18n('Y-m-d', strtotime($dem_detail_event_order_date))."\n\n";
		
		$enable_admin_email_customization = dem_email_customization_op_get_value('enable_admin_email_customization','No');
		$dpevent_admin_email_id_value 		= get_post_meta( $dem_detail_event_id, 'dpevent_admin_email_id', true );
		if ( $enable_admin_email_customization == 'Yes' && !empty($dpevent_admin_email_id_value ) ){
			 	 $to = $dpevent_admin_email_id_value;
		}else{
			$to = get_option('admin_email');
		}
		$from = $dem_detail_name." <".$dem_detail_email_id.">";
		$subject = $dem_email_subject." ".$dem_detail_name;
		$txt = $content;
		$plain_txt = $plain_content;
		
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
		$message.= $txt;
		$message.= "\n\n";
		
		# End email
		$message .= "--{$mime_boundary}--\n";;

		$result = mail($to, $subject, $message, $headers);
		
		$dem_email_msg3 				= __('Thank you for contacting us. We will be in contact with you shortly. We have received your following booking/inquiry details:','dpevent');
		$dem_email_msg4 				= __('Event Booking/Inquiry.','dpevent');
		$dem_email_msg5 				= __('Confirmation Mail From Event Booking/Inquiry.','dpevent');
		
		$contentr = "<table width='500' border='1' cellspacing='0' cellpadding='0'><tr><td><table width='100%'><tr>";
		$contentr .= "<td align='center'>".$dem_email_msg1."</td>";
		$contentr .= "</tr></table></td></tr><tr><td>
							<table width='100%' border='0' cellspacing='5' cellpadding='2' align='center'>
								<tr><td colspan='2'> Dear ".$dem_detail_name.",</td></tr>
								<tr><td colspan='2'	> ".$dem_email_msg3."</td></tr>
								<tr><td width='50%'></td></tr><tr><td width='50%'></td></tr>
								<tr><td align='left' valign='top'>".$dem_email_name.": </td><td valign='top'>".$dem_detail_name."</td></tr>
								<tr><td align='left' valign='top'>".$dem_email_email.": </td><td valign='top'>".$dem_detail_email_id."</td></tr>";
								if ( $divi_dem_hide_tel_no_frm != 'on'  ){
								$contentr .= "<tr><td align='left' valign='top'>".$dem_email_phone.": </td><td valign='top'>".$dem_detail_phone_no."</td></tr>";
								}
								$contentr .= "<tr><td align='left' valign='top'>".$dem_email_event_id.": </td><td valign='top'>".$dem_detail_event_id."</td></tr>
								<tr><td align='left' valign='top'>".$dem_email_event_name.": </td><td valign='top'>".$dem_detail_event_title."</td></tr>
								<tr><td align='left' valign='top'>".$dem_email_price.": </td><td valign='top'>".$dem_detail_ticket_currency_symbol_name." ".$dem_detail_single_ticket_prices."</td></tr>
								<tr><td align='left' valign='top'>".$dem_email_noft.": </td><td valign='top'>".$dem_detail_no_of_ticket."</td></tr>
								<tr><td align='left' valign='top'>".$dem_email_tp.": </td><td valign='top'>".$dem_detail_total_ticket_price."</td></tr>
								<tr><td align='left' valign='top'>".$dem_email_status.": </td><td valign='top'>Pending Review</td></tr>
								<tr><td align='left' valign='top'>".$dem_email_bookingdate.": </td><td valign='top'>".date_i18n('Y-m-d', strtotime($dem_detail_event_order_date))."</td></tr>
								</table></td></tr><tr><td></td></tr></table>";
								
		$plain_contentr  = "Dear ".$dem_detail_name.",\n";
		$plain_contentr .= $dem_email_msg3.":\n\n";
		
		$plain_contentr .= $dem_email_name.": ".$dem_detail_name."\n";		
		$plain_contentr .= $dem_email_email.": ".$dem_detail_email_id."\n";
		if ( $divi_dem_hide_tel_no_frm != 'on'  ){
		$plain_contentr .= $dem_email_phone.": ".$dem_detail_phone_no."\n";
		}
		$plain_contentr .= $dem_email_event_id.": ".$dem_detail_event_id."\n";
		$plain_contentr .= $dem_email_event_name.": ".$dem_detail_event_title."\n";
		$plain_contentr .= $dem_email_price.": ".$dem_detail_ticket_currency_symbol_name." ".$dem_detail_single_ticket_prices."\n";
		$plain_contentr .= $dem_email_noft.": ".$dem_detail_no_of_ticket."\n";
		$plain_contentr .= $dem_email_tp.": ".$dem_detail_total_ticket_price."\n";
		$plain_contentr .= $dem_email_status.": Pending Review \n";
		$plain_contentr .= $dem_email_bookingdate.": ".date_i18n('Y-m-d', strtotime($dem_detail_event_order_date))."\n\n";
		
		
		$email_to = $dem_detail_email_id;
		$email_from = $dem_email_msg4." <".get_option('admin_email').">";
		$email_subject = $dem_email_msg5;
		$email_txt = $contentr;
		$email_plain_txt = $plain_contentr;
		
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
	    if ($dem_booking_lastid){
	    	$json_result['success']	=	1;
	    	$json_result['id']		=	$dem_booking_lastid;
	    	$json_result['url'] 	= add_query_arg( array(
											'booking' => 'verify',
											'oid' => $dem_booking_lastid,
											'_wpnonce'=> wp_create_nonce( 'dem_response_verify' )
										),  $return );
	    }else{
		 	$json_result['success'] = 0;
	    }
	    wp_send_json($json_result);
     	wp_die();
  }
}
add_action('wp_ajax_make_booking', 'dem_makeBooking');
add_action('wp_ajax_nopriv_make_booking', 'dem_makeBooking'); // not really needed
function dp_recursive_sanitize_text_field( $array ) {
    foreach ( $array as $key => &$value ) {
        if ( is_array( $value ) ) {
            $value = dp_recursive_sanitize_text_field( $value );
        } else {
            $value = sanitize_text_field( $value );
        }
    }
    return $array;
}
//Inquiry
function dem_makeInquiry(){
	global $wpdb;
	$json_result = array();
	$dem_themename = dem_theme_name();
	$divi_dem_hide_tel_no_frm 					= et_get_option($dem_themename.'_dem_hide_tel_no_frm','off');
	$dem_rt_if_form 							= et_get_option($dem_themename.'_dem_rt_if_form','off');
	$divi_dem_price_inquiry_form				= et_get_option($dem_themename.'_dem_price_inquiry_form','off');
	if ( isset( $_POST['book_nonce_data'] ) && !wp_verify_nonce( sanitize_key( $_POST['book_nonce_data'] ), 'dem_ticket_booking_paypal_nonce' ) ) {
		 $json_result['success'] = 0;
		 wp_die();
	}	
	$dem_book_data 				= isset($_POST['book_data']) ? dem_unserializeForm(urldecode( dp_recursive_sanitize_text_field($_POST['book_data']) ) ) : '';
	if ( empty($dem_book_data) ) { 
		 $json_result['success'] = 0;
		 wp_die(); 
	} 
	$book_return_url 						= isset( $_POST["book_return_url"] ) ? esc_url_raw( $_POST["book_return_url"] ) : '';
	$book_email_data 						= isset( $_POST["book_email_data"] ) ? sanitize_email ( $_POST["book_email_data"] ) : '';
  	$dem_detail_name   						= sanitize_text_field( $dem_book_data ["dem_detail_name"] );
    $dem_detail_email_id 					= sanitize_email( $book_email_data );
    $dem_detail_phone_no 					= sanitize_text_field( $dem_book_data ["dem_detail_phone_no"] );
	$dem_detail_event_id					= sanitize_text_field( $dem_book_data ["dem_detail_event_id"] );
	$dem_detail_event_title					= sanitize_text_field( $dem_book_data ["dem_detail_event_title"] );
	$dem_detail_event_order_date			= sanitize_text_field( $dem_book_data ["dem_detail_event_order_date"] );
	$return									= esc_url( $book_return_url );
	if (  $dem_rt_if_form == 'on' ){
    	$dem_detail_no_of_ticket 			= sanitize_text_field( $dem_book_data ["dem_detail_no_of_ticket"] );
	}else{
		$dem_detail_no_of_ticket  = '-';
	}
	if (  $dem_rt_if_form == 'on' && $divi_dem_price_inquiry_form == 'on'  ){
		$dem_detail_total_ticket_price				= sanitize_text_field( $dem_book_data ["dem_detail_total_ticket_price"] );
		$dem_detail_ticket_currency_symbol_position = sanitize_text_field( $dem_book_data ["dem_detail_ticket_currency_symbol_position"] );
		$dem_detail_ticket_currency_symbol_name		= sanitize_text_field( $dem_book_data ["dem_detail_ticket_currency_symbol_name"] );
		$dem_detail_single_ticket_prices			= sanitize_text_field( $dem_book_data ["dem_detail_single_ticket_prices"] );
	}else{
		$dem_detail_total_ticket_price				= '-';
		$dem_detail_ticket_currency_symbol_position = '-';
		$dem_detail_ticket_currency_symbol_name		= '-';
		$dem_detail_single_ticket_prices			= '-';
	}
	
	$table = $wpdb->prefix.'dem_order';
	if ( ! wp_verify_nonce( sanitize_key( $dem_book_data['dem_ticket_booking_paypal'] ), 'dem_ticket_booking_paypal_nonce' ) ) { 
		$json_result['success'] = 0;
		 wp_die();

	}elseif(($dem_detail_name =='') || ($dem_detail_email_id =='') || ($dem_detail_phone_no =='')){
			$json_result['success'] = 0;
			 wp_die();
	}else{
		
	  	$dem_order_data =  array(
					        'dem_user_name'				=>	$dem_detail_name,
					        'dem_user_email'			=>	$dem_detail_email_id,
					        'dem_user_tel'				=>	$dem_detail_phone_no,
					        'dem_event_id'				=> 	$dem_detail_event_id,
					        'dem_event_title'			=> 	$dem_detail_event_title,
					        'dem_event_currency'		=>	$dem_detail_ticket_currency_symbol_name,
					        'dem_event_cu_pos'			=> 	$dem_detail_ticket_currency_symbol_position,
					        'dem_event_ticket_price'	=> 	$dem_detail_single_ticket_prices,
					        'dem_event_no_of_ticket'	=>	$dem_detail_no_of_ticket,
					        'dem_event_total_price'		=> 	$dem_detail_total_ticket_price,
					        'dem_booking_date'			=>	date_i18n('Y-m-d', strtotime($dem_detail_event_order_date)),
					        'dem_booking_status'		=> '-',
	     				 );
		$wpdb->insert($table,$dem_order_data );
		
		$enable_email_customization 	= dem_email_customization_op_get_value('enable_email_customization','No');
		$cc_email_customization 		= dem_email_customization_op_get_value('cc_email_customization','');
		
		$useremail_content   			= dem_email_customization_op_get_value('useremail','');
		$adminemail_content   			= dem_email_customization_op_get_value('adminemail','');
		$admin_subject_email_customization = dem_email_customization_op_get_value('admin_subject_email_customization',''); 
		$user_subject_email_customization  = dem_email_customization_op_get_value('user_subject_email_customization','');
		
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
			 '{field_email_nooftickets}',
			 '{field_email_price}',
			 '{field_email_totalprice}',
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
			 $dem_detail_no_of_ticket,
			 $dem_detail_single_ticket_prices,
			 $dem_detail_total_ticket_price,
			 date_i18n('Y-m-d', strtotime($dem_detail_event_order_date)),
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
			$headers  = "From: {$admin_from}\n";
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
			
		}else{
		$cc_email_customization 		= dem_email_customization_op_get_value('cc_email_customization','');
		$dem_email_msg1 				= __('Booking/Inquiry Information','dpevent');
		$dem_email_msg2 				= __('Dear Site Administrator, Following booking/inquiry  has been received.','dpevent');
		$dem_email_name 				= __('Name','dpevent');
		$dem_email_email 				= __('Email','dpevent');
		$dem_email_phone 				= __('Phone','dpevent');
		$dem_email_event_name 			= __('Event Name','dpevent');
		$dem_email_event_id 			= __('Event ID','dpevent');
		$dem_email_noft 				= __('No of Tickets','dpevent');
		$dem_email_price 				= __('Price','dpevent');
		$dem_email_tp 					= __('Total Price','dpevent');
		$dem_email_subject 				= __('Booking/Inquiry From .','dpevent');
		
	    $content = "<table width='500' border='1' cellspacing='0' cellpadding='0'><tr><td><table width='100%'><tr>";
		$content .= "<td align='center'>".$dem_email_msg1."</td>";
		$content .=	"</tr></table></td></tr><tr><td>
							<table width='100%' border='0' cellspacing='5' cellpadding='2' align='center'>
								<tr><td colspan='2'> ".$dem_email_msg2." </td></tr>
								<tr><td width='50%'></td></tr>
								<tr><td align='left' valign='top'>".$dem_email_name.": </td><td valign='top'>".$dem_detail_name."</td></tr>
								<tr><td align='left' valign='top'>".$dem_email_email.": </td><td valign='top'>".$dem_detail_email_id."</td></tr>";
								if ( $divi_dem_hide_tel_no_frm != 'on'  ){
								$content .=	"<tr><td align='left' valign='top'>".$dem_email_phone.": </td><td valign='top'>".$dem_detail_phone_no."</td></tr>";
								}
								if (  $dem_rt_if_form == 'on' ){
								$content .=	"<tr><td align='left' valign='top'>".$dem_email_noft.": </td><td valign='top'>".$dem_detail_no_of_ticket."</td></tr>";
								}
								if (  $dem_rt_if_form == 'on' && $divi_dem_price_inquiry_form == 'on'  ){
								$content .=	"<tr><td align='left' valign='top'>".$dem_email_price.": </td><td valign='top'>".$dem_detail_ticket_currency_symbol_name." ".$dem_detail_single_ticket_prices."</td></tr>
								<tr><td align='left' valign='top'>".$dem_email_tp.": </td><td valign='top'>".$dem_detail_total_ticket_price."</td></tr>";
								}
								$content .=	"<tr><td align='left' valign='top'>".$dem_email_event_name.": </td><td valign='top'>".$dem_detail_event_title."</td></tr>
								<tr><td align='left' valign='top'>".$dem_email_event_id.": </td><td valign='top'>".$dem_detail_event_id."</td></tr>
							</table></td></tr><tr>
						<td></td></tr></table>";
		
		$plain_content  = $dem_email_msg2." \n\n";		
		$plain_content .= $dem_email_name.": ".$dem_detail_name."\n";		
		$plain_content .= $dem_email_email.": ".$dem_detail_email_id."\n";
		if ( $divi_dem_hide_tel_no_frm != 'on'  ){
		$plain_content .= $dem_email_phone.": ".$dem_detail_phone_no."\n";
		}
		if (  $dem_rt_if_form == 'on' ){
			$plain_content .= $dem_email_noft.": ".$dem_detail_no_of_ticket."\n";
		}
		if (  $dem_rt_if_form == 'on' && $divi_dem_price_inquiry_form == 'on'  ){
			$plain_content .= $dem_email_price.": ".$dem_detail_ticket_currency_symbol_name." ".$dem_detail_single_ticket_prices."\n";
			$plain_content .= $dem_email_tp.": ".$dem_detail_total_ticket_price."\n";
		}
		$plain_content .= $dem_email_event_name.": ".$dem_detail_event_title."\n";
		$plain_content .= $dem_email_event_id.": ".$dem_detail_event_id."\n\n";
		$enable_admin_email_customization = dem_email_customization_op_get_value('enable_admin_email_customization','No');
		$dpevent_admin_email_id_value 		= get_post_meta( $dem_detail_event_id, 'dpevent_admin_email_id', true );
		if ( $enable_admin_email_customization == 'Yes' && !empty($dpevent_admin_email_id_value ) ){
			 	 $to = $dpevent_admin_email_id_value;
		}else{
			$to = get_option('admin_email');
		}
		$from = $dem_detail_name." <".$dem_detail_email_id.">";
		$subject =  $dem_email_subject." ".$dem_detail_name;
		$txt = $content;
		$plain_txt = $plain_content;
		
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
		$message.= $txt;
		$message.= "\n\n";
		
		# End email
		$message .= "--{$mime_boundary}--\n";;

		$result = mail($to, $subject, $message, $headers);
		
		$dem_email_msg3 				= __('Thank you for contacting us. We will be in contact with you shortly. We have received your following booking/inquiry details:','dpevent');
		$dem_email_msg4 				= __('Event Booking/Inquiry.','dpevent');
		$dem_email_msg5 				= __('Confirmation Mail From Event Booking/Inquiry.','dpevent');
		
		$contentr = "<table width='500' border='1' cellspacing='0' cellpadding='0'><tr><td><table width='100%'><tr>";
		$contentr .= "<td align='center'>".$dem_email_msg1."</td>";
		$contentr .= "</tr></table></td></tr><tr><td>
							<table width='100%' border='0' cellspacing='5' cellpadding='2' align='center'>
								<tr><td colspan='2'> Dear ".$dem_detail_name.",</td></tr>
								<tr><td colspan='2'	>".$dem_email_msg3."</td></tr>
								<tr><td width='50%'></td></tr><tr><td width='50%'></td></tr>
								<tr><td align='left' valign='top'>".$dem_email_name.": </td><td valign='top'>".$dem_detail_name."</td></tr>
								<tr><td align='left' valign='top'>".$dem_email_email.": </td><td valign='top'>".$dem_detail_email_id."</td></tr>";
								if ( $divi_dem_hide_tel_no_frm != 'on'  ){
								$contentr .= "<tr><td align='left' valign='top'>".$dem_email_phone.": </td><td valign='top'>".$dem_detail_phone_no."</td></tr>";
								}
								if (  $dem_rt_if_form == 'on' ){
								$contentr .=	"<tr><td align='left' valign='top'>".$dem_email_noft.": </td><td valign='top'>".$dem_detail_no_of_ticket."</td></tr>";
								}
								if (  $dem_rt_if_form == 'on' && $divi_dem_price_inquiry_form == 'on'  ){
								$contentr .= "<tr><td align='left' valign='top'>".$dem_email_price.": </td><td valign='top'>".$dem_detail_ticket_currency_symbol_name." ".$dem_detail_single_ticket_prices."</td></tr>
								<tr><td align='left' valign='top'>".$dem_email_tp.": </td><td valign='top'>".$dem_detail_total_ticket_price."</td></tr>";
								}
								$contentr .= "<tr><td align='left' valign='top'>".$dem_email_event_id.": </td><td valign='top'>".$dem_detail_event_id."</td></tr>
								<tr><td align='left' valign='top'>".$dem_email_event_name.": </td><td valign='top'>".$dem_detail_event_title."</td></tr>
								</table></td></tr><tr><td></td></tr></table>";
					
		$plain_contentr  = "Dear ".$dem_detail_name.",\n";
		$plain_contentr .= $dem_email_msg3." \n\n";
		
		$plain_contentr .= $dem_email_name.": ".$dem_detail_name."\n";		
		$plain_contentr .= $dem_email_email.": ".$dem_detail_email_id."\n";
		if ( $divi_dem_hide_tel_no_frm != 'on'  ){
		$plain_contentr .= $dem_email_phone.": ".$dem_detail_phone_no."\n";
		}
		if (  $dem_rt_if_form == 'on' ){
			$plain_contentr .= $dem_email_noft.": ".$dem_detail_no_of_ticket."\n";
		}
		if (  $dem_rt_if_form == 'on' && $divi_dem_price_inquiry_form == 'on'  ){
			$plain_contentr .= $dem_email_price.": ".$dem_detail_ticket_currency_symbol_name." ".$dem_detail_single_ticket_prices."\n";
			$plain_contentr .= $dem_email_tp.": ".$dem_detail_total_ticket_price."\n";
		}
		$plain_contentr .= $dem_email_event_id.": ".$dem_detail_event_id."\n";
		$plain_contentr .= $dem_email_event_name.": ".$dem_detail_event_title."\n\n";
		
		$email_to = $dem_detail_email_id;
		$email_from =  $dem_email_msg4." <".get_option('admin_email').">";
		$email_subject =  $dem_email_msg5;
		$email_txt = $contentr;
		$email_plain_txt = $plain_contentr;
		
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
		$dem_booking_lastid = $wpdb->insert_id;
		
	    if ($dem_booking_lastid){
	    	$json_result['success']		= 1;
	    	$json_result['id']			= $dem_booking_lastid;
	    	$json_result['url'] 		= add_query_arg( array(
											'Inquiry' => 'verify',
											'InquiryId' => $dem_booking_lastid,
											'InquiryEventId' => $dem_detail_event_id,
											'InquiryTicketQty' => $dem_detail_no_of_ticket,
											'_wpnonce'=> wp_create_nonce( 'dem_response_verify' )
										),  $return );
	    }else{
		 	$json_result['success']=0;
	    }
	    wp_send_json($json_result);
     	wp_die();
  }
}
add_action('wp_ajax_make_inquiry', 'dem_makeInquiry');
add_action('wp_ajax_nopriv_make_inquiry', 'dem_makeInquiry'); // not really needed