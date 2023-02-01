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
class Xmoze_Portfolio_Gallery extends \Elementor\Widget_Base
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
        return 'xmoze-portfolio-gallery';
    }

    public function get_script_depends()
    {
        return ['isotope', 'xmoze-addon'];
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
        return __('Xmoze Portfolio Gallery', 'xmoze-hp');
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
        return 'eicon-gallery-grid';
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
            'section_gallery',
            [
                'label' => __('Gallery', 'xmoze-hp'),
            ]
        );
        

        $this->add_control(
            'layout_type',
            [
                'label' => __('Layout type', 'xmoze-hp'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => array(
                    'masonry' => 'Masonry',
                    'normal' => 'Normal',
                    'slider' => 'Slider'
                ),
                'default' => 'masonry',
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
			'image',
			[
				'label' => __( 'Choose Image', 'xmoze-hp' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
        );
        
        $repeater->add_control(
			'image_size',
			[
				'label' => __( 'Image Dimension', 'xmoze-hp' ),
				'type' => \Elementor\Controls_Manager::IMAGE_DIMENSIONS,
				'description' => __( 'Crop the original image size to any custom size. Set custom width or height to keep the original size ratio.', 'xmoze-hp' ),
				'default' => [
					'width' => '',
					'height' => '',
				],
			]
        );
        $repeater->add_responsive_control(
            'image_grid',
            [
                'label' => __('Image grid', 'xmoze-hp'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => array(
                    '' => 'Default',
                    '12' => '1 Column',
                    '6' => '2 Column',
                    '4' => '3 Column',
                    '3' => '4 Column',
                ),
                'default'            => '',
            ]
        );
        
        $repeater->add_control(
			'image_title',
			[
				'label' => __( 'Title', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'Type your title here', 'plugin-domain' ),
			]
		);

		$this->add_control(
			'gallery_list',
			[
				'label' => __( 'Repeater List', 'xmoze-hp' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ image_title }}}',
			]
        );
        
       
        
        
        $this->end_controls_section();
        $this->start_controls_section(
            'section_width_nd_height',
            [
                'label' => __('Width & Height', 'xmoze-hp'),
            ]
        );


        $this->add_responsive_control(
            'post_grid',
            [
                'label' => __('Post grid', 'xmoze-hp'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => array(
                    '12' => '1 Column',
                    '6' => '2 Column',
                    '4' => '3 Column',
                    '3' => '4 Column',
                ),
                'default'            => 3,
                'condition' => [
                    'layout_type!' => 'slider'
                ]
            ]
        );

        $this->add_responsive_control(
            'column_verti_gap',
            [
                'label' => __('Column Vertical Gap', 'xmoze-hp'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'devices' => ['desktop', 'tablet', 'mobile'],
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'desktop_default' => [
                    'size' => 15,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}}  .xmoze-portfolio-item-wrap' => 'padding: 0 {{SIZE}}{{UNIT}} 0;',
                ]
            ]
        );

        $this->add_responsive_control(
            'column_hori_gap',
            [
                'label' => __('Column Horizontal Gap', 'xmoze-hp'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'devices' => ['desktop', 'tablet', 'mobile'],
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                ],
                'desktop_default' => [
                    'size' => 30,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}}  .xmoze-portfolio-item-wrap' => 'padding-bottom: {{SIZE}}{{UNIT}} ;',
                ],
                'condition' => [
                    'layout_type!' => 'slider'
                ]
            ]
        );
        $this->add_control(
            'use_custom_height',
            [
                'label' => __('Use custom height?', 'xmoze-hp'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'xmoze-hp'),
                'label_off' => __('No', 'xmoze-hp'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
        $this->add_responsive_control(
            'normal_image_height',
            [
                'label' => __('Normal Image Height', 'xmoze-hp'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'devices' => ['desktop', 'tablet', 'mobile'],
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}}  .xmoze-portfolio-item img' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'use_custom_height' => 'yes'
                ],
            ]
        );

        $this->end_controls_section();
              
    //Slider Setting
    $this->start_controls_section('slider_settings',
    [
            'label' => __('Slider Settings', 'xmoze-hp'),
            'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            'condition' => [
                'layout_type' => 'slider'
            ]
            ]
        );

        $this->add_responsive_control(
            'per_coulmn',
            [
                'label' => __( 'Slider Items', 'xmoze-hp' ),
                'type' => \Elementor\Controls_Manager::SELECT,
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
                'default' => 'no',
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
                'default' => 'no',
            ]
        );

        $this->add_control(
            'mousedrag',
            [
                'label' => __( 'Show MouseDrag', 'xmoze-hp' ),
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
        $this->add_control(
            'loop',
            [
                'label' => __( 'Infinite Loop', 'xmoze-hp' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'xmoze-hp' ),
                'label_off' => __( 'Hide', 'xmoze-hp' ),
                'return_value' => 'yes',
                'default' => 'true',
            ]
        );
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
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'section_image',
            [
                'label' => __('Image', 'xmoze-hp'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs(
            'image_hover_tabs'
        );
        $this->start_controls_tab(
            'image_normal_tab',
            [
                'label' => __('Normal', 'xmoze-hp'),
            ]
        );
        $this->add_responsive_control(
            'image_radius',
            [
                'label' => __('Image Radius', 'xmoze-hp'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    ' {{WRAPPER}} .xmoze-portfolio-item img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'image_shadow',
                'label' => __('Button Shadow', 'xmoze-hp'),
                'selector' => '{{WRAPPER}} .xmoze-portfolio-item img',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'image_border',
                'label' => __('Border', 'xmoze-hp'),
                'selector' => '{{WRAPPER}} .xmoze-portfolio-item img',
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'image_hover_tab',
            [
                'label' => __('Hover', 'xmoze-hp'),
            ]
        );
        $this->add_responsive_control(
            'image_hover_radius',
            [
                'label' => __('Box Image Radius', 'xmoze-hp'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    ' {{WRAPPER}} .xmoze-portfolio-item:hover img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'image_hover_shadow',
                'label' => __('Button Shadow', 'xmoze-hp'),
                'selector' => '{{WRAPPER}} .xmoze-portfolio-item:hover img',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'image_hover_border',
                'label' => __('Border', 'xmoze-hp'),
                'selector' => '{{WRAPPER}} .xmoze-portfolio-item:hover img',
            ]
        );
        $this->add_control(
            'enable_hover_rotate',
            [
                'label' => __('Rotate animation on hover?', 'xmoze-hp'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'xmoze-hp'),
                'label_off' => __('No', 'xmoze-hp'),
                'return_value' => 'xmoze-hover-rotate',
                'default' => 'no',
            ]
        );
        
        $this->add_control(
            'image_hover_animation',
            [
                'label' => __('Hover Animation', 'xmoze-hp'),
                'type' => \Elementor\Controls_Manager::HOVER_ANIMATION,
                // 'prefix_class' => 'elementor-animation-',
                'condition' => [
                    'enable_hover_rotate!' => 'xmoze-hover-rotate'
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        $this->start_controls_section(
            'section_title_style',
            [
                'label' => __('Title', 'xmoze-hp'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs(
            'title_style_tabs'
        );
        $this->start_controls_tab(
            'title_style_normal_tab',
            [
                'label' => __('Normal', 'xmoze-hp'),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'label' => __('Title Typography', 'xmoze-hp'),
                'name' => 'title_typo',
                'selector' => '{{WRAPPER}} .xmoze-portfolio-title',
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label' => __('Title Color', 'xmoze-hp'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xmoze-portfolio-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'title_align',
            [
                'label' => __('Align', 'xmoze-hp'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'flex-start' => __('Left', 'xmoze-hp'),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __('top', 'xmoze-hp'),
                        'icon' => 'fa fa-align-center',
                    ],
                    'flex-end' => [
                        'title' => __('Right', 'xmoze-hp'),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .xmoze-portfolio-content h3' => 'justify-content: {{VALUE}};',
                ],
                'toggle' => true,
            ]
        );
       
        $this->end_controls_tab();
        $this->start_controls_tab(
            'title_style_hover_tab',
            [
                'label' => __('Hover', 'xmoze-hp'),
            ]
        );
        $this->add_control(
            'title_color_hover',
            [
                'label' => __('Title Color', 'xmoze-hp'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xmoze-portfolio-title:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
       
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        $this->start_controls_section(
            'section_content_style',
            [
                'label' => __('Content Box', 'xmoze-hp'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        
  
        $this->add_control(
            'content_bg_color',
            [
                'label' => __('Content Background Color', 'xmoze-hp'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xmoze-portfolio-content' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'content_gap',
            [
                'label' => __('Content gap', 'xmoze-hp'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 400,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}}  .xmoze-portfolio-content.content-postion-on-image' => 'left:{{SIZE}}{{UNIT}};right:{{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'content_y_position',
            [
                'label' => __('Content Y Position', 'xmoze-hp'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}}  .xmoze-portfolio-content.content-postion-on-image' => 'bottom:{{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'content_padding',
            [
                'label' => __('Content Padding', 'xmoze-hp'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .xmoze-portfolio-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'content_radius',
            [
                'label' => __('Content Box Radius', 'xmoze-hp'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .xmoze-portfolio-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                'layout_type' => 'slider',
            ]
        ]
    );

    $this->add_control(
        'dots_color',
        [
            'label' => __('Color', 'xmoze-hp'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'default' => '',
            'selectors' => [
                '{{WRAPPER}} .xmoze-pf-gallery-slider-dots' => 'background-color: {{VALUE}};',
            ],
        ]
    );

    $this->add_control(
        'dots_color_active',
        [
            'label' => __('Active Color', 'xmoze-hp'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'default' => '',
            'selectors' => [
                '{{WRAPPER}} .xmoze-pf-gallery-slider-dots li.slick-active button' => 'background-color: {{VALUE}};',
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
                'layout_type' => 'slider',
            ]
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
                '{{WRAPPER}} .xmoze-pf-gallery-slider .slick-arrow i' => 'color: {{VALUE}}; border-color: {{VALUE}};',
                '{{WRAPPER}} .xmoze-pf-gallery-slider .slick-arrow svg path' => 'stroke: {{VALUE}};',
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
                '{{WRAPPER}} .xmoze-pf-gallery-slider .slick-arrow i:vefore' => 'color: {{VALUE}};',
                '{{WRAPPER}} .xmoze-pf-gallery-slider .slick-arrow svg path' => 'fill: {{VALUE}};',
            ],
        ]
    );

    $this->add_control(
        'arrow_bg_color',
        [
            'label' => __('Background Color', 'xmoze-hp'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                 '{{WRAPPER}} .xmoze-pf-gallery-slider button.slick-arrow' => 'background-color: {{VALUE}} !important;',
            ],
        ]
    );
    $this->add_group_control(
        \Elementor\Group_Control_Border::get_type(),
        [
            'name' => 'arrow_border',
            'label' => __('Border', 'xmoze-hp'),
            'selector' => '{{WRAPPER}} .xmoze-pf-gallery-slider button.slick-arrow',
        ]
    );
    $this->add_responsive_control(
        'arrow_icon_radius',
        [
            'label' => __('Arrow Radius', 'xmoze-hp'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'selectors' => [
                ' {{WRAPPER}} .xmoze-pf-gallery-slider button.slick-arrow' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );
    $this->add_group_control(
        \Elementor\Group_Control_Box_Shadow::get_type(),
        [
            'name' => 'arrow_shadow',
            'label' => __('Shadow', 'fd-addons'),
            'selector' => '{{WRAPPER}} .xmoze-pf-gallery-slider button.slick-arrow',
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
                 '{{WRAPPER}} .xmoze-pf-gallery-slider .slick-arrow:hover i:vefore' => 'color: {{VALUE}};',
                 '{{WRAPPER}} .xmoze-pf-gallery-slider .slick-arrow:hover svg path' => 'stroke: {{VALUE}};',
            ],
        ]
    );

    $this->add_control(
        'arrow_hover_fill_color',
        [
            'label' => __('Line Color', 'xmoze-hp'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                 '{{WRAPPER}} .xmoze-pf-gallery-slider .slick-arrow:hover i:vefore' => 'color: {{VALUE}};',
                 '{{WRAPPER}} .xmoze-pf-gallery-slider .slick-arrow:hover svg path' => 'fill: {{VALUE}};',
            ],
        ]
    );

    $this->add_control(
        'arrow_bg_hover_color',
        [
            'label' => __('Background Color Hover', 'xmoze-hp'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                 '{{WRAPPER}} .xmoze-pf-gallery-slider .xmoze-slick-next:hover, .xmoze-pf-gallery-slider .xmoze-slick-prev:hover' => 'background-color: {{VALUE}}  !important;',
            ],
        ]
    );

    $this->add_group_control(
        \Elementor\Group_Control_Border::get_type(),
        [
            'name' => 'arrow_hover_border',
            'label' => __('Border', 'xmoze-hp'),
            'selector' => '{{WRAPPER}} .xmoze-pf-gallery-slider button.slick-arrow:hover',
        ]
    );
    $this->add_responsive_control(
        'arrow_hover_icon_radius',
        [
            'label' => __('Arrow Radius', 'xmoze-hp'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'selectors' => [
                ' {{WRAPPER}} .xmoze-pf-gallery-slider button.slick-arrow:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );
    $this->add_group_control(
        \Elementor\Group_Control_Box_Shadow::get_type(),
        [
            'name' => 'arrow_hover_shadow',
            'label' => __('Shadow Hover', 'fd-addons'),
            'selector' => '{{WRAPPER}} .xmoze-pf-gallery-slider .xmoze-slick-next:hover, {{WRAPPER}} .xmoze-pf-gallery-slider .xmoze-slick-prev:hover',
        ]
    );
    $this->end_controls_tab();
    $this->end_controls_tabs();

    $this->add_control(
        'hrthere',
        [
            'type' => \Elementor\Controls_Manager::DIVIDER,
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
                '{{WRAPPER}} .xmoze-pf-gallery-slider button.slick-arrow' => 'bottom: {{SIZE}}{{UNIT}} !important;',
            ],
        ]
    );

    $this->add_responsive_control(
        'arrow_prev_position',
        [
            'label' => __('Prev icon Position', 'xmoze-hp'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => ['px', '%'],
            'condition' => [
                'arrow_position_toggle' => 'yes'
            ],
            'range' => [
                'px' => [
                    'min' => -2000,
                    'max' => 2000,
                ],
                '%' => [
                    'min' => -100,
                    'max' => 100,
                ],
            ],
            'selectors' => [
                'body:not(.rtl) {{WRAPPER}} .xmoze-pf-gallery-slider .slick-arrow.xmoze-slick-prev' => 'left: {{SIZE}}{{UNIT}};',
            ],
        ]
    );
    $this->add_responsive_control(
        'arrow_nextv_position',
        [
            'label' => __('Next icon Position', 'xmoze-hp'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => ['px', '%'],
            'condition' => [
                'arrow_position_toggle' => 'yes'
            ],
            'range' => [
                'px' => [
                    'min' => -2000,
                    'max' => 2000,
                ],
                '%' => [
                    'min' => -100,
                    'max' => 100,
                ],
            ],
            'selectors' => [
                'body:not(.rtl) {{WRAPPER}} .xmoze-pf-gallery-slider .slick-arrow.xmoze-slick-next' => 'right: {{SIZE}}{{UNIT}}; left:auto;',
            ],
        ]
    );


    // $this->add_responsive_control(
    //     'arrow_position_right_gap',
    //     [
    //         'label' => __('Prev Aarrow Gap', 'xmoze-hp'),
    //         'type' => \Elementor\Controls_Manager::SLIDER,
    //         'size_units' => ['px'],
    //         'condition' => [
    //             'arrow_position_toggle' => 'yes'
    //         ],
    //         'range' => [
    //             'px' => [
    //                 'min' => -1000,
    //                 'max' => 2000,
    //             ],
    //         ],
    //         'selectors' => [
    //             'body:not(.rtl) {{WRAPPER}} .xmoze-pf-gallery-slider .slick-arrow.xmoze-slick-next' => 'right: {{SIZE}}{{UNIT}};',
    //             'body.rtl {{WRAPPER}} .xmoze-pf-gallery-slider .slick-arrow  button.xmoze-slick-prev' => 'left: {{SIZE}}{{UNIT}};',
    //         ],
    //     ]
    // );
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
                '{{WRAPPER}}  .xmoze-pf-gallery-slider .slick-arrow i' => 'font-size: {{SIZE}}{{UNIT}}',
                '{{WRAPPER}}  .xmoze-pf-gallery-slider .slick-arrow svg' => 'width: {{SIZE}}{{UNIT}}',
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
                '{{WRAPPER}} .xmoze-pf-gallery-slider button.slick-arrow' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
            ],
        ]
    );

    
    $this->end_controls_section();
    }

    protected function get_render_icon($icon){
        ob_start();
        \Elementor\Icons_Manager::render_icon($icon, ['aria-hidden' => 'true']);
        return ob_get_clean();
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
        $paged = get_query_var('paged') ? get_query_var('paged') : 1;
        $portfolio_data = [];
        $portfolio_data['settings'] = $this->get_settings();
        $portfolio_data = json_encode($portfolio_data);
        $post_grid_desktop = $settings['post_grid'];
        $post_grid_tablet  = $settings['post_grid_tablet'];
        $post_grid_mobile  = $settings['post_grid_mobile'];
        //this code slider option
        $slider_extraSetting = array(
            
            'next_icon' => $this->get_render_icon($settings['arrow_next_icon']),
            'prev_icon' => $this->get_render_icon($settings['arrow_prev_icon']),
            
            'loop' => (!empty($settings['loop']) && 'yes' === $settings['loop']) ? true : false,
            'dots' => (!empty($settings['dots']) && 'yes' === $settings['dots']) ? true : false,
            'autoplay' => (!empty($settings['autoplay']) && 'yes' === $settings['autoplay']) ? true : false,
            'nav' => (!empty($settings['arrows']) && 'yes' === $settings['arrows']) ? true : false,
            'mousedrag' => (!empty($settings['mousedrag']) && 'yes' === $settings['mousedrag']) ? true : false,
            'autoplaytimeout' => !empty($settings['autoplaytimeout']) ? $settings['autoplaytimeout'] : '5000',
            
            //this a responsive layout
            'per_coulmn' =>        (!empty($settings['per_coulmn'])) ? $settings['per_coulmn'] : 3,
            'per_coulmn_tablet' => (!empty($settings['per_coulmn_tablet'])) ? $settings['per_coulmn_tablet'] : 2,
            'per_coulmn_mobile' => (!empty($settings['per_coulmn_mobile'])) ? $settings['per_coulmn_mobile'] : 1
        );
        
        $jasondecode = wp_json_encode($slider_extraSetting);
        if('slider' == $settings['layout_type']){
            $this->add_render_attribute('pf_gallery_slide', 'data-settings', $jasondecode);
        }


?>
        <?php if('slider' == $settings['layout_type']):  ?>
            <div class="xmoze-pf-gallery-slider" <?php echo $this->get_render_attribute_string('pf_gallery_slide'); ?>>
                <?php 
                    $i = 0;
                    foreach (  $settings['gallery_list'] as $item ) : 
                        $image_size = ( $item['image_size']['width'] || $item['image_size']['height'] ) ? [$item['image_size']['width'] , $item['image_size']['height']] : 'full';
                    ?>
                        <div class="xmoze-portfolio-item" <?php //echo  $this->get_render_attribute_string( 'xmoze-gallery-lightbox-'.$i ) ; ?>>
                            <a href="<?php echo wp_get_attachment_image_url( $item['image']['id'], 'full'  ) ?>" class="xmoze-portfolio-image d-block <?php echo esc_attr('elementor-animation-'.$settings['image_hover_animation']) ?>">
                                <?php echo wp_get_attachment_image( $item['image']['id'], $image_size  ); ?>
                            </a>
                            <?php if(!empty($item['image_title'])):?>
                            <a href="<?php echo wp_get_attachment_image_url( $item['image']['id'], 'full'  ) ?>" class="xmoze-portfolio-content content-postion-on-image">
                                <h3 class="xmoze-portfolio-title">
                                    <?php echo esc_html( $item['image_title'] ) ?>
                                </h3>
                            </a>
                            <?php endif; ?>
                        </div>
                        <?php endforeach; ?>
                </div>

            <?php else: ?>

            <div class="row justify-content-center xmoze-pf-gallery-wrap layout-mode-<?php echo esc_attr($settings['layout_type'] . ' ' . $settings['enable_hover_rotate']) ?>">
                <?php 
                $i = 0;
                foreach (  $settings['gallery_list'] as $item ) : 
                    $i++;
                    $unique_id = rand(100, 10000);
                    $image_size = ( $item['image_size']['width'] || $item['image_size']['height'] ) ? [$item['image_size']['width'] , $item['image_size']['height']] : 'full';
                    if(!empty($item['image_grid'])){
                        $image_grid_desktop = $item['image_grid'];
                        $image_grid_tablet  = $item['image_grid_tablet'];
                        $image_grid_mobile  = $item['image_grid_mobile'];
                        $grid = sprintf('col-lg-%s col-md-%s col-%s', esc_attr($image_grid_desktop), esc_attr($image_grid_tablet), esc_attr($image_grid_mobile));   
                    }else{
                        $grid = sprintf('col-lg-%s col-md-%s col-%s', esc_attr($post_grid_desktop), esc_attr($post_grid_tablet), esc_attr($post_grid_mobile));    
                    }
                ?>
                <div class="xmoze-portfolio-item-wrap <?php echo esc_attr( $grid ) ?>"  >

                    <div class="xmoze-portfolio-item" <?php echo  $this->get_render_attribute_string( 'xmoze-gallery-lightbox-'.$i ) ; ?>>
                        <a href="<?php echo wp_get_attachment_image_url( $item['image']['id'], 'full'  ) ?>" class="xmoze-portfolio-image d-block <?php echo esc_attr('elementor-animation-'.$settings['image_hover_animation']) ?>">
                            <?php echo wp_get_attachment_image( $item['image']['id'], $image_size  ); ?>
                        </a>
                        <?php if(!empty($item['image_title'])):?>
                        <a href="<?php echo wp_get_attachment_image_url( $item['image']['id'], 'full'  ) ?>" class="xmoze-portfolio-content content-postion-on-image">
                            <h3 class="xmoze-portfolio-title">
                                <?php echo esc_html( $item['image_title'] ) ?>
                            </h3>
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            
         <?php endif;?>
<?php

    }
}

$widgets_manager->register(new \Xmoze_Portfolio_Gallery());