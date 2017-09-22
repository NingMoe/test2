<?php
// error_reporting(0);
// ini_set('max_execution_time', '0');
// set_time_limit(0);
// echo ini_get('max_execution_time');exit;
header("Content-type:text/html;charset=utf-8");
include('function.php');
include('class/cls_mysql.php');
include('class/print.class.php');

$aa=1;
$bb=2;
echo $aa+$bb;exit;
//  $text_file = 'test_jia.php'; 
//  $str = @file_get_contents($text_file); 

//  require_once "class/jiami.php";
//  $text_auth = new text_auth(64);

//  $str = $text_auth->encrypt($str, "test.com");
//  $filename = 'test_jia2.php'; // 加密后的文本为二进制，普通的文本编辑器无法正常查看 
//  file_put_contents($filename, $str);
// // 解密过程
// exit;

 $text_file = 'test_jia2.php';
 $str = @file_get_contents($text_file); 
 require_once "class/jiami.php"; 
 $text_auth = new text_auth(64); 

 $str = $text_auth->decrypt($str, "test.com"); 

 $filename = 'test_jia3.php'; 
 file_put_contents($filename, $str); 
exit;


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

// echo 280000/3/2000;exit;
// echo 55.3-19.4;exit;
// echo 55.3*0.35;exit;
// echo 55.3/2;exit;
// echo 270000/2000/3;exit;
// echo 250000/2000/3;exit;
// echo 14*7;
// exit;
// // $print = new Yprint();
// // $content = "测试测试";
// // $apiKey = "xxxxxx";
// // $msign = 'xxxxxx';
// // //打印
// // $print->action_print(407,'4004508952',$content,$apiKey,$msign);
// // $print->action_print(4843,'4004509769',$content,'37bcb1972c920fb60383a687c30f9f2001004488','ts254uzri4vt');
// exit;

// echo 331800-280000;exit;
// echo 46.6-4.7;exit;
// echo 46.6*0.1;exit;
// echo 180*2000-280000;exit;
// // echo 280000-(2000*60);exit;
// echo 3000+150*12;exit;
$keyword='搜索笑笑-1-2-3';
$keyword = str_replace("搜索","",$keyword);
$temp=explode('-',$keyword);
$pages=isset($temp[2])?intval($temp[2]):1;
$nowid=isset($temp[1])?intval($temp[1]):0;
print_r($temp);
exit;
echo 32*0.3;exit;
$a=1;
$GLOBALS['a']=2;
echo $a;exit;
echo $GLOBALS['a'];exit;

$url='http://apis.baidu.com/apistore/wooyun/public?limit=10';
$test=baiduapi($url);
var_dump($test);
exit;
echo dirname(__FILE__);exit;
echo 904/40;exit;
// $status= get_headers('http://www.baidu.com');
// print_r($status);
// 0.5+0.5+1+0.5+2+1
echo 3787-2112;exit;
echo 30*2000;exit;
echo 63400.0+29400*0.9;exit;
exit;
// echo 47500/2000;exit;
// echo 5500/2000;exit;

echo 30+13+12;exit;  //48
echo 30*(1+0.6);exit;  //48


echo 1.4*2000;exit;
echo 6.3*2000;exit;
echo 17.2*2000;exit;
echo 20*2000;exit;

// echo (15.2+5)*(1+0.3);exit;
// echo (13.2+5)*(0.3);exit;
echo 6.6+4.5+15.2;exit;


echo number_format(3333333.333333, 2, '.', '');exit;
echo sprintf("%01.00f",1);;exit;
echo 69/12;exit; 
echo date('Y-m-d','1495097706');exit;
$aa=array('a','b','中文');
$aa=json_encode($aa);
print_r($aa);
print_r(json_decode($aa,true));
$bb='["a","b","\u4e2d\u6587"]';
print_r(json_decode($bb,true));
// exit;
$test='{"rank_name":null,"next_rank":600,"next_rank_name":""}';
// $test='["a","b","\u4e2d\u6587"]';
var_dump(json_decode($test,true));
exit;
// exit;
// 1、变更套餐次月生效。
// 2、至享产品上网版套餐生效后：每月1号扣取当月套餐费。
// 3、电信/联通至简产品生效后：
// （1）每月1号扣取当月来电显示功能费。
// （2）来电显示为必开业务，无法取消。
// 4、至惠年卡2.0版本C50/C100/W50/C100套餐生效后：
// （1）套餐生效时一次性收取年费，如有效期内需要销户，年费则不予退还。
// （2）有效期内变更为其他产品，则年卡有效期内剩余资源不再赠送，按照新套餐资费收取。
// （3）年卡有效期到期后，未变更其他产品，则自动按照原套餐费标准续期一年。
// 5、享聊套餐生效后，每月1号扣取当月套餐费。
// 6、至和产品新入网送话费版套餐生效后：
// （1）每月1号扣取当月套餐费；
// （2）合约期内变更为其他产品，产品变更生效当月起停止赠送话费。
// （3）合约期内变更为其他档次套餐，套餐变更生效次月起按照新套餐标准赠送话费。
// （4）全月停机的状态下，全月停机当月不再赠送话费。
// 7、游无忌套餐生效后:每月1号扣取当月套餐费。 
// echo (600-300)/15;exit;
// echo (360-180)/15;exit;
// echo 759.75-258.34;exit;
// 'EMS','9540583451501'

// echo randCode(5,1);
// exit;
// $shipping_info=get_kuaidi('EMS','9540583451501');
$shipping_info=get_kuaidi('圆通速递','884814179216307242');
print_r($shipping_info);
exit;

