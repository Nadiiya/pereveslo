<?php get_header(); ?>
<main class="page__main">
    <section class="section section-main section-main--archive">
        <div class="section-main__container container">
            <h1 class="section-main__title">
                Результати пошуку: "<?php the_search_query(); ?>"
            </h1>
        </div>
    </section>
    <div class="page__container container">
        <div class="page__wrapper">
            <section class="section section-posts">
                <div class="section-posts__posts">
                    <?php if (have_posts()):
                        while (have_posts()): the_post(); ?>
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
                                                    $terms    = get_the_term_list($post->ID, 'genre', '', ', ');
                                                    $category = get_the_category_list(', ');
                                                    echo $terms ? $terms : '';
                                                    echo $category ? $category : '';
                                                    ?>
                                                </dd>
                                            </div>
                                            <div class="meta-data__item">
                                                <dt class="meta-data__term">
                                                    <span class="visually-hidden">Кількість коментарів:</span>
                                                </dt>
                                                <dd class="meta-data__definition meta-data__definition--comments"
                                                    title="Кількість коментарів">
                                                    <?php echo $post->comment_count; ?>
                                                </dd>
                                                <dt class="meta-data__term">
                                                    <span class="visually-hidden">Кількість переглядів:</span>
                                                </dt>
                                                <dd class="meta-data__definition meta-data__definition--views"
                                                    title="Кількість переглядів">
                                                    <?php do_action('pageviews'); ?>
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
                        <?php endwhile; ?>

                        <?php echo get_the_posts_pagination(array(
                        'show_all'           => false,
                        'end_size'           => 1,
                        'mid_size'           => 1,
                        'prev_next'          => true,
                        'prev_text'          => __('«'),
                        'next_text'          => __('»'),
                        'type'               => 'list',
                        'screen_reader_text' => __('На сторінку:'),
                        'aria_label'         => __('Posts'),
                        'class'              => 'pagination',
                    )); ?>
                    <?php else: ?>
                        <p>Поки що немає творів</p>
                    <?php endif ?>
                </div>
            </section>
        </div>
        <aside class="page__aside sidebar">
            <?php get_sidebar() ?>
        </aside>
    </div>
</main>
<?php get_footer(); ?>
