<div class="et_pb_column dem_column_grid_view <?php echo esc_attr($dem_column_class .' '.$last_child); ?>">
	<div class="dem_grid_style2_container ">
		<?php if ( $event_thumbnail_image_url ): ?>
			<a href="<?php echo esc_url ( $event_permalink ); ?>"  <?php echo esc_attr($target_blank); ?>>
				<div class="dem_image"><img src="<?php echo esc_url ( $event_thumbnail_image_url ); ?>" alt="<?php echo esc_attr( $event_title ); ?>"></div>
			</a>
		<?php endif; ?>
		<div class="dem_grid_style2_event_detail">
			<?php echo et_core_esc_previously($dem_grid_title_val); ?>
			<?php if( $event_start_date && $event_venue_address && $event_end_time ){
				if ( $dem_time_format == 'twhr' ){
					$event_date_t = esc_html(date_i18n("h:i a",  strtotime(esc_attr( $event_start_time )))).' to '.esc_html(date_i18n("h:i a",  strtotime(esc_attr( $event_end_time ))));
				}else{
					$event_date_t = esc_html(date_i18n("H:i",strtotime(esc_attr( $event_start_time )))).' to '.esc_html(date_i18n("H:i",strtotime(esc_attr( $event_end_time ))));
				}
				?>
				<p class="dem_grid_style2_event_date_time_venue">
					<i class="et-pb-icon">&#xe01d;</i><?php echo esc_html(date_i18n('d ', esc_attr( $event_start_date ))); ?> <?php echo esc_html(date_i18n(' F, Y',  esc_attr( $event_start_date )));  echo ' '.esc_attr($dem_evt_at).' '; echo esc_attr( $event_date_t ); echo ' '.esc_attr($dem_evt_on).' '; echo esc_attr( rtrim($event_venue_address,', ') ); ?>
				</p>
			<?php }
			if( $event_ticket_cost && $event_ticket_cost_currency ){
				if( $event_ticket_currency_position == 'suffix' ){ ?>
					<p class="dem_grid_style2_event_cost"><?php echo esc_attr( $divi_dem_ticket_start_from ); ?> <?php echo esc_attr( $event_ticket_cost.$event_ticket_cost_currency ); ?></p>
		    <?php }else{ ?>
					<p class="dem_grid_style2_event_cost"><?php echo esc_attr( $divi_dem_ticket_start_from.' '.$event_ticket_cost_currency.$event_ticket_cost ); ?></p>
					<?php
				}
			}
			?>
			<div class="dem_grid_style2_event_text"><?php echo wp_kses_post( $event_content ); ?></div>
			<?php if ( $dem_grid_show_read_more == 'on' ) { ?>
			<p class="dem_grid_style2_book_now">
				<a href="<?php echo esc_url ( $event_permalink ); ?>" class="et_pb_button" <?php echo esc_attr($target_blank); ?>><?php echo esc_attr( $event_readmore_btn_text ); ?></a>
			</p>
			<?php } ?>
		</div>
	</div>
</div> 	