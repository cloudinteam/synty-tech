<?php
if ( !defined( 'ABSPATH' ) ) {
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
use Elementor\Icons_Manager;

class Xmoze_Services extends \Elementor\Widget_Base {
    /**
     * Retrieve the widget name.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'xmoze-service';
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
    public function get_title() {
        return __( 'Xmoze Services', 'xmoze-hp' );
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
    public function get_icon() {
        return 'eicon-settings';
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
    public function get_categories() {
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
    protected function register_controls() {

        $this->start_controls_section(
            'section_layout',
            [
                'label' => __( 'Layout', 'xmoze-hp' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'service_item_style',
            [
                'label'             => __( 'Service Style', 'xmoze-hp' ),
                'type'              =>  \Elementor\Controls_Manager::SELECT,
                'default'           => 'default',
                'options'           => [
                    'default'    =>   __('Default Style','xmoze-hp'),
                    'style-one'    =>   __('Style 01','xmoze-hp'),
                ],
                'separator' => 'after',
            ]
        );
        $this->add_control(
            'show_slider_settings',
            [
                'label' => __('Slider Active', 'finisys'),
                'type' =>  \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'finisys'),
                'label_off' => __('No', 'finisys'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_responsive_control('per_line', [
            'label'              => __('Columns Per row', 'xmoze-hp'),
            'type'               => \Elementor\Controls_Manager::SELECT,
            'default'            => '4 Column',
            'tablet_default'     => '6 Column',
            'mobile_default'     => '12 Column',
            'options'            => [
                '12' => '1',
                '6'  => '2',
                '4'  => '3',
                '3'  => '4',
            ],
            'frontend_available' => true,
        ]);

        $this->add_responsive_control(
            'column_gap',
            [
                'label'     => __( 'Column Gap', 'xmoze-hp' ),
                'type'      => \Elementor\Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .xmoze-service-widget-wrap' => 'padding: 0 {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'row_gap',
            [
                'label'     => __( 'Row Gap', 'xmoze-hp' ),
                'type'      => \Elementor\Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .xmoze-service-widget-wrap' => 'margin: 0 0 {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'section_content',
            [
                'label' => __( 'Content', 'xmoze-hp' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'show_excerpt',
            [
                'label'        => __( 'Show Excerpt', 'xmoze-hp' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => __( 'Show', 'xmoze-hp' ),
                'label_off'    => __( 'Hide', 'xmoze-hp' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );
        $this->add_control(
            'excerpt_limit',
            [
                'label'    => __( 'Excerpt Word Limit', 'xmoze-hp' ),
                'type'     => \Elementor\Controls_Manager::SLIDER,
                'range'    => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                ],
                'conditon' => [
                    'show_excerpt' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'show_title_icon',
            [
                'label' => __( 'Show Title Icon?', 'xmoze-hp' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'xmoze-hp' ),
                'label_off' => __( 'Hide', 'xmoze-hp' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'title_icon',
            [
                'label' => __( 'Title Icon', 'xmoze' ),
                'label_block' => false,
                'type' => \Elementor\Controls_Manager::ICONS,
                'skin' => 'inline',
                'default' => [
                    'value' => 'fas fa-arrow-right',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'show_title_icon' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'title_limit',
            [
                'label' => __( 'Title Word Limit', 'xmoze-hp' ),
                'type'  => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'section_query',
            [
                'label' => __( 'Query', 'xmoze-ts' ),
            ]
        );
        $this->add_control(
            'posts_per_page',
            [
                'label'   => __( 'Posts per page', 'xmoze-ts' ),
                'type'    => \Elementor\Controls_Manager::NUMBER,
                'default' => 5,
            ]
        );
        $this->add_control(
            'source',
            [
                'label'   => __( 'Source', 'xmoze-ts' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'service'          => 'Service',
                    'manual_selection' => 'Manual Selection',
                    'related'          => 'Related',
                ],
                'default' => 'service',
            ]
        );
        $this->add_control(
            'manual_selection',
            [
                'label'       => __( 'Manual Selection', 'xmoze-ts' ),
                'type'        => \Elementor\Controls_Manager::SELECT2,
                'description' => __( 'Get specific template posts', 'xmoze-ts' ),
                'label_block' => true,
                'multiple'    => true,
                'options'     => xmoze_cpt_slug_and_id( 'service' ),
                'default'     => [],
                'condition'   => [
                    'source' => 'manual_selection',
                ],
            ]
        );
        $this->start_controls_tabs(
            'include_exclude_tabs'
        );
        $this->start_controls_tab(
            'include_tabs',
            [
                'label'     => __( 'Include', 'xmoze-ts' ),
                'condition' => [
                    'source!' => 'manual_selection',
                ],
            ]
        );
        $this->add_control(
            'include_by',
            [
                'label'       => __( 'Include by', 'xmoze-ts' ),
                'type'        => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'multiple'    => true,
                'options'     => [
                    'tags'     => 'Tags',
                    'category' => 'Category',
                    'author'   => 'Author',
                ],
                'default'     => [],
                'condition'   => [
                    'source!' => 'manual_selection',
                ],
            ]
        );
        $this->add_control(
            'include_categories',
            [
                'label'       => __( 'Include categories', 'xmoze-ts' ),
                'type'        => \Elementor\Controls_Manager::SELECT2,
                'description' => __( 'Get templates for specific category(s)', 'xmoze-ts' ),
                'label_block' => true,
                'multiple'    => true,
                'options'     => xmoze_cpt_taxonomy_slug_and_name( 'service-category' ),
                'default'     => [],
                'condition'   => [
                    'include_by' => 'category',
                    'source!'    => 'related',
                ],
            ]
        );
        $this->add_control(
            'include_tags',
            [
                'label'       => __( 'Include Tags', 'xmoze-ts' ),
                'type'        => \Elementor\Controls_Manager::SELECT2,
                'description' => __( 'Get templates for specific tag(s)', 'xmoze-ts' ),
                'label_block' => true,
                'multiple'    => true,
                'options'     => xmoze_cpt_taxonomy_slug_and_name( 'service-tag' ),
                'default'     => [],
                'condition'   => [
                    'include_by' => 'tags',
                    'source!'    => 'related',
                ],
            ]
        );
        $this->add_control(
            'include_authors',
            [
                'label'       => __( 'Include authors', 'xmoze-ts' ),
                'type'        => \Elementor\Controls_Manager::SELECT2,
                'description' => __( 'Get templates for specific tag(s)', 'xmoze-ts' ),
                'label_block' => true,
                'multiple'    => true,
                'options'     => xmoze_cpt_author_slug_and_id( 'service' ),
                'default'     => [],
                'condition'   => [
                    'include_by' => 'author',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'exclude_tabs',
            [
                'label'     => __( 'Exclude', 'xmoze-ts' ),
                'condition' => [
                    'source!' => 'manual_selection',
                ],
            ]
        );
        $this->add_control(
            'exclude_by',
            [
                'label'       => __( 'Exclude by', 'xmoze-ts' ),
                'type'        => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'multiple'    => true,
                'options'     => [
                    'tags'         => 'tags',
                    'category'     => 'Category',
                    'author'       => 'Author',
                    'current_post' => 'Current Post',
                ],
                'default'     => [],
                'condition'   => [
                    'source!' => 'manual_selection',
                ],
            ]
        );
        $this->add_control(
            'exclude_categories',
            [
                'label'       => __( 'Exclude categories', 'xmoze-ts' ),
                'type'        => \Elementor\Controls_Manager::SELECT2,
                'description' => __( 'Get templates for specific category(s)', 'xmoze-ts' ),
                'label_block' => true,
                'multiple'    => true,
                'options'     => xmoze_cpt_taxonomy_slug_and_name( 'service-category' ),
                'default'     => [],
                'condition'   => [
                    'exclude_by' => 'category',
                    'source!'    => 'related',
                ],
            ]
        );
        $this->add_control(
            'exclude_tags',
            [
                'label'       => __( 'Exclude Tags', 'xmoze-ts' ),
                'type'        => \Elementor\Controls_Manager::SELECT2,
                'description' => __( 'Get templates for specific tag(s)', 'xmoze-ts' ),
                'label_block' => true,
                'multiple'    => true,
                'options'     => xmoze_cpt_taxonomy_slug_and_name( 'service-tag' ),
                'default'     => [],
                'condition'   => [
                    'exclude_by' => 'tags',
                    'source!'    => 'related',
                ],
            ]
        );
        $this->add_control(
            'exclude_authors',
            [
                'label'       => __( 'Exclude authors', 'xmoze-ts' ),
                'type'        => \Elementor\Controls_Manager::SELECT2,
                'description' => __( 'Get templates for specific tag(s)', 'xmoze-ts' ),
                'label_block' => true,
                'multiple'    => true,
                'options'     => xmoze_cpt_author_slug_and_id( 'service' ),
                'default'     => [],
                'condition'   => [
                    'exclude_by' => 'author',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->add_control(
            'orderby',
            [
                'label'   => __( 'Order By', 'xmoze-ts' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'date'       => 'Date',
                    'title'      => 'title',
                    'menu_order' => 'Menu Order',
                    'rand'       => 'Random',
                ],
                'default' => 'date',
            ]
        );
        $this->add_control(
            'order',
            [
                'label'   => __( 'Order', 'xmoze-ts' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'ASC'  => 'ASC',
                    'DESC' => 'DESC',
                ],
                'default' => 'DESC',
            ]
        );
        $this->end_controls_section();



        $this->start_controls_section(
            'section_btn',
            [
                'label' => __('Readmore', 'xmoze-hp'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'show_readmore',
            [
                'label' => __('Readmore button', 'xmoze-hp'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'xmoze-hp'),
                'label_off' => __('Hide', 'xmoze-hp'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'readmore_text',
            [
                'label' => __('Readmore text', 'xmoze-hp'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('READ MORE', 'xmoze-hp'),
                'conditon' => [
                    'show_readmore' => 'yes',
                ]
            ]
        );
        $this->add_control(
            'icon',
            [
                'label' => __('Icon', 'xmoze-hp'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'conditon' => [
                    'show_readmore' => 'yes',
                ]
            ]
        );
        $this->add_control(
            'icon_position',
            [
                'label' => __('Icon Position', 'xmoze-hp'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'after',
                'options' => [
                    'before' => __('Before', 'xmoze-hp'),
                    'after' => __('After', 'xmoze-hp'),
                ],
                'conditon' => [
                    'show_readmore' => 'yes',
                ]
            ]
        );
        $this->add_responsive_control(
            'button_align',
            [
                'label' => __('Align', 'xmoze-hp'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => __('Left', 'xmoze-hp'),
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
                'devices' => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .service-btn-wrap' => 'text-align:{{UNIT}};'
                ],
                'toggle' => true,
            ]
        );
        $this->end_controls_section();



        $this->start_controls_section(
            'section_image_style',
            [
                'label' => __( 'Image', 'xmoze-hp' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'service_item_style' => 'default',
                ],
            ]
        );
        $this->start_controls_tabs(
            'image_hover_tabs'
        );
        $this->start_controls_tab(
            'image_normal_tab',
            [
                'label' => __( 'Normal', 'xmoze-hp' ),
            ]
        );

        $this->add_responsive_control(
            'width',
            [
                'label'          => __('Width', 'xmoze-hp'),
                'type'           => \Elementor\Controls_Manager::SLIDER,
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
                    '{{WRAPPER}} .service-thumbnail-wrapper img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'space',
            [
                'label'          => __('Max Width', 'xmoze-hp'),
                'type'           => \Elementor\Controls_Manager::SLIDER,
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
                    '{{WRAPPER}} .service-thumbnail-wrapper img' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'height',
            [
                'label'          => __('Height', 'xmoze-hp'),
                'type'           => \Elementor\Controls_Manager::SLIDER,
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
                    '{{WRAPPER}} .service-thumbnail-wrapper img' => 'height: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );
        $this->add_responsive_control(
            'object-fit',
            [
                'label'     => __('Object Fit', 'xmoze-hp'),
                'type'      => \Elementor\Controls_Manager::SELECT,
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
                    '{{WRAPPER}} .service-thumbnail-wrapper img' => 'object-fit: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'image_gap',
            [
                'label'      => __( 'Image Gap', 'xmoze-hp' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .service-thumbnail-wrapper img ' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'      => 'image_border',
                'selector'  => '{{WRAPPER}} .service-thumbnail-wrapper img',
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'image_box_',
            [
                'label'      => __('Border Radius', 'xmoze-hp'),
                'type'       =>  \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .service-thumbnail-wrapper img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .service-thumbnail-wrapper img' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'image_box_shadow',
                'exclude'  => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .service-thumbnail-wrapper img',
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'style_hover_tab',
            [
                'label' => __( 'Hover', 'xmoze-hp' ),
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'image_shadow_hover',
                'label'    => __( 'Image Shadow', 'xmoze-hp' ),
                'selector' => '{{WRAPPER}}:hover .service-thumbnail-wrapper img',
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        // Titile
        $this->start_controls_section(
            'service_title_style',
            [
                'label' => __( 'Title', 'xmoze-hp' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs(
            'titlle_style_tabs'
        );

        $this->start_controls_tab(
            'title_style_normal_tab',
            [
                'label' => __( 'Normal', 'xmoze-hp' ),
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => __( 'Title Color', 'xmoze-hp' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xmoze-service-widget-item .service-content h3' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'heading_typography',
                'label'    => __( 'Title Typography', 'xmoze-hp' ),
                'selector' => '{{WRAPPER}} .xmoze-service-widget-item .service-content h3',
            ]
        );

        $this->add_responsive_control(
            'title_margin',
            [
                'label'      => __( 'Title Margin', 'xmoze-hp' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .xmoze-service-widget-item .service-content h3'          => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .xmoze-service-widget-item .service-content h3' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'title_padding',
            [
                'label'      => __( 'Title Padding', 'xmoze-hp' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .xmoze-service-widget-item .service-content h3'          => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .xmoze-service-widget-item .service-content h3' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();

        // Hover
        $this->start_controls_tab(
            'title_style_hover_tab',
            [
                'label' => __( 'Normal', 'xmoze-hp' ),
            ]
        );
        $this->add_control(
            'title_hover_color',
            [
                'label'     => __( 'Title Color', 'xmoze-hp' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xmoze-service-widget-item:hover .service-content h3' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        // Content
        $this->start_controls_section(
            'content_style',
            [
                'label' => __( 'Content', 'xmoze-hp' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs(
            'content_style_tabs'
        );
        $this->start_controls_tab(
            'content_style_normal_tab',
            [
                'label' => __( 'Normal', 'xmoze-hp' ),
            ]
        );

        $this->add_control(
            'excerpt_color',
            [
                'label'     => __( 'Excerpt Color', 'xmoze-hp' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xmoze-service-widget-item .service-content p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'excerpt_typ',
                'label'    => __( 'Excerpt Typography', 'xmoze-hp' ),
                'selector' => '{{WRAPPER}} .xmoze-service-widget-item .service-content p',
            ]
        );

        $this->add_responsive_control(
            'content_margin',
            [
                'label'      => __( 'Content Margin', 'xmoze-hp' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .xmoze-service-widget-item .service-content p'          => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .xmoze-service-widget-item .service-content p' => 'margin:
                    {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'content_box_padding',
            [
                'label'      => __( 'Content Box Padding', 'xmoze-hp' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .xmoze-service-widget-item .service-content'          => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .xmoze-service-widget-item .service-content' => 'padding:
                    {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->start_controls_tab(
            'content_style_hover_tab',
            [
                'label' => __( 'Hover', 'xmoze-hp' ),
            ]
        );
        $this->add_control(
            'excerpt_hover_color',
            [
                'label'     => __( 'Excerpt Color', 'xmoze-hp' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xmoze-service-widget-item:hover p' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();


        $this->start_controls_section(
            'button_style',
            [
                'label' => __('Button', 'xmoze-hp'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_readmore' => 'yes',
                ]
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'btn_typography',
                'label' => __('Button Typography', 'xmoze-hp'),
                'selector' => '{{WRAPPER}} .service-btn',
            ]
        );

        $this->start_controls_tabs(
            'button_style_tabs'
        );

        $this->start_controls_tab(
            'button_style_normal_tab',
            [
                'label' => __('Normal', 'xmoze-hp'),
            ]
        );
        $this->add_control(
            'icon_color',
            [
                'label' => __('Icon Color', 'xmoze-hp'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service-btn .btn-icon' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .service-btn .btn-icon path' => 'stroke: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'icon_fill_color',
            [
                'label' => __('Icon Fill Color', 'xmoze-hp'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service-btn .btn-icon path' => 'fill: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'boxed_btn_color',
            [
                'label' => __('Button Color', 'xmoze-hp'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service-btn' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'boxed_btn_background',
            [
                'label' => __('Background Color', 'xmoze-hp'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service-btn' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'button_border',
                'label' => __('Border', 'xmoze-hp'),
                'selector' => '{{WRAPPER}} .service-btn',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_shadow',
                'label' => __('Button Shadow', 'xmoze-hp'),
                'selector' => '{{WRAPPER}} .service-btn',
            ]
        );
        $this->add_responsive_control(
            'button_radius',
            [
                'label' => __('Border Radius', 'xmoze-hp'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .service-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .service-btn' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'icon_gap',
            [
                'label' => __('Icon gap', 'xmoze-hp'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .service-btn .icon-before, body.rtl {{WRAPPER}} .service-btn .icon-after ' => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .service-btn .icon-after , body.rtl  {{WRAPPER}} .service-btn .icon-before' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'icon_size',
            [
                'label' => __('Icon Size', 'xmoze-hp'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .xmoze-service-widget-item .service-btn .btn-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .xmoze-service-widget-item .service-btn .btn-icon svg' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'button_padding',
            [
                'label' => __('Button Padding', 'xmoze-hp'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .service-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .service-btn' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'button_style_hover_tab',
            [
                'label' => __('Hover', 'xmoze-hp'),
            ]
        );
        $this->add_control(
            'icon_hover_color',
            [
                'label' => __('Icon Color', 'xmoze-hp'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xmoze-service-widget-item:hover .service-btn .btn-icon' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .xmoze-service-widget-item:hover .service-btn .btn-icon path' => 'stroke: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'icon_fill_color_hover',
            [
                'label' => __('Icon Fill Color', 'xmoze-hp'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xmoze-service-widget-item:hover .service-btn .btn-icon path' => 'fill: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'btn_hover_color',
            [
                'label' => __('Button Color', 'xmoze-hp'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xmoze-service-widget-item:hover .service-btn' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'btn_hover_background',
            [
                'label' => __('Background Color', 'xmoze-hp'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xmoze-service-widget-item:hover .service-btn' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'button_hover_border',
                'label' => __('Border', 'xmoze-hp'),
                'selector' => '{{WRAPPER}} .service-btn:hover',
            ]
        );
        $this->add_control(
            'btn_hover_animation',
            [
                'label' => __('Hover Animation', 'xmoze-hp'),
                'type' => \Elementor\Controls_Manager::HOVER_ANIMATION,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_hover_shadow',
                'label' => __('Button Shadow', 'xmoze-hp'),
                'selector' => '{{WRAPPER}} .service-btn:hover',
            ]
        );
        $this->add_responsive_control(
            'button_hover_radius',
            [
                'label' => __('Border Radius', 'xmoze-hp'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .service-btn:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .service-btn:hover' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'icon_hover_gap',
            [
                'label' => __('Icon gap', 'xmoze-hp'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .service-btn:hover .icon-before' => 'transform: translatex( -{{SIZE}}{{UNIT}} );',
                    '{{WRAPPER}} .service-btn:hover .icon-after ' => 'transform: translatex( {{SIZE}}{{UNIT}} );',
                    'body.rtl {{WRAPPER}} .service-btn:hover .icon-before' => 'transform: translatex( {{SIZE}}{{UNIT}} );',
                    'body.rtl {{WRAPPER}} .service-btn:hover .icon-after ' => 'transform: translatex( -{{SIZE}}{{UNIT}} );',
                ],
            ]
        );
        $this->add_responsive_control(
            'title_hover_icon_size',
            [
                'label' => __('Hover Icon size', 'xmoze-hp'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'devices' => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .xmoze-service-widget-item:hover .service-btn .btn-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .xmoze-hp-button:hover svg' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'button_hover_padding',
            [
                'label' => __('Button Padding', 'xmoze-hp'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .xmoze-service-widget-item:hover .service-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .xmoze-service-widget-item:hover .service-btn' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();


        /*Box style*/
        $this->start_controls_section(
            'section_content_box_style',
            [
                'label' => __( 'Box', 'xmoze-hp' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs(
            'box_style_tabs'
        );
        $this->start_controls_tab(
            'box_style_normal_tab',
            [
                'label' => __( 'Normal', 'xmoze-hp' ),
            ]
        );
        $this->add_control(
            'box_bg_color',
            [
                'label'     => __( 'Box Backgroound Color', 'xmoze-hp' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xmoze-service-widget-item' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'box_shadow',
                'label'    => __( 'Box Hover Shadow', 'xmoze-hp' ),
                'selector' => '{{WRAPPER}} .xmoze-service-widget-item',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'box_border',
                'label'    => __( 'Box Border', '' ),
                'selector' => '{{WRAPPER}} .xmoze-service-widget-item',
            ]
        );
        $this->add_responsive_control(
            'box_radius',
            [
                'label'      => __( 'Box Radius', 'xmoze-hp' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .xmoze-service-widget-item'          => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'box_padding',
            [
                'label'      => __( 'Box Padding', 'xmoze-hp' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .xmoze-service-widget-item '          => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'box_style_hover_tab',
            [
                'label' => __( 'Hover', 'xmoze-hp' ),
            ]
        );
        $this->add_control(
            'ser_box_hover_bg_color',
            [
                'label'     => __( 'Box Background Color', 'xmoze-hp' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'defautl'   => '#233aff',
                'selectors' => [
                    '{{WRAPPER}} .xmoze-service-widget-item:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'box_hover_bg',
                'label' => __( 'Background', 'xmoze-hp' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} .xmoze-service-widget-item:hover',
            ]
        );

        $this->add_responsive_control(
            'box_hover_radius',
            [
                'label'      => __( 'Box Radius', 'xmoze-hp' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .xmoze-service-widget-item:hover'          => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'box_hover_shadow',
                'label'    => __( 'Box Hover Shadow', 'xmoze-hp' ),
                'selector' => '{{WRAPPER}} .xmoze-service-widget-item:hover',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'box_hover_border',
                'label'    => __( 'Box Border', '' ),
                'selector' => '{{WRAPPER}} .xmoze-service-widget-item:hover ',
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
    protected function render() {

        $settings = $this->get_settings();
        $services_style = $settings['service_item_style'];

        /* Gride Class */
        $grid_classes = [];
        $grid_classes[] = 'col-xl-' . $settings['per_line'];
        $grid_classes[] = 'col-md-' . $settings['per_line_tablet'];
        $grid_classes[] = 'col-sm-' . $settings['per_line_mobile'];
        $grid_classes = implode(' ', $grid_classes);
        $this->add_render_attribute('service_gride_classes', 'class', [$grid_classes, 'xmoze-service-widget-wrap col-lg-6']);

        $custom_css        = '';
        $paged              = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
        $include_categories = array();
        $exclude_tags       = array();
        $include_tags       = array();
        $include_authors    = array();
        $exclude_categories = array();
        $exclude_authors    = array();
        $is_include_cat    = in_array( 'category', $settings['include_by'] );
        $is_include_tag    = in_array( 'tags', $settings['include_by'] );
        $is_include_author = in_array( 'author', $settings['include_by'] );
        $is_exclude_cat    = in_array( 'category', $settings['exclude_by'], );
        $is_exclude_tag    = in_array( 'tags', $settings['exclude_by'] );
        $is_exclude_author = in_array( 'author', $settings['exclude_by'] );
        $current_post_id = '';

        if ( 0 != count( $settings['include_categories'] ) ) {
            $include_categories['tax_query'] = [
                'taxonomy' => 'service-category',
                'field'    => 'slug',
                'terms'    => $settings['include_categories'],
            ];
        }
        if ( 0 != count( $settings['include_tags'] ) ) {
            $include_tags = implode( ',', $settings['include_tags'] );
        }
        if ( 0 != count( $settings['include_authors'] ) ) {
            $include_authors = implode( ',', $settings['include_authors'] );
        }
        if ( 0 != count( $settings['exclude_categories'] ) ) {
            $exclude_categories['tax_query'] = [
                'taxonomy' => 'service-category',
                'operator' => 'NOT IN',
                'field'    => 'slug',
                'terms'    => $settings['exclude_categories'],
            ];
        }
        if ( 0 != count( $settings['exclude_tags'] ) ) {
            $exclude_tags['tax_query'] = [
                'taxonomy' => 'service-tag',
                'operator' => 'NOT IN',
                'field'    => 'slug',
                'terms'    => $settings['exclude_tags'],
            ];
        }
        if ( 0 != count( $settings['exclude_authors'] ) ) {
            $exclude_authors = implode( ',', $settings['exclude_authors'] );
        }
        if ( in_array( 'current_post', $settings['exclude_by'] ) && is_single() && 'portfolio' == get_post_type() ) {
            $current_post_id = get_the_ID();
        }
       // var_dump($settings['exclude_categories']);
        if ( 'related' == $settings['source'] && is_single() && 'portfolio' == get_post_type() ) {
            $related_categories = get_the_terms( get_the_ID(), 'service-category' );
            $related_cats       = [];
            if ( $related_categories ) {
                foreach ( $related_categories as $related_cat ) {
                    $related_cats[] = $related_cat->slug;
                }
            }
            $the_query = new WP_Query( array(
                'posts_per_page' => $settings['posts_per_page'],
                'post_type'      => 'service',
                'orderby'        => $settings['orderby'],
                'order'          => $settings['order'],
                'post__not_in'   => array( $current_post_id ),
                'paged'          => $paged,
                'tax_query'      => array(
                    array(
                        'taxonomy' => 'service-category',
                        'operator' => 'IN',
                        'field'    => 'slug',
                        'terms'    => $related_cats,
                    ),
                ),
            ) );
        } elseif ( 'manual_selection' == $settings['source'] ) {
            $the_query = new WP_Query( array(
                'posts_per_page' => $settings['posts_per_page'],
                'post_type'      => 'service',
                'orderby'        => $settings['orderby'],
                'order'          => $settings['order'],
                'paged'          => $paged,
                'post__in'       => ( 0 != count( $settings['manual_selection'] ) ) ? $settings['manual_selection'] : array(),
            ) );
        } else {
            $the_query = new WP_Query( array(
                'posts_per_page' => $settings['posts_per_page'],
                'post_type'      => 'service',
                'orderby'        => $settings['orderby'],
                'order'          => $settings['order'],
                'paged'          => $paged,
                'service-tag'    => ( $is_include_tag && 0 != count( $settings['include_tags'] ) ) ? $include_tags : '',
                'post__not_in'   => array( $current_post_id ),
                'author'         => ( $is_include_author && 0 != count( $settings['include_authors'] ) ) ? $include_authors : '',
                'author__not_in' => ( $is_exclude_author && 0 != count( $settings['exclude_authors'] ) ) ? $exclude_authors : '',
                'tax_query'      => array(
                    'relation' => 'AND',
                    ( $is_exclude_tag && 0 != count( $settings['exclude_tags'] ) ) ? $exclude_tags : '',
                    ( $is_exclude_cat && 0 != count( $settings['exclude_categories'] ) ) ? $exclude_categories : '',
                    ( $is_include_cat && 0 != count( $settings['include_categories'] ) ) ? $include_categories : '',
                ),
            ) );
        }



        $this->add_render_attribute('services_version', 'class', array( $services_style, 'row justify-content-center'));


        ?>
<?php if ( $the_query->have_posts() ): ?>
    <div <?php echo $this->get_render_attribute_string('services_version'); ?>>
        <?php while ( $the_query->have_posts() ): $the_query->the_post();?>
			        <?php
            $idd        = get_the_ID();
            $excerpt    = ( $settings['excerpt_limit']['size'] ) ? wp_trim_words( get_the_excerpt(), $settings['excerpt_limit']['size'], '...' ) : get_the_excerpt();
            $title      = ( $settings['title_limit']['size'] ) ? wp_trim_words( get_the_title(), $settings['title_limit']['size'], ' ' ) : get_the_title();

            ?>
			<!-- /.style inlcude -->
            <div <?php echo $this->get_render_attribute_string('service_gride_classes'); ?>>
                <?php
                    if ($services_style) {
                        include('Services/'.$services_style.'.php');
                    }
                ?>

            </div>

        <?php endwhile; wp_reset_postdata();?> </div>
    <?php endif; ?>

<?php

    }
}
$widgets_manager->register( new \Xmoze_Services() );