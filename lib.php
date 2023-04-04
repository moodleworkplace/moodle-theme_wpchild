<?php
// This file is part of the theme_wpchild plugin for Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Callbacks.
 *
 * @package    theme_wpchild
 * @copyright  2023 Mikel Martín <mikel@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or late
 */

/**
 * Implementation of $THEME->scss
 *
 * @param theme_config $theme The theme config object.
 * @return string
 */
function theme_wpchild_get_main_scss_content($theme) {
    global $CFG;

    $scss = '';

    // Load Workplace child specific scss variables (loaded first to override Workplace and LMS variables).
    $scss .= file_get_contents($CFG->dirroot . '/theme/wpchild/scss/variables.scss');

    // Add Workplace SCSS.
    $scss .= theme_workplace_get_main_scss_content($theme);

    // Load Workplace child scss.
    $scss .= file_get_contents($CFG->dirroot . '/theme/wpchild/scss/default.scss');

    return $scss;
}

/**
 * Allows to modify URL and cache file for the theme CSS for the tenants
 * Note: This callback is required to add per-tenant styles.
 *
 * @param moodle_url[] $urls
 */
function theme_wpchild_alter_css_urls(&$urls) {
    \theme_workplace\manager::alter_css_urls($urls, 'wpchild');
}

/**
 * Get inital SCSS for the theme.
 *
 * @param theme_config $theme The theme config object.
 * @return string
 */
function theme_wpchild_get_pre_scss($theme) {
    return '';
}

/**
 * Inject additional SCSS.
 *
 * @param theme_config $theme The theme config object.
 * @return string
 */
function theme_wpchild_get_extra_scss($theme) {
    return '';
}
