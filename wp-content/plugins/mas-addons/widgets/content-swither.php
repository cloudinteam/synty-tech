<?php
namespace Mas_Addons\Widgets;

if ( ! defined( 'ABSPATH' ) ) exit;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;

class Mas_Content_Switcher extends Widget_Base {

    public function get_name() {
		return 'mas-content-switcher';
	}

	/**
	 * Get widget title.
	 *
	 * @since 2.24.2
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __('Content Switcher', 'mas-addons');
	}

    public function get_categories() {
		return [ 'mas-addons' ];
	}

	/**
	 * Get widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'feather icon-toggle-right';
	}

	public function get_keywords() {
		return ['content', 'switcher', 'toggle', 'mas'];
	}

	protected function register_controls() {

        /**
         * Content Switcher Content
         */
        $this->start_controls_section(
            'mas_switcher_content_section',
            [
                'label' => __( 'Content', 'mas-addons' )
            ]
        );

        $this->start_controls_tabs( 'mas_switcher_content_tabs' );

            $this->start_controls_tab( 'mas_switcher_content_primary', [ 'label' => __( 'Primary', 'mas-addons' ) ] );

                $this->add_control(
                    'mas_switcher_content_primary_heading',
                    [
                        'label'       => esc_html__( 'Heading', 'mas-addons' ),
                        'type'        => Controls_Manager::TEXT,
                        'label_block' => true,
                        'default'     => esc_html__( 'Primary Heading', 'mas-addons' )
                    ]
                );

                $this->add_control(
                    'mas_switcher_primary_content_type',
                    [
                        'label'   => __( 'Content Type', 'mas-addons' ),
                        'type'    => Controls_Manager::SELECT,
                        'default' => 'content',
                        'options' => [
                            'content'       => __( 'Content', 'mas-addons' ),
                            'save_template' => __( 'Save Template', 'mas-addons' )
                        ]
                    ]
                );

                $this->add_control(
                    'mas_switcher_primary_content_save_template',
                    [
                        'label'     => __( 'Select Section', 'mas-addons' ),
                        'type'      => Controls_Manager::SELECT,
                        'options'   => $this->get_saved_template( 'section' ),
                        'default'   => '-1',
                        'condition' => [
                            'mas_switcher_primary_content_type' => 'save_template'
                        ]
                    ]
                );

