<?php
/**
 * Default Page Template
 *
 * @package Soundroom
 */

get_header();
?>

<section class="about-hero">
    <div class="container container--narrow">
        <div class="reveal">
            <span class="section__eyebrow"><?php echo esc_html(get_the_title()); ?></span>
            <h1 class="about-hero__title"><?php the_title(); ?></h1>
            <?php if (has_excerpt()): ?>
                <p class="about-hero__intro"><?php echo get_the_excerpt(); ?></p>
            <?php endif; ?>
        </div>
    </div>
</section>

<section class="section section--dark">
    <div class="container container--narrow">
        <div class="reveal">
            <div class="about-content__text">
                <?php 
                while (have_posts()): the_post();
                    the_content();
                endwhile;
                ?>
            </div>
        </div>
    </div>
</section>

<?php
get_footer();
