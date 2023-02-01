<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Icons_Manager;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
/**
 * Elementor icon widget.
 *
 * Elementor widget that displays an icon from over 600+ icons.
 *
 * @since 1.0.0
 */
class Job_Search extends \Elementor\Widget_Base
{
	/**
	 * Get widget name.
	 *
	 * Retrieve icon widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'xmoze-jobsearch';
	}
	/**
	 * Get widget title.
	 *
	 * Retrieve icon widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Xmoze Job Search', 'xmoze-hp' );
	}
	/**
	 * Get widget icon.
	 *
	 * Retrieve icon widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-favorite';
	}
	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the icon widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * @since 2.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'xmoze-addons' ];
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
		return [ 'search', 'job', 'carear' ];
	}
	/**
	 * Register icon widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {
		$this->start_controls_section(
			'search_section',
			[
				'label' => __( 'Search', 'xmoze-hp' ),
			]
		);
		$this->add_control(
			'input_text',
			[
				'label' => __( 'Placeholder Text', 'xmoze-hp' ),
				'type' => Controls_Manager::TEXT,
				'default' => __('Type job title or keyword', 'xmoze-hp'),
				'label_block' => true,			
			]
		);

		$this->add_control(
			'button_text',
			[
				'label' => __( 'Button Text', 'xmoze-hp' ),
				'type' => Controls_Manager::TEXT,
				'default' => __('Search', 'xmoze-hp'),
				'label_block' => true,	
			]
		);
        $this->end_controls_section();

		//form fields style
        $this->start_controls_section(
            '_section_fields_style',
            [
                'label' => __( 'Fields', 'xmoze-hp' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'field_typography',
                'label'    => __( 'Typography', 'fd-addons' ),
                'selector' => '{{WRAPPER}} .newsletter--inner-career form .form-control input',
            ]
        );

		$this->add_control(
            'field_color_icon',
            [
                'label'     => __( 'Icon Color', 'fd-addons' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .newsletter--inner-career form .form-control i' => 'color: {{VALUE}}',
                ],
            ]
        );

		$this->add_control(
            'field_color',
            [
                'label'     => __( 'Text Color', 'fd-addons' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .newsletter--inner-career form .form-control input' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'field_placeholder_color',
            [
                'label'     => __( 'Placeholder Text Color', 'fd-addons' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} ::-webkit-input-placeholder' => 'color: {{VALUE}};',
                    '{{WRAPPER}} ::-moz-placeholder'          => 'color: {{VALUE}};',
                    '{{WRAPPER}} ::-ms-input-placeholder'     => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'field_bg_color', 
            [
                'label'     => __( 'Background Color', 'fd-addons' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .newsletter--inner-career form, .newsletter--inner-career form .form-control' => 'background-color: {{VALUE}} !important',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'field_border',
                'selector' => '{{WRAPPER}} .newsletter--inner-career',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'field_box_shadow',
                'selector' => '{{WRAPPER}} .newsletter--inner-career',
            ]
        );
        $this->end_controls_section();
	
		//form fields style
        $this->start_controls_section(
            '_section_button_style',
            [
                'label' => __( 'Button', 'xmoze-hp' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

		$this->start_controls_tabs( 'tabs_button_state' );
        $this->start_controls_tab(
            'tab_button_normal',
            [
                'label' => __( 'Normal', 'fd-addons' ),
            ]
        );

		$this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'button_typography',
                'label'    => __( 'Typography', 'fd-addons' ),
                'selector' => '{{WRAPPER}} .newsletter--inner-career form button',
            ]
        );

		$this->add_control(
            'button_text_color',
            [
                'label'     => __( 'Text Color', 'fd-addons' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .newsletter--inner-career form button' => 'color: {{VALUE}}',
                ],
            ]
        );

		$this->add_control(
            'button_bg_color',
            [
                'label'     => __( 'Background Color', 'fd-addons' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .newsletter--inner-career form button' => 'background-color: {{VALUE}}',
                ],
            ]
        );
		$this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'button_box_shadow',
                'selector' => '{{WRAPPER}} .newsletter--inner-career form button',
            ]
        );

		$this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'button_border',
                'selector' => '{{WRAPPER}} .newsletter--inner-career form button',
            ]
        );
		$this->end_controls_tab();

		$this->start_controls_tab(
            'tab_button_hover',
            [
                'label' => __( 'Hover', 'fd-addons' ),
            ]
        );
		$this->add_control(
            'button_text_color_hover',
            [
                'label'     => __( 'Text Color', 'fd-addons' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .newsletter--inner-career form button:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

		$this->add_control(
            'button_bg_color_hover',
            [
                'label'     => __( 'Background Color', 'fd-addons' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .newsletter--inner-career form button:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );
		$this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'button_box_shadow_hover',
                'selector' => '{{WRAPPER}} .newsletter--inner-career form button:hover',
            ]
        );

		$this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'button_border_hyover',
                'selector' => '{{WRAPPER}} .newsletter--inner-career form button:hover',
            ]
        );
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

	}
	/**
	 * Render icon widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
        $settings = $this->get_settings_for_display();
		$input_text = $settings['input_text'];
        $button_text = $settings['button_text'];
        ?>

        <div class="newsletter--inner-career">
			<form method="GET" action="<?php echo get_post_type_archive_link('job'); ?>">

                <div class="form-control">
                <i class="fa fa-search"></i>
                <input type="search"  type="search" name="search_key" id="search_key" placeholder="<?php echo esc_attr( $input_text ) ?>">
                </div>
                <button type="submit" class="falsland-job-btn"><?php echo esc_attr( $button_text ) ?></button>
            </form>
        </div>
        <?php 

    }
}
$widgets_manager->register(new \Job_Search());