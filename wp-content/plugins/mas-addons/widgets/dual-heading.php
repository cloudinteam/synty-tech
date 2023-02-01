<?php
namespace Mas_Addons\Widgets;

if ( ! defined( 'ABSPATH' ) ) exit;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Icons_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Border;
use \Elementor\Widget_Base;

class Mas_Addons_Dual_Heading extends Widget_Base {

	public function get_name() {
		return 'fdaddons-dual-headding';
	}

	public function get_title() {
		return esc_html__( 'Dual Heading', 'mas-addons' );
	}

	public function get_icon() {
		return 'eicon-t-letter';
	}

	public function get_categories() {
		return [ 'mas-addons' ];
	}

    public function get_keywords() {
        return [ 'mas-addons', 'multi', 'double' ];
    }

    protected function register_controls() {

		/**
		* Dual Heading Content Section
		*/
		$this->start_controls_section(
			'mas_addons_dual_heading_content',
			[
				'label' => esc_html__( 'Content', 'mas-addons' )
			]
        );

        $this->add_control(
            'mas_addons_dual_first_heading',
            [
                'label'       => esc_html__( 'Before Heading', 'mas-addons' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => esc_html__( 'Before', 'mas-addons' )
            ]
        );

        $this->add_control(
            'mas_addons_dual_second_heading',
            [
                'label'       => esc_html__( 'Middle Heading', 'mas-addons' ),
                'type'        => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default'     => esc_html__( 'Middle', 'mas-addons' )
            ]
        );



        $this->add_control(
            'mas_addons_after_headding_show',
            [
                'label'        => esc_html__( 'Enable After Heading', 'mas-addons' ),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => 'no',
                'return_value' => 'yes'
            ]
        );

        $this->add_control(
            'mas_addons_dual_thard_heading',
            [
                'label'       => esc_html__( 'After Heading', 'mas-addons' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => esc_html__( 'After', 'mas-addons' ),
                'condition' => [
                    'mas_addons_after_headding_show' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'mas_addons_dual_heading_title_link',
            [
                'label'       => __( 'Heading URL', 'mas-addons' ),
                'type'        => Controls_Manager::URL,
                'placeholder' => __( 'https://your-link.com', 'mas-addons' ),
                'label_block' => true
            ]
        );
        $this->add_control(
            'mas_addons_sub_headding_show',
            [
                'label'        => esc_html__( 'Enable Sub Heading', 'mas-addons' ),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => 'no',
                'return_value' => 'yes'
            ]
        );

        $this->add_control(
            'mas_addons_dual_heading_description',
            [
                'label'       => __( 'Sub Heading', 'mas-addons' ),
                'type'        => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'dynamic'     => [ 'active' => true ],
                'condition' => [
                    'mas_addons_sub_headding_show' => 'yes',
                ],
                'default'     => __( 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'mas-addons' )
            ]
        );

        $this->add_control(
            'mas_addons_dual_heading_icon_show',
            [
                'label'        => esc_html__( 'Enable Icon', 'mas-addons' ),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => 'no',
                'return_value' => 'yes'
            ]
        );

        $this->add_control(
            'mas_addons_dual_heading_icon',
            [
                'label'   => __( 'Icon', 'mas-addons' ),
                'type'    => Controls_Manager::ICONS,
                'default' => [
                    'value'   => 'fab fa-wordpress-simple',
                    'library' => 'fa-brands'
                ],
                'condition' => [
                    'mas_addons_dual_heading_icon_show' => 'yes'
                ]
            ]
        );


        $this->end_controls_section();

        /*
        * Dual Heading Styling Section
        */
        $this->start_controls_section(
            'mas_addons_dual_heading_styles_general',
            [
                'label' => esc_html__( 'General Styles', 'mas-addons' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_responsive_control(
            'mas_addons_dual_heading_alignment',
            [
                'label'       => esc_html__( 'Alignment', 'mas-addons' ),
                'type'        => Controls_Manager::CHOOSE,
                'toggle'      => false,
                'label_block' => true,
                'options'     => [
                    'left'      => [
                        'title' => esc_html__( 'Left', 'mas-addons' ),
                        'icon'  => 'eicon-text-align-left'
                    ],
                    'center'    => [
                        'title' => esc_html__( 'Center', 'mas-addons' ),
                        'icon'  => 'eicon-text-align-center'
                    ],
                    'right'     => [
                        'title' => esc_html__( 'Right', 'mas-addons' ),
                        'icon'  => 'eicon-text-align-right'
                    ]
                ],
                'default'       => 'center',
                'label_block'   => true,
                'selectors'     => [
                    '{{WRAPPER}} .mas-addons-dual-heading .mas-addons-dual-heading-wrapper' => 'text-align: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'mas_addons_dual_heading_icon_color',
            [
                'label'     => esc_html__( 'Icon Color', 'mas-addons' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#132C47',
                'condition' => [
                    'mas_addons_dual_heading_icon_show'    => 'yes',
                    'mas_addons_dual_heading_icon[value]!' => ''
                ],
                'selectors' => [
                    '{{WRAPPER}} .mas-addons-dual-heading .mas-addons-dual-heading-wrapper .mas-addons-dual-heading-icon i' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'mas_addons_dual_heading_icon_size',
            [
                'label'        => __( 'Icon Size', 'mas-addons' ),
                'type'         => Controls_Manager::SLIDER,
                'range'        => [
                    'px'       => [
                        'min'  => 10,
                        'max'  => 150,
                        'step' => 2
                    ]
                ],
                'default'      => [
                    'unit'     => 'px',
                    'size'     => 36
                ],
                'selectors'    => [
                    '{{WRAPPER}} .mas-addons-dual-heading .mas-addons-dual-heading-wrapper .mas-addons-dual-heading-icon i' => 'font-size: {{SIZE}}{{UNIT}};'
                ],
                'condition'    => [
                    'mas_addons_dual_heading_icon_show'    => 'yes',
                    'mas_addons_dual_heading_icon[value]!' => ''
                ]
            ]
        );

        $this->add_responsive_control(
            'mas_addons_dual_heading_icon_margin',
            [
                'label'      => __('Icon Margin', 'mas-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'default'    => [
                    'top'    => '0',
                    'right'  => '0',
                    'bottom' => '15',
                    'left'   => '0'
                ],
                'selectors'  => [
                    '{{WRAPPER}} .mas-addons-dual-heading .mas-addons-dual-heading-wrapper .mas-addons-dual-heading-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'condition' => [
                    'mas_addons_dual_heading_icon_show'    => 'yes',
                    'mas_addons_dual_heading_icon[value]!' => ''
                ]
            ]
        );

        $this->end_controls_section();

        /*
            * Dual Heading First Part Styling Section
            */
        $this->start_controls_section(
            'mas_addons_dual_first_heading_styles',
            [
                'label' => esc_html__( 'Before Heading', 'mas-addons' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'mas_addons_dual_heading_first_text_color',
            [
                'label'     => esc_html__( 'Color', 'mas-addons' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#FF6C4B',
                'selectors' => [
                    '{{WRAPPER}} .mas-addons-dual-heading .mas-addons-dual-heading-wrapper .mas-addons-dual-heading-title .first-heading, {{WRAPPER}} .mas-addons-dual-heading .mas-addons-dual-heading-wrapper .mas-addons-dual-heading-title a .first-heading' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'            => 'mas_addons_dual_heading_first_bg_color',
                'types'           => [ 'classic', 'gradient' ],
                'default'         => '#222222',
                'selector'        => '{{WRAPPER}} .mas-addons-dual-heading .mas-addons-dual-heading-wrapper .mas-addons-dual-heading-title .first-heading, {{WRAPPER}} .mas-addons-dual-heading .mas-addons-dual-heading-wrapper .mas-addons-dual-heading-title a .first-heading',
            ]
        );

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
                'name'     => 'mas_addons_dual_first_heading_typography',
                'selector' => '{{WRAPPER}} .mas-addons-dual-heading .mas-addons-dual-heading-wrapper .mas-addons-dual-heading-title .first-heading'
			]
        );

        $this->add_responsive_control(
            'mas_addons_dual_first_heading_margin',
            [
                'label'      => __('Margin', 'mas-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .mas-addons-dual-heading .mas-addons-dual-heading-wrapper .mas-addons-dual-heading-title .first-heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'mas_addons_dual_first_heading_padding',
            [
                'label'      => __('Padding', 'mas-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .mas-addons-dual-heading .mas-addons-dual-heading-wrapper .mas-addons-dual-heading-title .first-heading' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'mas_addons_dual_first_heading_radius',
            [
                'label'      => __('Border radius', 'mas-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .mas-addons-dual-heading .mas-addons-dual-heading-wrapper .mas-addons-dual-heading-title .first-heading' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'mas_addons_dual_first_heading_border',
                'selector' => '{{WRAPPER}} .mas-addons-dual-heading .mas-addons-dual-heading-wrapper .mas-addons-dual-heading-title .first-heading'
            ]
        );
        $this->add_control(
			'show_title_first_strok',
			[
				'label' => __( 'Show Text Strok', 'mas-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'mas-addons' ),
				'label_off' => __( 'Hide', 'mas-addons' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

        $this->add_control(
			'show_title_first_strok_width',
			[
				'label' => __( 'Text Stroke Width', 'plugin-domain' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
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
                'condition' => [
                    'show_title_first_strok' => 'yes'
                ],
				'selectors' => [
					'{{WRAPPER}} .mas-addons-dual-heading .mas-addons-dual-heading-wrapper .mas-addons-dual-heading-title .first-heading' => '-webkit-text-stroke-width: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->add_control(
			'show_title_first_strok_color',
			[
				'label' => __( 'Text Stroke Color', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'show_title_first_strok' => 'yes'
                ],
				'selectors' => [
					'{{WRAPPER}} .mas-addons-dual-heading .mas-addons-dual-heading-wrapper .mas-addons-dual-heading-title .first-heading' => '-webkit-text-stroke-color: {{VALUE}}',
				],
			]
		);
        $this->add_control(
			'show_title_first_strok_fill_color',
			[
				'label' => __( 'Text Stroke Fill Color', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'show_title_first_strok' => 'yes'
                ],
				'selectors' => [
					'{{WRAPPER}} .mas-addons-dual-heading .mas-addons-dual-heading-wrapper .mas-addons-dual-heading-title .first-heading' => '-webkit-text-fill-color: {{VALUE}}',
				],
			]
		);
        $this->end_controls_section();


        /*
		* Dual Heading Thard Part Styling Section
		*/
        $this->start_controls_section(
                'mas_addons_dual_second_heading_styles',
                [
                    'label' => esc_html__( 'Middle Heading', 'mas-addons' ),
                    'tab'   => Controls_Manager::TAB_STYLE
                ]
        );

        $this->add_control(
                'mas_addons_dual_heading_second_text_color',
                [
                    'label'     => esc_html__( 'Color', 'mas-addons' ),
                    'type'      => Controls_Manager::COLOR,
                    'default'   => '#132C47',
                    'selectors' => [
                        '{{WRAPPER}} .mas-addons-dual-heading .mas-addons-dual-heading-wrapper .mas-addons-dual-heading-title .second-heading,  {{WRAPPER}} .mas-addons-dual-heading .mas-addons-dual-heading-wrapper .mas-addons-dual-heading-title .second-heading a ' => 'color: {{VALUE}};'
                    ]
                ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'mas_addons_dual_heading_second_bg_color',
                'types'    => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .mas-addons-dual-heading .mas-addons-dual-heading-wrapper .mas-addons-dual-heading-title .second-heading,  {{WRAPPER}} .mas-addons-dual-heading .mas-addons-dual-heading-wrapper .mas-addons-dual-heading-title .second-heading a '
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'mas_addons_dual_second_heading_typography',
                'selector' => '{{WRAPPER}} .mas-addons-dual-heading .mas-addons-dual-heading-wrapper .mas-addons-dual-heading-title .second-heading '
            ]
        );

        $this->add_responsive_control(
            'mas_addons_dual_second_heading_margin',
            [
                'label'      => __('Margin', 'mas-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .mas-addons-dual-heading .mas-addons-dual-heading-wrapper .mas-addons-dual-heading-title .second-heading ' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'mas_addons_dual_second_heading_padding',
            [
                'label'      => __('Padding', 'mas-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .mas-addons-dual-heading .mas-addons-dual-heading-wrapper .mas-addons-dual-heading-title .second-heading ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'mas_addons_dual_second_heading_radius',
            [
                'label'      => __('Border radius', 'mas-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .mas-addons-dual-heading .mas-addons-dual-heading-wrapper .mas-addons-dual-heading-title .second-heading ' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'mas_addons_dual_second_heading_border',
                'selector' => '{{WRAPPER}} .mas-addons-dual-heading .mas-addons-dual-heading-wrapper .mas-addons-dual-heading-title .second-heading '
            ]
        );
        $this->add_control(
			'show_title_second_strok',
			[
				'label' => __( 'Show Text Strok', 'mas-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'mas-addons' ),
				'label_off' => __( 'Hide', 'mas-addons' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

        $this->add_control(
			'show_title_second_strok_width',
			[
				'label' => __( 'Text Stroke Width', 'plugin-domain' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
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
                'condition' => [
                    'show_title_second_strok' => 'yes'
                ],
				'selectors' => [
					'{{WRAPPER}} .mas-addons-dual-heading .mas-addons-dual-heading-wrapper .mas-addons-dual-heading-title .second-heading' => '-webkit-text-stroke-width: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->add_control(
			'show_title_second_strok_color',
			[
				'label' => __( 'Text Stroke Color', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'show_title_second_strok' => 'yes'
                ],
				'selectors' => [
					'{{WRAPPER}} .mas-addons-dual-heading .mas-addons-dual-heading-wrapper .mas-addons-dual-heading-title .second-heading' => '-webkit-text-stroke-color: {{VALUE}}',
				],
			]
		);
        $this->add_control(
			'show_title_second_strok_fill_color',
			[
				'label' => __( 'Text Stroke Fill Color', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'show_title_second_strok' => 'yes'
                ],
				'selectors' => [
					'{{WRAPPER}} .mas-addons-dual-heading .mas-addons-dual-heading-wrapper .mas-addons-dual-heading-title .second-heading' => '-webkit-text-fill-color: {{VALUE}}',
				],
			]
		);
        $this->end_controls_section();


        /*
		* Dual Heading Thard Part Styling Section
		*/
        $this->start_controls_section(
            'mas_addons_dual_thard_heading_styles',
            [
                'label' => esc_html__( 'After Heading', 'mas-addons' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'mas_addons_after_headding_show' => 'yes',
                ],
            ]
         );

        $this->add_control(
                'mas_addons_dual_heading_thard_text_color',
                [
                    'label'     => esc_html__( 'Color', 'mas-addons' ),
                    'type'      => Controls_Manager::COLOR,
                    'default'   => '#132C47',
                    'selectors' => [
                        '{{WRAPPER}} .mas-addons-dual-heading .mas-addons-dual-heading-wrapper .mas-addons-dual-heading-title .thard-heading,  {{WRAPPER}} .mas-addons-dual-heading .mas-addons-dual-heading-wrapper .mas-addons-dual-heading-title .thard-heading a ' => 'color: {{VALUE}};'
                    ]
                ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'mas_addons_dual_heading_thard_bg_color',
                'types'    => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .mas-addons-dual-heading .mas-addons-dual-heading-wrapper .mas-addons-dual-heading-title .thard-heading,  {{WRAPPER}} .mas-addons-dual-heading .mas-addons-dual-heading-wrapper .mas-addons-dual-heading-title .thard-heading a '
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'mas_addons_dual_thard_heading_typography',
                'selector' => '{{WRAPPER}} .mas-addons-dual-heading .mas-addons-dual-heading-wrapper .mas-addons-dual-heading-title .thard-heading '
            ]
        );

        $this->add_responsive_control(
            'mas_addons_dual_thard_heading_margin',
            [
                'label'      => __('Margin', 'mas-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .mas-addons-dual-heading .mas-addons-dual-heading-wrapper .mas-addons-dual-heading-title .thard-heading ' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'mas_addons_dual_thard_heading_padding',
            [
                'label'      => __('Padding', 'mas-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .mas-addons-dual-heading .mas-addons-dual-heading-wrapper .mas-addons-dual-heading-title .thard-heading ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'mas_addons_dual_thard_heading_radius',
            [
                'label'      => __('Border radius', 'mas-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .mas-addons-dual-heading .mas-addons-dual-heading-wrapper .mas-addons-dual-heading-title .thard-heading ' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'mas_addons_dual_thard_heading_border',
                'selector' => '{{WRAPPER}} .mas-addons-dual-heading .mas-addons-dual-heading-wrapper .mas-addons-dual-heading-title .thard-heading '
            ]
        );
        $this->add_control(
			'show_title_third_strok',
			[
				'label' => __( 'Show Text Strok', 'mas-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'mas-addons' ),
				'label_off' => __( 'Hide', 'mas-addons' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

        $this->add_control(
			'show_title_third_strok_width',
			[
				'label' => __( 'Text Stroke Width', 'plugin-domain' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
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
                'condition' => [
                    'show_title_third_strok' => 'yes'
                ],
				'selectors' => [
					'{{WRAPPER}} .mas-addons-dual-heading .mas-addons-dual-heading-wrapper .mas-addons-dual-heading-title .thard-heading ' => '-webkit-text-stroke-width: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->add_control(
			'show_title_third_strok_color',
			[
				'label' => __( 'Text Stroke Color', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'show_title_second_strok' => 'yes'
                ],
				'selectors' => [
					'{{WRAPPER}} .mas-addons-dual-heading .mas-addons-dual-heading-wrapper .mas-addons-dual-heading-title .thard-heading ' => '-webkit-text-stroke-color: {{VALUE}}',
				],
			]
		);
        $this->add_control(
			'show_title_third_strok_fill_color',
			[
				'label' => __( 'Text Stroke Fill Color', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'show_title_third_strok' => 'yes'
                ],
				'selectors' => [
					'{{WRAPPER}} .mas-addons-dual-heading .mas-addons-dual-heading-wrapper .mas-addons-dual-heading-title .thard-heading ' => '-webkit-text-fill-color: {{VALUE}}',
				],
			]
		);
        $this->end_controls_section();

        /*
            * Dual Heading description Styling Section
        */
        $this->start_controls_section(
            'mas_addons_dual_heading_description_styles',
            [
                'label' => esc_html__( 'Sub Heading', 'mas-addons' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );


        $this->add_control(
            'mas_addons_dual_heading_description_text_color',
            [
                'label'     => esc_html__( 'Color', 'mas-addons' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#989B9E',
                'selectors' => [
                    '{{WRAPPER}} .mas-addons-dual-heading .mas-addons-dual-heading-wrapper p.mas-addons-dual-heading-description' => 'color: {{VALUE}};'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'            => 'mas_addons_dual_heading_description_typography',
                'fields_options'  => [
                    'font_weight' => [
                        'default' => '400'
                    ]
                ],
                'selector'        => '{{WRAPPER}} .mas-addons-dual-heading .mas-addons-dual-heading-wrapper p.mas-addons-dual-heading-description'
            ]
        );

        $this->add_responsive_control(
            'mas_addons_dual_heading_description_margin',
            [
                'label'      => __('Margin', 'mas-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .mas-addons-dual-heading .mas-addons-dual-heading-wrapper p.mas-addons-dual-heading-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'mas_addons_dual_heading_description_padding',
            [
                'label'      => __('Padding', 'mas-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .mas-addons-dual-heading .mas-addons-dual-heading-wrapper p.mas-addons-dual-heading-description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings          = $this->get_settings_for_display();

        $this->add_render_attribute( 'mas_addons_dual_first_heading', 'class', 'first-heading' );
        $this->add_inline_editing_attributes( 'mas_addons_dual_first_heading', 'none' );

        $this->add_render_attribute( 'mas_addons_dual_second_heading', 'class', 'second-heading' );
        $this->add_inline_editing_attributes( 'mas_addons_dual_second_heading', 'none' );

        $this->add_render_attribute( 'mas_addons_dual_thard_heading', 'class', 'thard-heading' );
        $this->add_inline_editing_attributes( 'mas_addons_dual_thard_heading', 'none' );

        $this->add_render_attribute( 'mas_addons_dual_heading_description', 'class', 'mas-addons-dual-heading-description' );
        $this->add_inline_editing_attributes( 'mas_addons_dual_heading_description' );

        if( $settings['mas_addons_dual_heading_title_link']['url'] ) {
            $this->add_render_attribute( 'mas_addons_dual_heading_title_link', 'href', esc_url( $settings['mas_addons_dual_heading_title_link']['url'] ) );
            if( $settings['mas_addons_dual_heading_title_link']['is_external'] ) {
                $this->add_render_attribute( 'mas_addons_dual_heading_title_link', 'target', '_blank' );
            }
            if( $settings['mas_addons_dual_heading_title_link']['nofollow'] ) {
                $this->add_render_attribute( 'mas_addons_dual_heading_title_link', 'rel', 'nofollow' );
            }
        }

        echo '<div class="mas-addons-dual-heading">';
            echo '<div class="mas-addons-dual-heading-wrapper">';

                if ( 'yes' === $settings['mas_addons_dual_heading_icon_show'] && !empty( $settings['mas_addons_dual_heading_icon']['value'] ) ) :
                    echo '<span class="mas-addons-dual-heading-icon">';
                        Icons_Manager::render_icon( $settings['mas_addons_dual_heading_icon'] );
                    echo '</span>';
                endif;

                echo '<h1 class="mas-addons-dual-heading-title">';
                    if( !empty( $settings['mas_addons_dual_heading_title_link']['url'] ) ) :
                        echo '<a '.$this->get_render_attribute_string( 'mas_addons_dual_heading_title_link' ).'>';
                    endif;
                    echo '<span '.$this->get_render_attribute_string( 'mas_addons_dual_first_heading' ).'>'.$settings['mas_addons_dual_first_heading'].'</span>';
                    echo '<span '.$this->get_render_attribute_string( 'mas_addons_dual_second_heading' ).'>'.$settings['mas_addons_dual_second_heading'].'</span>';
                    echo '<span '.$this->get_render_attribute_string( 'mas_addons_dual_thard_heading' ).'>'.$settings['mas_addons_dual_thard_heading'].'</span>';
                    if( !empty( $settings['mas_addons_dual_heading_title_link']['url'] ) ) {
                        echo '</a>';
                    }
                echo '</h1>';

                if ( !empty($settings['mas_addons_dual_heading_description'] ) ) :
                    echo '<p '.$this->get_render_attribute_string( 'mas_addons_dual_heading_description' ).'>'.wp_kses_post( $settings['mas_addons_dual_heading_description'] ).'</p>';
                endif;

            echo '</div>';
        echo '</div>';
    }
}
$widgets_manager->register( new \Mas_Addons\Widgets\Mas_Addons_Dual_Heading() );