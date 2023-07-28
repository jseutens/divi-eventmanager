<div class="et_pb_row dem_column_list_view_style3 dem_column_grid_view">
		<div class="et_pb_column et_pb_column_1_4 dem_list_style3_column_image ">
			<?php  if( !empty( $event_thumbnail_image_url ) ){  ?>
				<div class="dem_list_style3_image  dem_list_style3_desktop">
					<a href="<?php echo esc_url( $event_permalink ); ?>" <?php echo esc_attr($target_blank); ?>>
						<img src="<?php echo esc_url( $event_thumbnail_image_url ); ?>" alt="<?php echo esc_attr( $event_title ); ?>">
					</a>
				</div>
				<div class="dem_list_style3_image dem_list_style3_mobile">
					<a href="<?php echo esc_url( $event_permalink ); ?>" <?php echo esc_attr($target_blank); ?>>
						<img src="<?php echo esc_url( $event_thumbnail_image_large_url ); ?>" alt="<?php echo esc_attr( $event_title ); ?>">
					</a>
				</div>
			<?php } ?>
		</div>
		<div class="et_pb_column et_pb_column_1_2 dem_list_style3_column_content ">
			<div class="dem_list_style3_content">
				<?php echo et_core_esc_previously($dem_list_post_title_val); ?>
				<div class="dem_list_style3_description"><?php echo wp_kses_post( $event_content ); ?></div>
				<p class="dem_event_book_now">
				<?php if( $dem_list_show_read_more == 'on' ){ ?>
						<a href="<?php echo  esc_url( $event_permalink ); ?>" class="et_pb_button" <?php echo esc_attr($target_blank); ?>><?php echo esc_attr( $event_readmore_btn_text ); ?></a>
				<?php } ?>	
				</p>
			</div>
		</div>
		<div class="et_pb_column et_pb_column_1_4 dem_list_style3_column_meta_detail ">
			<div class="dem_list3_meta_detail_content">
				<?php if( !empty( $event_start_date ) ){ ?>
					<div class="dem_list_style3_date"><i class="et-pb-icon">&#xe023;</i><span><?php echo esc_html(date_i18n('d ', esc_attr( $event_start_date )));  echo esc_html(date_i18n(' F, Y',  esc_attr( $event_start_date ))); ?></span></div>
				<?php }
				if( !empty( $event_ticket_cost ) && !empty( $event_ticket_cost_currency ) ){
					if( $event_ticket_currency_position == 'suffix' ){ ?>
						<div class="dem_list_style3_ticket_cost"><i class="et-pb-icon">&#xe100;</i><span><?php echo esc_attr( $event_ticket_cost.$event_ticket_cost_currency ); ?></span></div>
					<?php }else{ ?>
						<div class="dem_list_style3_ticket_cost"><i class="et-pb-icon">&#xe100;</i><span><?php echo esc_attr( $event_ticket_cost_currency.$event_ticket_cost ); ?></span></div>
					<?php }
				}	
				if( !empty( $event_start_time ) && !empty( $event_end_time ) && !empty( $event_start_date ) ){
					if ( $dem_time_format == 'twhr' ){ ?>						
						<span class="dem_event_time"><i class="et-pb-icon">&#x7d;</i><?php echo esc_html( date_i18n('l', esc_attr( $event_start_date ))); ?>, <?php echo esc_html(  date_i18n("h:i a",  strtotime(esc_attr( $event_start_time )))); echo ' '.esc_attr($dem_evt_to).' '; echo esc_html( date_i18n("h:i a",  strtotime(esc_attr( $event_end_time )))); ?> </span>
					<?php }else{ ?>
						<span class="dem_event_time"><i class="et-pb-icon">&#x7d;</i><?php echo esc_html( date_i18n('l', esc_attr( $event_start_date))); ?>, <?php echo esc_html(date_i18n("H:i",strtotime(esc_attr( $event_start_time )))); echo ' '.esc_attr($dem_evt_to).' '; echo esc_html(date_i18n("H:i",strtotime(esc_attr( $event_end_time )))); ?></span>
						<?php
					}
				}
				if( !empty( $event_venue_address ) ){ ?>
					<div class="dem_list_style3_venue"><i class="et-pb-icon">&#xe01d;</i><span><?php echo esc_attr( rtrim($event_venue_address,', ') ); ?></span></div>
				<?php } ?>
			</div>
		</div>
</div>   