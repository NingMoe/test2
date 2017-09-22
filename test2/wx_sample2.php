<?php 
//define your token 
define("TOKEN", "vip9chengmings");//改成自己的TOKEN 
define('APP_ID', 'wxf99801d7d4daac2b');//改成自己的APPID 
define('APP_SECRET', 'ed6518238228bc1293028ad15834e85b');//改成自己的APPSECRET 
 
$wechatObj = new wechatCallbackapiTest(APP_ID,APP_SECRET); 
$wechatObj->Run(); 
// $wechatObj->valid();

 
class wechatCallbackapiTest 
{ 
    private $fromUsername; 
    private $toUsername; 
    private $times; 
    private $keyword; 
    private $app_id; 
    private $app_secret; 
     
    public function __construct($appid,$appsecret) 
    { 
        # code... 
        $this->app_id = $appid; 
        $this->app_secret = $appsecret; 
    } 
    public function valid() 
    { 
        $echoStr = $_GET["echostr"]; 
        if($this->checkSignature()){ 
            echo $echoStr; 
            exit; 
        } 
    } 
    /** 
     * 运行程序 
     * @param string $value [description] 
     */ 
    public function Run() 
    { 
        $this->responseMsg(); 
        //$arr[]= "您好，这是自动回复，我现在不在，有事请留言，我会尽快回复你的^_^"; 
        //echo $this->make_xml("text",$arr); 
    } 
    public function responseMsg() 
    {   
        echo '';
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];//返回回复数据 
        if (!empty($postStr)){ 
            	libxml_disable_entity_loader(true);
                $access_token = $this->get_access_token();//获取access_token 
                // $this->createmenu($access_token);//创建菜单 
                //$this->delmenu($access_token);//删除菜单 
                $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);

                $this->fromUsername = $postObj->FromUserName;//发送消息方ID 
                $this->toUsername = $postObj->ToUserName;//接收消息方ID 
                $this->keyword = trim($postObj->Content);//用户发送的消息 
                $this->times = time();//发送时间 
                $MsgType = $postObj->MsgType;//消息类型 
				
