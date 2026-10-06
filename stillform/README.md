# Stillform

Stillform is an original, responsive classic WordPress theme for architecture and interior studios. Its visual system uses warm ivory, charcoal and ochre, editorial typography, generous rhythm and original geometric SVG illustrations.

## Native WordPress features

- Editable page and post content in the block editor
- Custom logo, primary/footer menus, featured images and wide alignment
- Global palette and typography controls through `theme.json`
- Responsive navigation, keyboard escape behavior, skip link and reduced-motion support
- Templates for front page, pages, posts, archives, journal index and 404
- Five optional starter pages: Home, Studio, Projects, Journal and Contact

## Install

1. Download `stillform-1.0.0.zip` from the GitHub release.
2. In WordPress, open **Appearance → Themes → Add New → Upload Theme**.
3. Upload the ZIP, install and activate it.
4. Assign menus at **Appearance → Menus** and optionally set a logo.

## Optional sample content

Nothing is created automatically on activation. To opt in, open **Appearance → Stillform setup** and select **Create sample pages**. The tool creates Home, Studio, Projects, Journal and Contact only when a same-title page does not already exist, preserves existing pages, and sets the created/found Home page as the static front page.

The Contact page contains an email link only. It does **not** fake form submission. Replace the sample address or add a trusted form plugin.

## Assets and license provenance

- Theme PHP, CSS, JavaScript, copy and SVG artwork were created originally for Stillform.
- No stock photographs or third-party image assets are bundled.
- Runtime web fonts are DM Sans and Gloock, requested from Google Fonts. Both are distributed under the SIL Open Font License; the font files are not bundled.
- Theme code is licensed under GPL-2.0-or-later. See `LICENSE`.

## Checks performed on 2026-10-07

- PHP 8.3 syntax lint: all 11 PHP files passed.
- JavaScript syntax: `node --check` passed.
- `theme.json`: parsed successfully as JSON.
- Static policy check: five named starter pages present; setup is explicit opt-in; no activation hook mutates content.
- WordPress core 7.1.3 downloaded and the theme copied into its native `wp-content/themes` directory.
- PHP built-in server reached WordPress and returned HTTP 500 because no MySQL/database service is available in the execution environment; full browser testing against an installed WordPress site remains a gap.
- Installable ZIP integrity test passed with all 21 theme files at the time of packaging; release packaging is regenerated after documentation updates.
- Desktop and mobile design previews were rendered and captured from the actual theme stylesheet and original SVG hero artwork.

## Development

No build step is required. Edit PHP templates, `assets/css/global.css`, `assets/css/editor.css`, `assets/js/site.js`, or `theme.json`, then install the theme directory or package it as a ZIP whose root folder is `stillform/`.
