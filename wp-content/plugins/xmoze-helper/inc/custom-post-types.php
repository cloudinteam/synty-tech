<?php
// File Security Check
if (!defined('ABSPATH')) {
	exit;
}
class XmozeCustomPosts
{
	function __construct()
	{
		add_action('admin_menu', array($this, 'xmoze_header_footer_menu'));
		// Header
		add_action('init', array($this, 'xmoze_header'));
		add_action('init', array($this, 'xmoze_footer'));

		if(xmoze_check_cpt('megamenu')){
			add_action('init', array($this, 'xmoze_megamenu'));
		}


		// team
		if (xmoze_check_cpt('team')) {
			add_action('init', array($this, 'xmoze_team'));
		}

		// services
		if (xmoze_check_cpt('service')) {
			add_action('init', array($this, 'xmoze_service'));
			add_action('init', array($this, 'xmoze_service_category'));
			add_action('init', array($this, 'xmoze_service_tags'));
		}

		// crypto
		if (xmoze_check_cpt('crypto')) {
			add_action('init', array($this, 'xmoze_crypto'));
			add_action('init', array($this, 'xmoze_crypto_category'));
			add_action('init', array($this, 'xmoze_crypto_tags'));
		}

		// Portfolios
		if (xmoze_check_cpt('portfolio')) {
			add_action('init', array($this, 'xmoze_portfolio'));
			add_action('init', array($this, 'xmoze_portfolio_category'));
			add_action('init', array($this, 'xmoze_portfolio_tags'));
		}

		// Portfolios
		if (xmoze_check_cpt('job')) {
			add_action('init', array($this, 'xmoze_job'));
			add_action('init', array($this, 'xmoze_job_category'));
			add_action('init', array($this, 'xmoze_job_tags'));
			add_action('init', array($this, 'xmoze_job_location'));
		}

		// Testimonial
		if (xmoze_check_cpt('testimonial')) {
			add_action('init', array($this, 'xmoze_testimonial'));
		}


		// Case Study
		if (xmoze_check_cpt('case-study')) {
			add_action('init', array($this, 'xmoze_case_study'));
			add_action('init', array($this, 'xmoze_case_study_category'));
			add_action('init', array($this, 'xmoze_case_study_tags'));
		}
	}

	public function xmoze_header_footer_menu()
	{
		add_menu_page(
			'Header & Footer',
			'Header & Footer',
			'read',
			'header-footer',
			'',
			'dashicons-archive',
			40
		);
	}
	/**
	 *
	 * Xmoze Header Footer Post Type
	 *
	 */
	public function xmoze_header()
	{
		$labels = array(
			'name'               => _x('Header', 'post type general name', 'xmoze-hp'),
			'singular_name'      => _x('Header', 'post type singular name', 'xmoze-hp'),
			'menu_name'          => _x('Header', 'admin menu', 'xmoze-hp'),
			'name_admin_bar'     => _x('Header', 'add new on admin bar', 'xmoze-hp'),
			'add_new'            => __('Add New Header', 'xmoze-hp'),
			'add_new_item'       => __('Add New Header', 'xmoze-hp'),
			'new_item'           => __('New Header', 'xmoze-hp'),
			'edit_item'          => __('Edit Header', 'xmoze-hp'),
			'view_item'          => __('View Header', 'xmoze-hp'),
			'all_items'          => __('All Headers', 'xmoze-hp'),
			'search_items'       => __('Search Headers', 'xmoze-hp'),
			'parent_item_colon'  => __('Parent :', 'xmoze-hp'),
			'not_found'          => __('No Headers found.', 'xmoze-hp'),
			'not_found_in_trash' => __('No Headers found in Trash.', 'xmoze-hp')
		);
		$args = array(
			'labels'             => $labels,
			'description'        => __('Description.', 'xmoze-hp'),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'menu_icon'          => 'dashicons-id',
			'show_in_menu' 		 => 'header-footer',
			'rewrite'            => array('slug' => 'header'),
			'capability_type'    => 'post',
			'has_archive'        => false,
			'hierarchical'       => true,
			'menu_position'      => null,
			'supports'           => array('title', 'elementor', 'editor', 'thumbnail',  'page-attributes')
		);
		register_post_type('xmoze_header', $args);
	}

