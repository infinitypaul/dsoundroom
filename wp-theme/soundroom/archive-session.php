<?php
/**
 * Sessions Archive Template
 *
 * @package Soundroom
 */

get_header();

// Get total count for infinite scroll
$total_sessions = wp_count_posts('session')->publish;
?>

<!-- Sessions Header -->
<section class="sessions-header">
    <div class="container">
        <div class="reveal">
            <span class="section__eyebrow"><?php esc_html_e('All Sessions', 'soundroom'); ?></span>
            <h1 class="section__title"><?php esc_html_e('In the room', 'soundroom'); ?></h1>
            <p class="section__subtitle" style="margin: 0 auto;">
                <?php esc_html_e('Every session is a moment captured—artists at their most intimate, sound at its most honest.', 'soundroom'); ?>
            </p>
        </div>
    </div>
</section>

<!-- Filter Bar & Grid -->
<section class="section--dark" style="padding-top: 0;">
    <div class="container">
        <div class="filter-bar reveal">
            <button class="filter-btn active" data-filter="all"><?php esc_html_e('All', 'soundroom'); ?></button>
            <?php
            $genres = get_terms(array(
                'taxonomy'   => 'genre',
                'hide_empty' => true,
            ));
            
            if ($genres && !is_wp_error($genres)):
                foreach ($genres as $genre):
            ?>
                <button class="filter-btn" data-filter="<?php echo esc_attr($genre->slug); ?>">
                    <?php echo esc_html($genre->name); ?>
                </button>
            <?php
                endforeach;
            endif;
            ?>
        </div>
        
        <!-- Artists Grid -->
        <div class="artists-grid" id="artistsGrid" 
             data-page="1" 
             data-max-pages="<?php echo esc_attr(ceil($total_sessions / 9)); ?>"
             data-filter="all">
            <?php 
            // Initial load - get first batch
            $initial_query = new WP_Query(array(
                'post_type'      => 'session',
                'posts_per_page' => 9,
                'paged'          => 1,
                'orderby'        => 'date',
                'order'          => 'DESC',
            ));
            
            if ($initial_query->have_posts()): 
                while ($initial_query->have_posts()): $initial_query->the_post();
                    $session_genres = get_the_terms(get_the_ID(), 'genre');
                    $genre_classes = array();
                    $genre_names = array();
                    if ($session_genres && !is_wp_error($session_genres)) {
                        foreach ($session_genres as $g) {
                            $genre_classes[] = $g->slug;
                            $genre_names[] = $g->name;
                        }
                    }
            ?>
                <a href="<?php the_permalink(); ?>" class="artist-card reveal" data-genre="<?php echo esc_attr(implode(' ', $genre_classes)); ?>">
                    <?php if (has_post_thumbnail()): ?>
                        <?php the_post_thumbnail('artist-card', array('class' => 'artist-card__image')); ?>
                    <?php else: ?>
                        <div class="artist-card__placeholder"></div>
                    <?php endif; ?>
                    <div class="artist-card__overlay">
                        <h3 class="artist-card__name"><?php the_title(); ?></h3>
                        <div class="artist-card__tags">
                            <?php foreach (array_slice($genre_names, 0, 2) as $name): ?>
                                <span class="tag"><?php echo esc_html($name); ?></span>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </a>
            <?php 
                endwhile; 
                wp_reset_postdata();
            endif; 
            ?>
        </div>
        
        <!-- Infinite Scroll Loader -->
        <div class="infinite-scroll-status text-center mt-xl">
            <div class="infinite-scroll-loader" id="infiniteLoader" style="display: none;">
                <div class="loader-spinner"></div>
                <span>Loading more sessions...</span>
            </div>
            <div class="infinite-scroll-end" id="infiniteEnd" style="display: none;">
                <span class="section__eyebrow">You've seen them all</span>
            </div>
            <div class="infinite-scroll-empty" id="infiniteEmpty" style="display: none;">
                <span class="section__eyebrow">No sessions found</span>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="section section--charcoal">
    <div class="container container--narrow text-center">
        <div class="reveal">
            <h2 class="section__title"><?php esc_html_e('Be part of the room', 'soundroom'); ?></h2>
            <p class="section__subtitle" style="margin: 0 auto var(--space-lg);">
                <?php esc_html_e("Think your sound belongs here? We're always listening.", 'soundroom'); ?>
            </p>
            <a href="<?php echo esc_url(get_permalink(get_page_by_path('submit'))); ?>" class="btn btn--primary">
                <?php esc_html_e('Submit Your Session', 'soundroom'); ?>
            </a>
        </div>
    </div>
</section>

<?php
get_footer();
