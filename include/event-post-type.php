<?php 
if ( ! class_exists( 'Divi_Event_Post_Type' ) )
{
	class Divi_Event_Post_Type
	{
		function __construct()
		{
			add_action( 'init', array( &$this, 'dem_event_init' ) );
			add_action( 'add_meta_boxes', array( &$this, 'dem_event_meta_box_add' ) ); 
			add_action( 'admin_enqueue_scripts',array( &$this, 'dem_events_admin_js' ),9999);
			add_action( 'save_post',  array( &$this,'dem_event_save_meta_box_data' ) );
			add_action( 'post_updated_messages',  array( &$this,'dem_event_updated_messages' ) );
			add_action( 'manage_edit-dp_events_columns',  array( &$this,'dem_event_thumbnail_column' ),10,1);
			add_action( 'manage_dp_events_posts_custom_column',  array( &$this,'dem_event_display_thumbnail' ),10,1);
			add_filter( 'enter_title_here',array( &$this, 'dem_event_default_title' ));
			add_action( 'do_meta_boxes', array( &$this,'dem_event_change_image_box' ) );
			add_action( 'restrict_manage_posts', array(&$this,'dem_event_filter_list') );
			add_filter("manage_edit-event_category_columns",array( &$this, 'dem_event_category_columns')); 
			add_filter("manage_event_category_custom_column",array( &$this, 'dem_event_category_theme_columns'),10, 3);
			add_filter("manage_edit-event_tag_columns",array( &$this, 'dem_event_tag_columns')); 
			add_filter("manage_event_tag_custom_column",array( &$this, 'dem_event_tag_theme_columns'),10, 3);
		}
		
		function dem_event_category_theme_columns($out, $column_name, $theme_id) {
			switch ($column_name) {
				case 'event_category': 
					$out .= $theme_id; 
					break;
				default:
					break;
			}
			return $out;    
		}
		function dem_event_category_columns($theme_columns) 
		{
			$new_columns = array(
				'cb' 				=> '<input type="checkbox" />',
				'name' 				=> __('Name', 'dpevent'),
				'event_category' 	=> __('ID', 'dpevent'),
				'description' 		=> __('Description', 'dpevent'),
				'slug' 				=> __('Slug', 'dpevent'),
				'posts'				=> __('Count', 'dpevent')
			);
			return $new_columns;
		}
		function dem_event_tag_theme_columns($out, $column_name, $theme_id) {
			switch ($column_name) {
				case 'event_tag': 
					$out .= $theme_id; 
					break;
				default:
					break;
			}
			return $out;    
		}
		function dem_event_tag_columns($theme_columns) 
		{
			$new_columns = array(
				'cb' 			=> '<input type="checkbox" />',
				'name' 			=> __('Name'),
				'event_tag' 	=> __('ID'),
				'description' 	=> __('Description'),
				'slug' 			=> __('Slug'),
				'posts' 		=> __('Count')
			);
			return $new_columns;
		}
		
		function dem_events_admin_js(){
			global $post_type;
			if( 'dp_events' == $post_type ){
				$jquery_ui = array("jquery-ui-datepicker");
				foreach($jquery_ui as $script){
					wp_deregister_script($script);
				} 
				wp_enqueue_style('dem_event_admin_css', DEM_PLUGIN_URL.'assets/css/admin/dem_admin.min.css', array(), NULL);
				wp_enqueue_style( 'dem-choosen-stylesheet', DEM_PLUGIN_URL.'assets/css/admin/chosen.min.css', '1.0.0',false);
				wp_enqueue_script( 'dem-fulldatetimepicker-js', DEM_PLUGIN_URL.'assets/js/admin/jquery.datetimepicker.full.min.js','1.0.0',true);			
				wp_enqueue_script( 'dem-chosen-js', DEM_PLUGIN_URL.'assets/js/admin/chosen.jquery.min.js','1.0.0',true);
				wp_enqueue_script( 'dem-cust-gallery-script',DEM_PLUGIN_URL. 'assets/js/admin/event-gallery-add.min.js','1.0.0',true);
			}
		}
		function dem_event_init()
		{
			$dpevent_labels = array(
								'name' 					=> __('Events','dpevent'),
								'singular_name' 		=> __('Events','dpevent'),
								'add_new' 				=> __('Add  Event','dpevent'),
								'add_new_item' 			=> __('Add New Event ','dpevent'),
								'edit_item' 			=> __('Edit Event ','dpevent'),
								'new_item' 				=> __('New Event','dpevent'),
								'all_items' 			=> __('All Events','dpevent'),
								'search_items' 			=> __('Serach Event','dpevent'),
								'not_found' 			=> __('No Event found','dpevent'),
								'not_found_in_trash' 	=> __('No Event found in Trash','dpevent'), 
								'parent_item_colon'		=> '',
								'menu_name' 			=> __('Events','dpevent')
							);
			$dpevent_args = array(		
								'labels'             => $dpevent_labels,
								'public'             => true,
								'publicly_queryable' => true,
								'show_ui'            => true,
								'show_in_menu'       => true,
								'query_var'          => true,
								'rewrite'            => array( 'slug' => 'events' ),
								'capability_type'    => 'post',
								'has_archive'        => true,
								'show_in_rest'		 => true,
								'hierarchical'       => false,
								'menu_position'      => null,
								'menu_icon'			 => 'dashicons-calendar',
								'supports'           => array( 'title', 'editor','thumbnail','excerpt')
							);
							register_post_type( 'dp_events', $dpevent_args );
							
			$dpevent_categary_labels = array(
							'name'              => __( 'Event Categories', 'dpevent' ),
							'singular_name'     => __( 'Event Categories',  'dpevent' ),
							'search_items'      => __( 'Search Event Category', 'dpevent' ),
							'all_items'         => __( 'All Event Categories', 'dpevent' ),
							'parent_item'       => __( 'Parent Category', 'dpevent' ),
							'parent_item_colon' => __( 'Parent Category:', 'dpevent' ),
							'edit_item'         => __( 'Edit Event Category', 'dpevent' ),
							'update_item'       => __( 'Update Event Category', 'dpevent' ),
							'add_new_item'      => __( 'Add New Event Category', 'dpevent' ),
							'new_item_name'     => __( 'New Event Category', 'dpevent' ),
							'menu_name'         => __( 'Event Categories', 'dpevent' ),
						);
			$dpevent_categary_args = array(
								'hierarchical'      => true,
								'labels'            => $dpevent_categary_labels,
								'show_ui'           => true,
								'show_admin_column' => true,
								'query_var'         => true,
								'rewrite'           => array( 'slug' => 'event-category' ),
							);
			register_taxonomy( 'event_category', array( 'dp_events' ), $dpevent_categary_args );
					
			$dpevent_tag_labels = array(
							'name'              => __( 'Event Tags', 'dpevent' ),
							'singular_name'     => __( 'Event Tags',  'dpevent' ),
							'search_items'      => __( 'Search Event Tag', 'dpevent' ),
							'all_items'         => __( 'All Event Tags', 'dpevent' ),
							'parent_item'       => __( 'Parent Tag', 'dpevent' ),
							'parent_item_colon' => __( 'Parent Tag:', 'dpevent' ),
							'edit_item'         => __( 'Edit Event Tag', 'dpevent' ),
							'update_item'       => __( 'Update Event Tag', 'dpevent' ),
							'add_new_item'      => __( 'Add New Event Tag', 'dpevent' ),
							'new_item_name'     => __( 'New Event Tag', 'dpevent' ),
							'menu_name'         => __( 'Event Tags', 'dpevent' ),
						);
			$dpevent_tag_args = array(
								'hierarchical'      => true,
								'labels'            => $dpevent_tag_labels,
								'show_ui'           => true,
								'show_admin_column' => true,
								'query_var'         => true,
								'rewrite'           => array( 'slug' => 'tag-category' ),
							);
					register_taxonomy( 'event_tag', array( 'dp_events' ), $dpevent_tag_args );
        }
		function dem_event_meta_box_add() 
		{
			add_meta_box('dem_event_info_metabox',__( 'Event Information', 'dpevent' ),array( &$this,'dem_event_info_custom_meta_box' ), 'dp_events', 'normal', 'low' );
			add_meta_box('dem_venue_info_metabox',__( 'Venue Information' , 'dpevent'),array( &$this,'dem_venue_info_custom_meta_box' ), 'dp_events', 'normal', 'low' );
			add_meta_box('dem_organizer_info_metabox',__( 'Organizer Information', 'dpevent' ),array( &$this,'dem_organizer_info_custom_meta_box' ), 'dp_events', 'normal', 'low' );
			add_meta_box('dem_event_cost_metabox',__( 'Ticket Cost' , 'dpevent'),array( &$this,'dem_event_cost_custom_meta_box' ), 'dp_events', 'normal', 'low' );
			add_meta_box( 'dem_event_cust_gallery-metabox', __( 'Event Gallery' , 'dpevent'),array( &$this, 'dem_event_cust_gallery_meta_box' ), 'dp_events', 'normal', 'low' );
		}
		function dem_event_cust_gallery_meta_box()
		{
			global $post;
			$values = get_post_custom( $post->ID );
			$dpevent_cust_imagebox = isset( $values['dpevent_cust_image_id'] ) ? esc_attr( $values['dpevent_cust_image_id'][0] ) : "0";
			$i = 1;
		?>
			<p class="addmorebtn"><a href="javascript:void(0);" class="add button button-primary button-sm"><?php esc_attr_e('+ Add More Image','dpevent'); ?></a></p>
			<div class="ai_meta_control">
				<div class="imageDetailsClone">
					<?php
					for($i=0; $i<$dpevent_cust_imagebox+1; $i++ ):
						$dpevent_cust_gallery_upload_attach_id = isset( $values['dpevent_cust_imagebox'.$i] ) ? esc_attr( $values['dpevent_cust_imagebox'.$i][0] ) : "";
						$dpevent_cust_gallery_upload_image_src = wp_get_attachment_image_src( $dpevent_cust_gallery_upload_attach_id, 'thumbnail' );
						$dpevent_cust_galleryCheckImg = "none";
						$event_gal_image_url = '';
						if ( !empty($dpevent_cust_gallery_upload_image_src[0]) )
						{
							$dpevent_cust_galleryCheckImg = "inline-block";
							$event_gal_image_url =  esc_url( $dpevent_cust_gallery_upload_image_src[0] );
						}
					?>
					<div class="postbox clone imgbox-<?php echo esc_attr($i); ?>">
						<div class="handlediv" title="Click to toggle"><br></div>
						<h3 class="hndle"><span><?php esc_attr_e('Image Details: ','dpevent'); ?></span></h3>
						<div class="inside" style="margin-left: 20px;">
							<div class="form-field">
								<label for="cover_image" class="cust_gallery_upload_image"><?php esc_attr_e('Image','dpevent'); ?></label>
						        <div class="cover_image" style="display:<?php echo esc_attr($dpevent_cust_galleryCheckImg)?>;">
						          <img src="<?php echo esc_url( $event_gal_image_url ); ?>" name="dpevent_cust_gallery_display_cover_image" id="dpevent_cust_gallery_display_cover_image"/>
						        </div>
						        <p>
									<span><i><?php esc_attr_e('Best image size for thumbnail : <strong>150px * 150px</strong> (upload : JPG, PNG & GIF )','dpevent'); ?></i></span>
								</p>
						        
							    <input type="hidden" size="36" name="dpevent_cust_gallery_upload_image[]" id="dpevent_cust_gallery_upload_image<?php echo esc_attr($i); ?>" value="<?php echo esc_attr( $dpevent_cust_gallery_upload_attach_id ); ?>" />
								<p>
									<input name="dpevent_cust_gallery_upload_image_button" type="button" value="<?php esc_attr_e('Upload Image','dpevent');?>" class="button button-primary"/>
							    	<input name="dpevent_cust_gallery_remove_image_button" type="button" value="<?php esc_attr_e('Remove Image','dpevent');?>"  width="8%" class="button button-primary" style="display:<?php echo esc_attr($dpevent_cust_galleryCheckImg);?>;">
								</p>
							</div>
						</div>
						<?php if ( $i > 0 ):?>
						<div class="hr" style="margin-bottom: 10px;"></div>
						<p style="overflow:hidden; padding-right:10px;">
							<a href="javascript:void(0);" onclick="removebox('<?php echo esc_attr($i); ?>');" class="btn-right button button-remove button-sm">- <?php esc_attr_e('Remove','dpevent');?></a>
						</p>
						<?php endif;?>
					</div>
				<?php endfor;?>
				</div>
			</div>
			<input type="hidden" name="dpevent_cust_image_id" value="<?php echo esc_attr( $dpevent_cust_imagebox );?>">
		<?php	
		}
		function dem_event_info_custom_meta_box( $post ) 
		{
			$dp_event_start_date 		    =  get_post_meta( $post->ID, 'dp_event_start_date', true );
			$dp_event_start_time_value 		= get_post_meta( $post->ID, 'dp_event_start_time', true );
			$dp_event_end_date 				= get_post_meta( $post->ID, 'dp_event_end_date', true );
			$dp_event_end_time_value 		= get_post_meta( $post->ID, 'dp_event_end_time', true );
			$dpevent_custom_link 			= get_post_meta( $post->ID, 'dpevent_custom_link', true );
			$dp_event_page_link_type 		= get_post_meta( $post->ID, 'dp_event_page_link_type', true );
			$dp_event_page_booking_en_ds 	= get_post_meta( $post->ID, 'dp_event_page_booking_en_ds', true );
			
			$dpevent_custom_field1 	= get_post_meta( $post->ID, 'dpevent_custom_field1', true );
			$dpevent_custom_field2 	= get_post_meta( $post->ID, 'dpevent_custom_field2', true );
			$dpevent_custom_field3 	= get_post_meta( $post->ID, 'dpevent_custom_field3', true );
			
			$dp_event_start_date_value = '';$dp_event_end_date_value = '';
			if( $dp_event_start_date ){
				$dp_event_start_date_value = date_i18n('d-m-Y',$dp_event_start_date);
			}
			if( $dp_event_end_date ){
				$dp_event_end_date_value =  date_i18n('d-m-Y',$dp_event_end_date);
			}
		?>
		<table cellpadding="10">
			<tr>
				<td colspan="2">
					<label for="timeanddate">
						<strong><?php esc_attr_e( 'Time & Date ', 'dpevent' ); ?></strong>
					</label>
				</td>		
			</tr>
			<tr>
				<td>
					<label for="startend">
						<?php esc_attr_e( 'Start/End: ', 'dpevent' ); ?>
					</label>
				</td>
				<td width="30%">
					<input type="text" id="dp_event_start_date" name="dp_event_start_date" placeholder="<?php esc_attr_e( 'Start Date', 'dpevent' ); ?>" value="<?php echo esc_attr( $dp_event_start_date_value ) ?>" />
				</td>	
				<td width="30%">
					<input type="text" id="dp_event_start_time" name="dp_event_start_time" placeholder="<?php esc_attr_e( 'Start Time', 'dpevent' ); ?>" value="<?php echo esc_attr( $dp_event_start_time_value ) ?>" />
				</td>
				<td>
				<?php esc_attr_e( 'To', 'dpevent' ); ?>
				</td>	
				<td width="30%">
					<input type="text" id="dp_event_end_date" name="dp_event_end_date" placeholder="<?php esc_attr_e( 'End Date', 'dpevent' ); ?>" value="<?php echo esc_attr( $dp_event_end_date_value ) ?>" />
				</td>	
				<td width="30%">
					<input type="text" id="dp_event_end_time" name="dp_event_end_time" placeholder="<?php esc_attr_e( 'End Time', 'dpevent' ); ?>" value="<?php echo esc_attr( $dp_event_end_time_value ) ?>" />
				</td>			
			</tr>
			<tr>	
				<td colspan="2">
					<label for="address">
						<?php esc_attr_e( 'Event Detail Page Custom Link :', 'dpevent' ); ?>
					</label>
				</td>
				<td colspan="4"><input type="text" id="dpevent_custom_link" name="dpevent_custom_link" value="<?php echo esc_attr( $dpevent_custom_link ) ?>"  /><br/>
				 Display the events and link to external information when clicked on. So is it an option to assign an external link to the events and link to that on click instead of leading to another internal page</td>			
			</tr>
			<tr>
				<td colspan="2">
					<label for="cost">
						<?php esc_attr_e( 'Event Detail Page Link Type: ', 'dpevent' ); ?>
					</label>
				</td>
				<td colspan="4">
					<?php 
					$all_links_event = array(		
									 "default" => "Default[From Module]",
									 "posttypelink" => "Post Type Event Detail Page Link",
									 "customeventlink" => "Custom Event Detail Page Link"
									); 
					?>
					<select name="dp_event_page_link_type" class="dp_event_page_link_type" >
						<?php 
							foreach($all_links_event as $key => $value)
							{
								echo "<option value='".esc_attr($key)."'".  selected(esc_attr($dp_event_page_link_type), $key).">".esc_attr($value)."</option>";
							}
						?>
					</select>
					<br/>
					This option use for you can set individual event wise Link Type. If set "Default" then take from event module.
				</td>	
			</tr>
			<tr>
				<td colspan="2">
					<label for="cost">
						<?php esc_attr_e( 'Event Booking/Inquiry Form Enabled/Disabled: ', 'dpevent' ); ?>
					</label>
				</td>
				<td colspan="4">
					<?php 
					$all_opt_event = array(		
									 "default" => "Default[From Theme Option]",
									 "Yes" => "Show Booking/Inquiry Form",
									 "No" => "Hide Booking/Inquiry Form"
									); 
					?>
					<select name="dp_event_page_booking_en_ds" class="dp_event_page_booking_en_ds" >
						<?php 
							foreach($all_opt_event as $key => $value)
							{
								echo "<option value='".esc_attr($key)."'".  selected(esc_attr($dp_event_page_booking_en_ds), $key).">".esc_attr($value)."</option>";
							}
						?>
					</select>
					<br/>
					This option use for you can set individual event wise Enabled/Disabled Event Booking/Inquiry Form. If set "Default" then take from theme option.
				</td>	
			</tr>
			<tr>	
				<td colspan="2">
					<label for="address">
						<?php esc_attr_e( 'Event Custom Field 1 :', 'dpevent' ); ?>
					</label>
				</td>
				<td colspan="4"><input type="text" id="dpevent_custom_field1" name="dpevent_custom_field1" value="<?php echo esc_attr( $dpevent_custom_field1 ) ?>"  /><br/>
				 This field you can display in email template or you can use in event detail page or event grid,list and slider view but you need to add custom code for that.</td>			
			</tr>
			<tr>	
				<td colspan="2">
					<label for="address">
						<?php esc_attr_e( 'Event Custom Field 2 :', 'dpevent' ); ?>
					</label>
				</td>
				<td colspan="4"><input type="text" id="dpevent_custom_field2" name="dpevent_custom_field2" value="<?php echo esc_attr( $dpevent_custom_field2 ) ?>"  /><br/>
				 This field you can display in email template or you can use in event detail page or event grid,list and slider view but you need to add custom code for that.</td>			
			</tr>
			<tr>	
				<td colspan="2">
					<label for="address">
						<?php esc_attr_e( 'Event Custom Field 3 :', 'dpevent' ); ?>
					</label>
				</td>
				<td colspan="4"><input type="text" id="dpevent_custom_field3" name="dpevent_custom_field3" value="<?php echo esc_attr( $dpevent_custom_field3 ) ?>"  /><br/>
				 This field you can display in email template or you can use in event detail page or event grid,list and slider view but you need to add custom code for that.</td>			
			</tr>
		</table>
		<?php 	
		}
		function dem_venue_info_custom_meta_box( $post ) 
		{

			$address_value 		= get_post_meta( $post->ID, 'dpevent_address', true );
			$city_value 		= get_post_meta( $post->ID, 'dpevent_city', true );
			$country_value 		= get_post_meta( $post->ID, 'dpevent_country', true );
			$state_value 		= get_post_meta( $post->ID, 'dpevent_state', true );
			$pincode_value 		= get_post_meta( $post->ID, 'dpevent_pincode', true );
			$phone_number_value = get_post_meta( $post->ID, 'dpevent_phone_number', true );
			$website_value 		= get_post_meta( $post->ID, 'dpevent_website', true );
			$google_map_value 	= get_post_meta( $post->ID, 'dpevent_google_map', true );
					
		?>
		
		<table cellpadding="10">
			<tr>	
				<td>
					<label for="address">
						<?php esc_attr_e( 'Address:', 'dpevent' ); ?>
					</label>
				</td>
				<td><input type="text" id="address" name="dpevent_address" value="<?php echo esc_attr( $address_value ) ?>" size="40" /></td>			
			</tr>
			<tr>	
				<td>
					<label for="city">
						<?php esc_attr_e( 'City:', 'dpevent' ); ?>
					</label>
				</td>
				<td><input type="text" id="city" name="dpevent_city" value="<?php echo esc_attr( $city_value ) ?>" size="40" /></td>			
			</tr>
			<tr>	
				<td>
					<label for="country">
						<?php esc_attr_e( 'Country:', 'dpevent' ); ?>
					</label>
				</td>
				<td>
				 <?php
					$list = array("" =>"","AF" => "Afghanistan", "AL" => "Albania", "DZ" => "Algeria", "AS" => "American Samoa", "AD" => "Andorra", "AO" => "Angola", "AI" => "Anguilla", "AQ" => "Antarctica", "AG" => "Antigua and Barbuda", "AR" => "Argentina", "AM" => "Armenia", "AW" => "Aruba", "AU" => "Australia", "AT" => "Austria", "AZ" => "Azerbaijan", "AX" => "Åland Islands", "BS" => "Bahamas", "BH" => "Bahrain", "BD" => "Bangladesh", "BB" => "Barbados", "BY" => "Belarus", "BE" => "Belgium", "BZ" => "Belize", "BJ" => "Benin", "BM" => "Bermuda", "BT" => "Bhutan", "BO" => "Bolivia", "BA" => "Bosnia and Herzegovina", "BW" => "Botswana", "BV" => "Bouvet Island", "BR" => "Brazil", "BQ" => "British Antarctic Territory", "IO" => "British Indian Ocean Territory", "VG" => "British Virgin Islands", "BN" => "Brunei", "BG" => "Bulgaria", "BF" => "Burkina Faso", "BI" => "Burundi", "KH" => "Cambodia", "CM" => "Cameroon", "CA" => "Canada", "CT" => "Canton and Enderbury Islands", "CV" => "Cape Verde", "KY" => "Cayman Islands", "CF" => "Central African Republic", "TD" => "Chad", "CL" => "Chile", "CN" => "China", "CX" => "Christmas Island", "CC" => "Cocos [Keeling] Islands", "CO" => "Colombia", "KM" => "Comoros", "CG" => "Congo - Brazzaville", "CD" => "Congo - Kinshasa", "CK" => "Cook Islands", "CR" => "Costa Rica", "HR" => "Croatia", "CU" => "Cuba", "CY" => "Cyprus", "CZ" => "Czech Republic", "CI" => "Côte d’Ivoire", "DK" => "Denmark", "DJ" => "Djibouti", "DM" => "Dominica", "DO" => "Dominican Republic", "NQ" => "Dronning Maud Land", "DD" => "East Germany", "EC" => "Ecuador", "EG" => "Egypt", "SV" => "El Salvador", "GQ" => "Equatorial Guinea", "ER" => "Eritrea", "EE" => "Estonia", "ET" => "Ethiopia", "FK" => "Falkland Islands", "FO" => "Faroe Islands", "FJ" => "Fiji", "FI" => "Finland", "FR" => "France", "GF" => "French Guiana", "PF" => "French Polynesia", "TF" => "French Southern Territories", "FQ" => "French Southern and Antarctic Territories", "GA" => "Gabon", "GM" => "Gambia", "GE" => "Georgia", "DE" => "Germany", "GH" => "Ghana", "GI" => "Gibraltar", "GR" => "Greece", "GL" => "Greenland", "GD" => "Grenada", "GP" => "Guadeloupe", "GU" => "Guam", "GT" => "Guatemala", "GG" => "Guernsey", "GN" => "Guinea", "GW" => "Guinea-Bissau", "GY" => "Guyana", "HT" => "Haiti", "HM" => "Heard Island and McDonald Islands", "HN" => "Honduras", "HK" => "Hong Kong SAR China", "HU" => "Hungary", "IS" => "Iceland", "IN" => "India", "ID" => "Indonesia", "IR" => "Iran", "IQ" => "Iraq", "IE" => "Ireland", "IM" => "Isle of Man", "IL" => "Israel", "IT" => "Italy", "JM" => "Jamaica", "JP" => "Japan", "JE" => "Jersey", "JT" => "Johnston Island", "JO" => "Jordan", "KZ" => "Kazakhstan", "KE" => "Kenya", "KI" => "Kiribati", "KW" => "Kuwait", "KG" => "Kyrgyzstan", "LA" => "Laos", "LV" => "Latvia", "LB" => "Lebanon", "LS" => "Lesotho", "LR" => "Liberia", "LY" => "Libya", "LI" => "Liechtenstein", "LT" => "Lithuania", "LU" => "Luxembourg", "MO" => "Macau SAR China", "MK" => "Macedonia", "MG" => "Madagascar", "MW" => "Malawi", "MY" => "Malaysia", "MV" => "Maldives", "ML" => "Mali", "MT" => "Malta", "MH" => "Marshall Islands", "MQ" => "Martinique", "MR" => "Mauritania", "MU" => "Mauritius", "YT" => "Mayotte", "FX" => "Metropolitan France", "MX" => "Mexico", "FM" => "Micronesia", "MI" => "Midway Islands", "MD" => "Moldova", "MC" => "Monaco", "MN" => "Mongolia", "ME" => "Montenegro", "MS" => "Montserrat", "MA" => "Morocco", "MZ" => "Mozambique", "MM" => "Myanmar [Burma]", "NA" => "Namibia", "NR" => "Nauru", "NP" => "Nepal", "NL" => "Netherlands", "AN" => "Netherlands Antilles", "NT" => "Neutral Zone", "NC" => "New Caledonia", "NZ" => "New Zealand", "NI" => "Nicaragua", "NE" => "Niger", "NG" => "Nigeria", "NU" => "Niue", "NF" => "Norfolk Island", "KP" => "North Korea", "VD" => "North Vietnam", "MP" => "Northern Mariana Islands", "NO" => "Norway", "OM" => "Oman", "PC" => "Pacific Islands Trust Territory", "PK" => "Pakistan", "PW" => "Palau", "PS" => "Palestinian Territories", "PA" => "Panama", "PZ" => "Panama Canal Zone", "PG" => "Papua New Guinea", "PY" => "Paraguay", "YD" => "People's Democratic Republic of Yemen", "PE" => "Peru", "PH" => "Philippines", "PN" => "Pitcairn Islands", "PL" => "Poland", "PT" => "Portugal", "PR" => "Puerto Rico", "QA" => "Qatar", "RO" => "Romania", "RU" => "Russia", "RW" => "Rwanda", "RE" => "Réunion", "BL" => "Saint Barthélemy", "SH" => "Saint Helena", "KN" => "Saint Kitts and Nevis", "LC" => "Saint Lucia", "MF" => "Saint Martin", "PM" => "Saint Pierre and Miquelon", "VC" => "Saint Vincent and the Grenadines", "WS" => "Samoa", "SM" => "San Marino", "SA" => "Saudi Arabia", "SN" => "Senegal", "RS" => "Serbia", "CS" => "Serbia and Montenegro", "SC" => "Seychelles", "SL" => "Sierra Leone", "SG" => "Singapore", "SK" => "Slovakia", "SI" => "Slovenia", "SB" => "Solomon Islands", "SO" => "Somalia", "ZA" => "South Africa", "GS" => "South Georgia and the South Sandwich Islands", "KR" => "South Korea", "ES" => "Spain", "LK" => "Sri Lanka", "SD" => "Sudan", "SR" => "Suriname", "SJ" => "Svalbard and Jan Mayen", "SZ" => "Swaziland", "SE" => "Sweden", "CH" => "Switzerland", "SY" => "Syria", "ST" => "São Tomé and Príncipe", "TW" => "Taiwan", "TJ" => "Tajikistan", "TZ" => "Tanzania", "TH" => "Thailand", "TL" => "Timor-Leste", "TG" => "Togo", "TK" => "Tokelau", "TO" => "Tonga", "TT" => "Trinidad and Tobago", "TN" => "Tunisia", "TR" => "Turkey", "TM" => "Turkmenistan", "TC" => "Turks and Caicos Islands", "TV" => "Tuvalu", "UM" => "U.S. Minor Outlying Islands", "PU" => "U.S. Miscellaneous Pacific Islands", "VI" => "U.S. Virgin Islands", "UG" => "Uganda", "UA" => "Ukraine", "SU" => "Union of Soviet Socialist Republics", "AE" => "United Arab Emirates", "GB" => "United Kingdom", "US" => "United States", "ZZ" => "Unknown or Invalid Region", "UY" => "Uruguay", "UZ" => "Uzbekistan", "VU" => "Vanuatu", "VA" => "Vatican City", "VE" => "Venezuela", "VN" => "Vietnam", "WK" => "Wake Island", "WF" => "Wallis and Futuna", "EH" => "Western Sahara", "YE" => "Yemen", "ZM" => "Zambia", "ZW" => "Zimbabwe");
					?>
					 	<select name="dpevent_country" data-placeholder="Choose a Country..." class="dp_event_country"  >
					 		<?php 
 								foreach ($list as $key => $country) {
									 echo "<option value='".esc_attr( $country )."'". selected($country_value, esc_attr( $country) ) . ">" . esc_attr( $country ) . '</option>';
								 }   
							 ?>				 	
						 </select>
				</td>
			</tr>
			<tr>	
				<td>
					<label for="state">
						<?php esc_attr_e( 'State or Province:', 'dpevent' ); ?>
					</label>
				</td>
				<td><input type="text" id="state" name="dpevent_state" value="<?php echo esc_attr( $state_value ) ?>" size="40" /></td>			
			</tr>
			<tr>	
				<td>
					<label for="pincode">
						<?php esc_attr_e( 'Postal Code:', 'dpevent' ); ?>
					</label>
				</td>
				<td><input type="text" id="pincode" name="dpevent_pincode" value="<?php echo esc_attr( $pincode_value ) ?>" size="40"  /></td>			
			</tr>
			<tr>	
				<td>
					<label for="phone_Number">
						<?php esc_attr_e( 'Phone: ', 'dpevent' ); ?>
					</label>
				</td>
				<td><input type="text" id="phone_number" name="dpevent_phone_number" value="<?php echo esc_attr( $phone_number_value ) ?>" size="40" /></td>			
			</tr>
			<tr>		
				<td>
					<label for="website">
						<?php esc_attr_e( 'Website:', 'dpevent' ); ?>
					</label>
				</td>
				<td><input type="text" id="website" name="dpevent_website" value="<?php echo esc_url( $website_value ) ?>" size="40" /><br />Please add http/https on link</td>			
			</tr>
			<tr>	
				<td>
					<label for="google_map">
						<?php esc_attr_e( 'Show Google Map:', 'dpevent' ); ?>
					</label>
				</td>
				<td>
					<input type="checkbox" id="google_map" name="dpevent_google_map" value="yes" size="40"
					<?php checked( esc_attr( $google_map_value ),"yes"); ?> />
				 </td>			
			</tr>
		</table>
		<?php 	
		}
	
		function dem_organizer_info_custom_meta_box( $post ) 
		{

			$organizer_name_value 	= get_post_meta( $post->ID, 'dpevent_organizer_name', true );
			$email_id_value 		= get_post_meta( $post->ID, 'dpevent_email_id', true );
			$dpevent_admin_email_id_value 		= get_post_meta( $post->ID, 'dpevent_admin_email_id', true );
			
		?>
		<table cellpadding="10">
			<tr>
				<td>
					<label for="organizer_name">
						<?php esc_attr_e( 'Organizer Name: ', 'dpevent' ); ?>
					</label>
				</td>
				<td><input type="text" id="organizer_name" name="dpevent_organizer_name" value="<?php echo esc_attr( $organizer_name_value ) ?>" size="40" /></td>			
			</tr>
			<tr>
				<td>
					<label for="email_id">
						<?php esc_attr_e( 'Email: ', 'dpevent' ); ?>
					</label>
				</td>
				<td><input type="text" id="email_id" name="dpevent_email_id" value="<?php echo esc_attr( $email_id_value ) ?>" size="40" /></td>			
			</tr>
			<tr>
				<td>
					<label for="email_id">
						<?php esc_attr_e( 'Admin Receiver Email Address : ', 'dpevent' ); ?>
					</label>
				</td>
				
				<td><input type="text" id="dpevent_admin_email_id" name="dpevent_admin_email_id" value="<?php echo esc_attr( $dpevent_admin_email_id_value ) ?>" size="40" /><br/><p> This email is for admin receiver functionlaity per event.if you need a different receiver for the inquiry/booking email per event then Go for Email Customization Settings <a href="<?php echo esc_url(admin_url('/edit.php?post_type=dp_events&page=dp_events&tab=email_customization'));?>">Email Customization Settings</a></p>
				</td>			
			</tr>
		</table>
		<?php 	
		}
		function dp_event_website_custom_meta_box( $post ) 
		{
			$url_value = get_post_meta( $post->ID, 'dpevent_url_name', true );
			
		?>
		<table cellpadding="10">
			<tr>
				<td style="width:120px;" >
					<label for="url">
						<?php esc_attr_e( 'URL: ', 'dpevent' ); ?>
					</label>
				</td>
				<td><input type="text" id="url" name="dpevent_url_name" value="<?php echo esc_attr( $url_value ) ?>" size="40" /></td>			
			</tr>
		</table>
		<?php 	
		}
		function dem_event_cost_custom_meta_box( $post ) 
		{
			wp_nonce_field( 'dpevent_meta_box', 'dpevent_meta_box_nonce' );
			$dp_event_currency_symbol_value 		= get_post_meta( $post->ID, 'dp_event_currency_symbol_name', true );
			$dpevent_cost_value 					= get_post_meta( $post->ID, 'dpevent_cost_name', true );
			$dpevent_noticket_value 				= get_post_meta( $post->ID, 'dpevent_noticket', true );
			$linkedin_name_value 					= get_post_meta( $post->ID, 'dpevent_country', true );
			$dp_event_prefix_suffix_value 			= get_post_meta( $post->ID, 'dp_event_currency_prefix_suffix', true );
			$dp_event_form_type 					= get_post_meta( $post->ID, 'dp_event_form_type', true );
			$dpevent_noticket_allowtobook			= get_post_meta( $post->ID, 'dpevent_noticket_allowtobook', true );
			$dp_event_currency_symbol_value 		= htmlentities($dp_event_currency_symbol_value);
		?>
		<table cellpadding="10">
			<tr>
				<td>
					<label for="currency_symbol">
						<?php esc_attr_e( 'Currency Symbol: ', 'dpevent' ); ?>
					</label>
				</td>
				<td>
					<?php
						$currency_symbols = array(
									    "USD" => "&#36;" , //U.S. Dollar
									    "AUD" => "&#36;" , //Australian Dollar
									    "BRL" => "R&#36;" , //Brazilian Real
									    "CAD" => "C&#36;" , //Canadian Dollar
									    "CZK" => "K&#269;" , //Czech Koruna
									    "DKK" => "kr" , //Danish Krone
									    "EUR" => "&euro;" , //Euro
									    "HKD" => "&#36" , //Hong Kong Dollar
									    "HUF" => "Ft" , //Hungarian Forint
									    "ILS" => "&#x20aa;" , //Israeli New Sheqel
									    "INR" => "&#8377;", //Indian Rupee
									    "JPY" => "&yen;" , //Japanese Yen 	
									    "MYR" => "RM" , //Malaysian Ringgit 
									    "MXN" => "&#36" , //Mexican Peso
									    "NOK" => "kr" , //Norwegian Krone
									    "NZD" => "&#36" , //New Zealand Dollar
									    "PHP" => "&#x20b1;" , //Philippine Peso
									    "PLN" => "&#122;&#322;" ,//Polish Zloty
									    "GBP" => "&pound;" , //Pound Sterling
									    "SEK" => "kr" , //Swedish Krona
									    "CHF" => "Fr" , //Swiss Franc
									    "TWD" => "&#36;" , //Taiwan New Dollar 
									    "THB" => "&#3647;" , //Thai Baht
									    "TRY" => "&#8378;" //Turkish Lira
						); 
					?>		
					<select name="dp_event_currency_symbol_name" data-placeholder="Choose a Currency..." class="dp_event_currency" >
						<option value=""></option>
					 		<?php 
 								foreach ($currency_symbols as $key => $symbol) {
									 echo "<option value='". esc_attr($key) ."'". selected(esc_attr( $dp_event_currency_symbol_value ), $key ) . ">" . esc_attr($key).'['.esc_attr($symbol).']'. '</option>';
								 }   
							 ?>
					</select>
				</td>
				<td>
					<?php 
					$currency_prefix_suffix = array(		
													 "prefix" => "Before cost",
													 "suffix" => "After cost"
													); 
					?>
					<select name="dp_event_currency_prefix_suffix" class="dp_event_currency_prefix_suffix" >
						<?php 
							foreach($currency_prefix_suffix as $key => $value)
							{
								echo "<option value='".esc_attr($key)."'".  selected(esc_attr( $dp_event_prefix_suffix_value ), $key).">".esc_attr($value)."</option>";
							}
						?>
					</select>
				</td>			
			</tr>
			<tr>
				<td>
					<label for="noticket">
						<?php esc_attr_e( 'No Of Ticket Available: ', 'dpevent' ); ?>
					</label>
				</td>
				<td><input type="text" id="noticket" name="dpevent_noticket" value="<?php echo esc_attr( $dpevent_noticket_value ) ?>" size="40" /></td>			
			</tr>
			<tr>
				<td>
					<label for="dpevent_noticket_allowtobook">
						<?php esc_attr_e( 'No Of Ticket Allow To Book Per Person: ', 'dpevent' ); ?>
					</label>
				</td>
				<td><input type="text" id="dpevent_noticket_allowtobook" name="dpevent_noticket_allowtobook" value="<?php echo esc_attr( $dpevent_noticket_allowtobook ) ?>" size="3" /><br />Default is 10.</td>
			</tr>
			<tr>
				<td>
					<label for="cost">
						<?php esc_attr_e( 'Cost: ', 'dpevent' ); ?>
					</label>
				</td>
				<td><input type="text" id="cost" name="dpevent_cost_name" value="<?php echo esc_attr( $dpevent_cost_value ) ?>" size="40" /></td>			
			</tr>
			<tr>
				<td>
					<label for="cost">
						<?php esc_attr_e( 'Event Form Type: ', 'dpevent' ); ?>
					</label>
				</td>
				<td>
					<?php 
					$all_forms = array(		
									 "default" => "Default[From Theme Option]",
									 "free" => "Free[Inquiry Form]",
									 "paid" => "Paid[Booking Form]"
									); 
					?>
					<select name="dp_event_form_type" class="dp_event_form_type" >
						<?php 
							foreach($all_forms as $key => $value)
							{
								echo "<option value='".esc_attr($key)."'".  selected(esc_attr($dp_event_form_type), $key).">".esc_attr($value)."</option>";
							}
						?>
					</select>
				</td>	
			</tr>
		</table>
		<?php 	
		}
		function dem_event_save_meta_box_data($post_id)
			{
				if ( ! isset( $_POST['dpevent_meta_box_nonce'] ) ) {
					return;
				}
				if ( ! wp_verify_nonce( sanitize_key( $_POST['dpevent_meta_box_nonce'] ), 'dpevent_meta_box' ) ) {
					return;
				}
				if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
					return;
				}
				if ( isset( $_POST['post_type'] ) && 'dp_events' == $_POST['post_type'] )
				{
					if ( ! current_user_can( 'edit_page', $post_id ) ) {
						return;
					}
				} 
				else 
				{
					if ( ! current_user_can( 'edit_post', $post_id ) ) {
						return;
					}
				}		
					$dp_event_start_date 	= ( isset($_POST['dp_event_start_date']) && $_POST['dp_event_start_date'] == '01-01-1970')? '' : sanitize_text_field( $_POST['dp_event_start_date'] );
					$dp_event_start_time 	= isset($_POST['dp_event_start_time']) ? sanitize_text_field( $_POST['dp_event_start_time'] ) : '';  
					$dp_event_end_date 		= ( isset($_POST['dp_event_end_date']) && $_POST['dp_event_end_date'] == '01-01-1970')? '' : sanitize_text_field( $_POST['dp_event_end_date'] );
					$dp_event_end_time 		=  isset($_POST['dp_event_end_time']) ? sanitize_text_field( $_POST['dp_event_end_time'] ) : '';
					$dpevent_address 		= isset($_POST['dpevent_address']) ? sanitize_text_field( $_POST['dpevent_address'] ) : '';
					$dpevent_city 			= isset($_POST['dpevent_city']) ? sanitize_text_field( $_POST['dpevent_city'] ) : '';
					$dpevent_country 		= isset($_POST['dpevent_country']) ? sanitize_text_field( $_POST['dpevent_country'] ) : '';
					$dpevent_state 			= isset($_POST['dpevent_state']) ? sanitize_text_field( $_POST['dpevent_state'] ) : '';
					$dpevent_pincode		= isset($_POST['dpevent_pincode']) ? sanitize_text_field( $_POST['dpevent_pincode'] ) : '';
					$dpevent_phone_number 	= isset($_POST['dpevent_phone_number']) ? sanitize_text_field( $_POST['dpevent_phone_number'] ) : '';
					$dpevent_website 		= isset($_POST['dpevent_website']) ? sanitize_text_field( $_POST['dpevent_website'] ) : '';
					$dpevent_google_map 	= isset($_POST['dpevent_google_map']) ? sanitize_text_field( $_POST['dpevent_google_map'] ) : '';
					$dpevent_organizer_name = isset($_POST['dpevent_organizer_name']) ? sanitize_text_field( $_POST['dpevent_organizer_name'] ) : '';
					$dpevent_email_id 		= isset($_POST['dpevent_email_id']) ? sanitize_text_field( $_POST['dpevent_email_id'] ) : '';
					$dpevent_admin_email_id = isset($_POST['dpevent_admin_email_id']) ? sanitize_text_field( $_POST['dpevent_admin_email_id'] ) : '';
					$dp_event_currency_symbol_name = isset($_POST['dp_event_currency_symbol_name']) ? sanitize_text_field( $_POST['dp_event_currency_symbol_name'] ) : '';
					$dpevent_noticket 		= isset($_POST['dpevent_noticket']) ? sanitize_text_field( $_POST['dpevent_noticket'] ) : '';
					$dpevent_cost_name 		= isset($_POST['dpevent_cost_name']) ? sanitize_text_field( $_POST['dpevent_cost_name'] ) : '';
					$dp_event_currency_prefix_suffix = isset($_POST['dp_event_currency_prefix_suffix']) ? sanitize_text_field( $_POST['dp_event_currency_prefix_suffix'] ) : '';
					$dpevent_cust_image_id 	= isset($_POST['dpevent_cust_image_id']) ? sanitize_text_field( $_POST['dpevent_cust_image_id'] ) : '';
					$dp_event_form_type 	= isset($_POST['dp_event_form_type']) ? sanitize_text_field( $_POST['dp_event_form_type'] ) : '';
					$dpevent_noticket_allowtobook 	= isset($_POST['dpevent_noticket_allowtobook']) ? sanitize_text_field( $_POST['dpevent_noticket_allowtobook'] ) : '10';
					
					$dpevent_custom_link 		 = isset($_POST['dpevent_custom_link']) ? sanitize_text_field( $_POST['dpevent_custom_link'] ) : '';
					$dp_event_page_link_type 	 = isset($_POST['dp_event_page_link_type']) ? sanitize_text_field( $_POST['dp_event_page_link_type'] ) : 'default';
					$dp_event_page_booking_en_ds = isset($_POST['dp_event_page_booking_en_ds']) ? sanitize_text_field( $_POST['dp_event_page_booking_en_ds'] ) : 'default';
					
					$dpevent_custom_field1 		 = isset($_POST['dpevent_custom_field1']) ? sanitize_text_field( $_POST['dpevent_custom_field1'] ) : '';
					$dpevent_custom_field2 		 = isset($_POST['dpevent_custom_field2']) ? sanitize_text_field( $_POST['dpevent_custom_field2'] ) : '';
					$dpevent_custom_field3 		 = isset($_POST['dpevent_custom_field3']) ? sanitize_text_field( $_POST['dpevent_custom_field3'] ) : '';
					
					for ( $i=0; $i<$dpevent_cust_image_id+1; $i++ )
				    {
						$dpevent_upload_image 	= isset($_POST['dpevent_cust_gallery_upload_image'][$i]) ? sanitize_text_field( $_POST['dpevent_cust_gallery_upload_image'][$i] ) : '';
						if ( isset( $dpevent_upload_image ) )  
				        	update_post_meta( $post_id, 'dpevent_cust_imagebox'.$i , $dpevent_upload_image );		
				    }
					// Update the meta field in the database.
					update_post_meta( $post_id, 'dp_event_start_date', strtotime($dp_event_start_date) );
					update_post_meta( $post_id, 'dp_event_start_time', $dp_event_start_time);
					update_post_meta( $post_id, 'dp_event_end_date', strtotime($dp_event_end_date));
					update_post_meta( $post_id, 'dp_event_end_time', $dp_event_end_time);
					update_post_meta( $post_id, 'dpevent_address', $dpevent_address );
					update_post_meta( $post_id, 'dpevent_city', $dpevent_city );
					update_post_meta( $post_id, 'dpevent_country', $dpevent_country );
					update_post_meta( $post_id, 'dpevent_state', $dpevent_state );
					update_post_meta( $post_id, 'dpevent_pincode', $dpevent_pincode );
					update_post_meta( $post_id, 'dpevent_phone_number', $dpevent_phone_number );
					update_post_meta( $post_id, 'dpevent_website', $dpevent_website );
					update_post_meta( $post_id, 'dpevent_google_map', $dpevent_google_map );
					update_post_meta( $post_id, 'dpevent_organizer_name', $dpevent_organizer_name );
					update_post_meta( $post_id, 'dpevent_email_id', $dpevent_email_id );
					update_post_meta( $post_id, 'dpevent_admin_email_id', $dpevent_admin_email_id);
					update_post_meta( $post_id, 'dp_event_currency_symbol_name', $dp_event_currency_symbol_name );
					update_post_meta( $post_id, 'dpevent_cust_image_id', $dpevent_cust_image_id );
					update_post_meta( $post_id, 'dpevent_noticket', $dpevent_noticket );
					update_post_meta( $post_id, 'dpevent_cost_name', $dpevent_cost_name );
					update_post_meta( $post_id, 'dp_event_currency_prefix_suffix', $dp_event_currency_prefix_suffix );
					update_post_meta( $post_id, 'dp_event_form_type', $dp_event_form_type );
					update_post_meta( $post_id, 'dpevent_noticket_allowtobook', $dpevent_noticket_allowtobook );
					update_post_meta( $post_id, 'dpevent_custom_link', $dpevent_custom_link );
					update_post_meta( $post_id, 'dp_event_page_link_type', $dp_event_page_link_type );
					update_post_meta( $post_id, 'dp_event_page_booking_en_ds', $dp_event_page_booking_en_ds );
					
					update_post_meta( $post_id, 'dpevent_custom_field1', $dpevent_custom_field1 );
					update_post_meta( $post_id, 'dpevent_custom_field2', $dpevent_custom_field2 );
					update_post_meta( $post_id, 'dpevent_custom_field3', $dpevent_custom_field3 );
					
	}
	
	function dem_event_updated_messages( $messages ) 
		{
			$post             = get_post();
			$post_type        = get_post_type( $post );
			$post_type_object = get_post_type_object( $post_type );
			$messages['dp_events'] = array(
				0  => '', 
				1  => __( 'Event updated.', 'dpevent' ),
				2  => __( 'Custom field updated.', 'dpevent' ),
				3  => __( 'Custom field deleted.', 'dpevent' ),
				4  => __( 'Event updated.', 'dpevent' ),
				5  => isset( $_GET['revision'] ) ? sprintf( __( 'Event restored to revision from %s', 'dpevent' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false, // phpcs:ignore Processing form data without nonce verification.
				6  => __( 'Event published.', 'dpevent' ),
				7  => __( 'Event saved.', 'dpevent' ),
				8  => __( 'Event submitted.', 'dpevent' ),
				9  => sprintf(
					__( 'Event scheduled for: <strong>%1$s</strong>.', 'dpevent' ),
					date_i18n( __( 'M j, Y @ G:i', 'dpevent' ), strtotime( $post->post_date ) )
				),
				10 => __( 'Event draft updated.', 'dpevent' )
			);
			if ( $post_type_object->publicly_queryable && 'dp_events' == $post_type ) 
			{
				$permalink = get_permalink( $post->ID );
				$view_link = sprintf( ' <a href="%s">%s</a>', esc_url( $permalink ),'View '. $post_type );
				$messages[ $post_type ][1] .= $view_link;
				$messages[ $post_type ][6] .= $view_link;
				$messages[ $post_type ][9] .= $view_link;
				$preview_permalink = add_query_arg( 'preview', 'true', $permalink );
				$preview_link = sprintf( ' <a target="_blank" href="%s">%s</a>', esc_url( $preview_permalink ),'Preview '. $post_type );
				$messages[ $post_type ][8]  .= $preview_link;
				$messages[ $post_type ][10] .= $preview_link;
			}
			return $messages;
		}
	function dem_event_thumbnail_column( $columns )
	{
		$column_thumbnail = array	(  'thumbnail' 	=> __('Image', 'dpevent' ),
									   'title'  	=> __('Name','dpevent'),								   
									   'start-date' => __('Start Date', 'dpevent' ),
									   'end-date' 	=> __('End date', 'dpevent' )
									);
		$columns = array_slice( $columns, 0, 1, true ) + $column_thumbnail + array_slice( $columns, 1, 1, true ) + array_slice( $columns, 1, NULL, true );
			return $columns;
	}
	function dem_event_display_thumbnail( $column)
	{
		global $post;
			switch ( $column )
			{
				case 'thumbnail' :
					$default_image = DEM_PLUGIN_URL. '/assets/images/default.png';
					$get_feture_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ) ); 	
				    if( !empty( $get_feture_image[0] ) ) {
				    	echo '<img src="'. esc_url( $get_feture_image[0] ).'" style="max-height: 50px" name="'.esc_attr( get_the_title() ).'" />';
				    } else {
				    	echo '<img src="'.esc_url($default_image).'" style="max-height: 50px" name="'.esc_attr( get_the_title() ).'" />';  
				    }
		        	break;
					case 'start-date':
						$start_date = get_post_meta($post->ID, 'dp_event_start_date' , true );
					if( !empty( $start_date) ){
						$start_date = date_i18n('dS M, Y', $start_date);
						$start_time = get_post_meta($post->ID, 'dp_event_start_time' , true );
					}else{
						$start_date = $start_time = '';
					} 
					echo esc_attr($start_date ." ". $start_time);
					break;
					case 'end-date':
					$end_date = get_post_meta($post->ID, 'dp_event_end_date' , true );
					if( !empty( $end_date ) ) {
						$end_date= date_i18n('dS M, Y', $end_date);
						$end_time = get_post_meta($post->ID, 'dp_event_end_time' , true );
					}else{
						$end_date = $end_time = '';
					} 
					echo esc_attr($end_date ." ". $end_time);
					break;
			}
	}
	function dem_event_default_title( $title )
		{
			$screen = get_current_screen();
			if ( 'dp_events' == $screen->post_type ){
				$title = __('Enter the Event', 'dpevent' );
			}
			return $title;
		}
	function dem_event_change_image_box()
		{
			remove_meta_box( 'postimagediv', 'dp_events', 'normal' );
    		add_meta_box( 'postimagediv', __('Event Image ( Best view size: 400px * 400px)', 'dpevent' ), 'post_thumbnail_meta_box', 'dp_events', 'side', 'low' );
		}
	function dem_event_filter_list ()
	{
	  	global $typenow;
	    // select the custom taxonomy
	    $taxonomies = array('event_category','event_tag');
	    // select the type of custom post
	    if( $typenow == 'dp_events' ){
	        foreach ($taxonomies as $tax_slug) {
			
	            $tax_obj = get_taxonomy($tax_slug);
	            $tax_name = $tax_obj->labels->name;
	            $terms = get_terms($tax_slug);
				$tax_slug_val = isset( $_GET[$tax_slug] ) ? sanitize_text_field( wp_unslash($_GET[$tax_slug]) ) : ''; // phpcs:ignore Processing form data without nonce verification.
	            if(count($terms) > 0) {
	                echo "<select name='".esc_attr($tax_slug)."' id='".esc_attr($tax_slug)."' class='postform'>";
	                echo "<option value=''>Show All ".esc_attr($tax_name)."</option>";
	                foreach ($terms as $term) {
	                    echo "<option value='". esc_attr($term->slug)."'".selected($tax_slug_val, esc_attr( $term->slug ) ) . ">" . esc_attr($term->name) .' (' .esc_attr($term->count) .')</option>';
				    }
	                echo "</select>";
	            }
	        }
	    }
	}
	}
	new Divi_Event_Post_Type;
}
?>