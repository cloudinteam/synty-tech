<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;
/**
 * Shade heading widget.
 *
 * Shade widget that displays an eye-catching headlines.
 *
 * @since 1.0.0
 */
class Xmoze_Portfolio_Meta extends Widget_Base {
    /**
     * Get widget name.
     *
     * Retrieve heading widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'xmoze-single-pf-meta';
    }
    /**
     * Get widget title.
     *
     * Retrieve heading widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return __('Portfolio Meta', 'xmoze-hp');
    }
    /**
     * Get widget icon.
     *
     * Retrieve heading widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-t-letter';
    }
    /**
     * Get widget categories.
     *
     * Retrieve the list of categories the heading widget belongs to.
     *
     * Used to determine where to display the widget in the editor.
     *
     * @since 2.0.0
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories() {
        return ['xmoze-addons'];
    }
    /**
     * Get widget keywords.
     *
     * Retrieve the list of keywords the widget belongs to.
     *
     * @since 2.1.0
     * @access public
     *
     * @return array Widget keywords.
     */
    public function get_keywords() {
        return ['meta', 'work', 'single', 'portfolio'];
    }
    /**
     * Register heading widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function register_controls() {
        $this->start_controls_section(
            'section_content',
            [
                'label' => __('Content', 'xmoze-hp'),
            ]
        );

        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'label',
            [
                'label'       => __('Label', 'xmoze-hp'),
                'type'        => Controls_Manager::TEXTAREA,
                'dynamic'     => [
                    'active' => true,
                ],
                'placeholder' => __('Enter your title', 'xmoze-hp'),
                'default'     => __('Category Here', 'xmoze-hp'),
            ]
        );
        $repeater->add_control(
            'get_meta',
            [
                'label'   => __('Select Meta', 'xmoze-hp'),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'category'       => 'Category',
                    'client_name'    => 'Client Name',
                    'project_name'   => 'Project Name',
                    'finishing_date' => 'Finishing Date',
                    'duration'       => 'Duration',
                    'project_url'       => 'Project URL',
                ],
                'default' => 'category',
            ]
        );
        $this->add_control(
            'pf_meta_list',
            [
                'label'       => __('Meta List', 'xmoze-hp'),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{{ label }}}',
            ]
        );
       
        $this->end_controls_section();

        $this->start_controls_section(
            'list_meta',
            [
                'label' => __('List', 'xmoze-hp'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'      => 'list_border',
                'selector'  => '{{WRAPPER}} ul.pf-meta li',
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'list_shadow',
                'label' => __('Shadow', 'fd-addons'),
                'selector' => '{{WRAPPER}} ul.pf-meta li',
            ]
        );

        $this->add_control(
            'list_border_radius',
            [
                'label'      => __('Border radius', 'xmoze-hp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} ul.pf-meta li' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} ul.pf-meta li' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'list_padding',
            [
                'label'      => __('padding', 'xmoze-hp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} ul.pf-meta li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} ul.pf-meta li' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'list_margin',
            [
                'label'      => __('margin', 'xmoze-hp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} ul.pf-meta li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} ul.pf-meta li' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'section_content_lavel_style',
            [
                'label' => __('Meta Label', 'xmoze-hp'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'label_color',
            [
                'label'     => __('Label Color', 'xmoze-hp'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pf-meta-label' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'label_typography',
                'label'    => __('Label Typography', 'xmoze-hp'),
                'selector' => '{{WRAPPER}} .pf-meta-label',
            ]
        );
        $this->add_control(
            'label_margin',
            [
                'label'      => __('Margin', 'xmoze-hp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .pf-meta-label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .pf-meta-label' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'section_content_style',
            [
                'label' => __('Meta Content', 'xmoze-hp'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'meta_color',
            [
                'label'     => __('Meta Color', 'xmoze-hp'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pf-meta-value' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'meta_typography',
                'label'    => __('Meta Typography', 'xmoze-hp'),
                'selector' => '{{WRAPPER}} .pf-meta-value',
            ]
        );
        $this->add_control(
            'gap',
            [
                'label'      => __('List Gap', 'xmoze-hp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .pf-meta-value' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .pf-meta-value' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->end_controls_section();

        $this->start_controls_section(
            'box_content_style',
            [
                'label' => __('Box', 'xmoze-hp'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'content_shadow',
                'label' => __('Shadow', 'fd-addons'),
                'selector' => '{{WRAPPER}} .xmoze-single-pf-meta-widget',
            ]
        );
        $this->add_responsive_control(
            'align',
            [
                'label'     => __('Alignment', 'xmoze-hp'),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'left'    => [
                        'title' => __('Left', 'xmoze-hp'),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center'  => [
                        'title' => __('Center', 'xmoze-hp'),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right'   => [
                        'title' => __('Right', 'xmoze-hp'),
                        'icon'  => 'eicon-text-align-right',
                    ],
                    'justify' => [
                        'title' => __('Justified', 'xmoze-hp'),
                        'icon'  => 'eicon-text-align-justify',
                    ],
                ],
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .xmoze-single-pf-meta-widget' => 'text-align: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'box_gap',
            [
                'label'      => __('Padding', 'xmoze-hp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .xmoze-single-pf-meta-widget' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .xmoze-single-pf-meta-widget' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->end_controls_section();
    }
    /**
     * Render heading widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings_for_display();
        global $post;
        $idd = get_the_ID();

        $categories = get_the_terms(get_the_ID(), 'portfolio-category');
        if (!empty($categories)) {
            $pf_cat_name = join(' ', wp_list_pluck($categories, 'name'));
        }
        ?>


        <div class="xmoze-single-pf-meta-widget">
          <ul class="pf-meta ">
			  <?php
            foreach ($settings['pf_meta_list'] as $selected_meta):
            if ('category' == $selected_meta['get_meta']) {
                $meta = (!empty($pf_cat_name)) ? $pf_cat_name : '';
            } else {
                $meta = get_field($selected_meta['get_meta'], $idd);
            
            }
            if (!empty($meta)) {
                printf('<li><span class="pf-meta-label">%2$s</span> <span class="pf-meta-value">%1$s</span></li>', $meta, $selected_meta['label']);
            }
            ?>
			<?php endforeach; wp_reset_postdata();?>
		  </ul>
        </div>
        <?php
    }
}
$widgets_manager->register(new \Xmoze_Portfolio_Meta());