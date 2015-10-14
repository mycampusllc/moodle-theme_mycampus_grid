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

function theme_mycampus_grid_process_css($css, $theme) {

    // Set the background image for the logo.
    $logo = $theme->setting_file_url('logo', 'logo');
    $css = theme_mycampus_grid_set_logo($css, $logo);

    // Set custom CSS.
    if (!empty($theme->settings->customcss)) {
        $customcss = $theme->settings->customcss;
    } else {
        $customcss = null;
    }
    $css = theme_mycampus_grid_set_customcss($css, $customcss);

    return $css;
}

/**
 * Adds the logo to CSS.
 *
 * @param string $css The CSS.
 * @param string $logo The URL of the logo.
 * @return string The parsed CSS
 */
function theme_mycampus_grid_set_logo($css, $logo) {
    $tag = '[[setting:logo]]';
    $replacement = $logo;
    if (is_null($replacement)) {
        $replacement = '';
    }

    $css = str_replace($tag, $replacement, $css);

    return $css;
}

/**
 * Serves any files associated with the theme settings.
 *
 * @param stdClass $course
 * @param stdClass $cm
 * @param context $context
 * @param string $filearea
 * @param array $args
 * @param bool $forcedownload
 * @param array $options
 * @return bool
 */
function theme_mycampus_grid_pluginfile($course, $cm, $context, $filearea, $args, $forcedownload, array $options = array()) {
    if ($context->contextlevel == CONTEXT_SYSTEM and $filearea === 'logo') {
        $theme = theme_config::load('mycampus_1');
        return $theme->setting_file_serve('logo', $args, $forcedownload, $options);
    } else {
        send_file_not_found();
    }
}

/**
 * Adds any custom CSS to the CSS before it is cached.
 *
 * @param string $css The original CSS.
 * @param string $customcss The custom CSS to add.
 * @return string The CSS which now contains our custom CSS.
 */
function theme_mycampus_grid_set_customcss($css, $customcss) {
    $tag = '[[setting:customcss]]';
    $replacement = $customcss;
    if (is_null($replacement)) {
        $replacement = '';
    }

    $css = str_replace($tag, $replacement, $css);

    return $css;
}

/**
 * Returns an object containing HTML for the areas affected by settings.
 *
 * Do not add mycampus_1 specific logic in here, child themes should be able to
 * rely on that function just by declaring settings with similar names.
 *
 * @param renderer_base $output Pass in $OUTPUT.
 * @param moodle_page $page Pass in $PAGE.
 * @return stdClass An object with the following properties:
 *      - navbarclass A CSS class to use on the navbar. By default ''.
 *      - heading HTML to use for the heading. A logo if one is selected or the default heading.
 *      - footnote HTML to use as a footnote. By default ''.
 */
function theme_mycampus_grid_get_html_for_settings(renderer_base $output, moodle_page $page) {
    global $CFG;
    $return = new stdClass;

    $return->navbarclass = '';
    if (!empty($page->theme->settings->invert)) {
        $return->navbarclass .= ' navbar-inverse';
    }

    if (!empty($page->theme->settings->logo)) {
        //$return->heading = html_writer::link($CFG->wwwroot, '', array('title' => get_string('home'), 'class' => 'logo'));
    } else {
        //$return->heading = $output->page_heading();
    }

    $return->footer = '';
    if (!empty($page->theme->settings->footer)) {
        $return->footer = '<div class="footnote text-center">'.$page->theme->settings->footer.'</div>';
    }

	$return->day30userinfor		= 0;
    if (!empty($page->theme->settings->day30userinfor)) {
        $return->day30userinfor = $page->theme->settings->day30userinfor;
    }

	$return->day30accessinfor	= 0;
    if (!empty($page->theme->settings->day30accessinfor)) {
        $return->day30accessinfor = $page->theme->settings->day30accessinfor;
    }

	$return->isshowcoursedescinfor	= 0;
    if (!empty($page->theme->settings->isshowcoursedescinfor)) {
        $return->isshowcoursedescinfor = $page->theme->settings->isshowcoursedescinfor;
    }

	$return->logo				= 0;
    if (!empty($page->theme->settings->logo)) {
        $return->logo = $page->theme->settings->logo;
    }

	$return->isshowlogo				= 0;
    if (!empty($page->theme->settings->isshowlogo)) {
        $return->isshowlogo = $page->theme->settings->isshowlogo;
    }

	$return->wonderfulcoursenumber				= 0;
    if (!empty($page->theme->settings->wonderfulcoursenumber)) {
        $return->wonderfulcoursenumber = $page->theme->settings->wonderfulcoursenumber;
    }

	$return->hotcourse							= 0;
    if (!empty($page->theme->settings->hotcourse)) {
        $return->hotcourse = $page->theme->settings->hotcourse;
    }

	$return->wonderfulcourse					= 0;
    if (!empty($page->theme->settings->wonderfulcourse)) {
        $return->wonderfulcourse = $page->theme->settings->wonderfulcourse;
    }

	$return->wonderfulcoursenumber				= 0;
    if (!empty($page->theme->settings->wonderfulcoursenumber)) {
        $return->wonderfulcoursenumber = $page->theme->settings->wonderfulcoursenumber;
    }

	$return->indexshowcoursenumber				= 4;
    if (!empty($page->theme->settings->indexshowcoursenumber)) {
        $return->indexshowcoursenumber = $page->theme->settings->indexshowcoursenumber;
    }

	$return->adodbcacheseconds					= 3600;
    if (!empty($page->theme->settings->adodbcacheseconds)) {
        $return->adodbcacheseconds = $page->theme->settings->adodbcacheseconds;
    }

	$return->coursestatistics						= 0;
    if (!empty($page->theme->settings->coursestatistics)) {
        $return->coursestatistics = $page->theme->settings->coursestatistics;
    }

	$return->coursecategorystatistics						= 0;
    if (!empty($page->theme->settings->coursecategorystatistics)) {
        $return->coursecategorystatistics = $page->theme->settings->coursecategorystatistics;
    }

	$return->useraccessstatistics						= 0;
    if (!empty($page->theme->settings->useraccessstatistics)) {
        $return->useraccessstatistics = $page->theme->settings->useraccessstatistics;
    }

	$return->activeteachersstatistics						= 0;
    if (!empty($page->theme->settings->activeteachersstatistics)) {
        $return->activeteachersstatistics = $page->theme->settings->activeteachersstatistics;
    }

	$return->activestudentsstatistics						= 0;
    if (!empty($page->theme->settings->activestudentsstatistics)) {
        $return->activestudentsstatistics = $page->theme->settings->activestudentsstatistics;
    }

	//print_R($return);exit;

    return $return;
}

/**
 * All theme functions should start with theme_mycampus_grid_
 * @deprecated since 2.5.1
 */
function mycampus_1_process_css() {
    throw new coding_exception('Please call theme_'.__FUNCTION__.' instead of '.__FUNCTION__);
}

/**
 * All theme functions should start with theme_mycampus_grid_
 * @deprecated since 2.5.1
 */
function mycampus_1_set_logo() {
    throw new coding_exception('Please call theme_'.__FUNCTION__.' instead of '.__FUNCTION__);
}

/**
 * All theme functions should start with theme_mycampus_grid_
 * @deprecated since 2.5.1
 */
function mycampus_1_set_customcss() {
    throw new coding_exception('Please call theme_'.__FUNCTION__.' instead of '.__FUNCTION__);
}


require_once($CFG->dirroot .'/config.php');
require_once($CFG->dirroot .'/lib/adodb/adodb.inc.php');
//print_R($_SERVER);
global $dbA,$adodbcacheseconds,$indexshowcoursenumber;

if($CFG->dbtype=="mariadb")		{
	$dbA=NewADOConnection('mysqli');
}
else	{
	$dbA=NewADOConnection($CFG->dbtype);
}

