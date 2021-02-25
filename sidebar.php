
<section class="sidebar__section">
    <h2 class="sidebar__title">
        Наші автори:
    </h2>
    <?php $users = get_users([
        'role'       => 'author',
        'fields'     => ['ID', 'display_name', 'user_nicename'],
        'exclude'    => '166',
        'orderby'    => 'display_name',
        'order'      => 'ASC',
        'meta_query' => array(
            array(
                'key'   => 'is_graduate',
                'value' => '0',
            )
        )
    ]);
    if (!empty($users)):
        echo do_shortcode('[tabby title="Активні"]'); ?>
        <ul class="sidebar__list users-list">
            <?php foreach ($users as $user): ?>
                <li class="users-list__item">
                    <a class="users-list__link"
                       href="<?php echo get_author_posts_url($user->ID, $user->user_nicename); ?>">
                        <?php echo $user->display_name ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <?php echo do_shortcode('[tabby title="Архів"]'); ?>
    <?php $users = get_users([
        'role'       => 'author',
        'fields'     => ['ID', 'display_name', 'user_nicename'],
        'exclude'    => '166',
        'orderby'    => 'display_name',
        'order'      => 'ASC',
        'meta_query' => array(
            array(
                'key'   => 'is_graduate',
                'value' => '1',
            )
        )
    ]); ?>
    <ul class="sidebar__list users-list">
        <?php foreach ($users as $user): ?>
            <li class="users-list__item">
                <a class="users-list__link" href="<?php echo get_author_posts_url($user->ID, $user->user_nicename); ?>">
                    <?php echo $user->display_name ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
    <?php echo do_shortcode('[tabbyending]'); ?>
</section>

<section class="sidebar__section">
    <?php if (function_exists('the_ad')) {
        the_ad(4500);
    } ?>
</section>

<section class="sidebar__section">
    <?php
    if (function_exists('wp_tag_cloud')) {
        echo '<h2 class="sidebar__title">Теги:</h2>';
        wp_tag_cloud(array(
            'smallest' => 8,
            'largest'  => 24,
            'number'   => '',
        ));
    }
    ?>
</section>
