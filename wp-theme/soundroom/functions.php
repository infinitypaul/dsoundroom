<?php
/**
 * The Soundroom Theme Functions
 *
 * @package Soundroom
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

define('SOUNDROOM_VERSION', '1.0.0');
define('SOUNDROOM_DIR', get_template_directory());
define('SOUNDROOM_URI', get_template_directory_uri());

/**
 * Theme Setup
 */
function soundroom_setup() {
    // Add theme support
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo', array(
        'height'      => 60,
        'width'       => 380,
        'flex-height' => true,
        'flex-width'  => true,
    ));
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));
    add_theme_support('customize-selective-refresh-widgets');
    add_theme_support('editor-styles');
    add_theme_support('wp-block-styles');
    add_theme_support('responsive-embeds');

    // Register navigation menus
    register_nav_menus(array(
        'primary'   => __('Primary Menu', 'soundroom'),
        'footer'    => __('Footer Menu', 'soundroom'),
        'social'    => __('Social Links', 'soundroom'),
    ));

    // Set content width
    if (!isset($content_width)) {
        $content_width = 1400;
    }

    // Add image sizes
    add_image_size('artist-card', 600, 800, true);
    add_image_size('artist-hero', 1920, 1080, true);
    add_image_size('session-thumbnail', 800, 450, true);
}
add_action('after_setup_theme', 'soundroom_setup');

/**
 * Enqueue Styles and Scripts
 */
function soundroom_scripts() {
    // Google Fonts
    wp_enqueue_style(
        'soundroom-fonts',
        'https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;1,300;1,400&family=Inter:wght@300;400;500;600&display=swap',
        array(),
        null
    );

    // Main stylesheet
    wp_enqueue_style(
        'soundroom-style',
        SOUNDROOM_URI . '/assets/css/style.css',
        array('soundroom-fonts'),
        SOUNDROOM_VERSION
    );

    // Main JavaScript
    wp_enqueue_script(
        'soundroom-scripts',
        SOUNDROOM_URI . '/assets/js/main.js',
        array(),
        SOUNDROOM_VERSION,
        true
    );

    // Localize script for AJAX
    wp_localize_script('soundroom-scripts', 'soundroom', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce'    => wp_create_nonce('soundroom_nonce'),
    ));
}
add_action('wp_enqueue_scripts', 'soundroom_scripts');

/**
 * Register Custom Post Type: Sessions (Artists)
 */
function soundroom_register_post_types() {
    // Sessions/Artists CPT
    register_post_type('session', array(
        'labels' => array(
            'name'               => __('Sessions', 'soundroom'),
            'singular_name'      => __('Session', 'soundroom'),
            'add_new'            => __('Add New Session', 'soundroom'),
            'add_new_item'       => __('Add New Session', 'soundroom'),
            'edit_item'          => __('Edit Session', 'soundroom'),
            'new_item'           => __('New Session', 'soundroom'),
            'view_item'          => __('View Session', 'soundroom'),
            'search_items'       => __('Search Sessions', 'soundroom'),
            'not_found'          => __('No sessions found', 'soundroom'),
            'not_found_in_trash' => __('No sessions found in trash', 'soundroom'),
            'menu_name'          => __('Sessions', 'soundroom'),
        ),
        'public'              => true,
        'has_archive'         => true,
        'rewrite'             => array('slug' => 'sessions'),
        'menu_icon'           => 'dashicons-microphone',
        'supports'            => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'show_in_rest'        => true,
        'publicly_queryable'  => true,
    ));

    // Genre/Vibe Taxonomy
    register_taxonomy('genre', 'session', array(
        'labels' => array(
            'name'              => __('Genres', 'soundroom'),
            'singular_name'     => __('Genre', 'soundroom'),
            'search_items'      => __('Search Genres', 'soundroom'),
            'all_items'         => __('All Genres', 'soundroom'),
            'edit_item'         => __('Edit Genre', 'soundroom'),
            'update_item'       => __('Update Genre', 'soundroom'),
            'add_new_item'      => __('Add New Genre', 'soundroom'),
            'new_item_name'     => __('New Genre Name', 'soundroom'),
            'menu_name'         => __('Genres', 'soundroom'),
        ),
        'hierarchical'       => true,
        'public'             => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_nav_menus'  => true,
        'show_in_rest'       => true,
        'show_admin_column'  => true,
        'show_in_quick_edit' => true,
        'rewrite'            => array('slug' => 'genre'),
    ));
}
add_action('init', 'soundroom_register_post_types');

