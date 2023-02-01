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
class xmoze_portfolio_loop extends \Elementor\Widget_Base
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
        return 'xmoze-portfolio';
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
        return __('Portfolio', 'xmoze-ts');
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
            'section_layout',
            [
                'label' => __('Layout', 'xmoze-ts'),
            ]
        );
        $this->add_control(
            'layout_type',
            [
                'label' => __('Layout type', 'xmoze-ts'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => array(
                    'masonry' => 'Masonry',
                    'normal' => 'Normal',
                    'slider' => 'Slider',
                ),
                'default' => 'masonry',
            ]
        );
        // $this->add_control(
        //     'content_position',
        //     [
        //         'label' => __('Content Position', 'xmoze-ts'),
        //         'type' => \Elementor\Controls_Manager::SELECT,
        //         'options' => array(
        //             'on-image' => 'On Image',
        //             'below-image' => 'Below Image',
        //             'disabled' => 'Hidden',
        //         ),
        //         'default' => 'on-image',
        //     ]
        // );

   

        $this->add_control(
            'enable_filtering',
            [
                'label' => __('Enable Filtering??', 'xmoze-ts'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'xmoze-ts'),
                'label_off' => __('No', 'xmoze-ts'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

     


        $this->add_control(
            'enable_loadmore',
            [
                'label' => __('Enable Loadmore?', 'xmoze-ts'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'xmoze-ts'),
                'label_off' => __('No', 'xmoze-ts'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
        $this->add_control(
            'loadmore_text',
            [
                'label' => __('Loadmore Text', 'xmoze-ts'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'default' => __('Load more works', 'xmoze-ts'),
                'condition' => [
                    'enable_loadmore' => 'yes'
                ],
            ]
        );
        $this->add_control(
            'loadmore_align',
            [
                'label' => __('Loadmore Align', 'xmoze-ts'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'xmoze-ts'),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __('top', 'xmoze-ts'),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'xmoze-ts'),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'condition' => [
                    'enable_loadmore' => 'yes'
                ],
                'default' => 'center',
                'toggle' => true,
            ]
        );
        $this->add_control(
            'loadmore_gap',
            [
                'label' => __('Loadmore Top Gap', 'xmoze-ts'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 400,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 100,
                ],
                'selectors' => [
                    '{{WRAPPER}}  .xmoze-loadmore-wrap' => 'margin-top:{{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'enable_loadmore' => 'yes'
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'section_width_nd_height',
            [
                'label' => __('Width & Height', 'xmoze-ts'),
            ]
        );
        $this->add_control(
            'all_text',
            [
                'label' => __('Filter first item text', 'xmoze-ts'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('All WOrks', 'xmoze-ts'),
                'condition' => [
                    'enable_filtering' => 'yes'
                ],
            ]
        );
        $this->add_control(
            'use_meta_grid',
            [
                'label' => __('Use grid from meta?', 'xmoze-ts'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'xmoze-ts'),
                'label_off' => __('No', 'xmoze-ts'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
        $this->add_responsive_control(
            'post_grid',
            [
                'label' => __('Post Column', 'xmoze-ts'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => array(
                    'col-md-12' => '1 Column',
                    'col-md-6' => '2 Column',
                    'col-md-4' => '3 Column',
                    'col-md-3' => '4 Column',
                ),
                'default' => 'col-md-4',
                'condition' => [
                    'use_meta_grid!' => 'yes'
                ],
            ]
        );

        $this->add_responsive_control(
            'column_verti_gap',
            [
                'label' => __('Column Vertical Gap', 'xmoze-ts'),
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
                'label' => __('Column Horizontal Gap', 'xmoze-ts'),
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
                ]
            ]
        );
        $this->add_control(
            'use_custom_height',
            [
                'label' => __('Use custom height?', 'xmoze-ts'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'xmoze-ts'),
                'label_off' => __('No', 'xmoze-ts'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
        $this->add_responsive_control(
            'normal_image_height',
            [
                'label' => __('Normal Image Height', 'xmoze-ts'),
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
                    '{{WRAPPER}}  .xmoze-portfolio-item-wrap.height-normal .xmoze-portfolio-item img' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'use_custom_height' => 'yes'
                ],
            ]
        );

        $this->add_responsive_control(
            'big_image_height',
            [
                'label' => __('Big Image Height', 'xmoze-ts'),
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
                    '{{WRAPPER}}  .xmoze-portfolio-item-wrap.height-big .xmoze-portfolio-item img' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'use_custom_height' => 'yes'
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'section_query',
            [
                'label' => __('Query', 'xmoze-ts'),
            ]
        );
        $this->add_control(
            'posts_per_page',
            [
                'label' => __('Posts per page', 'xmoze-ts'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 5,
            ]
        );
        $this->add_control(
            'source',
            [
                'label'         => __('Source', 'xmoze-ts'),
                'type'          => \Elementor\Controls_Manager::SELECT,
                'options'       => [
                    'portfolio' => 'Portfolio',
                    'manual_selection' => 'Manual Selection',
                    'related' => 'Related',
                    'meta' => 'Meta',
                ],
                'default' =>    'portfolio',
            ]
        );
        $this->add_control(
            'portfolio_type',
            [
                'label'         => __('Portfolio type', 'xmoze-ts'),
                'type'          => \Elementor\Controls_Manager::SELECT,
                'options'       => xmoze_get_meta_field_keys('portfolio', 'portfolio_type'),
                'default' =>    xmoze_get_meta_field_keys('portfolio', 'portfolio_type', 'value'),
                'condition' => [
                    'source' => 'meta'
                ],
            ]
        );
        $this->add_control(
            'manual_selection',
            [
                'label'         => __('Manual Selection', 'xmoze-ts'),
                'type'          => \Elementor\Controls_Manager::SELECT2,
                'description'   => __('Get specific template posts', 'xmoze-ts'),
                'label_block'   => true,
                'multiple'      => true,
                'options'       => xmoze_cpt_slug_and_id('portfolio'),
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
                'label' => __('Include', 'xmoze-ts'),
                'condition' => [
                    'source!' => 'manual_selection'
                ],
            ]
        );
        $this->add_control(
            'include_by',
            [
                'label'         => __('Include by', 'xmoze-ts'),
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
                'label'         => __('Include categories', 'xmoze-ts'),
                'type'          => \Elementor\Controls_Manager::SELECT2,
                'description'   => __('Get templates for specific category(s)', 'xmoze-ts'),
                'label_block'   => true,
                'multiple'      => true,
                'options'       => xmoze_cpt_taxonomy_slug_and_name('portfolio-category'),
                'default' =>    [],
                'condition' => [
                    'include_by' => 'category',
                    'source!' => 'related'
                ],
            ]
        );
        $this->add_control(
            'include_tags',
            [
                'label'         => __('Include Tags', 'xmoze-ts'),
                'type'          => \Elementor\Controls_Manager::SELECT2,
                'description'   => __('Get templates for specific tag(s)', 'xmoze-ts'),
                'label_block'   => true,
                'multiple'      => true,
                'options'       => xmoze_cpt_taxonomy_slug_and_name('portfolio-tag'),
                'default' =>    [],
                'condition' => [
                    'include_by' => 'tags',
                    'source!' => 'related'
                ],
            ]
        );
        $this->add_control(
            'include_authors',
            [
                'label'         => __('Include authors', 'xmoze-ts'),
                'type'          => \Elementor\Controls_Manager::SELECT2,
                'description'   => __('Get templates for specific tag(s)', 'xmoze-ts'),
                'label_block'   => true,
                'multiple'      => true,
                'options'       => xmoze_cpt_author_slug_and_id('portfolio'),
                'default' =>    [],
                'condition' => [
                    'include_by' => 'author',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'exclude_tabs',
            [
                'label' => __('Exclude', 'xmoze-ts'),
                'condition' => [
                    'source!' => 'manual_selection'
                ],
            ]
        );
        $this->add_control(
            'exclude_by',
            [
                'label'         => __('Exclude by', 'xmoze-ts'),
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
                    'source!' => 'manual_selection'
                ],
            ]
        );
        $this->add_control(
            'exclude_categories',
            [
                'label'         => __('Exclude categories', 'xmoze-ts'),
                'type'          => \Elementor\Controls_Manager::SELECT2,
                'description'   => __('Get templates for specific category(s)', 'xmoze-ts'),
                'label_block'   => true,
                'multiple'      => true,
                'options'       => xmoze_cpt_taxonomy_slug_and_name('portfolio-category'),
                'default' =>    [],
                'condition' => [
                    'exclude_by' => 'category',
                    'source!' => 'related'
                ],
            ]
        );
        $this->add_control(
            'exclude_tags',
            [
                'label'         => __('Exclude Tags', 'xmoze-ts'),
                'type'          => \Elementor\Controls_Manager::SELECT2,
                'description'   => __('Get templates for specific tag(s)', 'xmoze-ts'),
                'label_block'   => true,
                'multiple'      => true,
                'options'       => xmoze_cpt_taxonomy_slug_and_name('portfolio-tag'),
                'default' =>    [],
                'condition' => [
                    'exclude_by' => 'tags',
                    'source!' => 'related'
                ],
            ]
        );
        $this->add_control(
            'exclude_authors',
            [
                'label'         => __('Exclude authors', 'xmoze-ts'),
                'type'          => \Elementor\Controls_Manager::SELECT2,
                'description'   => __('Get templates for specific tag(s)', 'xmoze-ts'),
                'label_block'   => true,
                'multiple'      => true,
                'options'       => xmoze_cpt_author_slug_and_id('portfolio'),
                'default' =>    [],
                'condition' => [
                    'exclude_by' => 'author',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->add_control(
            'orderby',
            [
                'label'         => __('Order By', 'xmoze-ts'),
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
                'label'         => __('Order', 'xmoze-ts'),
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
            'section_filter_style',
            [
                'label' => __('Filter', 'xmoze-ts'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'enable_filtering' => 'yes'
                ],
            ]
        );
        
        $this->add_responsive_control(
            'filter_align',
            [
                'label' => __('Filter Align', 'xmoze-ts'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'xmoze-ts'),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __('top', 'xmoze-ts'),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'xmoze-ts'),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}} .pf-isotope-nav' => 'text-align: {{VALUE}};',
                ],
                'toggle' => true,
                'condition' => [
                    'enable_filtering' => 'yes'
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'label' => __('Filter Typography', 'xmoze-ts'),
                'name' => 'filter_typo',
                'selector' => '{{WRAPPER}} .pf-isotope-nav li',
            ]
        );
        $this->add_control(
            'filter_color',
            [
                'label' => __('Filter Color', 'xmoze-ts'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pf-isotope-nav li' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'filter_hover_color',
            [
                'label' => __('Filter Hover Color', 'xmoze-ts'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pf-isotope-nav li.active' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'filter_hover_bg_color',
            [
                'label' => __('Filter Hover BG Color', 'xmoze-ts'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}  .pf-isotope-nav li.active' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'filtar_margin',
            [
                'label' => __('Margin', 'xmoze-ts'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .pf-isotope-nav li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}}  .pf-isotope-nav li' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'filtar_padding',
            [
                'label' => __('Padding', 'xmoze-ts'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .pf-isotope-nav li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}}  .pf-isotope-nav li' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'filtar_radius',
            [
                'label' => __('Filter Border Radius', 'xmoze-ts'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .pf-isotope-nav li' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}}  .pf-isotope-nav li' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'section_content',
            [
                'label' => __('Content', 'xmoze-ts'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'show_category',
            [
                'label' => __('Show category?', 'xmoze-ts'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'xmoze-ts'),
                'label_off' => __('No', 'xmoze-ts'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
   
        $this->add_control(
            'show_readmore',
            [
                'label' => __('Show Readmore?', 'xmoze-ts'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'xmoze-ts'),
                'label_off' => __('No', 'xmoze-ts'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_title',
            [
                'label' => __('Show Title?', 'xmoze-ts'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'xmoze-ts'),
                'label_off' => __('No', 'xmoze-ts'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'show_title_icon',
            [
                'label' => __('Show Link Icon?', 'xmoze-ts'),
                'type'  => \Elementor\Controls_Manager::SWITCHER,
                'label_on'  => __('Yes', 'xmoze-ts' ),
                'label_off' => __('No',  'xmoze-ts' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'show_popup_icon',
            [
                'label' => __('Show Popup Icon?', 'xmoze-ts'),
                'type'  => \Elementor\Controls_Manager::SWITCHER,
                'label_on'  => __('Yes', 'xmoze-ts' ),
                'label_off' => __('No',  'xmoze-ts' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'title_icon',
            [
                'label' => __('Choose Link Icon', 'xmoze-hp'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'condition' => [
                    'show_title_icon' => 'yes',
                 ]
            ]
        );

        $this->add_control(
            'popup_icon',
            [
                'label' => __('Choose Popup Icon', 'xmoze-hp'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'condition' => [
                    'show_popup_icon' => 'yes',
                 ]
            ]
        );

       

        $this->end_controls_section();

  



 //Slider Setting
        
 $this->start_controls_section('slider_settings',
 [
 'label' => __('Slider Settings', 'xmoze-hp'),
 'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
 'condition' => [
     'layout_type' => 'slider',
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

//Slider setting end




        $this->start_controls_section(
            'section_btn',
            [
                'label' => __( 'Readmore', 'xmoze-hp' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'show_readmore' => 'yes',
                 ]
            ]
        );

        $this->add_control(
            'readmore_text',
            [
                'label'    => __( 'Readmore text', 'xmoze-hp' ),
                'type'     => \Elementor\Controls_Manager::TEXT,
                'default'  => __( 'Read More', 'xmoze-hp' ),
                'conditon' => [
                    'show_readmore' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'icon',
            [
                'label'    => __( 'Icon', 'xmoze-hp' ),
                'type'     => \Elementor\Controls_Manager::ICONS,
                'conditon' => [
                    'show_readmore' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'icon_position',
            [
                'label'    => __( 'Icon Position', 'xmoze-hp' ),
                'type'     => \Elementor\Controls_Manager::SELECT,
                'default'  => 'after',
                'options'  => [
                    'before' => __( 'Before', 'xmoze-hp' ),
                    'after'  => __( 'After', 'xmoze-hp' ),
                ],
                'conditon' => [
                    'show_readmore' => 'yes',
                ],
            ]
        );
        $this->add_responsive_control(
            'button_align',
            [
                'label'        => __( 'Align', 'xmoze-hp' ),
                'type'         => \Elementor\Controls_Manager::CHOOSE,
                'options'      => [
                    'left'   => [
                        'title' => __( 'Left', 'xmoze-hp' ),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __( 'top', 'xmoze-hp' ),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'right'  => [
                        'title' => __( 'Right', 'xmoze-hp' ),
                        'icon'  => 'fa fa-align-right',
                    ],
                ],
                'devices'      => ['desktop', 'tablet', 'mobile'],
                'prefix_class' => 'content-align%s-',
                'toggle'       => true,
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'section_image',
            [
                'label' => __('Image', 'xmoze-ts'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs(
            'image_hover_tabs'
        );
        $this->start_controls_tab(
            'image_normal_tab',
            [
                'label' => __('Normal', 'xmoze-ts'),
            ]
        );
        $this->add_responsive_control(
            'image_radius',
            [
                'label' => __('Image Radius', 'xmoze-ts'),
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
                'label' => __('Button Shadow', 'xmoze-ts'),
                'selector' => '{{WRAPPER}} .xmoze-portfolio-item img',
            ]
        );
        
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'image_border',
                'label' => __('Border', 'xmoze-ts'),
                'selector' => '{{WRAPPER}} .xmoze-portfolio-item img',
            ]
        );

        $this->end_controls_tab();
        $this->start_controls_tab(
            'image_hover_tab',
            [
                'label' => __('Hover', 'xmoze-ts'),
            ]
        );
        $this->add_responsive_control(
            'image_hover_radius',
            [
                'label' => __('Box Image Radius', 'xmoze-ts'),
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
                'label' => __('Button Shadow', 'xmoze-ts'),
                'selector' => '{{WRAPPER}} .xmoze-portfolio-item:hover img',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'image_hover_border',
                'label' => __('Border', 'xmoze-ts'),
                'selector' => '{{WRAPPER}} .xmoze-portfolio-item:hover img',
            ]
        );
        $this->add_control(
            'enable_hover_rotate',
            [
                'label' => __('Rotate animation on hover?', 'xmoze-ts'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'xmoze-ts'),
                'label_off' => __('No', 'xmoze-ts'),
                'return_value' => 'xmoze-hover-rotate',
                'default' => 'no',
            ]
        );
        $this->add_control(
            'image_hover_animation',
            [
                'label' => __('Hover Animation', 'xmoze-ts'),
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
            'section_category_style',
            [
                'label' => __('Category', 'xmoze-hp'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_category' => 'yes',
                 ]
            ]
        );
        $this->start_controls_tabs(
            'category_style_tabs'
        );
        $this->start_controls_tab(
            'category_style_normal_tab',
            [
                'label' => __('Normal', 'xmoze-hp'),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'label' => __('Category Typography', 'xmoze-ts'),
                'name' => 'category_typo',
                'selector' => '{{WRAPPER}} .xmoze-pf-category',
            ]
        );
        $this->add_control(
            'category_color',
            [
                'label' => __('Category Color', 'xmoze-ts'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xmoze-pf-category' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'category_gap',
            [
                'label' => __('Category Gap', 'xmoze-ts'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 400,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}}  .xmoze-pf-category' => 'margin-bottom:{{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'category_style_hover_tab',
            [
                'label' => __('Hover', 'xmoze-hp'),
            ]
        );
        $this->add_control(
            'category_color_hover',
            [
                'label' => __('Category Color', 'xmoze-ts'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xmoze-pf-category:hover' => 'color: {{VALUE}};',
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
                'condition' => [
                    'show_title' => 'yes',
                 ]
            ]
        );
        
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'label' => __('Title Typography', 'xmoze-ts'),
                'name' => 'title_typo',
                'selector' => '{{WRAPPER}} .xmoze-portfolio-title h3',
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label' => __('Title Color', 'xmoze-ts'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xmoze-portfolio-title h3' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'title_color_hover',
            [
                'label' => __('Title Hover Color', 'xmoze-ts'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xmoze-portfolio-title h3:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'title_margin',
            [
                'label'      => __( 'Margin', 'xmoze-hp' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .xmoze-portfolio-title h3'          => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .xmoze-portfolio-title h3' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'wrap_title_margin',
            [
                'label'      => __( 'Wrap Margin', 'xmoze-hp' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .xmoze-portfolio-title'          => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .xmoze-portfolio-title' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        
        $this->start_controls_section(
        'link_icon_popup_icon',
            [
                'label' => __('Link/ Popup Icon', 'xmoze-ts'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs(
            'lp_style_tabs'
        );
        $this->start_controls_tab(
            'lp_style_normal_tab',
            [
                'label' => __('Normal', 'xmoze-hp'),
            ]
        );
        $this->add_control(
            'lp_icon_line_color',
            [
                'label' => __('Icon Line Color', 'xmoze-hp'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .links-icons svg path' => 'stroke: {{VALUE}}',
                    '{{WRAPPER}} .links-icons i' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'lp_icon_fill_color',
            [
                'label' => __('SVG Fill Color', 'xmoze-hp'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .links-icons svg path' => 'fill: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'lp_bg_color',
            [
                'label' => __('Background Color', 'xmoze-hp'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .links-icons a' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'lp_icon_rotate',
            [
                'label' => __('Rotate icon', 'xmoze-hp'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -360,
                        'max' => 360,
                    ],
                ],
                'devices' => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .links-icons svg, {{WRAPPER}} .links-icons i' => 'transform: rotate( {{SIZE}}deg );',
                ],
            ]
        );
        $this->add_responsive_control(
            'lp_icon_size',
            [
                'label' => __('icon Size', 'xmoze-hp'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -360,
                        'max' => 360,
                    ],
                ],
                'devices' => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .links-icons  svg' => 'width: {{SIZE}}{{UNIT}} ;',
                    '{{WRAPPER}} .links-icons  i' => 'font-size: {{SIZE}}{{UNIT}} ;',
                ],
            ]
        );

        $this->add_responsive_control(
            'lp_icon_box_size',
            [
                'label' => __('icon Hieght Widget', 'xmoze-hp'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .links-icons  a' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );


        $this->add_responsive_control(
            'lp_radius', 
            [
                'label'      => __( 'Border Radius', 'xmoze-hp' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .links-icons'          => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .links-icons' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'lp_padding', 
            [
                'label'      => __( 'Padding', 'xmoze-hp' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .links-icons'          => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .links-icons' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'lp_margin', 
            [
                'label'      => __( 'Margin', 'xmoze-hp' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .links-icons'          => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .links-icons' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'lp_style_hover_tab',
            [
                'label' => __('Hover', 'xmoze-hp'),
            ]
        );
        
        $this->add_control(
            'lp_icon_line_color_hover',
            [
                'label' => __('Icon Line Color', 'xmoze-hp'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .links-icons:hover svg path' => 'stroke: {{VALUE}}',
                    '{{WRAPPER}} .links-icons:hover i' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'lp_icon_fill_color_hover',
            [
                'label' => __('SVG Fill Color', 'xmoze-hp'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .links-icons:hover svg path' => 'fill: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'lp_bg_color_hover',
            [
                'label' => __('Background Color', 'xmoze-hp'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .links-icons a:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();


        $this->end_controls_section();

        $this->start_controls_section(
            'section_content_style',
            [
                'label' => __('Content Box', 'xmoze-ts'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
      $this->add_responsive_control(
            'content_align',
            [
                'label' => __('Align', 'xmoze-hp'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'xmoze-hp'),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'xmoze-hp'),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'xmoze-hp'),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .xmoze-portfolio-content' => 'text-align: {{VALUE}} !important;',
                ],
            ]
        );
        $this->add_control(
            'content_width',
            [
                'label' => __('Content Width', 'xmoze-ts'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}}  .xmoze-portfolio-content.content-postion-on-image' => 'width:{{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'content_bg_color',
				'label' => __( 'Content Background Color', 'xmoze-ts' ),
				'types' => [ 'classic', 'gradient'],
				'selector' => '{{WRAPPER}} .xmoze-portfolio-content',
			]
		);
        $this->add_control(
            'content_gap',
            [
                'label' => __('Content gap', 'xmoze-ts'),
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
                'condition' => [
                    'content_position' => 'on-image',
                ]
            ]
        );
        $this->add_control(
            'content_y_position',
            [
                'label' => __('Content Y Position', 'xmoze-ts'),
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
                'condition' => [
                    'content_position' => 'on-image',
                ]
            ]
        );
        $this->add_responsive_control(
            'content_padding',
            [
                'label' => __('Content Padding', 'xmoze-ts'),
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
                'label' => __('Content Box Radius', 'xmoze-ts'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .xmoze-portfolio-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'box_radius',
            [
                'label' => __('Box Radius', 'xmoze-ts'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    ' {{WRAPPER}} .xmoze-portfolio-item ' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'button_style',
            [
                'label' => __( 'Button', 'xmoze-hp' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE, 'condition' => [
                    'show_readmore' => 'yes',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'btn_typography',
                'label'    => __( 'Button Typography', 'xmoze-hp' ),
                'selector' => '{{WRAPPER}} .portfolio-btn',
            ]
        );
        $this->start_controls_tabs(
            'button_style_tabs'
        );
        $this->start_controls_tab(
            'button_style_normal_tab',
            [
                'label' => __( 'Normal', 'xmoze-hp' ),
            ]
        );
        $this->add_control(
            'btn_icon_color',
            [
                'label'     => __( 'Icon Color', 'xmoze-hp' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .portfolio-btn .btn-icon'      => 'color: {{VALUE}}',
                    '{{WRAPPER}} .portfolio-btn .btn-icon path' => 'stroke: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'icon_fill_color',
            [
                'label'     => __( 'Icon Fill Color', 'xmoze-hp' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .portfolio-btn .btn-icon path' => 'fill: {{VALUE}}',
                ],
                'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'icon[library]',
							'operator' => '==',
							'value' => 'svg',
						],
					],
				],
            ]
        );
        $this->add_control(
            'boxed_btn_color',
            [
                'label'     => __( 'Button Color', 'xmoze-hp' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .portfolio-btn' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'boxed_btn_background',
            [
                'label'     => __( 'Background Color', 'xmoze-hp' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .portfolio-btn' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'button_shadow',
                'label'    => __( 'Button Shadow', 'xmoze-hp' ),
                'selector' => '{{WRAPPER}} .portfolio-btn',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'button_border',
                'label'    => __( 'Border', 'xmoze-hp' ),
                'selector' => '{{WRAPPER}} .portfolio-btn',
            ]
        );
        $this->add_control(
            'btn_icon_size',
            [
                'label'      => __( 'Icon Size', 'xmoze-hp' ),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 50,
                        'step' => 1,
                    ],
                    '%'  => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .portfolio-btn .btn-icon'     => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .portfolio-btn .btn-icon svg' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'btn_icon_gap',
            [
                'label'      => __( 'Icon gap', 'xmoze-hp' ),
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
                    '{{WRAPPER}} .portfolio-btn .icon-before, body.rtl {{WRAPPER}} .portfolio-btn .icon-after '  => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .portfolio-btn .icon-after , body.rtl  {{WRAPPER}} .portfolio-btn .icon-before' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'button_radius',
            [
                'label'      => __( 'Border Radius', 'xmoze-hp' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .portfolio-btn'          => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .portfolio-btn' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'buton_style_divider',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );
        $this->add_responsive_control(
            'button_padding',
            [
                'label'      => __( 'Button Padding', 'xmoze-hp' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .portfolio-btn'          => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .portfolio-btn' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'button_style_hover_tab',
            [
                'label' => __( 'Hover', 'xmoze-hp' ),
            ]
        );
        $this->add_control(
            'btn_icon_hover_color',
            [
                'label'     => __( 'Icon Color', 'xmoze-hp' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xmoze-portfolio-widget-item:hover .portfolio-btn .btn-icon'      => 'color: {{VALUE}}',
                    '{{WRAPPER}} .xmoze-portfolio-widget-item:hover .portfolio-btn .btn-icon path' => 'stroke: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'btn_icon_fill_color_hover',
            [
                'label'     => __( 'Icon Fill Color', 'xmoze-hp' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xmoze-portfolio-widget-item:hover .portfolio-btn .btn-icon path' => 'fill: {{VALUE}}',
                ],
                'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'icon[library]',
							'operator' => '==',
							'value' => 'svg',
						],
					],
				],
            ]
        );
        $this->add_control(
            'btn_hover_color',
            [
                'label'     => __( 'Button Color', 'xmoze-hp' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xmoze-portfolio-widget-item:hover .portfolio-btn' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'btn_hover_background',
            [
                'label'     => __( 'Background Color', 'xmoze-hp' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .portfolio-btn:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'button_hover_border',
                'label'    => __( 'Border', 'xmoze-hp' ),
                'selector' => '{{WRAPPER}} .portfolio-btn:hover',
            ]
        );
        $this->add_control(
            'btn_hover_animation',
            [
                'label' => __( 'Hover Animation', 'xmoze-hp' ),
                'type'  => \Elementor\Controls_Manager::HOVER_ANIMATION,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'button_hover_shadow',
                'label'    => __( 'Button Shadow', 'xmoze-hp' ),
                'selector' => '{{WRAPPER}} .portfolio-btn:hover',
            ]
        );
        $this->add_responsive_control(
            'button_hover_radius',
            [
                'label'      => __( 'Border Radius', 'xmoze-hp' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .portfolio-btn:hover'          => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .portfolio-btn:hover' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'icon_hover_gap',
            [
                'label'      => __( 'Icon gap', 'xmoze-hp' ),
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
                    '{{WRAPPER}} .portfolio-btn:hover .icon-before'          => 'transform: translatex( -{{SIZE}}{{UNIT}} );',
                    '{{WRAPPER}} .portfolio-btn:hover .icon-after '          => 'transform: translatex( {{SIZE}}{{UNIT}} );',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();


   /*
   * 
   SLider Style start
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
            '{{WRAPPER}} .portfolio-slider ul.portfolio-slider-dot-list li' => 'background-color: {{VALUE}};',
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
            '{{WRAPPER}} .portfolio-slider ul.portfolio-slider-dot-list' => 'justify-content: {{VALUE}};',
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
            '{{WRAPPER}} .portfolio-slider ul.portfolio-slider-dot-list li' => 'width: {{SIZE}}{{UNIT}};',
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
            '{{WRAPPER}} .portfolio-slider ul.portfolio-slider-dot-list li' => 'height: {{SIZE}}{{UNIT}};',
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
            '{{WRAPPER}} .portfolio-slider ul.portfolio-slider-dot-list li ' => 'margin-right: {{SIZE}}{{UNIT}};',
            'body.rtl {{WRAPPER}} .portfolio-slider ul.portfolio-slider-dot-list li ' => 'margin-left: {{SIZE}}{{UNIT}};',
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
            '{{WRAPPER}} .portfolio-slider-dot-list' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            'body.rtl {{WRAPPER}} .portfolio-slider-dot-list' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
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
            '{{WRAPPER}} .portfolio-slider ul.portfolio-slider-dot-list li' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            'body.rtl {{WRAPPER}} .portfolio-slider ul.portfolio-slider-dot-list li' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
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
            '{{WRAPPER}} .portfolio-slider ul.portfolio-slider-dot-list li.slick-active' => 'background-color: {{VALUE}}  !important;',
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
            '{{WRAPPER}} .portfolio-slider ul.portfolio-slider-dot-list li.slick-active' => 'width: {{SIZE}}{{UNIT}} !important;',
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
            '{{WRAPPER}} .portfolio-slider ul.portfolio-slider-dot-list li.slick-active' => 'height: {{SIZE}}{{UNIT}} !important;',
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
            '{{WRAPPER}} .portfolio-slider-arrow button' => 'color: {{VALUE}}; border-color: {{VALUE}};',
            '{{WRAPPER}} .portfolio-slider-arrow button svg path' => 'stroke: {{VALUE}};',
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
            '{{WRAPPER}} .portfolio-slider-arrow button' => 'color: {{VALUE}};',
            '{{WRAPPER}} .portfolio-slider-arrow button svg path' => 'fill: {{VALUE}};',
        ],
    ]
);

$this->add_control(
    'arrow_bg_color',
    [
        'label' => __('Background Color', 'xmoze-hp'),
        'type' => \Elementor\Controls_Manager::COLOR,
        'selectors' => [
             '{{WRAPPER}} .portfolio-slider-arrow button' => 'background-color: {{VALUE}} !important;',
        ],
    ]
);

$this->add_group_control(
    \Elementor\Group_Control_Box_Shadow::get_type(),
    [
        'name' => 'arrow_shadow',
        'label' => __('Shadow', 'fd-addons'),
        'selector' => '{{WRAPPER}} .portfolio-slider-arrow button ',
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
     $start = is_rtl() ? __( 'Right', 'elementor' ) : __( 'Left', 'elementor' );
     $end = ! is_rtl() ? __( 'Right', 'elementor' ) : __( 'Left', 'elementor' );

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
                '{{WRAPPER}} .portfolio-slider-arrow' => '{{VALUE}}: 0;',
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
            '{{WRAPPER}} .portfolio-slider-arrow' => 'top: {{SIZE}}{{UNIT}} !important; bottom:auto',
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
        '{{WRAPPER}} .portfolio-slider-arrow' => 'bottom: {{SIZE}}{{UNIT}} !important; top:auto',
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
            '{{WRAPPER}}  .portfolio-slider-arrow .prev' => 'left: {{SIZE}}{{UNIT}}; right: auto !important;',
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
            '{{WRAPPER}} .portfolio-slider-arrow .next' => 'right: {{SIZE}}{{UNIT}} !important; left: auto !important;',
        ],
        'condition' => [
            'arrow_horizontal_position' => 'space_between',
        ],
    ]
);

$this->add_responsive_control(
    'arrow_gap_',
    [
        'label' => __( 'Arrow Gap', 'happy-elementor-addons' ),
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
            '{{WRAPPER}} .portfolio-slider-arrow .prev' => 'margin-right: {{SIZE}}{{UNIT}} !important; position: relative !important',
            '{{WRAPPER}} .portfolio-slider-arrow .next ' => 'margin-right: 0 !important; position: relative !important',
        ],
        'condition' => [
            'arrow_horizontal_position' => 'default',
        ],
    ]
);

$this->add_responsive_control(
    'align_arrow',
    [
        'label' => __( 'Alignment', 'xmoze-hp' ),
        'type' => \Elementor\Controls_Manager::CHOOSE,
        'options' => [
            'left' => [
                'title' => __( 'Left', 'xmoze-hp' ),
                'icon' => 'eicon-text-align-left',
            ],
            'center' => [
                'title' => __( 'Center', 'xmoze-hp' ),
                'icon' => 'eicon-text-align-center',
            ],
            'right' => [
                'title' => __( 'Right', 'xmoze-hp' ),
                'icon' => 'eicon-text-align-right',
            ],
        ],
        'default' => 'left',
        'selectors' => [
            '{{WRAPPER}} .portfolio-slider-arrow' => 'text-align: {{VALUE}};',
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
            '{{WRAPPER}}  .portfolio-slider-arrow button i' => 'font-size: {{SIZE}}{{UNIT}}',
            '{{WRAPPER}}  .portfolio-slider-arrow button svg' => 'width: {{SIZE}}{{UNIT}}',
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
            '{{WRAPPER}} .portfolio-slider-arrow button' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}',
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
            '{{WRAPPER}} .portfolio-slider-arrow button' => 'line-height: {{SIZE}}{{UNIT}} !important;',
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
            '{{WRAPPER}} .portfolio-slider-arrow button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            'body.rtl {{WRAPPER}} .portfolio-slider-arrow button ' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
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
             '{{WRAPPER}} .portfolio-slider-arrow .slick-active' => 'color: {{VALUE}};',
             '{{WRAPPER}} .portfolio-slider-arrow button:hover ' => 'color: {{VALUE}};',
             '{{WRAPPER}} .portfolio-slider-arrow .slick-active svg path' => 'stroke: {{VALUE}};',
             '{{WRAPPER}} .portfolio-slider-arrow button:hover svg path ' => 'stroke: {{VALUE}};',
        ],
    ]
);

$this->add_control(
    'arrow_hover_fill_color',
    [
        'label' => __('Line Color', 'xmoze-hp'),
        'type' => \Elementor\Controls_Manager::COLOR,
        'selectors' => [
             '{{WRAPPER}} .portfolio-slider-arrow .slick-active' => 'color: {{VALUE}};',
             '{{WRAPPER}} .portfolio-slider-arrow button:hover ' => 'color: {{VALUE}};',
             '{{WRAPPER}} .portfolio-slider-arrow .slick-active path' => 'fill: {{VALUE}};',
             '{{WRAPPER}} .portfolio-slider-arrow button:hover path' => 'fill: {{VALUE}};',
        ],
    ]
);

$this->add_control(
    'arrow_bg_hover_color',
    [
        'label' => __('Background Color Hover', 'xmoze-hp'),
        'type' => \Elementor\Controls_Manager::COLOR,
        'selectors' => [
             '{{WRAPPER}} .portfolio-slider-arrow button:hover ' => 'background-color: {{VALUE}}  !important;',
             '{{WRAPPER}} .portfolio-slider-arrow .slick-active ' => 'background-color: {{VALUE}}  !important;',
        ],
    ]
);

$this->end_controls_tab();
$this->end_controls_tabs();

$this->end_controls_section();


//SLider control style End


        $this->start_controls_section(
            'section_loadmore',
            [
                'label' => __('Loadmore', 'xmoze-ts'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'enable_loadmore' => 'yes'
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'label' => __('Typography', 'xmoze-ts'),
                'name' => 'loadmore_typo',
                'selector' => '{{WRAPPER}} .xmoze-pf-loadmore-btn',
            ]
        );
        $this->start_controls_tabs(
            'loadmore_hover_tabs'
        );
        $this->start_controls_tab(
            'loadmore_normal_tab',
            [
                'label' => __('Normal', 'xmoze-ts'),
            ]
        );
        $this->add_control(
            'loadore_color',
            [
                'label' => __('Color', 'xmoze-ts'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xmoze-pf-loadmore-btn' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'loadmore_background_color',
            [
                'label' => __('Filter background Color', 'xmoze-ts'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xmoze-pf-loadmore-btn' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'loadmore_border',
                'label' => __('Border', 'xmoze-ts'),
                'selector' => '{{WRAPPER}} .xmoze-pf-loadmore-btn',
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'loadmore_hover_tab',
            [
                'label' => __('Hover', 'xmoze-ts'),
            ]
        );
        $this->add_control(
            'loadore_hover_color',
            [
                'label' => __('Color', 'xmoze-ts'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xmoze-pf-loadmore-btn:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'loadmore_hover_bg_color',
            [
                'label' => __('Filter background Color', 'xmoze-ts'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xmoze-pf-loadmore-btn:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'loadmore_hover_border',
                'label' => __('Border', 'xmoze-ts'),
                'selector' => '{{WRAPPER}} .xmoze-pf-loadmore-btn:hover',
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->add_control(
            'hr',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );
        $this->add_responsive_control(
            'loadmoere_button_padding',
            [
                'label' => __('Button Padding', 'xmoze-ts'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'default' => [
                    'top' => '22',
                    'right' => '38',
                    'bottom' => '21',
                    'left' => '38',
                ],
                'selectors' => [
                    '{{WRAPPER}} .xmoze-pf-loadmore-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'loadmoere_button_radius',
            [
                'label' => __('Border Radius', 'xmoze-ts'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'default' => [
                    'top' => '33',
                    'right' => '33',
                    'bottom' => '33',
                    'left' => '33',
                ],
                'selectors' => [
                    '{{WRAPPER}} .xmoze-pf-loadmore-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'loadmoere_button_shadow',
                'label' => __('Button Shadow', 'xmoze-ts'),
                'selector' => '{{WRAPPER}} .xmoze-pf-loadmore-btn',
                'fields_options' =>
                [
                    'box_shadow_type' =>
                    [
                        'default' => 'yes',
                    ],
                    'box_shadow' => [
                        'default' =>
                        [
                            'horizontal' => 0,
                            'vertical' => 0,
                            'blur' => 0,
                            'spread' => 0,
                            'color' => 'rgba(3, 3, 3, 0.14)',
                        ],
                    ],
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
        $paged = get_query_var('paged') ? get_query_var('paged') : 1;
        $portfolio_data = [];
        $portfolio_data['settings'] = $this->get_settings();
        $portfolio_data = json_encode($portfolio_data);

        $active_slider = $settings['layout_type'];


        $slider_extraSetting = array(

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

        if($active_slider == 'slider') {
            $this->add_render_attribute('portfolio_attr', 'class', array('portfolio-slider' ));
            $this->add_render_attribute('portfolio_attr', 'data-settings', $jasondecode);
            
        }else{
            $this->add_render_attribute('portfolio_attr', 'class', array('row xmoze-portfolio-wrap' ));
            $this->add_render_attribute('portfolio_attr', 'class', array('layout-mode-'. esc_attr($settings['layout_type'] . ' ' . $settings['enable_hover_rotate']) .' enable-filter-'.$settings['enable_filtering'] ));
            
        }
       


        // Including the query 
        include('queries/portfolio-query.php');
        if ($the_query->have_posts()) :
            if ($settings['enable_filtering']) :
    ?>
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <ul class="pf-isotope-nav text-<?php echo esc_attr($settings['filter_align']); ?>">
                                <li data-filter="<?php echo esc_attr('*') ?>" class="active"><?php echo esc_html($settings['all_text'])  ?></li>
                                <?php
                                if (0 != count($settings['include_categories'])) :
                                    foreach ($settings['include_categories'] as $cat) :
                                        $pf_term = get_term_by('slug', $cat, 'portfolio-category');
                                ?>
                                        <li data-filter=".<?php echo esc_attr($pf_term->slug) ?>"><?php echo esc_html($pf_term->name) ?></li>
                                        <?php
                                    endforeach;
                                else :
                                    $pf_terms = get_terms('portfolio-category');
                                    if (!empty($pf_terms)) :
                                        foreach ($pf_terms as $pf_term) : ?>
                                            <li data-filter=".<?php echo esc_attr($pf_term->slug) ?>"><?php echo esc_html($pf_term->name) ?></li>
                                <?php
                                        endforeach;
                                    endif;
                                endif;
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <div <?php echo $this->get_render_attribute_string('portfolio_attr'); ?>>
                <?php
                // including the item
                include('contents/portfolio-content.php');
                ?>
            </div>

 <?php if ( 'slider' == $active_slider && 'yes' == $settings['arrows']): ?>                       
            <div class="portfolio-slider-arrow">
                <?php if ( ! empty( $settings['arrow_prev_icon']['value'] ) ) : ?>
                    <button type="button" class="slick-prev prev slick-arrow slick-active">
                        <?php \Elementor\Icons_Manager::render_icon( $settings['arrow_prev_icon'], ['aria-hidden' => 'true'] ); ?>
                    </button>
                <?php endif; ?>
                
                <?php if ( ! empty( $settings['arrow_next_icon']['value'] ) ) : ?>
                    <button type="button" class="slick-next next slick-arrow ">
                        <?php \Elementor\Icons_Manager::render_icon( $settings['arrow_next_icon'], ['aria-hidden' => 'true'] ); ?>
                    </button>
                <?php endif; ?>
            </div>
        <?php endif; ?>


            <?php
            $total_posts = $the_query->found_posts;
            if ('yes' == $settings['enable_loadmore'] && '-1' != $settings['posts_per_page'] && $total_posts >= $settings['posts_per_page']) :
                $posts_per_page = $settings['posts_per_page'];
                $page_amount = ceil($total_posts / $posts_per_page);
                $ajaxurl = admin_url('admin-ajax.php');
                $nonce = wp_create_nonce('xmoze_loadmore_callback');
            ?>


               
            <div class="row">
                <div class="col-12">
                    <div class="xmoze-loadmore-wrap text-<?php echo $settings['loadmore_align']; ?>">
                        <span id="load-next-portfolios-message"></span>
                        <span class="xmoze-pf-loadmore-btn" data-url="<?php echo esc_url($ajaxurl) ?>" data-referrar="<?php echo $nonce; ?>" data-total-page="<?php echo $page_amount; ?>" data-paged="<?php echo $paged; ?>" data-portfolio-settings='<?php echo $portfolio_data ?>'><?php echo $settings['loadmore_text'] ?></span>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        <?php endif;
        wp_reset_postdata();
    }
}

$widgets_manager->register(new \xmoze_portfolio_loop());