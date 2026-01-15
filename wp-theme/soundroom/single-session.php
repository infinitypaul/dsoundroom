<?php
/**
 * Single Session (Artist) Template
 *
 * @package Soundroom
 */

get_header();

while (have_posts()): the_post();
    
    // Get custom fields (assumes ACF or similar)
    $youtube_url = get_post_meta(get_the_ID(), 'youtube_url', true);
    $audiomack_embed = get_post_meta(get_the_ID(), 'audiomack_embed', true);
    $location = get_post_meta(get_the_ID(), 'location', true);
    $credits = get_post_meta(get_the_ID(), 'credits', true);
    $instagram = get_post_meta(get_the_ID(), 'instagram_url', true);
    $spotify = get_post_meta(get_the_ID(), 'spotify_url', true);
    $artist_youtube = get_post_meta(get_the_ID(), 'artist_youtube_url', true);
    $artist_audiomack = get_post_meta(get_the_ID(), 'artist_audiomack_url', true);
?>

<!-- Artist Hero -->
<section class="artist-hero">
    <div class="artist-hero__bg">
        <?php if (has_post_thumbnail()): ?>
            <?php the_post_thumbnail('artist-hero', array('class' => 'artist-hero__bg-image')); ?>
        <?php endif; ?>
    </div>
    
    <div class="container">
        <div class="artist-hero__content reveal">
            <a href="<?php echo get_post_type_archive_link('session'); ?>" class="btn btn--ghost" style="margin-bottom: var(--space-md);">
                <?php esc_html_e('← Back to Sessions', 'soundroom'); ?>
            </a>
            <h1 class="artist-hero__name"><?php the_title(); ?></h1>
            <div class="artist-hero__tags">
                <?php
                $genres = get_the_terms(get_the_ID(), 'genre');
                if ($genres && !is_wp_error($genres)):
                    foreach ($genres as $genre):
                ?>
                    <span class="tag tag--accent"><?php echo esc_html($genre->name); ?></span>
                <?php 
                    endforeach;
                endif;
                ?>
                <?php if ($location): ?>
                    <span class="tag"><?php echo esc_html($location); ?></span>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<!-- Artist Content -->
