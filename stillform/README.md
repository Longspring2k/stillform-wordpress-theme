# Stillform 1.1.0

Stillform is a classic WordPress portfolio theme for an architecture or interior studio. It uses locally bundled photography, native WordPress content, system fonts, and responsive editorial layouts. No build step or external runtime asset service is required.

## Theme features

- Native `project` post type and project-type taxonomy
- Editable block-editor content for pages, projects and journal posts
- Custom logo, featured images, primary and footer menu locations
- Responsive navigation, skip link and reduced-motion support
- Theme palette and typography settings in `theme.json`
- Contact email editable at **Appearance → Customize → Stillform contact**
- Email links only; Stillform does not include or simulate a contact form

## Install

1. Upload a ZIP whose root directory is `stillform/` at **Appearance → Themes → Add New → Upload Theme**.
2. Activate Stillform.
3. Configure the contact address at **Appearance → Customize → Stillform contact**.
4. Create your own content, or explicitly opt into the bundled demonstration content.

Activation does not create posts, upload media, alter menus, or change site options.

## Optional demo installer

Open **Appearance → Stillform demo** and read the warning before selecting **Install or refresh demo content**. The installer is packaged inside the theme; no outside seed script is required.

It creates five pages, four fictional projects, three fictional journal posts, eight media attachments from bundled images, and a demo navigation menu. It assigns the demo Home page as the static front page and assigns the menu to the primary and footer locations. Those are deliberate changes to content and site/theme options.

Each created post, attachment and menu item carries Stillform ownership metadata. A second run refreshes only those owned records. If arbitrary existing content already uses a demo slug, it is preserved without modification and omitted from demo-owned navigation. The installer never runs on activation.

The project-root `setup-demo.php` is only a WP-CLI wrapper around this bundled installer. It refuses to activate the theme or alter unrelated identity, permalink, or timezone settings.

## Content policy

Stillform, its projects, people, locations and journal writing are fictional demonstration content. Replace them before representing a real practice. Bundled photographs are licensed demonstration images and must not be presented as work designed by Stillform or by the site owner.

The default `studio@example.com` is a placeholder. Change it in the Customizer before launch. There is no fake form or hidden submission behavior.

## Images and fonts

Eight JPEG files are bundled under `assets/images/architecture/`, so pages do not fetch images from Unsplash at runtime. Original Unsplash image URLs and license information are recorded in `assets/images/PROVENANCE.md`; imported attachments also receive source and license metadata.

The theme uses system font stacks: Georgia/Times New Roman for serif display text and Arial/Helvetica for sans-serif text. It does not request Google Fonts or bundle font files.

## Verified local environment

Development and visual verification use the included Docker site with WordPress 7.1.0, PHP 8.3 and MySQL 8.4. PHP syntax is checked inside that WordPress container. The theme requires WordPress 6.6 or later and PHP 8.0 or later.

## Development

No build step is required. Main styles are in `assets/css/`, scripts in `assets/js/site.js`, setup in `inc/setup.php`, and the reusable opt-in demo installer in `inc/sample-content.php` with data in `inc/demo-data.php`. Theme code is GPL-2.0-or-later; see `LICENSE`.