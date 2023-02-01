<?php
/**
 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class XmozeTestimonial extends \Elementor\Widget_Base {
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
    public function get_name() {
        return 'xmoze-testimonial';
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
    public function get_title() {
        return __( 'Xmoze Testimonial', 'xmoze' );
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
    public function get_icon() {
        return 'eicon-icon-box';
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
    public function get_categories() {
        return ['xmoze-addons'];
    }

    public function get_keywords() {
        return ['testimonial', 'xmoze', 'reviw'];
    }
    /**
     * Register oEmbed widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function register_controls() {
        /**
         * Content tab
         */
        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Content', 'xmoze' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'testimonial_style',
            [
                'label'     => __( 'Testimonial Style', 'xmoze' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default'   => 'style-one',
                'options'   => [
                    'style-one' => __( 'Style One', 'xmoze' ),
                    'style-two' => __( 'Style Two', 'xmoze' ),
                ],
                'separator' => 'after',
            ]
        );
        $this->add_control(
            'star',
            [
                'label'     => __( 'Customar Rating', 'xmoze' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default'   => '5',
                'options'   => [
                    'none' => __( 'none', 'xmoze' ),
                    '1'    => __( '1', 'xmoze' ),
                    '2'    => __( '2', 'xmoze' ),
                    '3'    => __( '3', 'xmoze' ),
                    '4'    => __( '4', 'xmoze' ),
                    '5'    => __( '5', 'xmoze' ),
                ],
                'condition' => [
                    'testimonial_style' => 'style-two',
                ],
            ]
        );
        $this->add_control(
            'image',
            [
                'label'   => __( 'Choose Image', 'xmoze' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $this->add_control(
            'image_position',
            [
                'label'        => __( 'Image Position', 'xmoze' ),
                'type'         => \Elementor\Controls_Manager::CHOOSE,
                'default'      => 'top',
                'options'      => [
                    'left'  => [
                        'title' => __( 'Left', 'xmoze' ),
                        'icon'  => 'eicon-h-align-left',
                    ],
                    'top'   => [
                        'title' => __( 'Top', 'xmoze' ),
                        'icon'  => 'eicon-v-align-top',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'xmoze' ),
                        'icon'  => 'eicon-h-align-right',
                    ],
                ],
                'prefix_class' => 'xmoze-position-',
                'toggle'       => true,
                'condition'    => [
                    'testimonial_style!' => 'style-two',
                ],
            ]
        );
        $this->add_control(
            'name',
            [
                'label'       => __( 'Name', 'xmoze' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => __( 'Customer Name', 'xmoze' ),
            ]
        );
        $this->add_control(
            'title',
            [
                'label'       => __( 'Title', 'xmoze' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => __( 'Easy Intragition', 'xmoze' ),
            ]
        );
        $this->add_control(
            'description',
            [
                'label'   => __( 'Content', 'xmoze' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __( '“You made it so simple. My new site is so much faster and easier to work with than my old site. I just choose the page, make the change and click save.', 'xmoze' ),
            ]
        );
        $this->add_control(
            'testimonial_alignment',
            [
                'label'     => __( 'Alignment', 'elementor' ),
                'type'      => \Elementor\Controls_Manager::CHOOSE,
                'default'   => 'center',
                'options'   => [
                    'left'   => [
                        'title' => __( 'Left', 'elementor' ),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'elementor' ),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right'  => [
                        'title' => __( 'Right', 'elementor' ),
                        'icon'  => 'eicon-text-align-right',
                    ],
                    'toggle' => true,
                ],
                'condition' => [
                    'testimonial_style!' => 'style-two',
                ],
                'selectors' => [
                    '{{WRAPPER}} .xmoze-testimonial-item' => 'text-align: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_section();
        /**
         * Style tab
         */
        //Rating
        $this->start_controls_section(
            'rating_style',
            [
                'label'     => __( 'Stars', 'xmoze' ),
                'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'testimonial_style' => 'style-two',
                    'star!'             => 'none',
                ],
            ]
        );
        $this->add_control(
            'star_size',
            [
                'label'      => __( 'Size', 'xmoze' ),
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
                    '{{WRAPPER}} .testimonial-star i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'star_gap',
            [
                'label'      => __( 'Spacing', 'xmoze' ),
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
                    '{{WRAPPER}} .testimonial-star i' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'star_color',
            [
                'label'     => __( 'Icon Color', 'xmoze' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#F0AD4Es',
                'selectors' => [
                    '{{WRAPPER}} .testimonial-star i' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'star_margin',
            [
                'label'      => __( 'Margin', 'xmoze' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .testimonial-star' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        //image control style
        $this->start_controls_section(
            'image_style',
            [
                'label' => __( 'Image', 'xmoze' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'image_sizes',
            [
                'label'     => __( 'Image Size', 'xmoze' ),
                'type'      => \Elementor\Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .xmoze-testimonial-item .testi-image img ' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'image_margin',
            [
                'label'      => __( 'Image Margin', 'xmoze' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .xmoze-testimonial-item .testi-image' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'border_image',
                'label'    => __( 'Border', 'xmoze' ),
                'selector' => '{{WRAPPER}} .xmoze-testimonial-item .testi-image img ',
            ]
        );
        $this->add_responsive_control(
            'image_border_radius',
            [
                'label'      => __( 'Border Radius', 'xmoze' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .xmoze-testimonial-item .testi-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'content_style',
            [
                'label' => __( 'Description', 'xmoze' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'desscription_color',
            [
                'label'     => __( 'Color', 'xmoze' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xmoze-testimonial-item .testi-content p' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'description_typography',
                'label'    => __( 'Typography', 'xmoze' ),
                'selector' => '{{WRAPPER}} .xmoze-testimonial-item .testi-content p ',
            ]
        );
        $this->add_responsive_control(
            'desc_gap',
            [
                'label'      => __( 'Margin', 'xmoze' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .xmoze-testimonial-item .testi-content p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        //end descripit
        $this->start_controls_section(
            'name_style',
            [
                'label' => __( 'Name', 'xmoze' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'margin_gap',
            [
                'label'      => __( 'Margin', 'xmoze' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .xmoze-testimonial-item .testi-content p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'name_color',
            [
                'label'     => __( 'Color', 'xmoze' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xmoze-testimonial-item .testi-meta .testi-name' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'name_typography',
                'label'    => __( 'Typography', 'xmoze' ),
                'selector' => '{{WRAPPER}} .xmoze-testimonial-item .testi-meta .testi-name ',
            ]
        );
        $this->add_responsive_control(
            'name_gap',
            [
                'label'      => __( 'Margin', 'xmoze' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .xmoze-testimonial-item .testi-meta .testi-name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        //end name
        $this->start_controls_section(
            'title_style',
            [
                'label' => __( 'Title', 'xmoze' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label'     => __( 'Color', 'xmoze' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xmoze-testimonial-item .testi-meta .testi-title' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typography',
                'label'    => __( 'Typography', 'xmoze' ),
                'selector' => '{{WRAPPER}} .xmoze-testimonial-item .testi-meta .testi-title ',
            ]
        );
        $this->add_responsive_control(
            'title_gap',
            [
                'label'      => __( 'Margin', 'xmoze' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .xmoze-testimonial-item .testi-meta .testi-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        // end title section
        $this->start_controls_section(
            'box_style',
            [
                'label' => __( 'Box', 'xmoze' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs(
            'testi_normal_box_wrap'
        );
        //start normal
        $this->start_controls_tab(
            'testi_normal_box',
            [
                'label' => __( 'Normal', 'xmoze' ),
            ]
        );
        $this->add_control(
            'box_background',
            [
                'label'     => __( 'Box Background Color', 'xmoze' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xmoze-testimonial-item ' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'box_border_radius',
            [
                'label'      => __( 'Box Border Radius', 'xmoze' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .xmoze-testimonial-item  ' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'box_padding',
            [
                'label'      => __( 'Box Padding', 'xmoze' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .xmoze-testimonial-item ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'border',
                'label'    => __( 'Border', 'xmoze' ),
                'selector' => '{{WRAPPER}} .xmoze-testimonial-item ',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'box_shadow',
                'label'    => __( 'Box Shadow', 'xmoze' ),
                'selector' => '{{WRAPPER}} .xmoze-testimonial-item ',
            ]
        );
        $this->add_responsive_control(
            'box_optacity',
            [
                'label'     => __( 'Box Opacity', 'xmoze' ),
                'type'      => \Elementor\Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 1,
                        'step' => .01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .xmoze-testimonial-item ' => 'opacity: {{SIZE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'box_min_height',
            [
                'label'     => __( 'Min Height', 'xmoze' ),
                'type'      => \Elementor\Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    '%'  => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .xmoze-testimonial-item ' => 'min-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        //start hover
        $this->start_controls_tab(
            'testi_hover_box',
            [
                'label' => __( 'Hover', 'xmoze' ),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'box_hover_shadow',
                'label'    => __( 'Box Hover Shadow', 'xmoze' ),
                'selector' => '{{WRAPPER}} .xmoze-testimonial-item:hover',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'border_hover',
                'label'    => __( 'Box Hover Border', 'xmoze' ),
                'selector' => '{{WRAPPER}} .xmoze-testimonial-item:hover',
            ]
        );
        $this->end_controls_tab();
        //end hover
        $this->end_controls_tabs();
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
    protected function render() {
        $settings = $this->get_settings_for_display();
        $testimonial_style = $settings['testimonial_style'];
        $description = $settings['description'];
        $name = $settings['name'];
        $title = $settings['title'];
        ?>
            <?php
if ( $testimonial_style == 'style-one' ) {
            ?>
				<div class="xmoze-testimonial-item <?php echo esc_attr( $settings['image_position'] ) ?>">
					<?php if ( !empty( $settings['image']['url'] ) ): ?>
						<div class="testi-image">
							<?php echo \Elementor\Group_Control_Image_Size::get_attachment_image_html( $settings );
            ?>
						</div>
					<?php endif;?>
					<div class="test-content-wrap">
						<div class="testi-content">
							<p><?php echo esc_html( $description ) ?></p>
						</div>
						<div class="testi-meta">
							<h4 class="testi-name"><?php echo esc_html( $name ) ?></h4>
							<span class="testi-title"><?php echo esc_html( $title ) ?></span>
						</div>
					</div>
				</div>
				<?php
} elseif ( $testimonial_style == 'style-two' ) {
            ?>
				<div class="xmoze-testimonial-item <?php echo esc_attr( $testimonial_style ); ?>" >
					<div class="test-content-wrap ">
						<?php if ( 'none' != $settings['star'] ): ?>
						<div class="testimonial-star">
                            <?php for ( $i = 0; $i < $settings['star']; $i++ ): ?>
                                <i class="fa fa-star"></i>
                            <?php endfor;?>
                        </div>
						<?php endif;?>
						<div class="testi-content">
							<p><?php echo $settings['description'] ?></p>
						</div>
						<div class="testi-meta">
							<?php if ( !empty( $settings['image']['url'] ) ): ?>
								<div class="testi-image">
									<?php echo \Elementor\Group_Control_Image_Size::get_attachment_image_html( $settings );
            ?>
								</div>
							<?php endif;?>
							<div class="testi-name-title-wraper">
								<h4 class="testi-name"><?php echo esc_html( $name ) ?></h4>
								<span class="testi-title"><?php echo esc_html( $title ) ?></span>
							</div>
						</div>
					</div>
				</div>
				<?php
};
        ?>
	<?php
}
}

$widgets_manager->register(new \XmozeTestimonial());