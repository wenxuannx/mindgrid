<?php
/**
 * The main template file
 *
 * @package ICT_Research
 */

get_header(); ?>

<main id="primary" class="site-main">
    <div class="container section-padding">
        
        <?php if (have_posts()) : ?>
            
            <header class="page-header">
                <?php
                if (is_home() && !is_front_page()) :
                    ?>
                    <h1 class="page-title"><?php single_post_title(); ?></h1>
                    <?php
                else :
                    ?>
                    <h1 class="page-title"><?php _e('Latest Updates', 'ict-research'); ?></h1>
                    <?php
                endif;
                ?>
            </header>

            <div class="posts-grid">
                <?php
                while (have_posts()) :
                    the_post();
                    get_template_part('template-parts/content', get_post_type());
                endwhile;
                ?>
            </div>

            <?php
            the_posts_navigation();

        else :

            get_template_part('template-parts/content', 'none');

        endif;
        ?>

    </div>
</main>

<?php
get_footer();
