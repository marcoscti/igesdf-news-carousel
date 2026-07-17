<?php
if (!defined('ABSPATH')) exit;

function igesdf_gallery_admin_assets($hook){
 global $post;
 if (($hook==='post.php'||$hook==='post-new.php') && isset($post) && $post->post_type==='noticia'){ wp_enqueue_media(); }
}
add_action('admin_enqueue_scripts','igesdf_gallery_admin_assets');

function igesdf_swiper_assets(){
 global $post;
 if (is_singular('noticia') && isset($post->post_content) && has_shortcode($post->post_content,'carrossel_noticia')){
   wp_enqueue_style('swiper-css','https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css',[], '8.4.7');
   wp_enqueue_script('swiper-js','https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js',[], '8.4.7', true);
   wp_enqueue_style('igesdf-news-carousel-css', IGESDF_NEWS_CAROUSEL_URL.'assets/css/style.css',['swiper-css'], IGESDF_NEWS_CAROUSEL_VERSION);
 }
}
add_action('wp_enqueue_scripts','igesdf_swiper_assets');
