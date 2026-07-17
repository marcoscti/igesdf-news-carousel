<?php

if (!defined('ABSPATH')) {
    exit;
}

function igesdf_news_carousel_admin_menu()
{
    add_options_page(
        'IgesDF News Carousel',
        'IgesDF News Carousel',
        'manage_options',
        'igesdf-news-carousel',
        'igesdf_news_carousel_admin_page'
    );
}

add_action('admin_menu', 'igesdf_news_carousel_admin_menu');

function igesdf_news_carousel_admin_page()
{
    ?>
    <div class="wrap">
        <h1>IgesDF News Carousel</h1>
        <p>Use o shortcode <code>[carrossel_noticia]</code> em posts do tipo <strong>noticia</strong>.</p>
        <?php if (!post_type_exists('noticia')) : ?>
            <div class="notice notice-warning inline">
                <p>O tipo de post personalizado <strong>noticia</strong> não está registrado.</p>
                <p>Ative o plugin ou o tema responsável pelo registro do CPT <code>noticia</code> para usar este plugin.</p>
            </div>
        <?php else : ?>
            <p>O tipo de post personalizado <strong>noticia</strong> está disponível.</p>
            <p>Edite ou crie uma notícia e adicione imagens usando a metabox de galeria.</p>
        <?php endif; ?>
    </div>
    <?php
}

function igesdf_news_carousel_admin_notice()
{
    if (
        is_admin()
        && current_user_can('activate_plugins')
        && !post_type_exists('noticia')
    ) {
        printf(
            '<div class="notice notice-warning is-dismissible"><p>%s</p></div>',
            esc_html__('O plugin IgesDF News Carousel está ativo, mas o tipo de post personalizado noticia não foi registrado. Ative o plugin de core ou o tema correto para habilitar o CPT.', 'igesdf-news-carousel')
        );
    }
}

add_action('admin_notices', 'igesdf_news_carousel_admin_notice');
