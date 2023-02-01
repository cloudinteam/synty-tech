<div <?php echo $this->get_render_attribute_string('team_gride_classes'); ?>>
    <a href="<?php the_permalink(); ?>" class="single-item">
        <div class="team-wrapper">
        
        <?php if(has_post_thumbnail() ): ?>
            <div class="team-image">
                <?php the_post_thumbnail('full');?>

                <?php if (function_exists('the_field') ): 
                    $social_links = get_field('social_links');
                    ?> 
                    <div class="social-icons">
                        <ul class="list-unstyled">
                            <?php foreach( $social_links as  $social_link):  ?>
                            <li>
                                <a href="<?php echo esc_url($social_link['url']); ?>">
                                <?php echo $social_link['icon'] ?>
                                </a>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif;?>
            </div>
        <?php endif; ?>
        
        <div class="user-identity">
            <h6><?php the_title();?></h6>
            <?php if (function_exists('the_field')): ?>
                <span><?php the_field('position')?></span>
            <?php endif;?>
        </div>
        </div>
    </a>
</div>