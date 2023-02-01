<?php

/**
 * Xmoze Testimonial Normal Widget.
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
use  Elementor\Repeater;
use  Elementor\Icons_Manager;

if (!defined('ABSPATH')) {
    exit;
}
// If this file is called directly, abort.
class Xmoze_Testimonail_Loop extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'xmoze-testimonial-loop';
    }

    public function get_title()
    {
        return __('Xmoze Testimonial', 'xmoze-hp');
    }

    public function get_icon()
    {
        return ('eicon-testimonial');
    }

    public function get_categories()
    {
        return ['xmoze-addons'];
    }

    public function get_script_depends()
    {
        return ['xmoze-addon'];
    }

    public function get_style_depends()
    {
        return ['owl-carousel', 'xmoze-addons'];
    }

    public function get_keywords()
    {
        return ['team', 'card', 'testimonial', 'membar', 'reviw', 'rating'];
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'ts_section',
            [
                'label' => __('General', 'xmoze-hp'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );



        $this->add_control(
            'testimonial_mesonary',
            [
                'label'             => __('Masonry Or Normal', 'xmoze-hp'),
                'type'              => Controls_Manager::SELECT,
                'default'           => 'default_style',
                'options'           => [
                    'default_style' =>  __('Normal',     'xmoze-hp'),
                    'testimonil_masonry' => __('Masonry',     'xmoze-hp'),
                ],
                'separator' => 'after',
            ]
        );

        $this->add_control(
            'testimonial_style',
            [
                'label'             => __('Testimonial Style', 'xmoze-hp'),
                'type'              => Controls_Manager::SELECT,
                'default'           => 'style-one',
                'options'           => [
                    'style-one'    =>   __('Style 01',     'xmoze-hp'),
                    'style-two'    =>   __('Style 02',     'xmoze-hp'),
                    'style-three'  =>   __('Style 03',   'xmoze-hp'),
                    'style-four'   =>   __('Style 04',    'xmoze-hp'),
                    'style-five'   =>   __('Style 05',    'xmoze-hp'),
                    'style-six'    =>   __('Style 06',    'xmoze-hp'),
                    'style-seven'  =>   __('Style 07',    'xmoze-hp'),
                    'style-eight'  =>   __('Style 08',    'xmoze-hp'),
                    'style-nine'    =>  __('Style 09',    'xmoze-hp'),
                    'style-ten'    =>   __('Style 10',    'xmoze-hp'),
                ],
                'separator' => 'after',
            ]
        );

        $this->add_control(
            'show_slider_settings',
            [
                'label' => __('Slider Active', 'finisys'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'finisys'),
                'label_off' => __('No', 'finisys'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'show_icon',
            [
                'label' => __('Show Rating', 'finisys'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'finisys'),
                'label_off' => __('No', 'finisys'),
                'return_value' => 'yes',
                'default' => 'yes',

            ]
        );
        $this->add_control(
            'show_heading',
            [
                'label' => __('Show Heading', 'finisys'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'finisys'),
                'label_off' => __('No', 'finisys'),
                'return_value' => 'yes',
                'default' => 'no',

            ]
        );
        $this->add_control(
            'show_socail_links',
            [
                'label' => __('Social Links', 'xmoze-hp'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'xmoze-hp'),
                'label_off' => __('No', 'xmoze-hp'),
                'return_value' => 'yes',
                'default' => 'no',

            ]
        );


        $this->add_control(
            'show_quate',
            [
                'label' => __('Show Quate', 'finisys'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'finisys'),
                'label_off' => __('No', 'finisys'),
                'return_value' => 'yes',
                'default' => 'yes',

            ]
        );

        $this->add_control(
            'icon',
            [
                'label' => __('Ratting Icon', 'finisys'),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-star',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'show_icon' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'quate',
            [
                'label' => __('Quate Icon', 'finisys'),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-star',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'show_quate' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'layout_gap',
            [
                'label' => __('Item Gap', 'xmoze'),
                'type' => Controls_Manager::POPOVER_TOGGLE,
                'label_off' => __('Default', 'xmoze'),
                'label_on' => __('Custom', 'xmoze'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );


        $this->add_responsive_control(
            'item_gap_right',
            [
                'label'          => __('Gap Right', 'xmoze'),
                'type'           => Controls_Manager::SLIDER,
                'size_units'     => ['px'],
                'range'          => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                ],
                'selectors'      => [
                    '{{WRAPPER}} .xmoze--tn-single' => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .xmoze--tn-wraper' => 'margin-right: -{{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'item_gap_bottom',
            [
                'label'          => __('Gap Bottom', 'xmoze'),
                'type'           => Controls_Manager::SLIDER,
                'size_units'     => ['px'],
                'range'          => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                ],
                'selectors'      => [
                    '{{WRAPPER}} .xmoze--tn-single' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .xmoze--tn-wraper' => 'margin-bottom: -{{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();


        //Query
        $this->start_controls_section(
            'query',
            [
                'label' => __('Query', 'xmoze-hp'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );


        $this->add_control(
            'item_per_page',
            [
                'label'       => __('Numbar Of Items', 'xmoze'),
                'type'        => Controls_Manager::NUMBER,
                'default'     => '',
                'description' => 'user emty value show all posts',
            ]
        );
        $this->add_responsive_control('per_line', [
            'label'              => __('Columns per row', 'xmoze-hp'),
            'type'               => Controls_Manager::SELECT,
            'default'            => '4',
            'tablet_default'     => '6',
            'tablet_extra'     => '6',
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
                'options' => xmoze_get_all_posts('xmoze_testimonial'),
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
        $this->add_control(
            't_word_limit',
            [
                'label' => __('Testimonial Word Limit', 'xmoze-hp'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                ],
            ]
        );
        $this->end_controls_section();


        //Slider Setting
        $this->start_controls_section(
            'slider_settings',
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
                'label' => __('Slider Items', 'xmoze-hp'),
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
            'show_vertical',
            [
                'label' => __('Vertical Mode?', 'xmoze-hp'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'xmoze-hp'),
                'label_off' => __('Hide', 'xmoze-hp'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'show_center_mode',
            [
                'label' => __('Center Mode?', 'xmoze-hp'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'xmoze-hp'),
                'label_off' => __('Hide', 'xmoze-hp'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'arrows',
            [
                'label' => __('Show arrows?', 'xmoze-hp'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'xmoze-hp'),
                'label_off' => __('Hide', 'xmoze-hp'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'dots',
            [
                'label' => __('Show Dots?', 'xmoze-hp'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'xmoze-hp'),
                'label_off' => __('Hide', 'xmoze-hp'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'mousedrag',
            [
                'label' => __('Show MouseDrag', 'xmoze-hp'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'xmoze-hp'),
                'label_off' => __('Hide', 'xmoze-hp'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'autoplay',
            [
                'label' => __('Auto Play?', 'xmoze-hp'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'xmoze-hp'),
                'label_off' => __('Hide', 'xmoze-hp'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'loop',
            [
                'label' => __('Infinite Loop', 'xmoze-hp'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'xmoze-hp'),
                'label_off' => __('Hide', 'xmoze-hp'),
                'return_value' => 'yes',
                'default' => 'true',
            ]
        );
        $this->add_control(
            'autoplaytimeout',
            [
                'label' => __('Autoplay Timeout', 'xmoze-hp'),
                'type' => \Elementor\Controls_Manager::SELECT,
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
                'label' => __('Previous Icon', 'xmoze'),
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
                'label' => __('Next Icon', 'xmoze'),
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

        //iamge
        $this->start_controls_section(
            'iamge_style',
            [
                'label' => __('Image', 'xmoze-hp'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'width',
            [
                'label'          => __('Width', 'xmoze-hp'),
                'type'           => Controls_Manager::SLIDER,
                'default'        => [
                    'unit' => 'px',
                ],
                'tablet_default' => [
                    'unit' => 'px',
                ],
                'mobile_default' => [
                    'unit' => 'px',
                ],
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
                    '{{WRAPPER}} .xmoze--t-thumb img' => 'width: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );

        $this->add_responsive_control(
            'space',
            [
                'label'          => __('Max Width', 'xmoze-hp'),
                'type'           => Controls_Manager::SLIDER,
                'default'        => [
                    'unit' => 'px',
                ],
                'tablet_default' => [
                    'unit' => 'px',
                ],
                'mobile_default' => [
                    'unit' => 'px',
                ],
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
                    '{{WRAPPER}} .xmoze--t-thumb img' => 'max-width: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );
        $this->add_responsive_control(
            'height',
            [
                'label'          => __('Height', 'xmoze-hp'),
                'type'           => Controls_Manager::SLIDER,
                'default'        => [
                    'unit' => 'px',
                ],
                'tablet_default' => [
                    'unit' => 'px',
                ],
                'mobile_default' => [
                    'unit' => 'px',
                ],
                'size_units'     => ['px', 'vh'],
                'range'          => [
                    'px' => [
                        'min' => 1,
                        'max' => 500,
                    ],
                    'vh' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors'      => [
                    '{{WRAPPER}} .xmoze--t-thumb img' => 'height: {{SIZE}}{{UNIT}} !important;',
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
                    '{{WRAPPER}} .xmoze--t-thumb img' => 'object-fit: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'image_border',
                'selector'  => '{{WRAPPER}} .xmoze--t-thumb img',
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'image_border_radius',
            [
                'label'      => __('Border Radius', 'xmoze-hp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .xmoze--t-thumb img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                    'body.rtl {{WRAPPER}} .xmoze--t-thumb img' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}} !important;;',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_margin',
            [
                'label'      => __('Margin', 'xmoze-hp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .xmoze--t-thumb' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .xmoze--t-thumb' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'image_box_shadow',
                'exclude'  => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .xmoze--t-thumb img',
            ]
        );
        $this->end_controls_section();



        // Heading
        $this->start_controls_section(
            'tn_heading',
            [
                'label' => __('Heading', 'xmoze-hp'),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition'   => [
                    'show_heading' => 'yes',
                ]
            ]
        );
        $this->add_control(
            'heading_color',
            [
                'label'     => __('Color', 'xmoze-hp'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xmoze-ts-heading h4' => 'color: {{VALUE}}',
                ],
            ]
        );


        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'heading_typo',
                'label'    => __('Typography', 'xmoze-hp'),
                'selector' => '{{WRAPPER}}  .xmoze-ts-heading h4',
            ]
        );
        $this->add_responsive_control(
            'heading_margin',
            [
                'label'      => __('Margin', 'xmoze-hp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .xmoze-ts-heading h4' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .xmoze-ts-heading h4' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();


        // Name
        $this->start_controls_section(
            'tn_name',
            [
                'label' => __('Name', 'xmoze-hp'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'name_color',
            [
                'label'     => __('Color', 'xmoze-hp'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xmoze--tn-name' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'name_color_hover',
            [
                'label'     => __('Hover Color', 'xmoze-hp'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xmoze--tn-single:hover .xmoze--tn-name' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'name_typo',
                'label'    => __('Typography', 'xmoze-hp'),
                'selector' => '{{WRAPPER}}  .xmoze--tn-name',
            ]
        );
        $this->add_responsive_control(
            'name_margin',
            [
                'label'      => __('Margin', 'xmoze-hp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .xmoze--tn-name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .xmoze--tn-name' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        // Title
        $this->start_controls_section(
            'tn_title',
            [
                'label' => __('User Description', 'xmoze-hp'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label'     => __('Color', 'xmoze-hp'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xmoze--tn-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'title_color_hover',
            [
                'label'     => __('Hover Color', 'xmoze-hp'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xmoze--tn-single:hover .xmoze--tn-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typo',
                'label'    => __('Typography', 'xmoze-hp'),
                'selector' => '{{WRAPPER}}  .xmoze--tn-title',
            ]
        );

        $this->add_responsive_control(
            'title_margin',
            [
                'label'      => __('Margin', 'xmoze-hp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .xmoze--tn-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .xmoze--tn-title' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        // Discription
        $this->start_controls_section(
            'discription',
            [
                'label' => __('Designation', 'xmoze-hp'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'dis_color',
            [
                'label'     => __('Color', 'xmoze-hp'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xmoze--tn-dis p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'dis_color_hover',
            [
                'label'     => __('Hover Color', 'xmoze-hp'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xmoze--tn-single:hover .xmoze--tn-dis p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'dis_typo',
                'label'    => __('Typography', 'xmoze-hp'),
                'selector' => '{{WRAPPER}}  .xmoze--tn-dis p',
            ]
        );
        $this->add_responsive_control(
            'dis_border_radius',
            [
                'label'      => __('Border Radius', 'xmoze-hp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'condition' => [
                    'testimonial_style' => 'style-three',
                ],
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}}  .xmoze--tn-dis' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}}  .xmoze--tn-dis' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'dis_margin',
            [
                'label'      => __('Margin', 'xmoze-hp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .xmoze--tn-dis p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .xmoze--tn-dis p' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'dis_bottom_gap',
            [
                'label'      => __('Bottom Gap', 'xmoze-hp'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .xmoze--tn-dis' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
                    'body.rtl {{WRAPPER}} .xmoze--tn-dis' => 'margin-bottom:{{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );
        $this->add_responsive_control(
            'dis_padding',
            [
                'label'      => __('Padding', 'xmoze-hp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'condition' => [
                    'testimonial_style' => 'style-three',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .xmoze--tn-dis' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .xmoze--tn-dis' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        //icon style
        $this->start_controls_section(
            'icon_style',
            [
                'label' => __('Rating', 'xmoze-hp'),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_icon' => 'yes',
                ]
            ]
        );

        $this->start_controls_tabs(
            'icon_style_tabs'
        );

        // hover
        $this->start_controls_tab(
            'tab_icon_normal_color',
            [
                'label' => __('Normal', 'xmoze'),
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label'     => __('Active Color', 'xmoze-hp'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xmoze--tn-icon .active_color' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .xmoze--tn-icon svg' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .xmoze--tn-icon svg path' => 'fill: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'icon_inactive_color',
            [
                'label'     => __('Inactive Color', 'xmoze-hp'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xmoze--tn-icon .inactive_color' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .xmoze--tn-icon svg' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .xmoze--tn-icon svg path' => 'fill: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'line_icon_color',
            [
                'label'     => __('Line Color', 'xmoze-hp'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xmoze--tn-icon i,
                    {{WRAPPER}}  .xmoze--tn-icon svg' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .xmoze--tn-icon svg path' => 'stroke: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'fd_addons_position_rating_type',
            [
                'label'       => __('Position Type', 'fd-addons'),
                'label_block' => true,
                'type'        => Controls_Manager::SELECT,
                'options'     => [
                    ''         => __('Default', 'fd-addons'),
                    'static'   => __('Static', 'fd-addons'),
                    'relative' => __('Relative', 'fd-addons'),
                    'absolute' => __('Absolute', 'fd-addons'),

                ],
                'default'     => '',
                'selectors'   => [
                    '{{WRAPPER}} .xmoze--tn-icon' => 'position:{{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'fd_addons_position_rating_top',
            [
                'label'      => __('Top', 'fd-addons'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range'      => [
                    'px' => [
                        'min'  => -2000,
                        'max'  => 2000,
                        'step' => 1,

                    ],
                    '%'  => [
                        'min'  => -100,
                        'max'  => 100,
                        'step' => 1,
                    ],
                    'em' => [
                        'min'  => -150,
                        'max'  => 150,
                        'step' => 1,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .xmoze--tn-icon' => 'top:{{SIZE}}{{UNIT}};',
                ],
                'condition'  => [
                    'fd_addons_position_rating_type' => ['relative', 'absolute'],
                ],
            ]
        );

        $this->add_responsive_control(
            'fd_addons_position_rating__right',
            [
                'label'        => __('Right', 'fd-addons'),
                'type'         => Controls_Manager::SLIDER,
                'size_units'   => ['px', 'em', '%'],
                'range'        => [
                    'px' => [
                        'min'  => -2000,
                        'max'  => 2000,
                        'step' => 1,
                    ],
                    '%'  => [
                        'min'  => -100,
                        'max'  => 100,
                        'step' => 1,
                    ],
                    'em' => [
                        'min'  => -150,
                        'max'  => 150,
                        'step' => 1,
                    ],
                ],
                'selectors'    => [
                    '{{WRAPPER}} .xmoze--tn-icon' => 'right:{{SIZE}}{{UNIT}};',
                ],
                'condition'    => [
                    'fd_addons_position_rating_type' => ['relative', 'absolute'],
                ],
                'return_value' => '',
            ]
        );


        $this->add_responsive_control(
            'fd_addons_position_rating_bottom',
            array(
                'label'      => __('Bottom', 'fd-addons'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => array('px', 'em', '%'),
                'range'      => array(
                    'px' => array(
                        'min'  => -2000,
                        'max'  => 2000,
                        'step' => 1,
                    ),
                    '%'  => array(
                        'min'  => -100,
                        'max'  => 100,
                        'step' => 1,
                    ),
                    'em' => array(
                        'min'  => -150,
                        'max'  => 150,
                        'step' => 1,
                    ),
                ),

                'selectors'  => array(
                    '{{WRAPPER}} .xmoze--tn-icon' => 'bottom:{{SIZE}}{{UNIT}};',
                ),
                'condition'  => array(
                    'fd_addons_position_rating_type' => array('relative', 'absolute'),
                ),
            )
        );

        $this->add_responsive_control(
            'fd_addons_position_rating_left',
            array(
                'label'      => __('Left', 'fd-addons'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => array('px', 'em', '%'),
                'range'      => array(
                    'px' => array(
                        'min'  => -2000,
                        'max'  => 2000,
                        'step' => 1,
                    ),
                    '%'  => array(
                        'min'  => -100,
                        'max'  => 100,
                        'step' => 1,
                    ),
                    'em' => array(
                        'min'  => -150,
                        'max'  => 150,
                        'step' => 1,
                    ),
                ),
                'selectors'  => array(
                    '{{WRAPPER}} .xmoze--tn-icon' => 'left:{{SIZE}}{{UNIT}};',
                ),
                'condition'  => array(
                    'fd_addons_position_rating_type' => array('relative', 'absolute'),
                ),
            )
        );

        $this->add_responsive_control(
            'fd_addons_position_from_rating_center',
            array(
                'label'       => __('From Center', 'fd-addons'),
                'description' => __('Please avoid using "From Center" and "Left" options at the same time.', 'fd-addons'),
                'type'        => Controls_Manager::SLIDER,
                'size_units'  => array('px', 'em', '%'),
                'range'       => array(
                    'px' => array(
                        'min'  => -1000,
                        'max'  => 1000,
                        'step' => 1,
                    ),
                    '%'  => array(
                        'min'  => -100,
                        'max'  => 100,
                        'step' => 1,
                    ),
                    'em' => array(
                        'min'  => -150,
                        'max'  => 150,
                        'step' => 1,
                    ),
                ),

                'selectors'   => array(
                    '{{WRAPPER}} .xmoze--tn-icon' => 'left:calc( 50% + {{SIZE}}{{UNIT}} );',
                ),
                'condition'   => array(
                    'fd_addons_position_rating_type' => array('relative', 'absolute'),
                ),
            )
        );

        $this->add_responsive_control(
            'fd_addons_position_rating_zindex',
            array(
                'label'     => __('Z-Index', 'fd-addons'),
                'type'      => Controls_Manager::NUMBER,
                'default'   => '',
                'selectors' => array(
                    '{{WRAPPER}} .xmoze--tn-icon' => 'z-index:{{VALUE}};',
                ),
            ),

        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_icon_hover_color',
            [
                'label' => __('Hover', 'xmoze'),
            ]
        );
        $this->add_control(
            'icon_color_hover',
            [
                'label'     => __('Hover Color', 'xmoze-hp'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xmoze--tn-single:hover .xmoze--tn-icon i,
                {{WRAPPER}} .xmoze--tn-single:hover .xmoze--tn-icon svg' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .xmoze--tn-single:hover .xmoze--tn-icon svg path' => 'fill: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'icon_color_line_hover',
            [
                'label'     => __('Hover Line Color', 'xmoze-hp'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xmoze--tn-single:hover .xmoze--tn-icon i,
                {{WRAPPER}} .xmoze--tn-single:hover .xmoze--tn-icon svg' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .xmoze--tn-single:hover .xmoze--tn-icon svg path' => 'stroke: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_responsive_control(
            'icon_size',
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
                    '{{WRAPPER}} .xmoze--tn-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .xmoze--tn-icon svg' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );


        $this->add_responsive_control(
            'icon_right_gap',
            [
                'label'          => __('Right Gap', 'xmoze-hp'),
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
                    '{{WRAPPER}} .xmoze--tn-icon i' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_margin',
            [
                'label'      => __('Margin', 'xmoze-hp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .xmoze--tn-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .xmoze--tn-icon' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        //Title style
        $this->start_controls_section(
            'there_style_title',
            [
                'label' => __('Title', 'xmoze-hp'),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'testimonial_style' => 'style-three',
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'style_title_typo',
                'label'    => __('Typography', 'xmoze-hp'),
                'selector' => '{{WRAPPER}}  .testimonial-content-box.style-three .heading-text h2',
            ]
        );
        $this->add_control(
            'style_title_color',
            [
                'label'     => __('Color', 'xmoze-hp'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testimonial-content-box.style-three .heading-text h2' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'style_title_margin',
            [
                'label'      => __('Margin', 'xmoze-hp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .testimonial-content-box.style-three .heading-text h2' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .testimonial-content-box.style-three .heading-text h2' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();



        //Quate
        $this->start_controls_section(
            'quate_style',
            [
                'label' => __('Quote', 'xmoze-hp'),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_quate' => 'yes',
                ]
            ]
        );

        $this->start_controls_tabs(
            'quate_style_tabs'
        );

        // normal
        $this->start_controls_tab(
            'tab_quate_normal_color',
            [
                'label' => __('Normal', 'xmoze'),
            ]
        );

        $this->add_control(
            'quate_color',
            [
                'label'     => __('Color', 'xmoze-hp'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xmoze--tn-icon i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .xmoze--tn-icon svg' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .xmoze--tn-icon svg path' => 'fill: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'line_quate_color',
            [
                'label'     => __('Line Color', 'xmoze-hp'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xmoze--tn-icon i,
                 {{WRAPPER}} .xmoze--tn-icon svg' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .xmoze--tn-icon svg path' => 'stroke: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'quate_bg_color',
            [
                'label'     => __('Background Color', 'xmoze-hp'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}:hover .xmoze--tn-icon' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'quate_hover_color',
            [
                'label' => __('Hover', 'xmoze'),
            ]
        );
        $this->add_control(
            'quate_color_hover',
            [
                'label'     => __('Hover Color', 'xmoze-hp'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xmoze--tn-single:hover .xmoze--tn-icon i,
                {{WRAPPER}} .xmoze--tn-single:hover .xmoze--tn-icon svg' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .xmoze--tn-single:hover .xmoze--tn-icon svg path' => 'fill: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'quate_bg_color_hover',
            [
                'label'     => __('Background Hover Color', 'xmoze-hp'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}:hover .xmoze--tn-icon' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'quate_color_line_hover',
            [
                'label'     => __('Hover Line Color', 'xmoze-hp'),
                'type'      => Controls_Manager::COLOR,
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .xmoze--tn-single:hover .xmoze--tn-icon i,
                {{WRAPPER}} .xmoze--tn-single:hover .xmoze--tn-icon svg' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .xmoze--tn-single:hover .xmoze--tn-icon svg path' => 'stroke: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_control(
            'hr1',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );

        $this->add_responsive_control(
            'quate_size',
            [
                'label'          => __('Font Size', 'xmoze-hp'),
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
                    '{{WRAPPER}} .xmoze--tn-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .xmoze--tn-icon svg' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'quate_box_size',
            [
                'label'          => __('Quate Box Size', 'xmoze-hp'),
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
                    '{{WRAPPER}} .xmoze--tn-icon' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'quate_border',
                'selector'  => '{{WRAPPER}} .xmoze--tn-icon',
            ]
        );
        $this->add_responsive_control(
            'quate_border_radius',
            [
                'label'      => __('Border Radius', 'xmoze-hp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .xmoze--tn-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .xmoze--tn-icon' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'quate_margin',
            [
                'label'      => __('Margin', 'xmoze-hp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .xmoze--tn-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .xmoze--tn-icon' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        /*
        *Socail links
        */
        $this->start_controls_section(
            'social_links',
            [
                'label' => __('Social Profile', 'xmoze-hp'),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition'   => [
                    'show_socail_links' => 'yes',
                ]

            ]
        );

        $this->add_control(
            'social_icon_color',
            [
                'label'     => __('Color', 'xmoze-hp'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .social-icons ul li i' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'social_icon_color_hover',
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
                'label' => __('Alignment', 'xmoze-hp'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => __('Left', 'xmoze-hp'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'xmoze-hp'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'flex-end' => [
                        'title' => __('Right', 'xmoze-hp'),
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
                'types'     => ['classic', 'gradient'],
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
                    'dots' => 'yes'
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
                    '{{WRAPPER}} .testimonial-slider ul.testimonial-slider-dot-list li' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'dots_align',
            [
                'label' => __('Alignment', 'xmoze-hp'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => __('Left', 'xmoze-hp'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'xmoze-hp'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'flex-end' => [
                        'title' => __('Right', 'xmoze-hp'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .testimonial-slider ul.testimonial-slider-dot-list' => 'justify-content: {{VALUE}};',
                ],
            ]
        );

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
                    '{{WRAPPER}} .testimonial-slider ul.testimonial-slider-dot-list li' => 'width: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .testimonial-slider ul.testimonial-slider-dot-list li' => 'height: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .testimonial-slider ul.testimonial-slider-dot-list li ' => 'margin-right: {{SIZE}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .testimonial-slider ul.testimonial-slider-dot-list li ' => 'margin-left: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .testimonial-slider-dot-list' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .testimonial-slider-dot-list' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
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
                    '{{WRAPPER}} .testimonial-slider ul.testimonial-slider-dot-list li' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .testimonial-slider ul.testimonial-slider-dot-list li' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
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
                    '{{WRAPPER}} .testimonial-slider ul.testimonial-slider-dot-list li.slick-active' => 'background-color: {{VALUE}}  !important;',
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
                    '{{WRAPPER}} .testimonial-slider ul.testimonial-slider-dot-list li.slick-active' => 'width: {{SIZE}}{{UNIT}} !important;',
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
                    '{{WRAPPER}} .testimonial-slider ul.testimonial-slider-dot-list li.slick-active' => 'height: {{SIZE}}{{UNIT}} !important;',
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
                    '{{WRAPPER}} .testimonial-slider-arrow button' => 'color: {{VALUE}}; border-color: {{VALUE}};',
                    '{{WRAPPER}} .testimonial-slider-arrow button svg path' => 'stroke: {{VALUE}};',
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
                    '{{WRAPPER}} .testimonial-slider-arrow button' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .testimonial-slider-arrow button svg path' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'arrow_bg_color',
            [
                'label' => __('Background Color', 'xmoze-hp'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testimonial-slider-arrow button' => 'background-color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'arrow_shadow',
                'label' => __('Shadow', 'fd-addons'),
                'selector' => '{{WRAPPER}} .testimonial-slider-arrow button ',
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
        $start = is_rtl() ? __('Right', 'elementor') : __('Left', 'elementor');
        $end = !is_rtl() ? __('Right', 'elementor') : __('Left', 'elementor');

        /* tobol */
        $this->add_control(
            'offset_orientation_v',
            [
                'label' => __('Vertical Orientation', 'elementor'),
                'type' => Controls_Manager::CHOOSE,
                'toggle' => false,
                'default' => 'start',
                'options' => [
                    'top' => [
                        'title' => __('Top', 'elementor'),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'bottom' => [
                        'title' => __('Bottom', 'elementor'),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                ],
                'render_type' => 'ui',
                'selectors' => [
                    '{{WRAPPER}} .testimonial-slider-arrow' => '{{VALUE}}: 0;',
                ],

            ]
        );

        $this->add_responsive_control(
            'arrow_position_top',
            [
                'label' => __('Vertical', 'xmoze-hp'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['%', 'px'],
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
                    '{{WRAPPER}} .testimonial-slider-arrow' => 'top: {{SIZE}}{{UNIT}} !important; bottom:auto',
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
                'size_units' => ['%', 'px'],
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
                    '{{WRAPPER}} .testimonial-slider-arrow' => 'bottom: {{SIZE}}{{UNIT}} !important; top:auto',
                ],
                'condition' => [
                    'offset_orientation_v' => 'bottom',
                ],
            ]
        );


        $this->add_control(
            'arrow_horizontal_position',
            [
                'label'             => __('Horizontal Position', 'xmoze-hp'),
                'type'              => Controls_Manager::SELECT,
                'default'           => 'space_between',
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
                'label' => __('Horizontal Prev', 'happy-elementor-addons'),
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
                    '{{WRAPPER}}  .testimonial-slider-arrow .prev' => 'left: {{SIZE}}{{UNIT}}; right: auto !important;',
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
                'label' => __('Horizontal Next', 'happy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
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
                    '{{WRAPPER}} .testimonial-slider-arrow .next' => 'right: {{SIZE}}{{UNIT}} !important; left: auto !important;',
                ],
                'condition' => [
                    'arrow_horizontal_position' => 'space_between',
                ],
            ]
        );

        $this->add_responsive_control(
            'arrow_gap_',
            [
                'label' => __('Arrow Gap', 'happy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
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
                    '{{WRAPPER}} .testimonial-slider-arrow .prev' => 'margin-right: {{SIZE}}{{UNIT}} !important; position: relative !important',
                    '{{WRAPPER}} .testimonial-slider-arrow .next ' => 'margin-right: 0 !important; position: relative !important',
                ],
                'condition' => [
                    'arrow_horizontal_position' => 'default',
                ],
            ]
        );

        $this->add_responsive_control(
            'align_arrow',
            [
                'label' => __('Alignment', 'xmoze-hp'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'xmoze-hp'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'xmoze-hp'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'xmoze-hp'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}} .testimonial-slider-arrow' => 'text-align: {{VALUE}};',
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
                    '{{WRAPPER}}  .testimonial-slider-arrow button i' => 'font-size: {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}}  .testimonial-slider-arrow button svg' => 'width: {{SIZE}}{{UNIT}}',
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
                    '{{WRAPPER}} .testimonial-slider-arrow button' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}',
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
                    '{{WRAPPER}} .testimonial-slider-arrow button' => 'line-height: {{SIZE}}{{UNIT}} !important;',
                ],
            ]

        );

        $this->add_responsive_control(
            'arrows_border_radius',
            [
                'label'      => __('Border Radius', 'xmoze-hp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .testimonial-slider-arrow button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .testimonial-slider-arrow button ' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            '_tab_arrow_hover',
            [
                'label' => __('Hover', 'xmoze-hp'),
            ]
        );

        $this->add_control(
            'arrow_hover_color',
            [
                'label' => __('Color', 'xmoze-hp'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testimonial-slider-arrow button:hover ' => 'color: {{VALUE}} !important;',
                    '{{WRAPPER}} .testimonial-slider-arrow button:hover svg path ' => 'stroke: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_control(
            'arrow_hover_fill_color',
            [
                'label' => __('Line Color', 'xmoze-hp'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testimonial-slider-arrow button:hover ' => 'color: {{VALUE}} !important;',
                    '{{WRAPPER}} .testimonial-slider-arrow button:hover path' => 'fill: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_control(
            'arrow_bg_hover_color',
            [
                'label' => __('Background Color Hover', 'xmoze-hp'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testimonial-slider-arrow button:hover ' => 'background-color: {{VALUE}}  !important;',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            '_tab_arrow_active',
            [
                'label' => __('Active', 'xmoze-hp'),
            ]
        );

        $this->add_control(
            'arrow_active_color',
            [
                'label' => __('Color', 'xmoze-hp'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testimonial-slider-arrow .slick-active' => 'color: {{VALUE}} !important;;',
                    '{{WRAPPER}} .testimonial-slider-arrow .slick-active svg path' => 'stroke: {{VALUE}} !important;;',
                ],
            ]
        );

        $this->add_control(
            'arrow_active_fill_color',
            [
                'label' => __('Line Color', 'xmoze-hp'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testimonial-slider-arrow .slick-active' => 'color: {{VALUE}} !important;;',
                    '{{WRAPPER}} .testimonial-slider-arrow .slick-active path' => 'fill: {{VALUE}} !important;;',
                ],
            ]
        );

        $this->add_control(
            'arrow_bg_active_color',
            [
                'label' => __('Background Color Hover', 'xmoze-hp'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testimonial-slider-arrow .slick-active ' => 'background-color: {{VALUE}}  !important;',
                ],
            ]
        );

        $this->end_controls_tab();


        $this->end_controls_tabs();

        $this->end_controls_section();

        /* end arrow */

        // Content Box
        $this->start_controls_section(
            'content_box_style',
            [
                'label' => __('Content Box', 'xmoze-hp'),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'testimonial_style' => 'style-three',
                ]
            ]
        );
        $this->start_controls_tabs(
            'content_box_style_tabs'
        );
        // normal
        $this->start_controls_tab(
            'content_box_style_normal',
            [
                'label' => __('Normal', 'xmoze-hp'),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'content_box_bg',
                'label' => __('Background', 'plugin-domain'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .content-box',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'content_box_border',
                'selector'  => '{{WRAPPER}} .content-box',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'content_box_shadow',
                'exclude'  => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .content-box',
            ]
        );
        $this->add_responsive_control(
            'content_box_align',
            [
                'label' => __('Alignment', 'xmoze-hp'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'xmoze-hp'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'xmoze-hp'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'xmoze-hp'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}} .content-box' => 'text-align: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_responsive_control(
            'content_box_margin_bottom',
            [
                'label'          => __('Bottom Gap', 'xmoze-hp'),
                'type'           => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
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
                    '{{WRAPPER}} .content-box' => 'margin-bottom:{{SIZE}}{{UNIT}};',
                ],
            ]
        );


        $this->add_responsive_control(
            'content_box_box_margin',
            [
                'label'      => __('Margin', 'xmoze-hp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .content-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .slick-list' => 'margin: 0 -{{RIGHT}}{{UNIT}} 0 -{{LEFT}}{{UNIT}};',

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
                    '{{WRAPPER}} .content-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .content-box' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'content_box_border_radius',
            [
                'label'      => __('Border Radius', 'xmoze-hp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .content-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .content-box' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        // hover
        $this->start_controls_tab(
            'content_box_style_hover',
            [
                'label' => __('Normal', 'xmoze-hp'),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'content_box_bg_hover',
                'label' => __('Background', 'plugin-domain'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .content-box:hover',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'content_box_border_hover',
                'selector'  => '{{WRAPPER}} .content-box:hover',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'content_box_shadow_hover',
                'exclude'  => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .content-box:hover',
            ]
        );

        $this->add_responsive_control(
            'content_box_border_radius_hover',
            [
                'label'      => __('Border Radius', 'xmoze-hp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .content-box:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .content-box:hover' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();


        //Box Style
        $this->start_controls_section(
            'ts_style',
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
            'tn_bg_color',
            [
                'label' => __('Normal', 'xmoze-hp'),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'bg',
                'label' => __('Background', 'plugin-domain'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .xmoze--tn-single',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'tn_border',
                'selector'  => '{{WRAPPER}} .xmoze--tn-single',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'tn_shadow',
                'exclude'  => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .xmoze--tn-single',
            ]
        );
        $this->add_responsive_control(
            'align',
            [
                'label' => __('Alignment', 'xmoze-hp'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'xmoze-hp'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'xmoze-hp'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'xmoze-hp'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}} .xmoze--tn-single' => 'text-align: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_responsive_control(
            'margin_bottom',
            [
                'label'          => __('Bottom Gap', 'xmoze-hp'),
                'type'           => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
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
                    '{{WRAPPER}} .xmoze--tn-single' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );


        $this->add_responsive_control(
            'box_margin',
            [
                'label'      => __('Margin', 'xmoze-hp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .xmoze--tn-single' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .slick-list' => 'margin: 0 -{{RIGHT}}{{UNIT}} 0 -{{LEFT}}{{UNIT}};',

                ],
            ]
        );

        $this->add_responsive_control(
            'box_padding',
            [
                'label'      => __('Padding', 'xmoze-hp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .xmoze--tn-single' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .xmoze--tn-single' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'border_radius',
            [
                'label'      => __('Border Radius', 'xmoze-hp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .xmoze--tn-single' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .xmoze--tn-single' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        // hover
        $this->start_controls_tab(
            'bg_color_hover',
            [
                'label' => __('Normal', 'xmoze-hp'),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'bg_hover',
                'label' => __('Background', 'plugin-domain'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .xmoze--tn-single:hover',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'tn_border_hover',
                'selector'  => '{{WRAPPER}} .xmoze--tn-single:hover',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'tn_shadow_hover',
                'exclude'  => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .xmoze--tn-single:hover',
            ]
        );

        $this->add_responsive_control(
            'border_radius_hover',
            [
                'label'      => __('Border Radius', 'xmoze-hp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .xmoze--tn-single:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .xmoze--tn-single:hover' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
    }

    protected function render()
    {

        $settings = $this->get_settings_for_display();
        $numabr_of_item = !empty($settings['item_per_page']) ? $settings['item_per_page'] : -1;
        $testimonial_style = $settings['testimonial_style'];
        $testimonial_mesonary = $settings['testimonial_mesonary'];


        //this code slider option
        $slider_extraSetting = array(

            'loop' => (!empty($settings['loop']) && 'yes' === $settings['loop']) ? true : false,
            'dots' => (!empty($settings['dots']) && 'yes' === $settings['dots']) ? true : false,
            'autoplay' => (!empty($settings['autoplay']) && 'yes' === $settings['autoplay']) ? true : false,
            'nav' => (!empty($settings['arrows']) && 'yes' === $settings['arrows']) ? true : false,
            'nav' => (!empty($settings['arrows']) && 'yes' === $settings['arrows']) ? true : false,
            'show_vertical' => (!empty($settings['show_vertical']) && 'yes' === $settings['show_vertical']) ? true : false,
            'show_center_mode' => (!empty($settings['show_center_mode']) && 'yes' === $settings['show_center_mode']) ? true : false,
            'autoplaytimeout' => !empty($settings['autoplaytimeout']) ? $settings['autoplaytimeout'] : '5000',

            //this a responsive layout
            'per_coulmn' => (!empty($settings['per_coulmn'])) ? $settings['per_coulmn'] : 3,
            'per_coulmn_tablet' => (!empty($settings['per_coulmn_tablet'])) ? $settings['per_coulmn_tablet'] : 2,
            'per_coulmn_mobile' => (!empty($settings['per_coulmn_mobile'])) ? $settings['per_coulmn_mobile'] : 1
        );

        $jasondecode = wp_json_encode($slider_extraSetting);

        if (('yes' == $settings['show_slider_settings'])) {
            $this->add_render_attribute('testimonail_version', 'class', array('testimonial-slider', 't-style'));
            $this->add_render_attribute('testimonail_version', 'data-settings', $jasondecode);
        } else {
            $this->add_render_attribute('testimonail_version', 'class', array($testimonial_style, $testimonial_mesonary, 'row g-0 justify-content-center'));
            //gride class
            $grid_classes = [];
            $grid_classes[] = 'col-xl-' . $settings['per_line'];
            $grid_classes[] = 'col-md-' . $settings['per_line_tablet'];
            $grid_classes[] = 'col-sm-' . $settings['per_line_mobile'];
            $grid_classes = implode(' ', $grid_classes);
            $this->add_render_attribute('tn_classes', 'class', [$grid_classes, 'col-lg-6']);
        }

        $query_args = [
            'post_type'           => 'xmoze_testimonial',
            'orderby' => $settings['orderby'],
            'order'   => $settings['order'],
            'posts_per_page'      => $numabr_of_item,
            'post_status'         => 'publish',
            'ignore_sticky_posts' => 1,
        ];

        // get_type
        if ('selected' === $settings['post_by']) {
            $query_args['post__in'] = (array)$settings['post__in'];
        }
        $t_loop = new \WP_Query($query_args);

?>

        <div class="xmoze--tn-wraper <?php echo esc_attr($settings['testimonial_style']); ?>">
            <div <?php echo $this->get_render_attribute_string('testimonail_version'); ?>>
                <?php while ($t_loop->have_posts()) : $t_loop->the_post();
                    $content = ($settings['t_word_limit']['size']) ? wp_trim_words(get_the_content(), $settings['t_word_limit']['size'], '  ') : get_the_content();
                ?>
                    <div <?php echo $this->get_render_attribute_string('tn_classes'); ?>>

                        <?php if ($testimonial_style) {
                            include('testimonial/' . $testimonial_style . '.php');
                        } ?>

                    </div>
                <?php endwhile;
                wp_reset_postdata(); ?>
            </div>

            <?php if ('yes' == $settings['show_slider_settings'] && 'yes' == $settings['arrows']) : ?>
                <div class="testimonial-slider-arrow">
                    <?php if (!empty($settings['arrow_prev_icon']['value'])) : ?>
                        <button type="button" class="slick-prev prev slick-arrow slick-active">
                            <?php Icons_Manager::render_icon($settings['arrow_prev_icon'], ['aria-hidden' => 'true']); ?>
                        </button>
                    <?php endif; ?>

                    <?php if (!empty($settings['arrow_next_icon']['value'])) : ?>
                        <button type="button" class="slick-next next slick-arrow ">
                            <?php Icons_Manager::render_icon($settings['arrow_next_icon'], ['aria-hidden' => 'true']); ?>
                        </button>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

        </div>
<?php
    }
}
$widgets_manager->register(new \Xmoze_Testimonail_Loop());
