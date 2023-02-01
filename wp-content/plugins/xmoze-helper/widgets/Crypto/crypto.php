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



class Xmoze_Crypto extends \Elementor\Widget_Base {

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

        return 'xmoze-crypto';

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

        return __( 'Xmoze Crypto', 'xmoze-hp' );

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

        return 'eicon-meetup';

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

                    '{{WRAPPER}} .xmoze-crypto-widget-wrap' => 'padding: 0 {{SIZE}}{{UNIT}};',

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

                    '{{WRAPPER}} .xmoze-crypto-widget-wrap' => 'margin: 0 0 {{SIZE}}{{UNIT}};',

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

                    'crypto'          => 'Service',

                    'manual_selection' => 'Manual Selection',

                    'related'          => 'Related',

                ],

                'default' => 'crypto',

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

                'options'     => xmoze_cpt_slug_and_id( 'crypto' ),

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

                'options'     => xmoze_cpt_taxonomy_slug_and_name( 'crypto-category' ),

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

                'options'     => xmoze_cpt_taxonomy_slug_and_name( 'crypto-tag' ),

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

                'options'     => xmoze_cpt_author_slug_and_id( 'crypto' ),

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

                'options'     => xmoze_cpt_taxonomy_slug_and_name( 'crypto-category' ),

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

                'options'     => xmoze_cpt_taxonomy_slug_and_name( 'crypto-tag' ),

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

                'options'     => xmoze_cpt_author_slug_and_id( 'crypto' ),

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



            //Slider Setting

    $this->start_controls_section('slider_settings',

    [

    'label' => __('Slider Settings', 'xmoze-hp'),

    'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,

    'condition' => [

            'show_slider_settings' => 'yes',

        ]

    ]

);

