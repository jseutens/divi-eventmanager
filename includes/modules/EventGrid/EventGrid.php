<?php
class DPEVENT_Grid extends ET_Builder_Module {
	public $slug       = 'dpevent_grid';
	public $vb_support = 'on';
	protected $module_credits = array(
		'module_uri' => 'https://divi-professional.com/product/divi-event-manager-plugin/',
		'author'     => 'Divi Professional',
		'author_uri' => 'https://divi-professional.com/',
	);
	public function init() {
		$this->name = esc_html__( 'DP Event Grid', 'dpevent' );
		$this->main_css_element = '%%order_class%%';
		$this->icon_path        = plugin_dir_path( __FILE__ ). 'dem.svg';
	}
	function get_settings_modal_toggles() {
		return array(
			'general' => array(
				'toggles' => array(
					'main_content' 		=> esc_html__('General Settings', 'dpevent'),
					'tagcat_setting' 	=> esc_html__('Tag/Category Settings', 'dpevent'),
					'display_setting' 	=> esc_html__('Display On/Off', 'dpevent'),
				),
			),
			'advanced' => array(
				'toggles' => array(
					'dem_color_setting'          => array(
						'title'    		 => esc_html__( 'Style Color Settings', 'dpevent' ),
					),   
				),
			),
		);
	}

	function get_advanced_fields_config() {
		return array(
			'fonts' => array(
				'header' => array(
							'label' 	=> esc_html__('Event Title', 'dpevent'),
							'css' 		=> array(
										'main' 			=> "%%order_class%% .dem_grid_title",
										'important' 	=> 'all',
							),
							'font_size' => array(
										'default' => '20px',
							),
							'line_height' => array(
										'default' => '1.3em',
							),
							'header_level' => array(
										'default' => 'h3',
										'computed_affects' => array('__dem_grid',),
							),
				),  
				'dem_address_fonts' => array(
							'label' 	   => esc_html__('Event Address', 'dpevent'),
							'css' 		   => array(
											'main' 			=> "%%order_class%% .dem_grid_venue,
																%%order_class%% .dem_grid_style2_event_date_time_venue,
																%%order_class%% .dem_grid_style3_venue strong",
																
											'text_align' 	=> "%%order_class%% .dem_grid_venue,
																%%order_class%% .dem_grid_style2_event_date_time_venue,
																%%order_class%% .dem_grid_style3_venue",
											'important' 	=> 'all',
							),
							'font_size' 	=> array(
											'default' 		=> '15px',
							),
				), 
				'dem_date_fonts' => array(
								'label' 	=> esc_html__('Event Date', 'dpevent'),
								'css' 		=> array(
											'main' 			=> "%%order_class%% .dem_grid_style1 div.dem_grid_main_content .dem-event-date .dem-event-day,
																%%order_class%% .dem_grid_style1 div.dem_grid_main_content .dem-event-date .dem-event-month,
																%%order_class%% .dem_grid_style1 div.dem_grid_main_content .dem-event-date .dem-event-time,
																%%order_class%% .dem_grid_style3 .dem_column_grid_view .dem_grid_style3_date_city_day .dem_grid_style3_date_month,
																%%order_class%% .dem_grid_style3 .dem_column_grid_view .dem_grid_style3_date_city_day .dem_grid_style3_city,
																%%order_class%% .dem_grid_style3 .dem_column_grid_view .dem_grid_style3_date_city_day .dem_grid_style3_day 
											",
											'text_align' 	=> "%%order_class%% .dem_grid_style1 div.dem_grid_main_content .dem-event-date .dem-event-day,
																 %%order_class%% .dem_grid_style1 div.dem_grid_main_content .dem-event-date .dem-event-month,
																 %%order_class%% .dem_grid_style1 div.dem_grid_main_content .dem-event-date .dem-event-time,
																 %%order_class%% .dem_grid_style3 .dem_column_grid_view .dem_grid_style3_date_city_day",
											'important' => 'all',
								),
								'font_size' => array(
											'default' => '15px',
								)
				), 
				'dem_description_name_fonts' => array(
								'label' 	=> esc_html__('Event Description', 'dpevent'),
								'css' 		=> array(
												'main' 		 	=> "%%order_class%% .dem_grid_style2_event_text ,
																	%%order_class%% .dem_grid_style1 .dem_grid_event_text ,
																	%%order_class%% .dem_grid_style3 .dem_grid_style3_event_text",
												'text_align' 	=> "%%order_class%% .dem_grid_style2_event_text,
																	%%order_class%% .dem_grid_style1 .dem_grid_event_text ,
																	%%order_class%% .dem_grid_style3 .dem_grid_style3_event_text",
												'important' 	=> 'all',
								),
								'font_size' => array(
											  'default' => '15px',
								)
				),       
			),
			'margin_padding' => array(
								'css' => array(
									'padding' 	=> "%%order_class%% .dem_column_grid_view",
									'margin' 	=> "%%order_class%% .et_pb_column",
									'important' => 'all',
								),
			),
			'borders'               => array(
				'default' => array(
					'css' => array(
						'main' => array(
							'border_radii'  => "%%order_class%% .et_pb_column",
							'border_styles' => "%%order_class%% .et_pb_column",
						),
					),
				),
			),
			'box_shadow'            => array(
				'default' => array(
					'css' => array(
						'main'    => '%%order_class%% .et_pb_column',
						'hover'   => '%%order_class%% .et_pb_column:hover',
					),
				),
			),
			'background' => array(
					'css' => array(
						'main'		 => '%%order_class%% .et_pb_column',
						'important'  => 'all',
					),
					'use_background_video' => false,   
					'use_background_image' => false,             
			),
			'text' 			 => false,
			'filters'        => false,
			'scroll_effects' => false,
			'link_options'   => false,
			'transform'		 => false,
		);
	}

