<?php
global $wpdb;
$dem_charset_collate = '';
if ( ! empty( $wpdb->charset ) ) {
  $dem_charset_collate = "DEFAULT CHARACTER SET {$wpdb->charset}";
}
if ( ! empty( $wpdb->collate ) ) {
  $dem_charset_collate .= " COLLATE {$wpdb->collate}";
}
$dem_contact_table = $wpdb->prefix . "dem_order";
if($wpdb->get_var("SHOW TABLES LIKE '$dem_contact_table'") != $dem_contact_table) {
$dem_contact_sql = "CREATE TABLE $dem_contact_table (
	dem_booking_id int(11) NOT NULL AUTO_INCREMENT,
	dem_user_name varchar(50) NOT NULL,
	dem_user_email varchar(50) NOT NULL,
	dem_user_tel varchar(15) NULL,
	dem_event_id int(10) NOT NULL,
	dem_event_title varchar(200) NOT NULL,
	dem_event_currency varchar(20) NOT NULL,
	dem_event_cu_pos varchar(15) NOT NULL,
	dem_event_ticket_price varchar(15) NOT NULL,
	dem_event_total_price varchar(15) NOT NULL,
	dem_event_no_of_ticket int(3) NULL,
	dem_booking_date date NOT NULL,
	dem_booking_status varchar(10) NOT NULL,
	PRIMARY KEY (`dem_booking_id`)
	) $dem_charset_collate;";
require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
dbDelta( $dem_contact_sql );
}