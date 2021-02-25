<form role="search" method="get" class="header__search-form search-form" action="<?php echo home_url('/'); ?>">
    <label class="search-form__label" for="search">
        <span class="visually-hidden">Пошук по сайту</span>
    </label>
    <input class="search-form__input" id="search" type="search-form__input"
           placeholder="<?php echo esc_attr_x('Пошук', 'placeholder') ?>"
           value="<?php echo get_search_query() ?>" name="s"
           title="Пошук по сайту"/>
    <svg class="search-form__icon" xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17">
        <path d="M17 15.586l-3.542-3.542A7.465 7.465 0 0 0 15 7.5 7.5 7.5 0 1 0 7.5 15c1.71 0 3.282-.579 4.544-1.542L15.586 17 17 15.586zM2 7.5C2 4.467 4.467 2 7.5 2 10.532 2 13 4.467 13 7.5c0 3.032-2.468 5.5-5.5 5.5A5.506 5.506 0 0 1 2 7.5z"></path>
    </svg>
</form>
	