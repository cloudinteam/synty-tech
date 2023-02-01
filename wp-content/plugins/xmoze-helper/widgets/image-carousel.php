<?php
/**
 * xmoze Image Carousel.
 *
 *
 * @since 1.0.0
 */
use  Elementor\Widget_Base;
use  Elementor\Controls_Manager;
use  Elementor\utils;
use  Elementor\Group_Control_Typography;
use  Elementor\Group_Control_Box_Shadow;
use  Elementor\Group_Control_Background;
use  Elementor\Group_Control_Border;
use  Elementor\Embed;
use  Elementor\Icons_Manager;
if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Xmoze_Imagecarousel extends \Elementor\Widget_Base
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
        return 'xmoze-image-carousels';
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
        return __('Image Carousel', 'xmoze-hp');
    }

    public function get_keywords(){
        return ['iamge ', 'carousel','app', 'mobile' ];
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
        return 'eicon-image-rollover';
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
        return ['xmoze-addons'];
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
            'content_section',
            [
                'label' => __('Content', 'xmoze-hp'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'frame_image',
            [
                'label' => __('Frame', 'xmoze-hp'),
                'type' => \Elementor\Controls_Manager::MEDIA,
            ]
        );
        $this->add_control(
            'frame_size',
            [
                'label' => __('Frame image Dimension', 'xmoze-hp'),
                'type' => \Elementor\Controls_Manager::IMAGE_DIMENSIONS,
                'description' => __('Crop the original image size to any custom size. Set custom width or height to keep the original size ratio.', 'plugin-name'),
            ]
        );
        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'image',
            [
                'label' => __('Image', 'xmoze-hp'),
                'type' => \Elementor\Controls_Manager::MEDIA,
            ]
        );
        $repeater->add_control(
            'image_size',
            [
                'label' => __('Image Dimension', 'xmoze-hp'),
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
                'label' => __('Image Items', 'xmoze-hp'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
            ]
        );
        $this->end_controls_section();

        // SLIDER SETTINGS
        $this->start_controls_section(
            'slider_settings',
            [
                'label' => __('Selider Settings', 'xmoze-hp'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        


        // $this->add_control(
        //     'arrows',
        //     [
        //         'label' => __('Show arrows?', 'xmoze-hp'),
        //         'type'  => \Elementor\Controls_Manager::SWITCHER,
        //         'label_on'  => __('Show', 'xmoze-hp'),
        //         'label_off' => __('Hide', 'xmoze-hp'),
        //         'return_value' => 'yes',
        //         'default' => 'yes',
        //     ]
        // );
        // $this->add_responsive_control(
		// 	'arrow_x_position',
		// 	[
		// 		'label' => __( 'Arrow x position', 'xmoze-hp' ),
		// 		'type' => \Elementor\Controls_Manager::SLIDER,
		// 		'size_units' => [ 'px', '%' ],
		// 		'range' => [
		// 			'px' => [
		// 				'min' => 0,
		// 				'max' => 1000,
		// 				'step' => 1,
		// 			],
		// 			'%' => [
		// 				'min' => 0,
		// 				'max' => 100,
		// 			],
        //         ],
        //         'selectors' => [
		// 			'{{WRAPPER}} .xmoze-image-carousel .slick-prev' => 'left: {{SIZE}}{{UNIT}};',
		// 			'{{WRAPPER}} .xmoze-image-carousel .slick-next' => 'right: {{SIZE}}{{UNIT}};',

        //         ],
        //         'condition' => [
        //             'arrows' => 'yes',
        //         ]
	
		// 	]
        // );
        // $this->add_responsive_control(
		// 	'arrow_y_position',
		// 	[
		// 		'label' => __( 'Arrow y position', 'xmoze-hp' ),
		// 		'type' => \Elementor\Controls_Manager::SLIDER,
		// 		'size_units' => [ 'px', '%' ],
		// 		'range' => [
		// 			'px' => [
		// 				'min' => -1000,
		// 				'max' => 1000,
		// 				'step' => 1,
		// 			],
		// 			'%' => [
		// 				'min' => 0,
		// 				'max' => 100,
		// 			],
        //         ],
        //         'selectors' => [
		// 			'{{WRAPPER}} .xmoze-image-carousel .slick-arrow' => 'top: {{SIZE}}{{UNIT}};',
        //         ],
        //         'condition' => [
        //             'arrows' => 'yes',
        //         ]
	
		// 	]
        // );

        $this->add_control(
            'dots',
            [
                'label' => __('Show Dots?', 'xmoze-hp'),
                'type'  => \Elementor\Controls_Manager::SWITCHER,
                'label_on'  => __('Show', 'xmoze-hp'),
                'label_off' => __('Hide', 'xmoze-hp'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'arrows',
            [
                'label' => __( 'Show arrows?', 'xmoze-hp' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'xmoze-hp' ),
                'label_off' => __( 'Hide', 'xmoze-hp' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
           );


        $this->add_responsive_control(
			'dots_x_position',
			[
				'label' => __( 'Dots x position', 'xmoze-hp' ),
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
					'{{WRAPPER}} .screenshots-dots .slick-dots' => 'left: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'dots' => 'yes',
                ]
	
			]
        );
        $this->add_responsive_control(
			'dots_y_position',
			[
				'label' => __( 'Dots y position', 'xmoze-hp' ),
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
					'{{WRAPPER}} .screenshots-dots .slick-dots' => 'bottom: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'dots' => 'yes',
                ]
	
			]
        );
        $this->add_control(
            'autoplay',
            [
                'label' => __('Auto Play?', 'xmoze-hp'),
                'type'  => \Elementor\Controls_Manager::SWITCHER,
                'label_on'  => __('Show', 'xmoze-hp'),
                'label_off' => __('Hide', 'xmoze-hp'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'loop',
            [
                'label' => __('Infinite Loop', 'xmoze-hp'),
                'type'  => \Elementor\Controls_Manager::SWITCHER,
                'label_on'  => __('Show', 'xmoze-hp'),
                'label_off' => __('Hide', 'xmoze-hp'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'autoplaytimeout',
            [
                'label' => __('Autoplay Timeout', 'xmoze-hp'),
                'type'  => \Elementor\Controls_Manager::SELECT,
                'label_block' => true,
                'default' => '5000',
                'options' => [
                    '1000'  => __('1 Second', 'xmoze-hp'),
                    '2000'  => __('2 Second', 'xmoze-hp'),
                    '3000'  => __('3 Second', 'xmoze-hp'),
                    '4000'  => __('4 Second', 'xmoze-hp'),
                    '5000'  => __('5 Second', 'xmoze-hp'),
                    '6000'  => __('6 Second', 'xmoze-hp'),
                    '7000'  => __('7 Second', 'xmoze-hp'),
                    '8000'  => __('8 Second', 'xmoze-hp'),
                    '9000'  => __('9 Second', 'xmoze-hp'),
                    '10000' => __('10 Second', 'xmoze-hp'),
                    '11000' => __('11 Second', 'xmoze-hp'),
                    '12000' => __('12 Second', 'xmoze-hp'),
                    '13000' => __('13 Second', 'xmoze-hp'),
                    '14000' => __('14 Second', 'xmoze-hp'),
                    '15000' => __('15 Second', 'xmoze-hp'),
                ],
                'condition' => [
                    'autoplay' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'arrow_prev_icon',
            [
                'label' => __( 'Previous Icon', 'xmoze' ),
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
                'label' => __( 'Next Icon', 'xmoze' ),
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
                'label' => __('Dots Style', 'xmoze-hp'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'dots_color', [
                'label'         =>   __( 'Color', 'xmoze-hp' ),
                'type'          =>  \Elementor\Controls_Manager::COLOR,
                'default'       =>  __( '#f7f9fc' , 'xmoze-hp' ),
                'selectors' => [
                    '{{WRAPPER}} .screenshots-dots .slick-dots li' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'dots_active_color', [
                'label'         =>   __( 'Active Color', 'xmoze-hp' ),
                'type'          =>  \Elementor\Controls_Manager::COLOR,
                'default'       =>  __( '#ffd166' , 'xmoze-hp' ),
                'selectors' => [
                    '{{WRAPPER}} .screenshots-dots .slick-dots li.slick-active' => 'background-color: {{VALUE}} !important',
                ],
            ]
        );

        $this->add_responsive_control(
            'bots_width_height',
            [
                'label'          => __('Size', 'xmoze-hp'),
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
                    '{{WRAPPER}} .screenshots-dots .slick-dots li button' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}} .screenshots-dots .slick-dots li' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'dots_margin',
            [
                'label'      => __('Dots Gap', 'xmoze-hp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .screenshots-dots .slick-dots li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .screenshots-dots .slick-dots li' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'dots_border_radius',
            [
                'label'      => __('Border Radius', 'xmoze-hp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .screenshots-dots .slick-dots li' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .screenshots-dots .slick-dots li' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                    '{{WRAPPER}} .screenshots-dots .slick-dots li button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .screenshots-dots .slick-dots li button' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'dots_gap',
            [
                'label'      => __('Margin', 'xmoze-hp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .screenshots-dots' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .screenshots-dots' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );

        

        $this->end_controls_section();


 /*
   * 
    Arrows
   */
  $this->start_controls_section(
    'arrows_navigation',
    [
        'label' => __('Navigation - Arrow', 'xmoze-hp'),
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
        'label' => __('Normal', 'xmoze-hp'),
    ]
);

$this->add_control(
    'arrow_color',
    [
        'label' => __('Color', 'xmoze-hp'),
        'type' => \Elementor\Controls_Manager::COLOR,
        'default' => '',
        'selectors' => [
            '{{WRAPPER}} .screenshot-slider-arrow button' => 'color: {{VALUE}}; border-color: {{VALUE}};',
            '{{WRAPPER}} .screenshot-slider-arrow button svg path' => 'stroke: {{VALUE}};',
        ],
    ]
);

$this->add_control(
    'arrow_color_fill',
    [
        'label' => __('Line Color', 'xmoze-hp'),
        'type' => \Elementor\Controls_Manager::COLOR,
        'default' => '',
        'selectors' => [
            '{{WRAPPER}} .screenshot-slider-arrow button' => 'color: {{VALUE}};',
            '{{WRAPPER}} .screenshot-slider-arrow button svg path' => 'fill: {{VALUE}};',
        ],
    ]
);

$this->add_control(
    'arrow_bg_color',
    [
        'label' => __('Background Color', 'xmoze-hp'),
        'type' => \Elementor\Controls_Manager::COLOR,
        'selectors' => [
             '{{WRAPPER}} .screenshot-slider-arrow button' => 'background-color: {{VALUE}} !important;',
        ],
    ]
);

$this->add_group_control(
    \Elementor\Group_Control_Box_Shadow::get_type(),
    [
        'name' => 'arrow_shadow',
        'label' => __('Shadow', 'fd-addons'),
        'selector' => '{{WRAPPER}} .screenshot-slider-arrow button ',
    ]
);

$this->add_control(
    'arrow_position_toggle',
    [
        'label' => __('Position', 'xmoze-hp'),
        'type' => \Elementor\Controls_Manager::POPOVER_TOGGLE,
        'label_off' => __('None', 'xmoze-hp'),
        'label_on' => __('Custom', 'xmoze-hp'),
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
                '{{WRAPPER}} .screenshot-slider-arrow' => '{{VALUE}}: 0;',
            ],

        ]
    );

    $this->add_responsive_control(
    'arrow_position_top',
    [
        'label' => __('Vertical', 'xmoze-hp'),
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
            '{{WRAPPER}} .screenshot-slider-arrow' => 'top: {{SIZE}}{{UNIT}} !important; bottom:auto',
        ],
        'condition' => [
            'offset_orientation_v' => 'top',
        ],
    ]
);


$this->add_responsive_control(
'arrow_position_bottom',
[
    'label' => __('Vertical', 'xmoze-hp'),
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
        '{{WRAPPER}} .screenshot-slider-arrow' => 'bottom: {{SIZE}}{{UNIT}} !important; top:auto',
    ],
    'condition' => [
        'offset_orientation_v' => 'bottom',
    ],
]
);


$this->add_control(
    'arrow_horizontal_position',
    [
        'label'             => __( 'Horizontal Position', 'xmoze-hp' ),
        'type'              => \Elementor\Controls_Manager::SELECT,
        'default'           => 'default',
        'options'           => [
            'default'    =>   __('Default',    'xmoze-hp'),
            'space_between'    =>   __('Space Between',    'xmoze-hp'),
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
            '{{WRAPPER}}  .screenshot-slider-arrow .prev' => 'left: {{SIZE}}{{UNIT}}; right: auto !important;',
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
            '{{WRAPPER}} .screenshot-slider-arrow .next' => 'right: {{SIZE}}{{UNIT}} !important; left: auto !important;',
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
            '{{WRAPPER}} .screenshot-slider-arrow .prev' => 'margin-right: {{SIZE}}{{UNIT}} !important; position: relative !important',
            '{{WRAPPER}} .screenshot-slider-arrow .next ' => 'margin-right: 0 !important; position: relative !important',
        ],
        'condition' => [
            'arrow_horizontal_position' => 'default',
        ],
    ]
);

$this->add_responsive_control(
    'align_arrow',
    [
        'label' => __( 'Alignment', 'xmoze-hp' ),
        'type' => \Elementor\Controls_Manager::CHOOSE,
        'options' => [
            'left' => [
                'title' => __( 'Left', 'xmoze-hp' ),
                'icon' => 'eicon-text-align-left',
            ],
            'center' => [
                'title' => __( 'Center', 'xmoze-hp' ),
                'icon' => 'eicon-text-align-center',
            ],
            'right' => [
                'title' => __( 'Right', 'xmoze-hp' ),
                'icon' => 'eicon-text-align-right',
            ],
        ],
        'default' => 'left',
        'selectors' => [
            '{{WRAPPER}} .screenshot-slider-arrow' => 'text-align: {{VALUE}};',
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
        'label' => __('Icon Size', 'xmoze-hp'),
        'type' => \Elementor\Controls_Manager::SLIDER,
        'size_units' => ['px'],
        'range' => [
            'px' => [
                'min' => 10,
                'max' => 150,
            ],
        ],
        'selectors' => [
            '{{WRAPPER}}  .screenshot-slider-arrow button i' => 'font-size: {{SIZE}}{{UNIT}}',
            '{{WRAPPER}}  .screenshot-slider-arrow button svg' => 'width: {{SIZE}}{{UNIT}}',
        ],
    ]
);

$this->add_responsive_control(
    'arrow_size_box',
    [
        'label' => __('Size', 'xmoze-hp'),
        'type' => \Elementor\Controls_Manager::SLIDER,
        'size_units' => ['px'],
        'range' => [
            'px' => [
                'min' => 20,
                'max' => 150,
            ],
        ],
        'selectors' => [
            '{{WRAPPER}} .screenshot-slider-arrow button' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}',
        ],
    ]
    
);

$this->add_responsive_control(
    'arrow_size_line_height',
    [
        'label' => __('Line Height', 'xmoze-hp'),
        'type' => \Elementor\Controls_Manager::SLIDER,
        'size_units' => ['px'],
        'range' => [
            'px' => [
                'min' => 0,
                'max' => 150,
            ],
        ],
        'selectors' => [
            '{{WRAPPER}} .screenshot-slider-arrow button' => 'line-height: {{SIZE}}{{UNIT}} !important;',
        ],
    ]
    
);

$this->add_responsive_control(
    'arrows_border_radius',
    [
        'label'      => __('Border Radius', 'xmoze-hp'),
        'type'       => \Elementor\Controls_Manager::DIMENSIONS,
        'size_units' => ['px'],
        'selectors'  => [
            '{{WRAPPER}} .screenshot-slider-arrow button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            'body.rtl {{WRAPPER}} .screenshot-slider-arrow button ' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
        ],
    ]
);
$this->end_controls_tab();

$this->start_controls_tab(
    '_tab_arrow_hover',
    [
        'label' => __('Active', 'xmoze-hp'),
    ]
);

$this->add_control(
    'arrow_hover_color',
    [
        'label' => __('Color', 'xmoze-hp'),
        'type' => \Elementor\Controls_Manager::COLOR,
        'selectors' => [
             '{{WRAPPER}} .screenshot-slider-arrow .slick-active' => 'color: {{VALUE}};',
             '{{WRAPPER}} .screenshot-slider-arrow button:hover ' => 'color: {{VALUE}};',
             '{{WRAPPER}} .screenshot-slider-arrow .slick-active svg path' => 'stroke: {{VALUE}};',
             '{{WRAPPER}} .screenshot-slider-arrow button:hover svg path ' => 'stroke: {{VALUE}};',
        ],
    ]
);

$this->add_control(
    'arrow_hover_fill_color',
    [
        'label' => __('Line Color', 'xmoze-hp'),
        'type' => \Elementor\Controls_Manager::COLOR,
        'selectors' => [
             '{{WRAPPER}} .screenshot-slider-arrow .slick-active' => 'color: {{VALUE}};',
             '{{WRAPPER}} .screenshot-slider-arrow button:hover ' => 'color: {{VALUE}};',
             '{{WRAPPER}} .screenshot-slider-arrow .slick-active path' => 'fill: {{VALUE}};',
             '{{WRAPPER}} .screenshot-slider-arrow button:hover path' => 'fill: {{VALUE}};',
        ],
    ]
);

$this->add_control(
    'arrow_bg_hover_color',
    [
        'label' => __('Background Color Hover', 'xmoze-hp'),
        'type' => \Elementor\Controls_Manager::COLOR,
        'selectors' => [
             '{{WRAPPER}} .screenshot-slider-arrow button:hover ' => 'background-color: {{VALUE}}  !important;',
             '{{WRAPPER}} .screenshot-slider-arrow .slick-active ' => 'background-color: {{VALUE}}  !important;',
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
     * Render oEmbed widget output on the frontend.
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
        $xmoze_apps = array(
            'loop'     => (!empty($settings['loop']) && 'yes' === $settings['loop']) ? true : false,
            'autoplay' => (!empty($settings['autoplay']) && 'yes' === $settings['autoplay']) ? true : false,
            'nav'      => (!empty($settings['arrows']) && 'yes' === $settings['arrows']) ? true : false,
            'dots'     => (!empty($settings['dots']) && 'yes' === $settings['dots']) ? true : false,
            'autoplaytimeout' => !empty($settings['autoplaytimeout']) ? $settings['autoplaytimeout'] : '5000',
        );

        $app_jasondecode = wp_json_encode($xmoze_apps);
    ?>
         <div class="bg-purple-heart">
                <!-- Screenshot Area -->
                <div class="screenshot-slider-wrapper">
                    <div class="screenshot-slider" data-apps='<?php echo esc_attr($app_jasondecode) ?>'>
                        <!-- single-slide Area -->
                        <?php foreach ($image_lists as $list) : ?>
                            <div class="single-slide focus-reset">
                                <div class="screenshot-image">
                                <?php echo \Elementor\Group_Control_Image_Size::get_attachment_image_html($list, 'image_size', 'image'); ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <!-- / .Screenshot Area -->
                    <div class="phone-bg-img">
                        <?php echo \Elementor\Group_Control_Image_Size::get_attachment_image_html($settings, 'frame_size', 'frame_image'); ?>
                    </div>
                </div>
                <div class="screenshots-dots"></div>

                
 <?php if ( 'yes' == $settings['arrows']): ?>                       
            <div class="screenshot-slider-arrow">
                <?php if ( ! empty( $settings['arrow_prev_icon']['value'] ) ) : ?>
                    <button type="button" class="slick-prev prev slick-arrow slick-active">
                        <?php \Elementor\Icons_Manager::render_icon( $settings['arrow_prev_icon'], ['aria-hidden' => 'true'] ); ?>
                    </button>
                <?php endif; ?>
                
                <?php if ( ! empty( $settings['arrow_next_icon']['value'] ) ) : ?>
                    <button type="button" class="slick-next next slick-arrow ">
                        <?php \Elementor\Icons_Manager::render_icon( $settings['arrow_next_icon'], ['aria-hidden' => 'true'] ); ?>
                    </button>
                <?php endif; ?>
            </div>
        <?php endif; ?>
               
      

            </div>
    <?php
    }
}
$widgets_manager->register(new \Xmoze_Imagecarousel());