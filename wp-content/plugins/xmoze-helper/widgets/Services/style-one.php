<?php
     // from acf
     $txtvalue = get_field( 'text-number' );
     $subheading = get_field( 'sub-heading' );
?>
    <div class="xmoze-service-widget-item">
        <div class="content-service-wrap">
            <div class="txt-number-wrap">
                <h2 class="txt-number" ><?php echo esc_html( $txtvalue); ?></h2>
            </div>
            <div class="service-content">
               <span class="xmoze-service-heading d-block"><?php echo esc_html($subheading); ?></span>

               <div class="d-block">
               <h3 class="service-title"><a href="<?php echo esc_url( the_permalink()); ?>"><?php echo esc_html(  $title ); ?></a></h3>
               </div>


                <?php
                    echo ( 'yes' == $settings['show_excerpt'] ) ? sprintf( '<p> %s </p>', esc_html( $excerpt ) ) : '';
                ?>
            </div>
        </div>


    </div>