<section class="section section--dark">
    <div class="container">
        <div class="artist-content">
            <!-- Main Content -->
            <div class="artist-main">
                <?php if ($youtube_url): 
                    // Convert YouTube URL to embed URL
                    $youtube_id = '';
                    if (preg_match('/[?&]v=([^&]+)/', $youtube_url, $matches)) {
                        $youtube_id = $matches[1];
                    } elseif (preg_match('/youtu\.be\/([^?]+)/', $youtube_url, $matches)) {
                        $youtube_id = $matches[1];
                    }
                ?>
                    <!-- Video Embed -->
                    <div class="video-embed reveal">
                        <iframe 
                            src="https://www.youtube.com/embed/<?php echo esc_attr($youtube_id); ?>" 
                            title="<?php the_title_attribute(); ?> - Soundroom Session"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                            allowfullscreen>
                        </iframe>
                    </div>
                <?php endif; ?>
                
                <?php if ($audiomack_embed): ?>
                    <!-- Audio Embed -->
                    <div class="audio-embed reveal">
                        <?php echo $audiomack_embed; ?>
                    </div>
                <?php endif; ?>
                
                <!-- Story Section -->
                <div class="artist-story reveal">
                    <h2 class="artist-story__title"><?php esc_html_e('The Story', 'soundroom'); ?></h2>
                    <div class="artist-story__text">
                        <?php the_content(); ?>
                    </div>
                </div>
            </div>
            
            <!-- Sidebar -->
            <aside class="artist-sidebar">
                <!-- Listen/Watch Links -->
                <div class="sidebar-card reveal">
                    <h3 class="sidebar-card__title"><?php esc_html_e('Listen & Watch', 'soundroom'); ?></h3>
                    <div class="social-links">
                        <?php if ($artist_youtube): ?>
                            <a href="<?php echo esc_url($artist_youtube); ?>" class="social-link" target="_blank">
                                <svg class="social-link__icon" viewBox="0 0 24 24" fill="currentColor"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                                <span class="social-link__text">YouTube</span>
                            </a>
                        <?php endif; ?>
                        <?php if ($artist_audiomack): ?>
                            <a href="<?php echo esc_url($artist_audiomack); ?>" class="social-link" target="_blank">
                                <svg class="social-link__icon" viewBox="0 0 24 24" fill="currentColor"><path d="M12 0C5.372 0 0 5.372 0 12s5.372 12 12 12 12-5.372 12-12S18.628 0 12 0zm5.5 17.5c-.276 0-.5-.224-.5-.5v-10c0-.276.224-.5.5-.5s.5.224.5.5v10c0 .276-.224.5-.5.5zm-3 1c-.276 0-.5-.224-.5-.5V6c0-.276.224-.5.5-.5s.5.224.5.5v12c0 .276-.224.5-.5.5zm-3 0c-.276 0-.5-.224-.5-.5V6c0-.276.224-.5.5-.5s.5.224.5.5v12c0 .276-.224.5-.5.5zm-3-1c-.276 0-.5-.224-.5-.5v-10c0-.276.224-.5.5-.5s.5.224.5.5v10c0 .276-.224.5-.5.5zm-3-2c-.276 0-.5-.224-.5-.5v-6c0-.276.224-.5.5-.5s.5.224.5.5v6c0 .276-.224.5-.5.5z"/></svg>
                                <span class="social-link__text">Audiomack</span>
                            </a>
                        <?php endif; ?>
                        <?php if ($instagram): ?>
                            <a href="<?php echo esc_url($instagram); ?>" class="social-link" target="_blank">
                                <svg class="social-link__icon" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                                <span class="social-link__text">Instagram</span>
                            </a>
                        <?php endif; ?>
                        <?php if ($spotify): ?>
                            <a href="<?php echo esc_url($spotify); ?>" class="social-link" target="_blank">
                                <svg class="social-link__icon" viewBox="0 0 24 24" fill="currentColor"><path d="M12 0C5.4 0 0 5.4 0 12s5.4 12 12 12 12-5.4 12-12S18.66 0 12 0zm5.521 17.34c-.24.359-.66.48-1.021.24-2.82-1.74-6.36-2.101-10.561-1.141-.418.122-.779-.179-.899-.539-.12-.421.18-.78.54-.9 4.56-1.021 8.52-.6 11.64 1.32.42.18.479.659.301 1.02zm1.44-3.3c-.301.42-.841.6-1.262.3-3.239-1.98-8.159-2.58-11.939-1.38-.479.12-1.02-.12-1.14-.6-.12-.48.12-1.021.6-1.141C9.6 9.9 15 10.561 18.72 12.84c.361.181.54.78.241 1.2zm.12-3.36C15.24 8.4 8.82 8.16 5.16 9.301c-.6.179-1.2-.181-1.38-.721-.18-.601.18-1.2.72-1.381 4.26-1.26 11.28-1.02 15.721 1.621.539.3.719 1.02.419 1.56-.299.421-1.02.599-1.559.3z"/></svg>
                                <span class="social-link__text">Spotify</span>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
                
                <?php 
                $credits_text = get_post_meta(get_the_ID(), 'credits_text', true);
                if ($credits_text): ?>
                    <!-- Session Credits -->
                    <div class="sidebar-card reveal">
                        <h3 class="sidebar-card__title"><?php esc_html_e('Session Credits', 'soundroom'); ?></h3>
                        <div class="credits-list">
                            <?php 
                            // Parse credits from textarea (format: Role - Name per line)
                            $lines = explode("\n", trim($credits_text));
                            foreach ($lines as $line):
                                $line = trim($line);
                                if (empty($line)) continue;
                                $parts = explode(' - ', $line, 2);
                                $role = isset($parts[0]) ? trim($parts[0]) : '';
                                $name = isset($parts[1]) ? trim($parts[1]) : $role;
                            ?>
                                <div class="credit-item">
                                    <span class="credit-item__role"><?php echo esc_html($role); ?></span>
                                    <span class="credit-item__name"><?php echo esc_html($name); ?></span>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
                
                <!-- Share -->
                <div class="sidebar-card reveal">
                    <h3 class="sidebar-card__title"><?php esc_html_e('Share This Session', 'soundroom'); ?></h3>
                    <div class="social-links" style="flex-direction: row; gap: var(--space-sm);">
                        <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title() . ' on The Soundroom'); ?>" class="social-link" style="flex: 1; justify-content: center;" target="_blank">
                            <svg class="social-link__icon" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                        </a>
                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" class="social-link" style="flex: 1; justify-content: center;" target="_blank">
                            <svg class="social-link__icon" viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                        <a href="#" class="social-link" style="flex: 1; justify-content: center;" onclick="navigator.clipboard.writeText('<?php echo esc_js(get_permalink()); ?>'); alert('Link copied!'); return false;">
                            <svg class="social-link__icon" viewBox="0 0 24 24" fill="currentColor"><path d="M16 1H4c-1.1 0-2 .9-2 2v14h2V3h12V1zm3 4H8c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h11c1.1 0 2-.9 2-2V7c0-1.1-.9-2-2-2zm0 16H8V7h11v14z"/></svg>
                        </a>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</section>

<!-- More Sessions -->
<section class="section section--charcoal">
    <div class="container">
        <div class="section__header reveal">
            <span class="section__eyebrow"><?php esc_html_e('More Sessions', 'soundroom'); ?></span>
            <h2 class="section__title"><?php esc_html_e('Continue listening', 'soundroom'); ?></h2>
        </div>
        
        <div class="artists-grid artists-grid--featured">
            <?php
            $related_sessions = new WP_Query(array(
                'post_type'      => 'session',
                'posts_per_page' => 3,
                'post__not_in'   => array(get_the_ID()),
                'orderby'        => 'rand',
            ));
            
            if ($related_sessions->have_posts()):
                while ($related_sessions->have_posts()): $related_sessions->the_post();
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
                                foreach (array_slice($genres, 0, 2) as $genre):
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
    </div>
</section>

<?php
endwhile;

get_footer();
