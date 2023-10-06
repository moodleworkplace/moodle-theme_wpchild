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

use theme_wpchild\manager;

/**
 * Implementation of $THEME->scss
 *
 * @param \theme_config $theme The theme config object.
 * @return string
 */
function theme_wpchild_get_main_scss_content($theme) {
    global $CFG;

    $scss = '';

    // Load Workplace child specific scss variables (loaded first to override Workplace and LMS variables).
    $scss .= file_get_contents($CFG->dirroot . '/theme/wpchild/scss/variables.scss');

    // Special tenant SCSS added by this theme.
    $scss .= manager::get_custom_scss($theme);

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
    \theme_workplace\manager::alter_css_urls($urls);
}

/**
 * Get inital SCSS for the theme.
 *
 * @param theme_config $theme The theme config object.
 * @return string
 */
function theme_wpchild_get_pre_scss($theme) {
    $scss = '';
    // Prepend pre-scss.
    if (!empty($theme->settings->scsspre)) {
        $scss .= $theme->settings->scsspre;
    }
    return $scss;
}

/**
 * Inject additional SCSS.
 *
 * @param theme_config $theme The theme config object.
 * @return string
 */
function theme_wpchild_get_extra_scss($theme) {
    $scss = '';
    $scss .= manager::get_custom_scss($theme);
    // Append extra-scss.
    if (!empty($theme->settings->scss)) {
        $scss .= $theme->settings->scss;
    }
    return $scss;
}

/**
 * Add extra element to tenant branding settings.
 * {@see \tool_tenant\form\edit_css_form::definition()}
 *
 * @param tool_tenant\form\edit_css_form $form
 * @param MoodleQuickForm $mform
 * @param array $ajaxformdata
 *
 */
function theme_wpchild_extend_tenant_edit_css_form(tool_tenant\form\edit_css_form $form, MoodleQuickForm $mform,
        array $ajaxformdata): void {
    $filemanageroptions = [
        'accepted_types' => ['web_image'],
        'maxbytes' => 0,
        'subdirs' => 0,
        'maxfiles' => 1,
    ];
    $mform->addElement('filemanager', 'pattern', get_string('backgroundpattern', 'theme_wpchild'), '', $filemanageroptions);
}

/**
 * Callback for tenant get css config.
 * {@see \tool_tenant\manager::get_css_config()}
 *
 * @param array $info
 * @param int $tenantid
 * @param array $filemanageroptions
 */
function theme_wpchild_tenant_get_css_config(array &$info, int $tenantid, array $filemanageroptions): void {
    $filemanageroptions = [
        'accepted_types' => ['web_image'],
        'maxbytes' => 0,
        'subdirs' => 0,
        'maxfiles' => 1,
    ];
    $context = \context_system::instance();
    $draftitemid = \file_get_submitted_draft_itemid('pattern');
    \file_prepare_draft_area($draftitemid, $context->id, 'theme_wpchild', 'pattern', $tenantid, $filemanageroptions);
    $info['pattern'] = $draftitemid;
}

/**
 * Callback for tenant get css config.
 * {@see \tool_tenant\form\edit_css_form::process_dynamic_submission()}
 *
 * @param stdClass $data
 */
function theme_wpchild_process_tenant_edit_css_requests(stdClass $data): void {
    file_save_draft_area_files($data->pattern, \context_system::instance()->id, 'theme_wpchild', 'pattern', $data->tenantid);
    unset($data->pattern);
}

/**
 * Serves files.
 *
 * @param stdClass $course
 * @param stdClass $cm
 * @param context $context
 * @param string $filearea
 * @param array $args
 * @param bool $forcedownload
 * @return bool|null false if file not found, does not return anything if found - just send the file
 */
function theme_wpchild_pluginfile($course, $cm, $context, $filearea, $args, $forcedownload) {
    global $CFG;

    require_once($CFG->libdir . '/filelib.php');
    if ($filearea === 'pattern') {
        $relativepath = implode('/', $args);
        $fullpath = '/' . $context->id . '/theme_wpchild/' . $filearea . '/' . $relativepath;
        $fs = get_file_storage();
        if (!($file = $fs->get_file_by_hash(sha1($fullpath))) || $file->is_directory()) {
            return false;
        }
        send_stored_file($file, 0, 0, $forcedownload);
    }
}
