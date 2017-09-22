<?php
// error_reporting(0);
// date_default_timezone_set('PRC'); //设置中国时区 
// ini_set('max_execution_time', '0');
// set_time_limit(0);
// echo ini_get('max_execution_time');exit;
// dirname(__FILE__);
header("Content-type:text/html;charset=utf-8");
include('function.php');
require_once '../aliyun-oss-php-sdk-2.2.4/autoload.php';
exit;

// echo 3783.4+3550.33;exit;
// // echo 1.2*7;exit;
// // echo strtoupper(md5('9chengming.com'));exit;
// // {"h5_info": {"type":"Wap","wap_url": "https://pay.qq.com","wap_name": "腾讯充值"}}
// echo json_encode(array('h5_info' => array(
// 	'type'=>'Wap',
// 	'wap_url'=>'https://pay.qq.com',
// 	'wap_name'=>'腾讯充值'
// 	)));
// exit;
// echo 318/7;exit;
// 50
// 8
// 12
// echo strtoupper(md5('SDK-GKG-010-00552636282'));exit;
// SDK-GKG-010-00552
// 636282
// $content="测试验证码哈咯呵呵";
// $url="http://sdk.entinfo.cn:8061/webservice.asmx/mdsmssend?sn=SDK-GKG-010-00552&pwd=D38B197F79955125494CD12910B8E4A1&mobile=13420246245&content=$content&ext=&stime=&rrid=&msgfmt=";
// $back=https_request($url);
// var_dump($back);
// exit;
// echo 45*2000;exit;
// echo 14*2000;exit;
// echo 5.5+34.7+9.3+16.9;exit;

// echo 81.1-27.9;exit;
// echo 270000-286200;exit;
// echo json_encode(array('error' => '0', 'message' => '没有错误'));
// var_dump(json_last_error());
// exit;
// $url='http://erp3.moco-paris.com:8181/erp/app/odJson/proc.action?do=getStoreInfo&procOutCursorCount=1';
// $url='http://lchengming.cn/wechat_shop-master/index.php/Api/Login/authlogin';
// $back=https_request($url);
// echo $back;
// exit;

// echo 68000*3;exit;
// echo 200000-(62+30)*2000;exit;
// echo 205000/2000/3;exit;

// $str = str_replace(PHP_EOL, '<br>', $ss);
// $s=explode('<br>',$ss);
// $a = get_defined_constants(TRUE) ;
// print_r($a);
// exit;
// echo function_exists('date_default_timezone_set');
// echo ini_get('date.timezone');
// exit;
// sleep(10);
// $star=microtime(true);
// for ($i=0; $i <1000 ; $i++) { 
//   // echo $i;
// }
// $end=microtime(true);
// echo $end-$star;
// exit;

// 数据库连接
// include('class/cls_mysql.php');
// // $db_host='localhost:3306';
// // $db_database='luna';
// // $db_username='root';
// // $db_password='root';
// $db_host='gz-cdb-d1gscpbw.sql.tencentcdb.com:63968';
// $db_database='test';
// $db_username='root';
// $db_password='BBBBBCFHc0OW1z';
// $db_charset='utf8';
// $db = new cls_mysql($db_host, $db_username, $db_password, $db_database, $db_charset);
// print_r($db);
// $users=$db->getAll("select * from lr_user");
// print_r($users);
// exit;

// 小票机
// include('class/print.class.php');
// $print = new Yprint();
// $content = "测试测试\n测试测试测试测试测试测试";
// $apiKey = "37bcb1972c920fb60383a687c30f9f2001004488";
// $msign = 'vndujt2hz3ku';
// // //打印
// // $print->action_print(407,'4004508952',$content,$apiKey,$msign);
// // $print->action_print(4843,'4004509769',$content,'37bcb1972c920fb60383a687c30f9f2001004488','ts254uzri4vt');
// $print->action_print(4843,'4004527606',$content,$apiKey,$msign);
// exit;

// 大鱼短信
// include_once('class/cls_alisms.php');
// // $alisms = new AliSms("23389337","e35d73d90f2b19257f4c28816ae0067a");
// // $result = $alisms->sign('布仓')->data(array('msg'=>$msg))->code('SMS_11076341')->send($phone_id);
// $alisms = new AliSms('23409628','f716f7d20fc410164a57664e36c1321b');
// $result = $alisms->sign('布仓')->data(array('msg'=>''))->code('SMS_77310077')->send('13420246245');
// print_r($result);
// exit;

