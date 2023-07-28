<div class="et_pb_column et_pb_column_4_4 dem_column_list_view dem_column_list_view_style1">
	<a class="dem_event_item_link" href="<?php echo esc_url($event_permalink); ?>" <?php echo esc_attr($target_blank); ?>>
		<?php if( !empty( $event_start_date ) ){	?>	
			<div class="dem_event_date">
				<div class="dem_event_day"><?php echo esc_html(date_i18n('d', esc_attr( $event_start_date ))); ?></div>
				<div class="dem_event_month"><?php echo esc_html(date_i18n('F', esc_attr( $event_start_date ))); ?></div>
				<div class="dem_event_year"><?php echo esc_html(date_i18n('Y', esc_attr( $event_start_date ))); ?></div>
			</div>
		<?php } ?>
		<div class="dem_event_detail ">
			<?php if( !empty( $event_start_time ) && !empty( $event_end_time ) && !empty( $event_start_date ) ){
					if ( $dem_time_format == 'twhr' ){ ?>
						<div class="dem_event_time">
							<i class="et-pb-icon">&#x7d;</i>&nbsp;<?php echo esc_html(date_i18n('l', esc_attr( $event_start_date ))); ?>, <?php echo esc_html(date_i18n("h:i a",  strtotime(esc_attr( $event_start_time )))); echo ' '.esc_attr($dem_evt_to).' '; echo esc_html(date_i18n("h:i a",  strtotime(esc_attr( $event_end_time )))); ?>
						</div>
				<?php }else{ ?>
						<div class="dem_event_time">
							<i class="et-pb-icon">&#x7d;</i>&nbsp;<?php echo esc_html(date_i18n('l', esc_attr( $event_start_date ))); ?>, <?php echo esc_html(date_i18n("H:i",strtotime(esc_attr( $event_start_time )))); echo ' '.esc_attr($dem_evt_to).' '; echo esc_html(date_i18n("H:i",strtotime(esc_attr( $event_end_time )))); ?>
						</div>
				<?php }
				}
				echo et_core_esc_previously($dem_list_post_title_val); 
				if( !empty( $event_venue_address ) ){ ?><div class="dem_event_venue"><i class="et-pb-icon">&#xe081;</i>&nbsp;<?php echo esc_attr( rtrim($event_venue_address,', ') ); ?></div><?php }
				if( !empty( $event_content ) ){ ?><p class="dem_event_content"><?php echo wp_kses_post( $event_content ); ?></p><?php } ?>
		</div>
		<?php if( $dem_list_show_read_more == 'on' ){ ?> <i class="et-pb-icon dem_event_icon_arrow_right">&#x39;</i> <?php } ?>
	</a>
</div>