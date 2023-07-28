<?php get_header(); ?>
<div id="main-content">
	<div class="container">
		<div id="content-area" class="clearfix">			
			<div class="et_pb_row dp_events_page_row">
					<?php 
					$dem_themename = dem_theme_name();
					$divi_dem_archive_view_style 		= et_get_option($dem_themename.'_dem_archive_view_style','style3');
					$divi_dem_archive_dem_post_per_page = et_get_option($dem_themename.'_dem_archive_dem_post_per_page','9');
					$divi_dem_archive_display_event		= et_get_option($dem_themename.'_dem_archive_display_event','default');
					if ( $divi_dem_archive_display_event == 'showpastevents' ){
						$dem_show_past_events    	=	"on";
					    $dem_show_upcoming_events	=	"off";
					}else if ( $divi_dem_archive_display_event == 'showupcomingevents' ){
						$dem_show_past_events    	=	"off";
					    $dem_show_upcoming_events	=	"on";
					}else{
						$dem_show_past_events    	=	"off";
					    $dem_show_upcoming_events	=	"off";
					}
					if ( $divi_dem_archive_view_style == 'style1' || $divi_dem_archive_view_style == 'style2' || $divi_dem_archive_view_style == 'style3' ){
						echo do_shortcode( '[DP_Grid_View_Event dem_show_past_events="'.$dem_show_past_events.'" dem_show_upcoming_events="'.$dem_show_upcoming_events.'" dem_post_per_page="'.$divi_dem_archive_dem_post_per_page.'" dem_event_view_style="'.$divi_dem_archive_view_style.'" dem_show_pagination="on"]' ); 
					}else{
						echo do_shortcode( '[DP_List_View_Event dem_show_past_events="'.$dem_show_past_events.'" dem_show_upcoming_events="'.$dem_show_upcoming_events.'" dem_post_per_page="'.$divi_dem_archive_dem_post_per_page.'" dem_event_view_style="'.ltrim($divi_dem_archive_view_style, 'l').'" dem_show_pagination="on"]' ); 

					}
					?>
			</div>			
		</div> <!-- #content-area -->
	</div> <!-- .container -->
</div> <!-- #main-content -->
<?php get_footer(); ?>