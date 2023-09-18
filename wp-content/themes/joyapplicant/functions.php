<?php

if (!function_exists('japp_setup')) :
    function japp_setup()
    {
        //
        // ------------------------------------------------------------
        // ------------------------------------------------------------
        // ------------------------------------------------------------
        // ---------- POST AND PUBLISHING ----------
        // ----------
        // ----------
        //
        add_theme_support('post-thumbnails');
        add_theme_support('post-formats',  array('aside', 'gallery', 'quote', 'image', 'video'));
        add_theme_support('responsive-embeds');
        add_theme_support('automatic-feed-links');
        add_theme_support('title-tag');
    }
endif;
add_action('after_setup_theme', 'japp_setup');

//
// ------------------------------------------------------------
// ------------------------------------------------------------
// ------------------------------------------------------------
// ---------- STYLESHEET ----------
// ----------
// ----------
//
wp_enqueue_style('style', get_stylesheet_uri());

//
// ------------------------------------------------------------
// ------------------------------------------------------------
// ------------------------------------------------------------
// ---------- NAVIGATION MENUS ----------
// ----------
// ----------
//
function japp_menus()
{
    register_nav_menus(
        array(
            'header' => __('Header Menu')
        )
    );
}
add_action('init', 'japp_menus');

//
// ------------------------------------------------------------
// ------------------------------------------------------------
// ------------------------------------------------------------
// ---------- WIDGETS & SIDEBARS ----------
// ----------
// ----------
//
// function tts_widgets()
// {
//     register_sidebar(
//         array(
//             'name' => __('Header Contact', 'tts'),
//             'id' => 'header-contact',
//         )
//     );
//     register_sidebar(
//         array(
//             'name' => __('Footer Col 1', 'tts'),
//             'id' => 'footer-col-1',
//         )
//     );
//     register_sidebar(
//         array(
//             'name' => __('Footer Col 2', 'tts'),
//             'id' => 'footer-col-2',
//         )
//     );
//     register_sidebar(
//         array(
//             'name' => __('Footer Col 3', 'tts'),
//             'id' => 'footer-col-3',
//         )
//     );
//     register_sidebar(
//         array(
//             'name' => __('Footer Footer Col 4', 'tts'),
//             'id' => 'footer-col-4',
//         )
//     );
//     register_sidebar(
//         array(
//             'name' => __('Footer Legal', 'tts'),
//             'id' => 'footer-legal',
//         )
//     );
// }
// add_action('widgets_init', 'tts_widgets');

//
// ------------------------------------------------------------
// ------------------------------------------------------------
// ------------------------------------------------------------
// ---------- CONTENT MAX WIDTH ----------
// ----------
// ----------
//
if (!isset($content_width)) {
    $content_width = 1024;
}

//
// ------------------------------------------------------------
// ------------------------------------------------------------
// ------------------------------------------------------------
// ---------- DISABLE EMOJI ----------
// ----------
// ----------
//
function disable_emojis()
{
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
    add_filter('tiny_mce_plugins', 'disable_emojis_tinymce');
    add_filter('wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2);
}
add_action('init', 'disable_emojis');

function disable_emojis_tinymce($plugins)
{
    if (is_array($plugins)) {
        return array_diff($plugins, array('wpemoji'));
    } else {
        return array();
    }
}

function disable_emojis_remove_dns_prefetch($urls, $relation_type)
{
    if ('dns-prefetch' == $relation_type) {
        $emoji_svg_url = apply_filters('emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/');
        $urls = array_diff($urls, array($emoji_svg_url));
    }
    return $urls;
}

//
// ------------------------------------------------------------
// ------------------------------------------------------------
// ------------------------------------------------------------
// ---------- DISABLE REST API ----------
// ----------
// ----------
//
function remove_json_api()
{
    remove_action('wp_head', 'rest_output_link_wp_head', 10);
    remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);
    remove_action('rest_api_init', 'wp_oembed_register_route');
    add_filter('embed_oembed_discover', '__return_false');
    remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);
    remove_action('wp_head', 'wp_oembed_add_discovery_links');
    remove_action('wp_head', 'wp_oembed_add_host_js');
}
add_action('after_setup_theme', 'remove_json_api');

function disable_json_api()
{
    add_filter('json_enabled', '__return_false');
    add_filter('json_jsonp_enabled', '__return_false');

    add_filter('rest_enabled', '__return_false');
    add_filter('rest_jsonp_enabled', '__return_false');
}
add_action('after_setup_theme', 'disable_json_api');

//
// ------------------------------------------------------------
// ------------------------------------------------------------
// ------------------------------------------------------------
// ---------- DISABLE CLASSIC WP STYLING ----------
// ----------
// ----------
//
function disable_classic_theme_styles()
{
    wp_deregister_style('classic-theme-styles');
    wp_dequeue_style('classic-theme-styles');
}
add_filter('wp_enqueue_scripts', 'disable_classic_theme_styles', 100);

//
// ------------------------------------------------------------
// ------------------------------------------------------------
// ------------------------------------------------------------
// ---------- TITLE ----------
// ----------
// ----------
//
function manual_page_title()
{
    remove_theme_support('title-tag');
}
add_action('after_setup_theme', 'manual_page_title', 11);

//
// ------------------------------------------------------------
// ------------------------------------------------------------
// ------------------------------------------------------------
// ---------- THIRD PARTY PLUGINS ----------
// ----------
// ----------
//
// CONTACT FORM 7
// add_filter('wpcf7_load_js', '__return_false');
// add_filter('wpcf7_load_css', '__return_false');

// function contactform_dequeue_scripts()
// {
//     $load_scripts = false;

//     if (!is_page(array('get-a-free-demo', 'contact-us'))) {
//         $load_scripts = true;
//     }

//     if (!$load_scripts) {
//         wp_dequeue_script('contact-form-7');
//         wp_dequeue_script('google-recaptcha');
//         wp_dequeue_script('wpcf7-recaptcha');
//         wp_dequeue_style('wpcf7-recaptcha');
//         wp_dequeue_style('contact-form-7');
//     }
// }
// add_action('wp_enqueue_scripts', 'contactform_dequeue_scripts', 99);
