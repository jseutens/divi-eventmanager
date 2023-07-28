<?php 
	if ( ! defined( 'ABSPATH' ) ) {
		die; // If this file is called directly, abort.
	}
	/**
	 * Class Upcoming_Events
	 */
	class Widget_Upcoming_Events_Lists extends WP_Widget {
		/**
		 * Initializing the widget
		 */
		public function __construct() {
			$widget_ops = array(
				'class'       => 'upcoming-events-lists',
				'description' => __( 'A widget to display a list of upcoming events', 'dpevent' )
			);

			parent::__construct(
				'dem_upcoming_events',            //base id
				__( 'Upcoming Events', 'dpevent' ),    //title
				$widget_ops
			);
		}
		/**
		 * Displaying the widget on the back-end
		 *
		 * @param  array $instance An instance of the widget
		 */
		public function form( $instance ) {
			$widget_defaults = array(
				'title'         	=> 'Upcoming Events',
				'number_events' 	=> 5,
				'dem_day_format' 	=> 'D',
				'dem_date_format' 	=> 'F d Y',
				'dem_time_format' 	=> 'h:i a',
				'dem_orderby' 		=> 'date_desc'
			);
			$instance = wp_parse_args( (array) $instance, $widget_defaults );
			?>
	        <!-- Rendering the widget form in the admin -->
	        <p>
	            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title', 'dpevent' ); ?></label>
	            <input type="text" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
	                   name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" class="widefat"
	                   value="<?php echo esc_attr( $instance['title'] ); ?>">
	        </p>
	        <p>
	            <label for="<?php echo esc_attr( $this->get_field_id( 'number_events' ) ); ?>"><?php esc_html_e( 'Number of events to show', 'dpevent' ); ?></label>
	            <select id="<?php echo esc_attr( $this->get_field_id( 'number_events' ) ); ?>"
	                    name="<?php echo esc_attr( $this->get_field_name( 'number_events' ) ); ?>" class="widefat">
					<?php for ( $i = 1; $i <= 10; $i ++ ): ?>
	                    <option value="<?php echo esc_attr( $i ); ?>" <?php selected( $i, esc_attr( $instance['number_events'] ), true ); ?>><?php echo esc_attr( $i ); ?></option>
					<?php endfor; ?>
	            </select>
	        </p>
			  <p>
	            <label for="<?php echo esc_attr( $this->get_field_id( 'dem_orderby' ) ); ?>"><?php esc_html_e( 'Order By', 'dpevent' ); ?></label>
	            <select id="<?php echo esc_attr( $this->get_field_id( 'dem_orderby' ) ); ?>"
	                    name="<?php echo esc_attr( $this->get_field_name( 'dem_orderby' ) ); ?>" class="widefat">
					
	                <option value="<?php esc_attr_e( 'date_desc'); ?>" <?php selected( 'date_desc', esc_attr( $instance['dem_orderby'] ), true ); ?>><?php esc_html_e( 'Date: new to old', 'dpevent' ); ?></option>
					<option value="<?php esc_attr_e( 'date_asc'); ?>" <?php selected( 'date_asc', esc_attr( $instance['dem_orderby'] ), true ); ?>><?php esc_html_e( 'Date: old to new', 'dpevent' ); ?></option>
					<option value="<?php esc_attr_e( 'title_asc' ); ?>" <?php selected( 'title_asc', esc_attr( $instance['dem_orderby'] ), true ); ?>><?php esc_html_e( 'Title: a-z', 'dpevent' ); ?></option>
					<option value="<?php esc_attr_e( 'title_desc'); ?>" <?php selected( 'title_desc', esc_attr( $instance['dem_orderby'] ), true ); ?>><?php esc_html_e( 'Title: z-a', 'dpevent' ); ?></option>
					<option value="<?php esc_attr_e( 'event_start_desc'); ?>" <?php selected( 'event_start_desc', esc_attr( $instance['dem_orderby'] ), true ); ?>><?php esc_html_e( 'Event Start Date : DESC', 'dpevent' ); ?></option>
					<option value="<?php esc_attr_e( 'event_start_asc'); ?>" <?php selected( 'event_start_asc', esc_attr( $instance['dem_orderby'] ), true ); ?>><?php esc_html_e( 'Event Start Date : ASC', 'dpevent' ); ?></option>
					<option value="<?php esc_attr_e( 'rand'); ?>" <?php selected( 'rand', esc_attr( $instance['dem_orderby'] ), true ); ?>><?php esc_html_e( 'Random', 'dpevent' ); ?></option>
					
	            </select>
	        </p> 
			  <p>
	            <label for="<?php echo esc_attr( $this->get_field_id( 'dem_day_format' ) ); ?>"><?php esc_html_e( 'Day Format', 'dpevent' ); ?></label>
	            <input type="text" id="<?php echo esc_attr( $this->get_field_id( 'dem_day_format' ) ); ?>"
	                   name="<?php echo esc_attr( $this->get_field_name( 'dem_day_format' ) ); ?>" class="widefat"
	                   value="<?php echo esc_attr( $instance['dem_day_format'] ); ?>">
	        </p>
			 <p>
	            <label for="<?php echo esc_attr( $this->get_field_id( 'dem_date_format' ) ); ?>"><?php esc_html_e( 'Date Format', 'dpevent' ); ?></label>
	            <input type="text" id="<?php echo esc_attr( $this->get_field_id( 'dem_date_format' ) ); ?>"
	                   name="<?php echo esc_attr( $this->get_field_name( 'dem_date_format' ) ); ?>" class="widefat"
	                   value="<?php echo esc_attr( $instance['dem_date_format'] ); ?>">
	        </p>
			<p>
	            <label for="<?php echo esc_attr( $this->get_field_id( 'dem_time_format' ) ); ?>"><?php esc_html_e( 'Time Format', 'dpevent' ); ?></label>
	            <input type="text" id="<?php echo esc_attr( $this->get_field_id( 'dem_time_format' ) ); ?>"
	                   name="<?php echo esc_attr( $this->get_field_name( 'dem_time_format' ) ); ?>" class="widefat"
	                   value="<?php echo esc_attr( $instance['dem_time_format'] ); ?>">
	        </p>
			<?php
		}
		/**
		 * Making the widget updateable
		 *
		 * @param  array $new_instance New instance of the widget
		 * @param  array $old_instance Old instance of the widget
		 *
		 * @return array An updated instance of the widget
		 */
		public function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			$instance['title']         		= $new_instance['title'];
			$instance['number_events'] 		= $new_instance['number_events'];
			$instance['dem_day_format'] 	= $new_instance['dem_day_format'];
			$instance['dem_date_format'] 	= $new_instance['dem_date_format'];
			$instance['dem_time_format'] 	= $new_instance['dem_time_format'];
			$instance['dem_orderby'] 		= $new_instance['dem_orderby'];
			return $instance;
		}
		/**
		 * Displaying the widget on the front-end
		 *
		 * @param  array $args Widget options
		 * @param  array $instance An instance of the widget
		 */
		public function widget( $args, $instance ) {
			if ( isset( $instance['title'] ) ) {
				$title = apply_filters( 'widget_title', $instance['title'] );
			}
			if ( isset( $instance['dem_day_format'] ) ) {
				$dem_day_format = $instance['dem_day_format'];
			}else{
				$dem_day_format = 'D';
			}
			
			if ( isset( $instance['dem_date_format'] ) ) {
				$dem_date_format = $instance['dem_date_format'];
			}else{
				$dem_date_format = 'F d Y';
			}
			
			if ( isset( $instance['dem_time_format'] ) ) {
				$dem_time_format = $instance['dem_time_format'];
			}else{
				$dem_time_format = 'h:i a';
			}
			
			if ( isset( $instance['dem_orderby'] ) ) {
				$dem_orderby = $instance['dem_orderby'];
			}else{
				$dem_orderby = 'date_desc';
			}
			
		 	//echo $current_date = date('d-m-Y');
		 	$current_date = gmdate('d-m-Y');
			/** @var Upcoming_Events_Lists_Event[] $events */
			$event_args = array( 	
									'post_type' 		=> 'dp_events',
									'posts_per_page'	=> $instance['number_events'],
									'post_status'    	=> 'publish',
								 	'meta_query' 		=> array(
																array(
																	'key' 		=> 'dp_event_end_date',
																	'value' 	=>  strtotime($current_date),
																	'compare' 	=> '>=', 
																	),

															)
							);
							
				if ( 'date_desc' !== $dem_orderby ) {
						switch( $dem_orderby ) {
							case 'date_asc' :
								$event_args['orderby'] = 'date';
								$event_args['order'] = 'ASC';
								break;
							case 'title_asc' :
								$event_args['orderby'] = 'title';
								$event_args['order'] = 'ASC';
								break;
							case 'title_desc' :
								$event_args['orderby'] = 'title';
								$event_args['order'] = 'DESC';
								break;
							case 'rand' :
								$event_args['orderby'] = 'rand';
								break;
							case 'event_start_desc' :
								$event_args['orderby'] = 'meta_value_num';
								$event_args['order'] = 'DESC';
								$event_args['meta_key'] = 'dp_event_start_date';
								break;
							case 'event_start_asc' :
								$event_args['orderby'] = 'meta_value_num';
								$event_args['order'] = 'ASC';
								$event_args['meta_key'] = 'dp_event_start_date';
								break;
						}
			}else{
						$event_args['orderby'] = 'date';
						$event_args['order'] = 'DESC';
			}				
			$events = new WP_Query( $event_args );
			//Preparing to show the events
			echo et_core_intentionally_unescaped( $args['before_widget'], 'html' );
			if ( ! empty( $title ) ) {
				echo '<h2>' . esc_attr( $title ). '</h2>';
			}
			?>
	        <div class="upcoming-events-list">
				<?php
					if($events ->have_posts()) : 
     					while($events ->have_posts()) : 
         						$events ->the_post();
								$event_permalink 				= get_the_permalink(get_the_ID());
								$event_title 					= get_the_title(get_the_ID());
								$event_start_date 				= get_post_meta(get_the_ID(), 'dp_event_start_date',true);
								$event_end_date 				= get_post_meta(get_the_ID(), 'dp_event_end_date',true);
								$event_start_time 				= get_post_meta(get_the_ID(), 'dp_event_start_time',true);
								$event_end_time 				= get_post_meta(get_the_ID(), 'dp_event_end_time',true);
								$event_venue					= get_post_meta(get_the_ID() ,'dpevent_address', true );
								$event_ticket_cost 				= get_post_meta(get_the_ID(), 'dpevent_cost_name', true);
								$event_ticket_cost_currency		= get_post_meta(get_the_ID(), 'dp_event_currency_symbol_name', true);
								$event_ticket_currency_position	= get_post_meta(get_the_ID(), 'dp_event_currency_prefix_suffix', true);?>
								<div id="event-<?php echo esc_attr( get_the_ID() );  ?>" class="dem_widget_main">
									<div id="event-<?php echo esc_attr( get_the_ID() );  ?>" class="dem_widget_mini">
										<?php if ( $event_start_date ) { ?>
						                    <div class="dem_widget_event_date ">
												<span class="dem_widget_event_date_dayname">
													<?php echo esc_html( date_i18n($dem_day_format, esc_attr( $event_start_date ))); ?>	
												</span>
												<span class="dem_widget_event_date_daynumber">
													<?php echo esc_html( date_i18n('d', esc_attr( $event_start_date ))); ?>
												</span>
						                    </div>
										<?php } ?>
										<?php if ( $event_title ) { ?>
						                    <div class="dem_widget_event_list_info ">
												<h2 class="dem_widget_event_title">
													<a href="<?php echo esc_url ( $event_permalink ); ?>" ><?php echo esc_html( $event_title ); ?></a>
												</h2>
												<div class="dem_widget_event_duration">
													<span class="dem_widget_event_date_time_start">
														<?php echo esc_html( date_i18n($dem_date_format,esc_attr( $event_start_date )) ).'  @  '.esc_html( date_i18n($dem_time_format, strtotime( esc_attr( $event_start_time )))) ; ?>
													</span>
												</div>
						                    </div>
						                   
										<?php } ?>
					               
					            	</div>
				            	</div>
		<?php
						endwhile;
					endif;
					wp_reset_postdata();
				?>
	        </div>
			<?php
			echo et_core_intentionally_unescaped( $args['after_widget'], 'html' );
		}
		/**
		 * Register current class as widget
		 */
		public static function register() {
			register_widget( __CLASS__ );
		}
	}
	add_action( 'widgets_init', array( 'Widget_Upcoming_Events_Lists', 'register' ) );
?>