            switch ($MsgType)
            {
                case "text":
                    $resultStr = $this->receiveText($this->keyword);
                    break;
                case "image":
                    $resultStr = $this->receiveImage($postObj);
                    break;
                case "location":
                    $resultStr = $this->receiveLocation($postObj);
                    break;
                case "voice":
                    $resultStr = $this->receiveVoice($postObj);
                    break;
                case "video":
                    $resultStr = $this->receiveVideo($postObj);
                    break;
                case "link":
                    $resultStr = $this->receiveLink($postObj);
                    break;
                case "event":
                    $resultStr = $this->receiveEvent($postObj);
                    break;
                default:
                    $resultStr = "unknow msg type: ".$RX_TYPE;
                    break;
            }
            echo $this->make_xml($resultStr);
            // error_log( var_export($postObj,true).var_export($resultStr,true)." \n", 3, "logs.log");
            error_log( date('Y-m-d H:i:s',$this->times).' '.$this->fromUsername.' '.$this->keyword.' '.var_export($resultStr,true)." \n", 3, "logs.log");
            exit;
        }else { 
            echo "this a file for weixin API!"; 
            exit; 
        } 
    }
	
    private function receiveText($contents)
    {
        $keyword = trim($contents);
		
        if(substr($keyword,0,6) == '天气'){
            $keyword = strreplace($keyword);
            $content = getWeather($keyword);
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
            if(is_array($temp)){
                $content['content'] = $temp;
                $content['type'] = 'music'; // music
            }elseif(empty($temp))
                $content='网络暂时不稳定';
            else
                $content=$temp;
        }elseif(substr($keyword,0,6) == '图片'){
            $content['content'] = $keyword;
            $content['type'] = 'image'; // music
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
            $content =$item;
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
        }else{
        	$content = ajaxsns_comm($keyword);
        }
        return $content;
    }

    private function receiveImage($object)
    {
        $funcFlag = 0;
        $contentStr = "你发送的是图片，地址为：".$object->PicUrl;
        return $contentStr;
    }

    private function receiveLocation($object)
    {
        $funcFlag = 0;
        $contentStr = "你发送的是位置，纬度为：".$object->Location_X."；经度为：".$object->Location_Y."；缩放级别为：".$object->Scale."；位置为：".$object->Label;
        return $contentStr;
    }

    private function receiveVoice($object)
    {
        $funcFlag = 0;
        $contentStr = "你发送的是语音，媒体ID为：".$object->MediaId;
        return $contentStr;
    }

    private function receiveVideo($object)
    {
        $funcFlag = 0;
        $contentStr = "你发送的是视频，媒体ID为：".$object->MediaId;
        return $contentStr;
    }

    private function receiveLink($object)
    {
        $funcFlag = 0;
        $contentStr = "你发送的是链接，标题为：".$object->Title."；内容为：".$object->Description."；链接地址为：".$object->Url;
        return $contentStr;
    }
    private function receiveEvent($object)
    {
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
        foreach ($help_list as $key => $value) {
            $help.=$value."\n\n";
        }
        $help.="如有任何问题可随时联系我哦:13420246245[玫瑰]";
        $contentStr = "";
        switch ($object->Event)
        {
            case "subscribe":
                // $contentStr = "哈喽，我是成铭，现在我们是好友咯![愉快][玫瑰]\n".$help;
                $contentStr = "好高兴！我们成为好朋友了哦！！！[愉快]\n想听歌吗？左下角点击一下，发送“点歌不再联系”试试看[玫瑰]";

                // $item[0]['Title']='我的店铺';
                // $item[0]['Description']='我的介绍介绍介绍';
                // $item[0]['PicUrl']='http://www.amongo.com.cn/Uploads/articlecat/20151210092450.jpg';
                // $item[0]['Url']="http://qiaoruigj.gz11.hostadm.net/mobile/?u=".$object->EventKey;
                // $contentStr = $item;

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
                        $this->set_php_file('user_info.php','could not to the database1');
                    }
                    $db_selecct=mysql_select_db($db_database);//选择数据库

                    $query="select * from wx where openid='".$object->FromUserName."'";//构建查询语句
                    $result=mysql_query($query);//执行查询
                    if(!$result)
                    {
                        //todo 失败
                    }
                    $result_row=mysql_fetch_row($result);
                    // 存在未绑定、不是分销商的此openid，
                    if(!$result_row){

                        $sql="INSERT INTO wx (openid,log_time) VALUES ('".$object->FromUserName."','".time()."')";
                        $query=mysql_query($sql);
                    }
                    mysql_close($connection);//关闭连接
                break;
            case "unsubscribe":
                $contentStr = "";
                break;
            case "CLICK":
                switch ($object->EventKey)
				{
					case "VCX_WEATHER":
						$contentStr = "发送【天气+城市】，例如：\n天气广州";
						break;
					case "VCX_IDENT":
						$contentStr = "发送【身份证+号码】'，例如'身份证420984198704207896'";
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
                break;
            default:
                $contentStr = "receive a new event: ".$object->Event;
                break;
        }
        //$resultStr = $this->transmitText($object, $contentStr);
        return $contentStr;
    }
	
	
	
	 
    /** 
     * 获取access_token 
     */ 
    // private function get_access_token() 
    // { 
    //     $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$this->app_id."&secret=".$this->app_secret; 
    //     $data = json_decode(file_get_contents($url),true); 
    //     if($data['access_token']){ 
    //         return $data['access_token']; 
    //     }else{ 
    //         return "获取access_token错误"; 
    //     } 
    // } 
    private function get_access_token() {
    // access_token 应该全局存储与更新，以下代码以写入到文件中做示例
    $data = json_decode($this->get_php_file("access_token.php"));
    if ($data->expire_time < time()) {
      // 如果是企业号用以下URL获取access_token
      // $url = "https://qyapi.weixin.qq.com/cgi-bin/gettoken?corpid=$this->app_id&corpsecret=$this->app_secret";
      $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$this->app_id&secret=$this->app_secret";
      $res = json_decode($this->httpGet($url));
      $access_token = $res->access_token;

      if ($access_token) {
        $data->expire_time = time() + 7000;
        $data->access_token = $access_token;
        $this->set_php_file("access_token.php", json_encode($data));
      }
    } else {
      $access_token = $data->access_token;
    }
    return $access_token;
    }

    /** 
     * 创建菜单 
     * @param $access_token 已获取的ACCESS_TOKEN 
     */ 
    public function createmenu($access_token) 
    { 
        $url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$access_token; 
        $arr = array(  
            'button' =>array( 
                array( 
                    'name'=>urlencode("生活查询"), 
                    'sub_button'=>array( 
                        array( 
                            'name'=>urlencode("天气查询"), 
                            'type'=>'click', 
                            'key'=>'VCX_WEATHER' 
                        ), /*
                        array( 
                            'name'=>urlencode("身份证查询"), 
                            'type'=>'click', 
                            'key'=>'VCX_IDENT' 
                        ), */
                        array( 
                            'name'=>urlencode("中英文互译"), 
                            'type'=>'click', 
                            'key'=>'VCX_FANYI' 
                        ), 
                        array( 
                            'name'=>urlencode("歌词查询"), 
                            'type'=>'click', 
                            'key'=>'VCX_GECI' 
                        ),/*
                        array( 
                            'name'=>urlencode("快递查询"), 
                            'type'=>'click', 
                            'key'=>'VCX_KUAIDI' 
                        ),*/
                        array( 
                            'name'=>urlencode("号码归属地"), 
                            'type'=>'click', 
                            'key'=>'VCX_GUISHU' 
                        ), 
                        array( 
                            'name'=>urlencode("成语查询"), 
                            'type'=>'click', 
                            'key'=>'VCX_CHENGYU' 
                        )/*, 
                        array( 
                            'name'=>urlencode("城市查询"), 
                            'type'=>'click', 
                            'key'=>'VCX_CHENGSHI' 
                        )*/
                    ) 
                ), 
                array( 
                    'name'=>urlencode("轻松娱乐"), 
                    'sub_button'=>array(
                        array( 
                            'name'=>urlencode("笑话"), 
                            'type'=>'click', 
                            'key'=>'VCX_XIAOHUI' 
                        ),
                        array( 
                            'name'=>urlencode("猜一猜"), 
                            'type'=>'click', 
                            'key'=>'VCX_CYC' 
                        )
                    ) 
                ), 
                array( 
                    'name'=>urlencode("联系我们"), 
                    'sub_button'=>array( 
                        array( 
                            'name'=>urlencode("微官网"), 
                            'type'=>'view', 
                            'url'=>'http://www.9chengming.com' 
                        ), 
                        array( 
                            'name'=>urlencode("微商城"), 
                            'type'=>'view', 
                            'url'=>'http://shop.9chengming.com' 
                        ), 
                        array( 
                            'name'=>urlencode("帮助"), 
                            'type'=>'click', 
                            'key'=>'VCX_BANGZHU' 
                        )
                    ) 
                ) 
            ) 
        ); 
        $jsondata = urldecode(json_encode($arr)); 
        $ch = curl_init(); 
        curl_setopt($ch,CURLOPT_URL,$url); 
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1); 
        curl_setopt($ch,CURLOPT_POST,1); 
        curl_setopt($ch,CURLOPT_POSTFIELDS,$jsondata); 
        curl_exec($ch); 
        curl_close($ch); 
    } 
    /** 
     * 查询菜单 
     * @param $access_token 已获取的ACCESS_TOKEN 
     */ 
     
    private function getmenu($access_token) 
    { 
        # code... 
        $url = "https://api.weixin.qq.com/cgi-bin/menu/get?access_token=".$access_token; 
        $data = file_get_contents($url); 
        return $data; 
    } 
    /** 
     * 删除菜单 
     * @param $access_token 已获取的ACCESS_TOKEN 
     */ 
     
    private function delmenu($access_token) 
    { 
        # code... 
        $url = "https://api.weixin.qq.com/cgi-bin/menu/delete?access_token=".$access_token; 
        $data = json_decode(file_get_contents($url),true); 
        if ($data['errcode']==0) { 
            # code... 
            return true; 
        }else{ 
            return false; 
        } 
    } 
         
    /** 
     *@param type: text 文本类型, news 图文类型 
     *@param value_arr array(内容),array(ID) 
     *@param o_arr array(array(标题,介绍,图片,超链接),...小于10条),array(条数,ID) 
     */ 
     
    private function make_xml($value_arr){ 
        //=================xml header============ 
        $con="<xml> 
                    <ToUserName><![CDATA[{$this->fromUsername}]]></ToUserName> 
                    <FromUserName><![CDATA[{$this->toUsername}]]></FromUserName> 
                    <CreateTime>{$this->times}</CreateTime> "; 

        if($value_arr['type']=='music'){ //音乐
            $itemTpl = "<MsgType><![CDATA[music]]></MsgType>  
                <Music>  
                    <Title><![CDATA[%s]]></Title>  
                    <Description><![CDATA[%s]]></Description>  
                    <MusicUrl><![CDATA[%s]]></MusicUrl>  
                    <HQMusicUrl><![CDATA[%s]]></HQMusicUrl>
                </Music>";
            $con .= sprintf($itemTpl, $value_arr['content']['fileName'], round($value_arr['content']['fileSize']/(1024*1024),2).'M', $value_arr['content']['url'], $value_arr['content']['url']);

        }elseif($value_arr['type']=='image'){ //图片
                // $this->set_php_file('user_info.php',var_export($value_arr,true));
            $itemTpl = "<MsgType><![CDATA[image]]></MsgType>
                <Image>
                    <MediaId><![CDATA[%s]]></MediaId>
                </Image>";
            $con .= sprintf($itemTpl, 'http://www.suresong.cn/m/maizi/Uploads/201605/57469225dc622.jpg');
        }elseif($value_arr['type']=='voice'){ //语音
            $itemTpl = "<MsgType><![CDATA[voice]]></MsgType>
                <Voice>
                    <MediaId><![CDATA[media_id]]></MediaId>
                </Voice>";
            $con .= sprintf($itemTpl, $value_arr['content']['fileName'], ($value_arr['content']['filesize']/1024), $value_arr['content']['url'], $value_arr['content']['url']);
        }elseif($value_arr['type']=='video'){ //视频
            $itemTpl = "<MsgType><![CDATA[video]]></MsgType>
                <Video>
                    <MediaId><![CDATA[media_id]]></MediaId>
                    <Title><![CDATA[title]]></Title>
                    <Description><![CDATA[description]]></Description>
                </Video>";
            $con .= sprintf($itemTpl, $value_arr['content']['fileName'], ($value_arr['content']['filesize']/1024), $value_arr['content']['url'], $value_arr['content']['url']);
        }else{

            if(!is_array($value_arr)){
                    $con.="<MsgType><![CDATA[text]]></MsgType>
    					<Content><![CDATA[{$value_arr}]]></Content> 
                        <FuncFlag>0</FuncFlag>";   
            }else{
    			$mycounts=count($value_arr);
    			$con.="<MsgType><![CDATA[news]]></MsgType>
    				<Content><![CDATA[]]></Content> 
    				<ArticleCount>{$mycounts}</ArticleCount> 
    				 <Articles>"; 
    	       $itemTpl = "<item>
                    <Title><![CDATA[%s]]></Title>
                    <Description><![CDATA[%s]]></Description>
                    <PicUrl><![CDATA[%s]]></PicUrl>
                    <Url><![CDATA[%s]]></Url>
                    </item>";
    			foreach($value_arr as $item){ 
    				$con .= sprintf($itemTpl, $item['Title'], $item['Description'], $item['PicUrl'], $item['Url']);
    			} 
    			$con.="</Articles>
    				 <FuncFlag>0</FuncFlag>";
    		}

        }
        $con.="</xml>"; 
        return $con; 
    } 
  
    private function checkSignature() 
    { 
        $signature = $_GET["signature"]; 
        $timestamp = $_GET["timestamp"]; 
        $nonce = $_GET["nonce"];     
                 
        $token = TOKEN; 
        $tmpArr = array($token, $timestamp, $nonce); 
        sort($tmpArr); 
        $tmpStr = implode( $tmpArr ); 
        $tmpStr = sha1( $tmpStr ); 
         

        if( $tmpStr == $signature ){ 
            return true; 
        }else{ 
            return false; 
        } 
    } 

    private function get_php_file($filename) {
        return trim(substr(file_get_contents($filename), 15));
    }
    private function set_php_file($filename, $content) {
        $fp = fopen($filename, "w+");
        fwrite($fp, $content);
        fclose($fp);
    }
    //by cheney
    private function httpGet($url, $data=null) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        if (!empty($data)){
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);   //只需要设置一个秒的数量就可以
        $output = curl_exec($ch);
        if(curl_errno($ch)>0) error_log(curl_error($ch)." \n", 3, "curl_err.log");
        curl_close($ch);
        return $output;
    }

    private function wei_curl($url, $data=null) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        if (!empty($data)){
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);   //只需要设置一个秒的数量就可以
        $output = curl_exec($ch);
        if(curl_errno($ch)>0) error_log(curl_error($ch)." \n", 3, "curl_err.log");
        curl_close($ch);
        return $output;
    }
} 


