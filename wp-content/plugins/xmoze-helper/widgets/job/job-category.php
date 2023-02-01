<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Icons_Manager;
/**
 * heading widget.
 *
 * widget that displays an eye-catching headlines.
 *
 * @since 1.0.0
 */
class Xmoze_Job_Category extends Widget_Base {
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
        return 'xmoze-category';
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
        return __('Xmoze Job Category', 'xmoze-hp');
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
        return ['meta', 'job', 'category'];
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

        $this->add_control(
            'category_count',
            [
                'label'       => __('Category Limit', 'xmoze-hp'),
                'type'        => Controls_Manager::NUMBER,
                'default'     => '',
                'description' => 'user emty value show all posts',
                'default' => 6,
            ]
        );
        $this->add_responsive_control('per_line', [
            'label'              => __('Columns per row', 'xmoze-hp'),
            'type'               => Controls_Manager::SELECT,
            'default'            => '3',
            'tablet_default'     => '4',
            'mobile_default'     => '12',
            'options'            => [
                '12' => '1',
                '6'  => '2',
                '4'  => '3',
                '3'  => '4',
            ],
            'frontend_available' => true,
        ]);
        $this->end_controls_section();


        /*
        *Image
        */
        $this->start_controls_section('box_iamge',
            [
                'label' => __('Icon', 'xmoze-hp'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

		$this->add_control(
			'icon-position',
			[
				'label' => __( 'Icon Position', 'elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'default' => 'top',
				'options' => [
					'left' => [
						'title' => __( 'Left', 'elementor' ),
						'icon' => 'eicon-h-align-left',
					],
					'top' => [
						'title' => __( 'Top', 'elementor' ),
						'icon' => 'eicon-v-align-top',
					],
					'right' => [
						'title' => __( 'Right', 'elementor' ),
						'icon' => 'eicon-h-align-right',
					],
					'bottom' => [
						'title' => __( 'Bottom', 'elementor' ),
						'icon' => 'eicon-v-align-bottom',
					],
				],
			]
		);
        $this->add_control(
			'enable_icon_box',
			[
				'label' => __('Enable Icon Box', 'fd-addons'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __('Show', 'fd-addons'),
				'label_off' => __('Hide', 'fd-addons'),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
        $this->add_responsive_control(
			'icon_size',
			[
				'label' => __('Icon Size', 'fd-addons'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'devices' => ['desktop', 'tablet', 'mobile'],
				'desktop_default' => [
					'size' => '',
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}}  .xmoze-cat-icon svg' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}  .xmoze-cat-icon img' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'enable_icon_box' => 'yes',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'icon_background_gradient',
				'types'     => [ 'classic', 'gradient' ],
				'fields_options'  => [
					'background'  => [
						'default' => 'classic'
					],
					'color'       => [
						'default' => '#ffffff'
					]
				],
				'condition' => ['enable_icon_box' => 'yes'],
				'selector'  => '{{WRAPPER}} .xmoze-cat-icon',
			]
		);
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'image_border',
                'selector'  => '{{WRAPPER}} .xmoze-cat-icon',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'image_box_shadow',
                'exclude'  => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .xmoze-cat-icon',
            ]
        );

        $this->add_responsive_control(
            'width',
            [
                'label'          => __('Width', 'xmoze-hp'),
                'type'           => Controls_Manager::SLIDER,
                'size_units'     => ['%', 'px','vw'],
                'range'          => [
                    '%'  => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 1000,
                    ],
                    'vw' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors'      => [
                    '{{WRAPPER}} .xmoze-cat-icon' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'space',
            [
                'label'          => __('Max Width', 'xmoze-hp'),
                'type'           => Controls_Manager::SLIDER,
                'size_units'     => ['px', '%', 'vw'],
                'range'          => [
                    '%'  => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 1000,
                    ],
                    'vw' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors'      => [
                    '{{WRAPPER}} .xmoze-cat-icon' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'height',
            [
                'label'          => __('Height', 'xmoze-hp'),
                'type'           => Controls_Manager::SLIDER,
                'size_units'     => ['px', 'vh'],
                'range'          => [
                    'px' => [
                        'min' => 1,
                        'max' => 1000,
                    ],
                    'vh' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors'      => [
                    '{{WRAPPER}} .xmoze-cat-icon' => 'height: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );

        $this->add_responsive_control(
            'object-fit',
            [
                'label'     => __('Object Fit', 'xmoze-hp'),
                'type'      => Controls_Manager::SELECT,
                'condition' => [
                    'height[size]!' => '',
                ],
                'options'   => [
                    ''        => __('Default', 'xmoze-hp'),
                    'fill'    => __('Fill', 'xmoze-hp'),
                    'cover'   => __('Cover', 'xmoze-hp'),
                    'contain' => __('Contain', 'xmoze-hp'),
                ],
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .xmoze-cat-icon img' => 'object-fit: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_box_',
            [
                'label'      => __('Border Radius', 'xmoze-hp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .xmoze-cat-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .xmoze-cat-icon' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_box_margin',
            [
                'label'      => __('Margin', 'xmoze-hp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .xmoze-cat-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .xmoze-cat-icon' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
			'svg_fill_color',
			[
				'label' => __( 'Svg Fill Color', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .xmoze-cat-icon svg path' => 'fill: {{VALUE}}',
				],
			]
		);
        $this->add_control(
			'svg_stroke_color',
			[
				'label' => __( 'Svg Stroke Color', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .xmoze-cat-icon svg path' => 'stroke: {{VALUE}}',
				],
			]
		);


        $this->add_control(
			'active_svg_fill_color',
			[
				'label' => __( 'Active Svg Fill Color', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .xmoze-job-cat:hover .xmoze-cat-icon svg path' => 'fill: {{VALUE}}',
				],
			]
		);
        $this->add_control(
			'active_svg_stroke_color',
			[
				'label' => __( 'Active Svg Stroke Color', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .xmoze-job-cat:hover .xmoze-cat-icon svg path' => 'stroke: {{VALUE}}',
				],
			]
		);

        $this->end_controls_section();

        /*
        *Title
        */
        $this->start_controls_section('cate_box_title',
            [
                'label' => __('Title', 'xmoze-hp'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'xmoze_title_color',
            [
                'label'     => __('Color', 'xmoze-hp'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}  .xmoze-job-cat-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'xmoze_title_color_hover',
            [
                'label'     => __('Hover Color', 'xmoze-hp'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}  .xmoze-job-cat:hover .xmoze-job-cat-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'xmoze_title_typo',
                'label'    => __('Typography', 'xmoze-hp'),
                'selector' => '{{WRAPPER}}   .xmoze-job-cat-title',
            ]
        );

        $this->add_responsive_control(
            'xmoze_title_margin',
            [
                'label'      => __('Margin', 'xmoze-hp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}}  .xmoze-job-cat-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}}  .xmoze-job-cat-title' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'xmoze_title_padding',
            [
                'label'      => __('Padding', 'xmoze-hp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}}  .xmoze-job-cat-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}}  .xmoze-job-cat-title' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        /*
        **== Category Count
        */
        $this->start_controls_section('cate_count',
            [
                'label' => __('Category Count', 'xmoze-hp'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'cate_count_color',
            [
                'label'     => __('Color', 'xmoze-hp'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}  .xmoze-job-count' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'cate_count_color_hover',
            [
                'label'     => __('Hover Color', 'xmoze-hp'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}  .xmoze-job-cat:hover .xmoze-job-count' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'xmoze_cate_typo',
                'label'    => __('Typography', 'xmoze-hp'),
                'selector' => '{{WRAPPER}}   .xmoze-job-count',
            ]
        );

        $this->add_responsive_control(
            'xmoze_cate_margin',
            [
                'label'      => __('Margin', 'xmoze-hp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}}  .xmoze-job-count' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}}  .xmoze-job-count' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'xmoze_cate_padding',
            [
                'label'      => __('Padding', 'xmoze-hp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}}  .xmoze-job-count' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}}  .xmoze-job-count' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        /* box style */
        $this->start_controls_section('box',
            [
                'label' => __('Box', 'xmoze-hp'),
                'tab'   => Controls_Manager::TAB_STYLE,

            ]
        );

		$this->add_responsive_control(
            'box_align',
            [
                'label'     => __( 'Box Alignment', 'fd-addons' ),
                'type'      => \Elementor\Controls_Manager::CHOOSE,
                'options'   => [
                    'left'    => [
                        'title' => __( 'Left', 'fd-addons' ),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center'  => [
                        'title' => __( 'Center', 'fd-addons' ),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right'   => [
                        'title' => __( 'Right', 'fd-addons' ),
                        'icon'  => 'eicon-text-align-right',
                    ],
                ],
                'default'   => 'left',
                'selectors' => [
                    '{{WRAPPER}} .xmoze-job-cat'  => 'text-align: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
			'wrap_box_width',
			[
				'label' => __( 'Width', 'plugin-domain' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 100,
				],
				'selectors' => [
					'{{WRAPPER}} .xmoze-job-cat' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->add_control(
			'wrap_box_height',
			[
				'label' => __( 'Height', 'plugin-domain' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 212,
				],
				'selectors' => [
					'{{WRAPPER}} .xmoze-job-cat' => 'min-height: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->start_controls_tabs(
            'style_tabs'
        );
        // normal
        $this->start_controls_tab(
            'box_normal',
            [
                'label' => __('Normal', 'xmoze-hp'),
            ]
        );
        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'box_bg_color',
				'types'     => [ 'classic', 'gradient' ],
				'fields_options'  => [
					'background'  => [
						'default' => 'classic'
					],
					'color'       => [
						'default' => '#ffffff'
					]
				],
				'selector'  => '{{WRAPPER}} .xmoze-job-cat',
			]
		);
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'box_border',
                'selector'  => '{{WRAPPER}} .xmoze-job-cat',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'box_shadow',
                'exclude'  => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .xmoze-job-cat',
            ]
        );

        $this->add_responsive_control(
            'margin_bottom',
            [
                'label'          => __('Bottom Gap', 'xmoze-hp'),
                'type'           => Controls_Manager::SLIDER,
                'default'        => [
                    'unit' => 'px',
                ],
                'range'          => [
                    'px' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors'      => [
                    '{{WRAPPER}} .xmoze-job-cat' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );


        $this->add_responsive_control(
            'box_margin',
            [
                'label'      => __('Margin', 'xmoze-hp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .xmoze-job-cat' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .xmoze-job-cat' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'box_padding',
            [
                'label'      => __('Padding', 'xmoze-hp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .xmoze-job-cat' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .xmoze-job-cat' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'box_border_radius',
            [
                'label'      => __('Border Radius', 'xmoze-hp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .xmoze-job-cat' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .xmoze-job-cat' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        // hover
        $this->start_controls_tab(
            'box_hover',
            [
                'label' => __('Hover', 'xmoze-hp'),
            ]
        );

        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'box_bg_hover_color',
				'types'     => [ 'classic', 'gradient' ],
				'fields_options'  => [
					'background'  => [
						'default' => 'classic'
					],
					'color'       => [
						'default' => '#ffffff'
					]
				],
				'selector'  => '{{WRAPPER}} .job-categories-wrap .xmoze-job-cat:hover',
			]
		);
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'tn_border_hover',
                'selector'  => '{{WRAPPER}} .xmoze-job-cat:hover',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'box_shadow_hover',
                'exclude'  => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .xmoze-job-cat:hover',
            ]
        );

        $this->add_responsive_control(
            'box__hover_radius',
            [
                'label'      => __('Border Radius', 'xmoze-hp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .xmoze-job-cat:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .xmoze-job-cat:hover' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
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

        $this->add_render_attribute('cat_version', 'class', array('job-categories-wrap row justify-content-center' ));

        //grid class
        $grid_classes = [];
        $grid_classes[] = 'col-lg-' . $settings['per_line'];
        $grid_classes[] = 'col-md-' . $settings['per_line_tablet'];
        $grid_classes[] = 'col-sm-' . $settings['per_line_mobile'];
        $grid_classes = implode(' ', $grid_classes);
        $this->add_render_attribute('cat_grid_classes', 'class', [$grid_classes]);

        $term = get_queried_object();

        $numabr_of_cat = !empty($settings['category_count']) ? $settings['category_count'] : -1;

        $taxonomy     = 'job-category';
        $orderby      = 'date';
        $show_count   = 1;
        $pad_counts   = 0;
        $hierarchical = 0;
        $title        = '';
        $empty        = 0;

        $args = array(
            'taxonomy'     => $taxonomy,
            'order'        => 'DESC',
            'orderby'      => 'date',
            'show_count'   => $show_count,
            'pad_counts'   => $pad_counts,
            'hierarchical' => $hierarchical,
            'title_li'     => $title,
            'hide_empty'   => $empty,
            'number'       => $numabr_of_cat + 1,
        );

        $all_categories = get_categories($args);

        ?>
        <div <?php echo $this->get_render_attribute_string('cat_version'); ?>>
            <?php
            foreach ($all_categories as $cat) {

                // $category_icon = get_field('category_icon');


                $category_id = $cat->term_id;
                $product_count_label = _nx('Job', 'Jobs', $cat->category_count, 'Job', 'xmoze-hp');
                $list = '';

                ?>
                <div <?php echo $this->get_render_attribute_string('cat_grid_classes'); ?>>
                    <a class="xmoze-job-cat xmoze-icon-positions-<?php echo $settings['icon-position'] ?>" href="<?php echo get_term_link($cat->slug, 'job-category') ?>">
                        <div class="xmoze-cat-icon">

                        <?php

                            $job_category_icon_file = get_field('job_category_icon', $cat);

                            $job_category_icon = (isset($job_category_icon_file) ? $job_category_icon_file : '');


                            if($job_category_icon && function_exists('the_field')){
                                echo file_get_contents($job_category_icon);
                            }
                        ?>

                        </div>
                        <div class="xmoze-cat-contnt">
                            <h4 class="xmoze-job-cat-title"><?php echo $cat->name ?></h4>
                            <span class="xmoze-job-count"> <?php echo $cat->category_count ?> <?php echo $product_count_label ?></span>
                        </div>
                    </a>
                </div>
            <?php
            } ?>
        </div>
        <?php
    }
}
$widgets_manager->register(new \Xmoze_Job_Category());