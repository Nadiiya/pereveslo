<?php get_header(); ?>

<?php $url = wp_get_attachment_url(get_post_thumbnail_id($post->ID, 'full')); ?>
<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>

        <h6><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
        <p><?php the_content(); ?></p>
    <?php endwhile; ?>
<?php endif; ?>
<?php get_footer();
