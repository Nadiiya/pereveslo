<?php
/**
 * Template Name: template-galery
 */
get_header(); ?>
    <main class="page__main">
        <section class="section section-main section-main--galery">
            <div class="container">
                <h1 class="section-main__title">
                    <?php echo get_the_title(); ?>
                </h1>
                <p>
                    <?php the_content(); ?>
                </p>
            </div>
        </section>
        <section class="section section-galerey container">
            <?php
            $images = acf_photo_gallery('photo_gallery', $post->ID);
            if (count($images)):?>
                <ul class="images">
                    <?php foreach ($images as $image):
                        $id = $image['id'];
                        $title = $image['title'];
                        $caption = $image['caption'];
                        $full_image_url = $image['full_image_url'];
                        $thumbnail_image_url = $image['thumbnail_image_url'];
                        $target = $image['target'];
                        $alt = get_field('photo_gallery_alt', $id);
                        $class = get_field('photo_gallery_class', $id);
                        ?>
                        <li class="images__item image">
                            <a class="image__link" data-fancybox="fancybox"
                               title="<?php echo($caption . '<br>' . " $title"); ?>"
                               href="<?php echo $full_image_url ?>">
                                <figure class="image__figure">
                                    <img class="image__img" width="250" height="250"
                                         src="<?php echo $thumbnail_image_url; ?>">
                                    <figcaption class="image__caption">
                                        <h2 class="image__title">
                                            <?php echo $caption ? '"' . $caption . '"' : '' ?>
                                        </h2>
                                        <p>
                                            <?php echo $title ? 'Автор: ' . $title : '' ?>

                                        </p>
                                    </figcaption>
                                </figure>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </section>
    </main>


<?php get_footer(); ?>