function get_kuaidi($ecs,$num){
    $getcom = $ecs;


// 快递100查询接口专用KEY，申请KEY地址：http://www.kuaidi100.com/openapi/
// $kuaidi100key = "b0c887c349f3d126";

/*
提示：如果您需要的公司不在以下列表，请按以下方法自行添加或修改，快递公司名称区分大小写
case "与【shopex后台-商店配置-物流公司】下的公司名称一致":
$postcom '中的名称与【http://code.google.com/p/kuaidi-api/wiki/Open_API_API_URL】下的【快递公司代码】一致’;
*/
// $kuaidi100key = "b0c887c349f3d126";
// $customer = "b0c887c349f3d126";
$kuaidi100key = "VMqzVUAb6146";
$customer = "D79FFD47A0669B83CCFC2F5E3D68730D";
$kuaidi100key = "zczXPylZ1784";
$customer = "32514028908689846F531CF2D1D95D71";
switch ($getcom){
  case "EMS"://ecshop后台中显示的快递公司名称
    $postcom = 'ems';//快递公司代码
    break;
  case "中国邮政":
    $postcom = 'ems';
    break;
  case "申通快递":
    $postcom = 'shentong';
    break;
  case "圆通速递":
    $postcom = 'yuantong';
    break;
  case "顺丰速运":
    $postcom = 'shunfeng';
    break;
  case "天天快递":
    $postcom = 'tiantian';
    break;
  case "韵达快递":
    $postcom = 'yunda';
    break;
  case "中通速递":
    $postcom = 'zhongtong';
    break;
  case "龙邦物流":
    $postcom = 'longbanwuliu';
    break;
  case "宅急送":
    $postcom = 'zhaijisong';
    break;
  case "全一快递":
    $postcom = 'quanyikuaidi';
    break;
  case "汇通速递":
    $postcom = 'huitongkuaidi';
    break;  
  case "民航快递":
    $postcom = 'minghangkuaidi';
    break;  
  case "亚风速递":
    $postcom = 'yafengsudi';
    break;  
  case "快捷速递":
    $postcom = 'kuaijiesudi';
    break;  
  case "华宇物流":
    $postcom = 'tiandihuayu';
    break;  
  case "中铁快运":
    $postcom = 'zhongtiewuliu';
    break;    
  case "百世汇通":
    $postcom = 'huitongkuaidi';
    break;
  case "全峰快递":
    $postcom = 'quanfengkuaidi';
    break;
  case "德邦":
    $postcom = 'debangwuliu';
    break;
  case "FedEx":
    $postcom = 'fedex';
    break;    
  case "UPS":
    $postcom = 'ups';
    break;    
  case "DHL":
    $postcom = 'dhl';
    break;    
  default:
    $postcom = '';
}


    $post_data = array();
    $post_data["customer"] = $customer;
    $key= $kuaidi100key ;
    $post_data["param"] = '{"com":"'.$postcom.'","num":"'.$num.'"}';
    $url='http://poll.kuaidi100.com/poll/query.do';
    $post_data["sign"] = md5($post_data["param"].$key.$post_data["customer"]);
    $post_data["sign"] = strtoupper($post_data["sign"]);
    $o="";
    $arr1 = array();
    foreach ($post_data as $k=>$v)
    {
        $o.= "$k=".urlencode($v)."&";   //默认UTF-8编码格式
    }
    $post_data=substr($o,0,-1);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
    $result = curl_exec($ch);
    $data = str_replace("\&quot;",'"',$result );
    $data = json_decode($data,true);
    return $data;
}


echo (360)/15;exit;
echo 58000*0.2;exit;
echo 30000*0.4;exit;
// echo 4.5/5*100;exit;
// echo 20-(21.02-10.46-2);  //9
// echo 20-(21.55-11.44-2); //10
// echo 20-(24.45-11.89-2); //11
// echo 20-(24.45-9.44-2); //12
// echo 20-(25.28-6.99-2); //1
// echo 20-(46.28-3.71-2); //2
// echo (21.02+21.55+24.45+24.45+25.28)-2*5;
//3.71
// echo 8*8*300;
// echo 600*2/500;
// exit;
// echo 101-101*0.1;
// exit;



$template=array(
    'touser' => 'ofruwwhIfG7_NQDROHsHt5VWqYeI',
    'template_id' => 'fPjju5WWRVeeL9i2TPirQNigYPzatRTgRNsnskoM1Fc',
    'topcolor'=>"#7B68EE",
    'data'=>array(
        'first'=>array('value'=>urlencode(iconv('gbk','utf-8',$first)),'color'=>"#FF0000"),
        'keyword1'=>array('value'=>urlencode(iconv('gbk','utf-8',$keyword1)),'color'=>'#FF0000'),
        'keyword2'=>array('value'=>urlencode(date("Y-m-d H:i:s",$keyword2)),'color'=>'#FF0000'),
        'remark'=>array('value'=>urlencode(iconv('gbk','utf-8',$remark)),'color'=>'#FF0000') 
    )
);
$json_template=json_encode($template);
$url='https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=GaYs1S-B2awG6boAK7HIcVgwwQLFmThi6QCRH8Jfskh_uwqO8vVQqqb4F2SUulJgYawxa3_Jf93ZkMO-frfqJBC_CJBKGvTfBFNtmQgj_3U2AAXxswcChZ5dLJw3HVbdNBJcAEATHP';
$back=https_request($url,$json_template);
print_r($back);
exit;
































echo 50*2.1;

exit;

$time=strtotime("2017-3-23 17:30:00")-time();
$str='距离下班时间:'.time2string($time);
echo $str;exit;
echo hideStr($str,9,5);
exit;

