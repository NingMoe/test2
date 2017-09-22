<?php
// error_reporting(0);
// ini_set('max_execution_time', '0');
// set_time_limit(0);
// echo ini_get('max_execution_time');exit;
header("Content-type:text/html;charset=utf-8");
// include('function.php');
// include('class/cls_mysql.php');

set_time_limit(0);
require_once(dirname(__FILE__).'/class/QueryList/QueryList.class.php');
//列表 第一页
// $url = "http://www.izaojiao.com/jigou/guangzhou/all";
// $reg = array("diqu"=>array(".gray2 a:eq(0)","html"),"url"=>array(".tu a:eq(0)","href"));
// $rang = ".sou";
// //使用curl抓取源码并以GBK编码格式输出
// $hj = QueryList::Query($url,$reg,$rang,'curl','utf-8');
// $arr = $hj->jsonArr;

$url = "http://storebt.org/s/%E7%94%B5%E5%AD%90/0/0/1.html";
$url = "http://storebt.org/s/%e7%8f%ad%e8%8a%b1%e5%95%aa/0/0/1.html";
$url = "http://storebt.org/s/笑话/0/0/1.html";
$reg = array("title"=>array("dl.item dt a","html"),"url"=>array("dl.item dt a","href"));
$rang = "";
//使用curl抓取源码并以GBK编码格式输出
$hj = QueryList::Query($url,$reg,$rang,'curl','utf-8');
$arr = $hj->jsonArr;
// print_r($arr);exit;
for ($i = 0;  $i< count($arr); $i++) 
// for ($i = 0;  $i< 1; $i++) 
{
    //详细页
    $url = $arr[$i]['url'];
    $regs = array(
            "url"=>array(".magnet a","href")
            );
    $hj = QueryList::Query($url,$regs);
    $tmps=$hj->jsonArr;
    // echo urldecode($tmps[0]['url'])."\r";
    $tmp[]=$tmps[0]['url'];
}
print_r($tmp);exit;