	public function get_fields() {
		$fields = [];
		$fields = $this->dem_grid_get_general_fields($fields);
		$fields = $this->dem_grid_get_display_tag_cat_fields($fields);
        $fields = $this->dem_grid_get_display_fields($fields);
		$fields = $this->dem_grid_get_custom_color_fields($fields);
		return $fields;
	}
	public function dem_include_event_category(){
			$terms = get_terms( array(
				'taxonomy' => 'event_category',
				'hide_empty' => false,
			) );
			$terms_content = array();
			$terms_content['all'] = esc_html__('All', 'dpevent');
			$count = count($terms);
			if ( $count > 0 ){
				foreach($terms as $testival){
					$terms_content[$testival->term_id] = $testival->name;
				}
			}
			return $terms_content;
	}
	public function dem_grid_get_general_fields($fields) {

		$fields['dem_grid_select_style'] = array(
			'label' 			=> esc_html__('Select Style', 'dpevent'),
			'type' 				=> 'select',
			'option_category' 	=> 'basic_option',
								'options' => array(
									'style1' => esc_html__('Grid Style1', 'dpevent'),
									'style2' => esc_html__('Grid Style2', 'dpevent'),
									'style3' => esc_html__('Grid Style3', 'dpevent'),                
								),
			'default' 			=> 'style1',
			'toggle_slug'		=> 'main_content',
			'description' 		=> esc_html__('Here you can select style of event grid.', 'dpevent'),
			'computed_affects'  => array('__dem_grid',),
		);
		$fields['dem_grid_column'] = array(
			'label' 			=> esc_html__('Select Column Layout', 'dpevent'),
			'type' 				=> 'select',
			'options' 			=> array(
									'col2' => esc_html__('2 Column', 'dpevent'),
									'col3' => esc_html__('3 Column', 'dpevent'),
									'col4' => esc_html__('4 Column', 'dpevent'),
								),
			'option_category' 	=> 'configuration',
			'description' 		=> esc_html__('Choose column layout of event.', 'dpevent'),
			'toggle_slug' 		=> 'main_content',
			'default' 			=> 'col3',
			'computed_affects'  => array('__dem_grid',),
		);
		
		$fields['dem_grid_display_number_of_event'] = array(
			'label' 			=> esc_html__('Display Number Of Event', 'dpevent'),
			'type' 				=> 'text',
			'option_category' 	=> 'configuration',
			'description' 		=> esc_html__("Here Display number of event per page", 'dpevent'),
			'default' 			=> 6,
			'toggle_slug' 		=> 'main_content',
			'computed_affects' 	=> array('__dem_grid',),
		);
		$fields['dem_orderby'] = array(
			'label' 			=> esc_html__('Order By', 'dpevent'),
			'type' 				=> 'select',
			'option_category' 	=> 'configuration',
			'options' 			=> array(
									'date_desc' => esc_html__('Date: new to old', 'dpevent'),
									'date_asc' => esc_html__('Date: old to new', 'dpevent'),
									'title_asc' => esc_html__('Title: a-z', 'dpevent'),
									'title_desc' => esc_html__('Title: z-a', 'dpevent'),
									'event_start_desc'	=> esc_html__( 'Event Start Date : DESC', 'dpevent' ),
									'event_start_asc' 	=> esc_html__( 'Event Start Date : ASC', 'dpevent' ),
									'rand' => esc_html__('Random', 'dpevent'),
								),
			'default_on_front' 	=> 'date_asc',
			'description' 		=> esc_html__('Here you can adjust the order of event.', 'dpevent'),
			'toggle_slug' 		=> 'main_content',
			'computed_affects' 	=> array('__dem_grid',),
		);
		$fields['dem_time_format'] = array(
			'label' 			=> esc_html__('Time Format', 'dpevent'),
			'type' 				=> 'select',
			'option_category' 	=> 'configuration',
			'options' 			=> array(
									'twhr' => esc_html__('12 Hours', 'dpevent'),
									'tfhr' => esc_html__('24 Hours', 'dpevent'),
								),
			'default_on_front' 	=> 'twhr',
			'description' 		=> esc_html__('Here you can adjust event Time Format.', 'dpevent'),
			'toggle_slug' 		=> 'main_content',
			'computed_affects' 	=> array('__dem_grid',),
		);
		$fields['dem_link_type'] = array(
			'label' 			=> esc_html__('Event Detail Page Link Type', 'dpevent'),
			'type' 				=> 'select',
			'option_category' 	=> 'configuration',
			'options' 			=> array(
									'default' => esc_html__('Default', 'dpevent'),
									'customlink' => esc_html__('Custom Link', 'dpevent'),
								),
			'default_on_front' 	=> 'default',
			'description' 		=> esc_html__('Here you can adjust Event Detail Page Link Type.', 'dpevent'),
			'toggle_slug' 		=> 'main_content',
			'computed_affects' 	=> array('__dem_grid',),
		);
		$fields['dem_show_event'] = array(
			'label' 			=> esc_html__('Show Events', 'dpevent'),
			'type' 				=> 'select',
			'option_category' 	=> 'configuration',
			'options' 			=> array(
									'default' => esc_html__('Default', 'dpevent'),
									'show_upcomming_events' => esc_html__('Show Upcomming Events', 'dpevent'),
									'show_past_events' => esc_html__('Show Past Events', 'dpevent'),
								),
			'default_on_front' 	=> 'default',
			'description' 		=> esc_html__('Here you can display event by past or upcomming.', 'dpevent'),
			'toggle_slug' 		=> 'main_content',
			'computed_affects' 	=> array('__dem_grid',),
		);
		$fields['use_current_loop']  = array(
				'label'            => esc_html__( 'Use Current Event Category Page[This is for only Event Category Page]', 'dpevent' ),
				'type'             => 'yes_no_button',
				'option_category'  => 'configuration',
				'options'          => array(
					'on'  => et_builder_i18n( 'Yes', 'dpevent' ),
					'off' => et_builder_i18n( 'No', 'dpevent' ),
				),
				'description'      => esc_html__( 'Only include events for the current category page. Useful on category archive pages. For example let\'s say you used this module on a Theme Builder layout that is enabled for events categories. Selecting the event category above and enabling this option would show only events that are on sale when viewing events categories.', 'dpevent' ),
				'toggle_slug'      => 'main_content',
				'default'          => 'off',
				'show_if'          => array(
					'function.isTBLayout' => 'on',
				),
				'computed_affects' => array(
					'__dem_grid',
				),
			);
		return $fields;
	}
	public function dem_grid_get_display_tag_cat_fields($fields){
		$fields['dem_grid_show_filter_options'] = array(
			'label' 			=> esc_html__('Show Filter Options', 'dpevent'),
			'type' 				=> 'select',
			'option_category' 	=> 'configuration',
			'options' 			=> array(
									'default' => esc_html__('Default[No Filter Options]', 'dpevent'),
									'dem_display_category_filter' => esc_html__('Display Events Category Filter', 'dpevent'),
									'dem_display_dropdown_filter' => esc_html__('DropDown Filter With Various Options', 'dpevent'),
								),
			'default_on_front' 	=> 'default',
			'description' 		=> esc_html__('Here you can display events filter options.', 'dpevent'),
			'toggle_slug' 		=> 'main_content',
			'computed_affects' 	=> array('__dem_grid',),
			'show_if'          => array(
				'use_current_loop' => 'off',
			),
		);
		$fields['dem_grid_no_filter_options'] = array(
			'label' 			=> esc_html__('Without Filter Options Show Today/Week/Month/Year Events', 'dpevent'),
			'type' 				=> 'select',
			'option_category' 	=> 'configuration',
			'options' 			=> array(
									'default' => esc_html__('Default', 'dpevent'),
									'dem_w_today' => esc_html__('Display Today Events', 'dpevent'),
									'dem_w_week' => esc_html__('Display This Week Events', 'dpevent'),
									'dem_w_month' => esc_html__('Display This Month Events', 'dpevent'),
									'dem_w_year' => esc_html__('Display This Year Events', 'dpevent'),
								),
			'default_on_front' 	=> 'default',
			'show_if'			=> array('dem_grid_show_filter_options' => 'default'),
			'description' 		=> esc_html__('Here you can display  Without Filter Options Show Today/Week/Month/Year Events.', 'dpevent'),
			'toggle_slug' 		=> 'main_content',
			'computed_affects' 	=> array('__dem_grid',),
		);
		$fields['dem_show_event_filter_result'] = array(
			'label' 			=> esc_html__('DropDown Filter Result Show Events', 'dpevent'),
			'type' 				=> 'select',
			'option_category' 	=> 'configuration',
			'options' 			=> array(
									'result_default' => esc_html__('Default', 'dpevent'),
									'result_show_upcomming_events' => esc_html__('Only Show Upcomming Events', 'dpevent'),
									'result_show_past_events' => esc_html__('Only Show Past Events', 'dpevent'),
								),
			'default_on_front' 	=> 'default',
			'show_if'			=> array('dem_grid_show_filter_options' => 'dem_display_dropdown_filter'),
			'description' 		=> esc_html__('Here you can display event by past or upcomming.', 'dpevent'),
			'toggle_slug' 		=> 'main_content',
			'computed_affects' 	=> array('__dem_grid',),
		);
		$fields['hide_category_filter'] = array(
			'label' 			=> esc_html__('Hide DropDown Category Filter', 'dpevent'),
			'type'			=> 'yes_no_button',
			'option_category'	=> 'configuration',
			'options'		=> array(
				'off' 			=> esc_html__( 'No', 'dpevent' ),
				'on'  			=> esc_html__( 'Yes', 'dpevent' ),
			),
			'default'		=> 'off',
			'toggle_slug'	=> 'main_content',
			'show_if'		=> array('dem_grid_show_filter_options' => 'dem_display_dropdown_filter'),
			'description'	=> esc_html__( 'This setting will turn on and off the Hide DropDown Category Filter.', 'dpevent' ),
			'computed_affects' 	=> array('__dem_grid',),
		);
		$fields['hide_all_today_week_month_filter'] = array(
			'label' 			=> esc_html__('Hide Today/Week/Month DropDown Filter', 'dpevent'),
			'type'			=> 'yes_no_button',
			'option_category'	=> 'configuration',
			'options'		=> array(
				'off' 			=> esc_html__( 'No', 'dpevent' ),
				'on'  			=> esc_html__( 'Yes', 'dpevent' ),
			),
			'default'		=> 'off',
			'toggle_slug'	=> 'main_content',
			'show_if'		=> array('dem_grid_show_filter_options' => 'dem_display_dropdown_filter'),
			'description'	=> esc_html__( 'This setting will turn on and off the Hide Today/Week/Month DropDown Filter', 'dpevent' ),
			'computed_affects' 	=> array('__dem_grid',),
		);
		$fields['hide_sorting_filter'] = array(
			'label' 			=> esc_html__('Hide Sorting DropDown Filter', 'dpevent'),
			'type'			=> 'yes_no_button',
			'option_category'	=> 'configuration',
			'options'		=> array(
				'off' 			=> esc_html__( 'No', 'dpevent' ),
				'on'  			=> esc_html__( 'Yes', 'dpevent' ),
			),
			'default'		=> 'off',
			'toggle_slug'	=> 'main_content',
			'show_if'		=> array('dem_grid_show_filter_options' => 'dem_display_dropdown_filter'),
			'description'	=> esc_html__( 'This setting will turn on and off the Hide Sorting DropDown Filter', 'dpevent' ),
			'computed_affects' 	=> array('__dem_grid',),
		);
		$fields['dem_grid_category'] = array(
			'label' 			=> esc_html__('Display Events Category On Filter/Display Events By Category', 'dpevent'),
			'type' 				=> 'select',
			'option_category' 	=> 'basic_option',
								'options' => array(
									'all' => esc_html__('All', 'dpevent'),
									'specificcategory' => esc_html__('Specific Event Category', 'dpevent'),
								),
			'default' 			=> 'all',
			'default_on_front'  => 'all',
			'description' 		=> esc_html__('Here you can select event category.', 'dpevent'),
			'toggle_slug' 		=> 'tagcat_setting',
			'computed_affects'  => array('__dem_grid',),
			'show_if'          => array(
				'use_current_loop' => 'off',
			),
		);
		$fields['include_categories'] = array(
			'label' 			=> esc_html__('Specific Event Categories', 'dpevent'),
			'type'              => 'categories',
			'option_category' 	=> 'basic_option',
			'show_if'			=> array('dem_grid_category' => 'specificcategory'),
			'renderer_options'  => array(
									'use_terms' => true,
									'term_name' => 'event_category',
								),
			'description' 		=> esc_html__('Choose which categories you would like to include in the event.', 'dpevent'),
			'toggle_slug'		=> 'tagcat_setting',
			'computed_affects'  => array('__dem_grid',),
		);		
		$fields['dem_grid_tag'] = array(
			'label' 			=> esc_html__('Display Events By Tags', 'dpevent'),
			'type' 				=> 'select',
			'option_category' 	=> 'basic_option',
			'options' 			=> array(
									'all' => esc_html__('All', 'dpevent'),
									'specifictag' => esc_html__('Specific Event Tag', 'dpevent'),
								),
			'default'	 		=> 'all',
			'default_on_front' 	=> 'all',
			'description' 		=> esc_html__('Here you can select the event tags.', 'dpevent'),
			'toggle_slug' 		=> 'tagcat_setting',
			'computed_affects'  => array('__dem_grid',),
			'show_if'          => array(
				'use_current_loop' => 'off',
			),
		);
		$fields['include_tags'] = array(
			'label' 			=> esc_html__('Specific Tags', 'dpevent'),
			'type'              => 'categories',
			'option_category' 	=> 'basic_option',
			'show_if' 			=> array('dem_grid_tag' => 'specifictag',),
			'renderer_options'  => array(
									'use_terms' => true,
									'term_name' => 'event_tag',
								),
			'description' 		=> esc_html__('Choose which tags you would like to include in the events.', 'dpevent'),
			'toggle_slug'		=> 'tagcat_setting',
			'computed_affects'  => array('__dem_grid',),
		);
		$fields['dem_grid_default_category_filter']	= array(
					'label'			=> esc_html__( 'Choose Default Filter Category', 'dpevent' ),
					'type'			=> 'select',
					'option_category'	=> 'configuration',
					'options'		=> $this->dem_include_event_category(),
					'default'		=> 'all',
					'toggle_slug'	=> 'tagcat_setting',
					'show_if'		=> array('dem_grid_show_filter_options' => 'dem_display_category_filter'),
					'description'	=> esc_html__( 'Here you can select the  Default Category Filter.', 'dpevent' ),
					'computed_affects' 	=> array('__dem_grid',),
		);
		$fields['dem_grid_category_orderby'] 	= array(
				'label'			=> esc_html__( 'Category Filter List Order By', 'dpevent' ),
				'type'			=> 'select',
				'option_category'	=> 'configuration',
				'options'			=> array(
					'id_desc'  		=> esc_html__( 'ID: High to Low', 'dpevent' ),
					'id_asc'   		=> esc_html__( 'ID: Low to High', 'dpevent' ),
					'name_asc'  	=> esc_html__( 'Title: a-z', 'dpevent' ),
					'name_desc' 	=> esc_html__( 'Title: z-a', 'dpevent' ),
					'slug_desc' 	=> esc_html__( 'Slug : z-a', 'dpevent' ),
					'slug_asc' 		=> esc_html__( 'Slug : a-z', 'dpevent' ),
					'count'       	=> esc_html__( 'Count', 'dpevent' ),
				),
				'default'		=> 'id_desc',
				'show_if'		=> array('dem_grid_show_filter_options' => 'dem_display_category_filter'),
				'toggle_slug'	=> 'tagcat_setting',
				'description'	=> esc_html__( 'Here you can adjust Category Filter List Order.', 'dpevent' ),
				'computed_affects' 	=> array('__dem_grid',),
		);
		$fields['dem_grid_hide_all_cat']	=array(
					'label'			=> esc_html__( 'Hide "All" Text in Filter', 'dpevent' ),
					'type'			=> 'yes_no_button',
					'option_category'	=> 'configuration',
					'options'		=> array(
						'off' 			=> esc_html__( 'No', 'dpevent' ),
						'on'  			=> esc_html__( 'Yes', 'dpevent' ),
					),
					'default'		=> 'off',
					'toggle_slug'	=> 'tagcat_setting',
					'show_if'		=> array('dem_grid_show_filter_options' => 'dem_display_category_filter'),
					'description'	=> esc_html__( 'This setting will turn on and off the Hide All Option in Filter.', 'dpevent' ),
					'computed_affects' 	=> array('__dem_grid',),
		);	
		$fields['dem_grid_filter_all_label'] 	= array(
				'label'			=> esc_html__( ' "ALL" Text Label In Filter Option', 'dpevent' ),
				'type'			=> 'text',
				'option_category' => 'configuration',
				'show_if'		=> array('dem_grid_show_filter_options' => 'dem_display_category_filter','dem_grid_hide_all_cat' => 'off'),
				'default'		=> 'All',
				'toggle_slug'	=> 'tagcat_setting',
				'description'	=> esc_html__( 'ALL Text Filter Label', 'dpevent' ),
				'computed_affects' 	=> array('__dem_grid',),
		);
		
		return $fields;
	}
	public function dem_grid_get_display_fields($fields){
		$fields['dem_grid_view_pagination'] = array(
			'label' 			=> esc_html__('Show Pagination', 'dpevent'),
			'type' 				=> 'yes_no_button',
			'option_category' 	=> 'configuration',
			'options' 			=> array(
									'on' => esc_html__('Yes', 'dpevent'),
									'off' => esc_html__('No', 'dpevent'),
								),
			'default' 			=> 'on',
			'default_on_front' 	=> 'on',
			'description' 		=> esc_html__('Here you can select the display Pagination or not.', 'dpevent'),
			'toggle_slug' 		=> 'display_setting',
			'computed_affects' 	=> array('__dem_grid',),
		);
		$fields['dem_grid_show_read_more'] = array(
			'label' 			=> esc_html__('Show Read More Button', 'dpevent'),
			'type' 				=> 'yes_no_button',
			'option_category' 	=> 'configuration',
			'options' 			=> array(
									'on' => esc_html__('Yes', 'dpevent'),
									'off' => esc_html__('No', 'dpevent'),
								),         
			'default_on_front' 	=> 'on',
			'show_if' 			=> array('dem_grid_select_style' => 'style2'),
			'description' 		=> esc_html__('Turn the read more button on or off.', 'dpevent'),
			'toggle_slug'		=> 'display_setting',
			'computed_affects'  => array('__dem_grid',),
		);
		$fields['dem_grid_readmore_txt'] = array(
			'label' 			=> esc_html__('Read More Button Text', 'dpevent'),
			'type' 				=> 'text',
			'option_category'	=> 'configuration',
			'description' 		=> esc_html__('Enter Here Read More Button Text.', 'dpevent'),
			'show_if' 			=> array('dem_grid_show_read_more' => 'on','dem_grid_select_style' => 'style2'),
			'default' 			=> 'Read More',
			'toggle_slug' 		=> 'display_setting',
			'computed_affects'  => array('__dem_grid',),
		);
		return $fields;
	}
	public function dem_grid_get_custom_color_fields($fields){
		$fields['dem_filter_row_bk_color'] = array(
			'label' 				=> esc_html__('Filter Row Background Color', 'dpevent'),
			'type'					=> 'color-alpha',
			'show_if'				=> array('dem_grid_show_filter_options' => 'dem_display_dropdown_filter'),
			'custom_color' 			=> true,
			'hover' 				=> "tabs",
			'toggle_slug' 			=> 'dem_color_setting',
			'tab_slug'    			=> 'advanced',
		);
		$fields['dem_filter_row_text_color'] = array(
			'label' 				=> esc_html__('Filter Result Text/Reset Text Color', 'dpevent'),
			'type'					=> 'color-alpha',
			'show_if'				=> array('dem_grid_show_filter_options' => 'dem_display_dropdown_filter'),
			'custom_color' 			=> true,
			'hover' 				=> "tabs",
			'toggle_slug' 			=> 'dem_color_setting',
			'tab_slug'    			=> 'advanced',
		);
		$fields['dem_filter_color'] = array(
			'label' 				=> esc_html__('Filter Button Text Color', 'dpevent'),
			'type'					=> 'color-alpha',
			'show_if' 				=> array('dem_grid_show_filter_options' => 'dem_display_category_filter'),
			'custom_color' 			=> true,
			'hover' 				=> "tabs",
			'toggle_slug' 			=> 'dem_color_setting',
			'tab_slug'    			=> 'advanced',
		);
		$fields['dem_filter_bg_color'] = array(
			'label' 				=> esc_html__('Filter Button Background Color', 'dpevent'),
			'type' 					=> 'color-alpha',
			'show_if' 				=> array('dem_grid_show_filter_options' => 'dem_display_category_filter'),
			'custom_color' 			=> true,
			 'hover' 				=> "tabs",
			'toggle_slug' 			=> 'dem_color_setting',
			'tab_slug'    			=> 'advanced',
		);
		$fields['dem_filter_active_color'] = array(
			'label' 				=> esc_html__('Filter Button Active Text Color', 'dpevent'),
			'type' 					=> 'color-alpha',
			'show_if' 				=> array('dem_grid_show_filter_options' => 'dem_display_category_filter'),
			'custom_color' 			=> true,
			'hover' 				=> "tabs",
			'toggle_slug' 			=> 'dem_color_setting',
			'tab_slug'    			=> 'advanced',
		);
		$fields['dem_filter_active_bg_color'] = array(
			'label' 				=> esc_html__('Filter Button Active Background Color', 'dpevent'),
			'type' 					=> 'color-alpha',
			'show_if' 				=> array('dem_grid_show_filter_options' => 'dem_display_category_filter'),
			'custom_color' 			=> true,
			'hover' 				=> "tabs",
			'toggle_slug' 			=> 'dem_color_setting',
			'tab_slug'    			=> 'advanced',
		);
		$fields['dem_pagination_color'] = array(
			'label' 				=> esc_html__('Pagination Text Color', 'dpevent'),
			'type'					=> 'color-alpha',
			'show_if' 				=> array('dem_grid_view_pagination' => 'on'),
			'custom_color' 			=> true,
			'hover' 				=> "tabs",
			'toggle_slug' 			=> 'dem_color_setting',
			'tab_slug'    			=> 'advanced',
		);
		$fields['dem_pagination_bg_color'] = array(
			'label' 				=> esc_html__('Pagination Background Color', 'dpevent'),
			'type' 					=> 'color-alpha',
			'show_if' 				=> array('dem_grid_view_pagination' => 'on'),
			'custom_color' 			=> true,
			 'hover' 				=> "tabs",
			'toggle_slug' 			=> 'dem_color_setting',
			'tab_slug'    			=> 'advanced',
		);
		$fields['dem_pagination_active_color'] = array(
			'label' 				=> esc_html__('Pagination Active Text Color', 'dpevent'),
			'type' 					=> 'color-alpha',
			'show_if' 				=> array('dem_grid_view_pagination' => 'on'),
			'custom_color' 			=> true,
			'hover' 				=> "tabs",
			'toggle_slug' 			=> 'dem_color_setting',
			'tab_slug'    			=> 'advanced',
		);
		$fields['dem_pagination_active_bg_color'] = array(
			'label' 				=> esc_html__('Pagination Active Background Color', 'dpevent'),
			'type' 					=> 'color-alpha',
			'show_if'				=> array('dem_grid_view_pagination' => 'on'),
			'custom_color' 			=> true,
			'hover' 				=> "tabs",
			'toggle_slug' 			=> 'dem_color_setting',
			'tab_slug'    			=> 'advanced',
		);
		$fields['style2_dem_readmore_bg_color'] = array(
			'label' 				=> esc_html__('Style2 Read More Background Color', 'dpevent'),
			'type' 					=> 'color-alpha',
			'show_if' 				=> array('dem_grid_select_style' => 'style2'),
			'custom_color' 			=> true,
			'hover' 				=> "tabs",
			'toggle_slug' 			=> 'dem_color_setting',
			'tab_slug'    			=> 'advanced',
		);
		$fields['style2_ticket_readmore_text_color'] = array(
			'label' 				=> esc_html__('Style2 Read More Text Color', 'dpevent'),
			'type' 					=> 'color-alpha',
			'show_if' 				=> array('dem_grid_select_style' => 'style2'),
			'custom_color' 			=> true,
			'hover' 				=> "tabs",
			'toggle_slug' 			=> 'dem_color_setting',
			'tab_slug'    			=> 'advanced',
		);
		$fields['style2_ticket_start_text_color'] = array(
			'label' 				=> esc_html__('Style2 Ticket Start From Text Color', 'dpevent'),
			'type' 					=> 'color-alpha',
			'show_if' 				=> array('dem_grid_select_style' => 'style2'),
			'custom_color' 			=> true,
			'hover' 				=> "tabs",
			'toggle_slug' 			=> 'dem_color_setting',
			'tab_slug'    			=> 'advanced',
		);
		$fields['dem_hidden_field_plugin_url'] = array(
			'label' 			=> esc_html__('no label', 'dpevent'),
			'type' 				=> 'hidden',
			'default' 			=> DEM_PLUGIN_URL,
			'toggle_slug' 		=> 'dem_color_setting',
			'tab_slug'    		=> 'advanced',
		);
		$fields['__dem_grid'] = array(
			'type' 					=> 'computed',
			'computed_callback' 	=> array('DPEVENT_Grid', 'dem_grid_compute'),
			'computed_depends_on' 	=> array(
				'header_level',
				'dem_grid_select_style',
				'dem_grid_category',           
				'include_categories',           
				'dem_grid_tag',           
				'include_tags',           
				'dem_grid_column',           
				'dem_grid_display_number_of_event',           
				'dem_orderby',           
				'dem_show_event',                    
				'dem_grid_view_pagination',           
				'dem_grid_readmore_txt',           
				'dem_grid_show_read_more',           
				'dem_time_format', 
				'dem_grid_show_filter_options', 
				'dem_grid_default_category_filter',  
				'dem_grid_category_orderby',  
				'dem_grid_filter_all_label',  
				'dem_grid_hide_all_cat',     
				'dem_show_event_filter_result',
				'hide_category_filter',
				'hide_all_today_week_month_filter',
				'hide_sorting_filter',
				'dem_grid_no_filter_options',
				'dem_link_type',
				'use_current_loop',
				      
			),
		);
		return $fields;
	}
	