//处理端口不为3306的情况
$theme_mycampus_grid_dboptions = $CFG->dboptions;
if($theme_mycampus_grid_dboptions['dbport']!="")		{
	$dbA->Connect($CFG->dbhost.":".$theme_mycampus_grid_dboptions['dbport'],$CFG->dbuser,$CFG->dbpass,$CFG->dbname);
}
else	{
	$dbA->Connect($CFG->dbhost,$CFG->dbuser,$CFG->dbpass,$CFG->dbname);
}
$dbA->Execute("set names utf8;");
$dbA->Execute("set sql_mode='';");
$ADODB_FETCH_MODE	= ADODB_FETCH_ASSOC;
$ADODB_CACHE_DIR	= $CFG->cachedir.'/adodbcache';
if(!is_dir($ADODB_CACHE_DIR))		{
	mkdir($ADODB_CACHE_DIR);
}
//print_R($dbA);exit;


//判断初始化的参数是否在系统里面
$theme_name = 'theme_mycampus_grid';
$sql		= "select * from mdl_config_plugins where name='version' and plugin='$theme_name'";
$rs			= $dbA->Execute($sql);
$rs_a		= $rs->GetArray();
if($rs_a[0]['value']=='')		{
	$sql = "update mdl_config set value='7' where name='frontpage'";
	$dbA->Execute($sql);
	$sql = "update mdl_config set value='7' where name='frontpageloggedin'";
	$dbA->Execute($sql);
}


//mycampus_1_GetCourseTeacherNumber
function mycampus_1_GetCourseTeacherNumber($id)		{
	global $dbA,$adodbcacheseconds,$indexshowcoursenumber;
	$sql = "SELECT userid FROM mdl_role_assignments, mdl_context where  mdl_role_assignments.contextid=mdl_context.id and mdl_context.instanceid='$id' and mdl_role_assignments.roleid=3 limit 10";
	//echo $sql."<br>";
	$rs = $dbA->CacheExecute($adodbcacheseconds,$sql);
	$rs_a   = $rs->GetArray();
	$useridArray = array();
	for($i=0;$i<sizeof($rs_a);$i++)
	{
		$useridArray[]	= $rs_a[$i]['userid'];
	}

	if(count($useridArray)==0)		{
		return array();
	}
	else	{
		$sql = "SELECT firstname,lastname FROM mdl_user where id in ('".join("','",$useridArray)."')";
		//echo $sql."<br>";
		$rs = $dbA->CacheExecute($adodbcacheseconds,$sql);
		$rs_a   = $rs->GetArray();
		$老师信息	= array();;
		for($i=0;$i<sizeof($rs_a);$i++)
		{
			$老师信息[]	= $rs_a[$i]['firstname']." ".$rs_a[$i]['lastname'];
		}
		return $老师信息;
	}
}
//mycampus_1_GetCourseQuestionNumber
function mycampus_1_GetCourseQuestionNumber($id)		{
	global $dbA,$adodbcacheseconds,$indexshowcoursenumber;
	$sql	= "SELECT path FROM mdl_context WHERE contextlevel = '50' AND instanceid = '$id'";
	$rs		= $dbA->CacheExecute($adodbcacheseconds,$sql);
	$rs_a   = $rs->GetArray();
	$path	= $rs_a[0]['path'];
	$pathArray = explode('/',$path);
	@array_shift($pathArray);

	$sql	= "SELECT count(1) AS num FROM mdl_question WHERE hidden='0' AND parent='0' and category in (select id from mdl_question_categories WHERE contextid IN ('".@join("','",$pathArray)."'))";
	$rs		= $dbA->CacheExecute($adodbcacheseconds,$sql);
	$rs_a   = $rs->GetArray();
	$NUM	= $rs_a[0]['num'];
	return $NUM;
}

function mycampus_1_GetCourseEnrollmentStudentNumber($id)		{
	global $dbA,$adodbcacheseconds,$indexshowcoursenumber;
	$sql = "SELECT COUNT(userid) AS num FROM mdl_role_assignments, mdl_context where  mdl_role_assignments.contextid=mdl_context.id and mdl_context.instanceid='$id'";
	$rs = $dbA->CacheExecute($adodbcacheseconds,$sql);
	$rs_a   = $rs->GetArray();
	$NUM	= $rs_a[0]['num'];
	return $NUM;
}

function mycampus_1_GetCourseSectionNumber($id)		{
	global $dbA,$adodbcacheseconds,$indexshowcoursenumber;
	$sql = "select COUNT(*) AS num from `mdl_course_sections` where course = '$id' and name!=''";
	$rs = $dbA->CacheExecute($adodbcacheseconds,$sql);
	$rs_a   = $rs->GetArray();
	$NUM	= $rs_a[0]['num'];
	return $NUM;
}

function mycampus_1_GetCourseQuizNumber($id)		{
	global $dbA,$adodbcacheseconds,$indexshowcoursenumber;
	$sql = "select COUNT(*) AS num from mdl_quiz where course = '$id'";
	$rs = $dbA->CacheExecute($adodbcacheseconds,$sql);
	$rs_a   = $rs->GetArray();
	$NUM	= $rs_a[0]['num'];
	return $NUM;
}

function mycampus_1_GetCourseOneMouthActivesNumber($id)		{
	global $dbA,$adodbcacheseconds,$indexshowcoursenumber;
	$sql = "select COUNT(*) AS num from mdl_logstore_standard_log where courseid='$id'";
	$rs = $dbA->CacheExecute($adodbcacheseconds,$sql);
	$rs_a   = $rs->GetArray();
	$NUM	= $rs_a[0]['num'];
	return $NUM;
}


function mycampus_1_substr_for_utf8($sourcestr,$cutlength)
{
	$returnstr="";
	$i=0;
	$n=0;
	$str_length=strlen($sourcestr);    //字符串的字节数
	while (($n<$cutlength) and ($i<=$str_length))
	{
		$temp_str=substr($sourcestr,$i,1);
		$ascnum=Ord($temp_str); //得到字符串中第$i位字符的ascii码
		if ($ascnum>=224) //如果ASCII位高与224，
		{
			$returnstr=$returnstr.substr($sourcestr,$i,3); //根据UTF-8编码规范，将3个连续的字符计为单个字符
			$i=$i+3; //实际Byte计为3
			$n++; //字串长度计1
		}
		elseif ($ascnum>=192)//如果ASCII位高与192，
		{
			$returnstr=$returnstr.substr($sourcestr,$i,2); //根据UTF-8编码规范，将2个连续的字符计为单个字符
			$i=$i+2; //实际Byte计为2
			$n++; //字串长度计1
		}
		elseif ($ascnum>=65 && $ascnum<=90) //如果是大写字母，
		{
			$returnstr=$returnstr.substr($sourcestr,$i,1);
			$i=$i+1; //实际的Byte数仍计1个
			$n++; //但考虑整体美观，大写字母计成一个高位字符
		}
		else //其他情况下，包括小写字母和半角标点符号，
		{
			$returnstr=$returnstr.substr($sourcestr,$i,1);
			$i=$i+1;    //实际的Byte数计1个
			$n=$n+0.5;    //小写字母和半角标点等与半个高位字符宽…
		}
	}

	if ($str_length>$cutlength)
	{
		$returnstr = $returnstr;    //超过长度时在尾处加上省略号
	}

	return $returnstr;
}


function mycampus_1_objectToArray($rs_a)				{
	$rs_a		= array_values($rs_a);
	$rsNew_a	= array();
	for($i=0;$i<sizeof($rs_a);$i++)			{
		$rsNew_a[$i]	= (array)$rs_a[$i];
	}
    return $rsNew_a;
}

function mycampus_1_randpictice($id,$course='course')
{

	$CourseFile = "theme/mycampus_1/images/".$course."_".$id.".jpg";
	if(is_file($CourseFile))			{
		$returnCourseGroupImg = $CourseFile;
	}
	else	{
		$returnCourseGroupImg = "/theme/mycampus_1/images/".$course."_0000.jpg";
	}

	return $returnCourseGroupImg;
}

