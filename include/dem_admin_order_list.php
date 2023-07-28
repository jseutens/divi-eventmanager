<?php
$dem_themename = dem_theme_name();
$get_form_option =  et_get_option($dem_themename.'_dem_display_form','Booking');
$divi_dem_hide_tel_no_frm  = et_get_option($dem_themename.'_dem_hide_tel_no_frm','off');
$dem_rt_if_form 			= et_get_option($dem_themename.'_dem_rt_if_form','off');
$dem_event_increase_ticket_cancel 	= et_get_option($dem_themename.'_dem_event_increase_ticket_cancel','on');
if ( $get_form_option == 'Booking' ){
	if ( isset( $_GET['dem_order_nonce'] ) && !wp_verify_nonce( sanitize_key( $_GET['dem_order_nonce'] ), 'dem_order_verify_nonce' ) ) {

	die( esc_attr__( 'Security check', 'dpevent' ) ); 
	}else{	
	$Action= isset ( $_GET["Action"] ) ? sanitize_key( wp_unslash($_GET["Action"]) ) : '';
	$eid = isset ( $_GET["Id"] ) ? intval($_GET["Id"]) : '';
	global $wpdb;
	$table_name = $wpdb->prefix . "dem_order"; 	
	if( $Action == "view" && ! empty($eid) )
	{
		global $wpdb;
		$records = $wpdb->get_results( $wpdb->prepare("select * from {$wpdb->prefix}dem_order where dem_booking_id = %d",$eid ));
		if ( ! empty( $records ) )
			{ 
		?>
			<div class="wrap dem_order"> 
				<h2><?php esc_attr_e( $records[0]->dem_user_name.' Order Information','dpevent');?></h2>
				<table class=" wp-list-table widefat fixed display view_click" id="userlist">
					<tbody>				     
					<?php
						foreach ( $records as $user )
							{
								$dem_booking_id			= $user->dem_booking_id;
								$dem_event_id			= $user->dem_event_id;
								$dem_user_name			= $user->dem_user_name;
								$dem_user_email			= $user->dem_user_email;
								$dem_user_tel			= $user->dem_user_tel;
								$dem_event_title		= $user->dem_event_title;
								$dem_event_ticket_price	= $user->dem_event_ticket_price;
								$dem_event_currency		= $user->dem_event_currency;
								$dem_event_cu_pos		= $user->dem_event_cu_pos;
								$dem_event_no_of_ticket	= $user->dem_event_no_of_ticket;
								$dem_booking_date		= $user->dem_booking_date;
								$dem_booking_status		= $user->dem_booking_status;
								$dem_event_total_price	= $user->dem_event_total_price;
					?>	
					<tr>	
						<th><b><label for="dem_booking_id"><?php esc_attr_e( 'Booking ID :', 'dpevent' ); ?></label></b></th>
						<td><?php echo esc_attr( $dem_booking_id ); ?></td>
					</tr>
					<tr>	
						<th><b><label for="dem_event_id"><?php esc_attr_e( 'Event ID :', 'dpevent' ); ?></label></b></th>
						<td><?php echo esc_attr( $dem_event_id ); ?></td>
					</tr>
					<tr>	
						<th><b><label for="dem_user_name"><?php esc_attr_e( 'Name :', 'dpevent' ); ?></label></b></th>
						<td><?php echo esc_attr( $dem_user_name ); ?></td>
					</tr>
					<tr>	
						<th><b><label for="dem_user_email"><?php esc_attr_e( 'Email :', 'dpevent' ); ?></label></b></th>
						<td><?php echo esc_attr( $dem_user_email ); ?></td>
					</tr>
					<?php if ( $divi_dem_hide_tel_no_frm != 'on'  ){ ?>
					<tr>	
						<th><b><label for="dem_user_tel"><?php esc_attr_e( 'Phone No :', 'dpevent' ); ?></label></b></th>
						<td><?php echo esc_attr( $dem_user_tel ); ?></td>
					</tr>
					<?php } ?>
					<tr>	
						<th><b><label for="dem_event_title"><?php esc_attr_e( 'Event Name :', 'dpevent' ); ?></label></b></th>
						<td><?php echo esc_attr( $dem_event_title ); ?></td>
					</tr>
					<tr>	
						<th><b><label for="dem_event_ticket_price"><?php esc_attr_e( 'Ticket Price :', 'dpevent' ); ?></label></b></th>
							<td><?php if($dem_event_cu_pos == 'suffix'){ 
											echo esc_attr($dem_event_ticket_price.' '.$dem_event_currency);
										} else { 
											echo esc_attr($dem_event_currency.' '.$dem_event_ticket_price); 
										} ?>		
							</td>
					</tr>
					<tr>	
						<th><b><label for="dem_event_no_of_ticket"><?php esc_attr_e( 'No. of Tickets :', 'dpevent' ); ?></label></b></th>
						<td><?php echo esc_attr( $dem_event_no_of_ticket ); ?></td>
					</tr>
					<tr>	
						<th><b><label for="dem_event_total_price"><?php esc_attr_e( 'Total price:', 'dpevent' ); ?></label></b></th>
						<td><?php echo esc_attr( $dem_event_total_price ); ?></td>
					</tr>
					<tr>	
						<th><b><label for="dem_booking_date"><?php esc_attr_e( 'Booking Date :', 'dpevent' ); ?></label></b></th>
						<td><?php echo esc_html( date_i18n( 'dS F Y', strtotime(esc_attr( $dem_booking_date ) ) ) ); ?></td>
					</tr>
					<tr>	
						<th><b><label for="dem_booking_status"><?php esc_attr_e( 'Booking Status :', 'dpevent' ); ?></label></b></th>
						<td><?php echo esc_attr( $dem_booking_status ); ?></td>
					</tr>
					<?php 	}?>			
					</tbody>
				</table>
				<a class="dem_orderlist_back" href="admin.php?page=dem_event_order"><?php esc_attr_e( 'Back', 'dpevent' ); ?></a>
			</div>
		<?php }else { esc_attr_e( 'No Records Found !!!', 'dpevent' ); } 
	}elseif( $Action == "status" && ! empty($eid) ){
		$order_detail = $wpdb->get_row( $wpdb->prepare( "SELECT  *  FROM {$wpdb->prefix}dem_order WHERE  dem_booking_id= %d ",$eid), ARRAY_A  ); 
		if ( ! empty($order_detail) ){
			$dpevent_noticket    			 = get_post_meta($order_detail['dem_event_id'],'dpevent_noticket', true );
			$buy_ticket 					 = $order_detail['dem_event_no_of_ticket'];
			$remaining_ticket				 = $dpevent_noticket - $buy_ticket;
			update_post_meta( $order_detail['dem_event_id'], 'dpevent_noticket', esc_attr( $remaining_ticket ) );
			$wpdb->update($table_name, array('dem_booking_status'=>'Completed' ), array('dem_booking_id' =>$eid));
		}
		?>
		<script>window.location.href = 'admin.php?page=dem_event_order';</script>
		<?php
	}elseif( $Action == "email" && ! empty($eid) ){
		$order_detail = $wpdb->get_row( $wpdb->prepare( "SELECT  *  FROM {$wpdb->prefix}dem_order WHERE  dem_booking_id= %d ",$eid), ARRAY_A  ); 
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
			
		}else{
		$cc_email_customization 		= dem_email_customization_op_get_value('cc_email_customization','');
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
									<tr><td align='left' valign='top'>".$dem_email_status.": </td><td valign='top'>".$dem_booking_status."</td></tr>
									<tr><td align='left' valign='top'>".$dem_email_bookingdate.": </td><td valign='top'>".$dem_booking_date."</td></tr>
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
			$plain_content .= $dem_email_status.": ".$dem_booking_status."\n";
			$plain_content .= $dem_email_bookingdate.": ".$dem_booking_date."\n\n";
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
									<tr><td align='left' valign='top'>".$dem_email_status.": </td><td valign='top'>".$dem_booking_status."</td></tr>
									<tr><td align='left' valign='top'>".$dem_email_bookingdate.": </td><td valign='top'>".$dem_booking_date."</td></tr>
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
			$plain_contentr .= $dem_email_status.": ".$dem_booking_status."\n";
			$plain_contentr .= $dem_email_bookingdate.": ".$dem_booking_date."\n\n";
			
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
		}
		?>
		<script>window.location.href = 'admin.php?page=dem_event_order';</script>
		<?php
	}elseif( $Action == "del" && ! empty($eid) ){
		if ( $dem_event_increase_ticket_cancel == 'on' ){
			$order_detail = $wpdb->get_row( $wpdb->prepare( "SELECT  *  FROM {$wpdb->prefix}dem_order WHERE  dem_booking_id= %d ",$eid), ARRAY_A  ); 
			if ( ! empty($order_detail) ){
				if ( $order_detail['dem_booking_status'] == 'Completed' || $order_detail['dem_booking_status'] == 'completed' ){
					$dpevent_noticket    			 = get_post_meta($order_detail['dem_event_id'],'dpevent_noticket', true );
					$buy_ticket 					 = $order_detail['dem_event_no_of_ticket'];
					$remaining_ticket				 = $dpevent_noticket + $buy_ticket;
					update_post_meta( $order_detail['dem_event_id'], 'dpevent_noticket', esc_attr( $remaining_ticket ) );
				}
			}
		}	
		
		$wpdb->delete( $table_name, array( 'dem_booking_id' => $eid ) );
		echo "<div style='clear:both;'></div><div class='updated' id='message'><p><strong>".esc_attr__('Record Deleted.','dpevent')."</strong>.</p></div>";
		?>
		<script>window.location.href = 'admin.php?page=dem_event_order';</script>
		<?php
	
	}else{
		$dem_sql_match = '-';
		$records = $wpdb->get_results( $wpdb->prepare( "select * from {$wpdb->prefix}dem_order  WHERE dem_booking_status != %s order by dem_booking_id ASC" ,$dem_sql_match));
		?>
		
		<div class="wrap dem_order" > 
			<h2><?php esc_attr_e('Order Listing','dpevent');?></h2>
			<div id="dem_order_event_filter"></div>
			<table class="wp-list-table widefat fixed display" id="eventlist" style="width:100%">
				<thead>
					<tr>
						<th ><b><?php esc_attr_e('Booking ID','dpevent');?></b></th>
						<th ><b><?php esc_attr_e('Event ID','dpevent');?></b></th>
						<th ><b><?php esc_attr_e('User Name','dpevent');?></b></th>
						<th ><b><?php esc_attr_e('Email','dpevent');?></b></th>
						<?php if ( $divi_dem_hide_tel_no_frm != 'on'  ){ ?>
						<th ><b><?php esc_attr_e('Phone No','dpevent');?></b></th>
						<?php } ?>
						<th ><b><?php esc_attr_e('Event Name','dpevent');?></b></th>
						<th ><b><?php esc_attr_e('Price','dpevent');?></b></th>
						<th ><b><?php esc_attr_e('No. of Tickets','dpevent');?></b></th>
						<th ><b><?php esc_attr_e('Total Price','dpevent');?></b></th>
						<th ><b><?php esc_attr_e('Booking Date','dpevent');?></b></th>
						<th ><b><?php esc_attr_e('Booking Status','dpevent');?></b></th>
						<th ><b><?php esc_attr_e('Action','dpevent');?></b></th>
						
					</tr>
				</thead>
				<tbody>				     
					<?php
									
						if ( ! empty( $records ) )
						{ 
							foreach ( $records as $user )
							{
								$dem_booking_id			= $user->dem_booking_id;
								$dem_event_id			= $user->dem_event_id;
								$dem_user_name			= $user->dem_user_name;
								$dem_user_email			= $user->dem_user_email;
								$dem_user_tel			= $user->dem_user_tel;
								$dem_event_title		= $user->dem_event_title;
								$dem_event_ticket_price	= $user->dem_event_ticket_price;
								$dem_event_currency		= $user->dem_event_currency;
								$dem_event_cu_pos		= $user->dem_event_cu_pos;
								$dem_event_no_of_ticket	= $user->dem_event_no_of_ticket;
								$dem_event_total_price  = $dem_event_ticket_price * $dem_event_no_of_ticket;
								$dem_booking_date		= $user->dem_booking_date;
								$dem_booking_status		= $user->dem_booking_status;
								
					?>
								<tr>
									<td class=""><?php echo esc_attr( $dem_booking_id ); ?></td>
									<td class=""><?php echo esc_attr( $dem_event_id ); ?></td>
									<td class=""><?php echo esc_attr( $dem_user_name ); ?></td>
									<td class=""><?php echo esc_attr( $dem_user_email ); ?></td> 
									<?php if ( $divi_dem_hide_tel_no_frm != 'on'  ){ ?>
									<td class=""><?php echo esc_attr( $dem_user_tel ); ?></td> 
									<?php } ?>
									<td class=""><?php echo esc_attr( $dem_event_title ); ?></td> 
									<td class=""><?php if($dem_event_cu_pos == 'suffix'){ 
															echo esc_attr( $dem_event_ticket_price.' '.$dem_event_currency );
														} else { 
															echo esc_attr( $dem_event_currency.' '.$dem_event_ticket_price ); 
														} ?>
									</td> 
									<td class=""><?php echo esc_attr( $dem_event_no_of_ticket ); ?></td>
									<td class="">
													<?php if($dem_event_cu_pos == 'suffix'){ 
															echo esc_attr( $dem_event_total_price.' '.$dem_event_currency );
														} else { 
															echo esc_attr( $dem_event_currency.' '.$dem_event_total_price ); 
													} ?>
									</td>
									<td class=""><?php echo esc_html( date_i18n('dS F Y', strtotime(esc_attr( $dem_booking_date ) )) ) ; ?></td>
									<td class=""><?php echo esc_attr( $dem_booking_status ); ?></td> 
									<td class="quote-header-action">								
										<a  onclick="javascript:return confirm('<?php esc_attr_e('Are you sure you want to delete this record?','dpevent');?>')" href="<?php print esc_url ( wp_nonce_url(admin_url('admin.php?page=dem_event_order&Action=del&Id='.esc_attr( $dem_booking_id )), 'dem_order_verify_nonce', 'dem_order_nonce'));?>" >
											<img width= "20" src="<?php echo esc_url(  DEM_PLUGIN_URL.'assets/images/delete.png');?>" title="<?php esc_attr_e('Delete','dpevent');?>" alt="<?php esc_attr_e('Delete','dpevent');?>" />
										</a> &nbsp;
										<a href="<?php print esc_url ( wp_nonce_url(admin_url('admin.php?page=dem_event_order&Action=view&Id='.esc_attr( $dem_booking_id )), 'dem_order_verify_nonce', 'dem_order_nonce'));?>">
											<img width="20" src="<?php echo esc_url( DEM_PLUGIN_URL.'assets/images/view.jpg');?>" title="<?php esc_attr_e('View','dpevent');?>" alt="<?php esc_attr_e('View','dpevent');?>" />
										</a>
										<?php if ($dem_booking_status == 'Pending' ){ ?>
										<a href="<?php print esc_url (  wp_nonce_url(admin_url('admin.php?page=dem_event_order&Action=status&Id='.esc_attr( $dem_booking_id )), 'dem_order_verify_nonce', 'dem_order_nonce'));?>">
											<img width= "20" src="<?php echo esc_url( DEM_PLUGIN_URL.'assets/images/approved.png');?>" title="<?php esc_attr_e('Status','dpevent');?>" alt="<?php esc_attr_e('Status','dpevent');?>" />
										</a>
									<?php } ?><br/>
									<a href="<?php print esc_url ( wp_nonce_url(admin_url('admin.php?page=dem_event_order&Action=email&Id='.esc_attr( $dem_booking_id )), 'dem_order_verify_nonce', 'dem_order_nonce'));?>"><?php esc_attr_e('Send Email','dpevent');?></a>
									</td>                  
								</tr>
					<?php 						
							}
						} 
						else
						{
								echo "<tr><td colspan='11'>".esc_attr__('No Records Found !!! ','dpevent')."</td></tr>";
						} 
					?>
					</tbody>
					<tfoot>
					<tr>
						<th ><b><?php esc_attr_e('Booking ID','dpevent');?></b></th>
						<th ><b><?php esc_attr_e('Event ID','dpevent');?></b></th>
						<th ><b><?php esc_attr_e('User Name','dpevent');?></b></th>
						<th ><b><?php esc_attr_e('Email','dpevent');?></b></th>
						<?php if ( $divi_dem_hide_tel_no_frm != 'on'  ){ ?>
						<th ><b><?php esc_attr_e('Phone No','dpevent');?></b></th>
						<?php } ?>
						<th ><b><?php esc_attr_e('Event Name','dpevent');?></b></th>
						<th ><b><?php esc_attr_e('Price','dpevent');?></b></th>
						<th ><b><?php esc_attr_e('No. of Tickets','dpevent');?></b></th>
						<th ><b><?php esc_attr_e('Total Price','dpevent');?></b></th>
						<th ><b><?php esc_attr_e('Booking Date','dpevent');?></b></th>
						<th ><b><?php esc_attr_e('Booking Status','dpevent');?></b></th>
						<th ><b><?php esc_attr_e('Action','dpevent');?></b></th>
					</tr>					
				  </tfoot>
			</table>
		</div>
	<?php } 
	}	
}
if ( $get_form_option == 'Inquiry' ){
if ( isset( $_GET['dem_order_nonce'] ) && !wp_verify_nonce( sanitize_key( $_GET['dem_order_nonce'] ), 'dem_order_verify_nonce' ) ) {
	die( esc_attr__( 'Security check', 'dpevent' ) ); 
}else{
$dem_rt_if_form 					= et_get_option($dem_themename.'_dem_rt_if_form','off');
$divi_dem_price_inquiry_form		= et_get_option($dem_themename.'_dem_price_inquiry_form','off');
$Action= isset ( $_GET["Action"] ) ?  sanitize_key( wp_unslash($_GET["Action"]) ) : '';
$eid = isset ( $_GET["Id"] ) ? intval($_GET["Id"]) : '';
global $wpdb;
$table_name = $wpdb->prefix . "dem_order"; 
if( $Action == "view" && ! empty($eid) )
{
	$records = $wpdb->get_results( $wpdb->prepare("select * from {$wpdb->prefix}dem_order where dem_booking_id = %d",$eid ));
	if ( ! empty( $records ) )
	{ 
?>
	<div class="wrap dem_order"> 
		<h2><?php esc_attr_e( $records[0]->dem_user_name.' Inquiry Information','dpevent');?></h2>
		<table class=" wp-list-table widefat fixed display view_click" id="userlist">
			<tbody>				     
			<?php
				
					foreach ( $records as $user )
					{
						$dem_booking_id			= $user->dem_booking_id;
						$dem_event_id			= $user->dem_event_id;
						$dem_user_name			= $user->dem_user_name;
						$dem_user_email			= $user->dem_user_email;
						$dem_user_tel			= $user->dem_user_tel;
						$dem_event_title		= $user->dem_event_title;
						$dem_booking_date		= $user->dem_booking_date;
						$dem_event_no_of_ticket	= $user->dem_event_no_of_ticket;
						$dem_event_ticket_price	= $user->dem_event_ticket_price;
						$dem_event_currency		= $user->dem_event_currency;
						$dem_event_cu_pos		= $user->dem_event_cu_pos;
						$dem_event_total_price	= $user->dem_event_total_price;
								
			?>	
			<tr>	
				<th><b><label for="dem_booking_id"><?php esc_attr_e( 'Inquiry ID :', 'dpevent' ); ?></label></b></th>
				<td><?php echo esc_attr( $dem_booking_id ); ?></td>
			</tr>
			<tr>	
				<th><b><label for="dem_booking_id"><?php esc_attr_e( 'Event ID :', 'dpevent' ); ?></label></b></th>
				<td><?php echo esc_attr( $dem_event_id ); ?></td>
			</tr>
			<tr>	
				<th><b><label for="dem_user_name"><?php esc_attr_e( 'Name :', 'dpevent' ); ?></label></b></th>
				<td><?php echo esc_attr( $dem_user_name ); ?></td>
			</tr>
			<tr>	
				<th><b><label for="dem_user_email"><?php esc_attr_e( 'Email :', 'dpevent' ); ?></label></b></th>
				<td><?php echo esc_attr( $dem_user_email ); ?></td>
			</tr>
			<?php if ( $divi_dem_hide_tel_no_frm != 'on'  ){ ?>
			<tr>	
				<th><b><label for="dem_user_tel"><?php esc_attr_e( 'Phone No :', 'dpevent' ); ?></label></b></th>
				<td><?php echo esc_attr( $dem_user_tel ); ?></td>
			</tr>
			<?php } ?>
			<tr>	
				<th><b><label for="dem_event_title"><?php esc_attr_e( 'Event Name :', 'dpevent' ); ?></label></b></th>
				<td><?php echo esc_attr( $dem_event_title ); ?></td>
			</tr>
			<?php if ( $dem_rt_if_form == 'on' ){ ?>
			<tr>	
						<th><b><label for="dem_event_no_of_ticket"><?php esc_attr_e( 'No. of Tickets :', 'dpevent' ); ?></label></b></th>
						<td><?php echo esc_attr( $dem_event_no_of_ticket ); ?></td>
			</tr>
			<?php } if (  $dem_rt_if_form == 'on' && $divi_dem_price_inquiry_form == 'on'  ){?>
					<tr>	
						<th><b><label for="dem_event_ticket_price"><?php esc_attr_e( 'Ticket Price :', 'dpevent' ); ?></label></b></th>
							<td><?php if($dem_event_cu_pos == 'suffix'){ 
											echo esc_attr($dem_event_ticket_price.' '.$dem_event_currency);
										} else { 
											echo esc_attr($dem_event_currency.' '.$dem_event_ticket_price); 
										} ?>		
							</td>
					</tr>
					<tr>	
						<th><b><label for="dem_event_total_price"><?php esc_attr_e( 'Total price:', 'dpevent' ); ?></label></b></th>
						<td><?php echo esc_attr( $dem_event_total_price ); ?></td>
					</tr>
			<?php } ?>			
			<tr>	
				<th><b><label for="dem_booking_date"><?php esc_attr_e( 'Inquiry Date :', 'dpevent' ); ?></label></b></th>
				<td><?php echo esc_html( date_i18n('dS F Y', strtotime(esc_attr( $dem_booking_date ))) ) ; ?></td>
			</tr>
				<?php 						
					}
			?>			
			</tbody>
		</table>
	    <a class="dem_orderlist_back" href="<?php echo esc_url( admin_url( 'admin.php?page=dem_event_order'));?>"><?php esc_attr_e( 'Back', 'dpevent' ); ?></a>
	</div>
<?php
	}else{
		esc_attr_e ('No Records Found !!! ','dpevent');
	} 
}elseif( $Action == "del" && ! empty($eid) ){
	if ( $dem_event_increase_ticket_cancel == 'on' ){
		$order_detail = $wpdb->get_row( $wpdb->prepare( "SELECT  *  FROM {$wpdb->prefix}dem_order WHERE  dem_booking_id= %d ",$eid), ARRAY_A  ); 
		if ( ! empty($order_detail) ){
			$dpevent_noticket    			 = get_post_meta($order_detail['dem_event_id'],'dpevent_noticket', true );
			$buy_ticket 					 = $order_detail['dem_event_no_of_ticket'];
			$remaining_ticket				 = $dpevent_noticket + $buy_ticket;
			update_post_meta( $order_detail['dem_event_id'], 'dpevent_noticket', esc_attr( $remaining_ticket ) );
		}
	}	
	$wpdb->delete( $table_name, array( 'dem_booking_id' => $eid ) );
	?>
	<div style='clear:both;'></div><div class='updated' id='message'><p><strong><?php esc_attr_e('Record Deleted.','dpevent');?></strong>.</p></div>
	<script>window.location.href = 'admin.php?page=dem_event_order';</script>
	<?php

}else{
	$dem_sql_match = '-';
	$records = $wpdb->get_results( $wpdb->prepare( "select * from {$wpdb->prefix}dem_order  WHERE dem_booking_status = %s order by dem_booking_id ASC" ,$dem_sql_match));
	
?>
	<div class="wrap dem_order"> 
		<h2><?php esc_attr_e('Inquiry Listing','dpevent');?></h2>
		<div id="dem_order_event_filter"></div>
		<table class="wp-list-table widefat fixed display" id="eventlist" style="width:100%">
			<thead>
				<tr>
					<th ><b><?php esc_attr_e('Inquiry ID','dpevent');?></b></th>
					<th ><b><?php esc_attr_e('Event ID','dpevent');?></b></th>
					<th ><b><?php esc_attr_e('User Name','dpevent');?></b></th>
					<th ><b><?php esc_attr_e('Email','dpevent');?></b></th>
					<?php if ( $divi_dem_hide_tel_no_frm != 'on'  ){ ?>
					<th ><b><?php esc_attr_e('Phone No','dpevent');?></b></th>
					<?php } ?>
					<?php if ( $dem_rt_if_form == 'on' ){ ?>
					<th ><b><?php esc_attr_e('No of Tickets','dpevent');?></b></th>
					<?php } if (  $dem_rt_if_form == 'on' && $divi_dem_price_inquiry_form == 'on'  ){?>
						<th ><b><?php esc_attr_e('Price','dpevent');?></b></th>
						<th ><b><?php esc_attr_e('Total Price','dpevent');?></b></th>
					<?php } ?>
					<th ><b><?php esc_attr_e('Event Name','dpevent');?></b></th>					
					<th ><b><?php esc_attr_e('Inquiry Date','dpevent');?></b></th>
					<th ><b><?php esc_attr_e('Action','dpevent');?></b></th>
				</tr>
			</thead>
			<tbody>				     
				<?php
								
					if ( ! empty( $records ) )
					{ 
						foreach ( $records as $user )
						{
							$dem_booking_id			= $user->dem_booking_id;
							$dem_event_id			= $user->dem_event_id;
							$dem_user_name			= $user->dem_user_name;
							$dem_user_email			= $user->dem_user_email;
							$dem_user_tel			= $user->dem_user_tel;
							$dem_event_title		= $user->dem_event_title;
							$dem_booking_date		= $user->dem_booking_date;
							$dem_event_no_of_ticket	= $user->dem_event_no_of_ticket;
							$dem_event_ticket_price	= $user->dem_event_ticket_price;
							$dem_event_currency		= $user->dem_event_currency;
							$dem_event_cu_pos		= $user->dem_event_cu_pos;
							if ( $dem_event_ticket_price != '-' ){
								$dem_event_total_price  = $dem_event_ticket_price * $dem_event_no_of_ticket;
							}else{
								$dem_event_total_price  = '-';
							}
							
				?>
							<tr>
								<td class=""><?php echo esc_attr( $dem_booking_id ); ?></td>
								<td class=""><?php echo esc_attr( $dem_event_id ); ?></td>
								<td class=""><?php echo esc_attr( $dem_user_name ); ?></td>
								<td class=""><?php echo esc_attr( $dem_user_email ); ?></td> 
								<?php if ( $divi_dem_hide_tel_no_frm != 'on'  ){ ?>
								<td class=""><?php echo esc_attr( $dem_user_tel ); ?></td> 
								<?php } ?>
								<?php if ( $dem_rt_if_form == 'on' ){ ?>
								<td><?php echo esc_attr( $dem_event_no_of_ticket ); ?></td>
								<?php } if (  $dem_rt_if_form == 'on' && $divi_dem_price_inquiry_form == 'on'  ){?>
									<td class=""><?php if($dem_event_cu_pos == 'suffix'){ 
															echo esc_attr( $dem_event_ticket_price.' '.$dem_event_currency );
														} else { 
															echo esc_attr( $dem_event_currency.' '.$dem_event_ticket_price ); 
														} ?>
									</td> 
									<td class="">
													<?php if($dem_event_cu_pos == 'suffix'){ 
															echo esc_attr( $dem_event_total_price.' '.$dem_event_currency );
														} else { 
															echo esc_attr( $dem_event_currency.' '.$dem_event_total_price ); 
													} ?>
									</td>
								<?php } ?>	
								<td class=""><?php echo esc_attr( $dem_event_title ); ?></td> 
								<td class=""><?php echo esc_html( date_i18n('dS F Y', strtotime(esc_attr( $dem_booking_date ))) ) ; ?></td>
								<td class="quote-header-action">								
									<a  onclick="javascript:return confirm('Are you sure you want to delete this record?')" href="<?php print esc_url (  wp_nonce_url( admin_url( 'admin.php?page=dem_event_order&Action=del&Id='.esc_attr( $dem_booking_id ) ), 'dem_order_verify_nonce', 'dem_order_nonce'));?>">
										<img width="20" src="<?php echo esc_url( DEM_PLUGIN_URL.'assets/images/delete.png');?>" title="<?php esc_attr_e('Delete','dpevent');?>" alt="<?php esc_attr_e('Delete','dpevent');?>" />
									</a> &nbsp;
									<a href="<?php print esc_url (  wp_nonce_url( admin_url( 'admin.php?page=dem_event_order&Action=view&Id='.esc_attr( $dem_booking_id ) ), 'dem_order_verify_nonce', 'dem_order_nonce'));?>">
										<img width= "20" src="<?php echo esc_url( DEM_PLUGIN_URL.'assets/images/view.jpg');?>" title="<?php esc_attr_e('View','dpevent');?>" alt="<?php esc_attr_e('View','dpevent');?>" />
									</a>
								</td>                  
							</tr>
				<?php 						
						}
					} 
					else
					{
						?><tr><td><?php esc_attr_e('No Records Found !!! ','dpevent');?>
						</td></tr>
				<?php } 
				?>
				</tbody>
				<tfoot>
				<tr>
					<th ><b><?php esc_attr_e('Inquiry ID','dpevent');?></b></th>
					<th ><b><?php esc_attr_e('Event ID','dpevent');?></b></th>
					<th ><b><?php esc_attr_e('User Name','dpevent');?></b></th>
					<th ><b><?php esc_attr_e('Email','dpevent');?></b></th>
					<?php if ( $divi_dem_hide_tel_no_frm != 'on'  ){ ?>
					<th ><b><?php esc_attr_e('Phone No','dpevent');?></b></th>
					<?php } ?>
					<?php if ( $dem_rt_if_form == 'on' ){ ?>
					<th ><b><?php esc_attr_e('No of Tickets','dpevent');?></b></th>
					<?php } if (  $dem_rt_if_form == 'on' && $divi_dem_price_inquiry_form == 'on'  ){?>
						<th ><b><?php esc_attr_e('Price','dpevent');?></b></th>
						<th ><b><?php esc_attr_e('Total Price','dpevent');?></b></th>
					<?php } ?>
					<th ><b><?php esc_attr_e('Event Name','dpevent');?></b></th>
					<th ><b><?php esc_attr_e('Inquiry Date','dpevent');?></b></th>
					<th ><b><?php esc_attr_e('Action','dpevent');?></b></th>
				</tr>					
				</tfoot>
		</table>
	</div>
<?php }
} 
} ?>