//百度提供天气预报查询接口API
function getWeather($cityName)
{
    if ($cityName == "" || (strstr($cityName, "+"))){
        return "发送天气+城市，例如'天气深圳'";
		exit;
    }
    $url = "http://api.map.baidu.com/telematics/v3/weather?location=".urlencode($cityName)."&output=json&ak=ECe3698802b9bf4457f0e01b544eb6aa";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);
    $result = json_decode($output, true);
    if ($result["error"] != 0){
        return $result["status"];
    }
    $curHour = (int)date('H',time());
    $weather = $result["results"][0];
    $weatherArray[] = array("Title" =>$weather['currentCity']."天气预报", "Description" =>"", "PicUrl" =>"", "Url" =>"");
    for ($i = 0; $i < count($weather["weather_data"]); $i++) {
        $weatherArray[] = array("Title"=>
            $weather["weather_data"][$i]["date"]."\n".
            $weather["weather_data"][$i]["weather"]." ".
            $weather["weather_data"][$i]["wind"]." ".
            $weather["weather_data"][$i]["temperature"],
        "Description"=>"", 
        "PicUrl"=>(($curHour >= 6) && ($curHour < 18))?$weather["weather_data"][$i]["dayPictureUrl"]:$weather["weather_data"][$i]["nightPictureUrl"], "Url"=>"");
    }
    return $weatherArray;
}
//simsim机器人
function SimSimi($keyword) {
    //----------- 获取COOKIE ----------//  
    $url = "http://www.simsimi.com/";  
    $ch = curl_init($url);  
    curl_setopt($ch, CURLOPT_HEADER,1);  
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);  
    $content = curl_exec($ch);  
    list($header, $body) = explode("\r\n\r\n", $content);  
    preg_match("/set\-cookie:([^\r\n]*);/iU", $header, $matches);  
    $cookie = $matches[1];  
    curl_close($ch);  
  
    //----------- 抓 取 回 复 ----------//  
    $url = "http://www.simsimi.com/func/req?lc=ch&msg=$keyword";  
    $ch = curl_init($url);  
    curl_setopt($ch, CURLOPT_REFERER, "http://www.simsimi.com/talk.htm?lc=ch");  
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);  
    curl_setopt($ch, CURLOPT_COOKIE, $cookie);  
    $content = json_decode(curl_exec($ch),1);  
    curl_close($ch);  
  
    if($content['result']=='100') {  
        $content['response'];  
        return $content['response'];  
    } else {  
        return '我还不会回答这个问题...';  
    }  
}  
  //翻译函数
