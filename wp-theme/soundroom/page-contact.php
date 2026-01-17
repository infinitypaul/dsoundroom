<?php
/**
 * Template Name: Contact Page
 *
 * @package Soundroom
 */

get_header();
?>

<!-- Contact Hero -->
<section class="contact-hero">
    <div class="container">
        <div class="reveal">
            <span class="section__eyebrow"><?php esc_html_e('Contact', 'soundroom'); ?></span>
            <h1 class="section__title"><?php esc_html_e("Let's connect", 'soundroom'); ?></h1>
        </div>
    </div>
</section>

<!-- Contact Content -->
<section class="section section--dark" style="padding-top: 0;">
    <div class="container">
        <div class="contact-content">
            <!-- Contact Info -->
            <div class="contact-info reveal">
                <div>
                    <h2 class="contact-info__title"><?php esc_html_e('Get in touch', 'soundroom'); ?></h2>
                    <p class="contact-info__text">
                        <?php esc_html_e("For collaborations, press inquiries, or just to say hello—we'd love to hear from you.", 'soundroom'); ?>
                    </p>
                </div>
                
                <div>
                    <p class="text-muted" style="font-size: var(--text-sm); margin-bottom: var(--space-xs);"><?php esc_html_e('Email', 'soundroom'); ?></p>
                    <a href="mailto:<?php echo esc_attr(antispambot(get_option('admin_email'))); ?>" class="contact-info__email">
                        <?php echo antispambot(get_option('admin_email')); ?>
                    </a>
                </div>
                
                <div>
                    <p class="text-muted" style="font-size: var(--text-sm); margin-bottom: var(--space-xs);"><?php esc_html_e('Location', 'soundroom'); ?></p>
                    <p style="font-size: var(--text-lg);"><?php esc_html_e('Lagos, Nigeria', 'soundroom'); ?></p>
                </div>
                
                <div>
                    <p class="text-muted" style="font-size: var(--text-sm); margin-bottom: var(--space-sm);"><?php esc_html_e('Follow us', 'soundroom'); ?></p>
                    <div class="contact-socials">
                        <?php if ($youtube = get_theme_mod('soundroom_youtube')): ?>
                            <a href="<?php echo esc_url($youtube); ?>" target="_blank" aria-label="YouTube">
                                <svg viewBox="0 0 24 24" fill="currentColor"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                            </a>
                        <?php endif; ?>
                        <?php if ($instagram = get_theme_mod('soundroom_instagram')): ?>
                            <a href="<?php echo esc_url($instagram); ?>" target="_blank" aria-label="Instagram">
                                <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                            </a>
                        <?php endif; ?>
                        <?php if ($twitter = get_theme_mod('soundroom_twitter')): ?>
                            <a href="<?php echo esc_url($twitter); ?>" target="_blank" aria-label="Twitter">
                                <svg viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                            </a>
                        <?php endif; ?>
                        <?php if ($audiomack = get_theme_mod('soundroom_audiomack')): ?>
                            <a href="<?php echo esc_url($audiomack); ?>" target="_blank" aria-label="Audiomack">
                                <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 0C5.372 0 0 5.372 0 12s5.372 12 12 12 12-5.372 12-12S18.628 0 12 0zm5.5 17.5c-.276 0-.5-.224-.5-.5v-10c0-.276.224-.5.5-.5s.5.224.5.5v10c0 .276-.224.5-.5.5zm-3 1c-.276 0-.5-.224-.5-.5V6c0-.276.224-.5.5-.5s.5.224.5.5v12c0 .276-.224.5-.5.5zm-3 0c-.276 0-.5-.224-.5-.5V6c0-.276.224-.5.5-.5s.5.224.5.5v12c0 .276-.224.5-.5.5zm-3-1c-.276 0-.5-.224-.5-.5v-10c0-.276.224-.5.5-.5s.5.224.5.5v10c0 .276-.224.5-.5.5zm-3-2c-.276 0-.5-.224-.5-.5v-6c0-.276.224-.5.5-.5s.5.224.5.5v6c0 .276-.224.5-.5.5z"/></svg>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="divider" style="width: 100%; background-color: var(--color-dark-gray);"></div>

                <div>
                    <p class="text-muted" style="font-size: var(--text-sm);">
                        <strong><?php esc_html_e('For artist submissions:', 'soundroom'); ?></strong><br>
                        <?php 
                        printf(
                            esc_html__('Please use our %s instead of emailing directly.', 'soundroom'),
                            '<a href="' . esc_url(get_permalink(get_page_by_path('submit'))) . '" style="color: var(--color-accent);">' . esc_html__('submission form', 'soundroom') . '</a>'
                        );
                        ?>
                    </p>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="reveal">
                <form class="form" id="contactForm">
                    <?php wp_nonce_field('soundroom_nonce', 'contact_nonce'); ?>
                    
                    <div class="form-group">
                        <label for="name" class="form-label"><?php esc_html_e('Your Name', 'soundroom'); ?> *</label>
                        <input type="text" id="name" name="name" class="form-input" required placeholder="<?php esc_attr_e('Full name', 'soundroom'); ?>">
                    </div>

                    <div class="form-group">
                        <label for="email" class="form-label"><?php esc_html_e('Email Address', 'soundroom'); ?> *</label>
                        <input type="email" id="email" name="email" class="form-input" required placeholder="<?php esc_attr_e('your@email.com', 'soundroom'); ?>">
                    </div>

                    <div class="form-group">
                        <label for="subject" class="form-label"><?php esc_html_e('Subject', 'soundroom'); ?> *</label>
                        <select id="subject" name="subject" class="form-select" required>
                            <option value="" disabled selected><?php esc_html_e('What is this regarding?', 'soundroom'); ?></option>
                            <option value="collaboration"><?php esc_html_e('Collaboration / Partnership', 'soundroom'); ?></option>
                            <option value="press"><?php esc_html_e('Press / Media Inquiry', 'soundroom'); ?></option>
                            <option value="sponsorship"><?php esc_html_e('Sponsorship', 'soundroom'); ?></option>
                            <option value="general"><?php esc_html_e('General Question', 'soundroom'); ?></option>
                            <option value="feedback"><?php esc_html_e('Feedback', 'soundroom'); ?></option>
                            <option value="other"><?php esc_html_e('Other', 'soundroom'); ?></option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="message" class="form-label"><?php esc_html_e('Message', 'soundroom'); ?> *</label>
                        <textarea id="message" name="message" class="form-textarea" required placeholder="<?php esc_attr_e("Tell us what's on your mind...", 'soundroom'); ?>" style="min-height: 180px;"></textarea>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn--primary">
                            <?php esc_html_e('Send Message', 'soundroom'); ?>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php
get_footer();
