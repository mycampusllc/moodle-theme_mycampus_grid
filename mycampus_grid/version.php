<?php
/**
 * Moodle's mycampus_grid theme, an example of how to make a Bootstrap theme
 *
 * DO NOT MODIFY THIS THEME!
 *
 *
 * For full information about creating Moodle themes, see:
 * http://docs.moodle.org/dev/Themes_2.0
 *
 * @package   theme_mycampus_grid
 * @copyright Mycampus LLC
 * @website   http://www.mycampus.us
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

$plugin->version   = 2015101410;
$plugin->requires  = 2014050800;
$plugin->maturity = MATURITY_STABLE;
$plugin->release = '2.9.1 (Build: 2015062410)';
$plugin->component = 'theme_mycampus_grid';
$plugin->dependencies = array(
    'theme_bootstrapbase'  => 2014050800,
);
