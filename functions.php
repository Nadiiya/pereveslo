<?php


/**
 * Functions for Pereveslo
 */


function connect_styles_scripts()
{

    wp_enqueue_style('normalize', get_stylesheet_directory_uri() . '/css/normalize.css');


    wp_enqueue_style('font-awesome', get_stylesheet_directory_uri() . '/fontawesome/css/font-awesome.min.css');

    wp_enqueue_style('slick', get_stylesheet_directory_uri() . '/slick/slick.css');

    wp_enqueue_style('slick-theme', get_stylesheet_directory_uri() . '/slick/slick-theme.css');

    wp_enqueue_style('fancybox', get_stylesheet_directory_uri() . '/css/jquery.fancybox.min.css');


    wp_enqueue_style('fonts',
        'https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,600;0,700;1,400&family=Marck+Script&display=swap');


    wp_enqueue_style('style', get_stylesheet_directory_uri() . '/style.css');

    wp_enqueue_style('main', get_stylesheet_directory_uri() . '/css/main.css');

    wp_enqueue_script('jquery');

    wp_enqueue_script('matchHeight', get_template_directory_uri() . '/js/jquery.matchHeight.js', null, null, true);

    wp_enqueue_script('slick', get_stylesheet_directory_uri() . '/slick/slick.min.js');

    wp_enqueue_script('easing', get_stylesheet_directory_uri() . '/js/easing.1.3.js');

    wp_enqueue_script('fancybox', get_stylesheet_directory_uri() . '/js/jquery.fancybox.min.js');


    wp_enqueue_script('js', get_stylesheet_directory_uri() . '/js/js.js');

    wp_enqueue_script('jquery-matcheight', get_template_directory_uri() . '/js/jquery.matchHeight.js');

}

add_action('wp_enqueue_scripts', 'connect_styles_scripts');

function wpb_image_editor_default_to_gd($editors)
{
    $gd_editor = 'WP_Image_Editor_GD';
    $editors   = array_diff($editors, array($gd_editor));
    array_unshift($editors, $gd_editor);

    return $editors;
}

add_filter('wp_image_editors', 'wpb_image_editor_default_to_gd');


//Enable support for custom logo.
add_theme_support('custom-logo', [
    'height'               => 65,
    'width'                => 170,
    'unlink-homepage-logo' => true,
]);


// Register Menu

register_nav_menus(array(
    'top'         => 'top_menu',
    'studio-list' => 'studio-page'

));

add_action('login_head', 'my_custom_login_logo');
function my_custom_login_logo()
{
    echo '
	<style>
	h1 a {  background-image:url(' . get_bloginfo('template_directory') . 'imgs/logo.png) !important; width: 150px !important; height: 45px !important; background-size: cover !important; }
	</style>
	';
}

//Remove menu items classes and add custom classes
add_filter('nav_menu_css_class', 'add_my_class_to_nav_menu', 10, 2);
function add_my_class_to_nav_menu($classes, $item)
{
    $classes   = [];
    $classes[] = 'main-menu__item';

    return $classes;
}


// Registers theme support
add_theme_support('post-thumbnails');
add_theme_support('html5', array('search-form'));
add_theme_support('title-tag');

//customize archive title
add_filter('get_the_archive_title', function ($title) {
    return preg_replace('~^[^:]+: ~', '', $title);
});

//unset url field in comment form
add_filter('comment_form_default_fields', 'unset_url_field');
function unset_url_field($fields)
{
    if (isset($fields['url'])) {
        unset($fields['url']);
    }

    return $fields;
}


// Adding Options Page

if (function_exists('acf_add_options_page')) {
    acf_add_options_page();
}

if (function_exists('add_image_size')) {
    add_image_size('post-img', 400, 200, true);
    add_image_size('photo_author', 200, 300, array('center', 'top'));
    add_image_size('singl-img', 600, 400);
}

// Tag cloud
add_filter('widget_tag_cloud_args', 'set_tag_cloud_args');
function set_tag_cloud_args($args)
{
    $args['number']   = 0;
    $args['largest']  = 26;
    $args['smallest'] = 12;
    $args['unit']     = 'px';

    return $args;
}

add_filter('show_admin_bar', '__return_false'); // отключить

//Fix translate
add_filter('gettext', 'filter_gettext', 10, 3);

//show custom post types on tag pages
function add_custom_types($query)
{
    if (is_tag() && $query->is_main_query()) {
        $post_types = get_post_types();
        $query->set('post_type', $post_types);
    }
}

add_filter('pre_get_posts', 'add_custom_types');

function filter_gettext($translation, $text, $domain)
{
    if ($text === 'Site Admin' && $domain === 'default') {
        $translation = 'Профіль';
    }

    return $translation;
}