echo 23*1.0001;exit;

 class Db{
   const DB_HOST='localhost';
   const DB_NAME='';
   const DB_USER='';
   const DB_PWD='';
   private $_db;
   //保存实例的私有静态变量
   private static $_instance;
   //构造函数和克隆函数都声明为私有的
   private function __construct(){
    //$this->_db=mysql_connect();
   }
   private function __clone(){
    //实现
   }
   //访问实例的公共静态方法
   public static function getInstance(){
    // if(!(self::$_instance instanceof self)){
    //  self::$_instance=new self();
    // }
    //或者
    if(self::$_instance===null){
      self::$_instance=new Db();
    }
    return self::$_instance;
   }
   public function fetchAll(){
    return 'ss';
    //实现
   }
   public function fetchRow(){
    //实现
   }
 }
 //类外部获取实例的引用
 $db=Db::getInstance();
 echo $db->fetchAll();
 exit;

























$sss=array (
  'item' => 
  array (
    0 => 
    array (
      '@attributes' => 
      array (
        'id' => '0',
      ),
      'Title' => '天气广州天气预报',
      'Description' => 
      array (
      ),
      'PicUrl' => 
      array (
      ),
      'Url' => 
      array (
      ),
    ),
    1 => 
    array (
      '@attributes' => 
      array (
        'id' => '1',
      ),
      'Title' => '周五 03月17日 (实时：19℃)
小雨 微风 20 ~ 17℃',
      'Description' => 
      array (
      ),
      'PicUrl' => 'http://api.map.baidu.com/images/weather/night/xiaoyu.png',
      'Url' => 
      array (
      ),
    ),
    2 => 
    array (
      '@attributes' => 
      array (
        'id' => '2',
      ),
      'Title' => '周六
小雨转中雨 微风 20 ~ 16℃',
      'Description' => 
      array (
      ),
      'PicUrl' => 'http://api.map.baidu.com/images/weather/night/zhongyu.png',
      'Url' => 
      array (
      ),
    ),
    3 => 
    array (
      '@attributes' => 
      array (
        'id' => '3',
      ),
      'Title' => '周日
中雨转小雨 微风 20 ~ 18℃',
      'Description' => 
      array (
      ),
      'PicUrl' => 'http://api.map.baidu.com/images/weather/night/xiaoyu.png',
      'Url' => 
      array (
      ),
    ),
    4 => 
    array (
      '@attributes' => 
      array (
        'id' => '4',
      ),
      'Title' => '周一
小雨 微风 22 ~ 17℃',
      'Description' => 
      array (
      ),
      'PicUrl' => 'http://api.map.baidu.com/images/weather/night/xiaoyu.png',
      'Url' => 
      array (
      ),
    ),
  ),
);
print_r(json_encode($sss));
exit;
$postStr='<xml>
    <ToUserName><![CDATA[gh_58b4834492eb]]></ToUserName>
    <FromUserName><![CDATA[oGKPsjtInfRjm4Zgi3KOWXk_Yu8w]]></FromUserName>
    <CreateTime>1487754901</CreateTime>
    <MsgType><![CDATA[text]]></MsgType>
    <Content><![CDATA[璁剧疆鑿滃崟]]></Content>
    <MsgId>6389858644700185551</MsgId>
    <Encrypt><![CDATA[lsb3ZmTIFMBNyRxOxwwvIcQu5k0W0c8/67nYHwb5J5JYyxGgWDNN1Twqeas/f6n5nt2lKFe8QWtZmhAWbFikWmz6Vz3ilflBg9+nmtaxPKdVB84+0eNxk/Hxnqz/A9T24BarHdjOkSN1qCmOytIg7ixbUgca8E4w4qK62h2LeGWlTGT2Pm3v9tUO4oqzfBjo2U10HQbj08xx30jttAkc/Zm+Tzq50lxJiaBY3BP06CGiqyXDZins697ex/rEfv7HY1+yFf+OY5QX0WdYriIfPJv+Xfim618jGs7gWhHxDFvim8NSmVTAXjvCjvwTz7bzxiyx01uko2JH5lE76Jixx+RyE1yMvPh6vnuD+KIVFPzFnzZ0jNcqLV25Z4fiwzj4PDp8Ilvv5Y8mkrDF+7SG84UmKIIiInoJFxNdrMeR3KXucgLam5VXEHWdck+S/nDg/m3M+ZO5+UXMcJYRP6raVQ==]]></Encrypt>
</xml>';
    // $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA); 
    $postObj= xmlToArray($postStr);
    print_r($postObj);
    exit;
echo 139.00*(1.1);exit;
echo 181.81818181818/2;exit;
echo 4000/22;exit;
echo 6+2*(8-1);
exit;
$yourdate = strtotime(date("Y-m-01 00:00:00"));
$endday = strtotime(date('Y-m-d', mktime(23, 59, 59, date('m', strtotime($yourdate)) + 4, 00)));
// echo date('Y-m-d', mktime(23, 59, 59, date('m', strtotime($yourdate)) + 4, 00));
// echo $endday;exit;
echo 30000*0.6;exit;
// echo 58000*0.3+30000*0.6;
// echo 50000*0.7;

// 芯片
// 专利
// 3612 
// 核心技术 
exit;
//猜一猜
function c1c(){
    $url = 'http://apis.baidu.com/txapi/naowan/naowan';
    $chengyu=baiduapi($url);
    if ($chengyu['msg']!='success'){
        $content= $chengyu['msg'].$chengyu['code'];
    }else{
        $content="猜一猜：\n";
        $content .= $chengyu['newslist'][0]['quest']."\n答案：".$chengyu['newslist'][0]['result'];
    }
    return $content;
}
$test=c1c();
print_r($test);
exit;


