<?php
set_time_limit(0);
header("Content-type:text/html;charset=utf-8");
include('cls_mysql.php');

$db_host='localhost:3306';
$db_database='tonghang';
$db_username='tonghang_f';
$db_password='Wn18W75u';
$db_charset='utf8';

$db = new cls_mysql($db_host, $db_username, $db_password, $db_database, $db_charset);
$type=isset($_GET['type'])&&$_GET['type']?intval($_GET['type']):0;
switch ($type) {
    case 0:
        echo "http://v.9chengming.com/dianying/test.php?type=";
        break;
    case 1: // 查找全部
        $sql="select title,content from dianying";//构建查询语句
        $list=$db->getAll($sql);
        foreach ($list as $value) {
            if($value)
                printf("%s<br>%s<br>\r\n", $value['title'],$value['content']);
        }
        break;
    case 2: //模糊查找
        $sql="select title,content from dianying where title like '%".addslashes($_GET['title'])."%'";
        $list=$db->getAll($sql);
        echo count($list).'<br>';
        foreach ($list as $value) {
            if($value)
                printf("%s<br>%s<br>\r\n", $value['title'],$value['content']);
        }
        break;
    case 3: //精确查找
        $sql="select down_url from dianying where title = '".addslashes($_GET['title'])."'";
        $down_url=$db->getOne($sql);
        if($down_url)
            echo $down_url;
        else
            echo '无下载地址';
        break;
    case 4: //所有链接地址
        $sql="select down_url from dianying";
        $list=$db->getCol($sql);
        foreach ($list as $value) {
            if($value)
                printf("%s<br>\r\n", $value);
        }
        break;
    default:
        echo "http://v.9chengming.com/dianying/test.php?title=";
        break;
}

exit;