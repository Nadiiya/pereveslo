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
            <section class="section publication">
                <h2 class="visually-hidden">Список наших публікацій</h2>
                <?php if (have_posts()) : ?>
                    <ul class="publication__list">
                        <?php while (have_posts()) : the_post(); ?>
                            <li class="publication__item" data-mh="publication__item">
                                <h2 class="publication__title">
                                    <?php the_title(); ?>
                                </h2>
                                <p class="publication__description">
                                    <?php get_field('publication-number') ? the_field('publication-number') : ''; ?>
                                </p>
                                <?php
                                $pdf_img  = has_post_thumbnail() ? get_the_post_thumbnail_url('',
                                    'medium') : get_template_directory_uri() . '/imgs/no-image.png';
                                $pdf_link = get_field('publication-file') ? get_field('publication-file') : '';
                                echo do_shortcode("[3d-flip-book mode='thumbnail-lightbox' pdf= $pdf_link template='short-white-book-view' lightbox='light' classes='publication__container' thumbnail=$pdf_img][/3d-flip-book]");
                                ?>
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
