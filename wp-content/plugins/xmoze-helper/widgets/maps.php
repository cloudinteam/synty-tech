<?php
namespace Elementor;


if ( !defined( 'ABSPATH' ) ) {
    exit;
}
/**
 * Class Maps
 */
class Maps extends Widget_Base {
    public function get_name() {
        return 'fd-addons-maps';
    }

    // public function is_reload_preview_required() {
    //     return true;
    // }

    public function get_title() {
        return __( 'Google Map', 'fd-addons' );
    }

    public function get_icon() {
        return 'eicon-google-maps';
    }

    public function get_categories() {
        return ['fd-addons','xmoze-addons'];
    }


    public function get_script_depends() {
        return [
            // 'google-maps-cluster',
            'xmoze-maps-api-js',
            'xmoze-maps-js',
        ];
    }

    public function get_keywords() {
        return ['google', 'marker', 'pin'];
    }

    // public function get_custom_help_url() {
    //     return 'https://uxtheme.net/support/';
    // }

    /**
     * Register Google Maps controls.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function register_controls() {
        $this->start_controls_section(
            'fd_addons_map_settings',
            [
                'label' => __( 'Center Location', 'fd-addons' ),
            ]
        );

        $settings = get_option( 'fd-addons' );

        if ( empty( $settings['gmap_api'] ) || '1' == $settings['gmap_api'] ) {
            $this->add_control(
                'maps_api_url',
                [
                    'raw'             => 'Finest Maps widget requires an API key. Get your API key from <a target="_blank" href="https://developers.google.com/maps/documentation/javascript/get-api-key">here</a> and add it to Finest options page. Go to Dashboard -> Finest Options -> Integrations tab',
                    'type'            => Controls_Manager::RAW_HTML,
                    'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
                ]
            );
        }

        /*   $this->add_control('map_ip_location',
        [
        'label'         => __( 'Get User Location', 'fd-addons' ),
        'description'   => __('Get center location from visitor\'s location','fd-addons'),
        'type'          => Controls_Manager::SWITCHER,
        'return_value'  => 'true'
        ]
        );

        $this->add_control('map_location_finder',
        [
        'label'         => __( 'Latitude & Longitude Finder', 'fd-addons' ),
        'type'          => Controls_Manager::SWITCHER,
        'condition'     => [
        'map_ip_location!'  => 'true'
        ]
        ]
        );

        $this->add_control('map_notice',
        [
        'label' => __( 'Find Latitude & Longitude', 'elementor' ),
        'type'  => Controls_Manager::RAW_HTML,
        'raw'   => '<form onsubmit="getAddress(this);" action="javascript:void(0);"><input type="text" id="fd-addons-map-get-address" class="fd-addons-map-get-address" style="margin-top:10px; margin-bottom:10px;"><input type="submit" value="Search" class="elementor-button elementor-button-default" onclick="getAddress(this)"></form><div class="fd-addons-address-result" style="margin-top:10px; line-height: 1.3; font-size: 12px;"></div>',
        'label_block' => true,
        'condition'     => [
        'map_location_finder'   => 'yes',
        'map_ip_location!'  => 'true'
        ]
        ]
        );
         */

        $this->add_control(
            'maps_center_lat',
            [
                'label'       => __( 'Center Latitude', 'fd-addons' ),
                'type'        => Controls_Manager::TEXT,
                'dynamic'     => ['active' => true],
                'description' => __( 'Center latitude and longitude are required to identify your location', 'fd-addons' ),
                'default'     => '18.591212',
                'label_block' => true,
                /*          'condition'     => [
            'map_ip_location!'  => 'true'
            ] */
            ]
        );