/**
 * Register Sidebars/Widget Areas
 */
function soundroom_widgets_init() {
    register_sidebar(array(
        'name'          => __('Footer Widget Area', 'soundroom'),
        'id'            => 'footer-widgets',
        'description'   => __('Add widgets here to appear in your footer.', 'soundroom'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title footer__section-title">',
        'after_title'   => '</h4>',
    ));
}
add_action('widgets_init', 'soundroom_widgets_init');

/**
 * Custom Logo Output
 */
function soundroom_custom_logo() {
    if (has_custom_logo()) {
        the_custom_logo();
    } else {
        ?>
        <a href="<?php echo esc_url(home_url('/')); ?>" class="header__logo">
            <img src="<?php echo SOUNDROOM_URI; ?>/assets/images/logo-white.svg" alt="<?php bloginfo('name'); ?>">
        </a>
        <?php
    }
}

/**
 * Custom Walker for Primary Navigation
 */
class Soundroom_Nav_Walker extends Walker_Nav_Menu {
    public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        $classes = array('nav__link');
        
        if (in_array('current-menu-item', $item->classes) || in_array('current_page_item', $item->classes)) {
            $classes[] = 'nav__link--active';
        }

        $output .= sprintf(
            '<a href="%s" class="%s">%s</a>',
            esc_url($item->url),
            esc_attr(implode(' ', $classes)),
            esc_html($item->title)
        );
    }

    public function end_el(&$output, $item, $depth = 0, $args = null) {
        // No closing tag needed
    }

    public function start_lvl(&$output, $depth = 0, $args = null) {
        // No sub-menu wrapper
    }

    public function end_lvl(&$output, $depth = 0, $args = null) {
        // No sub-menu wrapper
    }
}

/**
 * Get Featured Sessions
 */
function soundroom_get_featured_sessions($count = 6) {
    return new WP_Query(array(
        'post_type'      => 'session',
        'posts_per_page' => $count,
        'meta_key'       => '_soundroom_featured',
        'meta_value'     => '1',
        'orderby'        => 'date',
        'order'          => 'DESC',
    ));
}

/**
 * Get Sessions by Genre
 */
function soundroom_get_sessions_by_genre($genre_slug, $count = -1) {
    return new WP_Query(array(
        'post_type'      => 'session',
        'posts_per_page' => $count,
        'tax_query'      => array(
            array(
                'taxonomy' => 'genre',
                'field'    => 'slug',
                'terms'    => $genre_slug,
            ),
        ),
    ));
}

/**
 * ACF Options Page (if ACF is active)
 */
if (function_exists('acf_add_options_page')) {
    acf_add_options_page(array(
        'page_title' => __('Theme Settings', 'soundroom'),
        'menu_title' => __('Soundroom Settings', 'soundroom'),
        'menu_slug'  => 'soundroom-settings',
        'capability' => 'edit_posts',
        'redirect'   => false,
        'icon_url'   => 'dashicons-microphone',
    ));
}

/**
 * Newsletter Form Handler
 */
function soundroom_newsletter_handler() {
    check_ajax_referer('soundroom_nonce', 'nonce');
    
    $email = sanitize_email($_POST['email']);
    
    if (!is_email($email)) {
        wp_send_json_error(array('message' => 'Please enter a valid email address.'));
    }
    
    // Here you would integrate with your email service (Mailchimp, etc.)
    // For now, we'll just store it as a custom option
    $subscribers = get_option('soundroom_subscribers', array());
    $subscribers[] = array(
        'email' => $email,
        'date'  => current_time('mysql'),
    );
    update_option('soundroom_subscribers', $subscribers);
    
    wp_send_json_success(array('message' => 'Welcome to The Soundroom!'));
}
add_action('wp_ajax_soundroom_newsletter', 'soundroom_newsletter_handler');
add_action('wp_ajax_nopriv_soundroom_newsletter', 'soundroom_newsletter_handler');

/**
 * Session Submission Form Handler
 */