// 发短信
// $content='【芊贝壳】验证码为901452（客服绝不会以任何理由索取此验证码，切勿告知他人），请在页面中输入以完成验证。';
// $url="http://112.74.139.4:8002/sms3_api/jsonapi/jsonrpc2.jsp?{'id':1,'method':'send','params':{'userid':'201693','password':'6bcf9c820d05a222ae3a3984a36f55df','submit':[{'content':'".urlencode($content)."','phone':'13420246245'}]}}";
// $back=https_request($url);
// print_r($back);
// exit;

// 采集
// require_once('/class/QueryList/QueryList.class.php');
// $url = "http://www.dytt8.net/html/gndy/rihan/list_6_24.html";
// $reg = array("url"=>array("a.ulink:eq(1)","href"),"title"=>array("a.ulink:eq(1)","html"));
// $rang = "div.co_content8 table";
// $hj = QueryList::Query($url,$reg,$rang,'curl','utf-8');
// $arr = $hj->jsonArr;
// print_r($arr);exit;

// 微信短信模板
// $template=array(
//     'touser' => 'ofruwwhIfG7_NQDROHsHt5VWqYeI',
//     'template_id' => 'fPjju5WWRVeeL9i2TPirQNigYPzatRTgRNsnskoM1Fc',
//     'topcolor'=>"#7B68EE",
//     'data'=>array(
//         'first'=>array('value'=>urlencode(iconv('gbk','utf-8',$first)),'color'=>"#FF0000"),
//         'keyword1'=>array('value'=>urlencode(iconv('gbk','utf-8',$keyword1)),'color'=>'#FF0000'),
//         'keyword2'=>array('value'=>urlencode(date("Y-m-d H:i:s",$keyword2)),'color'=>'#FF0000'),
//         'remark'=>array('value'=>urlencode(iconv('gbk','utf-8',$remark)),'color'=>'#FF0000') 
//     )
// );
// $json_template=json_encode($template);
// $url='https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=GaYs1S-B2awG6boAK7HIcVgwwQLFmThi6QCRH8Jfskh_uwqO8vVQqqb4F2SUulJgYawxa3_Jf93ZkMO-frfqJBC_CJBKGvTfBFNtmQgj_3U2AAXxswcChZ5dLJw3HVbdNBJcAEATHP';
// $back=https_request($url,$json_template);
// print_r($back);
// exit;

// 快递
// $shipping_info=get_kuaidi('EMS','9540583451501');
// // $shipping_info=get_kuaidi('圆通速递','884814179216307242');
// print_r($shipping_info);
// exit;

// 加密
// require_once "class/jiami.php";
// $text_auth = new text_auth(64);
// $text_file = 'test_jia.php'; 
// $str = @file_get_contents($text_file); 
// $str = $text_auth->encrypt($str, "test.com");
// $filename = 'test_jia2.php'; // 加密后的文本为二进制，普通的文本编辑器无法正常查看 
// file_put_contents($filename, $str);
// // 解密
// $text_auth = new text_auth(64); 
// $text_file = 'test_jia2.php';
// $str = @file_get_contents($text_file); 
// $str = $text_auth->decrypt($str, "test.com"); 
// $filename = 'test_jia3.php'; 
// file_put_contents($filename, $str); 
// exit;

// 百度接口
// $url = 'http://tingapi.ting.baidu.com/v1/restserver/ting?method=baidu.ting.billboard.billList&type=1&size=10&offset=0';
// $test=baiduapi($url);
// var_dump($test);
// exit;

// $postStr='<xml>
// <ToUserName><![CDATA[gh_58b4834492eb]]></ToUserName>
// <FromUserName><![CDATA[oGKPsjtInfRjm4Zgi3KOWXk_Yu8w]]></FromUserName>
// <CreateTime>1487754901</CreateTime>
// <MsgType><![CDATA[text]]></MsgType>
// <Content><![CDATA[璁剧疆鑿滃崟]]></Content>
// <MsgId>6389858644700185551</MsgId>
// <Encrypt><![CDATA[lsb3ZmTIFMBNyRxOxwwvIcQu5k0W0c8/67nYHwb5J5JYyxGgWDNN1Twqeas/f6n5nt2lKFe8QWtZmhAWbFikWmz6Vz3ilflBg9+nmtaxPKdVB84+0eNxk/Hxnqz/A9T24BarHdjOkSN1qCmOytIg7ixbUgca8E4w4qK62h2LeGWlTGT2Pm3v9tUO4oqzfBjo2U10HQbj08xx30jttAkc/Zm+Tzq50lxJiaBY3BP06CGiqyXDZins697ex/rEfv7HY1+yFf+OY5QX0WdYriIfPJv+Xfim618jGs7gWhHxDFvim8NSmVTAXjvCjvwTz7bzxiyx01uko2JH5lE76Jixx+RyE1yMvPh6vnuD+KIVFPzFnzZ0jNcqLV25Z4fiwzj4PDp8Ilvv5Y8mkrDF+7SG84UmKIIiInoJFxNdrMeR3KXucgLam5VXEHWdck+S/nDg/m3M+ZO5+UXMcJYRP6raVQ==]]></Encrypt>
// </xml>';
// // $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA); 
// $postObj= xmlToArray($postStr);
// print_r($postObj);
// exit;

