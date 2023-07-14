# Workplace child theme example (theme_wpchild)

This plugin is an example of a child theme for the Workplace theme (`theme_workplace`) used in
**Moodle Workplace** product. It is intended to be used as a starting point for creating your own
theme based on Workplace theme.

## Requirements

This plugin is open-source but it can only be used with Workplace product and it requires
Workplace theme to be installed. Supported versions:

- Moodle Workplace 4.1 with the build date no earlier than 2023-07-17 (4.1.4+ or 4.1.4+ Rolling).
- Any version of Moodle Workplace 4.2.

## Features

Features introduced in this plugin are added to demonstrate the possibilities only, they may not have
any practical use.

- Functions `theme_wpchild_extend_tenant_edit_css_form()`, `theme_wpchild_tenant_get_css_config()`
  `theme_wpchild_process_tenant_edit_css_requests()` in `lib.php` implement respective callbacks
  from `tool_tenant` and allow to extend the tenant Branding form and adds a file manager
  element for the Background image.
- Class `\tool_wpchild\manager` contains functions that actually add this background image
  to the tenant CSS. These functions are called from the standard callbacks for theme plugins
  `theme_wpchild_get_main_scss_content()` and `theme_wpchild_alter_css_urls()`.
- Folder `scss/` contains scss files that add the background image and change the fonts.
- File `settings.php` defines the settings `theme_wpchild/scsspre` and `theme_wpchild/scss` similar
  to how Workplace theme defines them.

## Using theme_wpchild to create a new Workplace theme

- Copy the folder `/theme/wpchild/` to a new folder `/theme/newtheme/` where `newtheme` is your theme name.
- Inside the new folder rename the file `lang/en/theme_wpchild.php` to `lang/en/theme_newtheme.php`.
- Search `wpchild` in the all folder files and replace with `newtheme`.
- Now you can install this theme and start modifying settings, callbacks and scss files to implement
  your theme features.
- Substitute `pix/screenshot.jpg` with your own image.
- Remove or replace files `README.md` and `CHANGELOG.md` since they describe
  the features and changes in the `theme_wpchild` plugin.
- Remove file `.gitlab-ci.yml` unless you also use GitLab CI
  for continuous integration and testing.
