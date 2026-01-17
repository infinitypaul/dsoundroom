<?php
/**
 * Template Name: Contact Page
 *
 * @package Soundroom
 */

get_header();
?>

<!-- Contact Hero -->
<section class="about-hero">
    <div class="container container--narrow">
        <div class="reveal">
            <span class="section__eyebrow"><?php esc_html_e('Contact', 'soundroom'); ?></span>
            <h1 class="about-hero__title"><?php esc_html_e('Get in touch', 'soundroom'); ?></h1>
            <p class="about-hero__intro">
                <?php esc_html_e('For bookings, press inquiries, or just to say hello—we\'d love to hear from you.', 'soundroom'); ?>
            </p>
        </div>
    </div>
</section>

<!-- Contact Content -->
<section class="section section--dark">
    <div class="container container--narrow">
        <div class="contact-grid">
            <!-- Contact Info -->
            <div class="contact-info reveal">
                <div class="contact-item">
                    <h3 class="contact-item__title"><?php esc_html_e('Email', 'soundroom'); ?></h3>
                    <a href="mailto:<?php echo antispambot(get_option('admin_email')); ?>" class="contact-item__link">
                        <?php echo antispambot(get_option('admin_email')); ?>
                    </a>
                </div>
                
                <div class="contact-item">
                    <h3 class="contact-item__title"><?php esc_html_e('Follow', 'soundroom'); ?></h3>
                    <div class="contact-socials">
                        <?php if ($youtube = get_theme_mod('soundroom_youtube')): ?>
                            <a href="<?php echo esc_url($youtube); ?>" target="_blank"><?php esc_html_e('YouTube', 'soundroom'); ?></a>
                        <?php endif; ?>
                        <?php if ($instagram = get_theme_mod('soundroom_instagram')): ?>
                            <a href="<?php echo esc_url($instagram); ?>" target="_blank"><?php esc_html_e('Instagram', 'soundroom'); ?></a>
                        <?php endif; ?>
                        <?php if ($twitter = get_theme_mod('soundroom_twitter')): ?>
                            <a href="<?php echo esc_url($twitter); ?>" target="_blank"><?php esc_html_e('Twitter', 'soundroom'); ?></a>
                        <?php endif; ?>
                        <?php if ($audiomack = get_theme_mod('soundroom_audiomack')): ?>
                            <a href="<?php echo esc_url($audiomack); ?>" target="_blank"><?php esc_html_e('Audiomack', 'soundroom'); ?></a>
                        <?php endif; ?>
                        <?php if ($spotify = get_theme_mod('soundroom_spotify')): ?>
                            <a href="<?php echo esc_url($spotify); ?>" target="_blank"><?php esc_html_e('Spotify', 'soundroom'); ?></a>
                        <?php endif; ?>
                    </div>
                </div>
                
                <div class="contact-item">
                    <h3 class="contact-item__title"><?php esc_html_e('For Artists', 'soundroom'); ?></h3>
                    <p class="contact-item__text">
                        <?php esc_html_e('Want to be featured on The Soundroom?', 'soundroom'); ?>
                    </p>
                    <a href="<?php echo esc_url(get_permalink(get_page_by_path('submit'))); ?>" class="btn btn--outline" style="margin-top: var(--space-sm);">
                        <?php esc_html_e('Submit / Be Featured', 'soundroom'); ?>
                    </a>
                </div>
            </div>
            
            <!-- Contact Form -->
            <div class="contact-form-wrapper reveal">
                <h3 class="form-title"><?php esc_html_e('Send a message', 'soundroom'); ?></h3>
                <form class="contact-form" id="contactForm">
                    <?php wp_nonce_field('soundroom_nonce', 'contact_nonce'); ?>
                    
                    <div class="form-group">
                        <label for="contact_name" class="form-label"><?php esc_html_e('Name', 'soundroom'); ?></label>
                        <input type="text" id="contact_name" name="name" class="form-input" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="contact_email" class="form-label"><?php esc_html_e('Email', 'soundroom'); ?></label>
                        <input type="email" id="contact_email" name="email" class="form-input" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="contact_subject" class="form-label"><?php esc_html_e('Subject', 'soundroom'); ?></label>
                        <select id="contact_subject" name="subject" class="form-select">
                            <option value="general"><?php esc_html_e('General Inquiry', 'soundroom'); ?></option>
                            <option value="press"><?php esc_html_e('Press / Media', 'soundroom'); ?></option>
                            <option value="booking"><?php esc_html_e('Booking', 'soundroom'); ?></option>
                            <option value="partnership"><?php esc_html_e('Partnership', 'soundroom'); ?></option>
                            <option value="other"><?php esc_html_e('Other', 'soundroom'); ?></option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="contact_message" class="form-label"><?php esc_html_e('Message', 'soundroom'); ?></label>
                        <textarea id="contact_message" name="message" class="form-textarea" rows="5" required></textarea>
                    </div>
                    
                    <div class="form-group">
                        <button type="submit" class="btn btn--primary"><?php esc_html_e('Send Message', 'soundroom'); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php
get_footer();