	public function render($attrs, $content = null, $render_slug) {
		$dem_themename 					= dem_theme_name();
		$header_level 					  = esc_attr( $this->props['header_level'] );
		$dem_select_style 				  = esc_attr( $this->props['dem_grid_select_style'] );
		$dem_grid_category 				  = esc_attr( $this->props['dem_grid_category'] );
		$include_categories 			  = esc_attr( $this->props['include_categories'] );
		$include_tags 					  = esc_attr( $this->props['include_tags'] );
		$dem_grid_tag 					  = esc_attr( $this->props['dem_grid_tag'] );
		$dem_grid_column 				  = esc_attr( $this->props['dem_grid_column'] );
		$dem_grid_display_number_of_event = esc_attr( $this->props['dem_grid_display_number_of_event'] );
		$dem_orderby 					  = esc_attr( $this->props['dem_orderby'] );
		$dem_time_format 				  = esc_attr( $this->props['dem_time_format'] );
		$dem_show_event 				  = esc_attr( $this->props['dem_show_event'] );
		$dem_hidden_field_plugin_url	  = esc_url( $this->props['dem_hidden_field_plugin_url'] );
		$dem_grid_view_pagination		  = esc_attr( $this->props['dem_grid_view_pagination'] );
		$dem_grid_show_read_more		  = esc_attr( $this->props['dem_grid_show_read_more'] );
		$dem_grid_readmore_txt		 	  = esc_attr( $this->props['dem_grid_readmore_txt'] );
		$dem_grid_show_filter_options	  = esc_attr( $this->props['dem_grid_show_filter_options'] );
		$dem_grid_default_category_filter = esc_attr( $this->props['dem_grid_default_category_filter'] );
		$dem_grid_category_orderby	  	  = esc_attr( $this->props['dem_grid_category_orderby'] );
		$dem_grid_filter_all_label	  	  = esc_attr( $this->props['dem_grid_filter_all_label'] );
		$dem_grid_hide_all_cat	  	  	  = esc_attr( $this->props['dem_grid_hide_all_cat'] );
		$dem_show_event_filter_result	  = esc_attr( $this->props['dem_show_event_filter_result'] );
		$hide_category_filter	  	  	  = esc_attr( $this->props['hide_category_filter'] );
		$hide_all_today_week_month_filter = esc_attr( $this->props['hide_all_today_week_month_filter'] );
		$hide_sorting_filter	  	  	  = esc_attr( $this->props['hide_sorting_filter'] );
		$dem_grid_no_filter_options	  	  = esc_attr( $this->props['dem_grid_no_filter_options'] );
		$dem_link_type	  	  			  = esc_attr( $this->props['dem_link_type'] );
		$use_current_loop                 = esc_attr( $this->props['use_current_loop'] );
		
		
		$divi_dem_multi_lan 			= et_get_option($dem_themename.'_dem_multi_lan','off');
		if ( $divi_dem_multi_lan == 'on'){
			$divi_dem_ticket_start_from 	= __('Ticket Start From', 'dpevent'); 
			$dem_evt_to 					= __('to', 'dpevent'); 
			$dem_evt_at						= __('at', 'dpevent'); 
			$dem_evt_on 					= __('on', 'dpevent'); 
			$divi_dem_no_result 			= __('Sorry, no events were found.', 'dpevent'); 
		}else{
			$divi_dem_ticket_start_from 	= et_get_option($dem_themename.'_dem_ticket_start_from','Ticket Start From'); 
			$dem_evt_to 					= et_get_option($dem_themename.'_dem_evt_to','to'); 
			$dem_evt_at						= et_get_option($dem_themename.'_dem_evt_at','at'); 
			$dem_evt_on 					= et_get_option($dem_themename.'_dem_evt_on','on'); 
			$divi_dem_no_result 			= et_get_option($dem_themename.'_dem_no_result','Sorry, no events were found.'); 
		}
		
		 if ( is_archive() ){
			 global $wp;
			 $current_url = home_url( add_query_arg( array(), $wp->request ) );
		 }else{
			 $current_url = get_permalink();
		 }
			 
		if ( !is_admin() ) {
			wp_enqueue_script( 'dem_equalheight');
			if( $dem_grid_view_pagination == 'on' ){
				wp_enqueue_style('dem_event_pagination_css');
			}
		}

		$this->dem_grid_style_color_css( $render_slug );
		$this->dem_grid_style_pagination_css( $render_slug );

        //event per page 
		if ( $dem_grid_display_number_of_event == '' ) {
			$dem_args = array('posts_per_page' => -1);
		} else {
			$dem_args = array('posts_per_page' => (int) $dem_grid_display_number_of_event);
		}
		// pagination
		if ( get_query_var('paged') ) {
			$paged = (int) get_query_var('paged');
		} elseif ( get_query_var('page') ) {
			$paged = (int) get_query_var('page');
		} else {
			$paged = 1;
		}
		$dem_args['paged'] = $paged;
		// Tag & Category Query
		// Default View
		if ( $dem_grid_show_filter_options == 'default' ) {
		
			if ( $dem_grid_tag != 'all' && $dem_grid_category != 'all' ) {	
				
				if ( !empty( $include_tags ) && !empty( $include_categories ) ) {
					
					$dem_args['tax_query'] = array(
						'relation' => 'AND',
						array(
							'taxonomy' => 'event_tag',
							'field' => 'term_id',
							'terms' => explode(",", $include_tags),
							'operator' => 'IN'
						),
						array(
							'taxonomy' => 'event_category',
							'field' => 'term_id',
							'terms' => explode(",", $include_categories),
							'operator' => 'IN'
						),
					);
					
				}
				
				if ( empty( $include_tags ) && !empty( $include_categories ) ) {
					$dem_args['tax_query'] = array(
						array(
							'taxonomy' => 'event_category',
							'field' => 'term_id',
							'terms' => explode(",", $include_categories),
							'operator' => 'IN'
						),
					);
				}
				
				if ( !empty( $include_tags) && empty( $include_categories) ) {
					$dem_args['tax_query'] = array(
						array(
							'taxonomy' => 'event_tag',
							'field' => 'term_id',
							'terms' => explode(",", $include_tags),
							'operator' => 'IN'
						),
					);
				}
				
			} else if ( $dem_grid_tag != 'all' && $dem_grid_category == 'all' ) {
			
				if ( !empty( $include_tags ) ) {
					$dem_args['tax_query'] = array(
						array(
							'taxonomy' => 'event_tag',
							'field' => 'term_id',
							'terms' => explode(",", $include_tags),
							'operator' => 'IN'
						)
					);
				}
				
			} else if ( $dem_grid_category != 'all' && $dem_grid_tag == 'all' ) {
			
				if ( !empty( $include_categories ) ) {
					$dem_args['tax_query'] = array(
						array(
							'taxonomy' => 'event_category',
							'field' => 'term_id',
							'terms' => explode(",", $include_categories),
							'operator' => 'IN'
						)
					);
				}
				
			} else {
			}
		
		}// end if Default View
		
		// Category Filter View
		//if ( $dem_grid_show_filter_options != 'dem_display_dropdown_filter' ) {
			// Order & Orderby
			if ( 'date_desc' !== $dem_orderby ) {
				switch ( $dem_orderby ) {
						case 'date_asc' :
							$dem_args['orderby'] = 'date';
							$dem_args['order'] = 'ASC';
							break;
						case 'title_asc' :
							$dem_args['orderby'] = 'title';
							$dem_args['order'] = 'ASC';
							break;
						case 'title_desc' :
							$dem_args['orderby'] = 'title';
							$dem_args['order'] = 'DESC';
							break;
						case 'rand' :
							$dem_args['orderby'] = 'rand';
							break;
						case 'event_start_desc' :
							$dem_args['orderby'] = 'meta_value_num';
							$dem_args['order'] = 'DESC';
							$dem_args['meta_key'] = 'dp_event_start_date';
							break;
						case 'event_start_asc' :
							$dem_args['orderby'] = 'meta_value_num';
							$dem_args['order'] = 'ASC';
							$dem_args['meta_key'] = 'dp_event_start_date';
							break;
					}
			} else {
				$dem_args['orderby'] = 'date';
				$dem_args['order'] = 'DESC';
			}
		//}// end Category Filter View
		
		$dem_args['post_type'] = 'dp_events';
		
		if ( $dem_grid_show_filter_options == 'default' || $dem_grid_show_filter_options == 'dem_display_category_filter' ) {
			//show upcomming events
			if( $dem_show_event == "show_upcomming_events" ){
				$dem_current_date = gmdate('d-m-Y');
				$dem_args['meta_query']  = array(
					array(
						'key' 		=> 'dp_event_end_date',
						'value' 	=>  strtotime($dem_current_date),
						'compare' 	=> '>=', 
					),
				);	
			}else if( $dem_show_event == "show_past_events" ){ //show past events
				$dem_current_date = gmdate('d-m-Y');
				$dem_args['meta_query']  = array(
					array(
						'key' 		=> 'dp_event_end_date',
						'value' 	=>  strtotime($dem_current_date),
						'compare' 	=> '<=', 
					),
	
				);
			}else{}
		}
		if ( $dem_grid_show_filter_options == 'default' && $dem_grid_no_filter_options != 'default' ) {
				// Today Events
				if( $dem_grid_no_filter_options == 'dem_w_today')
				{
					$date_today= gmdate('d-m-Y');
					$dem_args['meta_key'] = 'dp_event_start_date';
					$dem_args['meta_query'] = array(
							'relation' => 'AND',
							array(
								'key' => 'dp_event_end_date',
								'value' => strtotime($date_today),
								'compare' => '>='
							),
							array(
								'key' => 'dp_event_start_date',
								'value' => strtotime($date_today),
								'compare' => '<'
							)
					);
				}
				// This Month Events
				if( $dem_grid_no_filter_options =='dem_w_month')
				{
					$start_date_thismonth = gmdate('01-m-Y',strtotime('this month'));
					$end_date_thismonth = gmdate('t-m-Y',strtotime('this month'));
					$dem_args['meta_key'] = 'dp_event_start_date';
					$dem_current_date = gmdate('d-m-Y');
					if ( $dem_show_event == 'show_upcomming_events' ){
						$dem_args['meta_query'] = array(
							'relation' => 'AND',
							array(
								'key' => 'dp_event_end_date',
								'value' => strtotime($start_date_thismonth),
								'compare' => '>='
							),
							array(
								'key' => 'dp_event_start_date',
								'value' => strtotime($end_date_thismonth),
								'compare' => '<='
							),
							array(
								'key' 		=> 'dp_event_end_date',
								'value' 	=>  strtotime($dem_current_date),
								'compare' 	=> '>=', 
							)
						);
					}else if ( $dem_show_event == 'show_past_events' ){
						$dem_args['meta_query'] = array(
							'relation' => 'AND',
							array(
								'key' => 'dp_event_end_date',
								'value' => strtotime($start_date_thismonth),
								'compare' => '>='
							),
							array(
								'key' => 'dp_event_start_date',
								'value' => strtotime($end_date_thismonth),
								'compare' => '<='
							),
							array(
								'key' 		=> 'dp_event_end_date',
								'value' 	=>  strtotime($dem_current_date),
								'compare' 	=> '<=', 
							)
						);
					}else{
							$dem_args['meta_query'] = array(
								'relation' => 'AND',
								array(
									'key' => 'dp_event_end_date',
									'value' => strtotime($start_date_thismonth),
									'compare' => '>='
								),
								array(
									'key' => 'dp_event_start_date',
									'value' => strtotime($end_date_thismonth),
									'compare' => '<='
								)
						    );
					}
				}
				// This Week Events
				if( $dem_grid_no_filter_options =='dem_w_week')
				{
					 $thisweek_day = gmdate('w');
					 $start_date_thisweek = gmdate("d-m-Y",strtotime('monday this week'));
					 $end_date_thisweek = gmdate("d-m-Y",strtotime("sunday this week"));
					 //$start_date_thisweek = gmdate('d-m-Y', strtotime('-'. $thisweek_day . ' days'));
					 //$end_date_thisweek = gmdate('d-m-Y', strtotime('+' . (6 - $thisweek_day) . ' days'));
					 $dem_args['meta_key'] = 'dp_event_start_date';
					 $dem_current_date = gmdate('d-m-Y');
					
					if ( $dem_show_event == 'show_upcomming_events' ){
						$dem_args['meta_query'] = array(
							'relation' => 'AND',
							array(
								'key' => 'dp_event_end_date',
								'value' => strtotime($start_date_thisweek),
								'compare' => '>='
							),
							array(
								'key' => 'dp_event_start_date',
								'value' => strtotime($end_date_thisweek),
								'compare' => '<='
							),
							array(
								'key' 		=> 'dp_event_end_date',
								'value' 	=>  strtotime($dem_current_date),
								'compare' 	=> '>=', 
							)
						);
					}else if ( $dem_show_event == 'show_past_events' ){
						$dem_args['meta_query'] = array(
							'relation' => 'AND',
							array(
								'key' => 'dp_event_end_date',
								'value' => strtotime($start_date_thisweek),
								'compare' => '>='
							),
							array(
								'key' => 'dp_event_start_date',
								'value' => strtotime($end_date_thisweek),
								'compare' => '<='
							),
							array(
								'key' 		=> 'dp_event_end_date',
								'value' 	=>  strtotime($dem_current_date),
								'compare' 	=> '<=', 
							)
						);
					}else{
						$dem_args['meta_query'] = array(
							'relation' => 'AND',
							array(
								'key' => 'dp_event_end_date',
								'value' => strtotime($start_date_thisweek),
								'compare' => '>='
							),
							array(
								'key' => 'dp_event_start_date',
								'value' => strtotime($end_date_thisweek),
								'compare' => '<='
							)
						);
					}
				}
				// This Year Events
				if( $dem_grid_no_filter_options =='dem_w_year')
				{
					$start_date_thisyear = gmdate("01-01-Y", strtotime("this year"));
					$end_date_thisyear = gmdate("t-12-Y", strtotime($start_date_thisyear));
					$dem_args['meta_key'] = 'dp_event_start_date';
					$dem_current_date = gmdate('d-m-Y');
					if ( $dem_show_event == 'show_upcomming_events' ){
						$dem_args['meta_query'] = array(
							'relation' => 'AND',
							array(
								'key' => 'dp_event_end_date',
								'value' => strtotime($start_date_thisyear),
								'compare' => '>='
							),
							array(
								'key' => 'dp_event_start_date',
								'value' => strtotime($end_date_thisyear),
								'compare' => '<='
							),
							array(
								'key' 		=> 'dp_event_end_date',
								'value' 	=>  strtotime($dem_current_date),
								'compare' 	=> '>=', 
							)
						);
					}else if ( $dem_show_event == 'show_past_events' ){
						$dem_args['meta_query'] = array(
							'relation' => 'AND',
							array(
								'key' => 'dp_event_end_date',
								'value' => strtotime($start_date_thisyear),
								'compare' => '>='
							),
							array(
								'key' => 'dp_event_start_date',
								'value' => strtotime($end_date_thisyear),
								'compare' => '<='
							),
							array(
								'key' 		=> 'dp_event_end_date',
								'value' 	=>  strtotime($dem_current_date),
								'compare' 	=> '<=', 
							)
						);
					}else{
						$dem_args['meta_query'] = array(
							'relation' => 'AND',
							array(
								'key' => 'dp_event_end_date',
								'value' => strtotime($start_date_thisyear),
								'compare' => '>='
							),
							array(
								'key' => 'dp_event_start_date',
								'value' => strtotime($end_date_thisyear),
								'compare' => '<='
							)
						);
					}
				}
		}
		$dem_grid_output = '';
		// Category Filter View
		if ( $dem_grid_show_filter_options == 'dem_display_category_filter' ) {
			$dem_grid_nonce = wp_create_nonce( 'dem_grid_nonce' );
			if ( isset( $_GET['dem_wpnonce'] ) && !wp_verify_nonce( sanitize_key( $_GET['dem_wpnonce'] ), 'dem_grid_nonce' ) ) {
				 die( esc_html__( 'Security check', 'dpevent' ) ); 
			}
			if(isset($_GET["dem_cat"]) && is_numeric($_GET["dem_cat"]) && $_GET["dem_cat"]!='')
			{	
				$dem_cat = intval ($_GET["dem_cat"]);
				$dem_args['tax_query'] = array(
						array(
							'taxonomy' => 'event_category',
							'field' => 'term_id',
							'terms' => $dem_cat,
							'operator' => 'IN'
						),
				);
			}else if( isset($_GET["dem_cat"]) && $_GET["dem_cat"]== 'all'){
			}else if ( $dem_grid_default_category_filter != 'all' ){
				$dem_args['tax_query'] = array(
						array(
							'taxonomy' => 'event_category',
							'field' => 'term_id',
							'terms' => $dem_grid_default_category_filter,
							'operator' => 'IN'
						),
				);
			}else{}		
		    /*Category Filter Sorting Option*/
		   if ( 'id_desc' !== $dem_grid_category_orderby ) {
				switch( $dem_grid_category_orderby ) {
					case 'id_asc' :
						$dem_cat_orderby = 'id';
						$dem_cat_order = 'ASC';
						break;
					case 'name_asc' :
						$dem_cat_orderby = 'name';
						$dem_cat_order = 'ASC';
						break;
					case 'name_desc' :
						$dem_cat_orderby = 'name';
						$dem_cat_order = 'DESC';
						break;
					case 'count' :
						$dem_cat_orderby = 'count';
						break;
					case 'slug_desc' :
						$dem_cat_orderby = 'slug';
						$dem_cat_order = 'DESC';
						break;
					case 'slug_asc' :
						$dem_cat_orderby = 'slug';
						$dem_cat_order = 'ASC';
						break;
				}
			}else{
				$dem_cat_orderby = 'id';
				$dem_cat_order = 'DESC';
			}
			
		   $dem_event_category_all = get_terms( array(
				'taxonomy' 			=> 'event_category',
				'hide_empty'		=> false,
				'orderby'           => $dem_cat_orderby, 
	    		'order'             => $dem_cat_order,
			) );
			
			 $dem_grid_cat_active_class= '';
				 if ( $dem_grid_category == 'all'){
				 	 if(isset($_GET["dem_cat"]) && is_numeric($_GET["dem_cat"]) && $_GET["dem_cat"]!=''){
					 }else if( isset($_GET["dem_cat"]) && $_GET["dem_cat"]== 'all'){ $dem_grid_cat_active_class= 'active';
					 }else if ( $dem_grid_default_category_filter == 'all' ){ 
						 $dem_grid_cat_active_class= 'active';
					 }else{}
					$dem_grid_output .= '<ul class="dem_grid_category_filter_list" id="grid_filter">';
					if ( $dem_grid_hide_all_cat == 'off'){
						$dem_grid_output .= '<li><a href="'.esc_url($current_url).'?dem_cat=all&dem_wpnonce='.$dem_grid_nonce.'#grid_filter" class="et_smooth_scroll_disabled dem_grid_filter '.esc_attr($dem_grid_cat_active_class).' " data-filter=".all" ><span>'.esc_attr($dem_grid_filter_all_label).'</span></a></li>';
					}
					$dem_event_category_all_count = count($dem_event_category_all);
					if ( $dem_event_category_all_count > 0 ){
					foreach($dem_event_category_all as $dem_category_val){
							 $dem_grid_cat_active_class= '';
							 if(isset($_GET["dem_cat"]) && is_numeric($_GET["dem_cat"]) && $_GET["dem_cat"]!=''){
							 	if ( $_GET["dem_cat"] == $dem_category_val->term_id ){ $dem_grid_cat_active_class= 'active';}
							 }else if( isset($_GET["dem_cat"]) && $_GET["dem_cat"]== 'all'){
							 }else if ( $dem_grid_default_category_filter == $dem_category_val->term_id ){ 
							 	$dem_grid_cat_active_class= 'active';
							 }else{}
							$dem_grid_output .= '<li><a href="'.esc_url($current_url).'?dem_cat='.esc_attr($dem_category_val->term_id).'&dem_wpnonce='.$dem_grid_nonce.'#grid_filter" class="et_smooth_scroll_disabled dem_grid_filter '.esc_attr($dem_grid_cat_active_class).'" data-filter=".cat-'.esc_attr($dem_category_val->term_id).'" ><span>'.esc_attr($dem_category_val->name).'</span></a></li>';
						}
					}
					$dem_grid_output .= '</ul>';
				 }else{
					if ( $include_categories != '' ){
					     if(isset($_GET["dem_cat"]) && is_numeric($_GET["dem_cat"]) && $_GET["dem_cat"]!=''){
						 }else if( isset($_GET["dem_cat"]) && $_GET["dem_cat"]== 'all'){ $dem_grid_cat_active_class= 'active';
						 }else if ( $dem_grid_default_category_filter == 'all' ){ 
							 $dem_grid_cat_active_class= 'active';
						 }else{}
						$dem_grid_output .= '<ul class="dem_grid_category_filter_list" id="grid_filter">';
						if ( $dem_grid_hide_all_cat == 'off'){
							$dem_grid_output .= '<li><a href="'.esc_url($current_url).'?dem_cat=all&dem_wpnonce='.$dem_grid_nonce.'#grid_filter" class="dem_grid_filter et_smooth_scroll_disabled '.esc_attr($dem_grid_cat_active_class).'" data-filter=".all" ><span>'.esc_attr($dem_grid_filter_all_label).'</span></a></li>';
						}
						$dem_event_category_all_count = count($dem_event_category_all);
						if ( $dem_event_category_all_count > 0 ){
							foreach($dem_event_category_all as $dem_category_val){
							$dem_grid_cat_active_class= '';
								 if(isset($_GET["dem_cat"]) && is_numeric($_GET["dem_cat"]) && $_GET["dem_cat"]!=''){
									if ( $_GET["dem_cat"] == $dem_category_val->term_id ){ $dem_grid_cat_active_class= 'active';}
								 }else if( isset($_GET["dem_cat"]) && $_GET["dem_cat"]== 'all'){
								 }else if ( $dem_grid_default_category_filter == $dem_category_val->term_id ){ 
									$dem_grid_cat_active_class= 'active';
								 }else{}
								if  ( in_array( $dem_category_val->term_id,explode( ",", $include_categories) ) ){
									$dem_grid_output .= '<li><a href="'.esc_url($current_url).'?dem_cat='.esc_attr($dem_category_val->term_id).'&dem_wpnonce='.$dem_grid_nonce.'#grid_filter" class="et_smooth_scroll_disabled dem_grid_filter '.esc_attr($dem_grid_cat_active_class).'" data-filter=".cat-'.esc_attr($dem_category_val->term_id).'" ><span>'.esc_attr($dem_category_val->name).'</span></a></li>';
								}
							}
						}
						$dem_grid_output .= '</ul>';
					}
				}
		} // End Category Filter View
		
		// Dropdown Filter
		if ( $dem_grid_show_filter_options == 'dem_display_dropdown_filter' ) {
		
		 if ( isset( $_GET['dem_wpnonce'] ) && wp_verify_nonce( sanitize_key( $_GET['dem_wpnonce'] ), 'dem_grid_nonce' ) ) {
			if ( $hide_all_today_week_month_filter != 'on' ){
				// Today Events
				if(isset($_GET["dem_filter"]) && $_GET["dem_filter"]=='today')
				{
					$date_today= gmdate('d-m-Y');
					$dem_args['meta_key'] = 'dp_event_start_date';
					$dem_args['meta_query'] = array(
							'relation' => 'AND',
							array(
								'key' => 'dp_event_end_date',
								'value' => strtotime($date_today),
								'compare' => '>='
							),
							array(
								'key' => 'dp_event_start_date',
								'value' => strtotime($date_today),
								'compare' => '<'
							)
					);
				}
				// This Month Events
				if(isset($_GET["dem_filter"]) && $_GET["dem_filter"]=='thismonth')
				{
					$start_date_thismonth = gmdate('01-m-Y',strtotime('this month'));
					$end_date_thismonth = gmdate('t-m-Y',strtotime('this month'));
					$dem_args['meta_key'] = 'dp_event_start_date';
					$dem_current_date = gmdate('d-m-Y');
					if ( $dem_show_event_filter_result == 'result_show_upcomming_events' ){
						$dem_args['meta_query'] = array(
							'relation' => 'AND',
							array(
								'key' => 'dp_event_end_date',
								'value' => strtotime($start_date_thismonth),
								'compare' => '>='
							),
							array(
								'key' => 'dp_event_start_date',
								'value' => strtotime($end_date_thismonth),
								'compare' => '<='
							),
							array(
								'key' 		=> 'dp_event_end_date',
								'value' 	=>  strtotime($dem_current_date),
								'compare' 	=> '>=', 
							)
						);
					}else if ( $dem_show_event_filter_result == 'result_show_past_events' ){
						$dem_args['meta_query'] = array(
							'relation' => 'AND',
							array(
								'key' => 'dp_event_end_date',
								'value' => strtotime($start_date_thismonth),
								'compare' => '>='
							),
							array(
								'key' => 'dp_event_start_date',
								'value' => strtotime($end_date_thismonth),
								'compare' => '<='
							),
							array(
								'key' 		=> 'dp_event_end_date',
								'value' 	=>  strtotime($dem_current_date),
								'compare' 	=> '<=', 
							)
						);
					}else{
							$dem_args['meta_query'] = array(
								'relation' => 'AND',
								array(
									'key' => 'dp_event_end_date',
									'value' => strtotime($start_date_thismonth),
									'compare' => '>='
								),
								array(
									'key' => 'dp_event_start_date',
									'value' => strtotime($end_date_thismonth),
									'compare' => '<='
								)
						    );
					}
				}
				// This Week Events
				if(isset($_GET["dem_filter"]) && $_GET["dem_filter"]=='thisweek')
				{
					$thisweek_day = gmdate('w');
					//$start_date_thisweek = gmdate('d-m-Y', strtotime('-'. $thisweek_day . ' days'));
					//$end_date_thisweek = gmdate('d-m-Y', strtotime('+' . (6 - $thisweek_day) . ' days'));
					$start_date_thisweek = gmdate("d-m-Y",strtotime('monday this week'));
					 $end_date_thisweek = gmdate("d-m-Y",strtotime("sunday this week"));
					$dem_args['meta_key'] = 'dp_event_start_date';
					$dem_current_date = gmdate('d-m-Y');
					
					if ( $dem_show_event_filter_result == 'result_show_upcomming_events' ){
						$dem_args['meta_query'] = array(
							'relation' => 'AND',
							array(
								'key' => 'dp_event_end_date',
								'value' => strtotime($start_date_thisweek),
								'compare' => '>='
							),
							array(
								'key' => 'dp_event_start_date',
								'value' => strtotime($end_date_thisweek),
								'compare' => '<='
							),
							array(
								'key' 		=> 'dp_event_end_date',
								'value' 	=>  strtotime($dem_current_date),
								'compare' 	=> '>=', 
							)
						);
					}else if ( $dem_show_event_filter_result == 'result_show_past_events' ){
						$dem_args['meta_query'] = array(
							'relation' => 'AND',
							array(
								'key' => 'dp_event_end_date',
								'value' => strtotime($start_date_thisweek),
								'compare' => '>='
							),
							array(
								'key' => 'dp_event_start_date',
								'value' => strtotime($end_date_thisweek),
								'compare' => '<='
							),
							array(
								'key' 		=> 'dp_event_end_date',
								'value' 	=>  strtotime($dem_current_date),
								'compare' 	=> '<=', 
							)
						);
					}else{
						$dem_args['meta_query'] = array(
							'relation' => 'AND',
							array(
								'key' => 'dp_event_end_date',
								'value' => strtotime($start_date_thisweek),
								'compare' => '>='
							),
							array(
								'key' => 'dp_event_start_date',
								'value' => strtotime($end_date_thisweek),
								'compare' => '<='
							)
						);
					}
				}
				// This Year Events
				if(isset($_GET["dem_filter"]) && $_GET["dem_filter"]=='thisyear')
				{
					$start_date_thisyear = gmdate("01-01-Y", strtotime("this year"));
					$end_date_thisyear = gmdate("t-12-Y", strtotime($start_date_thisyear));
					$dem_args['meta_key'] = 'dp_event_start_date';
					$dem_current_date = gmdate('d-m-Y');
					if ( $dem_show_event_filter_result == 'result_show_upcomming_events' ){
						$dem_args['meta_query'] = array(
							'relation' => 'AND',
							array(
								'key' => 'dp_event_end_date',
								'value' => strtotime($start_date_thisyear),
								'compare' => '>='
							),
							array(
								'key' => 'dp_event_start_date',
								'value' => strtotime($end_date_thisyear),
								'compare' => '<='
							),
							array(
								'key' 		=> 'dp_event_end_date',
								'value' 	=>  strtotime($dem_current_date),
								'compare' 	=> '>=', 
							)
						);
					}else if ( $dem_show_event_filter_result == 'result_show_past_events' ){
						$dem_args['meta_query'] = array(
							'relation' => 'AND',
							array(
								'key' => 'dp_event_end_date',
								'value' => strtotime($start_date_thisyear),
								'compare' => '>='
							),
							array(
								'key' => 'dp_event_start_date',
								'value' => strtotime($end_date_thisyear),
								'compare' => '<='
							),
							array(
								'key' 		=> 'dp_event_end_date',
								'value' 	=>  strtotime($dem_current_date),
								'compare' 	=> '<=', 
							)
						);
					}else{
						$dem_args['meta_query'] = array(
							'relation' => 'AND',
							array(
								'key' => 'dp_event_end_date',
								'value' => strtotime($start_date_thisyear),
								'compare' => '>='
							),
							array(
								'key' => 'dp_event_start_date',
								'value' => strtotime($end_date_thisyear),
								'compare' => '<='
							)
						);
					}
				}
			}
			if ( $hide_sorting_filter != 'on' && $dem_grid_show_filter_options == 'dem_display_dropdown_filter' ){
				// Order & Orderby
				if ( isset($_GET["dem_sort"]) ){ $dem_orderby = sanitize_key($_GET["dem_sort"]);}
				if ( 'date_desc' !== $dem_orderby ) {
					switch ( $dem_orderby ) {
							case 'date_asc' :
								$dem_args['orderby'] = 'date';
								$dem_args['order'] = 'ASC';
								break;
							case 'title_asc' :
								$dem_args['orderby'] = 'title';
								$dem_args['order'] = 'ASC';
								break;
							case 'title_desc' :
								$dem_args['orderby'] = 'title';
								$dem_args['order'] = 'DESC';
								break;
							case 'rand' :
								$dem_args['orderby'] = 'rand';
								break;
							case 'event_start_desc' :
								$dem_args['orderby'] = 'meta_value_num';
								$dem_args['order'] = 'DESC';
								$dem_args['meta_key'] = 'dp_event_start_date';
								break;
							case 'event_start_asc' :
								$dem_args['orderby'] = 'meta_value_num';
								$dem_args['order'] = 'ASC';
								$dem_args['meta_key'] = 'dp_event_start_date';
								break;
						}
				} else {
					$dem_args['orderby'] = 'date';
					$dem_args['order'] = 'DESC';
				}
			}
			if ( $hide_category_filter != 'on' ){
				// event category filter
				if(isset($_GET["dem_cat"]) && is_numeric($_GET["dem_cat"]) && $_GET["dem_cat"]!='')
				{	
					$dem_cat = intval($_GET["dem_cat"]);
					$dem_args['tax_query'] = array(
							array(
								'taxonomy' => 'event_category',
								'field' => 'term_id',
								'terms' => $dem_cat,
								'operator' => 'IN'
							),
					);
				}
			}
			if ( $hide_all_today_week_month_filter != 'on' ){
				if( isset($_GET["dem_filter"]) && $_GET["dem_filter"]=='' ){
							//show upcomming events
							if( $dem_show_event_filter_result == 'result_show_upcomming_events' ){
								$dem_current_date = gmdate('d-m-Y');
								$dem_args['meta_query']  = array(
									array(
										'key' 		=> 'dp_event_end_date',
										'value' 	=>  strtotime($dem_current_date),
										'compare' 	=> '>=', 
									),
								);	
							}else if( $dem_show_event_filter_result == 'result_show_past_events' ){ //show past events
								$dem_current_date = gmdate('d-m-Y');
								$dem_args['meta_query']  = array(
									array(
										'key' 		=> 'dp_event_end_date',
										'value' 	=>  strtotime($dem_current_date),
										'compare' 	=> '<=', 
									),
								 );
							}else{}
				 }
			 }else{
			 	 //show upcomming events
				if( $dem_show_event_filter_result == 'result_show_upcomming_events' ){
					$dem_current_date = gmdate('d-m-Y');
					$dem_args['meta_query']  = array(
						array(
							'key' 		=> 'dp_event_end_date',
							'value' 	=>  strtotime($dem_current_date),
							'compare' 	=> '>=', 
						),
					);	
				}else if( $dem_show_event_filter_result == 'result_show_past_events' ){ //show past events
					$dem_current_date = gmdate('d-m-Y');
					$dem_args['meta_query']  = array(
						array(
							'key' 		=> 'dp_event_end_date',
							'value' 	=>  strtotime($dem_current_date),
							'compare' 	=> '<=', 
						),
					 );
				}else{}
			 }
		  }else{
		  	//show upcomming events
			if( $dem_show_event == "show_upcomming_events" ){
				$dem_current_date = gmdate('d-m-Y');
				$dem_args['meta_query']  = array(
					array(
						'key' 		=> 'dp_event_end_date',
						'value' 	=>  strtotime($dem_current_date),
						'compare' 	=> '>=', 
					),
				);	
			}else if( $dem_show_event == "show_past_events" ){ //show past events
				$dem_current_date = gmdate('d-m-Y');
				$dem_args['meta_query']  = array(
					array(
						'key' 		=> 'dp_event_end_date',
						'value' 	=>  strtotime($dem_current_date),
						'compare' 	=> '<=', 
					),
	
				);
			}else{}
		  }//nonce verify
		} // end Dropdown Filter
		//Query
		if ( $use_current_loop == 'on' && ( is_tax( 'event_category' ) || is_tax( 'event_tag' ) ) ) {
			if ( is_tax( 'event_category' ) ) { 
				$include_categories = (string) get_queried_object_id();
				$dem_args['tax_query'] = array(
						array(
							'taxonomy' => 'event_category',
							'field' => 'term_id',
							'terms' => explode(",", $include_categories),
							'operator' => 'IN'
						),
				);
			} else if ( is_tax( 'event_tag' ) ) {
				$include_tags =  (string) get_queried_object_id();
				$dem_args['tax_query'] = array(
						array(
							'taxonomy' => 'event_tag',
							'field' => 'term_id',
							'terms' => explode(",", $include_tags),
							'operator' => 'IN'
						),
				);
			} else  {}
		}
		$dem_grid_query = new WP_Query($dem_args);
		if ( $dem_grid_show_filter_options == 'dem_display_dropdown_filter' ) {
			if ( $divi_dem_multi_lan == 'on'){
				$dem_filter_cat_op 					= __('All Categories', 'dpevent' );
				$dem_filter_cat_evt_op 				= __('All Events', 'dpevent' );
				$dem_filter_today_op 				= __('Today', 'dpevent' );
				$dem_filter_week_op 				= __('This Week', 'dpevent' );
				$dem_filter_month_op 				= __('This Month', 'dpevent' );
				$dem_filter_year_op 				= __('This Year', 'dpevent' );
				$dem_filter_sort_op 				= __('Default Sorting', 'dpevent' ); 
				$dem_filter_dno_op 					= __('Date: new to old', 'dpevent' ); 
				$dem_filter_dow_op 					= __('Date: old to new', 'dpevent' ); 
				$dem_filter_taz_op 					= __('Title: a-z', 'dpevent' ); 
				$dem_filter_tza_op 					= __('Title: z-a', 'dpevent' ); 
				$dem_filter_sdd_op 					= __('Event Start Date : DESC', 'dpevent' ); 
				$dem_filter_sda_op 					= __('Event Start Date : ASC', 'dpevent' ); 
				$dem_filter_ran_op 					= __('Random', 'dpevent' ); 
				$dem_filter_reset_op 				= __('Reset', 'dpevent' );
				$dem_filter_sa_result_op 			= __('Showing all {totalcount} results', 'dpevent' );
			}else{
				$dem_filter_cat_op 					= et_get_option($dem_themename.'_dem_filter_cat_op','All Categories'); 
				$dem_filter_cat_evt_op 				= et_get_option($dem_themename.'_dem_filter_cat_evt_op','All Events'); 
				$dem_filter_today_op 				= et_get_option($dem_themename.'_dem_filter_today_op','Today'); 
				$dem_filter_week_op 				= et_get_option($dem_themename.'_dem_filter_week_op','This Week'); 
				$dem_filter_month_op 				= et_get_option($dem_themename.'_dem_filter_month_op','This Month'); 
				$dem_filter_year_op 				= et_get_option($dem_themename.'_dem_filter_year_op','This Year'); 
				$dem_filter_sort_op 				= et_get_option($dem_themename.'_dem_filter_sort_op','Default Sorting'); 
				$dem_filter_dno_op 					= et_get_option($dem_themename.'_dem_filter_dno_op','Date: new to old'); 
				$dem_filter_dow_op 					= et_get_option($dem_themename.'_dem_filter_dow_op','Date: old to new'); 
				$dem_filter_taz_op 					= et_get_option($dem_themename.'_dem_filter_taz_op','Title: a-z'); 
				$dem_filter_tza_op 					= et_get_option($dem_themename.'_dem_filter_tza_op','Title: z-a'); 
				$dem_filter_sdd_op 					= et_get_option($dem_themename.'_dem_filter_sdd_op','Event Start Date : DESC'); 
				$dem_filter_sda_op 					= et_get_option($dem_themename.'_dem_filter_sda_op','Event Start Date : ASC'); 
				$dem_filter_ran_op 					= et_get_option($dem_themename.'_dem_filter_ran_op','Random'); 
				$dem_filter_reset_op 				= et_get_option($dem_themename.'_dem_filter_reset_op','Reset'); 
				$dem_filter_sa_result_op 			= et_get_option($dem_themename.'_dem_filter_sa_result_op','Showing all {totalcount} results'); 
			}
			
			$dem_filter_sa_result_op_cnt		= str_replace('{totalcount}', $dem_grid_query->found_posts, $dem_filter_sa_result_op);
			$dem_grid_nonce = wp_create_nonce( 'dem_grid_nonce' );
			$dem_grid_output .= '<form method="get" class="dem_event_search_form" id="gridview">
									<div class="list_grid_row et_pb_gutters1 et_pb_row">
										<div class="list_grid_col et_pb_column et_pb_column_1_4">';
										//if ( isset($_GET['dem_sort']) || isset($_GET['dem_filter']) || isset($_GET['dem_cat']) ){
											$dem_grid_output .= '<p class="p_reset">'.__($dem_filter_sa_result_op_cnt,'dpevent').'</p>';
										// }
										$dem_grid_output .= '</div>
										<div class="et_pb_column et_pb_column_3_4">
											<div class="list_grid_filter_setting">';
										 if ( $hide_all_today_week_month_filter != 'on' ){
											$p_category_select_defaultview= (isset($_GET["dem_filter"]) && $_GET["dem_filter"] == "")? ' selected="selected" ' : '';
											$p_category_select_today = (isset($_GET["dem_filter"]) && $_GET["dem_filter"] == "today")? 'selected="selected"' : '';  
											$p_category_select_thisweek = (isset($_GET["dem_filter"]) && $_GET["dem_filter"] == "thisweek")? 'selected="selected"' : '';  
											$p_category_select_thismonth = (isset($_GET["dem_filter"]) && $_GET["dem_filter"] == "thismonth")? 'selected="selected"' : '';  
											$p_category_select_thisyear = (isset($_GET["dem_filter"]) && $_GET["dem_filter"] == "thisyear")? 'selected="selected"' : '';  
											$dem_grid_output .= '<select name="dem_filter" class="dem_v2_filter"  onchange="this.form.submit()">
													<option value="" '.esc_attr($p_category_select_defaultview).' >'.__($dem_filter_cat_evt_op,'dpevent').'</option>
													<option value="today" '.esc_attr($p_category_select_today).' >'.__($dem_filter_today_op,'dpevent').'</option>
													<option value="thisweek" '.esc_attr($p_category_select_thisweek).' >'.__($dem_filter_week_op,'dpevent').'</option>
													<option value="thismonth" '.esc_attr($p_category_select_thismonth).' >'.__($dem_filter_month_op,'dpevent').'</option>
													<option value="thisyear" '.esc_attr($p_category_select_thisyear).' >'.__($dem_filter_year_op,'dpevent').'</option>
												</select>';
										 }
										 if ( $hide_category_filter != 'on' ){
												if ( $dem_grid_category == 'all'){
													$event_cat_terms = get_terms('event_category', array('hide_empty' => '0'));   
												}else{
													$event_cat_terms = get_terms('event_category', array('hide_empty' => '0','include'=>$include_categories));
												}
												$dem_grid_output .= '<select name="dem_cat" class="dem_v2_filter"  onchange="this.form.submit()">
													<option value="">'.__($dem_filter_cat_op,'dpevent').'</option>';
													  foreach ( $event_cat_terms as $event_cat_term ):
													  $p_category_select = (isset($_GET['dem_cat']) && $_GET['dem_cat'] == $event_cat_term->term_id )? ' selected="selected" ' : '';
													  $dem_grid_output .= '<option value="'.esc_attr($event_cat_term->term_id).'" '.esc_attr($p_category_select).'>'.esc_attr($event_cat_term->name).'</option>'; 		
													  endforeach;
												$dem_grid_output .= '</select>';
											}
										 if ( $hide_sorting_filter != 'on' ){
												$p_category_select_default = (isset($_GET["dem_sort"]) && $_GET["dem_sort"] == "")? ' selected="selected" ' : '';
												$p_category_select_date_desc = (isset($_GET["dem_sort"]) && $_GET["dem_sort"] == "date_desc")? 'selected="selected" ' : '';
												$p_category_select_date_asc = (isset($_GET["dem_sort"]) && $_GET["dem_sort"] == "date_asc")? 'selected="selected" ' : '';
												$p_category_select_title_asc = (isset($_GET["dem_sort"]) && $_GET["dem_sort"] == "title_asc")? 'selected="selected" ' : '';
												$p_category_select_title_desc = (isset($_GET["dem_sort"]) && $_GET["dem_sort"] == "title_desc")? 'selected="selected" ' : '';
												$p_category_select_event_start_desc = (isset($_GET["dem_sort"]) && $_GET["dem_sort"] == "event_start_desc")? 'selected="selected" ' : '';
												$p_category_select_event_start_asc = (isset($_GET["dem_sort"]) && $_GET["dem_sort"] == "event_start_asc")? 'selected="selected" ' : '';
												$p_category_select_rand = (isset($_GET["dem_sort"]) && $_GET["dem_sort"] == "rand")? 'selected="selected" ' : ''; 
												$dem_grid_output .= '<select name="dem_sort" class="dem_v2_filter"  onchange="this.form.submit()">
													<option value="default" '.esc_attr($p_category_select_default).' >'.__($dem_filter_sort_op,'dpevent').'</option>
													<option value="date_desc" '.esc_attr($p_category_select_date_desc).' >'.__($dem_filter_dno_op,'dpevent').'</option>
													<option value="date_asc" '.esc_attr($p_category_select_date_asc).' >'.__($dem_filter_dow_op,'dpevent').'</option>
													<option value="title_asc" '.esc_attr($p_category_select_title_asc).' >'.__($dem_filter_taz_op,'dpevent').'</option>
													<option value="title_desc" '.esc_attr($p_category_select_title_desc).' >'.__($dem_filter_tza_op,'dpevent').'</option>
													<option value="event_start_desc" '.esc_attr($p_category_select_event_start_desc).' >'.__($dem_filter_sdd_op,'dpevent').'</option>
													<option value="event_start_asc" '.esc_attr($p_category_select_event_start_asc).' >'.__($dem_filter_sda_op,'dpevent').'</option>
													<option value="rand" '.esc_attr($p_category_select_rand).' >'.__($dem_filter_ran_op,'dpevent').'</option>
												</select>';
											}	
										 $dem_grid_output .= '<input type="hidden" value='.esc_attr ($dem_grid_nonce).' name="dem_wpnonce" id="dem_wpnonce"/>';
										 if (  isset($_GET['dem_sort']) || isset($_GET['dem_filter']) || isset($_GET['dem_cat'])  ){
											$dem_grid_output .= '<div class="p_reset"><a href="'.esc_url($current_url).'">'.__($dem_filter_reset_op,"dpevent").'</a></div>';
											?>
											<script type="text/javascript">
											jQuery(document).ready(function($){
												jQuery('html, body').animate({
														scrollTop: jQuery("#gridview").offset().top
													}, 1000);
												});
											</script>
											<?php
										 } 
							$dem_grid_output .= '</div></div></div></form>';
		}
		
		// Find Files From Child Theme. If Found then call from theme otherwise files call from plugin
		$dem_template_path 	=  get_stylesheet_directory() . '/divi-eventmanager';
		$dem_grid_path 		=  $dem_template_path.'/grid';
		$dem_css_path 		=  $dem_template_path.'/css/grid';
		$dem_css_url 		=  get_stylesheet_directory_uri().'/divi-eventmanager/css/grid'; 
		
		if ( file_exists( $dem_css_path . '/dem_grid_'.$dem_select_style.'.css' ) )
		{
			wp_enqueue_style('dem_grid_view_event_'.$dem_select_style, esc_url($dem_css_url.'/dem_grid_'.$dem_select_style.'.css'), array(), NULL);
		}else{
			wp_enqueue_style('dem_grid_view_event_'.$dem_select_style, esc_url(DEM_PLUGIN_URL.'assets/css/divi-layout-css/grid/dem_grid_'.$dem_select_style.'.min.css'), array(), NULL);
		}
		
		if ( $dem_grid_column == 'col4'){
			$dem_column_class = 'et_pb_column_1_4';
			$dem_condition = '4';
		}else if ( $dem_grid_column == 'col3'){
			$dem_column_class = 'et_pb_column_1_3';
			$dem_condition = '3';
		} else if ( $dem_grid_column == 'col2'){
			$dem_column_class = 'et_pb_column_1_2';
			$dem_condition = '2';
		} else{
			$dem_column_class = 'et_pb_column_1_3';
			$dem_condition = '3';
		}
				
		$dem_grid_output .= '<div class=" dem_grid_main et_pb_gutters2  dem_equalheight dem_grid_' . $dem_select_style . ' ">';
		$i = 1;
		if ( $dem_grid_query->have_posts() ) {
			
			while ( $dem_grid_query->have_posts() ) {
				$dem_grid_query->the_post();
				ob_start();
				$last_child = '';
				if ($i % $dem_condition == 0 ){ $last_child = 'et-last-child'; }
				$dp_event_thumb = array();
				$dp_event_thumb = wp_get_attachment_image_src(get_post_thumbnail_id(), 'dem_grid_400_400');
				if( $dp_event_thumb[0] != ''){ 
					$image_path = $dp_event_thumb[0] ;
				}else{ 
					$image_path = DEM_PLUGIN_URL. '/assets/images/default.png';
				} 
				
				$event_thumbnail_image_url 		= $image_path;
				$target_blank  = '';
				//$event_permalink 				= get_the_permalink(get_the_ID());
				$dpevent_custom_link 			= get_post_meta( get_the_ID(), 'dpevent_custom_link', true );
				$dp_event_page_link_type 		= get_post_meta( get_the_ID(), 'dp_event_page_link_type', true );
				if ( $dp_event_page_link_type == 'default' ){
					if ( $dem_link_type == 'customlink' && $dpevent_custom_link != '' ){
						$event_permalink 				= $dpevent_custom_link;
						$target_blank  = ' target="_blank" ';
					}else{
						$event_permalink 				= get_the_permalink(get_the_ID());
					}
				}else if( $dp_event_page_link_type == 'posttypelink' ){
					$event_permalink 				= get_the_permalink(get_the_ID());
				}else if( $dp_event_page_link_type == 'customeventlink' && $dpevent_custom_link != '' ){
					$event_permalink 				= $dpevent_custom_link;
					$target_blank  = ' target="_blank" ';
				}else{
					$event_permalink 				= get_the_permalink(get_the_ID());
				}
				$event_title 					= get_the_title(get_the_ID());
				$event_start_date 				= get_post_meta(get_the_ID(), 'dp_event_start_date',true);
				$event_end_date 				= get_post_meta(get_the_ID(), 'dp_event_end_date',true);
				$event_start_time 				= get_post_meta(get_the_ID(), 'dp_event_start_time',true);
				$event_end_time 				= get_post_meta(get_the_ID(), 'dp_event_end_time',true);
				$event_venue					= get_post_meta(get_the_ID() ,'dpevent_address', true );
				$event_city                     = get_post_meta(get_the_ID() ,'dpevent_city', true );
				$event_state                    = get_post_meta(get_the_ID() ,'dpevent_state', true );
				$event_country                  = get_post_meta(get_the_ID() ,'dpevent_country', true );
				$event_ticket_cost 				= get_post_meta(get_the_ID(), 'dpevent_cost_name', true);
				$event_ticket_cost_currency		= get_post_meta(get_the_ID(), 'dp_event_currency_symbol_name', true);
				$event_ticket_currency_position	= get_post_meta(get_the_ID(), 'dp_event_currency_prefix_suffix', true);
				$event_readmore_btn_text		= $dem_grid_readmore_txt;
				$event_content 					= get_the_excerpt();
				$event_post_categories 			= wp_get_post_terms( get_the_ID() ,'event_category', array("fields" => "ids"));
				
				$event_venue_address = $dem_grid_title_val ='';
				if( $event_venue != '' ){
					$event_venue_address .= $event_venue.', ';
				}
				if( $event_city != '' ){
					$event_venue_address .= $event_city.', ';
				}
				if( $event_state != '' ){
					$event_venue_address .= $event_state.', ';
				}
				if( $event_country != '' ){
					$event_venue_address .= $event_country.', ';
				}
				
				if ( '' !== $event_title ) {
					if( $dem_select_style == 'style1' ){
						$dem_grid_title_val = sprintf(
							'<%1$s class="et_pb_module_header dem_grid_title" >%2$s</%1$s>', et_pb_process_header_level($header_level, 'h3'), esc_attr($event_title)
						);	
					}else{
						$dem_grid_title_val = sprintf(
							'<%1$s class="et_pb_module_header dem_grid_title"><a href="%3$s" %4$s>%2$s</a></%1$s>', et_pb_process_header_level($header_level, 'h3'), esc_attr($event_title), esc_url($event_permalink), esc_attr($target_blank)
						);
					}
				}	
						
				if ( file_exists( $dem_grid_path . '/dem_grid_'.$dem_select_style.'.php' ) )
				{
					include $dem_grid_path. '/dem_grid_'.$dem_select_style.'.php';
				}else{
					include DEM_PLUGIN_PATH. 'include/divi-layout-style/grid/dem_grid_'.$dem_select_style.'.php';
				}
				
				$dem_grid_output .= ob_get_contents();
				ob_end_clean();
				$i++;
			}
			
			if ( $dem_grid_view_pagination == 'on' && $dem_grid_query->max_num_pages > 1 ) {
					$dem_grid_output .= '<div class="et_pb_row_custom_pagination pagination-container"><nav class="navigation dem_pagination"><div class="nav-links">';
					$dem_grid_output .= paginate_links(array(
						'format' => 'page/%#%',
						'current' => max(1, $paged),
						'total' => $dem_grid_query->max_num_pages,
						'prev_text' => __('<span class="et-pb-icon">&#x34;</span>', 'dpevent'),
						'next_text' => __('<span class="et-pb-icon">&#x35;</span>', 'dpevent'),
					));
					$dem_grid_output .= '</div></nav></div>';
			}
			$dem_grid_output .= '</div>';
		}else{
			
			$dem_grid_output .= esc_html__($divi_dem_no_result, 'dpevent');
		}
		wp_reset_postdata();
		return $dem_grid_output;
	}

