<?php

/**
 * Plugin Name: Xmoze Helper
 * Description: This plugin is compatible with Xmoze WordPress Landing Page Theme
 * Plugin URI: 
 * Version:     1.1.3
 * Author:      mthemeus
 * Author URI:  
 * Text Domain: xmoze-hp
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Main xmoze-hp Class
 *
 * The main class that initiates and runs the plugin.
 *
 * @since 1.0.0
 */
final class xmoze_elementor
{

    /**
     * Plugin Version
     *
     * @since 1.0.0
     *
     * @var string The plugin version.
     */
    const VERSION = '1.1.3';

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
     * @var xmoze_elementor The single instance of the class.
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
     * @return xmoze_elementor An instance of the class.
     */
    public static function instance()
    {
        if (is_null(self::$_instance)) {
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
    public function __construct()
    {
        add_action('init', [$this, 'i18n']);
        add_action('plugins_loaded', [$this, 'init']);
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
    public function i18n()
    {
        load_plugin_textdomain('xmoze-hp');
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
    public function init()
    {


		// $this->update_checker();

        // Require the main plugin file
        require(__DIR__ . '/inc/helper-functions.php');
        require_once(__DIR__ . '/inc/custom-post-types.php');
        require(__DIR__ . '/inc/acf.php');
        require(__DIR__ . '/inc/elmentor-extender.php');
        require(__DIR__ . '/inc/recent-post-thumbnail.php');
        require(__DIR__ . '/inc/admin-column.php');
        require(__DIR__ . '/inc/woocommerce-helper.php');

        // Check if Elementor installed and activated
        if (!did_action('elementor/loaded')) {
            add_action('admin_notices', [$this, 'admin_notice_missing_main_plugin']);
            return;
        }

        // Check for required Elementor version
        if (!version_compare(ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=')) {
            add_action('admin_notices', [$this, 'admin_notice_minimum_elementor_version']);
            return;
        }

        // Check for required PHP version
        if (version_compare(PHP_VERSION, self::MINIMUM_PHP_VERSION, '<')) {
            add_action('admin_notices', [$this, 'admin_notice_minimum_php_version']);
            return;
        }

        // Add Plugin actions
        add_action('elementor/widgets/register', [$this, 'init_widgets']);
        add_action('elementor/frontend/after_enqueue_styles', [$this, 'widget_styles']);
        add_action('elementor/frontend/after_register_scripts', [$this, 'widget_scripts']);
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
    public function admin_notice_missing_main_plugin()
    {
        if (isset($_GET['activate'])) {
            unset($_GET['activate']);
        }

        $message = sprintf(
            /* translators: 1: Plugin name 2: Elementor */
            esc_html__('"%1$s" requires "%2$s" to be installed and activated.', 'xmoze-hp'),
            '<strong>' . esc_html__('Xmoze Helper', 'xmoze-hp') . '</strong>',
            '<strong>' . esc_html__('Elementor', 'xmoze-hp') . '</strong>'
        );

        printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
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
    public function admin_notice_minimum_elementor_version()
    {
        if (isset($_GET['activate'])) {
            unset($_GET['activate']);
        }

        $message = sprintf(
            /* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
            esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'xmoze-hp'),
            '<strong>' . esc_html__('Xmoze Helper', 'xmoze-hp') . '</strong>',
            '<strong>' . esc_html__('Elementor', 'xmoze-hp') . '</strong>',
            self::MINIMUM_ELEMENTOR_VERSION
        );

        printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
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
    public function admin_notice_minimum_php_version()
    {
        if (isset($_GET['activate'])) {
            unset($_GET['activate']);
        }

        $message = sprintf(
            /* translators: 1: Plugin name 2: PHP 3: Required PHP version */
            esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'xmoze-hp'),
            '<strong>' . esc_html__('xmoze-hp', 'xmoze-hp') . '</strong>',
            '<strong>' . esc_html__('PHP', 'xmoze-hp') . '</strong>',
            self::MINIMUM_PHP_VERSION
        );

        printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
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
    public function init_widgets()
    {

        $widgets_manager = \Elementor\Plugin::instance()->widgets_manager;

        // Include Widget files crypto
		if (xmoze_check_cpt('crypto')) {
            require_once __DIR__ . '/widgets/Crypto/crypto.php';
        }

        // Include Widget files
		if (xmoze_check_cpt('service')) {
            require_once __DIR__ . '/widgets/services.php';
        }


        if( xmoze_check_cpt('job') ){
            require_once __DIR__ . '/widgets/job/job.php';
            require_once __DIR__ . '/widgets/job/job-single-meta.php';
            require_once __DIR__ . '/widgets/job/job-category.php';
        }

        if (xmoze_check_cpt('team')) {
            require_once __DIR__ . '/widgets/team.php';
        }

        if (xmoze_check_cpt('testimonial')) {
            require_once __DIR__ . '/widgets/testimonial.php';
            require_once __DIR__ . '/widgets/testimonial-two.php';
        }

        if (xmoze_check_cpt('portfolio')) {
            require_once __DIR__ . '/widgets/portfolio/portfolio.php';
            require_once __DIR__ . '/widgets/portfolio/portfolio-gallery.php';
            require_once __DIR__ . '/widgets/portfolio/single-portfolio-meta.php';

        }

        // case study

        if (xmoze_check_cpt('case-study')) {
            require_once __DIR__ . '/widgets/case-study/case-study.php';
            require_once __DIR__ . '/widgets/case-study/single-case-study-meta.php';
            require_once __DIR__ . '/widgets/case-study/category.php';

        }

        if ( class_exists( 'WooCommerce' ) ) {
            require_once __DIR__ . '/widgets/woocommerce/top-right-meta.php';
        }

        /* Tab */
        // require_once __DIR__ . '/widgets/tab.php';

        /* Featured */
        // require_once __DIR__ . '/widgets/featured.php';

        /* Testimonail Simple */
        require_once __DIR__ . '/widgets/testimonial-simple.php';

        /*Logo */
        require_once __DIR__ . '/widgets/logo.php';

        /* Nav Menu */
        require_once __DIR__ . '/widgets/main-menu.php';

        /* Vertical Menu */
        require_once __DIR__ . '/widgets/vertical-menu.php';

        /* Step Box */
        require_once __DIR__ . '/widgets/step-box.php';

        /* Dr Box */
        require_once __DIR__ . '/widgets/dr-box.php';

        /* Dr Box */
        require_once __DIR__ . '/widgets/image-carousel.php';

        /* Maps */
        // require_once __DIR__ . '/widgets/maps.php';

        /*job search*/
        require_once __DIR__ . '/widgets/job-search.php';

    }


    public function widget_styles()
    {

  

        wp_register_style('owl-carousel', plugins_url('/assets/css/owl.carousel.min.css', __FILE__), [], microtime());
        wp_enqueue_style('owl-carousel');

        wp_enqueue_style('slick', plugins_url('/assets/css/slick.css', __FILE__), [], microtime());
        wp_enqueue_style('hellofonts', plugins_url('/assets/css/custom-fonts.css', __FILE__), [], microtime());
        wp_enqueue_style('magnific-popup', plugins_url('/assets/css/magnific-popup.css', __FILE__), [], microtime());
        wp_enqueue_style('xmoze-helper-addons', plugins_url('/assets/css/addons.css', __FILE__), [], microtime());
        wp_enqueue_style('xmoze-woocommerce', plugins_url('/assets/css/xmoze-woocommerce.css', __FILE__), [], microtime());
        wp_style_add_data('xmoze-helper-addons', 'rtl', 'replace');
    }

    public function widget_scripts()
    {


        wp_register_script('owl-carousel', plugins_url('/assets/js/owl.carousel.min.js', __FILE__), ['jquery']);
        wp_enqueue_script('owl-carousel');

        wp_enqueue_script('jquery-ui-datepicker');
        wp_enqueue_script('slick', plugins_url('/assets/js/slick.js', __FILE__), ['jquery']);
        wp_enqueue_script('isotope', plugins_url('/assets/js/isotope.pkgd.min.js', __FILE__), ['jquery']);
        wp_enqueue_script('packery', plugins_url('/assets/js/packery-mode.pkgd.min.js', __FILE__), ['jquery', 'isotope']);
        wp_enqueue_script('imagesloaded', plugins_url('/assets/js/imagesloaded.pkgd.min.js', __FILE__), ['jquery', 'isotope']);
        wp_enqueue_script('magnific-popup', plugins_url('/assets/js/jquery.magnific-popup.min.js', __FILE__), ['jquery'], microtime(), true);
        wp_enqueue_script('xmoze-addon', plugins_url('/assets/js/addon.js', __FILE__), ['jquery'], microtime(), true);
    }
}

xmoze_elementor::instance();

/**
 * adding new category
 */
function xmoze_add_elementor_widget_categories($elements_manager)
{
    $elements_manager->add_category(
        'xmoze-addons',
        [
            'title' => __('Xmoze Addons', 'xmoze-hp'),
            'icon' => 'fa fa-plug',
        ]
    );
}
add_action('elementor/elements/categories_registered', 'xmoze_add_elementor_widget_categories');

// Adding Circular Std Font
/**
 * Add Font Group
 */
add_filter( 'elementor/fonts/groups', function ( $font_groups ) {
    $font_groups['xmoze_fonts'] = __( 'GeneralSans' );
    $font_groups['xmoze_fonts_two'] = __( 'ClashDisplay-Variable' );
    $font_groups['xmoze_fonts_three'] = __( 'CabinetGrotesk-Bold' );
    $font_groups['xmoze_fonts_file'] = __( 'CabinetGrotesk-Medium' );
    return $font_groups;
} );

add_filter( 'elementor/fonts/additional_fonts', function ( $additional_fonts ) {
    $additional_fonts['GeneralSans-Variable'] = 'xmoze_fonts';
    $additional_fonts['ClashDisplay-Variable'] = 'xmoze_fonts_two';
    $additional_fonts['CabinetGrotesk-Bold'] = 'xmoze_fonts_two';
    $additional_fonts['CCabinetGrotesk-Medium'] = 'xmoze_fonts_file';
    return $additional_fonts;
} );