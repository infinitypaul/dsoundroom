<?php
/**
 * Template Name: About Page
 *
 * @package Soundroom
 */

get_header();
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

<!-- About Sections -->
<section class="section section--dark">
    <div class="container container--narrow">
        <!-- The Vision -->
        <div class="about-section reveal">
            <div class="about-content">
                <div>
                    <span class="about-content__label"><?php esc_html_e('The Vision', 'soundroom'); ?></span>
                </div>
                <div class="about-content__text">
                    <p>
                        <?php esc_html_e("In an age of infinite production layers and algorithmic playlists, there's something radical about simplicity. The Soundroom exists to capture that—music in its most human form.", 'soundroom'); ?>
                    </p>
                    <p>
                        <?php esc_html_e("No overdubs. No auto-tune. No distractions. Just an artist, their instrument, and a room designed to make every note matter.", 'soundroom'); ?>
                    </p>
                </div>
            </div>
        </div>

        <!-- The Format -->
        <div class="about-section reveal">
            <div class="about-content">
                <div>
                    <span class="about-content__label"><?php esc_html_e('The Format', 'soundroom'); ?></span>
                </div>
                <div class="about-content__text">
                    <p>
                        <?php esc_html_e("Each session is filmed with cinematic intention—every frame composed to complement the emotion of the music. We prioritize atmosphere: soft lighting, negative space, and the quiet intensity of focused performance.", 'soundroom'); ?>
                    </p>
                    <p>
                        <?php esc_html_e("Audio is recorded live with minimal processing. What you hear is what happened in the room—breath, resonance, the occasional beautiful mistake.", 'soundroom'); ?>
                    </p>
                </div>
            </div>
        </div>

        <!-- The Sound -->
        <div class="about-section reveal">
            <div class="about-content">
                <div>
                    <span class="about-content__label"><?php esc_html_e('The Sound', 'soundroom'); ?></span>
                </div>
                <div class="about-content__text">
                    <p>
                        <?php esc_html_e("The Soundroom is genre-agnostic. We've hosted worship leaders and alternative artists. Spoken word poets and Afro-soul vocalists. Acoustic sessions and full band arrangements.", 'soundroom'); ?>
                    </p>
                    <p>
                        <?php esc_html_e("What unites every session isn't a sound—it's a feeling. The intimacy of being in the room. The privilege of witnessing something unguarded.", 'soundroom'); ?>
                    </p>
                </div>
            </div>
        </div>

        <!-- The Host -->
        <div class="about-section reveal">
            <div class="about-content">
                <div>
                    <span class="about-content__label"><?php esc_html_e('The Host', 'soundroom'); ?></span>
                </div>
                <div class="about-content__text">
                    <p>
                        <?php esc_html_e("Infinity Paul is a producer, creative director, and lifelong student of sound. After years of working behind the scenes with artists across Africa and beyond, The Soundroom emerged from a simple question: what happens when we take away everything except the music?", 'soundroom'); ?>
                    </p>
                    <p>
                        <?php esc_html_e("The answer has been more powerful than expected. Artists find freedom in the constraints. Listeners find connection in the honesty. And the room itself has become a kind of creative sanctuary—a place where pretense dissolves and only the real remains.", 'soundroom'); ?>
                    </p>
                </div>
            </div>
        </div>

        <!-- The Philosophy -->
        <div class="about-section reveal">
            <div class="about-content">
                <div>
                    <span class="about-content__label"><?php esc_html_e('The Philosophy', 'soundroom'); ?></span>
                </div>
                <div class="about-content__text">
                    <p>
                        <?php esc_html_e("We believe in quality over quantity. Every session is curated, not just for technical skill, but for artistic intention. We look for artists who have something to say—and the courage to say it without hiding.", 'soundroom'); ?>
                    </p>
                    <p>
                        <?php esc_html_e("The Soundroom is also a community. Each featured artist becomes part of a growing archive of genuine expression. Their pages live permanently, shareable links that represent not just a performance, but a moment in their artistic journey.", 'soundroom'); ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="section section--charcoal">
    <div class="container container--narrow text-center">
        <div class="reveal">
            <h2 class="section__title"><?php esc_html_e('Enter the room', 'soundroom'); ?></h2>
            <p class="section__subtitle" style="margin: 0 auto var(--space-lg);">
                <?php esc_html_e("Whether you're here to listen or to be heard, you're welcome.", 'soundroom'); ?>
            </p>
            <div style="display: flex; gap: var(--space-sm); justify-content: center; flex-wrap: wrap;">
                <a href="<?php echo esc_url(get_post_type_archive_link('session')); ?>" class="btn btn--primary">
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
get_footer();
