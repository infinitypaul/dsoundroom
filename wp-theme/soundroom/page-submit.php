<?php
/**
 * Template Name: Submit Page
 *
 * @package Soundroom
 */

get_header();
?>

<!-- Submit Hero -->
<section class="about-hero">
    <div class="container">
        <div class="reveal">
            <span class="section__eyebrow"><?php esc_html_e('Be Featured', 'soundroom'); ?></span>
            <h1 class="about-hero__title"><?php esc_html_e('Share your sound', 'soundroom'); ?></h1>
            <p class="about-hero__intro">
                <?php esc_html_e("The Soundroom is always listening. If you're an artist with something genuine to say—regardless of genre—we'd love to hear from you.", 'soundroom'); ?>
            </p>
        </div>
        
        <div class="callout reveal" style="margin-top: var(--space-xl);">
            <p>
                <strong><?php esc_html_e('How it works:', 'soundroom'); ?></strong>
                <?php esc_html_e("Sessions are curated by invitation and submission. We prioritize artistic intention over follower counts, and authenticity over polish. If your submission resonates, we'll reach out to discuss next steps.", 'soundroom'); ?>
            </p>
        </div>
    </div>
</section>

<!-- Submit Form -->
<section class="section--dark" style="padding-top: 0;">
    <div class="container">
        <form class="submission-form reveal" id="submissionForm">
            <?php wp_nonce_field('soundroom_nonce', 'submission_nonce'); ?>
            
            <div class="form-group">
                <label for="name" class="form-label"><?php esc_html_e('Artist / Stage Name', 'soundroom'); ?> *</label>
                <input type="text" id="name" name="name" class="form-input" required>
            </div>
            
            <div class="form-group">
                <label for="email" class="form-label"><?php esc_html_e('Email Address', 'soundroom'); ?> *</label>
                <input type="email" id="email" name="email" class="form-input" required>
            </div>
            
            <div class="form-group">
                <label for="phone" class="form-label"><?php esc_html_e('Phone / WhatsApp (Optional)', 'soundroom'); ?></label>
                <input type="text" id="phone" name="phone" class="form-input">
            </div>
            
            <div class="form-group">
                <label for="location" class="form-label"><?php esc_html_e('Location', 'soundroom'); ?> *</label>
                <input type="text" id="location" name="location" class="form-input" placeholder="<?php esc_attr_e('Lagos, Nigeria', 'soundroom'); ?>" required>
            </div>
            
            <div class="form-group">
                <label for="genre" class="form-label"><?php esc_html_e('Genre / Vibe', 'soundroom'); ?> *</label>
                <select id="genre" name="genre" class="form-select" required>
                    <option value=""><?php esc_html_e('Select your primary genre', 'soundroom'); ?></option>
                    <option value="worship"><?php esc_html_e('Worship', 'soundroom'); ?></option>
                    <option value="afro-soul"><?php esc_html_e('Afro-soul', 'soundroom'); ?></option>
                    <option value="soul-rnb"><?php esc_html_e('Soul / R&B', 'soundroom'); ?></option>
                    <option value="acoustic"><?php esc_html_e('Acoustic', 'soundroom'); ?></option>
                    <option value="spoken-word"><?php esc_html_e('Spoken Word / Poetry', 'soundroom'); ?></option>
                    <option value="alternative"><?php esc_html_e('Alternative', 'soundroom'); ?></option>
                    <option value="jazz"><?php esc_html_e('Jazz', 'soundroom'); ?></option>
                    <option value="folk"><?php esc_html_e('Folk', 'soundroom'); ?></option>
                    <option value="other"><?php esc_html_e('Other', 'soundroom'); ?></option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="music_links" class="form-label"><?php esc_html_e('Links to Your Music', 'soundroom'); ?> *</label>
                <textarea id="music_links" name="music_links" class="form-textarea" rows="3" placeholder="<?php esc_attr_e('YouTube, Audiomack, Spotify, SoundCloud, etc.', 'soundroom'); ?>" required></textarea>
            </div>
            
            <div class="form-group">
                <label for="social_links" class="form-label"><?php esc_html_e('Social Media Link', 'soundroom'); ?></label>
                <input type="text" id="social_links" name="social_links" class="form-input" placeholder="<?php esc_attr_e('Instagram, Twitter, etc.', 'soundroom'); ?>">
            </div>
            
            <div class="form-group">
                <label for="intent" class="form-label"><?php esc_html_e('Your Intent / What This Session Would Mean', 'soundroom'); ?> *</label>
                <textarea id="intent" name="intent" class="form-textarea" rows="4" placeholder="<?php esc_attr_e("Tell us why you want to be on The Soundroom. What does your music mean to you?", 'soundroom'); ?>" required></textarea>
            </div>
            
            <div class="form-group">
                <label for="song" class="form-label"><?php esc_html_e('What Song Would You Perform?', 'soundroom'); ?></label>
                <textarea id="song" name="song" class="form-textarea" rows="2" placeholder="<?php esc_attr_e('Song title and a brief description', 'soundroom'); ?>"></textarea>
            </div>
            
            <div class="form-group">
                <label for="source" class="form-label"><?php esc_html_e('How Did You Hear About The Soundroom?', 'soundroom'); ?></label>
                <select id="source" name="source" class="form-select">
                    <option value=""><?php esc_html_e('Select an option', 'soundroom'); ?></option>
                    <option value="youtube"><?php esc_html_e('YouTube', 'soundroom'); ?></option>
                    <option value="instagram"><?php esc_html_e('Instagram', 'soundroom'); ?></option>
                    <option value="twitter"><?php esc_html_e('Twitter/X', 'soundroom'); ?></option>
                    <option value="friend"><?php esc_html_e('Friend / Word of Mouth', 'soundroom'); ?></option>
                    <option value="featured-artist"><?php esc_html_e('Featured Artist', 'soundroom'); ?></option>
                    <option value="search"><?php esc_html_e('Google / Search', 'soundroom'); ?></option>
                    <option value="other"><?php esc_html_e('Other', 'soundroom'); ?></option>
                </select>
            </div>
            
            <div class="form-group">
                <button type="submit" class="btn btn--primary btn--large" style="width: 100%;">
                    <?php esc_html_e('Submit Application', 'soundroom'); ?>
                </button>
            </div>
        </form>
    </div>
