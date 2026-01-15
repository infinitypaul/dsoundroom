<?php
/**
 * 404 Page Template
 *
 * @package Soundroom
 */

get_header();
?>

<section class="about-hero" style="min-height: 60vh; display: flex; align-items: center;">
    <div class="container container--narrow text-center">
        <div class="reveal">
            <span class="section__eyebrow"><?php esc_html_e('404', 'soundroom'); ?></span>
            <h1 class="about-hero__title"><?php esc_html_e('Lost in the sound', 'soundroom'); ?></h1>
            <p class="about-hero__intro">
                <?php esc_html_e("The page you're looking for doesn't exist. But the music is always playing somewhere.", 'soundroom'); ?>
            </p>
            <div class="hero__actions" style="justify-content: center; margin-top: var(--space-lg);">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn--primary">
                    <?php esc_html_e('Back to Home', 'soundroom'); ?>
                </a>
                <a href="<?php echo get_post_type_archive_link('session'); ?>" class="btn btn--outline">
                    <?php esc_html_e('Browse Sessions', 'soundroom'); ?>
                </a>
            </div>
        </div>
    </div>
</section>

<?php
get_footer();
