<?php

namespace Mas_Addons\Widgets;

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
class Blog extends \Elementor\Widget_Base
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
        return 'mas-addons-blog';
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
        return __('Blog', 'mas-addons');
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
        return 'eicon-post-list';
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
        return ['mas-addons'];
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
        $post_categories =  mas_addons_cpt_taxonomy_slug_and_name('category');
        $this->start_controls_section(
            'section_general',
            [
                'label' => __('General', 'mas-addons'),
            ]
        );
        $this->add_control(
            'enable_masonry',
            [
                'label' => __('Enable Masonry?', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'mas-addons'),
                'label_off' => __('Hide', 'mas-addons'),
                'return_value' => 'masonry',
                'default' => '',
            ]
        );
        $this->add_control(
            'show_slider_settings',
            [
                'label' => __('Enable Slider?', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'mas-addons'),
                'label_off' => __('No', 'mas-addons'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );



        $this->add_control(
            'posts_per_page',
            [
                'label' => __('Posts per page', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 5,
            ]
        );

        $this->add_responsive_control('per_line', [
            'label'              => __('Columns per row', 'mas-addons'),
            'type'               => \Elementor\Controls_Manager::SELECT,
            'default'            => '4',
            'tablet_default'     => '6',
            'mobile_default'     => '12',
            'options'            => [
                '12' => '1',
                '6'  => '2',
                '4'  => '3',
                '3'  => '4',
            ],
            'frontend_available' => true,
        ]);

        $this->add_control(
            'post_style',
            [
                'label' => __('Select style', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'style-one',
                'options' => array(
                    'style-one' => 'Style 1',
                    'style-two' => 'Style 2',
                    'style-three' => 'Style 3',
                ),
            ]
        );
        $this->add_responsive_control(
            'post_grid',
            [
                'label' => __('Post grid', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => array(
                    '12' => '1 Column',
                    '6' => '2 Column',
                    '4' => '3 Column',
                    '3' => '4 Column',
                ),
                'default'            => 3,
                'tablet_default'     => 6,
                'mobile_default'     => 12,
            ]
        );

        $this->add_control(
            'source',
            [
                'label'         => __('Source', 'mas-addons'),
                'type'          => \Elementor\Controls_Manager::SELECT,
                'options'       => [
                    'archive' => 'Archive',
                    'manual_selection' => 'Manual Selection',
                    'related' => 'Related',
                ],
                'default' =>    'archive',
            ]
        );
        $this->add_control(
            'manual_selection',
            [
                'label'         => __('Manual Selection', 'mas-addons'),
                'type'          => \Elementor\Controls_Manager::SELECT2,
                'description'   => __('Get specific template posts', 'mas-addons'),
                'label_block'   => true,
                'multiple'      => true,
                'options'       => mas_addons_cpt_slug_and_id('post'),
                'default' =>    [],
                'condition' => [
                    'source' => 'manual_selection'
                ],
            ]
        );
        $this->start_controls_tabs(
            'include_exclude_tabs'
        );
        $this->start_controls_tab(
            'include_tabs',
            [
                'label' => __('Include', 'mas-addons'),
                'condition' => [
                    'source!' => 'manual_selection'
                ],
            ]
        );
        $this->add_control(
            'include_by',
            [
                'label'         => __('Include by', 'mas-addons'),
                'type'          => \Elementor\Controls_Manager::SELECT2,
                'label_block'   => true,
                'multiple'      => true,
                'options'       => [
                    'tags'  => 'Tags',
                    'category'  => 'Category',
                    'author' => 'Author',
                ],
                'default' =>    [],
                'condition' => [
                    'source!' => 'manual_selection'
                ],
            ]
        );
        $this->add_control(
            'include_categories',
            [
                'label'         => __('Include categories', 'mas-addons'),
                'type'          => \Elementor\Controls_Manager::SELECT2,
                'description'   => __('Get templates for specific category(s)', 'mas-addons'),
                'label_block'   => true,
                'multiple'      => true,
                'options'       => mas_addons_cpt_taxonomy_slug_and_name('category'),
                'default' =>    [],
                'condition' => [
                    'include_by' => 'category',
                    'source!' => 'related',
                    'source!' => 'manual_selection'
                ],
            ]
        );
        $this->add_control(
            'include_tags',
            [
                'label'         => __('Include Tags', 'mas-addons'),
                'type'          => \Elementor\Controls_Manager::SELECT2,
                'description'   => __('Get templates for specific tag(s)', 'mas-addons'),
                'label_block'   => true,
                'multiple'      => true,
                'options'       => mas_addons_cpt_taxonomy_slug_and_name('post_tag'),
                'default' =>    [],
                'condition' => [
                    'include_by' => 'tags',
                    'source!' => 'related',
                    'source!' => 'manual_selection'
                ],
            ]
        );
        $this->add_control(
            'include_authors',
            [
                'label'         => __('Include authors', 'mas-addons'),
                'type'          => \Elementor\Controls_Manager::SELECT2,
                'description'   => __('Get templates for specific tag(s)', 'mas-addons'),
                'label_block'   => true,
                'multiple'      => true,
                'options'       => mas_addons_cpt_author_slug_and_id('post'),
                'default' =>    [],
                'condition' => [
                    'include_by' => 'author',
                    'source!' => 'manual_selection'
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'exclude_tabs',
            [
                'label' => __('Exclude', 'mas-addons'),
                'condition' => [
                    'source!' => 'manual_selection'
                ],
            ]
        );
        $this->add_control(
            'exclude_by',
            [
                'label'         => __('Exclude by', 'mas-addons'),
                'type'          => \Elementor\Controls_Manager::SELECT2,
                'label_block'   => true,
                'multiple'      => true,
                'options'       => [
                    'tags'  => 'tags',
                    'category'  => 'Category',
                    'author' => 'Author',
                    'current_post' => 'Current Post',
                ],
                'default' =>    [],
                'condition' => [
                    'source!' => 'manual_selection',
                    'source!' => 'manual_selection'
                ],
            ]
        );
        $this->add_control(
            'exclude_categories',
            [
                'label'         => __('Exclude categories', 'mas-addons'),
                'type'          => \Elementor\Controls_Manager::SELECT2,
                'description'   => __('Get templates for specific category(s)', 'mas-addons'),
                'label_block'   => true,
                'multiple'      => true,
                'options'       => mas_addons_cpt_taxonomy_slug_and_name('category'),
                'default' =>    [],
                'condition' => [
                    'exclude_by' => 'category',
                    'source!' => 'related',
                    'source!' => 'manual_selection'
                ],
            ]
        );
        $this->add_control(
            'exclude_tags',
            [
                'label'         => __('Exclude Tags', 'mas-addons'),
                'type'          => \Elementor\Controls_Manager::SELECT2,
                'description'   => __('Get templates for specific tag(s)', 'mas-addons'),
                'label_block'   => true,
                'multiple'      => true,
                'options'       => mas_addons_cpt_taxonomy_slug_and_name('post_tag'),
                'default' =>    [],
                'condition' => [
                    'exclude_by' => 'tags',
                    'source!' => 'related',
                    'source!' => 'manual_selection'
                ],
            ]
        );
        $this->add_control(
            'exclude_authors',
            [
                'label'         => __('Exclude authors', 'mas-addons'),
                'type'          => \Elementor\Controls_Manager::SELECT2,
                'description'   => __('Get templates for specific tag(s)', 'mas-addons'),
                'label_block'   => true,
                'multiple'      => true,
                'options'       => mas_addons_cpt_author_slug_and_id('post'),
                'default' =>    [],
                'condition' => [
                    'exclude_by' => 'author',
                    'source!' => 'manual_selection'
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->add_control(
            'orderby',
            [
                'label'         => __('Order By', 'mas-addons'),
                'type'          => \Elementor\Controls_Manager::SELECT,
                'options'       => [
                    'date'   => 'Date',
                    'title'    => 'title',
                    'menu_order'    => 'Menu Order',
                    'rand'    => 'Random',
                ],
                'default' =>    'date',
            ]
        );
        $this->add_control(
            'order',
            [
                'label'         => __('Order', 'mas-addons'),
                'type'          => \Elementor\Controls_Manager::SELECT,
                'options'       => [
                    'ASC'   => 'ASC',
                    'DESC'    => 'DESC',
                ],
                'default' =>    'DESC',
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'section_content',
            [
                'label' => __('Content', 'mas-addons'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'show_excerpt',
            [
                'label' => __('Show Content', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'mas-addons'),
                'label_off' => __('Hide', 'mas-addons'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
        $this->add_control(
            'enable_pagination',
            [
                'label' => __('Show Pagination?', 'grayic-ts'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'grayic-ts'),
                'label_off' => __('No', 'grayic-ts'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'title_limit',
            [
                'label' => __('Title Limit', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 7,
                ],
            ]
        );
        $this->add_control(
            'excerpt_limit',
            [
                'label' => __('Excerpt Word Limit', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 15,
                ],
                'devices' => ['desktop', 'tablet', 'mobile'],
                'condition' => [
                    'show_excerpt' => 'yes',
                ]
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'section_meta',
            [
                'label' => __('Meta', 'mas-addons'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'show_category',
            [
                'label' => __('Show Category', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'mas-addons'),
                'label_off' => __('Hide', 'mas-addons'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'cat_position',
            [
                'label' => __('Position', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'top',
                'options' => array(
                    'top' => 'Top',
                    'bottom' => 'Bottom',
                ),
                'condition' => [
                    'show_category' => 'yes',
                ]
            ]
        );
        $this->add_control(
            'cat_icon',
            [
                'label' => __('Date Icon', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'condition' => [
                    'show_category' => 'yes',
                ]
            ]
        );
        $this->add_control(
            'show_date',
            [
                'label' => __('Show Date', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'mas-addons'),
                'label_off' => __('Hide', 'mas-addons'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'date_position',
            [
                'label' => __('Position', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'top',
                'options' => array(
                    'top' => 'Top',
                    'bottom' => 'Bottom',
                ),
                'condition' => [
                    'show_date' => 'yes',
                ]
            ]
        );
        $this->add_control(
            'date_icon',
            [
                'label' => __('Date Icon', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'condition' => [
                    'show_date' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'show_author',
            [
                'label' => __('Show Author', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'mas-addons'),
                'label_off' => __('Hide', 'mas-addons'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'author_position',
            [
                'label' => __('Position', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'bottom',
                'options' => array(
                    'top' => 'Top',
                    'bottom' => 'Bottom',
                ),
                'condition' => [
                    'show_author' => 'yes',
                ]
            ]
        );
        $this->add_control(
            'author_text',
            [
                'label' => __('Author Label', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('By', 'mas-addons'),
                'condition' => [
                    'show_author' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'author_icon',
            [
                'label' => __('Author Icon', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'condition' => [
                    'show_author' => 'yes',
                ]
            ]
        );


        $this->add_control(
            'show_comment',
            [
                'label' => __('Show Comment', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'mas-addons'),
                'label_off' => __('Hide', 'mas-addons'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'comment_position',
            [
                'label' => __('Position', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'bottom',
                'options' => array(
                    'top' => 'Top',
                    'bottom' => 'Bottom',
                ),
                'condition' => [
                    'show_comment' => 'yes',
                ]
            ]
        );
        $this->add_control(
            'comment_text',
            [
                'label' => __('Commnent Label', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Comment', 'mas-addons'),
                'condition' => [
                    'show_comment' => 'yes',
                ]
            ]
        );
        $this->add_control(
            'comment_icon',
            [
                'label' => __('Comment Icon', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'condition' => [
                    'show_comment' => 'yes',
                ]
            ]
        );

        $this->end_controls_section();
        $this->start_controls_section(
            'section_btn',
            [
                'label' => __('Readmore', 'mas-addons'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'show_readmore',
            [
                'label' => __('Readmore button', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'mas-addons'),
                'label_off' => __('Hide', 'mas-addons'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'readmore_text',
            [
                'label' => __('Readmore text', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('READ MORE', 'mas-addons'),
                'conditon' => [
                    'show_readmore' => 'yes',
                ]
            ]
        );
        $this->add_control(
            'btn_icon',
            [
                'label' => __('Icon', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'conditon' => [
                    'show_readmore' => 'yes',
                ]
            ]
        );
        $this->add_control(
            'icon_position',
            [
                'label' => __('Icon Position', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'after',
                'options' => [
                    'before' => __('Before', 'mas-addons'),
                    'after' => __('After', 'mas-addons'),
                ],
                'conditon' => [
                    'show_readmore' => 'yes',
                ]
            ]
        );
        $this->add_responsive_control(
            'button_align',
            [
                'label' => __('Align', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'mas-addons'),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __('top', 'mas-addons'),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'mas-addons'),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'devices' => ['desktop', 'tablet', 'mobile'],
                'prefix_class' => 'content-align%s-',
                'toggle' => true,
            ]
        );
        $this->end_controls_section();


        //Slider Setting

        $this->start_controls_section(
            'slider_settings',
            [
                'label' => __('Slider Settings', 'mas-addons'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'show_slider_settings' => 'yes',
                ]
            ]
        );
        $this->add_responsive_control(
            'row_margin',
            [
                'label' => __('Row Gap', 'upmedix'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .blog-slider .slick-list' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'column_margin',
            [
                'label' => __('Column Gap', 'upmedix'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .blog-slider .slick-slide' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $this->add_responsive_control(
            'per_coulmn',
            [
                'label' => __('Slider Items', 'mas-addons'),
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
                ],
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'show_vertical',
            [
                'label' => __('Vertical Mode?', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'mas-addons'),
                'label_off' => __('Hide', 'mas-addons'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'show_center_mode',
            [
                'label' => __('Center Mode?', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'mas-addons'),
                'label_off' => __('Hide', 'mas-addons'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'arrows',
            [
                'label' => __('Show arrows?', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'mas-addons'),
                'label_off' => __('Hide', 'mas-addons'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'dots',
            [
                'label' => __('Show Dots?', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'mas-addons'),
                'label_off' => __('Hide', 'mas-addons'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'mousedrag',
            [
                'label' => __('Show MouseDrag', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'mas-addons'),
                'label_off' => __('Hide', 'mas-addons'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'autoplay',
            [
                'label' => __('Auto Play?', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'mas-addons'),
                'label_off' => __('Hide', 'mas-addons'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'loop',
            [
                'label' => __('Infinite Loop', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'mas-addons'),
                'label_off' => __('Hide', 'mas-addons'),
                'return_value' => 'yes',
                'default' => 'true',
            ]
        );
        $this->add_control(
            'autoplaytimeout',
            [
                'label' => __('Autoplay Timeout', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'label_block' => true,
                'default' => '5000',
                'options' => [
                    '1000'  => __('1 Second', 'mas-addons'),
                    '2000'  => __('2 Second', 'mas-addons'),
                    '3000'  => __('3 Second', 'mas-addons'),
                    '4000'  => __('4 Second', 'mas-addons'),
                    '5000'  => __('5 Second', 'mas-addons'),
                    '6000'  => __('6 Second', 'mas-addons'),
                    '7000'  => __('7 Second', 'mas-addons'),
                    '8000'  => __('8 Second', 'mas-addons'),
                    '9000'  => __('9 Second', 'mas-addons'),
                    '10000' => __('10 Second', 'mas-addons'),
                    '11000' => __('11 Second', 'mas-addons'),
                    '12000' => __('12 Second', 'mas-addons'),
                    '13000' => __('13 Second', 'mas-addons'),
                    '14000' => __('14 Second', 'mas-addons'),
                    '15000' => __('15 Second', 'mas-addons'),
                ],
                'condition' => [
                    'autoplay' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'arrow_prev_icon',
            [
                'label' => __('Previous Icon', 'advis'),
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
                'label' => __('Next Icon', 'advis'),
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

        //Slider setting end







        $this->start_controls_section(
            'section_image_style',
            [
                'label' => __('Image', 'mas-addons'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
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
        $this->add_responsive_control(
            'image_width',
            [
                'label' => __('Image Width', 'mas-addons'),
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
                'devices' => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .mas-addons-post:not(-widget-item.post-style-list) .post-thumbnail img'  => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .mas-addons-post-widget-item.post-style-list .post-thumbnail-wrapper'  => 'flex: 0 0 {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'image_height',
            [
                'label' => __('Image Height', 'mas-addons'),
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
                'devices' => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .post-thumbnail img'  => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'image_radius',
            [
                'label' => __('Image Radius', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .post-thumbnail ' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'

                ],
            ]
        );
        $this->add_responsive_control(
            'image_margin',
            [
                'label' => __('Image Margin', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    'body:not(.rtl) {{WRAPPER}} .post-thumbnail-wrapper ' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .post-thumbnail-wrapper ' => ': {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'image_padding',
            [
                'label' => __('Image Padding', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    'body:not(.rtl) {{WRAPPER}} .post-thumbnail-wrapper ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .post-thumbnail-wrapper ' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
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
                'label'             => __('Hover Style', 'mas-addons'),
                'type'              => \Elementor\Controls_Manager::SELECT,
                'default'           => 'hover-default',
                'options'           => [
                    'hover-default' =>   __('Default',    'mas-addons'),
                    'hover-one'     =>   __('Style 01',    'mas-addons'),
                ],
                'separator' => 'after',
            ]
        );
        $this->end_controls_tab();

        $this->end_controls_tabs();
        $this->end_controls_section();

        /*
        Catgory Style
        */
        $this->start_controls_section(
            'category_style',
            [
                'label' => __('Category', 'mas-addons'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_category' => 'yes'
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'cat_typography',
                'label' => __('Category Typography', 'mas-addons'),
                'selector' => '{{WRAPPER}} .category-list',
                'condition' => [
                    'show_category' => 'yes'
                ]
            ]
        );

        $this->start_controls_tabs(
            'category_style_tabs'
        );
        //normal
        $this->start_controls_tab(
            'category_style_normal_tab',
            [
                'label' => __('Normal', 'mas-addons'),
            ]
        );

        $this->add_control(
            'category_color',
            [
                'label' => __('Category Color', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .category-list' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'category_bg_color',
            [
                'label' => __('Category Background Color', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .category-list' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'cat_hr',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'category_border',
                'label' => __('Border', 'mas-addons'),
                'selector' => '{{WRAPPER}} .category-list',
            ]
        );
        $this->add_responsive_control(
            'catgory_radius',
            [
                'label' => __('Border Radius', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    'body:not(.rtl) {{WRAPPER}} .category-list' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .category-list' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'catgory_margin',
            [
                'label' => __('Margin', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    'body:not(.rtl) {{WRAPPER}} .category-list' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .category-list' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'catgory_padding',
            [
                'label' => __('Padding', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    'body:not(.rtl) {{WRAPPER}} .category-list' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .category-list' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'category_style_hover_tab',
            [
                'label' => __('Hover', 'mas-addons'),
            ]
        );

        $this->add_control(
            'category_color_hover',
            [
                'label' => __('Category Hover Color', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .category-list:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'category_bg_color_hover',
            [
                'label' => __('Category Hover Background Color', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .category-list:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();


        $this->end_controls_section();

        /*
        Top Meta  Style
        */
        $this->start_controls_section(
            'top_meta_bottom_style',
            [
                'label' => __('Top Meta', 'mas-addons'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'top_meta_typography',
                'label' => __('Typography', 'mas-addons'),
                'selector' => '{{WRAPPER}} .post-top-meta a, .post-top-meta span',
            ]
        );


        $this->add_control(
            'top_meta_color',
            [
                'label' => __('Text Color', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .post-top-meta a, .post-top-meta span' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'top_meta_svg_stock_color',
            [
                'label' => __('SVG Line Color', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .post-top-meta i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .post-top-meta svg path' => 'stroke: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'top_meta_svg_fil_color',
            [
                'label' => __('SVG Fill Color', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .post-top-meta i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .post-top-meta svg path' => 'fill: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'top_icon_meta_size',
            [
                'label' => __('Icon Size', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .post-top-meta i'       => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .post-top-meta svg'   => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'top_icon_meta_gap',
            [
                'label' => __('Icon Gap', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .post-top-meta i, {{WRAPPER}} .post-top-meta svg'       => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'top_meta_middeborder_padding',
            [
                'label' => __('Padding', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .post-top-meta > span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_responsive_control(
            'top_meta_middeborder_margin',
            [
                'label' => __('Margin', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    ' {{WRAPPER}} .post-top-meta > *' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_responsive_control(
            'top_meta_topmeta_margin',
            [
                'label' => __('Meta Margin', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    ' {{WRAPPER}} .post-top-meta' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->end_controls_section();
        /*
        Bottom Meta Style
        */
        $this->start_controls_section(
            'meta_bottom_style',
            [
                'label' => __('Bottom Meta', 'mas-addons'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'meat_typography',
                'label' => __('Typography', 'mas-addons'),
                'selector' => '{{WRAPPER}} .post-meta-bottom a, .post-meta-bottom span',
            ]
        );


        $this->add_control(
            'meta_color',
            [
                'label' => __('Text Color', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .post-meta-bottom a, .post-meta-bottom span' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'svg_stock_color',
            [
                'label' => __('SVG Line Color', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .post-meta-bottom i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .post-meta-bottom svg path' => 'stroke: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'svg_fil_color',
            [
                'label' => __('SVG Fill Color', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .post-meta-bottom i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .post-thumbnail svg path' => 'fill: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'bottom_meta_border',
				'label' => esc_html__( 'Border', 'mas-addons' ),
				'selector' => '{{WRAPPER}} .post-meta-bottom',
			]
		);

        $this->add_control(
            'icon_meta_size',
            [
                'label' => __('Icon Size', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .post-meta-bottom i'       => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .post-meta-bottom svg'   => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'bottom_icon_meta_gap',
            [
                'label' => __('Icon Gap', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .post-meta-bottom i, {{WRAPPER}} .post-meta-bottom svg'       => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'middeborder_padding',
            [
                'label' => __('Padding', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .post-meta-bottom > span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_responsive_control(
            'middeborder_margin',
            [
                'label' => __('Item Margin', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    ' {{WRAPPER}} .post-meta-bottom > *' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_responsive_control(
            'meta_margin',
            [
                'label' => __('Meta Margin', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    ' {{WRAPPER}} .post-meta-bottom' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->end_controls_section();

        /*
        Content  Style
        */
        $this->start_controls_section(
            'content_style',
            [
                'label' => __('Content', 'mas-addons'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'heading_typography',
                'label' => __('Title Typography', 'mas-addons'),
                'selector' => '{{WRAPPER}} .mas-addons-post-widget-item .post-title',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'excerpt_typo',
                'label' => __('Excerpt Typography', 'mas-addons'),
                'selector' => '{{WRAPPER}} .mas-addons-post-widget-item p',
                'condition' => [
                    'show_excerpt' => 'yes'
                ]
            ]
        );

        $this->start_controls_tabs(
            'content_style_tabs'
        );
        $this->start_controls_tab(
            'content_style_normal_tab',
            [
                'label' => __('Normal', 'mas-addons'),
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label' => __('Title Color', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mas-addons-post-widget-item .post-title' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'excerpt_color',
            [
                'label' => __('Excerpt Color', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mas-addons-post-widget-item p' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'show_excerpt' => 'yes'
                ]
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'content_style_hover_tab',
            [
                'label' => __('Hover', 'mas-addons'),
            ]
        );
        $this->add_control(
            'title_hover_color',
            [
                'label' => __('Title Color', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .post-title:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'excerpt_hover_color',
            [
                'label' => __('Excerpt Color', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mas-addons-post-widget-item:hover p' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'show_excerpt' => 'yes'
                ]
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->add_control(
            'title_br',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );

        $this->add_responsive_control(
            'title_gap',
            [
                'label' => __('Title Gap', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    'body:not(.rtl) {{WRAPPER}} .mas-addons-post-widget-item .post-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .mas-addons-post-widget-item .post-title' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_responsive_control(
            'content_padding',
            [
                'label' => __('Content Padding', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    'body:not(.rtl) {{WRAPPER}} .mas-addons-post-widget-item .post-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .mas-addons-post-widget-item .post-content' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'button_style',
            [
                'label' => __('Button', 'mas-addons'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs(
            'button_style_tabs'
        );
        $this->start_controls_tab(
            'button_style_normal_tab',
            [
                'label' => __('Normal', 'mas-addons'),
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'btn_typography',
                'label' => __('Typography', 'mas-addons'),
                'selector' => '{{WRAPPER}} .post-btn',
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label' => __('Icon Color', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .post-btn .btn-icon' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .post-btn .btn-icon path' => 'fill: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'boxed_btn_color',
            [
                'label' => __('Button Color', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .post-btn' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'boxed_btn_background',
            [
                'label' => __('Background Color', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .post-btn' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'button_border',
                'label' => __('Border', 'mas-addons'),
                'selector' => '{{WRAPPER}} .post-btn',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_shadow',
                'label' => __('Shadow', 'mas-addons'),
                'selector' => '{{WRAPPER}} .post-btn',
            ]
        );


        $this->add_responsive_control(
            'icon_gap',
            [
                'label' => __('Icon Gap', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],

                'selectors' => [
                    'body:not(.rtl) {{WRAPPER}} .post-btn .btn-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                    'body.rtl {{WRAPPER}} .post-btn .btn-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                ],
            ]
        );

        $this->add_control(
            'buton_style_divider',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );
        $this->add_control(
            'icon_size',
            [
                'label' => __('Icon Size', 'mas-addons'),
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
                    '{{WRAPPER}} .post-btn .btn-icon'       => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .post-btn .btn-icon svg'   => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'button_radius',
            [
                'label' => __('Border Radius', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .post-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                ],
            ]
        );

        $this->add_responsive_control(
            'button_wrapper_padding',
            [
                'label' => __('Wrapper Padding', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .post-btn-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                ],
            ]
        );
        $this->add_responsive_control(
            'button_wrapper_margin',
            [
                'label' => __('Wrapper Margin', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .post-btn-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                ],
            ]
        );

        $this->add_responsive_control(
            'button_padding',
            [
                'label' => __('Button Padding', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .post-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                ],
            ]
        );
        $this->add_responsive_control(
            'button_margin',
            [
                'label' => __('Button Margin', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .post-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                ],
            ]
        );

        $this->end_controls_tab();
        $this->start_controls_tab(
            'button_style_hover_tab',
            [
                'label' => __('Hover', 'mas-addons'),
            ]
        );
        $this->add_control(
            'icon_hover_color',
            [
                'label' => __('Icon Color', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mas-addons-post-widget-item:hover .post-btn .btn-icon' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .mas-addons-post-widget-item:hover .post-btn .btn-icon path' => 'fill: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'btn_hover_typography',
                'label' => __('Typography', 'mas-addons'),
                'selector' => '{{WRAPPER}} .mas-addons-post-widget-item:hover .post-btn',
            ]
        );

        $this->add_control(
            'icon_hover_size',
            [
                'label' => __('Hover Icon Size', 'mas-addons'),
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
                    '{{WRAPPER}} .post-btn:hover .btn-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .post-btn:hover .btn-icon svg'   => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'btn_hover_color',
            [
                'label' => __('Button Color', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mas-addons-post-widget-item:hover .post-btn' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'btn_hover_background',
            [
                'label' => __('Background Color', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .post-btn:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'button_hover_padding',
            [
                'label' => __('Button Padding', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .mas-addons-post-widget-item:hover .post-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                ],
            ]
        );
        $this->add_responsive_control(
            'button_hover_margin',
            [
                'label' => __('Button Margin', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .mas-addons-post-widget-item:hover .post-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'button_hover_border',
                'label' => __('Border', 'mas-addons'),
                'selector' => '{{WRAPPER}} .post-btn:hover',
            ]
        );
        $this->add_control(
            'btn_hover_animation',
            [
                'label' => __('Hover Animation', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::HOVER_ANIMATION,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_hover_shadow',
                'label' => __('Button Shadow', 'mas-addons'),
                'selector' => '{{WRAPPER}} .post-btn:hover',
            ]
        );
        $this->add_responsive_control(
            'button_hover_radius',
            [
                'label' => __('Border Radius', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    'body:not(.rtl) {{WRAPPER}} .post-btn:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .post-btn:hover' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'icon_hover_gap',
            [
                'label' => __('Icon gap', 'mas-addons'),
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
                    'body:not(.rtl) {{WRAPPER}} .post-btn:hover .icon-before' => 'transform: translatex( -{{SIZE}}{{UNIT}} );',
                    'body:not(.rtl) {{WRAPPER}} .post-btn:hover .icon-after ' => 'transform: translatex( {{SIZE}}{{UNIT}} );',
                    'body.rtl {{WRAPPER}} .post-btn:hover .icon-before' => 'transform: translatex( {{SIZE}}{{UNIT}} );',
                    'body.rtl {{WRAPPER}} .post-btn:hover .icon-after ' => 'transform: translatex( -{{SIZE}}{{UNIT}} );',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_pagination',
            [
                'label' => __('Pagination', 'mas-addons'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'conditon' => [
                    'enable_pagination' => 'yes',
                ]
            ]
        );
        $this->start_controls_tabs(
            'pagination_controls'
        );
        $this->start_controls_tab(
            'pagination_normal',
            [
                'label' => __('Normal', 'mas-addons'),
                'condition' => [
                    'enable_pagination' => 'yes'
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'label' => __('Pagination typography', 'mas-addons'),
                'name' => 'pagi_typography',
                'selector' => '{{WRAPPER}} .mas-addons-pagination  a, {{WRAPPER}} .mas-addons-pagination span',
                'condition' => [
                    'enable_pagination' => 'yes'
                ],
            ]
        );
        $this->add_control(
            'pagi_color',
            [
                'label' => __('Pagination Color', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mas-addons-pagination > a' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .mas-addons-pagination > span ' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .mas-addons-pagination a span.mas-addons-pagination-icon ' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'enable_pagination' => 'yes'
                ],
            ]
        );
        $this->add_control(
            'pagi_bg_color',
            [
                'label' => __('Pagination Background Color', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mas-addons-pagination > a' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .mas-addons-pagination > span ' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .mas-addons-pagination a span.mas-addons-pagination-icon' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'enable_pagination' => 'yes'
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'page_border',
                'label' => __('Pagination Border', 'mas-addons'),
                'selector' => '{{WRAPPER}} .mas-addons-pagination > a, {{WRAPPER}} .mas-addons-pagination > span',
                'condition' => [
                    'enable_pagination' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'hr',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );

        $this->add_responsive_control(
            'pagi_align',
            [
                'label' => __('Align', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'mas-addons'),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'mas-addons'),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'mas-addons'),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .mas-addons-pagination'    => 'text-align: {{VALUE}};',
                ],
                'devices' => ['desktop', 'tablet', 'mobile'],
                'toggle' => true,
            ]
        );
        $this->add_responsive_control(
            'pagi_margin',
            [
                'label' => __('Pagination Margin', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .mas-addons-pagination'    => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} mas-addons-pagination' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'enable_pagination' => 'yes'
                ],
            ]
        );

        $this->add_responsive_control(
            'pagi_radius',
            [
                'label' => __('Pagination Border Radius', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .mas-addons-pagination > a'    => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .mas-addons-pagination > span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'enable_pagination' => 'yes'
                ],
            ]
        );

        $this->end_controls_tab();
        $this->start_controls_tab(
            'pagination_hover',
            [
                'label' => __('Hover', 'mas-addons'),
                'condition' => [
                    'enable_pagination' => 'yes'
                ],
            ]
        );
        $this->add_control(
            'pagi_hover_color',
            [
                'label' => __('Pagination Hover Color', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mas-addons-pagination > a:hover' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .mas-addons-pagination > span:hover ' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .mas-addons-pagination > span.current ' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .mas-addons-pagination a:hover span.mas-addons-pagination-icon ' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'enable_pagination' => 'yes'
                ],
            ]
        );
        $this->add_control(
            'pagi_hover_bg_color',
            [
                'label' => __('Pagination Background Hover Color', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mas-addons-pagination > a:hover' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .mas-addons-pagination > span:hover ' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .mas-addons-pagination > span.current ' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .mas-addons-pagination a:hover span.mas-addons-pagination-icon' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'enable_pagination' => 'yes'
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'page_hover_border',
                'label' => __('Pagination Hover Border', 'mas-addons'),
                'selector' => '{{WRAPPER}} .mas-addons-pagination > a:hover, {{WRAPPER}} .mas-addons-pagination > span:hover,{{WRAPPER}} .mas-addons-pagination > span.current',
                'condition' => [
                    'enable_pagination' => 'yes'
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        $this->start_controls_section(
            'content_box',
            [
                'label' => __('Content Box', 'mas-addons'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'      => 'content_bg_overly',
                'types'     => ['classic', 'gradient'],
                'selector'  => '{{WRAPPER}} .post-content-wrap',
                'label' => __('Content Background Color', 'mas-addons'),
            ]
        );

        $this->add_responsive_control(
            'content_radius',
            [
                'label' => __('Border Radius', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    'body:not(.rtl) {{WRAPPER}} .post-content-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .post-content-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'content_box_margin',
            [
                'label' => __('Margin', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    'body:not(.rtl) {{WRAPPER}} .mas-addons-post-widget-item .post-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .post-content-wrap' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'content_box_padding',
            [
                'label' => __('Padding', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    'body:not(.rtl) {{WRAPPER}} .post-content-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .post-content-wrap' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
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
                'label' => __('Navigation - Arrow', 'mas-addons'),
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
                'label' => __('Normal', 'mas-addons'),
            ]
        );

        $this->add_control(
            'arrow_color',
            [
                'label' => __('Color', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .blog-slider-arrow button' => 'color: {{VALUE}}; border-color: {{VALUE}};',
                    '{{WRAPPER}} .blog-slider-arrow button svg path' => 'stroke: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'arrow_color_fill',
            [
                'label' => __('Line Color', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .blog-slider-arrow button' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .blog-slider-arrow button svg path' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'arrow_bg_color',
            [
                'label' => __('Background Color', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blog-slider-arrow button' => 'background-color: {{VALUE}} !important;',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'      => 'arrow_border',
                'selector'  => '{{WRAPPER}} .blog-slider-arrow button',
            ]
        );


        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'arrow_shadow',
                'label' => __('Shadow', 'mas-addons'),
                'selector' => '{{WRAPPER}} .blog-slider-arrow button ',
            ]
        );




        $this->add_control(
            'arrow_position_toggle',
            [
                'label' => __('Position', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::POPOVER_TOGGLE,
                'label_off' => __('None', 'mas-addons'),
                'label_on' => __('Custom', 'mas-addons'),
                'return_value' => 'yes',
            ]
        );
        $this->start_popover();
        $this->add_control(
            'offset_orientation_v',
            [
                'label' => __('Vertical Orientation', 'elementor'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'toggle' => false,
                'default' => 'start',
                'options' => [
                    'top' => [
                        'title' => __('Top', 'elementor'),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'bottom' => [
                        'title' => __('Bottom', 'elementor'),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                ],
                'render_type' => 'ui',
                'selectors' => [
                    '{{WRAPPER}} .blog-slider-arrow' => '{{VALUE}}: 0;',
                ],
            ]
        );
        $this->add_responsive_control(
            'arrow_position_top',
            [
                'label' => __('Vertical', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['%', 'px'],
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
                    '{{WRAPPER}} .blog-slider-arrow' => 'top: {{SIZE}}{{UNIT}} !important; bottom:auto',
                ],
                'condition' => [
                    'offset_orientation_v' => 'top',
                ],
            ]
        );
        $this->add_responsive_control(
            'arrow_position_bottom',
            [
                'label' => __('Vertical', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['%', 'px'],
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
                    '{{WRAPPER}} .blog-slider-arrow' => 'bottom: {{SIZE}}{{UNIT}} !important; top:auto',
                ],
                'condition' => [
                    'offset_orientation_v' => 'bottom',
                ],
            ]
        );
        $this->add_control(
            'arrow_horizontal_position',
            [
                'label'             => __('Horizontal Position', 'mas-addons'),
                'type'              => \Elementor\Controls_Manager::SELECT,
                'default'           => 'default',
                'options'           => [
                    'default'    =>   __('Default',    'mas-addons'),
                    'space_between'    =>   __('Space Between',    'mas-addons'),
                ],
                'separator' => 'after',
            ]
        );
        $this->add_responsive_control(
            'arrow_position_x_prev',
            [
                'label' => __('Horizontal Prev', 'happy-elementor-addons'),
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
                    '{{WRAPPER}} .blog-slick-prev' => 'left: {{SIZE}}{{UNIT}}; right: auto !important;',
                ],
                'condition' => [
                    'arrow_horizontal_position' => 'space_between',
                ],
            ]
        );
        $this->add_responsive_control(
            'arrow_position_right',
            [
                'label' => __('Horizontal Next', 'happy-elementor-addons'),
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
                    '{{WRAPPER}} .blog-slick-next' => 'right: {{SIZE}}{{UNIT}} !important; left: auto !important;',
                ],
                'condition' => [
                    'arrow_horizontal_position' => 'space_between',
                ],
            ]
        );
        $this->add_responsive_control(
            'arrow_gap_',
            [
                'label' => __('Arrow Gap', 'happy-elementor-addons'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'max' => 1000,
                    ],
                    '%' => [
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .blog-slick-prev' => 'margin-right: {{SIZE}}{{UNIT}} !important;',
                    '{{WRAPPER}} .blog-slick-next ' => 'margin-right: 0 !important;',
                ],
                'condition' => [
                    'arrow_horizontal_position' => 'default',
                ],
            ]
        );
        $this->add_responsive_control(
            'align_arrow',
            [
                'label' => __('Alignment', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'mas-addons'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'mas-addons'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'mas-addons'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}} .blog-slider-arrow' => 'text-align: {{VALUE}};',
                ],
                'condition' => [
                    'arrow_horizontal_position' => 'default',
                ],
            ]
        );
        $this->end_popover();





        $this->add_responsive_control(
            'arrow_icon_size',
            [
                'label' => __('Icon Size', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 150,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}}  .blog-slider-arrow button i' => 'font-size: {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}}  .blog-slider-arrow button svg' => 'width: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'arrow_size_box',
            [
                'label' => __('Size', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 20,
                        'max' => 150,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .blog-slider-arrow button' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}',
                ],
            ]

        );

        $this->add_responsive_control(
            'arrow_size_line_height',
            [
                'label' => __('Line Height', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 150,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .blog-slider-arrow button' => 'line-height: {{SIZE}}{{UNIT}} !important;',
                ],
            ]

        );

        $this->add_responsive_control(
            'arrows_border_radius',
            [
                'label'      => __('Border Radius', 'mas-addons'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .blog-slider-arrow button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .blog-slider-arrow button ' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );







        $this->end_controls_tab();

        $this->start_controls_tab(
            '_tab_arrow_hover',
            [
                'label' => __('Active', 'mas-addons'),
            ]
        );

        $this->add_control(
            'arrow_hover_color',
            [
                'label' => __('Color', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blog-slider-arrow .slick-active' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .blog-slider-arrow button:hover ' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .blog-slider-arrow .slick-active svg path' => 'stroke: {{VALUE}};',
                    '{{WRAPPER}} .blog-slider-arrow button:hover svg path ' => 'stroke: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'arrow_hover_fill_color',
            [
                'label' => __('Line Color', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blog-slider-arrow .slick-active' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .blog-slider-arrow button:hover ' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .blog-slider-arrow .slick-active path' => 'fill: {{VALUE}};',
                    '{{WRAPPER}} .blog-slider-arrow button:hover path' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'arrow_bg_hover_color',
            [
                'label' => __('Background Color Hover', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blog-slider-arrow button:hover ' => 'background-color: {{VALUE}}  !important;',
                    '{{WRAPPER}} .blog-slider-arrow .slick-active ' => 'background-color: {{VALUE}}  !important;',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'      => 'arrow_border_hover',
                'selector'  => '{{WRAPPER}} .blog-slider-arrow button:hover',
            ]
        );


        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();


        /* end arrow */



        $this->start_controls_section(
            'section_content_box_style',
            [
                'label' => __('Box', 'mas-addons'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs(
            'box_style_tabs'
        );
        $this->start_controls_tab(
            'box_style_normal_tab',
            [
                'label' => __('Normal', 'mas-addons'),
            ]
        );

        $this->add_control(
            'box_bg_color',
            [
                'label' => __('Box Backgroound Color', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mas-addons-post-widget-item' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'box_shadow',
                'label' => __('Box Hover Shadow', 'mas-addons'),
                'selector' => '{{WRAPPER}} .mas-addons-post-widget-item',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'box_border',
                'label' => __('Box Border', ''),
                'selector' => '{{WRAPPER}} .mas-addons-post-widget-item',
            ]
        );

        $this->add_control(
            'layout_gap',
            [
                'label' => __('Item Gap', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::POPOVER_TOGGLE,
                'label_off' => __('Default', 'mas-addons'),
                'label_on' => __('Custom', 'mas-addons'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

       /*  $this->start_popover(); */

        $this->add_responsive_control(
            'gap_right',
            [
                'label'          => __('Gap Right', 'mas-addons'),
                'type'           => \Elementor\Controls_Manager::SLIDER,
                'size_units'     => ['px'],
                'range'          => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                ],
                'selectors'      => [
                    '{{WRAPPER}} .mas-addons-post-widget-wrap' => 'padding: 0 {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .row' => 'margin-right: -{{SIZE}}{{UNIT}};margin-left: -{{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'gap_bottom',
            [
                'label'          => __('Gap Bottom', 'mas-addons'),
                'type'           => \Elementor\Controls_Manager::SLIDER,
                'size_units'     => ['px'],
                'range'          => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                ],
                'selectors'      => [
                    '{{WRAPPER}} .mas-addons-post-widget-item' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .advis-blog-wraper' => 'margin-bottom: -{{SIZE}}{{UNIT}};',
                ],
            ]
        );
   /*      $this->end_popover(); */

        $this->add_responsive_control(
            'box_radius',
            [
                'label' => __('Box Radius', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    'body:not(.rtl) {{WRAPPER}} .mas-addons-post-widget-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .mas-addons-post-widget-item' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'box_padding',
            [
                'label' => __('Box Padding', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    ' {{WRAPPER}} .mas-addons-post-widget-item ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );



        $this->end_controls_tab();
        $this->start_controls_tab(
            'box_style_hover_tab',
            [
                'label' => __('Hover', 'mas-addons'),
            ]
        );
        $this->add_control(
            'box_hover_bg_color',
            [
                'label' => __('Box Backgroound Color', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'defautl' => '#233aff',
                'selectors' => [
                    '{{WRAPPER}} .mas-addons-post-widget-item:hover:after' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'box_hover_radius',
            [
                'label' => __('Box Radius', 'mas-addons'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    'body:not(.rtl) {{WRAPPER}} .mas-addons-post-widget-item:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .mas-addons-post-widget-item:hover' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'box_hover_shadow',
                'label' => __('Box Hover Shadow', 'mas-addons'),
                'selector' => '{{WRAPPER}} .mas-addons-post-widget-item:hover',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'box_hover_border',
                'label' => __('Box Border', ''),
                'selector' => '{{WRAPPER}} .mas-addons-post-widget-item:hover ',
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
    function get_render_icon($icon)
    {
        ob_start();
        \Elementor\Icons_Manager::render_icon($icon, ['aria-hidden' => 'true']);
        return ob_get_clean();
    }


    protected function render()
    {
        $settings = $this->get_settings();
        $blog_style = $settings['post_style'];
        $include_categories = [];
        $exclude_tags = [];
        $include_tags = '';
        $include_authors = '';
        $exclude_categories = [];
        $exclude_authors = '';
        $current_post_id = '';


        //this code slider option

        $slider_extraSetting = array(

            'loop' => (!empty($settings['loop']) && 'yes' === $settings['loop']) ? true : false,
            'dots' => (!empty($settings['dots']) && 'yes' === $settings['dots']) ? true : false,
            'autoplay' => (!empty($settings['autoplay']) && 'yes' === $settings['autoplay']) ? true : false,
            'nav' => (!empty($settings['arrows']) && 'yes' === $settings['arrows']) ? true : false,
            'mousedrag' => (!empty($settings['mousedrag']) && 'yes' === $settings['mousedrag']) ? true : false,
            'show_vertical' => (!empty($settings['show_vertical']) && 'yes' === $settings['show_vertical']) ? true : false,
            'show_center_mode' => (!empty($settings['show_center_mode']) && 'yes' === $settings['show_center_mode']) ? true : false,
            'autoplaytimeout' => !empty($settings['autoplaytimeout']) ? $settings['autoplaytimeout'] : '5000',
            // 'slider_center_padding' => !empty($settings['slider_center_padding']) ? $settings['slider_center_padding'] : '300',

            //this a responsive layout
            'per_coulmn' => (!empty($settings['per_coulmn'])) ? $settings['per_coulmn'] : 3,
            'per_coulmn_tablet' => (!empty($settings['per_coulmn_tablet'])) ? $settings['per_coulmn_tablet'] : 2,
            'per_coulmn_mobile' => (!empty($settings['per_coulmn_mobile'])) ? $settings['per_coulmn_mobile'] : 1
        );

        $jasondecode = wp_json_encode($slider_extraSetting);
        $image_hover_style = $settings['image_hover_style'];

        $masonary_active =  $settings['enable_masonry'];

        // $random_number = random_int(100000, 999999);

        if (('yes' == $settings['show_slider_settings'])) {
            $this->add_render_attribute('blog_version', 'class', array('blog-slider', 't-style',));
            $this->add_render_attribute('blog_version', 'data-settings', $jasondecode);
        } else {
            $this->add_render_attribute('blog_version', 'class', array($blog_style, $masonary_active, 'row justify-content-center'));
            //gride class
            $grid_classes = [];
            $grid_classes[] = 'col-xl-' . $settings['per_line'];
            $grid_classes[] = 'col-md-' . $settings['per_line_tablet'];
            $grid_classes[] = 'col-sm-' . $settings['per_line_mobile'];
            $grid_classes = implode(' ', $grid_classes);
            $this->add_render_attribute('grid_classes', 'class', [$grid_classes, 'mas-addons-post-widget-wrap col-lg-6', $image_hover_style]);
        }

        //End code slider option


        if (0 != count($settings['include_categories'])) {
            $include_categories['tax_query'] = [
                'taxonomy' => 'category',
                'field'    => 'slug',
                'terms'    => $settings['include_categories'],
            ];
        }
        if (0 != count($settings['include_tags'])) {
            $include_tags = implode(',', $settings['include_tags']);
        }
        if (0 != count($settings['include_authors'])) {
            $include_authors = implode(',', $settings['include_authors']);
        }
        if (0 != count($settings['exclude_categories'])) {
            $exclude_categories['tax_query'] = [
                'taxonomy' => 'category',
                'operator' => 'NOT IN',
                'field'    => 'slug',
                'terms'    => $settings['exclude_categories'],
            ];
        }
        if (0 != count($settings['exclude_tags'])) {
            $exclude_tags['tax_query'] = [
                'taxonomy' => 'post_tag',
                'operator' => 'NOT IN',
                'field'    => 'slug',
                'terms'    => $settings['exclude_tags'],
            ];
        }
        if (0 != count($settings['exclude_authors'])) {
            $exclude_authors = implode(',', $settings['exclude_authors']);
        }
        if (in_array('current_post', $settings['exclude_by'])) {
            $current_post_id = get_the_ID();
        }
        // var_dump($settings['exclude_categories']);
        if ('related' == $settings['source'] && is_single() && 'post' == get_post_type()) {
            $related_categories = get_the_terms(get_the_ID(), 'category');
            $related_cats = [];
            foreach ($related_categories as $related_cat) {
                $related_cats[] = $related_cat->slug;
            }
            $the_query = new \WP_Query(array(
                'posts_per_page' => $settings['posts_per_page'],
                'post_type' => 'post',
                'orderby' => $settings['orderby'],
                'order' => $settings['order'],
                'post__not_in' => array($current_post_id),
                'paged' => get_query_var('paged') ? get_query_var('paged') : 1,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'category',
                        'operator' => 'IN',
                        'field'    => 'slug',
                        'terms'    => $related_cats,
                    ),
                ),
            ));
        } elseif ('manual_selection' == $settings['source']) {
            $the_query = new \WP_Query(array(
                'posts_per_page' => $settings['posts_per_page'],
                'post_type' => 'post',
                'orderby' => $settings['orderby'],
                'order' => $settings['order'],
                'paged' => get_query_var('paged') ? get_query_var('paged') : 1,
                'post__in' => (0 != count($settings['manual_selection'])) ? $settings['manual_selection'] : array(),
            ));
        } else {
            $the_query = new \WP_Query(array(
                'posts_per_page' => $settings['posts_per_page'],
                'post_type' => 'post',
                'orderby' => $settings['orderby'],
                'order' => $settings['order'],
                'paged' => get_query_var('paged') ? get_query_var('paged') : 1,
                'post_tag' => (0 != count($settings['include_tags'])) ? $include_tags : '',
                'post__not_in' => array($current_post_id),
                'author' => (0 != count($settings['include_authors'])) ? $include_authors : '',
                'author__not_in' => (0 != count($settings['exclude_authors'])) ? $exclude_authors : '',
                'tax_query' => array(
                    'relation' => 'AND',
                    (0 != count($settings['exclude_tags'])) ? $exclude_tags : '',
                    (0 != count($settings['exclude_categories'])) ? $exclude_categories : '',
                    (0 != count($settings['include_categories'])) ? $include_categories : '',
                ),
            ));
        } ?>
        <div class="advis-blog-wraper">

            <div <?php echo $this->get_render_attribute_string('blog_version'); ?>>

                <?php
                $i = 0;
                while ($the_query->have_posts()) : $the_query->the_post(); ?>
                    <?php
                    $i++;
                    $top_meta = '';
                    $bottom_meta = '';
                    $idd = get_the_ID();
                    $cat_icon = $this->get_render_icon($settings['cat_icon']);
                    $comment_icon = $this->get_render_icon($settings['comment_icon']);
                    $date_icon = $this->get_render_icon($settings['date_icon']);
                    $comment_text =  $settings['comment_text'];

                    $excerpt = ($settings['excerpt_limit']['size']) ? wp_trim_words(get_the_excerpt(), $settings['excerpt_limit']['size'], '...') : get_the_excerpt();
                    $title = ($settings['title_limit']['size']) ? wp_trim_words(get_the_title(), $settings['title_limit']['size'], '...') : get_the_title();

                    // if (1 === $i && $settings['first_post_grid']) {
                    //     $post_grid = 'col-md-' . $settings['first_post_grid'];
                    // } else {
                    //     $post_grid = $post_grid_global;
                    // }

                    if ($this->get_render_icon($settings['author_icon'])) {
                        $author_icon = $this->get_render_icon($settings['author_icon']);
                    } else {
                        $author_icon = $settings['author_text'];
                    }

                    // Author meta
                    if ('top' == $settings['author_position']) {
                        $top_meta .= 'yes' == $settings['show_author'] ? mas_addons_posted_by($author_icon) : '';
                    } else {
                        $bottom_meta .= 'yes' == $settings['show_author'] ? mas_addons_posted_by($author_icon) : '';
                    }

                    // category meta
                    if ('top' == $settings['cat_position']) {
                        $top_meta .= 'yes' == $settings['show_category'] ? mas_addons_posted_category($cat_icon) : '';
                    } else {
                        $bottom_meta .= 'yes' == $settings['show_category'] ? mas_addons_posted_category($cat_icon) : '';
                    }

                    // Date meta
                    if ('top' == $settings['date_position']) {
                        $top_meta .= 'yes' == $settings['show_date'] ? mas_addons_posted_date($date_icon) : '';
                    } else {
                        $bottom_meta .= 'yes' == $settings['show_date'] ? mas_addons_posted_date($date_icon) : '';
                    }

                    // Comment meta
                    if ('top' == $settings['comment_position']) {
                        $top_meta .= 'yes' == $settings['show_comment'] ? mas_addons_comment_count($comment_text, $comment_icon) : '';
                    } else {
                        $bottom_meta .= 'yes' == $settings['show_comment'] ? mas_addons_comment_count($comment_text, $comment_icon) : '';
                    }

                    ?>

                    <div <?php echo $this->get_render_attribute_string('grid_classes'); ?>>
                        <div class="mas-addons-post-widget-item <?php printf('post-style-%s', esc_attr($settings['post_style'])) ?>">
                            <?php if ($blog_style) {
                                include('blogcontent/' . $blog_style . '.php');
                            } ?>

                        </div>
                    </div>
                <?php
                endwhile; ?>

            </div>

            <?php if ('yes' == $settings['show_slider_settings'] && 'yes' == $settings['arrows']) : ?>
                <div class="blog-slider-arrow">
                    <?php if (!empty($settings['arrow_prev_icon']['value'])) : ?>
                        <button type="button" class="slick-prev prev slick-arrow slick-active prev-<?php echo esc_attr( $this->get_ID()); ?>">
                            <?php \Elementor\Icons_Manager::render_icon($settings['arrow_prev_icon'], ['aria-hidden' => 'true']); ?>
                        </button>
                    <?php endif; ?>

                    <?php if (!empty($settings['arrow_next_icon']['value'])) : ?>
                        <button type="button" class="slick-next next slick-arrow next-<?php echo esc_attr( $this->get_ID()); ?>">
                            <?php \Elementor\Icons_Manager::render_icon($settings['arrow_next_icon'], ['aria-hidden' => 'true']); ?>
                        </button>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

        </div>

        <!-- pagination -->
<?php
        if ($settings['enable_pagination']) :
            $big = 999999999; // need an unlikely integer
            echo '<div class="row"><div class="col-12"><div class="mas-addons-pagination">';
            echo paginate_links(array(
                'base' => str_replace($big, '%#%', get_pagenum_link($big)),
                'format' => '?paged=%#%',
                'current' => max(1, get_query_var('paged')),
                'prev_text' => '<span class="mas-addons-pagination-icon"><i class="fas fa-angle-left"> </i></span>',
                'next_text' => '<span class="mas-addons-pagination-icon"><i class="fas fa-angle-right"> </i></span>',
                'total' => $the_query->max_num_pages,
            ));
            echo '</div></div></div>';
        endif;
        wp_reset_postdata();
    }
}

$widgets_manager->register(new \Mas_Addons\Widgets\Blog());
