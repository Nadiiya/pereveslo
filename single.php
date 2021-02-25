<?php get_header(); ?>
    <main class="page__main">
        <div class="page__container container">
            <div class="page__wrapper">
                <section class="section section--breadcrumbs">
                    <?php
                    if (function_exists('yoast_breadcrumb')) {
                        yoast_breadcrumb('<p id="breadcrumbs">', '</p>');
                    }
                    ?>
                </section>
                <?php while (have_posts()) :
                the_post(); ?>
                <article class="post">
                    <section class="section post__section">
                        <header class="post__header">
                            <?php if (has_post_thumbnail()): ?>
                                <?php the_post_thumbnail('singl-img', array(
                                    'class' => 'post__img'
                                )) ?>
                            <?php endif ?>
                            <h1 class="post__title">
                                <?php the_title(); ?>
                            </h1>
                            <dl class="post__meta-data meta-data">
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
                                        <time datetime="<?php echo get_the_date(); ?>"><?php echo get_the_date(); ?></time>
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
                                        $tags     = get_the_tag_list('<p>Теги: ', ', ', '</p>');
                                        echo $terms ? $terms : '';
                                        echo $category ? $category : '';
                                        echo $tags ? $tags : '';
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
                        <div class="post__content post-content">
                            <?php the_content(); ?>
                        </div>
                    </section>
                    <?php
                    if (comments_open()) :
                        comments_template();
                    endif;
                    ?>
                    <?php endwhile; ?>
                </article>
            </div>
            <div class="page__aside sidebar">
                <?php get_sidebar() ?>
            </div>
    </main>
<?php get_footer(); ?>
