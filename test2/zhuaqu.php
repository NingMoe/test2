<?php
// error_reporting(0);
// ini_set('max_execution_time', '0');
set_time_limit(0);
header("Content-type:text/html;charset=utf-8");
include('class/cls_mysql.php');
	// $urls='http://www.dytt8.net/html/gndy/dyzz/20091005/22043.html';
	// $content=file_get_contents($urls);
	// $content= iconv('gb2312', 'utf-8//IGNORE', $content);
	// $title="/<div class=\"title_all\"><h1><font color=#07519a>.*?<\/font><\/h1><\/div>/ism";
	// if(preg_match_all($title, $content, $matches)){
	//    $info['title']=strip_tags($matches[0][0]);
	// }else{
	//    $info['title']='';
	// }
	// print_r($info);
	// exit;
$db_host='localhost:3306';
$db_database='tonghang';
$db_username='tonghang_f';
$db_password='Wn18W75u';
$db_charset='utf8';
$db = new cls_mysql($db_host, $db_username, $db_password, $db_database, $db_charset);

require_once(dirname(__FILE__).'/class/QueryList/QueryList.class.php');

$url=isset($_GET['url'])&&$_GET['url']?trim($_GET['url']):'http://www.dytt8.net/html/gndy/oumei/list_7_1.html';

$reg = array("url"=>array("a.ulink:eq(1)","href"),"title"=>array("a.ulink:eq(1)","html"));
$rang = "div.co_content8 table";
$hj = QueryList::Query($url,$reg,$rang,'curl','utf-8');
$arr = $hj->jsonArr;
$where='';
$time=time();
foreach ($arr as $key => $value) {
	$urls='http://www.dytt8.net'.$value['url'];
	$content=file_get_contents($urls);
	$content= iconv('gb2312', 'utf-8//IGNORE', $content);
	$title="/<div class=\"title_all\"><h1><font color=#07519a>.*?<\/font><\/h1><\/div>/ism";
	if(preg_match_all($title, $content, $matches)){
	   $info['title']=strip_tags($matches[0][0]);
	}else{
	   $info['title']='';
	}
    $sql="select id from dianying where title = '".addslashes($info['title'])."' or url='".$urls."'";
	if($db->getOne($sql))
		continue;
	$down="/<td style=\"WORD-WRAP: break-word\" bgcolor=\"#fdfddf\">.*?<\/td>/ism";
	if(preg_match_all($down, $content, $matches)){
	   $info['down_url']=strip_tags($matches[0][0]);
	}else{  
	   $info['down_url']='';
	}
	$regex4="/<div id=\"Zoom\".*?>.*?<\/div>/ism";
	if(preg_match_all($regex4, $content, $matches)){
	   $info['content']=$matches[0][0];
	}else{  
	   $info['content']='';  
	}
	$info['url']=$urls;
	$where .= "('".$info['title']."','".$info['down_url']."','".addslashes($info['content'])."','".$info['url']."','".$time."'),";
}
if($where){
	$where=rtrim($where,',');
	$sql="INSERT INTO dianying (title,down_url,content,url,add_time) VALUES $where";
	$db->query($sql);
	echo '执行成功';
}else
	echo '无数据';
exit;