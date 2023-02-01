<?php
if (!defined('ABSPATH')) {
    exit;
}
// Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;
use Elementor\Group_Control_Background;
use Elementor\Icons_Manager;

class Xmoze_Drbox extends \Elementor\Widget_Base
{

    /**
     * Retrieve the widget name.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name()
    {
        return 'xmoze-drbox';
    }


    /**
     * Retrieve the widget title.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title()
    {
        return __('Xmoze Doctor Box', 'xmoze-hp');
    }

    /**
     * Retrieve the widget icon.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon()
    {
        return 'eicon-image-rollover';
    }

    /**
     * Retrieve the list of categories the widget belongs to.
     *
     * Used to determine where to display the widget in the editor.
     *
     * Note that currently Elementor supports only one category.
     * When multiple categories passed, Elementor uses the first one.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories()
    {
        return ['xmoze-addons'];
    }

    /**
     * Register the widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function register_controls()
    {
        $this->start_controls_section(
            'section_layout',
            [
                'label' => __('Content', 'xmoze-hp'),
            ]
        );

        $this->add_control(
            'image',
            [
                'label'   => __( 'Choose Image', 'xmoze' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
            ]
        );

        $this->add_control(
			'rating',
			[
				'label' => __( 'Rating', 'xmoze' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 0.1,
				'max' => 100,
				'step' => 0.1,
				'default' => 5,
			]
		);

        $this->add_control(
            'catgory',
            [
                'label'       => __( 'Catgory', 'xmoze' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => __( 'Radiology', 'xmoze' ),
            ]
        );

        $this->add_control(
            'name',
            [
                'label'       => __( 'Name', 'xmoze' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => __( 'Dr. Esther Howard', 'xmoze' ),
            ]
        );

        $this->add_control(
            'disignateon',
            [
                'label'       => __( 'Disignateon', 'xmoze' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => __( 'M.B.B.S, Ph.D', 'xmoze' ),
            ]
        );

        $this->add_control(
            'deggre',
            [
                'label'       => __( 'Deggre', 'xmoze' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => __( 'Attending physician, Cardiology editor.', 'xmoze' ),
            ]
        );

        $this->add_control(
            'available',
            [
                'label'       => __( 'Available', 'xmoze' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => __( 'Available Today', 'xmoze' ),
            ]
        );

        $this->add_control(
            'btn_text',
            [
                'label'       => __( 'Button Text', 'xmoze' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => __( 'Book Today', 'xmoze' ),
            ]
        );

        $this->add_control(
			'btn_url',
			[
				'label' => __( 'Link', 'xmoze' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'xmoze' ),
			]
		);
        $this->end_controls_section();

        /* 
        *Image
        */
        $this->start_controls_section('box_iamge',
            [
                'label' => __('Image', 'xmoze-hp'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'image_border',
                'selector'  => '{{WRAPPER}} .xmoze-dr-thum img',
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
                'selector' => '{{WRAPPER}} .xmoze-dr-thum img',
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
                    '{{WRAPPER}} .xmoze-dr-thum img' => 'width: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .xmoze-dr-thum img' => 'max-width: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .xmoze-dr-thum img' => 'height: {{SIZE}}{{UNIT}} !important;',
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
                    '{{WRAPPER}} .xmoze-dr-thum img' => 'object-fit: {{VALUE}};',
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
                    '{{WRAPPER}} .xmoze-dr-thum img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .xmoze-dr-thum img' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();



        /* 
        *Rating
        */

        $this->start_controls_section('box_rating',
            [
                'label' => __('Rating', 'xmoze-hp'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'xmoze_rating_color',
            [
                'label'     => __('Color', 'xmoze-hp'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}  .xmoze-dr-rating-number, {{WRAPPER}} .xmoze-dr-rating i' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'xmoze_rating_bg_color',
            [
                'label'     => __('Color', 'xmoze-hp'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xmoze-dr-rating' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'rating_border',
                'label'    => __( 'Border', 'xmoze-hp' ),
                'selector' => '{{WRAPPER}} .xmoze-dr-rating',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'rating_shadow',
                'label'    => __( 'Button Shadow', 'xmoze-hp' ),
                'selector' => '{{WRAPPER}} .xmoze-dr-rating',
            ]
        );
        

        $this->add_responsive_control(
            'xmoze_rating_margin',
            [
                'label'      => __('Margin', 'xmoze-hp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}}  .xmoze-dr-rating' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}}  .xmoze-dr-rating' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'xmoze_rating_padding',
            [
                'label'      => __('Margin', 'xmoze-hp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}}  .xmoze-dr-rating' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}}  .xmoze-dr-rating' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'xmoze_rating_border_radius',
            [
                'label'      => __('Border Radius', 'xmoze-hp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}}  .xmoze-dr-rating' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}}  .xmoze-dr-rating' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        /* 
        *Category
        */
        $this->start_controls_section('box_catgory',
            [
                'label' => __('Category', 'xmoze-hp'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'xmoze_team_category_color',
            [
                'label'     => __('Color', 'xmoze-hp'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}  .xmoze-content-box span.xmoze-dr-catgory' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'category_typo',
                'label'    => __('Typography', 'xmoze-hp'),
                'selector' => '{{WRAPPER}}   .xmoze-content-box span.xmoze-dr-catgory',
            ]
        );
        $this->add_responsive_control(
            'xmoze_team_category_padding',
            [
                'label'      => __('Margin', 'xmoze-hp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}}  .xmoze-content-box span.xmoze-dr-catgory' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}}  .xmoze-content-box span.xmoze-dr-catgory' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        /* 
        *Name
        */
        $this->start_controls_section('box_name',
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
                    '{{WRAPPER}}  .xmoze-content-box .xmoze-dr-name' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'name_typo',
                'label'    => __('Typography', 'xmoze-hp'),
                'selector' => '{{WRAPPER}}   .xmoze-content-box .xmoze-dr-name',
            ]
        );
        $this->add_responsive_control(
            'xmoze_team_name_padding',
            [
                'label'      => __('Margin', 'xmoze-hp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}}  .xmoze-content-box .xmoze-dr-name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}}  .xmoze-content-box .xmoze-dr-name' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        
        /*  
        *Designation
        */
        $this->start_controls_section('box_designation',
            [
                'label' => __('Designation', 'xmoze-hp'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'xmoze_team_designation_color',
            [
                'label'     => __('Color', 'xmoze-hp'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}  .xmoze-content-box .xmoze-dr-Designation' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'designation_typo',
                'label'    => __('Typography', 'xmoze-hp'),
                'selector' => '{{WRAPPER}}   .xmoze-content-box .xmoze-dr-Designation',
            ]
        );
        $this->add_responsive_control(
            'xmoze_team_designation_padding',
            [
                'label'      => __('Margin', 'xmoze-hp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}}  .xmoze-content-box .xmoze-dr-Designation' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}}  .xmoze-content-box .xmoze-dr-Designation' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        /*  
        *Deggre
        */
        $this->start_controls_section('box_deggre',
            [
                'label' => __('Deggre', 'xmoze-hp'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'xmoze_team_deggre_color',
            [
                'label'     => __('Color', 'xmoze-hp'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}  .xmoze-content-box .xmoze-dr-deggre' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'deggre_typo',
                'label'    => __('Typography', 'xmoze-hp'),
                'selector' => '{{WRAPPER}}   .xmoze-content-box .xmoze-dr-deggre',
            ]
        );
        $this->add_responsive_control(
            'xmoze_team_deggre_padding',
            [
                'label'      => __('Margin', 'xmoze-hp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}}  .xmoze-content-box .xmoze-dr-deggre' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}}  .xmoze-content-box .xmoze-dr-deggre' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        /*  
        *Available
        */
        $this->start_controls_section('box_available',
            [
                'label' => __('Available', 'xmoze-hp'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'xmoze_team_available_color',
            [
                'label'     => __('Color', 'xmoze-hp'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}  .xmoze-contetn-bottom .xmoze-dr-available' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'available_typo',
                'label'    => __('Typography', 'xmoze-hp'),
                'selector' => '{{WRAPPER}}   .xmoze-contetn-bottom .xmoze-dr-available',
            ]
        );
        $this->add_responsive_control(
            'xmoze_team_available_padding',
            [
                'label'      => __('Margin', 'xmoze-hp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}}  .xmoze-contetn-bottom .xmoze-dr-available' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}}  .xmoze-contetn-bottom .xmoze-dr-available' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();


        $this->start_controls_section(
            'button_style',
            [
                'label' => __( 'Button', 'xmoze-hp' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

 
        $this->start_controls_tabs(
            'button_style_tabs'
        );

        $this->start_controls_tab(
            'button_style_normal_tab',
            [
                'label' => __( 'Normal', 'xmoze-hp' ),
            ]
        );
        
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'btn_typography',
                'label'    => __( 'Typography', 'xmoze-hp' ),
                'selector' => '{{WRAPPER}} .xmoze-dr-btn',
            ]
        );

        $this->add_control(
            'boxed_btn_color',
            [
                'label'     => __( 'Button Color', 'xmoze-hp' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .xmoze-dr-btn' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'boxed_btn_background',
            [
                'label'     => __( 'Background Color', 'xmoze-hp' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xmoze-dr-btn' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'button_border',
                'label'    => __( 'Border', 'xmoze-hp' ),
                'selector' => '{{WRAPPER}} .xmoze-dr-btn',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'button_shadow',
                'label'    => __( 'Button Shadow', 'xmoze-hp' ),
                'selector' => '{{WRAPPER}} .xmoze-dr-btn',
            ]
        );
        $this->add_responsive_control(
            'btn_width',
            [
                'label'      => __( 'Min Width', 'xmoze-hp' ),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    '%'  => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .xmoze-dr-btn'=> 'min-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'btn_height',
            [
                'label'      => __( 'Min Height', 'xmoze-hp' ),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    '%'  => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .xmoze-dr-btn' => 'min-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'button_radius',
            [
                'label'      => __( 'Border Radius', 'xmoze-hp' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .xmoze-dr-btn'          => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .xmoze-dr-btn' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}}
                    ;',
                ],
            ]
        );
      
        $this->add_responsive_control(
            'button_padding',
            [
                'label'      => __( 'Button Padding', 'xmoze-hp' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .xmoze-dr-btn'          => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .xmoze-dr-btn' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'button_style_hover_tab',
            [
                'label' => __( 'Hover', 'xmoze-hp' ),
            ]
        );

        $this->add_control(
            'btn_hover_color',
            [
                'label'     => __( 'Button Color', 'xmoze-hp' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xmoze-dr-btn:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'btn_hover_background',
            [
                'label'     => __( 'Background Color', 'xmoze-hp' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xmoze-dr-btn:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );


        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'button_hover_border',
                'label'    => __( 'Border', 'xmoze-hp' ),
                'selector' => '{{WRAPPER}} .xmoze-dr-btn:hover',
            ]
        );

        $this->add_control(
            'btn_hover_animation',
            [
                'label' => __( 'Hover Animation', 'xmoze-hp' ),
                'type'  => \Elementor\Controls_Manager::HOVER_ANIMATION,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'button_hover_shadow',
                'label'    => __( 'Button Shadow', 'xmoze-hp' ),
                'selector' => '{{WRAPPER}} .xmoze-dr-btn:hover',
            ]
        );

        $this->add_responsive_control(
            'button_hover_radius',
            [
                'label'      => __( 'Border Radius', 'xmoze-hp' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .xmoze-dr-btn:hover'          => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .xmoze-dr-btn:hover' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}}
                    ;',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        /* box style */
        $this->start_controls_section('content_box',
            [
                'label' => __('Content Box', 'xmoze-hp'),
                'tab'   => Controls_Manager::TAB_STYLE,

            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'cbox_border',
                'selector'  => '{{WRAPPER}} .xmoze-content-box',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'cbox_shadow',
                'exclude'  => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .xmoze-content-box',
            ]
        );
        $this->add_responsive_control(
            'cbox_radius',
            [
                'label'      => __( 'Border Radius', 'xmoze-hp' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .xmoze-content-box'          => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .xmoze-content-box' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}}
                    ;',
                ],
            ]
        );
        $this->add_responsive_control(
            'cbox_margin',
            [
                'label'      => __( 'Margin', 'xmoze-hp' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .xmoze-content-box'          => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .xmoze-content-box' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}}
                    ;',
                ],
            ]
        );
        $this->add_responsive_control(
            'cbox_padding',
            [
                'label'      => __( 'padding', 'xmoze-hp' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .xmoze-content-box'          => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .xmoze-content-box' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}}
                    ;',
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
                    '{{WRAPPER}} .xmoze-dr-single-item' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'box_border',
                'selector'  => '{{WRAPPER}} .xmoze-dr-single-item',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'box_shadow',
                'exclude'  => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .xmoze-dr-single-item',
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
                    '{{WRAPPER}} .xmoze-dr-single-item' => 'text-align: {{VALUE}} !important;',
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
                    '{{WRAPPER}} .xmoze-dr-single-item' => 'margin-bottom: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .xmoze-dr-single-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .xmoze-dr-single-item' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
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
                    '{{WRAPPER}} .xmoze-dr-single-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .xmoze-dr-single-item' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
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
                    '{{WRAPPER}} .xmoze-dr-single-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .xmoze-dr-single-item' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();
        
        // hover
        $this->start_controls_tab(
            'box_hover',
            [
                'label' => __('Normal', 'xmoze-hp'),
            ]
        );
        
        $this->add_control(
            'bg_hover',
            [
                'label'     => __('Backround Color', 'xmoze-hp'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xmoze-dr-single-item:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'tn_border_hover',
                'selector'  => '{{WRAPPER}} .xmoze-dr-single-item:hover',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'box_shadow_hover',
                'exclude'  => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .xmoze-dr-single-item:hover',
            ]
        );

        $this->add_responsive_control(
            'box__hover',
            [
                'label'      => __('Border Radius', 'xmoze-hp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .xmoze-dr-single-item:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .xmoze-dr-single-item:hover' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
    }

    /**
     * Render the widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function render()
    {

    $settings = $this->get_settings();
    $rating = $settings['rating'];
    $image = $settings['image'];
    $catgory = $settings['catgory'];
    $name = $settings['name'];
    $disignateon = $settings['disignateon'];
    $deggre = $settings['deggre'];
    $available = $settings['available'];
    $btn_text = $settings['btn_text'];
    $btn_url = $settings['btn_url'];
    $target = $settings['btn_url']['is_external'] ? ' target="_blank"' : '';
    $nofollow = $settings['btn_url']['nofollow'] ? ' rel="nofollow"' : '';





    ?>
        <div class="xmoze-dr-wraper">
            <!-- single item -->
            <div class="xmoze-dr-single-item">
                <?php if($image): ?>
                    <div class="xmoze-dr-thum">
                        <img src="<?php echo esc_url($image['url'] ); ?>" alt="">
                        <div class="xmoze-dr-rating">
                            <i class="fas fa-star"></i>
                            <span class="xmoze-dr-rating-number"><?php echo esc_attr( $rating ); ?></span>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="xmoze-content-box">
                    <span class="xmoze-dr-catgory"><?php echo esc_html($catgory); ?></span>
                    <span class="xmoze-dr-name"><?php echo esc_html($name); ?></span>
                    <span class="xmoze-dr-Designation"><?php echo esc_html($disignateon); ?></span>
                    <span class="xmoze-dr-deggre"><?php echo esc_html($deggre); ?></span>

                    <div class="xmoze-contetn-bottom">
                        <span class="xmoze-dr-available"><?php echo esc_html($available); ?></span>
                        <a <?php echo $target. $nofollow ?> href="<?php echo esc_url( $btn_url['url'] ) ?>" class="xmoze-dr-btn"><?php echo esc_html($btn_text); ?></a>
                    </div>
                </div>
            </div>

        </div>
    <?php

    
}
}


$widgets_manager->register(new \Xmoze_Drbox());