	function dem_grid_style_color_css($render_slug){
           $dem_grid_show_filter_options	  = esc_attr( $this->props['dem_grid_show_filter_options'] );
			if ( $dem_grid_show_filter_options == 'dem_display_dropdown_filter'){
				$dem_filter_row_bk_color = $this->props['dem_filter_row_bk_color'];           
            	$dem_filter_row_text_color = $this->props['dem_filter_row_text_color'];   
				 if ( $dem_filter_row_bk_color != '' ) {
				 	ET_Builder_Element::set_style($render_slug, array(
                        'selector' => '%%order_class%% .list_grid_row.et_pb_row',
                        'declaration' => sprintf(
                                'background-color: %1$s !important;', esc_html($dem_filter_row_bk_color)
                        ),
                    ));
				 }
				 if ( $dem_filter_row_text_color != '' ) {
				 	ET_Builder_Element::set_style($render_slug, array(
                        'selector' => '%%order_class%% .list_grid_row.et_pb_row .p_reset,%%order_class%% .list_grid_row.et_pb_row .p_reset a',
                        'declaration' => sprintf(
                                'color: %1$s !important;', esc_html($dem_filter_row_text_color)
                        ),
                    ));
				 }
			}
			
			$dem_select_style 						= $this->props['dem_grid_select_style'];  
            $style2_dem_readmore_bg_color 			= $this->props['style2_dem_readmore_bg_color'];           
            $style2_dpevent_readmore_bg_hover_color = $this->get_hover_value( 'style2_dem_readmore_bg_color' );     
			$style2_ticket_readmore_text_color 		= $this->props['style2_ticket_readmore_text_color'];           
            $style2_ticket_readmore_text_color_hover_color = $this->get_hover_value( 'style2_ticket_readmore_text_color' ); 
            $style2_ticket_start_text_color 		= $this->props['style2_ticket_start_text_color'];           
            $style2_ticket_start_text_hover_color 	= $this->get_hover_value( 'style2_ticket_start_text_color' );
            
			if( $dem_select_style == "style2" ){
			
                if ( $style2_dem_readmore_bg_color != '' ) {
                    ET_Builder_Element::set_style($render_slug, array(
                        'selector' => '%%order_class%% .dem_grid_style2_event_detail .dem_grid_style2_book_now a',
                        'declaration' => sprintf(
                                'background-color: %1$s !important;border:1px solid %1$s !important;', esc_html($style2_dem_readmore_bg_color)
                        ),
                    ));
                }  
				
                if ( $style2_dpevent_readmore_bg_hover_color != '' ) {
                    ET_Builder_Element::set_style($render_slug, array(
                        'selector' => '%%order_class%% .dem_grid_style2_event_detail .dem_grid_style2_book_now a:hover',
                        'declaration' => sprintf(
                                'background-color: %1$s !important;border:1px solid %1$s !important;', esc_html($style2_dpevent_readmore_bg_hover_color)
                        ),
                    ));
                } 
				
				if ( $style2_ticket_readmore_text_color != '' ) {
                    ET_Builder_Element::set_style($render_slug, array(
                        'selector' => '%%order_class%% .dem_grid_style2_event_detail .dem_grid_style2_book_now a',
                        'declaration' => sprintf(
                                'color: %1$s !important;', esc_html($style2_ticket_readmore_text_color)
                        ),
                    ));
                }  
				
                if ( $style2_ticket_readmore_text_color_hover_color != '' ) {
                    ET_Builder_Element::set_style($render_slug, array(
                        'selector' => '%%order_class%% .dem_grid_style2_event_detail .dem_grid_style2_book_now a:hover',
                        'declaration' => sprintf(
                                'color: %1$s !important;', esc_html($style2_ticket_readmore_text_color_hover_color)
                        ),
                    ));
                } 
				
				
                if ( $style2_ticket_start_text_color != '' ) {
                    ET_Builder_Element::set_style($render_slug, array(
                        'selector' => '%%order_class%% .dem_grid_style2_event_detail .dem_grid_style2_event_cost',
                        'declaration' => sprintf(
                                'color: %1$s !important;', esc_html($style2_ticket_start_text_color)
                        ),
                    ));
                } 
				
                if ( $style2_ticket_start_text_hover_color != '' ) {
                    ET_Builder_Element::set_style($render_slug, array(
                        'selector' => '%%order_class%% .dem_grid_style2_event_detail .dem_grid_style2_event_cost:hover',
                        'declaration' => sprintf(
                                'color: %1$s !important;', esc_html($style2_ticket_start_text_hover_color)
                        ),
                    ));
                }    
				          
            }               
        }
    function dem_grid_style_pagination_css($render_slug){
			$dem_grid_show_filter_options	  = esc_attr( $this->props['dem_grid_show_filter_options'] );
			
			 if( $dem_grid_show_filter_options == "dem_display_category_filter" ){
			 		$dem_filter_color 				= $this->props['dem_filter_color'];
					$dem_filter_hover_color 		= $this->get_hover_value( 'dem_filter_color' );
					$dem_filter_bg_color 			= $this->props['dem_filter_bg_color']; 
					$dem_filter_bg_hover_color 		= $this->get_hover_value( 'dem_filter_bg_color' );
					$dem_filter_active_color 		= $this->props['dem_filter_active_color'];
					$dem_filter_active_hover_color 	= $this->get_hover_value( 'dem_filter_active_color' );
					$dem_filter_active_bg_color 	= $this->props['dem_filter_active_bg_color']; 
					$dem_filter_active_bg_hover_color = $this->get_hover_value( 'dem_filter_active_bg_color' );
				
				if ( $dem_filter_color != '' ) {
					ET_Builder_Element::set_style($render_slug, array(
						'selector' => '%%order_class%% .dem_grid_category_filter_list li a',
						'declaration' => sprintf(
								'color: %1$s !important;', esc_html($dem_filter_color)
						),
					));
				}  
				
                if ( $dem_filter_hover_color != '' ) {
                    ET_Builder_Element::set_style($render_slug, array(
                        'selector' => '%%order_class%% .dem_grid_category_filter_list li a:hover',
                        'declaration' => sprintf(
                                'color: %1$s !important;', esc_html($dem_filter_hover_color)
                        ),
                    ));
                }
				
                if ($dem_filter_bg_color != '') {
                    ET_Builder_Element::set_style($render_slug, array(
                        'selector' => '%%order_class%% .dem_grid_category_filter_list li a',
                        'declaration' => sprintf(
                                'background: %1$s !important;', esc_html($dem_filter_bg_color)
                        ),
                    ));
                }  
				
                if ( $dem_filter_bg_hover_color != '' ) {
                    ET_Builder_Element::set_style($render_slug, array(
                        'selector' => '%%order_class%% .dem_grid_category_filter_list li a:hover',
                        'declaration' => sprintf(
                                'background: %1$s !important;', esc_html($dem_filter_bg_hover_color)
                        ),
                    ));
                } 

                if ( $dem_filter_active_color != '' ) {
                    ET_Builder_Element::set_style($render_slug, array(
                        'selector' => '%%order_class%% .dem_grid_category_filter_list li a.active',
                        'declaration' => sprintf(
                                'color: %1$s !important;', esc_html($dem_filter_active_color)
                        ),
                    ));
                }  
				
                if ( $dem_filter_active_hover_color != '' ) {
                    ET_Builder_Element::set_style($render_slug, array(
                        'selector' => '%%order_class%% .dem_grid_category_filter_list li a.active:hover',
                        'declaration' => sprintf(
                                'color: %1$s !important;', esc_html($dem_filter_active_hover_color)
                        ),
                    ));
                }
                if ( $dem_filter_active_bg_color != '' ) {
                    ET_Builder_Element::set_style($render_slug, array(
                        'selector' => '%%order_class%% .dem_grid_category_filter_list li a.active',
                        'declaration' => sprintf(
                                'background: %1$s !important;', esc_html($dem_filter_active_bg_color)
                        ),
                    ));
                }  
                if ( $dem_filter_active_bg_hover_color != '' ) {
                    ET_Builder_Element::set_style($render_slug, array(
                        'selector' => '%%order_class%% .dem_grid_category_filter_list li a.active:hover',
                        'declaration' => sprintf(
                                'background: %1$s !important;', esc_html($dem_filter_active_bg_hover_color)
                        ),
                    ));
                } 
			 }
           
           $dem_grid_view_pagination 			= $this->props['dem_grid_view_pagination'];
            if( $dem_grid_view_pagination == "on" ){
                $dem_pagination_color 				= $this->props['dem_pagination_color'];
				$dem_pagination_hover_color 		= $this->get_hover_value( 'dem_pagination_color' );
				$dem_pagination_bg_color 			= $this->props['dem_pagination_bg_color']; 
				$dem_pagination_bg_hover_color 		= $this->get_hover_value( 'dem_pagination_bg_color' );
				$dem_pagination_active_color 		= $this->props['dem_pagination_active_color'];
				$dem_pagination_active_hover_color 	= $this->get_hover_value( 'dem_pagination_active_color' );
				$dem_pagination_active_bg_color 	= $this->props['dem_pagination_active_bg_color']; 
				$dem_pagination_active_bg_hover_color = $this->get_hover_value( 'dem_pagination_active_bg_color' );
			    if ( $dem_pagination_color != '' ) {
                    ET_Builder_Element::set_style($render_slug, array(
                        'selector' => '%%order_class%% .et_pb_row_custom_pagination .navigation a.page-numbers, %%order_class%% .et_pb_row_custom_pagination .navigation span.page-numbers',
                        'declaration' => sprintf(
                                'color: %1$s !important;', esc_html($dem_pagination_color)
                        ),
                    ));
                }  
				
                if ( $dem_pagination_hover_color != '' ) {
                    ET_Builder_Element::set_style($render_slug, array(
                        'selector' => '%%order_class%% .et_pb_row_custom_pagination .navigation a.page-numbers:hover, %%order_class%% .et_pb_row_custom_pagination .navigation span.page-numbers:hover',
                        'declaration' => sprintf(
                                'color: %1$s !important;', esc_html($dem_pagination_hover_color)
                        ),
                    ));
                }
				
                if ($dem_pagination_bg_color != '') {
                    ET_Builder_Element::set_style($render_slug, array(
                        'selector' => '%%order_class%% .et_pb_row_custom_pagination .navigation a.page-numbers, %%order_class%% .et_pb_row_custom_pagination .navigation span.page-numbers',
                        'declaration' => sprintf(
                                'background: %1$s !important;', esc_html($dem_pagination_bg_color)
                        ),
                    ));
                }  
				
                if ( $dem_pagination_bg_hover_color != '' ) {
                    ET_Builder_Element::set_style($render_slug, array(
                        'selector' => '%%order_class%% .et_pb_row_custom_pagination .navigation a.page-numbers:hover, %%order_class%% .et_pb_row_custom_pagination .navigation span.page-numbers:hover',
                        'declaration' => sprintf(
                                'background: %1$s !important;', esc_html($dem_pagination_bg_hover_color)
                        ),
                    ));
                } 

                if ( $dem_pagination_active_color != '' ) {
                    ET_Builder_Element::set_style($render_slug, array(
                        'selector' => '%%order_class%% .et_pb_row_custom_pagination .navigation span.page-numbers.current',
                        'declaration' => sprintf(
                                'color: %1$s !important;', esc_html($dem_pagination_active_color)
                        ),
                    ));
                }  
				
                if ( $dem_pagination_active_hover_color != '' ) {
                    ET_Builder_Element::set_style($render_slug, array(
                        'selector' => '%%order_class%% .et_pb_row_custom_pagination .navigation span.page-numbers.current:hover',
                        'declaration' => sprintf(
                                'color: %1$s !important;', esc_html($dem_pagination_active_hover_color)
                        ),
                    ));
                }
                if ( $dem_pagination_active_bg_color != '' ) {
                    ET_Builder_Element::set_style($render_slug, array(
                        'selector' => '%%order_class%% .et_pb_row_custom_pagination .navigation span.page-numbers.current',
                        'declaration' => sprintf(
                                'background: %1$s !important;', esc_html($dem_pagination_active_bg_color)
                        ),
                    ));
                }  
                if ( $dem_pagination_active_bg_hover_color != '' ) {
                    ET_Builder_Element::set_style($render_slug, array(
                        'selector' => '%%order_class%% .et_pb_row_custom_pagination .navigation span.page-numbers.current:hover',
                        'declaration' => sprintf(
                                'background: %1$s !important;', esc_html($dem_pagination_active_bg_hover_color)
                        ),
                    ));
                } 
                         
            }               
    }
	
