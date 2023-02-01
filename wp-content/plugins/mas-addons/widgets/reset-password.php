<?php

namespace Mas_Addons\Widgets;
// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use  Elementor\Group_Control_Background;
use Elementor\Widget_Base;

class Mas_LostPassword extends Widget_Base {

	public function get_name() {
		return 'mas-addons-lost-password';
	}

	public function get_title() {
		return __( 'Lost Password Form', 'mas-addons' );
	}

	public function get_icon() {
		return 'mas-addons-icon eicon-lock-user';
	}

	public function get_categories() {
		return [ 'mas-addons' ];
	}

    public function get_keywords() {
        return [
            'form',
            'lost',
            'password',
            'mas-addons',
        ];
    }

	// public function get_style_depends() {
	// 	return [ 'mas-addons-forms' ];
	// }

	protected function register_controls() {

		$this->start_controls_section(
			'section_lost_password',
			[
				'label' 		=> __( 'Form', 'mas-addons' ),
			]
		);

		$this->add_control(
			'show_message',
			[
				'label' 		=> __( 'Show Message', 'mas-addons' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'default' 		=> 'yes',
			]
		);

		$this->add_control(
			'message',
			[
				'label'   		=> __( 'Message', 'mas-addons' ),
				'type'    		=> Controls_Manager::TEXTAREA,
				'default'		=> __( 'Please enter your username or email address. You will receive a link to create a new password via email.', 'mas-addons' ),
				'condition'		=> [
					'show_message' => 'yes'
				],
				'dynamic' 		=> [ 'active' => true ],
			]
		);

		$this->add_control(
			'label_heading',
			[
				'label' 		=> __( 'Label', 'mas-addons' ),
				'type' 			=> Controls_Manager::HEADING,
				'separator' 	=> 'before',
			]
		);

		$this->add_control(
			'show_label',
			[
				'label' 		=> __( 'Show Label', 'mas-addons' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'default' 		=> 'yes',
			]
		);

		$this->add_control(
			'user_label',
			[
				'label' 		=> __( 'Username', 'mas-addons' ),
				'type'			=> Controls_Manager::TEXT,
				'default'		=> __( 'Username or Email', 'mas-addons' ),
				'label_block' => true,
				'condition'		=> [
					'show_label' => 'yes'
				],
				'dynamic' 		=> [ 'active' => true ],
			]
		);

		$this->add_control(
			'placeholder_heading',
			[
				'label' 		=> __( 'Placeholders', 'mas-addons' ),
				'type' 			=> Controls_Manager::HEADING,
				'separator' 	=> 'before',
			]
		);

		$this->add_control(
			'show_placeholders',
			[
				'label' 		=> __( 'Show Placeholders', 'mas-addons' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'default' 		=> 'yes',
			]
		);

		$this->add_control(
			'user_placeholder',
			[
				'label' 		=> __( 'Username', 'mas-addons' ),
				'type'			=> Controls_Manager::TEXT,
				'default'		=> __( 'Username or Email Address', 'mas-addons' ),
				'label_block' => true,
				'condition'		=> [
					'show_placeholders' => 'yes'
				],
				'dynamic' 		=> [ 'active' => true ],
			]
		);

		$this->add_control(
			'submit_heading',
			[
				'label' 		=> __( 'Submit Button', 'mas-addons' ),
				'type' 			=> Controls_Manager::HEADING,
				'separator' 	=> 'before',
			]
		);

		$this->add_control(
			'submit_text',
			[
				'label' 		=> __( 'Text', 'mas-addons' ),
				'type'			=> Controls_Manager::TEXT,
				'default'		=> __( 'Get New Password', 'mas-addons' ),
				'dynamic' 		=> [ 'active' => true ],
				'label_block' => true,
			]
		);

		$this->add_control(
			'login_heading',
			[
				'label' 		=> __( 'Login Link', 'mas-addons' ),
				'type' 			=> Controls_Manager::HEADING,
				'separator' 	=> 'before',
			]
		);

		$this->add_control(
			'show_login',
			[
				'label' 		=> __( 'Show Link', 'mas-addons' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'default' 		=> 'yes',
			]
		);

		$this->add_control(
			'login_text',
			[
				'label' 		=> __( 'Text', 'mas-addons' ),
				'type'			=> Controls_Manager::TEXT,
				'default'		=> __( 'Back to the Login Page', 'mas-addons' ),
				'label_block' => true,
				'dynamic' 		=> [ 'active' => true ],
			]
		);

		$this->add_control(
			'login_link',
			[
				'label'   		=> __( 'Link', 'mas-addons' ),
				'type'    		=> Controls_Manager::URL,
				'placeholder' 	=> __( 'https://your-link.com', 'mas-addons' ),
			]
		);

		$this->add_control(
			'privacy_policy_heading',
			[
				'label' 		=> __( 'Privacy Policy Link', 'mas-addons' ),
				'type' 			=> Controls_Manager::HEADING,
				'separator' 	=> 'before',
			]
		);

		$this->add_control(
			'privacy_policy_text',
			[
				'type' 		=> Controls_Manager::RAW_HTML,
				'raw'  		=> sprintf(
					__( 'Select your Privacy Policy page in the %1$sPrivacy Settings%2$s', 'mas-addons' ),
					'<a href="' . esc_url( admin_url( 'privacy.php' ) ) . '" target="_blank">',
					'</a>'
				),
			]
		);

		$this->add_control(
			'show_privacy_policy',
			[
				'label' 		=> __( 'Show Link', 'mas-addons' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'default' 		=> 'yes',
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'section_login_content',
			[
				'label' 		=> __( 'Additional Options', 'mas-addons' ),
			]
		);

		$this->add_control(
			'redirect_after_lost_password',
			[
				'label' 		=> __( 'Redirect After Login', 'mas-addons' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'default' 		=> 'off',
			]
		);

		$this->add_control(
			'redirect_url',
			[
				'type' 			=> Controls_Manager::URL,
				'show_label' 	=> false,
				'show_external' => false,
				'separator' 	=> false,
				'placeholder' 	=> 'http://your-link.com/',
				'description' 	=> __( 'Note: Because of security reasons, you can ONLY use your current domain here.', 'mas-addons' ),
				'condition' 	=> [
					'redirect_after_lost_password' => 'yes',
				],
			]
		);

		$this->add_control(
			'show_logged_in_message',
			[
				'label' 		=> __( 'Logged in Message', 'mas-addons' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'default' 		=> 'yes',
				'label_off' 	=> __( 'Hide', 'mas-addons' ),
				'label_on' 		=> __( 'Show', 'mas-addons' ),
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_label_style',
			[
				'label' 		=> __( 'Label', 'mas-addons' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'label_typo',
				'selector' 		=> '{{WRAPPER}} .mas-addons-form label',
			]
		);

		$this->add_control(
			'label_color',
			[
				'label' 		=> __( 'Color', 'mas-addons' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .mas-addons-form label' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'label_spacing',
			[
				'label' 		=> __( 'Spacing', 'mas-addons' ),
				'type' 			=> Controls_Manager::SLIDER,
				'range' 		=> [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' 	=> [
					'{{WRAPPER}} .mas-addons-form label' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' 			=> 'label_text_shadow',
				'selector' 		=> '{{WRAPPER}} .mas-addons-form label',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_message_style',
			[
				'label' 		=> __( 'Message Box', 'mas-addons' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'message_background',
			[
				'label' 		=> __( 'Background Color', 'mas-addons' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .mas-addons-form-message' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'message_color',
			[
				'label' 		=> __( 'Color', 'mas-addons' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .mas-addons-form-message' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'message_typo',
				'selector' 		=> '{{WRAPPER}} .mas-addons-form-message',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'message_border',
				'label' 		=> __( 'Border', 'mas-addons' ),
				'selector' 		=> '{{WRAPPER}} .mas-addons-form-message',
			]
		);

		$this->add_responsive_control(
			'message_border_radius',
			[
				'label' 		=> __( 'Border Radius', 'mas-addons' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .mas-addons-form-message' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'message_padding',
			[
				'label' 		=> __( 'Padding', 'mas-addons' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .mas-addons-form-message' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 			=> 'message_box_shadow',
				'selector' 		=> '{{WRAPPER}} .mas-addons-form-message',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_field_style',
			[
				'label' 		=> __( 'Field', 'mas-addons' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( 'tabs_field_style' );

		$this->start_controls_tab(
			'tab_field_normal',
			[
				'label' 		=> __( 'Normal', 'mas-addons' ),
			]
		);

		$this->add_control(
			'field_background',
			[
				'label' 		=> __( 'Background Color', 'mas-addons' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .mas-addons-form .mas-addons-input' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'field_color',
			[
				'label' 		=> __( 'Color', 'mas-addons' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .mas-addons-form .mas-addons-input' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'field_placeholder_color',
			[
				'label' 		=> __( 'Placeholder Color', 'mas-addons' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .mas-addons-form .mas-addons-input::-webkit-input-placeholder' => 'color: {{VALUE}}',
					'{{WRAPPER}} .mas-addons-form .mas-addons-input::-moz-placeholder'          => 'color: {{VALUE}}',
					'{{WRAPPER}} .mas-addons-form .mas-addons-input:-ms-input-placeholder'      => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'field_typo',
				'selector' 		=> '{{WRAPPER}} .mas-addons-form .mas-addons-input',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 			=> 'field_box_shadow',
				'selector' 		=> '{{WRAPPER}} .mas-addons-form .mas-addons-input',
			]
		);
		$this->add_responsive_control(
            'input_width',
            [
                'label'      => __( 'Width', 'mas-addons' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 1000,
                        'step' => 1,
                    ],
                    '%'  => [
                        'min'  => 0,
                        'max'  => 100,
                        'step' => 1,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .mas-addons-form .mas-addons-input' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

		$this->add_responsive_control(
            'input_height',
            [
                'label'      => __( 'Height', 'mas-addons' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 1000,
                        'step' => 1,
                    ],
                    '%'  => [
                        'min'  => 0,
                        'max'  => 100,
                        'step' => 1,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .mas-addons-form .mas-addons-input' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'field_border',
				'label' 		=> __( 'Border', 'mas-addons' ),
				'selector' 		=> '{{WRAPPER}} .mas-addons-form .mas-addons-input',
			]
		);


		$this->add_responsive_control(
			'field_border_radius',
			[
				'label' 		=> __( 'Border Radius', 'mas-addons' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .mas-addons-form .mas-addons-input' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'field_padding',
			[
				'label' 		=> __( 'Padding', 'mas-addons' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .mas-addons-form .mas-addons-input' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'field_margin',
			[
				'label' 		=> __( 'Margin', 'mas-addons' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .mas-addons-form .mas-addons-input' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_field_hover',
			[
				'label' 		=> __( 'Hover', 'mas-addons' ),
			]
		);

		$this->add_control(
			'field_hover_background',
			[
				'label' 		=> __( 'Background Color', 'mas-addons' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .mas-addons-form .mas-addons-input:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'field_hover_color',
			[
				'label' 		=> __( 'Color', 'mas-addons' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .mas-addons-form .mas-addons-input:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'field_hover_border_color',
			[
				'label' 		=> __( 'Border Color', 'mas-addons' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .mas-addons-form .mas-addons-input:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_field_focus',
			[
				'label' 		=> __( 'Focus', 'mas-addons' ),
			]
		);

		$this->add_control(
			'field_focus_background',
			[
				'label' 		=> __( 'Background Color', 'mas-addons' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .mas-addons-form .mas-addons-input:focus' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'field_focus_color',
			[
				'label' 		=> __( 'Color', 'mas-addons' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .mas-addons-form .mas-addons-input:focus' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'field_focus_border_color',
			[
				'label' 		=> __( 'Border Color', 'mas-addons' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .mas-addons-form .mas-addons-input:focus' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		

		$this->end_controls_section();

		$this->start_controls_section(
			'section_button_style',
			[
				'label' 		=> __( 'Button', 'mas-addons' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( 'tabs_button_style' );

		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label' 		=> __( 'Normal', 'mas-addons' ),
			]
		);

		$this->add_control(
			'button_background',
			[
				'label' 		=> __( 'Background Color', 'mas-addons' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .mas-addons-form .mas-addons-buttons .mas-addons-submit .mas-addons-button' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_color',
			[
				'label' 		=> __( 'Color', 'mas-addons' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .mas-addons-form .mas-addons-buttons .mas-addons-submit .mas-addons-button' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			[
				'label' 		=> __( 'Hover', 'mas-addons' ),
			]
		);

		$this->add_control(
			'button_hover_background',
			[
				'label' 		=> __( 'Background Color', 'mas-addons' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .mas-addons-form .mas-addons-buttons .mas-addons-submit .mas-addons-button:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_color',
			[
				'label' 		=> __( 'Color', 'mas-addons' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .mas-addons-form .mas-addons-buttons .mas-addons-submit .mas-addons-button:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_border_color',
			[
				'label' 		=> __( 'Border Color', 'mas-addons' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .mas-addons-form .mas-addons-buttons .mas-addons-submit .mas-addons-button:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'button_typo',
				'selector' 		=> '{{WRAPPER}} .mas-addons-form .mas-addons-buttons .mas-addons-button',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 			=> 'button_box_shadow',
				'selector' 		=> '{{WRAPPER}} .mas-addons-form .mas-addons-buttons .mas-addons-button',
			]
		);
		$this->add_responsive_control(
            'button_width',
            [
                'label'      => __( 'Width', 'mas-addons' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 1000,
                        'step' => 1,
                    ],
                    '%'  => [
                        'min'  => 0,
                        'max'  => 100,
                        'step' => 1,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .mas-addons-form .mas-addons-buttons .mas-addons-button' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

		$this->add_responsive_control(
            'button_height',
            [
                'label'      => __( 'Height', 'mas-addons' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 100,
                        'step' => 1,
                    ],
                    '%'  => [
                        'min'  => 0,
                        'max'  => 100,
                        'step' => 1,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .mas-addons-form .mas-addons-buttons .mas-addons-button' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'button_border',
				'label' 		=> __( 'Border', 'mas-addons' ),
				'selector' 		=> '{{WRAPPER}} .mas-addons-form .mas-addons-buttons .mas-addons-button',
			]
		);

		$this->add_responsive_control(
			'button_border_radius',
			[
				'label' 		=> __( 'Border Radius', 'mas-addons' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .mas-addons-form .mas-addons-buttons .mas-addons-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'button_margin',
			[
				'label' 		=> __( 'Margin', 'mas-addons' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .mas-addons-form .mas-addons-buttons .mas-addons-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'button_padding',
			[
				'label' 		=> __( 'Padding', 'mas-addons' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .mas-addons-form .mas-addons-buttons .mas-addons-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

	

		$this->end_controls_section();

		$this->start_controls_section(
			'section_link_style',
			[
				'label' 		=> __( 'Login Link', 'mas-addons' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( 'tabs_link_style' );

		$this->start_controls_tab(
			'tab_link_normal',
			[
				'label' 		=> __( 'Normal', 'mas-addons' ),
			]
		);

		$this->add_control(
			'link_color',
			[
				'label' 		=> __( 'Color', 'mas-addons' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .mas-addons-form .mas-addons-link a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_link_hover',
			[
				'label' 		=> __( 'Hover', 'mas-addons' ),
			]
		);

		$this->add_control(
			'link_hover_color',
			[
				'label' 		=> __( 'Color', 'mas-addons' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .mas-addons-form .mas-addons-link a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'link_typo',
				'selector' 		=> '{{WRAPPER}} .mas-addons-form .mas-addons-link a',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_privacy_link_style',
			[
				'label' 		=> __( 'Privacy Policy', 'mas-addons' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( 'tabs_privacy_link_style' );

		$this->start_controls_tab(
			'tab_privacy_link_normal',
			[
				'label' 		=> __( 'Normal', 'mas-addons' ),
			]
		);

		$this->add_control(
			'privacy_link_color',
			[
				'label' 		=> __( 'Color', 'mas-addons' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .mas-addons-form .mas-addons-privacy a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_privacy_link_hover',
			[
				'label' 		=> __( 'Hover', 'mas-addons' ),
			]
		);

		$this->add_control(
			'privacy_link_hover_color',
			[
				'label' 		=> __( 'Color', 'mas-addons' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .mas-addons-form .mas-addons-privacy a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'privacy_link_typo',
				'selector' 		=> '{{WRAPPER}} .mas-addons-form .mas-addons-privacy a',
			]
		);

		$this->end_controls_section();

        // Style tab section
        $this->start_controls_section(
            'mas_addons_reset_form_style_section',
            [
                'label' => __( 'Box', 'mas-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->add_responsive_control(
                'reset_form_style_align',
                [
                    'label' => __( 'Alignment', 'mas-addons' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => __( 'Left', 'mas-addons' ),
                            'icon' => 'fa fa-align-left',
                        ],
                        'center' => [
                            'title' => __( 'Center', 'mas-addons' ),
                            'icon' => 'fa fa-align-center',
                        ],
                        'right' => [
                            'title' => __( 'Right', 'mas-addons' ),
                            'icon' => 'fa fa-align-right',
                        ],
                        'justify' => [
                            'title' => __( 'Justified', 'mas-addons' ),
                            'icon' => 'fa fa-align-justify',
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .mas-addons-form' => 'text-align: {{VALUE}};',
                    ],
                    'default' => 'left',
                    'separator' =>'before',
                ]
            );

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'reset_form_section_background',
                    'label' => __( 'Background', 'mas-addons' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .mas-addons-form',
                ]
            );

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'reset_form_section_box_shadow',
                    'label' => __( 'Box Shadow', 'mas-addons' ),
                    'selector' => '{{WRAPPER}} .mas-addons-form',
                ]
            );

        
            $this->add_responsive_control(
                'reset_form_section_margin',
                [
                    'label' => __( 'Margin', 'mas-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .mas-addons-form' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        'body.rtl {{WRAPPER}} .mas-addons-form' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'reset_form_section_padding',
                [
                    'label' => __( 'Padding', 'mas-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .mas-addons-form' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        'body.rtl {{WRAPPER}} .mas-addons-form' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();

	}

	protected function render() {
		$settings 				= $this->get_settings_for_display();
		$current_url 			= remove_query_arg( 'fake_arg' );
		$show_login 			= 'yes' === $settings['show_login'];
		$show_privacy_policy 	= 'yes' === $settings['show_privacy_policy'];

		if ( 'yes' === $settings['redirect_after_lost_password'] && ! empty( $settings['redirect_url']['url'] ) ) {
			$redirect_url = $settings['redirect_url']['url'];
		} else {
			$redirect_url = $current_url;
		}

		if ( is_user_logged_in() && ! \Elementor\Plugin::instance()->editor->is_edit_mode() ) {
			if ( 'yes' === $settings['show_logged_in_message'] ) {
				$current_user = wp_get_current_user();

				echo '<div class="mas-addons-login">' .
					sprintf( __( 'You are Logged in as %1$s (<a href="%2$s">Logout</a>)', 'mas-addons' ), $current_user->display_name, wp_logout_url( $current_url ) ) .
					'</div>';
			}

			return;
		}

		// Field
		$this->add_render_attribute( 'user_label', 'for', 'mas-addons_user_lost_password' );
		$this->add_render_attribute( 'user_input', [
			'type'	=> 'text',
			'name'	=> 'user_login',
			'id'	=> 'mas-addons_user_lost_password',
			'class' => [
				'mas-addons-username',
				'mas-addons-input',
			],
		] );

		// Placeholders
		if ( $settings['show_placeholders'] ) {
			$this->add_render_attribute( 'user_input', 'placeholder', $settings['user_placeholder'] );
		}

		// Login link
		if ( ! empty( $settings['login_link']['url'] ) ) {
			$this->add_render_attribute( 'login_link', 'href', $settings['login_link']['url'] );

			if ( $settings['login_link']['is_external'] ) {
				$this->add_render_attribute( 'login_link', 'target', '_blank' );
			}

			if ( $settings['login_link']['nofollow'] ) {
				$this->add_render_attribute( 'login_link', 'rel', 'nofollow' );
			}
		} else {
			$this->add_render_attribute( 'login_link', 'href', wp_login_url( $redirect_url ) );
		}

		// Register/login
		$this->add_render_attribute( 'buttons', [
			'class' => [
				'mas-addons-buttons',
				'clr',
			],
		] );

		$this->add_render_attribute( 'submit', 'class', 'mas-addons-submit' );

		if ( $settings['show_message'] ) {
			echo '<p class="mas-addons-form-message">' . $settings['message'] . '</p>';
		} ?>

		<form class="mas-addons-form" method="post" action="<?php echo wp_lostpassword_url(); ?>">
			<p class="mas-addons-username">
				<?php
				if ( $settings['show_label'] ) {
					echo '<label ' . $this->get_render_attribute_string( 'user_label' ) . '>' . $settings['user_label'] . '</label>';
				}

				echo '<input ' . $this->get_render_attribute_string( 'user_input' ) . ' size="1">'; ?>
			</p>

			<?php do_action( 'lostpassword_form' ); ?>

			<div <?php echo $this->get_render_attribute_string( 'buttons' ); ?>>
				<div <?php echo $this->get_render_attribute_string( 'submit' ); ?>>
					<input type="submit" class="mas-addons-button" value="<?php echo esc_attr( $settings['submit_text'] ); ?>"/>
				</div>
			</div>

			<?php
			if ( $show_login ) {
				echo '<div class="mas-addons-link">';
					echo '<a ' . $this->get_render_attribute_string( 'login_link' ) . '>'. $settings['login_text'] .'</a>';
				echo '</div>';
			} ?>

			<?php
			if ( $show_privacy_policy && function_exists( 'the_privacy_policy_link' ) ) {
				the_privacy_policy_link( '<div class="mas-addons-privacy">', '</div>' );
			} ?>

			<input type="hidden" name="redirect_to" value="<?php echo esc_url( $redirect_url ); ?>" />
			<input type="hidden" name="action" value="lostpassword" />
		</form>

	<?php
	}

}
$widgets_manager->register( new \Mas_Addons\Widgets\Mas_LostPassword() );