<?php
/**
 * Moodle's mycampus_1 theme, an example of how to make a Bootstrap theme
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

// Get the HTML for the settings bits.


$html = theme_mycampus_grid_get_html_for_settings($OUTPUT, $PAGE);

$left = 0;  // To know if to add 'pull-right' and 'desktop-first-column' classes in the layout for LTR.
echo $OUTPUT->doctype() ?>
<html <?php echo $OUTPUT->htmlattributes(); ?>>
<head>
    <title><?php echo $OUTPUT->page_title(); ?></title>
    <link rel="shortcut icon" href="<?php echo $OUTPUT->favicon(); ?>" />
    <?php echo $OUTPUT->standard_head_html() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body <?php echo $OUTPUT->body_attributes('two-column'); ?>>

<?php echo $OUTPUT->standard_top_of_body_html() ?>

<header role="banner" class="navbar navbar-fixed-top<?php echo $html->navbarclass ?> moodle-has-zindex">
    <nav role="navigation" class="navbar-inner">
        <div class="container-fluid">
            <a class="brand" href="<?php echo $CFG->wwwroot;?>"><?php echo $SITE->shortname; ?></a>
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <div class="nav-collapse collapse">
                <?php echo $OUTPUT->custom_menu(); ?>
                <ul class="nav pull-right">
                    <li><?php echo $OUTPUT->page_heading_menu(); ?></li>
                    <li class="navbar-text"><?php echo $OUTPUT->login_info() ?></li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<div id="page" class="container-fluid">

    <header id="page-header" class="clearfix">
        <?php echo $html->heading; ?>
        <div id="page-navbar" class="clearfix">
            <nav class="breadcrumb-nav"><?php echo $OUTPUT->navbar(); ?></nav>
            <div class="breadcrumb-button"><?php echo $OUTPUT->page_heading_button(); ?></div>
        </div>
        <div id="course-header">
            <?php echo $OUTPUT->course_header(); ?>
        </div>
    </header>

    <div id="page-content" class="row-fluid">
        <table border='0' cellpadding='0' cellspacing='0' width=100%>
			<tr>
				<td valign=top>
					<?php
					echo $OUTPUT->course_content_header();
					echo $OUTPUT->main_content();
					//print "AAAAAAAAAAAAAAAAAAAAA";

					$courserenderer		= $PAGE->get_renderer('core', 'course');
					//echo $OUTPUT->box($courserenderer->course_search_form('', 'short'), 'mdl-align');
					echo $courserenderer->course_section_cm_list($SITE, $section);
					echo $courserenderer->course_section_add_cm_control($SITE, $section->section);
					$frontpage_categories_list = $courserenderer->frontpage_categories_list();
					$frontpage_categories_list = str_replace("course/index.php?categoryid=","index.php?action=mycampus_1_coursecontextgroup&groupid=",$frontpage_categories_list);
					print $frontpage_categories_list;

					echo $OUTPUT->course_content_footer();

					print "<BR>";
					mycampus_1_left_button($html);
					?>
				</td>
				<td valign=top>
				<?php

				$indexshowcoursenumber	= $html->indexshowcoursenumber;
				$adodbcacheseconds		= $html->adodbcacheseconds;
				//print $indexshowcoursenumber;exit;

				$action		= optional_param('action','', PARAM_TEXT);
				$id			= optional_param('id','', PARAM_TEXT);
				$groupid	= optional_param('groupid','', PARAM_TEXT);

				if($action=='coursecontextdetail'&&$id!="")			{
					mycampus_1_indexcoursedetailshow($html);
				}
				elseif($action=="mycampus_1_coursecontextgroup"&&$groupid!="")		{
					mycampus_1_coursecontextgroup($html);
				}
				elseif($action=="coursestatisticsall")		{
					require_once($CFG->dirroot .'/theme/mycampus_1/lib/mycampus_1_coursestatisticsall.php');
					mycampus_1_coursestatisticsall($html);
				}
				elseif($action=="coursestatistics")		{
					require_once($CFG->dirroot .'/theme/mycampus_1/lib/mycampus_1_coursestatistics.php');
					mycampus_1_coursestatistics($html);
				}
				elseif($action=="coursecategorystatistics")			{
					require_once($CFG->dirroot .'/theme/mycampus_1/lib/mycampus_1_coursecategorystatistics.php');
					mycampus_1_coursecategorystatistics($html);
				}
				elseif($action=="useraccessstatistics")		{
					require_once($CFG->dirroot .'/theme/mycampus_1/lib/mycampus_1_useraccessstatistics.php');
					mycampus_1_useraccessstatistics($html);
				}
				elseif($action=="pageaccessstatistics")		{
					require_once($CFG->dirroot .'/theme/mycampus_1/lib/mycampus_1_pageaccessstatistics.php');
					mycampus_1_pageaccessstatistics($html);
				}
				elseif($action=="activeteachersstatistics")		{
					require_once($CFG->dirroot .'/theme/mycampus_1/lib/mycampus_1_activeteachersstatistics.php');
					mycampus_1_activeteachersstatistics($html);
				}
				elseif($action=="activestudentsstatistics")		{
					require_once($CFG->dirroot .'/theme/mycampus_1/lib/mycampus_1_activestudentsstatistics.php');
					mycampus_1_activestudentsstatistics($html);
				}
				else	{
					mycampus_1_IndexMainCourseShow($html);
				}
				?>
				</td>
			</tr>
		</table>
    </div>

    <footer id="page-footer">
        <div id="course-footer"><?php echo $OUTPUT->course_footer(); ?></div>
        <p class="helplink"><?php echo $OUTPUT->page_doc_link(); ?></p>
        <?php
        echo $html->footer;
		//print '<p><a href="http://www.moodle360.cn" target="_blank">本皮肤由【单点魔灯】提供</a></p>';
        print '<p><a href="http://www.mycampus.us" target="_blank">[This skin supplied by MYCAMPUS LLC]</a></p>';
        echo $OUTPUT->login_info();
        echo $OUTPUT->home_link();
        echo $OUTPUT->standard_footer_html();
        ?>
    </footer>

    <?php echo $OUTPUT->standard_end_of_body_html() ?>

</div>
</body>
</html>
