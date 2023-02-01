    <?php

    use Elementor\Icons_Manager;
    ?>

    <div class="xmoze--tn-single xmoze-tn-bottom-style-five <?php echo esc_attr($testimonial_style); ?>">

        <div class="xmoze--tn-top">
            <?php if (has_post_thumbnail()) : ?>
                <div class="xmoze--t-thumb">
                    <?php the_post_thumbnail('medium') ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="xmoze--tn-right">

            <div class="xmoze--tn-dis">
                <?php echo xmoze_get_meta($content); ?>
            </div>

            <div class="d-flex justify-content-between align-items-end">
                <div class="xmoze--tn-name-title">
                    <h4 class="xmoze--tn-name">
                        <?php the_title() ?>
                    </h4>

                    <?php if (function_exists('the_field')) : ?>
                        <span class="xmoze--tn-title">
                            <?php echo get_field('designation') ?>
                        </span>
                    <?php endif; ?>
                </div>

                <?php if (function_exists('the_field')) :
                    $ratting = get_field('review_rating');
                ?>
                    <div class="xmoze--tn-rating">
                        <?php for ($i = 0; $i < 5; $i++) :
                            $class = '';
                        ?>
                            <?php if ($ratting > $i) {
                                $class = "active_color";
                            } ?>
                            <span class="inactive_color"><?php Icons_Manager::render_icon($settings['icon'], ['class' => $class, 'aria-hidden' => 'true']) ?></span>
                        <?php endfor; ?>
                    </div>
                <?php endif; ?>
            </div>

        </div>

    </div>