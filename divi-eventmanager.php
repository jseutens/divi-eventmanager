<?php
/*
  Plugin Name: Divi Event Manager
  Plugin URI:  https://divi-professional.com/product/divi-event-manager-plugin/
  Description: Divi Event Manager is a Fully Responsive,lightweight, scalable and full event management featured.Manage your events with this powerful plugin and display them using divi modules,shortcodes and widgets.Quickly and easily create events, accept bookings.
  Version:     1.5.3
  Author:      Divi Professional
  Author URI:  https://divi-professional.com/
  License:     GPL2
  License URI: https://www.gnu.org/licenses/gpl-2.0.html
  Text Domain: dpevent
  Domain Path: /languages

  Divi Event Manager is free software: you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation, either version 2 of the License, or
  any later version.

  Divi Event Manager is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with Divi Event Manager. If not, see https://www.gnu.org/licenses/gpl-2.0.html.
*/
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
define('ROOTDIR', plugin_dir_path(__FILE__));
define('DEM_PLUGIN_URL', plugin_dir_url(__FILE__));
define('DEM_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('DEM_PLUGIN_DIR', trailingslashit(dirname(__FILE__)));

if (!function_exists('dem_initialize_extension')):
/**
 * Creates the extension's main class instance.
 *
 * @since 1.0.0
 */
function dem_initialize_extension() {
	require_once plugin_dir_path(__FILE__) . 'includes/DiviEventmanager.php';
	require_once(plugin_dir_path(__FILE__) . 'include/event-post-type.php');
	require_once(plugin_dir_path(__FILE__) . 'include/dem-eventmanager-shortcode.php');
}
add_action('divi_extensions_init', 'dem_initialize_extension');
endif;


add_action('plugins_loaded', 'dem_plugin_load_function');
/* plugin additional */
function dem_plugin_load_function() {
	add_action("epanel_render_maintabs", 'dem_epanel_tab');
	add_action("et_epanel_changing_options", 'dem_epanel_fields');
	load_plugin_textdomain('dpevent', false, DEM_PLUGIN_DIR . '/languages');
	require_once(plugin_dir_path(__FILE__) . 'include/dem_epanel_fields.php');
}
require_once(plugin_dir_path(__FILE__) . 'include/dem-functions.php');
require_once(plugin_dir_path(__FILE__) . 'include/dem-settings.php');

/* Plugin Setting Links */
function dem_plugin_settings_link($links, $file) {
	static $this_plugin;
	if (!$this_plugin) {
		$this_plugin = plugin_basename(__FILE__);
	}
	if ($file == $this_plugin) {
		$plugin_links[] = '<a href="' . admin_url('edit.php?post_type=dp_events&page=dp_events') . '">' . __('Color Settings', 'dpevent') . '</a>';
		$plugin_links[] = '<a href="' . admin_url('admin.php?page=et_divi_options#wrap-dem') . '">' . __('Settings', 'dpevent') . '</a>';
		foreach ($plugin_links as $link) {
			array_unshift($links, $link);
		}
	}
	return $links;
}
add_filter('plugin_action_links', 'dem_plugin_settings_link', 10, 2);

/* Documentation */
function dem_plugin_links($dem_links_array, $plugin_file_name, $plugin_data, $status) {
	if (strpos($plugin_file_name, basename(__FILE__))) {
		// You can still use `array_unshift()` to add links at the beginning.
		$dem_links_array[] = '<a href="'.esc_url("https://divi-professional.com/event-mananger-plugin-documentation/").'" target="_blank">Documentation</a>';
		$dem_links_array[] = '<a href="'.esc_url("https://divi-professional.com/my-account/").'" target="_blank">Support</a>';
	}
	return $dem_links_array;
}
add_filter('plugin_row_meta', 'dem_plugin_links', 10, 4);

/* Resize Image Size */
add_action('init', 'dem_event_image');
function dem_event_image() {
	add_image_size('dem_detail_1080_608', 1080, 608, array('top', 'center'));
	add_image_size('dem_detail_150_150', 150, 150, array('top', 'center'));
	add_image_size('dem_grid_400_400', 400, 400, array('top', 'center'));
	add_image_size('dem_list_300_300', 300, 300, array('top', 'center'));
	add_image_size('dem_slider1_500_232', 400, 200, array('top', 'center'));
	add_image_size('dem_slider3_400_300', 400, 300, array('top', 'center'));
}

// JS & CSS Load
add_action('wp_enqueue_scripts', 'dem_frontend_css_js');
function dem_frontend_css_js() {

	wp_register_style('dem_event_pagination_css', DEM_PLUGIN_URL . 'assets/css/pagination/dem_event_pagination.min.css', array(), NULL);
	wp_register_script('dem_equalheight', DEM_PLUGIN_URL . 'assets/js/dem_equalheight.min.js', array(), '1.0.0', true);
	
	wp_register_style('dem_slider_owl_carousel_min_css', DEM_PLUGIN_URL . 'assets/css/owlcarousel/owl.carousel.min.css', array(), NULL);
	wp_register_style('dem_slider_owl_theme_min_css', DEM_PLUGIN_URL . 'assets/css/owlcarousel/owl.theme.default.min.css', array(), NULL);
	wp_register_script('dem_slider_owl_corousel_min_js', DEM_PLUGIN_URL . 'assets/js/owl.carousel.min.js', array(), '1.0.0', true);
	
	wp_register_style('dem_calendar_main_css', DEM_PLUGIN_URL . 'assets/css/dem-calendar-main.min.css', array(), NULL);
	wp_register_script('dem_calendar_main_js', DEM_PLUGIN_URL . 'assets/js/dem-calendar-main.min.js', array(), '1.0.0', true);
	wp_register_script('dem_calendar_locales_js', DEM_PLUGIN_URL . 'assets/js/locales-all.min.js', array(), '1.0.0', true);
	wp_register_style('magnific-popup', DEM_PLUGIN_URL .'assets/css/magnific-popup.min.css', array(), NULL);			
	wp_register_script( 'magnific-popup', DEM_PLUGIN_URL . 'assets/js/jquery.magnific-popup.min.js', array('jquery'), NULL, TRUE );
	
	wp_register_script('dem_validation_js', DEM_PLUGIN_URL . 'assets/js/jquery.validate.min.js', array(), '1.0.0', true);
	//wp_register_script('dem_et_booking_js', DEM_PLUGIN_URL . 'assets/js/dem_booking.min.js', array(), '1.0.0', true);
	

	if (et_core_is_fb_enabled()) {
		wp_enqueue_style('dem_event_pagination_css');
		wp_enqueue_style('dem_slider_owl_carousel_min_css');
		wp_enqueue_style('dem_slider_owl_theme_min_css');
		wp_enqueue_script('dem_equalheight');
		wp_enqueue_script('dem_slider_owl_corousel_min_js');
		wp_enqueue_style('dem_calendar_main_css');
        wp_enqueue_script('dem_calendar_main_js');
		wp_enqueue_script('dem_calendar_locales_js');
	}
}

add_action('wp_enqueue_scripts', 'dem_detail_page_scripts', 9999);
function dp_event_assets( $modules ) {
	if (is_singular('dp_events')) {
		array_push( $modules, 'et_pb_contact_form' ,'et_pb_fullwidth_header','et_pb_section','et_pb_row','et_pb_column','et_pb_row_inner','et_pb_social_media_follow');
	}
	return $modules;
}
add_filter( 'et_required_module_assets', 'dp_event_assets' );
function dp_event_load_global_assets( $assets_list ) {
	$assets_prefix = et_get_dynamic_assets_path();

	// Ensure there is no other `et_icons_all` asset on the list to avoid any unexpected issue.
	if ( ! isset( $assets_list['et_icons_all'] ) ) {
		$assets_list['et_icons_all'] = array(
			'css' => "{$assets_prefix}/css/icons_all.css",
		);

		// Unset the other `et_icons_` assets. Only one icon asset can be loaded at the same time.
		unset( $assets_list['et_icons_base'], $assets_list['et_icons_social'] );
	}

	return $assets_list;
}
add_filter( 'et_global_assets_list', 'dp_event_load_global_assets' );
add_filter( 'et_late_global_assets_list', 'dp_event_load_global_assets' );

add_action('admin_enqueue_scripts', 'dem_css_js_admin', 9999);

function dem_css_js_admin($hook) {
    wp_enqueue_style('dem_css_js_admin', DEM_PLUGIN_URL .'assets/css/admin/dem_admin_module.min.css', array(), NULL);        
	wp_enqueue_script( 'jquery-migrate', DEM_PLUGIN_URL.'assets/js/admin/jquery-migrate-1.4.1-wp.min.js','1.4.1-wp');
	wp_enqueue_script(  'jquery', false, array( 'jquery-core', 'jquery-migrate' ), '1.12.4-wp' );
	if ( $hook == 'toplevel_page_dem_event_order' ){
	 wp_enqueue_style('datatablescss', DEM_PLUGIN_URL .'assets/css/admin/datatables.min.css', array(), NULL);        
	 wp_enqueue_script( 'datatablesjs', DEM_PLUGIN_URL.'assets/js/admin/datatables.min.js','');
	}
}


function dem_detail_page_scripts() {
	$dem_themename = dem_theme_name();

	if (is_post_type_archive('dp_events')) {
		wp_enqueue_style('dem_event_pagination_css');
	}

	if (is_singular('dp_events')) {
		wp_enqueue_style('magnific-popup');
		wp_enqueue_script('magnific-popup');
		$dem_detailpage_view = et_get_option($dem_themename . '_dem_detail_view_style', 'style1');
		
		// Woocommerce concept : Find Files From Child Theme. If Found then call from theme otherwise files call from plugin  
		$dem_template_path 	= get_stylesheet_directory() . '/divi-eventmanager';
		$dem_css_path 		= $dem_template_path . '/css/detail';
		$dem_css_url 		= get_stylesheet_directory_uri() . '/divi-eventmanager/css/detail';

		if ($dem_detailpage_view == 'style1') {
			if (file_exists($dem_css_path . '/dem_detail_style1.min.css')) {
				wp_enqueue_style('dem_detail_style1', $dem_css_url . '/dem_detail_style1.min.css', array(), NULL);
			} else {
				wp_enqueue_style('dem_detail_style1', DEM_PLUGIN_URL . 'assets/css/single-event/dem_detail_style1.min.css', array(), NULL);
			}
		} else if ($dem_detailpage_view == 'style2') {
			if (file_exists($dem_css_path . '/dem_detail_style2.min.css')) {
				wp_enqueue_style('dem_detail_style2', $dem_css_url . '/dem_detail_style2.min.css', array(), NULL);
			} else {
				wp_enqueue_style('dem_detail_style2', DEM_PLUGIN_URL . 'assets/css/single-event/dem_detail_style2.min.css', array(), NULL);
			}
		} else {
			if (file_exists($dem_css_path . '/dem_detail_customstyle.css')) {
				wp_enqueue_style('dem_detail_customstyle', $dem_css_url . '/dem_detail_customstyle.css', array(), NULL);
			} else {
				wp_enqueue_style('dem_detail_customstyle', DEM_PLUGIN_URL . 'assets/css/single-event/dem_detail_customstyle.min.css', array(), NULL);
			}
		}
		wp_enqueue_script('dem_validation_js', DEM_PLUGIN_URL . 'assets/js/jquery.validate.min.js', array(), '1.0.0', true);
		wp_enqueue_script('dem_et_booking_js', DEM_PLUGIN_URL . 'assets/js/dem_booking.min.js', array(), '1.0.0', true);
		$divi_dem_hide_form = et_get_option($dem_themename . '_dem_hide_form', 'off');
		$divi_dem_price_inquiry_form = et_get_option($dem_themename . '_dem_price_inquiry_form', 'off');
		wp_localize_script('dem_et_booking_js', 'et_booking_ajax_url', array('url' => admin_url('admin-ajax.php'), 'divi_dem_hide_form' => $divi_dem_hide_form, 'divi_dem_price_inquiry_form' => $divi_dem_price_inquiry_form));
		
	}
}

/************* Event Detail page  *****************/	
add_filter( 'single_template', 'dem_single_template' );
function dem_single_template($single_template) {
	$dem_themename = dem_theme_name();
	$dem_detailpage_view = et_get_option($dem_themename.'_dem_detail_view_style','style1');
	 global $post;
	 $dem_template_path =  get_stylesheet_directory() . '/divi-eventmanager';
	 if ($post->post_type == 'dp_events') {
	  if ( file_exists( $dem_template_path . '/single-dp_events_'.$dem_detailpage_view.'.php' ) )
		  {
			  $single_template = $dem_template_path. '/single-dp_events_'.$dem_detailpage_view.'.php';  
		  }else{
			  $single_template = ROOTDIR. 'include/single-dp_events_'.$dem_detailpage_view.'.php';  
		  }
						 
	 }
	return $single_template;
}
// Archive Event Template
function dem_events_archive_template( $archive_template ) {
     global $post;
	 $dem_template_path =  get_stylesheet_directory() . '/divi-eventmanager';
     if ( is_post_type_archive ( 'dp_events' ) ) {
	 	  if ( file_exists( $dem_template_path . '/archive-dp_events.php' ) )
		  {
			   $archive_template = $dem_template_path . '/archive-dp_events.php';
		  }else{
			   $archive_template = plugin_dir_path(__FILE__) . 'include/archive-dp_events.php';
		  }
         
     }
     return $archive_template;
}
add_filter( 'archive_template', 'dem_events_archive_template' ) ;

/************* Upcomming Event Widget *****************/    
function dem_widget_load_scripts()
{
    wp_enqueue_style('dem-upcoming-events-widget', DEM_PLUGIN_URL.'assets/css/dem_upcoming_events_widget.min.css', array(), NULL);
}
if(is_active_widget('', '','dem_upcoming_events'))
{
    add_action('wp_enqueue_scripts', 'dem_widget_load_scripts');
} 
include  DEM_PLUGIN_PATH . '/include/dem_upcoming_widget.php';

/************* Create Table in Datebase *****************/  
add_action('admin_init','dem_add_contact_table');
function dem_add_contact_table()
{
    require_once(DEM_PLUGIN_PATH . '/include/dem_order_table.php');
}

/************* CHANGE SLUGS OF CUSTOM POST TYPES  *****************/    
function dem_listing_page_slug( $arguments, $post_type ) {
  // $dem_listing_page_slug = et_get_option($dem_themename.'_dem_detail_changed_slug','events');
    $tname =  wp_get_theme();
    $dem_listing_page_slug_item = '';
    if ( $tname == 'Extra' ){
        $dem_listing_page_slug = get_option('et_extra');
		 if(isset($dem_listing_page_slug['extra_dem_detail_changed_slug']) && !empty($dem_listing_page_slug['extra_dem_detail_changed_slug'])) {
        		$dem_listing_page_slug_item = $dem_listing_page_slug['extra_dem_detail_changed_slug'];
		 }else{
		 		$dem_listing_page_slug_item = 'events';
		 }
    }else{
        $dem_listing_page_slug = get_option('et_divi');
		if(isset($dem_listing_page_slug['divi_dem_detail_changed_slug']) && !empty($dem_listing_page_slug['divi_dem_detail_changed_slug'])) {
        		$dem_listing_page_slug_item = $dem_listing_page_slug['divi_dem_detail_changed_slug'];
		}else{
		 		$dem_listing_page_slug_item = 'events';
		}
    }
   //flush_rewrite_rules();
    /*item post type slug*/   
    if ( 'dp_events' === $post_type ) { 
        $arguments['rewrite'] = array(
            'slug' => $dem_listing_page_slug_item
        );
    }
    return $arguments;
}
add_filter( 'register_post_type_args', 'dem_listing_page_slug', 10, 2 );

/*
CHANGE SLUGS OF TAXONOMIES, slugs used for archive pages
*/
function dem_change_taxonomies_slug( $args, $taxonomy ) {
    $tname =  wp_get_theme();
    $dem_event_category_slug_item = '';
    $dem_event_tag_slug_item = '';
    if ( $tname == 'Extra' ){
        $dem_event_page_slug = get_option('et_extra');
		if(isset($dem_event_page_slug['extra_dem_cat_slug']) && !empty($dem_event_page_slug['extra_dem_cat_slug'])) {
        		 $dem_event_category_slug_item = $dem_event_page_slug['extra_dem_cat_slug'];
		}else{
		 		 $dem_event_category_slug_item = 'event-category';
		}
		if(isset($dem_event_page_slug['extra_dem_tag_slug']) && !empty($dem_event_page_slug['extra_dem_tag_slug'])) {
        		$dem_event_tag_slug_item = $dem_event_page_slug['extra_dem_tag_slug'];
		}else{
		 		$dem_event_tag_slug_item = 'tag-category';
		}
    }else{
        $dem_event_page_slug = get_option('et_divi');
		if(isset($dem_event_page_slug['divi_dem_cat_slug']) && !empty($dem_event_page_slug['divi_dem_cat_slug'])) {
        		 $dem_event_category_slug_item = $dem_event_page_slug['divi_dem_cat_slug'];
		}else{
		 		 $dem_event_category_slug_item = 'event-category';
		}
		if(isset($dem_event_page_slug['divi_dem_tag_slug']) && !empty($dem_event_page_slug['divi_dem_tag_slug'])) {
        		$dem_event_tag_slug_item = $dem_event_page_slug['divi_dem_tag_slug'];
		}else{
		 		$dem_event_tag_slug_item = 'tag-category';
		}
    }
    if ( 'event_category' === $taxonomy && $dem_event_category_slug_item!= '') {
        $args['rewrite']['slug'] = $dem_event_category_slug_item;
    }
    if ( 'event_tag' === $taxonomy && $dem_event_tag_slug_item!= '') {
        $args['rewrite']['slug'] = $dem_event_tag_slug_item;
    }
    return $args;
}
add_filter( 'register_taxonomy_args', 'dem_change_taxonomies_slug', 10, 2 );


/************* To Display Order In Admin panel *****************/   
add_action('admin_menu','dem_order');
function dem_order()
{
    add_menu_page(__('Event Ticket Order','dpevent'), __('Event Ticket Order/Inquiry','dpevent'), 'manage_options', 'dem_event_order', 'dem_event_order', 'dashicons-tickets-alt' , 50 );
}
function dem_event_order(){
    require_once(DEM_PLUGIN_PATH . '/include/dem_admin_order_list.php');
}
require_once(DEM_PLUGIN_PATH . '/include/dem-ajax-from.php');