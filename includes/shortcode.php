<?php

if (!defined('ABSPATH')) {
    exit;
}

function igesdf_carrossel_noticia_shortcode($atts)
{
    global $post;

    if (!$post || $post->post_type !== 'noticia') {
        return '';
    }

    $atts = shortcode_atts([
        'autoplay'   => 'true',
        'loop'       => 'true',
        'slides'     => 1,
        'space'      => 20,
        'speed'      => 600,
        'delay'      => 4000,
        'navigation' => 'true',
        'pagination' => 'true',
        'legenda' => false
    ], $atts);

    $images = get_post_meta(
        $post->ID,
        '_igesdf_noticia_gallery',
        true
    );

    if (empty($images) || !is_array($images)) {
        return '';
    }

    $uid = wp_unique_id('swiper_');

    ob_start();
?>

    <div class="swiper <?php echo esc_attr($uid); ?> igesdf-news-carousel">
        <div class="swiper-wrapper">

            <?php foreach ($images as $image_id): ?>

                <div class="swiper-slide">
                    <?php

                    echo wp_get_attachment_image(
                        $image_id,
                        'large',
                        false,
                        [
                            'loading' => 'lazy',
                            'style' => '
                                width:100%;
                                border-radius:12px;
                            ',
                        ]
                    );

                    if ($atts['legenda'] == 'true') {
                        echo '<small>'.wp_get_attachment_caption($image_id).'</small>';
                    }
                    ?>
                </div>

            <?php endforeach; ?>

        </div>

        <?php if ($atts['pagination'] === 'true'): ?>
            <div class="swiper-pagination"></div>
        <?php endif; ?>

        <?php if ($atts['navigation'] === 'true'): ?>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        <?php endif; ?>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selector = '.<?php echo esc_js($uid); ?>';
            const el = document.querySelector(selector);

            // Proteção: Verifica se Swiper existe no tema e se o elemento já não foi inicializado
            if (typeof Swiper !== 'undefined' && el && document.body.contains(el) && !el.swiper) {
                try {
                    const swiperInstance = new Swiper(el, {
                        watchOverflow: true,
                        observer: true,
                        observeParents: true,
                        loop: <?php echo ($atts['loop'] === 'true' && count($images) > (int)$atts['slides']) ? 'true' : 'false'; ?>,
                        slidesPerView: <?php echo (int)$atts['slides']; ?>,
                        spaceBetween: <?php echo (int)$atts['space']; ?>,
                        speed: <?php echo (int)$atts['speed']; ?>,

                        <?php if ($atts['autoplay'] === 'true'): ?>
                            autoplay: {
                                delay: <?php echo (int)$atts['delay']; ?>,
                                disableOnInteraction: false
                            },
                        <?php endif; ?>

                        <?php if ($atts['pagination'] === 'true'): ?>
                            pagination: {
                                el: selector + ' .swiper-pagination',
                                clickable: true
                            },
                        <?php endif; ?>

                        <?php if ($atts['navigation'] === 'true'): ?>
                            navigation: {
                                nextEl: selector + ' .swiper-button-next',

                                prevEl: selector + ' .swiper-button-prev'
                            },
                        <?php endif; ?>
                    });
                } catch (e) {
                    console.error("Erro ao inicializar Swiper no elemento " + selector, e);
                }
            }
        });
    </script>

<?php

    return ob_get_clean();
}

add_shortcode(
    'carrossel_noticia',
    'igesdf_carrossel_noticia_shortcode'
);
