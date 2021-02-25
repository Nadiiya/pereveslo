<?php
/**
 * Template Name: Home page
 */

get_header(); ?>

<main class="page__main">
    <section class="section section-main section-main--home">
        <div class="section-main__container container">
            <h1 class="section-main__title">
                <?php get_field('section1_caption') ? the_field('section1_caption') : ''; ?>
            </h1>
            <p class="section-main__description">
                <?php get_field('section1_description') ? the_field('section1_description') : ''; ?>
            </p>
        </div>
    </section>
    <div class="page__container container">
        <div class="page__wrapper">
            <section class="section section-about">
                <h2 class="section__title section-about__title">
                    <?php get_field('section2_caption') ? the_field('section2_caption') : ''; ?>
                </h2>
                <?php if (get_field('section2_photo')): ?>
                    <figure class="section-about__figure">
                        <img class="section-about__img" src="<?php the_field('section2_photo') ?>"
                             alt="Фото керівника студії" width="300" height="400">
                        <figcaption
                                class="section-about__figcaption"><?php get_field('photo_descr') ? the_field('photo_descr') : ''; ?></figcaption>
                    </figure>
                <?php endif; ?>
                <p class="section-about__text">
                    <?php get_field('section2_content') ? the_field('section2_content') : ''; ?>
                </p>
            </section>
            <section class="section section-news">
                <h2 class="section__title section-news__title">
                    <?php get_field('section3_caption') ? the_field('section3_caption') : ''; ?>
                </h2>
                <div class="section-news__posts">

                    <?php
                    $args  = array(
                        'order'          => 'date',
                        'orderby'        => 'DESC',
                        'posts_per_page' => '4',
                    );
                    $query = new WP_Query($args);

                    if ($query->have_posts()) : ?>
                        <?php while ($query->have_posts()) : $query->the_post() ?>
                            <article class="post-card">
                                <div class="post-card__img"
                                     style="background-image:url('<?php if (has_post_thumbnail()): the_post_thumbnail_url('post-img'); else: echo get_template_directory_uri() . '/imgs/no-image.png'; endif; ?>')">
                                </div>
                                <div class="post-card__inner">
                                    <header class="post-card__header">
                                        <h3 class="post-card__title">
                                            <a class="post-card__title-link" href="<?php echo get_permalink() ?>">
                                                <?php the_title(); ?>
                                            </a>
                                        </h3>
                                        <dl class="post-card__meta-data meta-data">
                                            <div class="meta-data__item meta-data__item--author">
                                                <dt class="meta-data__term meta-data__term--author">
                                                    <div class="meta-data__avatar">
                                                        <?php echo get_avatar(get_the_author_meta('user_email'), 50); ?>
                                                    </div>
                                                </dt>
                                                <dd class="meta-data__definition">
                                                <dd class="meta-data__definition">
                                                    <?php the_author_posts_link(); ?>
                                                </dd>
                                                </dd>
                                            </div>
                                            <div class=" meta-data__item">
                                                <dt class="meta-data__term meta-data__term--date"
                                                    title="Дата публікації">
                                                    <span class="visually-hidden">Дата:</span>
                                                </dt>
                                                <dd class="meta-data__definition meta-data__definition--date">
                                                    <span><?php the_date(); ?></span>
                                                </dd>
                                            </div>
                                            <div class="meta-data__item">
                                                <dt class="meta-data__term">
                                                    <span class="visually-hidden">Категорія:</span>
                                                </dt>
                                                <dd class="meta-data__definition meta-data__definition--category">
                                                    <?php the_category(', '); ?>
                                                </dd>
                                            </div>
                                        </dl>
                                    </header>
                                    <div class="post-card__content post-content">
                                        <?php
                                        echo kama_excerpt(); ?>
                                        <a class="post-card__read-more" href="<?php echo get_permalink() ?>">читати
                                            далі</a>
                                    </div>
                                </div>
                            </article>
                        <?php endwhile ?>
                    <?php else : ?>
                        <p>Поки що новин немає</p>
                    <?php endif ?>
                    <?php wp_reset_query(); ?>
                </div>
                <a class="button button--more" href="<?php echo get_home_url() . '/blog' ?>">
                    Перейти до блогу
                </a>
            </section>

            <section class="section section-authors">
                <h2 class="section__title section-news__title">
                    <?php get_field('section4_caption') ? the_field('section4_caption') : ''; ?>
                </h2>
                <?php $users = get_users([
                    'role'       => 'author',
                    'fields'     => ['ID', 'display_name', 'user_nicename'],
                    'exclude'    => '166',
                    'orderby'    => 'registered',
                    'order'      => 'ASC',
                    'offset'     => rand(1, 50),
                    'number'     => 10,
                    'meta_query' => array(
                        array(
                            'key'   => 'is_graduate',
                            'value' => '0',
                        )
                    )
                ]); ?>
                <?php if (!empty($users)): ?>
                    <div class="section-authors__slider authors-slider slide">
                        <?php foreach ($users as $user): ?>
                            <?php $user_name = $user->display_name; ?>
                            <?php $user_link = get_author_posts_url($user->ID, $user->user_nicename); ?>
                            <?php $user_description = get_user_meta($user->ID, 'description', true); ?>
                            <?php $user_avatar = get_avatar($user->ID, 135, 'mystery', 'аватар користувача', ''); ?>
                            <a class="authors-slider__item" href="<?php echo $user_link ?>"
                               data-mh="authors-slider__item">
                                <?php echo !empty($user_avatar) ? $user_avatar : '' ?>
                                <h3 class="authors-slider__title"><?php echo !empty($user_name) ? $user_name : '' ?></h3>
                                <blockquote class="authors-slider__quote">
                                    <?php
                                    echo !empty($user_description) ?
                                        wp_trim_words($user_description, 20, '...') :
                                        'Поки що нічого про себе не розказує...';
                                    ?>
                                </blockquote>
                            </a>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                <?php wp_reset_query(); ?>
            </section>

            <section class="section section-posts">
                <h2 class="section__title section-posts__title">
                    <?php get_field('section5_caption') ? the_field('section5_caption') : ''; ?>
                </h2>
                <div class="section-posts__posts">

                    <?php
                    $args  = array(
                        'post_type'      => 'tvir',
                        'order'          => 'date',
                        'orderby'        => 'DESC',
                        'posts_per_page' => '6',
                    );
                    $query = new WP_Query($args);
                    if ($query->have_posts()) : ?>
                        <?php while ($query->have_posts()) : $query->the_post() ?>
                            <article class="post-card">
                                <div class="post-card__img"
                                     style="background-image:url('<?php if (has_post_thumbnail()): the_post_thumbnail_url('post-img'); else: echo get_template_directory_uri() . '/imgs/no-image.png'; endif; ?>')">
                                </div>
                                <div class="post-card__inner">
                                    <header class="post-card__header">
                                        <h3 class="post-card__title">
                                            <a class="post-card__title-link" href="<?php echo get_permalink() ?>">
                                                <?php the_title(); ?>
                                            </a>
                                        </h3>
                                        <dl class="post-card__meta-data meta-data">
                                            <div class="meta-data__item meta-data__item--author">
                                                <dt class="meta-data__term meta-data__term--author">
                                                    <div class="meta-data__avatar">
                                                        <?php echo get_avatar(get_the_author_meta('user_email'), 50); ?>
                                                    </div>
                                                </dt>
                                                <dd class="meta-data__definition">
                                                    <?php the_author_posts_link(); ?>
                                                </dd>
                                            </div>
                                            <div class=" meta-data__item">
                                                <dt class="meta-data__term meta-data__term--date"
                                                    title="Дата публікації">
                                                    <span class="visually-hidden">Дата:</span>
                                                </dt>
                                                <dd class="meta-data__definition meta-data__definition--date">
                                                    <span><?php echo get_the_date(); ?></span>
                                                </dd>
                                            </div>
                                            <div class="meta-data__item">
                                                <dt class="meta-data__term">
                                                    <span class="visually-hidden">Категорія:</span>
                                                </dt>
                                                <dd class="meta-data__definition meta-data__definition--category">
                                                    <?php
                                                    $terms = get_the_term_list($post->ID, 'genre');
                                                    if ($terms): ?>
                                                        <?php echo $terms ?>
                                                    <?php endif; ?>
                                                </dd>
                                            </div>
                                        </dl>
                                    </header>
                                    <div class="post-card__content post-content">
                                        <?php
                                        echo kama_excerpt(); ?>
                                        <a class="post-card__read-more" href="<?php echo get_permalink() ?>">читати
                                            далі</a>
                                    </div>
                                </div>
                            </article>
                        <?php endwhile ?>
                    <?php else : ?>
                        <p>Поки що творів немає</p>
                    <?php endif ?>
                    <?php wp_reset_query(); ?>
                </div>
            </section>

            <section class="section section-comments">
                <h2 class="section__title section-news__title">
                    <?php get_field('section6_caption') ? the_field('section6_caption') : ''; ?>
                </h2>
                <?php
                $args     = array(
                    'number'  => 6,
                    'orderby' => 'comment_date',
                    'status'  => 'approve',
                    'order'   => 'DESC',
                    'type'    => '',
                );
                $comments = get_comments($args);

                if ($comments): ?>
                    <ul class="section-comments__list comment__list">
                        <?php
                        foreach ($comments as $comment):
                            $comment_link = get_comment_link($comment->comment_ID);
                            $comment_excerpt = wp_trim_words($comment->comment_content, 50, '...');
                            $post_id = $comment->comment_post_ID;
                            $comment_date = get_comment_date('', $comment->comment_ID);
                            $post_title = get_the_title($post_id);
                            $post_link = get_permalink($post_id);
                            ?>
                            <li class="comment__item">
                                <?php echo get_avatar($comment, 50); ?>
                                <h4 class="comment__author">
                                    <?php echo $comment->comment_author ?>
                                </h4>
                                <div class="comment__title">
                                    <small class="comment__data">До публікації:</small>
                                    <a class="comment__title-link" href="<?php echo $post_link ?>">
                                        <?php echo $post_title ? $post_title : '' ?>
                                    </a>
                                </div>
                                <small class="comment__data">
                                    <?php echo $comment_date ?>
                                </small>
                                <p class="comment__content">
                                    <?php echo $comment_excerpt ?>
                                </p>
                                <a class="comment__link" href="<?php echo $comment_link ?>">Перейти до коментаря</a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </section>
        </div>
        <aside class="page__aside sidebar">
            <?php get_sidebar() ?>
        </aside>
    </div>
</main>

<?php get_footer(); ?>
