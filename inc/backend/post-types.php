<?php
defined('ABSPATH') or die("No script kiddies please!");

$team_title = __( 'Team Members', 'cw-tms' );
$team_title = apply_filters( 'team_title', $team_title );

/**
* Our Team post type
*/
register_post_type( 'team-members', 
        array( 'labels' => 
                array(
                'name' => __( $team_title, 'cw-tms' ),
                'singular_name' => __( 'Team Member', 'cw-tms' ), 
                'all_items' => __( 'All Team Members', 'cw-tms' ), 
                'add_new' => __( 'Add New', 'cw-tms' ), 
                'add_new_item' => __( 'Add New Member', 'cw-tms' ), 
                'edit' => __( 'Edit Member', 'cw-tms' ), 
                'edit_item' => __( 'Edit', 'cw-tms' ), 
                'new_item' => __( 'New Post Member', 'cw-tms' ), 
                'view_item' => __( 'View Members', 'cw-tms' ), 
                'search_items' => __( 'Search Members', 'cw-tms' ),
                'not_found' =>  __( 'Nothing found in the Database.', 'cw-tms' ), 
                'not_found_in_trash' => __( 'Nothing found in Trash', 'cw-tms' ), 
                'parent_item_colon' => ''
                ), 
        'public' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'show_ui' => true,
        'query_var' => true,
        'menu_position' => 24,
        'menu_icon' => 'dashicons-groups',
        'has_archive' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'supports' => array( 'title', 'editor', 'thumbnail')
    ) 
);