	static function dem_grid_compute($dem_args = array(), $conditional_tags = array(), $current_page = array()) {
		$defaults = array(
			'header_level' 				=> 'h3',
			'dem_grid_select_style' 	=> 'style1',
			'dem_grid_category' 		=> 'all',
			'include_categories' 		=> '',
			'dem_grid_tag' 				=> 'all',
			'include_tags' 				=> '',
			'dem_grid_column'			=> 'col3',
			'dem_grid_display_number_of_event' => '6',
			'dem_orderby' 				=> 'date_asc',
			'dem_show_event' 			=> 'default',
			'dem_grid_view_pagination' 	=> 'on',
			'dem_grid_readmore_txt' 	=> 'Read More',
			'dem_grid_show_read_more' 	=> 'on',
			'dem_time_format' 			=> 'twhr',
			'dem_grid_show_filter_options'     => 'default',
			'dem_grid_default_category_filter' => 'all', 
			'dem_grid_category_orderby' 	   => 'id_desc',
			'dem_grid_filter_all_label'        => 'All',  
			'dem_grid_hide_all_cat'            => 'off', 
			'dem_show_event_filter_result'     => 'result_default',
			'hide_category_filter'     		   => 'off',
			'hide_all_today_week_month_filter' => 'off',
			'hide_sorting_filter'     		   => 'off',
			'dem_grid_no_filter_options'       => 'default',
			'dem_link_type'       			   => 'default',
			'use_current_loop'                 => 'off',
			
		);
		$dem_args = wp_parse_args(array_filter($dem_args), $defaults);
		$use_current_loop 					= ( $dem_args['use_current_loop'] );
		$header_level 						= ( $dem_args['header_level'] );
		$dem_select_style 					= ( $dem_args['dem_grid_select_style'] );
		$dem_grid_category 					= ( $dem_args['dem_grid_category'] );
		$include_categories 				= ( $dem_args['include_categories'] );
		$dem_grid_tag 						= ( $dem_args['dem_grid_tag'] );
		$include_tags 						= ( $dem_args['include_tags'] );
		$dem_grid_column 					= ( $dem_args['dem_grid_column'] );
		$dem_grid_display_number_of_event 	= ( $dem_args['dem_grid_display_number_of_event'] );
		$dem_orderby 						= ( $dem_args['dem_orderby'] );
		$dem_show_event 					= ( $dem_args['dem_show_event'] );
		$dem_grid_view_pagination 			= ( $dem_args['dem_grid_view_pagination'] );
		$dem_grid_readmore_txt 				= ( $dem_args['dem_grid_readmore_txt'] );
		$dem_grid_show_read_more 			= ( $dem_args['dem_grid_show_read_more'] );
		$dem_time_format 					= ( $dem_args['dem_time_format'] );
		$dem_grid_show_filter_options	    = ( $dem_args['dem_grid_show_filter_options'] );
		$dem_grid_default_category_filter   = ( $dem_args['dem_grid_default_category_filter'] );
		$dem_grid_category_orderby	  	    = ( $dem_args['dem_grid_category_orderby'] );
		$dem_grid_filter_all_label	  	    = ( $dem_args['dem_grid_filter_all_label'] );
		$dem_grid_hide_all_cat	  	  	    = ( $dem_args['dem_grid_hide_all_cat'] );
		$dem_show_event_filter_result	  	= ( $dem_args['dem_show_event_filter_result'] );
		$hide_category_filter	  	  	  	= ( $dem_args['hide_category_filter'] );
		$hide_all_today_week_month_filter 	= ( $dem_args['hide_all_today_week_month_filter'] );
		$hide_sorting_filter	  	  	  	= ( $dem_args['hide_sorting_filter'] );
		$dem_grid_no_filter_options	  	  	= ( $dem_args['dem_grid_no_filter_options'] );
		$dem_link_type	  	  			  	= ( $dem_args['dem_link_type'] );
		$dem_themename 					    = dem_theme_name();
		$divi_dem_multi_lan 			    = et_get_option($dem_themename.'_dem_multi_lan','off');
		 if ( is_archive() ){
			 global $wp;
			 $current_url = home_url( add_query_arg( array(), $wp->request ) );
		 }else{
			 $current_url = get_permalink();
		 }
				 
		$dem_arguments = array();
        //event per page
		if ($dem_grid_display_number_of_event == '') {
			$dem_arguments = array('posts_per_page' => -1);
		} else {
			$dem_arguments = array('posts_per_page' => (int) $dem_grid_display_number_of_event);
		}
		if (get_query_var('paged')) {
			$paged = (int) get_query_var('paged');
		} elseif (get_query_var('page')) {
			$paged = (int) get_query_var('page');
		} else {
			$paged = 1;
		}
		$dem_arguments['paged'] = $paged;

		//$include_categories = explode(",", $dem_args['include_categories']);
       // $include_tag = explode(",", $dem_args['include_tags']);
		
		// Tag & Category Query
		// Default View
		if ( $dem_grid_show_filter_options == 'default' ) {
		
			if ( $dem_grid_tag != 'all' && $dem_grid_category != 'all' ) {	
				
				if ( !empty( $include_tags ) && !empty( $include_categories ) ) {
					
					$dem_arguments['tax_query'] = array(
						'relation' => 'AND',
						array(
							'taxonomy' => 'event_tag',
							'field' => 'term_id',
							'terms' => explode(",", $include_tags),
							'operator' => 'IN'
						),
						array(
							'taxonomy' => 'event_category',
							'field' => 'term_id',
							'terms' => explode(",", $include_categories),
							'operator' => 'IN'
						),
					);
					
				}
				
				if ( empty( $include_tags ) && !empty( $include_categories ) ) {
					$dem_arguments['tax_query'] = array(
						array(
							'taxonomy' => 'event_category',
							'field' => 'term_id',
							'terms' => explode(",", $include_categories),
							'operator' => 'IN'
						),
					);
				}
				
				if ( !empty( $include_tags) && empty( $include_categories) ) {
					$dem_arguments['tax_query'] = array(
						array(
							'taxonomy' => 'event_tag',
							'field' => 'term_id',
							'terms' => explode(",", $include_tags),
							'operator' => 'IN'
						),
					);
				}
				
			} else if ( $dem_grid_tag != 'all' && $dem_grid_category == 'all' ) {
			
				if ( !empty( $include_tags ) ) {
					$dem_arguments['tax_query'] = array(
						array(
							'taxonomy' => 'event_tag',
							'field' => 'term_id',
							'terms' => explode(",", $include_tags),
							'operator' => 'IN'
						)
					);
				}
				
			} else if ( $dem_grid_category != 'all' && $dem_grid_tag == 'all' ) {
			
				if ( !empty( $include_categories ) ) {
					$dem_arguments['tax_query'] = array(
						array(
							'taxonomy' => 'event_category',
							'field' => 'term_id',
							'terms' => explode(",", $include_categories),
							'operator' => 'IN'
						)
					);
				}
				
			} else {
			}
		
		}// end if Default View
		
		// Category Filter View
		//if ( $dem_grid_show_filter_options != 'dem_display_dropdown_filter' ) {
			// Order & Orderby
			if ( 'date_desc' !== $dem_orderby ) {
				switch ( $dem_orderby ) {
						case 'date_asc' :
							$dem_arguments['orderby'] = 'date';
							$dem_arguments['order'] = 'ASC';
							break;
						case 'title_asc' :
							$dem_arguments['orderby'] = 'title';
							$dem_arguments['order'] = 'ASC';
							break;
						case 'title_desc' :
							$dem_arguments['orderby'] = 'title';
							$dem_arguments['order'] = 'DESC';
							break;
						case 'rand' :
							$dem_arguments['orderby'] = 'rand';
							break;
						case 'event_start_desc' :
							$dem_arguments['orderby'] = 'meta_value_num';
							$dem_arguments['order'] = 'DESC';
							$dem_arguments['meta_key'] = 'dp_event_start_date';
							break;
						case 'event_start_asc' :
							$dem_arguments['orderby'] = 'meta_value_num';
							$dem_arguments['order'] = 'ASC';
							$dem_arguments['meta_key'] = 'dp_event_start_date';
							break;
					}
			} else {
				$dem_arguments['orderby'] = 'date';
				$dem_arguments['order'] = 'DESC';
			}
		//}// end Category Filter View
		
		$dem_arguments['post_type'] = 'dp_events';
		
		if ( $dem_grid_show_filter_options == 'default' || $dem_grid_show_filter_options == 'dem_display_category_filter' ) {
			//show upcomming events
			if( $dem_show_event == "show_upcomming_events" ){
				$dem_current_date = gmdate('d-m-Y');
				$dem_arguments['meta_query']  = array(
					array(
						'key' 		=> 'dp_event_end_date',
						'value' 	=>  strtotime($dem_current_date),
						'compare' 	=> '>=', 
					),
				);	
			}else if( $dem_show_event == "show_past_events" ){ //show past events
				$dem_current_date = gmdate('d-m-Y');
				$dem_arguments['meta_query']  = array(
					array(
						'key' 		=> 'dp_event_end_date',
						'value' 	=>  strtotime($dem_current_date),
						'compare' 	=> '<=', 
					),
	
				);
			}else{}
		}
		if ( $dem_grid_show_filter_options == 'default' && $dem_grid_no_filter_options != 'default' ) {
				// Today Events
				if( $dem_grid_no_filter_options == 'dem_w_today')
				{
					$date_today= gmdate('d-m-Y');
					$dem_arguments['meta_key'] = 'dp_event_start_date';
					$dem_arguments['meta_query'] = array(
							'relation' => 'AND',
							array(
								'key' => 'dp_event_end_date',
								'value' => strtotime($date_today),
								'compare' => '>='
							),
							array(
								'key' => 'dp_event_start_date',
								'value' => strtotime($date_today),
								'compare' => '<'
							)
					);
				}
				// This Month Events
				if( $dem_grid_no_filter_options =='dem_w_month')
				{
					$start_date_thismonth = gmdate('01-m-Y',strtotime('this month'));
					$end_date_thismonth = gmdate('t-m-Y',strtotime('this month'));
					$dem_arguments['meta_key'] = 'dp_event_start_date';
					$dem_current_date = gmdate('d-m-Y');
					if ( $dem_show_event == 'show_upcomming_events' ){
						$dem_arguments['meta_query'] = array(
							'relation' => 'AND',
							array(
								'key' => 'dp_event_end_date',
								'value' => strtotime($start_date_thismonth),
								'compare' => '>='
							),
							array(
								'key' => 'dp_event_start_date',
								'value' => strtotime($end_date_thismonth),
								'compare' => '<='
							),
							array(
								'key' 		=> 'dp_event_end_date',
								'value' 	=>  strtotime($dem_current_date),
								'compare' 	=> '>=', 
							)
						);
					}else if ( $dem_show_event == 'show_past_events' ){
						$dem_arguments['meta_query'] = array(
							'relation' => 'AND',
							array(
								'key' => 'dp_event_end_date',
								'value' => strtotime($start_date_thismonth),
								'compare' => '>='
							),
							array(
								'key' => 'dp_event_start_date',
								'value' => strtotime($end_date_thismonth),
								'compare' => '<='
							),
							array(
								'key' 		=> 'dp_event_end_date',
								'value' 	=>  strtotime($dem_current_date),
								'compare' 	=> '<=', 
							)
						);
					}else{
							$dem_arguments['meta_query'] = array(
								'relation' => 'AND',
								array(
									'key' => 'dp_event_end_date',
									'value' => strtotime($start_date_thismonth),
									'compare' => '>='
								),
								array(
									'key' => 'dp_event_start_date',
									'value' => strtotime($end_date_thismonth),
									'compare' => '<='
								)
						    );
					}
				}
				// This Week Events
				if( $dem_grid_no_filter_options =='dem_w_week')
				{
					$thisweek_day = gmdate('w');
					$start_date_thisweek = gmdate("d-m-Y",strtotime('monday this week'));
					$end_date_thisweek = gmdate("d-m-Y",strtotime("sunday this week"));
					//$start_date_thisweek = gmdate('d-m-Y', strtotime('-'. $thisweek_day . ' days'));
					//$end_date_thisweek = gmdate('d-m-Y', strtotime('+' . (6 - $thisweek_day) . ' days'));
					$dem_arguments['meta_key'] = 'dp_event_start_date';
					$dem_current_date = gmdate('d-m-Y');
					
					if ( $dem_show_event == 'show_upcomming_events' ){
						$dem_arguments['meta_query'] = array(
							'relation' => 'AND',
							array(
								'key' => 'dp_event_end_date',
								'value' => strtotime($start_date_thisweek),
								'compare' => '>='
							),
							array(
								'key' => 'dp_event_start_date',
								'value' => strtotime($end_date_thisweek),
								'compare' => '<='
							),
							array(
								'key' 		=> 'dp_event_end_date',
								'value' 	=>  strtotime($dem_current_date),
								'compare' 	=> '>=', 
							)
						);
					}else if ( $dem_show_event == 'show_past_events' ){
						$dem_arguments['meta_query'] = array(
							'relation' => 'AND',
							array(
								'key' => 'dp_event_end_date',
								'value' => strtotime($start_date_thisweek),
								'compare' => '>='
							),
							array(
								'key' => 'dp_event_start_date',
								'value' => strtotime($end_date_thisweek),
								'compare' => '<='
							),
							array(
								'key' 		=> 'dp_event_end_date',
								'value' 	=>  strtotime($dem_current_date),
								'compare' 	=> '<=', 
							)
						);
					}else{
						$dem_arguments['meta_query'] = array(
							'relation' => 'AND',
							array(
								'key' => 'dp_event_end_date',
								'value' => strtotime($start_date_thisweek),
								'compare' => '>='
							),
							array(
								'key' => 'dp_event_start_date',
								'value' => strtotime($end_date_thisweek),
								'compare' => '<='
							)
						);
					}
				}
				// This Year Events
				if( $dem_grid_no_filter_options =='dem_w_year')
				{
					$start_date_thisyear = gmdate("01-01-Y", strtotime("this year"));
					$end_date_thisyear = gmdate("t-12-Y", strtotime($start_date_thisyear));
					$dem_arguments['meta_key'] = 'dp_event_start_date';
					$dem_current_date = gmdate('d-m-Y');
					if ( $dem_show_event == 'show_upcomming_events' ){
						$dem_arguments['meta_query'] = array(
							'relation' => 'AND',
							array(
								'key' => 'dp_event_end_date',
								'value' => strtotime($start_date_thisyear),
								'compare' => '>='
							),
							array(
								'key' => 'dp_event_start_date',
								'value' => strtotime($end_date_thisyear),
								'compare' => '<='
							),
							array(
								'key' 		=> 'dp_event_end_date',
								'value' 	=>  strtotime($dem_current_date),
								'compare' 	=> '>=', 
							)
						);
					}else if ( $dem_show_event == 'show_past_events' ){
						$dem_arguments['meta_query'] = array(
							'relation' => 'AND',
							array(
								'key' => 'dp_event_end_date',
								'value' => strtotime($start_date_thisyear),
								'compare' => '>='
							),
							array(
								'key' => 'dp_event_start_date',
								'value' => strtotime($end_date_thisyear),
								'compare' => '<='
							),
							array(
								'key' 		=> 'dp_event_end_date',
								'value' 	=>  strtotime($dem_current_date),
								'compare' 	=> '<=', 
							)
						);
					}else{
						$dem_arguments['meta_query'] = array(
							'relation' => 'AND',
							array(
								'key' => 'dp_event_end_date',
								'value' => strtotime($start_date_thisyear),
								'compare' => '>='
							),
							array(
								'key' => 'dp_event_start_date',
								'value' => strtotime($end_date_thisyear),
								'compare' => '<='
							)
						);
					}
				}
		}
		$dem_grid_output = '';
		// Category Filter View
		if ( $dem_grid_show_filter_options == 'dem_display_category_filter' ) {
			$dem_grid_nonce = wp_create_nonce( 'dem_grid_nonce' );
			if ( isset( $_GET['dem_wpnonce'] ) && !wp_verify_nonce( sanitize_key( $_GET['dem_wpnonce'] ), 'dem_grid_nonce' ) ) {
				 die( esc_html__( 'Security check', 'dpevent' ) ); 
			}
			if(isset($_GET["dem_cat"]) && is_numeric($_GET["dem_cat"]) && $_GET["dem_cat"]!='')
			{	
				$dem_cat = intval ($_GET["dem_cat"]);
				$dem_arguments['tax_query'] = array(
						array(
							'taxonomy' => 'event_category',
							'field' => 'term_id',
							'terms' => $dem_cat,
							'operator' => 'IN'
						),
				);
			}else if( isset($_GET["dem_cat"]) && $_GET["dem_cat"]== 'all'){
			}else if ( $dem_grid_default_category_filter != 'all' ){
				$dem_arguments['tax_query'] = array(
						array(
							'taxonomy' => 'event_category',
							'field' => 'term_id',
							'terms' => $dem_grid_default_category_filter,
							'operator' => 'IN'
						),
				);
			}else{}		
		    /*Category Filter Sorting Option*/
		   if ( 'id_desc' !== $dem_grid_category_orderby ) {
				switch( $dem_grid_category_orderby ) {
					case 'id_asc' :
						$dem_cat_orderby = 'id';
						$dem_cat_order = 'ASC';
						break;
					case 'name_asc' :
						$dem_cat_orderby = 'name';
						$dem_cat_order = 'ASC';
						break;
					case 'name_desc' :
						$dem_cat_orderby = 'name';
						$dem_cat_order = 'DESC';
						break;
					case 'count' :
						$dem_cat_orderby = 'count';
						break;
					case 'slug_desc' :
						$dem_cat_orderby = 'slug';
						$dem_cat_order = 'DESC';
						break;
					case 'slug_asc' :
						$dem_cat_orderby = 'slug';
						$dem_cat_order = 'ASC';
						break;
				}
			}else{
				$dem_cat_orderby = 'id';
				$dem_cat_order = 'DESC';
			}
			
		   $dem_event_category_all = get_terms( array(
				'taxonomy' 			=> 'event_category',
				'hide_empty'		=> false,
				'orderby'           => $dem_cat_orderby, 
	    		'order'             => $dem_cat_order,
			) );
			
			 $dem_grid_cat_active_class= '';
				
				 if ( $dem_grid_category == 'all'){
				 	 if(isset($_GET["dem_cat"]) && is_numeric($_GET["dem_cat"]) && $_GET["dem_cat"]!=''){
					 }else if( isset($_GET["dem_cat"]) && $_GET["dem_cat"]== 'all'){ $dem_grid_cat_active_class= 'active';
					 }else if ( $dem_grid_default_category_filter == 'all' ){ 
						 $dem_grid_cat_active_class= 'active';
					 }else{}
					$dem_grid_output .= '<ul class="dem_grid_category_filter_list" id="grid_filter">';
					if ( $dem_grid_hide_all_cat == 'off'){
						$dem_grid_output .= '<li><a href="'.esc_url($current_url).'?dem_cat=all&dem_wpnonce='.$dem_grid_nonce.'#grid_filter" class="et_smooth_scroll_disabled dem_grid_filter '.esc_attr($dem_grid_cat_active_class).' " data-filter=".all" ><span>'.esc_attr($dem_grid_filter_all_label).'</span></a></li>';
					}
					$dem_event_category_all_count = count($dem_event_category_all);
					if ( $dem_event_category_all_count > 0 ){
					foreach($dem_event_category_all as $dem_category_val){
							 $dem_grid_cat_active_class= '';
							 if(isset($_GET["dem_cat"]) && is_numeric($_GET["dem_cat"]) && $_GET["dem_cat"]!=''){
							 	if ( $_GET["dem_cat"] == $dem_category_val->term_id ){ $dem_grid_cat_active_class= 'active';}
							 }else if( isset($_GET["dem_cat"]) && $_GET["dem_cat"]== 'all'){
							 }else if ( $dem_grid_default_category_filter == $dem_category_val->term_id ){ 
							 	$dem_grid_cat_active_class= 'active';
							 }else{}
							$dem_grid_output .= '<li><a href="'.esc_url($current_url).'?dem_cat='.esc_attr($dem_category_val->term_id).'&dem_wpnonce='.$dem_grid_nonce.'#grid_filter" class="et_smooth_scroll_disabled dem_grid_filter '.esc_attr($dem_grid_cat_active_class).'" data-filter=".cat-'.esc_attr($dem_category_val->term_id).'" ><span>'.esc_attr($dem_category_val->name).'</span></a></li>';
						}
					}
					$dem_grid_output .= '</ul>';
				 }else{
					if ( $include_categories != '' ){
					     if(isset($_GET["dem_cat"]) && is_numeric($_GET["dem_cat"]) && $_GET["dem_cat"]!=''){
						 }else if( isset($_GET["dem_cat"]) && $_GET["dem_cat"]== 'all'){ $dem_grid_cat_active_class= 'active';
						 }else if ( $dem_grid_default_category_filter == 'all' ){ 
							 $dem_grid_cat_active_class= 'active';
						 }else{}
						$dem_grid_output .= '<ul class="dem_grid_category_filter_list" id="grid_filter">';
						if ( $dem_grid_hide_all_cat == 'off'){
							$dem_grid_output .= '<li><a href="'.esc_url($current_url).'?dem_cat=all&dem_wpnonce='.$dem_grid_nonce.'#grid_filter" class="dem_grid_filter et_smooth_scroll_disabled '.esc_attr($dem_grid_cat_active_class).'" data-filter=".all" ><span>'.esc_attr($dem_grid_filter_all_label).'</span></a></li>';
						}
						$dem_event_category_all_count = count($dem_event_category_all);
						if ( $dem_event_category_all_count > 0 ){
							foreach($dem_event_category_all as $dem_category_val){
							$dem_grid_cat_active_class= '';
								 if(isset($_GET["dem_cat"]) && is_numeric($_GET["dem_cat"]) && $_GET["dem_cat"]!=''){
									if ( $_GET["dem_cat"] == $dem_category_val->term_id ){ $dem_grid_cat_active_class= 'active';}
								 }else if( isset($_GET["dem_cat"]) && $_GET["dem_cat"]== 'all'){
								 }else if ( $dem_grid_default_category_filter == $dem_category_val->term_id ){ 
									$dem_grid_cat_active_class= 'active';
								 }else{}
								if  ( in_array( $dem_category_val->term_id,explode( ",", $include_categories) ) ){
									$dem_grid_output .= '<li><a href="'.esc_url($current_url).'?dem_cat='.esc_attr($dem_category_val->term_id).'&dem_wpnonce='.$dem_grid_nonce.'#grid_filter" class="et_smooth_scroll_disabled dem_grid_filter '.esc_attr($dem_grid_cat_active_class).'" data-filter=".cat-'.esc_attr($dem_category_val->term_id).'" ><span>'.esc_attr($dem_category_val->name).'</span></a></li>';
								}
							}
						}
						$dem_grid_output .= '</ul>';
					}
				}
		} // End Category Filter View
		
		// Dropdown Filter
		if ( $dem_grid_show_filter_options == 'dem_display_dropdown_filter' ) {
		
		 if ( isset( $_GET['dem_wpnonce'] ) && wp_verify_nonce( sanitize_key( $_GET['dem_wpnonce'] ), 'dem_grid_nonce' ) ) {
			if ( $hide_all_today_week_month_filter != 'on' ){
				// Today Events
				if(isset($_GET["dem_filter"]) && $_GET["dem_filter"]=='today')
				{
					$date_today= gmdate('d-m-Y');
					$dem_arguments['meta_key'] = 'dp_event_start_date';
					$dem_arguments['meta_query'] = array(
							'relation' => 'AND',
							array(
								'key' => 'dp_event_end_date',
								'value' => strtotime($date_today),
								'compare' => '>='
							),
							array(
								'key' => 'dp_event_start_date',
								'value' => strtotime($date_today),
								'compare' => '<'
							)
					);
				}
				// This Month Events
				if(isset($_GET["dem_filter"]) && $_GET["dem_filter"]=='thismonth')
				{
					$start_date_thismonth = gmdate('01-m-Y',strtotime('this month'));
					$end_date_thismonth = gmdate('t-m-Y',strtotime('this month'));
					$dem_arguments['meta_key'] = 'dp_event_start_date';
					$dem_current_date = gmdate('d-m-Y');
					if ( $dem_show_event_filter_result == 'result_show_upcomming_events' ){
						$dem_arguments['meta_query'] = array(
							'relation' => 'AND',
							array(
								'key' => 'dp_event_end_date',
								'value' => strtotime($start_date_thismonth),
								'compare' => '>='
							),
							array(
								'key' => 'dp_event_start_date',
								'value' => strtotime($end_date_thismonth),
								'compare' => '<='
							),
							array(
								'key' 		=> 'dp_event_end_date',
								'value' 	=>  strtotime($dem_current_date),
								'compare' 	=> '>=', 
							)
						);
					}else if ( $dem_show_event_filter_result == 'result_show_past_events' ){
						$dem_arguments['meta_query'] = array(
							'relation' => 'AND',
							array(
								'key' => 'dp_event_end_date',
								'value' => strtotime($start_date_thismonth),
								'compare' => '>='
							),
							array(
								'key' => 'dp_event_start_date',
								'value' => strtotime($end_date_thismonth),
								'compare' => '<='
							),
							array(
								'key' 		=> 'dp_event_end_date',
								'value' 	=>  strtotime($dem_current_date),
								'compare' 	=> '<=', 
							)
						);
					}else{
							$dem_arguments['meta_query'] = array(
								'relation' => 'AND',
								array(
									'key' => 'dp_event_end_date',
									'value' => strtotime($start_date_thismonth),
									'compare' => '>='
								),
								array(
									'key' => 'dp_event_start_date',
									'value' => strtotime($end_date_thismonth),
									'compare' => '<='
								)
						    );
					}
				}
				// This Week Events
				if(isset($_GET["dem_filter"]) && $_GET["dem_filter"]=='thisweek')
				{
					$thisweek_day = gmdate('w');
					$start_date_thisweek = gmdate("d-m-Y",strtotime('monday this week'));
					 $end_date_thisweek = gmdate("d-m-Y",strtotime("sunday this week"));
					//$start_date_thisweek = gmdate('d-m-Y', strtotime('-'. $thisweek_day . ' days'));
					//$end_date_thisweek = gmdate('d-m-Y', strtotime('+' . (6 - $thisweek_day) . ' days'));
					$dem_arguments['meta_key'] = 'dp_event_start_date';
					$dem_current_date = gmdate('d-m-Y');
					
					if ( $dem_show_event_filter_result == 'result_show_upcomming_events' ){
						$dem_arguments['meta_query'] = array(
							'relation' => 'AND',
							array(
								'key' => 'dp_event_end_date',
								'value' => strtotime($start_date_thisweek),
								'compare' => '>='
							),
							array(
								'key' => 'dp_event_start_date',
								'value' => strtotime($end_date_thisweek),
								'compare' => '<='
							),
							array(
								'key' 		=> 'dp_event_end_date',
								'value' 	=>  strtotime($dem_current_date),
								'compare' 	=> '>=', 
							)
						);
					}else if ( $dem_show_event_filter_result == 'result_show_past_events' ){
						$dem_arguments['meta_query'] = array(
							'relation' => 'AND',
							array(
								'key' => 'dp_event_end_date',
								'value' => strtotime($start_date_thisweek),
								'compare' => '>='
							),
							array(
								'key' => 'dp_event_start_date',
								'value' => strtotime($end_date_thisweek),
								'compare' => '<='
							),
							array(
								'key' 		=> 'dp_event_end_date',
								'value' 	=>  strtotime($dem_current_date),
								'compare' 	=> '<=', 
							)
						);
					}else{
						$dem_arguments['meta_query'] = array(
							'relation' => 'AND',
							array(
								'key' => 'dp_event_end_date',
								'value' => strtotime($start_date_thisweek),
								'compare' => '>='
							),
							array(
								'key' => 'dp_event_start_date',
								'value' => strtotime($end_date_thisweek),
								'compare' => '<='
							)
						);
					}
				}
				// This Year Events
				if(isset($_GET["dem_filter"]) && $_GET["dem_filter"]=='thisyear')
				{
					$start_date_thisyear = gmdate("01-01-Y", strtotime("this year"));
					$end_date_thisyear = gmdate("t-12-Y", strtotime($start_date_thisyear));
					$dem_arguments['meta_key'] = 'dp_event_start_date';
					$dem_current_date = gmdate('d-m-Y');
					if ( $dem_show_event_filter_result == 'result_show_upcomming_events' ){
						$dem_arguments['meta_query'] = array(
							'relation' => 'AND',
							array(
								'key' => 'dp_event_end_date',
								'value' => strtotime($start_date_thisyear),
								'compare' => '>='
							),
							array(
								'key' => 'dp_event_start_date',
								'value' => strtotime($end_date_thisyear),
								'compare' => '<='
							),
							array(
								'key' 		=> 'dp_event_end_date',
								'value' 	=>  strtotime($dem_current_date),
								'compare' 	=> '>=', 
							)
						);
					}else if ( $dem_show_event_filter_result == 'result_show_past_events' ){
						$dem_arguments['meta_query'] = array(
							'relation' => 'AND',
							array(
								'key' => 'dp_event_end_date',
								'value' => strtotime($start_date_thisyear),
								'compare' => '>='
							),
							array(
								'key' => 'dp_event_start_date',
								'value' => strtotime($end_date_thisyear),
								'compare' => '<='
							),
							array(
								'key' 		=> 'dp_event_end_date',
								'value' 	=>  strtotime($dem_current_date),
								'compare' 	=> '<=', 
							)
						);
					}else{
						$dem_arguments['meta_query'] = array(
							'relation' => 'AND',
							array(
								'key' => 'dp_event_end_date',
								'value' => strtotime($start_date_thisyear),
								'compare' => '>='
							),
							array(
								'key' => 'dp_event_start_date',
								'value' => strtotime($end_date_thisyear),
								'compare' => '<='
							)
						);
					}
				}
			}
			if ( $hide_sorting_filter != 'on' && $dem_grid_show_filter_options == 'dem_display_dropdown_filter' ){
				// Order & Orderby
				if ( isset($_GET["dem_sort"]) ){ $dem_orderby = sanitize_key($_GET["dem_sort"]);}
				if ( 'date_desc' !== $dem_orderby ) {
					switch ( $dem_orderby ) {
							case 'date_asc' :
								$dem_arguments['orderby'] = 'date';
								$dem_arguments['order'] = 'ASC';
								break;
							case 'title_asc' :
								$dem_arguments['orderby'] = 'title';
								$dem_arguments['order'] = 'ASC';
								break;
							case 'title_desc' :
								$dem_arguments['orderby'] = 'title';
								$dem_arguments['order'] = 'DESC';
								break;
							case 'rand' :
								$dem_arguments['orderby'] = 'rand';
								break;
							case 'event_start_desc' :
								$dem_arguments['orderby'] = 'meta_value_num';
								$dem_arguments['order'] = 'DESC';
								$dem_arguments['meta_key'] = 'dp_event_start_date';
								break;
							case 'event_start_asc' :
								$dem_arguments['orderby'] = 'meta_value_num';
								$dem_arguments['order'] = 'ASC';
								$dem_arguments['meta_key'] = 'dp_event_start_date';
								break;
						}
				} else {
					$dem_arguments['orderby'] = 'date';
					$dem_arguments['order'] = 'DESC';
				}
			}
			if ( $hide_category_filter != 'on' ){
				// event category filter
				if(isset($_GET["dem_cat"]) && is_numeric($_GET["dem_cat"]) && $_GET["dem_cat"]!='')
				{	
					$dem_cat = intval($_GET["dem_cat"]);
					$dem_arguments['tax_query'] = array(
							array(

								'taxonomy' => 'event_category',
								'field' => 'term_id',
								'terms' => $dem_cat,
								'operator' => 'IN'
							),
					);
				}
			}
			if ( $hide_all_today_week_month_filter != 'on' ){
				if( isset($_GET["dem_filter"]) && $_GET["dem_filter"]=='' ){
							//show upcomming events
							if( $dem_show_event_filter_result == 'result_show_upcomming_events' ){
								$dem_current_date = gmdate('d-m-Y');
								$dem_arguments['meta_query']  = array(
									array(
										'key' 		=> 'dp_event_end_date',
										'value' 	=>  strtotime($dem_current_date),
										'compare' 	=> '>=', 
									),
								);	
							}else if( $dem_show_event_filter_result == 'result_show_past_events' ){ //show past events
								$dem_current_date = gmdate('d-m-Y');
								$dem_arguments['meta_query']  = array(
									array(
										'key' 		=> 'dp_event_end_date',
										'value' 	=>  strtotime($dem_current_date),
										'compare' 	=> '<=', 
									),
								 );
							}else{}
				 }
			 }else{
			 	 //show upcomming events
				if( $dem_show_event_filter_result == 'result_show_upcomming_events' ){
					$dem_current_date = gmdate('d-m-Y');
					$dem_arguments['meta_query']  = array(
						array(
							'key' 		=> 'dp_event_end_date',
							'value' 	=>  strtotime($dem_current_date),
							'compare' 	=> '>=', 
						),
					);	
				}else if( $dem_show_event_filter_result == 'result_show_past_events' ){ //show past events
					$dem_current_date = gmdate('d-m-Y');
					$dem_arguments['meta_query']  = array(
						array(
							'key' 		=> 'dp_event_end_date',
							'value' 	=>  strtotime($dem_current_date),
							'compare' 	=> '<=', 
						),
					 );
				}else{}
			 }
		  }else{
		  	//show upcomming events
			if( $dem_show_event == "show_upcomming_events" ){
				$dem_current_date = gmdate('d-m-Y');
				$dem_arguments['meta_query']  = array(
					array(
						'key' 		=> 'dp_event_end_date',
						'value' 	=>  strtotime($dem_current_date),
						'compare' 	=> '>=', 
					),
				);	
			}else if( $dem_show_event == "show_past_events" ){ //show past events
				$dem_current_date = gmdate('d-m-Y');
				$dem_arguments['meta_query']  = array(
					array(
						'key' 		=> 'dp_event_end_date',
						'value' 	=>  strtotime($dem_current_date),
						'compare' 	=> '<=', 
					),
	
				);
			}else{}
		  }//nonce verify
		} // end Dropdown Filter
		if ( $use_current_loop == 'on' && ( is_tax( 'event_category' ) || is_tax( 'event_tag' ) ) ) {
			if ( is_tax( 'event_category' ) ) { 
				$include_categories = (string) get_queried_object_id();
				$dem_arguments['tax_query'] = array(
						array(
							'taxonomy' => 'event_category',
							'field' => 'term_id',
							'terms' => explode(",", $include_categories),
							'operator' => 'IN'
						),
				);
			} else if ( is_tax( 'event_tag' ) ) {
				$include_tags =  (string) get_queried_object_id();
				$dem_arguments['tax_query'] = array(
						array(
							'taxonomy' => 'event_tag',
							'field' => 'term_id',
							'terms' => explode(",", $include_tags),
							'operator' => 'IN'
						),
				);
			} else  {}
		}
		$dem_grid_query = new WP_Query($dem_arguments);
		//Query
		if ( $dem_grid_show_filter_options == 'dem_display_dropdown_filter' ) {
			
			if ( $divi_dem_multi_lan == 'on'){
				$dem_filter_cat_op 					= __('All Categories', 'dpevent' );
				$dem_filter_cat_evt_op 				= __('All Events', 'dpevent' );
				$dem_filter_today_op 				= __('Today', 'dpevent' );
				$dem_filter_week_op 				= __('This Week', 'dpevent' );
				$dem_filter_month_op 				= __('This Month', 'dpevent' );
				$dem_filter_year_op 				= __('This Year', 'dpevent' );
				$dem_filter_sort_op 				= __('Default Sorting', 'dpevent' ); 
				$dem_filter_dno_op 					= __('Date: new to old', 'dpevent' ); 
				$dem_filter_dow_op 					= __('Date: old to new', 'dpevent' ); 
				$dem_filter_taz_op 					= __('Title: a-z', 'dpevent' ); 
				$dem_filter_tza_op 					= __('Title: z-a', 'dpevent' ); 
				$dem_filter_sdd_op 					= __('Event Start Date : DESC', 'dpevent' ); 
				$dem_filter_sda_op 					= __('Event Start Date : ASC', 'dpevent' ); 
				$dem_filter_ran_op 					= __('Random', 'dpevent' ); 
				$dem_filter_reset_op 				= __('Reset', 'dpevent' );
				$dem_filter_sa_result_op 			= __('Showing all {totalcount} results', 'dpevent' );
			}else{
				$dem_filter_cat_op 					= et_get_option($dem_themename.'_dem_filter_cat_op','All Categories'); 
				$dem_filter_cat_evt_op 				= et_get_option($dem_themename.'_dem_filter_cat_evt_op','All Events'); 
				$dem_filter_today_op 				= et_get_option($dem_themename.'_dem_filter_today_op','Today'); 
				$dem_filter_week_op 				= et_get_option($dem_themename.'_dem_filter_week_op','This Week'); 
				$dem_filter_month_op 				= et_get_option($dem_themename.'_dem_filter_month_op','This Month'); 
				$dem_filter_year_op 				= et_get_option($dem_themename.'_dem_filter_year_op','This Year'); 
				$dem_filter_sort_op 				= et_get_option($dem_themename.'_dem_filter_sort_op','Default Sorting'); 
				$dem_filter_dno_op 					= et_get_option($dem_themename.'_dem_filter_dno_op','Date: new to old'); 
				$dem_filter_dow_op 					= et_get_option($dem_themename.'_dem_filter_dow_op','Date: old to new'); 
				$dem_filter_taz_op 					= et_get_option($dem_themename.'_dem_filter_taz_op','Title: a-z'); 
				$dem_filter_tza_op 					= et_get_option($dem_themename.'_dem_filter_tza_op','Title: z-a'); 
				$dem_filter_sdd_op 					= et_get_option($dem_themename.'_dem_filter_sdd_op','Event Start Date : DESC'); 
				$dem_filter_sda_op 					= et_get_option($dem_themename.'_dem_filter_sda_op','Event Start Date : ASC'); 
				$dem_filter_ran_op 					= et_get_option($dem_themename.'_dem_filter_ran_op','Random'); 
				$dem_filter_reset_op 				= et_get_option($dem_themename.'_dem_filter_reset_op','Reset'); 
				$dem_filter_sa_result_op 			= et_get_option($dem_themename.'_dem_filter_sa_result_op','Showing all {totalcount} results'); 
				
			}
			$dem_filter_sa_result_op_cnt			 = str_replace('{totalcount}', $dem_grid_query->found_posts, $dem_filter_sa_result_op);
			$dem_grid_nonce = wp_create_nonce( 'dem_grid_nonce' );
			$dem_grid_output .= '<form method="get" class="dem_event_search_form" id="gridview">
									<div class="list_grid_row et_pb_gutters1 et_pb_row">
										<div class="list_grid_col et_pb_column et_pb_column_1_4">';
										//if ( isset($_GET['dem_sort']) || isset($_GET['dem_filter']) || isset($_GET['dem_cat']) ){
											$dem_grid_output .= '<p class="p_reset">'.__($dem_filter_sa_result_op_cnt,'dpevent').'</p>';
										// }
										$dem_grid_output .= '</div>
										<div class="et_pb_column et_pb_column_3_4">
											<div class="list_grid_filter_setting">';
										 if ( $hide_all_today_week_month_filter != 'on' ){
											$p_category_select_defaultview= (isset($_GET["dem_filter"]) && $_GET["dem_filter"] == "")? ' selected="selected" ' : '';
											$p_category_select_today = (isset($_GET["dem_filter"]) && $_GET["dem_filter"] == "today")? 'selected="selected"' : '';  
											$p_category_select_thisweek = (isset($_GET["dem_filter"]) && $_GET["dem_filter"] == "thisweek")? 'selected="selected"' : '';  
											$p_category_select_thismonth = (isset($_GET["dem_filter"]) && $_GET["dem_filter"] == "thismonth")? 'selected="selected"' : '';  
											$p_category_select_thisyear = (isset($_GET["dem_filter"]) && $_GET["dem_filter"] == "thisyear")? 'selected="selected"' : '';  
											$dem_grid_output .= '<select name="dem_filter" class="dem_v2_filter"  onchange="this.form.submit()">
													<option value="" '.esc_attr($p_category_select_defaultview).' >'.__($dem_filter_cat_evt_op,'dpevent').'</option>
													<option value="today" '.esc_attr($p_category_select_today).' >'.__($dem_filter_today_op,'dpevent').'</option>
													<option value="thisweek" '.esc_attr($p_category_select_thisweek).' >'.__($dem_filter_week_op,'dpevent').'</option>
													<option value="thismonth" '.esc_attr($p_category_select_thismonth).' >'.__($dem_filter_month_op,'dpevent').'</option>
													<option value="thisyear" '.esc_attr($p_category_select_thisyear).' >'.__($dem_filter_year_op,'dpevent').'</option>
												</select>';
										 }
										 if ( $hide_category_filter != 'on' ){
												if ( $dem_grid_category == 'all'){
													$event_cat_terms = get_terms('event_category', array('hide_empty' => '0'));   
												}else{
													$event_cat_terms = get_terms('event_category', array('hide_empty' => '0','include'=>$include_categories));
												}
												$dem_grid_output .= '<select name="dem_cat" class="dem_v2_filter"  onchange="this.form.submit()">
													<option value="">'.__($dem_filter_cat_op ,'dpevent').'</option>';
													  foreach ( $event_cat_terms as $event_cat_term ):
													  $p_category_select = (isset($_GET['dem_cat']) && $_GET['dem_cat'] == $event_cat_term->term_id )? ' selected="selected" ' : '';
													  $dem_grid_output .= '<option value="'.esc_attr($event_cat_term->term_id).'" '.esc_attr($p_category_select).'>'.esc_attr($event_cat_term->name).'</option>'; 		
													  endforeach;
												$dem_grid_output .= '</select>';
											}
										 if ( $hide_sorting_filter != 'on' ){
												$p_category_select_default = (isset($_GET["dem_sort"]) && $_GET["dem_sort"] == "")? ' selected="selected" ' : '';
												$p_category_select_date_desc = (isset($_GET["dem_sort"]) && $_GET["dem_sort"] == "date_desc")? 'selected="selected" ' : '';
												$p_category_select_date_asc = (isset($_GET["dem_sort"]) && $_GET["dem_sort"] == "date_asc")? 'selected="selected" ' : '';
												$p_category_select_title_asc = (isset($_GET["dem_sort"]) && $_GET["dem_sort"] == "title_asc")? 'selected="selected" ' : '';
												$p_category_select_title_desc = (isset($_GET["dem_sort"]) && $_GET["dem_sort"] == "title_desc")? 'selected="selected" ' : '';
												$p_category_select_event_start_desc = (isset($_GET["dem_sort"]) && $_GET["dem_sort"] == "event_start_desc")? 'selected="selected" ' : '';
												$p_category_select_event_start_asc = (isset($_GET["dem_sort"]) && $_GET["dem_sort"] == "event_start_asc")? 'selected="selected" ' : '';
												$p_category_select_rand = (isset($_GET["dem_sort"]) && $_GET["dem_sort"] == "rand")? 'selected="selected" ' : ''; 
												$dem_grid_output .= '<select name="dem_sort" class="dem_v2_filter"  onchange="this.form.submit()">
													<option value="default" '.esc_attr($p_category_select_default).' >'.__($dem_filter_sort_op,'dpevent').'</option>
													<option value="date_desc" '.esc_attr($p_category_select_date_desc).' >'.__($dem_filter_dno_op,'dpevent').'</option>
													<option value="date_asc" '.esc_attr($p_category_select_date_asc).' >'.__($dem_filter_dow_op,'dpevent').'</option>
													<option value="title_asc" '.esc_attr($p_category_select_title_asc).' >'.__($dem_filter_taz_op,'dpevent').'</option>
													<option value="title_desc" '.esc_attr($p_category_select_title_desc).' >'.__($dem_filter_tza_op,'dpevent').'</option>
													<option value="event_start_desc" '.esc_attr($p_category_select_event_start_desc).' >'.__($dem_filter_sdd_op,'dpevent').'</option>
													<option value="event_start_asc" '.esc_attr($p_category_select_event_start_asc).' >'.__($dem_filter_sda_op,'dpevent').'</option>
													<option value="rand" '.esc_attr($p_category_select_rand).' >'.__($dem_filter_ran_op,'dpevent').'</option>
												</select>';
											}	
										 $dem_grid_output .= '<input type="hidden" value='.esc_attr ($dem_grid_nonce).' name="dem_wpnonce" id="dem_wpnonce"/>';
										 if (  isset($_GET['dem_sort']) || isset($_GET['dem_filter']) || isset($_GET['dem_cat'])  ){
											$dem_grid_output .= '<div class="p_reset"><a href="'.esc_url($current_url).'">'.__($dem_filter_reset_op,"dpevent").'</a></div>';
											?>
											<script type="text/javascript">
											jQuery(document).ready(function($){
												jQuery('html, body').animate({
														scrollTop: jQuery("#gridview").offset().top
													}, 1000);
												});
											</script>
											<?php
										 } 
							$dem_grid_output .= '</div></div></div></form>';
		}
		if ( $dem_grid_column == 'col4'){
			$dem_column_class = 'et_pb_column_1_4';
			$dem_condition = '4';
		}else if ( $dem_grid_column == 'col3'){
			$dem_column_class = 'et_pb_column_1_3';
			$dem_condition = '3';
		} else if ( $dem_grid_column == 'col2'){
			$dem_column_class = 'et_pb_column_1_2';
			$dem_condition = '2';
		} else{
			$dem_column_class = 'et_pb_column_1_3';
			$dem_condition = '3';
		}
		// Find Files From Child Theme. If Found then call from theme otherwise files call from plugin
		$dem_template_path 	=  get_stylesheet_directory() . '/divi-eventmanager';
		$dem_grid_path 		=  $dem_template_path.'/grid';
		
		if ( $divi_dem_multi_lan == 'on'){
			$divi_dem_ticket_start_from 	= __('Ticket Start From', 'dpevent'); 
			$dem_evt_to 					= __('to', 'dpevent'); 
			$dem_evt_at						= __('at', 'dpevent'); 
			$dem_evt_on 					= __('on', 'dpevent'); 
			$divi_dem_no_result 			= __('Sorry, no events were found.', 'dpevent'); 
		}else{
			$divi_dem_ticket_start_from 	= et_get_option($dem_themename.'_dem_ticket_start_from','Ticket Start From'); 
			$dem_evt_to 					= et_get_option($dem_themename.'_dem_evt_to','to'); 
			$dem_evt_at						= et_get_option($dem_themename.'_dem_evt_at','at'); 
			$dem_evt_on 					= et_get_option($dem_themename.'_dem_evt_on','on'); 
			$divi_dem_no_result 			= et_get_option($dem_themename.'_dem_no_result','Sorry, no events were found.'); 
		}
		
		$i = 1;
		if ( $dem_grid_query->have_posts() ) {

			while ( $dem_grid_query->have_posts() ) {
				$dem_grid_query->the_post();             
				ob_start();
				$last_child = '';
				$dp_event_thumb = array();
				if ($i % $dem_condition == 0 ){ $last_child = 'et-last-child'; }
				$dp_event_thumb = wp_get_attachment_image_src(get_post_thumbnail_id(), 'dem_grid_400_400');
				if( $dp_event_thumb[0] != ''){ 
					$image_path = $dp_event_thumb[0] ;
				}else{ 
					$image_path = DEM_PLUGIN_URL. '/assets/images/default.png';
				} 
				$event_thumbnail_image_url      =   $image_path;
				$target_blank  = '';
				//$event_permalink 				= get_the_permalink(get_the_ID());
				$dpevent_custom_link 			= get_post_meta( get_the_ID(), 'dpevent_custom_link', true );
				$dp_event_page_link_type 		= get_post_meta( get_the_ID(), 'dp_event_page_link_type', true );
				if ( $dp_event_page_link_type == 'default' ){
					if ( $dem_link_type == 'customlink' && $dpevent_custom_link != '' ){
						$event_permalink 				= $dpevent_custom_link;
						$target_blank  = ' target="_blank" ';
					}else{
						$event_permalink 				= get_the_permalink(get_the_ID());
					}
				}else if( $dp_event_page_link_type == 'posttypelink' ){
					$event_permalink 				= get_the_permalink(get_the_ID());
				}else if( $dp_event_page_link_type == 'customeventlink' && $dpevent_custom_link != '' ){
					$event_permalink 				= $dpevent_custom_link;
					$target_blank  = ' target="_blank" ';
				}else{
					$event_permalink 				= get_the_permalink(get_the_ID());
				}
				
				$event_title                    =  get_the_title(get_the_ID());
				$event_start_date               =  get_post_meta(get_the_ID(), 'dp_event_start_date',true);
				$event_end_date                 =  get_post_meta(get_the_ID(), 'dp_event_end_date',true);
				$event_start_time               =  get_post_meta(get_the_ID(), 'dp_event_start_time',true);
				$event_end_time                 =  get_post_meta(get_the_ID(), 'dp_event_end_time',true);
				$event_venue                    =  get_post_meta(get_the_ID() ,'dpevent_address', true );
				$event_city                     =  get_post_meta(get_the_ID() ,'dpevent_city', true );
				$event_state                    =  get_post_meta(get_the_ID() ,'dpevent_state', true );
				$event_country                  =  get_post_meta(get_the_ID() ,'dpevent_country', true );
				$event_ticket_cost              =  get_post_meta(get_the_ID(), 'dpevent_cost_name', true);
				$event_ticket_cost_currency     =  get_post_meta(get_the_ID(), 'dp_event_currency_symbol_name', true);
				$event_ticket_currency_position =  get_post_meta(get_the_ID(), 'dp_event_currency_prefix_suffix', true);
				$event_readmore_btn_text        =  $dem_grid_readmore_txt;
				$event_content 					=  get_the_excerpt();

				$event_venue_address = $dem_grid_title_val ='';
				if( $event_venue != ''){
					$event_venue_address .= $event_venue.', ';
				}
				if( $event_city != ''){
					$event_venue_address .= $event_city.', ';
				}
				if( $event_state != ''){
					$event_venue_address .= $event_state.', ';
				}
				if( $event_country != ''){
					$event_venue_address .= $event_country.', ';
				}
				if ( '' !== $event_title ) {
					if( $dem_select_style == 'style1' ){
						$dem_grid_title_val = sprintf(
							'<%1$s class="et_pb_module_header dem_grid_title">%2$s</%1$s>', et_pb_process_header_level($header_level, 'h3'), esc_attr($event_title)
						);
					}else{
						$dem_grid_title_val = sprintf(
							'<%1$s class="et_pb_module_header dem_grid_title"><a href="%3$s" %4$s>%2$s</a></%1$s>', et_pb_process_header_level($header_level, 'h3'), esc_attr($event_title), esc_url($event_permalink), esc_attr($target_blank)
						);
					}
					
				}
				if ( file_exists( $dem_grid_path . '/dem_grid_'.$dem_select_style.'.php' ) )
				{
					include $dem_grid_path. '/dem_grid_'.$dem_select_style.'.php';
				}else{
					include DEM_PLUGIN_PATH. 'include/divi-layout-style/grid/dem_grid_'.$dem_select_style.'.php';
				}
				$dem_grid_output .= ob_get_contents();
				ob_end_clean();
				$i++;
			}
		}else{
			$dem_grid_output .= esc_html__($divi_dem_no_result, 'dpevent');
		}
		if ($dem_grid_view_pagination == 'on' && $dem_grid_query->max_num_pages > 1 ) {
				$dem_grid_output .= '<div class="et_pb_row_custom_pagination pagination-container"><nav class="navigation dem_pagination"><div class="nav-links">';
				$dem_grid_output .= paginate_links(array(
					'format' => 'page/%#%',
					'current' => max(1, $paged),
					'total' => $dem_grid_query->max_num_pages,
					'prev_text' => __('<span class="et-pb-icon">&#x34;</span>', 'dpevent'),
					'next_text' => __('<span class="et-pb-icon">&#x35;</span>', 'dpevent'),
				));
				$dem_grid_output .= '</div></nav></div>';
		}
		wp_reset_postdata();
		return $dem_grid_output;
	}
}
new DPEVENT_Grid;