// 邮件发送
$ds= send_mail('317205134@qq.com','哈哈','哈哈哈哈哈哈','test');
// $ds= send_mail('service@jyfame.com','哈哈','哈哈哈哈哈哈','test');
print_r($ds);
exit;

// 环信
// include('class/cls_huanxin.php');
// $rs = new Hxcall();
// $data=array(
//   array('username' => 'qwerasd111','password' => '123456','nickname' =>'福州1111'),
//   array('username' => 'qwerasd222','password' => '123456','nickname' =>'福州2222'),
//   );
// // echo $rs->hx_register($data);
// // echo $rs->hx_user_info('qwerasd333');
// // echo $rs->hx_user_delete('qwerasd111');
// // echo $rs->hx_send('qwerasd111','qwerasd222sss','dfadsr214wefaedf');
// // echo $rs->hx_contacts('qwerasd111', 'qwerasd222');
// // echo $rs->hx_contacts_user('qwerasd222');
// echo "ds";
// exit;

// 压缩
// include('class/phpzip.php');
// $file='./';
// $archive  = new PHPZip();
// // $filelist = $archive->visitFile($file); // 遍历文件
// // print "当前文件夹的文件:<p>\r\n";
// // foreach($filelist as $file)
// //     printf("%s<br>\r\n", $file);
// $archive->Zip($file, './case.zip'); // 压缩
// exit;
// // 解压缩
// $archive   = new PHPZip();
// $zipfile   = './case.zip';
// $savepath  = './mytest';
// // $zipfile   = $unzipfile;
// // $savepath  = $unziptarget;
// $array     = $archive->GetZipInnerFilesInfo($zipfile);
// $filecount = 0;
// $dircount  = 0;
// $failfiles = array();
// // set_time_limit(0);  // 修改为不限制超时时间(默认为30秒)
// for($i=0; $i<count($array); $i++) {
//     if($array[$i]['folder'] == 0){
//         if($archive->unZip($zipfile, $savepath, $i) > 0){
//             $filecount++;
//         }else{
//             $failfiles[] = $array[$i]['filename'];
//         }
//     }else{
//         $dircount++;
//     }
// }
// // set_time_limit(30);
// printf("文件夹:%d&nbsp;&nbsp;&nbsp;&nbsp;解压文件:%d&nbsp;&nbsp;&nbsp;&nbsp;失败:%d<br>\r\n", $dircount, $filecount, count($failfiles));
// if(count($failfiles) > 0){
//    foreach($failfiles as $file){
//        printf("&middot;%s<br>\r\n", $file);
//    }
// }
// exit;


require_once('/class/QueryList/QueryList.class.php');
$url = "http://storebt.org/s/笑话/0/0/1.html";
$reg = array("title"=>array("dl.item dt a","html"),"url"=>array("dl.item dt a","href"));
$rang = "";
//使用curl抓取源码并以GBK编码格式输出
$hj = QueryList::Query($url,$reg,$rang,'curl','utf-8');
$arr = $hj->jsonArr;
print_r($arr);
exit;


echo (53.5+5)*3;exit;
$value=array('aa','bb');
echo implode(',', $value);exit;
echo 55200*0.3;exit;
echo urldecode("%6E1%7A%62%2F%6D%615%5C%76%740%6928%2D%70%78%75%71%79%2A6%6C%72%6B%64%679%5F%65%68%63%73%77%6F4%2B%6637%6A");exit;


echo 42*2000;exit;
require_once('/class/QueryList/QueryList.class.php');
// 搜索笑话-1-2
// $content='';
$keyword = str_replace("搜索","",$keyword);
$temp=explode('-',$keyword);
$nowid=isset($temp[1])?intval($temp[1]):0;
$pages=isset($temp[2])?intval($temp[2]):1;

$many=isset($temp[3])?intval($temp[3]):0;

// $url = "http://storebt.org/s/笑话/0/0/1.html";
// $reg = array("title"=>array("dl.item dt a","html"),"url"=>array("dl.item dt a","href"));
// $rang = "";
// //使用curl抓取源码并以GBK编码格式输出
// $hj = QueryList::Query($url,$reg,$rang,'curl','utf-8');
// $arr = $hj->jsonArr;