function mycampus_1_indexcoursedetailshow($html)		{
	global $dbA,$adodbcacheseconds,$indexshowcoursenumber;
	$indexshowcoursenumber	= $html->indexshowcoursenumber;
	$adodbcacheseconds		= $html->adodbcacheseconds;

	$id		= optional_param('id','', PARAM_TEXT);

	$sql = "select * from mdl_course where id='".$id."'";  //需要调整id回来
	//echo $adodbcacheseconds."<br>";exit;
	$rs = $dbA->CacheExecute($adodbcacheseconds,$sql);
	$rs_a   = $rs->GetArray();
	print "<table border='0' cellpadding='10' cellspacing='10'  width='100%'><tr><td>";
	//print $sql."<br>";
	//print "<tr class=''>";
	//print_R($rs_a);exit;
    //无内容输出提示($rs_a);
    $courseNUM = sizeof($rs_a);
	if($courseNUM==0)			{
		print "<table border='0' cellpadding='10' cellspacing='10'><tr width=500 higth=1000><td><font size='5' face='arial'>没有课程内容</font></td></tr></table>";
	}
	for($i=0;$i<$courseNUM;$i++)
	{
		$id			= $rs_a[$i]['id'];        // id
		$fullname	= $rs_a[$i]['fullname'];  //课程名称
		$summary	= $rs_a[$i]['summary'];   //课程简介
		$shortname  = $rs_a[$i]['shortname'];
		//echo $summary."<br>";
		$returnCourseGroupImg = mycampus_1_randpictice($id);
		//得到老师信息
		$mycampus_1_GetCourseTeacherNumber = mycampus_1_GetCourseTeacherNumber($id);
		mycampus_1__ReturnTableCourseYindaoye($html,$fullname,$summary,$returnCourseGroupImg,$id,$mycampus_1_GetCourseTeacherNumber,$shortname);
	}
	print "</td></tr></table>";
}


//返回课程引导页输出
function mycampus_1__ReturnTableCourseYindaoye($html,$fullname,$summary,$returnCourseGroupImg,$id,$mycampus_1_GetCourseTeacherNumber,$shortname)
{
	global $CFG,$dbA;
	global $dbA,$adodbcacheseconds,$indexshowcoursenumber;
	$indexshowcoursenumber	= $html->indexshowcoursenumber;
	$adodbcacheseconds		= $html->adodbcacheseconds;
	if($summary=="")
	{
		$summary = "抱歉，没有课程内容简介！";
	}
	$summary = preg_replace("/<img.+?\/>/", "", $summary);
	$summary = strip_tags($summary);
	$summary = "<p>$summary</p>";

	$mycampus_1_GetCourseTeacherNumber_TEXT = join(',',$mycampus_1_GetCourseTeacherNumber);
	print "<link rel=\"stylesheet\" type=\"text/css\" href=\"/theme/mycampus_1/style/style_4.css\" />";
	print "
				<script type=\"text/javascript\" src=\"/theme/mycampus_1/js/jquery-1.7.1.min.js\"></script>
				<script src=\"/theme/mycampus_1/js/highcharts/highcharts.js\"></script>
				<script src=\"/theme/mycampus_1/js/highcharts/modules/exporting.js\"></script>
				<style type=\"text/css\">
				${demo.css}
				</style>
				";
	echo "<br><font size='5' face='arial'>".$fullname."</font><br><br>";
	print "<table border='0' cellpadding='0' cellspacing='0' width='960'>";
	print "<tr><td width=15>&nbsp;</td><td width='80%'>".$summary."</td><td width='20%'><img border=0 title='$fullname' src='$returnCourseGroupImg' width=200 hight=300></a></td></tr>";
	print "<tr><td width=15>&nbsp;</td><td><BR>
		$shortname [教师:".$mycampus_1_GetCourseTeacherNumber_TEXT."]
		&nbsp;&nbsp;
		<a href='/course/view.php?id=".$id."' target='_self' class=\"dandian_enter\"><font color=red>点击进入学习</font></a>
		</td>";
	print "</tr>";
	print "<tr><td width='100%' colspan=3>&nbsp;&nbsp;";

	//最近30天访问量
	$timecreated = mktime(1,1,1,date('m'),date('d')-60,date('Y'));
	$sql = "select FROM_UNIXTIME(timecreated,'%m-%d') AS datetime,COUNT(*) AS num from mdl_logstore_standard_log where courseid='$id' and timecreated>='$timecreated' group by FROM_UNIXTIME(timecreated,'%m-%d') order by FROM_UNIXTIME(timecreated,'%m-%d') desc limit 30";
	$rs = $dbA->CacheExecute($adodbcacheseconds,$sql);
	$rs_a   = $rs->GetArray();
	$xAxis = $yAxis = array();
	for($i=sizeof($rs_a);$i>0;$i--)			{
		$ii = $i-1;
		$DATETIME	= $rs_a[$ii]['datetime'];
		$NUM		= $rs_a[$ii]['num'];
		$xAxis[]	= $DATETIME;
		$yAxis[]	= $NUM;
	}
	$xAxisText = join("','",$xAxis);
	$yAxisText = join(',',$yAxis);
	//print_R($rs_a);
	print "
			<script type=\"text/javascript\">
		$(function () {
			$('#container').highcharts({
				chart: {
					type: 'line'
				},
				title: {
					text: '',
					x: -2 //center
				},
				subtitle: {
					text: '【".$fullname."】最近30天访问量',
					x: -5
				},
				xAxis: {
					categories: ['$xAxisText']
				},
				yAxis: {
					title: {
						text: '每天访问量 ( 次 )'
					},
					plotLines: [{
						value: 0,
						width: 1,
						color: '#808080'
					}]
				},
				tooltip: {
					valueSuffix: '次'
				},
				plotOptions: {
					line: {
						dataLabels: {
							enabled: true
						},
						enableMouseTracking: false
					}
				},
				legend: {
					layout: 'vertical',
					align: 'right',
					verticalAlign: 'middle',
					borderWidth: 0
				},
				series: [{
					name: '访问量',
					color:'#0056CC',
					data: [$yAxisText]
				}]
			});
		});
		</script>
		</head>
		<body>
		<div id=\"container\" style=\"min-width: 810px; height: 300px; margin: 0 auto\"></div>
		";

	//每天活跃度用户数
	$timecreated = mktime(1,1,1,date('m'),date('d')-60,date('Y'));
	$sql = "select FROM_UNIXTIME(timecreated,'%m-%d') AS datetime,COUNT(distinct userid) AS num from mdl_logstore_standard_log where courseid='$id' and timecreated>'$timecreated' group by FROM_UNIXTIME(timecreated,'%m-%d') order by FROM_UNIXTIME(timecreated,'%m-%d') desc limit 15";
	$rs = $dbA->CacheExecute($adodbcacheseconds,$sql);
	$rs_a   = $rs->GetArray();
	$xAxis = $yAxis = array();
	for($i=sizeof($rs_a);$i>0;$i--)			{
		$ii = $i-1;
		$DATETIME	= $rs_a[$ii]['datetime'];
		$NUM		= $rs_a[$ii]['num'];
		$xAxis[]	= $DATETIME;
		$yAxis[]	= $NUM;
	}
	$xAxisText = join("','",$xAxis);
	$yAxisText = join(',',$yAxis);
	//print_R($rs_a);
	print "
			<script type=\"text/javascript\">
		$(function () {
			$('#container_userid').highcharts({
				chart: {
					type: 'column',
					margin: [ 50, 50, 100, 80]
				},
				title: {
					text: '',
					x: -2 //center
				},
				subtitle: {
					text: '【".$fullname."】每天活跃度用户数',
					x: -5
				},
				xAxis: {
					categories: ['$xAxisText']
				},
				yAxis: {
					title: {
						text: '每天活跃度用户数 ( 个 )'
					},
					plotLines: [{
						value: 0,
						width: 1,
						color: '#808080'
					}]
				},
				tooltip: {
					valueSuffix: '个'
				},
				plotOptions: {
					line: {
						dataLabels: {
							enabled: true
						},
						enableMouseTracking: false
					}
				},
				legend: {
					layout: 'vertical',
					align: 'right',
					verticalAlign: 'middle',
					borderWidth: 0
				},
				series: [{
					name: '活跃度用户数',
					color:'#CE443E',
					data: [$yAxisText]
				}]
			});
		});
		</script>
		</head>
		<body>
		<div id=\"container_userid\" style=\"min-width: 810px; height: 300px; margin: 0 auto\"></div>
		";

	//各模块访问量统计
	$sql = "select target AS datetime,COUNT(*) AS num from mdl_logstore_standard_log where courseid='$id' group by target order by target limit 15";
	$rs = $dbA->CacheExecute($adodbcacheseconds,$sql);
	$xAxis = $yAxis = array();
	$rs_a   = $rs->GetArray();
	for($i=0;$i<sizeof($rs_a);$i++)			{
		$DATETIME	= $rs_a[$i]['datetime'];
		$NUM		= $rs_a[$i]['num'];
		$xAxis[]	= $DATETIME;
		$yAxis[]	= $NUM;
	}
	$xAxisText = join("','",$xAxis);
	$yAxisText = join(',',$yAxis);
	//print_R($rs_a);
	print "
			<script type=\"text/javascript\">
		$(function () {
			$('#container_target').highcharts({
				chart: {
					type: 'line'
				},
				title: {
					text: '',
					x: -2 //center
				},
				subtitle: {
					text: '【".$fullname."】各模块访问量统计',
					x: -5
				},
				xAxis: {
					categories: ['$xAxisText']
				},
				yAxis: {
					title: {
						text: '各模块访问量统计 ( 次 )'
					},
					plotLines: [{
						value: 0,
						width: 1,
						color: '#808080'
					}]
				},
				tooltip: {
					valueSuffix: '次'
				},
				plotOptions: {
					line: {
						dataLabels: {
							enabled: true
						},
						enableMouseTracking: false
					}
				},
				legend: {
					layout: 'vertical',
					align: 'right',
					verticalAlign: 'middle',
					borderWidth: 0
				},
				series: [{
					name: '各模块访问量统计',
					color:'#22103B',
					data: [$yAxisText]
				}]
			});
		});
		</script>
		</head>
		<body>
		<div id=\"container_target\" style=\"min-width: 810px; height: 300px; margin: 0 auto\"></div>
		";
	print "</td></tr>";
	print "</table>";
	//color:'#22103B' #47A447
}


