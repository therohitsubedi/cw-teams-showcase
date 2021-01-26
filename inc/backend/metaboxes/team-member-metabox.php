<?php
defined('ABSPATH') or die("No script kiddies please!");

/**
 * Meta box for Post Type Team Memebers 
 */

add_action('add_meta_boxes', 'cw_tms_members_info_field');
function  cw_tms_members_info_field() {
    add_meta_box(
         'cw_tms_members_info', // $id
         __( "Member's Info", 'cw-tms' ), // $title
         'cw_tms_members_info_callback', // $callback
         'team-members', // $page
         'normal', // $context
         'high'
    ); // $priority
}

if( ! function_exists( 'cw_tms_members_info_callback' ) ):
function cw_tms_members_info_callback() {
    global $post ;
    wp_nonce_field( basename( __FILE__ ), 'cw_tms_members_info_nonce' );
    $cw_tms_member_designation = get_post_meta( $post->ID, 'cw_tms_member_designation', true );
    $cw_tms_member_address = get_post_meta( $post->ID, 'cw_tms_member_address', true );
    $cw_tms_member_fb_link = get_post_meta( $post->ID, 'cw_tms_member_fb_link', true );
    $cw_tms_member_tw_link = get_post_meta( $post->ID, 'cw_tms_member_tw_link', true );
    $cw_tms_member_gp_link = get_post_meta( $post->ID, 'cw_tms_member_gp_link', true );
    $cw_tms_member_lnk_link = get_post_meta( $post->ID, 'cw_tms_member_lnk_link', true );
    $cw_tms_member_web_link = get_post_meta( $post->ID, 'cw_tms_member_web_link', true );
?>

	<div class="member-info-wrapper">
        <div class="single-field-wrap">
            <h4><span class="section-title"><?php _e( 'Designation', 'cw-tms' );?></span></h4>
            <span class="section-inputfield"><input type="text" name="cw_tms_member_designation" value="<?php if( !empty( $cw_tms_member_designation ) ){ echo $cw_tms_member_designation ; }?>" /></span>
        </div>
        <div class="single-field-wrap">
            <h4><span class="section-title"><?php _e( 'Address', 'cw-tms' );?></span></h4>
            <span class="section-inputfield"><input type="text" name="cw_tms_member_address" value="<?php if( !empty( $cw_tms_member_address ) ){ echo $cw_tms_member_address ; }?>" /></span>
        </div>
        <div class="single-field-wrap">
            <h4><span class="section-title"><?php _e( 'Facebook', 'cw-tms' );?></span></h4>
            <span class="section-inputfield"><input type="text" name="cw_tms_member_fb_link" value="<?php if( !empty( $cw_tms_member_fb_link ) ){ echo $cw_tms_member_fb_link ; }?>" /></span>
        </div>
        <div class="single-field-wrap">
            <h4><span class="section-title"><?php _e( 'Twitter', 'cw-tms' );?></span></h4>
            <span class="section-inputfield"><input type="text" name="cw_tms_member_tw_link" value="<?php if( !empty( $cw_tms_member_tw_link ) ){ echo $cw_tms_member_tw_link ; }?>" /></span>
        </div>
        <div class="single-field-wrap">
            <h4><span class="section-title"><?php _e( 'Google Plus', 'cw-tms' );?></span></h4>
            <span class="section-inputfield"><input type="text" name="cw_tms_member_gp_link" value="<?php if( !empty( $cw_tms_member_gp_link ) ){ echo $cw_tms_member_gp_link ; }?>" /></span>
        </div>
        <div class="single-field-wrap">
            <h4><span class="section-title"><?php _e( 'LinkedIn', 'cw-tms' );?></span></h4>
            <span class="section-inputfield"><input type="text" name="cw_tms_member_lnk_link" value="<?php if( !empty( $cw_tms_member_lnk_link ) ){ echo $cw_tms_member_lnk_link ; }?>" /></span>
        </div>
        <div class="single-field-wrap">
            <h4><span class="section-title"><?php _e( 'Website', 'cw-tms' );?></span></h4>
            <span class="section-inputfield"><input type="text" name="cw_tms_member_web_link" value="<?php if( !empty( $cw_tms_member_web_link ) ){ echo $cw_tms_member_web_link ; }?>" /></span>
        </div>
    </div>
<?php
}
endif;
function cw_tms_members_info_save_post( $post_id ) { 
    global  $post;

        // Verify the nonce before proceeding.
    if ( !isset( $_POST[ 'cw_tms_members_info_nonce' ] ) || !wp_verify_nonce( $_POST[ 'cw_tms_members_info_nonce' ], basename( __FILE__ ) ) )
        return;

    // Stop WP from clearing custom fields on autosave
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE)  
        return;
        
    if ( 'page' == $_POST[ 'post_type' ] ) {  
        if (!current_user_can( 'edit_page', $post_id ) )  
            return $post_id;  
    } elseif (!current_user_can( 'edit_post', $post_id ) ) {  
            return $post_id;  
    }

    $cw_tms_member_designation = get_post_meta( $post->ID, 'cw_tms_member_designation', true );
    $stz_member_designation = sanitize_text_field($_POST['cw_tms_member_designation']);

    $cw_tms_member_address = get_post_meta( $post->ID, 'cw_tms_member_address', true );
    $stz_member_address = sanitize_text_field($_POST['cw_tms_member_address']);

    $cw_tms_member_fb_link = get_post_meta( $post->ID, 'cw_tms_member_fb_link', true );
    $stz_member_fb_link = esc_url($_POST['cw_tms_member_fb_link']);
    
    $cw_tms_member_tw_link = get_post_meta( $post->ID, 'cw_tms_member_tw_link', true );
    $stz_member_tw_link = esc_url($_POST['cw_tms_member_tw_link']);
    
    $cw_tms_member_gp_link = get_post_meta( $post->ID, 'cw_tms_member_gp_link', true );
    $stz_member_gp_link = esc_url($_POST['cw_tms_member_gp_link']);
    
    $cw_tms_member_lnk_link = get_post_meta( $post->ID, 'cw_tms_member_lnk_link', true );
    $stz_member_lnk_link = esc_url($_POST['cw_tms_member_lnk_link']);

    $cw_tms_member_web_link = get_post_meta( $post->ID, 'cw_tms_member_web_link', true );
    $stz_member_web_link = esc_url($_POST['cw_tms_member_web_link']);

    //update member's Designation
    if ( $stz_member_designation && '' == $stz_member_designation ){
        add_post_meta( $post_id, 'cw_tms_member_designation', $stz_member_designation );
    }elseif ($stz_member_designation && $stz_member_designation != $cw_tms_member_designation) {  
        update_post_meta($post_id, 'cw_tms_member_designation', $stz_member_designation);  
    } elseif ('' == $stz_member_designation && $cw_tms_member_designation) {  
        delete_post_meta($post_id,'cw_tms_member_designation', $cw_tms_member_designation);  
    }

    //update member's address
    if ( $stz_member_address && '' == $stz_member_address ){
        add_post_meta( $post_id, 'cw_tms_member_address', $stz_member_address );
    }elseif ($stz_member_address && $stz_member_address != $cw_tms_member_address) {  
        update_post_meta($post_id, 'cw_tms_member_address', $stz_member_address);  
    } elseif ('' == $stz_member_address && $cw_tms_member_address) {  
        delete_post_meta($post_id,'cw_tms_member_address', $cw_tms_member_address);  
    }

    //update member's facebook link
    if ( $stz_member_fb_link && '' == $stz_member_fb_link ){
        add_post_meta( $post_id, 'cw_tms_member_fb_link', $stz_member_fb_link );
    }elseif ($stz_member_fb_link && $stz_member_fb_link != $cw_tms_member_fb_link) {  
        update_post_meta($post_id, 'cw_tms_member_fb_link', $stz_member_fb_link);  
    } elseif ('' == $stz_member_fb_link && $cw_tms_member_fb_link) {  
        delete_post_meta($post_id,'cw_tms_member_fb_link', $cw_tms_member_fb_link);  
    }
    
    //update member's twitter link
    if ( $stz_member_tw_link && '' == $stz_member_tw_link ){
        add_post_meta( $post_id, 'cw_tms_member_tw_link', $stz_member_tw_link );
    }elseif ($stz_member_tw_link && $stz_member_tw_link != $cw_tms_member_tw_link) {  
        update_post_meta($post_id, 'cw_tms_member_tw_link', $stz_member_tw_link);  
    } elseif ('' == $stz_member_tw_link && $cw_tms_member_tw_link) {  
        delete_post_meta($post_id,'cw_tms_member_tw_link', $cw_tms_member_tw_link);  
    }
    
    //update member's google plus link
    if ( $stz_member_gp_link && '' == $stz_member_gp_link ){
        add_post_meta( $post_id, 'cw_tms_member_gp_link', $stz_member_gp_link );
    }elseif ($stz_member_gp_link && $stz_member_gp_link != $cw_tms_member_gp_link) {  
        update_post_meta($post_id, 'cw_tms_member_gp_link', $stz_member_gp_link);  
    } elseif ('' == $stz_member_gp_link && $cw_tms_member_gp_link) {  
        delete_post_meta($post_id,'cw_tms_member_gp_link', $cw_tms_member_gp_link);  
    }
    
    //update member's LinkedIn link
    if ( $stz_member_lnk_link && '' == $stz_member_lnk_link ){
        add_post_meta( $post_id, 'cw_tms_member_lnk_link', $stz_member_lnk_link );
    }elseif ($stz_member_lnk_link && $stz_member_lnk_link != $cw_tms_member_lnk_link) {  
        update_post_meta($post_id, 'cw_tms_member_lnk_link', $stz_member_lnk_link);  
    } elseif ('' == $stz_member_lnk_link && $cw_tms_member_lnk_link) {  
        delete_post_meta($post_id,'cw_tms_member_lnk_link', $cw_tms_member_lnk_link);  
    }

    //update member's Website link
    if ( $stz_member_web_link && '' == $stz_member_web_link ){
        add_post_meta( $post_id, 'cw_tms_member_web_link', $stz_member_web_link );
    }elseif ($stz_member_web_link && $stz_member_web_link != $cw_tms_member_web_link) {  
        update_post_meta($post_id, 'cw_tms_member_web_link', $stz_member_web_link);  
    } elseif ('' == $stz_member_web_link && $cw_tms_member_web_link) {  
        delete_post_meta($post_id,'cw_tms_member_web_link', $cw_tms_member_web_link);  
    }
}
add_action('save_post', 'cw_tms_members_info_save_post');
    