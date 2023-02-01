<?php

/**
 * Plugin Name: Mas Addons
 * Description: A collection of beautifully designed Elementor addons.
 * Plugin URI:
 * Version:1.0.2
 * Author:
 * Author URI:
 * Text Domain: mas-addons
 */

if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
define( 'MAS_ADDONS__FILE__', __FILE__ );
define( 'MAS_ADDONS_DIR_PATH', plugin_dir_path( MAS_ADDONS__FILE__ ) );
define( 'MAS_ADDONS_ASSETS', plugins_url( 'assets/', __FILE__ ) );
/**
 * Main mas-addons Class
 *
 * The main class that initiates and runs the plugin.
 *
 * @since 1.0.0
 */
final class MAS_Addons_elementor {

    /**
     * Plugin Version
     *
     * @since 1.0.0
     *
     * @var string The plugin version.
     */
    const VERSION = '1.0.0';

    /**
     * Minimum Elementor Version
     *
     * @since 1.0.0
     *
     * @var string Minimum Elementor version required to run the plugin.
     */
    const MINIMUM_ELEMENTOR_VERSION = '2.0.0';

    /**
     * Minimum PHP Version
     *
     * @since 1.0.0
     *
     * @var string Minimum PHP version required to run the plugin.
     */
    const MINIMUM_PHP_VERSION = '5.6';

    /**
     * Instance
     *
     * @since 1.0.0
     *
     * @access private
     * @static
     *
     * @var mas_addons_elementor The single instance of the class.
     */
    private static $_instance = null;

    /**
     * Instance
     *
     * Ensures only one instance of the class is loaded or can be loaded.
     *
     * @since 1.0.0
     *
     * @access public
     * @static
     *
     * @return mas_addons_elementor An instance of the class.
     */
    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    /**
     * Constructor
     *
     * @since 1.0.0
     *
     * @access public
     */
    public function __construct() {
        add_action( 'init', [$this, 'i18n'] );
        add_action( 'plugins_loaded', [$this, 'init'] );

         //Defined Constants
         if (!defined('MAS_ADDONS_BADGE')) {
            define('MAS_ADDONS_BADGE', '<span class="mas-addons-badge"></span>');
        }
    }

    /**
     * Load Textdomain
     *
     * Load plugin localization files.
     *
     * Fired by `init` action hook.
     *
     * @since 1.0.0
     *
     * @access public
     */
    public function i18n() {
        load_plugin_textdomain( 'mas-addons' );
    }

    /**
     * Initialize the plugin
     *
     * Load the plugin only after Elementor (and other plugins) are loaded.
     * Checks for basic plugin requirements, if one check fail don't continue,
     * if all check have passed load the files required to run the plugin.
     *
     * Fired by `plugins_loaded` action hook.
     *
     * @since 1.0.0
     *
     * @access public
     */
    public function init() {

        // $this->update_checker();

        // Require the main plugin file
        require __DIR__ . '/inc/helper-functions.php';
        require __DIR__ . '/inc/elmentor-extender.php';
        require __DIR__ . '/inc/Classes/breadcrumb-class.php';
        require __DIR__ . '/traits/mas-button-murkup.php';

        // Check if Elementor installed and activated
        if ( !did_action( 'elementor/loaded' ) ) {
            add_action( 'admin_notices', [$this, 'admin_notice_missing_main_plugin'] );

            return;
        }

        // Check for required Elementor version
        if ( !version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
            add_action( 'admin_notices', [$this, 'admin_notice_minimum_elementor_version'] );

            return;
        }

        // Check for required PHP version
        if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
            add_action( 'admin_notices', [$this, 'admin_notice_minimum_php_version'] );

            return;
        }

