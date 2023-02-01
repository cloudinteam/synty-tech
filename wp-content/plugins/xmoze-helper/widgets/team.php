<?php
/**
 * Happyden Team Widget.
 *
 *
 * @since 1.0.0
 */
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Css_Filter;
use Elementor\Icons_Manager;

if (!defined('ABSPATH')) {
    exit;
}
// If this file is called directly, abort.
class XmozeTeam extends \Elementor\Widget_Base {
    public function get_name() {
        return 'xmoze_team';
    }
    public function get_title() {
        return __('Xmoze Team', 'xmoze-hp');
    }
    public function get_icon() {
        return ('eicon-person');
    }
    public function get_categories() {
        return ['xmoze-addons'];
    }
    public function get_keywords() {
        return ['team', 'membar', 'portfolio'];
    }
    protected function register_controls() {
        $this->start_controls_section('general_section',
            [
                'label' => __('General ', 'xmoze-hp'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'membar_per_page',
            [
                'label'       => __('Numbar Of Membar', 'xmoze-hp'),
                'type'        => Controls_Manager::NUMBER,
                'default'     => '',
                'description' => 'user emty value show all posts',
            ]
        );

        $this->add_control(
            'team_style',
            [
                'label'             => __( 'Team Style', 'xmoze-hp' ),
                'type'              => Controls_Manager::SELECT,
                'default'           => 'team-area-style-01',
                'options'           => [
                    'team-area-style-01'   =>   __('Style One',    'xmoze-hp'),
                    'team-area-style-02'   =>   __('Style Two',    'xmoze-hp'),
                ],
                'separator' => 'after',
            ]
        );

        $this->add_control(
            'show_slider_settings',
            [
                'label' => __('Slider Active', 'xmoze-hp'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'xmoze-hp'),
                'label_off' => __('No', 'xmoze-hp'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'show_socail_links',
            [
                'label' => __('Social  Links', 'xmoze-hp'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'xmoze-hp'),
                'label_off' => __('No', 'xmoze-hp'),
                'return_value' => 'yes',
                'default' => 'no',
                'condition'   => [
					'team_style' => 'team-area-style-02',
				]
            ]
        );


        $this->add_responsive_control(
            'gap_right',
            [
                'label'          => __('Gap Right', 'xmoze'),
                'type'           => Controls_Manager::SLIDER,
                'size_units'     => ['px', '%'],
                'range'          => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'      => [
                    '{{WRAPPER}} .single-item' => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .team-area ' => 'margin-right: -{{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'gap_bottom',
            [
                'label'          => __('Gap Bottom', 'xmoze'),
                'type'           => Controls_Manager::SLIDER,
                'size_units'     => ['px', '%'],
                'range'          => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'      => [
                    '{{WRAPPER}} .single-item' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .team-area ' => 'margin-bottom: -{{SIZE}}{{UNIT}};',
                ],
            ]
        );


        $this->end_controls_section();

        $this->start_controls_section('guery_section',
            [
                'label' => __('Query ', 'xmoze-hp'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_responsive_control('per_line', [
            'label'              => __('Columns per row', 'xmoze-hp'),
            'type'               => Controls_Manager::SELECT,
            'default'            => '3',
            'tablet_default'     => '6',
            'mobile_default'     => '12',
            'options'            => [
                '12' => '1',
                '6'  => '2',
                '4'  => '3',
                '3'  => '4',
            ],
            'frontend_available' => true,
        ]);

        $this->add_control(
            'post_by',
            [
                'label' => __('Post By:', 'xmoze-hp'),
                'type' => Controls_Manager::SELECT,
                'default' => 'latest',
                'label_block' => true,
                'options' => array(
                    'latest'   =>   __('Latest Post', 'xmoze-hp'),
                    'selected' =>   __('Selected posts', 'xmoze-hp'),
                ),
            ]
        );
        $this->add_control(
            'post__in',
            [
                'label' => __('Post In', 'xmoze-hp'),
                'type' => Controls_Manager::SELECT2,
                'options' => xmoze_get_all_posts('team'),
                'multiple' => true,
                'label_block' => true,
                'condition'   => [
					'post_by' => 'selected',
				]
            ]
        );
       
        $this->add_control(
            'orderby',
            [
                'label' => __('Order By', 'xmoze-hp'),
                'type' => Controls_Manager::SELECT,
                'options' => xmoze_get_post_orderby_options(),
                'default' => 'date',
                'label_block' => true,

            ]
        );
        $this->add_control(
            'order',
            [
                'label' => __('Order', 'xmoze-hp'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'asc' => 'Ascending',
                    'desc' => 'Descending',
                ],
                'default' => 'desc',
                'label_block' => true,

            ]
        );
        $this->end_controls_section();

        //Slider Setting
    $this->start_controls_section('slider_settings',
    [
            'label' => __('Slider Settings', 'xmoze-hp'),
            'tab'   => Controls_Manager::TAB_CONTENT,
            'condition' => [
                'show_slider_settings' => 'yes',
            ]
            ]
        );

        $this->add_responsive_control(
            'per_coulmn',
            [
                'label' => __( 'Slider Items', 'xmoze-hp' ),
                'type' => Controls_Manager::SELECT,
                'default'            => 3,
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
            'arrows',
            [
                'label' => __( 'Show arrows?', 'xmoze-hp' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'xmoze-hp' ),
                'label_off' => __( 'Hide', 'xmoze-hp' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'dots',
            [
                'label' => __( 'Show Dots?', 'xmoze-hp' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'xmoze-hp' ),
                'label_off' => __( 'Hide', 'xmoze-hp' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'mousedrag',
            [
                'label' => __( 'MouseDrag?', 'xmoze-hp' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'xmoze-hp' ),
                'label_off' => __( 'Hide', 'xmoze-hp' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'autoplay',
            [
                'label' => __( 'Auto Play?', 'xmoze-hp' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'xmoze-hp' ),
                'label_off' => __( 'Hide', 'xmoze-hp' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        // $this->add_control(
        //     'loop',
        //     [
        //         'label' => __( 'Infinite Loop', 'xmoze-hp' ),
        //         'type' => \Elementor\Controls_Manager::SWITCHER,
        //         'label_on' => __( 'Show', 'xmoze-hp' ),
        //         'label_off' => __( 'Hide', 'xmoze-hp' ),
        //         'return_value' => 'yes',
        //         'default' => 'true',
        //     ]
        // );
        $this->add_control(
            'autoplaytimeout',
            [
                'label' => __( 'Autoplay Timeout', 'xmoze-hp' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'label_block' => true,
                'default' => '5000',
                'options' => [
                    '1000'  => __( '1 Second', 'xmoze-hp' ),
                    '2000'  => __( '2 Second', 'xmoze-hp' ),
                    '3000'  => __( '3 Second', 'xmoze-hp' ),
                    '4000'  => __( '4 Second', 'xmoze-hp' ),
                    '5000'  => __( '5 Second', 'xmoze-hp' ),
                    '6000'  => __( '6 Second', 'xmoze-hp' ),
                    '7000'  => __( '7 Second', 'xmoze-hp' ),
                    '8000'  => __( '8 Second', 'xmoze-hp' ),
                    '9000'  => __( '9 Second', 'xmoze-hp' ),
                    '10000' => __( '10 Second', 'xmoze-hp' ),
                    '11000' => __( '11 Second', 'xmoze-hp' ),
                    '12000' => __( '12 Second', 'xmoze-hp' ),
                    '13000' => __( '13 Second', 'xmoze-hp' ),
                    '14000' => __( '14 Second', 'xmoze-hp' ),
                    '15000' => __( '15 Second', 'xmoze-hp' ),
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
                    'arrows' => 'yes'
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
                    'arrows' => 'yes'
                ],
            ]
        );

        $this->add_responsive_control(
            'slider_width',
            [
                'label'          => __('Width', 'xmoze-hp'),
                'type'           => Controls_Manager::SLIDER,
                'size_units'     => ['%', 'px','vw'],
                'default'        => ['%'],
                'range'          => [
                    '%'  => [
                        'min' => 1,
                        'max' => 300,
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
                    '{{WRAPPER}} .team-area-style-01 .slick-list' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );



        $this->end_controls_section();

        /*
        *Image
        */
        $this->start_controls_section('team_box_iamge',
            [
                'label' => __('Image', 'xmoze-hp'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->start_controls_tabs('image_normal_tabs');
        // Normal tab
        $this->start_controls_tab(
            'iamge_normal_tab',
            [
                'label' => __('Normal', 'xmoze-hp'),
            ]
        );

        $this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'iamge_filter_normal',
				'selector' => '{{WRAPPER}} .team-wrapper img',
			]
		);

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'image_border',
                'selector'  => '{{WRAPPER}} .team-wrapper img',
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'image_box_shadow',
                'exclude'  => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .team-wrapper img',
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
                    '{{WRAPPER}} .team-wrapper img' => 'width: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .team-wrapper img' => 'max-width: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .team-wrapper img' => 'height: {{SIZE}}{{UNIT}} !important;',
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
                    '{{WRAPPER}} .team-wrapper img' => 'object-fit: {{VALUE}};',
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
                    '{{WRAPPER}} .team-wrapper img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .team-wrapper img' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();

        // Hover Style
        $this->start_controls_tab(
            'iamge_hover_tab',
            [
                'label' => __('Hover', 'xmoze-hp'),
            ]
        );
        $this->add_control(
            'image_hover_style',
            [
                'label'             => __('Image Hover Style', 'xmoze-hp'),
                'type'              => \Elementor\Controls_Manager::SELECT,
                'default'           => 'hover-default',
                'options'           => [
                    'hover-default' =>   __('Default',    'xmoze-hp'),
                    'hover-one'     =>   __('Style 01',    'xmoze-hp'),
                ],
                'separator' => 'after',
            ]
        );
        $this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'iamge_filter_hover',
				'selector' => '{{WRAPPER}} .team-wrapper:hover img',
			]
		);

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        /*
        *Name
        */
        $this->start_controls_section('team_box_name',
            [
                'label' => __('Name', 'xmoze-hp'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'xmoze_team_name_color',
            [
                'label'     => __('Color', 'xmoze-hp'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}  .user-identity h6' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'xmoze_team_name_style',
                'label'    => __('Typography', 'xmoze-hp'),
                'selector' => '{{WRAPPER}}   .user-identity h6',
            ]
        );
        $this->add_responsive_control(
            'xmoze_team_name_padding',
            [
                'label'      => __('Margin', 'xmoze-hp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}}  .user-identity h6' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}}  .user-identity h6' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        /*
        *Title
        */
        $this->start_controls_section('team_box_position',
            [
                'label' => __('Designation', 'xmoze-hp'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'xmoze_team_position_color',
            [
                'label'     => __('Color', 'xmoze-hp'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .user-identity span' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'xmoze_team_position_style',
                'label'    => __('Typography', 'xmoze-hp'),
                'selector' => '{{WRAPPER}}  .user-identity span',
            ]
        );
        $this->add_responsive_control(
            'xmoze_team_position_padding',
            [
                'label'      => __('Margin', 'xmoze-hp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .user-identity span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .user-identity span' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

    /*
   *
    Dots
   */
    $this->start_controls_section(
        'dots_navigation',
        [
            'label' => __('Navigation - Dots', 'xmoze-hp'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            'condition' => [
                'dots' => 'yes',
                'show_slider_settings' => 'yes'
            ],
        ]
    );
    $this->start_controls_tabs('_tabs_dots');

    $this->start_controls_tab(
        '_tab_dots_normal',
        [
            'label' => __('Normal', 'xmoze-hp'),
        ]
    );

    $this->add_control(
        'dots_color',
        [
            'label' => __('Color', 'xmoze-hp'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'default' => '',
            'selectors' => [
                '{{WRAPPER}} .team-slider ul.team-slider-dot-list li' => 'background-color: {{VALUE}};',
            ],
        ]
    );

    // $this->add_responsive_control(
    //     'align',
    //     [
    //         'label' => __( 'Alignment', 'xmoze-hp' ),
    //         'type' => Controls_Manager::CHOOSE,
    //         'options' => [
    //             'flex-start' => [
    //                 'title' => __( 'Left', 'xmoze-hp' ),
    //                 'icon' => 'eicon-text-align-left',
    //             ],
    //             'center' => [
    //                 'title' => __( 'Center', 'xmoze-hp' ),
    //                 'icon' => 'eicon-text-align-center',
    //             ],
    //             'flex-end' => [
    //                 'title' => __( 'Right', 'xmoze-hp' ),
    //                 'icon' => 'eicon-text-align-right',
    //             ],
    //         ],
    //         'default' => 'center',
    //         'selectors' => [
    //             '{{WRAPPER}} .team-slider ul.team-slider-dot-list' => 'justify-content: {{VALUE}};',
    //         ],
    //     ]
    // );


    // $this->add_control(
    //     'dots_position_toggle',
    //     [
    //         'label' => __('Position', 'xmoze-hp'),
    //         'type' => \Elementor\Controls_Manager::POPOVER_TOGGLE,
    //         'label_off' => __('None', 'xmoze-hp'),
    //         'label_on' => __('Custom', 'xmoze-hp'),
    //         'return_value' => 'yes',
    //     ]
    // );
    // $this->start_popover();


    // $this->add_responsive_control(
    //     'dots_position_y',
    //     [
    //         'label' => __('Vertical', 'xmoze-hp'),
    //         'type' => \Elementor\Controls_Manager::SLIDER,
    //         'size_units' => ['%','px'],
    //         'condition' => [
    //             'dots_position_toggle' => 'yes'
    //         ],
    //         'range' => [
    //             'px' => [
    //                 'min' => -1000,
    //                 'max' => 1000,
    //             ],
    //             '%' => [
    //                 'min' => -100,
    //                 'max' => 100,
    //             ],
    //         ],
    //         'selectors' => [
    //             '{{WRAPPER}} .team-slider ul.team-slider-dot-list' => 'top: {{SIZE}}{{UNIT}} !important;',
    //         ],
    //     ]
    // );

    // $this->add_responsive_control(
    //     'dots_position_x',
    //     [
    //         'label' => __('Horizontal', 'xmoze-hp'),
    //         'type' => \Elementor\Controls_Manager::SLIDER,
    //         'size_units' => ['px', '%'],
    //         'condition' => [
    //             'dots_position_toggle' => 'yes'
    //         ],
    //         'range' => [
    //             'px' => [
    //                 'min' => -1000,
    //                 'max' => 1000,
    //             ],
    //             '%' => [
    //                 'min' => 0,
    //                 'max' => 100,
    //             ],
    //         ],
    //         'selectors' => [
    //             'body:not(.rtl) {{WRAPPER}} .team-slider ul.team-slider-dot-list' => 'right: {{SIZE}}{{UNIT}};',
    //             'body.rtl {{WRAPPER}} .team-slider ul.team-slider-dot-list' => 'left: {{SIZE}}{{UNIT}};',
    //         ],
    //     ]
    // );
    // $this->end_popover();

    $this->add_responsive_control(
        'dots_box_width',
        [
            'label' => __('Width', 'xmoze-hp'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 200,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .team-slider ul.team-slider-dot-list li' => 'width: {{SIZE}}{{UNIT}};',
            ],
        ]
    );

    $this->add_responsive_control(
        'dots_box_height',
        [
            'label' => __('Height', 'xmoze-hp'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 200,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .team-slider ul.team-slider-dot-list li' => 'height: {{SIZE}}{{UNIT}};',
            ],
        ]
    );

    $this->add_responsive_control(
        'dots_margin',
        [
            'label'          => __('Gap Right', 'xmoze-hp'),
            'type'           => Controls_Manager::SLIDER,
            'default'        => [
                'unit' => 'px',
            ],
            'range'          => [
                'px' => [
                    'min' => 0,
                    'max' => 200,
                ],
            ],
            'selectors'      => [
                '{{WRAPPER}} .team-slider ul.team-slider-dot-list li ' => 'margin-right: {{SIZE}}{{UNIT}};',
                'body.rtl {{WRAPPER}} .team-slider ul.team-slider-dot-list li ' => 'margin-left: {{SIZE}}{{UNIT}};',
            ],
        ]
    );

    $this->add_responsive_control(
        'dots_min_margin',
        [
            'label'      => __('Margin', 'xmoze-hp'),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%'],
            'selectors'  => [
                '{{WRAPPER}} .team-slider-dot-list' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                'body.rtl {{WRAPPER}} .team-slider-dot-list' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
            ],
        ]
    );

    $this->add_responsive_control(
        'dots_box_',
        [
            'label'      => __('Border Radius', 'xmoze-hp'),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%'],
            'selectors'  => [
                '{{WRAPPER}} .team-slider ul.team-slider-dot-list li' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                'body.rtl {{WRAPPER}} .team-slider ul.team-slider-dot-list li' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
            ],
        ]
    );
    $this->end_controls_tab();

    $this->start_controls_tab(
        '_tab_dots_active',
        [
            'label' => __('Active', 'xmoze-hp'),
        ]
    );
    $this->add_control(
        'dots_color_active',
        [
            'label' => __('Active Color', 'xmoze-hp'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'default' => '',
            'selectors' => [
                '{{WRAPPER}} .team-slider ul.team-slider-dot-list li.slick-active' => 'background-color: {{VALUE}}  !important;',
            ],
        ]
    );

    $this->add_responsive_control(
        'arrow_dots_box_active_width',
        [
            'label' => __('Width', 'xmoze-hp'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 200,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .team-slider ul.team-slider-dot-list li.slick-active' => 'width: {{SIZE}}{{UNIT}} !important;',
            ],
        ]
    );

    $this->add_responsive_control(
        'arrow_dots_box_active_height',
        [
            'label' => __('Height', 'xmoze-hp'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 200,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .team-slider ul.team-slider-dot-list li.slick-active' => 'height: {{SIZE}}{{UNIT}} !important;',
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
        'label' => __('Navigation - Arrow', 'xmoze-hp'),
        'tab' => \Elementor\Controls_Manager::TAB_STYLE,
        'condition' => [
            'arrows' => 'yes',
            'show_slider_settings' => 'yes'
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
            '{{WRAPPER}} .team-slider-arrow button' => 'color: {{VALUE}}; border-color: {{VALUE}};',
            '{{WRAPPER}} .team-slider-arrow button svg path' => 'stroke: {{VALUE}};',
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
            '{{WRAPPER}} .team-slider-arrow button' => 'color: {{VALUE}};',
            '{{WRAPPER}} .team-slider-arrow button svg path' => 'fill: {{VALUE}};',
        ],
    ]
);

$this->add_control(
    'arrow_bg_color',
    [
        'label' => __('Background Color', 'xmoze-hp'),
        'type' => \Elementor\Controls_Manager::COLOR,
        'selectors' => [
             '{{WRAPPER}} .team-slider-arrow button' => 'background-color: {{VALUE}} !important;',
        ],
    ]
);

$this->add_group_control(
    \Elementor\Group_Control_Box_Shadow::get_type(),
    [
        'name' => 'arrow_shadow',
        'label' => __('Shadow', 'fd-addons'),
        'selector' => '{{WRAPPER}} .team-slider-arrow button ',
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
$this->add_responsive_control(
    'arrow_position_y',
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
            '{{WRAPPER}} .team-slider-arrow .prev, {{WRAPPER}} .team-slider-arrow .next' => 'top: {{SIZE}}{{UNIT}} !important;',
        ],
    ]
);

$this->add_responsive_control(
    'arrow_position_x',
    [
        'label' => __( 'Horizontal', 'happy-elementor-addons' ),
        'type' => Controls_Manager::SLIDER,
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
            '{{WRAPPER}}  .team-slider-arrow .prev' => 'left: {{SIZE}}{{UNIT}};',
            '{{WRAPPER}}  .team-slider-arrow .next' => 'right: {{SIZE}}{{UNIT}};',
        ],
    ]
);

$this->add_responsive_control(
    'arrow_position_dubol',
    [
        'label' => __( 'Horizontal Left Right', 'happy-elementor-addons' ),
        'type' => Controls_Manager::SLIDER,
        'size_units' => ['px', '%'],
        'condition' => [
            'arrow_position_toggle' => 'yes'
        ],
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
            '{{WRAPPER}} .team-slider-arrow .prev' => 'left: {{SIZE}}{{UNIT}} !important;',
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
            '{{WRAPPER}}  .team-slider-arrow button i' => 'font-size: {{SIZE}}{{UNIT}}',
            '{{WRAPPER}}  .team-slider-arrow button svg' => 'width: {{SIZE}}{{UNIT}}',
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
            '{{WRAPPER}} .team-slider-arrow button' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}} !important;',
        ],
    ]

);
$this->add_responsive_control(
    'arrows_box_',
    [
        'label'      => __('Border Radius', 'xmoze-hp'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => ['px'],
        'selectors'  => [
            '{{WRAPPER}} .team-slider-arrow button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            'body.rtl {{WRAPPER}} .team-slider-arrow button ' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
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
             '{{WRAPPER}} .team-slider-arrow .slick-active' => 'color: {{VALUE}};',
             '{{WRAPPER}} .team-slider-arrow button:hover ' => 'color: {{VALUE}};',
             '{{WRAPPER}} .team-slider-arrow .slick-active svg path' => 'stroke: {{VALUE}};',
             '{{WRAPPER}} .team-slider-arrow button:hover svg path ' => 'stroke: {{VALUE}};',
        ],
    ]
);

$this->add_control(
    'arrow_hover_fill_color',
    [
        'label' => __('Line Color', 'xmoze-hp'),
        'type' => \Elementor\Controls_Manager::COLOR,
        'selectors' => [
             '{{WRAPPER}} .team-slider-arrow .slick-active' => 'color: {{VALUE}};',
             '{{WRAPPER}} .team-slider-arrow button:hover ' => 'color: {{VALUE}};',
             '{{WRAPPER}} .team-slider-arrow .slick-active path' => 'fill: {{VALUE}};',
             '{{WRAPPER}} .team-slider-arrow button:hover path' => 'fill: {{VALUE}};',
        ],
    ]
);

$this->add_control(
    'arrow_bg_hover_color',
    [
        'label' => __('Background Color Hover', 'xmoze-hp'),
        'type' => \Elementor\Controls_Manager::COLOR,
        'selectors' => [
             '{{WRAPPER}} .team-slider-arrow button:hover ' => 'background-color: {{VALUE}}  !important;',
             '{{WRAPPER}} .team-slider-arrow .slick-active ' => 'background-color: {{VALUE}}  !important;',
        ],
    ]
);

$this->end_controls_tab();
$this->end_controls_tabs();

$this->end_controls_section();

        /*
        *Socail links
        */
        $this->start_controls_section('social_links',
        [
            'label' => __('Social Profile', 'xmoze-hp'),
            'tab'   => Controls_Manager::TAB_STYLE,
            'condition'   => [
                'show_socail_links' => 'yes',
            ]

        ]
        );

        $this->add_control(
            'icon_color',
            [
                'label'     => __('Color', 'xmoze-hp'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .social-icons ul li i' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'icon_color_hover',
            [
                'label'     => __('Color Hover', 'xmoze-hp'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .social-icons ul li:hover i' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'socail_align',
            [
                'label' => __( 'Alignment', 'xmoze-hp' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => __( 'Left', 'xmoze-hp' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'xmoze-hp' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'flex-end' => [
                        'title' => __( 'Right', 'xmoze-hp' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .social-icons ul' => 'justify-content: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'fd_addons_pricing_table_promo_background',
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .social-icons:after',
			]
		);

        $this->add_responsive_control(
            'social_links_size',
            [
                'label'          => __('Size', 'xmoze-hp'),
                'type'           => Controls_Manager::SLIDER,
                'size_units'     => ['px'],
                'range'          => [
                    'px' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors'      => [
                    '{{WRAPPER}} .social-icons ul li  i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .social-icons ul li svg' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'social_links_box_',
            [
                'label'      => __('Border Radius', 'xmoze-hp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .social-icons' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .social-icons ' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'social_links_margin_icon',
            [
                'label'      => __('Right Gap', 'xmoze-hp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .social-icons ul li ' => 'margin-right: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .social-icons ul li  ' => 'margin-left: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'social_links_margin',
            [
                'label'      => __('Margin', 'xmoze-hp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .social-icons ul' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .social-icons ul' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();



    /* Content box style */
    $this->start_controls_section('content_box',
        [
            'label' => __('Content Box', 'xmoze-hp'),
            'tab'   => Controls_Manager::TAB_STYLE,

        ]
    );

    $this->add_control(
        'content_bg',
        [
            'label'     => __('Backround Color', 'xmoze-hp'),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .user-identity' => 'background-color: {{VALUE}}',
            ],
        ]
    );
    $this->add_group_control(
        Group_Control_Border::get_type(),
        [
            'name'      => 'content_box_border',
            'selector'  => '{{WRAPPER}} .user-identity',
        ]
    );

    $this->add_group_control(
        Group_Control_Box_Shadow::get_type(),
        [
            'name'     => 'content_box_shadow',
            'exclude'  => [
                'box_shadow_position',
            ],
            'selector' => '{{WRAPPER}} .user-identity',
        ]
    );
    $this->add_responsive_control(
       'content_align',
       [
           'label' => __( 'Alignment', 'xmoze-hp' ),
           'type' => Controls_Manager::CHOOSE,
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
               '{{WRAPPER}} .user-identity' => 'text-align: {{VALUE}} !important;',
           ],
       ]
   );

    $this->add_responsive_control(
    'content_box_margin',
        [
            'label'      => __('Margin', 'xmoze-hp'),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%'],
            'selectors'  => [
                '{{WRAPPER}} .user-identity' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                'body.rtl {{WRAPPER}} .user-identity' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
            ],
        ]
    );
    $this->add_responsive_control(
        'content_box_padding',
            [
                'label'      => __('Padding', 'xmoze-hp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .user-identity' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .user-identity' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
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

     $this->start_controls_tabs(
         'style_tabs'
     );
     // normal
     $this->start_controls_tab(
         'team_normal',
         [
             'label' => __('Normal', 'xmoze-hp'),
         ]
     );

     $this->add_control(
         'bg',
         [
             'label'     => __('Backround Color', 'xmoze-hp'),
             'type'      => Controls_Manager::COLOR,
             'selectors' => [
                 '{{WRAPPER}} .single-item' => 'background-color: {{VALUE}}',
             ],
         ]
     );
     $this->add_group_control(
         Group_Control_Border::get_type(),
         [
             'name'      => 'box_border',
             'selector'  => '{{WRAPPER}} .single-item',
         ]
     );

     $this->add_group_control(
         Group_Control_Box_Shadow::get_type(),
         [
             'name'     => 'box_shadow',
             'exclude'  => [
                 'box_shadow_position',
             ],
             'selector' => '{{WRAPPER}} .single-item',
         ]
     );
     $this->add_responsive_control(
        'align',
        [
            'label' => __( 'Alignment', 'xmoze-hp' ),
            'type' => Controls_Manager::CHOOSE,
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
                '{{WRAPPER}} .single-item' => 'text-align: {{VALUE}} !important;',
            ],
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
                '{{WRAPPER}} .single-item' => 'margin-bottom: {{SIZE}}{{UNIT}};',
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
                 '{{WRAPPER}} .single-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                 'body.rtl {{WRAPPER}} .single-item' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
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
                 '{{WRAPPER}} .single-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                 'body.rtl {{WRAPPER}} .single-item' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
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
                 '{{WRAPPER}} .single-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                 'body.rtl {{WRAPPER}} .single-item' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
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

     $this->add_control(
         'bg_hover',
         [
             'label'     => __('Backround Color', 'xmoze-hp'),
             'type'      => Controls_Manager::COLOR,
             'selectors' => [
                 '{{WRAPPER}} .single-item:hover' => 'background-color: {{VALUE}}',
             ],
         ]
     );
     $this->add_group_control(
         Group_Control_Border::get_type(),
         [
             'name'      => 'tn_border_hover',
             'selector'  => '{{WRAPPER}} .single-item:hover',
         ]
     );

     $this->add_group_control(
         Group_Control_Box_Shadow::get_type(),
         [
             'name'     => 'box_shadow_hover',
             'exclude'  => [
                 'box_shadow_position',
             ],
             'selector' => '{{WRAPPER}} .single-item:hover',
         ]
     );

     $this->add_responsive_control(
         'box__hover',
         [
             'label'      => __('Border Radius', 'xmoze-hp'),
             'type'       => Controls_Manager::DIMENSIONS,
             'size_units' => ['px', '%'],
             'selectors'  => [
                 '{{WRAPPER}} .single-item:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                 'body.rtl {{WRAPPER}} .single-item:hover' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
             ],
         ]
     );
     $this->end_controls_tab();
     $this->end_controls_tabs();
    $this->end_controls_section();

    }

    // protected function get_render_icon($icon){
    //     ob_start();
    //     \Elementor\Icons_Manager::render_icon($icon, ['aria-hidden' => 'true']);
    //     return ob_get_clean();
    // }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $team_style  = $settings['team_style'];
        $image_hover_style = $settings['image_hover_style'];
         //this code course slider option
		$slider_extraSetting = array(

            // 'next_icon' => $this->get_render_icon($settings['arrow_next_icon']),
            // 'prev_icon' => $this->get_render_icon($settings['arrow_prev_icon']),
	        // 'loop' => (!empty($settings['loop']) && 'yes' === $settings['loop']) ? true : false,
	        'autoplay' => (!empty($settings['autoplay']) && 'yes' === $settings['autoplay']) ? true : false,
        	'nav' => (!empty($settings['arrows']) && 'yes' === $settings['arrows']) ? true : false,
        	'dots' => (!empty($settings['dots']) && 'yes' === $settings['dots']) ? true : false,
        	'mousedrag' => (!empty($settings['mousedrag']) && 'yes' === $settings['mousedrag']) ? true : false,
        	'autoplaytimeout' => !empty($settings['autoplaytimeout']) ? $settings['autoplaytimeout'] : '5000',

        	//this a responsive layout
            'per_coulmn' =>        (!empty($settings['per_coulmn'])) ? $settings['per_coulmn'] : 3,
            'per_coulmn_tablet' => (!empty($settings['per_coulmn_tablet'])) ? $settings['per_coulmn_tablet'] : 2,
            'per_coulmn_mobile' => (!empty($settings['per_coulmn_mobile'])) ? $settings['per_coulmn_mobile'] : 1
        );
        $jasondecode = wp_json_encode($slider_extraSetting);




        if ( ( 'yes' == $settings['show_slider_settings'] ) ) {
            $this->add_render_attribute('team_version', 'class', array('team-slider', 't-style',$image_hover_style ));
            $this->add_render_attribute('team_version', 'data-settings', $jasondecode);
        } else {
            $this->add_render_attribute('team_version', 'class', array('row g-0 justify-content-center',$image_hover_style ));
            //gride class
            $grid_classes = [];
            $grid_classes[] = 'col-lg-' . $settings['per_line'];
            $grid_classes[] = 'col-md-' . $settings['per_line_tablet'];
            $grid_classes[] = 'col-sm-' . $settings['per_line_mobile'];
            $grid_classes = implode(' ', $grid_classes);
            $this->add_render_attribute('team_gride_classes', 'class', [$grid_classes]);
        }


        // Query
        $numabr_of_membar = !empty($settings['membar_per_page']) ? $settings['membar_per_page'] : -1;
        $query_args = [
            'post_type'           => 'team',
            'orderby' => $settings['orderby'],
            'order'   => $settings['order'],
            'posts_per_page'      => $numabr_of_membar,
            'post_status'         => 'publish',
            'ignore_sticky_posts' => 1,
        ];

        // get_type
        if ( 'selected' === $settings['post_by'] ) {
            $query_args['post__in'] = (array)$settings['post__in'];
        }

        $team_teams = new \WP_Query($query_args);
        ?>
    <div class="team-area <?php echo esc_attr( $team_style ) ?>">

        <div <?php echo $this->get_render_attribute_string('team_version'); ?>>
        <?php while ($team_teams->have_posts()): $team_teams->the_post();  ?>

            <div <?php echo $this->get_render_attribute_string('team_gride_classes'); ?>>
                <a  href="<?php the_permalink(); ?>" class="single-item">
                    <div class="team-wrapper">

                    <?php if(has_post_thumbnail() ): ?>
                        <div class="team-image">
                            <?php the_post_thumbnail('full');?>

                            <?php if (function_exists('the_field')  && 'yes' == $settings['show_socail_links'] ):
                                $social_links = get_field('social_links');
                                ?>
                                <div class="social-icons">
                                    <ul class="list-unstyled">
                                        <?php foreach( $social_links as  $social_link):  ?>
                                        <li>
                                            <a href="<?php echo esc_url($social_link['url']); ?>">
                                            <?php echo $social_link['icon'] ?>
                                            </a>
                                        </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>

                            <?php endif;?>
                        </div>
                    <?php endif; ?>

                    <div class="user-identity">
                        <h6><?php the_title();?></h6>
                        <?php if (function_exists('the_field')): ?>
                            <span><?php the_field('position')?></span>
                        <?php endif;?>
                    </div>
                    </div>
                </a>
            </div>
        <?php endwhile; wp_reset_postdata();?>
    </div>

    <?php if ( 'yes' == $settings['show_slider_settings'] && 'yes' == $settings['arrows']): ?>
        <div class="team-slider-arrow">

            <?php if ( ! empty( $settings['arrow_prev_icon']['value'] ) ) : ?>
                <button type="button" class="slick-prev prev slick-arrow slick-active">
                    <?php Icons_Manager::render_icon( $settings['arrow_prev_icon'], ['aria-hidden' => 'true'] ); ?>
                </button>
            <?php endif; ?>

            <?php if ( ! empty( $settings['arrow_next_icon']['value'] ) ) : ?>
                <button type="button" class=" slick-next next slick-arrow ">
                    <?php Icons_Manager::render_icon( $settings['arrow_next_icon'], ['aria-hidden' => 'true'] ); ?>
                </button>
            <?php endif; ?>
        </div>
    <?php endif; ?>




</div>
    <?php
}
}
$widgets_manager->register(new \XmozeTeam());