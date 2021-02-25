<?php get_header(); ?>
    <main class="page__main">
        <section class="section section-main section-main--archive">
            <div class="section-main__container container">
                <h1 class="section-main__title">
                    <?php the_archive_title(); ?>
                </h1>
            </div>
        </section>
        <div class="page__container container">
            <div class="page__wrapper">
                <section class="section section--breadcrumbs">
                    <?php
                    if (function_exists('yoast_breadcrumb')) {
                        yoast_breadcrumb('<p id="breadcrumbs">', '</p>');
                    }
                    ?>
                </section>
                <section class="section quote-list">
                    <h2 class="visually-hidden">Список цитат</h2>
                    <?php if (have_posts()) : ?>
                        <ul class="quote-list__list">
                            <?php while (have_posts()) : the_post(); ?>
                                <li class="quote-list__item">
                                    <blockquote class="quote">

                                        <?php the_content(); ?>

                                        <cite class="quote__cite">
                                            <span class="quote__source quote__source--author"><?php get_field('quote_author') ? the_field('quote_author') : ''; ?></span>
                                            <br>
                                            <span class="quote__source quote__source--source"><?php get_field('quote_source') ? the_field('quote_source') : ''; ?></span>
                                        </cite>

                                    </blockquote>
                                </li>
                            <?php endwhile; ?>
                        </ul>
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
                        <p>Поки що немає публікацій</p>
                    <?php endif; ?>
                </section>

            </div>
            <div class="page__aside sidebar">
                <?php get_sidebar() ?>
            </div>
    </main>
<?php get_footer(); ?>