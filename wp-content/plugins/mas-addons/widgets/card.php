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
class Mas_Addons_Card extends Widget_Base {
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
		return 'mas-addons-card';
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
		return __( 'Card', 'mas-addons' );
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
		return [ 'Card', 'image box', 'fd addons' ];
	}
	/**
	 * Register icon widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {
		$this->start_controls_section(
			'card_section',
			[
				'label' => __( 'Content', 'mas-addons' ),
			]
		);
        $this->add_control(
			'image',
			[
				'label' => __('Choose Image', 'mas-addons'),
				'type' => \Elementor\Controls_Manager::MEDIA,
			]
		);
        $this->add_control(
            'item_count',
            [
                'label'       => __( 'Iteam Count', 'mas-addons' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => __( '1', 'mas-addons' ),
            ]
        );
        $this->add_control(
            'heading',
            [
                'label'       => __( 'Heading', 'mas-addons' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => __( 'Commarcial Affairs', 'mas-addons' ),
            ]
        );
        $this->add_control(
            'content',
            [
                'label'       => __( 'Content', 'mas-addons' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => __( 'Consectetur adipiscing elit', 'mas-addons' ),
            ]
        );
		$this->end_controls_section();

		/* 
        *Image
        */
        $this->start_controls_section('box_iamge',
            [
                'label' => __('Image', 'advis-hp'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );


        $this->start_controls_tabs(
            'image_hover_tabs'
        );

        $this->start_controls_tab(
            'image_normal_tab',
            [
                'label' => __('Normal', 'advis-ts'),
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'image_border',
                'selector'  => '{{WRAPPER}} .mas-addons-card-images img',
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
                'selector' => '{{WRAPPER}} .mas-addons-card-images img',
            ]
        );
        
        $this->add_responsive_control(
            'width',
            [
                'label'          => __('Width', 'advis-hp'),
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
                    '{{WRAPPER}} .mas-addons-card-images img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'space',
            [
                'label'          => __('Max Width', 'advis-hp'),
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
                    '{{WRAPPER}} .mas-addons-card-images img' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'height',
            [
                'label'          => __('Height', 'advis-hp'),
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
                    '{{WRAPPER}} .mas-addons-card-images img' => 'height: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'object-fit',
            [
                'label'     => __('Object Fit', 'advis-hp'),
                'type'      => Controls_Manager::SELECT,
                'condition' => [
                    'height[size]!' => '',
                ],
                'options'   => [
                    ''        => __('Default', 'advis-hp'),
                    'fill'    => __('Fill', 'advis-hp'),
                    'cover'   => __('Cover', 'advis-hp'),
                    'contain' => __('Contain', 'advis-hp'),
                ],
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .mas-addons-card-images img' => 'object-fit: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_box_',
            [
                'label'      => __('Border Radius', 'advis-hp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .mas-addons-card-images img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .mas-addons-card-images img' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_box_margin',
            [
                'label'      => __('Margin', 'advis-hp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .mas-addons-card-images img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .mas-addons-card-images img' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();
        
        $this->start_controls_tab(
            'image_hover_tab',
            [
                'label' => __('Hover', 'advis-ts'),
            ]
        );
        $this->add_control(
            'image_hover_style',
            [
                'label'             => __('Hover Style', 'advis-hp'),
                'type'              => Controls_Manager::SELECT,
                'default'           => 'hover-default',
                'options'           => [
                    'hover-default' =>   __('Default',    'advis-hp'),
                    'hover-one'     =>   __('Style 01',    'advis-hp'),
                ],
                'separator' => 'after',
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();

		/* 
        *Number
        */
        $this->start_controls_section('card_count',
            [
                'label' => __('Number', 'advis-hp'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

		$this->add_control(
            'number_color',
            [
                'label'     => __('Color', 'advis-hp'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mas-addons-card-number' => 'color: {{VALUE}}',
                ],
            ]
        );
		
		$this->add_control(
            'number_bg_color',
            [
                'label'     => __('Background Color', 'advis-hp'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mas-addons-card-number' => 'background-color: {{VALUE}}',
                ],
            ]
        );
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'number_typo',
                'label'    => __('Typography', 'advis-hp'),
                'selector' => '{{WRAPPER}}  .mas-addons-card-number',
            ]
        );
		$this->add_responsive_control(
            'number_size',
            [
                'label'          => __('Size', 'advis-hp'),
                'type'           => Controls_Manager::SLIDER,
                'size_units'     => ['px'],
                'range'          => [
                    'px' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .mas-addons-card-number' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'number_border',
				'selector'  => '{{WRAPPER}} .mas-addons-card-number',
			]
		);
   
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'number_shadow',
				'exclude'  => [
					'box_shadow_position',
				],
				'selector' => '{{WRAPPER}} .mas-addons-card-number',
			]
		);
		$this->add_responsive_control(
            'number_border_radius',
            [
                'label'      => __('Border Radius', 'advis-hp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .mas-addons-card-number' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .mas-addons-card-number' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'number_margin',
            [
                'label'      => __('Margin', 'advis-hp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .mas-addons-card-number' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .mas-addons-card-number' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
		$this->end_controls_section();

		/* 	
        *Title
        */
        $this->start_controls_section('card_title',
            [
                'label' => __('Title', 'advis-hp'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => __('Color', 'advis-hp'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mas-addons-card-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typo',
                'label'    => __('Typography', 'advis-hp'),
                'selector' => '{{WRAPPER}}  .mas-addons-card-title',
            ]
        );

        $this->add_responsive_control(
            'title_margin',
            [
                'label'      => __('Margin', 'advis-hp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .mas-addons-card-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .mas-addons-card-title' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

		/* 
        *Discription
        */
        $this->start_controls_section('card_dis',
            [
                'label' => __('Discription', 'advis-hp'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'dis_color',
            [
                'label'     => __('Color', 'advis-hp'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mas-addons-card-discription' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'dis_typo',
                'label'    => __('Typography', 'advis-hp'),
                'selector' => '{{WRAPPER}}  .mas-addons-card-discription',
            ]
        );

        $this->add_responsive_control(
            'dis_margin',
            [
                'label'      => __('Margin', 'advis-hp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .mas-addons-card-discription' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .mas-addons-card-discription' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

		/* 
        *Content Box
        */
        $this->start_controls_section('card_content',
            [
                'label' => __('Content Box', 'advis-hp'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'content_bg',
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .mas-addons-card-content',
			]
		);

		$this->add_responsive_control(
            'content_padding',
            [
                'label'      => __('Padding', 'advis-hp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .mas-addons-card-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .mas-addons-card-content' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );

		$this->add_responsive_control(
            'content_margin',
            [
                'label'      => __('Margin', 'advis-hp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .mas-addons-card-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .mas-addons-card-content' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
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
	protected function render() {
		$settings = $this->get_settings_for_display();
        $image = $settings['image'];

        $item_count = $settings['item_count'];
        $heading    = $settings['heading'];
        $content    = $settings['content'];
        $image_hover_style = $settings['image_hover_style'];

        ?>
        <div class="mas-addons-card-wraper">
            <div class="mas-addons-single-card <?php echo esc_attr( $image_hover_style  ) ?>">
                <div class="mas-addons-card-images">
                 <img src="<?php echo esc_url($image['url']) ?>" alt="">

					<div class="mas-addons-card-number">
						<span><?php echo esc_html($item_count); ?></span>
					</div>
                </div>
                <div class="mas-addons-card-content">
                    <h3 class="mas-addons-card-title"><?php echo esc_html($heading); ?></h3>
                    <span class="mas-addons-card-discription">
                        <?php echo esc_html($content) ?>
                    </span>
                </div>
            </div>
        </div>
        <?php 
	}
}
$widgets_manager->register( new \Mas_Addons\Widgets\Mas_Addons_Card() );