<?php 
use Elementor\Icons_Manager;
?>
    <div class="xmoze--tn-single d-flex align-items-center flex-wrap flex-xl-nowrap">
        <div class="xmoze--t-thumb">
            <?php the_post_thumbnail( 'full' ) ?>  
        </div>
        <div class="content-box">
          <div class="xmoze--tn-dis">
              <?php echo xmoze_get_meta( $content );?>
          </div>

          <div class="testimonial-bottom style-three">
              <div class="xmoze--tn-name-title mb-0">
                  <h4 class="xmoze--tn-name">
                      <?php the_title() ?>
                  </h4>

                  <?php if(function_exists('the_field') ):?>
                      <span class="xmoze--tn-title">
                          <?php echo get_field('designation') ?>
                      </span>
                  <?php endif; ?>
              </div>
          
              <?php if(function_exists('the_field') ):    
                      $ratting = get_field('review_rating');
                  ?>
                  <div class="xmoze--tn-rating">
                      <?php for($i=0;$i<$ratting;$i++): ?>
                          <?php Icons_Manager::render_icon($settings['icon'], ['aria-hidden' => 'true']) ?>
                      <?php endfor; ?>
                  </div>
              <?php endif; ?>
          </div>
          
      </div>
      
    </div>