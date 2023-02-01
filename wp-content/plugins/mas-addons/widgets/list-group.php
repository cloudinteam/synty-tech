<?php
namespace Mas_Addons\Widgets;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Control_Media;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Icons_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Typography;
use \Elementor\Utils;
use \Elementor\Repeater;
use \Elementor\Widget_Base;

class Mas_List_group extends Widget_Base {

	public function get_name() {
		return 'mas-list-group';
	}

	public function get_title() {
		return esc_html__( 'Mas List Group', 'mas-addons' );
	}

	public function get_icon() {
		return 'eicon-editor-list-ol';
	}

	public function get_categories() {
		return [ 'mas-addons' ];
	}

	public function get_keywords() {
		return [ 'mas', 'information', 'group', 'list', 'icon', 'socail' ];
	}

	protected function register_controls() {

		/*
		* Icon List Content
		*/
		$this->start_controls_section(
			'mas_section_list_content',
			[
				'label' => esc_html__( 'Content', 'mas-addons' )
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
            'mas_list_icon_type',
            [
                'label' => __( 'Media Type', 'mas-addons' ),
                'type' => Controls_Manager::CHOOSE,
                'default' => 'icon',
				'options' => [
					'icon' => [
						'title' => __( 'Icon', 'mas-addons' ),
						'icon' => 'eicon-star',
					],
					'number' => [
						'title' => __( 'Number', 'mas-addons' ),
						'icon' => 'eicon-number-field',
					],
					'image' => [
						'title' => __( 'Image', 'mas-addons' ),
						'icon' => 'eicon-image',
					],
				],
				'toggle' => false,
                'style_transfer' => true,
            ]
        );

		$repeater->add_control(
			'mas_list_icon',
			[
				'label'       => __( 'Icon', 'mas-addons' ),
				'type'        => Controls_Manager::ICONS,
				'label_block' => true,
				'separator'   =>'after',
				'default'     => [
					'value'   => 'far fa-check-circle',
					'library' => 'fa-regular'
				],
				'condition' =>[
					'mas_list_icon_type' => 'icon'
				]
			]
		);

		$repeater->add_control(
			'mas_list_icon_number',
			[
				'label'   => esc_html__( 'Number', 'mas-addons' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( '1', 'mas-addons' ),
				'separator'   =>'after',
				'condition' =>[
					'mas_list_icon_type' => 'number'
				]
			]
		);

		$repeater->add_control(
			'mas_list_icon_number_image',
			[
				'label' => __( 'Choose Image', 'mas-addons' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'separator'   =>'after',
				'dynamic' => [
					'active' => true,
				],
				'condition' =>[
					'mas_list_icon_type' => 'image'
				]
			]
		);

        $repeater->add_control(
			'mas_list_text',
			[
				'label'   => esc_html__( 'Text', 'mas-addons' ),
				'type'    => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__( 'List Text', 'mas-addons' ),
				'dynamic' => [ 'active' => true ]
			]
		);

		$repeater->add_control(
			'mas_list_link',
			[
				'label' => __( 'List URL', 'mas-addons' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'mas-addons' ),
				'show_external' => true,
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
				],
			]
		);

		$this->add_control(
			'mas_list_group',
			[
				'label' => __( 'List Items', 'elementor' ),
				'type' 		=> Controls_Manager::REPEATER,
				'fields' 	=> $repeater->get_controls(),
				'default' => [
					[
						'mas_list_text' => __( 'List Item #1', 'elementor' ),
						'mas_list_icon' => [
							'value' => 'fas fa-check',
							'library' => 'fa-solid',
						],
					],
					[
						'mas_list_text' => __( 'List Item #2', 'elementor' ),
						'mas_list_icon' => [
							'value' => 'fas fa-check',
							'library' => 'fa-solid',
						],
					],
					[
						'mas_list_text' => __( 'List Item #3', 'elementor' ),
						'mas_list_icon' => [
							'value' => 'fas fa-check',
							'library' => 'fa-solid',
						],
					],
				],
				'title_field' => '{{{ elementor.helpers.renderIcon( this, mas_list_icon, {}, "i", "panel" ) }}}{{{ mas_list_text }}}'
			]
		);

		$this->end_controls_section();

		/*
		* Icon List Content
		*/
		$this->start_controls_section(
			'mas_section_list_style',
			[
				'label' => esc_html__( 'Container', 'mas-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'mas_section_list_layout',
			[
				'label' => __( 'Layout', 'mas-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'layout_1',
				'options' => [
					'layout_1' => __( 'Layout 1', 'mas-addons' ),
					'layout_2' => __( 'Layout 2', 'mas-addons' ),
					'layout_3' => __( 'Layout 3', 'mas-addons' ),
				],
			]
		);

		$this->add_responsive_control(
			'mas_section_list_alignment',
			[
				'label'       => esc_html__( 'Alignment', 'mas-addons' ),
				'type'        => Controls_Manager::CHOOSE,
				'toggle'      => false,
				'label_block' => false,
				'options'     => [
					'mas-list-group-left'   => [
						'title' => esc_html__( 'Left', 'mas-addons' ),
						'icon'  => 'eicon-text-align-left'
					],
					'mas-list-group-center' => [
						'title' => esc_html__( 'Center', 'mas-addons' ),
						'icon'  => 'eicon-text-align-center'
					],
					'mas-list-group-right'  => [
						'title' => esc_html__( 'Right', 'mas-addons' ),
						'icon'  => 'eicon-text-align-right'
					]
				],
				'selectors_dictionary' => [
					'mas-list-group-left' => 'justify-content: flex-start; text-align: left;',
					'mas-list-group-center' => 'justify-content: center; text-align: center;',
					'mas-list-group-right' => 'justify-content: flex-end; text-align: right;',
				],
				'selectors' => [
					'{{WRAPPER}} .mas-list-group .mas-list-group-wrapper' => '{{VALUE}};',
					'{{WRAPPER}} .mas-list-group .mas-list-group-wrapper .mas-list-group-item' => '{{VALUE}};',
					'{{WRAPPER}} .mas-list-group .mas-list-group-wrapper .mas-list-group-item a' => '{{VALUE}};',
				],
				'default'     => 'mas-list-group-left',
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'            => 'mas_section_list_group_background',
				'types'           => [ 'classic', 'gradient' ],
				'selector'        => '{{WRAPPER}} .mas-list-group',
			]
		);

		$this->add_responsive_control(
			'mas_section_list_group_padding',
			[
				'label'      => __( 'Padding', 'mas-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
                    'top'      => '0',
                    'right'    => '0',
                    'bottom'   => '0',
                    'left'     => '0',
                    'unit'     => 'px',
                    'isLinked' => true
                ],
				'selectors'  => [
					'{{WRAPPER}} .mas-list-group' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'mas_section_list_group_border',
				'selector'  => '{{WRAPPER}} .mas-list-group'
			]
		);

		$this->add_responsive_control(
			'mas_section_list_group_radius',
			[
				'label'        => __( 'Border Radius', 'mas-addons' ),
				'type'         => Controls_Manager::DIMENSIONS,
				'size_units'   => [ 'px', '%', 'em' ],
				'default'      => [
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '0',
					'left'     => '0',
					'unit'     => 'px'
				],
				'selectors'    => [
					'{{WRAPPER}} .mas-list-group' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'mas_section_list_group_shadow',
				'selector' => '{{WRAPPER}} .mas-list-group'
			]
		);

		$this->end_controls_section();

		/*
		* Icon List Content
		*/
		$this->start_controls_section(
			'mas_section_list_item_style',
			[
				'label' => esc_html__( 'List Item', 'mas-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_responsive_control(
			'mas_section_list_item_padding',
			[
				'label'        => __( 'Item Padding', 'mas-addons' ),
				'type'         => Controls_Manager::DIMENSIONS,
				'size_units'   => [ 'px', '%', 'em' ],
				'default'      => [
					'top'      => '10',
					'right'    => '10',
					'bottom'   => '10',
					'left'     => '10',
					'unit'     => 'px'
				],
				'selectors'    => [
					'{{WRAPPER}} .mas-list-group .mas-list-group-wrapper .mas-list-group-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_control(
			'mas_section_list_item_separator',
            [
				'label'        => __( 'Item Separator', 'mas-addons' ),
				'type'         =>  Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'mas-addons' ),
				'label_off'    => __( 'Hide', 'mas-addons' ),
				'return_value' => 'yes',
				'default'      => 'no',
				'condition'    => [
					'mas_section_list_layout!' => 'layout_3'
				]
			]
        );

		$this->add_responsive_control(
			'mas_section_list_item_separator_height',
			[
				'label' => __( 'Separator Height', 'mas-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 10,
						'step' => 1,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 1,
				],
				'selectors' => [
					'{{WRAPPER}} .mas-list-group .mas-list-group-wrapper.layout_1 .mas-list-group-item:not(:last-child):after' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .mas-list-group .mas-list-group-wrapper.layout_2 .mas-list-group-item:not(:last-child):after' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'mas_section_list_item_separator' => 'yes',
					'mas_section_list_layout!' => 'layout_3'
				]
			]
		);

		$this->add_control(
			'mas_section_list_item_separator_color',
			[
				'label' => __( 'Separator Color', 'mas-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#e5e5e5',
				'selectors' => [
					'{{WRAPPER}} .mas-list-group .mas-list-group-wrapper.layout_1 .mas-list-group-item:not(:last-child):after' => 'background: {{VALUE}}',
					'{{WRAPPER}} .mas-list-group .mas-list-group-wrapper.layout_2 .mas-list-group-item:not(:last-child):after' => 'background: {{VALUE}}',
				],
				'condition' => [
					'mas_section_list_item_separator' => 'yes',
					'mas_section_list_layout!' => 'layout_3'
				]
			]
		);

		$this->add_responsive_control(
			'mas_list_item_spacing',
			[
				'label' => __( 'Item Spacing', 'mas-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
						'step' => 1,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 10,
				],
				'selectors' => [
					'{{WRAPPER}} .mas-list-group .mas-list-group-wrapper.layout_3 .mas-list-group-item:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'mas_section_list_layout' => 'layout_3'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'            => 'mas_list_item_background',
				'types'           => [ 'classic', 'gradient' ],
				'selector'        => '{{WRAPPER}} .mas-list-group .mas-list-group-wrapper.layout_3 .mas-list-group-item',
				'condition' => [
					'mas_section_list_layout' => 'layout_3'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'mas_list_item_border',
				'selector'  => '{{WRAPPER}} .mas-list-group .mas-list-group-wrapper.layout_3 .mas-list-group-item',
				'fields_options'  => [
                    'border' 	  => [
                        'default' => 'solid'
                    ],
                    'width'  	  => [
                        'default' 	 => [
                            'top'    => '1',
                            'right'  => '1',
                            'bottom' => '1',
                            'left'   => '1'
                        ]
                    ],
                    'color' 	  => [
                        'default' => '#e5e5e5',
                    ]
                ],
				'condition' => [
					'mas_section_list_layout' => 'layout_3'
				]
			]
		);

		$this->add_responsive_control(
			'mas_list_item_radius',
			[
				'label'        => __( 'Border Radius', 'mas-addons' ),
				'type'         => Controls_Manager::DIMENSIONS,
				'size_units'   => [ 'px', '%', 'em' ],
				'default'      => [
					'top'      => '10',
					'right'    => '10',
					'bottom'   => '10',
					'left'     => '10',
					'unit'     => 'px'
				],
				'selectors'    => [
					'{{WRAPPER}} .mas-list-group .mas-list-group-wrapper.layout_3 .mas-list-group-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
				'condition' => [
					'mas_section_list_layout' => 'layout_3'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'mas_list_item_shadow',
				'selector' => '{{WRAPPER}} .mas-list-group .mas-list-group-wrapper.layout_3 .mas-list-group-item',
				'condition' => [
					'mas_section_list_layout' => 'layout_3'
				]
			]
		);

		$this->end_controls_section();

		/*
		* Icon List Icon Style
		*/
		$this->start_controls_section(
			'mas_section_list_icon_style',
			[
				'label' => esc_html__( 'Icon', 'mas-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_responsive_control(
			'mas_list_icon_position',
			[
				'label'       => esc_html__( 'Icon Position', 'mas-addons' ),
				'type'        => Controls_Manager::CHOOSE,
				'toggle'      => false,
				'label_block' => false,
				'options'     => [
					'mas-icon-left'   => [
						'title' => esc_html__( 'Left', 'mas-addons' ),
						'icon'  => 'eicon-h-align-left'
					],
					'mas-icon-center' => [
						'title' => esc_html__( 'Center', 'mas-addons' ),
						'icon'  => 'eicon-v-align-top'
					],
					'mas-icon-right'  => [
						'title' => esc_html__( 'Right', 'mas-addons' ),
						'icon'  => 'eicon-h-align-right'
					]
				],
				'default'     => 'mas-icon-left'
			]
		);

		$this->add_responsive_control(
			'mas_list_icon_alignment',
			[
				'label'       => esc_html__( 'Icon Vertical Alignment', 'mas-addons' ),
				'type'        => Controls_Manager::CHOOSE,
				'toggle'      => false,
				'label_block' => false,
				'options'     => [
					'mas-icon-align-left'   => [
						'title' => esc_html__( 'Top', 'mas-addons' ),
						'icon'  => 'eicon-v-align-top'
					],
					'mas-icon-align-center' => [
						'title' => esc_html__( 'Center', 'mas-addons' ),
						'icon'  => 'eicon-v-align-middle'
					],
					'mas-icon-align-right'  => [
						'title' => esc_html__( 'Bottom', 'mas-addons' ),
						'icon'  => 'eicon-v-align-bottom'
					]
				],
				'default'     => 'mas-icon-align-left',
				'selectors_dictionary' => [
					'mas-icon-align-left' => 'align-items: flex-start;',
					'mas-icon-align-center' => 'align-items: center;',
					'mas-icon-align-right' => 'align-items: flex-end;',
				],
				'selectors' => [
					'{{WRAPPER}} .mas-list-group .mas-list-group-wrapper .mas-list-group-item' => '{{VALUE}};',
				],
				'condition' => [
					'mas_list_icon_position!' => 'mas-icon-center'
				]
			]
		);

		$this->add_responsive_control(
			'mas_list_icon_top_alignment',
			[
				'label'       => esc_html__( 'Icon Alignment', 'mas-addons' ),
				'type'        => Controls_Manager::CHOOSE,
				'toggle'      => false,
				'label_block' => false,
				'options'     => [
					'mas-icon-top-align-left'   => [
						'title' => esc_html__( 'Left', 'mas-addons' ),
						'icon'  => 'eicon-v-align-top'
					],
					'mas-icon-top-align-center' => [
						'title' => esc_html__( 'Center', 'mas-addons' ),
						'icon'  => 'eicon-v-align-middle'
					],
					'mas-icon-top-align-right'  => [
						'title' => esc_html__( 'Right', 'mas-addons' ),
						'icon'  => 'eicon-v-align-bottom'
					]
				],
				'default'     => 'mas-icon-left',
				'selectors_dictionary' => [
					'mas-icon-top-align-left' => 'text-align: left; margin-right: auto;',
					'mas-icon-top-align-center' => 'text-align: center; margin-left: auto; margin-right: auto;',
					'mas-icon-top-align-right' => 'text-align: right; margin-left: auto;',
				],
				'selectors' => [
					'{{WRAPPER}} .mas-list-group .mas-list-group-wrapper .mas-list-group-item .mas-list-group-icon' => '{{VALUE}};',
					'{{WRAPPER}} .mas-list-group .mas-list-group-wrapper .mas-list-group-item .mas-list-group-icon .mas-list-group-icon-image' => '{{VALUE}};',
				],
				'condition' => [
					'mas_list_icon_position' => 'mas-icon-center'
				]
			]
		);

		$this->add_responsive_control(
			'mas_section_list_item_icon_spacing',
			[
				'label' => __( 'Icon Right Spacing', 'mas-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 10,
				],
				'selectors' => [
					'{{WRAPPER}} .mas-list-group .mas-list-group-wrapper .mas-list-group-item .mas-list-group-text' => 'padding-left: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'mas_list_icon_position' => 'mas-icon-left'
				]
			]
		);
		$this->add_responsive_control(
			'mas_section_list_item_icon_left_spacing',
			[
				'label' => __( 'Icon Left Spacing', 'mas-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 10,
				],
				'selectors' => [
					'{{WRAPPER}} .mas-list-group .mas-list-group-wrapper .mas-list-group-item .mas-list-group-icon' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'mas_list_icon_position' => 'mas-icon-right'
				]
			]
		);
		$this->add_responsive_control(
			'mas_section_list_item_icon_bottom_spacing',
			[
				'label' => __( 'Icon Bottom Spacing', 'mas-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 10,
				],
				'selectors' => [
					'{{WRAPPER}} .mas-list-group .mas-list-group-wrapper .mas-list-group-item .mas-list-group-icon' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'mas_list_icon_position' => 'mas-icon-center'
				]
			]
		);

		$this->add_responsive_control(
			'mas_section_list_item_icon_size',
			[
				'label' => __( 'Icon Size', 'mas-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 16,
				],
				'selectors' => [
					'{{WRAPPER}} .mas-list-group .mas-list-group-wrapper .mas-list-group-item .mas-list-group-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .mas-list-group .mas-list-group-wrapper .mas-list-group-item .mas-list-group-icon svg' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .mas-list-group .mas-list-group-wrapper .mas-list-group-item .mas-list-group-icon .mas-list-group-icon-image' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'mas_section_list_item_icon_color',
			[
				'label' => __( 'Icon Color', 'mas-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mas-list-group .mas-list-group-wrapper .mas-list-group-item .mas-list-group-icon i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .mas-list-group .mas-list-group-wrapper .mas-list-group-item .mas-list-group-icon svg path' => 'fill: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'mas_section_list_item_icon_color_hover',
			[
				'label' => __( 'Icon Color Hover', 'mas-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mas-list-group .mas-list-group-wrapper .mas-list-group-item .mas-list-group-icon:hover i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .mas-list-group .mas-list-group-wrapper .mas-list-group-item .mas-list-group-icon:hover svg path' => 'fill: {{VALUE}}',
				],
			]
		);


		$this->add_responsive_control(
			'mas_section_list_item_image_radius',
			[
				'label'        => __( 'Image Radius', 'mas-addons' ),
				'type'         => Controls_Manager::DIMENSIONS,
				'size_units'   => [ 'px', '%', 'em' ],
				'default'      => [
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '0',
					'left'     => '0',
					'unit'     => 'px'
				],
				'selectors'    => [
					'{{WRAPPER}} .mas-list-group .mas-list-group-wrapper .mas-list-group-item .mas-list-group-icon .mas-list-group-icon-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
			]
		);

		$this->add_control(
			'mas_list_item_icon_box_enable',
			[
				'label' => __( 'Enable Icon Box', 'mas-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'mas-addons' ),
				'label_off' => __( 'Hide', 'mas-addons' ),
				'return_value' => 'yes',
				'default' => 'no',
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'mas_list_item_icon_box_width',
			[
				'label' => __( 'Icon Box Width', 'mas-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
						'step' => 1,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 40,
				],
				'selectors' => [
					'{{WRAPPER}} .mas-list-group .mas-list-group-wrapper .mas-list-group-item .mas-list-group-icon.yes' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .mas-list-group .mas-list-group-wrapper.layout_1 .mas-list-group-item .mas-list-group-text' => 'width: calc( 100% - {{SIZE}}{{UNIT}} );',
					'{{WRAPPER}} .mas-list-group .mas-list-group-wrapper.layout_2 .mas-list-group-item .mas-list-group-text' => 'width: calc( 100% - {{SIZE}}{{UNIT}} );',
					'{{WRAPPER}} .mas-list-group .mas-list-group-wrapper.layout_3 .mas-list-group-item .mas-list-group-text' => 'width: calc( 100% - {{SIZE}}{{UNIT}} );',
				],
				'condition' => [
					'mas_list_item_icon_box_enable' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'mas_list_item_icon_box_height',
			[
				'label' => __( 'Icon Box Height', 'mas-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
						'step' => 1,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 40,
				],
				'selectors' => [
					'{{WRAPPER}} .mas-list-group .mas-list-group-wrapper .mas-list-group-item .mas-list-group-icon.yes' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'mas_list_item_icon_box_enable' => 'yes'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'            => 'mas_list_item_icon_box_background',
				'types'           => [ 'classic', 'gradient' ],
				'selector'        => '{{WRAPPER}} .mas-list-group .mas-list-group-wrapper .mas-list-group-item .mas-list-group-icon.yes',
				'condition' => [
					'mas_list_item_icon_box_enable' => 'yes'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'            => 'mas_list_item_icon_box_background_hover',
				'types'           => [ 'classic', 'gradient' ],
				'selector'        => '{{WRAPPER}} .mas-list-group .mas-list-group-wrapper .mas-list-group-item .mas-list-group-icon.yes:hover',
				'condition' => [
					'mas_list_item_icon_box_enable' => 'yes'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'mas_list_item_icon_box_border',
				'selector'  => '{{WRAPPER}} .mas-list-group .mas-list-group-wrapper .mas-list-group-item .mas-list-group-icon.yes',
				'condition' => [
					'mas_list_item_icon_box_enable' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'mas_list_item_icon_box_radius',
			[
				'label'        => __( 'Border Radius', 'mas-addons' ),
				'type'         => Controls_Manager::DIMENSIONS,
				'size_units'   => [ 'px', '%', 'em' ],
				'default'      => [
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '0',
					'left'     => '0',
					'unit'     => 'px'
				],
				'selectors'    => [
					'{{WRAPPER}} .mas-list-group .mas-list-group-wrapper .mas-list-group-item .mas-list-group-icon.yes' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
				'condition' => [
					'mas_list_item_icon_box_enable' => 'yes'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'mas_list_item_icon_box_shadow',
				'selector' => '{{WRAPPER}} .mas-list-group .mas-list-group-wrapper .mas-list-group-item .mas-list-group-icon.yes',
				'condition' => [
					'mas_list_item_icon_box_enable' => 'yes'
				]
			]
		);

		$this->end_controls_section();

		/*
		* Icon List Text
		*/
		$this->start_controls_section(
			'mas_section_list_text_style',
			[
				'label' => esc_html__( 'Text', 'mas-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_responsive_control(
			'mas_section_list_text_alignment',
			[
				'label'       => esc_html__( 'Text Alignment', 'mas-addons' ),
				'type'        => Controls_Manager::CHOOSE,
				'toggle'      => false,
				'label_block' => false,
				'options'     => [
					'mas-text-align-left'   => [
						'title' => esc_html__( 'Left', 'mas-addons' ),
						'icon'  => 'eicon-text-align-left'
					],
					'mas-text-align-center' => [
						'title' => esc_html__( 'Center', 'mas-addons' ),
						'icon'  => 'eicon-text-align-left'
					],
					'mas-text-align-right'  => [
						'title' => esc_html__( 'Right', 'mas-addons' ),
						'icon'  => 'eicon-text-align-left'
					]
				],
				'default'     => 'mas-text-align-left',
				'selectors_dictionary' => [
					'mas-text-align-left' => 'text-align: left;',
					'mas-text-align-center' => 'text-align: center;',
					'mas-text-align-right' => 'text-align: right;',
				],
				'selectors' => [
					'{{WRAPPER}} .mas-list-group .mas-list-group-wrapper .mas-list-group-item .mas-list-group-text' => '{{VALUE}};',
				],
				'condition' => [
					'mas_list_icon_position' => 'mas-icon-center'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'mas_section_list_text_typography',
				'label' => __( 'Typography', 'mas-addons' ),
				'selector' => '{{WRAPPER}} .mas-list-group .mas-list-group-wrapper .mas-list-group-item .mas-list-group-text',
			]
		);

		$this->add_control(
			'mas_section_list_text_color',
			[
				'label' => __( 'Title Color', 'mas-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mas-list-group .mas-list-group-wrapper .mas-list-group-item .mas-list-group-text' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

	}
	protected function render() {
		$settings = $this->get_settings_for_display();

		?>
		<div class="mas-list-group">
			<ul class="mas-list-group-wrapper <?php echo $settings['mas_section_list_layout']; ?>">
				<?php foreach( $settings['mas_list_group'] as $list ) : ?>
				<?php
					$target = $list['mas_list_link']['is_external'] ? ' target="_blank"' : '';
					$nofollow = $list['mas_list_link']['nofollow'] ? ' rel="nofollow"' : '';
				?>
					<li class="mas-list-group-item <?php echo $settings['mas_list_icon_position']?>">
						<?php if ( !empty( $list['mas_list_link']['url'] ) ) { ?>
						<a href="<?php echo $list['mas_list_link']['url']; ?>" <?php echo $target; ?> <?php echo $nofollow; ?> >
						<?php } ?>
							<span class="mas-list-group-icon <?php echo $settings['mas_list_item_icon_box_enable']; ?>">
								<?php if ( $list['mas_list_icon_type'] === 'icon' && !empty($list['mas_list_icon']) ){ ?>
									<?php Icons_Manager::render_icon( $list['mas_list_icon'], [ 'aria-hidden' => 'true' ] ); ?>
								<?php } ?>
								<?php if ( $list['mas_list_icon_type'] === 'number' && !empty($list['mas_list_icon_type']) ){ ?>
									<div class="mas-list-group-icon-number">
										<?php echo $list['mas_list_icon_number']; ?>
									</div>
								<?php } ?>
								<?php if ( $list['mas_list_icon_type'] === 'image' && !empty($list['mas_list_icon_type']) ){ ?>
									<div class="mas-list-group-icon-image">
										<img src="<?php echo $list['mas_list_icon_number_image']['url'] ?>" alt="<?php echo $list['mas_list_text']; ?>">
									</div>
								<?php } ?>
							</span>
							<?php if ( !empty( $list['mas_list_text'] ) ) { ?>
								<span class="mas-list-group-text">
									<?php echo $list['mas_list_text']; ?>
								</span>
							<?php } ?>
						<?php if ( !empty( $list['mas_list_link']['url'] ) ) { ?>
						</a>
						<?php } ?>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
		<?php
	}
}
$widgets_manager->register( new \Mas_Addons\Widgets\Mas_List_group() );