<?php
// error_reporting(0);
// ini_set('max_execution_time', '0');
set_time_limit(0);
header("Content-type:text/html;charset=utf-8");
// include('function.php');
// $content=file_get_contents('cai22.txt');

$title=$_GET['title'];
$title=iconv('gbk', 'UTF-8', $title);

$db_host='localhost:3306';
$db_database='kawo';
$db_username='root';
$db_password='root';

$connection=mysql_connect($db_host,$db_username,$db_password);//连接到数据库
mysql_query("set names 'utf8'");//编码转化
if(!$connection){
    echo 'could not to the database';
    exit;
}
$db_selecct=mysql_select_db($db_database);//选择数据库

// $query="select id from dianying where title='".$title."'";//电影
$query="select id from xiaoshuo where title='".$title."'";//小说

$result=mysql_query($query);//执行查询
if(!$result){
    echo 'could not to the database';
    exit;
}
$result_row=mysql_fetch_row($result);
mysql_close($connection);//关闭连接

// 是否存在
if($result_row)
	echo 1;
else
	echo 0;