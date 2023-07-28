<?php
add_action( 'admin_menu', 'dem_setting_admin_menu');
function dem_setting_admin_menu() {
		add_submenu_page( 'edit.php?post_type=dp_events', __( 'Event Settings', 'dpevent' ), __( 'Event Settings', 'dpevent' ), 'manage_options', 'dp_events',  'dem_tab'  );
}
function dem_tab(){
	if(is_admin()){
		 wp_enqueue_style( 'wp-color-picker' );
		 wp_enqueue_script( 'dp_event_color_js', DEM_PLUGIN_URL .'assets/js/dp_event_color.min.js', array( 'jquery', 'wp-color-picker' ), '', true  );
	 }
$is_settings_updated = false;
$nonce   = "dem_setting_admin_menu_nonce"; 
if ( isset( $_POST[ $nonce ] ) ) {
	$is_settings_updated         = true;
	$is_settings_updated_success = false;
	// Verify nonce and user permission
	if ( wp_verify_nonce( sanitize_text_field( wp_unslash($_POST[$nonce]) ), $nonce ) && current_user_can( 'switch_themes' ) ) {
		$active_tab_new = isset( $_GET[ 'tab' ] ) ? sanitize_text_field( wp_unslash($_GET['tab']) ) : 'general_view_op';
		$dem_post_array = $_POST;
		if( $active_tab_new == 'general_view_op' ) {
				$general_view_op_form = maybe_serialize($dem_post_array);
				update_option( 'general_view_op', $general_view_op_form );
		}
		
		if( $active_tab_new == 'detail_view_op' ) {
				$detail_view_op_form = maybe_serialize($dem_post_array);
				update_option( 'detail_view_op', $detail_view_op_form );
		}
		if( $active_tab_new == 'email_customization' ) {
				$email_view_op_form = maybe_serialize($dem_post_array);
				update_option( 'email_view_op', $email_view_op_form );
		}
			$is_settings_updated_message = __( 'Options data has been updated.','dpevent' );
			$is_settings_updated_success = true;
	} else {
			$is_settings_updated_message = __( 'Error authenticating request. Please try again.','dpevent' );
	}
}
?>
<div class="wrap">
		<?php if ( $is_settings_updated ) { ?>
			<div id="setting-error-settings_updated" class="updated settings-error notice is-dismissible <?php echo $is_settings_updated_success ? '' : 'error' ?>" style="margin: 0 0 25px 0;">
				<p>
					<strong><?php echo esc_html( $is_settings_updated_message ); ?></strong>
				</p>
				<button type="button" class="notice-dismiss">
					<span class="screen-reader-text"><?php esc_attr_e( 'Dismiss this notice.' ,'dpevent'); ?></span>
				</button>
			</div>
		<?php }
			$active_tab = isset( $_GET[ 'tab' ] ) ? sanitize_text_field( wp_unslash($_GET['tab']) ) : 'general_view_op';
		?>
		<h2 class="nav-tab-wrapper">
			<a href="?post_type=dp_events&page=dp_events&tab=general_view_op" class="nav-tab <?php echo $active_tab == 'general_view_op' ? 'nav-tab-active' : ''; ?>"><?php esc_attr_e( 'General Settings', 'dpevent' ); ?></a>
			<a href="?post_type=dp_events&page=dp_events&tab=detail_view_op" class="nav-tab <?php echo $active_tab == 'detail_view_op' ? 'nav-tab-active' : ''; ?>"><?php esc_attr_e( 'Style 1 & 2 and Custom Detail Page View Color Settings', 'dpevent' ); ?></a>
			<a href="?post_type=dp_events&page=dp_events&tab=email_customization" class="nav-tab <?php echo $active_tab == 'email_customization' ? 'nav-tab-active' : ''; ?>"><?php esc_attr_e( 'Email Customization Settings', 'dpevent' ); ?></a>
		</h2>
            <form action="" method="POST" class="dem-form">
			<?php if( $active_tab == 'general_view_op' ) {?>
			
			<table class="form-table">
				<h2><?php esc_attr_e('Event Detail Page Settings', 'dpevent'); ?></h2>
				<hr>
				<tr>
                    <th><?php esc_attr_e('Display Social Icon Section', 'dpevent'); ?></th>
                    <td><?php $divi_dem_display_social_icon_section = dem_general_view_op_get_value('divi_dem_display_social_icon_section','Yes');?>
					 <select name="divi_dem_display_social_icon_section">
							 <option value="Yes" <?php selected( esc_attr( $divi_dem_display_social_icon_section ),"Yes" ); ?>>Yes</option>
							<option value="No" <?php selected( esc_attr( $divi_dem_display_social_icon_section ), "No" ); ?>>No</option>
					 </select>
					 </td>
                </tr>
				<tr>
                    <th><?php esc_attr_e('Display Event Gallery Section', 'dpevent'); ?></th>
                    <td><?php $divi_dem_display_event_gallery_section = dem_general_view_op_get_value('divi_dem_display_event_gallery_section','Yes');?>
					 <select name="divi_dem_display_event_gallery_section">
							 <option value="Yes" <?php selected( esc_attr( $divi_dem_display_event_gallery_section ),"Yes" ); ?>>Yes</option>
							<option value="No" <?php selected( esc_attr( $divi_dem_display_event_gallery_section ), "No" ); ?>>No</option>
					 </select>
					 </td>
                </tr>
				<tr>
                    <th><?php esc_attr_e('Display Event Location Section', 'dpevent'); ?></th>
                    <td><?php $divi_dem_display_event_location_section = dem_general_view_op_get_value('divi_dem_display_event_location_section','Yes'); ?>
					 <select name="divi_dem_display_event_location_section">
							 <option value="Yes" <?php selected( esc_attr( $divi_dem_display_event_location_section ),"Yes" ); ?>>Yes</option>
							<option value="No" <?php selected( esc_attr( $divi_dem_display_event_location_section ), "No" ); ?>>No</option>
					 </select>
					 </td>
                </tr>
				<tr>
                    <th><?php esc_attr_e('Display Image Section', 'dpevent'); ?></th>
                    <td><?php $divi_dem_display_event_image_section = dem_general_view_op_get_value('divi_dem_display_event_image_section','Yes'); ?>
					 <select name="divi_dem_display_event_image_section">
							 <option value="Yes" <?php selected( esc_attr( $divi_dem_display_event_image_section ),"Yes" ); ?>>Yes</option>
							<option value="No" <?php selected( esc_attr( $divi_dem_display_event_image_section ), "No" ); ?>>No</option>
					 </select>
					 </td>
                </tr>
				<tr>
                    <th><?php esc_attr_e('Display Form Label', 'dpevent'); ?></th>
                    <td><?php $divi_dem_display_form_label = dem_general_view_op_get_value('divi_dem_display_form_label','No'); ?>
					 <select name="divi_dem_display_form_label">
							 <option value="No" <?php selected( esc_attr( $divi_dem_display_form_label ), "No" ); ?>>No</option>	
							 <option value="Yes" <?php selected( esc_attr( $divi_dem_display_form_label ),"Yes" ); ?>>Yes</option>
					 </select>
					 </td>
                </tr>
				</table>
		<?php }   if( $active_tab == 'detail_view_op' ) {
				?>
		<table class="form-table">
				<h2><?php esc_attr_e('Style 1 Color Settings', 'dpevent'); ?></h2>
			    <hr>
				<tr>
                    <th><?php esc_attr_e('Enable Style 1', 'dpevent'); ?></th>
                    <td><?php $divi_detailpage_style1_enable_style = dem_detail_view_op_get_value('divi_detailpage_style1_enable_style','No');?>
					 <select name="divi_detailpage_style1_enable_style">
					  <option value="Yes" <?php selected( esc_attr( $divi_detailpage_style1_enable_style ),"Yes" ); ?>>Yes</option>
							<option value="No" <?php selected( esc_attr( $divi_detailpage_style1_enable_style ), "No" ); ?>>No</option>
					 </select>
					 </td>
                </tr>				
				<tr>
                    <th><?php esc_attr_e('Style 1 Header Background Color', 'dpevent'); ?></th>
                    <td><?php  $divi_detailpage_style1_bk_color = dem_detail_view_op_get_value('divi_detailpage_style1_bk_color','');?>
						<input type="text" name="divi_detailpage_style1_bk_color" value="<?php echo esc_attr( $divi_detailpage_style1_bk_color );?>" class="dem-color-picker"/>
					 </td>
                </tr>
				<tr>
                    <th><?php esc_attr_e('Style 1 Header Text Color', 'dpevent'); ?></th>
                    <td><?php  $divi_detailpage_style1_txt_color = dem_detail_view_op_get_value('divi_detailpage_style1_txt_color','');?>
						<input type="text" name="divi_detailpage_style1_txt_color" value="<?php echo esc_attr( $divi_detailpage_style1_txt_color );?>" class="dem-color-picker"/>
					 </td>
                </tr>
				<tr>
                    <th><?php esc_attr_e('Style 1 Event Information & Event Organizer & Form Section Background Color', 'dpevent'); ?></th>
                    <td><?php $divi_detailpage_style1_event_org_color = dem_detail_view_op_get_value('divi_detailpage_style1_event_org_color','');  ?>
						<input type="text" name="divi_detailpage_style1_event_org_color" value="<?php echo esc_attr( $divi_detailpage_style1_event_org_color );?>" class="dem-color-picker"/>
					 </td>
                </tr>
				<tr>
                    <th><?php esc_attr_e('Style 1 Section Heading Color', 'dpevent'); ?></th>
                    <td><?php $divi_detailpage_style1_event_section_heading_color = dem_detail_view_op_get_value('divi_detailpage_style1_event_section_heading_color','');  ?>
						<input type="text" name="divi_detailpage_style1_event_section_heading_color" value="<?php echo esc_attr( $divi_detailpage_style1_event_section_heading_color );?>" class="dem-color-picker"/>
					 </td>
                </tr>
				<tr>
                    <th><?php esc_attr_e('Style 1 All Section Icon Color', 'dpevent'); ?></th>
                    <td><?php $divi_detailpage_style1_event_section_icon_color = dem_detail_view_op_get_value('divi_detailpage_style1_event_section_icon_color','');?>
						<input type="text" name="divi_detailpage_style1_event_section_icon_color" value="<?php echo esc_attr( $divi_detailpage_style1_event_section_icon_color );?>" class="dem-color-picker"/>
					 </td>
                </tr>
				<tr>
                    <th><?php esc_attr_e('Style 1 Description Color', 'dpevent'); ?></th>
                    <td><?php $divi_detailpage_style1_event_section_desc_color = dem_detail_view_op_get_value('divi_detailpage_style1_event_section_desc_color','');  ?>
						<input type="text" name="divi_detailpage_style1_event_section_desc_color" value="<?php echo esc_attr( $divi_detailpage_style1_event_section_desc_color );?>" class="dem-color-picker"/>
					 </td>
                </tr>
				<tr>
                    <th><?php esc_attr_e('Style 1 All Section Information Color', 'dpevent'); ?></th>
                    <td><?php $divi_detailpage_style1_event_section_information_color = dem_detail_view_op_get_value('divi_detailpage_style1_event_section_information_color','');  ?>
						<input type="text" name="divi_detailpage_style1_event_section_information_color" value="<?php echo esc_attr( $divi_detailpage_style1_event_section_information_color );?>" class="dem-color-picker"/>
					 </td>
                </tr>
				<tr>
                    <th><?php esc_attr_e('Style 1 Share Icon Color', 'dpevent'); ?></th>
                    <td><?php $divi_detailpage_style1_event_shareicon_color = dem_detail_view_op_get_value('divi_detailpage_style1_event_shareicon_color','');  ?>
						<input type="text" name="divi_detailpage_style1_event_shareicon_color" value="<?php echo esc_attr( $divi_detailpage_style1_event_shareicon_color );?>" class="dem-color-picker"/>
					 </td>
                </tr>
				<tr>
                    <th><?php esc_attr_e('Style 1 Share Icon Hover Color', 'dpevent'); ?></th>
                    <td><?php $divi_detailpage_style1_event_shareicon_hover_color = dem_detail_view_op_get_value('divi_detailpage_style1_event_shareicon_hover_color','');  ?>
						<input type="text" name="divi_detailpage_style1_event_shareicon_hover_color" value="<?php echo esc_attr( $divi_detailpage_style1_event_shareicon_hover_color );?>" class="dem-color-picker"/>
					 </td>
                </tr>
				<tr>
                    <th><?php esc_attr_e('Style 1 Border Color', 'dpevent'); ?></th>
                    <td><?php $divi_detailpage_style1_border_color = dem_detail_view_op_get_value('divi_detailpage_style1_border_color',''); ?>
						<input type="text" name="divi_detailpage_style1_border_color" value="<?php echo esc_attr( $divi_detailpage_style1_border_color );?>" class="dem-color-picker"/>
					 </td>
                </tr>
				<tr>
                    <th><?php esc_attr_e('Style 1 Boxshadow Color', 'dpevent'); ?></th>
                    <td><?php $divi_detailpage_style1_boxshaow_color = dem_detail_view_op_get_value('divi_detailpage_style1_boxshaow_color','');  ?>
						<input type="text" name="divi_detailpage_style1_boxshaow_color" value="<?php echo esc_attr( $divi_detailpage_style1_boxshaow_color );?>" class="dem-color-picker"/>
					 </td>
                </tr>
				<tr>
                    <th><?php esc_attr_e('Style 1 Form Button Text Color', 'dpevent'); ?></th>
                    <td><?php $divi_detailpage_style1_frmbtn_text_color = dem_detail_view_op_get_value('divi_detailpage_style1_frmbtn_text_color','');  ?>
						<input type="text" name="divi_detailpage_style1_frmbtn_text_color" value="<?php echo esc_attr( $divi_detailpage_style1_frmbtn_text_color );?>" class="dem-color-picker"/>
					 </td>
                </tr>
				<tr>
                    <th><?php esc_attr_e('Style 1 Form Button Text Hover Color', 'dpevent'); ?></th>
                    <td><?php $divi_detailpage_style1_frmbtn_hover_text_color = dem_detail_view_op_get_value('divi_detailpage_style1_frmbtn_hover_text_color','');  ?>
						<input type="text" name="divi_detailpage_style1_frmbtn_hover_text_color" value="<?php echo esc_attr( $divi_detailpage_style1_frmbtn_hover_text_color );?>" class="dem-color-picker"/>
					 </td>
                </tr>
				<tr>
                    <th><?php esc_attr_e('Style 1 Form Button Background Color', 'dpevent'); ?></th>
                    <td><?php $divi_detailpage_style1_frmbtn_btn_bk_color = dem_detail_view_op_get_value('divi_detailpage_style1_frmbtn_btn_bk_color',''); ?>
						<input type="text" name="divi_detailpage_style1_frmbtn_btn_bk_color" value="<?php echo esc_attr( $divi_detailpage_style1_frmbtn_btn_bk_color );?>" class="dem-color-picker"/>
					 </td>
                </tr>
				<tr>
                    <th><?php esc_attr_e('Style 1 Form Button Background Hover Color', 'dpevent'); ?></th>
                    <td><?php $divi_detailpage_style1_frmbtn_btn_bk_hover_color = dem_detail_view_op_get_value('divi_detailpage_style1_frmbtn_btn_bk_hover_color','');  ?>
						<input type="text" name="divi_detailpage_style1_frmbtn_btn_bk_hover_color" value="<?php echo esc_attr( $divi_detailpage_style1_frmbtn_btn_bk_hover_color );?>" class="dem-color-picker"/>
					 </td>
                </tr>
				<tr>
                    <th><?php esc_attr_e('Style 1 Form Field Background Color', 'dpevent'); ?></th>
                    <td><?php $divi_detailpage_style1_frmbtn_field_bk_color = dem_detail_view_op_get_value('divi_detailpage_style1_frmbtn_field_bk_color',''); ?>
						<input type="text" name="divi_detailpage_style1_frmbtn_field_bk_color" value="<?php echo esc_attr( $divi_detailpage_style1_frmbtn_field_bk_color );?>" class="dem-color-picker"/>
					 </td>
                </tr>
				<tr>
                    <th><?php esc_attr_e('Style 1 Form Field Placeholder Text Color', 'dpevent'); ?></th>
                    <td><?php $divi_detailpage_style1_frmbtn_field_label_color = dem_detail_view_op_get_value('divi_detailpage_style1_frmbtn_field_label_color',''); ?>
						<input type="text" name="divi_detailpage_style1_frmbtn_field_label_color" value="<?php echo esc_attr( $divi_detailpage_style1_frmbtn_field_label_color );?>" class="dem-color-picker"/>
					 </td>
                </tr>
				<tr>
                    <th><?php esc_attr_e('Style 1 Form Field Label Text Color', 'dpevent'); ?></th>
                    <td><?php $divi_detailpage_style1_frmbtn_field_nlabel_color = dem_detail_view_op_get_value('divi_detailpage_style1_frmbtn_field_nlabel_color',''); ?>
						<input type="text" name="divi_detailpage_style1_frmbtn_field_nlabel_color" value="<?php echo esc_attr( $divi_detailpage_style1_frmbtn_field_nlabel_color );?>" class="dem-color-picker"/>
					 </td>
                </tr>
			</table>
			<table class="form-table">
				<h2><?php esc_attr_e('Style 2 Color Settings', 'dpevent'); ?></h2>
			    <hr>
				<tr>
                    <th><?php esc_attr_e('Enable Style 2', 'dpevent'); ?></th>
                    <td><?php $divi_detailpage_style2_enable_style = dem_detail_view_op_get_value('divi_detailpage_style2_enable_style','No');?>
					 <select name="divi_detailpage_style2_enable_style">
					  <option value="Yes" <?php selected( esc_attr( $divi_detailpage_style2_enable_style ),"Yes" ); ?>>Yes</option>
							<option value="No" <?php selected( esc_attr( $divi_detailpage_style2_enable_style ), "No" ); ?>>No</option>
					 </select>
					 </td>
                </tr>					
				<tr>
                    <th><?php esc_attr_e('Style 2 Header Background Color', 'dpevent'); ?></th>
                    <td><?php $divi_detailpage_style2_bk_color = dem_detail_view_op_get_value('divi_detailpage_style2_bk_color','');?>
						<input type="text" name="divi_detailpage_style2_bk_color" value="<?php echo esc_attr( $divi_detailpage_style2_bk_color );?>" class="dem-color-picker"/>
					 </td>
                </tr>
				<tr>
                    <th><?php esc_attr_e('Style 2 Header Text Color', 'dpevent'); ?></th>
                    <td><?php  $divi_detailpage_style2_txt_color = dem_detail_view_op_get_value('divi_detailpage_style2_txt_color','');?>
						<input type="text" name="divi_detailpage_style2_txt_color" value="<?php echo esc_attr( $divi_detailpage_style2_txt_color );?>" class="dem-color-picker"/>
					 </td>
                </tr>
				<tr>
                    <th><?php esc_attr_e('Style 2 Event Information & Event Organizer/Event Venue & Event Location Section Background Color', 'dpevent'); ?></th>
                    <td><?php $divi_detailpage_style2_event_org_color = dem_detail_view_op_get_value('divi_detailpage_style2_event_org_color',''); ?>
						<input type="text" name="divi_detailpage_style2_event_org_color" value="<?php echo esc_attr( $divi_detailpage_style2_event_org_color );?>" class="dem-color-picker"/>
					 </td>
                </tr>
				<tr>
                    <th><?php esc_attr_e('Style 2 Section Heading Color', 'dpevent'); ?></th>
                    <td><?php $divi_detailpage_style2_event_section_heading_color = dem_detail_view_op_get_value('divi_detailpage_style2_event_section_heading_color',''); ?>
						<input type="text" name="divi_detailpage_style2_event_section_heading_color" value="<?php echo esc_attr( $divi_detailpage_style2_event_section_heading_color );?>" class="dem-color-picker"/>
					 </td>
                </tr>
				<tr>
                    <th><?php esc_attr_e('Style 2 All Section Label Color', 'dpevent'); ?></th>
                    <td><?php $divi_detailpage_style2_event_section_label_color = dem_detail_view_op_get_value('divi_detailpage_style2_event_section_label_color','');  ?>
						<input type="text" name="divi_detailpage_style2_event_section_label_color" value="<?php echo esc_attr( $divi_detailpage_style2_event_section_label_color );?>" class="dem-color-picker"/>
					 </td>
                </tr>
				<tr>
                    <th><?php esc_attr_e('Style 2 Description Color', 'dpevent'); ?></th>
                    <td><?php $divi_detailpage_style2_event_section_desc_color = dem_detail_view_op_get_value('divi_detailpage_style2_event_section_desc_color','');  ?>
						<input type="text" name="divi_detailpage_style2_event_section_desc_color" value="<?php echo esc_attr( $divi_detailpage_style2_event_section_desc_color );?>" class="dem-color-picker"/>
					 </td>
                </tr>
				<tr>
                    <th><?php esc_attr_e('Style 2 All Section Information Color', 'dpevent'); ?></th>
                    <td><?php $divi_detailpage_style2_event_section_information_color = dem_detail_view_op_get_value('divi_detailpage_style2_event_section_information_color','');?>
						<input type="text" name="divi_detailpage_style2_event_section_information_color" value="<?php echo esc_attr( $divi_detailpage_style2_event_section_information_color );?>" class="dem-color-picker"/>
					 </td>
                </tr>
				<tr>
                    <th><?php esc_attr_e('Style 2 Share Icon Color', 'dpevent'); ?></th>
                    <td><?php $divi_detailpage_style2_event_shareicon_color = dem_detail_view_op_get_value('divi_detailpage_style2_event_shareicon_color','');?>
						<input type="text" name="divi_detailpage_style2_event_shareicon_color" value="<?php echo esc_attr( $divi_detailpage_style2_event_shareicon_color );?>" class="dem-color-picker"/>
					 </td>
                </tr>
				<tr>
                    <th><?php esc_attr_e('Style 2 Share Icon Hover Color', 'dpevent'); ?></th>
                    <td><?php $divi_detailpage_style2_event_shareicon_hover_color = dem_detail_view_op_get_value('divi_detailpage_style2_event_shareicon_hover_color',''); ?>
						<input type="text" name="divi_detailpage_style2_event_shareicon_hover_color" value="<?php echo esc_attr( $divi_detailpage_style2_event_shareicon_hover_color );?>" class="dem-color-picker"/>
					 </td>
                </tr>
				<tr>
                    <th><?php esc_attr_e('Style 2 Box Border Color', 'dpevent'); ?></th>
                    <td><?php $divi_detailpage_style2_border_color = dem_detail_view_op_get_value('divi_detailpage_style2_border_color',''); ?>
						<input type="text" name="divi_detailpage_style2_border_color" value="<?php echo esc_attr( $divi_detailpage_style2_border_color );?>" class="dem-color-picker"/>
					 </td>
                </tr>
				<tr>
                    <th><?php esc_attr_e('Style 2 Boxshadow Color', 'dpevent'); ?></th>
                    <td><?php $divi_detailpage_style2_boxshaow_color = dem_detail_view_op_get_value('divi_detailpage_style2_boxshaow_color','');  ?>
						<input type="text" name="divi_detailpage_style2_boxshaow_color" value="<?php echo esc_attr( $divi_detailpage_style2_boxshaow_color );?>" class="dem-color-picker"/>
					 </td>
                </tr>
				<tr>
                    <th><?php esc_attr_e('Style 2 Form Button Text Color', 'dpevent'); ?></th>
                    <td><?php $divi_detailpage_style2_frmbtn_text_color = dem_detail_view_op_get_value('divi_detailpage_style2_frmbtn_text_color',''); ?>
						<input type="text" name="divi_detailpage_style2_frmbtn_text_color" value="<?php echo esc_attr( $divi_detailpage_style2_frmbtn_text_color );?>" class="dem-color-picker"/>
					 </td>
                </tr>
				<tr>
                    <th><?php esc_attr_e('Style 2 Form Button Text Hover Color', 'dpevent'); ?></th>
                    <td><?php $divi_detailpage_style2_frmbtn_hover_text_color = dem_detail_view_op_get_value('divi_detailpage_style2_frmbtn_hover_text_color',''); ?>
						<input type="text" name="divi_detailpage_style2_frmbtn_hover_text_color" value="<?php echo esc_attr( $divi_detailpage_style2_frmbtn_hover_text_color );?>" class="dem-color-picker"/>
					 </td>
                </tr>
				<tr>
                    <th><?php esc_attr_e('Style 2 Form Button Background Color', 'dpevent'); ?></th>
                    <td><?php $divi_detailpage_style2_frmbtn_btn_bk_color = dem_detail_view_op_get_value('divi_detailpage_style2_frmbtn_btn_bk_color',''); ?>
						<input type="text" name="divi_detailpage_style2_frmbtn_btn_bk_color" value="<?php echo esc_attr( $divi_detailpage_style2_frmbtn_btn_bk_color );?>" class="dem-color-picker"/>
					 </td>
                </tr>
				<tr>
                    <th><?php esc_attr_e('Style 2 Form Button Background Hover Color', 'dpevent'); ?></th>
                    <td><?php $divi_detailpage_style2_frmbtn_btn_bk_hover_color = dem_detail_view_op_get_value('divi_detailpage_style2_frmbtn_btn_bk_hover_color',''); ?>
						<input type="text" name="divi_detailpage_style2_frmbtn_btn_bk_hover_color" value="<?php echo esc_attr( $divi_detailpage_style2_frmbtn_btn_bk_hover_color );?>" class="dem-color-picker"/>
					 </td>
                </tr>
				<tr>
                    <th><?php esc_attr_e('Style 2 Form Field Background Color', 'dpevent'); ?></th>
                    <td><?php $divi_detailpage_style2_frmbtn_field_bk_color = dem_detail_view_op_get_value('divi_detailpage_style2_frmbtn_field_bk_color','');  ?>
						<input type="text" name="divi_detailpage_style2_frmbtn_field_bk_color" value="<?php echo esc_attr( $divi_detailpage_style2_frmbtn_field_bk_color );?>" class="dem-color-picker"/>
					 </td>
                </tr>
				<tr>
                    <th><?php esc_attr_e('Style 2 Form Field Placeholder Text Color', 'dpevent'); ?></th>
                    <td><?php $divi_detailpage_style2_frmbtn_field_label_color = dem_detail_view_op_get_value('divi_detailpage_style2_frmbtn_field_label_color',''); ?>
						<input type="text" name="divi_detailpage_style2_frmbtn_field_label_color" value="<?php echo esc_attr( $divi_detailpage_style2_frmbtn_field_label_color );?>" class="dem-color-picker"/>
					 </td>
                </tr>
				<tr>
                    <th><?php esc_attr_e('Style 2 Form Field Label Text Color', 'dpevent'); ?></th>
                    <td><?php $divi_detailpage_style2_frmbtn_field_nlabel_color = dem_detail_view_op_get_value('divi_detailpage_style2_frmbtn_field_nlabel_color',''); ?>
						<input type="text" name="divi_detailpage_style2_frmbtn_field_nlabel_color" value="<?php echo esc_attr( $divi_detailpage_style2_frmbtn_field_nlabel_color );?>" class="dem-color-picker"/>
					 </td>
                </tr>
			</table>
			<table class="form-table">
				<h2><?php esc_attr_e('Custom Style Booking/Inquiry Color Settings', 'dpevent'); ?></h2>
			    <hr>
				<tr>
                    <th><?php esc_attr_e('Enable Custom Style', 'dpevent'); ?></th>
                    <td><?php $divi_detailpage_custom_enable_style = dem_detail_view_op_get_value('divi_detailpage_custom_enable_style','No');?>
					 <select name="divi_detailpage_custom_enable_style">
					  <option value="Yes" <?php selected( esc_attr( $divi_detailpage_custom_enable_style ),"Yes" ); ?>>Yes</option>
							<option value="No" <?php selected( esc_attr( $divi_detailpage_custom_enable_style ), "No" ); ?>>No</option>
					 </select>
					 </td>
                </tr>				
				<tr>
                    <th><?php esc_attr_e('Custom Style Form Button Text Color', 'dpevent'); ?></th>
                    <td><?php $divi_detailpage_custom_frmbtn_text_color = dem_detail_view_op_get_value('divi_detailpage_custom_frmbtn_text_color','');  ?>
						<input type="text" name="divi_detailpage_custom_frmbtn_text_color" value="<?php echo esc_attr( $divi_detailpage_custom_frmbtn_text_color );?>" class="dem-color-picker"/>
					 </td>
                </tr>
				<tr>
                    <th><?php esc_attr_e('Custom Style Form Button Text Hover Color', 'dpevent'); ?></th>
                    <td><?php $divi_detailpage_custom_frmbtn_hover_text_color = dem_detail_view_op_get_value('divi_detailpage_custom_frmbtn_hover_text_color','');  ?>
						<input type="text" name="divi_detailpage_custom_frmbtn_hover_text_color" value="<?php echo esc_attr( $divi_detailpage_custom_frmbtn_hover_text_color );?>" class="dem-color-picker"/>
					 </td>
                </tr>
				<tr>
                    <th><?php esc_attr_e('Custom Style Form Button Background Color', 'dpevent'); ?></th>
                    <td><?php $divi_detailpage_custom_frmbtn_btn_bk_color = dem_detail_view_op_get_value('divi_detailpage_custom_frmbtn_btn_bk_color',''); ?>
						<input type="text" name="divi_detailpage_custom_frmbtn_btn_bk_color" value="<?php echo esc_attr( $divi_detailpage_custom_frmbtn_btn_bk_color );?>" class="dem-color-picker"/>
					 </td>
                </tr>
				<tr>
                    <th><?php esc_attr_e('Custom Style Form Button Background Hover Color', 'dpevent'); ?></th>
                    <td><?php $divi_detailpage_custom_frmbtn_btn_bk_hover_color = dem_detail_view_op_get_value('divi_detailpage_custom_frmbtn_btn_bk_hover_color','');  ?>
						<input type="text" name="divi_detailpage_custom_frmbtn_btn_bk_hover_color" value="<?php echo esc_attr( $divi_detailpage_custom_frmbtn_btn_bk_hover_color );?>" class="dem-color-picker"/>
					 </td>
                </tr>
				<tr>
                    <th><?php esc_attr_e('Custom Style Form Field Background Color', 'dpevent'); ?></th>
                    <td><?php $divi_detailpage_custom_frmbtn_field_bk_color = dem_detail_view_op_get_value('divi_detailpage_custom_frmbtn_field_bk_color',''); ?>
						<input type="text" name="divi_detailpage_custom_frmbtn_field_bk_color" value="<?php echo esc_attr( $divi_detailpage_custom_frmbtn_field_bk_color );?>" class="dem-color-picker"/>
					 </td>
                </tr>
				<tr>
                    <th><?php esc_attr_e('Custom Style Form Field Placeholder Text Color', 'dpevent'); ?></th>
                    <td><?php $divi_detailpage_custom_frmbtn_field_label_color = dem_detail_view_op_get_value('divi_detailpage_custom_frmbtn_field_label_color',''); ?>
						<input type="text" name="divi_detailpage_custom_frmbtn_field_label_color" value="<?php echo esc_attr( $divi_detailpage_custom_frmbtn_field_label_color );?>" class="dem-color-picker"/>
					 </td>
                </tr>
				<tr>
                    <th><?php esc_attr_e('Custom Style Form Field Label Text Color', 'dpevent'); ?></th>
                    <td><?php $divi_detailpage_custom_frmbtn_field_nlabel_color = dem_detail_view_op_get_value('divi_detailpage_custom_frmbtn_field_nlabel_color',''); ?>
						<input type="text" name="divi_detailpage_custom_frmbtn_field_nlabel_color" value="<?php echo esc_attr( $divi_detailpage_custom_frmbtn_field_nlabel_color );?>" class="dem-color-picker"/>
					 </td>
                </tr>
				<tr>
                    <th><?php esc_attr_e('Custom Style Form Heading Color', 'dpevent'); ?></th>
                    <td><?php $divi_detailpage_custom_heading_color = dem_detail_view_op_get_value('divi_detailpage_custom_heading_color',''); ?>
						<input type="text" name="divi_detailpage_custom_heading_color" value="<?php echo esc_attr( $divi_detailpage_custom_heading_color );?>" class="dem-color-picker"/>
					 </td>
                </tr>
				<tr>
                    <th><?php esc_attr_e('Custom Style Form Boxshadow Color', 'dpevent'); ?></th>
                    <td><?php $divi_detailpage_custom_boxshaow_color = dem_detail_view_op_get_value('divi_detailpage_custom_boxshaow_color','');  ?>
						<input type="text" name="divi_detailpage_custom_boxshaow_color" value="<?php echo esc_attr( $divi_detailpage_custom_boxshaow_color );?>" class="dem-color-picker"/>
					 </td>
                </tr>
				<tr>
                    <th><?php esc_attr_e('Custom Style Share Icon Color', 'dpevent'); ?></th>
                    <td><?php $divi_detailpage_custom_event_shareicon_color = dem_detail_view_op_get_value('divi_detailpage_custom_event_shareicon_color','');  ?>
						<input type="text" name="divi_detailpage_custom_event_shareicon_color" value="<?php echo esc_attr( $divi_detailpage_custom_event_shareicon_color );?>" class="dem-color-picker"/>
					 </td>
                </tr>
				<tr>
                    <th><?php esc_attr_e('Custom Style Share Icon Hover Color', 'dpevent'); ?></th>
                    <td><?php $divi_detailpage_custom_event_shareicon_hover_color = dem_detail_view_op_get_value('divi_detailpage_custom_event_shareicon_hover_color','');  ?>
						<input type="text" name="divi_detailpage_custom_event_shareicon_hover_color" value="<?php echo esc_attr( $divi_detailpage_custom_event_shareicon_hover_color );?>" class="dem-color-picker"/>
					 </td>
                </tr>
				
			</table>
		<?php } if( $active_tab == 'email_customization' ) {
				?>
			<table class="form-table">
				<h2><?php esc_attr_e('Email Customization Settings', 'dpevent'); ?></h2>
			    <hr>
				<tr>
                    <th>Subject Fields</th>
                    <td>
					Name : {field_email_name} <br/>
					Event Name: {field_email_eventname} <br/>
					</td>
                </tr>
				<tr>
                    <th>Message Fields</th>
                    <td>
					Name : {field_email_name} <br/>
					Email : {field_email_emailaddress} <br/>
					Phone : {field_email_phone} <br/>
					Event Name: {field_email_eventname} <br/>
					Event ID: {field_email_eventid} <br/>
					Price: {field_email_price} <br/>
					No of Tickets: {field_email_nooftickets} <br/>
					Total Price: {field_email_totalprice} <br/>
					Booking Status: {field_email_status} <br/>
					Booking/Inquiry Date: {field_email_date} <br/>
					Event Custom Field 1: {field_custom_field1} <br/>
					Event Custom Field 2: {field_custom_field2} <br/>
					Event Custom Field 3: {field_custom_field3} <br/>
					Event Start Date: {field_email_event_start_date} <br/>
					Event End Date: {field_email_event_end_date} <br/>
					Event Start Time: {field_email_event_start_time} <br/>
					Event End Time: {field_email_event_end_time} <br/>
					</td>
                </tr>
				<tr>
                    <th><?php esc_attr_e('Cc Email Address', 'dpevent'); ?></th>
                    <td><?php $cc_email_customization = dem_email_customization_op_get_value('cc_email_customization',''); ?>
						<input type="text" name="cc_email_customization" value="<?php echo esc_attr( $cc_email_customization );?>" /><br/><b>Note: For multiple email just add comma(,) seperator between two email address</b>
					 </td>
                </tr>
				<tr>
                    <th><?php esc_attr_e('Enable Different admin receiver for the inquiry/booking email per event', 'dpevent'); ?></th>
                    <td><?php $enable_admin_email_customization = dem_email_customization_op_get_value('enable_admin_email_customization','No');?>
					 <select name="enable_admin_email_customization">
					 <option value="No" <?php selected( esc_attr( $enable_admin_email_customization ), "No" ); ?>>No</option>
					  <option value="Yes" <?php selected( esc_attr( $enable_admin_email_customization ),"Yes" ); ?>>Yes</option>
					 </select>
					 <br/>If yes then Go to <a href="<?php echo esc_url(admin_url('/post-new.php?post_type=dp_events'));?>">here </a> and add email address </p>
					 </td>
                </tr>
				<tr>
                    <th><?php esc_attr_e('Enable Custom Email Send Message Format', 'dpevent'); ?></th>
                    <td><?php $enable_email_customization = dem_email_customization_op_get_value('enable_email_customization','No');?>
					 <select name="enable_email_customization">
					  <option value="Yes" <?php selected( esc_attr( $enable_email_customization ),"Yes" ); ?>>Yes</option>
							<option value="No" <?php selected( esc_attr( $enable_email_customization ), "No" ); ?>>No</option>
					 </select>
					 <br/> <b style="color:#FF0000;font-size:15px;">Note: Below all fields work when Enable Custom Email Send Message Format option is set to YES and you must fill below all fields.</b>
					 </td>
                </tr>
				<tr>
                    <th><?php esc_attr_e('User Email Subject', 'dpevent'); ?></th>
                    <td><?php $user_subject_email_customization = dem_email_customization_op_get_value('user_subject_email_customization',''); ?>
						<input type="text" name="user_subject_email_customization" value="<?php echo esc_attr( $user_subject_email_customization );?>" />
						<br/>Sample : Confirmation Mail of {field_email_eventname} Booking/Inquiry Information
					 </td>
                </tr>
				<tr>
                    <th><?php esc_attr_e('Admin Email Subject', 'dpevent'); ?></th>
                    <td><?php $admin_subject_email_customization = dem_email_customization_op_get_value('admin_subject_email_customization',''); ?>
						<input type="text" name="admin_subject_email_customization" value="<?php echo esc_attr( $admin_subject_email_customization );?>" />
						<br/>Sample : {field_email_eventname} Booking/Inquiry Information
					 </td>
                </tr>
				<tr>
                    <th><?php esc_attr_e('User Email Setting', 'dpevent'); ?></th>
                    <td><?php $useremail_content   = dem_email_customization_op_get_value('useremail',''); 
							  $useremail_editor_id = 'useremail';
							  wp_editor( $useremail_content, $useremail_editor_id );?>
							  <br/>Sample : <br/>
							  		Thank you for contacting us. We will be in contact with you shortly. We have received your following booking/inquiry details: \n <br/>
							        Name : {field_email_name} &lt;br&gt; <br/>
									Email : {field_email_emailaddress} &lt;br&gt; <br/>
									Phone : {field_email_phone} &lt;br&gt;<br/>
									Event Name: {field_email_eventname} &lt;br&gt;<br/>
									Event ID: {field_email_eventid}&lt;br&gt; <br/>
									Price: {field_email_price} &lt;br&gt;<br/>
									No of Tickets: {field_email_nooftickets}&lt;br&gt; <br/>
									Total Price: {field_email_totalprice} &lt;br&gt;<br/>
									Booking Status: {field_email_status} &lt;br&gt; <br/>
									Booking/Inquiry Date: {field_email_date} &lt;br&gt; <br/>
									Event Custom Field 1: {field_custom_field1} &lt;br&gt; <br/>
									Event Custom Field 2: {field_custom_field2} &lt;br&gt; <br/>
									Event Custom Field 3: {field_custom_field3} &lt;br&gt; <br/>
									Event Start Date: {field_email_event_start_date} &lt;br&gt;<br/>
									Event End Date: {field_email_event_end_date} &lt;br&gt;<br/>
									Event Start Time: {field_email_event_start_time}&lt;br&gt; <br/>
									Event End Time: {field_email_event_end_time}&lt;br&gt;  <br/>
					 </td>
                </tr>
				<tr>
                    <th><?php esc_attr_e('Admin Email Setting', 'dpevent'); ?></th>
                    <td><?php $adminemail_content   = dem_email_customization_op_get_value('adminemail',''); 
							  $adminemail_editor_id = 'adminemail';
							  wp_editor( $adminemail_content, $adminemail_editor_id );?>
							  <br/>Sample : <br/>
							  		Dear Site Administrator, Following booking/inquiry  has been received. &lt;br&gt; <br/>
							        Name : {field_email_name} &lt;br&gt; <br/>
									Email : {field_email_emailaddress} &lt;br&gt; <br/>
									Phone : {field_email_phone} &lt;br&gt;<br/>
									Event Name: {field_email_eventname} &lt;br&gt;<br/>
									Event ID: {field_email_eventid}&lt;br&gt; <br/>
									Price: {field_email_price} &lt;br&gt;<br/>
									No of Tickets: {field_email_nooftickets}&lt;br&gt; <br/>
									Total Price: {field_email_totalprice} &lt;br&gt;<br/>
									Booking Status: {field_email_status} &lt;br&gt; <br/>
									Booking/Inquiry Date: {field_email_date} <br/>
									Event Custom Field 1: {field_custom_field1} &lt;br&gt; <br/>
									Event Custom Field 2: {field_custom_field2} &lt;br&gt; <br/>
									Event Custom Field 3: {field_custom_field3} &lt;br&gt; <br/>
									Event Start Date: {field_email_event_start_date} &lt;br&gt;<br/>
									Event End Date: {field_email_event_end_date} &lt;br&gt;<br/>
									Event Start Time: {field_email_event_start_time}&lt;br&gt; <br/>
									Event End Time: {field_email_event_end_time}&lt;br&gt;  <br/>
					 </td>
                </tr>
			</table>
			<table class="form-table">	
				<h2><?php esc_attr_e('After Booking Status Completed Email Customization Settings(Only for Booking Form)', 'dpevent'); ?></h2>
			    <hr>
				<tr>
                    <th><?php esc_attr_e('Booking Status Completed User Email Subject', 'dpevent'); ?></th>
                    <td><?php $b_user_subject_email_customization = dem_email_customization_op_get_value('b_user_subject_email_customization',''); ?>
						<input type="text" name="b_user_subject_email_customization" value="<?php echo esc_attr( $b_user_subject_email_customization );?>" />
						<br/>Sample : Confirmation Mail of {field_email_eventname} Booking/Inquiry Information
					 </td>
                </tr>
				<tr>
                    <th><?php esc_attr_e('Booking Status Completed Admin Email Subject', 'dpevent'); ?></th>
                    <td><?php $b_admin_subject_email_customization = dem_email_customization_op_get_value('b_admin_subject_email_customization',''); ?>
						<input type="text" name="b_admin_subject_email_customization" value="<?php echo esc_attr( $b_admin_subject_email_customization );?>" />
						<br/>Sample : {field_email_eventname} Booking/Inquiry Information
					 </td>
                </tr>
				<tr>
                    <th><?php esc_attr_e('Booking Status Completed User Email Setting', 'dpevent'); ?></th>
                    <td><?php $b_useremail_content   = dem_email_customization_op_get_value('b_useremail',''); 
							  $b_useremail_editor_id = 'b_useremail';
							  wp_editor( $b_useremail_content, $b_useremail_editor_id );?>
							  <br/>Sample : <br/>
							  		Thank you for contacting us. We will be in contact with you shortly. We have received your following booking/inquiry details: \n <br/>
							        Name : {field_email_name} &lt;br&gt; <br/>
									Email : {field_email_emailaddress} &lt;br&gt; <br/>
									Phone : {field_email_phone} &lt;br&gt;<br/>
									Event Name: {field_email_eventname} &lt;br&gt;<br/>
									Event ID: {field_email_eventid}&lt;br&gt; <br/>
									Price: {field_email_price} &lt;br&gt;<br/>
									No of Tickets: {field_email_nooftickets}&lt;br&gt; <br/>
									Total Price: {field_email_totalprice} &lt;br&gt;<br/>
									Booking Status: {field_email_status} &lt;br&gt; <br/>
									Booking/Inquiry Date: {field_email_date} <br/>
									Event Custom Field 1: {field_custom_field1} &lt;br&gt; <br/>
									Event Custom Field 2: {field_custom_field2} &lt;br&gt; <br/>
									Event Custom Field 3: {field_custom_field3} &lt;br&gt; <br/>
									Event Start Date: {field_email_event_start_date} &lt;br&gt;<br/>
									Event End Date: {field_email_event_end_date} &lt;br&gt;<br/>
									Event Start Time: {field_email_event_start_time}&lt;br&gt; <br/>
									Event End Time: {field_email_event_end_time}&lt;br&gt;  <br/>
					 </td>
                </tr>
				<tr>
                    <th><?php esc_attr_e('Booking Status Completed Admin Email Setting', 'dpevent'); ?></th>
                    <td><?php $b_adminemail_content   = dem_email_customization_op_get_value('b_adminemail',''); 
							  $b_adminemail_editor_id = 'b_adminemail';
							  wp_editor( $b_adminemail_content, $b_adminemail_editor_id );?>
							  <br/>Sample : <br/>
							  		Dear Site Administrator, Following booking/inquiry  has been received. &lt;br&gt; <br/>
							        Name : {field_email_name} &lt;br&gt; <br/>
									Email : {field_email_emailaddress} &lt;br&gt; <br/>
									Phone : {field_email_phone} &lt;br&gt;<br/>
									Event Name: {field_email_eventname} &lt;br&gt;<br/>
									Event ID: {field_email_eventid}&lt;br&gt; <br/>
									Price: {field_email_price} &lt;br&gt;<br/>
									No of Tickets: {field_email_nooftickets}&lt;br&gt; <br/>
									Total Price: {field_email_totalprice} &lt;br&gt;<br/>
									Booking Status: {field_email_status} &lt;br&gt; <br/>
									Booking/Inquiry Date: {field_email_date} <br/>
									Event Custom Field 1: {field_custom_field1} &lt;br&gt; <br/>
									Event Custom Field 2: {field_custom_field2} &lt;br&gt; <br/>
									Event Custom Field 3: {field_custom_field3} &lt;br&gt; <br/>
									Event Start Date: {field_email_event_start_date} &lt;br&gt;<br/>
									Event End Date: {field_email_event_end_date} &lt;br&gt;<br/>
									Event Start Time: {field_email_event_start_time}&lt;br&gt; <br/>
									Event End Time: {field_email_event_end_time}&lt;br&gt;  <br/>
					 </td>
                </tr>
			</table>
		<?php } ?>
		
		<table class="form-table">
		<tr>
                    <td>
                        <button type="submit" class="button-primary"><?php esc_attr_e('Save Settings', 'dpevent'); ?></button>
                    </td>
					 <td>&nbsp;</td>
                </tr>
		</table>
                <?php wp_nonce_field( $nonce, $nonce ); ?>
                <input type="hidden"  name="action" value="dem_settings">
            </form>
    </div>
<?php
}
add_action('wp_footer','dem_custom_style',9999);
function dem_custom_style(){
  require_once(DEM_PLUGIN_PATH . 'include/dem-style.php'); 
}