<?php
/**
 * Front Page Template
 *
 * @package Soundroom
 */

get_header();

// Get theme settings (works with ACF or customizer)
$headline = get_option('soundroom_headline', 'A room for authentic sound.');
$subline = get_option('soundroom_subline', 'Intimate live sessions that strip back the noise and let the music breathe. Worship. Soul. Acoustic. Spoken word. Every genre, one feeling—real.');
?>

<!-- Hero Section -->
<section class="hero">
    <div class="hero__bg">
        <?php 
        $hero_image = get_option('soundroom_hero_image');
        if ($hero_image): ?>
            <img src="<?php echo esc_url($hero_image); ?>" alt="" class="hero__bg-image">
        <?php else: ?>
            <img src="<?php echo SOUNDROOM_URI; ?>/assets/images/hero-bg.svg" alt="" class="hero__bg-image">
        <?php endif; ?>
    </div>
    
    <div class="hero__content">
        <h1 class="hero__headline"><?php echo esc_html($headline); ?></h1>
        <p class="hero__subline"><?php echo esc_html($subline); ?></p>
        <div class="hero__actions">
            <a href="<?php echo get_post_type_archive_link('session'); ?>" class="btn btn--primary">
                <?php esc_html_e('Watch Sessions', 'soundroom'); ?>
            </a>
            <a href="<?php echo esc_url(get_permalink(get_page_by_path('submit'))); ?>" class="btn btn--outline">
                <?php esc_html_e('Submit / Be Featured', 'soundroom'); ?>
            </a>
        </div>
    </div>
    
    <div class="hero__scroll">
        <span><?php esc_html_e('Scroll', 'soundroom'); ?></span>
        <div class="hero__scroll-line"></div>
    </div>
</section>

<!-- Featured Sessions Section -->
<section class="section section--dark">
    <div class="container">
        <div class="section__header section__header--center reveal">
            <span class="section__eyebrow"><?php esc_html_e('Featured Sessions', 'soundroom'); ?></span>
            <h2 class="section__title"><?php esc_html_e('In the room', 'soundroom'); ?></h2>
            <p class="section__subtitle">
                <?php esc_html_e('Every session is a moment—unrehearsed energy, raw vocals, honest sound.', 'soundroom'); ?>
            </p>
        </div>
        
        <div class="artists-grid artists-grid--featured">
            <?php
            $featured_sessions = new WP_Query(array(
                'post_type'      => 'session',
                'posts_per_page' => 6,
                'orderby'        => 'date',
                'order'          => 'DESC',
            ));
            
            if ($featured_sessions->have_posts()):
                while ($featured_sessions->have_posts()): $featured_sessions->the_post();
            ?>
                <a href="<?php the_permalink(); ?>" class="artist-card reveal">
                    <?php if (has_post_thumbnail()): ?>
                        <?php the_post_thumbnail('artist-card', array('class' => 'artist-card__image')); ?>
                    <?php else: ?>
                        <div class="artist-card__placeholder"></div>
                    <?php endif; ?>
                    <div class="artist-card__overlay">
                        <h3 class="artist-card__name"><?php the_title(); ?></h3>
                        <div class="artist-card__tags">
                            <?php
                            $genres = get_the_terms(get_the_ID(), 'genre');
                            if ($genres && !is_wp_error($genres)):
                                foreach ($genres as $genre):
                            ?>
                                <span class="tag"><?php echo esc_html($genre->name); ?></span>
                            <?php 
                                endforeach;
                            endif;
                            ?>
                        </div>
                    </div>
                </a>
            <?php
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </div>
        
        <div class="text-center mt-xl reveal">
            <a href="<?php echo get_post_type_archive_link('session'); ?>" class="btn btn--outline">
                <?php esc_html_e('View All Sessions', 'soundroom'); ?>
            </a>
        </div>
    </div>
</section>

<!-- The Concept Section -->
<section class="section section--charcoal">
    <div class="container container--narrow">
        <div class="about-content reveal">
            <div>
                <span class="about-content__label"><?php esc_html_e('The Room', 'soundroom'); ?></span>
            </div>
            <div class="about-content__text">
                <p>
                    <?php esc_html_e('The Soundroom is where music comes undone—not to break it, but to reveal it. No tracks. No overdubs. Just artists, their craft, and the intimacy of a single room.', 'soundroom'); ?>
                </p>
                <p>
                    <?php esc_html_e('Every session is an invitation: to witness sound at its most honest, to feel the breath between notes, to remember why we fell in love with music.', 'soundroom'); ?>
                </p>
                <a href="<?php echo esc_url(get_permalink(get_page_by_path('about'))); ?>" class="btn btn--ghost">
                    <?php esc_html_e('Learn more about The Soundroom →', 'soundroom'); ?>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Newsletter Section -->
<section class="section section--dark">
    <div class="container container--narrow">
        <div class="newsletter reveal">
            <div class="text-center">
                <h3 class="newsletter__title"><?php esc_html_e('Enter the room', 'soundroom'); ?></h3>
                <p class="newsletter__text">
                    <?php esc_html_e('Get notified when new sessions drop. No spam—just sound.', 'soundroom'); ?>
                </p>
                <form class="newsletter__form" id="newsletterForm" style="max-width: 400px; margin: 0 auto;">
                    <?php wp_nonce_field('soundroom_nonce', 'newsletter_nonce'); ?>
                    <input type="email" name="email" class="newsletter__input" placeholder="<?php esc_attr_e('Your email', 'soundroom'); ?>" required>
                    <button type="submit" class="btn btn--primary btn--small"><?php esc_html_e('Subscribe', 'soundroom'); ?></button>
                </form>
            </div>
        </div>
    </div>
</section>

<?php
get_footer();