$this->add_responsive_control(

    'per_coulmn',

    [

        'label' => __( 'Slider Items', 'xmoze-hp' ),

        'type' => \Elementor\Controls_Manager::SELECT,

        'default'            => 4,

        'tablet_default'     => 2,

        'mobile_default'     => 1,

        'options'            => [

            '1' => '1',

            '2' => '2',

            '3' => '3',

            '4' => '4',

            '5' => '5',

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

        'condition' => [

            'arrows' => 'yes',

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

        'condition' => [

            'arrows' => 'yes',

        ],

    ]

);

    $this->end_controls_section();



        $this->start_controls_section(

            'section_image_style',

            [

                'label' => __( 'Image', 'xmoze-hp' ),

                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,

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

                    '{{WRAPPER}} .crypto-thumbnail-wrapper img' => 'width: {{SIZE}}{{UNIT}};',

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

                    '{{WRAPPER}} .crypto-thumbnail-wrapper img' => 'max-width: {{SIZE}}{{UNIT}};',

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

                    '{{WRAPPER}} .crypto-thumbnail-wrapper img' => 'height: {{SIZE}}{{UNIT}} !important;',

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

                    '{{WRAPPER}} .crypto-thumbnail-wrapper img' => 'object-fit: {{VALUE}};',

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

                    '{{WRAPPER}} .crypto-thumbnail-wrapper img ' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                ],

            ]

        );



        $this->add_group_control(

            \Elementor\Group_Control_Border::get_type(),

            [

                'name'      => 'image_border',

                'selector'  => '{{WRAPPER}} .crypto-thumbnail-wrapper img',

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

                    '{{WRAPPER}} .crypto-thumbnail-wrapper img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                    'body.rtl {{WRAPPER}} .crypto-thumbnail-wrapper img' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',

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

                'selector' => '{{WRAPPER}} .crypto-thumbnail-wrapper img',

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

                'selector' => '{{WRAPPER}}:hover .crypto-thumbnail-wrapper img',

            ]

        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();



        // Titile

        $this->start_controls_section(

            'crypto_title_style',

            [

                'label' => __( 'Title', 'xmoze-hp' ),

                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,

            ]

        );



        $this->add_control(

            'title_color',

            [

                'label'     => __( 'Title Color', 'xmoze-hp' ),

                'type'      => \Elementor\Controls_Manager::COLOR,

                'selectors' => [

                    '{{WRAPPER}} .xmoze-crypto-top-content h3' => 'color: {{VALUE}}',

                ],

            ]

        );



        $this->add_group_control(

            \Elementor\Group_Control_Typography::get_type(),

            [

                'name'     => 'heading_typography',

                'label'    => __( 'Title Typography', 'xmoze-hp' ),

                'selector' => '{{WRAPPER}} .xmoze-crypto-top-content h3',

            ]

        );



        $this->add_responsive_control(

            'title_padding',

            [

                'label'      => __( 'Title Padding', 'xmoze-hp' ),

                'type'       => \Elementor\Controls_Manager::DIMENSIONS,

                'size_units' => ['px', 'em', '%'],

                'selectors'  => [

                    '{{WRAPPER}} .xmoze-crypto-top-content h3'          => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                    'body.rtl {{WRAPPER}} .xmoze-crypto-top-content h3' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',

                ],

            ]

        );



        $this->add_responsive_control(

            'title_margin',

            [

                'label'      => __( 'Title Margin', 'xmoze-hp' ),

                'type'       => \Elementor\Controls_Manager::DIMENSIONS,

                'size_units' => ['px', 'em', '%'],

                'selectors'  => [

                    '{{WRAPPER}} .xmoze-crypto-top-content h3'          => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                    'body.rtl {{WRAPPER}} .xmoze-crypto-top-content h3' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',

                ],

            ]

        );

        $this->end_controls_section();



        /*

        Sub-Heading

        */

        $this->start_controls_section(

            'section_subheading_style',

            [

                'label' => __( 'Sub Heading', 'xmoze-hp' ),

                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,

            ]

        );



        $this->add_group_control(

            \Elementor\Group_Control_Typography::get_type(),

            [

                'name'     => 'subheading_typography',

                'label'    => __( 'Typography', 'xmoze-hp' ),

                'selector' => '{{WRAPPER}} .xmoze-crypto-heading',

            ]

        );



        $this->add_control(

            'shubheading_color',

            [

                'label'     => __( 'Color', 'xmoze-hp' ),

                'type'      => \Elementor\Controls_Manager::COLOR,

                'selectors' => [

                    '{{WRAPPER}} .xmoze-crypto-heading' => 'color: {{VALUE}}',

                ],

            ]

        );

        $this->add_responsive_control(

            'subheading_padding',

            [

                'label'      => __( 'Padding', 'xmoze-hp' ),

                'type'       => \Elementor\Controls_Manager::DIMENSIONS,

                'size_units' => ['px', 'em', '%'],

                'selectors'  => [

                    '{{WRAPPER}} .xmoze-crypto-heading' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                ],

            ]

        );

        $this->add_responsive_control(

            'subheading_margin',

            [

                'label'      => __( 'Margin', 'xmoze-hp' ),

                'type'       => \Elementor\Controls_Manager::DIMENSIONS,

                'size_units' => ['px', 'em', '%'],

                'selectors'  => [

                    '{{WRAPPER}} .xmoze-crypto-heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                ],

            ]

        );



        $this->end_controls_section();

        /*

        Sub-heading End

        */



        // Content

        $this->start_controls_section(

            'content_price',

            [

                'label' => __( 'Price', 'xmoze-hp' ),

                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,

            ]

        );



        $this->add_group_control(

            \Elementor\Group_Control_Typography::get_type(),

            [

                'name'     => 'price_typography',

                'label'    => __( 'Typography', 'xmoze-hp' ),

                'selector' => '{{WRAPPER}} .xmoze-crypto-price',

            ]

        );



        $this->add_control(

            'price_color',

            [

                'label'     => __( 'Color', 'xmoze-hp' ),

                'type'      => \Elementor\Controls_Manager::COLOR,

                'selectors' => [

                    '{{WRAPPER}} .xmoze-crypto-price' => 'color: {{VALUE}}',

                ],

            ]

        );

        $this->add_responsive_control(

            'price_padding',

            [

                'label'      => __( 'Padding', 'xmoze-hp' ),

                'type'       => \Elementor\Controls_Manager::DIMENSIONS,

                'size_units' => ['px', 'em', '%'],

                'selectors'  => [

                    '{{WRAPPER}} .xmoze-crypto-price' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                ],

            ]

        );

        $this->add_responsive_control(

            'price_margin',

            [

                'label'      => __( 'Margin', 'xmoze-hp' ),

                'type'       => \Elementor\Controls_Manager::DIMENSIONS,

                'size_units' => ['px', 'em', '%'],

                'selectors'  => [

                    '{{WRAPPER}} .xmoze-crypto-price' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                ],

            ]

        );

        $this->end_controls_section();



        // Content

        $this->start_controls_section(

            'button',

            [

                'label' => __( 'Button', 'xmoze-hp' ),

                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,

            ]

        );

        $this->start_controls_tabs('_tabs_button');



        $this->start_controls_tab(

            '_tab_button_normal',

            [

                'label' => __('Normal', 'xmoze-hp'),

            ]

        );

        $this->add_group_control(

            \Elementor\Group_Control_Typography::get_type(),

            [

                'name'     => 'button_typography',

                'label'    => __( 'Typography', 'xmoze-hp' ),

                'selector' => '{{WRAPPER}} .xmoze-crypto-button',

            ]

        );



        $this->add_control(

            'button_color',

            [

                'label'     => __( 'Color', 'xmoze-hp' ),

                'type'      => \Elementor\Controls_Manager::COLOR,

                'selectors' => [

                    '{{WRAPPER}} .xmoze-crypto-button' => 'color: {{VALUE}}',

                ],

            ]

        );

        $this->add_group_control(

            \Elementor\Group_Control_Box_Shadow::get_type(),

            [

                'name' => 'button_shadow',

                'label' => __('Shadow', 'xmoze-hp'),

                'selector' => '{{WRAPPER}} .xmoze-crypto-button',

            ]

        );

        $this->add_group_control(

            \Elementor\Group_Control_Border::get_type(),

            [

                'name'     => 'button_border',

                'label'    => __( 'Border', 'xmoze-hp' ),

                'selector' => '{{WRAPPER}} .xmoze-crypto-button',

            ]

        );

        $this->add_responsive_control(

            'button_border_radius',

            [

                'label'      => __( 'Border Radius', 'xmoze-hp' ),

                'type'       => \Elementor\Controls_Manager::DIMENSIONS,

                'size_units' => ['px', 'em', '%'],

                'selectors'  => [

                    '{{WRAPPER}} .xmoze-crypto-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                ],

            ]

        );

        $this->add_responsive_control(

            'button_padding',

            [

                'label'      => __( 'Padding', 'xmoze-hp' ),

                'type'       => \Elementor\Controls_Manager::DIMENSIONS,

                'size_units' => ['px', 'em', '%'],

                'selectors'  => [

                    '{{WRAPPER}} .xmoze-crypto-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                ],

            ]

        );

        $this->add_responsive_control(

            'button_margin',

            [

                'label'      => __( 'Margin', 'xmoze-hp' ),

                'type'       => \Elementor\Controls_Manager::DIMENSIONS,

                'size_units' => ['px', 'em', '%'],

                'selectors'  => [

                    '{{WRAPPER}} .xmoze-crypto-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                ],

            ]

        );

        $this->end_controls_tab();



        // Button Hover

        $this->start_controls_tab(

            '_tab_button_hover',

            [

                'label' => __('Hover', 'xmoze-hp'),

            ]

        );

        $this->add_group_control(

            \Elementor\Group_Control_Typography::get_type(),

            [

                'name'     => 'button_typography_hover',

                'label'    => __( 'Typography', 'xmoze-hp' ),

                'selector' => '{{WRAPPER}} .xmoze-crypto-button:hover',

            ]

        );



        $this->add_control(

            'button_color_hover',

            [

                'label'     => __( 'Color', 'xmoze-hp' ),

                'type'      => \Elementor\Controls_Manager::COLOR,

                'selectors' => [

                    '{{WRAPPER}} .xmoze-crypto-button:hover' => 'color: {{VALUE}}',

                ],

            ]

        );



        $this->add_group_control(

            \Elementor\Group_Control_Border::get_type(),

            [

                'name'     => 'button_border_hover',

                'label'    => __( 'Border', 'xmoze-hp' ),

                'selector' => '{{WRAPPER}} .xmoze-crypto-button:hover',

            ]

        );

        $this->add_responsive_control(

            'button_border_radius_hover',

            [

                'label'      => __( 'Border Radius', 'xmoze-hp' ),

                'type'       => \Elementor\Controls_Manager::DIMENSIONS,

                'size_units' => ['px', 'em', '%'],

                'selectors'  => [

                    '{{WRAPPER}} .xmoze-crypto-button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                ],

            ]

        );

        $this->add_group_control(

            \Elementor\Group_Control_Box_Shadow::get_type(),

            [

                'name' => 'button_shadow_hover',

                'label' => __('Shadow', 'xmoze-hp'),

                'selector' => '{{WRAPPER}} .xmoze-crypto-button:hover',

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

        $this->add_control(

            'excerpt_color',

            [

                'label'     => __( 'Excerpt Color', 'xmoze-hp' ),

                'type'      => \Elementor\Controls_Manager::COLOR,

                'selectors' => [

                    '{{WRAPPER}} .xmoze-crypto-widget-item .crypto-content p' => 'color: {{VALUE}}',

                ],

            ]

        );



        $this->add_group_control(

            \Elementor\Group_Control_Typography::get_type(),

            [

                'name'     => 'excerpt_typ',

                'label'    => __( 'Excerpt Typography', 'xmoze-hp' ),

                'selector' => '{{WRAPPER}} .xmoze-crypto-widget-item .crypto-content p',

            ]

        );



        $this->add_responsive_control(

            'content_margin',

            [

                'label'      => __( 'Content Margin', 'xmoze-hp' ),

                'type'       => \Elementor\Controls_Manager::DIMENSIONS,

                'size_units' => ['px', 'em', '%'],

                'selectors'  => [

                    '{{WRAPPER}} .xmoze-crypto-widget-item .crypto-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                    'body.rtl {{WRAPPER}} .xmoze-crypto-widget-item .crypto-content' => 'margin:

                    {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',

                ],

            ]

        );



        $this->add_responsive_control(

            'content_box_margin',

            [

                'label'      => __( 'Content Box Margin', 'xmoze-hp' ),

                'type'       => \Elementor\Controls_Manager::DIMENSIONS,

                'size_units' => ['px', 'em', '%'],

                'selectors'  => [

                    '{{WRAPPER}} .xmoze-crypto-widget-item .crypto-content-wrap'          => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                    'body.rtl {{WRAPPER}} .xmoze-crypto-widget-item .crypto-content-wrap' => 'margin:

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

                    '{{WRAPPER}} .xmoze-crypto-widget-item .crypto-content-wrap'          => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                    'body.rtl {{WRAPPER}} .xmoze-crypto-widget-item .crypto-content-wrap' => 'padding:

                    {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',

                ],

            ]

        );

        $this->end_controls_section();



    /*

   *

    Dots start

   */

    $this->start_controls_section(

        'dots_navigation',

        [

            'label' => __('Navigation - Dots', 'xmoze-hp'),

            'tab' => \Elementor\Controls_Manager::TAB_STYLE,

            'condition' => [

                'dots' => 'yes'

            ],

        ]

    );

    $this->start_controls_tabs('_tabs_dots');



    $this->start_controls_tab(

        '_tab_dots_normal',

        [

            'label' => __('Normal', 'xmoze-hp'),

        ]

    );



    $this->add_control(

        'dots_color',

        [

            'label' => __('Color', 'xmoze-hp'),

            'type' => \Elementor\Controls_Manager::COLOR,

            'default' => '',

            'selectors' => [

                '{{WRAPPER}} .cryptos-slider ul.cryptos-slider-dot-list li' => 'background-color: {{VALUE}}!important;',

            ],

        ]

    );



    $this->add_responsive_control(

        'dots_align',

        [

            'label' => __( 'Alignment', 'xmoze-hp' ),

            'type' => \Elementor\Controls_Manager::CHOOSE,

            'options' => [

                'flex-start' => [

                    'title' => __( 'Left', 'xmoze-hp' ),

                    'icon' => 'eicon-text-align-left',

                ],

                'center' => [

                    'title' => __( 'Center', 'xmoze-hp' ),

                    'icon' => 'eicon-text-align-center',

                ],

                'flex-end' => [

                    'title' => __( 'Right', 'xmoze-hp' ),

                    'icon' => 'eicon-text-align-right',

                ],

            ],

            'default' => 'center',

            'selectors' => [

                '{{WRAPPER}} .cryptos-slider ul.cryptos-slider-dot-list' => 'justify-content: {{VALUE}};',

            ],

        ]

    );



    $this->add_responsive_control(

        'dots_box_width',

        [

            'label' => __('Width', 'xmoze-hp'),

            'type' => \Elementor\Controls_Manager::SLIDER,

            'size_units' => ['px'],

            'range' => [

                'px' => [

                    'min' => 0,

                    'max' => 200,

                ],

            ],

            'selectors' => [

                '{{WRAPPER}} .cryptos-slider ul.cryptos-slider-dot-list li' => 'width: {{SIZE}}{{UNIT}};',

            ],

        ]

    );



    $this->add_responsive_control(

        'dots_box_height',

        [

            'label' => __('Height', 'xmoze-hp'),

            'type' => \Elementor\Controls_Manager::SLIDER,

            'size_units' => ['px'],

            'range' => [

                'px' => [

                    'min' => 0,

                    'max' => 200,

                ],

            ],

            'selectors' => [

                '{{WRAPPER}} .cryptos-slider ul.cryptos-slider-dot-list li' => 'height: {{SIZE}}{{UNIT}};',

            ],

        ]

    );



    $this->add_responsive_control(

        'dots_margin',

        [

            'label'          => __('Gap Right', 'xmoze-hp'),

            'type'           => \Elementor\Controls_Manager::SLIDER,

            'default'        => [

                'unit' => 'px',

            ],

            'range'          => [

                'px' => [

                    'min' => 0,

                    'max' => 200,

                ],

            ],

            'selectors'      => [

                '{{WRAPPER}} .cryptos-slider ul.cryptos-slider-dot-list li ' => 'margin-right: {{SIZE}}{{UNIT}};',

                'body.rtl {{WRAPPER}} .cryptos-slider ul.cryptos-slider-dot-list li ' => 'margin-left: {{SIZE}}{{UNIT}};',

            ],

        ]

    );

    $this->add_responsive_control(

        'dots_min_margin',

        [

            'label'      => __('Margin', 'xmoze-hp'),

            'type'       => \Elementor\Controls_Manager::DIMENSIONS,

            'size_units' => ['px', '%'],

            'selectors'  => [

                '{{WRAPPER}} .cryptos-slider-dot-list' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                'body.rtl {{WRAPPER}} .cryptos-slider-dot-list' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',

            ],

        ]

    );

    $this->add_responsive_control(

        'dots_border_radius',

        [

            'label'      => __('Border Radius', 'xmoze-hp'),

            'type'       => \Elementor\Controls_Manager::DIMENSIONS,

            'size_units' => ['px', '%'],

            'selectors'  => [

                '{{WRAPPER}} .cryptos-slider ul.cryptos-slider-dot-list li' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                'body.rtl {{WRAPPER}} .cryptos-slider ul.cryptos-slider-dot-list li' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',

            ],

        ]

    );

    $this->end_controls_tab();



    $this->start_controls_tab(

        '_tab_dots_active',

        [

            'label' => __('Active', 'xmoze-hp'),

        ]

    );

    $this->add_control(

        'dots_color_active',

        [

            'label' => __('Active Color', 'xmoze-hp'),

            'type' => \Elementor\Controls_Manager::COLOR,

            'default' => '',

            'selectors' => [

                '{{WRAPPER}} .cryptos-slider ul.cryptos-slider-dot-list li.slick-active' => 'background-color: {{VALUE}}  !important;',

            ],

        ]

    );



    $this->add_responsive_control(

        'arrow_dots_box_active_width',

        [

            'label' => __('Width', 'xmoze-hp'),

            'type' => \Elementor\Controls_Manager::SLIDER,

            'size_units' => ['px'],

            'range' => [

                'px' => [

                    'min' => 0,

                    'max' => 200,

                ],

            ],

            'selectors' => [

                '{{WRAPPER}} .cryptos-slider ul.cryptos-slider-dot-list li.slick-active' => 'width: {{SIZE}}{{UNIT}} !important;',

            ],

        ]

    );



    $this->add_responsive_control(

        'arrow_dots_box_active_height',

        [

            'label' => __('Height', 'xmoze-hp'),

            'type' => \Elementor\Controls_Manager::SLIDER,

            'size_units' => ['px'],

            'range' => [

                'px' => [

                    'min' => 0,

                    'max' => 200,

                ],

            ],

            'selectors' => [

                '{{WRAPPER}} .cryptos-slider ul.cryptos-slider-dot-list li.slick-active' => 'height: {{SIZE}}{{UNIT}} !important;',

            ],

        ]

    );

    $this->end_controls_tab();

    $this->end_controls_tabs();



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

            'arrows' => 'yes',

        ],

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

            '{{WRAPPER}} .cryptos-slider-arrow button' => 'color: {{VALUE}}; border-color: {{VALUE}};',

            '{{WRAPPER}} .cryptos-slider-arrow button svg path' => 'stroke: {{VALUE}};',

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

            '{{WRAPPER}} .cryptos-slider-arrow button' => 'color: {{VALUE}};',

            '{{WRAPPER}} .cryptos-slider-arrow button svg path' => 'fill: {{VALUE}};',

        ],

    ]

);



$this->add_control(

    'arrow_bg_color',

    [

        'label' => __('Background Color', 'xmoze-hp'),

        'type' => \Elementor\Controls_Manager::COLOR,

        'selectors' => [

             '{{WRAPPER}} .cryptos-slider-arrow button' => 'background-color: {{VALUE}} !important;',

        ],

    ]

);



$this->add_group_control(

    \Elementor\Group_Control_Box_Shadow::get_type(),

    [

        'name' => 'arrow_shadow',

        'label' => __('Shadow', 'xmoze-hp'),

        'selector' => '{{WRAPPER}} .cryptos-slider-arrow button ',

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



     /* tobol */

     $this->add_control(

        'offset_orientation_v',

        [

            'label' => __( 'Vertical Orientation', 'elementor' ),

            'type' => \Elementor\Controls_Manager::CHOOSE,

            'toggle' => false,

            'default' => 'start',

            'options' => [

                'top' => [

                    'title' => __( 'Top', 'elementor' ),

                    'icon' => 'eicon-v-align-top',

                ],

                'bottom' => [

                    'title' => __( 'Bottom', 'elementor' ),

                    'icon' => 'eicon-v-align-bottom',

                ],

            ],

            'render_type' => 'ui',

            'selectors' => [

                '{{WRAPPER}} .cryptos-slider-arrow' => '{{VALUE}}: 0;',

            ],



        ]

    );



    $this->add_responsive_control(

    'arrow_position_top',

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

            '{{WRAPPER}} .cryptos-slider-arrow' => 'top: {{SIZE}}{{UNIT}} !important; bottom:auto',

        ],

        'condition' => [

            'offset_orientation_v' => 'top',

        ],

    ]

);



$this->add_responsive_control(

'arrow_position_bottom',

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

        '{{WRAPPER}} .cryptos-slider-arrow' => 'bottom: {{SIZE}}{{UNIT}} !important; top:auto',

    ],

    'condition' => [

        'offset_orientation_v' => 'bottom',

    ],

]

);



$this->add_control(

    'arrow_horizontal_position',

    [

        'label'             => __( 'Horizontal Position', 'xmoze-hp' ),

        'type'              => \Elementor\Controls_Manager::SELECT,

        'default'           => 'default',

        'options'           => [

            'default'    =>   __('Default',    'xmoze-hp'),

            'space_between'    =>   __('Space Between',    'xmoze-hp'),

        ],

        'separator' => 'after',

    ]

);

$this->add_responsive_control(

    'arrow_position_x_prev',

    [

        'label' => __( 'Horizontal Prev', 'happy-elementor-addons' ),

        'type' => \Elementor\Controls_Manager::SLIDER,

        'size_units' => ['px', '%'],

        'condition' => [

            'arrow_position_toggle' => 'yes'

        ],

        'range' => [

            'px' => [

                'min' => -200,

                'max' => 2000,

            ],

            '%' => [

                'min' => -200,

                'max' => 200,

            ],

        ],

        'selectors' => [

            '{{WRAPPER}}  .cryptos-slider-arrow .prev' => 'left: {{SIZE}}{{UNIT}}; right: auto !important;',

        ],

        'condition' => [

            'arrow_horizontal_position' => 'space_between',

        ],



    ]

);



// default == arrow gap

// space-between == left position, right position



$this->add_responsive_control(

    'arrow_position_right',

    [

        'label' => __( 'Horizontal Next', 'happy-elementor-addons' ),

        'type' => \Elementor\Controls_Manager::SLIDER,

        'size_units' => ['px', '%'],

        'range' => [

            'px' => [

                'min' => -2000,

                'max' => 1000,

            ],

            '%' => [

                'min' => -200,

                'max' => 200,

            ],

        ],

        'selectors' => [

            '{{WRAPPER}} .cryptos-slider-arrow .next' => 'right: {{SIZE}}{{UNIT}} !important; left: auto !important;',

        ],

        'condition' => [

            'arrow_horizontal_position' => 'space_between',

        ],

    ]

);



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

            '{{WRAPPER}}  .cryptos-slider-arrow button i' => 'font-size: {{SIZE}}{{UNIT}}',

            '{{WRAPPER}}  .cryptos-slider-arrow button svg' => 'width: {{SIZE}}{{UNIT}}',

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

            '{{WRAPPER}} .cryptos-slider-arrow button' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}',

        ],

    ]



);



$this->add_responsive_control(

    'arrow_size_line_height',

    [

        'label' => __('Line Height', 'xmoze-hp'),

        'type' => \Elementor\Controls_Manager::SLIDER,

        'size_units' => ['px'],

        'range' => [

            'px' => [

                'min' => 0,

                'max' => 150,

            ],

        ],

        'selectors' => [

            '{{WRAPPER}} .cryptos-slider-arrow button' => 'line-height: {{SIZE}}{{UNIT}} !important;',

        ],

    ]



);



$this->add_responsive_control(

    'arrows_border_radius',

    [

        'label'      => __('Border Radius', 'xmoze-hp'),

        'type'       => \Elementor\Controls_Manager::DIMENSIONS,

        'size_units' => ['px'],

        'selectors'  => [

            '{{WRAPPER}} .cryptos-slider-arrow button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

            'body.rtl {{WRAPPER}} .cryptos-slider-arrow button ' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',

        ],

    ]

);

$this->end_controls_tab();



$this->start_controls_tab(

    '_tab_arrow_hover',

    [

        'label' => __('Active', 'xmoze-hp'),

    ]

);



$this->add_control(

    'arrow_hover_color',

    [

        'label' => __('Color', 'xmoze-hp'),

        'type' => \Elementor\Controls_Manager::COLOR,

        'selectors' => [

             '{{WRAPPER}} .cryptos-slider-arrow .slick-active' => 'color: {{VALUE}};',

             '{{WRAPPER}} .cryptos-slider-arrow button:hover ' => 'color: {{VALUE}};',

             '{{WRAPPER}} .cryptos-slider-arrow .slick-active svg path' => 'stroke: {{VALUE}};',

             '{{WRAPPER}} .cryptos-slider-arrow button:hover svg path ' => 'stroke: {{VALUE}};',

        ],

    ]

);



$this->add_control(

    'arrow_hover_fill_color',

    [

        'label' => __('Line Color', 'xmoze-hp'),

        'type' => \Elementor\Controls_Manager::COLOR,

        'selectors' => [

             '{{WRAPPER}} .cryptos-slider-arrow .slick-active' => 'color: {{VALUE}};',

             '{{WRAPPER}} .cryptos-slider-arrow button:hover ' => 'color: {{VALUE}};',

             '{{WRAPPER}} .cryptos-slider-arrow .slick-active path' => 'fill: {{VALUE}};',

             '{{WRAPPER}} .cryptos-slider-arrow button:hover path' => 'fill: {{VALUE}};',

        ],

    ]

);



$this->add_control(

    'arrow_bg_hover_color',

    [

        'label' => __('Background Color Hover', 'xmoze-hp'),

        'type' => \Elementor\Controls_Manager::COLOR,

        'selectors' => [

             '{{WRAPPER}} .cryptos-slider-arrow button:hover ' => 'background-color: {{VALUE}}  !important;',

             '{{WRAPPER}} .cryptos-slider-arrow .slick-active ' => 'background-color: {{VALUE}}  !important;',

        ],

    ]

);



$this->end_controls_tab();

$this->end_controls_tabs();



$this->end_controls_section();



/* end arrow */



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

                'default'   => '#ffffff',

                'selectors' => [

                    '{{WRAPPER}} .xmoze-crypto-widget-item' => 'background-color: {{VALUE}};',

                ],

            ]

        );

        $this->add_group_control(

            \Elementor\Group_Control_Box_Shadow::get_type(),

            [

                'name'     => 'box_shadow',

                'label'    => __( 'Box Hover Shadow', 'xmoze-hp' ),

                'selector' => '{{WRAPPER}} .xmoze-crypto-widget-item',

            ]

        );

        $this->add_group_control(

            \Elementor\Group_Control_Border::get_type(),

            [

                'name'     => 'box_border',

                'label'    => __( 'Box Border', '' ),

                'selector' => '{{WRAPPER}} .xmoze-crypto-widget-item',

            ]

        );

        $this->add_responsive_control(

            'box_radius',

            [

                'label'      => __( 'Box Radius', 'xmoze-hp' ),

                'type'       => \Elementor\Controls_Manager::DIMENSIONS,

                'size_units' => ['px', 'em', '%'],

                'selectors'  => [

                    '{{WRAPPER}} .xmoze-crypto-widget-item'          => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

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

                    '{{WRAPPER}} .xmoze-crypto-widget-item '          => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

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

                    '{{WRAPPER}} .xmoze-crypto-widget-item:hover' => 'background-color: {{VALUE}}',

                ],

            ]

        );

        $this->add_group_control(

            \Elementor\Group_Control_Background::get_type(),

            [

                'name' => 'box_hover_bg',

                'label' => __( 'Background', 'xmoze-hp' ),

                'types' => [ 'classic', 'gradient', 'video' ],

                'selector' => '{{WRAPPER}} .xmoze-crypto-widget-item:hover',

            ]

        );



        $this->add_responsive_control(

            'box_hover_radius',

            [

                'label'      => __( 'Box Radius', 'xmoze-hp' ),

                'type'       => \Elementor\Controls_Manager::DIMENSIONS,

                'size_units' => ['px', 'em', '%'],

                'selectors'  => [

                    '{{WRAPPER}} .xmoze-crypto-widget-item:hover'          => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                ],

            ]

        );

        $this->add_group_control(

            \Elementor\Group_Control_Box_Shadow::get_type(),

            [

                'name'     => 'box_hover_shadow',

                'label'    => __( 'Box Hover Shadow', 'xmoze-hp' ),

                'selector' => '{{WRAPPER}} .xmoze-crypto-widget-item:hover',

            ]

        );

        $this->add_group_control(

            \Elementor\Group_Control_Border::get_type(),

            [

                'name'     => 'box_hover_border',

                'label'    => __( 'Box Border', '' ),

                'selector' => '{{WRAPPER}} .xmoze-crypto-widget-item:hover ',

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



        /* Gride Class */

        $grid_classes = [];

        $grid_classes[] = 'col-xl-' . $settings['per_line'];

        $grid_classes[] = 'col-md-' . $settings['per_line_tablet'];

        $grid_classes[] = 'col-sm-' . $settings['per_line_mobile'];

        $grid_classes = implode(' ', $grid_classes);

        $this->add_render_attribute('crypto_gride_classes', 'class', [$grid_classes , 'xmoze-crypto-widget-wrap', 'col-lg-6']);



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

                'taxonomy' => 'crypto-category',

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

                'taxonomy' => 'crypto-category',

                'operator' => 'NOT IN',

                'field'    => 'slug',

                'terms'    => $settings['exclude_categories'],

            ];

        }

        if ( 0 != count( $settings['exclude_tags'] ) ) {

            $exclude_tags['tax_query'] = [

                'taxonomy' => 'crypto-tag',

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

            $related_categories = get_the_terms( get_the_ID(), 'crypto-category' );

            $related_cats       = [];

            if ( $related_categories ) {

                foreach ( $related_categories as $related_cat ) {

                    $related_cats[] = $related_cat->slug;

                }

            }

            $the_query = new WP_Query( array(

                'posts_per_page' => $settings['posts_per_page'],

                'post_type'      => 'crypto',

                'orderby'        => $settings['orderby'],

                'order'          => $settings['order'],

                'post__not_in'   => array( $current_post_id ),

                'paged'          => $paged,

                'tax_query'      => array(

                    array(

                        'taxonomy' => 'crypto-category',

                        'operator' => 'IN',

                        'field'    => 'slug',

                        'terms'    => $related_cats,

                    ),

                ),

            ) );

        } elseif ( 'manual_selection' == $settings['source'] ) {

            $the_query = new WP_Query( array(

                'posts_per_page' => $settings['posts_per_page'],

                'post_type'      => 'crypto',

                'orderby'        => $settings['orderby'],

                'order'          => $settings['order'],

                'paged'          => $paged,

                'post__in'       => ( 0 != count( $settings['manual_selection'] ) ) ? $settings['manual_selection'] : array(),

            ) );

        } else {

            $the_query = new WP_Query( array(

                'posts_per_page' => $settings['posts_per_page'],

                'post_type'      => 'crypto',

                'orderby'        => $settings['orderby'],

                'order'          => $settings['order'],

                'paged'          => $paged,

                'crypto-tag'    => ( $is_include_tag && 0 != count( $settings['include_tags'] ) ) ? $include_tags : '',

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

          //this code slider option

		$slider_extraSetting = array(

	        'loop' => (!empty($settings['loop']) && 'yes' === $settings['loop']) ? true : false,

	        'dots' => (!empty($settings['dots']) && 'yes' === $settings['dots']) ? true : false,

	        'autoplay' => (!empty($settings['autoplay']) && 'yes' === $settings['autoplay']) ? true : false,

        	'nav' => (!empty($settings['arrows']) && 'yes' === $settings['arrows']) ? true : false,

        	'nav' => (!empty($settings['arrows']) && 'yes' === $settings['arrows']) ? true : false,

        	'show_vertical' => (!empty($settings['show_vertical']) && 'yes' === $settings['show_vertical']) ? true : false,

        	'autoplaytimeout' => !empty($settings['autoplaytimeout']) ? $settings['autoplaytimeout'] : '5000',

            //this a responsive layout

            'per_coulmn' =>        (!empty($settings['per_coulmn'])) ? $settings['per_coulmn'] : 3,

            'per_coulmn_tablet' => (!empty($settings['per_coulmn_tablet'])) ? $settings['per_coulmn_tablet'] : 2,

            'per_coulmn_mobile' => (!empty($settings['per_coulmn_mobile'])) ? $settings['per_coulmn_mobile'] : 1

        );



        $jasondecode = wp_json_encode($slider_extraSetting);



        if ( ( 'yes' == $settings['show_slider_settings'] ) ) {

            $this->add_render_attribute('cryptos_version', 'class', array('cryptos-slider' ));

            $this->add_render_attribute('cryptos_version', 'data-settings', $jasondecode);

        }

        else {

            $this->add_render_attribute('cryptos_version', 'class', ['row justify-content-center'] );



        }

        ?>

        <?php if ( $the_query->have_posts() ): ?>

            <div <?php echo $this->get_render_attribute_string('cryptos_version'); ?>>

                <?php while ( $the_query->have_posts() ): $the_query->the_post();?>

                            <?php

                    $idd        = get_the_ID();

                    $excerpt    = ( $settings['excerpt_limit']['size'] ) ? wp_trim_words( get_the_excerpt(), $settings['excerpt_limit']['size'], '...' ) : get_the_excerpt();

                    $title      = ( $settings['title_limit']['size'] ) ? wp_trim_words( get_the_title(), $settings['title_limit']['size'], ' ' ) : get_the_title();

                    $xmoze_sub_title = get_field( 'xmoze_sub_title' );

                    $crypto_button_url = get_field( 'crypto_button_url' );

                    $xmoze_crypto_price = get_field( 'xmoze_crypto_price' );

                    $crypto_button_text = get_field( 'crypto_button_text' );



                    ?>

                    <!-- /.style inlcude -->

                <div <?php echo $this->get_render_attribute_string('crypto_gride_classes'); ?>>
                    <div class="xmoze-crypto-widget-item ">
                        <div class="xmoze-crypto-top">
                            <?php if (has_post_thumbnail()): ?>
                                <div class="crypto-thumbnail-wrapper">
                                    <?php the_post_thumbnail( 'large' ); ?>
                                </div>
                            <?php endif; ?>
                            <div class="xmoze-crypto-top-content">
                                <h3 class="crypto-title"><?php the_title() ?></h3>
                                <?php if($xmoze_sub_title): ?>
                                    <span class="xmoze-crypto-heading d-block"><?php echo esc_html($xmoze_sub_title); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                    <div class="crypto-content-wrap">
                            <div class="crypto-content">
                                <?php
                                    echo ('yes' == $settings['show_excerpt']) ? sprintf('<p> %s </p>', esc_html($excerpt)) : '';
                                ?>
                            </div>
                            <div class="xmoze-crypto-bottom-content">
                                <?php if($xmoze_crypto_price): ?>
                                    <span class="xmoze-crypto-price"><?php echo esc_html($xmoze_crypto_price); ?></span>
                                <?php endif; ?>
                                <?php if($crypto_button_text): ?>
                                    <a href="<?php echo esc_url($crypto_button_url) ?>" class="xmoze-crypto-button">
                                        <?php echo esc_html($crypto_button_text); ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                 </div>



                <?php

            endwhile;

            wp_reset_postdata();?>

        </div>

        <?php if ( 'yes' == $settings['show_slider_settings'] && 'yes' == $settings['arrows']): ?>
            <div class="cryptos-slider-arrow">
            <?php if ( ! empty( $settings['arrow_next_icon']['value'] ) ) : ?>
                    <button type="button" class="slick-next next slick-arrow ">
                        <?php Icons_Manager::render_icon( $settings['arrow_next_icon'], ['aria-hidden' => 'true'] ); ?>
                    </button>
                <?php endif; ?>
                <?php if ( ! empty( $settings['arrow_prev_icon']['value'] ) ) : ?>
                    <button type="button" class="slick-prev prev slick-arrow slick-active">
                        <?php Icons_Manager::render_icon( $settings['arrow_prev_icon'], ['aria-hidden' => 'true'] ); ?>
                    </button>
                <?php endif; ?>
            </div>
        <?php endif; ?>

    <?php endif; ?>



<?php



    }

}

$widgets_manager->register( new \Xmoze_Crypto() );