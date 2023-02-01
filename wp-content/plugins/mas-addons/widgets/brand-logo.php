<?php
namespace Mas_Addons\Widgets;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Icons_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Widget_Base;
/**
 * Elementor icon widget.
 *
 * Elementor widget that displays an icon from over 600+ icons.
 *
 * @since 1.0.0
 */
class Mas_Addons_Brand_Logo extends Widget_Base {
	/**
	 * Get widget name.
	 *
	 * Retrieve icon widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'mas-addons-brand-logo';
	}
	/**
	 * Get widget title.
	 *
	 * Retrieve icon widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Brand Logo');
	}
	/**
	 * Get widget icon.
	 *
	 * Retrieve icon widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-hotspot';
	}
	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the icon widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * @since 2.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'mas-addons' ];
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
		return [ 'client logo', 'drand', 'fd addons' ];
	}
	/**
	 * Register icon widget controls.
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
            'content_section',
            [
                'label' => __('Content', 'mas-addons'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'image',
            [
                'label' => __('Image', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::MEDIA,
            ]
        );
        $repeater->add_control(
            'image_size',
            [
                'label' => __('Image Dimension', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::IMAGE_DIMENSIONS,
                'description' => __('Crop the original image size to any custom size. Set custom width or height to keep the original size ratio.', 'plugin-name'),
                'default' => [
                    'width' => '',
                    'height' => '',
                ],
            ]
        );

        $this->add_control(
            'image_lists',
            [
                'label' => __('Image Items', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
            ]
        );
        $this->end_controls_section();

        // SLIDER SETTINGS
        $this->start_controls_section(
            'slider_settings',
            [
                'label' => __('Selider Settings', 'mas-addons'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_responsive_control(
			'per_coulmn',
			[
				'label' => __( 'Slider Items', 'mas-addons' ),
				'type' => Controls_Manager::SELECT,
				'default'            => 4,
				'tablet_default'     => 2,
				'mobile_default'     => 1,
				'options'            => [
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'5' => '5',
				],
				'frontend_available' => true,
			]
		);


        $this->add_control(
            'dots',
            [
                'label' => __('Show Dots?', 'mas-addons'),
                'type'  => \Elementor\Controls_Manager::SWITCHER,
                'label_on'  => __('Show', 'mas-addons'),
                'label_off' => __('Hide', 'mas-addons'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'arrows',
            [
                'label' => __( 'Show arrows?', 'mas-addons' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'mas-addons' ),
                'label_off' => __( 'Hide', 'mas-addons' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
           );


        $this->add_responsive_control(
			'dots_x_position',
			[
				'label' => __( 'Dots x position', 'mas-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => -1000,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
                ],
                'selectors' => [
					'{{WRAPPER}} .brand-logos-dots .slick-dots' => 'left: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'dots' => 'yes',
                ]
	
			]
        );
        $this->add_responsive_control(
			'dots_y_position',
			[
				'label' => __( 'Dots y position', 'mas-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => -1000,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
                ],
                'selectors' => [
					'{{WRAPPER}} .brand-logos-dots .slick-dots' => 'bottom: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'dots' => 'yes',
                ]
	
			]
        );
        $this->add_control(
            'autoplay',
            [
                'label' => __('Auto Play?', 'mas-addons'),
                'type'  => \Elementor\Controls_Manager::SWITCHER,
                'label_on'  => __('Show', 'mas-addons'),
                'label_off' => __('Hide', 'mas-addons'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'loop',
            [
                'label' => __('Infinite Loop', 'mas-addons'),
                'type'  => \Elementor\Controls_Manager::SWITCHER,
                'label_on'  => __('Show', 'mas-addons'),
                'label_off' => __('Hide', 'mas-addons'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'autoplaytimeout',
            [
                'label' => __('Autoplay Timeout', 'mas-addons'),
                'type'  => \Elementor\Controls_Manager::SELECT,
                'label_block' => true,
                'default' => '5000',
                'options' => [
                    '1000'  => __('1 Second', 'mas-addons'),
                    '2000'  => __('2 Second', 'mas-addons'),
                    '3000'  => __('3 Second', 'mas-addons'),
                    '4000'  => __('4 Second', 'mas-addons'),
                    '5000'  => __('5 Second', 'mas-addons'),
                    '6000'  => __('6 Second', 'mas-addons'),
                    '7000'  => __('7 Second', 'mas-addons'),
                    '8000'  => __('8 Second', 'mas-addons'),
                    '9000'  => __('9 Second', 'mas-addons'),
                    '10000' => __('10 Second', 'mas-addons'),
                    '11000' => __('11 Second', 'mas-addons'),
                    '12000' => __('12 Second', 'mas-addons'),
                    '13000' => __('13 Second', 'mas-addons'),
                    '14000' => __('14 Second', 'mas-addons'),
                    '15000' => __('15 Second', 'mas-addons'),
                ],
                'condition' => [
                    'autoplay' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'arrow_prev_icon',
            [
                'label' => __( 'Previous Icon', 'advis' ),
                'label_block' => false,
                'type' => \Elementor\Controls_Manager::ICONS,
                'skin' => 'inline',
                'default' => [
                    'value' => 'fas fa-chevron-left',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'arrows' => 'yes',
                ],
            ]
           );
           
           $this->add_control(
            'arrow_next_icon',
            [
                'label' => __( 'Next Icon', 'advis' ),
                'label_block' => false,
                'type' => \Elementor\Controls_Manager::ICONS,
                'skin' => 'inline',
                'default' => [
                    'value' => 'fas fa-chevron-right',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'arrows' => 'yes',
                ],
            ]
           );


        $this->end_controls_section();


        $this->start_controls_section(
            'content_style',
            [
                'label' => __('Dots Style', 'mas-addons'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        // $this->add_control(
        //     'dots_color', [
        //         'label'         =>   __( 'Color', 'mas-addons' ),
        //         'type'          =>  \Elementor\Controls_Manager::COLOR,
        //         'default'       =>  __( '#f7f9fc' , 'mas-addons' ),
        //         'selectors' => [
        //             '{{WRAPPER}} .brand-logos-dots .slick-dots li' => 'background-color: {{VALUE}}',
        //         ],
        //     ]
        // );

        

        // $this->add_responsive_control(
        //     'bots_width_height',
        //     [
        //         'label'          => __('Size', 'mas-addons'),
        //         'type'           => Controls_Manager::SLIDER,
        //         'default'        => [
        //             'unit' => 'px',
        //         ],
        //         'range'          => [
        //             'px' => [
        //                 'min' => 1,
        //                 'max' => 100,
        //             ],
        //         ],
        //         'selectors'      => [
        //             '{{WRAPPER}} .brand-logos-dots .slick-dots li button' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}',
        //             '{{WRAPPER}} .brand-logos-dots .slick-dots li' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}',
        //         ],
        //     ]
        // );
        $this->start_controls_tabs('_tabs_dots');

        $this->start_controls_tab(
            '_tab_dots_normal',
            [
                'label' => __('Normal', 'mas-addons'),
            ]
        );
        
        $this->add_control(
            'dots_color',
            [
                'label' => __('Color', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .brand-logos-dots .slick-dots li' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'dots_box_width',
            [
                'label' => __('Width', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .brand-logos-dots .slick-dots li button' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .brand-logos-dots .slick-dots li' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'dots_box_height',
            [
                'label' => __('Height', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .brand-logos-dots .slick-dots li button' => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .brand-logos-dots .slick-dots li' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'dots_gap',
            [
                'label'      => __('Margin', 'mas-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .brand-logos-dots' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .brand-logos-dots' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'dots_margin',
            [
                'label'      => __('Dots Gap', 'mas-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .brand-logos-dots .slick-dots li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .brand-logos-dots .slick-dots li' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'dots_border_radius',
            [
                'label'      => __('Border Radius', 'mas-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .brand-logos-dots .slick-dots li' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .brand-logos-dots .slick-dots li' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                    '{{WRAPPER}} .brand-logos-dots .slick-dots li button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .brand-logos-dots .slick-dots li button' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();
        
        $this->start_controls_tab(
            '_tab_dots_active',
            [
                'label' => __('Active', 'mas-addons'),
            ]
        );
        $this->add_control(
            'dots_active_color', [
                'label'         =>   __( 'Active Color', 'mas-addons' ),
                'type'          =>  \Elementor\Controls_Manager::COLOR,
                'default'       =>  __( '#ffd166' , 'mas-addons' ),
                'selectors' => [
                    '{{WRAPPER}} .brand-logos-dots .slick-dots li.slick-active' => 'background-color: {{VALUE}} !important',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'arrow_dots_box_active_width',
            [
                'label' => __('Width', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .brand-logos-dots .slick-dots li.slick-active' => 'width: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'arrow_dots_box_active_height',
            [
                'label' => __('Height', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .brand-logos-dots .slick-dots li.slick-active' => 'height: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();

        

    $this->end_controls_section();


    /*
    * 
        Arrows
    */
    $this->start_controls_section(
        'arrows_navigation',
        [
            'label' => __('Navigation - Arrow', 'mas-addons'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            'condition' => [
                'arrows' => 'yes',
            ],
        ]
    );

    $this->start_controls_tabs('_tabs_arrow');

    $this->start_controls_tab(
        '_tab_arrow_normal',
        [
            'label' => __('Normal', 'mas-addons'),
        ]
    );

    $this->add_control(
        'arrow_color',
        [
            'label' => __('Color', 'mas-addons'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'default' => '',
            'selectors' => [
                '{{WRAPPER}} .brand-logo-slider-arrow button' => 'color: {{VALUE}}; border-color: {{VALUE}};',
                '{{WRAPPER}} .brand-logo-slider-arrow button svg path' => 'stroke: {{VALUE}};',
            ],
        ]
    );

    $this->add_control(
        'arrow_color_fill',
        [
            'label' => __('Line Color', 'mas-addons'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'default' => '',
            'selectors' => [
                '{{WRAPPER}} .brand-logo-slider-arrow button' => 'color: {{VALUE}};',
                '{{WRAPPER}} .brand-logo-slider-arrow button svg path' => 'fill: {{VALUE}};',
            ],
        ]
    );

    $this->add_control(
        'arrow_bg_color',
        [
            'label' => __('Background Color', 'mas-addons'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .brand-logo-slider-arrow button' => 'background-color: {{VALUE}} !important;',
            ],
        ]
    );

    $this->add_group_control(
        \Elementor\Group_Control_Box_Shadow::get_type(),
        [
            'name' => 'arrow_shadow',
            'label' => __('Shadow', 'mas-addons'),
            'selector' => '{{WRAPPER}} .brand-logo-slider-arrow button ',
        ]
    );

    $this->add_control(
        'arrow_position_toggle',
        [
            'label' => __('Position', 'mas-addons'),
            'type' => \Elementor\Controls_Manager::POPOVER_TOGGLE,
            'label_off' => __('None', 'mas-addons'),
            'label_on' => __('Custom', 'mas-addons'),
            'return_value' => 'yes',
        ]
    );
    $this->start_popover();

    /* 
    Arrow Position
    */
     $start = is_rtl() ? __( 'Right', 'elementor' ) : __( 'Left', 'elementor' );
     $end = ! is_rtl() ? __( 'Right', 'elementor' ) : __( 'Left', 'elementor' );

     /* tobol */
     $this->add_control(
        'offset_orientation_v',
        [
            'label' => __( 'Vertical Orientation', 'elementor' ),
            'type' => \Elementor\Controls_Manager::CHOOSE,
            'toggle' => false,
            'default' => 'start',
            'options' => [
                'top' => [
                    'title' => __( 'Top', 'elementor' ),
                    'icon' => 'eicon-v-align-top',
                ],
                'bottom' => [
                    'title' => __( 'Bottom', 'elementor' ),
                    'icon' => 'eicon-v-align-bottom',
                ],
            ],
            'render_type' => 'ui',
            'selectors' => [
                '{{WRAPPER}} .brand-logo-slider-arrow' => '{{VALUE}}: 0;',
            ],

        ]
    );

    $this->add_responsive_control(
        'arrow_position_top',
        [
            'label' => __('Vertical', 'mas-addons'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => ['%','px'],
            'condition' => [
                'arrow_position_toggle' => 'yes'
            ],
            'range' => [
                'px' => [
                    'min' => -1000,
                    'max' => 1000,
                ],
                '%' => [
                    'min' => -100,
                    'max' => 100,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .brand-logo-slider-arrow' => 'top: {{SIZE}}{{UNIT}} !important; bottom:auto',
            ],
            'condition' => [
                'offset_orientation_v' => 'top',
            ],
        ]
    );      


    $this->add_responsive_control(
    'arrow_position_bottom',
    [
        'label' => __('Vertical', 'mas-addons'),
        'type' => \Elementor\Controls_Manager::SLIDER,
        'size_units' => ['%','px'],
        'condition' => [
            'arrow_position_toggle' => 'yes'
        ],
        'range' => [
            'px' => [
                'min' => -1000,
                'max' => 1000,
            ],
            '%' => [
                'min' => -100,
                'max' => 100,
            ],
        ],
        'selectors' => [
            '{{WRAPPER}} .brand-logo-slider-arrow' => 'bottom: {{SIZE}}{{UNIT}} !important; top:auto',
        ],
        'condition' => [
            'offset_orientation_v' => 'bottom',
        ],
    ]
    );


    $this->add_control(
        'arrow_horizontal_position',
        [
            'label'             => __( 'Horizontal Position', 'mas-addons' ),
            'type'              => \Elementor\Controls_Manager::SELECT,
            'default'           => 'default',
            'options'           => [
                'default'    =>   __('Default',    'mas-addons'),
                'space_between'    =>   __('Space Between',    'mas-addons'),
            ],
            'separator' => 'after',
        ]
    );
    $this->add_responsive_control(
        'arrow_position_x_prev',
        [
            'label' => __( 'Horizontal Prev', 'happy-elementor-addons' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => ['px', '%'],
            'condition' => [
                'arrow_position_toggle' => 'yes'
            ],
            'range' => [
                'px' => [
                    'min' => -200,
                    'max' => 2000,
                ],
                '%' => [
                    'min' => -200,
                    'max' => 200,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}}  .brand-logo-slider-arrow .prev' => 'left: {{SIZE}}{{UNIT}} !important; right: auto !important;',
            ],
            'condition' => [
                'arrow_horizontal_position' => 'space_between',
            ],

        ]
    );



// default == arrow gap
// space-between == left position, right position

    $this->add_responsive_control(
        'arrow_position_right',
        [
            'label' => __( 'Horizontal Next', 'happy-elementor-addons' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => ['px', '%'],
            'range' => [
                'px' => [
                    'min' => -2000,
                    'max' => 1000,
                ],
                '%' => [
                    'min' => -200,
                    'max' => 200,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .brand-logo-slider-arrow .next' => 'right: {{SIZE}}{{UNIT}} !important; left: auto !important;',
            ],
            'condition' => [
                'arrow_horizontal_position' => 'space_between',
            ],
        ]
    );

    $this->add_responsive_control(
        'arrow_gap_',
        [
            'label' => __( 'Arrow Gap', 'happy-elementor-addons' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => ['px', '%'],
            'range' => [
                'px' => [
                    'max' => 1000,
                ],
                '%' => [
                    'max' => 100,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .brand-logo-slider-arrow .prev' => 'margin-right: {{SIZE}}{{UNIT}} !important; position: relative !important',
                '{{WRAPPER}} .brand-logo-slider-arrow .next ' => 'margin-right: 0 !important; position: relative !important',
            ],
            'condition' => [
                'arrow_horizontal_position' => 'default',
            ],
        ]
    );

    $this->add_responsive_control(
        'align_arrow',
        [
            'label' => __( 'Alignment', 'mas-addons' ),
            'type' => \Elementor\Controls_Manager::CHOOSE,
            'options' => [
                'left' => [
                    'title' => __( 'Left', 'mas-addons' ),
                    'icon' => 'eicon-text-align-left',
                ],
                'center' => [
                    'title' => __( 'Center', 'mas-addons' ),
                    'icon' => 'eicon-text-align-center',
                ],
                'right' => [
                    'title' => __( 'Right', 'mas-addons' ),
                    'icon' => 'eicon-text-align-right',
                ],
            ],
            'default' => 'left',
            'selectors' => [
                '{{WRAPPER}} .brand-logo-slider-arrow' => 'text-align: {{VALUE}};',
            ],
            'condition' => [
                'arrow_horizontal_position' => 'default',
            ],
        ]
    );

    $this->end_popover();

    $this->add_responsive_control(
        'arrow_icon_size',
        [
            'label' => __('Icon Size', 'mas-addons'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 10,
                    'max' => 150,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}}  .brand-logo-slider-arrow button i' => 'font-size: {{SIZE}}{{UNIT}}',
                '{{WRAPPER}}  .brand-logo-slider-arrow button svg' => 'width: {{SIZE}}{{UNIT}}',
            ],
        ]
    );

    $this->add_responsive_control(
        'arrow_size_box',
        [
            'label' => __('Size', 'mas-addons'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 20,
                    'max' => 150,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .brand-logo-slider-arrow button' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}',
            ],
        ]
        
    );

    $this->add_responsive_control(
        'arrow_size_line_height',
        [
            'label' => __('Line Height', 'mas-addons'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 150,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .brand-logo-slider-arrow button' => 'line-height: {{SIZE}}{{UNIT}} !important;',
            ],
        ]
        
    );

    $this->add_responsive_control(
        'arrows_border_radius',
        [
            'label'      => __('Border Radius', 'mas-addons'),
            'type'       => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px'],
            'selectors'  => [
                '{{WRAPPER}} .brand-logo-slider-arrow button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                'body.rtl {{WRAPPER}} .brand-logo-slider-arrow button ' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
            ],
        ]
    );
    $this->end_controls_tab();

    $this->start_controls_tab(
        '_tab_arrow_hover',
        [
            'label' => __('Active', 'mas-addons'),
        ]
    );

    $this->add_control(
        'arrow_hover_color',
        [
            'label' => __('Color', 'mas-addons'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .brand-logo-slider-arrow .slick-active' => 'color: {{VALUE}};',
                '{{WRAPPER}} .brand-logo-slider-arrow button:hover ' => 'color: {{VALUE}};',
                '{{WRAPPER}} .brand-logo-slider-arrow .slick-active svg path' => 'stroke: {{VALUE}};',
                '{{WRAPPER}} .brand-logo-slider-arrow button:hover svg path ' => 'stroke: {{VALUE}};',
            ],
        ]
    );

    $this->add_control(
        'arrow_hover_fill_color',
        [
            'label' => __('Line Color', 'mas-addons'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .brand-logo-slider-arrow .slick-active' => 'color: {{VALUE}};',
                '{{WRAPPER}} .brand-logo-slider-arrow button:hover ' => 'color: {{VALUE}};',
                '{{WRAPPER}} .brand-logo-slider-arrow .slick-active path' => 'fill: {{VALUE}};',
                '{{WRAPPER}} .brand-logo-slider-arrow button:hover path' => 'fill: {{VALUE}};',
            ],
        ]
    );

    $this->add_control(
        'arrow_bg_hover_color',
        [
            'label' => __('Background Color Hover', 'mas-addons'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .brand-logo-slider-arrow button:hover ' => 'background-color: {{VALUE}}  !important;',
                '{{WRAPPER}} .brand-logo-slider-arrow .slick-active ' => 'background-color: {{VALUE}}  !important;',
            ],
        ]
    );

    $this->end_controls_tab();
    $this->end_controls_tabs();

    $this->end_controls_section();
    //SLider control style End


    $this->end_controls_section();
    }
	/**
	 * Render icon widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render()
    {
        $settings = $this->get_settings_for_display();

        $image_lists = $settings['image_lists'];

        //this code slider option
        $advis_drand_logo = array(
            'loop'     => (!empty($settings['loop']) && 'yes' === $settings['loop']) ? true : false,
            'autoplay' => (!empty($settings['autoplay']) && 'yes' === $settings['autoplay']) ? true : false,
            'nav'      => (!empty($settings['arrows']) && 'yes' === $settings['arrows']) ? true : false,
            'dots'     => (!empty($settings['dots']) && 'yes' === $settings['dots']) ? true : false,
            'autoplaytimeout' => !empty($settings['autoplaytimeout']) ? $settings['autoplaytimeout'] : '5000',
            //this a responsive layout
             'per_coulmn' =>        (!empty($settings['per_coulmn'])) ? $settings['per_coulmn'] : 3,
             'per_coulmn_tablet' => (!empty($settings['per_coulmn_tablet'])) ? $settings['per_coulmn_tablet'] : 2,
             'per_coulmn_mobile' => (!empty($settings['per_coulmn_mobile'])) ? $settings['per_coulmn_mobile'] : 1
        );

        $brnad_logo_jasondecode = wp_json_encode($advis_drand_logo);
        ?>
         <div class="bg-purple-heart">
            <!-- brand-logo Area -->
            <div class="brand-logo-slider-wrapper">
                <div class="brand-logo-slider" data-brand='<?php echo esc_attr($brnad_logo_jasondecode) ?>'>
                    <!-- single-slide Area -->
                    <?php foreach ($image_lists as $list) : ?>
                        <div class="single-slide">
                            <div class="brand-logo-image">
                            <?php echo \Elementor\Group_Control_Image_Size::get_attachment_image_html($list, 'image_size', 'image'); ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>


            <div class="brand-logos-dots"></div>
            <?php if ( 'yes' == $settings['arrows']): ?>                       
                <div class="brand-logo-slider-arrow">
                    <?php if ( ! empty( $settings['arrow_prev_icon']['value'] ) ) : ?>
                        <button type="button" class="slick-prev prev slick-arrow slick-active prev-<?php echo esc_attr( $this->get_ID()); ?>">
                            <?php \Elementor\Icons_Manager::render_icon( $settings['arrow_prev_icon'], ['aria-hidden' => 'true'] ); ?>
                        </button>
                    <?php endif; ?>
                    
                    <?php if ( ! empty( $settings['arrow_next_icon']['value'] ) ) : ?>
                        <button type="button" class="slick-next next slick-arrow next-<?php echo esc_attr( $this->get_ID()); ?>">
                            <?php \Elementor\Icons_Manager::render_icon( $settings['arrow_next_icon'], ['aria-hidden' => 'true'] ); ?>
                        </button>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    <?php
    }
}
$widgets_manager->register( new \Mas_Addons\Widgets\Mas_Addons_Brand_Logo() );