<?php
add_filter( 'gform_field_value_about_coach', 'coach_about_populate' ); //adds a filter to pre-populate the gravity form field
function coach_about_populate( $value ) {
	$author_id = get_current_user_id();  //get currently logged in user
	$pracid = get_field('plh_pract_id', 'user_'. $author_id );  //get the practitioner ID from user profile
	if($pracid <> null) { //if the ID is not null then continue
		if (is_int(intval($pracid))) { //Is the ID an int? It probably is as its setup as an INT inside ACF
			if (!is_null(get_post($pracid))) { //Does the post exist
    			return 'Prac ID is ' . $pracid . ' and the about field is this: ' . get_post_meta( $pracid, 'wpcf-about-coach', true ); //SAFE to get the data
			} else {
				return "CPT " . $pracid . " not found!"; //CPT of that ID doesn't exist
				exit(); //GTF out
			}
		} else { 
				return "Prac ID is not an INT!! Please contact the Administrator"; //NOT AN INT!!
				exit(); //GTF out
		}
	} else { //if the id IS null
		return "The Prac ID is empty. Please contact the site administrator.";
	}
}
?>
