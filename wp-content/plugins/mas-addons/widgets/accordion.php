<?php
namespace Mas_Addons\Widgets;

if ( ! defined( 'ABSPATH' ) ) exit;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Css_Filter;
use \Elementor\Control_Media;
use \Elementor\Icons_Manager;
use \Elementor\Repeater;
use \Elementor\Widget_Base;

class mas_addons_accordion extends Widget_Base {

	public function get_name() {
		return 'mas-addons-accordion';
	}

	public function get_title() {
		return esc_html__( 'Accordion', 'mas-addons' );
	}

	public function get_icon() {
		return 'eicon-accordion';
	}


	public function get_keywords() {
		return [ 'acc', 'faq', 'accordion', 'tab' ];
	}

   public function get_categories() {
		return [ 'mas-addons' ];
	}

	protected function register_controls() {
		
  		/**
  		 * Fd Addons Accordion Content Settings
  		 */
  		$this->start_controls_section(
  			'mas_addons_section_exclusive_accordion_content_settings',
  			[
  				'label' => esc_html__( 'Contents', 'mas-addons' )
  			]
  		);

  		$repeater = new Repeater();

        $repeater->start_controls_tabs('mas_addons_accordion_item_tabs');

        $repeater->start_controls_tab('mas_addons_accordion_item_content_tab', ['label' => __('Content', 'mas-addons')]);

        $repeater->add_control(
			'mas_addons_exclusive_accordion_default_active', [
				'label'        => esc_html__( 'Active as Default', 'mas-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'return_value' => 'yes'
			]
		);

        $repeater->add_control(
			'mas_addons_exclusive_accordion_icon_show', [
				'label'        => esc_html__( 'Enable Title Icon', 'mas-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'	   => __( 'On', 'mas-addons' ),
				'label_off'    => __( 'Off', 'mas-addons' ),
				'default'      => 'no',
				'return_value' => 'yes'
			]
		);
		
		$repeater->add_control(
			'mas_addons_exclusive_accordion_title_icon',
			[
				'label'       => __( 'Icon', 'mas-addons' ),
				'type'        => Controls_Manager::ICONS,
				'label_block' => true,
				'default'     => [
					'value'   => 'far fa-user',
					'library' => 'fa-regular'
				],
				'condition'   => [
					'mas_addons_exclusive_accordion_icon_show' => 'yes'
				]
			]
		);

        $repeater->add_control(
			'mas_addons_exclusive_accordion_title', [
				'label'   => esc_html__( 'Title', 'mas-addons' ),
				'type'    => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__( 'Accordion Title', 'mas-addons' ),
				'dynamic' => [ 'active' => true ]
			]
		);
		
        $repeater->add_control(
			'mas_addons_exclusive_accordion_content', [
				'label'   => esc_html__( 'Content', 'mas-addons' ),
				'type'    => Controls_Manager::WYSIWYG,
				'default' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio, neque qui velit. Magni dolorum quidem ipsam eligendi, totam, facilis laudantium cum accusamus ullam voluptatibus commodi numquam, error, est. Ea, consequatur.', 'mas-addons' )
			]
		);

        $repeater->add_control(
            'mas_addons_accordion_show_read_more_btn',
            [
                'label'        => esc_html__( 'Enable Button.', 'mas-addons' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'	   => __( 'On', 'mas-addons' ),
				'label_off'    => __( 'Off', 'mas-addons' ),
                'default'      => 'no',
                'return_value' => 'yes',
                'separator'	   => 'before'
            ]
        );  

        $repeater->add_control(
            'mas_addons_accordion_read_more_btn_text',
            [   
				'label'       => esc_html__( 'Button Text', 'mas-addons' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__('See Details', 'mas-addons'),
				'default'     => esc_html__('See Details', 'mas-addons' ),
				'condition'   => [
                    '.mas_addons_accordion_show_read_more_btn' => 'yes'
                ]
            ]
        );

        $repeater->add_control(
            'mas_addons_accordion_read_more_btn_url',
            [   
                'label'         => esc_html__( 'Button Link', 'mas-addons' ),
                'type'          => Controls_Manager::URL,
                'default'       => [
                    'url'           => '#',
                    'is_external'   => ''
                ],
                'show_external'     => true,
                'placeholder'       => __( 'http://your-link.com', 'mas-addons' ),
                'condition'     => [
                    '.mas_addons_accordion_show_read_more_btn' => 'yes'
                ]
            ]
        );

        $repeater->end_controls_tab();

   		$repeater->start_controls_tab('mas_addons_accordion_item_image_tab', ['label' => __('Image', 'mas-addons')]);

        $repeater->add_control(
			'mas_addons_accordion_image', [
				'label' => esc_html__( 'Choose Image', 'mas-addons' ),
				'type'  => Controls_Manager::MEDIA
			]
		);

        $repeater->end_controls_tab();

   		$repeater->start_controls_tab('mas_addons_accordion_item_style_tab', ['label' => __('Style', 'mas-addons')]);

        $repeater->add_control(
            'mas_addons_accordion_each_item_container_style',
            [
				'label' => esc_html__( 'Container', 'mas-addons' ),
				'type'  => Controls_Manager::HEADING
            ]
        );

		$repeater->add_control(
		    'mas_addons_accordion_each_item_container_bg_color',
		    [
		        'label'     => __( 'Background Color', 'mas-addons' ),
		        'type'      => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} {{CURRENT_ITEM}}.mas-addons-accordion-single-item' => 'background-color: {{VALUE}};'
		        ]
		    ]
		);

		$repeater->add_control(
		    'mas_addons_accordion_number_color',
		    [
		        'label'     => __( 'Number Color', 'mas-addons' ),
		        'type'      => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} {{CURRENT_ITEM}}.mas-addons-accordion-single-item .mas-addons-accordion-number span' => 'color: {{VALUE}};'
		        ]
		    ]
		);

		$repeater->add_control(
		    'mas_addons_accordion_number_bg_color',
		    [
		        'label'     => __( 'Number Background Color', 'mas-addons' ),
		        'type'      => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} {{CURRENT_ITEM}}.mas-addons-accordion-single-item .mas-addons-accordion-number span' => 'background-color: {{VALUE}};'
		        ]
		    ]
		);

        $repeater->add_control(
            'mas_addons_accordion_each_item_title_style',
            [
				'label'     => esc_html__( 'Title', 'mas-addons' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before'
            ]
        );

		$repeater->add_control(
		    'mas_addons_accordion_each_item_title_color',
		    [
		        'label'     => __( 'Text Color', 'mas-addons' ),
		        'type'      => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} {{CURRENT_ITEM}}.mas-addons-accordion-single-item .mas-addons-accordion-title h3' => 'color: {{VALUE}};'
		        ]
		    ]
		);

		$repeater->add_control(
		    'mas_addons_accordion_each_item_title_bg_color',
		    [
		        'label'     => __( 'Background Color', 'mas-addons' ),
		        'type'      => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} {{CURRENT_ITEM}}.mas-addons-accordion-single-item .mas-addons-accordion-title' => 'background-color: {{VALUE}};'
		        ]
		    ]
		);

		$repeater->add_control(
		    'mas_addons_accordion_each_item_title_hover_color',
		    [
		        'label'     => __( 'Hover Color', 'mas-addons' ),
		        'type'      => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} {{CURRENT_ITEM}}.mas-addons-accordion-single-item .mas-addons-accordion-title:hover h3' => 'color: {{VALUE}};'
		        ]
		    ]
		);

		$repeater->add_control(
		    'mas_addons_accordion_each_item_title_hover_bg_color',
		    [
		        'label'     => __( 'Hover Background Color', 'mas-addons' ),
		        'type'      => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} {{CURRENT_ITEM}}.mas-addons-accordion-single-item .mas-addons-accordion-title:hover' => 'background-color: {{VALUE}};'
		        ]
		    ]
		);

        $repeater->add_control(
            'mas_addons_accordion_each_item_content_style',
            [
				'label'     => esc_html__( 'Content', 'mas-addons' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before'
            ]
        );

		$repeater->add_group_control(
		    Group_Control_Border::get_type(),
		    [
				'name'     => 'mas_addons_accordion_each_item_container_border',
				'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}.mas-addons-accordion-single-item'
		    ]
		);

        $repeater->end_controls_tab();

        $repeater->end_controls_tabs();

  		$this->add_control(
			'mas_addons_exclusive_accordion_tab',
			[
				'type' 		=> Controls_Manager::REPEATER,
				'fields' 	=> $repeater->get_controls(),
				'default'	=> [
					[ 
						'mas_addons_exclusive_accordion_title'          => esc_html__( 'Accordion Title 1', 'mas-addons' ),
						'mas_addons_exclusive_accordion_default_active' => 'yes'
					],
					[ 'mas_addons_exclusive_accordion_title' => esc_html__( 'Accordion Title 2', 'mas-addons' ) ],
					[ 'mas_addons_exclusive_accordion_title' => esc_html__( 'Accordion Title 3', 'mas-addons' ) ]
				],
				'title_field' => '{{mas_addons_exclusive_accordion_title}}'
			]
		);

        $this->add_control(
			'mas_addons_show_number',
			[
				'label'        => esc_html__( 'Show Number', 'mas-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

        $this->add_control(
			'mas_addons_exclusive_accordion_tab_title_show_active_inactive_icon',
			[
				'label'        => esc_html__( 'Show Active/Inactive Icon?', 'mas-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes',
				'separator'	   => 'before' 
			]
		);

		$this->add_control(
			'mas_addons_exclusive_accordion_tab_title_active_icon',
			[
				'label'       => __( 'Active Icon', 'mas-addons' ),
				'type'        => Controls_Manager::ICONS,
				'default'     => [
					'value'   => 'fas fa-angle-up',
					'library' => 'fa-solid'
				],
				'condition'   => [
					'mas_addons_exclusive_accordion_tab_title_show_active_inactive_icon' => 'yes'
				]
			]
		);

		$this->add_control(
			'mas_addons_exclusive_accordion_tab_title_inactive_icon',
			[
				'label'       => __( 'Inactive Icon', 'mas-addons' ),
				'type'        => Controls_Manager::ICONS,
				'default'     => [
					'value'   => 'fas fa-angle-down',
					'library' => 'fa-solid'
				],
				'condition'   => [
					'mas_addons_exclusive_accordion_tab_title_show_active_inactive_icon' => 'yes'
				]
			]
		);

  		$this->end_controls_section();

  		/**
		 * -------------------------------------------
		 * Tab Style Fd Addons Accordion Container Style
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'mas_addons_section_exclusive_accordions_container_style',
			[
				'label'	=> esc_html__( 'Container', 'mas-addons' ),
				'tab'	=> Controls_Manager::TAB_STYLE
			]
		);		
		$this->start_controls_tabs( 'mas_addons_accordion_active_inactive_container_tabs' );
		// normal state tab
		$this->start_controls_tab( 'mas_addons_accordion_container_style', [ 'label' => esc_html__( 'Normal', 'mas-addons' ) ] );

		$this->add_control(
			'mas_addons_accordion_container_background_color',
			[
				'label'		=> esc_html__( 'Background Color', 'mas-addons' ),
				'type'		=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mas-addons-accordion-items .mas-addons-accordion-single-item' => 'background-color: {{VALUE}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'mas_addons_accordion_container_box_shadow',
				'selector' => '{{WRAPPER}} .mas-addons-accordion-items .mas-addons-accordion-single-item'
			]
		);
		$this->add_group_control(
        	Group_Control_Border::get_type(),
            [
				'name'     => 'mas_addons_exclusive_accordion_container_border',
				'selector' => '{{WRAPPER}} .mas-addons-accordion-items .mas-addons-accordion-single-item'
            ]
		);

        $this->add_responsive_control(
            'mas_addons_exclusive_accordion_container_padding',
            [
				'label'      => __('Padding', 'mas-addons'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
                    '{{WRAPPER}} .mas-addons-accordion-items .mas-addons-accordion-single-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'mas_addons_exclusive_accordion_container_margin',
            [
				'label'        => __('Margin', 'mas-addons'),
				'type'         => Controls_Manager::DIMENSIONS,
				'size_units'   => ['px', '%'],
				'default'      => [
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '20',
					'left'     => '0',
					'isLinked' => false
				],
                'selectors'    => [
                    '{{WRAPPER}} .mas-addons-accordion-items .mas-addons-accordion-single-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

		$this->add_responsive_control(
            'mas_addons_exclusive_accordion_container_border_radius',
            [
				'label'      => __('Border Radius', 'mas-addons'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'default'    => [
					'top'    => '0',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0'
				],
                'selectors'  => [
                    '{{WRAPPER}} .mas-addons-accordion-items .mas-addons-accordion-single-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );
		$this->end_controls_tab();
		
		// hover state tab
		$this->start_controls_tab( 'mas_addons_accordion_container_style_hover', [ 'label' => esc_html__( 'Active', 'mas-addons' ) ] );

		$this->add_control(
			'mas_addons_accordion_container_background_color_active',
			[
				'label'		=> esc_html__( 'Background Color', 'mas-addons' ),
				'type'		=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mas-addons-accordion-items .mas-addons-accordion-single-item.wraper-active' => 'background-color: {{VALUE}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'mas_addons_accordion_container_box_shadow_active',
				'selector' => '{{WRAPPER}} .mas-addons-accordion-items .mas-addons-accordion-single-item.wraper-active'
			]
		);
		$this->add_group_control(
        	Group_Control_Border::get_type(),
            [
				'name'     => 'mas_addons_exclusive_accordion_container_border_active',
				'selector' => '{{WRAPPER}} .mas-addons-accordion-items .mas-addons-accordion-single-item.wraper-active'
            ]
		);
		$this->add_responsive_control(
            'mas_addons_exclusive_accordion_container_border_radius_active',
            [
				'label'      => __('Border Radius', 'mas-addons'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .mas-addons-accordion-items .mas-addons-accordion-single-item.wraper-active' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

		$this->add_responsive_control(
            'mas_addons_exclusive_accordion_container_margin_active',
            [
				'label'      => __('Margin', 'mas-addons'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .mas-addons-accordion-items .mas-addons-accordion-single-item.wraper-active' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

		$this->add_responsive_control(
            'mas_addons_exclusive_accordion_container_padding_active',
            [
				'label'      => __('Padding', 'mas-addons'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .mas-addons-accordion-items .mas-addons-accordion-single-item.wraper-active' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'mas_addons_acc_number',
			[
				'label' => esc_html__( 'Nmber', 'mas-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'            => 'mas_addons_number_typography',
				'selector'        => '{{WRAPPER}} .mas-addons-accordion-number span',
				'fields_options'  => [
					'font_weight' => [
						'default' => '600',
					]
				]
			]
		);
		$this->add_responsive_control(
			'mas_addons_number_size',
			[
				'label'        => __( 'Size', 'mas-addons' ),
				'type'         => Controls_Manager::SLIDER,
				'range'        => [
					'px'       => [
						'min'  => 0,
						'max'  => 150,
						'step' => 1
					]
				],
				'selectors'    => [
					'{{WRAPPER}} .mas-addons-accordion-number span' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};'
				]
			]
		);   
		$this->add_responsive_control(
			'mas_addons_number_border_radius',
			[
				'label'      => __('Border Radius', 'mas-addons'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .mas-addons-accordion-number span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->add_responsive_control(
			'mas_addons_number_margin',
			[
				'label'      => __('Margin', 'mas-addons'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .mas-addons-accordion-number span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->add_responsive_control(
			'mas_addons_number_padding',
			[
				'label'      => __('Padding', 'mas-addons'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .mas-addons-accordion-number span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->end_controls_section();


		$this->start_controls_section(
			'mas_addons_section_exclusive_accordions_tab_style',
			[
				'label' => esc_html__( 'Title', 'mas-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);


		$this->start_controls_tabs( 'mas_addons_exclusive_accordion_header_tabs' );

			# Normal State Tab
			$this->start_controls_tab( 'mas_addons_exclusive_accordion_header_normal', [ 'label' => esc_html__( 'Normal', 'mas-addons' ) ] );
				
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'            => 'mas_addons_exclusive_accordion_title_typography',
					'selector'        => '{{WRAPPER}} .mas-addons-accordion-single-item h3',
					'fields_options'  => [
						'font_weight' => [
							'default' => '600'
						]
					]
				]
			);
	
			$this->add_control(
					'mas_addons_exclusive_accordion_tab_text_color',
					[
						'label'		=> esc_html__( 'Text Color', 'mas-addons' ),
						'type'		=> Controls_Manager::COLOR,
						'default'	=> '#000000',
						'selectors'	=> [
							'{{WRAPPER}} .mas-addons-accordion-items .mas-addons-accordion-single-item h3' => 'color: {{VALUE}};'
						]
					]
				);

				$this->add_control(
					'mas_addons_exclusive_accordion_tab_color',
					[
						'label'     => esc_html__( 'Background Color', 'mas-addons' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .mas-addons-accordion-items .mas-addons-accordion-single-item .mas-addons-accordion-title' => 'background-color: {{VALUE}};'
						]
					]
				);
				
				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name'               => 'mas_addons_exclusive_accordion_title_border',
						'fields_options'     => [
							'border' 	     => [
								'default'    => 'solid'
							],
							'width'  	     => [
								'default' 	 => [
									'top'    => '1',
									'right'  => '1',
									'bottom' => '1',
									'left'   => '1'
								]
							],
							'color' 	     => [
								'default'    => '#000000'
							]
						],
						'selector'           => '{{WRAPPER}} .mas-addons-accordion-items .mas-addons-accordion-single-item .mas-addons-accordion-title'
					]
				);
				
				$this->add_group_control(
					Group_Control_Box_Shadow::get_type(),
					[
						'name'     => 'mas_addons_accordion_title_box_shadow',
						'selector' => '{{WRAPPER}} .mas-addons-accordion-items .mas-addons-accordion-single-item .mas-addons-accordion-title'
					]
				);
		
				$this->add_responsive_control(
					'mas_addons_exclusive_accordion_title_padding',
					[
						'label'      => __('Padding', 'mas-addons'),
						'type'       => Controls_Manager::DIMENSIONS,
						'size_units' => ['px', '%'],
						'default'    => [
							'top'    => '20',
							'right'  => '20',
							'bottom' => '20',
							'left'   => '20'
						],
						'selectors'  => [
							'{{WRAPPER}} .mas-addons-accordion-items .mas-addons-accordion-single-item h3' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
						]
					]
				);
		
				$this->add_responsive_control(
					'mas_addons_exclusive_accordion_title_margin',
					[
						'label'      => __('Margin', 'mas-addons'),
						'type'       => Controls_Manager::DIMENSIONS,
						'size_units' => ['px', '%'],
						'default'    => [
							'top'    => '0',
							'right'  => '0',
							'bottom' => '0',
							'left'   => '0'
						],
						'selectors'  => [
							'{{WRAPPER}} .mas-addons-accordion-items .mas-addons-accordion-single-item .mas-addons-accordion-title h3' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
						]
					]
				);
		
				$this->add_responsive_control(
					'mas_addons_accordion_title_border_radius',
					[
						'label'      => esc_html__( 'Border Radius', 'mas-addons' ),
						'type'       => Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px'],
						'selectors'  => [
							'{{WRAPPER}} .mas-addons-accordion-items .mas-addons-accordion-single-item .mas-addons-accordion-title'=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
						]
					]
				);
			$this->end_controls_tab();

			#Hover State Tab
			$this->start_controls_tab( 'mas_addons_exclusive_accordion_header_hover', [ 'label' => esc_html__( 'Hover', 'mas-addons' ) ] );
				$this->add_control(
					'mas_addons_exclusive_accordion_tab_text_color_hover',
					[
						'label'		=> esc_html__( 'Text Color', 'mas-addons' ),
						'type'		=> Controls_Manager::COLOR,
						'selectors'	=> [
							'{{WRAPPER}} .mas-addons-accordion-items .mas-addons-accordion-single-item .mas-addons-accordion-title:hover h3' => 'color: {{VALUE}};',
							'{{WRAPPER}} .mas-addons-accordion-items .mas-addons-accordion-single-item .mas-addons-accordion-title.active:hover h3' => 'color: {{VALUE}};'
						]
					]
				);

				$this->add_control(
					'mas_addons_exclusive_accordion_tab_color_bg_hover',
					[
						'label'		=> esc_html__( 'Background Color', 'mas-addons' ),
						'type'		=> Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .mas-addons-accordion-items .mas-addons-accordion-single-item .mas-addons-accordion-title:hover' => 'background-color: {{VALUE}};'
						]
					]
				);

			$this->end_controls_tab();

			#Active State Tab
			$this->start_controls_tab( 'mas_addons_exclusive_accordion_header_active', [ 'label' => esc_html__( 'Active', 'mas-addons' ) ] );
				$this->add_control(
					'mas_addons_exclusive_accordion_tab_text_color_active',
					[
						'label'		=> esc_html__( 'Text Color', 'mas-addons' ),
						'type'		=> Controls_Manager::COLOR,
						'selectors'	=> [
							'{{WRAPPER}} .mas-addons-accordion-items .mas-addons-accordion-single-item .mas-addons-accordion-title.active h3' => 'color: {{VALUE}} !important;'
						]
					]
				);

				$this->add_control(
					'mas_addons_exclusive_accordion_tab_color_bg_active',
					[
						'label'		=> esc_html__( 'Background Color', 'mas-addons' ),
						'type'		=> Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .mas-addons-accordion-items .mas-addons-accordion-single-item .mas-addons-accordion-title.active' => 'background-color: {{VALUE}};'
						]
					]
				);

			$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		
		/**
		 * -------------------------------------------
		 * Icon Style
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'mas_addons_accordion_tab_title_icon_style',
			[
				'label'	=> esc_html__( 'Title Icon', 'mas-addons' ),
				'tab'	=> Controls_Manager::TAB_STYLE
			]
		);

        $this->start_controls_tabs( 'mas_addons_accordion_title_icon_style_tabs' );

        	// normal state tab
        	$this->start_controls_tab( 'mas_addons_accordion_title_icon_general_style', [ 'label' => esc_html__( 'Normal', 'mas-addons' ) ] );

			$this->add_control(
				'mas_addons_accordion_tab_title_icon_color',
				[
					'label'		=> esc_html__( 'Color', 'mas-addons' ),
					'type'		=> Controls_Manager::COLOR,
					'selectors'	=> [
						'{{WRAPPER}} .mas-addons-accordion-items .mas-addons-accordion-single-item .mas-addons-accordion-title span.mas-addons-tab-title-icon' => 'color: {{VALUE}};'
					]
				]
			);

			$this->add_control(
				'mas_addons_accordion_tab_title_icon_bg_color',
				[
					'label'		=> esc_html__( 'Background Color', 'mas-addons' ),
					'type'		=> Controls_Manager::COLOR,
					'selectors'	=> [
						'{{WRAPPER}} .mas-addons-accordion-items .mas-addons-accordion-single-item .mas-addons-accordion-title span.mas-addons-tab-title-icon' => 'background-color: {{VALUE}};'
					]
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'     => 'mas_addons_accordion_title_icon_border',
					'selector' => '{{WRAPPER}} .mas-addons-accordion-items .mas-addons-accordion-single-item .mas-addons-accordion-title span.mas-addons-tab-title-icon'
				]
			);
	
			$this->add_responsive_control(
				'mas_addons_accordion_title_icon_size',
				[
					'label'        => __( 'Size', 'mas-addons' ),
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
						'size'     => 20
					],
					'selectors'    => [
						'{{WRAPPER}} .mas-addons-accordion-items .mas-addons-accordion-single-item .mas-addons-accordion-title span.mas-addons-tab-title-icon i' => 'font-size: {{SIZE}}{{UNIT}};'
					]
				]
			);   
	
			$this->add_responsive_control(
				  'mas_addons_accordion_title_icon_width',
				  [
					'label'    => esc_html__( 'Width', 'mas-addons' ),
					'type'     => Controls_Manager::SLIDER,
					'default'  => [
						  'size' => 70
					],
					'range'    => [
						  'px'   => [
							  'max' => 100
						  ]
					],
					'selectors' => [
						  '{{WRAPPER}} .mas-addons-accordion-items .mas-addons-accordion-single-item .mas-addons-accordion-title span.mas-addons-tab-title-icon' => 'width: {{SIZE}}px;'
					]
				  ]
			);
	
		
			$this->add_responsive_control(
				'mas_addons_accordion_title_icon_padding',
				[
					'label'      => __('Padding', 'mas-addons'),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => ['px', '%'],
					'selectors'  => [
						'{{WRAPPER}} .mas-addons-accordion-items .mas-addons-accordion-single-item .mas-addons-accordion-title span.mas-addons-tab-title-icon i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
					]
				]
			);
	
			$this->add_responsive_control(
				'mas_addons_accordion_title_icon_margin',
				[
					'label'      => __('Margin', 'mas-addons'),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => ['px', '%'],
					'selectors'  => [
						'{{WRAPPER}} .mas-addons-accordion-items .mas-addons-accordion-single-item .mas-addons-accordion-title span.mas-addons-tab-title-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
					]
				]
			);

			$this->end_controls_tab();

			// active state tab
        	$this->start_controls_tab( 'mas_addons_accordion_title_icon_active_style', [ 'label' => esc_html__( 'Active', 'mas-addons' ) ] );

			$this->add_control(
				'mas_addons_accordion_title_icon_active_color',
				[
					'label'		=> esc_html__( 'Color', 'mas-addons' ),
					'type'		=> Controls_Manager::COLOR,
					'selectors'	=> [
						'{{WRAPPER}} .mas-addons-accordion-items .mas-addons-accordion-single-item .mas-addons-accordion-title.active span.mas-addons-tab-title-icon i' => 'color: {{VALUE}};'
					]
				]
			);

			$this->add_control(
				'mas_addons_accordion_title_icon_active_bg_color',
				[
					'label'		=> esc_html__( 'Background Color', 'mas-addons' ),
					'type'		=> Controls_Manager::COLOR,
					'selectors'	=> [
						'{{WRAPPER}} .mas-addons-accordion-items .mas-addons-accordion-single-item .mas-addons-accordion-title.active span.mas-addons-tab-title-icon' => 'background-color: {{VALUE}};'
					]
				]
			);

			$this->end_controls_tab();
		$this->end_controls_tabs();


		$this->end_controls_section();

		$this->start_controls_section(
			'mas_addons_accordion_active_inactive_icon_style',
			[
				'label'     => esc_html__( 'Active/Inactive Icon', 'mas-addons' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'mas_addons_exclusive_accordion_tab_title_show_active_inactive_icon' => 'yes'
				]
			]
		);

	    

        $this->start_controls_tabs( 'mas_addons_accordion_active_inactive_icon_style_tabs' );

        	// normal state tab
        	$this->start_controls_tab( 'mas_addons_accordion_general_style', [ 'label' => esc_html__( 'Normal', 'mas-addons' ) ] );

				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name'     => 'mas_addons_accordion_active_inactive_icon_border',
						'selector' => '{{WRAPPER}} .mas-addons-accordion-items .mas-addons-accordion-single-item .mas-addons-accordion-title .mas-addons-active-inactive-icon'
					]
				);

				$this->add_control(
					'mas_addons_accordion_general_icon_color',
					[
						'label'		=> esc_html__( 'Color', 'mas-addons' ),
						'type'		=> Controls_Manager::COLOR,
						'default'	=> '#000000',
						'selectors'	=> [
							'{{WRAPPER}} .mas-addons-accordion-items .mas-addons-accordion-single-item .mas-addons-accordion-title .mas-addons-active-inactive-icon i' => 'color: {{VALUE}};',
							'{{WRAPPER}} .mas-addons-accordion-items .mas-addons-accordion-single-item .mas-addons-accordion-title .mas-addons-active-inactive-icon svg' => 'color: {{VALUE}};',
							'{{WRAPPER}} .mas-addons-accordion-items .mas-addons-accordion-single-item .mas-addons-accordion-title .mas-addons-active-inactive-icon svg path' => 'fill: {{VALUE}};',
							
						]
					]
				);

				$this->add_control(
					'mas_addons_accordion_general_icon_bg_color',
					[
						'label'		=> esc_html__( 'Background Color', 'mas-addons' ),
						'type'		=> Controls_Manager::COLOR,
						'selectors'	=> [
							'{{WRAPPER}} .mas-addons-accordion-items .mas-addons-accordion-single-item .mas-addons-accordion-title .mas-addons-active-inactive-icon' => 'background-color: {{VALUE}};'
						]
					]
				);
				$this->add_responsive_control(
				'mas_addons_accordion_active_inactive_icon_size',
				[
					'label'        => esc_html__( 'Size', 'mas-addons' ),
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
						'size'     => 20
					],
					'selectors'    => [
						'{{WRAPPER}}  .mas-addons-accordion-items .mas-addons-accordion-single-item .mas-addons-accordion-title .mas-addons-active-inactive-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}}  .mas-addons-accordion-items .mas-addons-accordion-single-item .mas-addons-accordion-title .mas-addons-active-inactive-icon svg' => 'width: {{SIZE}}{{UNIT}};',
					]
				]
			);

			$this->add_responsive_control(
				'mas_addons_accordion_active_inactive_icon_width',
				[
					'label'       => esc_html__( 'Width', 'mas-addons' ),
					'type'        => Controls_Manager::SLIDER,
					'default'     => [
						'size'    => 70
					],
					'range'       => [
						'px'      => [
							'max' => 100
						]
					],
					'selectors'   => [
						'{{WRAPPER}} .mas-addons-accordion-items .mas-addons-accordion-single-item .mas-addons-accordion-title .mas-addons-active-inactive-icon' => 'width: {{SIZE}}px;'
					]
				]
			);

       
			$this->end_controls_tab();

			// active state tab
        	$this->start_controls_tab( 'mas_addons_accordion_active_style', [ 'label' => esc_html__( 'Active', 'mas-addons' ) ] );

			$this->add_control(
				'mas_addons_accordion_active_icon_color',
				[
					'label'		=> esc_html__( 'Color', 'mas-addons' ),
					'type'		=> Controls_Manager::COLOR,
					'default'	=> '#000000',
					'selectors'	=> [
						'{{WRAPPER}} .mas-addons-accordion-items .mas-addons-accordion-single-item .mas-addons-accordion-title.active .mas-addons-active-inactive-icon i' => 'color: {{VALUE}};',
						'{{WRAPPER}} .mas-addons-accordion-items .mas-addons-accordion-single-item .mas-addons-accordion-title.active .mas-addons-active-inactive-icon svg' => 'color: {{VALUE}};',
						'{{WRAPPER}} .mas-addons-accordion-items .mas-addons-accordion-single-item .mas-addons-accordion-title.active .mas-addons-active-inactive-icon svg path' => 'fill: {{VALUE}};'
					]
				]
			);

			$this->add_control(
				'mas_addons_accordion_active_icon_bg_color',
				[
					'label'		=> esc_html__( 'Background Color', 'mas-addons' ),
					'type'		=> Controls_Manager::COLOR,
					'selectors'	=> [
						'{{WRAPPER}} .mas-addons-accordion-items .mas-addons-accordion-single-item .mas-addons-accordion-title.active .mas-addons-active-inactive-icon' => 'background-color: {{VALUE}};'
					]
				]
			);

			$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
		
  		/**
		 * -------------------------------------------
		 * Tab Style Fd Addons Accordion Content Style
		 * -------------------------------------------
		 */

		$this->start_controls_section(
			'mas_addons_section_accordion_tab_content_style_settings',
			[
				'label'	=> esc_html__( 'Content', 'mas-addons' ),
				'tab'	=> Controls_Manager::TAB_STYLE
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'mas_addons_exclusive_accordion_content_typography',
				'selector' => '{{WRAPPER}} .mas-addons-accordion-single-item .mas-addons-accordion-text'
			]
		);

		$this->add_control(
			'mas_addons_accordion_content_bg_color',
			[
				'label'		=> esc_html__( 'Background Color', 'mas-addons' ),
				'type'		=> Controls_Manager::COLOR,
				'default'	=> '',
				'selectors'	=> [
					'{{WRAPPER}} .mas-addons-accordion-items .mas-addons-accordion-single-item .mas-addons-accordion-content .mas-addons-accordion-content-wrapper' => 'background-color: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'mas_addons_accordion_content_text_color',
			[
				'label'		=> esc_html__( 'Text Color', 'mas-addons' ),
				'type'		=> Controls_Manager::COLOR,
				'default'	=> '#000000',
				'selectors' => [
					'{{WRAPPER}} .mas-addons-accordion-single-item .mas-addons-accordion-text' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_group_control(
        	Group_Control_Border::get_type(),
            [
				'name'                 => 'mas_addons_exclusive_accordion_content_border',
				'fields_options'       => [
                    'border' 	       => [
                        'default'      => 'solid'
                    ],
                    'width'  		   => [
                        'default' 	   => [
							'top'      => '0',
							'right'    => '1',
							'bottom'   => '1',
							'left'     => '1',
							'isLinked' => false
                        ]
                    ],
                    'color' 		   => [
                        'default' 	   => '#000000'
                    ]
                ],
                'selector'             => '{{WRAPPER}} .mas-addons-accordion-items .mas-addons-accordion-single-item .mas-addons-accordion-content .mas-addons-accordion-content-wrapper'
            ]
		);
        $this->add_responsive_control(
            'mas_addons_accordion_content_padding',
            [
				'label'      => __('Padding', 'mas-addons'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'default'    => [
					'top'    => '20',
					'right'  => '20',
					'bottom' => '20',
					'left'   => '20'
				],
                'selectors'  => [
                    '{{WRAPPER}} .mas-addons-accordion-items .mas-addons-accordion-single-item .mas-addons-accordion-content .mas-addons-accordion-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'mas_addons_accordion_content_margin',
            [
				'label'      => __('Margin', 'mas-addons'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'default'    => [
					'top'    => '0',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0'
				],
                'selectors'  => [
                    '{{WRAPPER}} .mas-addons-accordion-single-item .mas-addons-accordion-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );
		
		$this->add_responsive_control(
            'mas_addons_accordion_content_border_radius',
            [
				'label'      => __('Border Radius', 'mas-addons'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'default'    => [
					'top'    => '0',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0'
				],
                'selectors'  => [
                    '{{WRAPPER}} .mas-addons-accordion-items .mas-addons-accordion-single-item .mas-addons-accordion-content .mas-addons-accordion-content-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

  		$this->end_controls_section();

		$this->start_controls_section(
			'mas_addons_section_accordion_tab_image_style',
			[
				'label'	=> esc_html__( 'Image', 'mas-addons' ),
				'tab'	=> Controls_Manager::TAB_STYLE

			]
		);

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
				'name'    => 'mas_addons_accordion_image_size',
				'label'   => esc_html__( 'Image Type', 'mas-addons' ),
				'default' => 'medium'
            ]
        );

        $this->add_control(
            'mas_addons_accordion_image_align',
            [
                'label'         => esc_html__( 'Image Position', 'mas-addons' ),
                'type'          => Controls_Manager::CHOOSE,
                'toggle'        => false,
                'options'       => [
                    'left'      => [
                        'title' => esc_html__( 'Left', 'mas-addons' ),
                        'icon'  => 'eicon-angle-left'
                    ],
                    'right'     => [
                        'title' => esc_html__( 'Right', 'mas-addons' ),
                        'icon'  => 'eicon-angle-right'
                    ]
                ],
                'default'       => 'right'
            ]
        );

        $this->add_responsive_control(
            'mas_addons_accordion_image_padding',
            [
				'label'      => __('Padding', 'mas-addons'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'default'    => [
                    'top'    => '20',
                    'right'  => '20',
                    'bottom' => '20',
                    'left'   => '20'
                ],
                'selectors'  => [
                    '{{WRAPPER}} .mas-addons-accordion-items .mas-addons-accordion-single-item .mas-addons-accordion-image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'mas_addons_accordion_image_margin',
            [
				'label'      => __('Margin', 'mas-addons'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
                    '{{WRAPPER}} .mas-addons-accordion-items .mas-addons-accordion-single-item .mas-addons-accordion-image' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
		);

  		$this->end_controls_section();

		$this->start_controls_section(
            'mas_addons_accordion_details_btn_style_section',
            [
				'label' => esc_html__( 'Button', 'mas-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->start_controls_tabs( 'mas_addons_accordion_details_button_style_tabs' );

            // normal state tab
            $this->start_controls_tab( 'mas_addons_accordion_details_btn_normal', [ 'label' => esc_html__( 'Normal', 'mas-addons' ) ] );
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'     => 'mas_addons_accordion_details_btn_typography',
					'selector' => '{{WRAPPER}} .mas-addons-accordion-items .mas-addons-accordion-single-item .mas-addons-accordion-button a'
				]
			);

            $this->add_control(
                'mas_addons_accordion_details_btn_normal_text_color',
                [
                    'label'     => esc_html__( 'Text Color', 'mas-addons' ),
                    'type'      => Controls_Manager::COLOR,
                    'default'   => '#ffffff',
                    'selectors' => [
                        '{{WRAPPER}} .mas-addons-accordion-items .mas-addons-accordion-single-item .mas-addons-accordion-button a' => 'color: {{VALUE}};'
                    ]
                ]
            );

            $this->add_control(
                'mas_addons_accordion_details_btn_normal_bg_color',
                [
                    'label'     => esc_html__( 'Background Color', 'mas-addons' ),
                    'type'      => Controls_Manager::COLOR,
                    'default'   => '#000000',
                    'selectors' => [
                        '{{WRAPPER}} .mas-addons-accordion-items .mas-addons-accordion-single-item .mas-addons-accordion-button a' => 'background-color: {{VALUE}};'
                    ]
                ]
            );
			$this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name'      => 'mas_addons_accordion_details_button_shadow',
                    'selector'  => '{{WRAPPER}} .mas-addons-accordion-items .mas-addons-accordion-single-item .mas-addons-accordion-button a'
                ]
            );

            $this->add_group_control(
            	Group_Control_Border::get_type(),
                [
					'name'               => 'mas_addons_accordion_details_btn_border',
					'fields_options'     => [
	                    'border' 	     => [
	                        'default'    => 'solid'
	                    ],
	                    'width'  	     => [
	                        'default'    => [
	                            'top'    => '1',
	                            'right'  => '1',
	                            'bottom' => '1',
	                            'left'   => '1'
	                        ]
	                    ],
	                    'color' 	     => [
	                        'default'    => '#000000'
	                    ]
	                ],
                    'selector'           => '{{WRAPPER}} .mas-addons-accordion-items .mas-addons-accordion-single-item .mas-addons-accordion-button a'
                ]
            );
			
			$this->add_responsive_control(
				'mas_addons_accordion_details_btn_padding',
				[
					'label'      => esc_html__( 'Padding', 'mas-addons' ),
					'type'       => Controls_Manager::DIMENSIONS,           
					'size_units' => [ 'px', 'em', '%' ],
					'default'    => [
						'top'    => '15',
						'right'  => '40',
						'bottom' => '15',
						'left'   => '40'
					],
					'selectors'  => [
						'{{WRAPPER}} .mas-addons-accordion-items .mas-addons-accordion-single-item .mas-addons-accordion-button a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
					]
				]
			);
	
			$this->add_responsive_control(
				'mas_addons_accordion_details_btn_margin',
				[
					'label'      => esc_html__( 'Margin', 'mas-addons' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],   
					'default'    => [
						'top'    => '30',
						'right'  => '0',
						'bottom' => '0',
						'left'   => '0'
					],              
					'selectors'  => [
						'{{WRAPPER}} .mas-addons-accordion-items .mas-addons-accordion-single-item .mas-addons-accordion-button a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
					]
				]
			);
			$this->add_responsive_control(
				'mas_addons_accordion_details_button_border_radius',
				[
					'label'      => esc_html__( 'Border Radius', 'mas-addons' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px'],
					'selectors'  => [
						'{{WRAPPER}} .mas-addons-accordion-items .mas-addons-accordion-single-item .mas-addons-accordion-button a'=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
					]
				]
			);

            

            $this->end_controls_tab();

            // hover state tab
            $this->start_controls_tab( 'mas_addons_accordion_details_btn_hover', [ 'label' => esc_html__( 'Hover', 'mas-addons' ) ] );

            $this->add_control(
                'mas_addons_accordion_details_btn_hover_text_color',
                [
                    'label'     => esc_html__( 'Text Color', 'mas-addons' ),
                    'type'      => Controls_Manager::COLOR,
                    'default'   => '#000000',
                    'selectors' => [
                        '{{WRAPPER}} .mas-addons-accordion-items .mas-addons-accordion-single-item .mas-addons-accordion-button a:hover' => 'color: {{VALUE}};'
                    ]
                ]
            );

            $this->add_control(
                'mas_addons_accordion_details_btn_hover_bg_color',
                [
                    'label'     => esc_html__( 'Background Color', 'mas-addons' ),
                    'type'      => Controls_Manager::COLOR,
                    'default'   => '#ffffff',
                    'selectors' => [
                        '{{WRAPPER}} .mas-addons-accordion-items .mas-addons-accordion-single-item .mas-addons-accordion-button a:hover' => 'background-color: {{VALUE}};'
                    ]
                ]
            );

			$this->add_group_control(
            	Group_Control_Border::get_type(),
                [
					'name'     => 'mas_addons_accordion_details_btn_hover_border',
					'selector' => '{{WRAPPER}} .mas-addons-accordion-items .mas-addons-accordion-single-item .mas-addons-accordion-button a:hover'
                ]
            );

			$this->add_responsive_control(
				'mas_addons_accordion_details_button_border_radius_hover',
				[
					'label'      => esc_html__( 'Border Radius', 'mas-addons' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px'],
					'selectors'  => [
						'{{WRAPPER}} .mas-addons-accordion-items .mas-addons-accordion-single-item .mas-addons-accordion-button a:hover'=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
					]
				]
			);

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name'      => 'mas_addons_accordion_details_button_hover_shadow',
                    'selector'  => '{{WRAPPER}} .mas-addons-accordion-items .mas-addons-accordion-single-item .mas-addons-accordion-button a:hover'
                ]
            );

            $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();  		

	}

    private function render_image( $accordion, $settings ) {
        $image_id   = $accordion['mas_addons_accordion_image']['id'];
        $image_size = $settings['mas_addons_accordion_image_size_size'];
        if ( 'custom' === $image_size ) {
            $image_src = Group_Control_Image_Size::get_attachment_image_src( $image_id, 'mas_addons_accordion_image_size', $settings );
        } else {
            $image_src = wp_get_attachment_image_src( $image_id, $image_size );
            $image_src = $image_src[0];
        }

        return sprintf( '<img src="%s" alt="'.Control_Media::get_image_alt( $accordion['mas_addons_accordion_image'] ).'" />', esc_url($image_src) );
    }

	protected function render() {

        $settings   = $this->get_settings_for_display();
        
        $this->add_render_attribute( 'mas_addons_accordion_heading', 'class', 'mas-addons-accordion-heading' );
        $this->add_render_attribute( 'mas_addons_accordion_details', 'class', 'mas-addons-accordion-text' );
        $this->add_render_attribute( 'mas_addons_accordion_button', 'class', 'mas-addons-accordion-button' );

		$i = 1;
        echo '<div class="mas-addons-accordion-items">';
        	do_action('mas_addons_accordion_wrapper_before');
            foreach( $settings['mas_addons_exclusive_accordion_tab'] as $key => $accordion ) : 
			
            	do_action('mas_addons_accordion_each_item_wrapper_before');

			
                
                $accordion_item_setting_key = $this->get_repeater_setting_key('mas_addons_exclusive_accordion_title', 'mas_addons_exclusive_accordion_tab', $key);

                $accordion_class = ['mas-addons-accordion-title'];

                if ( $accordion['mas_addons_exclusive_accordion_default_active'] === 'yes' ) {
                    $accordion_class[] = 'active-default';
                }

                $this->add_render_attribute( $accordion_item_setting_key, 'class', $accordion_class );

				$has_image = !empty( $accordion['mas_addons_accordion_image']['url'] ) ? 'yes' : 'no';
				$link_key  = 'link_' . $key;

                echo '<div class="mas-addons-accordion-single-item '.$accordion['mas_addons_exclusive_accordion_default_active'].'  elementor-repeater-item-'. esc_attr($accordion['_id']).'">';
                    echo '<div '.$this->get_render_attribute_string($accordion_item_setting_key).'>';
						if($settings['mas_addons_show_number'] == 'yes' ):
						echo '<div class="mas-addons-accordion-number">';
							echo '<span>';
							echo $i++;
							echo '</span>';
						echo '</div>';
			            endif;

						if ( ! empty( $accordion['mas_addons_exclusive_accordion_title_icon']['value'] ) && 'yes' === $accordion['mas_addons_exclusive_accordion_icon_show'] ) :
							echo '<span class="mas-addons-tab-title-icon">';
								Icons_Manager::render_icon( $accordion['mas_addons_exclusive_accordion_title_icon'], [ 'aria-hidden' => 'true' ] );
							echo '</span>';
						endif; 

                        echo '<h3 '.$this->get_render_attribute_string( 'mas_addons_accordion_heading' ).'>'.$accordion['mas_addons_exclusive_accordion_title'].'</h3>';

                        if( 'yes' === $settings['mas_addons_exclusive_accordion_tab_title_show_active_inactive_icon']):
                            echo '<div class="mas-addons-active-inactive-icon">';
                                if(!empty($settings['mas_addons_exclusive_accordion_tab_title_active_icon']['value'])){
                                    echo '<span class="mas-addons-active-icon">';
                                        Icons_Manager::render_icon( $settings['mas_addons_exclusive_accordion_tab_title_active_icon'], [ 'aria-hidden' => 'true' ] );
                                    echo '</span>';                                 
                                }
                                if(!empty($settings['mas_addons_exclusive_accordion_tab_title_inactive_icon']['value'])){
                                    echo '<span class="mas-addons-inactive-icon">';
                                        Icons_Manager::render_icon( $settings['mas_addons_exclusive_accordion_tab_title_inactive_icon'], [ 'aria-hidden' => 'true' ] );
                                    echo '</span>';                                 
                                }
                            echo '</div>';
                        endif;
                    echo '</div>';

                    echo '<div class="mas-addons-accordion-content">';
                        echo '<div class="mas-addons-accordion-content-wrapper has-image-'.esc_attr($has_image).' image-position-'.esc_attr($settings['mas_addons_accordion_image_align']).'">';
                            echo '<div '.$this->get_render_attribute_string( 'mas_addons_accordion_details' ).'>';
                                echo '<div>'.wp_kses_post( $accordion['mas_addons_exclusive_accordion_content'] ).'</div>';
                                if( 'yes' === $accordion['mas_addons_accordion_show_read_more_btn']):
									if( $accordion['mas_addons_accordion_read_more_btn_url']['url'] ) {
									    $this->add_render_attribute( $link_key, 'href', esc_url( $accordion['mas_addons_accordion_read_more_btn_url']['url'] ) );
									    if( $accordion['mas_addons_accordion_read_more_btn_url']['is_external'] ) {
									        $this->add_render_attribute( $link_key, 'target', '_blank' );
									    }
									    if( $accordion['mas_addons_accordion_read_more_btn_url']['nofollow'] ) {
									        $this->add_render_attribute( $link_key, 'rel', 'nofollow' );
									    }
									}
                                    if ( ! empty( $accordion['mas_addons_accordion_read_more_btn_text'] ) ) :
                                        echo '<div '.$this->get_render_attribute_string( 'mas_addons_accordion_button' ).'>';
                                            echo '<a '.$this->get_render_attribute_string( $link_key ).'>';
                                            	echo esc_html( $accordion['mas_addons_accordion_read_more_btn_text'] );
                                            echo '</a>';
                                        echo '</div>'; 
                                    endif;
                                endif;
                            echo '</div>';

                            if ( ! empty( $accordion['mas_addons_accordion_image']['url'] ) ) {
                                echo '<div class="mas-addons-accordion-image">';
                                    echo $this->render_image( $accordion, $settings );
                                echo '</div>';                                   
                            }

                        echo '</div>';
                    echo '</div>';
                echo '</div>';
                do_action('mas_addons_accordion_each_item_wrapper_after');
            endforeach;
            do_action('mas_addons_accordion_wrapper_after');
        echo '</div>';
    }
}
$widgets_manager->register( new \Mas_Addons\Widgets\mas_addons_accordion() );