$name='小幸运';
// $result=songs($name);
// $current_page=1;
// $url = 'http://apis.baidu.com/geekery/music/query?s='.urlencode($name).'&size=10&page='.$current_page;

$url = 'http://tingapi.ting.baidu.com/v1/restserver/ting?method=baidu.ting.billboard.billList&type=1&size=10&offset=0';
// $url = 'http://tingapi.ting.baidu.com/v1/restserver/ting?method=baidu.ting.song.downWeb&songid=877578&bit=24&_t=1393123213';
// $url = 'http://tingapi.ting.baidu.com/v1/restserver/ting?method=baidu.ting.song.play&songid=877578';
// $result=songs_baidu($name,1);//歌词
$result=songs_baidu($name);//歌曲
print_r($result);
exit;
function songs_baidu($name,$type=0){
    $url = 'http://tingapi.ting.baidu.com/v1/restserver/ting?method=baidu.ting.search.catalogSug&query='.$name;
    $result=baiduapi($url);
    if ($result['error_code']!='22000'){
        $content= $result['error_code'].$result['error_message'];
    }else{
        if(is_array($result['song'])){
            $songid=$result['song']['0']['songid'];
            if($type==0){//歌曲
              $url = 'http://tingapi.ting.baidu.com/v1/restserver/ting?method=baidu.ting.song.play&songid='.$songid;
              $result=baiduapi($url);
              print_r($result);exit;
              if ($result['error_code']!='22000'){
                  $content= $result['error_code'].$result['error_message'];
              }else{
                  $result['bitrate']['name']=$result['songinfo']['title'];
                  $content = $result['bitrate'];
              }
            }else{
              $url = 'http://tingapi.ting.baidu.com/v1/restserver/ting?method=baidu.ting.song.lry&songid='.$songid;
              $result=baiduapi($url);
              if(isset($result['error_code']))
                $content = '抱歉，没找到哦';
              else
                $content = $result['lrcContent'];
            }
        }
    }
    return $content;
}
function songs2ss($name,$page=1){
    $page=intval($page);
    $current_page=ceil($page/10);
    $key=($page-1)%10;

    $url = 'http://apis.baidu.com/geekery/music/query?s='.urlencode($name).'&size=10&page='.$current_page;
    $result=baiduapi($url);
    if ($result['status']!='success'){
        $content= $result['msg'].$result['code'];
    }else{
        if(is_array($result['data'])){
            $data=$result['data']['data'][$key];
            $url = 'http://apis.baidu.com/geekery/music/playinfo?hash='.$data['hash'];
            $result=baiduapi($url);
            if ($result['status']!='success'){
                $content= $result['msg'].$result['code'];
            }else{
                $content = $result['data'];
            }
        }
    }
    return $content;
}

$result=baiduapi($url);
print_r($result);
exit;

$a=array(2,3,4,5,3,6);
$b=array_unique($a);
print_r($b);
exit;
$ss=array (
  0 => 
  array (
    'pay_id' => '1',
    'pay_code' => 'alipay',
    'pay_name' => '支付宝',
    'pay_fee' => '0',
    'pay_desc' => '支付宝网站(www.alipay.com) 是国内先进的网上支付平台。<br/>支付宝收款接口：在线即可开通，<font color="red"><b>零预付，免年费</b></font>，单笔阶梯费率，无流量限制。<br/><a href="http://cloud.ecshop.com/payment_apply.php?mod=alipay" target="_blank"><font color="red">立即在线申请</font></a>',
    'pay_config' => 'a:4:{i:0;a:3:{s:4:"name";s:14:"alipay_account";s:4:"type";s:4:"text";s:5:"value";s:16:"olindora@163.com";}i:1;a:3:{s:4:"name";s:10:"alipay_key";s:4:"type";s:4:"text";s:5:"value";s:32:"25t7j1yvjn6fa3f2wkuk72e1zu36tn0g";}i:2;a:3:{s:4:"name";s:14:"alipay_partner";s:4:"type";s:4:"text";s:5:"value";s:16:"2088912830121753";}i:3;a:3:{s:4:"name";s:17:"alipay_pay_method";s:4:"type";s:6:"select";s:5:"value";s:1:"2";}}',
    'is_cod' => '0',
    'format_pay_fee' => '¥0.00',
  ),
  1 => 
  array (
    'pay_id' => '7',
    'pay_code' => 'weixin',
    'pay_name' => '微信支付',
    'pay_fee' => '0',
    'pay_desc' => '微信支付',
    'pay_config' => 'a:4:{i:0;a:3:{s:4:"name";s:5:"appId";s:4:"type";s:4:"text";s:5:"value";s:18:"wx209a81d435e8c121";}i:1;a:3:{s:4:"name";s:9:"appSecret";s:4:"type";s:4:"text";s:5:"value";s:32:"8c0c9692007ab1c1baf9029836df44dc";}i:2;a:3:{s:4:"name";s:9:"partnerId";s:4:"type";s:4:"text";s:5:"value";s:8:"10057690";}i:3;a:3:{s:4:"name";s:10:"partnerKey";s:4:"type";s:4:"text";s:5:"value";s:0:"";}}',
    'is_cod' => '0',
    'format_pay_fee' => '¥0.00',
  )
);
print_r($ss);
exit;
echo time();

exit;

echo 86400*3;
exit;
$ds= send_mail3('317205134@qq.com','哈哈','哈哈哈哈哈哈','test');
print_r($ds);
exit;

