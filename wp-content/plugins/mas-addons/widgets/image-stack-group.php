<?php
/**
 * Circle Image Group widget class
 */
namespace Mas_Addons\Widgets;

defined( 'ABSPATH' ) || die();


use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;


class Mas_Image_Stack_Group extends \Elementor\Widget_Base {

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
        return 'mas-addons-image-stack-group';
    }

	/**
	 * Get widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Image Stack Group', 'mas-addons' );
	}



	/**
	 * Get widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-photo-library';
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
    public function get_categories()
    {
        return ['mas-addons'];
    }

	public function get_keywords() {
		return [ 'image', 'stack', 'icon', 'group', 'client', 'mas' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'_section_icon',
			[
				'label' => __( 'Items', 'mas-addons' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new Repeater();




		$repeater->add_control(
			'image',
			[
				'type' => Controls_Manager::MEDIA,
				'label' => __( 'Image', 'mas-addons' ),
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$repeater->add_control(
			'tooltip',
			[
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'label' => __( 'Tooltip', 'mas-addons' ),
				'placeholder' => __( 'Type title here', 'mas-addons' ),
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$repeater->add_control(
			'tooltip_position',
			[
				'label' => __( 'Tooltip Position', 'mas-addons' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left'  => [
						'title' => __( 'Left', 'mas-addons' ),
						'icon' => 'eicon-h-align-left'
					],
					'up'  => [
						'title' => __( 'Up', 'mas-addons' ),
						'icon' => 'eicon-v-align-top'
					],
					'down'  => [
						'title' => __( 'Down', 'mas-addons' ),
						'icon' => 'eicon-v-align-bottom'
					],
					'right'  => [
						'title' => __( 'Right', 'mas-addons' ),
						'icon' => 'eicon-h-align-right'
					],
				],
				'toggle' => true,
			]
		);





		$repeater->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'icon_bg_color',
				'label' => __( 'Background', 'plugin-domain' ),
				'types' => [ 'classic', 'gradient' ],
				'exclude' => [ 'image' ],
				'selector' => '{{WRAPPER}} .mas-cig-item{{CURRENT_ITEM}} i'
			]
		);

		$repeater->add_control(
			'hr',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);


		$repeater->add_control(
			'border_color_item',
			[
				'label' => __( 'Border Color', 'mas-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} i' => 'border-color: {{VALUE}} !important;',
					'{{WRAPPER}} {{CURRENT_ITEM}} img' => 'border-color: {{VALUE}} !important;',
					'{{WRAPPER}} {{CURRENT_ITEM}} .fw-svg-wrap' => 'border-color: {{VALUE}} !important;',
				],
			]
		);

		$placeholder = [
			'image' => [
				'url' => Utils::get_placeholder_image_src(),
			],
		];

		$this->add_control(
			'images',
			[
				'show_label' => false,
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'title_field' => '<# print(tooltip || "Image Group Item"); #>',
				'default' => array_fill( 0, 4, $placeholder )
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label' => __( 'Alignment', 'mas-addons' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'mas-addons' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'mas-addons' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'mas-addons' ),
						'icon' => 'eicon-text-align-right',
					]
				],
				'toggle' => true,
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}}' => 'text-align: {{VALUE}};'
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'_section_style_icon',
			[
				'label' => __( 'Image / Icon', 'mas-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'img_size',
			[
				'label' => __( 'Item Size', 'mas-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 6,
						'max' => 300,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 60,
				],
				'selectors' => [
					'{{WRAPPER}} .mas-cig-item i,{{WRAPPER}} .mas-cig-item img' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .mas-cig-item i,{{WRAPPER}} .mas-cig-item .fw-svg-wrap' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label' => __( 'Icon Size', 'mas-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 6,
						'max' => 300,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 25,
				],
				'selectors' => [
					'{{WRAPPER}} .mas-cig-item i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .mas-cig-item svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_spacing',
			[
				'label' => __( 'Spacing', 'mas-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'default' => [
					'unit' => 'px',
					'size' => 5,
				],
				'selectors' => [
					'{{WRAPPER}} .mas-cig-item:not(:last-child)' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'hr1',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		$this->add_responsive_control(
			'icon_border_size',
			[
				'label' => __( 'Border Size', 'mas-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'default' => [
					'unit' => 'px',
					'size' => 3,
				],
				'selectors' => [
					'{{WRAPPER}} .mas-cig-item i,{{WRAPPER}} .mas-cig-item img,{{WRAPPER}} .mas-cig-item .fw-svg-wrap' => 'border-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'border_color',
			[
				'label' => __( 'Border Color', 'mas-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mas-cig-item i' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .mas-cig-item img' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .mas-cig-item .fw-svg-wrap' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
            'icon_border_radius',
            [
                'label' => __( 'Border Radius', 'mas-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .mas-cig-item,{{WRAPPER}}  .mas-cig-item i, {{WRAPPER}} .mas-cig-item img, {{WRAPPER}} .mas-cig-item .fw-svg-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
		);

		$this->add_control(
			'hr2',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label' => __( 'Icon Color', 'mas-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mas-cig-item i' => 'color: {{VALUE}}'
				]
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'icon_bg_color',
				'label' => __( 'Background', 'plugin-domain' ),
				'types' => [ 'classic', 'gradient' ],
				'exclude' => [ 'image' ],
				'selector' => '{{WRAPPER}} .mas-cig-item i'
			]
		);

		$this->add_group_control( Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'item_box_shadow',
				'label' => __( 'Box Shadow', 'mas-addons' ),
				'selector' => '{{WRAPPER}} .mas-cig-item-outline',
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'_section_style_tooltip',
			[
				'label' => __( 'Tooltips', 'mas-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'tooltip_position',
			[
				'label' => __( 'Position', 'mas-addons' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left'  => [
						'title' => __( 'Left', 'mas-addons' ),
						'icon' => 'eicon-h-align-left'
					],
					'up'  => [
						'title' => __( 'Up', 'mas-addons' ),
						'icon' => 'eicon-v-align-top'
					],
					'down'  => [
						'title' => __( 'Down', 'mas-addons' ),
						'icon' => 'eicon-v-align-bottom'
					],
					'right'  => [
						'title' => __( 'Right', 'mas-addons' ),
						'icon' => 'eicon-h-align-right'
					],
				],
				'default' => 'up',
				'toggle' => false,
			]
		);

		$this->add_responsive_control(
			'tooltip_padding',
			[
				'label' => __( 'Padding', 'mas-addons' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} [tooltip]::after' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
            'tooltip_border_radius',
            [
                'label' => __( 'Border Radius', 'mas-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} [tooltip]::after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
		);

		$this->add_control(
			'hr3',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		$this->add_group_control( Group_Control_Typography::get_type(),
			[
				'name' => 'tooltip_content_typography',
				'label' => __( 'Typography', 'mas-addons' ),
				'selector' => '{{WRAPPER}} [tooltip]::after',
			]
		);

		$this->add_control(
			'tooltip_color',
			[
				'label' => __( 'Color', 'mas-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} [tooltip]::after' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'tooltip_background',
			[
				'label' => __( 'Background Color', 'mas-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} [tooltip]::after' => 'background: {{VALUE}};',
					'{{WRAPPER}} [tooltip]::before' => '--caret-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control( Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'tooltip_box_shadow',
				'label' => __( 'Box Shadow', 'mas-addons' ),
				'selector' => '{{WRAPPER}} [tooltip]::after',
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render widget output on the frontend.
	 *
	 * Used to generate the final HTML displayed on the frontend.
	 *
	 * Note that if skin is selected, it will be rendered by the skin itself,
	 * not the widget.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		if ( empty( $settings['images'] ) ) {
			return;
		}

		?>

		<div class="mas-cig">
			<?php foreach ( $settings['images'] as $item ) :

				$item_id = 'elementor-repeater-item-'.$item['_id'];

                if(isset($item['image']) && $item['image']['url'] != ''){
                    $img_url = $item['image']['url'];
                }else{
                    $img_url = Utils::get_placeholder_image_src();
                }

                $content = '<img src="'.$img_url.'" alt="">';

				$tooltip_data = '';

				$tooltip_txt = $item['tooltip'];
				if(!empty($item['tooltip_position'])){
					$tooltip_position = $item['tooltip_position'];
				}else{
					$tooltip_position = $settings['tooltip_position'];
				}

				if($tooltip_txt){
					$tooltip_data = 'tooltip="'.$tooltip_txt.'" flow="'.$tooltip_position.'"';
				}

				$id = 'mas-cig-item-' . $item['_id'];

					$wrap_start = '<div '.$this->get_render_attribute_string( $id ).' class="mas-cig-item mas-cig-item-outline '.$item_id.'" '.$tooltip_data.'>';
					$wrap_end   = '</div>';
				
				echo $wrap_start, $content, $wrap_end;

			endforeach; ?>
		</div>

		<?php
	}
}
$widgets_manager->register(new \Mas_Addons\Widgets\Mas_Image_Stack_Group());