                $this->add_control(
                    'mas_switcher_content_primary_content',
                    [
                        'label'       => __( 'Content', 'mas-addons' ),
                        'type'        => Controls_Manager::WYSIWYG,
                        'default'     => __( 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.  Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
						', 'mas-addons' ),
                        'placeholder' => __( 'Type your description here', 'mas-addons' ),
                        'condition'   => [
                            'mas_switcher_primary_content_type' => 'content'
                        ]
                    ]
                );

            $this->end_controls_tab();

            $this->start_controls_tab( 'mas_switcher_content_secondary', [ 'label' => __('Secondary', 'mas-addons') ] );

                $this->add_control(
                    'mas_switcher_content_secondary_heading',
                    [
                        'label'       => esc_html__( 'Heading', 'mas-addons' ),
                        'type'        => Controls_Manager::TEXT,
                        'label_block' => true,
                        'default'     => esc_html__( 'Secondary Heading', 'mas-addons' )
                    ]
                );

                $this->add_control(
                    'mas_switcher_secondary_content_type',
                    [
                        'label'   => __( 'Content Type', 'mas-addons' ),
                        'type'    => Controls_Manager::SELECT,
                        'default' => 'content',
                        'options' => [
                            'content'       => __( 'Content', 'mas-addons' ),
                            'save_template' => __( 'Save Template', 'mas-addons' )
                        ]
                    ]
                );

                $this->add_control(
                    'mas_switcher_secondary_content_save_template',
                    [
                        'label'     => __( 'Select Section', 'mas-addons' ),
                        'type'      => Controls_Manager::SELECT,
                        'options'   => $this->get_saved_template( 'section' ),
                        'default'   => '-1',
                        'condition' => [
                            'mas_switcher_secondary_content_type' => 'save_template'
                        ]
                    ]
                );

                $this->add_control(
                    'mas_switcher_content_secondary_content',
                    [
                        'label'       => __( 'Content', 'mas-addons' ),
                        'type'        => Controls_Manager::WYSIWYG,
                        'default'     => __( 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.

						', 'mas-addons' ),
                        'placeholder' => __( 'Type your description here', 'mas-addons' ),
                        'condition'   => [
                            'mas_switcher_secondary_content_type' => 'content'
                        ]
                    ]
                );

            $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        /**
         * Content Switcher Style
         */
        $this->start_controls_section(
            'mas_switcher_content_heading_style',
            [
                'label' => __( 'Switcher Heading', 'mas-addons' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
			'mas_switcher_content_heading_allignment',
			[
                'label'   => __( 'Alignment', 'mas-addons' ),
                'type'    => Controls_Manager::CHOOSE,
                'default' => 'mas_switecher_center',
                'toggle'  => false,
                'options' => [
					'mas_switecher_left'   => [
                        'title'        => __( 'Left', 'mas-addons' ),
                        'icon'         => 'eicon-text-align-left'
					],
					'mas_switecher_center' => [
                        'title'        => __( 'Center', 'mas-addons' ),
                        'icon'         => 'eicon-text-align-center'
					],
					'mas_switecher_right'  => [
                        'title'        => __( 'Right', 'mas-addons' ),
                        'icon'         => 'eicon-text-align-right'
                    ],
					'mas_switecher_justify'  => [
                        'title'        => __( 'justify', 'mas-addons' ),
                        'icon'         => 'eicon-text-align-right'
					]
				]
			]
        );


        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'mas_switcher_content_heading_background',
				'label' => __( 'Background', 'mas-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .mas-content-switcher-toggle-inner',
			]
		);

        $this->add_control(
			'mas_switcher_content_heading_padding',
			[
                'label'        => __( 'Padding', 'mas-addons' ),
                'type'         => Controls_Manager::DIMENSIONS,
                'size_units'   => [ 'px', '%' ],
                'default'      => [
                    'top'      => '30',
                    'right'    => '0',
                    'bottom'   => '30',
                    'left'     => '0',
                    'unit'     => 'px',
                    'isLinked' => false
                ],
				'selectors'    => [
					'{{WRAPPER}} .mas-content-switcher-toggle-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
        );

        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
                'name'     => 'mas_switcher_content_heading_border',
                'selector' => '{{WRAPPER}} .mas-content-switcher-toggle-inner'
			]
		);

        $this->add_control(
			'mas_switcher_content_heading_radius',
			[
                'label'      => __( 'Border Radius', 'mas-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
					'{{WRAPPER}} .mas-content-switcher-toggle-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
        );

        $this->add_control(
			'mas_switcher_content_heading_spacing',
			[
                'label'       => __( 'Heading Spacing', 'mas-addons' ),
                'type'        => Controls_Manager::SLIDER,
                'size_units'  => [ 'px', '%' ],
                'range'       => [
					'px'      => [
						'min' => 0,
						'max' => 100
					]
				],
				'default'     => [
					'unit'    => 'px',
					'size'    => 20
				],
				'selectors'   => [
					'{{WRAPPER}} .mas-content-switcher-toggle-label-1' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .mas-content-switcher-toggle-label-2' => 'margin-left: {{SIZE}}{{UNIT}};'
				]
			]
        );

        $this->add_control(
			'mas_switcher_content_heading_bottom_spacing',
			[
                'label'       => __( 'Bottom Spacing', 'mas-addons' ),
                'type'        => Controls_Manager::SLIDER,
                'size_units'  => [ 'px' ],
                'range'       => [
					'px'      => [
						'min' => 0,
						'max' => 100
					]
				],
				'default'     => [
					'unit'    => 'px',
					'size'    => 0
				],
				'selectors'   => [
					'{{WRAPPER}} .mas-content-switcher-toggle-inner' => 'margin-bottom: {{SIZE}}{{UNIT}};'
				]
			]
        );

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
                'name'     => 'mas_switcher_content_heading_typography',
                'selector' => '{{WRAPPER}} .mas-content-switcher-toggle-label-1, {{WRAPPER}} .mas-content-switcher-toggle-label-2'
			]
        );

        $this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
                'name'     => 'mas_switcher_content_heading_shadow',
                'selector' => '{{WRAPPER}} .mas-content-switcher-toggle-inner'
			]
		);

        $this->start_controls_tabs('mas_switcher_content_heading_bottom_tabs');

            $this->start_controls_tab('mas_switcher_content_heading_primary', [ 'label' => __( 'Primary Heading', 'mas-addons' ) ] );

                $this->add_control(
                    'mas_switcher_content_heading_primary_color',
                    [
                        'label'     => __( 'Text Color', 'mas-addons' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .mas-content-switcher-toggle-label-1' => 'color: {{VALUE}};'
                        ]
                    ]
                );

            $this->end_controls_tab();

            $this->start_controls_tab('mas_switcher_content_heading_secondary', [ 'label' => __('Secondary Heading', 'mas-addons') ] );

                $this->add_control(
                    'mas_switcher_content_heading_secondary_color',
                    [
                        'label'     => __( 'Text Color', 'mas-addons' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .mas-content-switcher-toggle-label-2' => 'color: {{VALUE}};'
                        ]
                    ]
                );

            $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        /**
         * Content Switcher Style
         */
        $this->start_controls_section(
            'mas_switcher_content_switch_style',
            [
                'label' => __( 'Switch Style', 'mas-addons' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
			'mas_switcher_content_switch',
			[
                'label'     => __( 'Switch Background', 'mas-addons' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'after'
			]
        );

        $this->add_control(
			'mas_switcher_content_switch_width',
			[
                'label'       => __( 'Width', 'mas-addons' ),
                'type'        => Controls_Manager::SLIDER,
                'size_units'  => [ 'px' ],
                'range'       => [
					'px'      => [
						'min' => 0,
						'max' => 100
					]
				],
				'default'     => [
					'unit'    => 'px',
					'size'    => 70
				],
				'selectors'   => [
					'{{WRAPPER}} .mas-content-switcher-toggle-switch-slider' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .mas-content-switcher-toggle-switch-label' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} input:checked + .mas-content-switcher-toggle-switch-slider:before' => '-webkit-transform: translate( calc( {{SIZE}}{{UNIT}} - {{mas_switcher_content_switch_control_width.size}}{{mas_switcher_content_switch_control_width.unit}} ) , -50%); -ms-transform: translate(calc( {{SIZE}}{{UNIT}} - {{mas_switcher_content_switch_control_width.size}}{{mas_switcher_content_switch_control_width.unit}} ), -50%);transform: translate(calc( {{SIZE}}{{UNIT}} - {{mas_switcher_content_switch_control_width.size}}{{mas_switcher_content_switch_control_width.unit}} ), -50%);'
				]
			]
        );

        $this->add_control(
			'mas_switcher_content_switch_height',
			[
                'label'       => __( 'Height', 'mas-addons' ),
                'type'        => Controls_Manager::SLIDER,
                'size_units'  => [ 'px' ],
                'range'       => [
					'px'      => [
						'min' => 0,
						'max' => 100
					]
				],
				'default'     => [
					'unit'    => 'px',
					'size'    => 30
				],
				'selectors'   => [
                    '{{WRAPPER}} .mas-content-switcher-toggle-switch-slider,
                    {{WRAPPER}} .mas-content-switcher-toggle-switch,
                    {{WRAPPER}} .mas-content-switcher-toggle-switch-label' => 'height: {{SIZE}}{{UNIT}};'
				]
			]
        );

        $this->add_control(
			'mas_switcher_content_switch_radius',
			[
                'label'      => __( 'Switch Border Radius', 'mas-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default'    => [
                    'top'    => '30',
                    'right'  => '30',
                    'bottom' => '30',
                    'left'   => '30',
                    'unit'   => 'px'
                ],
                'selectors'  => [
					'{{WRAPPER}} .mas-content-switcher-toggle-switch-slider' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
        );

        $this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
                'name'     => 'mas_switcher_content_switch_shadow',
                'selector' => '{{WRAPPER}} .mas-content-switcher-toggle-switch-slider'
			]
		);

        $this->start_controls_tabs('mas_switcher_content_switch_tabs');

            $this->start_controls_tab('mas_switcher_content_switch_off', [ 'label' => __( 'Switch OFF', 'mas-addons') ] );

                $this->add_group_control(
                    Group_Control_Background::get_type(),
                    [
                        'name' => 'mas_switcher_content_switch_off_bg_color',
                        'label' => __( 'Background', 'mas-addons' ),
                        'types' => [ 'classic', 'gradient' ],
                        'fields_options'  => [
                            'background'  => [
                                'default' => 'classic'
                            ],
                            'color'       => [
                                'default' => '#4243DC'
                            ]
                        ],
                        'selector' => '{{WRAPPER}} .mas-content-switcher-toggle-switch-slider',
                    ]
                );

                $this->add_control(
                    'mas_switcher_content_switch_off_border_style',
                    [
                        'label' => __( 'Switch Border Style', 'mas-addons' ),
                        'type' => Controls_Manager::SELECT,
                        'default' => 'none',
                        'options' => [
                            'none' => __( 'None', 'mas-addons' ),
                            'solid'  => __( 'Solid', 'mas-addons' ),
                            'dashed' => __( 'Dashed', 'mas-addons' ),
                            'dotted' => __( 'Dotted', 'mas-addons' ),
                            'double' => __( 'Double', 'mas-addons' ),
                        ],
                        'selectors'   => [
                            '{{WRAPPER}} .mas-content-switcher-toggle-switch-slider' => 'border-style: {{VALUE}};'
                        ]
                    ]
                );

                $this->add_control(
                    'mas_switcher_content_switch_off_border_width',
                    [
                        'label'       => __( 'Switch Border Width', 'mas-addons' ),
                        'type'        => Controls_Manager::SLIDER,
                        'size_units'  => [ 'px' ],
                        'range'       => [
                            'px'      => [
                                'min' => 0,
                                'max' => 10
                            ]
                        ],
                        'default'     => [
                            'unit'    => 'px',
                            'size'    => 0
                        ],
                        'selectors'   => [
                            '{{WRAPPER}} .mas-content-switcher-toggle-switch-slider' => 'border-width: {{SIZE}}{{UNIT}};'
                        ],
                        'condition' => [
                            'mas_switcher_content_switch_off_border_style!' => 'none'
                        ]
                    ]
                );

                $this->add_control(
                    'mas_switcher_content_switch_off_border_color',
                    [
                        'label'     => __( 'Switch Border color', 'mas-addons' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .mas-content-switcher-toggle-switch-slider' => 'border-color: {{VALUE}};'
                        ],
                        'condition' => [
                            'mas_switcher_content_switch_off_border_style!' => 'none'
                        ]
                    ]
                );

            $this->end_controls_tab();

            $this->start_controls_tab('mas_switcher_content_switch_on', [ 'label' => __( 'Switch ON', 'mas-addons') ] );

                $this->add_group_control(
                    Group_Control_Background::get_type(),
                    [
                        'name' => 'mas_switcher_content_switch_on_bg_color',
                        'label' => __( 'Background', 'mas-addons' ),
                        'types' => [ 'classic', 'gradient' ],
                        'selector' => '{{WRAPPER}} input:checked + .mas-content-switcher-toggle-switch-slider',
                    ]
                );

                $this->add_control(
                    'mas_switcher_content_switch_on_border_style',
                    [
                        'label' => __( 'Switch Border Style', 'mas-addons' ),
                        'type' => Controls_Manager::SELECT,
                        'default' => 'none',
                        'options' => [
                            'none' => __( 'None', 'mas-addons' ),
                            'solid'  => __( 'Solid', 'mas-addons' ),
                            'dashed' => __( 'Dashed', 'mas-addons' ),
                            'dotted' => __( 'Dotted', 'mas-addons' ),
                            'double' => __( 'Double', 'mas-addons' ),
                        ],
                        'selectors'   => [
                            '{{WRAPPER}} input:checked + .mas-content-switcher-toggle-switch-slider' => 'border-style: {{VALUE}};'
                        ]
                    ]
                );

                $this->add_control(
                    'mas_switcher_content_switch_on_border_width',
                    [
                        'label'       => __( 'Switch Border Width', 'mas-addons' ),
                        'type'        => Controls_Manager::SLIDER,
                        'size_units'  => [ 'px' ],
                        'range'       => [
                            'px'      => [
                                'min' => 0,
                                'max' => 10
                            ]
                        ],
                        'default'     => [
                            'unit'    => 'px',
                            'size'    => 0
                        ],
                        'selectors'   => [
                            '{{WRAPPER}} input:checked + .mas-content-switcher-toggle-switch-slider' => 'border-width: {{SIZE}}{{UNIT}};'
                        ],
                        'condition' => [
                            'mas_switcher_content_switch_on_border_style!' => 'none'
                        ]
                    ]
                );

                $this->add_control(
                    'mas_switcher_content_switch_on_border_color',
                    [
                        'label'     => __( 'Switch Border color', 'mas-addons' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} input:checked + .mas-content-switcher-toggle-switch-slider' => 'border-color: {{VALUE}};'
                        ],
                        'condition' => [
                            'mas_switcher_content_switch_on_border_style!' => 'none'
                        ]
                    ]
                );

            $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
			'mas_switcher_content_switch_control',
			[
                'label'     => __( 'Switch Control', 'mas-addons' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before'
			]
        );

        $this->add_control(
			'mas_switcher_content_switch_control_spacing_with_border',
			[
                'label'       => __( 'Left & Right Spacing', 'mas-addons' ),
                'type'        => Controls_Manager::SLIDER,
                'size_units'  => [ 'px' ],
                'range'       => [
					'px'      => [
						'min' => 0,
						'max' => 20
					]
				],
				'default'     => [
					'unit'    => 'px',
					'size'    => 5
				],
				'selectors'   => [
                    '{{WRAPPER}} .mas-content-switcher-toggle-switch-slider:before'                 => 'margin-left: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} input:checked + .mas-content-switcher-toggle-switch-slider:before' => 'margin-left: calc( -{{SIZE}}{{UNIT}} - ( {{mas_switcher_content_switch_on_border_width.size}}{{mas_switcher_content_switch_on_border_width.unit}} * 2 ) ) ;',
                    '{{WRAPPER}} input:checked + .mas-content-switcher-toggle-switch-slider:before' => 'margin-left: calc( -{{SIZE}}{{UNIT}} - ( {{mas_switcher_content_switch_off_border_width.size}}{{mas_switcher_content_switch_off_border_width.unit}} * 2 ) ) ;'
                ],
                'condition' => [
                    'mas_switcher_content_switch_off_border_style!' => 'none',
                    'mas_switcher_content_switch_on_border_style!' => 'none',
                ]
			]
        );

        $this->add_control(
			'mas_switcher_content_switch_control_spacing_without_border',
			[
                'label'       => __( 'Left & Right Spacing', 'mas-addons' ),
                'type'        => Controls_Manager::SLIDER,
                'size_units'  => [ 'px' ],
                'range'       => [
					'px'      => [
						'min' => 0,
						'max' => 20
					]
				],
				'default'     => [
					'unit'    => 'px',
					'size'    => 5
				],
				'selectors'   => [
                    '{{WRAPPER}} .mas-content-switcher-toggle-switch-slider:before'                 => 'margin-left: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} input:checked + .mas-content-switcher-toggle-switch-slider:before' => 'margin-left: -{{SIZE}}{{UNIT}} ;',
                ],
                'condition' => [
                    'mas_switcher_content_switch_off_border_style' => 'none',
                    'mas_switcher_content_switch_on_border_style' => 'none'
                ]
			]
        );

        $this->add_control(
			'mas_switcher_content_switch_control_radius',
			[
                'label'      => __( 'Switch Control Border Radius', 'mas-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default'    => [
                    'top'    => '30',
                    'right'  => '30',
                    'bottom' => '30',
                    'left'   => '30',
                    'unit'   => 'px'
                ],
                'selectors'  => [
					'{{WRAPPER}} .mas-content-switcher-toggle-switch-slider:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
        );

        $this->start_controls_tabs( 'mas_switcher_content_switch_control_tabs' );

            $this->start_controls_tab( 'mas_switcher_content_switch_control_off', [ 'label' => __( 'Switch Control OFF', 'mas-addons' ) ] );

                $this->add_control(
                    'mas_switcher_content_switch_control_width',
                    [
                        'label'       => __( 'Width', 'mas-addons' ),
                        'type'        => Controls_Manager::SLIDER,
                        'size_units'  => [ 'px' ],
                        'range'       => [
                            'px'      => [
                                'min' => 0,
                                'max' => 50
                            ]
                        ],
                        'default'     => [
                            'unit'    => 'px',
                            'size'    => 27
                        ],
                        'selectors'   => [
                            '{{WRAPPER}} .mas-content-switcher-toggle-switch-slider:before' => 'width: {{SIZE}}{{UNIT}};'
                        ]
                    ]
                );

                $this->add_control(
                    'mas_switcher_content_switch_control_height',
                    [
                        'label'       => __( 'Height', 'mas-addons' ),
                        'type'        => Controls_Manager::SLIDER,
                        'size_units'  => [ 'px' ],
                        'range'       => [
                            'px'      => [
                                'min' => 0,
                                'max' => 50
                            ]
                        ],
                        'default'     => [
                            'unit'    => 'px',
                            'size'    => 27
                        ],
                        'selectors'   => [
                            '{{WRAPPER}} .mas-content-switcher-toggle-switch-slider:before' => 'height: {{SIZE}}{{UNIT}};'
                        ]
                    ]
                );

                $this->add_group_control(
                    Group_Control_Background::get_type(),
                    [
                        'name' => 'mas_switcher_content_switch_off_switch_control_color',
                        'label' => __( 'Background', 'mas-addons' ),
                        'types' => [ 'classic', 'gradient' ],
                        'fields_options'  => [
                            'background'  => [
                                'default' => 'classic'
                            ],
                            'color'       => [
                                'default' => '#ffffff',
                            ]
                        ],
                        'selector' => '{{WRAPPER}} .mas-content-switcher-toggle-switch-slider:before',
                    ]
                );

                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name'     => 'mas_switcher_content_switch_off_control_border',
                        'selector' => '{{WRAPPER}} .mas-content-switcher-toggle-switch-slider:before'
                    ]
                );

                $this->add_group_control(
                    Group_Control_Box_Shadow::get_type(),
                    [
                        'name'     => 'mas_switcher_content_switch_on_control_shadow',
                        'selector' => '{{WRAPPER}} .mas-content-switcher-toggle-switch-slider:before'
                    ]
                );

            $this->end_controls_tab();

            $this->start_controls_tab( 'mas_switcher_content_switch_control_on', [ 'label' => __( 'Switch Control ON', 'mas-addons' ) ] );

                $this->add_control(
                    'mas_switcher_content_switch_on_control_width',
                    [
                        'label'       => __( 'Width', 'mas-addons' ),
                        'type'        => Controls_Manager::SLIDER,
                        'size_units'  => [ 'px' ],
                        'range'       => [
                            'px'      => [
                                'min' => 0,
                                'max' => 50
                            ]
                        ],
                        'default'     => [
                            'unit'    => 'px',
                            'size'    => 27
                        ],
                        'selectors'   => [
                            '{{WRAPPER}} input:checked + .mas-content-switcher-toggle-switch-slider:before' => 'width: {{SIZE}}{{UNIT}};'
                        ]
                    ]
                );

                $this->add_control(
                    'mas_switcher_content_switch_on_control_height',
                    [
                        'label'       => __( 'Height', 'mas-addons' ),
                        'type'        => Controls_Manager::SLIDER,
                        'size_units'  => [ 'px' ],
                        'range'       => [
                            'px'      => [
                                'min' => 0,
                                'max' => 50
                            ]
                        ],
                        'default'     => [
                            'unit'    => 'px',
                            'size'    => 27
                        ],
                        'selectors'   => [
                            '{{WRAPPER}} input:checked + .mas-content-switcher-toggle-switch-slider:before' => 'height: {{SIZE}}{{UNIT}};'
                        ]
                    ]
                );

                $this->add_group_control(
                    Group_Control_Background::get_type(),
                    [
                        'name' => 'mas_switcher_content_switch_on_switch_control_color',
                        'label' => __( 'Background', 'mas-addons' ),
                        'types' => [ 'classic', 'gradient' ],
                        'fields_options'  => [
                            'background'  => [
                                'default' => 'classic'
                            ],
                            'color'       => [
                                'default' => '#ffffff',
                            ]
                        ],
                        'selector' => '{{WRAPPER}} input:checked + .mas-content-switcher-toggle-switch-slider:before',
                    ]
                );

                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name'     => 'mas_switcher_content_switch_on_control_border',
                        'selector' => '{{WRAPPER}} input:checked + .mas-content-switcher-toggle-switch-slider:before'
                    ]
                );

                $this->add_group_control(
                    Group_Control_Box_Shadow::get_type(),
                    [
                        'name'     => 'mas_switcher_content_switch_off_control_shadow',
                        'selector' => '{{WRAPPER}} input:checked + .mas-content-switcher-toggle-switch-slider:before'
                    ]
                );

            $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        /**
         * Content Switcher Content
         */
        $this->start_controls_section(
            'mas_switcher_content_main_contant_style',
            [
                'label' => __( 'Switcher Content', 'mas-addons' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
                'name'     => 'mas_switcher_main_contant_background',
                'label'    => __( 'Background', 'mas-addons' ),
                'types'    => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .mas-content-switcher-content-wrap'
			]
        );

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
                'name'     => 'mas_switcher_main_contant_typography',
                'selector' => '{{WRAPPER}} .mas-content-switcher-content-wrap'
			]
		);

        $this->add_control(
            'mas_switcher_main_contant_text_color',
            [
                'label'     => __( 'Text Color', 'mas-addons' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mas-content-switcher-content-wrap' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
			'mas_switcher_main_contant_padding',
			[
                'label'        => __( 'Padding', 'mas-addons' ),
                'type'         => Controls_Manager::DIMENSIONS,
                'size_units'   => [ 'px', '%' ],
                'default'      => [
                    'top'      => '20',
                    'right'    => '20',
                    'bottom'   => '20',
                    'left'     => '20',
                    'unit'     => 'px'
                ],
				'selectors'    => [
					'{{WRAPPER}} .mas-content-switcher-content-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
        );

        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
                'name'     => 'mas_switcher_main_contant_border',
                'selector' => '{{WRAPPER}} .mas-content-switcher-content-wrap'
			]
		);

        $this->add_control(
			'mas_switcher_main_contant_radius',
			[
                'label'      => __( 'Border Radius', 'mas-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
					'{{WRAPPER}} .mas-content-switcher-content-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
        );

        $this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
                'name'     => 'mas_switcher_main_contant_shadow',
                'selector' => '{{WRAPPER}} .mas-content-switcher-content-wrap'
			]
		);

        $this->end_controls_section();
    }

    /**
	 *  Get Saved Widgets
	 *
	 *  @param string $type Type.
	 *  @since 0.0.1
	 *  @return string
	 */
	public function get_saved_template( $type = 'page' ) {

		$saved_widgets = $this->get_post_template( $type );
		$options[-1]   = __( 'Select', 'mas-addons' );
		if ( count( $saved_widgets ) ) :
			foreach ( $saved_widgets as $saved_row ) :
				$options[ $saved_row['id'] ] = $saved_row['name'];
			endforeach;
		else :
			$options['no_template'] = __( 'No section template is added.', 'mas-addons' );
		endif;
		return $options;
	}

	/**
	 *  Get Templates based on category
	 *
	 *  @param string $type Type.
	 *  @since 0.0.1
	 *  @return string
	 */
	public function get_post_template( $type = 'page' ) {
		$posts = get_posts(
			array(
				'post_type'        => 'elementor_library',
				'orderby'          => 'title',
				'order'            => 'ASC',
				'posts_per_page'   => '-1',
				'tax_query'        => array(
					array(
						'taxonomy' => 'elementor_library_type',
						'field'    => 'slug',
						'terms'    => $type
					)
				)
			)
		);

		$templates = array();

		foreach ( $posts as $post ) :
			$templates[] = array(
				'id'   => $post->ID,
				'name' => $post->post_title
			);
		endforeach;

		return $templates;
	}

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <div class="mas-content-switcher-wrapper">
            <div class="mas-content-switcher-toggle <?php echo esc_attr( $settings['mas_switcher_content_heading_allignment'] ); ?>">
                <div class="mas-content-switcher-toggle-inner">
                    <div class="mas-content-switcher-toggle-label-1">
                        <?php echo esc_html( $settings['mas_switcher_content_primary_heading'] ); ?>
                    </div>
                    <div class="mas-content-switcher-toggle-switch">
                        <label class="mas-content-switcher-toggle-switch-label">
                            <input class="input" type="checkbox">
                            <span class="mas-content-switcher-toggle-switch-slider"></span>
                        </label>
                    </div>
                    <div class="mas-content-switcher-toggle-label-2">
                        <?php echo esc_html( $settings['mas_switcher_content_secondary_heading'] ); ?>
                    </div>
                </div>
            </div>
            <div class="mas-content-switcher-content-wrap">
                <div class="mas-content-switcher-primary-wrap">
                    <?php if( 'content' === $settings['mas_switcher_primary_content_type'] ) : ?>
                        <?php echo wp_kses_post( $settings['mas_switcher_content_primary_content'] ); ?>
                    <?php endif; ?>
                    <?php if( 'save_template' === $settings['mas_switcher_primary_content_type'] ) : ?>
                        <?php echo mas_layout_content( wp_kses_post( $settings['mas_switcher_primary_content_save_template'] ) ); ?>
                    <?php endif; ?>
                </div>
                <div class="mas-content-switcher-secondary-wrap">
                    <?php if( 'content' === $settings['mas_switcher_secondary_content_type'] ) : ?>
                        <?php echo wp_kses_post( $settings['mas_switcher_content_secondary_content'] ); ?>
                    <?php endif; ?>
                    <?php if( 'save_template' === $settings['mas_switcher_secondary_content_type'] ) : ?>
                        <?php echo mas_layout_content( wp_kses_post( $settings['mas_switcher_secondary_content_save_template'] ) ); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php
    }

}
$widgets_manager->register( new \Mas_Addons\Widgets\Mas_Content_Switcher() );