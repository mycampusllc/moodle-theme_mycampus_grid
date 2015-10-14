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

$THEME->name = 'mycampus_grid';

/////////////////////////////////
// The only thing you need to change in this file when copying it to
// create a new theme is the name above. You also need to change the name
// in version.php and lang/en/theme_mycampus_grid.php as well.
//////////////////////////////////
//
$THEME->doctype = 'html5';
$THEME->maturity = MATURITY_STABLE;
$THEME->parents = array('bootstrapbase');
$THEME->sheets	= array('custom');
$THEME->supportscssoptimisation = false;
$THEME->yuicssmodules	= array();
$THEME->enable_dock		= true;
$THEME->editor_sheets	= array();

$THEME->rendererfactory = 'theme_overridden_renderer_factory';
$THEME->csspostprocess	= 'theme_mycampus_grid_process_css';

$THEME->blockrtlmanipulations = array(
    'side-pre' => 'side-post',
    'side-post' => 'side-pre'
);

$THEME->layouts = array(
    'frontpage' => array(
        'file' => 'columns0.php',
        'regions' => array('side-pre', 'side-post'),
        'defaultregion' => 'side-pre',
        'options' => array('nonavbar' => false),
    ),

);
