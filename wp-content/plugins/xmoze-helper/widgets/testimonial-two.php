<?php

/**
 * Finisys Testimonial Normal Widget.
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
use Elementor\Repeater;
use Elementor\Icons_Manager;

if (!defined('ABSPATH')) {
    exit;
}
// If this file is called directly, abort.
class Xmoze_Testimonail_Loop_Two extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'xmoze-testimonial-two';
    }

    public function get_title()
    {
        return __('Xmoze Testimonial V2', 'xmoze-hp');
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
        return ['slick', 'xmoze-addons'];
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
            'item_per_page',
            [
                'label'       => __('Numbar Of Items', 'xmoze'),
                'type'        => Controls_Manager::NUMBER,
                'default'     => '',
                'description' => 'If Numbar Of Items value empty value show all posts',
            ]
        );

        $this->end_controls_section();
        //Slider Setting
        $this->start_controls_section(
            'slider_settings',
            [
                'label' => __('Slider Settings', 'xmoze-hp'),
                'tab'   => Controls_Manager::TAB_CONTENT,
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
            'draggable',
            [
                'label' => __('Draggable', 'xmoze-hp'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'xmoze-hp'),
                'label_off' => __('Hide', 'xmoze-hp'),
                'return_value' => 'yes',
                'default' => 'true',
            ]
        );
        $this->add_control(
            'focus',
            [
                'label' => __('Clickable', 'xmoze-hp'),
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
                    '{{WRAPPER}} .testimonial-v2-content-slider__img img' => 'width: {{SIZE}}{{UNIT}} !important;',
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
                    '{{WRAPPER}} .testimonial-v2-content-slider__img img' => 'max-width: {{SIZE}}{{UNIT}} !important;',
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
                    '{{WRAPPER}} .testimonial-v2-content-slider__img img' => 'height: {{SIZE}}{{UNIT}} !important;',
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
                    '{{WRAPPER}} .testimonial-v2-content-slider__img img' => 'object-fit: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'image_border',
                'selector'  => '{{WRAPPER}} .testimonial-v2-content-slider__img img',
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
                    '{{WRAPPER}} .testimonial-v2-content-slider__img img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                    'body.rtl {{WRAPPER}} .testimonial-v2-content-slider__img img' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}} !important;;',
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
                    '{{WRAPPER}} .testimonial-v2-content-slider__img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .testimonial-v2-content-slider__img' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
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
                'selector' => '{{WRAPPER}} .testimonial-v2-content-slider__img img',
            ]
        );
        $this->end_controls_section();

        //Top Content
        $this->start_controls_section(
            'top_content_settings',
            [
                'label' => __('Top Content', 'xmoze-hp'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'name_options',
            [
                'label' => __('Name Options', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'top_slider_name_color',
            [
                'label'     => __('Color', 'xmoze-hp'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xmoze--tn-two__meta-name' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'top_slider_name_color_hover',
            [
                'label'     => __('Hover Color', 'xmoze-hp'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testimonial-v2-content-slider__content:hover .xmoze--tn-two__meta-name' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'top_slider_name_typo',
                'label'    => __('Typography', 'xmoze-hp'),
                'selector' => '{{WRAPPER}}  .xmoze--tn-two__meta-name',
            ]
        );
        $this->add_responsive_control(
            'top_slider_name_margin',
            [
                'label'      => __('Margin', 'xmoze-hp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .xmoze--tn-two__meta-name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .xmoze--tn-two__meta-name' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'top_slider_des_options',
            [
                'label' => __('Descriptions Options', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'top_slider_des_color',
            [
                'label'     => __('Color', 'xmoze-hp'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testimonial-v2-content-slider__content p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'top_slider_des_color_hover',
            [
                'label'     => __('Hover Color', 'xmoze-hp'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testimonial-v2-content-slider__content:hover .testimonial-v2-content-slider__content p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'top_slider_des_typo',
                'label'    => __('Typography', 'xmoze-hp'),
                'selector' => '{{WRAPPER}}  .testimonial-v2-content-slider__content p',
            ]
        );
        $this->add_responsive_control(
            'top_slider_des_margin',
            [
                'label'      => __('Margin', 'xmoze-hp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .testimonial-v2-content-slider__content p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .testimonial-v2-content-slider__content p' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'top_slider_deg_options',
            [
                'label' => __('Positions Options', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'top_slider_deg_color',
            [
                'label'     => __('Color', 'xmoze-hp'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xmoze--tn-two__meta-designation' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'top_slider_deg_color_hover',
            [
                'label'     => __('Hover Color', 'xmoze-hp'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testimonial-v2-content-slider__content:hover .xmoze--tn-two__meta-designation' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'top_slider_deg_typo',
                'label'    => __('Typography', 'xmoze-hp'),
                'selector' => '{{WRAPPER}}  .xmoze--tn-two__meta-designation',
            ]
        );
        $this->add_responsive_control(
            'top_slider_deg_margin',
            [
                'label'      => __('Margin', 'xmoze-hp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .xmoze--tn-two__meta-designation' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .xmoze--tn-two__meta-designation' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
        //tab_image
        $this->start_controls_section(
            'tab_image_style',
            [
                'label' => __('Tab Image', 'xmoze-hp'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'tab_img_width',
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
                    '{{WRAPPER}} .testimonial-v2-tab__img img' => 'width: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );

        $this->add_responsive_control(
            'tab_img_space',
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
                    '{{WRAPPER}} .testimonial-v2-tab__img img' => 'max-width: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );
        $this->add_responsive_control(
            'tab_img_height',
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
                    '{{WRAPPER}} .testimonial-v2-tab__img img' => 'height: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );

        $this->add_responsive_control(
            'tab_img_object-fit',
            [
                'label'     => __('Object Fit', 'xmoze-hp'),
                'type'      => Controls_Manager::SELECT,
                'condition' => [
                    'tab_img_height[size]!' => '',
                ],
                'options'   => [
                    ''        => __('Default', 'xmoze-hp'),
                    'fill'    => __('Fill', 'xmoze-hp'),
                    'cover'   => __('Cover', 'xmoze-hp'),
                    'contain' => __('Contain', 'xmoze-hp'),
                ],
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .testimonial-v2-tab__img img' => 'object-fit: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'tab_img_image_border',
                'selector'  => '{{WRAPPER}} .testimonial-v2-tab__img img',
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'tab_img_border_radius',
            [
                'label'      => __('Border Radius', 'xmoze-hp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .testimonial-v2-tab__img img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                    'body.rtl {{WRAPPER}} .testimonial-v2-tab__img img' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}} !important;;',
                ],
            ]
        );

        $this->add_responsive_control(
            'tab_img_margin',
            [
                'label'      => __('Margin', 'xmoze-hp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .testimonial-v2-tab__img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .testimonial-v2-tab__img' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'tab_img_box_shadow',
                'exclude'  => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .testimonial-v2-tab__img img',
            ]
        );
        $this->end_controls_section();

        //Top Content
        $this->start_controls_section(
            'tab_meta_settings',
            [
                'label' => __('Tab Meta', 'xmoze-hp'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'tab_meta_name_options',
            [
                'label' => __('Name Options', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'tab_meta_name_color',
            [
                'label'     => __('Color', 'xmoze-hp'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testimonial-v2-tab__meta-name' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'tab_meta_name_color_hover',
            [
                'label'     => __('Hover Color', 'xmoze-hp'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testimonial-v2-content-slider__content:hover .testimonial-v2-tab__meta-name' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'tab_meta_name_typo',
                'label'    => __('Typography', 'xmoze-hp'),
                'selector' => '{{WRAPPER}}  .testimonial-v2-tab__meta-name',
            ]
        );
        $this->add_responsive_control(
            'tab_meta_name_margin',
            [
                'label'      => __('Margin', 'xmoze-hp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .testimonial-v2-tab__meta-name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .testimonial-v2-tab__meta-name' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'tab_meta_deg_options',
            [
                'label' => __('Positions Options', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'tab_meta_deg_color',
            [
                'label'     => __('Color', 'xmoze-hp'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testimonial-v2-tab__meta-designation' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'tab_meta_deg_color_hover',
            [
                'label'     => __('Hover Color', 'xmoze-hp'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testimonial-v2-content-slider__content:hover .testimonial-v2-tab__meta-designation' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'tab_meta_deg_typo',
                'label'    => __('Typography', 'xmoze-hp'),
                'selector' => '{{WRAPPER}}  .testimonial-v2-tab__meta-designation',
            ]
        );
        $this->add_responsive_control(
            'tab_meta_deg_margin',
            [
                'label'      => __('Margin', 'xmoze-hp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .testimonial-v2-tab__meta-designation' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .testimonial-v2-tab__meta-designation' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
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
                    '{{WRAPPER}} .xmoze--tn-review .active_color' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .xmoze--tn-review svg' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .xmoze--tn-review svg path' => 'fill: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'icon_inactive_color',
            [
                'label'     => __('Inactive Color', 'xmoze-hp'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xmoze--tn-review .inactive_color' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .xmoze--tn-review svg' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .xmoze--tn-review svg path' => 'fill: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'line_icon_color',
            [
                'label'     => __('Line Color', 'xmoze-hp'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xmoze--tn-review i,
                    {{WRAPPER}} .xmoze--tn-review svg' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .xmoze--tn-review svg path' => 'stroke: {{VALUE}}',
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
                    '{{WRAPPER}} .xmoze--tn-review' => 'position:{{VALUE}};',
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
                    '{{WRAPPER}} .xmoze--tn-review' => 'top:{{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .xmoze--tn-review' => 'right:{{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .xmoze--tn-review' => 'bottom:{{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .xmoze--tn-review' => 'left:{{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .xmoze--tn-review' => 'left:calc( 50% + {{SIZE}}{{UNIT}} );',
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
                    '{{WRAPPER}} .xmoze--tn-review' => 'z-index:{{VALUE}};',
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
                    '{{WRAPPER}} .testimonial-v2-tab__single:hover .xmoze--tn-review i,
                    {{WRAPPER}} .testimonial-v2-tab__single:hover .xmoze--tn-review svg' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .testimonial-v2-tab__single:hover .xmoze--tn-review svg path' => 'fill: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'icon_color_line_hover',
            [
                'label'     => __('Hover Line Color', 'xmoze-hp'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testimonial-v2-tab__single:hover .xmoze--tn-review i,
                    {{WRAPPER}} .testimonial-v2-tab__single:hover .xmoze--tn-review svg' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .testimonial-v2-tab__single:hover .xmoze--tn-review svg path' => 'stroke: {{VALUE}}',
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
                    '{{WRAPPER}} .xmoze--tn-review i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .xmoze--tn-review svg' => 'width: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .xmoze--tn-review i' => 'margin-right: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .xmoze--tn-review' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .xmoze--tn-review' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        /* end arrow */

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
                'selector' => '{{WRAPPER}} .testimonial-v2-tab__single',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'tn_border',
                'selector'  => '{{WRAPPER}} .testimonial-v2-tab__single',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'tn_shadow',
                'exclude'  => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .testimonial-v2-tab__single',
            ]
        );
        $this->add_responsive_control(
            'tn_align',
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
                    '{{WRAPPER}} .testimonial-v2-tab__single' => 'text-align: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_responsive_control(
            'tn_margin_bottom',
            [
                'label'          => __('Top Gap', 'xmoze-hp'),
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
                    '{{WRAPPER}} .testimonial-v2-tab__single' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'tn_margin_right',
            [
                'label'          => __('Right Gap', 'xmoze-hp'),
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
                    '{{WRAPPER}} .testimonial-v2-tab-slider .slick-slide' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );


        $this->add_responsive_control(
            'tn_box_margin',
            [
                'label'      => __('Margin', 'xmoze-hp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .testimonial-v2-tab__single' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .slick-list' => 'margin: 0 -{{RIGHT}}{{UNIT}} 0 -{{LEFT}}{{UNIT}};',

                ],
            ]
        );

        $this->add_responsive_control(
            'tn_box_padding',
            [
                'label'      => __('Padding', 'xmoze-hp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .testimonial-v2-tab__single' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .testimonial-v2-tab__single' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'tn_border_radius',
            [
                'label'      => __('Border Radius', 'xmoze-hp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .testimonial-v2-tab__single' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .testimonial-v2-tab__single' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        // hover
        $this->start_controls_tab(
            'tn_bg_color_hover',
            [
                'label' => __('Normal', 'xmoze-hp'),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'tn_bg_hover',
                'label' => __('Background', 'plugin-domain'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .testimonial-v2-tab__single:hover',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'tn_border_hover',
                'selector'  => '{{WRAPPER}} .testimonial-v2-tab__single:hover',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'tn_shadow_hover',
                'exclude'  => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .testimonial-v2-tab__single:hover',
            ]
        );

        $this->add_responsive_control(
            'tn_border_radius_hover',
            [
                'label'      => __('Border Radius', 'xmoze-hp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .testimonial-v2-tab__single:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .testimonial-v2-tab__single:hover' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
    }

    protected function render()
    {

        $settings = $this->get_settings_for_display();
        $numabr_of_item = !empty($settings['item_per_page']) ? $settings['item_per_page'] : -1;

        //this code slider option
        $slider_extraSetting = array(

            'loop' => (!empty($settings['loop']) && 'yes' === $settings['loop']) ? true : false,
            'dots' => (!empty($settings['dots']) && 'yes' === $settings['dots']) ? true : false,
            'autoplay' => (!empty($settings['autoplay']) && 'yes' === $settings['autoplay']) ? true : false,
            'nav' => (!empty($settings['arrows']) && 'yes' === $settings['arrows']) ? true : false,
            'show_vertical' => (!empty($settings['show_vertical']) && 'yes' === $settings['show_vertical']) ? true : false,
            'draggable' => (!empty($settings['draggable']) && 'yes' === $settings['draggable']) ? true : false,
            'focus' => (!empty($settings['focus']) && 'yes' === $settings['focus']) ? true : false,
            'autoplaytimeout' => !empty($settings['autoplaytimeout']) ? $settings['autoplaytimeout'] : '5000',

            //this a responsive layout
            'per_coulmn' => (!empty($settings['per_coulmn'])) ? $settings['per_coulmn'] : 3,
            'per_coulmn_tablet' => (!empty($settings['per_coulmn_tablet'])) ? $settings['per_coulmn_tablet'] : 2,
            'per_coulmn_mobile' => (!empty($settings['per_coulmn_mobile'])) ? $settings['per_coulmn_mobile'] : 1
        );
        $jasondecode = wp_json_encode($slider_extraSetting);
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


        <div class="testimonial-v2-wrapper">
            <!-- Content Slider -->
            <div class="testimonial-v2-content-slider" data-settings='<?php echo $jasondecode ?>'>

                <?php while ($t_loop->have_posts()) : $t_loop->the_post();
                    $content = ($settings['t_word_limit']['size']) ? wp_trim_words(get_the_excerpt(), $settings['t_word_limit']['size'], '') : get_the_excerpt();
                ?>

                    <!-- Single Slider -->
                    <div class="testimonial-v2-content-slider__single">
                        <div class="row align-items-center">
                            <!-- Image -->
                            <div class="col-md-5">
                                <?php if (has_post_thumbnail()) : ?>
                                    <div class="testimonial-v2-content-slider__img">
                                        <?php the_post_thumbnail('full') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <!--/ .Image  -->
                            <div class="col-xl-6 offset-xl-1 col-md-7">
                                <div class="testimonial-v2-content-slider__content">
                                    <?php echo xmoze_get_meta($content); ?>
                                    <h4 class="xmoze--tn-two__meta-info">
                                        <h3 class="xmoze--tn-two__meta-name">
                                            <?php the_title() ?>
                                        </h3>
                                        <span class="xmoze--tn-two__meta-designation">
                                            <?php echo get_field('designation') ?>
                                        </span>
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ .Single Slider -->
                <?php endwhile;
                wp_reset_postdata(); ?>

            </div>
            <!-- Tab Slider -->
            <div class="testimonial-v2-tab-slider">

                <?php while ($t_loop->have_posts()) : $t_loop->the_post(); ?>

                    <!-- Single Slider -->
                    <div class="testimonial-v2-tab__single d-flex align-items-center">
                        <div class="testimonial-v2-tab__img">
                            <?php the_post_thumbnail('medium') ?>
                        </div>
                        <div class="testimonial-v2-tab__meta-info">
                            <h4 class="testimonial-v2-tab__meta-name">
                                <?php the_title() ?>
                            </h4>
                            <p class="testimonial-v2-tab__meta-designation">
                                <?php echo get_field('designation') ?>
                            </p>
                            <?php if ('yes' === $settings['show_icon'] && function_exists('the_field')) :
                                $ratting = get_field('review_rating');
                            ?>
                                <div class="xmoze--tn-review">
                                    <?php for ($i = 0; $i < 5; $i++) :
                                        $class = '';
                                    ?>
                                        <?php if ($ratting > $i) {
                                            $class = "active_color";
                                        } ?>
                                        <span class="inactive_color">
                                            <?php Icons_Manager::render_icon($settings['icon'], ['class' => $class, 'aria-hidden' => 'true']) ?>
                                        </span>
                                    <?php endfor; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <!--/ .Single Slider -->

                <?php endwhile;
                wp_reset_postdata(); ?>
            </div>
        </div>

<?php

    }
}
$widgets_manager->register(new \Xmoze_Testimonail_Loop_Two());
