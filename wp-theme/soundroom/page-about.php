<?php
/**
 * Template Name: About Page
 *
 * @package Soundroom
 */

get_header();

while (have_posts()): the_post();
?>

<!-- About Hero -->
<section class="about-hero">
    <div class="container container--narrow">
        <div class="reveal">
            <span class="section__eyebrow"><?php esc_html_e('About', 'soundroom'); ?></span>
            <h1 class="about-hero__title"><?php esc_html_e('The Soundroom', 'soundroom'); ?></h1>
            <p class="about-hero__intro">
                <?php esc_html_e('A creative sanctuary where music is stripped to its essence—raw, intimate, and undeniably real.', 'soundroom'); ?>
            </p>
        </div>
    </div>
</section>

<!-- Vision Section -->
<section class="section section--dark">
    <div class="container container--narrow">
        <div class="about-content reveal">
            <div>
                <span class="about-content__label"><?php esc_html_e('The Vision', 'soundroom'); ?></span>
            </div>
            <div class="about-content__text">
                <?php the_content(); ?>
            </div>
        </div>
    </div>
</section>

<!-- Values Section -->
<section class="section section--charcoal">
    <div class="container">
        <div class="values-grid">
            <div class="value-card reveal">
                <span class="value-card__number">01</span>
                <h3 class="value-card__title"><?php esc_html_e('Intimacy', 'soundroom'); ?></h3>
                <p class="value-card__text">
                    <?php esc_html_e("Every session feels like you're in the room with the artist. No crowd noise, no distractions—just music.", 'soundroom'); ?>
                </p>
            </div>
            <div class="value-card reveal">
                <span class="value-card__number">02</span>
                <h3 class="value-card__title"><?php esc_html_e('Authenticity', 'soundroom'); ?></h3>
                <p class="value-card__text">
                    <?php esc_html_e("No playback, no overdubs. What you hear is what happened in the room—honest and unfiltered.", 'soundroom'); ?>
                </p>
            </div>
            <div class="value-card reveal">
                <span class="value-card__number">03</span>
                <h3 class="value-card__title"><?php esc_html_e('Diversity', 'soundroom'); ?></h3>
                <p class="value-card__text">
                    <?php esc_html_e("From worship to Afro-soul, spoken word to alternative—we celebrate the full spectrum of genuine artistry.", 'soundroom'); ?>
                </p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="section section--dark">
    <div class="container container--narrow text-center">
        <div class="reveal">
            <h2 class="section__title"><?php esc_html_e('Enter the room', 'soundroom'); ?></h2>
            <p class="section__subtitle" style="margin: 0 auto var(--space-lg);">
                <?php esc_html_e("Whether you're here to listen or to be heard, you're welcome.", 'soundroom'); ?>
            </p>
            <div class="hero__actions" style="justify-content: center;">
                <a href="<?php echo get_post_type_archive_link('session'); ?>" class="btn btn--primary">
                    <?php esc_html_e('Watch Sessions', 'soundroom'); ?>
                </a>
                <a href="<?php echo esc_url(get_permalink(get_page_by_path('submit'))); ?>" class="btn btn--outline">
                    <?php esc_html_e('Submit Your Music', 'soundroom'); ?>
                </a>
            </div>
        </div>
    </div>
</section>

<?php
endwhile;

get_footer();
