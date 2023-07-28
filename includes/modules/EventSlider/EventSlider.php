<?php
class DPEVENT_Slider extends ET_Builder_Module {
	public $slug       = 'dpevent_slider';
	public $vb_support = 'on';
    protected $module_credits = array(
        'module_uri' => 'https://divi-professional.com/',
        'author' => 'Divi Professional',
        'author_uri' => 'https://divi-professional.com/',
    );

    public function init() {
        $this->name = esc_html__('DP Event Slider', 'dpevent');
        $this->main_css_element = '%%order_class%%';
		$this->icon_path        = plugin_dir_path( __FILE__ ). 'dem.svg';
    }

    public function get_settings_modal_toggles() {
        return array(
            'general' => array(
                'toggles' => array(
                    'main_content'   => esc_html__('General Settings', 'dpevent'),
                    'slider_setting' => esc_html__('Slider Settings', 'dpevent'),
					'tagcat_setting' => esc_html__('Tag/Category Settings', 'dpevent'),
					'display_setting'=> esc_html__('Display On/Off', 'dpevent'),
                ),
            ),
            'advanced' => array(
                'toggles' => array(
                    'dem_color_setting' => array(
                        'title' => esc_html__('Slider/Style Color Settings', 'dpevent'),
                    ),
                ),
            )
        );
    }

