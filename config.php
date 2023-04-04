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
 * The configuration for theme_wpchild is defined here.
 *
 * @package    theme_wpchild
 * @copyright  2023 Mikel Martín <mikel@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or late
 */

defined('MOODLE_INTERNAL') || die();

require_once(__DIR__ . '/lib.php');

$THEME->name = 'wpchild';
$THEME->doctype = 'html5';
$THEME->parents = [
    'workplace',
    'boost',
];

$THEME->sheets = [];
$THEME->scss = function($theme) {
    return theme_wpchild_get_main_scss_content($theme);
};
$THEME->editor_sheets = [];
$THEME->usefallback = false;
$THEME->enable_dock = false;
$THEME->extrascsscallback = 'theme_wpchild_get_extra_scss';
$THEME->prescsscallback = 'theme_wpchild_get_pre_scss';
$THEME->precompiledcsscallback = 'theme_boost_get_precompiled_css';
$THEME->yuicssmodules = [];
$THEME->rendererfactory = 'theme_overridden_renderer_factory';
$THEME->requiredblocks = '';
$THEME->addblockposition = BLOCK_ADDBLOCK_POSITION_FLATNAV;
$THEME->iconsystem = \core\output\icon_system::FONTAWESOME;
$THEME->usescourseindex = true;
$THEME->haseditswitch = true;
$THEME->activityheaderconfig = [
    'notitle' => true
];

// Make sure the Site Home is not shown on the primary navigation.
$THEME->removedprimarynavitems = ['home'];

// Theme layouts.
$THEME->layouts = [];
