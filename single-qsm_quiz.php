<?php get_header(); ?>
    <main class="page__main">
        <div class="page__container container">
            <div class="page__wrapper">
                <?php while (have_posts()) :
                the_post(); ?>
                <article class="post">
                    <section class="section post__section">
                        <header class="post__header">
                            <h1 class="post__title">
                                <?php the_title(); ?>
                            </h1>
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
            </div>
    </main>
<?php get_footer(); ?>
