<?php
function dem_theme_name() {
	$tname = wp_get_theme();
	if ( $tname->get('Name') == 'Extra' || $tname->get('Template') == 'Extra' ){ $dem_tname = 'extra';}
	else if( $tname->get('Name') == 'Divi' || $tname->get('Template') == 'Divi' ){ $dem_tname = 'divi';}
	else{$dem_tname = 'divi';}
	return $dem_tname;
}
function dem_hex2rgba($color, $opacity = false) 
	{
		$default = 'rgb(0,0,0)';
		if(empty($color))
			  return $default; 
			if ($color[0] == '#' ) {
				$color = substr( $color, 1 );
			}
			if (strlen($color) == 6) {
					$hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
			} elseif ( strlen( $color ) == 3 ) {
					$hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
			} else {
					return $default;
			}
			$rgb =  array_map('hexdec', $hex);
			if($opacity){
				if(abs($opacity) > 1)
					$opacity = 1.0;
				$output = 'rgba('.implode(",",$rgb).','.$opacity.')';
			} else {
				$output = 'rgb('.implode(",",$rgb).')';
			}
		return $output;
}

function dem_general_view_op_get_value($dem_field_name, $dem_field_value = '') {
	 $dem_option_field_value = '';
	 $general_view_op_tool = unserialize(get_option('general_view_op'));
	 if ($dem_field_name != '' && is_array($general_view_op_tool) && array_key_exists($dem_field_name, $general_view_op_tool)) {
		$dem_option_field_value = $general_view_op_tool[$dem_field_name];
		  if ($dem_option_field_value == '' && $dem_field_value != '') {
		   $dem_option_field_value = esc_attr( $dem_field_value );
		}
	 } else {
		if ($dem_option_field_value == '' && $dem_field_value != '' && $dem_field_name != '') {
			 $dem_option_field_value = esc_attr( $dem_field_value );
		}
	 }
	 return $dem_option_field_value;
}



function dem_detail_view_op_get_value($dem_field_name, $dem_field_value = '') {
	 $dem_option_field_value = '';
	 $detail_view_op_tool = maybe_unserialize(get_option('detail_view_op'));
	 if ($dem_field_name != '' && is_array($detail_view_op_tool) && array_key_exists($dem_field_name, $detail_view_op_tool)) {
	    $dem_option_field_value = $detail_view_op_tool[$dem_field_name];
	 	if ($dem_option_field_value == '' && $dem_field_value != '') {
	  		 $dem_option_field_value = esc_attr( $dem_field_value );
		}
	 }else {
	 	 if ($dem_option_field_value == '' && $dem_field_value != '' && $dem_field_name != '') {
	  		 $dem_option_field_value = esc_attr( $dem_field_value );
		 }
	 }
	 return $dem_option_field_value;
}
function dem_email_customization_op_get_value($dem_field_name, $dem_field_value = '') {
	 $dem_option_field_value = '';
	 $email_view_op_tool = maybe_unserialize(get_option('email_view_op'));
	 if ($dem_field_name != '' && is_array($email_view_op_tool) && array_key_exists($dem_field_name, $email_view_op_tool)) {
	    $dem_option_field_value = $email_view_op_tool[$dem_field_name];
	 	if ($dem_option_field_value == '' && $dem_field_value != '') {
	  		 $dem_option_field_value = esc_attr( $dem_field_value );
		}
	 }else {
	 	 if ($dem_option_field_value == '' && $dem_field_value != '' && $dem_field_name != '') {
	  		 $dem_option_field_value = esc_attr( $dem_field_value );
		 }
	 }
	 return $dem_option_field_value;
}

function dem_unserializeForm($str) {
    $returndata = array();
    $strArray = explode("&", $str);
    $i = 0;
    foreach ($strArray as $item) {
        $array = explode("=", $item);
        $returndata[$array[0]] = $array[1];
    }
    return $returndata;
}