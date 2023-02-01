 <div class="xmoze-service-widget-item ">


 <?php if (has_post_thumbnail() && 'default' != $settings['service_item_style']) : ?>
        <div class="service-thumbnail-wrapper">
            <a href="<?php echo esc_url(  get_the_permalink(  )  )?>" class="service-thumbnail d-block">
              <?php the_post_thumbnail( 'full' ); ?>
            </a>
        </div>
    <?php else: ?>
        <?php if (!empty( get_post_meta( $idd, 'service_svg_icon', true ) ) ) : ?>
            <div class="service-thumbnail">
                <div class="service-thumbnail">
                    <?php
                        $thumb_icon_id = get_post_meta($idd, 'service_svg_icon', true );
                        $thumb_icon_url = wp_get_attachment_image_url( $thumb_icon_id, 'full' );
                    ?>
                    <img src="<?php echo esc_url( $thumb_icon_url) ?>" alt="">

                </div>
            </div>
        <?php endif; ?>
    <?php endif; ?>


     <div class="service-content-wrap">
         <div class="service-content">
                 <a href="<?php the_permalink(); ?>">
                     <h3 class="service-title"><?php the_title() ?></h3>

                     <?php if( $settings['show_title_icon'] == 'yes' ):  ?>
                        <span class="service-title-icon">
                            <?php \Elementor\Icons_Manager::render_icon( $settings['title_icon'], ['aria-hidden' => 'true'] ); ?></span>
                     <?php endif; ?>
                </a>
             <?php
                echo ('yes' == $settings['show_excerpt']) ? sprintf('<p> %s </p>', esc_html($excerpt)) : '';
            ?>
         </div>
     </div>

     <?php if ('yes' == $settings['show_readmore']): ?>
        <div class="service-btn-wrap">
            <a class="service-btn" href="<?php the_permalink() ?>">
                <?php if ('before' == $settings['icon_position'] && !empty($settings['icon']['value'])) : ?>
                    <span class="icon-before btn-icon"><?php \Elementor\Icons_Manager::render_icon($settings['icon'], ['aria-hidden' => 'true']) ?></span>
                <?php endif; ?>
                <?php echo esc_html($settings['readmore_text']); ?>
                <?php if ('after' == $settings['icon_position'] && !empty($settings['icon']['value'])) : ?>
                    <span class="icon-after btn-icon"><?php \Elementor\Icons_Manager::render_icon($settings['icon'], ['aria-hidden' => 'true']) ?></span>
                <?php endif; ?>
            </a>
        </div>
    <?php endif; ?>

 </div>