$url = "http://www.dytt8.net/html/gndy/rihan/list_6_24.html";
$reg = array("url"=>array("a.ulink:eq(1)","href"),"title"=>array("a.ulink:eq(1)","html"));
$rang = "div.co_content8 table";
$hj = QueryList::Query($url,$reg,$rang,'curl','utf-8');
$arr = $hj->jsonArr;
print_r($arr);exit;

$time=strtotime("2017-3-23 17:30:00")-time();
$str='距离xx时间:'.time2string($time);
echo $str;exit;
echo hideStr($str,9,5);
exit;

$yourdate = strtotime(date("Y-m-01 00:00:00"));
$endday = strtotime(date('Y-m-d', mktime(23, 59, 59, date('m', strtotime($yourdate)) + 4, 00)));
// echo date('Y-m-d', mktime(23, 59, 59, date('m', strtotime($yourdate)) + 4, 00));
// echo $endday;exit;

require_once(dirname(__FILE__).'/class/QueryList/QueryList.class.php');
$url = "http://www.dytt8.net/html/gndy/rihan/list_6_24.html";
$reg = array("url"=>array("a.ulink:eq(1)","href"),"title"=>array("a.ulink:eq(1)","html"));
$rang = "div.co_content8 table";
$hj = QueryList::Query($url,$reg,$rang,'curl','utf-8');
$arr = $hj->jsonArr;
// $url = "http://www.dytt8.net/html/gndy/dyzz/20091121/23026.html";
// $reg = array("content"=>array("div#Zoom span","html"),"title"=>array("div.title_all font","html"));
// $rang = "body";
// $hj = QueryList::Query($url,$reg,$rang,'curl','utf-8');
// $arr = $hj->jsonArr;
// print_r($arr);
// exit;
// unset($arr);
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
 //    $sql="select id from dianying where title = '".addslashes($info['title'])."'";
	// if($db->getOne($sql))
	// 	continue;
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
	$where .= "('".$info['title']."','".$info['down_url']."','".$info['content']."','".$info['url']."','".$time."'),";
}
if($where){
	$where=rtrim($where,',');
	$sql="INSERT INTO dianying (title,down_url,content,url,add_time) VALUES $where";
	$db->query($sql);
}
echo '执行成功';
exit;
// $list=file_get_contents($url);
// print_r($list);
// exit;

for ($i = 8;  $i< 9; $i++)
{
	$content=file_get_contents('http://www.dytt8.net'.$arr[$i]['url']);
	$content= iconv('gb2312', 'utf-8//IGNORE', $content);
	$title="/<div class=\"title_all\"><h1><font color=#07519a>.*?<\/font><\/h1><\/div>/ism";
	if(preg_match_all($title, $content, $matches)){
		// print_r($matches);exit;
	   $info['title']=strip_tags($matches[0][0]);
	}else{  
	   $info['title']='';
	}
	$down="/<td style=\"WORD-WRAP: break-word\" bgcolor=\"#fdfddf\">.*?<\/td>/ism";
	if(preg_match_all($down, $content, $matches)){
		// print_r($matches);exit;
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
	$tmp[]=$info;
}
print_r($tmp);
exit;

$content=file_get_contents($url);
// print_r($content);
$down="/<td style=\"WORD-WRAP: break-word\" bgcolor=\"#fdfddf\">.*?<\/td>/ism";
if(preg_match_all($down, $content, $matches)){
	// print_r($matches);exit;
   $down_url=strip_tags($matches[0][0]);
}else{  
   $down_url='';
}
print_r($down_url);exit;
$regex4="/<div id=\"Zoom\".*?>.*?<\/div>/ism";
if(preg_match_all($regex4, $content, $matches)){
   $contents=$matches[0];
}else{  
   $contents='';  
}
exit;

/**
 * http请求
 * @ $url    请求的地址
 * @ $data   发送的参数
 */
function http_post_data($url, $data_string) {
		//对空格进行转义
		$url = str_replace(' ','+',$url);
		$ch = curl_init();
		//设置选项，包括URL
		curl_setopt($ch, CURLOPT_URL, "$url");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch,CURLOPT_TIMEOUT,3);  //定义超时3秒钟  
		 // POST数据
		curl_setopt($ch, CURLOPT_POST, 1);
		
		// 把post的变量加上
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data_string));    //所需传的数组用http_bulid_query()函数处理一下，就ok了
		
		//执行并获取url地址的内容
		$output = curl_exec($ch);
		var_dump(curl_error($ch));exit;
		$errorCode = curl_errno($ch);
		//释放curl句柄
		curl_close($ch);
		if(0 !== $errorCode) {
				return false;
		}
		return $output;
}