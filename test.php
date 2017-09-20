<?php
include('cls_mysql.php');
// $db_host='gz-cdb-d1gscpbw.sql.tencentcdb.com:63968';
$db_host='172.16.0.5:3306';
$db_database='test';
$db_username='root';
$db_password='BBBBBCFHc0OW1z';
$db_charset='utf8';
$db = new cls_mysql($db_host, $db_username, $db_password, $db_database, $db_charset);
print_r($db);
$users=$db->getAll("select * from lr_user");
print_r($users);
exit;