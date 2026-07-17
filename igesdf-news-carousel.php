<?php
/**
 * Plugin Name: IgesDF News Carousel
 * Plugin URI:  https://github.com/marcoscti
 * Description: Carrossel de imagens para o CPT notícia utilizando Swiper.js.
 * Version:     1.2.2
 * Author:      Marcos Cordeiro
 * Author URI:  https://marcoscti.dev
 * License:     GPL2
 * Text Domain: igesdf-news-carousel
 */

if (!defined('ABSPATH')) {
    exit;
}

define('IGESDF_NEWS_CAROUSEL_URL', plugin_dir_url(__FILE__));
define('IGESDF_NEWS_CAROUSEL_PATH', plugin_dir_path(__FILE__));
define('IGESDF_NEWS_CAROUSEL_VERSION', '1.2.2');

add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('dashicons');
});

require_once IGESDF_NEWS_CAROUSEL_PATH . 'includes/metabox.php';
require_once IGESDF_NEWS_CAROUSEL_PATH . 'includes/shortcode.php';
require_once IGESDF_NEWS_CAROUSEL_PATH . 'includes/assets.php';
require_once IGESDF_NEWS_CAROUSEL_PATH . 'includes/admin.php';
