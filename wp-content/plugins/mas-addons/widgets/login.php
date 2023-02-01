<?php
/**
 * Finisys form Widget.
 *
 *
 * @since 1.0.0
 */
namespace Mas_Addons\Widgets;

use  Elementor\Widget_Base;
use  Elementor\Controls_Manager;
use  Elementor\utils;
use  Elementor\Group_Control_Typography;
use  Elementor\Group_Control_Box_Shadow;
use  Elementor\Group_Control_Background;
use  Elementor\Group_Control_Border;
use  Elementor\Plugin;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class  Fdaddons_LoginForm extends \Elementor\Widget_Base{

    public function get_name() {
        return 'fdaddons-login-form';
    }
    
    public function get_title() {
        return __( 'Login Form', 'mas-addons' );
    }

    public function get_icon() {
        return 'eicon-lock-user';
    }
    public function get_categories() {
        return [ 'mas-addons' ];
    }

    protected function register_controls() {

            $this->start_controls_section(
                'user_login_form_content',
                [
                    'label' => __( 'Login Form', 'mas-addons' ),
                ]
            );

            $this->add_control(
                'mas_addons_form_show_password',
                [
                    'label' => esc_html__( 'Show Password', 'mas-addons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'yes',
                    'label_off' => esc_html__( 'Hide', 'mas-addons' ),
                    'label_on' => esc_html__( 'Show', 'mas-addons' ),
                ]
            );
            $this->add_control(
                'mas_addons_form_show_label',
                [
                    'label' => esc_html__( 'Label', 'mas-addons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'yes',
                    'label_off' => esc_html__( 'Hide', 'mas-addons' ),
                    'label_on' => esc_html__( 'Show', 'mas-addons' ),
                ]
            );

            $this->add_control(
                'mas_addons_form_show_customlabel',
                [
                    'label' => esc_html__( 'Custom label', 'mas-addons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'no',
                    'label_off' => esc_html__( 'Hide', 'mas-addons' ),
                    'label_on' => esc_html__( 'Show', 'mas-addons' ),
                    'condition' =>[
                        'mas_addons_form_show_label' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'mas_addons_user_label',
                    [
                    'label'     => esc_html__( 'Username Label', 'mas-addons' ),
                    'type'      => Controls_Manager::TEXT,
                    'default'   => esc_html__( 'Username or Email', 'mas-addons' ),
                    'condition' => [
                        'mas_addons_form_show_label'   => 'yes',
                        'mas_addons_form_show_customlabel' => 'yes',
                    ],
                ]
            );

            $this->add_control(
                'mas_addons_user_placeholder',
                [
                    'label'     => esc_html__( 'Username Placeholder', 'mas-addons' ),
                    'type'      => Controls_Manager::TEXT,
                    'default'   => esc_html__( 'Username or Email', 'mas-addons' ),
                    'condition' => [
                        'mas_addons_form_show_label'   => 'yes',
                        'mas_addons_form_show_customlabel' => 'yes',
                    ],
                ]
            );

            $this->add_control(
                'mas_addons_password_label',
                [
                    'label'     => esc_html__( 'Password Label', 'mas-addons' ),
                    'type'      => Controls_Manager::TEXT,
                    'default'   => esc_html__( 'Password', 'mas-addons' ),
                    'condition' => [
                        'mas_addons_form_show_label'   => 'yes',
                        'mas_addons_form_show_customlabel' => 'yes',
                    ],
                ]
            );

            $this->add_control(
                'mas_addons_password_placeholder',
                [
                    'label'     => __( 'Password Placeholder', 'mas-addons' ),
                    'type'      => Controls_Manager::TEXT,
                    'default'   => __( 'Password', 'mas-addons' ),
                    'condition' => [
                        'mas_addons_form_show_label'   => 'yes',
                        'mas_addons_form_show_customlabel' => 'yes',
                    ],
                ]
            );

            $this->add_control(
                'redirect_page',
                [
                    'label' => __( 'Redirect page after Login', 'mas-addons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'no',
                    'label_off' => __( 'No', 'mas-addons' ),
                    'label_on' => __( 'Yes', 'mas-addons' ),
                ]
            );

            $this->add_control(
                'redirect_page_url',
                [
                    'type'          => Controls_Manager::URL,
                    'show_label'    => false,
                    'show_external' => false,
                    'separator'     => false,
                    'placeholder'   => 'http://your-link.com/',
                    'condition'     => [
                        'redirect_page' => 'yes',
                    ],
                ]
            );

            $this->add_control(
                'lost_password',
                [
                    'label'     => esc_html__( 'Lost your password?', 'mas-addons' ),
                    'type'      => Controls_Manager::SWITCHER,
                    'default'   => 'yes',
                    'label_off' => esc_html__( 'Hide', 'mas-addons' ),
                    'label_on'  => esc_html__( 'Show', 'mas-addons' ),
                ]
            );
            $this->add_control(
                'lostpass_link_text',
                [
                    'label' => __( 'Lost Password Text', 'mas-addons' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => __( 'Forgot Password?', 'mas-addons' ),
                    'label_block' => true,
                    'condition'     => [
                        'lost_password' => 'yes',
                    ],
                ]
            );
            $this->add_control('mas_addons_forget_button_existing_link',
            [
                'label'         => __('Select Reset Password Page ', 'mas_addons'),
                'type'          => Controls_Manager::SELECT2,
                'options'       => mas_addons_get_all_pages(),
                'condition'     => [
                    'lost_password'     => 'yes',
                ],
                'multiple'      => false,
                'label_block'   => true,
            ]
        );
            $this->add_control(
                'remember_me',
                [
                    'label'     => esc_html__( 'Remember Me', 'mas-addons' ),
                    'type'      => Controls_Manager::SWITCHER,
                    'default'   => 'yes',
                    'label_off' => esc_html__( 'Hide', 'mas-addons' ),
                    'label_on'  => esc_html__( 'Show', 'mas-addons' ),
                ]
            );
            $this->add_control(
                'remember_me_heading',
                [
                    'label' => __( 'Remember Me Text', 'mas-addons' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => __( 'Remember Me', 'mas-addons' ),
                    'label_block' => true,
                ]
            );
            if ( get_option( 'users_can_register' ) ) {
                $this->add_control(
                    'register_link',
                    [
                        'label'     => esc_html__( 'Register', 'mas-addons' ),
                        'type'      => Controls_Manager::SWITCHER,
                        'default'   => 'no',
                        'label_off' => esc_html__( 'Hide', 'mas-addons' ),
                        'label_on'  => esc_html__( 'Show', 'mas-addons' ),
                    ]
                );

                $this->add_control(
                    'register_text',
                    [
                        'label' => __( 'Register Text', 'mas-addons' ),
                        'type' => Controls_Manager::TEXT,
                        'default' => __( 'All ready have account?', 'mas-addons' ),
                        'label_block' => true,
                        'condition'     => [
                            'register_link' => 'yes',
                        ],
                    ]
                );
                $this->add_control(
                    'register_link_text',
                    [
                        'label' => __( 'Register Link Text', 'mas-addons' ),
                        'type' => Controls_Manager::TEXT,
                        'default' => __( 'Create a free account', 'mas-addons' ),
                        'label_block' => true,
                        'condition'     => [
                            'register_link' => 'yes',
                        ],
                    ]
                );
            }

            $this->add_control('mas_addons_reg_button_existing_link',
                [
                    'label'         => __('Select Register Page ', 'mas_addons'),
                    'type'          => Controls_Manager::SELECT2,
                    'options'       => mas_addons_get_all_pages(),
                    'condition'     => [
                        'register_link'     => 'yes',
                    ],
                    'multiple'      => false,
                    'label_block'   => true,
                ]
            );


            $this->add_control(
                'login_button_heading',
                [
                    'label' => __( 'Login Button', 'mas-addons' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'login_button_text',
                [
                    'label' => __( 'Button Text', 'mas-addons' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => __( 'Login', 'mas-addons' ),
                    'label_block' => true,
                ]
            );

            
        $this->end_controls_section();

        // Style tab section
        
        $this->start_controls_section(
            'mas_addons_login_showpass_style',
            [
                'label' => __( 'Show Password', 'mas-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' =>[
                    'mas_addons_form_show_password' => 'yes',
                ]
            ]
            
        );
        $this->add_responsive_control(
            'show-position-x',
            [
                'label' => __( 'Position X', 'mas-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 0,
                ],
                'selectors' => [
                    '{{WRAPPER}} .toggle-password' => 'right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'showpass-position-y',
            [
                'label' => __( 'Position Y', 'mas-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => -500,
                        'max' => 500,
                        'step' => 0,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 50,
                ],
                'selectors' => [
                    '{{WRAPPER}} .toggle-password' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();



        $this->start_controls_section(
            'login_form_style_input',
            [
                'label' => __( 'Input', 'mas-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
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
            'login_form_input_text_color',
            [
                'label'     => __( 'Text Color', 'mas-addons' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mas-addons-login-form-wrapper input'   => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'login_form_input_placeholder_color',
            [
                'label'     => __( 'Placeholder Color', 'mas-addons' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mas-addons-login-form-wrapper input[type*="text"]::-webkit-input-placeholder'  => 'color: {{VALUE}};',
                    '{{WRAPPER}} .mas-addons-login-form-wrapper input[type*="text"]::-moz-placeholder'  => 'color: {{VALUE}};',
                    '{{WRAPPER}} .mas-addons-login-form-wrapper input[type*="text"]:-ms-input-placeholder'  => 'color: {{VALUE}};',
                        '{{WRAPPER}} .mas-addons-login-form-wrapperinput[type*="password"]::-webkit-input-placeholder'  => 'color: {{VALUE}};',
                    '{{WRAPPER}} .mas-addons-login-form-wrapper input[type*="password"]::-moz-placeholder'  => 'color: {{VALUE}};',
                    '{{WRAPPER}} .mas-addons-login-form-wrapper input[type*="password"]:-ms-input-placeholder'  => 'color: {{VALUE}};',
                        '{{WRAPPER}} .mas-addons-login-form-wrapperinput[type*="email"]::-webkit-input-placeholder'  => 'color: {{VALUE}};',
                    '{{WRAPPER}} .mas-addons-login-form-wrapper input[type*="email"]::-moz-placeholder'  => 'color: {{VALUE}};',
                    '{{WRAPPER}} .mas-addons-login-form-wrapper input[type*="email"]:-ms-input-placeholder'  => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'login_form_input_typography',
                'selector' => '{{WRAPPER}} .mas-addons-login-form-wrapper input',
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'login_form_input_background',
                'label' => __( 'Background', 'mas-addons' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .mas-addons-login-form-wrapper input',
            ]
        );

        $this->add_control(
            'login_form_input_height',
            [
                'label' => __( 'Height', 'mas-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 56,
                ],
                'selectors' => [
                    '{{WRAPPER}} .mas-addons-login-form-wrapper input[type="text"],{{WRAPPER}} .mas-addons-login-form-wrapper input[type="password"]' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'login_form_input_border',
                'label' => __( 'Border', 'mas-addons' ),
                'selector' => '{{WRAPPER}} .mas-addons-login-form-wrapper input',
            ]
        );

        $this->add_responsive_control(
            'login_form_input_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'mas-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .mas-addons-login-form-wrapper input' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                ],
            ]
        );

        $this->add_responsive_control(
            'login_form_input_margin',
            [
                'label' => __( 'Margin', 'mas-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .mas-addons-login-form-wrapper input' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .mas-addons-login-form-wrapper input' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'login_form_input_padding',
            [
                'label' => __( 'Padding', 'mas-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .mas-addons-login-form-wrapper input' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .mas-addons-login-form-wrapper input' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
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
					'{{WRAPPER}} .mas-addons-login-form-wrapper input:focus' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'field_focus_color',
			[
				'label' 		=> __( 'Color', 'mas-addons' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .mas-addons-login-form-wrapper input:focus' => 'color: {{VALUE}};',
				],
			]
		);

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'login_form_input_border_focus',
                'label' => __( 'Border', 'mas-addons' ),
                'selector' => '{{WRAPPER}} .mas-addons-login-form-wrapper input:focus',
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

         // Label Style Start
         $this->start_controls_section(
            'login_form_style_label',
            [
                'label' => __( 'Label', 'mas-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_responsive_control(
                'login_form_label_align',
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
                        '{{WRAPPER}} .mas-addons-login-form-wrapper label' => 'text-align: {{VALUE}};',
                    ],
                    'default' => 'left',
                ]
            );

            $this->add_control(
                'login_form_label_text_color',
                [
                    'label'     => __( 'Color', 'mas-addons' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .mas-addons-login-form-wrapper label'   => 'color: {{VALUE}};',
                        '{{WRAPPER}} .mas-addons-login-form-wrapper .login_register_text'   => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'login_form_label_typography',
                    'selector' => '{{WRAPPER}} .mas-addons-login-form-wrapper label,{{WRAPPER}} .mas-addons-login-form-wrapper .login_register_text',
                ]
            );

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'login_form_label_background',
                    'label' => __( 'Background', 'mas-addons' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .mas-addons-login-form-wrapper label',
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'login_form_label_border',
                    'label' => __( 'Border', 'mas-addons' ),
                    'selector' => '{{WRAPPER}} .mas-addons-login-form-wrapper label',
                ]
            );

            $this->add_responsive_control(
                'login_form_label_margin',
                [
                    'label' => __( 'Margin', 'mas-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .mas-addons-login-form-wrapper label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        'body.rtl {{WRAPPER}} .mas-addons-login-form-wrapper label' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'login_form_label_padding',
                [
                    'label' => __( 'Padding', 'mas-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .mas-addons-login-form-wrapper label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        'body.rtl {{WRAPPER}} .mas-addons-login-form-wrapper label' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'login_form_label_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'mas-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .mas-addons-login-form-wrapper label' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                        'body.rtl {{WRAPPER}} .mas-addons-login-form-wrapper label' => 'border-radius: {{TOP}}px {{LEFT}}px {{BOTTOM}}px {{RIGHT}}px;',
                    ],
                ]
        );
        $this->end_controls_section();

        // Rememberme section start
        $this->start_controls_section(
            'login_form_style_rememberme',
            [
                'label' => __( 'Remember Me Checkbox', 'mas-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'login_form_input_rememberme_typography',
                    'selector' => '{{WRAPPER}} .mas-addons-login-form-wrapper form .log-remember label',
                ]
            );

            // $this->add_control(
            //     'login_form_input_rememberme_height',
            //     [
            //         'label' => __( 'Height', 'mas-addons' ),
            //         'type' => Controls_Manager::SLIDER,
            //         'size_units' => [ 'px', '%' ],
            //         'range' => [
            //             'px' => [
            //                 'min' => 0,
            //                 'max' => 200,
            //                 'step' => 1,
            //             ],
            //             '%' => [
            //                 'min' => 0,
            //                 'max' => 100,
            //             ],
            //         ],
            //         'default' => [
            //             'unit' => 'px',
            //             'size' => 20,
            //         ],
            //         'selectors' => [
            //             '{{WRAPPER}} .mas-addons-login-form-wrapper form .log-remember label input[type="checkbox"]' => 'height: {{SIZE}}{{UNIT}};',
            //         ],
            //     ]
            // );

            $this->add_responsive_control(
                'login_form_input_rememberme_margin',
                [
                    'label' => __( 'Margin', 'mas-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .mas-addons-login-form-wrapper form .log-remember label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                        'body.rtl {{WRAPPER}} .mas-addons-login-form-wrapper form .log-remember label' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}} !important;',
                    ],
                ]
            );
            $this->add_control(
                'login_form_input_rememberme_color',
                [
                    'label'     => __( 'Color', 'mas-addons' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .mas-addons-login-form-wrapper form .log-remember label'   => 'color: {{VALUE}};',
                    ],
                ]
            );
            $this->end_controls_section(); // Checkbox section end

            // foget password text
            $this->start_controls_section(
                'forget_forget_content',
                [
                    'label' => __( 'Forget', 'mas-addons' ),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'forget_typo',
                    'selector' => '{{WRAPPER}} .forgetpassword',
                ]
            );
            $this->add_control(
                'forgetpass_color',
                [
                    'label'     => __( 'Color', 'mas-addons' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .forgetpassword'   => 'color: {{VALUE}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'forgetpass_margin',
                [
                    'label' => __( 'Margin', 'mas-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .forgetpassword' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        'body.rtl {{WRAPPER}} .forgetpassword' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'forgetpass_positions',
                [
                    'label' => __( 'Positions', 'mas-addons' ),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'default' => 'none',
                    'options' => [
                        'Relative'  => __( 'Relative', 'mas-addons' ),
                        'fixed' => __( 'Fixed', 'mas-addons' ),
                        'absolute' => __( 'Absolute', 'mas-addons' ),
                        'static' => __( 'Static', 'mas-addons' ),
                        'none' => __( 'None', 'mas-addons' ),
                    ],
                ]
            );

            $this->add_responsive_control(
                'forgetpass-position-x',
                [
                    'label' => __( 'Position X', 'mas-addons' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1000,
                            'step' => 5,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 0,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .forgetpassword' => 'right: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' =>[
                        'forgetpass_positions' => 'absolute',
                    ]
                ]
            );

            $this->add_responsive_control(
                'forgetpass-position-y',
                [
                    'label' => __( 'Position Y', 'mas-addons' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range' => [
                        'px' => [
                            'min' => -500,
                            'max' => 500,
                            'step' => 0,
                        ],
                        '%' => [
                            'min' => -100,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 0,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .forgetpassword' => 'top: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' =>[
                        'forgetpass_positions' => 'absolute',
                    ]
                ]
            );
            
            $this->end_controls_section(); 

            // Registar Page text
            $this->start_controls_section(
                'forget_reg_content',
                [
                    'label' => __( 'Register', 'mas-addons' ),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
            );
            $this->add_responsive_control(
                'forget_reg_content_align',
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
                        '{{WRAPPER}} .finists-reg-link' => 'text-align: {{VALUE}};',
                    ],
                    'default' => 'left',
                ]
            );
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'reg_typo',
                    'selector' => '
                    {{WRAPPER}} .finists-reg-link, 
                    {{WRAPPER}} .finists-reg-link a',
                ]
            );
            $this->add_control(
                'regtext_color',
                [
                    'label'     => __( 'Color', 'mas-addons' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .finists-reg-link'   => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_control(
                'regtext_a_color',
                [
                    'label'     => __( 'Link Color', 'mas-addons' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .finists-reg-link a'   => 'color: {{VALUE}} !important;',
                    ],
                ]
            );

            $this->add_responsive_control(
                'regtext_margin',
                [
                    'label' => __( 'Margin', 'mas-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .finists-reg-link' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        'body.rtl {{WRAPPER}} .finists-reg-link' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                    ],
                ]
            );

            $this->end_controls_section(); 

            // Submit Button
            $this->start_controls_section(
                'login_form_style_submit_button',
                [
                    'label' => __( 'Submit Button', 'mas-addons' ),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
            );

            // Button Tabs Start
            $this->start_controls_tabs('login_form_style_submit_tabs');

                    // Start Normal Submit button tab
                    $this->start_controls_tab(
                        'login_form_style_submit_normal_tab',
                        [
                            'label' => __( 'Normal', 'mas-addons' ),
                        ]
                    );
                    
                    $this->add_control(
                        'login_form_submitbutton_text_color',
                        [
                            'label'     => __( 'Color', 'mas-addons' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .mas-addons-login-form-wrapper input[type="submit"]'   => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Typography::get_type(),
                        [
                            'name' => 'login_form_submitbutton_typography',
                            'selector' => '{{WRAPPER}} .mas-addons-login-form-wrapper input[type="submit"]',
                        ]
                    );

                    $this->add_control(
                        'login_form_submitbutton_background',
                        [
                            'label'     => __( 'Background Color', 'mas-addons' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .mas-addons-login-form-wrapper input[type="submit"]'   => 'background-color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'login_form_button_shadow',
                            'label' => __( 'Box Shadow', 'mas-addons' ),
                            'selector' => '{{WRAPPER}} .mas-addons-login-form-wrapper input[type="submit"]',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'login_form_submitbutton_border',
                            'label' => __( 'Border', 'mas-addons' ),
                            'selector' => '{{WRAPPER}} .mas-addons-login-form-wrapper input[type="submit"]',
                        ]
                    );
                    
                    $this->add_control(
                        'login_form_submitbutton_height',
                        [
                            'label' => __( 'Height', 'mas-addons' ),
                            'type' => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%' ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 1000,
                                    'step' => 1,
                                ],
                                '%' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                            ],
                            'default' => [
                                'unit' => 'px',
                                'size' => 50,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .mas-addons-login-form-wrapper input[type="submit"]' => 'height: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );
        
                    $this->add_control(
                        'login_form_submitbutton_width',
                        [
                            'label' => __( 'Height', 'mas-addons' ),
                            'type' => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%' ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 1000,
                                    'step' => 1,
                                ],
                                '%' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .mas-addons-login-form-wrapper input[type="submit"]' => 'width: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );
        
                    $this->add_responsive_control(
                        'login_form_submitbutton_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'mas-addons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .mas-addons-login-form-wrapper input[type="submit"]' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                                'body.rtl {{WRAPPER}} .mas-addons-login-form-wrapper input[type="submit"]' => 'border-radius: {{TOP}}px {{LEFT}}px {{BOTTOM}}px {{RIGHT}}px;',
                            ],
                        ]
                    );
                    
                    $this->add_responsive_control(
                        'login_form_submitbutton_margin',
                        [
                            'label' => __( 'Margin', 'mas-addons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .mas-addons-login-form-wrapper input[type="submit"]' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                'body.rtl {{WRAPPER}} .mas-addons-login-form-wrapper input[type="submit"]' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                            ],
                        ]
                    );
        
                    $this->add_responsive_control(
                        'login_form_submitbutton_padding',
                        [
                            'label' => __( 'Padding', 'mas-addons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .mas-addons-login-form-wrapper input[type="submit"]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                'body.rtl {{WRAPPER}} .mas-addons-login-form-wrapper input[type="submit"]' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                            ],
                        ]
                    );
                   
                $this->end_controls_tab(); // Normal submit Button tab end

                // Start Hover Submit button tab
                $this->start_controls_tab(
                    'login_form_style_submit_hover_tab',
                    [
                        'label' => __( 'Hover', 'mas-addons' ),
                    ]
                );
                    
                    $this->add_control(
                        'login_form_submitbutton_hover_text_color',
                        [
                            'label'     => __( 'Color', 'mas-addons' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .mas-addons-login-form-wrapper input[type="submit"]:hover'   => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'login_form_submitbutton_hover_background',
                            'label' => __( 'Background', 'mas-addons' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .mas-addons-login-form-wrapper input[type="submit"]:hover',
                        ]
                    );

                    $this->add_control(
                        'login_form_submitbutton_hover_background',
                        [
                            'label'     => __( 'Background Color', 'mas-addons' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .mas-addons-login-form-wrapper input[type="submit"]:hover'   => 'background-color: {{VALUE}};',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'login_form_button_shadow_hover',
                            'label' => __( 'Box Shadow Hover', 'mas-addons' ),
                            'selector' => '{{WRAPPER}} .mas-addons-login-form-wrapper input[type="submit"]:hover',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'login_form_submitbutton_hover_border',
                            'label' => __( 'Border', 'mas-addons' ),
                            'selector' => '{{WRAPPER}} .mas-addons-login-form-wrapper input[type="submit"]:hover',
                            'separator' =>'after',
                        ]
                    );
                    $this->add_control(
                        'hrtwo',
                        [
                            'type' => Controls_Manager::DIVIDER,
                        ]
                    );
                $this->end_controls_tab(); // Hover Submit Button tab End
            $this->end_controls_tabs(); // Button Tabs End

            

        $this->end_controls_section();

        // Style tab section
        $this->start_controls_section(
            'mas_addons_login_form_style_section',
            [
                'label' => __( 'Box', 'mas-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->add_responsive_control(
                'login_form_style_align',
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
                        '{{WRAPPER}} .mas-addons-login-form-wrapper' => 'text-align: {{VALUE}};',
                    ],
                    'default' => 'left',
                    'separator' =>'before',
                ]
            );

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'login_form_section_background',
                    'label' => __( 'Background', 'mas-addons' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .mas-addons-login-form-wrapper',
                ]
            );

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'login_form_section_box_shadow',
                    'label' => __( 'Box Shadow', 'mas-addons' ),
                    'selector' => '{{WRAPPER}} .mas-addons-login-form-wrapper',
                ]
            );

        
            $this->add_responsive_control(
                'login_form_section_margin',
                [
                    'label' => __( 'Margin', 'mas-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .mas-addons-login-form-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        'body.rtl {{WRAPPER}} .mas-addons-login-form-wrapper' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'login_form_section_padding',
                [
                    'label' => __( 'Padding', 'mas-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .mas-addons-login-form-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        'body.rtl {{WRAPPER}} .mas-addons-login-form-wrapper' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();


    }

    protected function render( $instance = [] ) {

        $settings   = $this->get_settings_for_display();

        $pages_link = get_permalink( $settings['mas_addons_reg_button_existing_link'] );
        $resetpage_link = get_permalink( $settings['mas_addons_forget_button_existing_link'] );

       //registar page
        $wp_default_link = wp_registration_url();
        if(!empty($pages_link)) {
            $button_link = $pages_link;
        }else{
            $button_link = $wp_default_link;
        };

        // reset page
        $wp_resetpage_link   = wp_lostpassword_url(); 
        if(!empty($resetpage_link)) {
            $reset_link = $resetpage_link;
        }else{
            $reset_link =  $wp_resetpage_link;
        };

        $current_url = remove_query_arg( 'fake_arg' );


        $id = $this->get_id();
        $home_url = \home_url();

        if ( $settings['redirect_page'] == 'yes' && ! empty( $settings['redirect_page_url']['url'] ) ) {
            $redirect_url = $settings['redirect_page_url']['url'];
        } else {
            $redirect_url = $home_url;
        }

        $this->add_render_attribute( 'loginform_area_attr', 'class', 'mas-addons-login-form-wrapper' );

        // Label Value
        $user_label = isset( $settings['mas_addons_user_label'] ) ? $settings['mas_addons_user_label'] : __('Username','mas-addons');
        $user_placeholder = isset( $settings['mas_addons_user_placeholder'] ) ? $settings['mas_addons_user_placeholder'] : __('Username','mas-addons');
        $pass_label = isset( $settings['mas_addons_password_label'] ) ? $settings['mas_addons_password_label'] : __('Password','mas-addons');
        $pass_placeholder = isset( $settings['mas_addons_password_placeholder'] ) ? $settings['mas_addons_password_placeholder'] : __('Password','mas-addons');
       
        ?>
            <div <?php echo $this->get_render_attribute_string( 'loginform_area_attr' ); ?> >

                <div id="mas_addons_message_<?php echo esc_attr( $id ); ?>" class="mas_addons_message">&nbsp;</div>

                <?php
                if ( is_user_logged_in() && !Plugin::instance()->editor->is_edit_mode() ) {
                    $current_user = wp_get_current_user();
                    echo '<div class="mas-addons-user-login">' .
                        sprintf( __( 'You are Logged in as %1$s (<a href="%2$s">Logout</a>)', 'mas-addons' ), $current_user->display_name, wp_logout_url( $current_url ) ) .
                        '</div>';
                    return;
                }
                ?>
                <form id="mas_addons_login_form_<?php echo esc_attr( $id ); ?>" action="formloginaction" method="post">
                    <div id="mas-addons-form-fs">
                        <div class="form-field">
                            <?php
                                if( $settings['mas_addons_form_show_label'] == 'yes'){
                                    echo sprintf('<label for="%1$s">%1$s</label>', $user_label );
                                }
                            ?>
                            <input 
                                type="text"  
                                id="login_username<?php echo esc_attr( $id ); ?>" 
                                name="login_username" 
                                placeholder="<?php echo esc_attr__( $user_placeholder,'mas-addons' );?>">
                        </div>

                        <div class="form-field password-field position-relative">
                            <?php
                                if( $settings['mas_addons_form_show_label'] == 'yes'){
                                    echo sprintf('<label for="%1$s">%1$s</label>', $pass_label );
                                }
                            ?>
                            <input
                                type="password" 
                                id="login_password<?php echo esc_attr( $id ); ?>" 
                                name="login_password" 
                                placeholder="<?php echo esc_attr__( $pass_placeholder,'mas-addons' );?>">
                                <?php if( $settings['mas_addons_form_show_password'] == 'yes' ): ?>
                                    <i class="toggle-password fas fa-fw fa-eye-slash"></i>
                                <?php endif;?>
                                <?php if( $settings['lost_password'] == 'yes' ): ?>
                                    <a href="<?php echo esc_url($reset_link); ?>" class="fright forgetpassword position-<?php echo $settings['forgetpass_positions']?>"><?php echo $settings['lostpass_link_text'] ?></a>
                                <?php endif;?>
                        </div>

                        
                        <div class="log-remember">
                            <?php if( $settings['remember_me'] == 'yes' ): ?>
                                <label class="lable-content" id="rememberme">
                                    <span class="checkmark"></span>
                                    <input name="rememberme" type="checkbox" id="rememberme" value="forever">
                                    <?php if( !empty( $settings['remember_me_heading'] ) ){ echo esc_attr__( $settings['remember_me_heading'], 'mas-addons'); } else { esc_html_e( 'Remember Me', 'mas-addons' ); } ?>
                                </label>
                            <?php endif; ?>
                        </div>
                                
                        <div class="form-field" id="form-footer">
                            <input 
                                type="submit" 
                                id="login_form_submit_<?php echo esc_attr__( $id, 'mas-addons'); ?>" 
                                name="login_form_submit<?php echo $id; ?>" 
                                value="<?php if( !empty( $settings['login_button_text'] ) ){ echo esc_attr__( $settings['login_button_text'], 'mas-addons'); } else { esc_html_e( 'Login', 'mas-addons' ); } ?>">
                           
                            <?php if( get_option( 'users_can_register' ) && $settings['register_link'] == 'yes' ): ?> 
                                <div class="finists-reg-link">
                                    <span class="freg-text"><?php if( !empty( $settings['register_text'] ) ){ echo esc_attr__( $settings['register_text'],
                                            'mas-addons'); } else { esc_html_e( 'All ready have account?', 'mas-addons' ); } ?></span>
                                            
                                    <a href="<?php echo esc_url($button_link); ?>" class="login_register_text">
                                        <?php if( !empty( $settings['register_link_text'] ) ){ echo esc_attr__( $settings['register_link_text'],
                                            'mas-addons'); } else { esc_html_e( 'Create a free account', 'mas-addons' ); } ?>
                                    </a>
                                </div>
                            <?php endif;?>
                        </div>
                    </div>
                    <?php wp_nonce_field( 'ajax-login-nonce', 'security' ); ?>
                </form>
            </div>
        <?php
        $this->mas_addons_login_check( $settings['redirect_page'], $redirect_url, $id );
    }
    public function mas_addons_login_check( $reddirectstatus, $redirect_url, $id ) {
        ?>
        <script type="text/javascript">
            jQuery(document).ready(function($) {
                "use strict";
                var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
                var loadingmessage = '<?php echo esc_html__('Please wait...','mas-addons'); ?>';
                var login_form_id = 'form#mas_addons_login_form_<?php echo esc_attr( $id ); ?>';
                var login_button_id = '#login_form_submit_<?php echo esc_attr( $id ); ?>';
                var redirect = '<?php echo $reddirectstatus; ?>';

                $( login_button_id ).on('click', function(){

                    $('#mas_addons_message_<?php echo esc_attr( $id ); ?>').html('<span class="mas_addons_lodding_msg">'+ loadingmessage +'</span>').fadeIn();

                    $.ajax({  
                        type: 'POST',
                        dataType: 'json',  
                        url:  ajaxurl,  
                        data: { 
                            'action': 'mas_addons_ajax_login',
                            'username': $( login_form_id + ' #login_username<?php echo esc_attr( $id ); ?>').val(), 
                            'password': $( login_form_id + ' #login_password<?php echo esc_attr( $id ); ?>').val(), 
                            'security': $( login_form_id + ' #security').val()
                        },
                        success: function(msg){
                            if ( msg.loggeauth == true ){
                                $('#mas_addons_message_<?php echo esc_attr( $id ); ?>').html('<div class="mas_addons_success_msg alert alert-success">'+ msg.message +'</div>').fadeIn();
                                if( redirect === 'yes' ){
                                    document.location.href = '<?php echo esc_url( $redirect_url ); ?>';
                                    console.log('ok');
                                }else{
                                    document.location.href = '<?php echo esc_url( $redirect_url ); ?>';
                                }
                            }else{
                                $('#mas_addons_message_<?php echo esc_attr( $id ); ?>').html('<div class="mas_addons_invalid_msg alert alert-danger">'+ msg.message +'</div>').fadeIn();
                            }
                        }  
                    });
                    return false;
                });
            });
        </script>
        <?php
    }

}
$widgets_manager->register( new \Mas_Addons\Widgets\Fdaddons_LoginForm() );