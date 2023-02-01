<?php
if (!defined('ABSPATH')) {
    exit;
}


/**
 * Meta Output
 *
 * @since 1.0
 *
 * @return array
 */
if ( ! function_exists( 'xmoze_get_meta' ) ) {
    function xmoze_get_meta( $data ) {
        global $wp_embed;
        $content = $wp_embed->autoembed( $data );
        $content = $wp_embed->run_shortcode( $content );
        $content = do_shortcode( $content );
        $content = wpautop( $content );
        return $content;
    }
}

function xmoze_cpt_taxonomy_slug_and_name($taxonomy_name, $option_tag = false)
{
    $taxonomyies = get_terms($taxonomy_name);
    if(true == $option_tag){
        $cpt_terms = '';
        foreach ($taxonomyies as $category) {
            if( isset( $category->slug ) && isset( $category->name ) ){
               $cpt_terms .= '<option value="'. esc_attr( $category->slug) .'">'.  $category->name .'</option>';
            }
        }
        return $cpt_terms;
    }
    $cpt_terms = [];
    foreach ($taxonomyies as $category) {
        if( isset( $category->slug ) && isset( $category->name ) ){
            $cpt_terms[$category->slug] = $category->name;
        }
    }
    return $cpt_terms;
}

function xmoze_cpt_taxonomy_id_and_name($taxonomy_name)
{
    $taxonomyies = get_terms($taxonomy_name);
    $cpt_terms = [];
    foreach ($taxonomyies as $category) {
        $cpt_terms[$category->term_id] = $category->name;
    }
    return $cpt_terms;
}

function xmoze_cpt_author_slug_and_id($post_type)
{
    $the_query = new WP_Query(array(
        'posts_per_page' => -1,
        'post_type' => $post_type,
    ));
    $author_meta = [];
    while ($the_query->have_posts()) : $the_query->the_post();
        $author_meta[get_the_author_meta('ID')] = get_the_author_meta('display_name');
    endwhile;
    wp_reset_postdata();
    return array_unique($author_meta);
}
function xmoze_cpt_slug_and_id($post_type)
{
    $the_query = new WP_Query(array(
        'posts_per_page' => -1,
        'post_type' => $post_type,
    ));
    $cpt_posts = [];
    while ($the_query->have_posts()) : $the_query->the_post();
        $cpt_posts[get_the_ID()] = get_the_title();
    endwhile;
    wp_reset_postdata();
    return $cpt_posts;
}

function xmoze_get_meta_field_keys($post_type, $field_name, $fild_type = "choices")
{
    $the_query = new WP_Query(array(
        'posts_per_page' => 1,
        'post_type' => $post_type,
    ));

    $field_object = [];
    while ($the_query->have_posts()) : $the_query->the_post();
    $field_object = isset(get_field_object($field_name)[$fild_type]) ? get_field_object($field_name)[$fild_type] : false;
    endwhile;
    return $field_object;
    wp_reset_postdata();
}


