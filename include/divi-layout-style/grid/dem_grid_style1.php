<div class=" et_pb_column <?php echo  esc_attr($dem_column_class .' '.$last_child); ?> ">
  	<div class="dem_grid_main_content dem_grid_style1_container">
  		<a href="<?php echo esc_url($event_permalink); ?>" <?php echo esc_attr($target_blank); ?> class="dem_column_grid_view" style=" background-image: url('<?php echo esc_url ( $event_thumbnail_image_url ); ?>'); ">    		<span class="dem_grid_detail">
  				<span class="dem_grid_title_content"><?php echo et_core_esc_previously($dem_grid_title_val) ; ?></span>
  				<?php if( !empty(rtrim($event_venue_address,', ')) ){ ?>
				<span class="dem_grid_venue"><i class="et-pb-icon">&#xe081;</i><?php echo esc_attr( rtrim($event_venue_address,', ') ); ?></span>
				<?php } ?>
  			</span>
  			<?php if( $event_start_date ){ ?>
  			<span class="dem-event-date">
				<span class="dem-event-day"><?php echo esc_html(date_i18n('d', esc_attr( $event_start_date ))); ?></span>
  				<span class="dem-event-month"><?php echo esc_html(date_i18n('F,Y', esc_attr( $event_start_date ))); ?></span>
  				<?php if( $event_start_time && $event_end_time ){
  							if ( $dem_time_format == 'twhr' ){ ?>
  								<span class="dem-event-time"><?php echo esc_html(date_i18n('l', esc_attr( $event_start_date ))); ?>, <?php echo esc_html(date_i18n("h:i a",  strtotime(esc_attr( $event_start_time )))); echo ' '.esc_attr($dem_evt_to).' '; echo esc_html(date_i18n("h:i a",  strtotime(esc_attr( $event_end_time )))); ?></span>
  					 <?php }else{ ?>
  								<span class="dem-event-time"><?php echo esc_html(date_i18n('l', esc_attr( $event_start_date ))); ?>, <?php echo esc_html(date_i18n("H:i",strtotime(esc_attr($event_start_time )))); echo ' '.esc_attr($dem_evt_to).' '; echo esc_html(date_i18n("H:i",strtotime(esc_attr( $event_end_time )))); ?></span>
  						<?php 
  					}
  				}
  				?>
  			</span>
  			<div class="dem_grid_event_text"><?php echo wp_kses_post( $event_content ); ?></div>	
  		<?php } ?>
  	 </a>
  </div>
</div>