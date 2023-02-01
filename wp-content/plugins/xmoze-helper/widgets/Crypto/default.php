 <div class="xmoze-crypto-widget-item ">
    <?php if (has_post_thumbnail() && 'default' != $settings['crypto_item_style']) : ?>
            <div class="crypto-thumbnail-wrapper">
                <a href="<?php echo esc_url(  get_the_permalink(  )  )?>" class="crypto-thumbnail d-block">
                <?php the_post_thumbnail( 'full' ); ?>
                </a>
            </div>
        <?php else: ?>
            <?php if (!empty( get_post_meta( $idd, 'crypto_svg_icon', true ) ) ) : ?>
                <div class="crypto-thumbnail">
                    <div class="crypto-thumbnail">
                        <?php
                            $thumb_icon_id = get_post_meta($idd, 'crypto_svg_icon', true );
                            $thumb_icon_url = wp_get_attachment_image_url( $thumb_icon_id, 'full' );
                        ?>
                        <img src="<?php echo esc_url( $thumb_icon_url) ?>" alt="">

                    </div>
                </div>
            <?php endif; ?>
        <?php endif; ?>


        <div class="crypto-content-wrap">
            <div class="crypto-content">
                    <a href="<?php the_permalink(); ?>">
                        <h3 class="crypto-title"><?php the_title() ?></h3>

                        <?php if( $settings['show_title_icon'] == 'yes' ):  ?>
                            <span class="crypto-title-icon">
                                <?php \Elementor\Icons_Manager::render_icon( $settings['title_icon'], ['aria-hidden' => 'true'] ); ?></span>
                        <?php endif; ?>
                    </a>
                <?php
                    echo ('yes' == $settings['show_excerpt']) ? sprintf('<p> %s </p>', esc_html($excerpt)) : '';
                ?>
            </div>

        </div>
 </div>

