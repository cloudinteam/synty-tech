<?php
namespace Mas_Addons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

if ( !defined( 'ABSPATH' ) ) {
    exit;
}
/**
 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Post_Navigation extends \Elementor\Widget_Base
{
    /**
     * Get widget name.
     *
     * Retrieve oEmbed widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name()
    {
        return 'mas-addons-post-navigation';
    }
    /**
     * Get widget title.
     *
     * Retrieve oEmbed widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title()
    {
        return __('Post Navigation', 'mas-addons');
    }
    /**
     * Get widget icon.
     *
     * Retrieve oEmbed widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon()
    {
        return 'eicon-post-navigation';
    }
    /**
     * Get widget categories.
     *
     * Retrieve the list of categories the oEmbed widget belongs to.
     *
     * @since 1.0.0
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories()
    {
        return ['mas-addons'];
    }
    /**
     * Register oEmbed widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function register_controls()
    {
        /**
         * Content tab
         */
        $this->start_controls_section(
            'post_navigation',
            [
                'label' => __('Post Navigation', 'mas-addons'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'prev_text',
            [
                'label' => __('Prev Text', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Previous Project', 'mas-addons'),
            ]
        );
        $this->add_control(
            'next_text',
            [
                'label' => __('Next Text', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Next Project', 'mas-addons'),
            ]
        );
        $this->add_control(
			'prev_icon',
			[
				'label' => __( 'Prev Icon', 'mas-addons' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-arrow-left',
					'library' => 'solid',
				],
			]
        );
        $this->add_control(
			'next_icon',
			[
				'label' => __( 'Next Icon', 'mas-addons' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-arrow-right',
					'library' => 'solid',
				],
			]
        );
        $this->end_controls_section();
        /**
         * Style tab
         */
        $this->start_controls_section(
            'general',
            [
                'label' => __('Style', 'mas-addons'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'label_typo',
                'label' => __('Prev Next Text Typography', 'mas-addons'),
                'selector' => '{{WRAPPER}} .mas-addons-addon-post-navigation .nav-label',
            ]
        );
        $this->start_controls_tabs(
            'nav_style_tabs'
        );
        $this->start_controls_tab(
            'nav_style_normal_tab',
            [
                'label' => __('Normal', 'mas-addons'),
            ]
        );
        $this->add_control(
            'label_color',
            [
                'label' => __('label Color', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mas-addons-addon-post-navigation .nav-label' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'icon_color',
            [
                'label' => __('Icon', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mas-addons-addon-post-navigation .nav-links a svg path' => 'stroke: {{VALUE}}',
                    '{{WRAPPER}} .mas-addons-addon-post-navigation .nav-links a i' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'svg_fill_color',
            [
                'label' => __('Icon Fill Color', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mas-addons-addon-post-navigation .nav-links a svg path' => 'fill: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'nav_background',
            [
                'label' => __('Background Color', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mas-addons-addon-post-navigation .nav-links a' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'nav_border',
                'label' => __('Border', 'mas-addons'),
                'selector' => '{{WRAPPER}} .nav-links a',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'nav_shadow',
                'label' => __('Button Shadow', 'mas-addons'),
                'selector' => '{{WRAPPER}} .nav-links a',
            ]
        );
        $this->add_responsive_control(
            'nav_radius',
            [
                'label' => __('Border Radius', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    'body:not(.rtl) {{WRAPPER}} .nav-links a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .nav-links a' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
			'icon_gap',
			[
				'label' => __( 'Icon gap', 'mas-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'body:not(.rtl) {{WRAPPER}} .mas-addons-addon-post-navigation .nav-previous i, body:not(.rtl) {{WRAPPER}} .mas-addons-addon-post-navigation .nav-previous svg ' => 'margin-right: {{SIZE}}{{UNIT}};',
					'body:not(.rtl) {{WRAPPER}} .mas-addons-addon-post-navigation .nav-next i,body:not(.rtl) {{WRAPPER}} .mas-addons-addon-post-navigation .nav-next svg ' => 'margin-left: {{SIZE}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .mas-addons-addon-post-navigation .nav-previous i, body.rtl{{WRAPPER}} .mas-addons-addon-post-navigation .nav-previous svg ' => 'margin-left: {{SIZE}}{{UNIT}};',
					'body.rtl {{WRAPPER}} .mas-addons-addon-post-navigation .nav-next i, body.rtl{{WRAPPER}} .mas-addons-addon-post-navigation .nav-next svg ' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->end_controls_tab();
        $this->start_controls_tab(
            'nav_style_hover_tab',
            [
                'label' => __('Hover', 'mas-addons'),
            ]
        );
        $this->add_control(
            'label_color_hover',
            [
                'label' => __('label Color', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mas-addons-addon-post-navigation a:hover .nav-label' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'icon_color_hover',
            [
                'label' => __('Icon', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mas-addons-addon-post-navigation .nav-links a:hover svg path' => 'stroke: {{VALUE}}',
                    '{{WRAPPER}} .mas-addons-addon-post-navigation .nav-links a:hover i' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'svg_fill_color_hover',
            [
                'label' => __('Icon Fill Color', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mas-addons-addon-post-navigation .nav-links a:hover svg path' => 'fill: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'nav_background_hover',
            [
                'label' => __('Background Color', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mas-addons-addon-post-navigation .nav-links a:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'nav_hover_border',
                'label' => __('Border', 'mas-addons'),
                'selector' => '{{WRAPPER}} .nav-links a:hover',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'nav_hover_shadow',
                'label' => __('Button Shadow', 'mas-addons'),
                'selector' => '{{WRAPPER}} .nav-links a:hover',
            ]
        );
        $this->add_responsive_control(
            'nav_hover_radius',
            [
                'label' => __('Border Radius', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    'body:not(.rtl) {{WRAPPER}} .nav-links a:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .nav-links a:hover' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'icon_hover_gap',
            [
                'label' => __('Icon gap', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    'body:not(.rtl) {{WRAPPER}} .nav-links a:hover .icon-before, body.rtl {{WRAPPER}} .nav-links a:hover .icon-after' => 'transform: translatex( -{{SIZE}}{{UNIT}} );',
                    'body:not(.rtl) {{WRAPPER}} .nav-links a:hover .icon-after,  body.rtl {{WRAPPER}} .nav-links a:hover .icon-before' => 'transform: translatex( {{SIZE}}{{UNIT}} );',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->add_control(
            'nav_style_divider',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );
        $this->add_control(
			'icon_size',
			[
				'label' => __( 'Icon Size', 'mas-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .mas-addons-addon-post-navigation svg' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .mas-addons-addon-post-navigation i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
        );
        $this->add_responsive_control(
            'nav_padding',
            [
                'label' => __('Nav Padding', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    'body:not(.rtl) {{WRAPPER}} .nav-links a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .nav-links a' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
    }
    /**
     * Render oEmbed widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render()
    {
        $popular_post_key = array();
        $popular_meta_value_num = array();
        $settings = $this->get_settings_for_display();
        ob_start();
        \Elementor\Icons_Manager::render_icon( $settings['prev_icon'], [ 'aria-hidden' => 'true' ] );
        $prev_icon = ob_get_clean();
        ob_start();
        \Elementor\Icons_Manager::render_icon( $settings['next_icon'], [ 'aria-hidden' => 'true' ] );
        $next_icon = ob_get_clean();
?>
        <div class="mas-addons-addon-post-navigation">
            <?php 
            		the_post_navigation(
                        array(
                            'prev_text' => '<span class="nav-icon"> '. $prev_icon .' </span> <span class="nav-label">'.$settings['prev_text'].'</span> ',
                            'next_text' => '<span class="nav-label">'.$settings['next_text'].'</span> <span class="nav-icon"> '. $next_icon  .'  </span>',
                        )
                    );
            ?>
        </div>
<?php
    }
}


$widgets_manager->register( new \Mas_Addons\Widgets\Post_Navigation() );