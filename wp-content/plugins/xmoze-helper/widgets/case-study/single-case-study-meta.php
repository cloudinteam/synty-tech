<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;
/**
 * Shade heading widget.
 *
 * Shade widget that displays an eye-catching headlines.
 *
 * @since 1.0.0
 */
class xmoze_Case_Study_Meta extends Widget_Base {
    /**
     * Get widget name.
     *
     * Retrieve heading widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'xmoze-single-cs-meta';
    }
    /**
     * Get widget title.
     *
     * Retrieve heading widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return __('Case Study Meta', 'xmoze-hp');
    }
    /**
     * Get widget icon.
     *
     * Retrieve heading widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-t-letter';
    }
    /**
     * Get widget categories.
     *
     * Retrieve the list of categories the heading widget belongs to.
     *
     * Used to determine where to display the widget in the editor.
     *
     * @since 2.0.0
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories() {
        return ['xmoze-addons'];
    }
    /**
     * Get widget keywords.
     *
     * Retrieve the list of keywords the widget belongs to.
     *
     * @since 2.1.0
     * @access public
     *
     * @return array Widget keywords.
     */
    public function get_keywords() {
        return ['meta', 'single', 'case study'];
    }
    /**
     * Register heading widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function register_controls() {
        
      
        $this->start_controls_section(
            'section_content',
            [
                'label' => __('Content', 'xmoze-hp'),
            ]
        );
        $this->add_control(
			'show_icon',
			[
				'label' => __( 'Show Icon', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'xmoze-hp' ),
				'label_off' => __( 'Hide', 'xmoze-hp' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
        $this->add_control(
			'title',
			[
				'label' => __( 'Title', 'xmoze-hp' ),
				'type' => \Elementor\Controls_Manager::TEXT,
                'default'     => __('About Project', 'xmoze-hp' ),
                'label_black' => true,
			]
		);
        
        $this->add_control(
			'description',
			[
				'label' => __( 'Discription', 'xmoze-hp' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default'     => __('It is a long established fact that a reader will be distracted by the ', 'xmoze-hp' ),
                'label_black' => true,
			]
		);

        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
			'icon',
			[
				'label' => __( 'Icon', 'text-domain' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				
			]
		);
        $repeater->add_control(
            'lebel',
            [
                'label'       => __('Label', 'xmoze-hp'),
                'type'        => Controls_Manager::TEXTAREA,
                'placeholder' => __('Enter your title', 'xmoze-hp'),
                
            ]
        );
        $repeater->add_control(
            'get_meta',
            [
                'label'   => __('Select Meta', 'xmoze-hp'),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'category'       => 'Category',
                    'sub-heading'    => 'Project Name',
                    'client'        => 'Client',
                    'year'     => 'Date',
                    'location'         => 'Location',
                    'rol'       => 'Rol',
                ],
                'default' => 'category',
            ]
        );
        $this->add_control(
            'pf_meta_list',
            [
                'label'       => __('Meta List', 'xmoze-hp'),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{{ lebel }}}',
            ]
        );
       
        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_title',
            [
                'label' => __('Title', 'xmoze-hp'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typography',
                'label'    => __('Title Typography', 'xmoze-hp'),
                'selector' => '{{WRAPPER}} .studies-title h2',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'title_shadow',
                'label' => __('Title Shadow', 'xmoze-hp'),
                'selector' => '{{WRAPPER}} .studies-title h2',
            ]
        );
        $this->start_controls_tabs(
			'title_tabs'
		);

		$this->start_controls_tab(
			'title_normal_tab',
			[
				'label' => __( 'Normal', 'xmoze-hp' ),
			]
		);
        $this->add_control(
            'title_color',
            [
                'label'     => __('Title Color', 'xmoze-hp'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .studies-title h2' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'title_padding',
            [
                'label'      => __('padding', 'xmoze-hp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .studies-title h2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .studies-title h2' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'title_margin',
            [
                'label'      => __('margin', 'xmoze-hp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .studies-title h2' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .studies-title h2' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
			'title_hover_tab',
			[
				'label' => __( 'Hover', 'plugin-name' ),
			]
		);
        $this->add_control(
            'title_hover_color',
            [
                'label'     => __('Title Color', 'xmoze-hp'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .studies-title h2:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'title_hover_padding',
            [
                'label'      => __('padding', 'xmoze-hp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .studies-title h2:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}}.studies-title h2:hover' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'title_hover_margin',
            [
                'label'      => __('margin', 'xmoze-hp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .studies-title h2:hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .studies-title h2:hover' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
		$this->end_controls_tabs();
        $this->end_controls_section();

        // Discription
        $this->start_controls_section(
            'section_style_dos',
            [
                'label' => __('Discription', 'xmoze-hp'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'dis_color',
            [
                'label'     => __('Color', 'xmoze-hp'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .studies-description' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'dis_typography',
                'label'    => __('Title Typography', 'xmoze-hp'),
                'selector' => '{{WRAPPER}} .studies-description',
            ]
        );
        $this->add_responsive_control(
            'dis_padding',
            [
                'label'      => __('Padding', 'xmoze-hp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .studies-description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .studies-description' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'dis_margin',
            [
                'label'      => __('Margin', 'xmoze-hp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .studies-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .studies-description' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'list_meta',
            [
                'label' => __('List', 'xmoze-hp'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'      => 'list_border',
                'selector'  => '{{WRAPPER}} ul.cs-meta li',
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'list_shadow',
                'label' => __('Shadow', 'fd-addons'),
                'selector' => '{{WRAPPER}} ul.cs-meta li',
            ]
        );

        $this->add_control(
            'list_border_radius',
            [
                'label'      => __('Border radius', 'xmoze-hp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} ul.cs-meta li' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} ul.cs-meta li' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'list_padding',
            [
                'label'      => __('padding', 'xmoze-hp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} ul.cs-meta li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} ul.cs-meta li' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'list_margin',
            [
                'label'      => __('margin', 'xmoze-hp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} ul.cs-meta li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} ul.cs-meta li' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'section_content_lavel_style',
            [
                'label' => __('Meta Label', 'xmoze-hp'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'label_color',
            [
                'label'     => __('Label Color', 'xmoze-hp'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cs-meta-label' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'label_typography',
                'label'    => __('Label Typography', 'xmoze-hp'),
                'selector' => '{{WRAPPER}} .cs-meta-label',
            ]
        );
        $this->add_responsive_control(
            'label_margin',
            [
                'label'      => __('Margin', 'xmoze-hp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .cs-meta-label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .cs-meta-label' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'section_content_style',
            [
                'label' => __('Meta Content', 'xmoze-hp'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'meta_color',
            [
                'label'     => __('Meta Color', 'xmoze-hp'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cs-meta-value' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'meta_typography',
                'label'    => __('Meta Typography', 'xmoze-hp'),
                'selector' => '{{WRAPPER}} .cs-meta-value',
            ]
        );
        $this->add_responsive_control(
            'gap',
            [
                'label'      => __('List Gap', 'xmoze-hp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .cs-meta-value' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .cs-meta-value' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->end_controls_section();

        /*icon */
        $this->start_controls_section(
			'icon_style',
			[
				'label' => __('Icon', 'fd-addons'),
				'tab' => Controls_Manager::TAB_STYLE,
				
			]
		); 
        $this->start_controls_tabs(
			'icon_hover_tabs'
		);
        $this->start_controls_tab(
			'icon_normal_tab',
			[
				'label' => __('Normal', 'fd-addons'),
			]
		);
        $this->add_control(
			'icon_color',
			[
				'label' => __('Icon Color', 'fd-addons'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} ul.cs-meta li .cs-meta-icon i' => 'color: {{VALUE}}',
					'{{WRAPPER}} ul.cs-meta li .cs-meta-icon svg' => 'color: {{VALUE}}',
					'{{WRAPPER}} ul.cs-meta li .cs-meta-icon svg path' => 'fill: {{VALUE}}',
					
				],
			]
		);
        $this->add_control(
			'icon_background',
			[
				'label' => __('Icon Background', 'fd-addons'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} ul.cs-meta li .cs-meta-icon' => 'background-color: {{VALUE}}',
				],
				
			]
		);
       
        $this->add_responsive_control(
			'icon_size',
			[
				'label' => __('Icon Size', 'fd-addons'),
				'type' => Controls_Manager::SLIDER,
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
				'desktop_default' => [
					'size' => '',
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}}  ul.cs-meta li .cs-meta-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}  ul.cs-meta li .cs-meta-icon svg' => 'width: {{SIZE}}{{UNIT}};',
				],
				
			]
		);
        $this->add_responsive_control(
			'space_between_icon',
			[
				'label' => __('Gap', 'fd-addons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} ul.cs-meta li .cs-meta-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'body.rtl {{WRAPPER}} ul.cs-meta li .cs-meta-icon' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
				],
			]
		);
        $this->end_controls_tab();

        $this->start_controls_tab(
			'style_hover_tab',
			[
				'label' => __('Hover', 'fd-addons'),
			]
		);
        $this->add_control(
			'icon_hover_color',
			[
				'label' => __('Icon Color', 'fd-addons'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover ul.cs-meta li .cs-meta-icon i' => 'color: {{VALUE}}',
					'{{WRAPPER}}:hover ul.cs-meta li .cs-meta-icon svg' => 'color: {{VALUE}}',
					'{{WRAPPER}}:hover ul.cs-meta li .cs-meta-icon svg path' => 'fill: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'icon_hover_background',
			[
				'label' => __('Icon Background', 'fd-addons'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover ul.cs-meta li .cs-meta-icon' => 'background-color: {{VALUE}}',
				],
			]
		);
		
		$this->end_controls_tab();
		$this->end_controls_tabs();


        $this->end_controls_section();
       
        $this->start_controls_section(
            'box_content_style',
            [
                'label' => __('Box', 'xmoze-hp'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'box_bg_color',
            [
                'label'     => __('Background Color', 'xmoze-hp'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xmoze-single-cs-meta-widget' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'content_shadow',
                'label' => __('Shadow', 'fd-addons'),
                'selector' => '{{WRAPPER}} .xmoze-single-cs-meta-widget',
            ]
        );
        $this->add_responsive_control(
            'align',
            [
                'label'     => __('Alignment', 'xmoze-hp'),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'left'    => [
                        'title' => __('Left', 'xmoze-hp'),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center'  => [
                        'title' => __('Center', 'xmoze-hp'),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right'   => [
                        'title' => __('Right', 'xmoze-hp'),
                        'icon'  => 'eicon-text-align-right',
                    ],
                    'justify' => [
                        'title' => __('Justified', 'xmoze-hp'),
                        'icon'  => 'eicon-text-align-justify',
                    ],
                ],
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .xmoze-single-cs-meta-widget' => 'text-align: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'box_gap',
            [
                'label'      => __('Padding', 'xmoze-hp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .xmoze-single-cs-meta-widget' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .xmoze-single-cs-meta-widget' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'box_radius',
            [
                'label'      => __('Radius', 'xmoze-hp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .xmoze-single-cs-meta-widget' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
    }
    /**
     * Render heading widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings_for_display();
        $title = $settings['title'];
        $description = $settings['description'];
        global $post;
        $idd = get_the_ID();
        $categories = get_the_terms(get_the_ID(), 'case-study-category');
       
        if (!empty($categories)) {
            $pf_cat_name = join(' ', wp_list_pluck($categories, 'name'));
        }
      
        ?>


        <div class="xmoze-single-cs-meta-widget">
            <div class="studies-title">
                <h2><?php echo esc_html( $title ); ?></h2>
            </div>
            
            <div class="studies-description">
                <?php echo xmoze_get_meta($description ); ?>
            </div>
          <ul class="cs-meta">
			  <?php
            foreach ($settings['pf_meta_list'] as $selected_meta):
             
            if ('category' == $selected_meta['get_meta']) {
                $meta = (!empty($pf_cat_name)) ? $pf_cat_name : '';
            } else {
                $meta = get_field($selected_meta['get_meta'], $idd);
            
            }
            if (!empty($meta)) { ?>
                <li>
                    <?php if ( 'yes' === $settings['show_icon'] ): ?>
                    <span class="cs-meta-icon"><?php \Elementor\Icons_Manager::render_icon( $selected_meta['icon'], [ 'aria-hidden' => 'true' ] ); ?></span>
                    <?php endif; ?>
                    <span class="cs-meta-label"><?php echo $selected_meta['lebel']; ?></span>
                    <span class="cs-meta-value" ><?php echo $meta ?></span></li>
            <?php }
            ?>
			<?php 
            endforeach; 
            wp_reset_postdata();?>
		  </ul>
        </div>
        <?php
    }
}
$widgets_manager->register(new \xmoze_Case_Study_Meta());