<?php
require(dirname(__FILE__) . '/wechat.class.php');
require(dirname(__FILE__) . '/function.php');
$options = array(
   'token'=>'vip9chengmings', //填写你设定的key
   'appid'=>'wxf99801d7d4daac2b', //填写高级调用功能的app id
   'appsecret'=>'ed6518238228bc1293028ad15834e85b', //填写高级调用功能的密钥
   'debug'=>1, //
   'logcallback'=>'mylog', //
);
$weObj = new Wechat($options);
// $weObj->valid();
$weObj->getRev();
$type = $weObj->getRevType();
switch($type) {
    case Wechat::MSGTYPE_TEXT:
        do_text($weObj);
        break;
    case Wechat::MSGTYPE_EVENT:
        do_event($weObj);
        break;
    case Wechat::MSGTYPE_IMAGE:
        $contentStr = "你发送的是图片，地址为：".$weObj->getRevPic();
        $weObj->text($contentStr)->reply();
        break;
    case Wechat::MSGTYPE_LOCATION:
        $location=$weObj->getRevGeo();
        $contentStr = "你发送的是位置，纬度为：".$location['x']."；经度为：".$location['y']."；缩放级别为：".$location['scale']."；位置为：".$location['label'];
        $weObj->text($contentStr)->reply();
        break;
    case Wechat::MSGTYPE_LINK:
        $link=$weObj->getRevLink();
        $contentStr = "你发送的是链接，标题为：".$link['title']."；内容为：".$link['description']."；链接地址为：".$link['url'];
        $weObj->text($contentStr)->reply();
        break;
    case Wechat::MSGTYPE_VOICE:
        $voice=$weObj->getRevVoice();
        $contentStr = "你发送的是语音，媒体ID为：".$voice['mediaid'];
        $weObj->text($contentStr)->reply();
        break;
    case Wechat::MSGTYPE_VIDEO:
        $video=$weObj->getRevVideo();
        $contentStr = "你发送的是视频，媒体ID为：".$video['mediaid'];
        $weObj->text($contentStr)->reply();
        break;
    default:
        $weObj->text("help info")->reply();
}
exit;
// 处理内容
function do_text($weObj){
        $keyword = trim($weObj->getRevContent());
        if(substr($keyword,0,6) == '天气'){
            $keyword = strreplace($keyword);
            $content = getWeather($keyword);
            $weObj->news($content)->reply();
            exit;
        }elseif(substr($keyword,0,6) == '快递'){
            $keyword = strreplace($keyword);
            $content = getDindan($keyword);
        }elseif(substr($keyword,0,6) == '点歌'){
            $keyword = strreplace($keyword);
            preg_match('/^([^0-9]*)/i', $keyword, $temp);
            $mypage=str_replace($temp[0], '', $keyword);
            if($mypage)
                $temp= songs(str_replace("点歌","",$keyword),$mypage);
            else
                $temp= songs(str_replace("点歌","",$keyword));
            if(empty($temp)){
                $content='网络暂时不稳定,请稍后再试';
            }else{
                $weObj->music($temp['fileName'],round($temp['fileSize']/(1024*1024),2).'M',$temp['url'],$temp['url'])->reply();
                exit;
            }
        }elseif(substr($keyword,0,12) == '城市列表'){
            $keyword = strreplace($keyword);
            $content = citylist(str_replace("城市列表","",$keyword));
        }elseif(substr($keyword,0,9) == '身份证'){
            $keyword = strreplace($keyword);
            $content = idservice(str_replace("身份证","",$keyword));
        }elseif(substr($keyword,0,9) == '归属地'){
            $keyword = strreplace($keyword);
            $content = mobilephone(str_replace("归属地","",$keyword));
        }elseif(substr($keyword,0,6) == '成语'){
            $keyword = strreplace($keyword);
            $content = chengyu(str_replace("成语","",$keyword));
        }elseif(substr($keyword,0,9) == '猜一猜'){
            $content = c1c();
        }elseif(substr($keyword,0,6) == '祝福'){
            $item[0]['Title']='生日快乐贺卡';
            $item[0]['Description']='祝宋凤生日快乐，永远18';
            $item[0]['PicUrl']='http://mmbiz.qpic.cn/mmbiz_jpg/gpsyRZOQ4giaVtdicByuXQ8UibVt1Tp5qqRAchRb8KiaIAU60iczJjlqOkImk44WJ5QJbWUVjRGJP21TQfoqvIzNsgg/640?wx_fmt=jpeg&wxfrom=5';
            $item[0]['Url']="http://f.lchengming.cn";
            $weObj->news($item)->reply();
            exit;
        }elseif(substr($keyword,0,9) == '绕口令'){
            $content = rkl();
        }elseif(substr($keyword,0,6) == '解梦'){
            $keyword = strreplace($keyword);
            $content = jiemeng(str_replace("解梦","",$keyword));
        }elseif(substr($keyword,0,6) == '生日'){
            $keyword=str_replace("生日","",$keyword);
            $keyword=str_replace("，",",",$keyword);
            $data=explode(',', $keyword);
            $content = shengri($data['0'],$data['1']);
        }elseif(substr($keyword,0,6) == '名言'){
            $content = mingyan();
        }elseif(substr($keyword,0,6) == '油价'){
            $keyword = strreplace($keyword);
            $content = youjia(str_replace("油价","",$keyword));
        }elseif(substr($keyword,0,6) == '星座'){
            $keyword = strreplace($keyword);
            $content = xingzuo(str_replace("星座","",$keyword));
        }elseif(substr($keyword,0,6) == '搞笑'){
            $keyword = strreplace($keyword);
            $content = gaoxiao(str_replace("搞笑","",$keyword));
        }elseif(substr($keyword,0,6) == '车票'){
            $keyword=str_replace("车票","",$keyword);
            $keyword=str_replace("，",",",$keyword);
            $data=explode(',', $keyword);
            $content = chepiao($data[0],$data[1],$data[2]);
        }elseif(substr($keyword,0,12) == '全部电影'){
            $content='http://v.9chengming.com/dianying/test.php?type=1';
        }elseif(substr($keyword,0,12) == '相关电影'){
            $keyword=str_replace("相关电影","",$keyword);
            $content='http://v.9chengming.com/dianying/test.php?type=2&title='.urlencode($keyword);
        }elseif(substr($keyword,0,6) == '电影'){
            $keyword=str_replace("电影","",$keyword);
            $content=https_request('http://v.9chengming.com/dianying/test.php?type=3&title='.urlencode($keyword));
        }elseif(substr($keyword,0,12) == '获取菜单'){
            // 获取菜单
            $data = $weObj->getMenu();// 已转数组
            $content = json_encode($data); //转json
        }elseif(substr($keyword,0,12) == '设置菜单'){
            //设置菜单
            $newmenu =  array(
                "button"=>
                    array(
                        array('name'=>'生活查询','sub_button'=>array(
                            array ('type' => 'click','name' => '天气查询','key' =>'VCX_WEATHER'),
                            array ('type' => 'click','name' => '歌词查询','key' =>'VCX_GECI'),
                            array ('type' => 'click','name' => '成语查询','key' =>'VCX_CHENGYU'),
                            array ('type' => 'click','name' => '中英文互译','key' =>'VCX_FANYI'),
                            array ('type' => 'click','name' => '号码归属地','key' =>'VCX_GUISHU'),
                            )
                        ),
                        array('name'=>'轻松娱乐','sub_button'=>array(
                            array ('type' => 'click','name' => '笑话','key' =>'VCX_XIAOHUI'),
                            array ('type' => 'view','name' => '玩一玩','url' =>'http://game.lchengming.cn'),
                            array ('type' => 'click','name' => '猜一猜','key' =>'VCX_CYC'),
                            )
                        ),
                        array('name'=>'联系我们','sub_button'=>array(
                            array ('type' => 'view','name' => '微官网','url' =>'http://www.9chengming.com'),
                            array ('type' => 'view','name' => '微商城','url' =>'http://shop.9chengming.com'),
                            array ('type' => 'view','name' => '地图','url' =>'http://wei.lchengming.cn/map.html'),
                            array ('type' => 'click','name' => '帮助','key' =>'VCX_BANGZHU'),
                            )
                        ),
                    )
            );
            $content = $weObj->createMenu($newmenu);
        }elseif(substr($keyword,0,12) == '发送邮件'){
            unlink('log.txt');
            $result = send_mail('317205134@qq.com','公众号','就成铭平台','就成铭平台log','log.txt');
            if($result){
                $content = '发送成功';
            }else
                $content = $result;
        }else{
            $content = ajaxsns_comm($keyword);
        }
        $content?'':$content='暂无相关信息';
        $weObj->text($content)->reply();
}
// 处理事件
function do_event($weObj){
    $help_list=array(
        "回复【天气+城市】，可查天气预报。例如'天气广州",
        "回复【点歌+歌名】，可点歌。例如'点歌小幸运'",
        "回复【歌词+歌名】，可查歌词。例如'歌词谢谢你的爱'",
        "回复【翻译+内容】，可以中英文互译。例如'翻译weather'",
        "回复【星座+星座名】，星座运势。例如'星座双子座'",
        "回复【搞笑+页数】，搞笑图片。例如'搞笑1'",
        "回复【成语+内容】，可查与内容相关的成语。例如'成语叶'",
        "回复【解梦+内容】，周公解梦。例如'解梦吃西瓜'",
        "回复【归属地+手机号码】，可查手机号码归属地。例如'归属地13420246245'",
        "回复【快递+快递单号】，可查快递进度。例如'快递2304204024'",
        "回复【城市列表+城市】，可查该城市列表。例如'城市列表广州'",
        "回复【名言】，名言警句。例如'名言'",
        "回复【绕口令】，可绕口令。例如'绕口令'",
        "回复【生日+月,日】，可预测一个人的性格发展。例如'生日1,1'",
        "回复【油价+省份】，今日油价。例如'油价广东'",
        "回复【车票+起点,终点,时间】，查询车票信息。例如'车票广州,终点,2016-06-20'",
        "回复【笑话】，会看到逗你开心的笑话。例如'笑话'",
        "回复【猜一猜】，可查猜猜游戏。例如'猜一猜'",
        );
    $help='';
    foreach ($help_list as $key => $value){
        $help.=$value."\n\n";
    }
    $help.="如有任何问题可随时联系我哦:13420246245[玫瑰]";
    $contentStr = "";
    $event_info=$weObj->getRevEvent();
    switch ($event_info['event'])
    {
        case "subscribe":
            // $contentStr = "哈喽，我是成铭，现在我们是好友咯![愉快][玫瑰]\n".$help;
            // $contentStr = "好高兴！我们成为好朋友了哦！！！[愉快]\n想听歌吗？左下角点击一下，发送“点歌不再联系”试试看[玫瑰]";
            $item[0]['Title']='哈喽，欢迎来到就成铭平台';
            $item[0]['Description']="好高兴！现在我们成为好朋友了哦！！！\n发送“点歌不再联系”，左下角点击一下就可以发送哦，试试看";
            $item[0]['PicUrl']='http://wei.lchengming.cn/i.jpg';
            $item[0]['Url']='http://wei.lchengming.cn/i.jpg';
            // $item[0]['Url']="http://qiaoruigj.gz11.hostadm.net/mobile/?u=".$object->EventKey;
                $db_host='qdm177261603.my3w.com:3306';
                $db_database='qdm177261603_db';
                $db_username='qdm177261603';
                $db_password='9chengming2015';
                // $db_host='localhost:3306';
                // $db_database='tonghang';
                // $db_username='tonghang_f';
                // $db_password='Wn18W75u';
                $connection=mysql_connect($db_host,$db_username,$db_password);//连接到数据库
                mysql_query("set names 'utf8'");//编码转化
                if(!$connection){
                    $weObj->set_php_file('user_info.php','could not to the database1');
                }
                $db_selecct=mysql_select_db($db_database);//选择数据库
                $query="select * from wx where openid='".$weObj->getRevFrom()."'";//构建查询语句
                $result=mysql_query($query);//执行查询
                if(!$result){
                    //todo 失败
                }
                $result_row=mysql_fetch_row($result);
                // 存在未绑定、不是分销商的此openid，
                if(!$result_row){
                    $sql="INSERT INTO wx (openid,log_time) VALUES ('".$weObj->getRevFrom()."','".time()."')";
                    $query=mysql_query($sql);
                }
                mysql_close($connection);//关闭连接
            $weObj->news($item)->reply();
            break;
        case "unsubscribe":
            $contentStr = "";
            $weObj->text($contentStr)->reply();
            break;
        case "CLICK":
            switch ($event_info['key'])
            {
                case "VCX_WEATHER":
                    $contentStr = "发送【天气+城市】，例如：\n天气广州";
                    break;
                case "VCX_IDENT":
                    $contentStr = "回复【点歌+歌名】，可点歌。例如：\n点歌小幸运";
                    break;
                case "VCX_FANYI":
                    $contentStr = "发送【翻译+内容】，可以中英文互译。例如“翻译weather”";
                    break;
                case "VCX_GECI":
                    $contentStr = "发送【歌词+歌名】，可查歌词。例如“歌词谢谢你的爱”";
                    break;
                case "VCX_KUAIDI":
                    $contentStr = "发送【快递+快递单号】，可查快递进度。例如“快递2304204024”";
                    break;
                case "VCX_GUISHU":
                    $contentStr = "发送【归属地+手机号码】，可查手机号码归属地。例如“归属地13420246245”";
                    break;
                case "VCX_CHENGYU":
                    $contentStr = "发送【成语+内容】，可查与内容相关的成语。例如“成语叶”";
                    break;
                case "VCX_CHENGSHI":
                    $contentStr = "发送【城市列表+城市】，可查该城市列表。例如“城市列表广州”";
                    break;
                case "VCX_XIAOHUI":
                    $contentStr = ajaxsns_comm('笑话');
                    break;
                case "VCX_CYC":
                    $contentStr = c1c('猜一猜');
                    break;
                case "VCX_BANGZHU":
                    $contentStr = $help;
                    break;
                default:
                    $contentStr = "对不起,功能还在开发中，敬请期待 ";
                    break;
            }
            $weObj->text($contentStr)->reply();
            break;
        default:
            $contentStr = "receive a new event: ".$event_info['event'];
            $weObj->text($contentStr)->reply();
            break;
    }
}
function mylog($log){
    error_log( date('Y-m-d H:i:s',time()).' '.var_export($log,true)." \n", 3, "log.txt");
}