    public function get_advanced_fields_config() {
        return array(
            'fonts' => array(
                'header' => array(
								'label' 	=> esc_html__('Title', 'dpevent'),
								'css' 		=> array(
												'main' 		 => "%%order_class%% .dem_slider_title a, 
																 %%order_class%% .dem_slider_title",
												'text_align' => "%%order_class%% .dem_slider_title",
												'important'  => 'all',
								),
								'font_size'  => array(
												 'default' => '20px',
								),
								'line_height' => array(
												'default' => '1.3em',
								),
								'header_level' => array(
												'default' => 'h3',
												'computed_affects' => array('__dem_slider',),
								),
                ),
                'dem_description_name_fonts' => array(
								'label' 	=> esc_html__('Event Description', 'dpevent'),
								'css' 		=> array(
												'main' 		 => "%%order_class%% .dem_slider_style2 .dem_slide_styler2_event_text",
												'text_align' => "%%order_class%% .dem_slider_style2 .dem_slide_styler2_event_text",
												'important'  => 'all',
								),
								'font_size'  => array(
												'default' => '15px',
								)
                ),
                'dem_catogory_name_fonts' => array(
								'label' 	=> esc_html__('Event Category/Address', 'dpevent'),
								'css' 		=> array(
												'main' 		=> "%%order_class%% .dem_slider_style1_category,
																%%order_class%% .dem_slider_style2 .dem_slider_style2_detail .dem_slider_style2_venue",
												'important' => 'all',
								),
								'font_size' => array(
											'default' => '15px',
								),
								'hide_text_align' => true,
								//'depends_on'      => 'dpevent_grid_show_category',
								//'depends_show_if' => 'on',
                ),
                'dem_date_fonts' => array(
								'label' 	=> esc_html__('Event Date', 'dpevent'),
								'css' 		=> array(
												'main' 		=> "%%order_class%% .dem_slider_style1_duration ,
															   %%order_class%% .dem_slider_style2 .item .dem-event-date .dem-event-month,
															   %%order_class%% .dem_slider_style2 .item .dem-event-date .dem-event-day,
															   %%order_class%% .dem_slider_style3 .dem_event_date",
												'text_align' => "%%order_class%% .dem_slider_style1_duration,
																 %%order_class%% .dem_slider_style3 .dem_event_date",
												'important'  => 'all',
								),
								'font_size' => array(
												'default' => '15px',
								),
								//'depends_on' => 'dpevent_grid_show_date',
								//'depends_show_if' => 'on',
                ),
                'dem_time_fonts' => array(
								'label' 		=> esc_html__('Event Time', 'dpevent'),
								'css' 			=> array(
												'main' 		 => "%%order_class%% .dem_slider_style2 .item .dem-event-date .dem-event-time",
												'text_align' => "%%order_class%% .dem_slider_style2 .item .dem-event-date .dem-event-time",
												'important'  => 'all',
								),
								'font_size' => array(
									'default' => '15px',
								),
                ),
            ),
            'margin_padding' => array(
                'css' => array(
						'padding' 	=> "%%order_class%% .dem_slider_style1 .dem_column_slider_view, 
										%%order_class%% .dem_slider_style3 .dem_slider_style3_item_inner,
										%%order_class%% .dem_slider_style2 .item a",
						'margin' 	=> "%%order_class%% .owl-carousel.owl-drag .owl-item",
						'important' => 'all',
                ),
            ),
            'borders'               => array(
				'default' => array(
					'css' => array(
						'main' => array(
							'border_radii'  => "%%order_class%% .item",
							'border_styles' => "%%order_class%% .item",
						),
					),
				),
			),
			'box_shadow'            => array(
				'default' => array(
					'css' => array(
						'main'    => '%%order_class%% .item',
						'hover'   => '%%order_class%% .item:hover',
					),
				),
			),
            'background' => array(
					'css' 				  => array(                    
									'main' => "%%order_class%% .item",
									'important' => 'all',
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
        $fields = $this->dem_slider_get_general_fields($fields);
		$fields = $this->dem_slider_get_display_tag_cat_fields($fields);
        $fields = $this->dem_get_slider_fields($fields);
		$fields = $this->dem_slider_get_display_fields($fields);
        $fields = $this->dem_slider_style_color_fields($fields);
        return $fields;
    }
	
	public function dem_slider_get_general_fields($fields) {
        $fields['dem_select_style'] = array(
            'label' 				=> esc_html__('Select Style', 'dpevent'),
            'type' 					=> 'select',
            'option_category' 		=> 'basic_option',
            'options' 				=> array(
										'style1' => esc_html__('Slider 1 Layout', 'dpevent'),
										'style2' => esc_html__('Slider 2 Layout', 'dpevent'),
										'style3' => esc_html__('Slider 3 Layout', 'dpevent'),
									),
            'default' 				=> 'style1',
            'default_on_front' 		=> 'style1',
            'description' 			=> esc_html__('Here you can select style of event slider.', 'dpevent'),
            'toggle_slug' 			=> 'main_content',
            'computed_affects' 		=> array( '__dem_slider', ),
        );
        $fields['dem_display_no_of_event_in_slider'] = array(
            'label' 				=> esc_html__('Display Number of Event on Slider', 'dpevent'),
            'type' 					=> 'text',
            'option_category' 		=> 'configuration',
            'description' 			=> esc_html__('Choose how many Display Number of Event you would like to display.', 'dpevent'),
            'default' 				=> '5',
            'default_on_front' 		=> '5',
            'toggle_slug' 			=> 'main_content',
            'computed_affects' 		=> array( '__dem_slider', ),
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
			'computed_affects' 	=> array('__dem_slider',),
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
			'computed_affects' 	=> array('__dem_slider',),
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
			'computed_affects' 	=> array('__dem_slider',),
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
			'computed_affects' 	=> array('__dem_slider',),
		);
		$fields['dem_slider_no_filter_options'] = array(
			'label' 			=> esc_html__('Show Today/Week/Month/Year Events', 'dpevent'),
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
			'description' 		=> esc_html__('Here you can display  Without Filter Options Show Today/Week/Month/Year Events.', 'dpevent'),
			'toggle_slug' 		=> 'main_content',
			'computed_affects' 	=> array('__dem_slider',),
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
					'__dem_slider',
				),
			);
        return $fields;
    }
	public function dem_slider_get_display_tag_cat_fields($fields){
		$fields['dem_slider_category'] = array(
			'label' 			=> esc_html__('Display Events By Category', 'dpevent'),
			'type' 				=> 'select',
			'option_category' 	=> 'basic_option',
								'options' => array(
									'all' => esc_html__('All', 'dpevent'),
									'specificcategory' => esc_html__('Specific Event Category', 'dpevent'),
								),
			'default' 			=> 'all',
			'default_on_front'  => 'all',
			'description' 		=> esc_html__('Here you can select event category.', 'dpevent'),
			'show_if'          => array(
				'use_current_loop' => 'off',
			),
			'toggle_slug' 		=> 'tagcat_setting',
			'computed_affects'  => array('__dem_slider',),
		);
		$fields['include_categories'] = array(
			'label' 			=> esc_html__('Specific Event Categories', 'dpevent'),
			'type'              => 'categories',
			'option_category' 	=> 'basic_option',
			'show_if'			=> array('dem_slider_category' => 'specificcategory'),
			'renderer_options'  => array(
									'use_terms' => true,
									'term_name' => 'event_category',
								),
			'description' 		=> esc_html__('Choose which categories you would like to include in the event.', 'dpevent'),
			'toggle_slug'		=> 'tagcat_setting',
			'computed_affects'  => array('__dem_slider',),
		);		
		$fields['dem_slider_tag'] = array(
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
			'show_if'          => array(
				'use_current_loop' => 'off',
			),
			'toggle_slug' 		=> 'tagcat_setting',
			'computed_affects'  => array('__dem_slider',),
		);
		$fields['include_tags'] = array(
			'label' 			=> esc_html__('Specific Tags', 'dpevent'),
			'type'              => 'categories',
			'option_category' 	=> 'basic_option',
			'show_if' 			=> array('dem_slider_tag' => 'specifictag',),
			'renderer_options'  => array(
									'use_terms' => true,
									'term_name' => 'event_tag',
								),
			'description' 		=> esc_html__('Choose which tags you would like to include in the events.', 'dpevent'),
			'toggle_slug'		=> 'tagcat_setting',
			'computed_affects'  => array('__dem_slider',),
		);
		return $fields;
	}
	public function dem_get_slider_fields($fields){
		$fields['dem_slider_show_read_more'] = array(
			'label' 			=> esc_html__('Show Read More Button', 'dpevent'),
			'type' 				=> 'yes_no_button',
			'option_category' 	=> 'configuration',
			'options' 			=> array(
									'on' => esc_html__('yes', 'dpevent'),
									'off' => esc_html__('No', 'dpevent'),
								),         
			'default_on_front' 	=> 'on',
			'show_if' 			=> array('dem_select_style' => array('style1', 'style3')),
			'description' 		=> esc_html__('Turn the read more button on or off.', 'dpevent'),
			'toggle_slug'		=> 'display_setting',
			'computed_affects'  => array('__dem_slider',),
		);
		$fields['dem_slider_read_more_button_text'] = array(
			'label' 			=> esc_html__('Read More Button Text', 'dpevent'),
			'type' 				=> 'text',
			'option_category'	=> 'configuration',
			'description' 		=> esc_html__('Enter Here Read More Button Text.', 'dpevent'),
			'show_if' 			=> array('dem_slider_show_read_more' => 'on'),
			'show_if_not' 		=> array('dem_select_style' => array('style1', 'style2')),
			'default' 			=> 'Read More',
			'toggle_slug' 		=> 'display_setting',
			'computed_affects'  => array('__dem_slider',),
		);
		return $fields;
	}
    public function dem_slider_get_display_fields($fields) {
        $fields['dem_slider_autoplay'] = array(
            'label' 			=> esc_html__('Autoplay', 'dpevent'),
            'type' 				=> 'yes_no_button',
            'option_category' 	=> 'configuration',
            'options' 			=> array(
									'on' => esc_html__('Yes', 'dpevent'),
									'off' => esc_html__('No', 'dpevent'),
								),
            'default' 			=> 'on',
            'description' 		=> esc_html__('Turn the autoplay on or off', 'dpevent'),
            'toggle_slug' 		=> 'slider_setting',
        );
        $fields['dem_slider_autoplayspeed'] = array(
            'label' 			=> esc_html__('Autoplay Slider Speed (in ms )', 'dpevent'),
            'type' 				=> 'text',
            'show_if' 			=> array('dem_slider_autoplay' => 'on'),
            'option_category' 	=> 'configuration',
            'default' 			=> '2000',
            'description' 		=> esc_html__("autoplaySpeed ( in ms ).Default is 2000.", 'dpevent'),
            'toggle_slug' 		=> 'slider_setting',
        );
        $fields['dem_slider_autoplayhoverpause'] = array(
            'label' 			=> esc_html__('Stop On Hover', 'dpevent'),
            'type' 				=> 'yes_no_button',
            'option_category' 	=> 'configuration',
            'options' 			=> array(
									'on' => esc_html__('Yes', 'dpevent'),
									'off' => esc_html__('No', 'dpevent'),
								),
            'show_if' 			=> array('dem_slider_autoplay' => 'on'),
            'default' 			=> 'on',
            'description' 		=> esc_html__('Pause on mouse hover.', 'dpevent'),
            'toggle_slug' 		=> 'slider_setting',
        );
        $fields['dem_slider_loop'] = array(
            'label' 			=> esc_html__('Slider Loop', 'dpevent'),
            'type' 				=> 'yes_no_button',
            'option_category' 	=> 'configuration',
            'options' 			=> array(
									'on' => esc_html__('Yes', 'dpevent'),
									'off' => esc_html__('No', 'dpevent'),
								),
            'default' 			=> 'on',
            'description' 		=> esc_html__('Infinity loop. Duplicate last and first items to get loop illusion.', 'dpevent'),
            'toggle_slug' 		=> 'slider_setting',
        );
        $fields['dem_slider_nav'] = array(
            'label' 			=> esc_html__('Display Arrow Navigation', 'dpevent'),
            'type' 				=> 'yes_no_button',
            'option_category' 	=> 'configuration',
            'options' 			=> array(
									'off' => esc_html__('No', 'dpevent'),
									'on' => esc_html__('Yes', 'dpevent'),
								),
            'default' 			=> 'off',
            'description' 		=> esc_html__('Turn the event Navigation on or off', 'dpevent'),
            'toggle_slug' 		=> 'slider_setting',
        );
        
        $fields['dem_slider_navspeed'] = array(
            'label' 			=> esc_html__('navSpeed (in ms )', 'dpevent'),
            'type' 				=> 'text',
            'show_if' 			=> array('dem_slider_nav' => 'on'),
            'option_category' 	=> 'configuration',
            'default' 			=> '2000',
            'description' 		=> esc_html__("Navigation speed.Default is 2000.", 'dpevent'),
            'toggle_slug' 		=> 'slider_setting',
        );
        $fields['dem_slider_dots'] = array(
            'label' 			=> esc_html__('Display Dots Navigation', 'dpevent'),
            'type' 				=> 'yes_no_button',
            'option_category' 	=> 'configuration',
            'options' 			=> array(
									'on' => esc_html__('yes', 'dpevent'),
									'off' => esc_html__('No', 'dpevent'),
								),
            'default' 			=> 'on',
            'description' 		=> esc_html__('Turn the posts Dots Navigation on or off', 'dpevent'),
            'toggle_slug' 		=> 'slider_setting',
        );
        $fields['dem_slider_dotsspeed'] = array(
            'label' 			=> esc_html__('Dots Navigation Speed (in ms )', 'dpevent'),
            'type' 				=> 'text',
            'show_if' 			=> array('dem_slider_dots' => 'on'),
            'option_category' 	=> 'configuration',
            'default' 			=> '2000',
            'description' 		=> esc_html__("dots Navigation speed.Default is 2000.", 'dpevent'),
            'toggle_slug' 		=> 'slider_setting',
        );
        $fields['dem_slider_responsive_480to980'] = array(
            'label' 			=> esc_html__('Responsive : Display items between 481 to 980 device width per slide', 'dpevent'),
            'type' 				=> 'select',
            'option_category' 	=> 'basic_option',
            'options' 			=> array(
									'1' => esc_html__('1', 'dpevent'),
									'2' => esc_html__('2', 'dpevent'),
									'3' => esc_html__('3', 'dpevent'),
								),
            'default' 			=> '2',
            'description' 		=> esc_html__('Responsive Display items between 481 to 980 device width per slide', 'dpevent'),
            'toggle_slug' 		=> 'slider_setting',
        );
        $fields['dem_slider_responsive_980to1024'] = array(
            'label' 			=> esc_html__('Responsive : Display items between 981 to 1024 device width per slide', 'dpevent'),
            'type' 				=> 'select',
            'option_category' 	=> 'basic_option',
            'options' 			=> array(
									'1' => esc_html__('1', 'dpevent'),
									'2' => esc_html__('2', 'dpevent'),
									'3' => esc_html__('3', 'dpevent'),
								),
            'default' 			=> '2',
            'description' 		=> esc_html__('Responsive Display items between 981 to 1024 device width per slide', 'dpevent'),
            'toggle_slug' 		=> 'slider_setting',
        );
        $fields['dem_slider_responsive_1024to1800'] = array(
            'label' 			=> esc_html__('Responsive : Display items between 1025 to 1800 device width per slide', 'dpevent'),
            'type' 				=> 'select',
            'option_category' 	=> 'basic_option',
            'options' 			=> array(
									'1' => esc_html__('1', 'dpevent'),
									'2' => esc_html__('2', 'dpevent'),
									'3' => esc_html__('3', 'dpevent'),
									'4' => esc_html__('4', 'dpevent'),
								),
            'default' 			=> '3',
            'description' 		=> esc_html__('Responsive Display items between 1025 to 1800 device width per slide', 'dpevent'),
            'toggle_slug' 		=> 'slider_setting',
        );
        $fields['dem_slider_responsive_1800toabove'] = array(
            'label' 			=> esc_html__('Responsive : Display items from 1800 up device width per slide', 'dpevent'),
            'type' 				=> 'select',
            'option_category' 	=> 'basic_option',
            'options' 			=> array(
									'1' => esc_html__('1', 'dpevent'),
									'2' => esc_html__('2', 'dpevent'),
									'3' => esc_html__('3', 'dpevent'),
									'4' => esc_html__('4', 'dpevent'),
									'5' => esc_html__('5', 'dpevent'),
								),
            'default' 			=> '3',
            'description' 		=> esc_html__('Responsive Display items from 1800 up device width per slide', 'dpevent'),
            'toggle_slug' 		=> 'slider_setting',
        );
        return $fields;
    }
    public function dem_slider_style_color_fields($fields) {
		$fields['dem_slider_nav_arrow_color'] = array(
            'label' 			=> esc_html__('Navigation Arrow Color', 'dpevent'),
            'type' 				=> 'color-alpha',
            'show_if' 			=> array('dem_slider_nav' => 'on'),
            'custom_color' 		=> true,
            'default' 			=> '#ffffff',
            'toggle_slug' 		=> 'dem_color_setting',
            'hover' 			=> 'tabs',
			'tab_slug'    		=> 'advanced',
        );
        $fields['dem_slider_nav_arrow_background_color'] = array(
            'label' 			=> esc_html__('Navigation Arrow Background Color', 'dpevent'),
            'type'				=> 'color-alpha',
            'show_if' 			=> array('dem_slider_nav' => 'on'),
            'custom_color' 		=> true,
            'default' 			=> '#808080',
            'toggle_slug' 		=> 'dem_color_setting',
            'hover' 			=> 'tabs',
			'tab_slug'    		=> 'advanced',
        );
	    $fields['dem_slider_dots_color'] = array(
            'label' 			=> esc_html__('Dot Navigation Background Color', 'dpevent'),
            'type' 				=> 'color-alpha',
            'show_if' 			=> array('dem_slider_dots' => 'on'),
            'custom_color' 		=> true,
            'default' 			=> '#D6D6D6',
            'toggle_slug' 		=> 'dem_color_setting',
			'tab_slug'    		=> 'advanced',
        );
        $fields['dem_slider_dots_active_color'] = array(
            'label' 			=> esc_html__('Dot Navigation Active/Hover Background Color', 'dpevent'),
            'type' 				=> 'color-alpha',
            'show_if' 			=> array('dem_slider_dots' => 'on'),
            'custom_color' 		=> true,
            'default' 			=> '#869791',
            'toggle_slug' 		=> 'dem_color_setting',
			'tab_slug'    		=> 'advanced',
        );
        $fields['style1_image_overlay_hover_color'] = array(
            'label' 			=> esc_html__('Style1 Image Overlay Hover Color', 'dpevent'),
            'type' 				=> 'color-alpha',
            'show_if' 			=> array('dem_select_style' => 'style1'),
            'custom_color' 		=> true,
            'toggle_slug' 		=> 'dem_color_setting',
            'tab_slug'    		=> 'advanced',
        );
        $fields['style1_image_icon_color'] = array(
            'label' 			=> esc_html__('Style1 Date & Category Icon Color', 'dpevent'),
            'type' 				=> 'color-alpha',
            'show_if' 			=> array('dem_select_style' => 'style1'),
            'custom_color' 		=> true,
            'toggle_slug' 		=> 'dem_color_setting',
            'tab_slug'    		=> 'advanced',
        );   
		 $fields['style1_readmore_bk_color'] = array(
            'label' 			=> esc_html__('Style1 Read More Background Color', 'dpevent'),
            'type' 				=> 'color-alpha',
            'show_if' 			=> array('dem_select_style' => 'style1'),
            'custom_color' 		=> true,
			'hover' 			=> 'tabs',
            'toggle_slug' 		=> 'dem_color_setting',
            'tab_slug'    		=> 'advanced',
        );  
		$fields['style1_readmore_icon_color'] = array(
            'label' 			=> esc_html__('Style1 Read More Icon Color', 'dpevent'),
            'type' 				=> 'color-alpha',
            'show_if' 			=> array('dem_select_style' => 'style1'),
            'custom_color' 		=> true,
			'hover' 			=> 'tabs',
            'toggle_slug' 		=> 'dem_color_setting',
            'tab_slug'    		=> 'advanced',
        );     
        $fields['style3_readmore_color'] = array(
            'label' 			=> esc_html__('Style3 Read More Color', 'dpevent'),
            'type' 				=> 'color-alpha',
            'show_if' 			=> array('dem_select_style' => 'style3'),
            'custom_color' 		=> true,
            'toggle_slug' 		=> 'dem_color_setting',
            'tab_slug'    		=> 'advanced',
            'hover' 			=> 'tabs',
        );   
        $fields['style3_readmore_bg_color'] = array(
            'label' 		    => esc_html__('Style3 Read More Background Color', 'dpevent'),
            'type' 			    => 'color-alpha',
            'show_if' 			=> array('dem_select_style' => 'style3'),
            'custom_color' 		=> true,
            'toggle_slug' 		=> 'dem_color_setting',
            'tab_slug'    		=> 'advanced',
            'hover' 			=> 'tabs',
        ); 
        $fields['style3_readmore_border_color'] = array(
            'label' 			=> esc_html__('style3 Read More Border Color', 'dpevent'),
            'type' 				=> 'color-alpha',
            'show_if' 			=> array('dem_select_style' => 'style3'),
            'custom_color' 		=> true,
            'toggle_slug' 		=> 'dem_color_setting',
            'tab_slug'    		=> 'advanced',
            'hover' 			=> 'tabs',
        );   
        $fields['dem_hidden_field_plugin_url'] = array(
            'label' 		  => esc_html__('no label', 'dpevent'),
            'type' 			  => 'hidden',
            'default' 		  => DEM_PLUGIN_URL,
            'toggle_slug' 	  => 'dem_color_setting',
			'tab_slug'    	  => 'advanced',
        );
        $fields['__dem_slider'] = array(
            'type' 					=> 'computed',
            'computed_callback' 	=> array('DPEVENT_Slider', 'dem_slider_compute'),
            'computed_depends_on'   => array(
                'dem_select_style',
                'header_level',
                'dem_display_no_of_event_in_slider',
                'dem_orderby',
                'dem_show_event',
                'dem_slider_tag',
                'dem_slider_category',
                'include_tags',
                'include_categories',
                'dem_slider_show_read_more',
                'dem_slider_read_more_button_text',
				'dem_time_format',
				'dem_slider_no_filter_options',
				'dem_link_type',
				'use_current_loop',
            ),
        );
        return $fields;
    }

	
	public function dem_event_slider_asserts() {
		 if (!is_admin()) {
            wp_enqueue_style('dem_slider_owl_carousel_min_css');
            wp_enqueue_style('dem_slider_owl_theme_min_css');
            wp_enqueue_script('dem_slider_owl_corousel_min_js');
			wp_enqueue_script('dem_equalheight');
        }
	}
	
    public function render($attrs, $content = null, $render_slug) {
		$this->dem_event_slider_asserts();
        $dem_select_style 						= esc_attr( $this->props['dem_select_style'] );
        $header_level 							= esc_attr( $this->props['header_level'] );
        $dem_slider_category 					= esc_attr( $this->props['dem_slider_category'] );
        $dem_slider_tag 						= esc_attr( $this->props['dem_slider_tag'] );
        $include_tags 							= esc_attr( $this->props['include_tags'] );
        $dem_orderby 							= esc_attr( $this->props['dem_orderby'] );
        $include_categories 					= esc_attr( $this->props['include_categories'] );
        $dem_display_no_of_event_in_slider 		= esc_attr( $this->props['dem_display_no_of_event_in_slider'] );
        $dem_slider_read_more_button_text 		= esc_attr( $this->props['dem_slider_read_more_button_text'] );
        $dem_slider_show_read_more 				= esc_attr( $this->props['dem_slider_show_read_more'] );
        $dem_show_event 						= esc_attr( $this->props['dem_show_event'] );
        $dem_slider_autoplay 					= esc_attr( $this->props['dem_slider_autoplay'] );
        $dem_slider_autoplaySpeed 				= esc_attr( $this->props['dem_slider_autoplayspeed'] );
        $dem_slider_autoplayHoverPause 			= esc_attr( $this->props['dem_slider_autoplayhoverpause'] );
        $dem_slider_loop 						= esc_attr( $this->props['dem_slider_loop'] );
        $dem_slider_nav 						= esc_attr( $this->props['dem_slider_nav'] );
        $dem_slider_navSpeed 					= esc_attr( $this->props['dem_slider_navspeed'] );
        $dem_slider_dots 						= esc_attr( $this->props['dem_slider_dots'] );
        $dem_slider_dotsSpeed 					= esc_attr( $this->props['dem_slider_dotsspeed'] );
        $dem_slider_responsive_480to980 		= esc_attr( $this->props['dem_slider_responsive_480to980'] );
        $dem_slider_responsive_980to1024 		= esc_attr( $this->props['dem_slider_responsive_980to1024'] );
        $dem_slider_responsive_1024to1800 		= esc_attr( $this->props['dem_slider_responsive_1024to1800'] );
        $dem_slider_responsive_1800toabove 		= esc_attr( $this->props['dem_slider_responsive_1800toabove'] );
		$dem_time_format 				        = esc_attr( $this->props['dem_time_format'] );
		$dem_slider_no_filter_options	  	    = esc_attr( $this->props['dem_slider_no_filter_options'] );
		$dem_link_type	  	  			  = esc_attr( $this->props['dem_link_type'] );
		$use_current_loop                 = esc_attr( $this->props['use_current_loop'] );

        $dem_hidden_field_plugin_url 		    = esc_url( $this->props['dem_hidden_field_plugin_url'] );
		$order_class 							= self::get_module_order_class( $render_slug );
		$order_number							= str_replace('_','',str_replace($this->slug,'', $order_class));
		$dem_themename 					= dem_theme_name();
		$divi_dem_multi_lan 			= et_get_option($dem_themename.'_dem_multi_lan','off');
		$this->dem_slider_dot_apply_css($render_slug);
        $this->dem_slider_nav_apply_css($render_slug);
        $this->dem_slider_style_color_css($render_slug);

        /* -------------------Order-By---------------------------- */

        if ( $dem_display_no_of_event_in_slider == '' ) {
            $args = array('posts_per_page' => -1);
        } else {
            $args = array('posts_per_page' => (int) $dem_display_no_of_event_in_slider);
        }
		
       

        if ( $dem_slider_tag != 'all' && $dem_slider_category != 'all' ) {
            
			if ( !empty($include_tags) && !empty($include_categories) ) {
                $args['tax_query'] = array(
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
            if ( empty($include_tags) && !empty($include_categories) ) {
                $args['tax_query'] = array(
                    array(
                        'taxonomy' => 'event_category',
                        'field' => 'term_id',
                        'terms' => explode(",", $include_categories),
                        'operator' => 'IN'
                    ),
                );
            }
            if ( !empty($include_tags) && empty($include_categories) ) {
                $args['tax_query'] = array(
                    array(
                        'taxonomy' => 'event_tag',
                        'field' => 'term_id',
                        'terms' => explode(",", $include_tags),
                        'operator' => 'IN'
                    ),
                );
            }
			
        } else if ( $dem_slider_tag != 'all' && $dem_slider_category == 'all' ) {
		
            if ( !empty($include_tags) ) {
                $args['tax_query'] = array(
                    array(
                        'taxonomy' => 'event_tag',
                        'field' => 'term_id',
                        'terms' => explode(",", $include_tags),
                        'operator' => 'IN'
                    )
                );
            }
			
        } else if ( $dem_slider_category != 'all' && $dem_slider_tag == 'all' ) {
		
            if ( !empty($include_categories) ) {
                $args['tax_query'] = array(
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
		 // Order & Orderby
		if ( 'date_desc' !== $dem_orderby ) {
			switch ( $dem_orderby ) {
					case 'date_asc' :
						$args['orderby'] = 'date';
						$args['order'] = 'ASC';
						break;
					case 'title_asc' :
						$args['orderby'] = 'title';
						$args['order'] = 'ASC';
						break;
					case 'title_desc' :
						$args['orderby'] = 'title';
						$args['order'] = 'DESC';
						break;
					case 'rand' :
						$args['orderby'] = 'rand';
						break;
					case 'event_start_desc' :
						$args['orderby'] = 'meta_value_num';
						$args['order'] = 'DESC';
						$args['meta_key'] = 'dp_event_start_date';
						break;
					case 'event_start_asc' :
						$args['orderby'] = 'meta_value_num';
						$args['order'] = 'ASC';
						$args['meta_key'] = 'dp_event_start_date';
						break;
			}
		} else {
			$args['orderby'] = 'date';
			$args['order'] = 'DESC';
		}
		
        $args['post_type'] = 'dp_events';
		if ( $dem_slider_no_filter_options != 'default' ) {
				// Today Events
				if( $dem_slider_no_filter_options == 'dem_w_today')
				{
					$date_today= gmdate('d-m-Y');
					$args['meta_key'] = 'dp_event_start_date';
					$args['meta_query'] = array(
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
				if( $dem_slider_no_filter_options =='dem_w_month')
				{
					$start_date_thismonth = gmdate('01-m-Y',strtotime('this month'));
					$end_date_thismonth = gmdate('t-m-Y',strtotime('this month'));
					$dem_args['meta_key'] = 'dp_event_start_date';
					$dem_current_date = gmdate('d-m-Y');
					if ( $dem_show_event == 'show_upcomming_events' ){
						$args['meta_query'] = array(
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
						$args['meta_query'] = array(
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
							$args['meta_query'] = array(
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
				if( $dem_slider_no_filter_options =='dem_w_week')
				{
					$thisweek_day = gmdate('w');
					//$start_date_thisweek = gmdate('d-m-Y', strtotime('-'. $thisweek_day . ' days'));
					//$end_date_thisweek = gmdate('d-m-Y', strtotime('+' . (6 - $thisweek_day) . ' days'));
					$start_date_thisweek = gmdate("d-m-Y",strtotime('monday this week'));
					 $end_date_thisweek = gmdate("d-m-Y",strtotime("sunday this week"));
					$dem_args['meta_key'] = 'dp_event_start_date';
					$dem_current_date = gmdate('d-m-Y');
					
					if ( $dem_show_event == 'show_upcomming_events' ){
						$args['meta_query'] = array(
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
						$args['meta_query'] = array(
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
						$args['meta_query'] = array(
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
				if( $dem_slider_no_filter_options =='dem_w_year')
				{
					$start_date_thisyear = gmdate("01-01-Y", strtotime("this year"));
					$end_date_thisyear = gmdate("t-12-Y", strtotime($start_date_thisyear));
					$dem_args['meta_key'] = 'dp_event_start_date';
					$dem_current_date = gmdate('d-m-Y');
					if ( $dem_show_event == 'show_upcomming_events' ){
						$args['meta_query'] = array(
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
						$args['meta_query'] = array(
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
						$args['meta_query'] = array(
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
		}else{
		
			if ( $dem_show_event == "show_upcomming_events" ) {
				$current_date = gmdate('d-m-Y');
				$args['meta_query'] = array(
					array(
						'key' => 'dp_event_end_date',
						'value' => strtotime($current_date),
						'compare' => '>=',
					),
				);
			} else if ( $dem_show_event == "show_past_events" ) {
				$current_date = gmdate('d-m-Y');
				$args['meta_query'] = array(
					array(
						'key' => 'dp_event_end_date',
						'value' => strtotime($current_date),
						'compare' => '<=',
					),
				);
			}else{ }
			
		}
		if ( $use_current_loop == 'on' && ( is_tax( 'event_category' ) || is_tax( 'event_tag' ) ) ) {
			if ( is_tax( 'event_category' ) ) { 
				$include_categories = (string) get_queried_object_id();
				$args['tax_query'] = array(
						array(
							'taxonomy' => 'event_category',
							'field' => 'term_id',
							'terms' => explode(",", $include_categories),
							'operator' => 'IN'
						),
				);
			} else if ( is_tax( 'event_tag' ) ) {
				$include_tags =  (string) get_queried_object_id();
				$args['tax_query'] = array(
						array(
							'taxonomy' => 'event_tag',
							'field' => 'term_id',
							'terms' => explode(",", $include_tags),
							'operator' => 'IN'
						),
				);
			} else  {}
		}
     	$dem_slider_output = '';
        $dem_slider_output .= '<div class="dem_slider_' . $dem_select_style . ' ">';
        $dem_slider_output .= '<div class="owl-carousel owl-theme ">';
        $dem_slider_query = new WP_Query($args);
		
		// Find Files From Child Theme. If Found then call from theme otherwise files call from plugin
		$dem_template_path 	=  get_stylesheet_directory() . '/divi-eventmanager';
		$dem_slider_path 	=  $dem_template_path.'/slider';
		$dem_css_path 		=  $dem_template_path.'/css/slider';
		$dem_css_url 		=  get_stylesheet_directory_uri().'/divi-eventmanager/css/slider'; 
		
		if ( file_exists( $dem_css_path . '/dem_slider_'.$dem_select_style.'.css' ) )
		{
			wp_enqueue_style('dem_slider_'.$dem_select_style, $dem_css_url.'/dem_slider_'.$dem_select_style.'.css', array(), NULL);
		}else{
			wp_enqueue_style('dem_slider_'.$dem_select_style, DEM_PLUGIN_URL.'assets/css/divi-layout-css/slider/dem_slider_'.$dem_select_style.'.min.css', array(), NULL);
		}
		if ( $divi_dem_multi_lan == 'on'){
			$dem_evt_to 					= __('to', 'dpevent'); 
			$divi_dem_no_result 			= __('Sorry, no events were found.', 'dpevent'); 
		}else{
			$dem_evt_to 					= et_get_option($dem_themename.'_dem_evt_to','to'); 
			$divi_dem_no_result 			= et_get_option($dem_themename.'_dem_no_result','Sorry, no events were found.'); 
		}
		
		
        if ( $dem_slider_query->have_posts() ) {
		
            while ( $dem_slider_query->have_posts() ) {
                $dem_slider_query->the_post();
                ob_start();
				$dem_event_thumb = array();
                if ( $dem_select_style == 'style1' ){
                    $dem_event_thumb = wp_get_attachment_image_src(get_post_thumbnail_id(), 'dem_slider1_500_232');  
                }
                elseif ( $dem_select_style == 'style2' ){
                    $dem_event_thumb = wp_get_attachment_image_src(get_post_thumbnail_id(), 'dem_grid_400_400');
                }
                elseif ( $dem_select_style == 'style3' ){
                    $dem_event_thumb = wp_get_attachment_image_src(get_post_thumbnail_id(), 'dem_slider3_400_300');
                }   
                if( $dem_event_thumb[0] != '' ){ 
                    $image_path = $dem_event_thumb[0] ;
                }else{ 
                    $image_path = DEM_PLUGIN_URL. '/assets/images/default.png';
                }
				
				$terms = get_the_terms(get_the_ID(), 'event_category');
                $terms_meta = [];
                if ( !empty($terms) ) {  foreach ($terms as $term) {  $terms_meta[] = $term->name;  }  }
				if (!empty($terms_meta)) { $terms_string = implode(', ', $terms_meta);  } else {  $terms_string = '';   }
				
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
				$event_readmore_btn_text		= $dem_slider_read_more_button_text;
				$event_content 					= get_the_excerpt();
				
                $event_venue_address = $dem_slider_title_val = '';
                if ( $event_venue != '' ) {
                    $event_venue_address .= $event_venue . ', ';
                }
                if ( $event_city != '' ) {
                    $event_venue_address .= $event_city . ', ';
                }
                if ( $event_state != '' ) {
                    $event_venue_address .= $event_state . ', ';
                }
                if ( $event_country != '' ) {
                    $event_venue_address .= $event_country . ', ';
                }

                if ( '' !== $event_title ) {
                    if( $dem_select_style == 'style2' ){
                        $dem_slider_title_val = sprintf(
                            '<%1$s class="et_pb_module_header dem_slider_title">%2$s</%1$s>', et_pb_process_header_level($header_level, 'h3'), esc_attr($event_title)
                    );
                    }else{
                          $dem_slider_title_val = sprintf(
                            '<%1$s class="et_pb_module_header dem_slider_title"><a href="%3$s" %4$s>%2$s</a></%1$s>', et_pb_process_header_level($header_level, 'h3'), esc_attr($event_title), esc_url($event_permalink), esc_attr($target_blank)
                    );
                    }

                }
				if ( file_exists( $dem_slider_path . '/dem_slider_'.$dem_select_style.'.php' ) )
				{
					include $dem_slider_path. '/dem_slider_'.$dem_select_style.'.php';
				}else{
					include DEM_PLUGIN_PATH. 'include/divi-layout-style/slider/dem_slider_'.$dem_select_style.'.php';
				}
                $dem_slider_output .= ob_get_contents();
                ob_end_clean();
            }
            wp_reset_postdata();
        }else{
			
			$dem_slider_output .= esc_html__($divi_dem_no_result, 'dpevent');
		}
        if ( $dem_slider_autoplay == "on" ) {

            if ( $dem_slider_autoplayHoverPause == "on" ) {
                $dem_slider_autoplayHoverPause_v = "autoplayHoverPause:true,";
            } else {
                $dem_slider_autoplayHoverPause_v = "autoplayHoverPause:false,";
            }
            $dem_slider_autoplay_v = "autoplay:true,autoplaySpeed:" . $dem_slider_autoplaySpeed . "," . $dem_slider_autoplayHoverPause_v;
			
        } else {
            $dem_slider_autoplay_v = "autoplay:false,";
        }

        if ( $dem_slider_loop == "on" ) {
            $dem_slider_loop_v = "loop:true,";
        } else {
            $dem_slider_loop_v = "loop:false,";
        }

        if ( $dem_slider_nav == "on" ) {
            $dem_slider_nav_v = "nav:true,navSpeed:" . $dem_slider_navSpeed . ",";
        } else {
            $dem_slider_nav_v = "nav:false,";
        }

        if ( $dem_slider_dots == "on" ) {
            $dem_slider_dots_v = "dots:true,dotsSpeed:" . $dem_slider_dotsSpeed . ",";
        } else {
            $dem_slider_dots_v = "dots:false,";
        }
		
        if ( $dem_slider_responsive_480to980 != "" ) {
            $dem_slider_responsive_480to980_v = $dem_slider_responsive_480to980;
        } else {
            $dem_slider_responsive_480to980_v = '2';
        }

        if ( $dem_slider_responsive_980to1024 != "" ) {
            $dem_slider_responsive_980to1024_v = $dem_slider_responsive_980to1024;
        } else {
            $dem_slider_responsive_980to1024_v = '2';
        }

        if ( $dem_slider_responsive_1024to1800 != "" ) {
            $dem_slider_responsive_1024to1800_v = $dem_slider_responsive_1024to1800;
        } else {
            $dem_slider_responsive_1024to1800_v = '3';
        }

        if ( $dem_slider_responsive_1800toabove != "" ) {
            $dem_slider_responsive_1800toabove_v = $dem_slider_responsive_1800toabove;
        } else {
            $dem_slider_responsive_1800toabove_v = '3';
        }
        $dem_slider_output .= '</div></div>';


        $dem_slider_output .= '<script>
            jQuery(document).ready(function() {
				 jQuery(\'.' . esc_attr( $order_class ) . ' .owl-carousel\').owlCarousel({
				  items: 3,
				  margin:10,
				  ' . $dem_slider_autoplay_v . '
				  ' . $dem_slider_loop_v . '
				  ' . $dem_slider_nav_v . '
				  ' . $dem_slider_dots_v . '
				  responsive: true,
				  responsive:{
							   0:{items:1},
							   481:{ items:' . $dem_slider_responsive_480to980_v . '  },
							   981:{ items:' . $dem_slider_responsive_980to1024_v . '},
							   1025:{ items:' . $dem_slider_responsive_1024to1800_v . '},
							   1800:{ items:' . $dem_slider_responsive_1800toabove_v . ' }
							}
				});
            });
            </script>';
		wp_reset_postdata();
        return $dem_slider_output;
    }

    function dem_slider_dot_apply_css($render_slug) {
        $dem_slider_dots 				= $this->props['dem_slider_dots'];
        $dem_slider_dots_color 			= $this->props['dem_slider_dots_color'];
        $dem_slider_dots_active_color	= $this->props['dem_slider_dots_active_color'];

        if ( $dem_slider_dots == 'on' ) {
          
		    if ( $dem_slider_dots_color != '' ) {
                ET_Builder_Element::set_style($render_slug, array(
                    'selector' => '%%order_class%% .owl-theme .owl-dots .owl-dot span',
                    'declaration' => sprintf( 'background: %1$s !important;', esc_html($dem_slider_dots_color) ),
                ));
            }

            if ( $dem_slider_dots_active_color != '' ) {
                ET_Builder_Element::set_style($render_slug, array(
                    'selector' => '%%order_class%% .owl-theme .owl-dots .owl-dot.active span,%%order_class%% .owl-theme .owl-dots .owl-dot:hover span',
                    'declaration' => sprintf('background: %1$s !important;', esc_html($dem_slider_dots_active_color) ),
                ));
            }
        }
    }
    function dem_slider_nav_apply_css($render_slug) {
        $dem_slider_nav 							= $this->props['dem_slider_nav'];
        $dem_slider_nav_arrow_color 				= $this->props['dem_slider_nav_arrow_color'];
        $dem_slider_nav_arrow_hover_color 			= $this->get_hover_value('dem_slider_nav_arrow_color');
        $dem_slider_nav_arrow_background_color 		= $this->props['dem_slider_nav_arrow_background_color'];
        $dem_slider_nav_arrow_background_hover_color = $this->get_hover_value('dem_slider_nav_arrow_background_color');

        if ( $dem_slider_nav == "on" ) {

            if ( $dem_slider_nav_arrow_color != '' ) {
                ET_Builder_Element::set_style($render_slug, array(
                    'selector' => '%%order_class%% .owl-carousel .owl-nav button.owl-next,%%order_class%% .owl-carousel .owl-nav button.owl-prev',
                    'declaration' => sprintf( 'color: %1$s !important;', esc_html($dem_slider_nav_arrow_color)),
                ));
            }
			
            if ( $dem_slider_nav_arrow_hover_color != '' ) {
                ET_Builder_Element::set_style($render_slug, array(
                    'selector' => '%%order_class%% .owl-theme .owl-nav [class*="owl-"]:hover',
                    'declaration' => sprintf('color: %1$s !important;', esc_html($dem_slider_nav_arrow_hover_color) ),
                ));
            }
			
            if ( $dem_slider_nav_arrow_background_color != '' ) {
                ET_Builder_Element::set_style($render_slug, array(
                    'selector' => '%%order_class%% .owl-carousel .owl-nav button.owl-next, %%order_class%% .owl-carousel .owl-nav button.owl-prev',
                    'declaration' => sprintf('background: %1$s !important;', esc_html($dem_slider_nav_arrow_background_color) ),
                ));
            }

            if ( $dem_slider_nav_arrow_background_hover_color != '' ) {
                ET_Builder_Element::set_style($render_slug, array(
                    'selector' => '%%order_class%% .owl-theme .owl-nav [class*="owl-"]:hover',
                    'declaration' => sprintf('background: %1$s !important;', esc_html($dem_slider_nav_arrow_background_hover_color) ),
                ));
            }
			
        }
    }
    function dem_slider_style_color_css($render_slug) {
	    $dem_select_style 					= $this->props['dem_select_style'];
        $style1_image_overlay_hover_color	= $this->props['style1_image_overlay_hover_color'];
        $style1_image_icon_color 			= $this->props['style1_image_icon_color'];
		
		$style1_readmore_bk_color 			= $this->props['style1_readmore_bk_color'];
		$style1_readmore_bk_color_hover 	= $this->get_hover_value('style1_readmore_bk_color');
		$style1_readmore_icon_color 		= $this->props['style1_readmore_icon_color'];
		$style1_readmore_icon_color_hover 	= $this->get_hover_value('style1_readmore_icon_color');

        if( $dem_select_style == 'style1' ){
            
			if ( $style1_image_overlay_hover_color != '' ) {
                ET_Builder_Element::set_style($render_slug, array(
                    'selector' => '%%order_class%% .dem_slider_style1 .dem_column_slider_view .dem_slider_style1_image .dem_slider_style1_image_overlay',
                    'declaration' => sprintf('background: %1$s none repeat scroll 0 0 !important;', esc_html($style1_image_overlay_hover_color)),
                ));
            }
			
            if ( $style1_image_icon_color != '' ) {
                ET_Builder_Element::set_style($render_slug, array(
                    'selector' => '%%order_class%% .dem_slider_style1 .dem_column_slider_view .dem_slider_style1_event_detail .dem_slider_style1_duration i,%%order_class%% .dem_slider_style1  .dem_column_slider_view .dem_slider_style1_event_detail .dem_slider_style1_category i',
                    'declaration' => sprintf('color: %1$s !important;', esc_html($style1_image_icon_color) ),
                ));
            }
			
			if ( $style1_readmore_bk_color != '' ) {
                ET_Builder_Element::set_style($render_slug, array(
                    'selector' => '%%order_class%% .dem_slider_style1 .dem_slider_style1_button a',
                    'declaration' => sprintf( 'background: %1$s !important;border-color: %1$s !important;', esc_html($style1_readmore_bk_color)),
                ));
            }
			
            if ( $style1_readmore_bk_color_hover != '' ) {
                ET_Builder_Element::set_style($render_slug, array(
                    'selector' => '%%order_class%% .dem_slider_style1 .dem_slider_style1_button a:hover',
                    'declaration' => sprintf( 'background: %1$s !important;border-color: %1$s !important;', esc_html($style1_readmore_bk_color_hover)),
                ));
            }
			
			if ( $style1_readmore_icon_color != '' ) {
                ET_Builder_Element::set_style($render_slug, array(
                    'selector' => '%%order_class%% .dem_slider_style1 .dem_slider_style1_button i.et-pb-icon',
                    'declaration' => sprintf( 'color: %1$s !important;', esc_html($style1_readmore_icon_color)),
                ));
            }
			
            if ( $style1_readmore_icon_color_hover != '' ) {
                ET_Builder_Element::set_style($render_slug, array(
                    'selector' => '%%order_class%% .dem_slider_style1 .dem_slider_style1_button i.et-pb-icon:hover',
                    'declaration' => sprintf( 'color: %1$s !important;', esc_html($style1_readmore_icon_color_hover)),
                ));
            }
			
        }
        $style3_readmore_color 						= $this->props['style3_readmore_color'];
        $style3_readmore_hover_color 				= $this->get_hover_value('style3_readmore_color');
        $style3_readmore_bg_color 					= $this->props['style3_readmore_bg_color'];
        $style3_readmore_bg_hover_color 			= $this->get_hover_value('style3_readmore_bg_color');
        $style3_readmore_border_color 				= $this->props['style3_readmore_border_color'];
        $style3_readmore_border_hover_color 		= $this->get_hover_value('style3_readmore_border_color');

         if( $dem_select_style == 'style3' ){
		 
            if ( $style3_readmore_color != '' ) {
                ET_Builder_Element::set_style($render_slug, array(
                    'selector' => '%%order_class%% .dem_slider_style3 .dem_slider_style3_event_view_more',
                    'declaration' => sprintf( 'color: %1$s !important;', esc_html($style3_readmore_color)),
                ));
            }
			
            if ( $style3_readmore_hover_color != '' ) {
                ET_Builder_Element::set_style($render_slug, array(
                    'selector' => '%%order_class%% .dem_slider_style3 .dem_slider3_event_view_more:hover',
                    'declaration' => sprintf( 'color: %1$s !important;', esc_html($style3_readmore_hover_color)),
                ));
            }
			
            if ( $style3_readmore_bg_color != '' ) {
                ET_Builder_Element::set_style($render_slug, array(
                    'selector' => '%%order_class%% .dem_slider_style3 .dem_slider_style3_event_view_more',
                    'declaration' => sprintf( 'background: %1$s !important;', esc_html($style3_readmore_bg_color)),
                ));
            }
			
            if ( $style3_readmore_bg_hover_color != '' ) {
                ET_Builder_Element::set_style($render_slug, array(
                    'selector' => '%%order_class%% .dem_slider_style3 .dem_slider_style3_event_view_more:hover',
                    'declaration' => sprintf( 'background: %1$s !important;', esc_html($style3_readmore_bg_hover_color) ),
                ));
            }
			
            if ( $style3_readmore_border_color != '' ) {
                ET_Builder_Element::set_style($render_slug, array(
                    'selector' => '%%order_class%% .dpevent_slider_style3 .dem_slider_style3_event_view_more',
                    'declaration' => sprintf( 'border: 1px solid  %1$s !important;', esc_html($style3_readmore_border_color)),
                ));
            }
			
            if ($style3_readmore_border_hover_color != '') {
                ET_Builder_Element::set_style($render_slug, array(
                    'selector' => '%%order_class%% .dpevent_slider_style3 .dem_slider_style3_event_view_more:hover',
                    'declaration' => sprintf( 'border: 1px solid  %1$s !important;', esc_html($style3_readmore_border_hover_color) ),
                ));
            }
			
        }
    }

    static function dem_slider_compute($args = array(), $conditional_tags = array(), $current_page = array()) {
        global $paged, $post, $wp_query, $et_fb_processing_shortcode_object, $et_pb_rendering_column_content;
        $global_processing_original_value = $et_fb_processing_shortcode_object;
        $defaults = array(
            'header_level' 						=> 'h3',
            'dem_orderby' 						=> 'date_desc',
            'dem_select_style' 					=> 'style1',
            'dem_display_no_of_event_in_slider' => '5',
            'dem_slider_category' 				=> 'all',
            'dem_slider_tag' 					=> 'all',
            'include_tags' 						=> '',
            'include_categories' 				=> '',
            'dem_slider_show_read_more' 		=> 'on',
            'dem_slider_read_more_button_text'  => 'read more',
            'dem_show_event' 					=> 'default',
			'dem_time_format' 					=> 'twhr',
			'dem_slider_no_filter_options'      => 'default',
			'dem_link_type'       			    => 'default', 
			'use_current_loop'                 => 'off',
        );

        $args = wp_parse_args(array_filter($args), $defaults);
		$use_current_loop 					= esc_attr($args['use_current_loop'] );
        $header_level 						= esc_attr($args['header_level'] );
        $dem_orderby				 		= esc_attr($args['dem_orderby'] );
        $dem_select_style 					= esc_attr($args['dem_select_style'] );
        $dem_display_no_of_event_in_slider  = esc_attr($args['dem_display_no_of_event_in_slider'] );
        $dem_slider_category 				= esc_attr($args['dem_slider_category'] );
        $dem_slider_tag 					= esc_attr($args['dem_slider_tag'] );
        $include_tags 						= esc_attr($args['include_tags'] );
        $include_categories 				= esc_attr($args['include_categories'] );
        $dem_slider_show_read_more 			= esc_attr($args['dem_slider_show_read_more'] );
        $dem_slider_read_more_button_text 	= esc_attr($args['dem_slider_read_more_button_text'] );
        $dem_show_event 					= esc_attr($args['dem_show_event'] );
		$dem_time_format 					= esc_attr($args['dem_time_format'] );
        $include_tags 						= explode(",", $args['include_tags']);
        $include_categories 				= explode(",", $args['include_categories']);
		$dem_slider_no_filter_options	  	= esc_attr( $args['dem_slider_no_filter_options'] );
		$dem_link_type	  	  			  	= esc_attr( $args['dem_link_type'] );
        $dem_themename 					= dem_theme_name();
		$divi_dem_multi_lan 			    = et_get_option($dem_themename.'_dem_multi_lan','off');
        if ( $dem_display_no_of_event_in_slider == '' ) {
            $arguments = array('posts_per_page' => -1);
        } else {
            $arguments = array('posts_per_page' => (int) $dem_display_no_of_event_in_slider);
        }
		
		
		 if ( $dem_slider_tag != 'all' && $dem_slider_category != 'all' ) {
            
			if ( !empty($include_tags) && !empty($include_categories) ) {
                $arguments['tax_query'] = array(
                    'relation' => 'AND',
                    array(
                        'taxonomy' => 'event_tag',
                        'field' => 'term_id',
                        'terms' => $include_tags,
                        'operator' => 'IN'
                    ),
                    array(
                        'taxonomy' => 'event_category',
                        'field' => 'term_id',
                        'terms' => $include_categories,
                        'operator' => 'IN'
                    ),
                );
            }
			
            if ( empty($include_tags) && !empty($include_categories) ) {
                $arguments['tax_query'] = array(
                    array(
                        'taxonomy' => 'event_category',
                        'field' => 'term_id',
                        'terms' => $include_categories,
                        'operator' => 'IN'
                    ),
                );
            }
			
            if ( !empty($include_tags) && empty($include_categories) ) {
                $arguments['tax_query'] = array(
                    array(
                        'taxonomy' => 'event_tag',
                        'field' => 'term_id',
                        'terms' => $include_tags,
                        'operator' => 'IN'
                    ),
                );
            }
			
        } else if ( $dem_slider_tag != 'all' && $dem_slider_category == 'all' ) {
           
		    if ( !empty($include_tags) ) {
                $arguments['tax_query'] = array(
                    array(
                        'taxonomy' => 'event_tag',
                        'field' => 'name',
                        'terms' => $include_tags,
                        'operator' => 'IN'
                    )
                );
            }
			
        } else if ( $dem_slider_category != 'all' && $dem_slider_tag == 'all' ) {
           
		    if ( !empty($include_categories) ) {
                $arguments['tax_query'] = array(
                    array(
                        'taxonomy' => 'event_category',
                        'field' => 'term_id',
                        'terms' => $include_categories,
                        'operator' => 'IN'
                    )
                );
            }
			
        } else {}
          
		 // Order & Orderby
		if ( 'date_desc' !== $dem_orderby ) {
			switch ( $dem_orderby ) {
					case 'date_asc' :
						$arguments['orderby'] = 'date';
						$arguments['order'] = 'ASC';
						break;
					case 'title_asc' :
						$arguments['orderby'] = 'title';
						$arguments['order'] = 'ASC';
						break;
					case 'title_desc' :
						$arguments['orderby'] = 'title';
						$arguments['order'] = 'DESC';
						break;
					case 'rand' :
						$arguments['orderby'] = 'rand';
						break;
					case 'event_start_desc' :
						$arguments['orderby'] = 'meta_value_num';
						$arguments['order'] = 'DESC';
						$arguments['meta_key'] = 'dp_event_start_date';
						break;
					case 'event_start_asc' :
						$arguments['orderby'] = 'meta_value_num';
						$arguments['order'] = 'ASC';
						$arguments['meta_key'] = 'dp_event_start_date';
						break;
			}
		} else {
			$arguments['orderby'] = 'date';
			$arguments['order'] = 'DESC';
		}
		
        $arguments['post_type'] = 'dp_events';
		if ( $dem_slider_no_filter_options != 'default' ) {
				// Today Events
				if( $dem_slider_no_filter_options == 'dem_w_today')
				{
					$date_today= gmdate('d-m-Y');
					$arguments['meta_key'] = 'dp_event_start_date';
					$arguments['meta_query'] = array(
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
				if( $dem_slider_no_filter_options =='dem_w_month')
				{
					$start_date_thismonth = gmdate('01-m-Y',strtotime('this month'));
					$end_date_thismonth = gmdate('t-m-Y',strtotime('this month'));
					$arguments['meta_key'] = 'dp_event_start_date';
					$dem_current_date = gmdate('d-m-Y');
					if ( $dem_show_event == 'show_upcomming_events' ){
						$arguments['meta_query'] = array(
							'relation' => 'AND',
							array(
								'key' => 'dp_event_end_date',
								'value' => strtotime($start_date_thismonth),
								'compare' => '>='
							),
							array(
								'key' => 'dp_event_start_date',
								'value' => strtotime($end_date_thismonth),
								'compare' => '<'
							),
							array(
								'key' 		=> 'dp_event_end_date',
								'value' 	=>  strtotime($dem_current_date),
								'compare' 	=> '>=', 
							)
						);
					}else if ( $dem_show_event == 'show_past_events' ){
						$arguments['meta_query'] = array(
							'relation' => 'AND',
							array(
								'key' => 'dp_event_end_date',
								'value' => strtotime($start_date_thismonth),
								'compare' => '>='
							),
							array(
								'key' => 'dp_event_start_date',
								'value' => strtotime($end_date_thismonth),
								'compare' => '<'
							),
							array(
								'key' 		=> 'dp_event_end_date',
								'value' 	=>  strtotime($dem_current_date),
								'compare' 	=> '<=', 
							)
						);
					}else{
							$arguments['meta_query'] = array(
								'relation' => 'AND',
								array(
									'key' => 'dp_event_end_date',
									'value' => strtotime($start_date_thismonth),
									'compare' => '>='
								),
								array(
									'key' => 'dp_event_start_date',
									'value' => strtotime($end_date_thismonth),
									'compare' => '<'
								)
						    );
					}
				}
				// This Week Events
				if( $dem_slider_no_filter_options =='dem_w_week')
				{
					$thisweek_day = gmdate('w');
					//$start_date_thisweek = gmdate('d-m-Y', strtotime('-'. $thisweek_day . ' days'));
					//$end_date_thisweek = gmdate('d-m-Y', strtotime('+' . (6 - $thisweek_day) . ' days'));
					$start_date_thisweek = gmdate("d-m-Y",strtotime('monday this week'));
					 $end_date_thisweek = gmdate("d-m-Y",strtotime("sunday this week"));
					$arguments['meta_key'] = 'dp_event_start_date';
					$dem_current_date = gmdate('d-m-Y');
					
					if ( $dem_show_event == 'show_upcomming_events' ){
						$arguments['meta_query'] = array(
							'relation' => 'AND',
							array(
								'key' => 'dp_event_end_date',
								'value' => strtotime($start_date_thisweek),
								'compare' => '>='
							),
							array(
								'key' => 'dp_event_start_date',
								'value' => strtotime($end_date_thisweek),
								'compare' => '<'
							),
							array(
								'key' 		=> 'dp_event_end_date',
								'value' 	=>  strtotime($dem_current_date),
								'compare' 	=> '>=', 
							)
						);
					}else if ( $dem_show_event == 'show_past_events' ){
						$arguments['meta_query'] = array(
							'relation' => 'AND',
							array(
								'key' => 'dp_event_end_date',
								'value' => strtotime($start_date_thisweek),
								'compare' => '>='
							),
							array(
								'key' => 'dp_event_start_date',
								'value' => strtotime($end_date_thisweek),
								'compare' => '<'
							),
							array(
								'key' 		=> 'dp_event_end_date',
								'value' 	=>  strtotime($dem_current_date),
								'compare' 	=> '<=', 
							)

						);
					}else{
						$arguments['meta_query'] = array(
							'relation' => 'AND',
							array(
								'key' => 'dp_event_end_date',
								'value' => strtotime($start_date_thisweek),
								'compare' => '>='
							),
							array(
								'key' => 'dp_event_start_date',
								'value' => strtotime($end_date_thisweek),
								'compare' => '<'
							)
						);
					}
				}
				// This Year Events
				if( $dem_slider_no_filter_options =='dem_w_year')
				{
					$start_date_thisyear = gmdate("01-01-Y", strtotime("this year"));
					$end_date_thisyear = gmdate("t-12-Y", strtotime($start_date_thisyear));
					$arguments['meta_key'] = 'dp_event_start_date';
					$dem_current_date = gmdate('d-m-Y');
					if ( $dem_show_event == 'result_show_upcomming_events' ){
						$arguments['meta_query'] = array(
							'relation' => 'AND',
							array(
								'key' => 'dp_event_end_date',
								'value' => strtotime($start_date_thisyear),
								'compare' => '>='
							),
							array(
								'key' => 'dp_event_start_date',
								'value' => strtotime($end_date_thisyear),
								'compare' => '<'
							),
							array(
								'key' 		=> 'dp_event_end_date',
								'value' 	=>  strtotime($dem_current_date),
								'compare' 	=> '>=', 
							)
						);
					}else if ( $dem_show_event == 'result_show_past_events' ){
						$arguments['meta_query'] = array(
							'relation' => 'AND',
							array(
								'key' => 'dp_event_end_date',
								'value' => strtotime($start_date_thisyear),
								'compare' => '>='
							),
							array(
								'key' => 'dp_event_start_date',
								'value' => strtotime($end_date_thisyear),
								'compare' => '<'
							),
							array(
								'key' 		=> 'dp_event_end_date',
								'value' 	=>  strtotime($dem_current_date),
								'compare' 	=> '<=', 
							)
						);
					}else{
						$arguments['meta_query'] = array(
							'relation' => 'AND',
							array(
								'key' => 'dp_event_end_date',
								'value' => strtotime($start_date_thisyear),
								'compare' => '>='
							),
							array(
								'key' => 'dp_event_start_date',
								'value' => strtotime($end_date_thisyear),
								'compare' => '<'
							)
						);
					}
				}
		}else{
			if ( $dem_show_event == "show_upcomming_events" ) {
				 $current_date = gmdate('d-m-Y');
				$arguments['meta_query'] = array(
					array(
						'key' => 'dp_event_end_date',
						'value' => strtotime($current_date),
						'compare' => '>=',
					),
				);
			} else if ( $dem_show_event == "show_past_events" ) {
				$current_date = gmdate('d-m-Y');
				$arguments['meta_query'] = array(
					array(
						'key' => 'dp_event_end_date',
						'value' => strtotime($current_date),
						'compare' => '<=',
					),
				);
			}else{}
		}
        $dem_template_path 	=  get_stylesheet_directory() . '/divi-eventmanager';
		$dem_slider_path 	=  $dem_template_path.'/slider';
		$dem_slider_output ='';
		if ( $divi_dem_multi_lan == 'on'){
			$dem_evt_to 					= __('to', 'dpevent'); 
			$divi_dem_no_result 			= __('Sorry, no events were found.', 'dpevent'); 
		}else{
			$dem_evt_to 					= et_get_option($dem_themename.'_dem_evt_to','to'); 
			$divi_dem_no_result 			= et_get_option($dem_themename.'_dem_no_result','Sorry, no events were found.'); 
		}
		if ( $use_current_loop == 'on' && ( is_tax( 'event_category' ) || is_tax( 'event_tag' ) ) ) {
			if ( is_tax( 'event_category' ) ) { 
				$include_categories = (string) get_queried_object_id();
				$arguments['tax_query'] = array(
						array(
							'taxonomy' => 'event_category',
							'field' => 'term_id',
							'terms' => explode(",", $include_categories),
							'operator' => 'IN'
						),
				);
			} else if ( is_tax( 'event_tag' ) ) {
				$include_tags =  (string) get_queried_object_id();
				$arguments['tax_query'] = array(
						array(
							'taxonomy' => 'event_tag',
							'field' => 'term_id',
							'terms' => explode(",", $include_tags),
							'operator' => 'IN'
						),
				);
			} else  {}
		}
        $dem_slider_query = new WP_Query($arguments);
         if ( $dem_slider_query->have_posts() ) {
    
            while ( $dem_slider_query->have_posts() ) {
                $dem_slider_query->the_post();
                ob_start();
				$dem_event_thumb = array();
				if ( $dem_select_style == 'style1' ){
                    $dem_event_thumb = wp_get_attachment_image_src(get_post_thumbnail_id(), 'dem_slider1_500_232');  
                }
                elseif ( $dem_select_style == 'style2' ){
                    $dem_event_thumb = wp_get_attachment_image_src(get_post_thumbnail_id(), 'dem_grid_400_400');
                }
                elseif ( $dem_select_style == 'style3' ){
                    $dem_event_thumb = wp_get_attachment_image_src(get_post_thumbnail_id(), 'dem_slider3_400_300');
                }   
                if( $dem_event_thumb[0] != '' ){ 
                    $image_path = $dem_event_thumb[0] ;
                }else{ 
                    $image_path = DEM_PLUGIN_URL. '/assets/images/default.png';
                }
				
				$terms = get_the_terms(get_the_ID(), 'event_category');
                $terms_meta = [];
                if ( !empty($terms) ) {  foreach ($terms as $term) {  $terms_meta[] = $term->name;  }  }
				if (!empty($terms_meta)) { $terms_string = implode(', ', $terms_meta);  } else {  $terms_string = '';   }
				
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
				$event_readmore_btn_text		= $dem_slider_read_more_button_text;
				$event_content 					= get_the_excerpt();

                $event_venue_address = $dem_slider_title_val = '';
                if ( $event_venue != '' ) {
                    $event_venue_address .= $event_venue . ', ';
                }
                if ( $event_city != '' ) {
                    $event_venue_address .= $event_city . ', ';
                }
                if ( $event_state != '' ) {
                    $event_venue_address .= $event_state . ', ';
                }
                if ( $event_country != '' ) {
                    $event_venue_address .= $event_country . ', ';
                }

                if ( '' !== $event_title ) {
                    if( $dem_select_style == 'style2' ){
                        $dem_slider_title_val = sprintf(
                            '<%1$s class="et_pb_module_header dem_slider_title">%2$s</%1$s>', et_pb_process_header_level($header_level, 'h3'), esc_attr($event_title)
                    );
                    }else{
                          $dem_slider_title_val = sprintf(
                            '<%1$s class="et_pb_module_header dem_slider_title"><a href="%3$s" %4$s>%2$s</a></%1$s>', et_pb_process_header_level($header_level, 'h3'), esc_attr($event_title), esc_url($event_permalink), esc_attr($target_blank)
                    );
                    }
                }
				if ( file_exists( $dem_slider_path . '/dem_slider_'.$dem_select_style.'.php' ) )
				{
					include $dem_slider_path. '/dem_slider_'.$dem_select_style.'.php';
				}else{
					include DEM_PLUGIN_PATH. 'include/divi-layout-style/slider/dem_slider_'.$dem_select_style.'.php';
				}
                $dem_slider_output .= ob_get_contents();
                ob_end_clean();
			}
            wp_reset_postdata();
        }else{
			
			$dem_slider_output .= esc_html__($divi_dem_no_result, 'dpevent');
		}
		wp_reset_postdata();	
        return $dem_slider_output;
    }
}

new DPEVENT_Slider;