        $this->add_control(
            'maps_center_long',
            [
                'label'       => __( 'Center Longitude', 'fd-addons' ),
                'type'        => Controls_Manager::TEXT,
                'dynamic'     => ['active' => true],
                'description' => __( 'Center latitude and longitude are required to identify your location', 'fd-addons' ),
                'default'     => '73.741261',
                'label_block' => true,
                /*        'condition'     => [
            'map_ip_location!'  => 'true'
            ]*/
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'fd_addons_map_pins_settings',
            [
                'label' => __( 'Locations', 'fd-addons' ),
            ]
        );

        $this->add_control(
            'maps_markers_width',
            [
                'label' => __( 'Max Width', 'fd-addons' ),
                'type'  => Controls_Manager::NUMBER,
                'title' => __( 'Set the Maximum width for markers description box', 'fd-addons' ),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'pin_icon',
            [
                'label' => __( 'Custom Icon', 'fd-addons' ),
                'type'  => Controls_Manager::MEDIA,
            ]
        );

        $repeater->add_control(
            'pin_icon_size',
            [
                'label'      => __( 'Size', 'fd-addons' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em'],
                'range'      => [
                    'px' => [
                        'min' => 1,
                        'max' => 200,
                    ],
                    'em' => [
                        'min' => 1,
                        'max' => 20,
                    ],
                ],
            ]
        );

        /* $repeater->add_control('map_pin_location_finder',
        [
        'label'         => __( 'Latitude & Longitude Finder', 'fd-addons' ),
        'type'          => Controls_Manager::SWITCHER,
        ]
        );

        $repeater->add_control('map_pin_notice',
        [
        'label' => __( 'Find Latitude & Longitude', 'elementor' ),
        'type'  => Controls_Manager::RAW_HTML,
        'raw'   => '<form onsubmit="getPinAddress(this);" action="javascript:void(0);"><input type="text" id="fd-addons-map-get-address" class="fd-addons-map-get-address" style="margin-top:10px; margin-bottom:10px;"><input type="submit" value="Search" class="elementor-button elementor-button-default" onclick="getPinAddress(this)"></form><div class="fd-addons-address-result" style="margin-top:10px; line-height: 1.3; font-size: 12px;"></div>',
        'label_block' => true,
        'condition' => [
        'map_pin_location_finder'   => 'yes'
        ]
        ]
        );
         */
        $repeater->add_control(
            'map_latitude',
            [
                'label'       => __( 'Latitude', 'fd-addons' ),
                'type'        => Controls_Manager::TEXT,
                'dynamic'     => ['active' => true],
                'description' => 'Click <a href="https://www.latlong.net/" target="_blank">here</a> to get your location coordinates',
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'map_longitude',
            [
                'name'        => 'map_longitude',
                'label'       => __( 'Longitude', 'fd-addons' ),
                'type'        => Controls_Manager::TEXT,
                'dynamic'     => ['active' => true],
                'description' => 'Click <a href="https://www.latlong.net/" target="_blank">here</a> to get your location coordinates',
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'pin_title',
            [
                'label'       => __( 'Title', 'fd-addons' ),
                'type'        => Controls_Manager::TEXT,
                'dynamic'     => ['active' => true],
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'pin_desc',
            [
                'label'       => __( 'Description', 'fd-addons' ),
                'type'        => Controls_Manager::WYSIWYG,
                'dynamic'     => ['active' => true],
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'custom_id',
            [
                'label'       => __( 'Custom ID', 'fd-addons' ),
                'type'        => Controls_Manager::TEXT,
                // 'description'   => __('Use this with Finest Carousel widget ','fd-addons') .  '<a href="https://uxtheme.net/docs/how-to-use-elementor-widgets-to-navigate-through-carousel-widget-slides/" target="_blank">Custom Navigation option</a>',
                'dynamic'     => ['active' => true],
                'separator'   => 'before',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'fd_addons_map_pins',
            [
                'label'       => __( 'All Locations', 'fd-addons' ),
                'type'        => Controls_Manager::REPEATER,
                'default'     => [
                    'map_latitude'  => '18.591212',
                    'map_longitude' => '73.741261',
                    'pin_title'     => __( 'Finest Google Maps', 'fd-addons' ),
                    'pin_desc'      => __( 'Add an optional description to your map pin', 'fd-addons' ),
                ],
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{{ pin_title }}}',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'maps_controls_section',
            [
                'label' => __( 'Controls', 'fd-addons' ),
            ]
        );

        $this->add_control(
            'fd_addons_map_type',
            [
                'label'   => __( 'Map Type', 'fd-addons' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'roadmap'   => __( 'Road Map', 'fd-addons' ),
                    'satellite' => __( 'Satellite', 'fd-addons' ),
                    'terrain'   => __( 'Terrain', 'fd-addons' ),
                    'hybrid'    => __( 'Hybrid', 'fd-addons' ),
                ],
                'default' => 'roadmap',
            ]
        );

        $this->add_responsive_control(
            'fd_addons_map_height',
            [
                'label'     => __( 'Height', 'fd-addons' ),
                'type'      => Controls_Manager::SLIDER,
                'default'   => [
                    'size' => 500,
                ],
                'range'     => [
                    'px' => [
                        'min' => 80,
                        'max' => 1400,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .fd_addons_map_height' => 'height: {{SIZE}}px;',
                ],
            ]
        );

        $this->add_control(
            'fd_addons_map_zoom',
            [
                'label'   => __( 'Zoom', 'fd-addons' ),
                'type'    => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 12,
                ],
                'range'   => [
                    'px' => [
                        'min' => 0,
                        'max' => 22,
                    ],
                ],
            ]
        );

        $this->add_control(
            'disable_drag',
            [
                'label' => __( 'Disable Map Drag', 'fd-addons' ),
                'type'  => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'fd_addons_map_option_map_type_control',
            [
                'label' => __( 'Map Type Controls', 'fd-addons' ),
                'type'  => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'fd_addons_map_option_zoom_controls',
            [
                'label' => __( 'Zoom Controls', 'fd-addons' ),
                'type'  => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'fd_addons_map_option_streeview',
            [
                'label' => __( 'Street View Control', 'fd-addons' ),
                'type'  => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'fd_addons_map_option_fullscreen_control',
            [
                'label' => __( 'Fullscreen Control', 'fd-addons' ),
                'type'  => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'fd_addons_map_option_mapscroll',
            [
                'label' => __( 'Scroll Wheel Zoom', 'fd-addons' ),
                'type'  => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'maps_marker_open',
            [
                'label' => __( 'Info Container Always Opened', 'fd-addons' ),
                'type'  => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'maps_marker_hover_open',
            [
                'label' => __( 'Info Container Opened when Hovered', 'fd-addons' ),
                'type'  => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'maps_marker_mouse_out',
            [
                'label'     => __( 'Info Container Closed when Mouse Out', 'fd-addons' ),
                'type'      => Controls_Manager::SWITCHER,
                'condition' => [
                    'maps_marker_hover_open' => 'yes',
                ],
            ]
        );

        // if( $settings['fd-addons-map-cluster'] ) {
        //     $this->add_control('fd_addons_map_option_cluster',
        //         [
        //             'label'         => __( 'Marker Clustering', 'fd-addons' ),
        //             'type'          => Controls_Manager::SWITCHER,
        //         ]
        //     );
        // }

        $this->end_controls_section();

        $this->start_controls_section(
            'maps_custom_styling_section',
            [
                'label' => __( 'Map Style', 'fd-addons' ),
            ]
        );

        $this->add_control(
            'maps_custom_styling',
            [
                'label'       => __( 'JSON Code', 'fd-addons' ),
                'type'        => Controls_Manager::TEXTAREA,
                'description' => 'Get your custom styling from <a href="https://snazzymaps.com/" target="_blank">here</a>',
                'label_block' => true,
            ]
        );

        $this->end_controls_section();
        /*
        $this->start_controls_section('section_pa_docs',
        [
        'label'         => __('Helpful Documentations', 'fd-addons'),
        ]
        );

        $doc1_url = "Helper_Functions::get_campaign_link( 'https://uxtheme.net/docs/google-maps-widget-tutorial', 'editor-page', 'wp-editor', 'get-support' )";

        $this->add_control('doc_1',
        [
        'type'            => Controls_Manager::RAW_HTML,
        'raw'             => sprintf(  '<a href="%s" target="_blank">%s</a>', $doc1_url ,__( 'Getting started »', 'fd-addons' ) ),
        'content_classes' => 'editor-pa-doc',
        ]
        );

        $doc2_url = "Helper_Functions::get_campaign_link( 'https://uxtheme.net/docs/getting-your-api-key-for-google-reviews', 'editor-page', 'wp-editor', 'get-support' )";

        $this->add_control('doc_2',
        [
        'type'            => Controls_Manager::RAW_HTML,
        'raw'             => sprintf(  '<a href="%s" target="_blank">%s</a>', $doc2_url ,__( 'Getting your API key »', 'fd-addons' ) ),
        'content_classes' => 'editor-pa-doc',
        ]
        );

        $this->end_controls_section(); */

        $this->start_controls_section(
            'maps_pin_title_style',
            [
                'label' => __( 'Title', 'fd-addons' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'maps_pin_title_color',
            [
                'label'     => __( 'Color', 'fd-addons' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fd-addons-maps-info-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'pin_title_typography',
                'selector' => '{{WRAPPER}} .fd-addons-maps-info-title',
            ]
        );

        $this->add_responsive_control(
            'maps_pin_title_margin',
            [
                'label'      => __( 'Margin', 'fd-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .fd-addons-maps-info-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        /*Pin Title Padding*/
        $this->add_responsive_control(
            'maps_pin_title_padding',
            [
                'label'      => __( 'Padding', 'fd-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .fd-addons-maps-info-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        /*Pin Title ALign*/
        $this->add_responsive_control(
            'maps_pin_title_align',
            [
                'label'     => __( 'Alignment', 'fd-addons' ),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'left'   => [
                        'title' => __( 'Left', 'fd-addons' ),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'fd-addons' ),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'right'  => [
                        'title' => __( 'Right', 'fd-addons' ),
                        'icon'  => 'fa fa-align-right',
                    ],
                ],
                'default'   => 'center',
                'selectors' => [
                    '{{WRAPPER}} .fd-addons-maps-info-title' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        /*End Title Style Section*/
        $this->end_controls_section();

        /*Start Pin Style Section*/
        $this->start_controls_section(
            'maps_pin_text_style',
            [
                'label' => __( 'Description', 'fd-addons' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'maps_pin_text_color',
            [
                'label'     => __( 'Color', 'fd-addons' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fd-addons-maps-info-desc' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'pin_text_typo',
                'selector' => '{{WRAPPER}} .fd-addons-maps-info-desc',
            ]
        );

        $this->add_responsive_control(
            'maps_pin_text_margin',
            [
                'label'      => __( 'Margin', 'fd-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .fd-addons-maps-info-desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'maps_pin_text_padding',
            [
                'label'      => __( 'Padding', 'fd-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .fd-addons-maps-info-desc' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'maps_pin_description_align',
            [
                'label'     => __( 'Alignment', 'fd-addons' ),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'left'   => [
                        'title' => __( 'Left', 'fd-addons' ),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'fd-addons' ),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'right'  => [
                        'title' => __( 'Right', 'fd-addons' ),
                        'icon'  => 'fa fa-align-right',
                    ],
                ],
                'default'   => 'center',
                'selectors' => [
                    '{{WRAPPER}} .fd-addons-maps-info-desc' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'info_box_style',
            [
                'label' => __( 'Info Box', 'fd-addons' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        /*    $this->add_control(
        'map_info_box_bg_color',
        [
        'label'         => __('Background', 'fd-addons'),
        'type'          => Controls_Manager::COLOR,
        'selectors'     => [
        '{{WRAPPER}} .gm-style-iw.gm-style-iw-c , {{WRAPPER}} .gm-style .gm-style-iw-t::after'   => 'background-color: {{VALUE}};',
        ]
        ]
        );

        $this->add_control(
        'map_info_width',
        [
        'label'         => __('Width', 'fd-addons'),
        'type'          => Controls_Manager::SLIDER,
        'size_units'    => ['px', '%', 'em'],
        'range' => [
        'px' => [
        'min' => 0,
        'max' => 1000,
        ],
        'em' => [
        'min' => 0,
        'max' => 100,
        ],
        '%' => [
        'min' => 0,
        'max' => 100,
        ]
        ],
        'selectors'     => [
        '{{WRAPPER}} .gm-style-iw.gm-style-iw-c' => 'width: {{SIZE}}{{UNIT}};'
        ]
        ]
        );

         */

        $this->add_responsive_control(
            'map_info_box_margin',
            [
                'label'      => __( 'Margin', 'fd-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .gm-style-iw.gm-style-iw-c' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'map_info_box_padding',
            [
                'label'      => __( 'Padding', 'fd-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .gm-style-iw.gm-style-iw-c' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'map_info_box_align',
            [
                'label'     => __( 'Alignment', 'fd-addons' ),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'left'   => [
                        'title' => __( 'Left', 'fd-addons' ),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'fd-addons' ),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'right'  => [
                        'title' => __( 'Right', 'fd-addons' ),
                        'icon'  => 'fa fa-align-right',
                    ],
                ],
                'default'   => 'center',
                'selectors' => [
                    '{{WRAPPER}} .gm-style-iw.gm-style-iw-c' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'maps_box_style',
            [
                'label' => __( 'Map', 'fd-addons' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'map_border',
                'selector' => '{{WRAPPER}} .fd-addons-maps-container',
            ]
        );

        $this->add_control(
            'maps_box_radius',
            [
                'label'      => __( 'Border Radius', 'fd-addons' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .fd-addons-maps-container,{{WRAPPER}} .fd_addons_map_height' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'label'    => __( 'Shadow', 'fd-addons' ),
                'name'     => 'maps_box_shadow',
                'selector' => '{{WRAPPER}} .fd-addons-maps-container',
            ]
        );

        $this->add_responsive_control(
            'maps_box_margin',
            [
                'label'      => __( 'Margin', 'fd-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .fd-addons-maps-container' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'maps_box_padding',
            [
                'label'      => __( 'Padding', 'fd-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .fd-addons-maps-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Render Google Maps widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings_for_display();

        $map_pins = $settings['fd_addons_map_pins'];
        $street_view = 'yes' == $settings['fd_addons_map_option_streeview'] ? 'true' : 'false';
        $scroll_wheel = 'yes' == $settings['fd_addons_map_option_mapscroll'] ? 'true' : 'false';
        $enable_full_screen = 'yes' == $settings['fd_addons_map_option_fullscreen_control'] ? 'true' : 'false';
        $enable_zoom_control = 'yes' == $settings['fd_addons_map_option_zoom_controls'] ? 'true' : 'false';
        $map_type_control = 'yes' == $settings['fd_addons_map_option_map_type_control'] ? 'true' : 'false';
        $automatic_open = 'yes' == $settings['maps_marker_open'] ? 'true' : 'false';
        $hover_open = 'yes' == $settings['maps_marker_hover_open'] ? 'true' : 'false';
        $hover_close = 'yes' == $settings['maps_marker_mouse_out'] ? 'true' : 'false';
        $marker_cluster = false;

        // $is_cluster_enabled = Admin_Helper::get_integrations_settings()['fd-addons-map-cluster'];

        // if( $is_cluster_enabled ) {
        //     $marker_cluster = 'yes' == $settings['fd_addons_map_option_cluster'] ? 'true' : 'false';
        // }

        $centerlat = !empty( $settings['maps_center_lat'] ) ? $settings['maps_center_lat'] : 18.591212;
        $centerlong = !empty( $settings['maps_center_long'] ) ? $settings['maps_center_long'] : 73.741261;
        $marker_width = !empty( $settings['maps_markers_width'] ) ? $settings['maps_markers_width'] : 1000;
        /*         $get_ip_location = $settings['map_ip_location'];

        if( 'true' == $get_ip_location ) {

        if ( isset( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
        $http_x_headers = explode( ',', $_SERVER['HTTP_X_FORWARDED_FOR'] );
        $_SERVER['REMOTE_ADDR'] = $http_x_headers[0];
        }
        $ipAddress = $_SERVER['REMOTE_ADDR'];
        $env = unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip=$ipAddress"));
        $centerlat = isset( $env['geoplugin_latitude'] ) ? $env['geoplugin_latitude'] : $centerlat;
        $centerlong = isset( $env['geoplugin_longitude'] ) ? $env['geoplugin_longitude'] : $centerlong;

        } */

        $map_settings = [
            'zoom'              => $settings['fd_addons_map_zoom']['size'],
            'maptype'           => $settings['fd_addons_map_type'],
            'streetViewControl' => $street_view,
            'centerlat'         => $centerlat,
            'centerlong'        => $centerlong,
            'scrollwheel'       => $scroll_wheel,
            'fullScreen'        => $enable_full_screen,
            'zoomControl'       => $enable_zoom_control,
            'typeControl'       => $map_type_control,
            'automaticOpen'     => $automatic_open,
            'hoverOpen'         => $hover_open,
            'hoverClose'        => $hover_close,
            'cluster'           => $marker_cluster,
            'drag'              => $settings['disable_drag'],
        ];

        $this->add_render_attribute( 'style_wrapper', 'data-style', $settings['maps_custom_styling'] );?>

    <div class="fd-addons-maps-container" id="fd-addons-maps-container">
        <?php if ( count( $map_pins ) ) {?>
	        <div class="fd_addons_map_height" data-settings='<?php echo wp_json_encode( $map_settings ); ?>' <?php echo $this->get_render_attribute_string( 'style_wrapper' ); ?>>
			<?php
foreach ( $map_pins as $index => $pin ) {
            $key = 'map_marker_' . $index;

            $this->add_render_attribute( $key, [
                'class'          => 'fd-addons-pin',
                'data-lng'       => $pin['map_longitude'],
                'data-lat'       => $pin['map_latitude'],
                'data-icon'      => $pin['pin_icon']['url'],
                'data-icon-size' => $pin['pin_icon_size']['size'],
                'data-max-width' => $marker_width,
            ] );

            if ( !empty( $pin['custom_id'] ) ) {
                $this->add_render_attribute( $key, 'data-id', esc_attr( $pin['custom_id'] ) );
            }?>
                <div <?php echo $this->get_render_attribute_string( $key ); ?>>
                    <?php if ( !empty( $pin['pin_title'] ) || !empty( $pin['pin_desc'] ) ): ?>
                        <div class='fd-addons-maps-info-container'><p class='fd-addons-maps-info-title'><?php echo $pin['pin_title']; ?></p><div class='fd-addons-maps-info-desc'><?php echo $pin['pin_desc']; ?></div></div>
                    <?php endif;?>
                </div>
                <?php
}
            ?>
            </div>
			<?php
}?>
    </div>
    <?php
}
}

$widgets_manager->register( new \Elementor\Maps() );