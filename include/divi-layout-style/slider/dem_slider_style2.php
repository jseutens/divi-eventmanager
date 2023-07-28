<div class="item dem_column_grid_view">
	<a href="<?php echo esc_url($event_permalink ) ?>" <?php echo esc_attr($target_blank); ?> style=" background-image: url(<?php echo esc_url($event_thumbnail_image_url ); ?>);">        
		<span class="dem_slider_style2_detail">
			<span class="dem_slider_style2_title"><?php echo et_core_esc_previously($dem_slider_title_val); ?></span>
			<?php if( !empty(rtrim($event_venue_address,', ')) ){ ?>
			<span class="dem_slider_style2_venue"><i class="et-pb-icon">&#xe01d;</i><?php echo esc_attr( $event_venue_address ); ?></span>
			<?php } ?>
		</span>
		<?php if( !empty ( $event_start_date ) && !empty ( $event_start_time ) && !empty ( $event_end_time ) ){
				if ( $dem_time_format == 'twhr' ){
					$event_date_t = esc_html(date_i18n("h:i a",  strtotime(esc_attr( $event_start_time )))).' '.esc_attr($dem_evt_to).' '.esc_html(date_i18n("h:i a",  strtotime(esc_attr( $event_end_time ))));
				}else{
					$event_date_t = esc_html(date_i18n("H:i",strtotime(esc_attr( $event_start_time )))).' '.esc_attr($dem_evt_to).' '.esc_html(date_i18n("H:i",strtotime(esc_attr( $event_end_time ))));
				}
				?>
			    <span class="dem-event-date">
					<span class="dem-event-day"><?php echo esc_html(date_i18n('d', esc_attr( $event_start_date ))); ?></span>
					<span class="dem-event-month"><?php echo esc_html(date_i18n('F,Y', esc_attr( $event_start_date ))); ?></span>
					<span class="dem-event-time"><?php echo esc_html(date_i18n('l',  esc_attr( $event_start_date ))); ?>, <?php echo esc_attr( $event_date_t ); ?></span>
				</span>
		<?php } ?>
	    <div class="dem_slide_styler2_event_text"><?php echo wp_kses_post( $event_content ); ?></div>
	</a>
</div>		 	