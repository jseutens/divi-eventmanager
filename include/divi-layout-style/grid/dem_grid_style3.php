<div class="et_pb_column dem_column_grid_view <?php echo esc_attr($dem_column_class .' '.$last_child); ?>">
	<div class="dem_grid_style3_container ">
		<div class="dem_grid_style3_date_city_day">
			<?php if( $event_start_date ){ ?>
				<div class="dem_grid_style3_date_month"><?php echo esc_html(date_i18n('d F', esc_attr( $event_start_date ))); ?></div>
			<?php } if( $event_city ){ ?>
				<div class="dem_grid_style3_city"><?php echo esc_attr( $event_city ); ?></div>
			<?php } if($event_start_date){ ?>
				<div class="dem_grid_style3_day"><?php echo esc_html(date_i18n('l', esc_attr( $event_start_date ))); ?></div>
			<?php } ?>
		</div>
		<div class="dem_grid_style3_event_content">
			<?php echo et_core_esc_previously($dem_grid_title_val); ?>
			<?php if( $event_venue_address != '' ){?>
				<p class="dem_grid_style3_venue"><strong><i class="et-pb-icon">&#xe01d;</i><?php echo esc_attr( rtrim($event_venue_address,', ') ); ?></strong></p>
			<?php } ?>
			<div class="dem_grid_style3_event_text"><?php echo wp_kses_post( $event_content ); ?></div>					
		</div>
	</div>
</div>