function soundroom_submission_handler() {
    check_ajax_referer('soundroom_nonce', 'nonce');
    
    $data = array(
        'name'         => sanitize_text_field($_POST['name']),
        'email'        => sanitize_email($_POST['email']),
        'phone'        => sanitize_text_field($_POST['phone']),
        'location'     => sanitize_text_field($_POST['location']),
        'genre'        => sanitize_text_field($_POST['genre']),
        'music_links'  => sanitize_textarea_field($_POST['music_links']),
        'social_links' => sanitize_textarea_field($_POST['social_links']),
        'intent'       => sanitize_textarea_field($_POST['intent']),
        'song'         => sanitize_textarea_field($_POST['song']),
        'source'       => sanitize_text_field($_POST['source']),
        'date'         => current_time('mysql'),
    );
    
    // Store submission
    $submissions = get_option('soundroom_submissions', array());
    $submissions[] = $data;
    update_option('soundroom_submissions', $submissions);
    
    // Send notification email
    $admin_email = get_option('admin_email');
    $subject = '[DSoundRoom] New Session Submission: ' . $data['name'];
    $message = "New artist submission received!\n\n";
    $message .= "=================================\n\n";
    foreach ($data as $key => $value) {
        if (!empty($value)) {
            $message .= ucfirst(str_replace('_', ' ', $key)) . ":\n" . $value . "\n\n";
        }
    }
    $message .= "=================================\n";
    $message .= "Reply directly to: " . $data['email'] . "\n";
    
    // Simple headers - let WordPress handle From address
    $headers = array('Reply-To: ' . $data['name'] . ' <' . $data['email'] . '>');
    
    $mail_sent = wp_mail($admin_email, $subject, $message, $headers);
    
    // Log email result for debugging
    if (!$mail_sent) {
        error_log('Soundroom: Failed to send submission email to ' . $admin_email);
    } else {
        error_log('Soundroom: Submission email sent successfully to ' . $admin_email);
    }
    
    wp_send_json_success(array('message' => 'Application received! We\'ll be in touch.'));
}
add_action('wp_ajax_soundroom_submission', 'soundroom_submission_handler');
add_action('wp_ajax_nopriv_soundroom_submission', 'soundroom_submission_handler');

/**
 * Contact Form Handler
 */
function soundroom_contact_handler() {
    check_ajax_referer('soundroom_nonce', 'nonce');
    
    $data = array(
        'name'    => sanitize_text_field($_POST['name']),
        'email'   => sanitize_email($_POST['email']),
        'subject' => sanitize_text_field($_POST['subject']),
        'message' => sanitize_textarea_field($_POST['message']),
        'date'    => current_time('mysql'),
    );
    
    // Store contact message
    $contacts = get_option('soundroom_contacts', array());
    $contacts[] = $data;
    update_option('soundroom_contacts', $contacts);
    
    // Send notification email
    $admin_email = get_option('admin_email');
    $email_subject = '[DSoundRoom] Contact: ' . ucfirst($data['subject']) . ' from ' . $data['name'];
    $email_message = "New contact message received!\n\n";
    $email_message .= "=================================\n\n";
    $email_message .= "From: " . $data['name'] . "\n";
    $email_message .= "Email: " . $data['email'] . "\n";
    $email_message .= "Subject: " . ucfirst($data['subject']) . "\n\n";
    $email_message .= "Message:\n" . $data['message'] . "\n\n";
    $email_message .= "=================================\n";
    $email_message .= "Reply directly to: " . $data['email'] . "\n";
    
    // Simple headers - let WordPress handle From address
    $headers = array('Reply-To: ' . $data['name'] . ' <' . $data['email'] . '>');
    
    $mail_sent = wp_mail($admin_email, $email_subject, $email_message, $headers);
    
    // Log email result for debugging
    if (!$mail_sent) {
        error_log('Soundroom: Failed to send contact email to ' . $admin_email);
    } else {
        error_log('Soundroom: Contact email sent successfully to ' . $admin_email);
    }
    
    wp_send_json_success(array('message' => 'Message sent! We\'ll get back to you soon.'));
}
add_action('wp_ajax_soundroom_contact', 'soundroom_contact_handler');
add_action('wp_ajax_nopriv_soundroom_contact', 'soundroom_contact_handler');

/**
 * AJAX handler for infinite scroll sessions
 */
