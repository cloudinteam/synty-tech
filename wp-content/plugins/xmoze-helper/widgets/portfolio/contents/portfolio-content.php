<?php
if (!defined('ABSPATH')) {
    exit;
}
while ($the_query->have_posts()) : $the_query->the_post(); ?>
    <?php
    $idd = get_the_ID();
    $categories = get_the_terms($idd, 'portfolio-category');
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
    ?>


    <div id="post-<?php the_ID(); ?>" class="<?php printf('xmoze-portfolio-item-wrap %s %s %s' , $grid  , $pf_cat_slug , $image_height); ?>">
        <div class="xmoze-portfolio-item ">
            <a href="<?php echo get_the_permalink() ?>" class="xmoze-portfolio-image d-block <?php echo esc_attr( 'elementor-animation-'.$settings['image_hover_animation'] ) ?>">
                <?php the_post_thumbnail() ?>
            </a>
            <div class="xmoze-portfolio-content content-postion-on-image">

            <div class="pt-title  d-flex align-items-center flex-wrap">

                <?php if( 'yes' == $settings['show_title']): ?>
                    <a class="xmoze-portfolio-title" href="<?php the_permalink() ?>">
                        <h3>
                            <?php echo get_the_title() ?>
                        </h3>
                        <div class="links-icons">
                            <?php if( 'yes' == $settings['show_title_icon'] && $settings['title_icon'] ): ?>
                                <a href="<?php the_permalink(); ?>" class="title-icon">
                                    <?php  Elementor\Icons_Manager::render_icon($settings['title_icon'], ['aria-hidden' => 'true']); ?>
                                </a>
                            <?php endif; ?>

                            <?php if( 'yes' == $settings['show_popup_icon'] && $settings['popup_icon'] ): ?>
                                <a class="popup-icon" href="<?php the_post_thumbnail_url('full'); ?>" >
                                    <?php  Elementor\Icons_Manager::render_icon($settings['popup_icon'], ['aria-hidden' => 'true']); ?>
                                </a>
                            <?php endif; ?>
                        </div>  
                    </a>
                <?php endif; ?>
              </div>
                <?php
                if (!empty($pf_cat_name) && 'yes' == $settings['show_category'] ) {
                    echo '<span class="xmoze-pf-category">' . esc_html(ltrim($pf_cat_name, ",")) . '</span>';
                }
                ?>
                      

                <?php if ( 'yes' == $settings['show_readmore'] ): ?>
                <div class="portfolio-btn-wrap">
                    <a class="portfolio-btn <?php echo esc_attr( 'elementor-animation-' . $settings['btn_hover_animation'] ) ?>"
                        href="<?php the_permalink()?>">
                        <?php if ( 'before' == $settings['icon_position'] && !empty( $settings['icon']['value'] ) ): ?>
                        <span
                            class="icon-before btn-icon"><?php \Elementor\Icons_Manager::render_icon( $settings['icon'], ['aria-hidden' => 'true'] )?></span>
                        <?php endif;?>
                        <?php echo esc_html( $settings['readmore_text'] ); ?>
                        <?php if ( 'after' == $settings['icon_position'] && !empty( $settings['icon']['value'] ) ): ?>
                        <span
                            class="icon-after btn-icon"><?php \Elementor\Icons_Manager::render_icon( $settings['icon'], ['aria-hidden' => 'true'] )?></span>
                        <?php endif;?>
                    </a>
                </div>
                <?php endif;?>
            </div>
        </div>
    </div>
<!-- #post-<?php the_ID(); ?> -->
<?php
endwhile;
?>