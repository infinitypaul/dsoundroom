<?php
/**
 * Template Name: Submit Page
 *
 * @package Soundroom
 */

get_header();
?>

<!-- Submit Hero -->
<section class="submit-hero">
    <div class="container">
        <div class="submit-hero__content reveal">
            <span class="section__eyebrow"><?php esc_html_e('Be Featured', 'soundroom'); ?></span>
            <h1 class="submit-hero__title"><?php esc_html_e('Share your sound', 'soundroom'); ?></h1>
            <p class="submit-hero__text">
                <?php esc_html_e("The Soundroom is always listening. If you're an artist with something genuine to say—regardless of genre—we'd love to hear from you.", 'soundroom'); ?>
            </p>
        </div>
    </div>
</section>

<!-- Submit Form -->
<section class="submit-form-section section--dark">
    <div class="container">
        <div class="reveal">
            <div class="form-note mb-xl" style="max-width: 700px;">
                <strong><?php esc_html_e('How it works:', 'soundroom'); ?></strong>
                <?php esc_html_e("Sessions are curated by invitation and submission. We prioritize artistic intention over follower counts, and authenticity over polish. If your submission resonates, we'll reach out to discuss next steps.", 'soundroom'); ?>
            </div>
        </div>

        <form class="form reveal" id="submitForm">
            <?php wp_nonce_field('soundroom_nonce', 'submission_nonce'); ?>
            
            <!-- Name -->
            <div class="form-group">
                <label for="name" class="form-label"><?php esc_html_e('Artist / Stage Name', 'soundroom'); ?> *</label>
                <input type="text" id="name" name="name" class="form-input" required placeholder="<?php esc_attr_e('Your name or stage name', 'soundroom'); ?>">
            </div>
            
            <!-- Email -->
            <div class="form-group">
                <label for="email" class="form-label"><?php esc_html_e('Email Address', 'soundroom'); ?> *</label>
                <input type="email" id="email" name="email" class="form-input" required placeholder="<?php esc_attr_e('your@email.com', 'soundroom'); ?>">
            </div>
            
            <!-- Phone (Optional) -->
            <div class="form-group">
                <label for="phone" class="form-label"><?php esc_html_e('Phone / WhatsApp (Optional)', 'soundroom'); ?></label>
                <input type="text" id="phone" name="phone" class="form-input" placeholder="<?php esc_attr_e('+234 xxx xxx xxxx', 'soundroom'); ?>">
            </div>
            
            <!-- Location -->
            <div class="form-group">
                <label for="location" class="form-label"><?php esc_html_e('Location', 'soundroom'); ?> *</label>
                <input type="text" id="location" name="location" class="form-input" required placeholder="<?php esc_attr_e('City, Country', 'soundroom'); ?>">
            </div>
            
            <!-- Genre / Vibe -->
            <div class="form-group">
                <label for="genre" class="form-label"><?php esc_html_e('Genre / Vibe', 'soundroom'); ?> *</label>
                <select id="genre" name="genre" class="form-select" required>
                    <option value="" disabled selected><?php esc_html_e('Select your primary genre', 'soundroom'); ?></option>
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
            
            <!-- Music Links -->
            <div class="form-group">
                <label for="music_links" class="form-label"><?php esc_html_e('Links to Your Music', 'soundroom'); ?> *</label>
                <textarea id="music_links" name="music_links" class="form-textarea" rows="3" required placeholder="<?php esc_attr_e('Share links to your music (YouTube, Spotify, Audiomack, SoundCloud, etc.)', 'soundroom'); ?>"></textarea>
            </div>
            
            <!-- Social Links -->
            <div class="form-group">
                <label for="social_links" class="form-label"><?php esc_html_e('Social Media Links', 'soundroom'); ?></label>
                <textarea id="social_links" name="social_links" class="form-textarea" rows="2" placeholder="<?php esc_attr_e('Instagram, Twitter/X, TikTok, etc.', 'soundroom'); ?>"></textarea>
            </div>
            
            <!-- Intent -->
            <div class="form-group">
                <label for="intent" class="form-label"><?php esc_html_e('Your Intent / What This Session Would Mean', 'soundroom'); ?> *</label>
                <textarea id="intent" name="intent" class="form-textarea" rows="4" required placeholder="<?php esc_attr_e('Tell us about yourself and your music. What would a Soundroom session mean to you? What story do you want to tell?', 'soundroom'); ?>"></textarea>
            </div>
            
            <!-- Song Choice -->
            <div class="form-group">
                <label for="song" class="form-label"><?php esc_html_e('What Song Would You Perform?', 'soundroom'); ?></label>
                <textarea id="song" name="song" class="form-textarea" rows="2" placeholder="<?php esc_attr_e('If selected, what song(s) would you want to perform in the room? Original or cover?', 'soundroom'); ?>"></textarea>
            </div>
            
            <!-- How Did You Hear -->
            <div class="form-group">
                <label for="source" class="form-label"><?php esc_html_e('How Did You Hear About The Soundroom?', 'soundroom'); ?></label>
                <select id="source" name="source" class="form-select">
                    <option value="" disabled selected><?php esc_html_e('Select an option', 'soundroom'); ?></option>
                    <option value="youtube"><?php esc_html_e('YouTube', 'soundroom'); ?></option>
                    <option value="instagram"><?php esc_html_e('Instagram', 'soundroom'); ?></option>
                    <option value="twitter"><?php esc_html_e('Twitter/X', 'soundroom'); ?></option>
                    <option value="friend"><?php esc_html_e('Friend / Word of Mouth', 'soundroom'); ?></option>
                    <option value="featured-artist"><?php esc_html_e('Featured Artist', 'soundroom'); ?></option>
                    <option value="search"><?php esc_html_e('Google / Search', 'soundroom'); ?></option>
                    <option value="other"><?php esc_html_e('Other', 'soundroom'); ?></option>
                </select>
            </div>
            
            <!-- Submit Button -->
            <div class="form-group">
                <button type="submit" class="btn btn--primary" style="width: 100%; max-width: 300px;">
                    <?php esc_html_e('Submit Application', 'soundroom'); ?>
                </button>
            </div>
        </form>

        <div class="reveal mt-xl" style="max-width: 700px;">
            <p class="text-muted" style="font-size: var(--text-sm);">
                <?php esc_html_e("By submitting, you confirm that the music you share is yours or you have rights to perform it. We review every submission personally—please allow 2-4 weeks for a response. Not all submissions will receive a reply, but every one is heard.", 'soundroom'); ?>
            </p>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="section section--charcoal">
    <div class="container container--narrow">
        <div class="section__header reveal">
            <span class="section__eyebrow"><?php esc_html_e('Common Questions', 'soundroom'); ?></span>
            <h2 class="section__title"><?php esc_html_e('Before you submit', 'soundroom'); ?></h2>
        </div>

        <div class="about-section reveal">
            <div class="about-content">
                <div>
                    <span class="about-content__label"><?php esc_html_e('What are you looking for?', 'soundroom'); ?></span>
                </div>
                <div class="about-content__text">
                    <p>
                        <?php esc_html_e("Artists with genuine artistic vision. We don't require you to be famous or have a certain follower count. We're looking for authenticity, vocal/musical ability, and an interesting story to tell.", 'soundroom'); ?>
                    </p>
                </div>
            </div>
        </div>

        <div class="about-section reveal">
            <div class="about-content">
                <div>
                    <span class="about-content__label"><?php esc_html_e('Where are sessions filmed?', 'soundroom'); ?></span>
                </div>
                <div class="about-content__text">
                    <p>
                        <?php esc_html_e("Currently in Lagos, Nigeria. If you're based elsewhere, let us know—we occasionally travel for special sessions, and are exploring ways to expand our reach.", 'soundroom'); ?>
                    </p>
                </div>
            </div>
        </div>

        <div class="about-section reveal">
            <div class="about-content">
                <div>
                    <span class="about-content__label"><?php esc_html_e('Is there a cost?', 'soundroom'); ?></span>
                </div>
                <div class="about-content__text">
                    <p>
                        <?php esc_html_e("The Soundroom is a creative platform, not a pay-to-play service. There's no cost to be featured. We cover production; you bring the music and your presence.", 'soundroom'); ?>
                    </p>
                </div>
            </div>
        </div>

        <div class="about-section reveal">
            <div class="about-content">
                <div>
                    <span class="about-content__label"><?php esc_html_e("What if I haven't released music yet?", 'soundroom'); ?></span>
                </div>
                <div class="about-content__text">
                    <p>
                        <?php esc_html_e("That's okay. Share demos, voice notes, or live recordings. We care more about potential and authenticity than a polished discography.", 'soundroom'); ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
get_footer();
