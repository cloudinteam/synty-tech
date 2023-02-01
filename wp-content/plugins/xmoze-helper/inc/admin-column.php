<?php 
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

add_filter( 'manage_xmoze_header_posts_columns', 'xmoze_include_exclude_columns' );
add_filter( 'manage_xmoze_footer_posts_columns', 'xmoze_include_exclude_columns' );
function xmoze_include_exclude_columns( $columns ){
    $columns['included_on'] = __( 'Included On' , 'xmoze-hp');
    $columns['excluded_on'] = __( 'Excluded On', 'xmoze_hp' );


    return $columns;

}

add_action( 'manage_xmoze_header_posts_custom_column', 'manage_realestate_posts_custom_colum_meta', 10, 2 );
add_action( 'manage_xmoze_footer_posts_custom_column', 'manage_realestate_posts_custom_colum_meta', 10, 2 );
function manage_realestate_posts_custom_colum_meta( $column, $post_id ){

    if('included_on' == $column){
        if( get_field('include_rules', $post_id ) ) {
              
            while( the_repeater_field('include_rules', $post_id) ) {
                $specific_pages = get_sub_field( 'pages' ) ? get_sub_field( 'pages' ) : [];
                $included_on = get_sub_field( 'include_on' );
                $archive        = 'archive' == $included_on ? is_archive() || is_home() || is_search() : false; 
                if('all' == $included_on){
                    esc_html_e( 'Entire Website', 'xmoze-hp' );
                }elseif('archive' == $included_on){
                    esc_html_e( 'Archive', 'xmoze-hp' );
                }else{
                    $pages = [];
                    foreach($specific_pages as $page){
                        $pages[] = get_the_title( $page );
                    }
    
                    echo implode(', ', $pages);
                }
            }
        }
    }
    if('excluded_on' == $column){
        if( get_field('exclude_rules', $post_id ) ) {
              
            while( the_repeater_field('exclude_rules', $post_id) ) {
                $specific_pages = get_sub_field( 'pages' ) ? get_sub_field( 'pages' ) : [];
                $excluded_on = get_sub_field( 'exclude_on' );
                $archive        = 'archive' == $excluded_on ? is_archive() || is_home() || is_search() : false; 
                if('all' == $excluded_on){
                    esc_html_e( 'Entire Website', 'xmoze-hp' );
                }elseif('archive' == $excluded_on){
                    esc_html_e( 'Archive', 'xmoze-hp' );
                }else{
                    $pages = [];
                    foreach($specific_pages as $page){
                        $pages[] = get_the_title( $page );
                    }
    
                    echo implode(', ', $pages);
                }
            }
        }
    }
}