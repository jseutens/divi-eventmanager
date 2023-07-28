<div class="item dem_column_grid_view">
	<div class="dem_column_slider_view ">
		<?php if ( !empty ( $event_thumbnail_image_url ) ): ?>
			<div class="dem_slider_style1_image">
				<a href="<?php echo esc_url($event_permalink ); ?>" <?php echo esc_attr($target_blank); ?>><img src="<?php echo esc_url($event_thumbnail_image_url ); ?>" alt="<?php echo esc_attr( $event_title ); ?>"></a>
				<div class="dem_slider_style1_image_overlay">
					<div class="dem_slider_style1_image_box">
						<div class="dem_slider_style1_image_content"><a href="<?php echo esc_url($event_permalink ); ?>" <?php echo esc_attr($target_blank); ?>><i class="et-pb-icon">&#xe02c;</i></a></div>
					</div>
				</div>
			</div>
		<?php endif;
		echo et_core_esc_previously($dem_slider_title_val); ?>	
		<div class="dem_slider_style1_event_detail">
		<?php if ( !empty ( $event_start_date ) ) { ?>
			<span class="dem_slider_style1_duration "><i class="et-pb-icon">&#xe025;</i><?php echo esc_html(date_i18n('j M,Y', esc_attr( $event_start_date ))); ?></span>
		<?php } if ( $event_start_date && $event_start_time && $event_end_time ) { ?>
			<span class="dem_slider_style1_category"><i class="et-pb-icon">&#xe012;</i><?php echo esc_attr( $terms_string ); ?></span>
			<?php if ( $dem_time_format == 'twhr' ) { ?>
				<span class="dem_slider_style1_category"><?php echo esc_html(date_i18n('l', esc_attr( $event_start_date ))); ?>, <?php echo esc_html(date_i18n("h:i a", strtotime(esc_attr( $event_start_time )))); echo ' '.esc_attr($dem_evt_to).' '; echo esc_html(date_i18n("h:i a", strtotime(esc_attr( $event_end_time )))); ?></span>
			<?php } else { ?>
				<span class="dem_slider_style1_category"><?php echo esc_html(date_i18n('l', esc_attr( $event_start_date ))); ?>, <?php echo esc_html(date_i18n("H:i", strtotime(esc_attr( $event_start_time )))); echo ' '.esc_attr($dem_evt_to).' '; echo esc_html(date_i18n("H:i", strtotime(esc_attr( $event_end_time )))); ?></span>
			<?php }
		   } ?>
	</div>
</div>
<?php if( $dem_slider_show_read_more == 'on' ){ ?>
	<div class="dem_slider_style1_button"><a href="<?php echo esc_url($event_permalink ); ?>" class="et_pb_button" <?php echo esc_attr($target_blank); ?> ><i class="et-pb-icon ">&#x24;</i></a></div>
<?php } ?>
</div>