function fanyi($keyword){
	$keyword = trim(substr($keyword,6,strlen($keyword)-6));
	$tranurl="http://openapi.baidu.com/public/2.0/bmt/translate?client_id=9peNkh97N6B9GGj9zBke9tGQ&q={$keyword}&from=auto&to=auto";//百度翻译地址
	$transtr=file_get_contents($tranurl);//读入文件
	$transon=json_decode($transtr);//json解析
	//print_r($transon);
	$contentStr = $transon->trans_result[0]->dst;//读取翻译内容
	return $contentStr;
}
//
function jiqiren($keyword){
    $ch = curl_init();
    $url = 'http://apis.baidu.com/turing/turing/turing?key=879a6cb3afb84dbf4fc84a1df2ab7319&info={$keyword}&userid=eb2edb736';
    $header = array(
        'apikey: 99a09ae2cdc9ef20d2f64f5385e4637e',
    );
    // 添加apikey到header
    curl_setopt($ch, CURLOPT_HTTPHEADER  , $header);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    // 执行HTTP请求
    curl_setopt($ch , CURLOPT_URL , $url);
    $res = curl_exec($ch);
    $transon=json_decode($res, true);
	return $transon[1];
}
	
	
  //快递查询函数
function getDindan($keyword){
	$keyword = trim(substr($keyword,6,strlen($keyword)-6));
	$status=array('0'=>'查询出错','1'=>'暂无记录','2'=>'在途中','3'=>'派送中','4'=>'已签收','5'=>'拒收','6'=>'疑难件','7'=>'退回');//构建快递状态数组
	$kuaidiurl="http://www.aikuaidi.cn/rest/?key=ff4735a30a7a4e5a8637146fd0e7cec9&order={$keyword}&id=shentong&show=xml";//快递地址
	$kuaidistr=file_get_contents($kuaidiurl);//读入文件
	$kuaidiobj=simplexml_load_string($kuaidistr);//xml解析
	$kuaidistatus = $kuaidiobj->Status;//获取快递状态
	$kuaistr=strval($kuaidistatus);//对象转换为字符串
	$contentStr0 =$status[$kuaistr];//根据数组返回
	foreach ($kuaidiobj->Data->Order as $a)
	 {    
	 foreach ($a->Time as $b)
	   {
		foreach ($a->Content as $c)
		{$m.="{$b}{$c}";}
		}
	 }
	//遍历获取快递时间和事件
	$contentStr="你的快递单号{$keyword}{$contentStr0}{$m}";
	return $contentStr;
  }
  //笑话
