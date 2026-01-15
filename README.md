# The Soundroom with Infinity Paul

A premium, minimalist website for an intimate live-session platform featuring artists across multiple genres.

## Overview

The Soundroom is a creative live-session platform that captures music in its most authentic form—raw, intimate, and real. This website serves as the digital home for the platform, showcasing featured sessions and inviting new artists to participate.

## Design Philosophy

- **Intimate & Cinematic**: Dark, moody aesthetic that feels like being in the room
- **Premium & Minimal**: Editorial typography, generous whitespace, subtle interactions
- **Genre-Agnostic**: Worship, Afro-soul, acoustic, spoken word, alternative—united by authenticity

## Pages

| Page | File | Description |
|------|------|-------------|
| Home | `index.html` | Hero, featured sessions, newsletter signup |
| Sessions | `sessions.html` | Artist directory with genre filters |
| Artist | `artist.html` | Individual session page template |
| About | `about.html` | Platform story and philosophy |
| Submit | `submit.html` | Artist submission form |
| Contact | `contact.html` | Contact information and form |

## File Structure

```
dsoundroom/
├── index.html
├── sessions.html
├── artist.html
├── about.html
├── submit.html
├── contact.html
├── css/
│   └── style.css
├── js/
│   └── main.js
├── assets/
│   ├── logo-white.svg
│   ├── logo-black.svg
│   ├── favicon.svg
│   └── images/
│       ├── hero-bg.jpg
│       └── artists/
│           ├── artist-01.jpg
│           ├── artist-01-hero.jpg
│           └── ...
└── README.md
```

## Setup

### Local Development

1. Clone or download the repository
2. Open `index.html` in your browser, or use a local server:

```bash
# Using Python
python -m http.server 8000

# Using Node.js
npx serve

# Using PHP
php -S localhost:8000
```

### WordPress Integration

This design is Gutenberg-friendly and can be integrated into WordPress:

1. **Theme Conversion**: Convert HTML templates to WordPress theme files
2. **Custom Post Type**: Create "Sessions" or "Artists" CPT
3. **ACF Fields**: Use Advanced Custom Fields for artist data
4. **Block Patterns**: Convert sections to reusable block patterns

### Recommended WordPress Setup

- **Theme**: Custom theme or Flavor/flavor starter
- **Plugins**:
  - Advanced Custom Fields Pro
  - Custom Post Type UI (or code CPT)
  - WPForms or Gravity Forms (for submissions)
  - Yoast SEO
  - WP Rocket (caching)

## Assets Required

### Images

Replace placeholder images with actual photos:

| Image | Dimensions | Notes |
|-------|------------|-------|
| `hero-bg.jpg` | 1920x1080 | Dark, moody studio shot |
| `artist-XX.jpg` | 600x800 | Portrait, 3:4 ratio |
| `artist-XX-hero.jpg` | 1920x1080 | Wide shot for artist pages |

### Image Guidelines

- Style: Cinematic, intimate lighting
- Color: Warm blacks, slightly desaturated
- Format: JPG/WebP, optimized for web
- Quality: 80% compression is fine

## Fonts

The design uses:

- **Headlines**: Cormorant Garamond (Google Fonts)
- **Body**: Inter (Google Fonts)

Fonts are loaded via Google Fonts CDN. For better performance, consider self-hosting.

## Color Palette

```css
--color-black: #0a0a0a;
--color-charcoal: #1a1a1a;
--color-dark-gray: #2a2a2a;
--color-medium-gray: #4a4a4a;
--color-muted: #7a7a7a;
--color-light-gray: #e8e6e3;
--color-off-white: #f7f5f2;
--color-accent: #c9a96e; /* Warm gold */
```

## Browser Support

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)
- Mobile browsers (iOS Safari, Chrome for Android)

## Customization

### Adding New Artists

1. Duplicate `artist.html`
2. Rename to artist's name (e.g., `adaeze.html`)
3. Update content: name, tags, video embed, story, credits
4. Add artist card to `sessions.html` and `index.html`

### Updating Branding

1. Replace `logo-white.svg` and `logo-black.svg` with actual brand assets
2. Update `favicon.svg` with simplified mark
3. Adjust colors in `css/style.css` CSS variables

## Performance Tips

1. Optimize images (use WebP with JPG fallback)
2. Enable browser caching
3. Minify CSS/JS for production
4. Use lazy loading for artist grid images
5. Consider a CDN for static assets

## License

© 2026 The Soundroom with Infinity Paul. All rights reserved.

---

Built with care for authentic sound.
