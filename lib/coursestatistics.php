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

function coursestatistics($html)		{
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
	$datetime = mktime(0,1,1,date('m'),date('d')-60,date('Y'));
	$sql = "select COUNT(*) AS NUM,courseid from mdl_logstore_standard_log where timecreated > '$datetime' group by courseid";
	$rs = $dbA->CacheExecute($adodbcacheseconds,$sql);
	$rsC_a	= $rs->GetArray();
	for($i=0;$i<sizeof($rsC_a);$i++)			{
		$NUM		= $rsC_a[$i]['NUM'];
		$course		= $rsC_a[$i]['courseid'];
		$GetCourseOneMouthActivesNumber[$course] = $NUM;
	}


	$得到课程的讨论区数量		= array();
	$得到课程的讨论区数量ALL	= array();
	$sql = "select COUNT(*) AS NUM,course,type from mdl_forum group by course,type order by type";
	$rs = $dbA->CacheExecute($adodbcacheseconds,$sql);
	$rsC_a	= $rs->GetArray();
	for($i=0;$i<sizeof($rsC_a);$i++)			{
		$NUM		= $rsC_a[$i]['NUM'];
		$course		= $rsC_a[$i]['course'];
		$type		= $rsC_a[$i]['type'];
		$得到课程的讨论区数量[$course]		.= $type.":".$NUM." ";
		$得到课程的讨论区数量ALL[$course]	+= $NUM;
	}


	$得到课程的讨论帖子数量 = array();
	$sql = "select COUNT(*) AS NUM,course from mdl_forum_discussions group by course";
	$rs = $dbA->CacheExecute($adodbcacheseconds,$sql);
	$rsC_a	= $rs->GetArray();
	for($i=0;$i<sizeof($rsC_a);$i++)			{
		$NUM		= $rsC_a[$i]['NUM'];
		$course		= $rsC_a[$i]['course'];
		$得到课程的讨论帖子数量[$course] = $NUM;
	}

	$得到课程的assign数量 = array();
	if(in_array("mdl_assign",$MetaTables))				{
		$sql = "select COUNT(*) AS NUM,course from mdl_assign group by course";
		$rs = $dbA->CacheExecute($adodbcacheseconds,$sql);
		$rsC_a	= $rs->GetArray();
		for($i=0;$i<sizeof($rsC_a);$i++)			{
			$NUM		= $rsC_a[$i]['NUM'];
			$course		= $rsC_a[$i]['course'];
			$得到课程的assign数量[$course] = $NUM;
		}
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


	$coursestatistics = get_string('coursestatistics', 'theme_mycampus_grid');
	$coursestatistics_updatedate	= get_string('coursestatistics_updatedate', 'theme_mycampus_grid');
	$coursestatistics_orderdatarule = get_string('coursestatistics_orderdatarule', 'theme_mycampus_grid');

	$coursestatistics_category_1	= get_string('coursestatistics_category_1', 'theme_mycampus_grid');
	$coursestatistics_category_2	= get_string('coursestatistics_category_2', 'theme_mycampus_grid');
	$coursestatistics_coursename	= get_string('coursestatistics_coursename', 'theme_mycampus_grid');
	$coursestatistics_teachername	= get_string('coursestatistics_teachername', 'theme_mycampus_grid');
	$coursestatistics_sections		= get_string('coursestatistics_sections', 'theme_mycampus_grid');
	$coursestatistics_files			= get_string('coursestatistics_files', 'theme_mycampus_grid');
	$coursestatistics_documents		= get_string('coursestatistics_documents', 'theme_mycampus_grid');
	$coursestatistics_users			= get_string('coursestatistics_users', 'theme_mycampus_grid');
	$coursestatistics_quizs			= get_string('coursestatistics_quizs', 'theme_mycampus_grid');
	$coursestatistics_questions		= get_string('coursestatistics_questions', 'theme_mycampus_grid');
	$coursestatistics_assesment		= get_string('coursestatistics_assesment', 'theme_mycampus_grid');
	$coursestatistics_userlogin		= get_string('coursestatistics_userlogin', 'theme_mycampus_grid');
	$coursestatistics_forums		= get_string('coursestatistics_forums', 'theme_mycampus_grid');
	$coursestatistics_posts			= get_string('coursestatistics_posts', 'theme_mycampus_grid');








	//print_R($CATE_DIR);
	//print_R($COURSE_DIR);
	global $SITE;
	print "<link rel=\"stylesheet\" type=\"text/css\" href=\"/theme/mycampus_1/style/style_4.css\" />\n";
	print "<link rel=\"stylesheet\" type=\"text/css\" href=\"/theme/mycampus_1/style/style_table.css\" />\n";
	print "
			<BR>
			<Table class=TableBlock width=960>
			<Tr class='TableContent'>
				<td colspan=31>".$coursestatistics."【".$SITE->shortname."】 $coursestatistics_updatedate :".date('Y-m-d')." $coursestatistics_orderdatarule</td>
			</tr>
			<Tr class='TableContent' align=center>
				<td colspan=1 nowrap>$coursestatistics_category_1</td>
				<td colspan=1 nowrap>$coursestatistics_category_2</td>
				<td colspan=1 nowrap title='Courseid'>id</td>
				<td colspan=1 nowrap>$coursestatistics_coursename</td>
				<td colspan=1 nowrap>$coursestatistics_teachername</td>
				<td colspan=1 nowrap>$coursestatistics_sections</td>
				<td colspan=1 nowrap>$coursestatistics_files</td>
				<td colspan=1 nowrap>$coursestatistics_documents</td>
				<td colspan=1 nowrap>PPT</td>
				<td colspan=1 nowrap>XLS</td>
				<td colspan=1 nowrap>DOC</td>
				<td colspan=1 nowrap>PDF</td>
				<td colspan=1 nowrap>FLV</td>
				<td colspan=1 nowrap>SWF</td>
				<td colspan=1 nowrap>$coursestatistics_users</td>
				<td colspan=1 nowrap>$coursestatistics_quizs</td>
				<td colspan=1 nowrap>$coursestatistics_questions</td>
				<td colspan=1 nowrap>$coursestatistics_assesment</td>
				<td colspan=1 nowrap>$coursestatistics_userlogin</td>
				<td colspan=1 nowrap>$coursestatistics_forums</td>
				<td colspan=1 nowrap>$coursestatistics_posts</td>
			</tr>
			";

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
			print "<Tr class='TableData' align=center>
						<td colspan=1 nowrap>$院系名称</td>
						<td colspan=1 nowrap>$专业名称</td>
						<td colspan=1 nowrap align=left>$id</td>
						<td colspan=1 nowrap align=left>$fullname</td>
						<td colspan=1 nowrap >".$GetCourseTeacherNumber_TEXT."</td>
						<td colspan=1 nowrap >".$GetCourseSectionNumber[$id]."</td>
						<td colspan=1 nowrap >".$得到某课程下面文件的数量."</td>
						<td colspan=1 nowrap >".$得到某课程下面文件的文档数量."</td>
						<td colspan=1 nowrap >".$得到某课程下面文件的数量PPT."</td>
						<td colspan=1 nowrap >".$得到某课程下面文件的数量XLS."</td>
						<td colspan=1 nowrap >".$得到某课程下面文件的数量DOC."</td>
						<td colspan=1 nowrap >".$得到某课程下面文件的数量PDF."</td>
						<td colspan=1 nowrap >".$得到某课程下面文件的数量FLV."</td>
						<td colspan=1 nowrap >".$得到某课程下面文件的数量SWF."</td>
						<td colspan=1 nowrap >".$GetCourseEnrollmentStudentNumber[$id]."</td>
						<td colspan=1 nowrap >".$GetCourseQuizNumber[$id]."</td>
						<td colspan=1 nowrap >".GetCourseQuestionNumber($id,$fullname)."</td>
						<td colspan=1 nowrap >".$得到课程的assign数量[$id]."</td>
						<td colspan=1 nowrap >".$GetCourseOneMouthActivesNumber[$id]."</td>
						<td colspan=1 nowrap >".$得到课程的讨论区数量ALL[$id]."</td>
						<td colspan=1 nowrap >".$得到课程的讨论帖子数量[$id]."</td>

					</tr>
				";
		}
	}


	print "</table>";


}

?>