function xmoze_loadmore_callback()
{
    // maybe it isn't the best way to declare global $post variable, but it is simple and works perfectly!
    $nonce = (isset($_POST['nonce'])) ? $_POST['nonce'] : '';
    if(check_ajax_referer( 'xmoze_loadmore_callback', 'folio_nonce' )){
        $settings = (isset($_POST['portfolio_settings'])) ? $_POST['portfolio_settings']['settings'] : [];
        $paged = (isset($_POST['paged'])) ? $_POST['paged'] : '';
        include(__DIR__ . '/../widgets/portfolio/queries/portfolio-query.php');
        include(__DIR__ . '/../widgets/portfolio/contents/portfolio-content.php');
        wp_reset_postdata();
        wp_die( ' ' );
    }else{
        echo "something wrong";
        wp_die( ' ' );
    }
}
add_action('wp_ajax_xmoze_loadmore_callback', 'xmoze_loadmore_callback'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_xmoze_loadmore_callback', 'xmoze_loadmore_callback'); // wp_ajax_nopriv_{action}



function xmoze_start_modify_html() {
    ob_start();
 }
 function xmoze_end_modify_html() {
    $html = ob_get_clean();
    $html = str_replace( 'font-display:swap;', '', $html );
    echo $html;
 }
 add_action( 'wp_head', 'xmoze_start_modify_html' );
 add_action( 'wp_footer', 'xmoze_end_modify_html' );

//sakib

/**
 * Checking post type enablee or disabled
 */
function xmoze_check_cpt( $opt_id ){
    $xmoze = get_option( 'xmoze' );
    if( isset( $xmoze[$opt_id] ) ){
        if( true == $xmoze[$opt_id] ) {
            return true;
        }else{
            return false;
        }
    }else{
        return true;
    }
}


 /**
 * Meta shortcode content Output
 *
 * @since 1.0
 *
 * @return array
 */
if ( ! function_exists( 'xmoze_get_meta' ) ) {
    function xmoze_get_meta( $data ) {
        global $wp_embed;
        $content = $wp_embed->autoembed( $data );
        $content = $wp_embed->run_shortcode( $content );
        $content = do_shortcode( $content );
        $content = wpautop( $content );
        return $content;
    }
}

 /**
 * Check if contact form 7 is activated
 *
 * @return bool
 */
if ( ! function_exists( 'xmoze_is_cf7_activated' ) ) {
    function xmoze_is_cf7_activated() {
        return class_exists( 'WPCF7' );
    }
}


/**
 *
 * Implementing Feature in menu item
 *
 */
function xmoze_implement_menu_meta( $classes, $item ) {
    $class = get_field('hide_this_menu', $item) ? 'hide-label' : '';
    $class .= get_field('is_it_title', $item) ? 'megamenu-heading' : '';
    $class .= get_field('select_megamenu', $item) ? 'menu-item-has-children xmoze-megamenu-builder-parent xmoze-mega-menu' : '';
    $classes[] = $class;
    return $classes;
}
add_filter('nav_menu_css_class', 'xmoze_implement_menu_meta', 10, 2);


/**
 *  Menu items - Add "Custom sub-menu" in menu item render output
 *  if menu item has class "menu-item-target"
 */
function xmoze_megamenu_builder_integrations( $item_output, $item, $depth, $args ) {

    $selected_megamenu = get_field('select_megamenu', $item, true);
    if(!empty( $selected_megamenu ) ){
        if( ! array_key_exists('elementor-preview', $_GET)){
            $custom_sub_menu_html = "   <ul class='xmoze-megamenu-builder-content-wrap sub-menu'>
            <li>".xmoze_layout_content($selected_megamenu)."</li>
        </ul>";

            // Append after <a> element of the menu item targeted
            $item_output .= $custom_sub_menu_html;
        }
    }



    return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'xmoze_megamenu_builder_integrations', 10, 4 );


function xmoze_layout_content($post_id){

	return Elementor\Plugin::instance()->frontend->get_builder_content($post_id, true);
}

/**
 * Post orderby list
 */
function xmoze_get_post_orderby_options()
{
    $orderby = array(
        'ID' => 'Post ID',
        'author' => 'Post Author',
        'title' => 'Title',
        'date' => 'Date',
        'modified' => 'Last Modified Date',
        'parent' => 'Parent Id',
        'rand' => 'Random',
        'comment_count' => 'Comment Count',
        'menu_order' => 'Menu Order',
    );
    $orderby = apply_filters('xmoze_post_orderby', $orderby);
    return $orderby;
}

/**
 * Get Posts
 *
 * @since 1.0
 *
 * @return array
 */
if ( ! function_exists( 'xmoze_get_all_posts' ) ) {
    function xmoze_get_all_posts($posttype)
    {
        $args = array(
            'post_type' => $posttype,
            'post_status' => 'publish',
            'posts_per_page' => -1
        );

        $post_list = array();
        if( $data = get_posts($args)){
            foreach($data as $key){
                $post_list[$key->ID] = $key->post_title;
            }
        }
        return  $post_list;
    }
}


/**
 * Get Author list
 *
 * @since 1.0
 *
 * @return array
 */
// if ( ! function_exists( 'xmoze_get_authors' ) )
// {
//     function xmoze_get_authors()
//     {
//         $user_query = new \WP_User_Query(
//             [
//                 'who' => 'authors',
//                 'has_published_posts' => true,
//                 'fields' => [
//                     'ID',
//                     'display_name',
//                 ],
//             ]
//         );
//         $authors = [];
//         foreach ($user_query->get_results() as $result) {
//             $authors[$result->ID] = $result->display_name;
//         }
//         return $authors;
//     }
// }


if ( ! function_exists( 'xmoze_post_excerpt' ) ) :
/**
 * Display post post excerpt or content
 * *
 * @since 1.0
 */
function xmoze_post_excerpt($post_id, $length = 20) {

    $post_object = get_post( $post_id );

    $excerpt = $post_object->post_excerpt;
    $content = $post_object->post_content;

    if ( !empty($excerpt)  && strlen(trim($excerpt)) != 0) {
        echo '<p>' . wp_trim_words( $excerpt, (int)$length, '' ) . '</p>';
    } else {
        echo '<p>' . wp_trim_words( $content, (int)$length, '' ) . '</p>';
    }

}
endif;




/**
 * Create Custom Query Vars
 * https://codex.wordpress.org/Function_Reference/get_query_var#Custom_Query_Vars
 */
function xmoze_job_query_vars_filter($vars)
{
    // add custom query vars that will be public
    // https://codex.wordpress.org/WordPress_Query_Vars
    $vars[] .= 'search_key';
    $vars[] .= 'job_location';
    $vars[] .= 'job_type';
    return $vars;
}
add_filter('query_vars', 'xmoze_job_query_vars_filter');
/**
 * Override Movie Archive Query
 * https://codex.wordpress.org/Plugin_API/Action_Reference/pre_get_posts
 */
function xmoze_job_search_query($query)
{
    // only run this query if we're on the job archive page and not on the admin side
    if ($query->is_archive('job') && $query->is_main_query() && !is_admin()) {
        // get query vars from url.
        // https://codex.wordpress.org/Function_Reference/get_query_var#Examples
        $job_type       = get_query_var('job_type', FALSE);
        $job_location   = get_query_var('job_location', FALSE);
        $search_key     = get_query_var('search_key', FALSE);
        // used to conditionally build the tax_query
        // the tax_query is used for a custom taxonomy assigned to the post type
        // i'm using the `'relation' => 'OR'` to make the search more broad
        $tax_query_array = array('relation' => 'OR');
        // final tax_query
        $tax_query_array[] = $job_type ?  ['taxonomy' => 'job-type', 'field' => 'slug', 'terms' =>  esc_attr($job_type)]  : null;
        $tax_query_array[] = $job_location ?  ['taxonomy' => 'job-location', 'field' => 'slug', 'terms' => esc_attr($job_location)] : null;
        $query->set('tax_query', $tax_query_array);
        $query->set('s', esc_attr($search_key));
    }
}
add_action('pre_get_posts', 'xmoze_job_search_query');
























