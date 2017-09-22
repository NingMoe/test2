<?php
// error_reporting(0);
// ini_set('max_execution_time', '0');
set_time_limit(0);
header("Content-type:text/html;charset=utf-8");

include('class/cls_mysql.php');
$db_host='localhost:3306';
$db_database='kawo';
$db_username='root';
$db_password='root';
$db_charset='utf8';
$db = new cls_mysql($db_host, $db_username, $db_password, $db_database, $db_charset);

// $goods_list=$db->getOne("select count(*) from xiaoshuo");
// print_r($goods_list);
// exit;

// $arr['type_id']='1';
// $arr['title']='3838.第3838章 灭门（十二）';
// $arr['content']='&nbsp;&nbsp;&nbsp;&nbsp;但自古天赋异禀之人就拥有不曲意逢迎他人的权利，所以冷瑶光有资格跟他这样说话。<br />
// <br />
// &nbsp;&nbsp;&nbsp;&nbsp;“平陵世家一事我已经查清，这件事本不是你的错，有兽潮一难，是平陵世家自作自受，主神殿一定会秉公持正，决不让神界众神寒心。”<br />
// <br />
// &nbsp;&nbsp;&nbsp;&nbsp;子余主神的态度很明朗，他是绝对不会帮平陵世家的，从前平陵世家效仿伏氏一族干的那些龌龊事他看在眼里，但只要他们不污染风动大神界，他也就睁一只眼闭一只眼了，今天这件事要是主神殿真的当了睁眼瞎，从此风动大神界将声名扫地，与他界来往有些磕绊倒没什么，最怕的便是众神离界。<br />
// <br />
// &nbsp;&nbsp;&nbsp;&nbsp;神界的强大，最实在的，便是神的数量。<br />
// <br />
// &nbsp;&nbsp;&nbsp;&nbsp;“主神殿打算如何处置？”瑶光挑眉。<br />
// <br />
// &nbsp;&nbsp;&nbsp;&nbsp;“陨落的主神主神殿不再追究责任，也绝不会让人事后寻仇，权良主神和平陵世家就交由主神殿发落，圣灵神女意下如何？”子余主神给足了面子。<br />
// <br />
// &nbsp;&nbsp;&nbsp;&nbsp;然而瑶光不满意，她面色微沉，“主神要如何处置是你主神殿的事，只要他不来找我麻烦，我也不会计较他们挟持九羽凤逼迫我和玉邪一事，但平陵世家我绝对不会放过！”<br />
// <br />
// &nbsp;&nbsp;&nbsp;&nbsp;将子余主神的大度放她一马直接扭转成了她不计前嫌不计较主神殿找她麻烦的事，这便是将她和主神殿放在了同等的位置上。<br />
// <br />
// &nbsp;&nbsp;&nbsp;&nbsp;若是换了其他的小神，主神殿肯提出这样的条件，无异于是主神对其低了半个头，见好就收才是正理，正当主神殿非要迁就她不可了？<br />
// <br />
// &nbsp;&nbsp;&nbsp;&nbsp;“圣灵神女，你莫要太过，”子余主神身后的奉仪主神警告道：“纵然平陵世家和权易主神有错在先，但你杀死主神，又引来兽潮涂炭平陵世家，这也是重罪！”<br />
// <br />
// &nbsp;&nbsp;&nbsp;&nbsp;“呵！”瑶光头轻轻一偏，那笑容便仿佛浸入了寒冰之中，“我就是这样一个睚眦必报的人，我不惹人，他们也最好不要来惹我，平陵世家险些毁我灵根，这个仇，灭他三次都不够解气，更何况他们还敢冒五行神尊名讳为自己牟利，更该死！”<br />
// <br />
// &nbsp;&nbsp;&nbsp;&nbsp;子余主神拦住还要说话的奉仪主神，沉吟之后问道：“那你想怎么样？”<br />
// <br />
// &nbsp;&nbsp;&nbsp;&nbsp;“我要风动大神界从此以后再无平陵这个姓氏！”<br />
// <br />
// &nbsp;&nbsp;&nbsp;&nbsp;举众哗然，就连在旁看热闹的神们都震惊了，这要求可够狠了，若是让主神殿处置，平陵世家说不定不久就可以东山再起，要是按照她说的去做，那么平陵世家便真的要散了！<br />
// <br />
// &nbsp;&nbsp;&nbsp;&nbsp;“猖狂，难道你要杀尽平陵世家满门吗？”权良主神几乎是脱口而出地吼叫起来，要是子余主神真答应了这个条件，平陵世家树倒猢狲散，他势单力薄，结果也可想而知！<br />
// <br />
// &nbsp;&nbsp;&nbsp;&nbsp;“我之前就说过了，”瑶光淡淡道：“降者不杀，自然离开平陵世家的就与我无仇无怨，而且我还可以化解他们也夜凤族之间的仇恨，至于平陵世家的家主和嫡系血脉……”<br />
// <br />
// &nbsp;&nbsp;&nbsp;&nbsp;扫过平陵世家等人紧张的面孔，她微微笑起来，“要是立下天道誓言不来找我寻仇，我也不是不能放过！”
// ';
// $arr['url']='http://www.69shu.com/txt/15536/16497191';
// $arr['add_time']='1483685053';
// $arr['zhangjie']='3838';
// $db->autoExecute('xiaoshuo', $arr, 'INSERT');
// exit;

// 查询遗漏zhangjie;
// $goods_list=$db->getAll("select zhangjie from xiaoshuo order by zhangjie asc");
// $i=1719;
// foreach ($goods_list as $key => $value) {
// 	if($value['zhangjie']!=$i)
// 		test($value['zhangjie']);
// 	$i++;
// }
// print_r($goods_list);
// exit;
// function test($data) {
// 	echo $GLOBALS["i"]."\n";
// 	$GLOBALS["i"]+=1;
// 	if($data!=$GLOBALS["i"])
// 		test($data);
// 	else
// 		return $GLOBALS["i"];
// }
// echo (3840-1955)/400;
// exit;

$start='801';
$goods_list=$db->getAll("select title,content from xiaoshuo where zhangjie >= $start order by zhangjie asc limit 400");
$str='';
foreach ($goods_list as $key => $value) {
	// $str=strip_tags($value['content'])."\n";
	$value['content']=str_replace('&nbsp;',' ',$value['content']);
	$value['content']=str_replace('<br />',"\r\n",$value['content']);
	$str.=$value['title']."\r\n\r\n".$value['content']."\r\n\r\n\r\n";
}
file_put_contents($start.'-'.($start+399).'.txt',$str);
exit;


// $goods_list=$db->getAll("select id, left (title,4) as zhangjie from xiaoshuo");
// foreach ($goods_list as $k => $v) {
// 	$db->query("update xiaoshuo set zhangjie='$v[zhangjie]' where id='$v[id]'");
// }
// print_r($goods_list);
// exit;
