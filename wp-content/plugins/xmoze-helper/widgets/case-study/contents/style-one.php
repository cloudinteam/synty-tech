<?php 
    $idd = get_the_ID();
    $thumb_icon_id = get_post_meta( $idd, 'cat_svg_icon', true );
    $thumb_icon_url = wp_get_attachment_image( $thumb_icon_id, 'full' );
    $image =  [
            'value' => [
            'url' => $thumb_icon_url,
            'id' => $thumb_icon_id,
        ],
        'library' => 'svg'
    ];

?>
<div  class="<?php printf('xmoze-case-study-item-wrap %s %s %s',$grid, $pf_cat_slug , $image_height); ?>">
    <div class="xmoze-case-study-item ">
        <div class="xmoze-case-study-image d-block">
            <a class="case-image" href="<?php the_permalink() ?>">
                <?php the_post_thumbnail() ?>
            </a>

            <div class="xmoze-case-study-content <?php echo esc_attr($settings['meta_postition']); ?>">
                <?php if('yes' == $settings['show_subheading']  ): ?>
                    <div class="xmoze-subheading">
                        <p><?php echo esc_html($sub_heading) ?></p>
                    </div>
                <?php endif; ?>
                <?php if ('yes' == $settings['show_title']): ?>
                    <div class="xmoze-case-study-title">
                        <?php the_title( '<h2><a href="'.esc_url(get_permalink()).'">','</a></h2>'); ?>
                    </div>
                <?php endif; ?>
                <?php if('yes' == $settings['show_date']  ): ?>
                <div class="advice-date">
                    <?php echo get_the_date(); ?>
                </div>
                <?php endif; ?>
                <?php if (!empty($pf_cat_name) && 'yes' == $settings['show_category'] ) { ?>
                        <a class="xmoze-cs-category" href="<?php the_permalink()?>">
                        <?php if ($thumb_icon_url) { ?>
                        <span class ="cat_icon" >
                            <?php  Elementor\Icons_Manager::render_icon($image, ['aria-hidden' => 'true']); ?>
                        </span>
                        <?php } ?>
                        <? echo esc_html(ltrim($pf_cat_name, ",")) ?></a>
                        <?
                    
                    }
                ?>
                <?php if('yes' == $settings['show_excerpt']  ): ?>
                <div class="studies_content">
                    <?php 
                       if(has_excerpt() ) {
                           the_excerpt();
                       }
                       else {
                           echo wp_trim_words( get_the_content() , 50,'...' );
                       }
                    ?>
                </div>
                <?php endif; ?>
            <?php if ( 'yes' == $settings['show_readmore'] ): ?>
            <div class="case-study-btn-wrap">
                <a class="case-study-btn <?php echo esc_attr( 'elementor-animation-' . $settings['btn_hover_animation'] ) ?>"
                    href="<?php the_permalink()?>">
                    <?php if ( 'before' == $settings['icon_position'] && !empty( $settings['icon']['value'] ) ): ?>
                    <span
                        class="icon-before btn-icon"><?php \Elementor\Icons_Manager::render_icon( $settings['icon'], ['aria-hidden' => 'true'] )?></span>
                    <?php endif;?>
                    <span class="case-readmore-text" ><?php echo esc_html( $settings['readmore_text'] ); ?></span>
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
</div>