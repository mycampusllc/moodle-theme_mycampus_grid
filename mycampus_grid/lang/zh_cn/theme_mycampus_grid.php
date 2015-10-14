<?php
/**
 * Strings for component 'theme_mycampus_grid', language 'en'
 *
 * @package   theme_mycampus_grid
 * @copyright Mycampus LLC
 * @website   http://www.mycampus.us
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$string['choosereadme'] = '
<div class="clearfix">
<div class="well">
<h2>mycampus_grid</h2>
<p><img class=img-polaroid src="mycampus_grid/pix/screenshot.jpg" /></p>
</div>
<div class="well">
<h3>关于mycampus_grid皮肤声明</h3>
<p>mycampus_grid 是由郑州单点科技开发,在Moodle bootstrap皮肤的基础上面形成.</p>
<p>本皮肤免费使用,但需要在网站下方显示[本皮肤由【单点魔灯】提供]字样,如需去除,请购买皮肤.</p>

<p>特性1:可以统计出系统里面每个老师的课程数,章节数,附件数,参与的学生数量,作业数,留言数,成绩数,讨论数等这些数据,形成一个老师的量化考核的基础数据,为行政管理提供直观图表。</p>
<p>特性2:可以在首页显示出热门课程(自动计算),以及精品课程(手动指定)。</p>
<p>特性3:可以在首页显示出系统最近30天的用户访问量以及系统访问量。</p>
<p>特性4:支持输出课程信息统计,课程分组统计,用户访问统计,教师活跃比例,学生活跃比例等五张统计报表。</p>

<p>注意:如果是LINUX系统,课程上传图片的时候,需要把/theme/mycampus_grid/images文件夹权限设置为777</p>
<p>开发商:郑州单点科技软件有限公司 王纪云</p>
<p>联系方式: 83102413@qq.com</p>
<p>官方网站: <a href="http://www.moodle360.cn">www.moodle360.cn</p>
</div></div>';

$string['configtitle']					= 'mycampus_grid';
$string['pluginname']					= 'mycampus_grid';

$string['wonderfulcourse']				= '精品课程';
$string['wonderfulcoursedesc']			= '精品课程:用于显示到首页的LOGO下部区域,精品课程的值,需要在下面手工指定';

$string['wonderfulcoursenumber']		= '精品课程内容';
$string['wonderfulcoursenumberdesc']	= '精品课程内容:直接列出课程的ID号,中间有半角的逗号隔开,如:1,2,3,4 最多显示四或五门课程';

$string['hotcourse']					= '热门课程';
$string['hotcoursedesc']				= '热门课程:根据最近60天的课程访问量得到具体要显示的课程,不需要人为干预,最多显示四或五门课程';

$string['isshowcoursedescinfor']		= '是否显示课程统计页面';
$string['isshowcoursedescinfordesc']	= '是:在首页点击课程链接的时候,显示课程统计页面,然后再进入课程;否:在首页点击课程链接的时候,直接进入课程页面.默认显示';

$string['day30userinfor']				= '最近30天用户活跃数统计拆线图';
$string['day30userinfordesc']			= '最近30天用户活跃数统计拆线图:默认显示';
$string['day30userinforunit']			= '用户活跃数 ( 个 )';

$string['day30accessinfor']				= '最近30天访问量统计拆线图';
$string['day30accessinfordesc']			= '最近30天访问量统计拆线图:默认显示';
$string['day30accessinforunit']			= '每天访问量 ( 次 )';

$string['adodbcacheseconds']			= '首页数据使用ADODB缓存的时间';
$string['adodbcachesecondsdesc']		= '单位:秒,如果对时效性要求不高,建议对这个值设到最大';

$string['indexshowcoursenumber']		= '首页热门课程以及精品课程显示的数量';
$string['indexshowcoursenumberdesc']	= '每行显示四门或五门课程';

$string['coursestatistics']				= '首页左侧的课程信息统计报表';
$string['coursestatisticsdesc']			= '默认:是';

$string['coursecategorystatistics']				= '首页左侧的课程分组统计报表';
$string['coursecategorystatisticsdesc']			= '默认:是';

$string['useraccessstatistics']					= '首页左侧的用户访问统计报表';
$string['useraccessstatisticsdesc']				= '默认:是';

$string['activeteachersstatistics']				= '首页左侧的教师活跃比例报表';
$string['activeteachersstatisticsdesc']			= '默认:是';

$string['activestudentsstatistics']				= '首页左侧的学生活跃比例报表';
$string['activestudentsstatisticsdesc']			= '默认:是';


$string['isshowlogo']							= '是否显示LOGO';
$string['isshowlogodesc']						= '是否显示LOGO:在首页中是否显示大LOGO图片,图片你可以在下面区域进行上传';

$string['logo']									= 'Logo';
$string['logodesc']								= '你可以上传自己的LOGO图片,宽度为:960px,高度用户可自行把握.格式为jpg.';

$string['footer']								= '页角显示';
$string['footerdesc']							= '在你MOODLE站点下面的页角部分显示.';

$string['region-side-post']						= 'Right';
$string['region-side-pre']						= 'Left';


$string['coursestatistics']							= "课程信息统计";
$string['coursecategorystatistics']					= "课程分组统计";
$string['useraccessstatistics']						= "用户访问统计";
$string['activeteachersstatistics']					= "教师活跃比例";
$string['activestudentsstatistics']					= "学生活跃比例";

$string['coursestatistics_updatedate']				= "数据更新";
$string['coursestatistics_orderdatarule']			= "排序规则:目录号,课程信息里面的排序号";
$string['coursestatistics_category_1']				= "院系(一级目录)";
$string['coursestatistics_category_2']				= "专业(二级目录)";
$string['coursestatistics_coursename']				= "课程";
$string['coursestatistics_teachername']				= "教师";
$string['coursestatistics_sections']				= "章节";
$string['coursestatistics_files']					= "文件数";
$string['coursestatistics_documents']				= "文档";
$string['coursestatistics_users']					= "用户";
$string['coursestatistics_quizs']					= "测验";
$string['coursestatistics_questions']				= "题库";
$string['coursestatistics_assesment']				= "作业";
$string['coursestatistics_userlogin']				= "用户登录";
$string['coursestatistics_forums']					= "讨论区";
$string['coursestatistics_posts']					= "帖子数";
$string['coursestatistics_actives']					= "综合活跃数";

$string['coursecategorystatistics_id']				= "序号";
$string['coursecategorystatistics_category']		= "院系";
$string['coursecategorystatistics_coursenumber']	= "课程门数";
$string['coursecategorystatistics_coursenumberincludedocument']				= "已有PPT等课程资源门数";
$string['coursecategorystatistics_percentage']		= "比例%";
$string['coursecategorystatistics_resourcesnumber']	= "课程资源数";
$string['coursecategorystatistics_total']			= "全校合计";

$string['indexpage_uploadimage']					= "图片上传完毕!,请返回到首页! 重要说明:由于系统的缓存机制,图片更新完以后不会立即刷新出来,稍等2分钟以后系统即可显示更新后的图片,请不要着急! ";
$string['indexpage_uploadimagebuttontitle']			= "课程图片修改";
$string['indexpage_uploadimagebuttonname']			= "提交";
$string['indexpage_gobacktoindexpage']				= "返回到首页";
$string['indexpage_uploadimagefailed']				= "图片上传失败,请确定文件上传正确以及可以访问临时文件目录!";
$string['indexpage_uploadimageformaterror']			= "图片上传格式不对,只支持JPG,GIF,PNG本种格式!";
$string['indexpage_statistics_name']				= "访问统计 【累计访问量:{a}次】";
$string['indexpage_statistics_name']				= "访问统计 【累计访问量:{a}次】";

$string['useraccessstatistics_table']					= "用户活跃比例【{a}】 数据更新:{b} 活跃用户占所有用户百分比:每天活跃的用户的数量除以所有用户的数量,最后显示的是百分比.【用户数量:{c}】";
$string['useraccessstatistics_table_date']				= "时间";
$string['useraccessstatistics_table_header_1']			= "活跃用户数量";
$string['useraccessstatistics_table_header_2']			= "活跃用户占所有用户百分比";
$string['useraccessstatistics_table_header_3']			= "活跃用户产生的页面访问量";
$string['useraccessstatistics_table_header_4']			= "平均每个用户产生的页面访问量";

$string['activeteachersstatistics_table']				= "教师活跃比例【{a}】 数据更新:{b} 活跃教师占所有教师比重:每天活跃的教师的数量除以所有教师的数量,最后显示的是百分比.【教师数量:{c}】";
$string['activeteachersstatistics_table_date']			= "时间";
$string['activeteachersstatistics_table_header_1']		= "活跃教师数量";
$string['activeteachersstatistics_table_header_2']		= "活跃教师占所有教师百分比";
$string['activeteachersstatistics_table_header_3']		= "活跃教师产生的页面访问量";
$string['activeteachersstatistics_table_header_4']		= "平均每个教师产生的页面访问量";


$string['activestudentsstatistics_table']				= "学生活跃比例【{a}】 数据更新:{b} 活跃学生占所有学生比重:每天活跃的学生的数量除以所有学生的数量,最后显示的是百分比.【学生数量:{c}】";
$string['activestudentsstatistics_table_date']			= "时间";
$string['activestudentsstatistics_table_header_1']		= "活跃学生数量";
$string['activestudentsstatistics_table_header_2']		= "活跃学生占所有学生百分比";
$string['activestudentsstatistics_table_header_3']		= "活跃学生产生的页面访问量";
$string['activestudentsstatistics_table_header_4']		= "平均每个学生产生的页面访问量";



