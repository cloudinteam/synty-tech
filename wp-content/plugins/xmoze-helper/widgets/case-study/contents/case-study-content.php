<?php
if (!defined('ABSPATH')) {
    exit;
}
while ($the_query->have_posts()) : $the_query->the_post(); ?>
<?php
    $idd = get_the_ID();
    $categories = get_the_terms($idd, 'case-study-category');
    $grid = '';
    $image_height = ' height-' . get_post_meta($idd, 'image_height', true);
    $pf_cat_slug = '';
    $pf_cat_name = '';

    if (!empty($categories)) {
        $pf_cat_name = join(' ', wp_list_pluck($categories, 'name'));
        $pf_cat_slug = join(' ', wp_list_pluck($categories, 'slug'));
    }
    
    if($active_slider == 'slider') {
        $grid = '';

      
    }elseif ('yes' == $settings['use_meta_grid']) {
        $grid =  'col-md-' . get_post_meta($idd, 'image_width', true);
    } else {
        $grid = $column_class;
    }
    $case_style = $settings['case_style'];
    
    
    ?>
     <?php if(function_exists('the_field')): ?>
        <?php 
          $sub_heading =  get_field('sub-heading');
        ?>
      <?php endif; ?>

        <!-- Murkup Lode -->
      <?php if ($case_style) {
        include($case_style . '.php');
      } ?>

<!-- #post-<?php the_ID(); ?> -->
<?php
endwhile;
?>