// 邮箱发送测试： smtp.163.com hunuosend@163.com testsend ||smtp.live.com hunuosend@hotmail.com Hunuoautomail88 
function send_mail3($to, $name, $subject = '', $body = '', $attachment = null, $config = '') {
    $config =array (
      'smtp_host' => 'smtp.163.com',
      'smtp_port' => '25',
      'from_email' => 'laozhongyishop@163.com',
      'from_name' => '我的test',
      'smtp_user' => 'laozhongyishop@163.com',
      'smtp_pass' => '188laozhongyi',
      'reply_email' => '',
      'reply_name' => '',
      'test_email' => '',
    );
    include_once('class/PHPMailer/phpmailer.class.php');         //从PHPMailer目录导class.phpmailer.php类文件
    $mail = new PHPMailer();                           //PHPMailer对象
    $mail->CharSet = 'UTF-8';                         //设定邮件编码，默认ISO-8859-1，如果发中文此项必须设置，否则乱码
    $mail->IsSMTP();                                   // 设定使用SMTP服务
//    $mail->IsHTML(true);
    $mail->SMTPDebug = 0;                             // 关闭SMTP调试功能 1 = errors and messages2 = messages only
    $mail->SMTPAuth = true;                           // 启用 SMTP 验证功能
    if ($config['smtp_port'] == 465)
        $mail->SMTPSecure = 'ssl';                    // 使用安全协议
    $mail->Host = $config['smtp_host'];                // SMTP 服务器
    $mail->Port = $config['smtp_port'];                // SMTP服务器的端口号
    $mail->Username = $config['smtp_user'];           // SMTP服务器用户名
    $mail->Password = $config['smtp_pass'];           // SMTP服务器密码
    $mail->SetFrom($config['from_email'], $config['from_name']);
    $replyEmail = $config['reply_email'] ? $config['reply_email'] : $config['reply_email'];
    $replyName = $config['reply_name'] ? $config['reply_name'] : $config['reply_name'];
    $mail->AddReplyTo($replyEmail, $replyName);
    $mail->Subject = $subject;
    $mail->MsgHTML($body);
    $mail->AddAddress($to, $name);
    if (is_array($attachment)) { // 添加附件
        foreach ($attachment as $file) {
            if (is_array($file)) {
                is_file($file['path']) && $mail->AddAttachment($file['path'], $file['name']);
            } else {
                is_file($file) && $mail->AddAttachment($file);
            }
        }
    } else {
        is_file($attachment) && $mail->AddAttachment($attachment);
    }
    return $mail->Send() ? true : $mail->ErrorInfo;
}

// // echo 39.84*3+317.43;exit;
// // echo 5100+6000+500;
// // 550
// // echo 5100+550-5150-790;
// // echo 450*11+200;
// // echo ((5100)/11);
// // echo 463.63636363636-450;
// // echo 11*13.63636363636;
// // 150;
// exit;
// exit;
// echo "test.php";
// exit;

// $time1 = strtotime('2012-3-11 11:11:11');
// $time2 = strtotime(time());
// $time_s= strtotime("2017-1-21");
// $time_n=time();
// echo date('Y-m-d H:i:s','1485077400');
// echo strtotime("2017-1-22 17:30:00");
// echo time();
// exit;





$img = file_get_contents('http://html.hunuo.com/2017/01/caojinghua/images/doctorPic.jpg'); 
file_put_contents('1.jpg',$img); 
exit;

$array=array(
	array('ss'=>5,'bb'=>5),
	array('ss'=>5,'bb'=>4),
	array('ss'=>5,'bb'=>6),
	array('ss'=>5,'bb'=>3)
	);

  // global $countpage; #定全局变量
$size=2;
$page=2;
$page=(empty($page))?'1':$page; #判断当前页面是否为空 如果为空就表示为第一页面 
$start=($page-1)*$size; #计算每次分页的开始位置
$totals=count($array); 
$countpage=ceil($totals/$count); #计算总页面数
$pagedata=array();
$pagedata=array_slice($array,$start,$size);
print_r($pagedata);
exit;
return $pagedata; #返回查询数据


print_r(bubbleSort($numbers,'bb'));
// print_r($numbers);exit;
// rsort($numbers);
exit;


$ds= send_mail2('317205134@qq.com','哈哈','哈哈哈哈哈哈','test');
print_r($ds);
exit;

// 邮箱发送测试： smtp.163.com hunuosend@163.com testsend ||smtp.live.com hunuosend@hotmail.com Hunuoautomail88 
function send_mail2($to, $name, $subject = '', $body = '', $attachment = null, $config = '') {
    $config =array (
      'smtp_host' => 'smtp.163.com',
      'smtp_port' => '25',
      'from_email' => 'hunuosend@163.com',
      'from_name' => '我的test',
      'smtp_user' => 'hunuosend@163.com',
      'smtp_pass' => 'testsend',
      'reply_email' => '',
      'reply_name' => '',
      'test_email' => '',
    );
    include_once('class/PHPMailer/phpmailer.class.php');         //从PHPMailer目录导class.phpmailer.php类文件
    $mail = new PHPMailer();                           //PHPMailer对象
    $mail->CharSet = 'UTF-8';                         //设定邮件编码，默认ISO-8859-1，如果发中文此项必须设置，否则乱码
    $mail->IsSMTP();                                   // 设定使用SMTP服务
//    $mail->IsHTML(true);
    $mail->SMTPDebug = 0;                             // 关闭SMTP调试功能 1 = errors and messages2 = messages only
    $mail->SMTPAuth = true;                           // 启用 SMTP 验证功能
    if ($config['smtp_port'] == 465)
        $mail->SMTPSecure = 'ssl';                    // 使用安全协议
    $mail->Host = $config['smtp_host'];                // SMTP 服务器
    $mail->Port = $config['smtp_port'];                // SMTP服务器的端口号
    $mail->Username = $config['smtp_user'];           // SMTP服务器用户名
    $mail->Password = $config['smtp_pass'];           // SMTP服务器密码
    $mail->SetFrom($config['from_email'], $config['from_name']);
    $replyEmail = $config['reply_email'] ? $config['reply_email'] : $config['reply_email'];
    $replyName = $config['reply_name'] ? $config['reply_name'] : $config['reply_name'];
    $mail->AddReplyTo($replyEmail, $replyName);
    $mail->Subject = $subject;
    $mail->MsgHTML($body);
    $mail->AddAddress($to, $name);
    if (is_array($attachment)) { // 添加附件
        foreach ($attachment as $file) {
            if (is_array($file)) {
                is_file($file['path']) && $mail->AddAttachment($file['path'], $file['name']);
            } else {
                is_file($file) && $mail->AddAttachment($file);
            }
        }
    } else {
        is_file($attachment) && $mail->AddAttachment($attachment);
    }
    return $mail->Send() ? true : $mail->ErrorInfo;
}






