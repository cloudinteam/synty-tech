<?php
namespace Finest_Addons\Widgets;

if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;
use Elementor\Icons_Manager;
/**
 * Finest heading widget.
 *
 * Finest widget that displays an eye-catching headlines.
 *
 * @since 1.0.0
 */
class Category extends Widget_Base {
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
        return 'xmoze-case-study-category';
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
        return __( 'Case Study Category', 'xmoze-ts' );
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
        return 'eicon-editor-list-ul';
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
        return ['xmoze-ts'];
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
        return ['heading', 'title', 'text'];
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
            'section_category',
            [
                'label' => __( 'Category', 'xmoze-ts' ),
            ]
        );
        $this->add_control(
            'show_page_category',
            [
                'label'        => __( 'Show Page Category', 'xmoze-ts' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => __( 'Show', 'xmoze-ts' ),
                'label_off'    => __( 'Hide', 'xmoze-ts' ),
                'return_value' => 'yes',
                'default'      => 'no',
            ]
        );
        $this->add_control(
            'category',
            [
                'label'       => __( 'Category', 'xmoze-ts' ),
                'type'        => Controls_Manager::TEXTAREA,
                'dynamic'     => [
                    'active' => true,
                ],
                'placeholder' => __( 'Enter your Category', 'xmoze-ts' ),
                'condition'   => [
                    'show_page_category!' => 'yes',
                ],
            ]
        );
        $this->add_control(
			'website_link',
			[
				'label' => __( 'Link', 'xmoze-ts' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'xmoze-ts' ),
				'show_external' => true,
				'default' => [
					'url' => '#',
					'is_external' => true,
					'nofollow' => true,
				],
			]
		);
        $this->add_responsive_control(
            'align',
            [
                'label'     => __( 'Alignment', 'xmoze-ts' ),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'left'    => [
                        'title' => __( 'Left', 'xmoze-ts' ),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center'  => [
                        'title' => __( 'Center', 'xmoze-ts' ),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right'   => [
                        'title' => __( 'Right', 'xmoze-ts' ),
                        'icon'  => 'eicon-text-align-right',
                    ],
                    'justify' => [
                        'title' => __( 'Justified', 'xmoze-ts' ),
                        'icon'  => 'eicon-text-align-justify',
                    ],
                ],
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}}' => 'text-align: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'view',
            [
                'label'   => __( 'View', 'xmoze-ts' ),
                'type'    => Controls_Manager::HIDDEN,
                'default' => 'traditional',
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'section_category_style',
            [
                'label' => __('Category', 'xmoze-hp'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                
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
                'selector' => '{{WRAPPER}} .xmoze-ts-heading-category a',
            ]
        );
       
        $this->add_control(
            'category_color',
            [
                'label' => __('Category Color', 'xmoze-ts'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xmoze-ts-heading-category a' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'cat_bg_color',
            [
                'label' => __('Background Color', 'xmoze-ts'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xmoze-ts-heading-category a' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'cat_border',
                'label' => __('Border', 'xmoze-ts'),
                'selector' => '{{WRAPPER}} .xmoze-ts-heading-category a',
            ]
        );
        $this->add_responsive_control(
            'cat_radius',
            [
                'label' => __('Image Radius', 'xmoze-ts'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    ' {{WRAPPER}} .xmoze-ts-heading-category a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
			'cat_padding',
			[
				'label' => __( 'Padding', 'xmoze-hp' ),
				'type' =>  \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .xmoze-ts-heading-category a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .xmoze-cs-category' => 'margin-bottom:{{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .xmoze-ts-heading-category a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_control(
			'icon_divider',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

        $this->add_responsive_control(
            'icon_size',
            [
                'label' => __('Icon Size', 'xmoze-ts'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 400,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .xmoze-ts-heading-category a .cat_icon svg' => ' width :{{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
			'cat_icon_margin',
			[
				'label' => __( 'Icon Gap', 'xmoze-hp' ),
				'type' =>  \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .xmoze-ts-heading-category a .cat_icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->end_controls_section();
        
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
        $idd = get_the_ID();
  
        $thumb_icon_id = get_post_meta( $idd, 'cat_svg_icon', true );
        $thumb_icon_url = wp_get_attachment_image( $thumb_icon_id, 'full' );
        $image =  [
                'value' => [
                'url' => $thumb_icon_url,
                'id' => $thumb_icon_id,
            ],
            'library' => 'svg'
        ];
        $settings = $this->get_settings_for_display();
        $target = $settings['website_link']['is_external'] ? ' target="_blank"' : '';
		$nofollow = $settings['website_link']['nofollow'] ? ' rel="nofollow"' : '';
        $title = $settings['category'];
        $this->add_render_attribute( 'category', 'class', 'xmoze-ts-heading-category' );
        ?>
        <div class="xmoze-cs-category" >
            <div <?php echo $this->get_render_attribute_string( 'category' ); ?>  >
                <?php 
                if ( 'yes' == $settings['show_page_category'] ) { 

                    global $post;
                    $category = get_the_terms( $post->ID, 'case-study-category' ); 
                    if ($category) {
                        $category = array_shift($category); ?>

                        <a href="<?php echo get_term_link( $category->term_id) ?>" <?php echo $target?> <?php echo $nofollow ?> >
                        <?php if ($thumb_icon_url) { ?>
                        <span class ="cat_icon" >
                            <?php Icons_Manager::render_icon($image, ['aria-hidden' => 'true']); ?>
                        </span>
                        <?php } ?>
                        <?php echo $category->name;  ?> </a>

                    <?php } ?> 
                
                <?php } else { 
                    echo '<a href="' . $settings['website_link']['url'] .'"'. $target . $nofollow . '>'. esc_html( $title ) .'</a>';
                    
                } ?>
            </div>
        </div>

        
       
        <?php 
       

    }

}

$widgets_manager->register( new \Finest_Addons\Widgets\Category() );