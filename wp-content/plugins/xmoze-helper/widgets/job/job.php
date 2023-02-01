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
class xmoze_job_loop extends \Elementor\Widget_Base
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
        return 'xmoze-job';
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
        return __('job', 'xmoze-ts');
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
                'label' => __('Genarel', 'xmoze-ts'),
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
            'post_grid',
            [
                'label' => __('Post Column', 'xmoze-ts'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'devices' => ['desktop', 'tablet', 'mobile'],
                'options' => array(
                    'col-md-12' => '1 Column',
                    'col-md-6' =>  '2 Column',
                    'col-md-4' =>  '3 Column',
                    'col-md-3' =>  '4 Column',
                ),
                'default' => 'col-md-3',
            ]
        );

        $this->add_responsive_control(
            'column_verti_gap',
            [
                'label' => __('Column Vertical Gap', 'xmoze-ts'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'devices' => ['desktop', 'tablet', 'mobile'],
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}}  .jobs-area__tab .card--single' => 'margin-right:{{SIZE}}{{UNIT}};',
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
                    'size' => 20,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}}  .xmoze-job-item-wrap' => 'padding-bottom: {{SIZE}}{{UNIT}} ;',
                ]
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
                    'job' => 'job',
                    'manual_selection' => 'Manual Selection',
                    'related' => 'Related',
                    'meta' => 'Meta',
                ],
                'default' =>    'job',
            ]
        );
        $this->add_control(
            'job_type',
            [
                'label'         => __('job type', 'xmoze-ts'),
                'type'          => \Elementor\Controls_Manager::SELECT,
                'options'       => xmoze_get_meta_field_keys('job', 'job_type'),
                'default'     =>    xmoze_get_meta_field_keys('job', 'job_type', 'value'),
                'condition'   => [
                    'source'  => 'meta'
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
                'options'       => xmoze_cpt_slug_and_id('job'),
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
                'options'       => xmoze_cpt_taxonomy_slug_and_name('job-category'),
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
                'options'       => xmoze_cpt_taxonomy_slug_and_name('job-tag'),
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
                'options'       => xmoze_cpt_author_slug_and_id('job'),
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
                'options'       => xmoze_cpt_taxonomy_slug_and_name('job-category'),
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
                'options'       => xmoze_cpt_taxonomy_slug_and_name('job-tag'),
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
                'options'       => xmoze_cpt_author_slug_and_id('job'),
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

        /*
        * meta 
        */
        $this->start_controls_section(
            'section_meta',
            [
                'label' => __('Meta', 'xmoze-ts'),
            ]
        );
        $this->add_control(
			'currency_icon',
			[
				'label' => __( 'Currency Icon', 'xmoze-ts' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-star',
					'library' => 'solid',
				],
			]
		);
        $this->add_control(
			'location_icon',
			[
				'label' => __( 'Location Icon', 'xmoze-ts' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-star',
					'library' => 'solid',
				],
			]
		);
        $this->add_control(
			'job_icon',
			[
				'label' => __( 'Job Type Icon', 'xmoze-ts' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-star',
					'library' => 'solid',
				],
			]
		);
        $this->end_controls_section();

        /*
        * button
        */
        $this->start_controls_section(
            'section_button',
            [
                'label' => __('Button', 'xmoze-ts'),
            ]
        );
        $this->add_control(
			'button_text',
			[
				'label' => __( 'Button Text', 'xmoze-ts' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Learn the details', 'xmoze-ts' ),
				'placeholder' => __( 'Type your title here', 'xmoze-ts' ),
			]
		);
        $this->add_control(
			'button_icon',
			[
				'label' => __( 'Button Icon', 'xmoze-ts' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-star',
					'library' => 'solid',
				],
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
                    '{{WRAPPER}} .jf-isotope-nav' => 'text-align: {{VALUE}};',
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
                'selector' => '{{WRAPPER}} .jf-isotope-nav li',
            ]
        );
        $this->add_control(
            'filter_color',
            [
                'label' => __('Filter Color', 'xmoze-ts'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jf-isotope-nav li' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'filter_hover_color',
            [
                'label' => __('Filter Hover Color', 'xmoze-ts'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jf-isotope-nav li.active' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'filter_hover_bg_color',
            [
                'label' => __('Filter Hover BG Color', 'xmoze-ts'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}  .jf-isotope-nav li.active' => 'background: {{VALUE}};',
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
                    '{{WRAPPER}} .jf-isotope-nav li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}}  .jf-isotope-nav li' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
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
                    '{{WRAPPER}} .jf-isotope-nav li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}}  .jf-isotope-nav li' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
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
                    '{{WRAPPER}} .jf-isotope-nav li' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}}  .jf-isotope-nav li' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        /*
            Icon Section
        */ 
        $this->start_controls_section(
            'icon_style',
            [
                'label' => __('Icon', 'xmoze-hp'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
			'enable_icon_box',
			[
				'label' => __('Enable Icon Box', 'xmoze'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __('Show', 'xmoze'),
				'label_off' => __('Hide', 'xmoze'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
        $this->start_controls_tabs(
			'icon_tabs'
		);

        $this->start_controls_tab(
			'icon_normal_tab',
			[
				'label' => __('Normal', 'xmoze'),
			]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'icon_background',
				'label' => __( 'Icon Background', 'xmoze' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .job-thumb',
                'condition' => ['enable_icon_box' => 'yes']
			]
		);

        $this->add_control(
			'icon_color',
			[
				'label' => __( 'Title Color', 'xmoze' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .job-thumb i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .job-thumb svg' => 'color: {{VALUE}}',
					'{{WRAPPER}} .job-thumb svg path' => 'fill: {{VALUE}}',
				],
			]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'icon_shadow',
				'label' => __('Icon Shadow', 'xmoze'),
				'selector' => '{{WRAPPER}} .job-thumb',
                'condition' => [
					'enable_icon_box' => 'yes',
				],
			]
		);
        $this->add_responsive_control(
			'icon_size',
			[
				'label' => __('Icon Size', 'xmoze'),
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
				'default' => [
					'size' => '40',
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}}  .job-thumb i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}  .job-thumb svg' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}  .job-thumb img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->add_responsive_control(
			'icon_box_size',
			[
				'label' => __('Icon Box Size', 'xmoze'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
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
				'default' => [
					'size' => 70,
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}}  .job-thumb' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
				'condition' => ['enable_icon_box' => 'yes']
			]
		);
        $this->add_responsive_control(
			'space_between_icon',
			[
				'label' => __('Icon Gap', 'xmoze'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'default'	=>	[
					'top' => '10',
					'right' => '10',
					'bottom' => '10',
					'left' => '10'
				],
				'selectors' => [
					'{{WRAPPER}} .job-thumb' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'body.rtl {{WRAPPER}} .job-thumb' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
				],
                
			]
		);
        $this->add_responsive_control(
			'image_width',
			[
				'label' => __('Image Width', 'xmoze'),
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
					'{{WRAPPER}}  .job-thumb img' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}  .job-thumb' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'image_height',
			[
				'label' => __('Image Height', 'xmoze'),
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
					'{{WRAPPER}}  .job-thumb img' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}  .job-thumb' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_tab();
        
        $this->start_controls_tab(
			'icon_hover_tab',
			[
				'label' => __('Hover', 'xmoze'),
			]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'icon_hover_background',
				'label' => __( 'Icon Background', 'xmoze' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .jobs-area__tab:hover .job-thumb',
                'condition' => ['enable_icon_box' => 'yes']
			]
		);
        $this->add_control(
			'icon_title_hover_color',
			[
				'label' => __( 'Title Color', 'xmoze' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jobs-area__tab:hover .job-thumb i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .jobs-area__tab:hover .job-thumb svg' => 'color: {{VALUE}}',
					'{{WRAPPER}} .jobs-area__tab:hover .job-thumb svg path' => 'fill: {{VALUE}}',
				],
			]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'icon_hover_shadow',
				'label' => __('Icon Shadow', 'xmoze'),
				'selector' => '{{WRAPPER}} .jobs-area__tab:hover .job-thumb',
                'condition' => [
					'enable_icon_box' => 'yes',
				],
			]
		);
        $this->add_responsive_control(
			'icon_hover_size',
			[
				'label' => __('Icon Size', 'xmoze'),
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
				'default' => [
					'size' => '40',
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}}  .jobs-area__tab:hover .job-thumb i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}  .jobs-area__tab:hover .job-thumb svg' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}  .jobs-area__tab:hover .job-thumb img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);



        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
        /* 
        Title
        */
        $this->start_controls_section(
            'section_title_style',
            [
                'label' => __('Title', 'xmoze-hp'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs(
            'title_style_tabs'
        );
        $this->start_controls_tab(
            'title_style_normal_tab',
            [
                'label' => __('Normal', 'xmoze-hp'),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'label' => __('Title Typography', 'xmoze-ts'),
                'name' => 'title_typo',
                'selector' => '{{WRAPPER}} .jobs-area__tab .card__heading a',
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label' => __('Title Color', 'xmoze-ts'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jobs-area__tab .card__heading a' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'title_style_hover_tab',
            [
                'label' => __('Hover', 'xmoze-hp'),
            ]
        );
        $this->add_control(
            'title_color_hover',
            [
                'label' => __('Title Color', 'xmoze-ts'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jobs-area__tab .card__heading a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_responsive_control(
            'titel_margin',
            [
                'label'      => __('Margin', 'xmoze-hp'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .jobs-area__tab .card__heading a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .jobs-area__tab .card__heading a' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        
        /* 
        Job Type
        */
        $this->start_controls_section(
            'job_type_content_style',
            [
                'label' => __('Job Type', 'xmoze-hp'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs(
            'job_type_style_tabs'
        );
        $this->start_controls_tab(
            'job_type_style_normal_tab',
            [
                'label' => __('Normal', 'xmoze-hp'),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'label' => __('Typography', 'xmoze-ts'),
                'name' => 'job_type_typo',
                'selector' => '{{WRAPPER}} .jobs-area__tab p',
            ]
        );
        $this->add_control(
            'job_type_color',
            [
                'label' => __('Content Color', 'xmoze-ts'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jobs-area__tab p' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
			'job_type_icon',
			[
				'label' => __( 'Icon', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

        $this->add_control(
            'job_meta_icon_color',
            [
                'label' => __('Color', 'xmoze-ts'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default'=>'',
                'selectors' => [
                    '{{WRAPPER}} .jobs-area__tab p i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .jobs-area__tab p svg' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .jobs-area__tab p svg path' => 'stroke: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'job_type_icon_hover_color',
            [
                'label' => __('Hover Color', 'xmoze-ts'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default'=>'',
                'selectors' => [
                    '{{WRAPPER}} .xmoze-job-item-wrap:hover .jobs-area__tab p i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .xmoze-job-item-wrap:hover .jobs-area__tab p svg' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .xmoze-job-item-wrap:hover .jobs-area__tab p svg path' => 'fill: {{VALUE}};',
                   
                ],
            ]
        );

        $this->add_responsive_control(
            'job_type_meta_icon_size',
            [
                'label' => __('Icon Width', 'xmoze-ts'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'devices' => ['desktop', 'tablet', 'mobile'],
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}}  .jobs-area__tab p i' => 'font-size:{{SIZE}}{{UNIT}}',
                    '{{WRAPPER}}  .jobs-area__tab p svg' => 'width:{{SIZE}}{{UNIT}}',
                    
                ]
            ]
        );
        $this->add_responsive_control(
            'job_type_meta_icon_height',
            [
                'label' => __('Icon Height', 'xmoze-ts'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'devices' => ['desktop', 'tablet', 'mobile'],
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}}  .jobs-area__tab p svg' => 'height:{{SIZE}}{{UNIT}}',
                    
                ]
            ]
        );
        $this->add_responsive_control(
            'job_type_icon_margin',
            [
                'label' => __('Icon Margin', 'xmoze-ts'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .jobs-area__tab p i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .jobs-area__tab p svg' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .jobs-area__tab p i' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .jobs-area__tab p svg' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                    
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'job_type_style_hover_tab',
            [
                'label' => __('Hover', 'xmoze-hp'),
            ]
        );
        $this->add_control(
            'job_type_color_hover',
            [
                'label' => __('Content Color', 'xmoze-ts'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jobs-area__tab p:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_responsive_control(
            'job_type_margin',
            [
                'label'      => __('Margin', 'xmoze-hp'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .jobs-area__tab p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .jobs-area__tab p' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        /* 
        Location
        */
        $this->start_controls_section(
            'location_content_style',
            [
                'label' => __('Location', 'xmoze-hp'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs(
            'location_style_tabs'
        );
        $this->start_controls_tab(
            'location_style_normal_tab',
            [
                'label' => __('Normal', 'xmoze-hp'),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'label' => __('Typography', 'xmoze-ts'),
                'name' => 'location_typo',
                'selector' => '{{WRAPPER}} .title-location span',
            ]
        );
        $this->add_control(
            'location_color',
            [
                'label' => __('Content Color', 'xmoze-ts'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .title-location span' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
			'location_icon_section',
			[
				'label' => __( 'Icon', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

        $this->add_control(
            'location_icon_color',
            [
                'label' => __('Color', 'xmoze-ts'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default'=>'',
                'selectors' => [
                    '{{WRAPPER}} .title-location span i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .title-location span svg' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .title-location span svg path' => 'stroke: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'location_icon_hover_color',
            [
                'label' => __('Hover Color', 'xmoze-ts'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default'=>'',
                'selectors' => [
                    '{{WRAPPER}} .xmoze-job-item-wrap:hover .title-location span i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .xmoze-job-item-wrap:hover .title-location span svg' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .xmoze-job-item-wrap:hover .title-location span svg path' => 'fill: {{VALUE}};',
                   
                ],
            ]
        );

        $this->add_responsive_control(
            'location_meta_icon_size',
            [
                'label' => __('Icon Width', 'xmoze-ts'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'devices' => ['desktop', 'tablet', 'mobile'],
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}}  .title-location span i' => 'font-size:{{SIZE}}{{UNIT}}',
                    '{{WRAPPER}}  .title-location span svg' => 'width:{{SIZE}}{{UNIT}}',
                    
                ]
            ]
        );
        $this->add_responsive_control(
            'location_meta_icon_height',
            [
                'label' => __('Icon Height', 'xmoze-ts'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'devices' => ['desktop', 'tablet', 'mobile'],
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}}  .title-location span svg' => 'height:{{SIZE}}{{UNIT}}',
                    
                ]
            ]
        );
        $this->add_responsive_control(
            'location_icon_margin',
            [
                'label' => __('Icon Margin', 'xmoze-ts'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .title-location span i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .title-location span svg' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .title-location span i' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .title-location span svg' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                    
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'location_style_hover_tab',
            [
                'label' => __('Hover', 'xmoze-hp'),
            ]
        );
        $this->add_control(
            'location_color_hover',
            [
                'label' => __('Content Color', 'xmoze-ts'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .title-location span:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_responsive_control(
            'location_margin',
            [
                'label'      => __('Margin', 'xmoze-hp'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .title-location span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .title-location span' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        /* 
        Salary
        */
        $this->start_controls_section(
            'salary_content_style',
            [
                'label' => __('Salary', 'xmoze-hp'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs(
            'salary_style_tabs'
        );
        $this->start_controls_tab(
            'salary_style_normal_tab',
            [
                'label' => __('Normal', 'xmoze-hp'),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'label' => __('Typography', 'xmoze-ts'),
                'name' => 'salary_typo',
                'selector' => '{{WRAPPER}} h5.salary',
            ]
        );
        $this->add_control(
            'salary_color',
            [
                'label' => __('Content Color', 'xmoze-ts'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} h5.salary' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
			'salary_icon_section',
			[
				'label' => __( 'Icon', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

        $this->add_control(
            'salary_icon_color',
            [
                'label' => __('Color', 'xmoze-ts'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default'=>'',
                'selectors' => [
                    '{{WRAPPER}} .salary-icon i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .salary-icon svg' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .salary-icon svg path' => 'stroke: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'salary_icon_hover_color',
            [
                'label' => __('Hover Color', 'xmoze-ts'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default'=>'',
                'selectors' => [
                    '{{WRAPPER}} .xmoze-job-item-wrap:hover .salary-icon i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .xmoze-job-item-wrap:hover .salary-icon svg' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .xmoze-job-item-wrap:hover .salary-icon svg path' => 'fill: {{VALUE}};',
                   
                ],
            ]
        );

        $this->add_responsive_control(
            'salary_meta_icon_size',
            [
                'label' => __('Icon Width', 'xmoze-ts'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'devices' => ['desktop', 'tablet', 'mobile'],
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}}  .salary-icon i' => 'font-size:{{SIZE}}{{UNIT}}',
                    '{{WRAPPER}}  .salary-icon svg' => 'width:{{SIZE}}{{UNIT}}',
                    
                ]
            ]
        );
        $this->add_responsive_control(
            'salary_meta_icon_height',
            [
                'label' => __('Icon Height', 'xmoze-ts'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'devices' => ['desktop', 'tablet', 'mobile'],
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}}  .salary-icon svg' => 'height:{{SIZE}}{{UNIT}}',
                    
                ]
            ]
        );
        $this->add_responsive_control(
            'salary_icon_margin',
            [
                'label' => __('Icon Margin', 'xmoze-ts'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .salary-icon i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .salary-icon svg' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .salary-icon i' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .salary-icon svg' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                    
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'salary_style_hover_tab',
            [
                'label' => __('Hover', 'xmoze-hp'),
            ]
        );
        $this->add_control(
            'salary_color_hover',
            [
                'label' => __('Content Color', 'xmoze-ts'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} h5.salary:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_responsive_control(
            'salary_margin',
            [
                'label'      => __('Margin', 'xmoze-hp'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} h5.salary' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} h5.salary' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
/* 
        job-descriptions p
        */
        $this->start_controls_section(
            'des_content_style',
            [
                'label' => __('Description', 'xmoze-hp'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs(
            'des_style_tabs'
        );
        $this->start_controls_tab(
            'des_style_normal_tab',
            [
                'label' => __('Normal', 'xmoze-hp'),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'label' => __('Typography', 'xmoze-ts'),
                'name' => 'des_typo',
                'selector' => '{{WRAPPER}} .job-descriptions p',
            ]
        );
        $this->add_control(
            'des_color',
            [
                'label' => __('Content Color', 'xmoze-ts'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .job-descriptions p' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'des_margin',
            [
                'label'      => __('Margin', 'xmoze-hp'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .job-descriptions p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .job-descriptions p' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'des_paddding',
            [
                'label'      => __('Padding', 'xmoze-hp'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .job-descriptions p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .job-descriptions p' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'des_style_hover_tab',
            [
                'label' => __('Hover', 'xmoze-hp'),
            ]
        );
        $this->add_control(
            'des_hover_color',
            [
                'label' => __('Content Color', 'xmoze-ts'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xmoze-job-item-wrap:hover .job-descriptions p' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'des_hover_margin',
            [
                'label'      => __('Margin', 'xmoze-hp'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .xmoze-job-item-wrap:hover .job-descriptions p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .xmoze-job-item-wrap:hover .job-descriptions p' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'des_hover_paddding',
            [
                'label'      => __('Padding', 'xmoze-hp'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .xmoze-job-item-wrap:hover .job-descriptions p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .xmoze-job-item-wrap:hover .job-descriptions p' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();




        /* 
        Button
        */
        $this->start_controls_section(
            'button',
            [
                'label' => __('Button', 'xmoze-hp'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'label' => __('Typography', 'xmoze-ts'),
                'name' => 'button_typo',
                'selector' => '{{WRAPPER}} a.xmoze-job-btn',
            ]
        );
        $this->add_control(
			'button_width',
			[
				'label' => __( 'Button Width', 'xmoze' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
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
					'unit' => '%',
					'size' => 50,
				],
				'selectors' => [
					'{{WRAPPER}} a.xmoze-job-btn' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->add_control(
			'button_height',
			[
				'label' => __( 'Button Height', 'xmoze' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
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
					'unit' => '%',
					'size' => 50,
				],
				'selectors' => [
					'{{WRAPPER}} a.xmoze-job-btn' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->start_controls_tabs(
            'button_tabs'
        );

        $this->start_controls_tab(
            'button_normal_tab',
            [
                'label' => __('Normal', 'xmoze-ts'),
            ]
        );

        $this->add_control(
            'button_color',
            [
                'label' => __('Color', 'xmoze-ts'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} a.xmoze-job-btn' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_bg_color',
            [
                'label' => __('Background Color', 'xmoze-ts'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} a.xmoze-job-btn' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'      => 'button_border',
                'selector'  => '{{WRAPPER}} a.xmoze-job-btn',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'button_box_shadow',
                'exclude'  => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} a.xmoze-job-btn',
                'separator' => 'after',
            ]
        );
        $this->end_controls_tab();

        // hover
        $this->start_controls_tab(
            'button_hover_tab',
            [
                'label' => __('Hover', 'xmoze-ts'),
            ]
        );

        $this->add_control(
            'button_color_hover',
            [
                'label' => __('Color', 'xmoze-ts'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} a.xmoze-job-btn:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_bg_color_hover',
            [
                'label' => __('Background Color', 'xmoze-ts'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} a.xmoze-job-btn:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'      => 'button_border_hover',
                'selector'  => '{{WRAPPER}} a.xmoze-job-btn:hover',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'button_box_shadow_hover',
                'exclude'  => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} a.xmoze-job-btn:hover',
                'separator' => 'after',
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();


        $this->add_responsive_control(
            'button_radius',
            [
                'label' => __('Radius', 'xmoze-ts'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} a.xmoze-job-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} a.xmoze-job-btn' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'button_margin',
            [
                'label' => __('Margin', 'xmoze-ts'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} a.xmoze-job-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} a.xmoze-job-btn' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'button_padding',
            [
                'label' => __('Padding', 'xmoze-ts'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} a.xmoze-job-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} a.xmoze-job-btn' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
			'buttion_icon',
			[
				'label' => __( 'Icon', 'xmoze-ts' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

        $this->add_control(
            'btn_icon_color',
            [
                'label' => __('Color', 'xmoze-ts'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} a.xmoze-job-btn i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} a.xmoze-job-btn svg' => 'color: {{VALUE}};',
                    '{{WRAPPER}} a.xmoze-job-btn svg path' => 'stroke: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'btn_icon_hover_color',
            [
                'label' => __('Hover Color', 'xmoze-ts'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xmoze-job-btn:hover a i' =>'color: {{VALUE}};',
                    '{{WRAPPER}} .xmoze-job-btn:hover a svg' =>'color: {{VALUE}};',
                    '{{WRAPPER}} .xmoze-job-btn:hover a svg path' =>'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'btn_meta_icon_size',
            [
                'label' => __('Icon Size', 'xmoze-ts'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'devices' => ['desktop', 'tablet', 'mobile'],
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}}  a.xmoze-job-btn i' => 'font-size:{{SIZE}}{{UNIT}}',
                    '{{WRAPPER}}  a.xmoze-job-btn svg' => 'width:{{SIZE}}{{UNIT}}',
                ]
            ]
        );

        $this->add_responsive_control(
            'btn_icon_margin',
            [
                'label' => __('Icon Margin', 'xmoze-ts'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} a.xmoze-job-btn i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} a.xmoze-job-btn svg' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} a.xmoze-job-btn i' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} a.xmoze-job-btn svg' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

       /* Content Box */
        $this->start_controls_section(
            'section_content_style',
            [
                'label' => __('Content Box', 'xmoze-ts'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs(
            'box_tabs'
        );

        $this->start_controls_tab(
            'box_normal_tab',
            [
                'label' => __('Normal', 'xmoze-ts'),
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'      => 'box_border',
                'selector'  => '{{WRAPPER}} .jobs-area__tab .card--single',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'box_box_shadow',
                'exclude'  => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .jobs-area__tab .card--single',
            ]
        );
        $this->end_controls_tab();

        // hover
        $this->start_controls_tab(
            'box_tab_hover',
            [
                'label' => __('Hover', 'xmoze-ts'),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'      => 'box_border_hover',
                'selector'  => '{{WRAPPER}} .jobs-area__tab .card--single:hover',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'box_box_shadow_hover',
                'exclude'  => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .jobs-area__tab .card--single:hover',
            ]
        );
        $this->end_controls_tab();
        
        $this->end_controls_tabs();

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
                'separator' => 'before',
                'devices' => ['desktop', 'tablet', 'mobile'],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .jobs-area__tab .card--single' => 'text-align: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'content_bg_color',
            [
                'label' => __('Content Background Color', 'xmoze-ts'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jobs-area__tab .card--single' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'content_padding',
            [
                'label' => __('Content Padding', 'xmoze-ts'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .jobs-area__tab .card--single' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .jobs-area__tab .card--single' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
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
                    '{{WRAPPER}} .jobs-area__tab .card--single' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    ' {{WRAPPER}} .xmoze-job-item ' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
        $heading_text = $settings['heading_text'];
        $paged = get_query_var('paged') ? get_query_var('paged') : 1;
        $job_data = [];
        $job_data['settings'] = $this->get_settings();
        $job_data = json_encode($job_data);

        // Including the query 
        include('queries/job-query.php');

        if ($the_query->have_posts()) :
                ?>
                <div class="row justify-content-center">
                <?php if ($settings['enable_filtering']) :
                    ?>
                    <div class="col-12">
                        <ul class="jf-isotope-nav text-<?php echo esc_attr($settings['filter_align']); ?>">
                            <li data-filter="<?php echo esc_attr('*') ?>" class="active"><?php echo esc_html($settings['all_text'])  ?></li>
                            <?php
                            if (0 != count($settings['include_categories'])) :
                                foreach ($settings['include_categories'] as $cat) :
                                    $jf_term = get_term_by('slug', $cat, 'job-category');
                            ?>
                                    <li data-filter=".<?php echo esc_attr($jf_term->slug) ?>"><?php echo esc_html($jf_term->name) ?></li>
                                    <?php
                                endforeach;
                            else :
                                $jf_terms = get_terms('job-category');
                                if (!empty($jf_terms)) :
                                    foreach ($jf_terms as $jf_term) : ?>
                                        <li data-filter=".<?php echo esc_attr($jf_term->slug) ?>"><?php echo esc_html($jf_term->name) ?></li>
                            <?php
                                    endforeach;
                                endif;
                            endif;
                            ?>
                        </ul>
                    </div>
                <?php endif; ?> 
                    <div class="col-lg-12">
                        <div class="xmoze-job-wrap layout-mode-<?php echo esc_attr( $settings['layout_type']); ?>">
                            <?php
                            // including the item
                            include('contents/job-content.php');
                            ?>
                        </div>
                    </div>
                </div>

        <?php endif;
        wp_reset_postdata();
    }
}

$widgets_manager->register(new \xmoze_job_loop());