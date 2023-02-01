<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
// Add Alignment Feature on counter
add_action('elementor/element/fd-addons-icon-box/icon_style/before_section_end', function ($element, $args) {
    // add a control
    $element->add_control(
        'enable_icon_shape',
        [
            'label'        => __('Enable shape?', 'fd-addons'),
            'type'         => \Elementor\Controls_Manager::SWITCHER,
            'label_on'     => __('Yes', 'fd-addons'),
            'label_off'    => __('No', 'fd-addons'),
            'return_value' => 'yes',
            'default'      => 'no',
            'prefix_class' => 'fd-addons-icon-shape-',
        ]
    );
    $element->add_control(
        'icon_shape_style',
        [
            'label'        => __('Shape Style', 'plugin-domain'),
            'type'         => \Elementor\Controls_Manager::POPOVER_TOGGLE,
            'label_off'    => __('Default', 'your-plugin'),
            'label_on'     => __('Custom', 'your-plugin'),
            'return_value' => 'yes',
            'default'      => 'yes',
        ]
    );
    $element->start_popover();
    $element->add_control(
        'icon_shap_background',
        [
            'label'     => __('Background Color', 'fd-addons'),
            'type'      => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .fd-addons-feature-icon-wrap:after' => 'background-color: {{VALUE}}',
            ],
        ]
    );
    $element->add_responsive_control(
        'icon_shape_width',
        [
            'label'      => __('Width', 'fd-addons'),
            'type'       => \Elementor\Controls_Manager::SLIDER,
            'size_units' => ['px', '%'],
            'range'      => [
                'px' => [
                    'min'  => 0,
                    'max'  => 1500,
                    'step' => 1,
                ],
                '%'  => [
                    'min'  => 0,
                    'max'  => 100,
                    'step' => 1,
                ],
            ],
            'selectors'  => [
                '{{WRAPPER}} .fd-addons-feature-icon-wrap:after' => 'width: {{SIZE}}{{UNIT}};',
            ],
        ]
    );
    $element->add_responsive_control(
        'icon_shape_hwight',
        [
            'label'      => __('Height', 'fd-addons'),
            'type'       => \Elementor\Controls_Manager::SLIDER,
            'size_units' => ['%', 'px'],
            'range'      => [
                'px' => [
                    'min'  => 0,
                    'max'  => 1500,
                    'step' => 1,
                ],
                '%'  => [
                    'min'  => 0,
                    'max'  => 100,
                    'step' => 1,
                ],
            ],
            'selectors'  => [
                '{{WRAPPER}} .fd-addons-feature-icon-wrap:after' => 'height: {{SIZE}}{{UNIT}};',
            ],
        ]
    );
    $element->add_responsive_control(
        'icon_shape_x_position',
        [
            'label'      => __('X Position', 'fd-addons'),
            'type'       => \Elementor\Controls_Manager::SLIDER,
            'size_units' => ['px', '%'],
            'range'      => [
                'px' => [
                    'min'  => -1000,
                    'max'  => 1000,
                    'step' => 1,
                ],
                '%'  => [
                    'min'  => -100,
                    'max'  => 100,
                    'step' => 1,
                ],
            ],
            'selectors'  => [
                '{{WRAPPER}} .fd-addons-feature-icon-wrap:after' => 'left: {{SIZE}}{{UNIT}};',
            ],
        ]
    );
    $element->add_responsive_control(
        'icon_shape_y_position',
        [
            'label'      => __('Y Position', 'fd-addons'),
            'type'       => \Elementor\Controls_Manager::SLIDER,
            'size_units' => ['%', 'px'],
            'range'      => [
                'px' => [
                    'min'  => -1000,
                    'max'  => 1000,
                    'step' => 1,
                ],
                '%'  => [
                    'min'  => -100,
                    'max'  => 100,
                    'step' => 1,
                ],
            ],
            'selectors'  => [
                '{{WRAPPER}} .fd-addons-feature-icon-wrap:after' => 'top: {{SIZE}}{{UNIT}};',
            ],
        ]
    );
    $element->add_responsive_control(
        'subscribe_button_border_radius',
        [
            'label'      => __('Border Radius', 'fd-addons'),
            'type'       => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'selectors'  => [
                '{{WRAPPER}} .fd-addons-feature-icon-wrap:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );
    $element->end_popover();
}, 10, 2);


add_action( 'elementor/element/divider/section_divider_style/before_section_start', function( $element, $args ) {
    
	$element->start_controls_section(
		'custom_section',
		[
			'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			'label' => __( 'Xmoze Extra', 'Xmoze' ),
		]
	);

	$element->add_responsive_control(
        'xmoze_divider',
        [
            'label'          => __('Rotate', 'Xmoze'),
            'type'           =>  \Elementor\Controls_Manager::SLIDER,
            'size_units'     => ['px', 'deg'],
            'range'          => [
                'px' => [
                    'min' => 1,
                    'max' => 1000,
                ],
                'deg' => [
                    'min' => 1,
                    'max' => 1000,
                ],
            ],
            'selectors'      => [
                '{{WRAPPER}} .elementor-divider' => 'transform: rotate({{SIZE}}{{UNIT}});',
            ],
        ]
    );

	$element->end_controls_section();

}, 10, 2 );