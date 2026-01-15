# The Soundroom WordPress Theme

A premium, minimalist WordPress theme for **The Soundroom with Infinity Paul** - an intimate live-session platform.

## Installation

### Method 1: Upload via WordPress Admin

1. Zip the `soundroom` folder
2. Go to **Appearance → Themes → Add New → Upload Theme**
3. Upload the zip file and activate

### Method 2: FTP/SFTP

1. Upload the `soundroom` folder to `/wp-content/themes/`
2. Go to **Appearance → Themes** and activate

## After Activation

### 1. Create Required Pages

Create these pages and assign the correct templates:

| Page | Template |
|------|----------|
| Home | Set as static front page (Settings → Reading) |
| About | About Page |
| Submit | Submit Page |
| Contact | Contact Page |

### 2. Set Up Menus

Go to **Appearance → Menus** and create:

- **Primary Menu** - Assign to "Primary Menu" location
- **Footer Menu** - Assign to "Footer Menu" location

### 3. Add Sessions

Go to **Sessions → Add New** to create session entries.

Each session can have:
- **Featured Image** - Portrait orientation (600×800px recommended)
- **Genres** - Assign one or more genres
- **Content** - The story/intent text
- **Custom Fields** (see below)

### 4. Custom Fields for Sessions

The theme looks for these meta fields (works great with ACF):

| Field | Key | Type |
|-------|-----|------|
| YouTube URL | `youtube_url` | URL |
| Audiomack Embed | `audiomack_embed` | Textarea (iframe code) |
| Location | `location` | Text |
| Instagram | `instagram_url` | URL |
| Spotify | `spotify_url` | URL |
| Artist YouTube | `artist_youtube_url` | URL |
| Artist Audiomack | `artist_audiomack_url` | URL |
| Credits | `credits` | Repeater/Array |

### 5. Theme Settings

Add these options to your database or use a plugin like ACF Options:

```php
// In wp-admin or via code:
update_option('soundroom_youtube', 'https://youtube.com/@thesoundroom');
update_option('soundroom_instagram', 'https://instagram.com/thesoundroom');
update_option('soundroom_audiomack', 'https://audiomack.com/thesoundroom');
update_option('soundroom_spotify', 'https://open.spotify.com/...');
update_option('soundroom_headline', 'A room for authentic sound.');
update_option('soundroom_subline', 'Your custom tagline here...');
```

## Recommended Plugins

- **Advanced Custom Fields (ACF)** - For custom fields
- **ACF Extended** - Additional ACF features
- **Yoast SEO** - For meta tags and SEO
- **WP Super Cache** or **LiteSpeed Cache** - Caching

## Theme Structure

```
soundroom/
├── assets/
│   ├── css/
│   │   └── style.css          # Main stylesheet
│   ├── js/
│   │   └── main.js            # JavaScript
│   └── images/
│       ├── logo-white.svg
│       ├── logo-black.svg
│       └── favicon.svg
├── functions.php               # Theme setup & features
├── header.php                  # Header template
├── footer.php                  # Footer template
├── front-page.php             # Homepage template
├── index.php                  # Default archive
├── page.php                   # Default page template
├── page-about.php             # About page template
├── page-submit.php            # Submit page template
├── page-contact.php           # Contact page template
├── single-session.php         # Single session template
├── archive-session.php        # Sessions archive template
├── style.css                  # Theme info (required)
└── screenshot.png             # Theme preview image
```

## Customization

### Colors

Edit `assets/css/style.css` and update the CSS variables:

```css
:root {
  --color-black: #0a0a0a;
  --color-charcoal: #1a1a1a;
  --color-accent: #c9a96e;  /* Gold accent */
  /* ... */
}
```

### Fonts

The theme uses:
- **Cormorant Garamond** - Headlines
- **Inter** - Body text

## Support

For questions or customizations, contact the developer.

---

**© 2026 The Soundroom with Infinity Paul**
