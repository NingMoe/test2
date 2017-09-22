<?php
// error_reporting(0);
// ini_set('max_execution_time', '0');
set_time_limit(0);
header("Content-type:text/html;charset=utf-8");
include('../class/cls_mysql.php');
echo 68800*0.25;exit;
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
$db_database='kawo';
$db_username='root';
$db_password='root';
$db_charset='utf8';
$db = new cls_mysql($db_host, $db_username, $db_password, $db_database, $db_charset);

$sql="select down_url from dianying where title like '%2016%爱情%' order by id desc";
$list=$db->getAll($sql);
// echo count($list).'<br>';
foreach ($list as $value) {
    if($value)
        echo $value['down_url']."\n";
}