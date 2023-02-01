<?php 
use Elementor\Icons_Manager;
?>

<div class="xmoze--tn-single style-five style-seven ">

    <div class="xmoze--tn-dis">
        <?php echo xmoze_get_meta( $content );?>
    </div>
    
    <div class="xmoze-tn-bottom-style-five">
        <div class="xmoze--tn-top">
            <?php if(has_post_thumbnail() ): ?>
                <div class="xmoze--t-thumb">
                    <?php the_post_thumbnail( 'medium' ) ?>  
                </div>
            <?php endif; ?>
        </div>
        <div class="xmoze--tn-name-title">
            <h4 class="xmoze--tn-name">
                <?php the_title() ?>
            </h4>

            <?php if(function_exists('the_field') ):?>
                <span class="xmoze--tn-title">
                    <?php echo get_field('designation') ?>
                </span>
            <?php endif; ?>
        </div>
    </div>
    <div class="xmoze--tn-icon">
        <?php Icons_Manager::render_icon($settings['quate'], ['aria-hidden' => 'true']) ?>
    </div>

   
</div>