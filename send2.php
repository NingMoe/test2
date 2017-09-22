<?php
error_reporting(0);
// ini_set('max_execution_time', '0');
set_time_limit(0);
// header("Content-type:text/html;charset=utf-8");
// $data['title']='ss';
// $data['content']='ss';
// $data['url']='ss';
// $data['down_url']='ss';
// $data['image']='ss';
$data=addslashes_deep($_POST);

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

// $sql="INSERT INTO dianying (title,content,url,down_url,image,add_time) VALUES ('".$data['title']."','".$data['content']."','".$data['url']."','".$data['down_url']."','".$data['image']."','".time()."')"; //电影
$sql="INSERT INTO xiaoshuo (title,content,url,type_id,add_time) VALUES ('".$data['title']."','".$data['content']."','".$data['url']."','1','".time()."')";

$query=mysql_query($sql);
mysql_close($connection);//关闭连接
// error_log( $sql."\n", 3, "cai3344.txt");
if($query)
	echo 1;
else{
	echo 0;
}
exit;

function addslashes_deep($value)
{
    if (empty($value))
    {
        return $value;
    }
    else
    {
        return is_array($value) ? array_map('addslashes_deep', $value) : addslashes(iconv('gbk', 'UTF-8', $value));
    }
}