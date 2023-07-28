<?php
class DPEVENT_Calendar extends ET_Builder_Module {
	public $slug       = 'dpevent_calendar';
	public $vb_support = 'on';
	protected $module_credits = array(
		'module_uri' => 'https://divi-professional.com/product/divi-event-manager-plugin/',
		'author'     => 'Divi Professional',
		'author_uri' => 'https://divi-professional.com/',
	);
	public function init() {
		$this->name = esc_html__( 'DP Event Calendar', 'dpevent' );
		$this->main_css_element = '%%order_class%%';
		$this->icon_path        = plugin_dir_path( __FILE__ ). 'dem.svg';
	}
	function get_settings_modal_toggles() {
		return array(
			'general' => array(
				'toggles' => array(
					'main_content' 		=> esc_html__('General Settings', 'dpevent')
				),
			),
			'advanced' => array(
				'toggles' => array(
					'dem_color_setting'          => array(
						'title'    		 => esc_html__( 'Calendar Color Settings', 'dpevent' ),
					),   
				),
			),
		);
	}

	function get_advanced_fields_config() {
		return array(
			'fonts' => array(
				'dem_center_title' => array(
							'label' 	=> esc_html__('Calendar Center Title', 'dpevent'),
							'css' 		=> array(
										'main' 			=> "%%order_class%% .fc .fc-toolbar-title",
										'important' 	=> 'all',
							),
							'font_size' => array(
										'default' => '20px',
							),
							'line_height' => array(
										'default' => '1.3em',
							)
				), 
				'dem_filter_button_fonts' => array(
							'label' 	   => esc_html__('Calendar Filter Button', 'dpevent'),
							'css' 		   => array(
											'main' 			=> "%%order_class%% .fc .fc-button-primary",
											'text_align' 	=> "%%order_class%% .fc .fc-button-primary",
											'important' 	=> 'all',
							),
							'font_size' 	=> array(
											'default' 		=> '15px',
							),
				), 
				'dem_weekday_heading_fonts' => array(
							'label' 	   => esc_html__('Calendar Heading/Day Text', 'dpevent'),
							'css' 		   => array(
											'main' 			=> "%%order_class%% .fc-day.fc-day-sun a,
																%%order_class%% .fc-day.fc-day-mon a,
																%%order_class%% .fc-day.fc-day-tue a,
																%%order_class%% .fc-day.fc-day-wed a,
																%%order_class%% .fc-day.fc-day-thu a,
																%%order_class%% .fc-day.fc-day-fri a,
																%%order_class%% .fc-day.fc-day-sat a,
																%%order_class%% .fc-timegrid-slot,
																%%order_class%% .fc-timegrid-axis,
																%%order_class%% .fc-popover-title",
											'text_align' 	=> "%%order_class%% .fc-day.fc-day-sun a,
																%%order_class%% .fc-day.fc-day-mon a,
																%%order_class%% .fc-day.fc-day-tue a,
																%%order_class%% .fc-day.fc-day-wed a,
																%%order_class%% .fc-day.fc-day-thu a,
																%%order_class%% .fc-day.fc-day-fri a,
																%%order_class%% .fc-day.fc-day-sat a,
																%%order_class%% .fc-timegrid-slot,
																%%order_class%% .fc-timegrid-axis,
																%%order_class%% .fc-popover-title",
											'important' 	=> 'all',
							),
							'font_size' 	=> array(
											'default' 		=> '18px',
							),
				), 
				'dem_filter_event_feed_fonts' => array(
							'label' 	   => esc_html__('Calendar Event Feed', 'dpevent'),
							'css' 		   => array(
											'main' 			=> "%%order_class%% .fc-event-title,%%order_class%% .fc-daygrid-dot-event .fc-event-title,%%order_class%% .fc-list-event,%%order_class%% .fc-event-time",
											'text_align' 	=> "%%order_class%% .fc-event-title,%%order_class%% .fc-daygrid-dot-event .fc-event-title,%%order_class%% .fc-list-event,%%order_class%% .fc-event-time",
											'important' 	=> 'all',
							),
							'font_size' 	=> array(
											'default' 		=> '15px',
							),
				), 
			), 
			
			'margin_padding' => array(
								'css' => array(
									'padding' 	=> "%%order_class%% .fc-theme-standard",
									'margin' 	=> "%%order_class%% .fc-theme-standard",
									'important' => 'all',
								),
			),
			'borders'               => array(
				'default' => array(
					'css' => array(
						'main' => array(
							'border_radii'  => "%%order_class%% .fc-theme-standard",
							'border_styles' => "%%order_class%% .fc-theme-standard",
						),
					),
				),
			),
			'box_shadow'            => array(
				'default' => array(
					'css' => array(
						'main'    => '%%order_class%% .fc-theme-standard',
						'hover'   => '%%order_class%% .fc-theme-standard:hover',
					),
				),
			),
			'background' => array(
					'css' => array(
						'main'		 => '%%order_class%% .fc-theme-standard',
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
		$fields = $this->dem_calendar_get_general_fields($fields);
		$fields = $this->dem_calendar_get_custom_color_fields($fields);
		return $fields;
	}
	public function dem_get_event_locale(){
			$locale_array =  array( 'en','af','ar-dz','ar-kw','ar-ly','ar-ma','ar-sa','ar-tn','ar','az','bg','bs','ca','cs','da','de','el','en-au','en-gb','en-nz','es','et','eu','fa','fi','fr','fr-ch','gl','he','hi','hr','hu','id','is','it','ja','ka','kk','ko','lb','lt','lv','mk','ms','nb','ne','nl','nn','pl','pt-br','pt','ro','ru','sk','sl','sq','sr-cyrl','sr','sv','th','tr','ug','uk','uz','vi','zh-cn','zh-tw');	
			$locale_array_content = array();
			$count = count($locale_array);
			if ( $count > 0 ){
				foreach($locale_array as $localearray){
					$locale_array_content[$localearray] = $localearray;
				}
			}
			return $locale_array_content;
	}
	public function dem_react_get_events(){
		$dem_args = array('posts_per_page' => -1);
		$dem_args['post_type'] = 'dp_events';
		$dem_calendar_query = new WP_Query($dem_args);
		$dem_calendar_data = array();
		if ( $dem_calendar_query->have_posts() ) {
			while ( $dem_calendar_query->have_posts() ) {
				$dem_calendar_query->the_post();
				
				$dp_event_thumb = array();
				$dp_event_thumb = wp_get_attachment_image_src(get_post_thumbnail_id(), 'dem_grid_400_400');
				if( $dp_event_thumb[0] != ''){ 
					$image_path = $dp_event_thumb[0] ;
				}else{ 
					$image_path = DEM_PLUGIN_URL. '/assets/images/default.png';
				} 
				
				$event_thumbnail_image_url 		= $image_path;
				$event_permalink 				= get_the_permalink(get_the_ID());
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
				$event_content 					= get_the_excerpt();
				$event_post_categories 			= wp_get_post_terms( get_the_ID() ,'event_category', array("fields" => "ids"));
				
				$event_venue_address = '';
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
				
				  $dem_event_row = array();
				  $dem_event_row["id"] = get_the_ID();
				  $dem_event_row["title"]= $event_title ;
				  $st_date = date_i18n('Y-m-d', ($event_start_date ));
				  $ed_date = date_i18n('Y-m-d', ($event_end_date ));
				  $dem_event_row["start"] = gmdate('Y-m-d\TH:i:s', strtotime("$st_date $event_start_time"));
				  $dem_event_row["end"] = gmdate('Y-m-d\TH:i:s', strtotime("$ed_date $event_end_time"));
				  $dem_event_row["url"] = $event_permalink;
				  array_push($dem_calendar_data, $dem_event_row);
			}	
		}
		wp_reset_postdata();
		return wp_json_encode($dem_calendar_data);
	}
	public function dem_calendar_get_general_fields($fields) {
		$fields['dem_event_react_calendar_view'] = array(
				'label'             => esc_html__( 'All Events in React Calendar ', 'decm-divi-event-calendar-module' ),
				'type'              => 'hidden',
				//'option_category'   => 'configuration',
				'description'       => esc_html__( 'Total number of events to show.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'       => 'main_content',
				'default'           => $this->dem_react_get_events(),
		);
		$fields['dem_calendar_get_event_locale']	= array(
					'label'			=> esc_html__( 'Select Calendar Locale/Language', 'dpevent' ),
					'type'			=> 'select',
					'option_category'	=> 'configuration',
					'options'		=> $this->dem_get_event_locale(),
					'default'		=> 'en',
					'toggle_slug'	=> 'main_content',
					'description'	=> esc_html__( 'Select Calendar Locale/Language', 'dpevent' ),
		);
		$fields['dem_calendar_daygridweek'] = array(
			'label' 			=> esc_html__('Display Grid Week View  ', 'dpevent'),
			'type'				=> 'yes_no_button',
			'option_category'	=> 'configuration',
			'options'		=> array(
				'on'  			=> esc_html__( 'Yes', 'dpevent' ),
				'off' 			=> esc_html__( 'No', 'dpevent' ),
				
			),
			'default'		=> 'on',
			'toggle_slug'	=> 'main_content',
			'description'	=> esc_html__( 'This setting will turn on and off the Grid Week View.', 'dpevent' ),
		);
		$fields['dem_calendar_daygridday'] = array(
			'label' 			=> esc_html__('Display Grid Day View', 'dpevent'),
			'type'				=> 'yes_no_button',
			'option_category'	=> 'configuration',
			'options'		=> array(
				'on'  			=> esc_html__( 'Yes', 'dpevent' ),
				'off' 			=> esc_html__( 'No', 'dpevent' ),
				
			),
			'default'		=> 'on',
			'toggle_slug'	=> 'main_content',
			'description'	=> esc_html__( 'This setting will turn on and off the Grid Day View.', 'dpevent' ),
		);
		$fields['dem_calendar_timegridweek'] = array(
			'label' 			=> esc_html__('Display Time Grid Week View', 'dpevent'),
			'type'				=> 'yes_no_button',
			'option_category'	=> 'configuration',
			'options'		=> array(
				'on'  			=> esc_html__( 'Yes', 'dpevent' ),
				'off' 			=> esc_html__( 'No', 'dpevent' ),
				
			),
			'default'		=> 'on',
			'toggle_slug'	=> 'main_content',
			'description'	=> esc_html__( 'This setting will turn on and off the Time Grid Week View.', 'dpevent' ),
		);
		$fields['dem_calendar_timegridday'] = array(
			'label' 			=> esc_html__('Display Time Grid Day View', 'dpevent'),
			'type'				=> 'yes_no_button',
			'option_category'	=> 'configuration',
			'options'		=> array(
				'on'  			=> esc_html__( 'Yes', 'dpevent' ),
				'off' 			=> esc_html__( 'No', 'dpevent' ),
				
			),
			'default'		=> 'on',
			'toggle_slug'	=> 'main_content',
			'description'	=> esc_html__( 'This setting will turn on and off the Time Grid Day View.', 'dpevent' ),
		);
		$fields['dem_calendar_listday'] = array(
			'label' 			=> esc_html__('Display List Day View', 'dpevent'),
			'type'				=> 'yes_no_button',
			'option_category'	=> 'configuration',
			'options'		=> array(
				'on'  			=> esc_html__( 'Yes', 'dpevent' ),
				'off' 			=> esc_html__( 'No', 'dpevent' ),
				
			),
			'default'		=> 'on',
			'toggle_slug'	=> 'main_content',
			'description'	=> esc_html__( 'This setting will turn on and off the List Day View.', 'dpevent' ),
		);
		$fields['dem_calendar_listday_label'] = array(
			'label' 			=> esc_html__('List Day View Label', 'dpevent'),
			'type' 				=> 'text',
			'option_category' 	=> 'configuration',
			'description' 		=> esc_html__("List Day View Label", 'dpevent'),
			'show_if'			=> array('dem_calendar_listday' => 'on'),
			'default' 			=> 'List Day',
			'toggle_slug' 		=> 'main_content',
		);
		$fields['dem_calendar_listweek'] = array(
			'label' 			=> esc_html__('Display List Week View', 'dpevent'),
			'type'				=> 'yes_no_button',
			'option_category'	=> 'configuration',
			'options'		=> array(
				'on'  			=> esc_html__( 'Yes', 'dpevent' ),
				'off' 			=> esc_html__( 'No', 'dpevent' ),
				
			),
			'default'		=> 'on',
			'toggle_slug'	=> 'main_content',
			'description'	=> esc_html__( 'This setting will turn on and off the List Week View.', 'dpevent' ),
		);
		$fields['dem_calendar_listweek_label'] = array(
			'label' 			=> esc_html__('List Week View Label', 'dpevent'),
			'type' 				=> 'text',
			'option_category' 	=> 'configuration',
			'description' 		=> esc_html__("List Week View Label", 'dpevent'),
			'show_if'			=> array('dem_calendar_listweek' => 'on'),
			'default' 			=> 'List Week',
			'toggle_slug' 		=> 'main_content',
		);
		$fields['dem_calendar_listmonth'] = array(
			'label' 			=> esc_html__('Display List Month View', 'dpevent'),
			'type'				=> 'yes_no_button',
			'option_category'	=> 'configuration',
			'options'		=> array(
				'on'  			=> esc_html__( 'Yes', 'dpevent' ),
				'off' 			=> esc_html__( 'No', 'dpevent' ),
				
			),
			'default'		=> 'on',
			'toggle_slug'	=> 'main_content',
			'description'	=> esc_html__( 'This setting will turn on and off the List Month View.', 'dpevent' ),
		);
		$fields['dem_calendar_listmonth_label'] = array(
			'label' 			=> esc_html__('List Month View Label', 'dpevent'),
			'type' 				=> 'text',
			'option_category' 	=> 'configuration',
			'description' 		=> esc_html__("List Month View Label", 'dpevent'),
			'show_if'			=> array('dem_calendar_listmonth' => 'on'),
			'default' 			=> 'List Month',
			'toggle_slug' 		=> 'main_content',
		);
		$fields['dem_calendar_listyear'] = array(
			'label' 			=> esc_html__('Display List Year View', 'dpevent'),
			'type'				=> 'yes_no_button',
			'option_category'	=> 'configuration',
			'options'		=> array(
				'on'  			=> esc_html__( 'Yes', 'dpevent' ),
				'off' 			=> esc_html__( 'No', 'dpevent' ),
				
			),
			'default'		=> 'on',
			'toggle_slug'	=> 'main_content',
			'description'	=> esc_html__( 'This setting will turn on and off the List Year View.', 'dpevent' ),
		);
		$fields['dem_calendar_listyear_label'] = array(
			'label' 			=> esc_html__('List Year View Label', 'dpevent'),
			'type' 				=> 'text',
			'option_category' 	=> 'configuration',
			'description' 		=> esc_html__("List Year View Label", 'dpevent'),
			'show_if'			=> array('dem_calendar_listyear' => 'on'),
			'default' 			=> 'List Year',
			'toggle_slug' 		=> 'main_content',
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
		);
		return $fields;
	}
	public function dem_calendar_get_custom_color_fields($fields){
		$fields['dem_calendar_filter_bg_color'] = array(
			'label' 				=> esc_html__('Calendar Filter Button Background Color', 'dpevent'),
			'type' 					=> 'color-alpha',
			'custom_color' 			=> true,
			 'hover' 				=> "tabs",
			'toggle_slug' 			=> 'dem_color_setting',
			'tab_slug'    			=> 'advanced',
		);
	    $fields['dem_calendar_filter_active_bg_color'] = array(
			'label' 				=> esc_html__('Calendar Filter Button Active Background Color', 'dpevent'),
			'type' 					=> 'color-alpha',
			'custom_color' 			=> true,
			 'hover' 				=> "tabs",
			'toggle_slug' 			=> 'dem_color_setting',
			'tab_slug'    			=> 'advanced',
		);
		 $fields['dem_calendar_border_pixel'] =  array(
                'label'           => esc_html__('Calendar Border Width (In Pixel)', 'dpevent'),
                'type'            => 'range',
                'description'     	=> esc_html__('Calendar Border Width', 'dpevent'),  
                'option_category'=> 'basic_option',
				'toggle_slug' 			=> 'dem_color_setting',
				'tab_slug'    			=> 'advanced',
				'range_settings'  => array(
                    'step' => 1,
                    'min'  => 1,
                    'max'  => 10,
                ),
                'default'         => '1px',
				'fixed_unit'      => 'px',
		);
		 $fields['dem_calendar_border_color'] = array(
			'label' 				=> esc_html__('Calendar Border Color', 'dpevent'),
			'type' 					=> 'color-alpha',
			'custom_color' 			=> true,
			'toggle_slug' 			=> 'dem_color_setting',
			'tab_slug'    			=> 'advanced',
		);
		$fields['dem_calendar_border_style'] = array(
				'label' => esc_html__('Calendar Border Style', 'dnext-divi-next'),
                'type' => 'select',
                'option_category' => 'configuration',
                'options' => array(
                    'solid' => esc_html__('Solid', 'dnext-divi-next'),
                    'dotted' => esc_html__('Dotted', 'dnext-divi-next'),
                    'dashed' => esc_html__('Dashed', 'dnext-divi-next'),
                    'double' => esc_html__('Double', 'dnext-divi-next'),
                    'groove' => esc_html__('Groove', 'dnext-divi-next'),
                    'ridge' => esc_html__('Ridge', 'dnext-divi-next'),
                    'inset' => esc_html__('Inset', 'dnext-divi-next'),
                    'outset' => esc_html__('Outset', 'dnext-divi-next'),
                ),
                'default' => 'solid',
                'tab_slug' => 'advanced',
                'toggle_slug' => 'dem_color_setting',
		);
		 $fields['dem_calendar_event_feed_bk_color'] = array(
			'label' 				=> esc_html__('Calendar Event Feed Background Color', 'dpevent'),
			'type' 					=> 'color-alpha',
			'custom_color' 			=> true,
			'toggle_slug' 			=> 'dem_color_setting',
			'tab_slug'    			=> 'advanced',
		);
		return $fields;
	}
	public function dem_event_calendar_asserts() {
		 if (!is_admin()) {
            wp_enqueue_style('dem_calendar_main_css');
            wp_enqueue_script('dem_calendar_main_js');
			wp_enqueue_script('dem_calendar_locales_js');
			
        }
	}
	public function render($attrs, $content = null, $render_slug) {
		$this->dem_event_calendar_asserts();
					
		$dem_calendar_daygridweek 					  = esc_attr( $this->props['dem_calendar_daygridweek'] );
		$dem_calendar_daygridday 					  = esc_attr( $this->props['dem_calendar_daygridday'] );
		$dem_calendar_timegridweek 					  = esc_attr( $this->props['dem_calendar_timegridweek'] );
		$dem_calendar_timegridday 					  = esc_attr( $this->props['dem_calendar_timegridday'] );
		$dem_calendar_listday 					  	  = esc_attr( $this->props['dem_calendar_listday'] );
		$dem_calendar_listweek 					      = esc_attr( $this->props['dem_calendar_listweek'] );
		$dem_calendar_listmonth 					  = esc_attr( $this->props['dem_calendar_listmonth'] );
		$dem_calendar_listyear 					      = esc_attr( $this->props['dem_calendar_listyear'] );
		$dem_calendar_get_event_locale 				  = esc_attr( $this->props['dem_calendar_get_event_locale'] );
		$dem_calendar_listday_label 				  = esc_attr( $this->props['dem_calendar_listday_label'] );
		$dem_calendar_listweek_label 				  = esc_attr( $this->props['dem_calendar_listweek_label'] );
		$dem_calendar_listmonth_label 				  = esc_attr( $this->props['dem_calendar_listmonth_label'] );
		$dem_calendar_listyear_label 				  = esc_attr( $this->props['dem_calendar_listyear_label'] );
		$dem_link_type	  	  			 	 		  = esc_attr( $this->props['dem_link_type'] );
		
		$this->dem_calendar_style_color_css( $render_slug );
		$dem_right = 'dayGridMonth,';
		$dem_right .= $dem_calendar_daygridweek == 'on' ? 'dayGridWeek,' : '';
		$dem_right .= $dem_calendar_daygridday == 'on' ? 'dayGridDay,' : '';
		$dem_right .= $dem_calendar_timegridweek == 'on' ? 'timeGridWeek,' : '';
		$dem_right .= $dem_calendar_timegridday == 'on' ? 'timeGridDay,' : '';
		$dem_right .= $dem_calendar_listday == 'on' ? 'listDay,' : '';
		$dem_right .= $dem_calendar_listweek == 'on' ? 'listWeek,' : '';
		$dem_right .= $dem_calendar_listmonth == 'on' ? 'listMonth,' : '';
		$dem_right .= $dem_calendar_listyear == 'on' ? 'listYear,' : '';
		
		$dem_calendar_output = '';
		$dem_args = array('posts_per_page' => -1);
		$dem_args['post_type'] = 'dp_events';
		$dem_calendar_query = new WP_Query($dem_args);
		$dem_calendar_data = array();
		if ( $dem_calendar_query->have_posts() ) {
			while ( $dem_calendar_query->have_posts() ) {
				$dem_calendar_query->the_post();
				
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
				$event_content 					= get_the_excerpt();
				$event_post_categories 			= wp_get_post_terms( get_the_ID() ,'event_category', array("fields" => "ids"));
				
				$event_venue_address = '';
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
				
				  $dem_event_row = array();
				  $dem_event_row["id"] = get_the_ID();
				  $dem_event_row["title"]= $event_title ;
				  $st_date = date_i18n('Y-m-d', ($event_start_date ));
				  $ed_date = date_i18n('Y-m-d', ($event_end_date ));
				  $dem_event_row["start"] = gmdate('Y-m-d\TH:i:s', strtotime("$st_date $event_start_time"));
				  $dem_event_row["end"] = gmdate('Y-m-d\TH:i:s', strtotime("$ed_date $event_end_time"));
				  $dem_event_row["url"] = $event_permalink;
				  array_push($dem_calendar_data, $dem_event_row);
			}	
			
		}
		$dem_current_date = gmdate('Y-m-d');
		$dem_calendar_output .="<script> document.addEventListener('DOMContentLoaded', function() {
								var calendarEl = document.getElementById('calendar');
								var calendar = new FullCalendar.Calendar(calendarEl, {
								  initialView: 'dayGridMonth',
								  initialDate: '".$dem_current_date."',
								  timeFormat: 'H:mm',
								   navLinks: true,
      							   nowIndicator: true,
								   dayMaxEvents: true, 
								   locale: '".$dem_calendar_get_event_locale."',
								   headerToolbar: {
									left: 'prev,next today',
									center: 'title',
									right: '".rtrim($dem_right, ',')."'
								  },
								  views: {
									listDay: { buttonText: '".$dem_calendar_listday_label."' },
									listWeek: { buttonText: '".$dem_calendar_listweek_label."' },
									listMonth: { buttonText: '".$dem_calendar_listmonth_label."' },
									listYear: { buttonText: '".$dem_calendar_listyear_label."' },
								  },
								   events: ".wp_json_encode($dem_calendar_data).",
								});
								calendar.render();
							  });</script>";
		$dem_calendar_output .= "<div id='calendar'></div>";
		wp_reset_postdata();
		return $dem_calendar_output;
	}
	function dem_calendar_style_color_css($render_slug){
			$dem_calendar_filter_bg_color 			  			=  $this->props['dem_calendar_filter_bg_color'] ;
			$dem_calendar_filter_bg_color_hover_color 			= $this->get_hover_value( 'dem_calendar_filter_bg_color' );
			$dem_calendar_filter_active_bg_color     		 	=  $this->props['dem_calendar_filter_active_bg_color'];
			$dem_calendar_filter_active_bg_color_hover_color 	= $this->get_hover_value( 'dem_calendar_filter_active_bg_color' );
		    $dem_calendar_border_pixel 				  			=  $this->props['dem_calendar_border_pixel'] ;
			$dem_calendar_border_color 				 			=  $this->props['dem_calendar_border_color'] ;
			$dem_calendar_border_style 				 			=  $this->props['dem_calendar_border_style'];
			$dem_calendar_event_feed_bk_color 				    =  $this->props['dem_calendar_event_feed_bk_color'];
			if ( $dem_calendar_event_feed_bk_color != '' ) {
                    ET_Builder_Element::set_style($render_slug, array(
                        'selector' => '%%order_class%% .fc-h-event,%%order_class%% .fc-v-event,%%order_class%% .fc-theme-standard .fc-list-day-cushion,%%order_class%% .fc-theme-standard .fc-popover-header',
                        'declaration' => sprintf(
                                'background-color: %1$s !important;', esc_html($dem_calendar_event_feed_bk_color)
                        ),
                    ));
					ET_Builder_Element::set_style($render_slug, array(
                        'selector' => '%%order_class%% .fc-list-event-dot,%%order_class%% .fc-daygrid-event-dot',
                        'declaration' => sprintf(
                                'border-color: %1$s !important;', esc_html($dem_calendar_event_feed_bk_color)
                        ),
                    ));
               }	
			  if ( $dem_calendar_filter_bg_color != '' ) {
                    ET_Builder_Element::set_style($render_slug, array(
                        'selector' => '%%order_class%% .fc .fc-button-primary',
                        'declaration' => sprintf(
                                'background-color: %1$s !important;', esc_html($dem_calendar_filter_bg_color)
                        ),
                    ));
					ET_Builder_Element::set_style($render_slug, array(
                         'selector' => '%%order_class%% .fc .fc-button-primary',
                        'declaration' => sprintf(
                                'border-color: %1$s !important;', esc_html($dem_calendar_filter_bg_color)
                        ),
                    ));
               }
			    if ( $dem_calendar_filter_bg_color_hover_color != '' ) {
                    ET_Builder_Element::set_style($render_slug, array(
                        'selector' => '%%order_class%% .fc .fc-button-primary:hover',
                        'declaration' => sprintf(
                                'background-color: %1$s !important;', esc_html($dem_calendar_filter_bg_color_hover_color)
                        ),
                    ));
					ET_Builder_Element::set_style($render_slug, array(
                        'selector' => '%%order_class%% .fc .fc-button-primary:hover',
                        'declaration' => sprintf(
                                'border-color: %1$s !important;', esc_html($dem_calendar_filter_bg_color_hover_color)
                        ),
                    ));
               }
			   
			    if ( $dem_calendar_filter_active_bg_color != '' ) {
                    ET_Builder_Element::set_style($render_slug, array(
                        'selector' => '%%order_class%% .fc .fc-button-primary:not(:disabled).fc-button-active,%%order_class%% .fc .fc-button-primary:not(:disabled):active',
                        'declaration' => sprintf(
                                'background-color: %1$s !important;', esc_html($dem_calendar_filter_active_bg_color)
                        ),
                    ));
					ET_Builder_Element::set_style($render_slug, array(
                        'selector' => '%%order_class%% .fc .fc-button-primary:not(:disabled).fc-button-active,%%order_class%% .fc .fc-button-primary:not(:disabled):active',
                        'declaration' => sprintf(
                                'border-color: %1$s !important;', esc_html($dem_calendar_filter_active_bg_color)
                        ),
                    ));
               }
			    if ( $dem_calendar_filter_active_bg_color_hover_color != '' ) {
                    ET_Builder_Element::set_style($render_slug, array(
                        'selector' => '%%order_class%% .fc .fc-button-primary:not(:disabled).fc-button-active:hover,%%order_class%% .fc .fc-button-primary:not(:disabled):active:hover',
                        'declaration' => sprintf(
                                'background-color: %1$s !important;', esc_html($dem_calendar_filter_active_bg_color_hover_color)
                        ),
                    ));
					ET_Builder_Element::set_style($render_slug, array(
                         'selector' => '%%order_class%% .fc .fc-button-primary:not(:disabled).fc-button-active:hover,%%order_class%% .fc .fc-button-primary:not(:disabled):active:hover',
                        'declaration' => sprintf(
                                'border-color: %1$s !important;', esc_html($dem_calendar_filter_active_bg_color_hover_color)
                        ),
                    ));
               }
			   
			   if ( $dem_calendar_border_pixel != '' && $dem_calendar_border_pixel != '1px' ) {
                    ET_Builder_Element::set_style($render_slug, array(
                        'selector' => '%%order_class%% .fc-theme-standard td,%%order_class%% .fc-theme-standard th,%%order_class%% .fc-v-event,%%order_class%% .fc-h-event',
                        'declaration' => sprintf(
                                'border-width: %1$s !important;', esc_html($dem_calendar_border_pixel)
                        ),
                    ));
               }
			    if ( $dem_calendar_border_color != '' ) {
                    ET_Builder_Element::set_style($render_slug, array(
                        'selector' => '%%order_class%% .fc-theme-standard td,%%order_class%% .fc-theme-standard th,%%order_class%% .fc-v-event,%%order_class%% .fc-h-event',
                        'declaration' => sprintf(
                                'border-color: %1$s !important;', esc_html($dem_calendar_border_color)
                        ),
                    ));
               }
			    if ( $dem_calendar_border_style != '' && $dem_calendar_border_style != 'solid' ) {
                    ET_Builder_Element::set_style($render_slug, array(
                        'selector' => '%%order_class%% .fc-theme-standard td,%%order_class%% .fc-theme-standard th,%%order_class%% .fc-v-event,%%order_class%% .fc-h-event',
                        'declaration' => sprintf(
                                'border-style: %1$s !important;', esc_html($dem_calendar_border_style)
                        ),
                    ));
               }
	}
}
new DPEVENT_Calendar;