	public function xmoze_footer()
	{
		$labels = array(
			'name'               => _x('Footer', 'post type general name', 'xmoze-hp'),
			'singular_name'      => _x('Footer', 'post type singular name', 'xmoze-hp'),
			'menu_name'          => _x('Footer', 'admin menu', 'xmoze-hp'),
			'name_admin_bar'     => _x('Footer', 'add new on admin bar', 'xmoze-hp'),
			'add_new'            => __('Add New Footer', 'xmoze-hp'),
			'add_new_item'       => __('Add New Footer', 'xmoze-hp'),
			'new_item'           => __('New Footer', 'xmoze-hp'),
			'edit_item'          => __('Edit Footer', 'xmoze-hp'),
			'view_item'          => __('View Footer', 'xmoze-hp'),
			'all_items'          => __('All Footers', 'xmoze-hp'),
			'search_items'       => __('Search Footers', 'xmoze-hp'),
			'parent_item_colon'  => __('Parent :', 'xmoze-hp'),
			'not_found'          => __('No Footers found.', 'xmoze-hp'),
			'not_found_in_trash' => __('No Footers found in Trash.', 'xmoze-hp')
		);
		$args = array(
			'labels'             => $labels,
			'description'        => __('Description.', 'xmoze-hp'),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'menu_icon'          => 'dashicons-id',
			'rewrite'            => array('slug' => 'footer'),
			'capability_type'    => 'post',
			'has_archive'        => false,
			'hierarchical'       => true,
			'menu_position'      => null,
			'show_in_menu' 		 => 'header-footer',
			'supports'           => array('title', 'elementor', 'editor', 'thumbnail',  'page-attributes')
		);
		register_post_type('xmoze_footer', $args);
	}


	public function xmoze_megamenu()
	{
		$labels = array(
			'name'               => _x('Mega Menu', 'post type general name', 'xmoze-hp'),
			'singular_name'      => _x('Mega Menu', 'post type singular name', 'xmoze-hp'),
			'menu_name'          => _x('Mega Menu', 'admin menu', 'xmoze-hp'),
			'name_admin_bar'     => _x('Mega Menu', 'add new on admin bar', 'xmoze-hp'),
			'add_new'            => __('Add New Mega Menu', 'xmoze-hp'),
			'add_new_item'       => __('Add New Mega Menu', 'xmoze-hp'),
			'new_item'           => __('New Mega Menu', 'xmoze-hp'),
			'edit_item'          => __('Edit Mega Menu', 'xmoze-hp'),
			'view_item'          => __('View Mega Menu', 'xmoze-hp'),
			'all_items'          => __('All Mega Menus', 'xmoze-hp'),
			'search_items'       => __('Search Mega Menus', 'xmoze-hp'),
			'parent_item_colon'  => __('Parent :', 'xmoze-hp'),
			'not_found'          => __('No Mega Menus found.', 'xmoze-hp'),
			'not_found_in_trash' => __('No Mega Menus found in Trash.', 'xmoze-hp')
		);

		$args = array(
			'labels'             => $labels,
			'description'        => __('Description.', 'xmoze-hp'),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'menu_icon'          => 'dashicons-id',
			'rewrite'            => array('slug' => 'megamenu'),
			'capability_type'    => 'post',
			'has_archive'        => false,
			'hierarchical'       => true,
			'menu_position'      => null,
			// 'show_in_menu' 		 => 'header-footer',
			'supports'           => array('title', 'elementor', 'thumbnail',  'page-attributes')
		);
		register_post_type('xmoze_megamenu', $args);
	}

