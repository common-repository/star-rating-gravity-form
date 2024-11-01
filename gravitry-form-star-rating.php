<?php
/**
* Plugin Name: Star Rating Gravity Form
* Description: This plugin allows create Star Rating for gravityfrom.
* Version: 1.0.1
* Copyright:2019 
* Text Domain: star-rating-gravity-form
* Domain Path: /languages 
*/


if (!defined('ABSPATH')) {
	die('-1');
}
if (!defined('SRGF_rating_GF_PLUGIN_NAME')) {
	define('SRGF_rating_GF_PLUGIN_NAME', 'Star Rating Gravity Form');
}
if (!defined('SRGF_rating_GF_PLUGIN_VERSION')) {
	define('SRGF_rating_GF_PLUGIN_VERSION', '1.0.0');
}
if (!defined('SRGF_rating_GF_PLUGIN_FILE')) {
	define('SRGF_rating_GF_PLUGIN_FILE', __FILE__);
}
if (!defined('SRGF_rating_GF_PLUGIN_DIR')) {
	define('SRGF_rating_GF_PLUGIN_DIR',plugins_url('', __FILE__));
}
if (!defined('SRGF_rating_GF_DOMAIN')) {
	define('SRGF_rating_GF_DOMAIN', 'star-rating-gravity-form');
}
if (!defined('SRGF_rating_GF_BASE_NAME')) {
    define('SRGF_rating_GF_BASE_NAME', plugin_basename(SRGF_rating_GF_PLUGIN_FILE));
}


if (!class_exists('SRGF_rating_GF')) {

	class SRGF_rating_GF {
	  	protected static $rating;
  
	  	function includes() {
			include_once('admin/gravity_rating.php');
	  	} 


	  	function init() { 
			add_action('admin_enqueue_scripts', array($this, 'rating_load_admin_script_style'));
			add_action('wp_enqueue_scripts', array($this, 'rating_load_admin_script_style'),999);
			add_filter( 'plugin_row_meta', array( $this, 'SRGF_plugin_row_meta' ), 10, 2 );		
	  	}


	  	function rating_load_admin_script_style() {
		  	wp_enqueue_script( 'scrsssipt', SRGF_rating_GF_PLUGIN_DIR . '/js/jquery.rateit.js', false, '1.0.0' );
		  	wp_enqueue_script( 'scrsipt', SRGF_rating_GF_PLUGIN_DIR . '/js/rating.js', false, '1.0.0' );
		  	wp_enqueue_style( 'stylssse', SRGF_rating_GF_PLUGIN_DIR . '/js/rateit.css', false, '1.0.0' );
		  	wp_enqueue_style( 'SRGF_admin_style', SRGF_rating_GF_PLUGIN_DIR . '/includes/css/admin_style.css', false, '1.0.0' );
	  	}

	  	function SRGF_plugin_row_meta( $links, $file ) {
            if ( SRGF_rating_GF_BASE_NAME === $file ) {
                $row_meta = array(
                    'rating'    =>  '<a href="https://oceanwebguru.com/gravity-forms-star-rating-field/" target="_blank">Documentation</a> | <a href="https://oceanwebguru.com/contact-us/" target="_blank">Support</a> | <a href="https://wordpress.org/support/plugin/star-rating-gravity-form/reviews/?filter=5#new-post" target="_blank"><img src="'.SRGF_rating_GF_PLUGIN_DIR.'/includes/images/star.png" class="srgf_rating_div"></a>',
                );

                return array_merge( $links, $row_meta );
            }
            return (array) $links;
      	}

	  	public static function rating() {
			if (!isset(self::$rating)) {
		  		self::$rating = new self();
		  		self::$rating->init();
		  		self::$rating->includes();
		  	}
			return self::$rating;
		}
	}
	add_action('plugins_loaded', array('SRGF_rating_GF', 'rating'));
}


add_action( 'plugins_loaded', 'SRGF_load_textdomain' );
 
function SRGF_load_textdomain() {
    load_plugin_textdomain( 'star-rating-gravity-form', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' ); 
}

function SRGF_load_my_own_textdomain( $mofile, $domain ) {
    if ( 'star-rating-gravity-form' === $domain && false !== strpos( $mofile, WP_LANG_DIR . '/plugins/' ) ) {
        $locale = apply_filters( 'plugin_locale', determine_locale(), $domain );
        $mofile = WP_PLUGIN_DIR . '/' . dirname( plugin_basename( __FILE__ ) ) . '/languages/' . $domain . '-' . $locale . '.mo';
    }
    return $mofile;
}
add_filter( 'load_textdomain_mofile', 'SRGF_load_my_own_textdomain', 10, 2 );

?>