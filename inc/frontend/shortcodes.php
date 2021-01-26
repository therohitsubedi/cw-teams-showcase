<?php
defined('ABSPATH') or die("No script kiddies please!");


/**
 * Shortcode for Team Member 
 */
add_shortcode( 'cw-team', 'cw_team_short' );
function cw_team_short( $team_atts ){
    $posts_per_page = 10;
    $post_order = 'DESC';
    $pagination_option = 'no';
    $section_title = 'Team Member';
if (is_array($team_atts)) {
    foreach( $team_atts as $key=>$value ){
        if( $key == 'posts_per_page' ){
            $posts_per_page = $value;
        } elseif( $key == 'order' ){
            $post_order = $value;
        } elseif( $key == 'pagination' ){
            $pagination_option = $value;
        } else{ }
    }
}
    $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
    $team_args = array(
                        'post_type'=>'team-members',
                        'post_status'=>'publish',
                        'posts_per_page'=>$posts_per_page,
                        'order'=>$post_order,
                        'paged' => $paged
                        );
    $team_query = new WP_Query( $team_args );
?>
<div class="team-section-wrapper clearfix">
    <h1 class="section-title"><?php echo esc_attr( $section_title ); ?></h1>
<?php
    if( $team_query->have_posts() ){
        while($team_query->have_posts()){
            $team_query->the_post();
            $post_id = get_the_ID();
            $image_id = get_post_thumbnail_id();
            $image_path = wp_get_attachment_image_src( $image_id, 'medium', true );
            $image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
            $member_designation = get_post_meta( $post_id, 'cw_tms_member_designation', true );
            $member_address = get_post_meta( $post_id, 'cw_tms_member_address', true );
            $member_fb_link = get_post_meta( $post_id, 'cw_tms_member_fb_link', true );
            $member_tw_link = get_post_meta( $post_id, 'cw_tms_member_tw_link', true );
            $member_gp_link = get_post_meta( $post_id, 'cw_tms_member_gp_link', true );
            $member_lnk_link = get_post_meta( $post_id, 'cw_tms_member_lnk_link', true );
            $member_web_link = get_post_meta( $post_id, 'cw_tms_member_web_link', true );
?>
    <div class="single-member-wrap">
        <div class="member-flip-wrap">
            <?php if( has_post_thumbnail() ) { ?>
                <figure><img src="<?php echo esc_url( $image_path[0] ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>" title="<?php the_title(); ?>" /></figure>
            <?php } ?>
            <div class="member-info">
                <h3 class="member-name"><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h3>
                <div class="member-desgination"><i class="fa fa-briefcase"></i> <?php echo esc_attr( $member_designation ); ?></div>
                <div class="member-address"><i class="fa fa-map-pin"></i> <?php echo esc_attr( $member_address ); ?></div>
                <div class="member-social-links">
                    <?php if( !empty( $member_fb_link ) ){ ?><span class="fb"><a href="<?php echo esc_url( $member_fb_link );?>" target="_blank"><i class="fa fa-facebook"></i></a></span><?php } ?>
                    <?php if( !empty( $member_tw_link ) ){ ?><span class="tw"><a href="<?php echo esc_url( $member_tw_link );?>" target="_blank"><i class="fa fa-twitter"></i></a></span><?php } ?>
                    <?php if( !empty( $member_gp_link ) ){ ?><span class="gp"><a href="<?php echo esc_url( $member_gp_link );?>" target="_blank"><i class="fa fa-google-plus"></i></a></span><?php } ?>
                    <?php if( !empty( $member_lnk_link ) ){ ?><span class="lnk"><a href="<?php echo esc_url( $member_lnk_link );?>" target="_blank"><i class="fa fa-linkedin"></i></a></span><?php } ?>
                    <?php if( !empty( $member_web_link ) ){ ?><span class="web"><a href="<?php echo esc_url( $member_web_link );?>" target="_blank"><i class="fa fa-globe"></i></a></span><?php } ?>
                </div>
            </div>
        </div>
    </div>
<?php 
        }
        $big = 999999999; // need an unlikely integer
         $page_args = array(
        	'base'               => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
        	'format'             => '?page=%#%',
        	'total'              => $team_query->max_num_pages,
        	'current'            => max( 1, get_query_var('paged') ),
        	'show_all'           => False,
        	'end_size'           => 1,
        	'mid_size'           => 2,
        	'prev_next'          => True,
        	'prev_text'          => __('&lt;&lt; Previous'),
        	'next_text'          => __('Next &gt;&gt;'),
        	'type'               => 'plain',
        	'add_args'           => False,
        	'add_fragment'       => '',
        	'before_page_number' => '',
        	'after_page_number'  => ''
        );
        if( $pagination_option == 'yes' ){
            echo '<div class="tms-pagination clear">'. paginate_links( $page_args ) .'</div>';    
        }
     } wp_reset_query(); 
?>
</div>
<?php
}

add_filter('widget_text', 'do_shortcode');