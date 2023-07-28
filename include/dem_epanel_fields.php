<?php
function dem_epanel_tab() {
	dem_epanel_fields();
	?> <li><a href="#wrap-dem"><?php esc_attr_e('DP Event Manager', 'dpevent'); ?></a></li> <?php
}
function dem_epanel_fields(){
	global $epanelMainTabs, $themename, $shortname, $options;
	/************* Tab list *****************/
	$themename = 'dpevent';
	$options[] = array(
		"name" => "wrap-dem",
		"type" => "contenttab-wrapstart",);

	$options[] = array(
		"type" => "subnavtab-start",);
	//General
	$options[] = array(
		"name" => "dem_tab_general",
		"type" => "subnav-tab",
		"desc" => esc_html__("General", $themename)
	);
	//Label
	$options[] = array(
		"name" => "dem_tab_labels",
		"type" => "subnav-tab",
		"desc" => esc_html__("Label", $themename)
	);
	//Shortcodes
	$options[] = array(
		"name" => "dem_shortcodes",
		"type" => "subnav-tab",
		"desc" => esc_html__("Shortcodes", $themename)
	);

	$options[] = array(
		"type" => "subnavtab-end",);

	/************* Start : General Setting *****************/
	$options[] = array(
		"name" => "dem_tab_general",
		"type" => "subcontent-start",);
	$options[] = array(
		'name' => esc_html__('General Settings', $themename),
		'desc' => '',
		"type" => "callback_function",
		"function_name" => 'dem_blank',
	);
	$options[] = array(
		'name' 		=> esc_html__('Time Format', $themename),
		'id'	 	=> $shortname . "_dem_display_time",
		'desc' 		=> esc_html__('Display Time Format', $themename),
		"type" 		=> "select",
		"options" 	=> array(
			'twhr' 	=> esc_html__('12 Hours', $themename),
			'tfhr' 	=> esc_html__('24 Hours', $themename),
		),
		'std' 		=> 'twhr',
		'et_save_values' => true,
	);
	$options[] = array(
		'name' 		=> esc_html__('Event Detail Page Style', $themename),
		'id'	 	=> $shortname . "_dem_detail_view_style",
		'desc' 		=> esc_html__('Select Style', $themename),
		"type" 		=> "select",
		"options" 	=> array(
			'style1' 	=> esc_html__('Style 1', $themename),
			'style2' 	=> esc_html__('Style 2', $themename),
			'customstyle' 	=> esc_html__('Custom Own Style', $themename),
		),
		'std' 		=> 'style1',
		'et_save_values' => true,
	);
	$options[] = array(
		'name' => esc_html__('Slug Settings', $themename),
		'desc' => '',
		"type" => "callback_function",
		"function_name" => 'dem_blank',
	);
	$options[] = array(
		'name' 		=> esc_html__('Archive Page Slug', $themename),
		'id' 		=> $shortname . "_dem_detail_changed_slug",
		'std' 		=> 'events',
		'type' 		=> 'text',
	);

	$options[] = array(
		'name' 		=> esc_html__('Event Category Slug', $themename),
		'id' 		=> $shortname . "_dem_cat_slug",
		'std' 		=> 'event-category',
		'type' 		=> 'text',
	);

	$options[] = array(
		'name' 		=> esc_html__('Event Tag Slug', $themename),
		'id' 		=> $shortname . "_dem_tag_slug",
		'std' 		=> 'tag-category',
		'type' 		=> 'text',
	);
	$options[] = array(
		'name' => esc_html__('Archive Page Settings', $themename),
		'desc' => '',
		"type" => "callback_function",
		"function_name" => 'dem_blank',
	);
	$options[] = array(
		'name' 		=> esc_html__('Archive Page Grid/List Style', $themename),
		'id'	 	=> $shortname . "_dem_archive_view_style",
		'desc' 		=> esc_html__('Select Style', $themename),
		"type" 		=> "select",
		"options" 	=> array(
			'style1' 	=> esc_html__('Grid Style 1', $themename),
			'style2' 	=> esc_html__('Grid Style 2', $themename),
			'style3' 	=> esc_html__('Grid Style 3', $themename),
			'lstyle1' 	=> esc_html__('List Style 1', $themename),
			'lstyle2' 	=> esc_html__('List Style 2', $themename),
			'lstyle3' 	=> esc_html__('List Style 3', $themename),
		),
		'std' 		=> 'style3',
		'et_save_values' => true,
	);

	$options[] = array(
		'name' 		=> esc_html__('Display Number of Events in Archive Page', $themename),
		'id' 		=> $shortname . "_dem_archive_dem_post_per_page",
		'std' 		=> '9',
		'type' 		=> 'text',
	);

	$options[] = array(
		'name' 		=> esc_html__('Display Event in Archive Page', $themename),
		'id'	 	=> $shortname . "_dem_archive_display_event",
		'desc' 		=> esc_html__('Display Event in Archive Page', $themename),
		"type" 		=> "select",
		"options" 	=> array(
			'default' 	=> esc_html__('Default', $themename),
			'showpastevents' 	=> esc_html__('Show Only Past Events', $themename),
			'showupcomingevents' 	=> esc_html__('Show Only Upcoming Events', $themename),
		),
		'std' 		=> 'default',
		'et_save_values' => true,
	);
	$options[] = array(
		'name' => esc_html__('Booking/Inquiry Form Settings', $themename),
		'desc' => '',
		"type" => "callback_function",
		"function_name" => 'dem_blank',
	);
	
	$options[] = array(
		'name' => esc_html__('Hide Booking/Inquiry Form', $themename),
		'id' => $shortname . "_dem_hide_form",
		'desc' => esc_html__('Hide Booking/Inquiry Form'),
		'std' => 'off',
		"type" => "checkbox"
	);
	
	$options[] = array(
		'name' 		=> esc_html__('Display Form', $themename),
		'id'	 	=> $shortname . "_dem_display_form",
		'desc' 		=> esc_html__('Display Form', $themename),
		"type" 		=> "select",
		"options" 	=> array(
			'Booking' 	=> esc_html__('Booking Form', $themename),
			'Inquiry' 	=> esc_html__('Inquiry Form', $themename),
		),
		'std' 		=> 'Booking',
		'et_save_values' => true,
	);
	$options[] = array(
		'name' => esc_html__('Hide Telephone Field on Booking/Inquiry Form', $themename),
		'id' => $shortname . "_dem_hide_tel_no_frm",
		'desc' => esc_html__('Hide Telephone Field on Booking/Inquiry Form'),
		'std' => 'off',
		"type" => "checkbox"
	);
	$options[] = array(
		'name' => esc_html__('Enable Event Fully Booked Functionality', $themename),
		'id' => $shortname . "_dem_event_fully_booked",
		'desc' => esc_html__('Enable Event Fully Booked Functionality'),
		'std' => 'on',
		"type" => "checkbox"
	);
	$options[] = array(
		'name' => esc_html__('Enable Hide Booking/Inquiry Form When Event expired Functionality', $themename),
		'id' => $shortname . "_dem_event_hide_expired_booked",
		'desc' => esc_html__('Enable Hide Booking/Inquiry Form When Event expired Functionality'),
		'std' => 'on',
		"type" => "checkbox"
	);
	$options[] = array(
		'name' => esc_html__('Enable Increase number of available tickets if we delete the subscription for an event in the booking/inquiry listing', $themename),
		'id' => $shortname . "_dem_event_increase_ticket_cancel",
		'desc' => esc_html__('Increase number of available tickets if we delete the subscription for an event in the booking/inquiry listing'),
		'std' => 'on',
		"type" => "checkbox"
	);
	$options[] = array(
		'name' => esc_html__('Enable Remaining Ticket for Inquiry Form', $themename),
		'id' => $shortname . "_dem_rt_if_form",
		'desc' => esc_html__('Enable Remaining Ticket for Inquiry Form'),
		'std' => 'off',
		"type" => "checkbox"
	);
	$options[] = array(
		'name' => esc_html__('Enable Price for Inquiry Form', $themename),
		'id' => $shortname . "_dem_price_inquiry_form",
		'desc' => esc_html__('Enable Price for Inquiry Form'),
		'std' => 'off',
		"type" => "checkbox"
	);
	$options[] = array(
		'name' 		=> esc_html__('Paypal Mode', $themename),
		'id'	 	=> $shortname . "_dem_paypal_mode",
		'desc' 		=> esc_html__('Paypal Mode', $themename),
		"type" 		=> "select",
		"options" 	=> array(
			'Live' 	=> esc_html__('Live', $themename),
			'Test' 	=> esc_html__('Test', $themename),
		),
		'std' 		=> 'Live',
		'et_save_values' => true,
	);

	$options[] = array(
		'name' 		=> esc_html__('Paypal Merchant Email Address', $themename),
		'id' 		=> $shortname . "_dem_paypal_email_address",
		'std' 		=> '',
		'type' 		=> 'text',
	);
	
	$options[] = array(
		'name' 		=> esc_html__('Return URL After Submit Inquiry/Payment Paid/Success Page URL[Default is Current Page/Event URL]', $themename),
		'id' 		=> $shortname . "_dem_paypal_return",
		'std' 		=> '',
		'type' 		=> 'text',
	);

	$options[] = array(
		"name" => "dem_tab_general",
		"type" => "subcontent-end",);
	/************* END: General Setting *****************/	

	

	/************* Start : Label Setting *****************/

	$options[] = array(
		"name" => "dem_tab_labels",
		"type" => "subcontent-start",);
	$options[] = array(
		'name' => esc_html__('Event Detail Page Labels', $themename),
		'desc' => '',
		"type" => "callback_function",
		"function_name" => 'dem_blank',
	);
	$options[] = array(
		'name' 		=> esc_html__('Ticket Start From', $themename),
		'id' 		=> $shortname . "_dem_ticket_start_from",
		'desc' 		=> esc_html__('Ticket Start From', $themename),
		'std' 		=> 'Ticket Start From',
		'type' 		=> 'text',
	);

	$options[] = array(
		'name' 		=> esc_html__('Event Information', $themename),
		'id' 		=> $shortname . "_dem_evt_info",
		'desc' 		=> esc_html__('Event Informationm', $themename),
		'std' 		=> 'Event Information',
		'type' 		=> 'text',
	);

	$options[] = array(
		'name' 		=> esc_html__('Event Organizer', $themename),
		'id' 		=> $shortname . "_dem_evt_org",
		'desc' 		=> esc_html__('Event Organizer ', $themename),
		'std' 		=> 'Event Organizer ',
		'type' 		=> 'text',
	);

	$options[] = array(
		'name' 		=> esc_html__('Event Venue', $themename),
		'id' 		=> $shortname . "_dem_evt_venue",
		'desc' 		=> esc_html__('Event Venue ', $themename),
		'std' 		=> 'Event Venue ',
		'type' 		=> 'text',
	);

	$options[] = array(
		'name' 		=> esc_html__('Event Location', $themename),
		'id' 		=> $shortname . "_dem_evt_location",
		'desc' 		=> esc_html__('Event Location ', $themename),
		'std' 		=> 'Event Location ',
		'type' 		=> 'text',
	);
	$options[] = array(
		'name' 		=> esc_html__('Event Venue Gallery', $themename),
		'id' 		=> $shortname . "_dem_evt_gallery",
		'desc' 		=> esc_html__('Event Venue Gallery', $themename),
		'std' 		=> 'Event Venue Gallery',
		'type' 		=> 'text',
	);

	$options[] = array(
		'name' 		=> esc_html__('Share event', $themename),
		'id' 		=> $shortname . "_dem_evt_share",
		'desc' 		=> esc_html__('Share event', $themename),
		'std' 		=> 'Share event',
		'type' 		=> 'text',
	);

	$options[] = array(
		'name' 		=> esc_html__('Booking/Inquiry Form Title', $themename),
		'id' 		=> $shortname . "_dem_evt_tickets",
		'desc' 		=> esc_html__('Get Tickets/Inquiry ', $themename),
		'std' 		=> 'Get Tickets',
		'type' 		=> 'text',
	);

	$options[] = array(
		'name' 		=> esc_html__('Remaining Tickets', $themename),
		'id' 		=> $shortname . "_dem_evt_rm_tickets",
		'desc' 		=> esc_html__('Remaining Tickets', $themename),
		'std' 		=> 'Remaining Tickets',
		'type' 		=> 'text',
	);

	$options[] = array(
		'name' 		=> esc_html__('Booking/Inquiry Button Text', $themename),
		'id' 		=> $shortname . "_dem_evt_btn",
		'desc' 		=> esc_html__('Pay with PayPal/Submit', $themename),
		'std' 		=> 'Pay with PayPal',
		'type' 		=> 'text',
	);

	$options[] = array(
		'name' 		=> esc_html__('Start', $themename),
		'id' 		=> $shortname . "_dem_evt_start",
		'desc' 		=> esc_html__('Start', $themename),
		'std' 		=> 'Start',
		'type' 		=> 'text',
	);

	$options[] = array(
		'name' 		=> esc_html__('End', $themename),
		'id' 		=> $shortname . "_dem_evt_end",
		'desc' 		=> esc_html__('End', $themename),
		'std' 		=> 'End',
		'type' 		=> 'text',
	);

	$options[] = array(
		'name' 		=> esc_html__('Cost', $themename),
		'id' 		=> $shortname . "_dem_evt_cost",
		'desc' 		=> esc_html__('Cost', $themename),
		'std' 		=> 'Cost',
		'type' 		=> 'text',
	);

	$options[] = array(
		'name' 		=> esc_html__('Categories', $themename),
		'id' 		=> $shortname . "_dem_evt_categories",
		'desc' 		=> esc_html__('Categories', $themename),
		'std' 		=> 'Categories',
		'type' 		=> 'text',
	);
	$options[] = array(
		'name' 		=> esc_html__('Tags', $themename),
		'id' 		=> $shortname . "_dem_evt_tags",
		'desc' 		=> esc_html__('Tags', $themename),
		'std' 		=> 'Tags',
		'type' 		=> 'text',
	);

	$options[] = array(
		'name' 		=> esc_html__('Organizer Name', $themename),
		'id' 		=> $shortname . "_dem_evt_organizername",
		'desc' 		=> esc_html__('Organizer Name', $themename),
		'std' 		=> 'Organizer Name',
		'type' 		=> 'text',
	);

	$options[] = array(
		'name' 		=> esc_html__('Email', $themename),
		'id' 		=> $shortname . "_dem_evt_email",
		'desc' 		=> esc_html__('Email', $themename),
		'std' 		=> 'Email',
		'type' 		=> 'text',
	);

	$options[] = array(
		'name' 		=> esc_html__('Address', $themename),
		'id' 		=> $shortname . "_dem_evt_address",
		'desc' 		=> esc_html__('Address', $themename),
		'std' 		=> 'Address',
		'type' 		=> 'text',
	);

	$options[] = array(
		'name' 		=> esc_html__('Phone No.', $themename),
		'id' 		=> $shortname . "_dem_evt_phoneno",
		'desc' 		=> esc_html__('Phone No.', $themename),
		'std' 		=> 'Phone No.',
		'type' 		=> 'text',
	);

	$options[] = array(
		'name' 		=> esc_html__('Website', $themename),
		'id' 		=> $shortname . "_dem_evt_website",
		'desc' 		=> esc_html__('Website', $themename),
		'std' 		=> 'Website',
		'type' 		=> 'text',
	);
	$options[] = array(
		'name' => esc_html__('Event All Styles & Detail Page Labels', $themename),
		'desc' => '',
		"type" => "callback_function",
		"function_name" => 'dem_blank',
	);
	$options[] = array(
		'name' 		=> esc_html__('To', $themename),
		'id' 		=> $shortname . "_dem_evt_to",
		'desc' 		=> esc_html__('to', $themename),
		'std' 		=> 'to',
		'type' 		=> 'text',
	);
	$options[] = array(
		'name' 		=> esc_html__('At', $themename),
		'id' 		=> $shortname . "_dem_evt_at",
		'desc' 		=> esc_html__('at', $themename),
		'std' 		=> 'at',
		'type' 		=> 'text',
	);
	$options[] = array(
		'name' 		=> esc_html__('on', $themename),
		'id' 		=> $shortname . "_dem_evt_on",
		'desc' 		=> esc_html__('on', $themename),
		'std' 		=> 'on',
		'type' 		=> 'text',
	);
	$options[] = array(
		'name' => esc_html__('Order Fail/Success Message Labels', $themename),
		'desc' => '',
		"type" => "callback_function",
		"function_name" => 'dem_blank',
	);
	$options[] = array(
		'name' 		=> esc_html__('Fully Booked Message', $themename),
		'id' 		=> $shortname . "_dem_evt_fully_booked_msg",
		'desc' 		=> esc_html__('Default is This Event is fully booked.Please contact to website Owner', $themename),
		'std' 		=> 'This Event is fully booked.Please contact to website Owner',
		'type' 		=> 'text',
	);
	$options[] = array(
		'name' 		=> esc_html__('Event Expired Message', $themename),
		'id' 		=> $shortname . "_dem_evt_expired_msg",
		'desc' 		=> esc_html__('Default is This Event is Expired.Please contact to website Owner', $themename),
		'std' 		=> 'This Event is Expired.Please contact to website Owner',
		'type' 		=> 'text',
	);
	$options[] = array(
		'name' 		=> esc_html__('Order Success Message', $themename),
		'id' 		=> $shortname . "_dem_evt_suc_msg",
		'desc' 		=> esc_html__('Default is Your Booking Order Placed Successfully!', $themename),
		'std' 		=> 'Your Booking Order Placed Successfully!',
		'type' 		=> 'text',
	);
	$options[] = array(
		'name' 		=> esc_html__('Order Fail Message', $themename),
		'id' 		=> $shortname . "_dem_evt_fail_msg",
		'desc' 		=> esc_html__('Default is Your Booking Order Placed Fail!', $themename),
		'std' 		=> 'Your Booking Order Placed Fail!',
		'type' 		=> 'text',
	);
	$options[] = array(
		'name' 		=> esc_html__('Inquiry Success Message', $themename),
		'id' 		=> $shortname . "_dem_evt_inq_suc_msg",
		'desc' 		=> esc_html__('Default is Your Inquiry Submitted Successfully!', $themename),
		'std' 		=> 'Your Inquiry Submitted Successfully!',
		'type' 		=> 'text',
	);
	$options[] = array(
		'name' 		=> esc_html__('Inquiry Fail Message', $themename),
		'id' 		=> $shortname . "_dem_evt_inq_fail_msg",
		'desc' 		=> esc_html__('Default is Your Inquiry Is Fail!', $themename),
		'std' 		=> 'Your Inquiry Is Fail!',
		'type' 		=> 'text',
	);
	$options[] = array(
		'name' => esc_html__('Booking/Inquiry Form Labels', $themename),
		'desc' => '',
		"type" => "callback_function",
		"function_name" => 'dem_blank',
	);
	$options[] = array(
		'name' 		=> esc_html__('Form Label/Placeholder : Name', $themename),
		'id' 		=> $shortname . "_dem_frm_name",
		'desc' 		=> esc_html__('Default is Name', $themename),
		'std' 		=> 'Name',
		'type' 		=> 'text',
	);
	$options[] = array(
		'name' 		=> esc_html__('Form Label/Placeholder : Email Address', $themename),
		'id' 		=> $shortname . "_dem_frm_emailaddress",
		'desc' 		=> esc_html__('Default is Email Address', $themename),
		'std' 		=> 'Email Address',
		'type' 		=> 'text',
	);
	$options[] = array(
		'name' 		=> esc_html__('Form Label/Placeholder : Telephone no', $themename),
		'id' 		=> $shortname . "_dem_frm_telno",
		'desc' 		=> esc_html__('Default is Telephone no', $themename),
		'std' 		=> 'Telephone no',
		'type' 		=> 'text',
	);
	$options[] = array(
		'name' 		=> esc_html__('Form Label/Placeholder : Number of Tickets', $themename),
		'id' 		=> $shortname . "_dem_frm_no_of_tickets",
		'desc' 		=> esc_html__('Default is Number of Tickets', $themename),
		'std' 		=> 'Number of Tickets',
		'type' 		=> 'text',
	);
	$options[] = array(
		'name' 		=> esc_html__('Form Label/Placeholder : Ticket Price', $themename),
		'id' 		=> $shortname . "_dem_frm_price_tickets",
		'desc' 		=> esc_html__('Default is Ticket Price', $themename),
		'std' 		=> 'Ticket Price',
		'type' 		=> 'text',
	);
	$options[] = array(
		'name' => esc_html__('General Labels', $themename),
		'desc' => '',
		"type" => "callback_function",
		"function_name" => 'dem_blank',
	);
	$options[] = array(
		'name' 		=> esc_html__('No Events Found Message', $themename),
		'id' 		=> $shortname . "_dem_no_result",
		'desc' 		=> esc_html__('Default is Sorry, no events were found.', $themename),
		'std' 		=> 'Sorry, no events were found.',
		'type' 		=> 'text',
	);
	$options[] = array(
		'name' => esc_html__('Filter Option Labels', $themename),
		'desc' => '',
		"type" => "callback_function",
		"function_name" => 'dem_blank',
	);
	$options[] = array(
		'name' 		=> esc_html__('All Categories', $themename),
		'id' 		=> $shortname . "_dem_filter_cat_op",
		'desc' 		=> esc_html__('Default All Categories', $themename),
		'std' 		=> 'All Categories',
		'type' 		=> 'text',
	);
	$options[] = array(
		'name' 		=> esc_html__('All Events', $themename),
		'id' 		=> $shortname . "_dem_filter_cat_evt_op",
		'desc' 		=> esc_html__('Default All Events', $themename),
		'std' 		=> 'All Events',
		'type' 		=> 'text',
	);
	$options[] = array(
		'name' 		=> esc_html__('Today', $themename),
		'id' 		=> $shortname . "_dem_filter_today_op",
		'desc' 		=> esc_html__('Default Today', $themename),
		'std' 		=> 'Today',
		'type' 		=> 'text',
	);
	$options[] = array(
		'name' 		=> esc_html__('This Week', $themename),
		'id' 		=> $shortname . "_dem_filter_week_op",
		'desc' 		=> esc_html__('Default This Week', $themename),
		'std' 		=> 'This Week',
		'type' 		=> 'text',
	);
	$options[] = array(
		'name' 		=> esc_html__('This Month', $themename),
		'id' 		=> $shortname . "_dem_filter_month_op",
		'desc' 		=> esc_html__('Default This Month', $themename),
		'std' 		=> 'This Month',
		'type' 		=> 'text',
	);
	$options[] = array(
		'name' 		=> esc_html__('This Year', $themename),
		'id' 		=> $shortname . "_dem_filter_year_op",
		'desc' 		=> esc_html__('Default This Year', $themename),
		'std' 		=> 'This Year',
		'type' 		=> 'text',
	);
	$options[] = array(
		'name' 		=> esc_html__('Default Sorting', $themename),
		'id' 		=> $shortname . "_dem_filter_sort_op",
		'desc' 		=> esc_html__('Default Sorting', $themename),
		'std' 		=> 'Default Sorting',
		'type' 		=> 'text',
	);
	$options[] = array(
		'name' 		=> esc_html__('Date: new to old', $themename),
		'id' 		=> $shortname . "_dem_filter_dno_op",
		'desc' 		=> esc_html__('Date: new to old', $themename),
		'std' 		=> 'Date: new to old',
		'type' 		=> 'text',
	);
	$options[] = array(
		'name' 		=> esc_html__('Date: old to new', $themename),
		'id' 		=> $shortname . "_dem_filter_dow_op",
		'desc' 		=> esc_html__('Date: old to new', $themename),
		'std' 		=> 'Date: old to new',
		'type' 		=> 'text',
	);
	$options[] = array(
		'name' 		=> esc_html__('Title: a-z', $themename),
		'id' 		=> $shortname . "_dem_filter_taz_op",
		'desc' 		=> esc_html__('Title: a-z', $themename),
		'std' 		=> 'Title: a-z',
		'type' 		=> 'text',
	);
	$options[] = array(
		'name' 		=> esc_html__('Title: z-a', $themename),
		'id' 		=> $shortname . "_dem_filter_tza_op",
		'desc' 		=> esc_html__('Title: z-a', $themename),
		'std' 		=> 'Title: z-a',
		'type' 		=> 'text',
	);
	$options[] = array(
		'name' 		=> esc_html__('Event Start Date : DESC', $themename),
		'id' 		=> $shortname . "_dem_filter_sdd_op",
		'desc' 		=> esc_html__('Event Start Date : DESC', $themename),
		'std' 		=> 'Event Start Date : DESC',
		'type' 		=> 'text',
	);
	$options[] = array(
		'name' 		=> esc_html__('Event Start Date : ASC', $themename),
		'id' 		=> $shortname . "_dem_filter_sda_op",
		'desc' 		=> esc_html__('Event Start Date : ASC', $themename),
		'std' 		=> 'Event Start Date : ASC',
		'type' 		=> 'text',
	);
	$options[] = array(
		'name' 		=> esc_html__('Random', $themename),
		'id' 		=> $shortname . "_dem_filter_ran_op",
		'desc' 		=> esc_html__('Random', $themename),
		'std' 		=> 'Random',
		'type' 		=> 'text',
	);
	$options[] = array(
		'name' 		=> esc_html__('Reset', $themename),
		'id' 		=> $shortname . "_dem_filter_reset_op",
		'desc' 		=> esc_html__('Reset', $themename),
		'std' 		=> 'Reset',
		'type' 		=> 'text',
	);
	$options[] = array(
		'name' 		=> esc_html__('Showing all results', $themename),
		'id' 		=> $shortname . "_dem_filter_sa_result_op",
		'desc' 		=> esc_html__('Showing all results', $themename),
		'std' 		=> 'Showing all {totalcount} results',
		'type' 		=> 'text',
	);
	$options[] = array(
		'name' => esc_html__('Hide All Above Labels', $themename),
		'desc' => '',
		"type" => "callback_function",
		"function_name" => 'dem_blank',
	);
	$options[] = array(
		'name' 		=> esc_html__('Hide All Above Labels For Work Multiple Languages Label', $themename),
		'id' 		=> $shortname . "_dem_multi_lan",
		'desc' 		=> esc_html__('Default is off', $themename),
		'std' => 'off',
		"type" => "checkbox"
	);
	$options[] = array(
		"name" => "dem_tab_labels",
		"type" => "subcontent-end",);
		
/************* End : Label Setting *****************/
/************* Start : Shortcode Setting *****************/
	$options[] = array(
		"name" => "dem_shortcodes",
		"type" => "subcontent-start",);

	$options[] = array(
		'name' => '',
		'desc' => '',
		"type" => "callback_function",
		"function_name" => 'dem_detail_shortcode_note'
	);
	$options[] = array(
		"name" => "dem_shortcodes",
		"type" => "subcontent-end",);

/************* End : Shortcode Setting *****************/
	$options[] = array(
		"name" => "wrap-dem",
		"type" => "contenttab-wrapend",);
}

