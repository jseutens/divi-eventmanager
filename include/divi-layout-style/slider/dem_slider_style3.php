<div class="item dem_column_grid_view">	
	<div class="dem_slider_style3_item_inner">
		<?php if ( !empty ( $event_thumbnail_image_url ) ){ ?>
			<div class="dem_slider_style3_event_image"> <img  src="<?php echo esc_url( $event_thumbnail_image_url ); ?>" alt="<?php echo esc_attr( $event_title ); ?>"> </div>
		<?php } ?>
		<div class="dem_slider_style3_event_meta_content">
			<?php if ( !empty ( $event_start_date ) ){ ?>
				<span class="dem_event_date"> <?php echo esc_html(date_i18n('d ', esc_attr( $event_start_date ))).esc_html(date_i18n('F,Y', esc_attr( $event_start_date ))); ?> </span>
			<?php }
			echo et_core_esc_previously($dem_slider_title_val); 
			if( $dem_slider_show_read_more == 'on' ){ ?>
				<div class="dem_slider_style3_view_more"><a class="dem_slider_style3_event_view_more" href="<?php echo esc_url( $event_permalink ) ?>" <?php echo esc_attr($target_blank); ?>><?php echo esc_attr( $dem_slider_read_more_button_text ); ?></a>
				</div>
			<?php } ?>	
		</div>
	</div>
</div>		