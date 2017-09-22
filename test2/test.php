<?php
// error_reporting(0);
// ini_set('max_execution_time', '0');
header("Content-type:text/html;charset=utf-8");
// echo function_exists('date_default_timezone_set');
// echo ini_get('date.timezone');
// exit;

require(dirname(__FILE__) . '/function.php');
$result = send_mail('317205134@qq.com','公众号','就成铭平台','就成铭平台log','log.txt');
print_r($result);
exit;