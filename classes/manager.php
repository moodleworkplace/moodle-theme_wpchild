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

namespace theme_wpchild;

/**
 * Manager class for theme wpchild.
 *
 * @package    theme_wpchild
 * @copyright  2023 Mikel Martín <mikel@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or late
 */
class manager {
    /**
     * Returns the logo css for the tenant.
     *
     * @param \tool_tenant\tenant $tenant
     * @param string $filename
     * @return string SCSS defining file variable.
     */
    protected static function get_tenant_scss_for_file(\tool_tenant\tenant $tenant, string $filename): string {
        $scss = '';

        $tenantid = $tenant->get('id');
        $fs = \get_file_storage();
        $contextid = \context_system::instance()->id;
        $files = $fs->get_area_files($contextid, 'theme_wpchild', $filename, $tenantid, 'itemid', false);
        $file = reset($files);
        if ($file && $file->is_valid_image()) {
            $url = \moodle_url::make_pluginfile_url(\context_system::instance()->id, 'theme_wpchild', $filename,
                    $tenantid, $file->get_filepath(), $file->get_filename());
            $scss .= '$' . $filename . ': "' . $url->out() . '";';
        }

        return $scss;
    }

    /**
     * Adds custom SCSS
     *
     * @param theme_config|null $theme
     * @return string
     */
    public static function get_custom_scss($theme): string {
        $tenantid = !empty($theme->settings->tenantid) ? $theme->settings->tenantid : 0;
        if (!$tenantid || !array_key_exists($tenantid, \tool_tenant\tenancy::get_tenants())
                || $tenantid == \tool_tenant\sharedspace::get_shared_space_id()) {
            $tenantid = \tool_tenant\tenancy::get_default_tenant_id();
        }
        $tenant = (new \tool_tenant\manager())->get_tenant($tenantid);

        $scss = '';
        $scss .= self::get_tenant_scss_for_file($tenant, 'pattern');
        return $scss;
    }
}
