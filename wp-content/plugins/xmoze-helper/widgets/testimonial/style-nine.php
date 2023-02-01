<?php 
use Elementor\Icons_Manager;
?>

<div class="xmoze--tn-single <?php echo esc_attr( $testimonial_style ); ?>">

<?php if(function_exists('the_field') ):    
            $ratting = get_field('review_rating');
           
        ?>
        <div class="xmoze--tn-icon">
            <?php for($i=0;$i<5;$i++): 
                	$class = '';
                ?>
                <?php if ($ratting > $i) {
                    $class = "active_color";
                } ?>
                <span class="inactive_color" ><?php Icons_Manager::render_icon($settings['icon'], [ 'class' => $class,'aria-hidden' => 'true']) ?></span>
            <?php endfor; ?>
        </div>



        <?php 
            $ts_heading = get_field('ts_heading'); 
            $ts_show_heading = $settings['show_heading'];

        ?>

        <?php if($ts_heading && 'yes' == $ts_show_heading): ?>

            <div class="xmoze-ts-heading">
                <h4><?php echo esc_html($ts_heading); ?></h4>
            </div>
        <?php endif; ?>


    <?php endif; ?>





    <div class="xmoze--tn-dis">
        <?php echo xmoze_get_meta( $content );?>
    </div>

    <div class="xmoze-tn-bottom-style-nine">
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
    
  

  
</div>