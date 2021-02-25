<footer class="footer">
    <div class="footer__wrapper container">
        <section class="footer__section">
            <?php if ($about_us_title = get_field('about_us_title', 'options')): ?>
                <h4 class="footer__title">
                    <?php echo $about_us_title ?>
                </h4>
            <?php endif; ?>
            <?php if ($about_us_content = get_field('about_us_content', 'options')): ?>
                <p class="footer__content">
                    <?php echo $about_us_content ?>
                </p>
            <?php endif; ?>
            <a class="footer__link" href="<?php echo get_home_url() . '/konfedeczijnist/' ?>">
                Політика конфіденційності
            </a>
        </section>
        <section class="footer__section contacts">
            <h4 class="footer__title">Наші контакти:</h4>
            <?php if ($address = get_field('address', 'options')): ?>
                <p class="footer__content"><?php echo $address ?></p>
            <?php endif; ?>
            <?php if ($mein_editor = get_field('mein_editor', 'options')): ?>
                <p class="footer__content"><?php echo $mein_editor ?></p>
            <?php endif; ?>
            <?php if ($developer_name = get_field('developer_name', 'options')): ?>
                <p class="footer__content"><?php echo $developer_name ?></p>
            <?php endif; ?>
        </section>
        <section class="footer__section social">
            <?php if (have_rows('social_networks', 'options')): ?>
                <h4 class="footer__title">Ми в соцмережах:</h4>
                <ul class="social__list">
                    <?php while (have_rows('social_networks', 'options')) : the_row();
                        $social_icon = get_sub_field('social_icon');
                        $social_linc = get_sub_field('social_linc');
                        ?>
                        <li class="social__item">
                            <a class="social__link" href="<?php echo $social_linc ?>" target="_blank">
                                <?php echo $social_icon ?>
                            </a>
                        </li>
                    <?php endwhile; ?>
                </ul>
            <?php endif; ?>
        </section>
    </div>
    <section class="footer__copyright">
        <h4 class="visually-hidden">Усі права захищені</h4>
        <p class="copyright">&#169; Студія "Перевесло", 2018 - <?php echo date('Y'); ?></p>
    </section>
</footer>
<?php wp_footer(); ?>

</body>
</html>
