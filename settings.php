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
 * Plugin settings.
 *
 * @package    theme_wpchild
 * @copyright  2023 Mikel Martín <mikel@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or late
 */

defined('MOODLE_INTERNAL') || die;

if ($ADMIN->fulltree) {

    // Raw SCSS to include before the content.
    $setting = new admin_setting_scsscode('theme_wpchild/scsspre', get_string('rawscsspre', 'theme_wpchild'),
        get_string('rawscsspre_desc', 'theme_wpchild'), '', PARAM_RAW);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settings->add($setting);

    // Raw SCSS to include after the content.
    $setting = new admin_setting_scsscode('theme_wpchild/scss', get_string('rawscss', 'theme_wpchild'),
        get_string('rawscss_desc', 'theme_wpchild'), '', PARAM_RAW);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settings->add($setting);
}
