# IgesDF News Carousel

[!WordPress Plugin Version](https://wordpress.org/plugins/igesdf-news-carousel/)
[!WordPress Requires At Least](https://wordpress.org/plugins/igesdf-news-carousel/)
[!WordPress Tested Up To](https://wordpress.org/plugins/igesdf-news-carousel/)
[!License](https://www.gnu.org/licenses/gpl-2.0.html)

**Contributors:** marcoscti
**Tags:** news, carousel, igesdf, wordpress, shortcode, responsive
**Requires at least:** 5.8
**Tested up to:** 6.7
**Requires PHP:** 7.4
**Stable tag:** 1.0.0
**License:** GPLv2 or later
**License URI:** https://www.gnu.org/licenses/gpl-2.0.html

## Description

O **IgesDF News Carousel** é um plugin simples e eficaz para exibir as últimas notícias ou posts do seu site WordPress em um carrossel moderno e responsivo. Ideal para destacar conteúdo importante em sua página inicial ou em seções específicas.

Com este plugin, você pode:
* Exibir notícias em um formato de carrossel dinâmico.
* Controlar a reprodução automática (autoplay).
* Definir o número de slides visíveis por vez.
* Integrar facilmente em qualquer post, página ou área de widget usando um shortcode.

## Installation

1.  Faça o upload da pasta `igesdf-news-carousel` para o diretório `/wp-content/plugins/`.
2.  Ative o plugin através do menu 'Plugins' no WordPress.
3.  Insira o shortcode `[carrossel_noticia]` em qualquer página, post ou widget de texto.

## How to Use

### Shortcode

Utilize o shortcode `[carrossel_noticia]` para exibir o carrossel de notícias. Você pode personalizar o comportamento do carrossel com os seguintes atributos:

*   `autoplay`: Define se o carrossel deve iniciar a reprodução automática.
    *   Valores: `true` ou `false` (padrão: `false`).
    *   Exemplo: `autoplay="true"`

*   `delay`: Define o tempo de exibição de cada slide no modo autoplay.
    *   Valores: Milissegundos (padrão: `3000`).
    *   Exemplo: `delay="5000"` (5 segundos).

*   `slides`: Define o número de slides visíveis por vez no carrossel.
    *   Valores: Um número inteiro (padrão: `3`).
    *   Exemplo: `slides="4"`

*   `loop`: Define se o carrossel deve voltar ao início automaticamente após o último slide.
    *   Valores: `true` ou `false` (padrão: `true`).
    *   Exemplo: `loop="false"`

*   `navigation`: Exibe ou oculta as setas de navegação laterais.
    *   Valores: `true` ou `false` (padrão: `true`).
    *   Exemplo: `navigation="false"`

*   `pagination`: Exibe ou oculta os pontos (bullets) de paginação na parte inferior.
    *   Valores: `true` ou `false` (padrão: `true`).
    *   Exemplo: `pagination="false"`

**Exemplos de uso:**

*   `[carrossel_noticia]` - Exibe o carrossel com as configurações padrão (3 slides, sem autoplay).
*   `[carrossel_noticia autoplay="true"]` - Exibe o carrossel com autoplay ativado.
*   `[carrossel_noticia slides="2" autoplay="true" delay="4000" pagination="false"]` - Exibe 2 slides, com autoplay de 4 segundos e sem pontos de paginação.

## Frequently Asked Questions

### Como faço para o carrossel aparecer no meu site?
Basta inserir o shortcode `[carrossel_noticia]` em qualquer post, página ou widget de texto.

### Posso controlar quantos itens são exibidos e se ele reproduz automaticamente?
Sim, você pode usar os atributos `slides` e `autoplay` no shortcode para personalizar esses comportamentos. Veja a seção "How to Use" para exemplos.

### O carrossel não está aparecendo. O que devo verificar?
Certifique-se de que o plugin está ativado e que o shortcode foi inserido corretamente. Verifique também se há notícias ou posts publicados no seu site para serem exibidos.

## Screenshots

1.  Exemplo do carrossel de notícias no frontend.
2.  Configurações do shortcode em um editor de blocos.

## Changelog

### 1.0.0
*   Lançamento inicial do plugin.
*   Implementação do shortcode `[carrossel_noticia]`.
*   Suporte aos atributos `autoplay` e `slides`.

## Upgrade Notice

### 1.0.0
Versão inicial estável disponível para uso.