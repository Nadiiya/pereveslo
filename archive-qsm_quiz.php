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
        <section class="section section-posts">
            <?php if (have_posts()):
                $categorys = get_terms(array(
                    'taxonomy' => 'quiz_category',
                    'parent'   => 0,
                    'order'    => 'DESC'
                ));
                foreach ($categorys as $category) : ?>
                    <h2>
                        <?php echo $category->name; ?>
                    </h2>
                    <?php
                    $termchildren = get_term_children($category->term_id, 'quiz_category');
                    if (!empty($termchildren)) :
                        foreach ($termchildren as $child) {
                            $term = get_term_by('id', $child, 'quiz_category');
                            echo do_shortcode('[tabby title="' . $term->name . '"]');
                            $args = array(
                                'order'     => 'DESC',
                                'tax_query' => array(
                                    array(
                                        'taxonomy' => 'quiz_category',
                                        'terms'    => $child
                                    ),
                                )
                            );

                            $query = new WP_Query($args);
                            if ($query->have_posts()):
                                while ($query->have_posts()):
                                    $query->the_post(); ?>
                                    <h3>
                                        <a class="post-card__title-link" href="<?php echo get_permalink() ?>">
                                            <?php the_title(); ?>
                                        </a>
                                    </h3>
                                <?php endwhile;
                                wp_reset_postdata();
                            endif;
                        }
                        echo do_shortcode('[tabbyending]');
                    else:
                        $args = array(
                            'order'     => 'DESC',
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'quiz_category',
                                    'terms'    => $category->term_id
                                ),
                            )
                        );
                        $query = new WP_Query($args);
                        if ($query->have_posts()):
                            while ($query->have_posts()):
                                $query->the_post(); ?>
                                <h3>
                                    <a class="post-card__title-link" href="<?php echo get_permalink() ?>">
                                        <?php the_title(); ?>
                                    </a>
                                </h3>
                            <?php endwhile;
                            wp_reset_postdata();
                        endif;
                    endif; ?>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Поки що немає тестів</p>
            <?php endif ?>
        </section>
    </div>
</main>
<?php get_footer(); ?>