$db_host='localhost:3306';
$db_database='kawo';
$db_username='root';
$db_password='root';
$db_charset='utf8';
$db = new cls_mysql($db_host, $db_username, $db_password, $db_database, $db_charset);

// $goods_list=$db->getAll("select zhangjie from xiaoshuo order by zhangjie asc");
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
$start='3555';
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
print_r($goods_list);
exit;



// include('class/cls_huanxin.php');
// $rs = new Hxcall();
// // $data=array(
// // 	array('username' => 'qwerasd333','password' => 'qazwsx','nickname' =>'福州3333'),
// // 	array('username' => 'qwerasd444','password' => 'qazwsx','nickname' =>'福州4444'),
// // 	);
// // echo $rs->hx_register($data);
// echo $rs->hx_user_info('qwerasd333');
// // echo $rs->hx_user_delete('qwerasd111');
// exit;

// $url='https://a1.easemob.com/zdfz/zdbf/token';
// $data['grant_type']='client_credentials';
// $data['client_id']='YXA6EXbHIDhDEea_vhF3UkLf9A';
// $data['client_secret']='YXA6fAKH9idU_zI6UQrpuFWLnF32INc';
// $data = json_encode($data);
// $header=array('Content-Type:application/json');
// $back=https_request2($url,$header,$data);
// $back='{
//   "access_token": "YWMtujtL4tFeEeaAsw1W44-LcgAAAAAAAAAAAAAAAAAAAAERdscgOEMR5r--EXdSQt_0AgMAAAFZYjfgtwBPGgBeSQ3jawCMa0ifndqC5lP0LjsxZCSOfq_CStL9HS93vA", 
//   "application": "1176c720-3843-11e6-bfbe-11775242dff4", 
//   "expires_in": 4980531
// }';
// $back=json_decode($back,1);
// $data='';
// $url='https://a1.easemob.com/zdfz/zdbf/users/mmtest';
// $header=array('Authorization:Bearer '.$back['access_token']);
// $back=https_request2($url,$header,$data);

// print_r($back);
// exit;

$url='https://www.baidu.com';
$back=https_request2($url);
function https_request2($url,$header='',$data = ''){
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url); // 要访问的网址
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);  // 设置不直接打印
    if($data!==''){
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    }
    curl_setopt($curl, CURLOPT_HTTPHEADER,$header);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    $output=curl_exec($curl);  // 执行
    if(curl_errno($curl))$output= 'Curl error: '.curl_error($curl);
    curl_close($curl);  // 关闭
    return $output;
}
exit;


// echo 0.84 % 420;
// echo 1001 % 40;
// echo ((0.84.84*100) % (420*100))/100;

echo ((10.84*100) % (420*100))/100;
exit;

// // 发送邮件
// echo send_mail('asdfae86@126.com','哈哈','哈哈哈哈哈哈','test','aa.png');
$ds= send_mail('317205134@qq.com','哈哈','哈哈哈哈哈哈','test','aa.png');
print_r($ds);
exit;

$config	= array(
		'DEFAULT_THEME'		=> 'Default',
		'DEFAULT_CHARSET' => 'utf-8',
		'APP_GROUP_LIST' => 'Home,Admin,User',
		'DEFAULT_GROUP' =>'Home',
		'TMPL_FILE_DEPR' => '_',
		'DB_FIELDS_CACHE' => false,
		'DB_FIELDTYPE_CHECK' => true,
		'URL_ROUTER_ON' => true,
		'DEFAULT_LANG'   => 'cn',
		'LANG_SWITCH_ON'		=> true,
		'TAGLIB_LOAD' => true,
		'TAGLIB_PRE_LOAD' => 'Yp',
		'TMPL_ACTION_ERROR' => APP_PATH.'/Tpl/Home/Default/Public/success.html',
		'TMPL_ACTION_SUCCESS' =>  APP_PATH.'/Tpl/Home/Default/Public/success.html',
		'COOKIE_PREFIX'=>'YP_',
		'COOKIE_EXPIRE'=>'',
		'VAR_PAGE' => 'p',
		'LAYOUT_HOME_ON'=>$sys_config['LAYOUT_ON'],
		'URL_ROUTE_RULES' => $RULES,
		'TMPL_EXCEPTION_FILE' => APP_PATH.'/Tpl/Home/Default/Public/exception.html'
);
print_r(array_merge($config));
echo DEFAULT_THEME;exit;
exit;

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