function dem_allowed_html() {
	$allowed_tags = array(
		'a' => array(
			'class' => array(),
			'href'  => array(),
			'rel'   => array(),
			'title' => array(),
		),
		'br' => array(),
		'b' => array(),
		'h1' => array(),
		'style' => array(),
		'img' => array(
			'alt'    => array(),
			'class'  => array(),
			'height' => array(),
			'src'    => array(),
			'width'  => array(),
		),
		'p' => array(
			'class' => array(),
		),
	);
	
	return $allowed_tags;
}

function dem_detail_shortcode_note(){
	$dem_allowedhtml = dem_allowed_html();
	echo wp_kses( '<h1>How to Use below Shortcodes in custom style of Detail Page.</h1>', $dem_allowedhtml );
	echo wp_kses( '<p>Please use below shortcode on Code Module OR Text Module OR Any Editor.<br/><br/>
		<b style="color: #ff0b0b;">Note : These shortcode only for event detail page</b><br/>
		Use This Shortcode to display Start Date : <b> [DP_Single_Event_Start_Date dem_start_date_format="F d, Y"] </b><br/>
		Use This Shortcode to display End Date : <b> [DP_Single_Event_End_Date dem_end_date_format="F d, Y"] </b><br/>
		Use This Shortcode to display Start Time : <b> [DP_Single_Event_Start_Time] </b><br/>
		Use This Shortcode to display End Time : <b> [DP_Single_Event_End_Time] </b><br/>
		Use This Shortcode to display Event Categorys : <b> [DP_Single_Event_Category] </b><br/>
		Use This Shortcode to display Tags : <b> [DP_Single_Event_Tag] </b><br/>
		Use This Shortcode to display Organizer Name : <b> [DP_Single_Event_Organizer_Name] </b><br/>
		Use This Shortcode to display Email Address : <b> [DP_Single_Event_Email_Address] </b><br/>
		Use This Shortcode to display Venue Address : <b> [DP_Single_Event_Venue_Address] </b><br/>
		Use This Shortcode to display Phone Number : <b> [DP_Single_Event_Phone_Number] </b><br/>
		Use This Shortcode to display Event Website : <b> [DP_Single_Event_Website] </b><br/>
		Use This Shortcode to display Event Price : <b> [DP_Single_Event_Price] </b><br/>
		Use This Shortcode to display Remaining Ticket : <b> [DP_Single_Remaining_Ticket] </b><br/>
		Use This Shortcode to display Social Icons : <b> [DP_Single_Social_Icon] </b><br/>
		Use This Shortcode to display Event Gallery : <b> [DP_Single_Event_Gallery gallery_column="4"] use gallery_column = 3 OR 4 OR 5 Column.Default is 4 Column.</b><br/>
		Use This Shortcode to display Event Map : <b> [DP_Single_Event_Map_Address] </b><br/>
		Use This Shortcode to display Booking Form : <b> [DP_Single_Booking_Form] </b><br/><style>#dem_shortcodes h1{font-size: 30px;font-weight: bold;margin-bottom: 25px;}#dem_shortcodes .et-epanel-box .et-box-content { width: 100% !important; }#dem_shortcodes p {line-height: 35px;font-size: 18px;}#dem_shortcodes img{width:80%;border:2px  solid #dedede;margin-bottom:25px;}</style><br/>
		Example<br/>
		<img src="'.DEM_PLUGIN_URL. '/assets/images/Shortcode1.png"><br/><br/><img src="'.DEM_PLUGIN_URL. '/assets/images/Shortcode2.png" ><br/><br/><img src="'.DEM_PLUGIN_URL. '/assets/images/Shortcode3.png"  >',$dem_allowedhtml );
}
function dem_blank(){echo '';}
function dem_grid_note(){
	$dem_allowedhtml = dem_allowed_html();
	echo wp_kses( '<h1>How to Use Grid View Shortcode</h1>', $dem_allowedhtml);
	echo wp_kses( '<p>Please use below shortcode on Code Module,Text Module,Default Wordpress Editor or any other editor<br/><br/>
		Grid View : <b> [DP_Grid_View_Event dem_post_per_page="No of Events to Display" dem_event_view_style="style1/style2/style3" dem_show_pagination="on/off" dem_show_upcoming_events="on/off" dem_event_by_category= "add category id here,you can add comma for multiple ids" dem_event_by_tag="add tag id here,you can add comma for multiple ids" dem_show_past_events="on/off"] </b>', $dem_allowedhtml);
}
function dem_list_note(){
	$dem_allowedhtml = dem_allowed_html();
	echo wp_kses( '<h1>How to Use List View Shortcode</h1>',$dem_allowedhtml );
	echo wp_kses( '<p>Please use below shortcode on Code Module,Text Module,Default Wordpress Editor or any other editor<br/><br/>
		List View : <b> [DP_List_View_Event dem_post_per_page="No of Events to Display" dem_event_view_style="style1/style2/style3" dem_show_pagination="on/off" dem_show_upcoming_events="on/off" dem_event_by_category= "add category id here,you can add comma for multiple ids" dem_event_by_tag="add tag id here,you can add comma for multiple ids" dem_show_past_events="on/off"] </b>', $dem_allowedhtml );
}
function dem_slider_note(){
	$dem_allowedhtml = dem_allowed_html();
	echo wp_kses( '<h1>How to Use Slider View Shortcode</h1>', $dem_allowedhtml );
	echo wp_kses( '<p>Please use below shortcode on Code Module,Text Module,Default Wordpress Editor or any other editor<br/><br/>
		Slider View : <b> [DP_Slider_View_Event dem_no_of_events="No of Events to Display" dem_event_view_style="style1/style2/style3" dem_show_upcoming_events="on/off" dem_event_by_category= "add category id here,you can add comma for multiple ids" dem_event_by_tag="add tag id here,you can add comma for multiple ids" dem_show_past_events="on/off"] </b>', $dem_allowedhtml);
}