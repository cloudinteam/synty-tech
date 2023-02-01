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
class Xmoze_StepBox extends \Elementor\Widget_Base
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
        return 'xmoze-stepbox';
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
        return __('Xmoze Step Box', 'xmoze-hp');
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
        return 'eicon-checkbox';
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

        $repeater = new \Elementor\Repeater();

        $repeater->start_controls_tabs('setp_box_tabs');

        $repeater->start_controls_tab('setp_box_tabs_item_content_tab', ['label' => __('Content', 'xmoze')]);

        $repeater->add_control(
            'title',
            [
                'label'       => __( 'Title', 'xmoze' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'content',
            [
                'label'       => __( 'Title', 'xmoze' ),
                'type'        => \Elementor\Controls_Manager::WYSIWYG,
                'label_block' => true,
            ]
        );


        $repeater->end_controls_tab();

        $repeater->start_controls_tab('setp_box_tabs_item_style_tab', ['label' => __('Style', 'xmoze')]);

        $repeater->add_control(
            'stepi_box_color',
            [
                'label'     => __('Color', 'xmoze-hp'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}  {{CURRENT_ITEM}}.xmoze-step-text-box span' => 'color: {{VALUE}}',
                ],
            ]
        );

        $repeater->add_control(
            'step_box_bg_color',
            [
                'label'     => __('Background Color', 'xmoze-hp'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}  {{CURRENT_ITEM}}.xmoze-step-text-box' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $repeater->add_control(
            'step_box_shape_color',
            [
                'label'     => __('Border Color', 'xmoze-hp'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}  {{CURRENT_ITEM}}.xmoze-step-single-item:after' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $repeater->end_controls_tab();
        $repeater->end_controls_tabs();

        // End Repeater Control field
        $this->add_control(
            'contents',
            [
                'label' => __( 'Repeater List', 'xmoze-hp' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '<# print(title.slice(0,1).toUpperCase() + title.slice(1)) #>',
                'default' => [
                    [
                        'title' =>   __('Market Research'),
                        'content' =>   __('Combined with a handful of model sentence structures looks reasonable.', 'xmoze-hp'),
                    ],
                ],
            ]
        );

        $this->end_controls_section();

        /*
        *Icon box
        */
        $this->start_controls_section('box_icon',
            [
                'label' => __('Icon Box', 'xmoze-hp'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'i_box_color',
            [
                'label'     => __('Color', 'xmoze-hp'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}  .xmoze-step-text-box span' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'i_box_bg_color',
            [
                'label'     => __('Background Color', 'xmoze-hp'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}  .xmoze-step-text-box' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'i_box_shape_color',
            [
                'label'     => __('Border Color', 'xmoze-hp'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}  .xmoze-step-single-item:after' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'i_box_typo',
                'label'    => __('Typography', 'xmoze-hp'),
                'selector' => '{{WRAPPER}}   .xmoze-step-text-box span',
            ]
        );
        $this->add_responsive_control(
            'sahpe_border_width',
            [
                'label'      => __( 'Border Width', 'xmoze-hp' ),
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
                    '{{WRAPPER}} .xmoze-step-single-item:after'=> 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'margin_right',
            [
                'label'      => __( 'Right Gap', 'xmoze-hp' ),
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
                    '{{WRAPPER}} .xmoze-step-text-box'=> 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'i_box_border_radius',
            [
                'label'      => __('Border Radius', 'xmoze-hp'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}}  .xmoze-step-text-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}}  .xmoze-step-text-box' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        /*
        *Title
        */
        $this->start_controls_section('box_Title',
            [
                'label' => __('Title', 'xmoze-hp'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label'     => __('Color', 'xmoze-hp'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}  .xmoze-setp-content .setp-headding' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typo',
                'label'    => __('Typography', 'xmoze-hp'),
                'selector' => '{{WRAPPER}}   .xmoze-setp-content .setp-headding',
            ]
        );
        $this->add_responsive_control(
            'title_margin',
            [
                'label'      => __('Margin', 'xmoze-hp'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}}  .xmoze-setp-content .setp-headding' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}}  .xmoze-setp-content .setp-headding' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'title_padding',
            [
                'label'      => __('Padding', 'xmoze-hp'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}}  .xmoze-setp-content .setp-headding' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}}  .xmoze-setp-content .setp-headding' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        /*
        *Discription
        */
        $this->start_controls_section('box_content',
            [
                'label' => __('Discription', 'xmoze-hp'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'dis_color',
            [
                'label'     => __('Color', 'xmoze-hp'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xmoze-setp-content p' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'dis_typo',
                'label'    => __('Typography', 'xmoze-hp'),
                'selector' => '{{WRAPPER}}  .xmoze-setp-content p',
            ]
        );
        $this->add_responsive_control(
            'dis_margin',
            [
                'label'      => __('Margin', 'xmoze-hp'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .xmoze-setp-content p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .xmoze-setp-content p' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'dis_padding',
            [
                'label'      => __('Padding', 'xmoze-hp'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .xmoze-setp-content p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .xmoze-setp-content p' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        /*
        *Box
        */
        $this->start_controls_section('box',
            [
                'label' => __('Box', 'xmoze-hp'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'box_padding',
            [
                'label'      => __('Padding', 'xmoze-hp'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .xmoze-step-single-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .xmoze-step-single-item' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
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
    $contents = $settings['contents'];
    $i = 0;

    ?>
     <div class="xmoze-step-icon-wraper">
            <!-- single item -->
            <?php foreach($contents as $content):
                $i++;
                ?>
                <div class="xmoze-step-single-item elementor-repeater-item-<?php echo esc_attr($content['_id']) ?>">
                    <div class="xmoze-step-text-box elementor-repeater-item-<?php echo esc_attr($content['_id']); ?>">
                        <span><?php echo esc_attr( $i ); ?></span>
                    </div>
                    <div class="xmoze-setp-content">
                        <h5 class="setp-headding"><?php echo esc_html( $content['title'] ) ?></h5>
                        <?php echo xmoze_get_meta($content['content']) ?>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>

    <?php


}
}


$widgets_manager->register(new \Xmoze_StepBox());