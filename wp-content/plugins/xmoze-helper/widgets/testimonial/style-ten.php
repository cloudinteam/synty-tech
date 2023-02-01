<?php 
use Elementor\Icons_Manager;
?>

<div class="xmoze--tn-single style-ten">
        <div class="xmoze--tn-dis">
            <?php echo xmoze_get_meta( $content );?>
        </div>

        <div class="xmoze-tn-bottom-style-style-ten">
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

        <?php if(function_exists('the_field') ):    
                $ratting = get_field('review_rating');
            ?>
            <div class="xmoze--tn-icon">
                <?php for($i=0;$i<$ratting;$i++): ?>
                    <?php Icons_Manager::render_icon($settings['icon'], ['aria-hidden' => 'true']) ?>
                <?php endfor; ?>
            </div>
        <?php endif; ?>
   
</div>