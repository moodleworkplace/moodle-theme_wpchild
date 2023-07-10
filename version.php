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
 * Plugin version and other meta-data are defined here.
 *
 * @package    theme_wpchild
 * @copyright  2023 Mikel Martín <mikel@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or late
 */

defined('MOODLE_INTERNAL') || die();

// This plugin is part of Moodle Workplace product.
$plugin->component    = 'theme_wpchild';
$plugin->release      = '4.2dev';
$plugin->version      = 2023050400;
$plugin->requires     = 2022112804.00;
$plugin->maturity     = MATURITY_STABLE;
$plugin->dependencies = [
    'theme_workplace'     => 2023011141,
];
