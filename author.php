<?php get_header(); ?>
<main class="page__main">

    <div class="page__container container">
        <div class="page__wrapper">
            <section class="section section-main--author">
                <div class="author container">
                    <?php
                    $current_author   = (isset($_GET['author_name'])) ? get_user_by('author',
                        $author_name) : get_userdata(intval($author));
                    $user_description = get_user_meta($current_author->ID, 'description', true);
                    $user_avatar      = get_avatar($current_author->ID, 150, 'mystery', 'аватар користувача', '');
                    ?>
                    <h1 class="author__title">
                        <?php echo $current_author->display_name; ?>
                    </h1>
                    <?php echo !empty($user_avatar) ? $user_avatar : '' ?>
                    <blockquote class="author__description">
                        <?php echo $user_description ? $user_description : 'Поки що нічого не розказує про себе'; ?>
                    </blockquote>
                </div>
            </section>
            <section class="section section-posts">

                <?php if (have_posts()): ?>
                    <?php if ($current_author->ID === 166): ?>
                        <section class="section category">
                            <h2 class="visually-hidden">Список категорій</h2>

                            <?php
                            $categories = get_categories([
                                'taxonomy' => 'studio_genre',
                                'orderby'  => 'count',
                                'order'    => 'DESC',
                            ]); ?>

                            <?php if ($categories): ?>
                                <ul class="tab">
                                    <?php foreach ($categories as $category): ?>
                                        <li class="tab__item">
                                            <a class="category__link"
                                               href="<?php echo get_category_link($category->term_id); ?>">
                		                    <span class="tab__title">
                		                    	<?php echo $category->name ?>
            		                    	</span>
                                                <p class="tab__descr">
                                                    <?php echo $category->category_description ?>
                                                </p>
                                            </a>
                                        </li>
                                    <?php endforeach ?>
                                </ul>
                            <?php endif; ?>
                        </section>
                    <?php endif; ?>

                    <div class="section-posts__posts">
                        <?php while (have_posts()): the_post(); ?>
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
                                                    <?php the_author(); ?>
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
                                                    $terms           = get_the_term_list($post->ID, 'genre', '', ', ');
                                                    $category        = get_the_category_list(', ');
                                                    $category_studio = get_the_term_list($post->ID, 'studio_genre', '',
                                                        ', ');
                                                    echo $terms ? $terms . '<br>' : '';
                                                    echo $category_studio ? $category_studio . '<br>' : '';
                                                    echo $category ? $category . '<br>' : '';
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
                    </div>
                <?php
                else:
                    echo '<p>Поки що немає творів</p>';
                endif; ?>
                <?php wp_reset_query(); ?>
            </section>
        </div>
        <aside class="page__aside sidebar">
            <?php get_sidebar() ?>
        </aside>
    </div>
    </div>
</main>
<?php get_footer(); ?>
