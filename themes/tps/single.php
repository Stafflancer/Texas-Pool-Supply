<?php get_header(); ?>

    <main class="main">
        <?php
        get_template_part('modules/post-content/post-content', '', array('breadcrubms' => 'NEWS & PRESS'));

        if (have_rows('any_question', 'option')) {
            while (have_rows('any_question', 'option')) {
                the_row();
                get_template_part('modules/any_questions/any_questions');
            }
        } ?>
    </main>

<?php get_footer(); ?>