function soundroom_load_more_sessions() {
    $page = isset($_POST['page']) ? absint($_POST['page']) : 1;
    $filter = isset($_POST['filter']) ? sanitize_text_field($_POST['filter']) : 'all';
    $per_page = 9;
    
    $args = array(
        'post_type'      => 'session',
        'posts_per_page' => $per_page,
        'paged'          => $page,
        'orderby'        => 'date',
        'order'          => 'DESC',
        'post_status'    => 'publish',
    );
    
    // Add genre filter if not 'all'
    if ($filter !== 'all' && !empty($filter)) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'genre',
                'field'    => 'slug',
                'terms'    => $filter,
            ),
        );
    }
    
    $query = new WP_Query($args);
    $html = '';
    
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            
            $session_genres = get_the_terms(get_the_ID(), 'genre');
            $genre_classes = array();
            $genre_names = array();
            
            if ($session_genres && !is_wp_error($session_genres)) {
                foreach ($session_genres as $g) {
                    $genre_classes[] = $g->slug;
                    $genre_names[] = $g->name;
                }
            }
            
            $thumbnail = '';
            if (has_post_thumbnail()) {
                $thumbnail = get_the_post_thumbnail(get_the_ID(), 'artist-card', array('class' => 'artist-card__image'));
            } else {
                $thumbnail = '<div class="artist-card__placeholder"></div>';
            }
            
            $tags_html = '';
            foreach (array_slice($genre_names, 0, 2) as $name) {
                $tags_html .= '<span class="tag">' . esc_html($name) . '</span>';
            }
            
            $html .= sprintf(
                '<a href="%s" class="artist-card reveal" data-genre="%s">
                    %s
                    <div class="artist-card__overlay">
                        <h3 class="artist-card__name">%s</h3>
                        <div class="artist-card__tags">%s</div>
                    </div>
                </a>',
                esc_url(get_permalink()),
                esc_attr(implode(' ', $genre_classes)),
                $thumbnail,
                esc_html(get_the_title()),
                $tags_html
            );
        }
        wp_reset_postdata();
    }
    
    // Calculate max pages for this filter
    $count_args = array(
        'post_type'      => 'session',
        'posts_per_page' => -1,
        'post_status'    => 'publish',
        'fields'         => 'ids',
    );
    
    if ($filter !== 'all' && !empty($filter)) {
        $count_args['tax_query'] = array(
            array(
                'taxonomy' => 'genre',
                'field'    => 'slug',
                'terms'    => $filter,
            ),
        );
    }
    
    $total_query = new WP_Query($count_args);
    $total_posts = $total_query->found_posts;
    $max_pages = ceil($total_posts / $per_page);
    
    wp_send_json_success(array(
        'html'       => $html,
        'max_pages'  => $max_pages,
        'total'      => $total_posts,
        'has_more'   => $page < $max_pages,
    ));
}
add_action('wp_ajax_soundroom_load_more', 'soundroom_load_more_sessions');
add_action('wp_ajax_nopriv_soundroom_load_more', 'soundroom_load_more_sessions');

/**
 * Add body classes
 */
function soundroom_body_classes($classes) {
    if (is_singular('session')) {
        $classes[] = 'single-session';
    }
    if (is_post_type_archive('session')) {
        $classes[] = 'archive-session';
    }
    return $classes;
}
add_filter('body_class', 'soundroom_body_classes');

/**
 * Customize excerpt length
 */
function soundroom_excerpt_length($length) {
    return 25;
}
add_filter('excerpt_length', 'soundroom_excerpt_length');

/**
 * Customize excerpt more
 */
function soundroom_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'soundroom_excerpt_more');

/**
 * Theme Customizer - Social Links & Settings
 */
