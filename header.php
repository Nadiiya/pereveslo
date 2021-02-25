<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google-site-verification" content="DvCuwE-Xe-bcPR74cHb8-fDNojtTwEwPI33ZRnqmzSk"/>
    <meta name="Description" content="Твори учасників літературно-мистецької студії Перевесло">
    <?php wp_head(); ?>
</head>
<body>
<header class="page__header header">
    <div class="header__top">
        <div class="header__top-inner container">
            <div class="header__search-form">
                <?php get_search_form() ?>
            </div>
            <ul class="header__user-nav user-nav">
                <?php wp_register('<li class="user-nav__link">', '</li>'); ?>
                <li class="user-nav__link">
                    <?php wp_loginout(home_url()); ?>
                </li>

            </ul>
        </div>
    </div>
    <div class="header__inner container">
        <div class="header__logo">
            <?php the_custom_logo() ?>
        </div>
        <nav class="header__navigation main-menu">
            <?php
            if (has_nav_menu('top')) {
                $args = array(
                    'theme_location' => 'top',
                    'container'      => '',
                    'menu_id'        => '',
                    'menu_class'     => 'main-menu__list',
                );
                wp_nav_menu($args);
            }
            ?>
        </nav>
        <button type="button" class="header__burger burger">
            <span class="visually-hidden">Відкрити меню</span>
        </button>
    </div>
</header>
