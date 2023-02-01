<?php
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
// Exit if accessed directly
/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Xmoze_Service_Category extends \Elementor\Widget_Base {
    /**
     * Retrieve the widget name.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'xmoze-service-categories';
    }
    /**
     * Retrieve the widget title.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return __( 'Service Categories', 'xmoze-hp' );
    }
    /**
     * Retrieve the widget icon.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-image';
    }
    /**
     * Retrieve the list of categories the widget belongs to.
     *
     * Used to determine where to display the widget in the editor.
     *
     * Note that currently Elementor supports only one category.
     * When multiple categories passed, Elementor uses the first one.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories() {
        return ['xmoze-addons'];
    }
    /**
     * Register the widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function register_controls() {
        $this->start_controls_section(
            'section_layout',
            [
                'label' => __( 'General', 'xmoze-hp' ),
            ]
        );
        $this->add_control(
            'category_count',
            [
                'label'       => __( 'Category Limit', 'xmoze-hp' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => 6,
            ]
        );
        $this->add_control(
            'use_custom_height',
            [
                'label'        => __( 'Use custom height?', 'xmoze-hp' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'xmoze-hp' ),
                'label_off'    => __( 'No', 'xmoze-hp' ),
                'return_value' => 'yes',
                'default'      => 'no',
            ]
        );
        $this->add_responsive_control(
            'normal_image_height',
            [
                'label'      => __( 'Normal Image Height', 'xmoze-hp' ),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'devices'    => ['desktop', 'tablet', 'mobile'],
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}}  .xmoze-service-cat' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition'  => [
                    'use_custom_height' => 'yes',
                ],
            ]
        );
        $this->add_responsive_control(
            'align',
            [
                'label'     => __( 'Align', 'fd-addons' ),
                'type'      => \Elementor\Controls_Manager::CHOOSE,
                'options'   => [
                    'left'   => [
                        'title' => __( 'Left', 'fd-addons' ),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __( 'top', 'fd-addons' ),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'right'  => [
                        'title' => __( 'Right', 'fd-addons' ),
                        'icon'  => 'fa fa-align-right',
                    ],

                ],
                'devices'   => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} ' => 'text-align: {{VALUE}}',
                ],
                'toggle'    => true,
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'section_more_content',
            [
                'label' => __( 'More Text', 'xmoze-hp' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'enable_more_text',
            [
                'label'        => __( 'Show more text?', 'xmoze-hp' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'xmoze-hp' ),
                'label_off'    => __( 'No', 'xmoze-hp' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );
        $this->add_control(
            'more_title',
            [
                'label'       => __( 'Title', 'xmoze-hp' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => '+4 More',
                'condition'   => [
                    'enable_more_text' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'more_desc',
            [
                'label'       => __( 'Description', 'xmoze-hp' ),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default'     => '50 availabe vacancy',
                'condition'   => [
                    'enable_more_text' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'more_link',
            [
                'label'         => __( 'Link', 'xmoze-hp' ),
                'type'          => \Elementor\Controls_Manager::URL,
                'placeholder'   => __( 'https://your-link.com/services', 'xmoze-hp' ),
                'show_external' => true,
                'default'       => [
                    'url'         => '',
                    'is_external' => false,
                    'nofollow'    => false,
                ],
                'condition'     => [
                    'enable_more_text' => 'yes',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'      => 'more_background',
                'label'     => __( 'Background', 'xmoze-hp' ),
                'types'     => ['classic', 'gradient', 'video'],
                'selector'  => '{{WRAPPER}} .xmoze-service-cat.service-more-card',
                'condition' => [
                    'enable_more_text' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();
        $this->start_controls_section(
            'section_icon_style',
            [
                'label' => __( 'Icon', 'xmoze-hp' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label'     => __( 'Icon Color', 'xmoze-hp' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xmoze-service-cat .service-cat-icon' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'icon_background',
            [
                'label'     => __( 'Icon Background', 'xmoze-hp' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xmoze-service-cat .service-cat-icon' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'icon_size',
            [
                'label'      => __( 'Icon gap', 'xmoze-hp' ),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 400,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}}  .xmoze-service-cat .service-cat-icon' => 'margin-bottom:{{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'section_style',
            [
                'label' => __( 'Title', 'xmoze-hp' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'label'    => __( 'Title Typography', 'xmoze-hp' ),
                'name'     => 'title_typo',
                'selector' => '{{WRAPPER}} .xmoze-service-cat .service-cat-title h4',
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label'     => __( 'Title Color', 'xmoze-hp' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xmoze-service-cat .service-cat-title h4' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'title_gap',
            [
                'label'      => __( 'Title gap', 'xmoze-hp' ),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 400,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}}  .xmoze-service-cat .service-cat-title h4' => 'margin-bottom:{{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'section_subtitle',
            [
                'label' => __( 'Subtitle', 'xmoze-hp' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'label'    => __( 'Title Typography', 'xmoze-hp' ),
                'name'     => 'subtitle_typo',
                'selector' => '{{WRAPPER}} .xmoze-service-cat .service-cat-title .service-count',
            ]
        );
        $this->add_control(
            'subtitle_color',
            [
                'label'     => __( 'Color', 'xmoze-hp' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xmoze-service-cat .service-cat-title .service-count' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'subtitle_gap',
            [
                'label'      => __( 'Title gap', 'xmoze-hp' ),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 400,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}}  .xmoze-service-cat .service-cat-title ' => 'margin-bottom:{{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'section_more_style',
            [
                'label'     => __( 'More Text', 'xmoze-hp' ),
                'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'enable_more_text' => 'yes',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'label'    => __( 'Title Typography', 'xmoze-hp' ),
                'name'     => 'more_typo',
                'selector' => '{{WRAPPER}} .service-more-card .service-cat-title .service-count',
            ]
        );
        $this->add_control(
            'more_color',
            [
                'label'     => __( 'Color', 'xmoze-hp' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service-more-card .service-cat-title .service-count' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'label'     => __( 'Subtitle Typography', 'xmoze-hp' ),
                'name'      => 'more_subtitle_typo',
                'selector'  => '{{WRAPPER}} .service-more-card .service-cat-title .service-count',
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'more_subtitle_color',
            [
                'label'     => __( 'Subtitle Color', 'xmoze-hp' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service-more-card .service-cat-title .service-count' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'more_gap',
            [
                'label'      => __( 'Title gap', 'xmoze-hp' ),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 400,
                    ],
                ],
                'separator'  => 'before',
                'selectors'  => [
                    '{{WRAPPER}}  .service-more-card .service-cat-title ' => 'margin-bottom:{{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'more_padding',
            [
                'label'      => __( 'Box Padding', 'xmoze-hp' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .service-more-card ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_content_box_style',
            [
                'label' => __( 'Box', 'xmoze-hp' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs(
            'box_style_tabs'
        );

        $this->start_controls_tab(
            'box_style_normal_tab',
            [
                'label' => __( 'Normal', 'xmoze-hp' ),
            ]
        );

        $this->add_control(
            'box_bg_color',
            [
                'label'     => __( 'Box Backgroound Color', 'xmoze-hp' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xmoze-service-cat ' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'box_shadow',
                'label'    => __( 'Box Hover Shadow', 'xmoze-hp' ),
                'selector' => '{{WRAPPER}} .xmoze-service-cat ',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'box_border',
                'label'    => __( 'Box Border', '' ),
                'selector' => '{{WRAPPER}} .xmoze-service-cat ',
            ]
        );
        $this->add_responsive_control(
            'box_radius',
            [
                'label'      => __( 'Box Radius', 'xmoze-hp' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .xmoze-service-cat ' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'row_gap',
            [
                'label'      => __( 'Row Gap', 'xmoze-hp' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .xmoze-service-cat-wrap ' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'box_padding',
            [
                'label'      => __( 'Box Padding', 'xmoze-hp' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .xmoze-service-cat' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'box_style_hover_tab',
            [
                'label' => __( 'Hover', 'xmoze-hp' ),
            ]
        );

        $this->add_control(
            'box_hover_bg_color',
            [
                'label'     => __( 'Box Backgroound Color', 'xmoze-hp' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'defautl'   => '#233aff',
                'selectors' => [
                    '{{WRAPPER}} .xmoze-service-cat :hover:after' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'box_hover_radius',
            [
                'label'      => __( 'Box Radius', 'xmoze-hp' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .xmoze-service-cat:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'box_hover_shadow',
                'label'    => __( 'Box Hover Shadow', 'xmoze-hp' ),
                'selector' => '{{WRAPPER}} .xmoze-service-cat :hover',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'box_hover_border',
                'label'    => __( 'Box Border', '' ),
                'selector' => '{{WRAPPER}} .xmoze-service-cat:hover ',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }
    /**
     * Render the widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings();
        $target   = $settings['more_link']['is_external'] ? ' target="_blank"' : '';
        $nofollow = $settings['more_link']['nofollow'] ? ' rel="nofollow"' : '';

        $taxonomy     = 'service-category';
        $orderby      = 'date';
        $show_count   = 1;
        $pad_counts   = 0;
        $hierarchical = 0;
        $title        = '';
        $empty        = 1;
        $args         = array(
            'taxonomy'     => $taxonomy,
            'orderby'      => $orderby,
            'show_count'   => $show_count,
            'pad_counts'   => $pad_counts,
            'hierarchical' => $hierarchical,
            'title_li'     => $title,
            'hide_empty'   => $empty,
            'number'       => $settings['category_count'],
        );
        $all_categories = get_categories( $args );
        ?>
<div class="service-categories-wrap row">
    <?php
foreach ( $all_categories as $cat ) {
            $category_id      = $cat->term_id;
            $cat_icon         = get_term_meta( $category_id, 'category_icon', true );
            $icon_color       = get_term_meta( $category_id, 'icon_color', true );
            $background_color = get_term_meta( $category_id, 'background_color', true );

            $service_count_label = esc_html__( ' availabe vacancy', 'Item', 'xmoze-hp' );
            $list                = '';
            ?>
    <div class="col-lg-3 col-md-6 xmoze-service-cat-wrap">
        <a class="xmoze-service-cat" href="<?php echo get_term_link( $cat->slug, 'service-category' ) ?>">
            <div class="cat-icon-wrap">
                <div class="service-cat-icon"
                    style="<?php printf( 'color:%s; background-color: %s', esc_attr( $icon_color ), esc_attr( $background_color ) )?>">
                    <i class="<?php echo esc_attr( $cat_icon ); ?>"></i>
                </div>
            </div>
            <div class="service-cat-title">
                <h4><?php echo esc_html( $cat->name ) ?></h4>
                <span class="service-count"> <?php echo $cat->category_count ?>
                    <?php echo $service_count_label ?></span>
            </div>
        </a>
    </div>
    <?php
}?>
    <?php if ( 'yes' == $settings['enable_more_text'] ): ?>
    <div class="col-lg-3 col-md-6 xmoze-service-cat-wrap">
        <a class="xmoze-service-cat service-more-card" href="<?php echo esc_url( $settings['more_link']['url'] ) ?>"
            <?php echo esc_attr( $target . $nofollow ) ?>>

            <div class="service-cat-title">
                <h4><?php echo esc_html( $settings['more_title'] ) ?></h4>
                <span class="service-count"> <?php echo esc_html( $settings['more_desc'] ) ?></span>
                <span class="service-more-link-icon">
                    <i class="fas fa-angle-right"></i>
                </span>
            </div>
        </a>
    </div>
</div>
<?php
endif;
    }
}
$widgets_manager->register( new \Xmoze_Service_Category() );