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

namespace theme_wpchild;

use advanced_testcase;

/**
 * Class workplace testcase
 *
 * @package    theme_wpchild
 * @category   test
 * @copyright  2023 Mikel Martín <mikel@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or late
 */
class lib_test extends advanced_testcase {

    /**
     * Test theme_wpchild_get_main_scss_content
     *
     * @covers ::theme_wpchild_get_main_scss_content
     */
    public function test_theme_wpchild_get_main_scss_content(): void {
        global $THEME;

        $scss = theme_wpchild_get_main_scss_content($THEME);

        // Check generated SCSS is not empty.
        $this->assertNotEmpty($scss);
    }
}