	/**
	 *
	 * xmoze Service Custom Post Type
	 *
	 */
	public function xmoze_service()
	{
		$labels = array(
			'name'               => _x('Service', 'post type general name', 'xmoze-hp'),
			'singular_name'      => _x('Service', 'post type singular name', 'xmoze-hp'),
			'menu_name'          => _x('Service', 'admin menu', 'xmoze-hp'),
			'name_admin_bar'     => _x('Service', 'add new on admin bar', 'xmoze-hp'),
			'add_new'            => __('Add New Service', 'xmoze-hp'),
			'add_new_item'       => __('Add New Service', 'xmoze-hp'),
			'new_item'           => __('New Service', 'xmoze-hp'),
			'edit_item'          => __('Edit Service', 'xmoze-hp'),
			'view_item'          => __('View Service', 'xmoze-hp'),
			'all_items'          => __('All Services', 'xmoze-hp'),
			'search_items'       => __('Search Services', 'xmoze-hp'),
			'parent_item_colon'  => __('Parent :', 'xmoze-hp'),
			'not_found'          => __('No Services found.', 'xmoze-hp'),
			'not_found_in_trash' => __('No Services found in Trash.', 'xmoze-hp')
		);
		$args = array(
			'labels'             => $labels,
			'description'        => __('Description.', 'xmoze-hp'),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'menu_icon'          => 'dashicons-megaphone',
			'rewrite'            => array('slug' => 'service', 'with_front' => true, 'pages' => true, 'feeds' => true),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => true,
			'menu_position'      => null,
			'supports'           => array('elementor', 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes')
		);
		register_post_type('service', $args);
	}
	public function xmoze_service_category()
	{
		$labels = array(
			'name'              => _x('Categories', 'taxonomy general name', 'xmoze-hp'),
			'singular_name'     => _x('Category', 'taxonomy singular name', 'xmoze-hp'),
			'search_items'      => __('Search Categories', 'xmoze-hp'),
			'all_items'         => __('All Categories', 'xmoze-hp'),
			'parent_item'       => __('Parent Category', 'xmoze-hp'),
			'parent_item_colon' => __('Parent Category:', 'xmoze-hp'),
			'edit_item'         => __('Edit Category', 'xmoze-hp'),
			'update_item'       => __('Update Category', 'xmoze-hp'),
			'add_new_item'      => __('Add New Category', 'xmoze-hp'),
			'new_item_name'     => __('New Category Name', 'xmoze-hp'),
			'menu_name'         => __('Category', 'xmoze-hp'),
		);
		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array('slug' => 'service-category'),
		);
		register_taxonomy('service-category', array('service'), $args);
	}
	public function xmoze_service_tags()
	{
		$labels = array(
			'name'              => _x('Tags', 'taxonomy general name', 'xmoze-hp'),
			'singular_name'     => _x('Tag', 'taxonomy singular name', 'xmoze-hp'),
			'search_items'      => __('Search Tags', 'xmoze-hp'),
			'all_items'         => __('All Tags', 'xmoze-hp'),
			'parent_item'       => __('Parent Tag', 'xmoze-hp'),
			'parent_item_colon' => __('Parent Tag:', 'xmoze-hp'),
			'edit_item'         => __('Edit Tag', 'xmoze-hp'),
			'update_item'       => __('Update Tag', 'xmoze-hp'),
			'add_new_item'      => __('Add New Tag', 'xmoze-hp'),
			'new_item_name'     => __('New Tag Name', 'xmoze-hp'),
			'menu_name'         => __('Tag', 'xmoze-hp'),
		);
		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array('slug' => 'pf-tag'),
		);
		register_taxonomy('service-tag', array('service'), $args);
	}


	/**
	 *
	 * xmoze Cripto Custom Post Type
	 *
	 */
	public function xmoze_crypto()
	{
		$labels = array(
			'name'               => _x('Crypto', 'post type general name', 'xmoze-hp'),
			'singular_name'      => _x('Crypto', 'post type singular name', 'xmoze-hp'),
			'menu_name'          => _x('Crypto', 'admin menu', 'xmoze-hp'),
			'name_admin_bar'     => _x('Crypto', 'add new on admin bar', 'xmoze-hp'),
			'add_new'            => __('Add New Crypto', 'xmoze-hp'),
			'add_new_item'       => __('Add New Crypto', 'xmoze-hp'),
			'new_item'           => __('New Crypto', 'xmoze-hp'),
			'edit_item'          => __('Edit Crypto', 'xmoze-hp'),
			'view_item'          => __('View Crypto', 'xmoze-hp'),
			'all_items'          => __('All Cryptos', 'xmoze-hp'),
			'search_items'       => __('Search Cryptos', 'xmoze-hp'),
			'parent_item_colon'  => __('Parent :', 'xmoze-hp'),
			'not_found'          => __('No Cryptos found.', 'xmoze-hp'),
			'not_found_in_trash' => __('No Cryptos found in Trash.', 'xmoze-hp')
		);
		$args = array(
			'labels'             => $labels,
			'description'        => __('Description.', 'xmoze-hp'),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'menu_icon'          => 'dashicons-money-alt',
			'rewrite'            => array('slug' => 'crypto', 'with_front' => true, 'pages' => true, 'feeds' => true),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => true,
			'menu_position'      => null,
			'supports'           => array('elementor', 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes')
		);
		register_post_type('crypto', $args);
	}
	public function xmoze_crypto_category()
	{
		$labels = array(
			'name'              => _x('Categories', 'taxonomy general name', 'xmoze-hp'),
			'singular_name'     => _x('Category', 'taxonomy singular name', 'xmoze-hp'),
			'search_items'      => __('Search Categories', 'xmoze-hp'),
			'all_items'         => __('All Categories', 'xmoze-hp'),
			'parent_item'       => __('Parent Category', 'xmoze-hp'),
			'parent_item_colon' => __('Parent Category:', 'xmoze-hp'),
			'edit_item'         => __('Edit Category', 'xmoze-hp'),
			'update_item'       => __('Update Category', 'xmoze-hp'),
			'add_new_item'      => __('Add New Category', 'xmoze-hp'),
			'new_item_name'     => __('New Category Name', 'xmoze-hp'),
			'menu_name'         => __('Category', 'xmoze-hp'),
		);
		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array('slug' => 'crypto-category'),
		);
		register_taxonomy('crypto-category', array('crypto'), $args);
	}
	public function xmoze_crypto_tags()
	{
		$labels = array(
			'name'              => _x('Tags', 'taxonomy general name', 'xmoze-hp'),
			'singular_name'     => _x('Tag', 'taxonomy singular name', 'xmoze-hp'),
			'search_items'      => __('Search Tags', 'xmoze-hp'),
			'all_items'         => __('All Tags', 'xmoze-hp'),
			'parent_item'       => __('Parent Tag', 'xmoze-hp'),
			'parent_item_colon' => __('Parent Tag:', 'xmoze-hp'),
			'edit_item'         => __('Edit Tag', 'xmoze-hp'),
			'update_item'       => __('Update Tag', 'xmoze-hp'),
			'add_new_item'      => __('Add New Tag', 'xmoze-hp'),
			'new_item_name'     => __('New Tag Name', 'xmoze-hp'),
			'menu_name'         => __('Tag', 'xmoze-hp'),
		);
		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array('slug' => 'crypto-tag'),
		);
		register_taxonomy('crypto-tag', array('crypto'), $args);
	}

	/**
	 *
	 * Xmoze Team Post Type
	 *
	 */
	public function xmoze_team()
	{
		$labels = array(
			'name'               => _x('Team Member', 'post type general name', 'xmoze-hp'),
			'singular_name'      => _x('Team Member', 'post type singular name', 'xmoze-hp'),
			'menu_name'          => _x('Team Member', 'admin menu', 'xmoze-hp'),
			'name_admin_bar'     => _x('Team Member', 'add new on admin bar', 'xmoze-hp'),
			'add_new'            => __('Add New Member', 'xmoze-hp'),
			'add_new_item'       => __('Add New Member', 'xmoze-hp'),
			'new_item'           => __('New Member', 'xmoze-hp'),
			'edit_item'          => __('Edit Member', 'xmoze-hp'),
			'view_item'          => __('View Member', 'xmoze-hp'),
			'all_items'          => __('All Team Members', 'xmoze-hp'),
			'search_items'       => __('Search Team Members', 'xmoze-hp'),
			'parent_item_colon'  => __('Parent :', 'xmoze-hp'),
			'not_found'          => __('No Team Members found.', 'xmoze-hp'),
			'not_found_in_trash' => __('No Team Members found in Trash.', 'xmoze-hp')
		);
		$args = array(
			'labels'             => $labels,
			'description'        => __('Description.', 'xmoze-hp'),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'menu_icon'          => 'dashicons-id',
			'rewrite'            => array('slug' => 'team', 'with_front' => true, 'pages' => true, 'feeds' => true),
			'capability_type'    => 'post',
			'has_archive'        => false,
			'hierarchical'       => true,
			'menu_position'      => null,
			'supports'           => array('title', 'editor', 'thumbnail', 'elementor',  'page-attributes')
		);
		register_post_type('team', $args);
	}

	/**
	 *
	 * Xmoze Portfolio Post Type
	 *
	 */
	public function xmoze_portfolio()
	{
		$labels = array(
			'name'               => _x('Portfolio', 'post type general name', 'xmoze-hp'),
			'singular_name'      => _x('Portfolio', 'post type singular name', 'xmoze-hp'),
			'menu_name'          => _x('Portfolio', 'admin menu', 'xmoze-hp'),
			'name_admin_bar'     => _x('Portfolio', 'add new on admin bar', 'xmoze-hp'),
			'add_new'            => __('Add New Portfolio', 'xmoze-hp'),
			'add_new_item'       => __('Add New Portfolio', 'xmoze-hp'),
			'new_item'           => __('New Portfolio', 'xmoze-hp'),
			'edit_item'          => __('Edit Portfolio', 'xmoze-hp'),
			'view_item'          => __('View Portfolio', 'xmoze-hp'),
			'all_items'          => __('All Portfolios', 'xmoze-hp'),
			'search_items'       => __('Search Portfolios', 'xmoze-hp'),
			'parent_item_colon'  => __('Parent :', 'xmoze-hp'),
			'not_found'          => __('No Portfolios found.', 'xmoze-hp'),
			'not_found_in_trash' => __('No Portfolios found in Trash.', 'xmoze-hp')
		);
		$args = array(
			'labels'             => $labels,
			'description'        => __('Description.', 'xmoze-hp'),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'menu_icon'          => 'dashicons-id',
			'rewrite'            => array('slug' => 'portfolio', 'with_front' => true, 'pages' => true, 'feeds' => true),
			'capability_type'    => 'post',
			'has_archive'        => false,
			'hierarchical'       => true,
			'menu_position'      => null,
			'supports'           => array('title', 'elementor', 'editor', 'thumbnail',  'page-attributes')
		);
		register_post_type('portfolio', $args);
	}
	public function xmoze_portfolio_category()
	{
		$labels = array(
			'name'              => _x('Categories', 'taxonomy general name', 'xmoze-hp'),
			'singular_name'     => _x('Category', 'taxonomy singular name', 'xmoze-hp'),
			'search_items'      => __('Search Categories', 'xmoze-hp'),
			'all_items'         => __('All Categories', 'xmoze-hp'),
			'parent_item'       => __('Parent Category', 'xmoze-hp'),
			'parent_item_colon' => __('Parent Category:', 'xmoze-hp'),
			'edit_item'         => __('Edit Category', 'xmoze-hp'),
			'update_item'       => __('Update Category', 'xmoze-hp'),
			'add_new_item'      => __('Add New Category', 'xmoze-hp'),
			'new_item_name'     => __('New Category Name', 'xmoze-hp'),
			'menu_name'         => __('Category', 'xmoze-hp'),
		);
		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array('slug' => 'portfolio-category'),
		);
		register_taxonomy('portfolio-category', array('portfolio'), $args);
	}
	public function xmoze_portfolio_tags()
	{
		$labels = array(
			'name'              => _x('Tags', 'taxonomy general name', 'xmoze-hp'),
			'singular_name'     => _x('Tag', 'taxonomy singular name', 'xmoze-hp'),
			'search_items'      => __('Search Tags', 'xmoze-hp'),
			'all_items'         => __('All Tags', 'xmoze-hp'),
			'parent_item'       => __('Parent Tag', 'xmoze-hp'),
			'parent_item_colon' => __('Parent Tag:', 'xmoze-hp'),
			'edit_item'         => __('Edit Tag', 'xmoze-hp'),
			'update_item'       => __('Update Tag', 'xmoze-hp'),
			'add_new_item'      => __('Add New Tag', 'xmoze-hp'),
			'new_item_name'     => __('New Tag Name', 'xmoze-hp'),
			'menu_name'         => __('Tag', 'xmoze-hp'),
		);
		$args = array(
			'hierarchical'      => false,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array('slug' => 'portfolio-tag'),
		);
		register_taxonomy('portfolio-tag', array('portfolio'), $args);
	}

	/**
	 *
	 * Xmoze Job Post Type
	 *
	 */
	public function xmoze_job()
	{
		$labels = array(
			'name'               => _x('Job', 'post type general name', 'xmoze-hp'),
			'singular_name'      => _x('Job', 'post type singular name', 'xmoze-hp'),
			'menu_name'          => _x('Job', 'admin menu', 'xmoze-hp'),
			'name_admin_bar'     => _x('Job', 'add new on admin bar', 'xmoze-hp'),
			'add_new'            => __('Add New Job', 'xmoze-hp'),
			'add_new_item'       => __('Add New Job', 'xmoze-hp'),
			'new_item'           => __('New Job', 'xmoze-hp'),
			'edit_item'          => __('Edit Job', 'xmoze-hp'),
			'view_item'          => __('View Job', 'xmoze-hp'),
			'all_items'          => __('All Jobs', 'xmoze-hp'),
			'search_items'       => __('Search Jobs', 'xmoze-hp'),
			'parent_item_colon'  => __('Parent :', 'xmoze-hp'),
			'not_found'          => __('No Jobs found.', 'xmoze-hp'),
			'not_found_in_trash' => __('No Jobs found in Trash.', 'xmoze-hp')
		);
		$args = array(
			'labels'             => $labels,
			'description'        => __('Description.', 'xmoze-hp'),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'menu_icon'          => 'dashicons-id',
			'rewrite'            => array('slug' => 'job', 'with_front' => true, 'pages' => true, 'feeds' => true),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => true,
			'menu_position'      => null,
			'supports'           => array('title', 'elementor', 'editor', 'thumbnail', 'excerpt', 'page-attributes')
		);
		register_post_type('job', $args);
	}
	public function xmoze_job_category()
	{
		$labels = array(
			'name'              => _x('Categories', 'taxonomy general name', 'xmoze-hp'),
			'singular_name'     => _x('Category', 'taxonomy singular name', 'xmoze-hp'),
			'search_items'      => __('Search Categories', 'xmoze-hp'),
			'all_items'         => __('All Categories', 'xmoze-hp'),
			'parent_item'       => __('Parent Category', 'xmoze-hp'),
			'parent_item_colon' => __('Parent Category:', 'xmoze-hp'),
			'edit_item'         => __('Edit Category', 'xmoze-hp'),
			'update_item'       => __('Update Category', 'xmoze-hp'),
			'add_new_item'      => __('Add New Category', 'xmoze-hp'),
			'new_item_name'     => __('New Category Name', 'xmoze-hp'),
			'menu_name'         => __('Category', 'xmoze-hp'),
		);
		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array('slug' => 'job-category'),
		);
		register_taxonomy('job-category', array('job'), $args);
	}
	public function xmoze_job_tags()
	{
		$labels = array(
			'name'              => _x('Tags', 'taxonomy general name', 'xmoze-hp'),
			'singular_name'     => _x('Tag', 'taxonomy singular name', 'xmoze-hp'),
			'search_items'      => __('Search Tags', 'xmoze-hp'),
			'all_items'         => __('All Tags', 'xmoze-hp'),
			'parent_item'       => __('Parent Tag', 'xmoze-hp'),
			'parent_item_colon' => __('Parent Tag:', 'xmoze-hp'),
			'edit_item'         => __('Edit Tag', 'xmoze-hp'),
			'update_item'       => __('Update Tag', 'xmoze-hp'),
			'add_new_item'      => __('Add New Tag', 'xmoze-hp'),
			'new_item_name'     => __('New Tag Name', 'xmoze-hp'),
			'menu_name'         => __('Tag', 'xmoze-hp'),
		);
		$args = array(
			'hierarchical'      => false,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array('slug' => 'job-tag'),
		);
		register_taxonomy('job-tag', array('job'), $args);
	}
	public function xmoze_job_location()
	{
		$labels = array(
			'name'              => _x('Job Locations', 'taxonomy general name', 'shadepro-ts'),
			'singular_name'     => _x('Job Location', 'taxonomy singular name', 'shadepro-ts'),
			'search_items'      => __('Search Job Locations', 'shadepro-ts'),
			'all_items'         => __('All Job Locations', 'shadepro-ts'),
			'parent_item'       => __('Parent Job Location', 'shadepro-ts'),
			'parent_item_colon' => __('Parent Job Location:', 'shadepro-ts'),
			'edit_item'         => __('Edit Job Location', 'shadepro-ts'),
			'update_item'       => __('Update Job Location', 'shadepro-ts'),
			'add_new_item'      => __('Add New Job Location', 'shadepro-ts'),
			'new_item_name'     => __('New Job Location Name', 'shadepro-ts'),
			'menu_name'         => __('Job Location', 'shadepro-ts'),
		);
		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array('slug' => 'job-location'),
		);
		register_taxonomy('job-location', array('job'), $args);
	}
	//Testimonial
	public function xmoze_testimonial()
	{
		$labels = array(
			'name'               => _x('Testimonial', 'post type general name', 'xmoze-hp'),
			'singular_name'      => _x('Testimonial', 'post type singular name', 'xmoze-hp'),
			'menu_name'          => _x('Testimonial', 'admin menu', 'xmoze-hp'),
			'name_admin_bar'     => _x('Testimonial', 'add new on admin bar', 'xmoze-hp'),
			'add_new'            => __('Add New Testimonial', 'xmoze-hp'),
			'add_new_item'       => __('Add New Testimonial', 'xmoze-hp'),
			'new_item'           => __('New Testimonial', 'xmoze-hp'),
			'edit_item'          => __('Edit Testimonial', 'xmoze-hp'),
			'view_item'          => __('View Testimonial', 'xmoze-hp'),
			'all_items'          => __('All Testimonial', 'xmoze-hp'),
			'search_items'       => __('Search Testimonial', 'xmoze-hp'),
			'parent_item_colon'  => __('Parent :', 'xmoze-hp'),
			'not_found'          => __('No Testimonial found.', 'xmoze-hp'),
			'not_found_in_trash' => __('No Testimonial found in Trash.', 'xmoze-hp')
		);
		$args = array(
			'labels'             => $labels,
			'description'        => __('Description.', 'xmoze-hp'),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'menu_icon'          => 'dashicons-testimonial',
			'rewrite'            => array('slug' => 'xmoze_testimonial', 'with_front' => true, 'pages' => true, 'feeds' => true),
			'capability_type'    => 'post',
			'has_archive'        => false,
			'hierarchical'       => true,
			'menu_position'      => null,
			'supports'           => array('title', 'editor', 'thumbnail',  'page-attributes')
		);
		register_post_type('xmoze_testimonial', $args);
	}
	public function xmoze_testimonial_category()
	{
		$labels = array(
			'name'              => _x('Categories', 'taxonomy general name', 'xmoze-hp'),
			'singular_name'     => _x('Category', 'taxonomy singular name', 'xmoze-hp'),
			'search_items'      => __('Search Categories', 'xmoze-hp'),
			'all_items'         => __('All Categories', 'xmoze-hp'),
			'parent_item'       => __('Parent Category', 'xmoze-hp'),
			'parent_item_colon' => __('Parent Category:', 'xmoze-hp'),
			'edit_item'         => __('Edit Category', 'xmoze-hp'),
			'update_item'       => __('Update Category', 'xmoze-hp'),
			'add_new_item'      => __('Add New Category', 'xmoze-hp'),
			'new_item_name'     => __('New Category Name', 'xmoze-hp'),
			'menu_name'         => __('Category', 'xmoze-hp'),
		);
		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array('slug' => 'portfolio-category'),
		);
		register_taxonomy('testimonial_category', array('xmoze_testimonial'), $args);
	}
	public function xmoze_testimonial_tags()
	{
		$labels = array(
			'name'              => _x('Tags', 'taxonomy general name', 'xmoze-hp'),
			'singular_name'     => _x('Tag', 'taxonomy singular name', 'xmoze-hp'),
			'search_items'      => __('Search Tags', 'xmoze-hp'),
			'all_items'         => __('All Tags', 'xmoze-hp'),
			'parent_item'       => __('Parent Tag', 'xmoze-hp'),
			'parent_item_colon' => __('Parent Tag:', 'xmoze-hp'),
			'edit_item'         => __('Edit Tag', 'xmoze-hp'),
			'update_item'       => __('Update Tag', 'xmoze-hp'),
			'add_new_item'      => __('Add New Tag', 'xmoze-hp'),
			'new_item_name'     => __('New Tag Name', 'xmoze-hp'),
			'menu_name'         => __('Tag', 'xmoze-hp'),
		);
		$args = array(
			'hierarchical'      => false,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array('slug' => 'portfolio-tag'),
		);
		register_taxonomy('testimonial_tag', array('xmoze_testimonial'), $args);
	}

	//Case Study

	public function xmoze_case_study()
	{
		$labels = array(
			'name'               => _x('Case Study', 'post type general name', 'xmoze-hp'),
			'singular_name'      => _x('Case Study', 'post type singular name', 'xmoze-hp'),
			'menu_name'          => _x('Case Study', 'admin menu', 'xmoze-hp'),
			'name_admin_bar'     => _x('Case Study', 'add new on admin bar', 'xmoze-hp'),
			'add_new'            => __('Add New Studies', 'xmoze-hp'),
			'add_new_item'       => __('Add New Studies', 'xmoze-hp'),
			'new_item'           => __('New Studies', 'xmoze-hp'),
			'edit_item'          => __('Edit Studies', 'xmoze-hp'),
			'view_item'          => __('View Studies', 'xmoze-hp'),
			'all_items'          => __('All Studies', 'xmoze-hp'),
			'search_items'       => __('Search Studies', 'xmoze-hp'),
			'parent_item_colon'  => __('Parent :', 'xmoze-hp'),
			'not_found'          => __('No Studies found.', 'xmoze-hp'),
			'not_found_in_trash' => __('No Studies found in Trash.', 'xmoze-hp')
		);
		$args = array(
			'labels'             => $labels,
			'description'        => __('Description.', 'xmoze-hp'),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'menu_icon'          => 'dashicons-media-spreadsheet',
			'rewrite'            => array('slug' => 'case-studies', 'with_front' => true, 'pages' => true, 'feeds' => true),
			'capability_type'    => 'post',
			'has_archive'        => false,
			'hierarchical'       => true,
			'menu_position'      => null,
			'supports'           => array('title', 'elementor', 'editor', 'excerpt', 'thumbnail',  'page-attributes')
		);
		register_post_type('case-study', $args);
	}

	public function xmoze_case_study_category()
	{
		$labels = array(
			'name'              => _x('Categories', 'taxonomy general name', 'xmoze-hp'),
			'singular_name'     => _x('Category', 'taxonomy singular name', 'xmoze-hp'),
			'search_items'      => __('Search Categories', 'xmoze-hp'),
			'all_items'         => __('All Categories', 'xmoze-hp'),
			'parent_item'       => __('Parent Category', 'xmoze-hp'),
			'parent_item_colon' => __('Parent Category:', 'xmoze-hp'),
			'edit_item'         => __('Edit Category', 'xmoze-hp'),
			'update_item'       => __('Update Category', 'xmoze-hp'),
			'add_new_item'      => __('Add New Category', 'xmoze-hp'),
			'new_item_name'     => __('New Category Name', 'xmoze-hp'),
			'menu_name'         => __('Category', 'xmoze-hp'),
		);
		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array('slug' => 'studies_category'),
		);
		register_taxonomy('case-study-category', array('case-study'), $args);
	}

	public function xmoze_case_study_tags()
	{
		$labels = array(
			'name'              => _x('Tags', 'taxonomy general name', 'xmoze-hp'),
			'singular_name'     => _x('Tag', 'taxonomy singular name', 'xmoze-hp'),
			'search_items'      => __('Search Tags', 'xmoze-hp'),
			'all_items'         => __('All Tags', 'xmoze-hp'),
			'parent_item'       => __('Parent Tag', 'xmoze-hp'),
			'parent_item_colon' => __('Parent Tag:', 'xmoze-hp'),
			'edit_item'         => __('Edit Tag', 'xmoze-hp'),
			'update_item'       => __('Update Tag', 'xmoze-hp'),
			'add_new_item'      => __('Add New Tag', 'xmoze-hp'),
			'new_item_name'     => __('New Tag Name', 'xmoze-hp'),
			'menu_name'         => __('Tag', 'xmoze-hp'),
		);
		$args = array(
			'hierarchical'      => false,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array('slug' => 'studies-tag'),
		);
		register_taxonomy('studies-tag', array('case-study'), $args);
	}
}
$xmozeCcases_stydyInstance = new XmozeCustomPosts;
