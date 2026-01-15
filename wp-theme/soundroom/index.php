<?php
/**
 * The main template file
 *
 * @package Soundroom
 */

get_header();
?>

<?php if (have_posts()): ?>
    <section class="section section--dark">
        <div class="container">
            <div class="section__header">
                <h1 class="section__title"><?php esc_html_e('Latest', 'soundroom'); ?></h1>
            </div>
            
            <div class="artists-grid">
                <?php while (have_posts()): the_post(); ?>
                    <article class="artist-card reveal">
                        <?php if (has_post_thumbnail()): ?>
                            <?php the_post_thumbnail('artist-card', array('class' => 'artist-card__image')); ?>
                        <?php else: ?>
                            <div class="artist-card__placeholder"></div>
                        <?php endif; ?>
                        <div class="artist-card__overlay">
                            <h3 class="artist-card__name">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h3>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>
            
            <?php the_posts_pagination(array(
                'mid_size'  => 2,
                'prev_text' => '←',
                'next_text' => '→',
            )); ?>
        </div>
    </section>
<?php else: ?>
    <section class="section section--dark">
        <div class="container">
            <p><?php esc_html_e('No content found.', 'soundroom'); ?></p>
        </div>
    </section>
<?php endif; ?>

<?php
get_footer();
