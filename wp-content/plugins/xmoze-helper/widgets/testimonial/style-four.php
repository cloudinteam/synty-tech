<?php

use Elementor\Icons_Manager;
?>

<div class="xmoze--tn-single <?php echo esc_attr($testimonial_style); ?>">



    <div class="xmoze-tn-bottom-style-four">

        <div class="xmoze--tn-user-identity">
            <div class="xmoze--tn-top">
                <?php if (has_post_thumbnail()) : ?>
                    <div class="xmoze--t-thumb">
                        <?php the_post_thumbnail('medium') ?>
                    </div>
                <?php endif; ?>
            </div>
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
        </div>



        <div class="xmoze--tn--social-links">
            <?php if (function_exists('the_field')  && 'yes' == $settings['show_socail_links']) :
                $social_links = get_field('social_links');
            ?>
                <div class="social-icons">
                    <ul class="list-unstyled">
                        <?php foreach ($social_links as  $social_link) :  ?>
                            <li>
                                <a href="<?php echo esc_url($social_link['url']); ?>">
                                    <?php echo $social_link['icon'] ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

            <?php endif; ?>
        </div>
    </div>


    <div class="xmoze--tn-dis">
        <?php echo xmoze_get_meta($content); ?>
    </div>

    <?php if (function_exists('the_field')) :
         $ratting = get_field('review_rating'); ?>
        <div class="xmoze--tn-rating">
            <?php for ($i = 0; $i < $ratting; $i++) : ?>
                <?php Icons_Manager::render_icon($settings['icon'], ['aria-hidden' => 'true']) ?>
            <?php endfor; ?>
        </div>
    <?php endif; ?>
</div>