add_action('after_setup_theme', function () {
    add_theme_support('pageviews');
});


function kama_excerpt($args = '')
{
    global $post;

    $default = array(
        'maxchar'   => 250,
        'text'      => '',
        'autop'     => true,
        'save_tags' => '<br>',
        'more_text' => '...',
    );

    if (is_array($args)) {
        $_args = $args;
    } else {
        parse_str($args, $_args);
    }

    $rg = (object)array_merge($default, $_args);
    if (!$rg->text) {
        $rg->text = $post->post_excerpt ?: $post->post_content;
    }
    $rg = apply_filters('kama_excerpt_args', $rg);

    $text = $rg->text;
    $text = preg_replace('~\[([a-z0-9_-]+)[^\]]*\](?!\().*?\[/\1\]~is', '', $text);
    $text = preg_replace('~\[/?[^\]]*\](?!\()~', '', $text);
    $text = trim($text);

    // <!--more-->
    if (strpos($text, '<!--more-->')) {
        preg_match('/(.*)<!--more-->/s', $text, $mm);

        $text = trim($mm[1]);

        $text_append = ' <a href="' . get_permalink($post->ID) . '#more-' . $post->ID . '">' . $rg->more_text . '</a>';
    } // text, excerpt, content
    else {
        $text = trim(strip_tags($text, $rg->save_tags));


        if (mb_strlen($text) > $rg->maxchar) {
            $text = mb_substr($text, 0, $rg->maxchar);
            $text = preg_replace('~(.*)\s[^\s]*$~s', '\\1 ...', $text);
        }
    }


    if ($rg->autop) {
        $text = preg_replace(
            array("~\r~", "~\n{2,}~", "~\n~", '~</p><br ?/>~'),
            array('', '</p><p>', '<br />', '</p>'),
            $text
        );
    }

    $text = apply_filters('kama_excerpt', $text, $rg);

    if (isset($text_append)) {
        $text .= $text_append;
    }

    return ($rg->autop && $text) ? "<p>$text</p>" : $text;
}

function is_paginated()
{
    global $wp_query;

    if ($wp_query->max_num_pages > 1) {
        return true;
    } else {
        return false;
    }
}

add_action('pre_get_posts', 'hwl_home_pagesize', 1);
function hwl_home_pagesize($query)
{
    if (is_admin() || !$query->is_main_query()) {
        return;
    }

    if ($query->is_post_type_archive('publication')) {

        $query->set('posts_per_page', 12);
    }
}

if (is_admin()) {

    add_action('restrict_manage_posts', 'wp_posts_list__author_dropdown');
    function wp_posts_list__author_dropdown($post_type)
    {

        if (!in_array($post_type, ['page', 'post', 'tvir'])) {
            return;
        }

        wp_dropdown_users([
            'show_option_all' => 'Все авторы',
            'selected'        => get_query_var('author', 0),
            'name'            => 'author',
            'who'             => 'authors',
            // 'role__in'        => ['author','editor','administrator'],
        ]);
    }
}

add_action('pre_user_query', 'temp_replace');

function temp_replace($query)
{
    $query->query_from = str_replace("post_type = 'post'", "post_type = 'tvir'", $query->query_from);
}

;

remove_action('pre_user_query', 'temp_replace');


//set cpt for author's page
function add_cpt_author($query)
{
    if (is_admin() || !$query->is_main_query()) {
        return;
    }

    if ($query->is_author()) {
        $query->set('post_type', array('tvir'));
    }

}

add_action('pre_get_posts', 'add_cpt_author');


//remove menu from site backend.
function remove_menus()
{
    $roles = wp_get_current_user()->roles;

    if (!in_array('author', $roles)) {
        return;
    }

    add_action('admin_init', function () {
        remove_menu_page('index.php');
        remove_menu_page('separator1');
        remove_menu_page('edit.php');
        remove_menu_page('edit.php?post_type=studio');
        remove_menu_page('edit-comments.php');
        remove_menu_page('edit.php?post_type=wishes');
        remove_menu_page('wpcf7');
        remove_menu_page('separator2');
        remove_menu_page('tools.php');
        remove_menu_page('acf-options');
        remove_menu_page('separator-last');
        remove_menu_page('qsm_dashboard');
    }, PHP_INT_MAX);
}

add_action('admin_menu', 'remove_menus', 100);

// function wp_maintenance_mode(){
// if(!current_user_can('manage_options') || !is_user_logged_in()){
// wp_die('<h1 style="color:red">Вибачте, наразі ведуться технічні роботи. </h1><br />Щойно роботи завершаться, ми знову будемо радувати вас новими творами!'); }
// }
// add_action('get_header', 'wp_maintenance_mode');