function getJock(){
    $param=array(
        "key"   => "free",
        "appid" =>   "0",
        "msg"   =>   "笑话"
    );
    $datas=http("http://api.qingyunke.com/api.php",$param);
    $json=json_decode($datas);
    if($json->result==0){
        $content=str_replace("{br}","\n",$json->content);
    }else{
        $content="从前有座山,山上有座庙,庙里有个小和尚,-^-,连接出错,请稍后再试,^_^.";
    }
    return $content;
}
  
//点歌
function getSong($song_title){
    //$song_title="春天里";
    $m_param=array(
        "op"    =>"7",
        "mode"  =>"1",
        "count" =>"1",
        "title" =>$song_title
    );
    $song_datas=http("http://box.zhangmen.baidu.com/x",$m_param);  
    $song_utf8=utf8($song_datas,"gbk");

    preg_match_all('/\<name\>(.*?)\<\/name\>/s', $song_utf8, $matchs); 
    if(count($matchs)>1){
        $song_name=$matchs[1][0];
    }
    if(empty($song_name)){
        return "未找到这首歌,检查一下网络或咱们换一首吧.";
    }

    $param=array(
        "op"    =>"12",
        "count" =>"1",
        "title" =>trim("$song_name")
    );
    //查找作者的这首歌
    $datas=http("http://box.zhangmen.baidu.com/x",$param);

    $xml = new DOMDocument(); 
    $xml->loadXML($datas);

    $lst=$xml->getElementsByTagName('encode');

    //普通质量地址
    $item=$lst->item(0);
    $pre=$item->nodeValue;
    $suffix=$item->nextSibling->nodeValue;
    $MusicURL=str_replace(strrchr($pre, "/"),"",$pre)."/".str_replace(strrchr($suffix, "&"),"",$suffix);


    //高质量地址
    $item=$lst->item(0);
    $pre=$item->nodeValue;
    $suffix=$item->nextSibling->nodeValue;
    $HQMusicUrl=str_replace(strrchr($pre, "/"),"",$pre)."/".str_replace(strrchr($suffix, "&"),"",$suffix);


    $datas=array();
    $datas[]=str_replace('$', "", $song_name);//音乐标题
    $datas[]="来自互联网";//音乐描述
    $datas[]="$MusicURL";//音乐链接
    $datas[]="$HQMusicUrl";//高质量音乐链接，WIFI环境优先使用该链接播放音乐

    //sendLyric(str_replace('$$', "-", $song_name),$fromUser);
    return $datas;

}
//中英互译  歌词 藏头诗  机器人
function ajaxsns_comm($msg){
    $param=array(
        "key"   => "free",
        "appid" =>   "0",
        "msg"   =>   "$msg"
    );
    $datas=http("http://api.qingyunke.com/api.php",$param);
    $json=json_decode($datas);
    if($json->result==0){
        $content=str_replace("{br}","\n",$json->content);
        $content=str_replace("提示：按分类看笑话请发送“笑话分类”","",$content);
        $content=str_replace("菲菲","铭铭",$content);
        $content=str_replace("梅州行","就成铭",$content);
        $content=str_replace("u3j.net/mzxing","9chengming.com",$content);
    }else{
        $content="从前有座山,山上有座庙,庙里有个小和尚,-^-,连接出错,请稍后再试,^_^.";
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
//城市列表
function citylist($city){
	$url = 'http://apis.baidu.com/apistore/weatherservice/citylist?cityname='.urlencode($city);
	$citylist=baiduapi($url);
	if ($citylist['errNum']!=0){
		$content= $citylist['errNum'].$citylist['errMsg'];
	}else{
		$content="城市列表：\n";
		foreach($citylist['retData'] as $item){ 
			$content .= $item['province_cn'].$item['district_cn'].$item['name_cn']."\n";
		}
	}
	return $content;
}
//身份证
function idservice($id){
	$url = 'http://apis.baidu.com/apistore/idservice/id?id='.$id;
	$idservice=baiduapi($url);
	if ($idservice['errNum']!=0){
		$content= $idservice['errNum'].$idservice['errMsg'];
	}else{
		$content = "身份证查询：\n性别：".($idservice['retData']['sex']=='M'?'男':'女')."\n出生日期：".$idservice['retData']['birthday']."\n地址：".$idservice['retData']['address'];
	}
	return $content;
}
//手机号码归属地
function mobilephone($tel){
            $url = 'http://apis.baidu.com/apistore/mobilenumber/mobilenumber?phone='.$tel;
	$idservice=baiduapi($url);
	if ($idservice['errNum']==0){
		$content= '运营商:'.$idservice['retData']['supplier']."\n省份:".$idservice['retData']['province']."\n城市:".$idservice['retData']['city'];
	}else{
		$content = '获取失败。'.$idservice['retMsg'];
	}
	return $content;
}
//成语查询
function chengyu($chengyu){
             $url = 'http://apis.baidu.com/avatardata/chengyu/search?keyWord='.urlencode($chengyu).'&page=1&rows=5';
	$chengyu=baiduapi($url);
	if ($chengyu['error_code']!=0){
		$content= $chengyu['error_code'].$chengyu['reason'];
	}else{
		$content="成语查询：\n";
		foreach($chengyu['result'] as $item){ 
                                $content .= $item['name']."\n";
                                $url = 'http://apis.baidu.com/avatardata/chengyu/lookup?id='.$item['id'];
                                $chengyu=baiduapi($url);
                                if($chengyu['error_code']==0){
                                    $content .= $chengyu['result']['spell']."\n".$chengyu['result']['content']."\n\n";
                                }
		}
	}
	return $content;
}
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
//绕口令
function rkl(){
    $url = 'http://apis.baidu.com/txapi/rkl/rkl?num=1';
    $chengyu=baiduapi($url);
    if ($chengyu['msg']!='success'){
        $content= $chengyu['msg'].$chengyu['code'];
    }else{
        $content .= $chengyu['newslist'][0]['content'];
    }
    return $content;
}
//生日预测
function shengri($m,$d){
    $url = 'http://apis.baidu.com/txapi/dob/dob?m='.$m."&d=".$d;
    $chengyu=baiduapi($url);
    // error_log( mb_strlen(strip_tags($chengyu['newslist'][0]['content']))." \n", 3, "curl_err.log");
    if ($chengyu['msg']!='success'){
        $content= $chengyu['msg'].$chengyu['code'];
    }else{
        $content=$chengyu['newslist'][0]['title']."\n";
        $temp=strip_tags($chengyu['newslist'][0]['content']);
        if(mb_strlen($temp)>2000)
            $content .= mb_strcut($temp, 0, 2000, 'utf-8');
        else
            $content .= $temp;
    }
    return $content;
}
//周公解梦
function jiemeng($m){
    $url = 'http://apis.baidu.com/txapi/dream/dream?word='.$m;
    $chengyu=baiduapi($url);
    if ($chengyu['msg']!='success'){
        $content= $chengyu['msg'].$chengyu['code'];
    }else{
        $content=$chengyu['newslist'][0]['title']."\n";
        $content .= $chengyu['newslist'][0]['result'];
    }
    return $content;
}
//名言警句
function mingyan(){
    $url = 'http://apis.baidu.com/txapi/dictum/dictum';
    $chengyu=baiduapi($url);
    if ($chengyu['msg']!='success'){
        $content= $chengyu['msg'].$chengyu['code'];
    }else{
        $content=$chengyu['newslist'][0]['mrname']."\n";
        $content .= $chengyu['newslist'][0]['content'];
    }
    return $content;
}
//今日油价
function youjia($prov){
    $url = 'http://apis.baidu.com/showapi_open_bus/oil_price/find?prov='.$prov;
    $chengyu=baiduapi($url);
    if ($chengyu['showapi_res_body']['list']==''){
        $content= '无相关信息';
    }else{
        $content=$chengyu['showapi_res_body']['list'][0]['prov']."\n";
        $content .= 'p90:'.$chengyu['showapi_res_body']['list'][0]['p90']."\n";
        $content .= 'p0:'.$chengyu['showapi_res_body']['list'][0]['p0']."\n";
        $content .= 'p97:'.$chengyu['showapi_res_body']['list'][0]['p97']."\n";
        $content .= 'p93:'.$chengyu['showapi_res_body']['list'][0]['p93']."\n";
        $content .= 'ct:'.$chengyu['showapi_res_body']['list'][0]['ct'];
    }
    return $content;
}
//星座运势
function xingzuo($xx){
    $url = 'http://apis.baidu.com/bbtapi/constellation/constellation_query?consName='.$xx.'&type=today';
    $chengyu=baiduapi($url);
    if ($chengyu['error_code']!='0'){
        $content= $chengyu['reason'].$chengyu['error_code'];
    }else{
        $content=$chengyu['name']." 今日运势\n";
        $content .= 'QFriend:'.$chengyu['QFriend']."\n";
        $content .= 'all:'.$chengyu['all']."\n";
        $content .= 'color:'.$chengyu['color']."\n";
        $content .= 'health:'.$chengyu['health']."\n";
        $content .= 'love:'.$chengyu['love']."\n";
        $content .= 'money:'.$chengyu['money']."\n";
        $content .= 'number:'.$chengyu['number']."\n";
        $content .= 'summary:'.$chengyu['summary']."\n";
        $content .= 'work:'.$chengyu['work'];
    }
    return $content;
}
// 搞笑图片
function gaoxiao($p=1){
    $url = 'http://apis.baidu.com/showapi_open_bus/showapi_joke/joke_pic?maxResult=5&page='.$p;
    $chengyu=baiduapi($url);
    if ($chengyu['showapi_res_code']!='0'){
        $tempArray= $chengyu['showapi_res_error'].$chengyu['showapi_res_code'];
    }else{

        $tempArray[] = array("Title" =>"搞笑图片", "Description" =>"", "PicUrl" =>"", "Url" =>"");

        $temp=$chengyu['showapi_res_body']['contentlist'];
        for($i=0; $i<count($temp); $i++){
            $tempArray[] = array("Title"=>$temp[$i]['title'],
            "Description"=>"", 
            "PicUrl"=>$temp[$i]['img'],
            "Url"=>$temp[$i]['img']);
        }
    }
    return $tempArray;
}
// 车票
function chepiao($from,$to,$time){
    $time=$time?$time:date('Y-m-d',time());
    $from=$from?$from:'广州';
    $to=$to?$to:'汕头';
    $url = 'http://apis.baidu.com/qunar/qunar_train_service/s2ssearch?version=1.0&from='.$from.'&to='.$to.'&date='.$time;
    $chengyu=baiduapi($url);
    if ($chengyu['ret']!='1'){
        $content= $chengyu['errmsg'].$chengyu['errcode'];
    }else{

        $temp=$chengyu['data']['trainList'];
        for($i=0; $i<count($temp); $i++){
            $content.=$temp[$i]['trainType'].$temp[$i]['trainNo']."\n开始".$temp[$i]['startTime']."\n结束".$temp[$i]['endTime']."\n";
            for($j=0; $j<count($temp[$i]['seatInfos']); $j++){
                $content.=$temp[$i]['seatInfos'][$j]['seat'].'价格'.$temp[$i]['seatInfos'][$j]['seatPrice'].'数量'.$temp[$i]['seatInfos'][$j]['remainNum']."\n";
            }
            // $content.="\n";
        }
    }
    if(mb_strlen($content)>2000)
        $content = mb_strcut($content, 0, 2000, 'utf-8');
    return $content;
}














 function http($url, $params, $method = 'GET', $header = array(), $multi = false){
  $opts = array(
      CURLOPT_TIMEOUT        => 30,
      CURLOPT_RETURNTRANSFER => 1,
      CURLOPT_SSL_VERIFYPEER => false,
      CURLOPT_SSL_VERIFYHOST => false,
      CURLOPT_HTTPHEADER     => $header
  );
  /* 根据请求类型设置特定参数 */
  switch(strtoupper($method)){
    case 'GET':
      $opts[CURLOPT_URL] = $url . '?' . http_build_query($params);
      break;
    case 'POST':
      //判断是否传输文件
      //$params = $multi ? $params : http_build_query($params);
      $opts[CURLOPT_URL] = $url;
      $opts[CURLOPT_POST] = 1;
      $opts[CURLOPT_POSTFIELDS] = $params;
      break;
    default:
      throw new Exception('不支持的请求方式！');
  }
  
  /* 初始化并执行curl请求 */
  $ch = curl_init();
  curl_setopt_array($ch, $opts);
  $data  = curl_exec($ch);
  $error = curl_error($ch);
  curl_close($ch);
  if($error) throw new Exception('请求发生错误：' . $error);
  return  $data;
 }
   function utf8($str, $encoding="gb2312")
  {
    if (function_exists('iconv'))
    {
      return @iconv($encoding, 'UTF-8', $str);
    }
    elseif (MB_ENABLED === TRUE)
    {
      return @mb_convert_encoding($str, 'UTF-8', $encoding);
    }
    return FALSE;
  }
function strreplace($str){
    $str = str_replace('+','',$str);
    $str = str_replace('-','',$str);
    $str = str_replace(',','',$str);
    $str = str_replace('，','',$str);
    $str = str_replace('；','',$str);
    return $str;
}
?>