<?php
if (!defined('ABSPATH')) {
  exit; // Exit if accessed directly.
}
class Xmoze_Recent_Posts_Widget extends WP_Widget
{
  /**
   * To create the example widget all four methods will be
   * nested inside this single instance of the WP_Widget class.
   **/

  public function __construct()
  {
    $widget_options = array(
      'classname' => 'xmoze_recent_posts_Widget',
      'description' => 'This widget will show latest post with thumbnail.',
    );
    parent::__construct('xmoze_recent_posts_Widget', 'Xmoze Recent Posts', $widget_options);
  }


  public function widget($args, $instance)
  {
    $title = apply_filters('widget_title', $instance['title']);
    $show_post_date = apply_filters('widget_show_post_date', $instance['show_post_date']);
    $ppp = (!empty($instance['ppp']) ? $instance['ppp'] : -1);

    echo $args['before_widget'] . $args['before_title'] . esc_html($title) . $args['after_title'];

    $query_args = array(
      'post_type' => 'post',
      'posts_per_page' => $ppp,
    );

    $query = new WP_Query($query_args);

    if ($query->have_posts()) {

      while ($query->have_posts()) {
        $query->the_post(); ?>

        <div class="post-item clearfix">
          <div class="post-thumb">
            <?php
            $thumb_id = get_post_thumbnail_id(get_the_ID());
            $img = wp_get_attachment_image_src($thumb_id, 'xmoze-blog-widget-thumb');

            if (has_post_thumbnail()) :
              printf('<a href="%s"><img src="%s" alt="%s" /></a>', get_the_permalink(), $img[0], esc_attr(get_the_title()));
            else :
              printf('<a href="%s"><img src="%s" class="rounded-default" alt="%s" /></a>', get_the_permalink(), '//via.placeholder.com/70x70.png', esc_attr(get_the_title()));
            endif;
            ?>
          </div>
          <p class="post-text">
            <a class="post-title" href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a>
            <?php if ($show_post_date) : ?>
              <span class="post-date"><?php echo get_the_date(); ?></span>
            <?php endif; ?>
          </p>
        </div>

    <?php

      }
      wp_reset_postdata();
    }

    echo $args['after_widget'];
  }

  public function form($instance)
  {
    $title = !empty($instance['title']) ? $instance['title'] : '';
    $show_post_date = !empty($instance['show_post_date']) ? $instance['show_post_date'] : '';
    $ppp = !empty($instance['$ppp']) ? $instance['$ppp'] : 5;

    ?>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'xmoze'); ?></label>
      <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" value="<?php echo esc_attr($title); ?>" />
    </p>

    <p>
      <label for="<?php echo esc_attr($this->get_field_id('show_post_date')); ?>"><?php esc_html_e('Display Post Date?', 'xmoze'); ?></label>
      <input type="checkbox" id="<?php echo esc_attr($this->get_field_id('show_post_date')) ?>" name="<?php echo esc_attr($this->get_field_name('show_post_date')) ?>" <?php if ($show_post_date == 'on') { echo ' checked'; } ?>>
    </p>

    <p>
      <label for="<?php echo esc_attr($this->get_field_id('ppp')); ?>"><?php esc_html_e('Post per page:', 'xmoze'); ?></label>
      <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('ppp')); ?>" name="<?php echo esc_attr($this->get_field_name('ppp')); ?>" value="<?php echo esc_attr($ppp); ?>" />
    </p>

<?php
  }
  public function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
    $instance['title'] = strip_tags($new_instance['title']);
    $instance['ppp'] = strip_tags($new_instance['ppp']);
    $instance['show_post_date'] = strip_tags($new_instance['show_post_date']);
    return $instance;
  }
}





function xmoze_plugin_widget_reg()
{
  register_widget('Xmoze_Recent_Posts_Widget');
}
add_action('widgets_init', 'xmoze_plugin_widget_reg');

?>