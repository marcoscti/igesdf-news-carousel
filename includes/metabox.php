<?php

if (!defined('ABSPATH')) {
    exit;
}

function igesdf_add_noticia_gallery_metabox()
{
    add_meta_box(
        'igesdf_noticia_gallery',
        'Carrossel de Imagens da Notícia',
        'igesdf_noticia_gallery_callback',
        'noticia',
        'normal',
        'high'
    );
}

add_action('add_meta_boxes', 'igesdf_add_noticia_gallery_metabox');

function igesdf_noticia_gallery_callback($post)
{
    wp_nonce_field(
        'igesdf_noticia_gallery_nonce',
        'igesdf_noticia_gallery_nonce'
    );

    $gallery = get_post_meta(
        $post->ID,
        '_igesdf_noticia_gallery',
        true
    );

    if (!is_array($gallery)) {
        $gallery = [];
    }
?>
	<p style="margin-top:15px;">
    <details style="margin-top:5px;">
        <summary style="cursor:pointer; font-weight:bold;color:red;font-size:16px;">Clique para ver: Dicas de Uso 💡</summary>
        <ul>
			<li>✅ Para selecionar várias imagens, Mantenha a tecla <code><strong>CTRL</strong></code> pressionada enquanto clica sobre as imagens desejadas.</li>
			<li>✅ Para exibir o Carrossel de imagens, utilize o shortcode: <code>[carrossel_noticia]</code></li>
            <li>✅ Para exibir a Legenda abaixo de cada imagem do carrossel basta utilizar o shortcode: <code>[carrossel_noticia legenda="true"]</code></li>
        </ul>
    </details>
    </p>
    <div id="igesdf-gallery-preview" class="igesdf-gallery-preview" style="display:flex; gap:10px; flex-wrap:wrap; margin-bottom:15px;">
        <?php foreach ($gallery as $image_id): ?>
            <div class="igesdf-gallery-item">
                <?php
                echo wp_get_attachment_image(
                    $image_id,
                    'thumbnail',
                    false,
                    [
                        'style' => '
                            width:120px;
                            height:120px;
                            object-fit:cover;
                            border-radius:10px;
                            border:1px solid #ddd;
                        '
                    ]
                );
                ?>
            </div>
        <?php endforeach; ?>
    </div>

    <input
        type="hidden"
        id="igesdf_gallery_ids"
        name="igesdf_gallery_ids"
        value="<?php echo esc_attr(implode(',', $gallery)); ?>">

    <button
        type="button"
        class="button button-primary"
        id="igesdf-upload-gallery">
        <span class="dashicons dashicons-format-image"></span>
        Selecionar Imagens
    </button>

    <button
        type="button"
        class="button button-secondary"
        id="igesdf-remove-gallery"
        style="margin-left: 10px;">
        <span class="dashicons dashicons-trash"></span>
        Remover Imagens
    </button>

    

    <script>
        jQuery(document).ready(function($) {

            let frame;

            $('#igesdf-upload-gallery').on('click', function(e) {

                e.preventDefault();

                frame = wp.media({
                    title: 'Selecionar imagens',
                    button: {
                        text: 'Usar imagens'
                    },
                    multiple: true
                });

                // Sincroniza a seleção do modal com os IDs atuais antes de abrir
                frame.on('open', function() {
                    const selection = frame.state().get('selection');
                    const ids = $('#igesdf_gallery_ids').val().split(',').filter(Boolean);
                    
                    selection.reset();
                    ids.forEach(function(id) {
                        const attachment = wp.media.attachment(id);
                        attachment.fetch();
                        selection.add(attachment ? [attachment] : []);
                    });
                });

                frame.on('select', function() {

                    const attachments = frame
                        .state()
                        .get('selection')
                        .toJSON();

                    let ids = [];
                    let html = '';

                    attachments.forEach(function(attachment) {

                        ids.push(attachment.id);

                        const thumb = (attachment.sizes && attachment.sizes.thumbnail) ? attachment.sizes.thumbnail.url : attachment.url;

                        html += `
                            <div class="igesdf-gallery-item">
                                <img
                                    src="${thumb}"
                                    style="
                                        width:120px;
                                        height:120px;
                                        object-fit:cover;
                                        border-radius:10px;
                                        border:1px solid #ddd;
                                    "
                                >
                            </div>
                        `;

                    });

                    $('#igesdf_gallery_ids').val(ids.join(','));
                    $('#igesdf-gallery-preview').html(html);

                });

                frame.open();

            });

            $('#igesdf-remove-gallery').on('click', function(e) {
                e.preventDefault();
                $('#igesdf_gallery_ids').val('');
                $('#igesdf-gallery-preview').html('');
            });


        });
    </script>

<?php
}

function igesdf_save_noticia_gallery($post_id)
{
    if (!isset($_POST['igesdf_noticia_gallery_nonce'])) {
        return;
    }

    if (
        !wp_verify_nonce(
            $_POST['igesdf_noticia_gallery_nonce'],
            'igesdf_noticia_gallery_nonce'
        )
    ) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (isset($_POST['igesdf_gallery_ids'])) {

        $ids = array_filter(
            array_map(
                'intval',
                explode(',', $_POST['igesdf_gallery_ids'])
            )
        );

        update_post_meta(
            $post_id,
            '_igesdf_noticia_gallery',
            $ids
        );
    }
}

add_action('save_post_noticia', 'igesdf_save_noticia_gallery');
