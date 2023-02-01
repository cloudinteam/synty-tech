<?php
namespace Mas_Addons\Widgets;

if ( ! defined( 'ABSPATH' ) ) exit;

use \Elementor\Controls_Manager;
use \Elementor\Repeater;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Background;
use \Elementor\Icons_Manager;
use \Elementor\Utils;
use \Elementor\Widget_Base;

class Mas_Modal_Popup extends Widget_Base {

	public function get_name() {
		return 'mas-modal-video';
	}

	public function get_title() {
		return esc_html__( 'Modal Popup', 'mas-addons' );
	}

	public function get_icon() {
		return 'eicon-video-camera';
	}

	public function get_categories() {
		return [ 'mas-addons' ];
	}

	public function get_keywords() {
		return [ 'mas', 'lightbox', 'popup', 'quickview', 'video', 'btn', 'button' ];
	}

	protected function register_controls() {

		/**
		 * Modal Popup Content section
		 */
		$this->start_controls_section(
			'mas_modal_content_section',
			[
				'label' => __( 'Contents', 'mas-addons' )
			]
		);

		$this->add_control(
			'mas_modal_content',
			[
				'label'   => __( 'Type of Modal', 'mas-addons' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'image',
                'options' => [
					'image'          => __( 'Image', 'mas-addons' ),
					'image-gallery'  => __( 'Image Gallery', 'mas-addons' ),
					'html_content'   => __( 'HTML Content', 'mas-addons' ),
					'youtube'        => __( 'Youtube Video', 'mas-addons' ),
					'vimeo'          => __( 'Vimeo Video', 'mas-addons' ),
					'external-video' => __( 'Self Hosted Video', 'mas-addons' ),
					'external_page'  => __( 'External Page', 'mas-addons' ),
					'shortcode'      => __( 'ShortCode', 'mas-addons' )
				]
			]
		);

		/**
		 * Modal Popup image section
		 */
		$this->add_control(
			'mas_modal_image',
			[
				'label'      => __( 'Image', 'mas-addons' ),
				'type'       => Controls_Manager::MEDIA,
				'default'    => [
					'url' 	 => Utils::get_placeholder_image_src()
				],
				'dynamic'    => [
					'active' => true
                ],
                'condition'  => [
                    'mas_modal_content' => 'image'
                ]
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'      => 'thumbnail',
				'default'   => 'full',
				'condition' => [
                    'mas_modal_content' => 'image'
                ]
			]
		);

		/**
		 * Modal Popup image gallery
		 */

		$this->add_control(
			'mas_modal_image_gallery_column',
			[
				'label'   => __( 'Column', 'mas-addons' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'column-three',
                'options' => [
					'column-one'   => __( 'Column 1', 'mas-addons' ),
					'column-two'   => __( 'Column 2', 'mas-addons' ),
					'column-three' => __( 'Column 3', 'mas-addons' ),
					'column-four'  => __( 'Column 4', 'mas-addons' ),
					'column-five'  => __( 'Column 5', 'mas-addons' ),
					'column-six'   => __( 'Column 6', 'mas-addons' )
				],
				'condition' => [
					'mas_modal_content' => 'image-gallery'
				]
			]
		);

		$image_repeater = new Repeater();

		$image_repeater->add_control(
			'mas_modal_image_gallery',
			[
				'label'   => __( 'Image', 'mas-addons' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src()
				],
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$image_repeater->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'      => 'thumbnail',
				'default'   => 'full',
			]
		);

		$image_repeater->add_control(
			'mas_modal_image_gallery_text',
			[
				'label' => __( 'Description', 'mas-addons' ),
				'type'  => Controls_Manager::TEXTAREA,
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$this->add_control(
			'mas_modal_image_gallery_repeater',
			[
				'label'   => esc_html__( 'Image Gallery', 'mas-addons' ),
				'type'    => Controls_Manager::REPEATER,
				'fields'  => $image_repeater->get_controls(),
				'default' => [
					[ 'mas_modal_image_gallery' => Utils::get_placeholder_image_src() ],
					[ 'mas_modal_image_gallery' => Utils::get_placeholder_image_src() ],
					[ 'mas_modal_image_gallery' => Utils::get_placeholder_image_src() ]
				],
				'condition' => [
					'mas_modal_content' => 'image-gallery'
				]
			]
		);
		/**
		 * Modal Popup html content section
		 */
		$this->add_control(
			'mas_modal_html_content',
			[
				'label'     => __( 'Add your content here (HTML/Shortcode)', 'mas-addons' ),
				'type'      => Controls_Manager::WYSIWYG,
				'default'   => __( 'Add your popup content here', 'mas-addons' ),
				'dynamic'   => [ 'active' => true ],
				'condition' => [
				  	'mas_modal_content' => 'html_content'
			  	]
			]
		);

		/**
		 * Modal Popup video section
		 */

		$this->add_control(
            'mas_modal_youtube_video_url',
            [
				'label'       => __( 'Provide Youtube Video URL', 'mas-addons' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => 'https://www.youtube.com/watch?v=b1lyIT1FvDo',
				'placeholder' => __( 'Place Youtube Video URL', 'mas-addons' ),
				'title'       => __( 'Place Youtube Video URL', 'mas-addons' ),
				'condition'   => [
                    'mas_modal_content' => 'youtube'
                ],
				'dynamic' => [
					'active' => true,
				]
            ]
        );


        $this->add_control(
            'mas_modal_vimeo_video_url',
            [
				'label'       => __( 'Provide Vimeo Video URL', 'mas-addons' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => 'https://vimeo.com/347565673',
				'placeholder' => __( 'Place Vimeo Video URL', 'mas-addons' ),
				'title'       => __( 'Place Vimeo Video URL', 'mas-addons' ),
				'condition'   => [
                    'mas_modal_content' => 'vimeo'
                ],
				'dynamic' => [
					'active' => true,
				]
            ]
		);

		/**
		 * Modal Popup external video section
		 */
		$this->add_control(
			'mas_modal_external_video',
			[
				'label'      => __( 'External Video', 'mas-addons' ),
				'type'       => Controls_Manager::MEDIA,
				'media_type' => 'video',
				'dynamic' => [
					'active' => true,
				],
				'condition'  => [
                    'mas_modal_content' => 'external-video'
                ]
			]
		);

		$this->add_control(
            'mas_modal_external_page_url',
            [
				'label'       => __( 'Provide External URL', 'mas-addons' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => 'https://masdevs.com',
				'placeholder' => __( 'Place External Page URL', 'mas-addons' ),
				'condition'   => [
                    'mas_modal_content' => 'external_page'
                ],
				'dynamic' => [
					'active' => true,
				]
            ]
        );

        $this->add_responsive_control(
            'mas_modal_video_width',
            [
				'label'        => __( 'Content Width', 'mas-addons' ),
				'type'         => Controls_Manager::SLIDER,
				'size_units'   => [ 'px', '%' ],
				'range'        => [
                    'px'       => [
						'min'  => 0,
						'max'  => 1000,
						'step' => 5
                    ],
                    '%'        => [
                        'min'  => 0,
                        'max'  => 100
                    ]
                ],
                'default'      => [
                    'unit'     => 'px',
                    'size'     => 720
                ],
                'selectors'    => [
					'{{WRAPPER}} .mas-modal-item .mas-modal-content .mas-modal-element iframe,
					{{WRAPPER}} .mas-modal-item .mas-modal-content .mas-video-hosted' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .mas-modal-item' => 'width: {{SIZE}}{{UNIT}};'
                ],
                'condition'    => [
                    'mas_modal_content' => [ 'youtube', 'vimeo', 'external_page', 'external-video' ]
                ]
            ]
        );

        $this->add_responsive_control(
            'mas_modal_video_height',
            [
				'label'        => __( 'Content Height', 'mas-addons' ),
				'type'         => Controls_Manager::SLIDER,
				'size_units'   => [ 'px', '%' ],
				'range'        => [
                    'px'       => [
						'min'  => 0,
						'max'  => 1000,
						'step' => 5
                    ],
                    '%'        => [
						'min'  => 0,
						'max'  => 100
                    ]
                ],
                'default'      => [
					'unit'     => 'px',
					'size'     => 400
                ],
                'selectors'    => [
                    '{{WRAPPER}} .mas-modal-item .mas-modal-content .mas-modal-element iframe' => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .mas-modal-item' => 'height: {{SIZE}}{{UNIT}};'
                ],
                'condition'    => [
                    'mas_modal_content' => [ 'youtube', 'vimeo', 'external_page' ]
                ]
            ]
        );

        $this->add_control(
            'mas_modal_shortcode',
            [
				'label'       => __( 'Enter your shortcode', 'mas-addons' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'placeholder' => __( '[gallery]', 'mas-addons' ),
				'condition'   => [
                    'mas_modal_content' => 'shortcode'
                ]
            ]
		);

		$this->add_responsive_control(
			'mas_modal_content_width',
			[
				'label' => __( 'Content Width', 'mas-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 2000,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .mas-modal-item' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition'    => [
                    'mas_modal_content' => [ 'image', 'image-gallery', 'html_content', 'shortcode' ]
                ]
			]
		);

		$this->add_control(
			'mas_modal_btn_text',
			[
				'label'       => __( 'Button Text', 'mas-addons' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( '', 'mas-addons' ),
				'dynamic'     => [
					'active'  => true
				]
			]
		);

		$this->add_control(
			'mas_modal_btn_icon',
			[
				'label'       => __( 'Button Icon', 'mas-addons' ),
				'label_block' => true,
				'type'        => Controls_Manager::ICONS,
                'default'     => [
                    'value'   => 'fas fa-play',
                    'library' => 'fa-brands'
                ]
			]
		);

		$this->end_controls_section();

		/**
		 * Modal Popup settings section
		 */
		$this->start_controls_section(
			'mas_modal_setting_section',
			[
				'label' => __( 'Settings', 'mas-addons' )
			]
		);

		$this->add_control(
			'mas_modal_overlay',
			[
				'label'        => __( 'Overlay', 'mas-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'mas-addons' ),
				'label_off'    => __( 'Hide', 'mas-addons' ),
				'return_value' => 'yes',
				'default'      => 'yes'
			]
		);

		$this->add_control(
			'mas_modal_overlay_click_close',
			[
				'label'     => __( 'Close While Clicked Outside', 'mas-addons' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => __( 'ON', 'mas-addons' ),
				'label_off' => __( 'OFF', 'mas-addons' ),
				'default'   => 'yes',
				'condition' => [
					'mas_modal_overlay' => 'yes'
				]
			]
		);

		$this->end_controls_section();

		/**
		 * Modal Popup button style
		 */

		$this->start_controls_section(
			'mas_modal_display_settings',
			[
				'label' => __( 'Button', 'mas-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);


		/**
		 * display settings for button normal and hover
		 */
		$this->start_controls_tabs( 'mas_modal_btn_typhography_color', ['separator' => 'before' ] );

			$this->start_controls_tab( 'mas_modal_btn_typhography_color_normal_tab', [ 'label' => esc_html__( 'Normal', 'mas-addons' )] );

				$this->add_control(
					'mas_modal_btn_typhography_color_normal',
					[
						'label'     => __( 'Color', 'mas-addons' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '#ffffff',
						'selectors' => [
							'{{WRAPPER}} .mas-modal-button .mas-modal-image-action span' => 'color: {{VALUE}};'
						]
					]
				);

				$this->add_control(
					'mas_modal_btn_background_normal',
					[
						'label'     => __( 'Background Color', 'mas-addons' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '#4243DC',
						'selectors' => [
							'{{WRAPPER}} .mas-modal-button .mas-modal-image-action' => 'background-color: {{VALUE}};'
						]
					]
				);

				$this->add_responsive_control(
					'mas_modal_btn_align',
					[
						'label'         => __( 'Alignment', 'mas-addons' ),
						'type'          => Controls_Manager::CHOOSE,
						'default'       => 'center',
						'toggle'        => false,
						'separator'     => 'before',
						'options'       => [
							'left'      => [
								'title' => __( 'Left', 'mas-addons' ),
								'icon'  => 'eicon-text-align-left'
							],
							'center'    => [
								'title' => __( 'Center', 'mas-addons' ),
								'icon'  => 'eicon-text-align-center'
							],
							'right'     => [
								'title' => __( 'Right', 'mas-addons' ),
								'icon'  => 'eicon-text-align-right'
							]
						],
						'selectors'     => [
							'{{WRAPPER}} .mas-modal-button' => 'text-align: {{VALUE}};'
						]
					]
				);
				$this->add_group_control(
					Group_Control_Typography::get_type(),
					[
						'name'      => 'mas_modal_btn_typhography',
						'label'     => __( 'Button Typography', 'mas-addons' ),
						'selector'  => '{{WRAPPER}} .mas-modal-button .mas-modal-image-action span'
					]
				);

				$this->add_control(
					'mas_modal_btn_enable_fixed_width_height',
					[
						'label' => __( 'Enable Fixed Height & Width?', 'mas-addons' ),
						'type' => Controls_Manager::SWITCHER,
						'label_on' => __( 'Show', 'mas-addons' ),
						'label_off' => __( 'Hide', 'mas-addons' ),
						'return_value' => 'yes',
						'default' => 'yes',
					]
				);

				$this->add_control(
					'mas_modal_btn_fixed_width_height',
					[
						'label' => __( 'Fixed Height & Width', 'mas-addons' ),
						'type' => Controls_Manager::POPOVER_TOGGLE,
						'label_off' => __( 'Default', 'mas-addons' ),
						'label_on' => __( 'Custom', 'mas-addons' ),
						'return_value' => 'yes',
						'default' => 'yes',
						'condition' => [
							'mas_modal_btn_enable_fixed_width_height' => 'yes'
						]
					]
				);

				$this->start_popover();

					$this->add_responsive_control(
						'mas_modal_btn_fixed_width',
						[
							'label'      => esc_html__( 'Width', 'mas-addons' ),
							'type'       => Controls_Manager::SLIDER,
							'size_units' => [ 'px', '%' ],
							'range'      => [
								'px'     => [
									'min'  => 0,
									'max'  => 500,
									'step' => 1
								],
								'%'        => [
									'min'  => 0,
									'max'  => 100
								]
							],
							'default'    => [
								'unit'   => 'px',
								'size'   => 70
							],
							'selectors'  => [
								'{{WRAPPER}} .mas-modal-button .mas-modal-image-action' => 'width: {{SIZE}}{{UNIT}};'

							],
							'condition' => [
								'mas_modal_btn_enable_fixed_width_height' => 'yes'
							]
						]
					);

					$this->add_responsive_control(
						'mas_modal_btn_fixed_height',
						[
							'label'      => esc_html__( 'Height', 'mas-addons' ),
							'type'       => Controls_Manager::SLIDER,
							'size_units' => [ 'px', '%' ],
							'range'      => [
								'px'     => [
									'min'  => 0,
									'max'  => 500,
									'step' => 1
								],
								'%'        => [
									'min'  => 0,
									'max'  => 100
								]
							],
							'default'    => [
								'unit'   => 'px',
								'size'   => 70
							],
							'selectors'  => [
								'{{WRAPPER}} .mas-modal-button .mas-modal-image-action' => 'height: {{SIZE}}{{UNIT}};'
							],
							'condition' => [
								'mas_modal_btn_enable_fixed_width_height' => 'yes'
							]
						]
					);

				$this->end_popover();

				$this->add_responsive_control(
					'mas_modal_btn_width',
					[
						'label'        => esc_html__( 'Width', 'mas-addons' ),
						'type'         => Controls_Manager::SLIDER,
						'size_units'   => [ 'px', '%' ],
						'range'        => [
							'px'       => [
								'min'  => 0,
								'max'  => 500,
								'step' => 1
							],
							'%'        => [
								'min'  => 0,
								'max'  => 100
							]
						],
						'default'      => [
							'unit'     => 'px',
							'size'     => 70
						],
						'selectors'    => [
							'{{WRAPPER}} .mas-modal-button .mas-modal-image-action' => 'width: {{SIZE}}{{UNIT}};'
						],
						'condition' => [
							'mas_modal_btn_enable_fixed_width_height!' => 'yes'
						]
					]
				);

				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name'               => 'mas_modal_btn_border_normal',
						'selector'           => '{{WRAPPER}} .mas-modal-button .mas-modal-image-action'
					]
				);

				$this->add_responsive_control(
					'mas_modal_btn_radius',
					[
						'label'      => __( 'Border Radius', 'mas-addons' ),
						'type'       => Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%' ],
						'default'    => [
							'top'    => '50',
							'right'  => '50',
							'bottom' => '50',
							'left'   => '50',
							'unit'   => 'px'
						],
						'selectors'  => [
							'{{WRAPPER}} .mas-modal-image-action, {{WRAPPER}} .mas-modal-image-action::before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
						]
					]
				);

				$this->add_responsive_control(
					'mas_modal_btn_padding',
					[
						'label'        => __( 'Padding', 'mas-addons' ),
						'type'         => Controls_Manager::DIMENSIONS,
						'size_units'   => [ 'px', '%' ],
						'default'      => [
							'top'      => '20',
							'right'    => '0',
							'bottom'   => '20',
							'left'     => '0',
							'unit'     => 'px',
							'isLinked' => false
						],
						'selectors'    => [
							'{{WRAPPER}} .mas-modal-image-action' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
						]
					]
				);

			$this->end_controls_tab();

			$this->start_controls_tab( 'mas_modal_btn_typhography_color_hover_tab', [ 'label' => esc_html__( 'Hover', 'mas-addons' ) ] );

				$this->add_control(
					'mas_modal_btn_color_hover',
					[
						'label'     => __( 'Text Color', 'mas-addons' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '#fff',
						'selectors' => [
							'{{WRAPPER}} .mas-modal-button .mas-modal-image-action:hover span' => 'color: {{VALUE}};'
						]
					]
				);

				$this->add_control(
					'mas_modal_btn_background_hover',
					[
						'label'     => __( 'Background Color', 'mas-addons' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '#EF2469',
						'selectors' => [
							'{{WRAPPER}} .mas-modal-button .mas-modal-image-action:hover' => 'background-color: {{VALUE}};'
						]
					]
				);
				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name'     => 'mas_modal_btn_border_hover',
						'selector' => '{{WRAPPER}} .mas-modal-button .mas-modal-image-action:hover'
					]
				);

			$this->end_controls_tab();
		$this->end_controls_tabs();

        $this->end_controls_section();

		/**
		 * Modal Popup Icon section
		 */
		$this->start_controls_section(
			'mas_modal_icon_section',
			[
				'label' => __( 'Icon', 'mas-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE
				]
		);

		$this->add_control(
			'mas_modal_btn_icon_color',
			[
				'label'     => __( 'Icon Color', 'mas-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .mas-modal-button .mas-modal-image-action span i' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'mas_modal_btn_icon_align',
			[
				'label'     => __( 'Icon Position', 'mas-addons' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'left',
				'options'   => [
					'left'  => __( 'Before', 'mas-addons' ),
					'right' => __( 'After', 'mas-addons' )
				],
				'condition' => [
                    'mas_modal_btn_icon[value]!' => ''
                ]
			]
		);

		$this->add_responsive_control(
			'mas_modal_btn_icon_indent',
			[
				'label'       => __( 'Icon Spacing', 'mas-addons' ),
				'type'        => Controls_Manager::SLIDER,
				'range'       => [
					'px'      => [
						'max' => 50
					]
				],
				'selectors'   => [
					'{{WRAPPER}} .mas-modal-button .mas-modal-image-action span.mas-modal-action-icon-left i' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .mas-modal-button .mas-modal-image-action span.mas-modal-action-icon-right i' => 'margin-left: {{SIZE}}{{UNIT}};'
				],
				'condition'   => [
                    'mas_modal_btn_icon[value]!' => ''
                ]
			]
		);
		$this->end_controls_section();

		/**
		 * Modal Popup Container section
		 */
		$this->start_controls_section(
			'mas_modal_container_section',
			[
				'label' => __( 'Container', 'mas-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'mas_modal_content_align',
			[
				'label'     => __( 'Alignment', 'mas-addons' ),
				'type'      => Controls_Manager::CHOOSE,
				'toggle'    => false,
				'default'   => 'center',
				'options'   => [
					'left'  => [
						'title' => __( 'Left', 'mas-addons' ),
						'icon'  => 'eicon-text-align-left'
					],
					'center'    => [
						'title' => __( 'Center', 'mas-addons' ),
						'icon'  => 'eicon-text-align-center'
					],
					'right'     => [
						'title' => __( 'Right', 'mas-addons' ),
						'icon'  => 'eicon-text-align-right'
					]
				],
				'selectors' => [
					'{{WRAPPER}} .mas-modal-item .mas-modal-content .mas-modal-element' => 'text-align: {{VALUE}};'
				],
				'condition' => [
					'mas_modal_content' => ['image-gallery', 'html_content']
				]
			]
		);

		$this->add_responsive_control(
			'mas_modal_content_height',
			[
				'label' => __( 'Contant Height for Tablet & Mobile', 'mas-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'        => [
					'px'       => [
						'min'  => 0,
						'max'  => 500,
						'step' => 1
					],
					'%'        => [
						'min'  => 0,
						'max'  => 100
					]
				],
				'selectors' => [
					'{{WRAPPER}} .mas-modal-item.modal-vimeo' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'mas_modal_image_gallery_description_typography',
				'selector'  => '{{WRAPPER}} .mas-modal-content .mas-modal-element .mas-modal-element-card .mas-modal-element-card-body p',
				'condition' => [
					'mas_modal_content' => [ 'image-gallery' ]
				]
			]
		);

		$this->add_control(
			'mas_modal_image_gallery_description_color',
			[
				'label'     => __( 'Description Color', 'mas-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mas-modal-content .mas-modal-element .mas-modal-element-card .mas-modal-element-card-body p'  => 'color: {{VALUE}};'
				],
				'condition' => [
					'mas_modal_content' => [ 'image-gallery' ]
				]
			]
		);

        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'mas_modal_content_border',
				'selector' => '{{WRAPPER}} .mas-modal-item .mas-modal-content .mas-modal-element'
			]
		);

		$this->add_control(
			'mas_modal_image_gallery_bg',
			[
				'label'     => __( 'Background Color', 'mas-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .mas-modal-item .mas-modal-content .mas-modal-element'  => 'background: {{VALUE}};'
				],
				'condition' => [
					'mas_modal_content' => ['image-gallery', 'html_content']
				]
			]
		);

		$this->add_control(
			'mas_modal_image_gallery_padding',
			[
				'label'      => __( 'Padding', 'mas-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'    => '10',
					'right'  => '10',
					'bottom' => '10',
					'left'   => '10',
					'unit'   => 'px'
				],
				'selectors'  => [
					'{{WRAPPER}} .mas-modal-item .mas-modal-content .mas-modal-element .mas-modal-element-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .mas-modal-item .mas-modal-content .mas-modal-element' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
				'condition'  => [
					'mas_modal_content' => [ 'image-gallery', 'html_content' ]
				]
			]
		);

        $this->add_responsive_control(
            'mas_modal_image_gallery_description_margin',
            [
                'label'      => __('Margin(Description)', 'mas-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .mas-modal-item .mas-modal-content .mas-modal-element .mas-modal-element-card-body' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
				'condition'  => [
					'mas_modal_content' => [ 'image-gallery' ]
				]
            ]
        );

		$this->add_control(
			'mas_modal_overlay_overflow_x',
			[
				'label'        => __( 'Overflow X', 'mas-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'mas-addons' ),
				'label_off'    => __( 'No', 'mas-addons' ),
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'mas_modal_overlay_overflow_y',
			[
				'label'        => __( 'Overflow Y', 'mas-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'mas-addons' ),
				'label_off'    => __( 'No', 'mas-addons' ),
				'default'      => 'yes',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'mas_modal_animation_tab',
			[
				'label' => __( 'Animation', 'mas-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'mas_modal_transition',
			[
				'label'   => __( 'Style', 'mas-addons' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'top-to-middle',
				'options' => [
					'top-to-middle'    => __( 'Top To Middle', 'mas-addons' ),
					'bottom-to-middle' => __( 'Bottom To Middle', 'mas-addons' ),
					'right-to-middle'  => __( 'Right To Middle', 'mas-addons' ),
					'left-to-middle'   => __( 'Left To Middle', 'mas-addons' ),
					'zoom-in'          => __( 'Zoom In', 'mas-addons' ),
					'zoom-out'         => __( 'Zoom Out', 'mas-addons' ),
					'left-rotate'      => __( 'Rotation', 'mas-addons' )
				]
			]
		);

		$this->end_controls_section();

		/**
		 * Modal Popup overlay style
		 */

		$this->start_controls_section(
			'mas_modal_overlay_tab',
			[
				'label'     => __( 'Overlay', 'mas-addons' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'mas_modal_overlay' => 'yes'
				]
			]
		);

		$this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'            => 'mas_modal_overlay_color',
                'types'           => [ 'classic' ],
                'selector'        => '{{WRAPPER}} .mas-modal-overlay',
                'fields_options'  => [
                    'background'  => [
                        'default' => 'classic'
                    ],
                    'color'       => [
                        'default' => 'rgba(0,0,0,.5)'
                    ]
                ]
            ]
        );

		$this->end_controls_section();

		/**
		 * Modal Popup Close button style
		 */

		$this->start_controls_section(
			'mas_modal_close_btn_style',
			[
				'label' => __( 'Close Button', 'mas-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'mas_modal_close_btn_position',
			[
				'label' => __( 'Close Button Position', 'mas-addons' ),
				'type' => Controls_Manager::POPOVER_TOGGLE,
				'label_off' => __( 'Default', 'mas-addons' ),
				'label_on' => __( 'Custom', 'mas-addons' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
        );

        $this->start_popover();

            $this->add_responsive_control(
                'mas_modal_close_btn_position_x_offset',
                [
                    'label' => __( 'X Offset', 'mas-addons' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range' => [
                        'px' => [
                            'min' => -4000,
                            'max' => 4000,
                        ],
                        '%' => [
                            'min' => -100,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .mas-modal-item.modal-vimeo .mas-modal-content .mas-close-btn' => 'left: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'mas_modal_close_btn_position_y_offset',
                [
                    'label' => __( 'Y Offset', 'mas-addons' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range' => [
                        'px' => [
                            'min' => -4000,
                            'max' => 4000,
                        ],
                        '%' => [
                            'min' => -100,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .mas-modal-item.modal-vimeo .mas-modal-content .mas-close-btn' => 'top: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_popover();

		$this->add_responsive_control(
            'mas_modal_close_btn_icon_size',
            [
				'label'      => __( 'Icon Size', 'mas-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
                    'px'       => [
						'min'  => 0,
						'max'  => 30,
                    ],
                ],
                'default'   => [
                    'unit'  => 'px',
                    'size'  => 20
                ],
                'selectors' => [
					'{{WRAPPER}} .mas-modal-item.modal-vimeo .mas-modal-content .mas-close-btn span::before' => 'width: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .mas-modal-item.modal-vimeo .mas-modal-content .mas-close-btn span::after' => 'height: {{SIZE}}{{UNIT}}'
                ],
            ]
        );

        $this->add_control(
			'mas_modal_close_btn_color',
			[
				'label'     => __( 'Color', 'mas-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .mas-modal-item.modal-vimeo .mas-modal-content .mas-close-btn span::before, {{WRAPPER}} .mas-modal-item.modal-vimeo .mas-modal-content .mas-close-btn span::after'  => 'background: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'mas_modal_close_btn_bg_color',
			[
				'label'    => __( 'Background Color', 'mas-addons' ),
				'type'     => Controls_Manager::COLOR,
				'default'  => 'transparent',
				'selectors' => [
					'{{WRAPPER}} .mas-modal-item.modal-vimeo .mas-modal-content .mas-close-btn'  => 'background: {{VALUE}};'
				]
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings            = $this->get_settings_for_display();

		if( 'youtube' === $settings['mas_modal_content'] ){
			$url = $settings['mas_modal_youtube_video_url'];

			preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $matches);

			$youtube_id = $matches[1];
		}

		if( 'vimeo' === $settings['mas_modal_content'] ){
			$vimeo_url       = $settings['mas_modal_vimeo_video_url'];
			$vimeo_id_select = explode('/', $vimeo_url);
			$vidid           = explode( '&', str_replace('https://vimeo.com', '', end($vimeo_id_select) ) );
			$vimeo_id        = $vidid[0];
		}

		$this->add_render_attribute( 'mas_modal_action', [
			'class'             => 'mas-modal-image-action image-modal',
			'data-mas-modal'   => '#mas-modal-' . $this->get_id(),
			'data-mas-overlay' => esc_attr( $settings['mas_modal_overlay'] )
		] );

		$this->add_render_attribute( 'mas_modal_overlay', [
			'class'                         => 'mas-modal-overlay',
			'data-mas_overlay_click_close' => $settings['mas_modal_overlay_click_close']
		] );

		$this->add_render_attribute( 'mas_modal_item', 'class', 'mas-modal-item' );
		$this->add_render_attribute( 'mas_modal_item', 'class', 'modal-vimeo' );
		$this->add_render_attribute( 'mas_modal_item', 'class', $settings['mas_modal_transition'] );
		$this->add_render_attribute( 'mas_modal_item', 'class', $settings['mas_modal_content'] );
		$this->add_render_attribute( 'mas_modal_item', 'class', esc_attr('mas-content-overflow-x-' . $settings['mas_modal_overlay_overflow_x'] ) );
		$this->add_render_attribute( 'mas_modal_item', 'class', esc_attr('mas-content-overflow-y-' . $settings['mas_modal_overlay_overflow_y'] ) );
		?>

		<div class="mas-modal">
			<div class="mas-modal-wrapper">

				<div class="mas-modal-button mas-modal-btn-fixed-width-<?php echo esc_attr($settings['mas_modal_btn_enable_fixed_width_height']);?>">
					<a href="#" <?php echo $this->get_render_attribute_string('mas_modal_action');?> >
						<span class="mas-modal-action-icon-<?php echo esc_attr($settings['mas_modal_btn_icon_align']);?>">
							<?php if( 'left' === $settings['mas_modal_btn_icon_align'] && !empty( $settings['mas_modal_btn_icon']['value'] ) ) {
								Icons_Manager::render_icon( $settings['mas_modal_btn_icon'], [ 'aria-hidden' => 'true' ] );
							}
							echo esc_html( $settings['mas_modal_btn_text'] );
							if( 'right' === $settings['mas_modal_btn_icon_align'] && !empty( $settings['mas_modal_btn_icon']['value'] ) ) {
								Icons_Manager::render_icon( $settings['mas_modal_btn_icon'], [ 'aria-hidden' => 'true' ] );
							} ;?>
						</span>
					</a>
				</div>

				<div id="mas-modal-<?php echo esc_attr( $this->get_id() );?>" <?php echo $this->get_render_attribute_string('mas_modal_item') ;?> >
					<div class="mas-modal-content">
						<div class="mas-modal-element <?php echo esc_attr( $settings['mas_modal_image_gallery_column'] );?>">
							<?php if ( 'image' === $settings['mas_modal_content'] ) {
								echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'mas_modal_image' );
							}

							if ( 'image-gallery' === $settings['mas_modal_content'] ) {
								foreach ( $settings['mas_modal_image_gallery_repeater'] as $gallery ) : ?>
									<div class="mas-modal-element-card">
										<div class="mas-modal-element-card-thumb">
											<?php echo Group_Control_Image_Size::get_attachment_image_html( $gallery, 'thumbnail', 'mas_modal_image_gallery' );?>
										</div>
										<?php if ( !empty( $gallery['mas_modal_image_gallery_text'] ) ) {?>
											<div class="mas-modal-element-card-body">
												<p><?php echo wp_kses_post( $gallery['mas_modal_image_gallery_text'] );?></p>
											</div>
										<?php } ;?>
									</div>
								<?php
								endforeach;
							}

							if ( 'html_content' === $settings['mas_modal_content'] ) { ?>
								<div class="mas-modal-element-body">
									<p><?php echo wp_kses_post( $settings['mas_modal_html_content'] );?></p>
								</div>
							<?php }

							if ( 'youtube' === $settings['mas_modal_content'] ) { ?>
								<iframe src="https://www.youtube.com/embed/<?php echo esc_attr( $youtube_id );?>" frameborder="0" allowfullscreen></iframe>
							<?php }

							if ( 'vimeo' === $settings['mas_modal_content'] ) { ?>
								<iframe id="vimeo-video" src="https://player.vimeo.com/video/<?php echo esc_attr( $vimeo_id );?>" frameborder="0" allowfullscreen ></iframe>
							<?php }

							if ( 'external-video' === $settings['mas_modal_content'] ) { ?>
								<video class="mas-video-hosted" src="<?php echo esc_url( $settings['mas_modal_external_video']['url'] );?>" controls="" controlslist="nodownload">
								</video>
							<?php }

							if ( 'external_page' === $settings['mas_modal_content'] ) { ?>
								<iframe src="<?php echo esc_url( $settings['mas_modal_external_page_url'] );?>" frameborder="0" allowfullscreen ></iframe>
							<?php }

							if ( 'shortcode' === $settings['mas_modal_content'] ) {
								echo do_shortcode( $settings['mas_modal_shortcode'] );
							} ;?>

							<div class="mas-close-btn">
								<span></span>
							</div>

						</div>
					</div>
				</div>
			</div>
			<div <?php echo $this->get_render_attribute_string('mas_modal_overlay');?>></div>
		</div>
	<?php
	}
}
$widgets_manager->register( new \Mas_Addons\Widgets\Mas_Modal_Popup() );