function mycampus_1_IndexMainCourseShow($html)			{
	global $dbA,$adodbcacheseconds,$indexshowcoursenumber;
	$indexshowcoursenumber	= $html->indexshowcoursenumber;
	$adodbcacheseconds		= $html->adodbcacheseconds;
	print "<link rel=\"stylesheet\" type=\"text/css\" href=\"/theme/mycampus_1/style/style_".$indexshowcoursenumber.".css\" />";
	//print_R($html);exit;
	if($html->isshowlogo)				{
		$logoArray = explode('/',$html->logo);
		$filename  = array_pop($logoArray);
		$sql			= "select * from mdl_files where component='theme_mycampus_grid' and filearea='logo' and filename='$filename'";
		//echo $sql."<br>";
		$rs				= $dbA->CacheExecute($adodbcacheseconds,$sql);
		$rs_a			= $rs->GetArray();
		$contenthash	= $rs_a[0]['contenthash'];
		$contextid		= $rs_a[0]['contextid'];
		$component		= $rs_a[0]['component'];
		$filearea		= $rs_a[0]['filearea'];
		$itemid			= $rs_a[0]['itemid'];
		$filename		= $rs_a[0]['filename'];
		if($contenthash!="")			{
			//pluginfile.php/1/theme_mycampus_grid/logo/0/logo.jpg
			$URL = "pluginfile.php/".$contextid."/".$component."/".$filearea."/".$itemid."/".$filename."";
		}
		else	{
			$URL = "/theme/mycampus_1/pix/logo.jpg";
		}
		print "<table border='0' cellpadding='0' cellspacing='0' width=960><tr><td align=center>";
		print "<div align=center><img src='".$URL."' border=0 width=920></div>";
		print "</td></tr></table>";//exit;
	}

	$coursestatistics_teachername			= get_string('coursestatistics_teachername', 'theme_mycampus_grid');
	$coursestatistics_users					= get_string('coursestatistics_users', 'theme_mycampus_grid');
	$coursestatistics_sections				= get_string('coursestatistics_sections', 'theme_mycampus_grid');
	$coursestatistics_quizs					= get_string('coursestatistics_quizs', 'theme_mycampus_grid');
	$coursestatistics_questions				= get_string('coursestatistics_questions', 'theme_mycampus_grid');
	$coursestatistics_actives				= get_string('coursestatistics_actives', 'theme_mycampus_grid');
	$wonderfulcourse						= get_string('wonderfulcourse', 'theme_mycampus_grid');
	$wonderfulcoursedesc					= get_string('wonderfulcoursedesc', 'theme_mycampus_grid');
	$hotcourse								= get_string('hotcourse', 'theme_mycampus_grid');
	$hotcoursedesc							= get_string('hotcoursedesc', 'theme_mycampus_grid');



	//精品课程
	if($html->wonderfulcourse&&$html->wonderfulcoursenumber!="")				{
		$精品课程id = explode(',',$html->wonderfulcoursenumber);
		$sql	= "select * from mdl_course where id IN ('".join("','",$精品课程id)."') and id>1 limit $indexshowcoursenumber";
		//echo $sql."<br>";
		$rs		= $dbA->CacheExecute($adodbcacheseconds,$sql);
		$rs_a   = $rs->GetArray();
		$CourseInforArray_ARRAY = array();
		for($i=0;$i<sizeof($rs_a);$i++)
		{
			$id			= $rs_a[$i]['id'];
			$fullname	= $rs_a[$i]['fullname'];
			$summary	= $rs_a[$i]['summary'];
			$CourseInforArray_ARRAY['id'][] = $id;
			$CourseInforArray_ARRAY['fullname'][] = $fullname;
			$CourseInforArray_ARRAY['summary'][] = $summary;
			$CourseInforArray_ARRAY['CourseCategoryName'][] = "";
		}

		print "<table border='0' cellpadding='0' cellspacing='0' width=960><tr><td>";
		print "<div class=\"dandian_wrap dandian_clearfix\">
			  <h2 title='$wonderfulcoursedesc'>$wonderfulcourse</h2>
			  <ul class=\"dandian_clearfix\">";

		for($i=0;$i<sizeof($CourseInforArray_ARRAY['id']);$i++)
		{
			$id			= $CourseInforArray_ARRAY['id'][$i];
			$fullname	= $CourseInforArray_ARRAY['fullname'][$i];
			$summary	= $CourseInforArray_ARRAY['summary'][$i];
			$CourseCategoryNameShowText	= $CourseInforArray_ARRAY['CourseCategoryName'][$i];

			$mycampus_1_GetCourseEnrollmentStudentNumber	= mycampus_1_GetCourseEnrollmentStudentNumber($id);
			$mycampus_1_GetCourseQuestionNumber			= mycampus_1_GetCourseQuestionNumber($id);
			$mycampus_1_GetCourseQuizNumber				= mycampus_1_GetCourseQuizNumber($id);
			$mycampus_1_GetCourseSectionNumber				= mycampus_1_GetCourseSectionNumber($id);
			$mycampus_1_GetCourseOneMouthActivesNumber		= mycampus_1_GetCourseOneMouthActivesNumber($id);
			$mycampus_1_GetCourseTeacherNumber				= mycampus_1_GetCourseTeacherNumber($id);

			$CourseNameShowText					= mycampus_1_substr_for_utf8($fullname,10);

			$returnCourseGroupImg				= mycampus_1_randpictice($id);
			$USER_OJB = $_SESSION['USER'];
			if($USER_OJB->username=='admin')		{
				$indexpage_uploadimagebuttontitle	= get_string("indexpage_uploadimagebuttontitle","theme_mycampus_grid");
				$indexpage_uploadimagebuttonname	= get_string("indexpage_uploadimagebuttonname","theme_mycampus_grid");
				$CourseEdingHtmlInfor = "
					<input type=file name=uploadFile size=4 title='$indexpage_uploadimagebuttontitle'>
					<input type=submit name=submit value='$indexpage_uploadimagebuttonname' title='$indexpage_uploadimagebuttontitle'>
					";
			}
			else	{
				$CourseEdingHtmlInfor = "";
			}

			if($html->isshowcoursedescinfor)		{
				$CourseURL = "?action=coursecontextdetail&id=$id";
			}
			else	{
				$CourseURL = "/course/view.php?id=$id";
			}

			print "
			<form name=form_".$id." action=\"?action=imagesetting&id=$id&time=".time()."\" method=post encType=multipart/form-data>
				<li>
				  <div class=\"dandian_info\"> <img src=\"$returnCourseGroupImg\" />
					<div class=\"dandian_text\">
					  <p>".$coursestatistics_teachername.": ".join(',',$mycampus_1_GetCourseTeacherNumber)."</p>
					  <p>".$coursestatistics_users.": $mycampus_1_GetCourseEnrollmentStudentNumber</p>
					  <p>".$coursestatistics_sections.": $mycampus_1_GetCourseSectionNumber</p>
					  <p>".$coursestatistics_quizs.": $mycampus_1_GetCourseQuizNumber</p>
					  <p>".$coursestatistics_questions.": $mycampus_1_GetCourseQuestionNumber</p>
					  <p>".$coursestatistics_actives.": $mycampus_1_GetCourseOneMouthActivesNumber</p>
					</div>
				  </div>
				  <BR>
				  <a href=\"$CourseURL\" class=\"dandian_enter\" title='$fullname'>$CourseNameShowText</a>
				  $CourseEdingHtmlInfor
				</li>
			</form>
					  ";

		}
		print "</ul>
				</div>";
		print "</td></tr></table>";
	}

	if($html->hotcourse)				{
		//热门课程
		$timecreated = mktime(1,1,1,date('m'),date('d')-60,date('Y'));
		$sql	= "select courseid,COUNT(*) AS num from mdl_logstore_standard_log where courseid>1 and timecreated>'$timecreated' group by courseid order by COUNT(*) desc limit $indexshowcoursenumber";
		$rs		= $dbA->CacheExecute($adodbcacheseconds,$sql);
		$rs_a   = $rs->GetArray();
		//print_R($sql);
		$COURSEid_ARRAY = array();
		for($i=0;$i<sizeof($rs_a);$i++)		{
			if($rs_a[$i]['courseid']>1)		{
				$COURSEid_ARRAY[]	= $rs_a[$i]['courseid'];
				$courseid			= $rs_a[$i]['courseid'];
				$mycampus_1_GetCourseOneMouthActivesNumberALL[$courseid] = $rs_a[$i]['num'];
			}
		}

		$sql = "select * from mdl_course where id in ('".join("','",$COURSEid_ARRAY)."') limit $indexshowcoursenumber";
		//echo $sql."<br>";
		$rs = $dbA->CacheExecute($adodbcacheseconds,$sql);
		$rs_a   = $rs->GetArray();
		$CourseInforArray_ARRAY = array();
		for($i=0;$i<sizeof($rs_a);$i++)
		{
			$id			= $rs_a[$i]['id'];
			$fullname	= $rs_a[$i]['fullname'];
			$summary	= $rs_a[$i]['summary'];
			$CourseInforArray_ARRAY['id'][] = $id;
			$CourseInforArray_ARRAY['fullname'][] = $fullname;
			$CourseInforArray_ARRAY['summary'][] = $summary;
			$CourseInforArray_ARRAY['CourseCategoryName'][] = "";
		}
		//print_R($rs_a);

		print "<table border='0' cellpadding='0' cellspacing='0' width=960><tr><td>";
		print "<div class=\"dandian_wrap dandian_clearfix\">
			  <h2 title='$hotcoursedesc'>$hotcourse</h2>
			  <ul class=\"dandian_clearfix\">";

		for($i=0;$i<sizeof($CourseInforArray_ARRAY['id']);$i++)
		{
			$id			= $CourseInforArray_ARRAY['id'][$i];
			$fullname	= $CourseInforArray_ARRAY['fullname'][$i];
			$summary	= $CourseInforArray_ARRAY['summary'][$i];
			$CourseCategoryNameShowText	= $CourseInforArray_ARRAY['CourseCategoryName'][$i];

			$mycampus_1_GetCourseEnrollmentStudentNumber	= mycampus_1_GetCourseEnrollmentStudentNumber($id);
			$mycampus_1_GetCourseQuestionNumber			= mycampus_1_GetCourseQuestionNumber($id);
			$mycampus_1_GetCourseQuizNumber				= mycampus_1_GetCourseQuizNumber($id);
			$mycampus_1_GetCourseSectionNumber				= mycampus_1_GetCourseSectionNumber($id);
			$mycampus_1_GetCourseOneMouthActivesNumber		= $mycampus_1_GetCourseOneMouthActivesNumberALL[$id];
			$mycampus_1_GetCourseTeacherNumber				= mycampus_1_GetCourseTeacherNumber($id);

			$CourseNameShowText						= mycampus_1_substr_for_utf8($fullname,10);

			$returnCourseGroupImg = mycampus_1_randpictice($id);
			//print_R($_SESSION);
			$USER_OJB = $_SESSION['USER'];
			if($USER_OJB->username=='admin')		{
				$indexpage_uploadimagebuttontitle	= get_string("indexpage_uploadimagebuttontitle","theme_mycampus_grid");
				$indexpage_uploadimagebuttonname	= get_string("indexpage_uploadimagebuttonname","theme_mycampus_grid");
				$CourseEdingHtmlInfor = "
					<input type=file name=uploadFile size=4 title='$indexpage_uploadimagebuttontitle'>
					<input type=submit name=submit value='$indexpage_uploadimagebuttonname' title='$indexpage_uploadimagebuttontitle'>
					";
			}
			else	{
				$CourseEdingHtmlInfor = "";
			}

			if($html->isshowcoursedescinfor)		{
				$CourseURL = "?action=coursecontextdetail&id=$id";
			}
			else	{
				$CourseURL = "/course/view.php?id=$id";
			}

			print "
			<form name=form_".$id." action=\"?action=imagesetting&id=$id&time=".time()."\" method=post encType=multipart/form-data>
				<li>
				  <div class=\"dandian_info\"> <img src=\"$returnCourseGroupImg\" />
					<div class=\"dandian_text\">
					  <p>".$coursestatistics_teachername.": ".join(',',$mycampus_1_GetCourseTeacherNumber)."</p>
					  <p>".$coursestatistics_users.": $mycampus_1_GetCourseEnrollmentStudentNumber</p>
					  <p>".$coursestatistics_sections.": $mycampus_1_GetCourseSectionNumber</p>
					  <p>".$coursestatistics_quizs.": $mycampus_1_GetCourseQuizNumber</p>
					  <p>".$coursestatistics_questions.": $mycampus_1_GetCourseQuestionNumber</p>
					  <p>".$coursestatistics_actives.": $mycampus_1_GetCourseOneMouthActivesNumber</p>
					</div>
				  </div>
				  <br>
				  <a href=\"$CourseURL\" class=\"dandian_enter\" title='$fullname'>$CourseNameShowText</a>
				  $CourseEdingHtmlInfor
				</li>
			</form>
					  ";

		}
		print "</ul>
				</div>";
		print "</td></tr></table>";
	}

	//print_R($html);;exit;

	if($html->day30userinfor||$html->day30accessinfor)				{
		print "
				<script type=\"text/javascript\" src=\"/theme/mycampus_1/js/jquery-1.7.1.min.js\"></script>
				<script src=\"/theme/mycampus_1/js/highcharts/highcharts.js\"></script>
				<script src=\"/theme/mycampus_1/js/highcharts/modules/exporting.js\"></script>
				<style type=\"text/css\">
				${demo.css}
				</style>
				";
	}

	if($html->day30userinfor)										{
		//最近30天用户活跃数
		$timecreated = mktime(1,1,1,date('m'),date('d')-30,date('Y'));
		$sql = "select FROM_UNIXTIME(timecreated,'%m-%d') AS datetime,COUNT(distinct userid) AS num from mdl_logstore_standard_log   where timecreated>'$timecreated' group by FROM_UNIXTIME(timecreated,'%m-%d') order by FROM_UNIXTIME(timecreated,'%m-%d') desc limit 30";
		$rs = $dbA->CacheExecute($adodbcacheseconds,$sql);
		$rs_a   = $rs->GetArray();
		$xAxis = $yAxis = array();
		$ALLNUM = 0;
		for($i=sizeof($rs_a);$i>0;$i--)			{
			$ii = $i-1;
			$DATETIME	= $rs_a[$ii]['datetime'];
			$NUM		= $rs_a[$ii]['num'];
			$xAxis[]	= $DATETIME;
			$yAxis[]	= $NUM;
			$ALLNUM		+= $NUM;
		}
		$xAxisText = join("','",$xAxis);
		$yAxisText = join(',',$yAxis);
		//print_R($rs_a);

		$indexpage_statistics_name				= get_string('indexpage_statistics_name', 'theme_mycampus_grid');
		$day30userinfor							= get_string('day30userinfor', 'theme_mycampus_grid');
		$day30userinforunit						= get_string('day30userinforunit', 'theme_mycampus_grid');

		$indexpage_statistics_name				= str_replace("{a}",$ALLNUM,$indexpage_statistics_name);

		print "<table border='0' cellpadding='10' cellspacing='10'><tr><td>
				&nbsp;&nbsp;&nbsp;<br><font size='5' face='arial'>$indexpage_statistics_name</font><HR>
				";

		print "
			<script type=\"text/javascript\">
			$(function () {
				$('#container_alluserid').highcharts({
					chart: {
						type: 'column',
						margin: [ 50, 50, 100, 80]
					},
					title: {
						text: '',
						x: -2 //center
					},
					subtitle: {
						text: '".$day30userinfor."',
						x: -5
					},
					xAxis: {
						categories: ['$xAxisText']
					},
					yAxis: {
						title: {
							text: '".$day30userinforunit."'
						},
						plotLines: [{
							value: 0,
							width: 1,
							color: '#808080'
						}]
					},
					tooltip: {
						valueSuffix: ' '
					},
					plotOptions: {
						line: {
							dataLabels: {
								enabled: true
							},
							enableMouseTracking: false
						}
					},
					legend: {
						layout: 'vertical',
						align: 'right',
						verticalAlign: 'middle',
						borderWidth: 0
					},
					series: [{
						name: '".$day30userinforunit."',
						color:'#CE443E',
						data: [$yAxisText]
					}]
				});
			});
			</script>
			</head>
			<body>
			<div id=\"container_alluserid\" style=\"min-width: 960px; height: 300px; margin: 0 auto\"></div>
			";
	}

	if($html->day30accessinfor)				{
		//最近30天系统全站访问量
		$timecreated = mktime(1,1,1,date('m'),date('d')-30,date('Y'));
		$sql = "select FROM_UNIXTIME(timecreated,'%m-%d') AS DATETIME,COUNT(*) AS num from mdl_logstore_standard_log where timecreated>'$timecreated'  group by FROM_UNIXTIME(timecreated,'%m-%d') order by FROM_UNIXTIME(timecreated,'%m-%d') desc limit 30";
		$rs = $dbA->CacheExecute($adodbcacheseconds,$sql);
		$rs_a   = $rs->GetArray();
		$xAxis = $yAxis = array();
		for($i=sizeof($rs_a);$i>0;$i--)			{
			$ii = $i-1;
			$DATETIME	= $rs_a[$ii]['datetime'];
			$NUM		= $rs_a[$ii]['num'];
			$xAxis[]	= $DATETIME;
			$yAxis[]	= $NUM;
			$ALLNUM		+= $NUM;
		}
		$xAxisText = join("','",$xAxis);
		$yAxisText = join(',',$yAxis);
		//print_R($rs_a);

		$day30accessinfor							= get_string('day30accessinfor', 'theme_mycampus_grid');
		$day30accessinforunit						= get_string('day30accessinforunit', 'theme_mycampus_grid');

		print "
			<script type=\"text/javascript\">
			$(function () {
				$('#container_allaccess').highcharts({
					chart: {
						type: 'line'
					},
					title: {
						text: '',
						x: -2 //center
					},
					subtitle: {
						text: '".$day30accessinfor."',
						x: -5
					},
					xAxis: {
						categories: ['$xAxisText']
					},
					yAxis: {
						title: {
							text: '".$day30accessinforunit."'
						},
						plotLines: [{
							value: 0,
							width: 1,
							color: '#808080'
						}]
					},
					tooltip: {
						valueSuffix: ' '
					},
					plotOptions: {
						line: {
							dataLabels: {
								enabled: true
							},
							enableMouseTracking: false
						}
					},
					legend: {
						layout: 'vertical',
						align: 'right',
						verticalAlign: 'middle',
						borderWidth: 0
					},
					series: [{
						name: '".$day30accessinforunit."',
						color:'#0056CC',
						data: [$yAxisText]
					}]
				});
			});
			</script>
			</head>
			<body>
			<div id=\"container_allaccess\" style=\"min-width: 960px; height: 300px; margin: 0 auto\"></div>
			";

		print "</td></tr></table>";
	}
	//end if
}