</section>

<!-- FAQ Section -->
<section class="section section--charcoal">
    <div class="container container--narrow">
        <div class="section__header reveal">
            <span class="section__eyebrow"><?php esc_html_e('FAQ', 'soundroom'); ?></span>
            <h2 class="section__title"><?php esc_html_e('Common questions', 'soundroom'); ?></h2>
        </div>
        
        <div class="faq-list">
            <div class="faq-item reveal">
                <h3 class="faq-item__question"><?php esc_html_e('What happens after I submit?', 'soundroom'); ?></h3>
                <p class="faq-item__answer">
                    <?php esc_html_e("We review every submission personally. If your sound resonates with The Soundroom vision, we'll reach out within 2-3 weeks to discuss next steps.", 'soundroom'); ?>
                </p>
            </div>
            <div class="faq-item reveal">
                <h3 class="faq-item__question"><?php esc_html_e('Do I need a certain follower count?', 'soundroom'); ?></h3>
                <p class="faq-item__answer">
                    <?php esc_html_e("No. We care about artistry and authenticity, not metrics. Some of our most powerful sessions have featured emerging artists with small but devoted audiences.", 'soundroom'); ?>
                </p>
            </div>
            <div class="faq-item reveal">
                <h3 class="faq-item__question"><?php esc_html_e('Where are sessions filmed?', 'soundroom'); ?></h3>
                <p class="faq-item__answer">
                    <?php esc_html_e("Sessions are currently filmed in Lagos, Nigeria. We may expand to other cities in the future.", 'soundroom'); ?>
                </p>
            </div>
        </div>
    </div>
</section>

<?php
get_footer();
