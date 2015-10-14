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

function coursecategorystatistics($html)		{
	global $dbA,$adodbcacheseconds,$indexshowcoursenumber,$CFG;
	$indexshowcoursenumber	= $html->indexshowcoursenumber;
	$adodbcacheseconds		= $html->adodbcacheseconds;

	$MetaTables = $dbA->MetaTables();
	//print_R($adodbcacheseconds);exit;

	$GetCourseQuizNumber = array();
	$sql = "select COUNT(*) AS NUM,course from mdl_quiz group by course";
	$rs = $dbA->CacheExecute($adodbcacheseconds,$sql);
	$rsC_a	= $rs->GetArray();
	for($i=0;$i<sizeof($rsC_a);$i++)			{
		$NUM		= $rsC_a[$i]['NUM'];
		$course		= $rsC_a[$i]['course'];
		$GetCourseQuizNumber[$course] = $NUM;
	}

	$GetCourseSectionNumber = array();
	$sql = "select COUNT(*) AS NUM,course from `mdl_course_sections` where visible=1 and name is not null group by course";
	$rs = $dbA->CacheExecute($adodbcacheseconds,$sql);
	$rsC_a	= $rs->GetArray();
	for($i=0;$i<sizeof($rsC_a);$i++)			{
		$NUM		= $rsC_a[$i]['NUM'];
		$course		= $rsC_a[$i]['course'];
		$GetCourseSectionNumber[$course] = $NUM;
	}

	$GetCourseEnrollmentStudentNumber = array();
	$sql = "SELECT COUNT(userid) AS NUM,mdl_context.instanceid AS course FROM mdl_role_assignments, mdl_context where  mdl_role_assignments.contextid=mdl_context.id group by mdl_context.instanceid";
	$rs = $dbA->CacheExecute($adodbcacheseconds,$sql);
	$rsC_a	= $rs->GetArray();
	for($i=0;$i<sizeof($rsC_a);$i++)			{
		$NUM		= $rsC_a[$i]['NUM'];
		$course		= $rsC_a[$i]['course'];
		$GetCourseEnrollmentStudentNumber[$course] = $NUM;
	}


	function 得到某课程下面文件的数量($id)		{
		global $dbA,$adodbcacheseconds,$indexshowcoursenumber;	//

		$sql = "SELECT id FROM mdl_course_modules WHERE course = '$id'";
		$rs = $dbA->CacheExecute($adodbcacheseconds,$sql);
		$rsC_a	= $rs->GetArray();
		$contextid_list = array();
		for($i=0;$i<sizeof($rsC_a);$i++)			{
			$contextid_list[]		= $rsC_a[$i]['id'];
		}
		if(count($contextid_list)==0)				{
			$contextid_list = array('9999999999');
		}

		$sql = "SELECT id FROM mdl_context WHERE instanceid in (".join(',',$contextid_list).")";
		//print $sql."<BR>";
		$rs = $dbA->CacheExecute($adodbcacheseconds,$sql);
		$rsC_a	= $rs->GetArray();
		$id_list = array();
		for($i=0;$i<sizeof($rsC_a);$i++)			{
			$id_list[]		= $rsC_a[$i]['id'];
		}
		 //!='' and component!='' and component!=''
		$sql = "SELECT count(distinct contenthash) AS NUM FROM mdl_files WHERE component not in ('backup','theme_more','user','blog','badges','group') and contextid in (".join(',',$id_list).")";
		//print $sql."<BR>";
		$rs = $dbA->CacheExecute($adodbcacheseconds,$sql);
		$NUM = $rs->fields['NUM'];
		return $NUM;
	}

	function 得到某课程下面文件的数量FLV($id)		{
		global $dbA,$adodbcacheseconds,$indexshowcoursenumber;
		$sql = "SELECT id FROM mdl_course_modules WHERE course = '$id'";
		$rs = $dbA->CacheExecute($adodbcacheseconds,$sql);
		$rsC_a	= $rs->GetArray();
		$contextid_list = array();
		for($i=0;$i<sizeof($rsC_a);$i++)			{
			$contextid_list[]		= $rsC_a[$i]['id'];
		}
		if(count($contextid_list)==0)				{
			$contextid_list = array('9999999999');
		}

		$sql = "SELECT id FROM mdl_context WHERE instanceid in ('".join("','",$contextid_list)."')";
		//print $sql."<BR>";
		$rs = $dbA->CacheExecute($adodbcacheseconds,$sql);
		$rsC_a	= $rs->GetArray();
		$id_list = array();
		for($i=0;$i<sizeof($rsC_a);$i++)			{
			$id_list[]		= $rsC_a[$i]['id'];
		}

		$sql = "SELECT count(distinct contenthash) AS NUM FROM mdl_files WHERE component not in ('backup','theme_more','user','blog','badges','group') and  contextid in ('".join("','",$id_list)."') and source like '%.flv%'";
		//print $sql."<BR>";
		$rs = $dbA->CacheExecute($adodbcacheseconds,$sql);
		$NUM = $rs->fields['NUM'];
		return $NUM;
	}

	function 得到某课程下面文件的数量SWF($id)		{
		global $dbA,$adodbcacheseconds,$indexshowcoursenumber;
		$sql = "SELECT id FROM mdl_course_modules WHERE course = '$id'";
		$rs = $dbA->CacheExecute($adodbcacheseconds,$sql);
		$rsC_a	= $rs->GetArray();
		$contextid_list = array();
		for($i=0;$i<sizeof($rsC_a);$i++)			{
			$contextid_list[]		= $rsC_a[$i]['id'];
		}
		if(count($contextid_list)==0)				{
			$contextid_list = array('9999999999');
		}

		$sql = "SELECT id FROM mdl_context WHERE instanceid in (".join(',',$contextid_list).")";
		//print $sql."<BR>";
		$rs = $dbA->CacheExecute($adodbcacheseconds,$sql);
		$rsC_a	= $rs->GetArray();
		$id_list = array();
		for($i=0;$i<sizeof($rsC_a);$i++)			{
			$id_list[]		= $rsC_a[$i]['id'];
		}

		$sql = "SELECT count(distinct contenthash) AS NUM FROM mdl_files WHERE component not in ('backup','theme_more','user','blog','badges','group') and  contextid in ('".join("','",$id_list)."') and source like '%.swf%'";
		//print $sql."<BR>";
		$rs = $dbA->CacheExecute($adodbcacheseconds,$sql);
		$NUM = $rs->fields['NUM'];
		return $NUM;
	}

	function 得到某课程下面文件的数量XLS($id)		{
		global $dbA,$adodbcacheseconds,$indexshowcoursenumber;
		$sql = "SELECT id FROM mdl_course_modules WHERE course = '$id'";
		$rs = $dbA->CacheExecute($adodbcacheseconds,$sql);
		$rsC_a	= $rs->GetArray();
		$contextid_list = array();
		for($i=0;$i<sizeof($rsC_a);$i++)			{
			$contextid_list[]		= $rsC_a[$i]['id'];
		}
		if(count($contextid_list)==0)				{
			$contextid_list = array('9999999999');
		}

		$sql = "SELECT id FROM mdl_context WHERE instanceid in (".join(',',$contextid_list).")";
		//print $sql."<BR>";
		$rs = $dbA->CacheExecute($adodbcacheseconds,$sql);
		$rsC_a	= $rs->GetArray();
		$id_list = array();
		for($i=0;$i<sizeof($rsC_a);$i++)			{
			$id_list[]		= $rsC_a[$i]['id'];
		}

		$sql = "SELECT count(distinct contenthash) AS NUM FROM mdl_files WHERE component not in ('backup','theme_more','user','blog','badges','group') and  contextid in ('".join("','",$id_list)."') and source like '%.xls%'";
		//print $sql."<BR>";
		$rs = $dbA->CacheExecute($adodbcacheseconds,$sql);
		$NUM = $rs->fields['NUM'];
		return $NUM;
	}

	function 得到某课程下面文件的数量PPT($id)		{
		global $dbA,$adodbcacheseconds,$indexshowcoursenumber;
		$sql = "SELECT id FROM mdl_course_modules WHERE course = '$id'";
		$rs = $dbA->CacheExecute($adodbcacheseconds,$sql);
		$rsC_a	= $rs->GetArray();
		$contextid_list = array();
		for($i=0;$i<sizeof($rsC_a);$i++)			{
			$contextid_list[]		= $rsC_a[$i]['id'];
		}
		if(count($contextid_list)==0)				{
			$contextid_list = array('9999999999');
		}

		$sql = "SELECT id FROM mdl_context WHERE instanceid in (".join(',',$contextid_list).")";
		//print $sql."<BR>";
		$rs = $dbA->CacheExecute($adodbcacheseconds,$sql);
		$rsC_a	= $rs->GetArray();
		$id_list = array();
		for($i=0;$i<sizeof($rsC_a);$i++)			{
			$id_list[]		= $rsC_a[$i]['id'];
		}

		$sql = "SELECT count(distinct contenthash) AS NUM FROM mdl_files WHERE component not in ('backup','theme_more','user','blog','badges','group') and  contextid in ('".join("','",$id_list)."') and source like '%.ppt%'";
		//print $sql."<BR>";
		$rs = $dbA->CacheExecute($adodbcacheseconds,$sql);
		$NUM = $rs->fields['NUM'];
		return $NUM;
	}

	function 得到某课程下面文件的数量DOC($id)		{
		global $dbA,$adodbcacheseconds,$indexshowcoursenumber;
		$sql = "SELECT id FROM mdl_course_modules WHERE course = '$id'";
		$rs = $dbA->CacheExecute($adodbcacheseconds,$sql);
		$rsC_a	= $rs->GetArray();
		$contextid_list = array();
		for($i=0;$i<sizeof($rsC_a);$i++)			{
			$contextid_list[]		= $rsC_a[$i]['id'];
		}
		if(count($contextid_list)==0)				{
			$contextid_list = array('9999999999');
		}

		$sql = "SELECT id FROM mdl_context WHERE instanceid in ('".join("','",$contextid_list)."')";
		//print $sql."<BR>";
		$rs = $dbA->CacheExecute($adodbcacheseconds,$sql);
		$rsC_a	= $rs->GetArray();
		$id_list = array();
		for($i=0;$i<sizeof($rsC_a);$i++)			{
			$id_list[]		= $rsC_a[$i]['id'];
		}

		$sql = "SELECT count(distinct contenthash) AS NUM FROM mdl_files WHERE component not in ('backup','theme_more','user','blog','badges','group') and  contextid in ('".join("','",$id_list)."') and source like '%.doc%'";
		//print $sql."<BR>";
		$rs = $dbA->CacheExecute($adodbcacheseconds,$sql);
		$NUM = $rs->fields['NUM'];
		return $NUM;
	}

	function 得到某课程下面文件的数量PDF($id)		{
		global $dbA,$adodbcacheseconds,$indexshowcoursenumber;
		$sql = "SELECT id FROM mdl_course_modules WHERE course = '$id'";
		$rs = $dbA->CacheExecute($adodbcacheseconds,$sql);
		$rsC_a	= $rs->GetArray();
		$contextid_list = array();
		for($i=0;$i<sizeof($rsC_a);$i++)			{
			$contextid_list[]		= $rsC_a[$i]['id'];
		}
		if(count($contextid_list)==0)				{
			$contextid_list = array('9999999999');
		}

		$sql = "SELECT id FROM mdl_context WHERE instanceid in ('".join("','",$contextid_list)."')";
		//print $sql."<BR>";
		$rs = $dbA->CacheExecute($adodbcacheseconds,$sql);
		$rsC_a	= $rs->GetArray();
		$id_list = array();
		for($i=0;$i<sizeof($rsC_a);$i++)			{
			$id_list[]		= $rsC_a[$i]['id'];
		}

		$sql = "SELECT count(distinct contenthash) AS NUM FROM mdl_files WHERE component not in ('backup','theme_more','user','blog','badges','group') and  contextid in ('".join("','",$id_list)."') and source like '%.pdf%'";
		//print $sql."<BR>";
		$rs = $dbA->CacheExecute($adodbcacheseconds,$sql);
		$NUM = $rs->fields['NUM'];
		return $NUM;
	}


	$GetCourseOneMouthActivesNumber = array();
	$datetime = mktime(0,1,1,date('m'),date('d')-30,date('Y'));
	$sql = "select COUNT(*) AS NUM,courseid from mdl_logstore_standard_log where timecreated > '$datetime' group by courseid";
	$rs = $dbA->CacheExecute($adodbcacheseconds,$sql);
	$rsC_a	= $rs->GetArray();
	for($i=0;$i<sizeof($rsC_a);$i++)			{
		$NUM		= $rsC_a[$i]['NUM'];
		$course		= $rsC_a[$i]['courseid'];
		$GetCourseOneMouthActivesNumber[$course] = $NUM;
	}



	$sql	= "select id,name,parent from mdl_course_categories order by sortorder";
	$rs		= $dbA->CacheExecute($adodbcacheseconds,$sql);
	$rsC_a	= $rs->GetArray();
	$USER_MAP = array();
	for($i=0;$i<sizeof($rsC_a);$i++)			{
		$parent = $rsC_a[$i]['parent'];
		$id		= $rsC_a[$i]['id'];
		$name	= $rsC_a[$i]['name'];
		$CATE_DIR[$parent][]	= $id;
		$CATE_MAP[$id]			= $name;
		$CATE_GROUP[$id]			= $parent;
	}


	//print_R($CATE_DIR);
	//print_R($COURSE_DIR);
	global $SITE;
	print "<link rel=\"stylesheet\" type=\"text/css\" href=\"/theme/mycampus_grid/style/style_4.css\" />";
	print "<link rel=\"stylesheet\" type=\"text/css\" href=\"/theme/mycampus_grid/style/style_table.css\" />";

	$sql	= "select * from mdl_course order by category,sortorder";
	$rs		= $dbA->CacheExecute($adodbcacheseconds,$sql);
	$rs_a	= $rs->GetArray();
	for($i=0;$i<sizeof($rs_a);$i++)			{
		$category	= $rs_a[$i]['category'];
		$id			= $rs_a[$i]['id'];
		$fullname	= $rs_a[$i]['fullname'];
		$专业名称	= $CATE_MAP[$category];
		$院系id = $CATE_GROUP[$category];
		$院系名称	= $CATE_MAP[$院系id];
		if($院系id==0)		{
			$院系名称	= $专业名称;
		}
		$GetCourseTeacherNumber		= GetCourseTeacherNumber($id);
		$GetCourseTeacherNumber_TEXT	= join(',',$GetCourseTeacherNumber);
		//<td colspan=1 nowrap title='文件数量'>".得到某课程下面文件的数量($id)."</td>
		//$统计汇总 = array();
		if($专业名称!="")			{
			$得到某课程下面文件的文档数量   = 0;
			$得到某课程下面文件的数量		= 得到某课程下面文件的数量($id);
			$得到某课程下面文件的文档数量	+= $得到某课程下面文件的数量PPT = 得到某课程下面文件的数量PPT($id);
			$得到某课程下面文件的文档数量	+= $得到某课程下面文件的数量XLS = 得到某课程下面文件的数量XLS($id);
			$得到某课程下面文件的文档数量	+= $得到某课程下面文件的数量DOC = 得到某课程下面文件的数量DOC($id);
			$得到某课程下面文件的文档数量	+= $得到某课程下面文件的数量PDF = 得到某课程下面文件的数量PDF($id);
			$得到某课程下面文件的文档数量	+= $得到某课程下面文件的数量FLV = 得到某课程下面文件的数量FLV($id);
			$得到某课程下面文件的文档数量	+= $得到某课程下面文件的数量SWF = 得到某课程下面文件的数量SWF($id);

			$统计汇总[$院系名称][$id]		 = $得到某课程下面文件的文档数量;
			if($得到某课程下面文件的文档数量>0)					{
				$统计汇总_2[$院系名称][$id]		 = $得到某课程下面文件的文档数量;
			}
		}
	}


	print "<BR>";

	//print_R($统计汇总);exit;

	$coursecategorystatistics								= get_string('coursecategorystatistics', 'theme_mycampus_grid');
	$coursestatistics_updatedate							= get_string('coursestatistics_updatedate', 'theme_mycampus_grid');
	$coursecategorystatistics_id							= get_string('coursecategorystatistics_id', 'theme_mycampus_grid');
	$coursecategorystatistics_category						= get_string('coursecategorystatistics_category', 'theme_mycampus_grid');
	$coursecategorystatistics_coursenumber					= get_string('coursecategorystatistics_coursenumber', 'theme_mycampus_grid');
	$coursecategorystatistics_coursenumberincludedocument	= get_string('coursecategorystatistics_coursenumberincludedocument', 'theme_mycampus_grid');
	$coursecategorystatistics_percentage					= get_string('coursecategorystatistics_percentage', 'theme_mycampus_grid');
	$coursecategorystatistics_resourcesnumber				= get_string('coursecategorystatistics_resourcesnumber', 'theme_mycampus_grid');
	$coursecategorystatistics_total							= get_string('coursecategorystatistics_total', 'theme_mycampus_grid');


	print "<Table class=TableBlock width=960>";
	print "
		<Tr class='TableContent'>
			<td colspan=22>".$coursecategorystatistics."【".$SITE->shortname."】 ".$coursestatistics_updatedate.":".date('Y-m-d')." </td>
		</tr>
		";
	print "
			<Tr class='TableContent' align=center>
				<td colspan=1 nowrap>$coursecategorystatistics_id</td>
				<td colspan=1 nowrap>$coursecategorystatistics_category</td>
				<td colspan=1 nowrap>$coursecategorystatistics_coursenumber</td>
				<td colspan=1 nowrap>$coursecategorystatistics_coursenumberincludedocument</td>
				<td colspan=1 nowrap>$coursecategorystatistics_percentage</td>
				<td colspan=1 nowrap>$coursecategorystatistics_resourcesnumber</td>
			</tr>
			";


	$院系LIST = array_keys($统计汇总);
	sort($院系LIST);
	for($i=0;$i<sizeof($院系LIST);$i++)			{
		$院系LIST_KEY	= $院系LIST[$i];
		$课程信息		= $统计汇总[$院系LIST_KEY];
		$课程门数		= count($课程信息);
		$课程门数_ALL	+= $课程门数;

		$已有PPT等课程资源门数	= count($统计汇总_2[$院系LIST_KEY]);
		$已有PPT等课程资源门数_ALL += $已有PPT等课程资源门数;

		$课程资源数_ARRAY		= array_values($统计汇总_2[$院系LIST_KEY]);
		$课程资源数				= array_sum($课程资源数_ARRAY);
		$课程资源数_ALL			+= $课程资源数;

		$比例			= $已有PPT等课程资源门数*100/$课程门数;
		$比例			= (int)$比例;
		$课程比例[]		= $比例;
		print "<Tr class='TableData' align=center>
				<td colspan=1 nowrap>".($i+1)."</td>
				<td colspan=1 nowrap>$院系LIST_KEY</td>
				<td colspan=1 nowrap>$课程门数</td>
				<td colspan=1 nowrap>$已有PPT等课程资源门数</td>
				<td colspan=1 nowrap>$比例</td>
				<td colspan=1 nowrap>$课程资源数</td>
			</tr>
				";
	}

	$全院平均		= $已有PPT等课程资源门数_ALL*100/$课程门数_ALL;
	$全院平均		= (int)$全院平均;
	print "<Tr class='TableContent' align=center>
			<td colspan=2 nowrap>$coursecategorystatistics_total</td>
			<td colspan=1 nowrap>$课程门数_ALL</td>
			<td colspan=1 nowrap>$已有PPT等课程资源门数_ALL</td>
			<td colspan=1 nowrap>".$全院平均."</td>
			<td colspan=1 nowrap>$课程资源数_ALL</td>
		</tr>
			";

	print "</table>";

}

?>