$action			= optional_param('action','', PARAM_TEXT);
$id				= optional_param('id','', PARAM_TEXT);
$groupid		= optional_param('groupid','', PARAM_TEXT);
$coursetroup	= optional_param('coursetroup','', PARAM_TEXT);

//处理课程上传的图片
if($action=="imagesetting"&&$id!="")			{
	if($coursetroup=="group")			{
		$NewCourseImage = "theme/mycampus_1/images/group_".$id.".jpg";
	}
	else	{
		$NewCourseImage = "theme/mycampus_1/images/course_".$id.".jpg";
	}
	$filename		= $_FILES['uploadFile']['tmp_name'];
	$filename_name	= $_FILES['uploadFile']['name'];
	$filename_type	= $_FILES['uploadFile']['type'];

	print_R($_FILES);print_R($_POST);print_R($filename_type);exit;
	$GOON		= 1;
	if(!is_file($filename))		{
		$indexpage_uploadimagefailed			= get_string('indexpage_uploadimagefailed', 'theme_mycampus_grid');
		print $indexpage_uploadimagefailed;
		$GOON	= 0;
	}
	else		{
		if($filename_type=="image/jpeg")									{
				/* 读取图档 */
				$im = imagecreatefromjpeg($filename);
		}
		elseif($filename_type=="image/gif")									{
				/* 读取图档 */
				$im = imagecreatefromgif($filename);
		}
		elseif($filename_type=="image/png")									{
				/* 读取图档 */
				$im = imagecreatefrompng($filename);
		}
		else			{
			$indexpage_uploadimageformaterror			= get_string('indexpage_uploadimageformaterror', 'theme_mycampus_grid');
			print $indexpage_uploadimageformaterror;
			$GOON = 0;
		}
	}

	if($GOON==1)												{
			/* 图片要截多少, 长/宽 */
			$new_img_width	= 400;
			$new_img_height = 300;
			/* 先建立一个 新的空白图档 */
			list( $width ,  $height )	= getimagesize ( $filename );
			$height						= $width*$new_img_height/$new_img_width;
			$newim = ImageCreateTrueColor($new_img_width, $new_img_height);
			// 输出图要从哪边开始 x, y ，原始图要从哪边开始 x, y ，要画多大 x, y(resize) , 要抓多大 x, y
			imagecopyresampled($newim, $im, 0, 0, 0, 0, $new_img_width, $new_img_height, $width, $height);
			/* 放大成 500 x 500 的图 */
			// imagecopyresampled($newim, $im, 0, 0, 100, 30, 500, 500, $new_img_width, $new_img_height);
			/* 将图印出来 */
			imagejpeg($newim,$NewCourseImage);
			/* 资源回收 */
			imagedestroy($newim);
			imagedestroy($im);

			$indexpage_uploadimage			= get_string('indexpage_uploadimage', 'theme_mycampus_grid');
			$indexpage_gobacktoindexpage	= get_string('indexpage_gobacktoindexpage', 'theme_mycampus_grid');

			print "<div align=center>$indexpage_uploadimage<a href='/index.php?action=$action&groupid=$groupid&coursecategoryname=$coursecategoryname&'>$indexpage_gobacktoindexpage</a></div>";
			print "<META HTTP-EQUIV=REFRESH CONTENT='2;URL=index.php?action=$action&groupid=$groupid&coursecategoryname=$coursecategoryname&'>\n";
			exit;
	}
	else			{
		//不用处理
	}

}