        // Add Plugin actions
        add_action( 'elementor/widgets/register', [$this, 'init_widgets'] );
        add_action( 'elementor/frontend/after_enqueue_styles', [$this, 'widget_styles'] );
        add_action( 'elementor/frontend/after_register_scripts', [$this, 'widget_scripts'] );
        add_action( 'elementor/editor/after_enqueue_scripts', [$this, 'editor_scripts'], 100 );
    }


    /**
     * Admin notice
     *
     * Warning when the site doesn't have Elementor installed or activated.
     *
     * @since 1.0.0
     *
     * @access public
     */
    public function admin_notice_missing_main_plugin() {
        if ( isset( $_GET['activate'] ) ) {
            unset( $_GET['activate'] );
        }

        $message = sprintf(
            /* translators: 1: Plugin name 2: Elementor */
            esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'mas-addons' ),
            '<strong>' . esc_html__( 'Mas Addons', 'mas-addons' ) . '</strong>',
            '<strong>' . esc_html__( 'Elementor', 'mas-addons' ) . '</strong>'
        );

        printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
    }

    /**
     * Admin notice
     *
     * Warning when the site doesn't have a minimum required Elementor version.
     *
     * @since 1.0.0
     *
     * @access public
     */
    public function admin_notice_minimum_elementor_version() {
        if ( isset( $_GET['activate'] ) ) {
            unset( $_GET['activate'] );
        }

        $message = sprintf(
            /* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
            esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'mas-addons' ),
            '<strong>' . esc_html__( 'Mas Helper', 'mas-addons' ) . '</strong>',
            '<strong>' . esc_html__( 'Elementor', 'mas-addons' ) . '</strong>',
            self::MINIMUM_ELEMENTOR_VERSION
        );

        printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
    }

    /**
     * Admin notice
     *
     * Warning when the site doesn't have a minimum required PHP version.
     *
     * @since 1.0.0
     *
     * @access public
     */
    public function admin_notice_minimum_php_version() {
        if ( isset( $_GET['activate'] ) ) {
            unset( $_GET['activate'] );
        }

        $message = sprintf(
            /* translators: 1: Plugin name 2: PHP 3: Required PHP version */
            esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'mas-addons' ),
            '<strong>' . esc_html__( 'mas-addons', 'mas-addons' ) . '</strong>',
            '<strong>' . esc_html__( 'PHP', 'mas-addons' ) . '</strong>',
            self::MINIMUM_PHP_VERSION
        );

        printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
    }

    /**
     * Init Widgets
     *
     * Include widgets files and register them
     *
     * @since 1.0.0
     *
     * @access public
     */
    public function init_widgets() {

        $widgets_manager = \Elementor\Plugin::instance()->widgets_manager;

        /* Button */
        require_once __DIR__ . '/widgets/btn.php';

        /* Creative Button */
        require_once __DIR__ . '/widgets/creative-button.php';

        /* Creative Button */
        require_once __DIR__ . '/widgets/modal-popup.php';

        /* heading widget */
        require_once __DIR__ . '/widgets/heading.php';

        /* dual heading widget */
        require_once __DIR__ . '/widgets/dual-heading.php';

        /* blog widget */
        require_once __DIR__ . '/widgets/blog.php';

        /* blog widget */
        require_once __DIR__ . '/widgets/blog-category.php';

        /* contact widget */
        require_once __DIR__ . '/widgets/contact-form.php';

        /* icon widget */
        require_once __DIR__ . '/widgets/icon-box.php';

        /* post widget */
        require_once __DIR__ . '/widgets/post-navigation.php';

        /* back widget */
        require_once __DIR__ . '/widgets/back-to-top.php';

        /* breadcrumb widget */
        require_once __DIR__ . '/widgets/breadcrumb.php';

        /* Featrue Image */
        require_once __DIR__ . '/widgets/feature-image.php';

        /* Excerpt Image */
        require_once __DIR__ . '/widgets/excerpt.php';

        /* Pricing Box */
        require_once __DIR__ . '/widgets/pricing-box.php';

        /* Pricing Table */
        require_once __DIR__ . '/widgets/pricing-table.php';

        /* Pricing Table */
        require_once __DIR__ . '/widgets/count-down.php';

        /* Progressm Gar */
        require_once __DIR__ . '/widgets/progress-bar.php';

        /* Login Form */
        require_once __DIR__ . '/widgets/login.php';

        /* Register Form */
        require_once __DIR__ . '/widgets/register-form.php';

        /* Reset Password Form */
        require_once __DIR__ . '/widgets/reset-password.php';


        /* Reset Password Form */
        require_once __DIR__ . '/widgets/accordion.php';

        /* Tabs */
        require_once __DIR__ . '/widgets/tabs.php';

        /* card */
        require_once __DIR__ . '/widgets/card.php';

        /* brnd logo */
        require_once __DIR__ . '/widgets/brand-logo.php';

        /* content swither */
        require_once __DIR__ . '/widgets/content-swither.php';

        /* content swither */
        require_once __DIR__ . '/widgets/image-stack-group.php';

        /* List group */
        require_once __DIR__ . '/widgets/list-group.php';

        /* Infiniti Slider */
        // require_once __DIR__ . '/widgets/infiniti-slider.php';

        require_once __DIR__ . '/inc/modules/custom-css/custom-css.php';
        require_once __DIR__ . '/inc/modules/extras/extras.php';
        require_once __DIR__ . '/inc/modules/custom-position/custom-position.php';
        require_once __DIR__ . '/inc/modules/css-transform/css-transform.php';
        require_once __DIR__ . '/inc/modules/floting-effect/floting-effect.php';
    }

    public function widget_styles() {
        wp_dequeue_style( 'elementor-animations' );

        wp_enqueue_style( 'mas-addons-elementor-animations', plugins_url( '/assets/css/animate.css', __FILE__ ), [], microtime() );
        wp_enqueue_style( 'slick', plugins_url('/assets/css/slick.css', __FILE__), [], microtime());
        wp_enqueue_style( 'owl-carousel', plugins_url( '/assets/css/owl.carousel.min.css', __FILE__ ), [], microtime() );
        wp_enqueue_style( 'magnific-popup', plugins_url( '/assets/css/magnific-popup.css', __FILE__ ), [], microtime() );
        wp_enqueue_style( 'mas-addons', plugins_url( '/assets/css/addons.css', __FILE__ ), [], microtime() );
        wp_enqueue_style( 'mas-crivite-button', plugins_url( '/assets/css/creative-button.css', __FILE__ ), [], microtime() );
        wp_enqueue_style( 'mas-group-image', plugins_url( '/assets/css/group-image.css', __FILE__ ), [], microtime() );
        wp_style_add_data('mas-addons', 'rtl', 'replace' );
    }

    public function widget_scripts() {
        wp_register_script( 'mas-addons-maps-js', plugins_url( '/assets/js/mas-addons-maps.js', __FILE__ ), ['jquery'] );
        wp_register_script( 'waypoints', plugins_url( '/assets/js//jquery.waypoints.min.js', __FILE__ ), ['jquery'], microtime(), true );
        wp_register_script( 'mas-progress-bar', plugins_url( '/assets/js/mas-progress-bar-vendor.min.js', __FILE__ ), ['jquery'], microtime(), true );

        wp_enqueue_script( 'jquery-ui-datepicker' );
        wp_enqueue_script( 'slick', plugins_url('/assets/js/slick.js', __FILE__), ['jquery']);
        wp_enqueue_script( 'owl-carousel', plugins_url( '/assets/js/owl.carousel.min.js', __FILE__ ), ['jquery'] );
        wp_enqueue_script( 'isotope', plugins_url( '/assets/js/isotope.pkgd.min.js', __FILE__ ), ['jquery'] );
        wp_enqueue_script( 'packery', plugins_url( '/assets/js/packery-mode.pkgd.min.js', __FILE__ ), ['jquery', 'isotope'] );
        wp_enqueue_script( 'imagesloaded', plugins_url( '/assets/js/imagesloaded.pkgd.min.js', __FILE__ ), ['jquery', 'isotope'] );
        wp_enqueue_script( 'magnific-popup', plugins_url( '/assets/js/jquery.magnific-popup.min.js', __FILE__ ), ['jquery'], microtime(), true );
        wp_enqueue_script( 'mas-addons', plugins_url( '/assets/js/addon.js', __FILE__ ), ['jquery'] );
    }

    public function editor_scripts() {

        wp_enqueue_script( 'mas-addons-editor', plugins_url( '/assets/js/editor.js', __FILE__ ), ['jquery'], self::VERSION, true );
        wp_enqueue_style( 'mas-addons-styles-editor', plugins_url( 'assets/css/editor.css', __FILE__ ), [ 'elementor-editor' ], self::VERSION . '050420217' );
    }
}

MAS_Addons_elementor::instance();

/**
 * adding new category
 */
function mas_addons_add_elementor_widget_categories( $elements_manager ) {
    $elements_manager->add_category(
        'mas-addons',
        [
            'title' => __( 'Mas addons', 'mas-addons' ),
            'icon'  => 'fa fa-plug',
        ]
    );
}
add_action( 'elementor/elements/categories_registered', 'mas_addons_add_elementor_widget_categories' );