// echo function_exists('date_default_timezone_set');
// echo ini_get('date.timezone');
// exit;

// 发短信
// $content='【芊贝壳】验证码为901452（客服绝不会以任何理由索取此验证码，切勿告知他人），请在页面中输入以完成验证。';
// $url="http://112.74.139.4:8002/sms3_api/jsonapi/jsonrpc2.jsp?{'id':1,'method':'send','params':{'userid':'201693','password':'6bcf9c820d05a222ae3a3984a36f55df','submit':[{'content':'".urlencode($content)."','phone':'13420246245'}]}}";
// $back=https_request($url);
// print_r($back);
// exit;

include('class/phpzip.php');

$file='./';
$archive  = new PHPZip();
// $filelist = $archive->visitFile($file); // 遍历文件
// print "当前文件夹的文件:<p>\r\n";
// foreach($filelist as $file)
//     printf("%s<br>\r\n", $file);
$archive->Zip($file, './case.zip'); // 压缩
exit;

// 解压缩
$archive   = new PHPZip();
$zipfile   = './case.zip';
$savepath  = './mytest';
// $zipfile   = $unzipfile;
// $savepath  = $unziptarget;
$array     = $archive->GetZipInnerFilesInfo($zipfile);
$filecount = 0;
$dircount  = 0;
$failfiles = array();
// set_time_limit(0);  // 修改为不限制超时时间(默认为30秒)

for($i=0; $i<count($array); $i++) {
    if($array[$i]['folder'] == 0){
        if($archive->unZip($zipfile, $savepath, $i) > 0){
            $filecount++;
        }else{
            $failfiles[] = $array[$i]['filename'];
        }
    }else{
        $dircount++;
    }
}
// set_time_limit(30);
printf("文件夹:%d&nbsp;&nbsp;&nbsp;&nbsp;解压文件:%d&nbsp;&nbsp;&nbsp;&nbsp;失败:%d<br>\r\n", $dircount, $filecount, count($failfiles));
if(count($failfiles) > 0){
   foreach($failfiles as $file){
       printf("&middot;%s<br>\r\n", $file);
   }
}
exit;


$name='周杰伦';
$result=songs($name);
print_r($result);exit;

interface travelInterface{
	public function __construct($speed, $distance);
	public function run();
}

abstract class travel implements travelInterface{     
	protected $speed; // 最高时速
	protected $distance; // 最远路程 
	public function __construct($speed, $distance)
	{
		$this->speed = $speed;
		$this->distance = $distance;
	}
}
class drive extends travel{    
	public function run()
	{
		echo "自驾游";
	}
}

class walk extends travel{
	 
	public function run()
	{
		echo "徒步旅行";
	}
}
// class human
// {
//     protected $travel; // 出行方式
 
//     public function __construct()
//     {
//         $this->travel = new drive(60,1000);
//     }
 
//     public function traveling(){
//         $this->travel->run();
//     }
// }
 
// $xiaoming = new human();
// $xiaoming->traveling();


class human
{
		protected $travel; // 出行方式
 
		public function __construct(travel $travel)
		{
				$this->travel = $travel;
		}
 
		public function traveling(){
				$this->travel->run();
		}
}
// $travel = new drive(60,1000);
$config = array(
		"travel" => new drive(60,1000)
		);

$xiaoming = new human($config["travel"]);
$xiaoming->traveling();
exit;






$str = 'abc测试 ef';
if (preg_match('/^[a-zA-Z0-9\u4e00-\u9fa5]+$|^[a-zA-Z0-9\u4e00-\u9fa5][a-zA-Z0-9_\s\ \u4e00-\u9fa5\.]*[a-zA-Z0-9\u4e00-\u9fa5]+$/', $str)) {
	 echo "符合验证规则";
} else {
	 echo "不符合验证规则";
}
exit;
echo https_request('www.baidu.com');exit;
// echo 68800*0.25;
// // echo 68800*0.75;
// exit;

// sleep(10);
$star=microtime(true);
$end=microtime(true);
echo $end-$star;
exit;

$a = get_defined_constants(TRUE) ;
print_r($a);
exit;
date_default_timezone_set('PRC');
echo date('Y-m-d H:i:s',time()); 
// echo time();
exit;

$host       = '127.0.0.1';
$user       = 'root';
$password   = 'root';
$database   = 'zhida';
	
/**
 * 期望得到额结果
 * array(
 *  1 => int,
 *  2 => int,
 *  3 => int
 * )
 */
$result = array(1=>0, 2=>0, 3=>0);
	
//异步方式[并发请求]
$time_start = microtime(true);
$links = array();
	
foreach ($result as $key=>$value) {
		$obj = new mysqli($host, $user, $password, $database);
		$links[spl_object_hash($obj)] = array('value'=>$key, 'link'=>$obj);
}

$done = 0;
$total = count($links);
	
foreach ($links as $value) {
		$value['link']->query("SELECT COUNT(*) AS `total` FROM `hunuo_shop_config` WHERE `value`={$value['value']}", MYSQLI_ASYNC);
}
	