function mycampus_1_coursecontextgroup($html)										{
	global $dbA,$adodbcacheseconds,$indexshowcoursenumber;

	$indexshowcoursenumber	= $html->indexshowcoursenumber;
	$adodbcacheseconds		= $html->adodbcacheseconds;

	$groupid				= optional_param('groupid','', PARAM_TEXT);
	$action					= optional_param('action','', PARAM_TEXT);
	$coursecategoryname		= optional_param('coursecategoryname','', PARAM_TEXT);

	//print_R($adodbcacheseconds);
	$sql	= "select id,name from mdl_course_categories where id='".$groupid."' order by sortorder";
	$rs		= $dbA->CacheExecute($adodbcacheseconds,$sql);
	$rsC_a	= $rs->GetArray();
	$coursegroupname = $rsC_a[0]['name'];

	$CourseInforArray_ARRAY = array();
	//处理，课程类别下直接就是课程的情况
	$sql = "select * from mdl_course where category='".$groupid."'";
	//echo $sql."<br>";
	$rs = $dbA->CacheExecute($adodbcacheseconds,$sql);
	$rs_a = $rs->GetArray();

	for($i=0;$i<sizeof($rs_a);$i++)
	{
		$id			= $rs_a[$i]['id'];
		$fullname	= $rs_a[$i]['fullname'];
		$summary	= $rs_a[$i]['summary'];
		$CourseInforArray_ARRAY['id'][] = $id;
		$CourseInforArray_ARRAY['fullname'][] = $fullname;
		$CourseInforArray_ARRAY['summary'][] = $summary;
		$CourseInforArray_ARRAY['CourseCategoryName'][] = "";
	}

	$coursestatistics_teachername			= get_string('coursestatistics_teachername', 'theme_mycampus_grid');
	$coursestatistics_users					= get_string('coursestatistics_users', 'theme_mycampus_grid');
	$coursestatistics_sections				= get_string('coursestatistics_sections', 'theme_mycampus_grid');
	$coursestatistics_quizs					= get_string('coursestatistics_quizs', 'theme_mycampus_grid');
	$coursestatistics_questions				= get_string('coursestatistics_questions', 'theme_mycampus_grid');
	$coursestatistics_actives				= get_string('coursestatistics_actives', 'theme_mycampus_grid');
	$wonderfulcourse						= get_string('wonderfulcourse', 'theme_mycampus_grid');
	$wonderfulcoursedesc					= get_string('wonderfulcoursedesc', 'theme_mycampus_grid');
	$hotcourse								= get_string('hotcourse', 'theme_mycampus_grid');
	$hotcoursedesc							= get_string('hotcoursedesc', 'theme_mycampus_grid');


	print "<link rel=\"stylesheet\" type=\"text/css\" href=\"/theme/mycampus_1/style/style_".$indexshowcoursenumber.".css\" />";


	if(count($CourseInforArray_ARRAY)>0)			{
			print "<table border='0' cellpadding='0' cellspacing='0' width=960><tr><td>";
			print "<div class=\"dandian_wrap dandian_clearfix\">
				  <h2>$coursegroupname</h2>
				  <ul class=\"dandian_clearfix\">";

			for($i=0;$i<sizeof($CourseInforArray_ARRAY['id']);$i++)
			{
				$id			= $CourseInforArray_ARRAY['id'][$i];
				$fullname	= $CourseInforArray_ARRAY['fullname'][$i];
				$summary	= $CourseInforArray_ARRAY['summary'][$i];
				$CourseCategoryNameShowText	= $CourseInforArray_ARRAY['CourseCategoryName'][$i];

				$mycampus_1_GetCourseEnrollmentStudentNumber	= mycampus_1_GetCourseEnrollmentStudentNumber($id);
				$mycampus_1_GetCourseQuestionNumber			= mycampus_1_GetCourseQuestionNumber($id);
				$mycampus_1_GetCourseQuizNumber				= mycampus_1_GetCourseQuizNumber($id);
				$mycampus_1_GetCourseSectionNumber				= mycampus_1_GetCourseSectionNumber($id);
				$mycampus_1_GetCourseTeacherNumber				= mycampus_1_GetCourseTeacherNumber($id);
				$mycampus_1_GetCourseOneMouthActivesNumber		= mycampus_1_GetCourseOneMouthActivesNumber($id);


				$CourseNameShowText					= mycampus_1_substr_for_utf8($fullname,10);

				$returnCourseGroupImg			= mycampus_1_randpictice($id);
				$USER_OJB = $_SESSION['USER'];
				if($USER_OJB->username=='admin')		{
					$indexpage_uploadimagebuttontitle	= get_string("indexpage_uploadimagebuttontitle","theme_mycampus_grid");
					$indexpage_uploadimagebuttonname	= get_string("indexpage_uploadimagebuttonname","theme_mycampus_grid");
					$CourseEdingHtmlInfor = "
						<input type=file name=uploadFile size=4 title='$indexpage_uploadimagebuttontitle'>
						<input type=submit name=submit value='$indexpage_uploadimagebuttonname' title='$indexpage_uploadimagebuttontitle'>
						<input type=hidden name=action value='".$action."'>
						<input type=hidden name=groupid value='".$groupid."'>
						<input type=hidden name=coursecategoryname value='".$coursecategoryname."'>
						";
				}
				else	{
					$CourseEdingHtmlInfor = "";
				}

				if($html->isshowcoursedescinfor)		{
					$CourseURL = "?action=coursecontextdetail&id=$id";
				}
				else	{
					$CourseURL = "/course/view.php?id=$id";
				}


				print "
				<form name=form_".$id." action=\"?action=imagesetting&id=$id&time=".time()."\" method=post encType=multipart/form-data>
					<li>
					  <div class=\"dandian_info\"> <img src=\"$returnCourseGroupImg\" />
						<div class=\"dandian_text\">
						  <p>".$coursestatistics_teachername.": ".join(',',$mycampus_1_GetCourseTeacherNumber)."</p>
						  <p>".$coursestatistics_users.": $mycampus_1_GetCourseEnrollmentStudentNumber</p>
						  <p>".$coursestatistics_sections.": $mycampus_1_GetCourseSectionNumber</p>
						  <p>".$coursestatistics_quizs.": $mycampus_1_GetCourseQuizNumber</p>
						  <p>".$coursestatistics_questions.": $mycampus_1_GetCourseQuestionNumber</p>
						  <p>".$coursestatistics_actives.": $mycampus_1_GetCourseOneMouthActivesNumber</p>
						</div>
					  </div>
					  <BR>

					  <a href=\"$CourseURL\" class=\"dandian_enter\" title='$fullname'>$CourseNameShowText</a>
					  $CourseEdingHtmlInfor
					</li>
				</form>
						  ";

			}
			print "</ul>
					</div>";
			print "</td></tr></table>";
	}
	else		{
		print "<table border='0' cellpadding='0' cellspacing='0' width=960><tr><td>";
		print "<div class=\"dandian_wrap dandian_clearfix\">
				  <h2>$coursegroupname</h2>";
		print "</td></tr></table>";
	}



	$sql	= "select id,name from mdl_course_categories where parent='".$groupid."' order by sortorder";
	$rs		= $dbA->CacheExecute($adodbcacheseconds,$sql);
	$rsC_a	= $rs->GetArray();
	//print_R($sql);print_R($rsC_a);
	for($iC=0;$iC<sizeof($rsC_a);$iC++)
	{
			$groupid		= $rsC_a[$iC]['id'];
			$GroupName		= $rsC_a[$iC]['name'];

			$CourseInforArray_ARRAY = array();
			//处理，课程类别下直接就是课程的情况
			$sql = "select * from mdl_course where category='".$groupid."'";
			//echo $sql."<br>";
			$rs = $dbA->CacheExecute($adodbcacheseconds,$sql);
			$rs_a = $rs->GetArray();
			for($i=0;$i<sizeof($rs_a);$i++)
			{
				$id			= $rs_a[$i]['id'];
				$fullname	= $rs_a[$i]['fullname'];
				$summary	= $rs_a[$i]['summary'];
				$CourseInforArray_ARRAY['id'][] = $id;
				$CourseInforArray_ARRAY['fullname'][] = $fullname;
				$CourseInforArray_ARRAY['summary'][] = $summary;
				$CourseInforArray_ARRAY['CourseCategoryName'][] = "";
			}
			print "<table border='0' cellpadding='0' cellspacing='0' width=960><tr><td>";
			print "<div class=\"dandian_wrap dandian_clearfix\">
				  <h2>$GroupName</h2>
				  <ul class=\"dandian_clearfix\">";

			for($i=0;$i<sizeof($CourseInforArray_ARRAY['id']);$i++)
			{
				$id			= $CourseInforArray_ARRAY['id'][$i];
				$fullname	= $CourseInforArray_ARRAY['fullname'][$i];
				$summary	= $CourseInforArray_ARRAY['summary'][$i];
				$CourseCategoryNameShowText	= $CourseInforArray_ARRAY['CourseCategoryName'][$i];

				$mycampus_1_GetCourseEnrollmentStudentNumber	= mycampus_1_GetCourseEnrollmentStudentNumber($id);
				$mycampus_1_GetCourseQuestionNumber			= mycampus_1_GetCourseQuestionNumber($id);
				$mycampus_1_GetCourseQuizNumber				= mycampus_1_GetCourseQuizNumber($id);
				$mycampus_1_GetCourseSectionNumber				= mycampus_1_GetCourseSectionNumber($id);
				$mycampus_1_GetCourseTeacherNumber				= mycampus_1_GetCourseTeacherNumber($id);
				$mycampus_1_GetCourseOneMouthActivesNumber		= mycampus_1_GetCourseOneMouthActivesNumber($id);


				$CourseNameShowText					= mycampus_1_substr_for_utf8($fullname,10);

				$returnCourseGroupImg = mycampus_1_randpictice($id);
				$USER_OJB = $_SESSION['USER'];
				if($USER_OJB->username=='admin')		{
					$indexpage_uploadimagebuttontitle	= get_string("indexpage_uploadimagebuttontitle","theme_mycampus_grid");
					$indexpage_uploadimagebuttonname	= get_string("indexpage_uploadimagebuttonname","theme_mycampus_grid");
					$CourseEdingHtmlInfor = "
						<input type=file name=uploadFile size=4 title='$indexpage_uploadimagebuttontitle'>
						<input type=submit name=submit value='$indexpage_uploadimagebuttonname' title='$indexpage_uploadimagebuttontitle'>
						<input type=hidden name=action value='".$action."'>
						<input type=hidden name=groupid value='".$groupid."'>
						<input type=hidden name=coursecategoryname value='".$coursecategoryname."'>
						";
				}
				else	{
					$CourseEdingHtmlInfor = "";
				}

				if($html->isshowcoursedescinfor)		{
					$CourseURL = "?action=coursecontextdetail&id=$id";
				}
				else	{
					$CourseURL = "/course/view.php?id=$id";
				}

				print "
				<form name=form_".$id." action=\"?action=imagesetting&id=$id&time=".time()."\" method=post encType=multipart/form-data>
					<li>
					  <div class=\"dandian_info\"> <img src=\"$returnCourseGroupImg\" />
						<div class=\"dandian_text\">
						  <p>".$coursestatistics_teachername.": ".join(',',$mycampus_1_GetCourseTeacherNumber)."</p>
						  <p>".$coursestatistics_users.": $mycampus_1_GetCourseEnrollmentStudentNumber</p>
						  <p>".$coursestatistics_sections.": $mycampus_1_GetCourseSectionNumber</p>
						  <p>".$coursestatistics_quizs.": $mycampus_1_GetCourseQuizNumber</p>
						  <p>".$coursestatistics_questions.": $mycampus_1_GetCourseQuestionNumber</p>
						  <p>".$coursestatistics_actives.": $mycampus_1_GetCourseOneMouthActivesNumber</p>
						</div>
					  </div>
					  <BR>
					  <a href=\"$CourseURL\" class=\"dandian_enter\" title='$fullname'>$CourseNameShowText</a>
					  $CourseEdingHtmlInfor
					</li>
				</form>
					";

			}
			print "</ul>
					</div>";
			print "</td></tr></table>";
	}

}

