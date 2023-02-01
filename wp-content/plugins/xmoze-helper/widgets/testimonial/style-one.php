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
    <?php endif; ?>

    <div class="xmoze--tn-dis">
        <?php echo xmoze_get_meta($content);?>
    </div>

    <div class="xmoze--tn-top">
        <div class="xmoze--tn-name-title">
            <h4 class="xmoze--tn-name">
                <?php the_title() ?>
            </h4>
        </div>
    </div>
    <!-- style four -->

</div>