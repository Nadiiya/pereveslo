<?php get_header(); ?>
    <main class="page__main">
        <section class="section section-main">
            <div class="section-main__container container">
                <h1 class="section-main__title">
                    <?php the_title(); ?>
                </h1>
            </div>
        </section>
        <div class="page__container container">
            <div class="page__wrapper">
                <section class="section">
                    <?php the_content(); ?>
                </section>
            </div>
            <aside class="page__aside sidebar">
                <?php get_sidebar() ?>
            </aside>
        </div>
    </main>

<?php get_footer(); ?>