function mycampus_1_left_button($html)		{
	//print_R($html);
	print "
	<fieldset class=\"coursesearchbox invisiblefieldset\">";
	$coursestatistics = get_string('coursestatistics', 'theme_mycampus_grid');
	if($html->coursestatistics)				print "<input type=\"button\" OnClick=\"location='index.php?action=coursestatistics'\" value=\"$coursestatistics\" /><BR>";

	$coursecategorystatistics = get_string('coursecategorystatistics', 'theme_mycampus_grid');
	if($html->coursecategorystatistics)		print "<input type=\"button\" OnClick=\"location='index.php?action=coursecategorystatistics'\" value=\"$coursecategorystatistics\" /><BR>";

	$useraccessstatistics = get_string('useraccessstatistics', 'theme_mycampus_grid');
	if($html->useraccessstatistics)			print "<input type=\"button\" OnClick=\"location='index.php?action=useraccessstatistics'\" value=\"$useraccessstatistics\" /><BR>";

	$activeteachersstatistics = get_string('activeteachersstatistics', 'theme_mycampus_grid');
	if($html->activeteachersstatistics)		print "<input type=\"button\" OnClick=\"location='index.php?action=activeteachersstatistics'\" value=\"$activeteachersstatistics\" /><BR>";

	$activestudentsstatistics = get_string('activestudentsstatistics', 'theme_mycampus_grid');
	if($html->activestudentsstatistics)		print "<input type=\"button\" OnClick=\"location='index.php?action=activestudentsstatistics'\" value=\"$activestudentsstatistics\" /><BR>";
	print "</fieldset>
	";
}


//print_R($dbA);//exit;