do {
	
		$tmp = array();
		foreach ($links as $value) {
				$tmp[] = $value['link'];
		}
	
		$read = $errors = $reject = $tmp;
		$re = mysqli_poll($read, $errors, $reject, 1);
		if (false === $re) {
				die('mysqli_poll failed');
		} elseif ($re < 1) {
				continue;
		}
	
		foreach ($read as $link) {
				$sql_result = $link->reap_async_query();
				if (is_object($sql_result)) {
						$sql_result_array = $sql_result->fetch_array(MYSQLI_ASSOC);//只有一行
						$sql_result->free();
						$hash = spl_object_hash($link);
						$key_in_result = $links[$hash]['value'];
						$result[$key_in_result] = $sql_result_array['total'];
				} else {
						echo $link->error, "\n";
				}
				$done++;
		}
	
		foreach ($errors as $link) {
				echo $link->error, "1\n";
				$done++;
		}
	
		foreach ($reject as $link) {
				printf("server is busy, client was rejected.\n", $link->connect_error, $link->error);
				//这个地方别再$done++了。
		}
} while ($done<$total);
var_dump($result);
echo "ASYNC_QUERY_TIME:", microtime(true)-$time_start, "\n";
	
$link = end($links);
$link = $link['link'];
echo "\n";
exit;











































// 9.80
echo 112*0.03+9.80;exit;

$url = 'https://kssm.kuaipandata.com/kss_web/thumb?i=6oeSiBn2v8XHmmZvf7824J7nQbodU/DryQTixkZaDb5skJVo81hToNah7r5DnpulRam+v9kJiMDFIjbTp3Jkqg==&c=XiaoMi&tm=1481360316&w=1024&h=768&s=OhfaEIzPp9y1aFH/mZCmCDSoAz8=&auto_rotate=0';
$ss=https_request($url);
print_r($ss);
exit;




















// 点歌
function songs($name,$page=1){
		$page=intval($page);
		$current_page=ceil($page/10);
		$key=($page-1)%10;

		$url = 'http://apis.baidu.com/geekery/music/query?s='.urlencode($name).'&size=10&page='.$current_page;
		$result=baiduapi($url);
		if ($result['status']!='success'){
				$content= $result['msg'].$result['code'];
		}else{
				if(is_array($result['data'])){
						$data=$result['data']['data'][$key];
						$url = 'http://apis.baidu.com/geekery/music/playinfo?hash='.$data['hash'];
						$result=baiduapi($url);
						if ($result['status']!='success'){
								$content= $result['msg'].$result['code'];
						}else{
								$content = $result['data'];
						}
				}
		}
		return $content;
}
//百度api
function baiduapi($urld){
		$ch = curl_init();
		$url = $urld;
		$header = array(
				'apikey: 99a09ae2cdc9ef20d2f64f5385e4637e',
		);
		// 添加apikey到header
		curl_setopt($ch, CURLOPT_HTTPHEADER  , $header);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		// 执行HTTP请求
		curl_setopt($ch , CURLOPT_URL , $url);
		$res = curl_exec($ch);
		$resd=json_decode($res,true);
		return $resd;
}


$email = '[  {\\"price\\" : \\"123\\",   \\"goods_id\\" : \\"211\\"  }]';
$email =str_replace('\\"', '"', $email);
// $email = '[
// {"UserID":11, "Name":{"FirstName":"Truly","LastName":"Zhu"}, "Email":"zhuleipro◎hotmail.com"},
// {"UserID":12, "Name":{"FirstName":"Jeffrey","LastName":"Richter"}, "Email":"xxx◎xxx.com"},
// {"UserID":13, "Name":{"FirstName":"Scott","LastName":"Gu"}, "Email":"xxx2◎xxx2.com"}
// ]';
print_r(json_decode($email,true));
exit;
// 8000
// 53200
// 8000
// 70000
// 6000
// 80000

// echo 8000+53200+8000+70000+6000+80000;
// echo 225200/4;
// exit;
// echo 70000*0.3;
// 
// 21000

// 24000
// 28000
// 32000
echo 80000*0.4;
exit;


$email = '推荐会员ID 3152 ( u134GMWV5991 )推广会员商';
$email=str_replace('会员', '<strong>会员</strong>', $email );
echo $email;
exit;
// echo substr($email,4,-3);
$start=strpos($email,'(');
$end=strpos($email,')');
echo str_replace(substr($email,$start,$end-$start+1), '', $email) ;
exit;
$domain = strstr($email, '@');
echo $domain; // 打印 @example.com
$user = strstr($email, '@', true); // 从 PHP 5.3.0 起
echo $user; // 打印 yuxiaoxiao 
exit;
$i=10;
if( 1 < $i && $i<100)
{
		echo "sdf";

}
exit;
// $ss='OK
// ADDR=115.28.40.121:7080
// SID=E8848763B5D8E548';
// $str = str_replace(PHP_EOL, '<br>', $ss);
// $s=explode('<br>',$ss);
// print_r(get_defined_constants(TRUE));
// echo 127/24;exit;
$a=array(210,'s',212);
$b=array(210,211,213);
$c=array_diff($a, $b);
//是否不同
if($c)
{
		echo "1";
}else
		echo "0";

print_r($c);
exit;


$a = get_defined_constants(TRUE) ;
foreach ( $a['sockets'] as $constant => $value ) {
		printf("%-25s %d\r\n", $constant, $value) ;
}

// echo PHP_EOL;
// echo DIRECTORY_SEPARATOR;

// print_r($s);exit;
// echo 177/268 *100;



		/**
		 * XML文档转为数组
		 * @param string $xml XML文档字符串
		 * @return array
		 */
		function xmlToArray($xml) {
				return $xml ? xmlToArrayElement(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)) : array();
		}

	 /**
		 * xml文档转为数组元素
		 * @param obj $xmlobject XML文档对象
		 * @return array
		 */
		function xmlToArrayElement($xmlobject) {
				$data = array();
				foreach ((array) $xmlobject as $key => $value) {
						$data[$key] = !is_string($value) ? xmlToArrayElement($value) : $value;
				}
				return $data;
		}
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