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

function activeteachersstatistics($html)		{
	global $dbA,$adodbcacheseconds,$indexshowcoursenumber,$CFG;
	$indexshowcoursenumber	= $html->indexshowcoursenumber;
	$adodbcacheseconds		= $html->adodbcacheseconds;

	$sql = "select firstname,id,username,lastname from mdl_user";
	//echo $sql."<br>";
	$rs = $dbA->CacheExecute($adodbcacheseconds,$sql);
	$rs_a = $rs->GetArray();
	$用户信息	= array();;
	for($i=0;$i<sizeof($rs_a);$i++)
	{
		$userid					= $rs_a[$i]['id'];
		$用户信息[$userid]		= $rs_a[$i]['firstname'].$rs_a[$i]['lastname'];
	}
	//print_R($用户信息);

	//得到教师的名单
	$sql = "SELECT distinct userid FROM mdl_role_assignments, mdl_context where mdl_role_assignments.contextid=mdl_context.id and (mdl_role_assignments.roleid=2 or mdl_role_assignments.roleid=3 or mdl_role_assignments.roleid=4)";
	$rs = $dbA->CacheExecute(3600,$sql);
	$rs_a = $rs->GetArray();
	$教师信息	= array();;
	for($i=0;$i<sizeof($rs_a);$i++)
	{
		$userid					= $rs_a[$i]['userid'];
		$教师信息[]				= $userid;
	}
	$教师数量					= count($教师信息);

	$得到每天系统登录的用户数量 = array();
	$datetime = mktime(0,1,1,date('m'),date('d')-60,date('Y'));
	$sql = "select COUNT(*) AS PAGE_NUM,COUNT(distinct userid) AS NUM,FROM_UNIXTIME(timecreated,'%m-%d') AS DATETIME from mdl_logstore_standard_log where timecreated > '$datetime' and userid in ('".join("','",$教师信息)."') group by FROM_UNIXTIME(timecreated,'%m-%d') order by DATETIME";
	//print $sql;
	$rs = $dbA->CacheExecute($adodbcacheseconds,$sql);
	$rsC_a	= $rs->GetArray();
	for($i=0;$i<sizeof($rsC_a);$i++)			{
		$PAGE_NUM		= $rsC_a[$i]['PAGE_NUM'];
		$NUM			= $rsC_a[$i]['NUM'];
		$DATETIME		= $rsC_a[$i]['DATETIME'];
		$userid			= $rsC_a[$i]['userid'];

		$得到每天系统登录的用户数量['活跃教师数量'][$DATETIME]								= $NUM;
		$得到每天系统登录的用户数量['活跃教师占所有教师百分比'][$DATETIME]					= number_format($NUM*100/$教师数量, 2, '.', '');;
		$得到每天系统登录的用户数量['活跃教师产生的页面访问量'][$DATETIME]					= $PAGE_NUM;
		$得到每天系统登录的用户数量['平均每个教师产生的页面访问量'][$DATETIME]				= (int)($PAGE_NUM/$NUM);

		$得到每天系统登录的用户数量_X_ALL['活跃教师数量']			+= $NUM;
		$得到每天系统登录的用户数量_Y[$DATETIME]					= $NUM;
	}

	$得到每天系统登录的用户数量_X_ALL['活跃教师占所有教师比重']	= number_format($得到每天系统登录的用户数量_X_ALL['活跃教师数量']*100/$教师数量, 2, '.', '');;

	$得到每天系统登录的用户数量_X = @array_keys($得到每天系统登录的用户数量);
	$得到每天系统登录的用户数量_Y = @array_keys($得到每天系统登录的用户数量_Y);

	//为了适应多语言的支持,得到每天系统登录的用户数量_XX 的值需要单独指定,顺序以及多少跟原来一样
	$得到每天系统登录的用户数量_XX	= array();
	$得到每天系统登录的用户数量_XX[] = get_string('activeteachersstatistics_table_header_1', 'theme_mycampus_grid');
	$得到每天系统登录的用户数量_XX[] = get_string('activeteachersstatistics_table_header_2', 'theme_mycampus_grid');
	$得到每天系统登录的用户数量_XX[] = get_string('activeteachersstatistics_table_header_3', 'theme_mycampus_grid');
	$得到每天系统登录的用户数量_XX[] = get_string('activeteachersstatistics_table_header_4', 'theme_mycampus_grid');

	//print_R($得到每天系统登录的用户数量);exit;
	//print_R($得到每天系统登录的用户数量);
	global $SITE;
	print "<link rel=\"stylesheet\" type=\"text/css\" href=\"/theme/mycampus_grid/style/style_4.css\" />";
	print "<link rel=\"stylesheet\" type=\"text/css\" href=\"/theme/mycampus_grid/style/style_table.css\" />";

	print "<BR>";

	$activeteachersstatistics_table				= get_string('activeteachersstatistics_table', 'theme_mycampus_grid');
	$activeteachersstatistics_table				= str_replace("{a}",$SITE->shortname,$activeteachersstatistics_table);
	$activeteachersstatistics_table				= str_replace("{b}",date("Y-m-d"),$activeteachersstatistics_table);
	$activeteachersstatistics_table				= str_replace("{c}",$教师数量,$activeteachersstatistics_table);

	$activeteachersstatistics_table_date		= get_string('activeteachersstatistics_table_date', 'theme_mycampus_grid');

	//print_R($得到每天系统登录的用户数量);exit;

	print "<Table class=TableBlock width=960>";
	print "
		<Tr class='TableContent'>
			<td colspan=22>$activeteachersstatistics_table</td>
		</tr>
		";

	print "
			<Tr class='TableContent' align=center>
				<td colspan=1 nowrap>$activeteachersstatistics_table_date</td>
				<td colspan=1 nowrap>".join("</td><td colspan=1 nowrap>",$得到每天系统登录的用户数量_XX)."</td>
			</tr>
			";

	for($i=0;$i<sizeof($得到每天系统登录的用户数量_Y);$i++)									{
		$得到每天系统登录的用户数量_Y_KEY = $得到每天系统登录的用户数量_Y[$i];
		print "<Tr class='TableData' align=center>
				<td colspan=1 nowrap>".$得到每天系统登录的用户数量_Y_KEY."</td>
				";
		for($xi=0;$xi<sizeof($得到每天系统登录的用户数量_X);$xi++)							{
			$得到每天系统登录的用户数量_X_KEY = $得到每天系统登录的用户数量_X[$xi];
			print "<td colspan=1 nowrap>".$得到每天系统登录的用户数量[$得到每天系统登录的用户数量_X_KEY][$得到每天系统登录的用户数量_Y_KEY]."</td>";
		}
		print "</tr>";
	}

	print "</table>";

}

?>