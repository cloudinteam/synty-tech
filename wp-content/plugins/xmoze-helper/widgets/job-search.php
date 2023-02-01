<?php

/**
 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class xmozeJobSearch extends \Elementor\Widget_Base
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
        return 'xmoze-job-search';
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
        return __('Xmoze Job Search', 'xmoze-ts');
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
        return 'eicon-search';
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
            'job_search',
            [
                'label' => __('General', 'xmoze-ts'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'submit_label',
            [
                'label' => __('Submit Label', 'xmoze-ts'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Search',
            ]
        );
        $this->add_control(
            'input_icon',
            [
                'label' => __('Search Icon', 'xmoze-ts'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-star',
                    'library' => 'solid',
                ],
            ]
        );
        $this->add_control(
            'select_icon',
            [
                'label' => __('Select Icon', 'xmoze-ts'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-star',
                    'library' => 'solid',
                ],
            ]
        );
        $this->end_controls_section();




        $this->start_controls_section(
            'form_style',
            [
                'label' => __('Form Style', 'xmoze-ts'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            '5B7486',
            [
                'label' => __('Placeholder Color', 'xmoze-ts'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xmoze-job-search-form .xmoze-job-search-input::placeholder, .xmoze-job-search-form .nice-select, .xmoze-job-search-form select, .xmoze-job-search-form .nice-select .current' => 'color: {{VALUE}} !important',
                ],
            ]
        );

        $this->add_responsive_control(
            'form_color',
            [
                'label' => __('Color', 'xmoze-ts'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xmoze-job-search-form input:not([type=submit]):not([type=radio]):not([type=checkbox])' => 'color: {{VALUE}} !important',
                ],
            ]
        );
        $this->add_responsive_control(
            'form_bg',
            [
                'label' => __('Background Color', 'xmoze-ts'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xmoze-job-search-form input:not([type=submit]):not([type=radio]):not([type=checkbox]), .xmoze-job-search-form .nice-select, .xmoze-job-search-form select' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'form_typography',
                'label' => __('Typography', 'xmoze-ts'),
                'selector' => '{{WRAPPER}} .xmoze-job-search-form input:not([type=submit]):not([type=radio]):not([type=checkbox]), .xmoze-job-search-form .nice-select, .xmoze-job-search-form select, .xmoze-job-search-form .nice-select .current',
            ]
        );


        $this->add_responsive_control(

            'form_width',
            [
                'label' => __('Width', 'xmoze-ts'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 600,

                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],

                'selectors' => [
                    '{{WRAPPER}} .xmoze-job-search-form .input-wrap' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(

            'form_height',
            [
                'label' => __('Height', 'xmoze-ts'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 600,

                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],

                'selectors' => [
                    '{{WRAPPER}} .xmoze-job-search-form input:not([type=submit]):not([type=radio]):not([type=checkbox]), .xmoze-job-search-form .nice-select, .xmoze-job-search-form select' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(

            'form_line_height',
            [
                'label' => __('Line Height', 'xmoze-ts'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 600,

                    ],
                ],

                'selectors' => [
                    '{{WRAPPER}} .xmoze-job-search-form input:not([type=submit]):not([type=radio]):not([type=checkbox]), .xmoze-job-search-form .nice-select, .xmoze-job-search-form select' => 'line-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );


        $this->add_responsive_control(
            'form_padding',
            [
                'label' => __('Padding', 'xmoze-ts'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .xmoze-job-search-form input:not([type=submit]):not([type=radio]):not([type=checkbox]), .xmoze-job-search-form .nice-select, .xmoze-job-search-form select' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'form_margin',
            [
                'label' => __('Margin', 'xmoze-ts'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .xmoze-job-search-form input:not([type=submit]):not([type=radio]):not([type=checkbox]), .xmoze-job-search-form .nice-select, .xmoze-job-search-form select' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'form_border',
                'label'    => __('Border', 'xmoze-ts'),
                'selector' => '{{WRAPPER}} .xmoze-job-search-form input:not([type=submit]):not([type=radio]):not([type=checkbox]), .xmoze-job-search-form .nice-select, .xmoze-job-search-form select',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'form_box_shadow',
                'label' => __('Box Shadow', 'xmoze-ts'),
                'selector' => '{{WRAPPER}} .xmoze-job-search-form input:not([type=submit]):not([type=radio]):not([type=checkbox]), .xmoze-job-search-form .nice-select, .xmoze-job-search-form select',
            ]
        );



        $this->add_responsive_control(
            'form_border_radius',
            [
                'label'      => __('Border Radius', 'xmoze-ts'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'default'    => [
                    'top'      => '0',
                    'right'    => '0',
                    'bottom'   => '0',
                    'left'     => '0',
                    'isLinked' => false
                ],
                'selectors'  => [
                    '{{WRAPPER}} .xmoze-job-search-form input:not([type=submit]):not([type=radio]):not([type=checkbox]), .xmoze-job-search-form .nice-select, .xmoze-job-search-form select' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'form_wrap_padding',
            [
                'label' => __('Wrap Padding', 'xmoze-ts'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .xmoze-job-search-form .input-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'form_wrap_margin',
            [
                'label' => __('Wrap Margin', 'xmoze-ts'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .xmoze-job-search-form .input-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'form_wrap_icon_padding',
            [
                'label' => __('Icon Padding', 'xmoze-ts'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .xmoze-job-search-form .input-wrap-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'form_wrap_icon_margin',
            [
                'label' => __('Icon Margin', 'xmoze-ts'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .xmoze-job-search-form .input-wrap-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'select_style',
            [
                'label' => __('Select Style', 'xmoze-ts'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'select_border',
                'label'    => __('Border', 'xmoze-ts'),
                'selector' => '{{WRAPPER}} .nice-select.xmoze-job-location',
            ]
        );


        $this->end_controls_section();
        $this->start_controls_section(
            'btn_style',
            [
                'label' => __('Button Style', 'xmoze-ts'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'label' => __('Typography', 'xmoze-ts'),
                'selector' => '{{WRAPPER}} .xmoze-job-search-form button[type=submit]',
            ]
        );

        $this->add_control(
            'button_color',
            [
                'label' => __('Color', 'xmoze-ts'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xmoze-job-search-form button[type=submit]' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'button_bg',
            [
                'label' => __('Background Color', 'xmoze-ts'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xmoze-job-search-form button[type=submit]' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(

            'button_width',
            [
                'label' => __('Width', 'xmoze-ts'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 600,

                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],

                'selectors' => [
                    '{{WRAPPER}} .xmoze-job-search-form button[type=submit]' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(

            'button_height',
            [
                'label' => __('Height', 'xmoze-ts'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 600,

                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],

                'selectors' => [
                    '{{WRAPPER}} .xmoze-job-search-form button[type=submit]' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'button_border',
                'label'    => __('Border', 'xmoze-ts'),
                'selector' => '{{WRAPPER}} .xmoze-job-search-form button[type=submit]',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_box_shadow',
                'label' => __('Box Shadow', 'xmoze-ts'),
                'selector' => '{{WRAPPER}} .xmoze-job-search-form button[type=submit]',
            ]
        );



        $this->add_responsive_control(
            'button_border_radius',
            [
                'label'      => __('Border Radius', 'xmoze-ts'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'default'    => [
                    'top'      => '0',
                    'right'    => '0',
                    'bottom'   => '0',
                    'left'     => '0',
                    'isLinked' => false
                ],
                'selectors'  => [
                    '{{WRAPPER}} .xmoze-job-search-form button[type=submit]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'button_padding',
            [
                'label' => __('Padding', 'xmoze-ts'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .xmoze-job-search-form button[type=submit]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'wrap_style',
            [
                'label' => __('Wrapper Style', 'xmoze-ts'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'field_align',
            [
                'label'     => __('Wrapper Align', 'fd-addons'),
                'type'      => \Elementor\Controls_Manager::CHOOSE,
                'options'   => [
                    'start'   => [
                        'title' => __('Left', 'fd-addons'),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'fd-addons'),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'end'  => [
                        'title' => __('Right', 'fd-addons'),
                        'icon'  => 'fa fa-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .xmoze-job-search-form-wrapper' => 'justify-content: {{VALUE}};',
                ],
                'toggle'    => true,
            ]
        );
        $this->add_responsive_control(
            'field_text_align',
            [
                'label'     => __('Content Align', 'fd-addons'),
                'type'      => \Elementor\Controls_Manager::CHOOSE,
                'options'   => [
                    'left'   => [
                        'title' => __('Left', 'fd-addons'),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'fd-addons'),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'right'  => [
                        'title' => __('Right', 'fd-addons'),
                        'icon'  => 'fa fa-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .xmoze-job-search-form-wrapper' => 'text-align: {{VALUE}};',
                ],
                'toggle'    => true,
            ]
        );

        $this->add_responsive_control(
            'wrap_width',
            [
                'label' => __('Width', 'xmoze-ts'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,

                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],

                'selectors' => [
                    '{{WRAPPER}} .xmoze-job-search-form' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'wrap_bg',
            [
                'label' => __('Background Color', 'xmoze-ts'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xmoze-job-search-form' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'wrap_border',
                'label'    => __('Wrap Border', 'xmoze-ts'),
                'selector' => '{{WRAPPER}} .xmoze-job-search-form',
            ]
        );

        $this->add_responsive_control(
            'wrap_border_radius',
            [
                'label'      => __('Border Radius', 'xmoze-ts'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'default'    => [
                    'top'      => '0',
                    'right'    => '0',
                    'bottom'   => '0',
                    'left'     => '0',
                    'isLinked' => false
                ],
                'selectors'  => [
                    '{{WRAPPER}} .xmoze-job-search-form' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'wrap_box_shadow',
                'label' => __('Box Shadow', 'xmoze-ts'),
                'selector' => '{{WRAPPER}} .xmoze-job-search-form',
            ]
        );



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
        $job_type = xmoze_cpt_taxonomy_slug_and_name(
            array(
                'taxonomy'          => 'job-type',
                'hide_empty'        => false,
            ),
            true
        );
        $job_location = xmoze_cpt_taxonomy_slug_and_name(
            array(
                'taxonomy'          => 'job-location',
                'hide_empty'        => false,
            ),
            true
        );
?>
        <div class="xmoze-job-search-form-wrapper d-flex align-items-center">
            <div class="xmoze-job-search-form">
                <form method="GET" action="<?php echo get_post_type_archive_link('job'); ?>">
                    <div class="input-wrap d-flex align-items-center justify-content-between">
                        <span class="input-wrap-icon"><?php \Elementor\Icons_Manager::render_icon($settings['input_icon'], ['aria-hidden' => 'true']); ?></span>
                        <input class="xmoze-job-search-input" type="search" name="search_key" id="search_key" placeholder="Job title or keyword">
                    </div>
                    <div class="input-wrap d-flex align-items-center justify-content-between">
                        <span class="input-wrap-icon"><?php \Elementor\Icons_Manager::render_icon($settings['select_icon'], ['aria-hidden' => 'true']); ?></span>
                        <select name="job-location" id="job-location" class="xmoze-job-location">
                            <option value=""><?php esc_html_e('Location', 'xmoze-ts') ?></option>
                            <?php if (!empty($job_location)) {
                                echo $job_location;
                            } ?>
                        </select>
                    </div>
                    <div class="input-wrap">
                        <button type="submit"><?php echo esc_html('Find Jobs'); ?></button>
                    </div>
                </form>
            </div>
        </div>
<?php
    }
}

$widgets_manager->register(new \xmozeJobSearch());
