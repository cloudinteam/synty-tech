<?php
namespace Mas_Addons\Widgets;

if ( ! defined( 'ABSPATH' ) ) exit;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;
use Mas\Elementor\Traits\Button_Markup;



class Mas_Creative_Button extends Widget_Base {

	 use Button_Markup;

    /**
     * Get widget name.
     */
    public function get_name() {
		return 'mas-creative-button';
	}
    /**
     * Get widget title.
     */
    public function get_title() {
        return __( 'Creative Button', 'mas-addons' );
    }

    /**
     * Get widget icon.
     */
    public function get_icon() {
		return 'eicon-download-button';
    }

    /**
     * Get widget category.
     */
    public function get_categories() {
		return [ 'mas-addons' ];
	}

    public function get_keywords() {
        return [ 'button', 'btn', 'advance', 'link', 'creative', 'creative-button', 'mas' ];
    }

	/**
     * Register widget content controls
     */
    protected function register_controls() {

        $this->start_controls_section(
            '_section_button',
            [
                'label' => __( 'Creative Button', 'mas-addons' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

		$this->add_control(
			'btn_style',
			[
				'label'   => __( 'Style', 'mas-addons' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'hermosa',
				'options' => [
					'hermosa'   => __( 'Hermosa', 'mas-addons' ),
					'montino'   => __( 'Montino', 'mas-addons' ),
					'iconica'   => __( 'Iconica', 'mas-addons' ),
					'symbolab'   => __( 'Symbolab', 'mas-addons' ),
					'estilo'   => __( 'Estilo', 'mas-addons' ),
				],
			]
		);

		$this->add_control(
			'estilo_effect',
			[
				'label'   => __( 'Effects', 'mas-addons' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'dissolve',
				'options' =>[
					'dissolve'   => __( 'Dissolve', 'mas-addons' ),
					'slide-down'   => __( 'Slide In Down', 'mas-addons' ),
					'slide-right'   => __( 'Slide In Right', 'mas-addons' ),
					'slide-x'   => __( 'Slide Out X', 'mas-addons' ),
					'cross-slider'   => __( 'Cross Slider', 'mas-addons' ),
					'slide-y'   => __( 'Slide Out Y', 'mas-addons' ),
				],
                'condition' => [
                    'btn_style' => 'estilo'
                ]
			]
		);

		$this->add_control(
			'symbolab_effect',
			[
				'label'   => __( 'Effects', 'mas-addons' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'back-in-right',
				'options' =>[
					'back-in-right'   => __( 'Back In Right', 'mas-addons' ),
					'back-in-left'   => __( 'Back In Left', 'mas-addons' ),
					'back-out-right'   => __( 'Back Out Right', 'mas-addons' ),
					'back-out-left'   => __( 'Back Out Left', 'mas-addons' ),
				],
                'condition' => [
                    'btn_style' => 'symbolab'
                ]
			]
		);

		$this->add_control(
			'iconica_effect',
			[
				'label'   => __( 'Effects', 'mas-addons' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'slide-in-down',
				'options' =>[
					'slide-in-down'   => __( 'Slide In Down', 'mas-addons' ),
					'slide-in-top'   => __( 'Slide In Top', 'mas-addons' ),
					'slide-in-right'   => __( 'Slide In Right', 'mas-addons' ),
					'slide-in-left'   => __( 'Slide In Left', 'mas-addons' ),
				],
                'condition' => [
                    'btn_style' => 'iconica'
                ]
			]
		);

		$this->add_control(
			'montino_effect',
			[
				'label'   => __( 'Effects', 'mas-addons' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'winona',
				'options' =>[
					'winona'   => __( 'Winona', 'mas-addons' ),
					'rayen'   => __( 'Rayen', 'mas-addons' ),
					'aylen'   => __( 'Aylen', 'mas-addons' ),
					'wapasha'   => __( 'Wapasha', 'mas-addons' ),
					'nina'   => __( 'Nina', 'mas-addons' ),
					'antiman'   => __( 'Antiman', 'mas-addons' ),
					'sacnite'   => __( 'Sacnite', 'mas-addons' ),
				],
                'condition' => [
                    'btn_style' => 'montino'
                ]
			]
		);

		$this->add_control(
			'hermosa_effect',
			[
				'label'   => __( 'Effects', 'mas-addons' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'exploit',
				'options' =>[
					'exploit'   => __( 'Exploit', 'mas-addons' ),
					'upward'   => __( 'Upward', 'mas-addons' ),
					'newbie'   => __( 'Newbie', 'mas-addons' ),
					'render'   => __( 'Render', 'mas-addons' ),
					'reshape'   => __( 'Reshape', 'mas-addons' ),
					'expandable'   => __( 'Expandable', 'mas-addons' ),
					'downhill'   => __( 'Downhill', 'mas-addons' ),
					'bloom'   => __( 'Bloom', 'mas-addons' ),
					'roundup'   => __( 'Roundup', 'mas-addons' ),
				],
                'condition' => [
                    'btn_style' => 'hermosa'
                ]
			]
		);

        $this->add_control(
            'button_text',
            [
                'label' => __( 'Text', 'mas-addons' ),
                'label_block'=> true,
                'type' => Controls_Manager::TEXT,
                'default' => 'Button Text',
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

		$this->add_control(
			'button_link',
			array(
				'label'         => __( 'Link', 'mas-addons' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => __( 'https://your-link.com', 'mas-addons' ),
				'show_external' => true,
				'default'       => array(
					'url'         => '#',
					'is_external' => false,
					'nofollow'    => true,
				),
			)
		);

		$this->add_control(
			'icon',
			[
				'label' => __( 'Icon', 'mas-addons' ),
				'description' => __( 'Please set an icon for the button.', 'mas-addons' ),
				'label_block' => false,
				'type' => Controls_Manager::ICONS,
				'skin' => 'inline',
				'exclude_inline_options' => [ 'svg' ],
				'default' => [
					'value' => 'fas fa-arrow-right',
					'library' => 'solid',
				],
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'relation' => 'or',
							'terms' => [
								[
									'name' => 'btn_style',
									'operator' => '==',
									'value' => 'symbolab',
								],
								[
									'name' => 'btn_style',
									'operator' => '==',
									'value' => 'iconica',
								],
							],
						],
						[
							'relation' => 'and',
							'terms' => [
								[
									'name' => 'btn_style',
									'operator' => '==',
									'value' => 'hermosa',
								],
								[
									'name' => 'hermosa_effect',
									'operator' => '==',
									'value' => 'expandable',
								],
							],
						]
					]
				],
			]
		);

        $this->add_responsive_control(
            'align_x',
            [
                'label' => __( 'Alignment', 'mas-addons' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'mas-addons' ),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'mas-addons' ),
                        'icon' => 'eicon-h-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'mas-addons' ),
                        'icon' => 'eicon-h-align-right',
                    ]
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .elementor-widget-container' => 'text-align: {{VALUE}};',
                ],
            ]
        );


		$this->add_control(
            'magnetic_enable',
            [
                'label'        => __('Magnetic Effect', 'mas-addons'),
                'type'         => Controls_Manager::SWITCHER,
                'label_block'  => false,
                'return_value' => 'yes',
				'separator' => 'before'
            ]
        );

		$this->add_control(
			'threshold',
			[
				'label' => __( 'Threshold', 'mas-addons'),
				'type' => Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 100,
				'step' => 1,
				'default' => 30,
				'condition' => [
                    'magnetic_enable' => 'yes'
				],
                'selectors' => [
                    '{{WRAPPER}} .mas-creative-btn' => 'margin: {{VALUE}}px;',
                ],
			]
		);

	$this->end_controls_section();




	/**
	 * Style section for Estilo, Symbolab, Iconica
	 *
	 * @return void
	 */

        $this->start_controls_section(
            '_estilo_symbolab_iconica_style_section',
            [
                'label' => __( 'Common', 'mas-addons' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
		);

		$this->add_responsive_control(
			'button_item_width',
			[
				'label' => __('Size', 'mas-addons'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .mas-creative-btn.mas-eft--downhill' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .mas-creative-btn.mas-eft--roundup' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .mas-creative-btn.mas-eft--roundup .progress' => 'width: calc({{SIZE}}{{UNIT}} - (({{SIZE}}{{UNIT}} / 100) * 20) ); height:auto;',
				],
                'conditions' => [
					'terms' => [
						[
							'relation' => 'or',
							'terms' => [
								[
									'name' => 'hermosa_effect',
									'operator' => '==',
									'value' => 'roundup',
								],
								[
									'name' => 'hermosa_effect',
									'operator' => '==',
									'value' => 'downhill',
								],
							],
						],
						[
							'terms' => [
								[
									'name' => 'btn_style',
									'operator' => '==',
									'value' => 'hermosa',
								],
							],
						]
					]
				]
			]
		);

		$this->add_responsive_control(
			'button_icon_size',
			[
				'label' => __('Icon Size', 'mas-addons'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 24,
				],
				'selectors' => [
					'{{WRAPPER}} .mas-creative-btn i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'relation' => 'or',
							'terms' => [
								[
									'name' => 'btn_style',
									'operator' => '==',
									'value' => 'symbolab',
								],
								[
									'name' => 'btn_style',
									'operator' => '==',
									'value' => 'iconica',
								],
							],
						],
						[
							'relation' => 'and',
							'terms' => [
								[
									'name' => 'btn_style',
									'operator' => '==',
									'value' => 'hermosa',
								],
								[
									'name' => 'hermosa_effect',
									'operator' => '==',
									'value' => 'expandable',
								],
							],
						]
					]
				],
			]
		);

		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'label' => __( 'Typography', 'mas-addons' ),
                'selector' => '{{WRAPPER}} .mas-creative-btn',
            ]
		);
		$this->add_responsive_control(
			'button_width',
			[
				'label' => __('Button Width', 'mas-addons'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
					'px' => [
						'min' => 0,
						'max' => 400,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .mas-creative-btn-wrap .mas-creative-btn' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'button_border',
				'exclude' => ['color'], //remove border color
                'selector' => '{{WRAPPER}} .mas-creative-btn, {{WRAPPER}} .mas-creative-btn.mas-eft--bloom div',
                'conditions' => [
					'terms' => [
						[
							'relation' => 'or',
							'terms' => [
								[
									'name' => 'hermosa_effect',
									'operator' => '!=',
									'value' => 'roundup',
								],
							],
						],
						[
							'terms' => [
								[
									'name' => 'btn_style',
									'operator' => '!=',
									'value' => '',
								],
							],
						]
					]
				]
            ]
        );

        $this->add_responsive_control(
            'button_border_radius',
            [
                'label' => __( 'Border Radius', 'mas-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .mas-creative-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .mas-creative-btn.mas-stl--hermosa.mas-eft--bloom div' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

		$this->add_responsive_control(
			'button_hermosa_roundup_stroke_width',
			[
				'label' => __('Stroke Width', 'mas-addons'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 10,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .mas-creative-btn.mas-eft--roundup' => '--ha-ctv-btn-stroke-width: {{SIZE}}{{UNIT}};',
				],
                'conditions' => [
					'terms' => [
						[
							'relation' => 'or',
							'terms' => [
								[
									'name' => 'hermosa_effect',
									'operator' => '==',
									'value' => 'roundup',
								],
							],
						],
						[
							'terms' => [
								[
									'name' => 'btn_style',
									'operator' => '==',
									'value' => 'hermosa',
								],
							],
						]
					]
				]
			]
		);


		$this->add_responsive_control(
            'button_padding',
            [
                'label' => __( 'Padding', 'mas-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .mas-creative-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                    '{{WRAPPER}} .mas-creative-btn.mas-stl--iconica > span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                    '{{WRAPPER}} .mas-creative-btn.mas-stl--montino.mas-eft--winona > span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .mas-creative-btn.mas-stl--montino.mas-eft--winona::after' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                    '{{WRAPPER}} .mas-creative-btn.mas-stl--montino.mas-eft--rayen > span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .mas-creative-btn.mas-stl--montino.mas-eft--rayen::before' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                    '{{WRAPPER}} .mas-creative-btn.mas-stl--montino.mas-eft--nina' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .mas-creative-btn.mas-stl--montino.mas-eft--nina::before' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                    '{{WRAPPER}} .mas-creative-btn.mas-stl--hermosa.mas-eft--bloom span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
				'separator' => 'before'
            ]
		);

		$conditions = [
			'terms' => [
				[
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'hermosa_effect',
							'operator' => '!=',
							'value' => 'roundup',
						],
					],
				],
				[
					'terms' => [
						[
							'name' => 'btn_style',
							'operator' => '!=',
							'value' => '',
						],
					],
				]
			]
		];
		$this->start_controls_tabs( '_tabs_button' );

        $this->start_controls_tab(
            '_tab_button_normal',
            [
                'label' => __( 'Normal', 'mas-addons' ),
            ]
		);

        $this->add_control(
            'button_text_color',
            [
                'label' => __( 'Text Color', 'mas-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mas-creative-btn-wrap .mas-creative-btn' => '--ha-ctv-btn-txt-clr: {{VALUE}}',
                ],
            ]
        );

		$this->add_control(
            'button_bg_color',
            [
                'label' => __( 'Background Color', 'mas-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mas-creative-btn-wrap .mas-creative-btn' => '--ha-ctv-btn-bg-clr: {{VALUE}}',
                ],
				'conditions' => $conditions,
            ]
        );

        $this->add_control(
            'button_border_color',
            [
                'label' => __( 'Border Color', 'mas-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mas-creative-btn-wrap .mas-creative-btn' => '--ha-ctv-btn-border-clr: {{VALUE}}',
                ],
                'conditions' => [
					'terms' => [
						[
							'relation' => 'or',
							'terms' => [
								[
									'name' => 'hermosa_effect',
									'operator' => '!=',
									'value' => 'roundup',
								],
							],
						],
						[
							'terms' => [
								[
									'name' => 'btn_style',
									'operator' => '!=',
									'value' => '',
								],
								[
									'name' => 'button_border_border',
									'operator' => '!=',
									'value' => '',
								],
							],
						]
					]
				]
            ]
        );

        $this->add_control(
            'button_roundup_circle_color',
            [
                'label' => __( 'Circle Color', 'mas-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mas-creative-btn-wrap .mas-creative-btn.mas-eft--roundup' => '--ha-ctv-btn-border-clr: {{VALUE}}',
                ],
                'conditions' => [
					'terms' => [
						[
							'relation' => 'or',
							'terms' => [
								[
									'name' => 'hermosa_effect',
									'operator' => '==',
									'value' => 'roundup',
								],
							],
						],
						[
							'terms' => [
								[
									'name' => 'btn_style',
									'operator' => '==',
									'value' => 'hermosa',
								],
							],
						]
					]
				]
            ]
        );

		$this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_box_shadow',
                'selector' => '{{WRAPPER}} .mas-creative-btn'
            ]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
            '_tabs_button_hover',
            [
                'label' => __( 'Hover', 'mas-addons' ),
            ]
		);

		$this->add_control(
            'button_hover_text_color',
            [
                'label' => __( 'Text Color', 'mas-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mas-creative-btn-wrap .mas-creative-btn' => '--ha-ctv-btn-txt-hvr-clr: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'button_hover_bg_color',
            [
                'label' => __( 'Background Color', 'mas-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mas-creative-btn-wrap .mas-creative-btn' => '--ha-ctv-btn-bg-hvr-clr: {{VALUE}}',
                ],
				'conditions' => $conditions,
            ]
        );

        $this->add_control(
            'button_hover_border_color',
            [
                'label' => __( 'Border Color', 'mas-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mas-creative-btn-wrap .mas-creative-btn:hover' => 'border-color: {{VALUE}}',
                ],
                // 'conditions' => [
				// 	'terms' => [
				// 		[
				// 			'relation' => 'or',
				// 			'terms' => [
				// 				[
				// 					'name' => 'hermosa_effect',
				// 					'operator' => '!=',
				// 					'value' => 'roundup',
				// 				],
				// 			],
				// 		],
				// 		[
				// 			'terms' => [
				// 				[
				// 					'name' => 'btn_style',
				// 					'operator' => '!=',
				// 					'value' => '',
				// 				],
				// 				[
				// 					'name' => 'button_border_border',
				// 					'operator' => '!=',
				// 					'value' => '',
				// 				],
				// 			],
				// 		]
				// 	]
				// ]
            ]
        );

        $this->add_control(
            'button_hover_roundup_circle_color',
            [
                'label' => __( 'Circle Color', 'mas-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mas-creative-btn-wrap .mas-creative-btn.mas-eft--roundup' => '--ha-ctv-btn-border-hvr-clr: {{VALUE}}',
                ],
                'conditions' => [
					'terms' => [
						[
							'relation' => 'or',
							'terms' => [
								[
									'name' => 'hermosa_effect',
									'operator' => '==',
									'value' => 'roundup',
								],
							],
						],
						[
							'terms' => [
								[
									'name' => 'btn_style',
									'operator' => '==',
									'value' => 'hermosa',
								],
							],
						]
					]
				]
            ]
        );

		$this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_hover_box_shadow',
                'selector' => '{{WRAPPER}} .mas-creative-btn:hover'
            ]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}

    protected function render() {
		$settings = $this->get_settings_for_display();
		$this->add_render_attribute( 'wrap', 'data-magnetic', $settings['magnetic_enable'] ? $settings['magnetic_enable'] : 'no' );
		$this->{'render_' . $settings['btn_style'] . '_markup'}($settings);

	}

}
$widgets_manager->register(new \Mas_Addons\Widgets\Mas_Creative_Button());