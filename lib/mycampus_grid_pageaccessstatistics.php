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

function mycampus_1_pageaccessstatistics($html)		{
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

	//得到用户的名单
	$sql = "SELECT distinct userid FROM mdl_role_assignments, mdl_context where mdl_role_assignments.contextid=mdl_context.id and (mdl_role_assignments.roleid=1 or mdl_role_assignments.roleid=2 or mdl_role_assignments.roleid=3 or mdl_role_assignments.roleid=4 or mdl_role_assignments.roleid=5)";
	$rs = $dbA->CacheExecute(3600,$sql);
	$rs_a = $rs->GetArray();
	$用户信息	= array();;
	for($i=0;$i<sizeof($rs_a);$i++)
	{
		$userid					= $rs_a[$i]['userid'];
		$用户信息[]				= $userid;
	}
	$用户数量					= count($用户信息);

	//print_R($用户信息);
	$得到每天系统登录的用户数量 = array();
	$datetime = mktime(0,1,1,date('m'),date('d')-60,date('Y'));
	$sql = "select COUNT(*) AS NUM,FROM_UNIXTIME(timecreated,'%m-%d') AS DATETIME from mdl_logstore_standard_log where timecreated > '$datetime' group by FROM_UNIXTIME(timecreated,'%m-%d') order by DATETIME";
	//print $sql;
	$rs = $dbA->CacheExecute($adodbcacheseconds,$sql);
	$rsC_a	= $rs->GetArray();
	for($i=0;$i<sizeof($rsC_a);$i++)			{
		$NUM			= $rsC_a[$i]['NUM'];
		$DATETIME		= $rsC_a[$i]['DATETIME'];
		$userid			= $rsC_a[$i]['userid'];
		$得到每天系统登录的用户数量['活跃用户数量'][$DATETIME]					= $NUM;
		$得到每天系统登录的用户数量['活跃用户占所有用户比重'][$DATETIME]		= number_format($NUM*100/$用户数量, 2, '.', '');;
		$得到每天系统登录的用户数量_X['活跃用户数量']				= $NUM;
		$得到每天系统登录的用户数量_X['活跃用户占所有用户比重']		= number_format($NUM*100/$用户数量, 2, '.', '');;
		$得到每天系统登录的用户数量_X_ALL['活跃用户数量']			+= $NUM;
		$得到每天系统登录的用户数量_Y[$DATETIME]					= $NUM;
	}

	$得到每天系统登录的用户数量_X_ALL['活跃用户占所有用户比重']	= number_format($得到每天系统登录的用户数量_X_ALL['活跃用户数量']*100/$用户数量, 2, '.', '');;

	$得到每天系统登录的用户数量_X = @array_keys($得到每天系统登录的用户数量_X);
	$得到每天系统登录的用户数量_Y = @array_keys($得到每天系统登录的用户数量_Y);

	//print_R($得到每天系统登录的用户数量);exit;
	//print_R($得到每天系统登录的用户数量);
	global $SITE;
	print "<link rel=\"stylesheet\" type=\"text/css\" href=\"/theme/mycampus_1/style/style_4.css\" />";
	print "<link rel=\"stylesheet\" type=\"text/css\" href=\"/theme/mycampus_1/style/style_table.css\" />";

	print "<BR>";

	//print_R($得到每天系统登录的用户数量);exit;

	print "<Table class=TableBlock width=960>";
	print "
		<Tr class='TableContent'>
			<td colspan=22>系统每天访问的用户次数【".$SITE->shortname."】 数据更新:".date('Y-m-d')." 说明:统计的行为包括登录,退出,查看,更新,创建等操作,这个图表主要用来反映用户在系统内的活跃情况.</td>
		</tr>
		";

	print "
			<Tr class='TableContent' align=center>
				<td colspan=1 nowrap>时间</td>
				<td colspan=1 nowrap>".join("</td><td colspan=1 nowrap>",$得到每天系统登录的用户数量_X)."</td>
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