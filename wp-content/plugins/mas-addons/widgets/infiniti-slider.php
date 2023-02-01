<?php
namespace Mas_Addons\Widgets;


if (!defined('ABSPATH')) {
    exit;
}

class Mas_infinit_slider extends \Elementor\Widget_Base {

	public function get_name() {
		return 'mas_infinit_slider';
	}

	public function get_title() {
		return esc_html__( 'Infinit Slider', 'mas-addons' );
	}

	public function get_icon() {
		return 'eicon-post-slider';
	}

	public function get_categories() {
		return [ 'mas-addons' ];
	}

	public function get_keywords() {
		return [ 'Infiniti Slider', 'mas-addons' ];
	}

  protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Content', 'mas-addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

    $repeater = new \Elementor\Repeater();

    $repeater->add_control(
			'slider_image2',
			[
				'label' => esc_html__( 'Slider Image', 'mas-addons' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_control(
			'demo_slider2',
			[
				'label' => esc_html__( 'Repeater List', 'halim-addon' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
			]
		);



		$this->end_controls_section();

		// setting slider

		$this->start_controls_section(
			'setting_section',
			[
				'label' => esc_html__( 'Setting', 'mas-addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_responsive_control(
            'per_coulmn',
            [
                'label' => __('Slider Per Column Items', 'mas-addons'),
                'type' =>  \Elementor\Controls_Manager::SELECT,
                'default'            => 4,
                'tablet_default'     => 3,
                'mobile_default'     => 1,
                'options'            => [
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                    '6' => '6',
                    '7' => '7',
                    '8' => '8',
                    '9' => '9',
                    '10' => '10',
                ],
                'frontend_available' => true,
            ]
        );

		$this->add_responsive_control(
            'slide_scroll',
            [
                'label' => __('Slider Scroll Items', 'mas-addons'),
                'type' =>  \Elementor\Controls_Manager::SELECT,
                'default'            => 1,
                'options'            => [
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                    '6' => '6',
                    '7' => '7',
                    '8' => '8',
                    '9' => '9',
                    '10' => '10',
                ],
                'frontend_available' => true,
            ]
        );



		$this->add_control(
			'slider_rtl',
			[
				'label' => esc_html__( 'Rtl?', 'mas-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'true', 'mas-addons' ),
				'label_off' => esc_html__( 'false', 'mas-addons' ),
				'return_value' => 'true',
				'default' => 'false',
			]
		);

		$this->add_control(
            'speed',
            [
                'label' => __('Autoplay Speed', 'mas-addons'),
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
            ]
        );


		$this->end_controls_section();

	}
	
  protected function render() {
   		$settings = $this->get_settings_for_display();
		$demo_slider2 = $settings['demo_slider2'];

        $slider_rtl = $settings['slider_rtl'];

    
		if($slider_rtl == 'true'){
			$rtl_open = 'rtl';
		};

		$slider_extraSetting = array(
            'autoplay' => (!empty($settings['autoplay']) && 'yes' === $settings['autoplay']) ? true : false,
            'slider_rtl' => (!empty( $slider_rtl) && 'true' ===  $slider_rtl) ? true : false,
            'speed' => !empty($settings['speed']) ? $settings['speed'] : '3000',
            'slide_scroll' => !empty($settings['slide_scroll']) ? $settings['slide_scroll'] : 1,

            //this a responsive layout
            'per_coulmn' => (!empty($settings['per_coulmn'])) ? $settings['per_coulmn'] : 3,
            'per_coulmn_tablet' => (!empty($settings['per_coulmn_tablet'])) ? $settings['per_coulmn_tablet'] : 2,
            'per_coulmn_mobile' => (!empty($settings['per_coulmn_mobile'])) ? $settings['per_coulmn_mobile'] : 1
        );
        $jasondecode = wp_json_encode($slider_extraSetting);


		$this->add_render_attribute('slider_version', 'class', array('mas-infiniti-slider'));
        $this->add_render_attribute('slider_version', 'data-settings', $jasondecode);
		?>
		
	
		<div dir="<?php echo esc_attr($rtl_open) ?>">
			<div <?php echo $this->get_render_attribute_string('slider_version'); ?>>
				<?php 
				foreach ($demo_slider2 as $demo_sliders2) {
					?>
					<div class="mas-demo-slider-item">
					<img src="<?php echo esc_url($demo_sliders2['slider_image2']['url'])?>" alt="">
					</div>
					<?php
				}
				?>
				
			</div>
		</div>

		<?php
   
  }

}
$widgets_manager->register( new \Mas_Addons\Widgets\Mas_infinit_slider() );