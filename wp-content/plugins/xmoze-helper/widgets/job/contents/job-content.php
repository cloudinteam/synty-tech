<?php
if (!defined('ABSPATH')) {
    exit;
}

?>

<div class="row justify-content-center">

<?php
while ($the_query->have_posts()) : $the_query->the_post(); ?>
    <?php
    $idd = get_the_ID();
    $categories = get_the_terms($idd, 'job-category');

    $jf_cat_name = '';

    if (!empty($categories)) {
        $jf_cat_name = join(' ', wp_list_pluck($categories, 'name'));
        $jf_cat_slug = join(' ', wp_list_pluck($categories, 'slug'));
    }
    $grid = '';
    $grid = $column_class;
    
    ?>
      <?php if(function_exists('the_field')): ?>
        <?php 
          $job_icon     =  get_field('job_icon');
          $job_location =  get_field('job_location');
          $job_type     =  get_field('xmoze_job_type'); 
          $salary       =  get_field('salary');
          $button_text  =  get_field('button_text');
          $button_url   =  get_field('button_url');
          $show_date    =  get_field('job_date');
        ?>
      <?php endif; ?>
      
          <div class="<?php printf('xmoze-job-item-wrap %s %s' , $grid  , $jf_cat_slug ); ?>">
              <div class="jobs-area__tab">
                  <div id="post-<?php the_ID(); ?>" class="card card--single">
                   
                    <div class="jobs-top__content d-flex align-items-center">
                        <div class="job-top-left job-thumb job-thumb-<?php echo $settings['enable_icon_box']; ?>">
                            <?php if(function_exists('the_field') )
                              {
                                echo file_get_contents( $job_icon );
                              };
                            ?>		
                        </div>
                      <div class="title-location">
                        <h3 class="card__heading"> <a href="<?php the_permalink()?>"><?php the_title(); ?></a></h3>
                        <?php if(!empty( $job_location ) && function_exists('the_field') ): ?>
                          <span><?php \Elementor\Icons_Manager::render_icon( $settings['location_icon'], [ 'aria-hidden' => 'true' ] ); ?><?php echo esc_html($job_location)  ?></span>
                        <?php endif; ?>
                      </div>
                      
                    </div>
                    <div class="job-descriptions">
                      <?php 
                        if(has_excerpt()){
                          the_excerpt();
                        }else {
                            ?>
                              <p><?php echo wp_trim_words(get_the_content(), 16, '');?></p>
                            <?php
                          } 
                        ?>
                    </div>
                   
                    <div class="salary-range d-flex align-items-center flex-wrap">
                    <span class="salary-icon"><?php \Elementor\Icons_Manager::render_icon( $settings['currency_icon'], [ 'aria-hidden' => 'true' ] ); ?></span>
                     <h5 class="salary"> <?php if(!empty( $job_type ) && function_exists('the_field') ){
                          echo $salary;
                      } ?></h5>
                    </div>

                  <div class="xmoze-job-bottom d-flex align-items-center justify-content-between">
                  <?php if(!empty( $job_type ) && function_exists('the_field') ): ?>
                      <p>
                      <?php \Elementor\Icons_Manager::render_icon( $settings['job_icon'], [ 'aria-hidden' => 'true' ] ); ?><?php echo esc_html($job_type);  ?>
                      </p>
                      <?php endif; ?>
                    <a class="xmoze-job-btn" href="<?php the_permalink(); ?>"><?php echo $settings['button_text'] ?><?php \Elementor\Icons_Manager::render_icon( $settings['button_icon'], [ 'aria-hidden' => 'true' ] ); ?></a>
                  </div>
                </div>
            </div>
        </div>
  <?php
  endwhile;
  ?>
</div>
<?php 