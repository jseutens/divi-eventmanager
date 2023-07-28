<?php 
$dem_themename = dem_theme_name();
$divi_dem_ticket_start_from = et_get_option($dem_themename.'_dem_ticket_start_from','Ticket Start From');
?>
<div class="et_pb_row dem_event_item dem_column_list_view_style2">
	<div class="et_pb_column et_pb_column_1_3 dem_column_list_view_style2_left">
		<a href="<?php echo  esc_url( $event_permalink ); ?>" <?php echo esc_attr($target_blank); ?>>
			<div class="dem_event_image dem_list_style2_desktop">
				<img src="<?php echo  esc_url( $event_thumbnail_image_url ); ?>" alt="<?php echo esc_attr( $event_title ); ?>">
			</div>
			<div class="dem_event_image dem_list_style2_mobile">
				<img src="<?php echo  esc_url( $event_thumbnail_image_large_url ); ?>" alt="<?php echo esc_attr( $event_title ); ?>">
			</div>
		</a>
	</div>
	<div class="et_pb_column et_pb_column_2_3 dem_column_list_view_style2_right">	
		<?php echo et_core_esc_previously($dem_list_post_title_val); 
		if( !empty( $event_start_date )  && !empty( $event_start_time ) && !empty( $event_end_time ) && !empty( $event_venue_address ) ){	
			if ( $dem_time_format == 'twhr' ){
				$event_date_t = esc_html(date_i18n("h:i a",  strtotime(esc_attr( $event_start_time )))).' - '.esc_html(date_i18n("h:i a",  strtotime(esc_attr( $event_end_time ))));
			}else{
				$event_date_t = esc_html(date_i18n("H:i",strtotime(esc_attr( $event_start_time )))).' - '.esc_html(date_i18n("H:i",strtotime(esc_attr( $event_end_time ))));
			}
			?>
			<p class="dem_event_date_time"><i class="et-pb-icon">&#xe023;</i>&nbsp;<?php echo esc_html(date_i18n('d ', esc_attr( $event_start_date )));  echo esc_html(date_i18n(' F, Y',  esc_attr( $event_start_date ))); echo ' '.esc_attr($dem_evt_at).' '; echo esc_attr( $event_date_t ); echo ' '.esc_attr($dem_evt_on).' '; echo esc_attr( rtrim($event_venue_address,', ') ); ?>
			</p>
		<?php } if( !empty( $event_content ) ){ ?>
			<p class="dem_event_content"><?php echo wp_kses_post( $event_content ); ?></p>
		<?php } if( !empty( $event_ticket_cost ) && !empty( $event_ticket_cost_currency ) ){
					if( $event_ticket_currency_position == 'suffix' ){ ?>
						<p class="dem_event_ticket"><?php echo esc_attr( $divi_dem_ticket_start_from ); ?> <?php echo esc_attr( $event_ticket_cost.$event_ticket_cost_currency ); ?></p>
					<?php }else{ ?> 
						<p class="dem_event_ticket"><?php echo esc_attr( $divi_dem_ticket_start_from ); ?> <?php echo esc_attr( $event_ticket_cost_currency.$event_ticket_cost ); ?></p>
					<?php }
			  } ?>
		<p class="dem_event_book_now">
		<?php if( $dem_list_show_read_more == 'on' ){ ?>
				<a href="<?php echo  esc_url( $event_permalink ); ?>" class="et_pb_button" <?php echo esc_attr($target_blank); ?>><?php echo esc_attr( $event_readmore_btn_text ); ?></a>
		<?php } ?>	
		</p>
	</div>
</div>  
<div class="et_pb_divider dem_divider"></div>			