function soundroom_customize_register($wp_customize) {
    // Add Soundroom Settings Section
    $wp_customize->add_section('soundroom_social', array(
        'title'    => __('Soundroom Social Links', 'soundroom'),
        'priority' => 30,
    ));

    // YouTube
    $wp_customize->add_setting('soundroom_youtube', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('soundroom_youtube', array(
        'label'   => __('YouTube Channel URL', 'soundroom'),
        'section' => 'soundroom_social',
        'type'    => 'url',
    ));

    // Instagram
    $wp_customize->add_setting('soundroom_instagram', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('soundroom_instagram', array(
        'label'   => __('Instagram URL', 'soundroom'),
        'section' => 'soundroom_social',
        'type'    => 'url',
    ));

    // Audiomack
    $wp_customize->add_setting('soundroom_audiomack', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('soundroom_audiomack', array(
        'label'   => __('Audiomack URL', 'soundroom'),
        'section' => 'soundroom_social',
        'type'    => 'url',
    ));

    // Spotify
    $wp_customize->add_setting('soundroom_spotify', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('soundroom_spotify', array(
        'label'   => __('Spotify URL', 'soundroom'),
        'section' => 'soundroom_social',
        'type'    => 'url',
    ));

    // Twitter
    $wp_customize->add_setting('soundroom_twitter', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('soundroom_twitter', array(
        'label'   => __('Twitter/X URL', 'soundroom'),
        'section' => 'soundroom_social',
        'type'    => 'url',
    ));

    // Add Homepage Settings Section
    $wp_customize->add_section('soundroom_homepage', array(
        'title'    => __('Soundroom Homepage', 'soundroom'),
        'priority' => 31,
    ));

    // Hero Headline
    $wp_customize->add_setting('soundroom_headline', array(
        'default'           => 'A room for authentic sound.',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('soundroom_headline', array(
        'label'   => __('Hero Headline', 'soundroom'),
        'section' => 'soundroom_homepage',
        'type'    => 'text',
    ));

    // Hero Subline
    $wp_customize->add_setting('soundroom_subline', array(
        'default'           => 'Intimate live sessions that strip back the noise and let the music breathe. Worship. Soul. Acoustic. Spoken word. Every genre, one feeling—real.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('soundroom_subline', array(
        'label'   => __('Hero Subline', 'soundroom'),
        'section' => 'soundroom_homepage',
        'type'    => 'textarea',
    ));
}
add_action('customize_register', 'soundroom_customize_register');

/**
 * Helper function to get theme mod with fallback to option
 */
function soundroom_get_option($key, $default = '') {
    $value = get_theme_mod($key, '');
    if (empty($value)) {
        $value = get_option($key, $default);
    }
    return $value;
}

/**
 * Add Admin Menu for Submissions
 */
function soundroom_admin_menu() {
    add_menu_page(
        __('Soundroom', 'soundroom'),
        __('Soundroom', 'soundroom'),
        'manage_options',
        'soundroom-submissions',
        'soundroom_submissions_page',
        'dashicons-format-audio',
        30
    );
    
    add_submenu_page(
        'soundroom-submissions',
        __('Artist Submissions', 'soundroom'),
        __('Submissions', 'soundroom'),
        'manage_options',
        'soundroom-submissions',
        'soundroom_submissions_page'
    );
    
    add_submenu_page(
        'soundroom-submissions',
        __('Contact Messages', 'soundroom'),
        __('Messages', 'soundroom'),
        'manage_options',
        'soundroom-contacts',
        'soundroom_contacts_page'
    );
    
    add_submenu_page(
        'soundroom-submissions',
        __('Newsletter Subscribers', 'soundroom'),
        __('Subscribers', 'soundroom'),
        'manage_options',
        'soundroom-subscribers',
        'soundroom_subscribers_page'
    );
}
add_action('admin_menu', 'soundroom_admin_menu');

/**
 * Submissions Admin Page
 */
function soundroom_submissions_page() {
    $submissions = get_option('soundroom_submissions', array());
    $submissions = array_reverse($submissions); // Show newest first
    ?>
    <div class="wrap">
        <h1><?php esc_html_e('Artist Submissions', 'soundroom'); ?></h1>
        
        <?php if (empty($submissions)): ?>
            <p><?php esc_html_e('No submissions yet.', 'soundroom'); ?></p>
        <?php else: ?>
            <p><?php printf(__('Total submissions: %d', 'soundroom'), count($submissions)); ?></p>
            <table class="wp-list-table widefat fixed striped">
                <thead>
                    <tr>
                        <th><?php esc_html_e('Date', 'soundroom'); ?></th>
                        <th><?php esc_html_e('Artist Name', 'soundroom'); ?></th>
                        <th><?php esc_html_e('Email', 'soundroom'); ?></th>
                        <th><?php esc_html_e('Location', 'soundroom'); ?></th>
                        <th><?php esc_html_e('Genre', 'soundroom'); ?></th>
                        <th><?php esc_html_e('Music Links', 'soundroom'); ?></th>
                        <th><?php esc_html_e('Intent', 'soundroom'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($submissions as $sub): ?>
                        <tr>
                            <td><?php echo esc_html($sub['date'] ?? 'N/A'); ?></td>
                            <td><strong><?php echo esc_html($sub['name'] ?? ''); ?></strong></td>
                            <td><a href="mailto:<?php echo esc_attr($sub['email'] ?? ''); ?>"><?php echo esc_html($sub['email'] ?? ''); ?></a></td>
                            <td><?php echo esc_html($sub['location'] ?? ''); ?></td>
                            <td><?php echo esc_html($sub['genre'] ?? ''); ?></td>
                            <td><?php echo wp_kses_post(nl2br($sub['music_links'] ?? '')); ?></td>
                            <td><?php echo esc_html(substr($sub['intent'] ?? '', 0, 100)) . '...'; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
    <?php
}

/**
 * Contacts Admin Page
 */
function soundroom_contacts_page() {
    $contacts = get_option('soundroom_contacts', array());
    $contacts = array_reverse($contacts);
    ?>
    <div class="wrap">
        <h1><?php esc_html_e('Contact Messages', 'soundroom'); ?></h1>
        
        <?php if (empty($contacts)): ?>
            <p><?php esc_html_e('No contact messages yet.', 'soundroom'); ?></p>
        <?php else: ?>
            <p><?php printf(__('Total messages: %d', 'soundroom'), count($contacts)); ?></p>
            <table class="wp-list-table widefat fixed striped">
                <thead>
                    <tr>
                        <th><?php esc_html_e('Date', 'soundroom'); ?></th>
                        <th><?php esc_html_e('Name', 'soundroom'); ?></th>
                        <th><?php esc_html_e('Email', 'soundroom'); ?></th>
                        <th><?php esc_html_e('Subject', 'soundroom'); ?></th>
                        <th><?php esc_html_e('Message', 'soundroom'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($contacts as $contact): ?>
                        <tr>
                            <td><?php echo esc_html($contact['date'] ?? 'N/A'); ?></td>
                            <td><strong><?php echo esc_html($contact['name'] ?? ''); ?></strong></td>
                            <td><a href="mailto:<?php echo esc_attr($contact['email'] ?? ''); ?>"><?php echo esc_html($contact['email'] ?? ''); ?></a></td>
                            <td><?php echo esc_html(ucfirst($contact['subject'] ?? '')); ?></td>
                            <td><?php echo esc_html($contact['message'] ?? ''); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
    <?php
}

/**
 * Subscribers Admin Page
 */
function soundroom_subscribers_page() {
    $subscribers = get_option('soundroom_subscribers', array());
    $subscribers = array_reverse($subscribers);
    ?>
    <div class="wrap">
        <h1><?php esc_html_e('Newsletter Subscribers', 'soundroom'); ?></h1>
        
        <?php if (empty($subscribers)): ?>
            <p><?php esc_html_e('No subscribers yet.', 'soundroom'); ?></p>
        <?php else: ?>
            <p><?php printf(__('Total subscribers: %d', 'soundroom'), count($subscribers)); ?></p>
            
            <h3><?php esc_html_e('Export Emails', 'soundroom'); ?></h3>
            <textarea class="large-text" rows="5" readonly><?php 
                $emails = array_column($subscribers, 'email');
                echo esc_textarea(implode(', ', $emails));
            ?></textarea>
            <p class="description"><?php esc_html_e('Copy these emails to import into Mailchimp, ConvertKit, etc.', 'soundroom'); ?></p>
            
            <h3><?php esc_html_e('All Subscribers', 'soundroom'); ?></h3>
            <table class="wp-list-table widefat fixed striped">
                <thead>
                    <tr>
                        <th><?php esc_html_e('Date', 'soundroom'); ?></th>
                        <th><?php esc_html_e('Email', 'soundroom'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($subscribers as $sub): ?>
                        <tr>
                            <td><?php echo esc_html($sub['date'] ?? 'N/A'); ?></td>
                            <td><a href="mailto:<?php echo esc_attr($sub['email'] ?? ''); ?>"><?php echo esc_html($sub['email'] ?? ''); ?></a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
    <?php
}
