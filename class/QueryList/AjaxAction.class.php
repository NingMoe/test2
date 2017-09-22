<?php
/**
 * 
 * AreaAction.class.php (ajax 获取地址)
 *
 * @package      	YOURPHP
 * @author          liuxun QQ:147613338 <admin@yourphp.cn>
 * @copyright     	Copyright (c) 2008-2011  (http://www.yourphp.cn)
 * @license         http://www.yourphp.cn/license.txt
 * @version        	YourPHP企业网站管理系统 v2.1 2011-03-01 yourphp.cn $
 */
if(!defined("Yourphp")) exit("Access Denied");
class AjaxAction extends BaseAction
{
    public function index()
    {
	 exit;
    }
    public function area()
    {
		$module = M('Area');
		$id = intval($_REQUEST['id']);
		$level= intval($_REQUEST['level']);
		$provinceid= intval($_REQUEST['provinceid']);
		$cityid= intval($_REQUEST['cityid']);
		$areaid= intval($_REQUEST['areaid']);
		
 		
		$province_str='<option value="0">请选择省份...</option>';
		$city_str='<option value="0">请选择城市...</option>';
		$area_str='<option value="0">请选择区域...</option>';
		$str ='';

		$r = $module->where("parentid=".$id)->select();	 		
		foreach($r as $key=>$pro){
			$selected = ( $pro['id']==$provinceid) ? ' selected="selected" ' : '';
			$str .='<option value="'.$pro['id'].'"'.$selected.'>'.$pro['name'].'</option>';
		}
		if($level==0){
			$province_str .=$str;
		}elseif($level==1){
			$city_str .=$str;
		}elseif($level==2){
			$area_str .=$str;
		}
		$str='';
		if($provinceid){
			
			$rr = $module->where("parentid=".$provinceid)->select();	 		
			foreach($rr as $key=>$pro){
				$selected = ($pro['id']==$cityid) ? ' selected="selected" ' : '';
				$str .='<option value="'.$pro['id'].'"'.$selected.'>'.$pro['name'].'</option>';
			}
			$city_str .=$str;
		}
		$str='';
		if($cityid){
			$rrr = $module->where("parentid=".$cityid)->select();	 		
			foreach($rrr as $key=>$pro){
				$selected = ($pro['id']==$areaid) ? ' selected="selected" ' : '';
				$str .='<option value="'.$pro['id'].'"'.$selected.'>'.$pro['name'].'</option>';
			}
			$area_str .=$str;
		}
		
		$res=array();
		$res['data']= $rs ? 1 : 0 ;
		$res['province'] =$province_str;
		$res['city'] =$city_str;
		$res['area'] =$area_str;
		echo json_encode($res); exit;
	 exit;
    }

	public function address(){
		$do=get_safe_replace($_REQUEST['do']);
		$model = M('User_address');
		$id = intval($_REQUEST['id']);
		
		$provinceid= intval($_REQUEST['province']);
		$cityid= intval($_REQUEST['city']);
		$areaid= intval($_REQUEST['area']);
		
		$userid = $_POST['userid'] = $this->_userid;
		if($do=='save'){
			$id= intval($_POST['id']);
			$_POST['isdefault']=1;
			if($userid){				
				$model->where("userid=".$userid)->save(array('isdefault'=>0));				
				if($id){
					$r = $model->save($_POST);
					if($model->getDbError())die(json_encode(array('id'=>0)));
					$_POST['edit'] =1;				
				}else{
					$where['province'] = array('eq',$provinceid);
					$where['city'] = array('eq',$cityid);
					$where['area'] = array('eq',$areaid);
					$where['consignee'] = array('eq',$_POST['consignee']);
					$where['address'] = array('eq',$_POST['address']);
					$ir = $model->where($where)->find();
					if($ir){
						echo json_encode(array('error'=>'收货信息已经存在！'));exit;
					}
					$id=$model->add ($_POST);
				}
			}else{
					$_POST['id']=1;
					$data = serialize($_POST);
					cookie('guest_address',$data,315360000);
					$id=1;
					$_POST['edit'] =1;
			}
			if($id){
				$_POST['id'] =$id;
				die(json_encode($_POST));
			}else{
				die(json_encode(array('id'=>0)));
			}
			 
		}elseif($do=='get'){
			if($userid){	
				$data=$model->find($id);
			}else{
				$data = unserialize( cookie('guest_address'));
			}
			if($data){
				die(json_encode($data));
			}else{
				die(json_encode(array('id'=>0)));
			}
			exit;
		}
	
	}

	public function shipping(){
		$do=get_safe_replace($_REQUEST['do']);
		$model = M('Shipping');
		$id = intval($_REQUEST['id']); 
 
		if($do=='get'){
			$data=$model->find($id);
			if($data){
				echo json_encode($data);
			}else{
				echo json_encode(array('id'=>0));
			}
			exit;
		}
	
	}
	
    public function getPro()
    {
		$pagesiz='15';
		$module = M('Product');
		$p = intval($_REQUEST['p']);
		$id = intval($_REQUEST['id']);
		$dq = intval($_REQUEST['dq']);
		$nl = intval($_REQUEST['nl']);
		$firstlist=$p*$pagesiz;
		if ($this->Categorys[$id][child]){
			$where="status=1 and catid in(".$this->Categorys[$id][arrchildid].")";
		}else{
			$where='status=1 and catid='.$id;
		}
		$where .= $dq?" and concat(',',diqu,',') like '%,".$dq.",%'":'';
		$where .= $nl?" and concat(',',ages,',') like '%,".$nl.",%'":'';
		$str="";
		$count = $module->where($where)->count();
		$pageTotal =ceil($count/$pagesiz);
if($count){
	$list = $module->where($where)->order('listorder desc,createtime desc,id desc')->limit($firstlist,$pagesiz)->select();
	
	
	
	foreach ($list as $v){
		$v['answer']=M('Guestbook')->order('createtime desc,id desc')->where('linkid='.$v['id'].' and catid='.$v[catid])->field('username,content')->limit(1)->find();
		$v['answer']['counts'] = M('Guestbook')->where('linkid='.$v['id'].' and catid='.$v[catid])->count();
		$str.="<li>
                	<a href='".$v[url]."'><img src='".$v[thumb]."' width='230' height='223' /></a>
                    <h6>".$v[title]."</h6>
                    <div class='MM'><img src='/Public/img/226.png' /><span>点评：<em>".$v[answer][counts]."</em></span><span>总体评分</span><img src='/Public/Css/s".$v[zongfen].".png' /></div>
               	</li>";
	}
}
		$data=array();
		$data['li']= $str ;
		if($pageTotal <= intval($p)){
			$data["next_page"] = 0;
		}else{
			$data["next_page"] = intval($p) + 1;
		}
		echo json_encode($data); exit;
	 exit;
    }
	
	
	
	
	
	
    public function getNews()
    {
		$pagesiz='15';
		$module = M('Article');
		$p = intval($_REQUEST['p']);
		$id = intval($_REQUEST['id']);
		$firstlist=$p*$pagesiz;
		if ($this->Categorys[$id][child]){
			$where="status=1 and catid in(".$this->Categorys[$id][arrchildid].")";
		}else{
			$where='status=1 and catid='.$id;
		}
		$str="";
		$count = $module->where($where)->count();
		$pageTotal =ceil($count/$pagesiz);
if($count){
	$list = $module->where($where)->order('listorder desc,createtime desc,id desc')->limit($firstlist,$pagesiz)->select();
	foreach ($list as $v){
		$str.="<div class='block' onclick=location.href='".$v[url]."'>
    	<img src='/Public/img/243.png' id='i1'/>
        <img src='/Public/img/244.png' id='i2'/>
		<div class='imgholder'>
			<img src='".$v[thumb]."' id='i3'/>
		</div>
        <div class='kc'>
            <h4>".$v[title]."</h4>
            <p>".$v[descirption]."</p>
        </div>
	</div>";
	}
}
		$data=array();
		$data['li']= $str ;
		if($pageTotal <= intval($p)){
			$data["next_page"] = 0;
		}else{
			$data["next_page"] = intval($p) + 1;
		}
		echo json_encode($data); exit;
	 exit;
    }
	public function toupiao(){
		$userid = $this->_userid;
		if($this->_groupid==5){
			echo json_encode(4);
			exit;
		}elseif ($userid){
			$ip =get_client_ip();
			$tounum= M('Log_toupiao')->count();
			if($tounum>=10000){
				$touwhere['time']=array('LT',strtotime(date("Y-m-d")));
				M('Log_toupiao')->where($touwhere)->delete();
			}
			$id = intval($_REQUEST['tpid']);
			$aid = intval($_REQUEST['acid']);
			
			$model = M('Voting');
			$votes=$model->find($id);
			if ($votes)
			{
				$actinfos=explode("\n",$this->Categorys[$votes['catid']]['actinfo']);
				foreach($actinfos as $r) {
					$v = explode(",",$r);
					$k = trim($v[0]);
					if($k==$aid){
						$startstime=strtotime($v[1]);
						$endstime=strtotime($v[2]);
						break;
					}
				}
				if($startstime>time()||$endstime<time())
				{
					echo $startstime;
					echo json_encode(0);
					exit;
				}
			}else{
				echo json_encode(0);
				exit;
			}
			$begins=strtotime(date("Y-m-d"));
			$ends=strtotime(date("Y-m-d"))+3600*24;
			$logwhere['time']=array('BETWEEN',"$begins,$ends");
			$logwhere['userid']=array('eq',$userid);
			$logwhere['cid']=array('eq',$id);
			//$logwhere['ip']=array('eq',$ip);
			$lognum= M('Log_toupiao')->where($logwhere)->count();
			if ($lognum>=1){
				echo json_encode(2);
				exit;
			}
			if($model->where("id=".$id)->setInc('toupiaoshu')){
				$data['ip']=$ip;
				$data['userid']=$userid;
				$data['cid']=$id;
				$data['time']=time();
				M('Log_toupiao')->add($data);
				echo json_encode(1);
			}else{
				echo json_encode(0);
			}
			exit;
		}else{
			echo json_encode(3);
			exit;
		}
	}
 
	public function getjigou(){
		$id = intval($_REQUEST['tpid']);
		$where=$id?"concat(',',diqu,',') like '%,".$id.",%'":"";
		$model = M('Product');
		$jglist = $model->where($where)->field('title,url,createtime')->order('listorder desc,createtime desc,id desc')->limit(5)->select();
		$where .=" and posid=1";
		$hdlist = M('Activity')->where($where)->field('title,url,createtime')->order('listorder desc,createtime desc,id desc')->limit(5)->select();
		$data['state']='1';
		$data['info']="<div class='txt' style='display:block;'>
	<ul>";
		foreach($hdlist as $v){
	$data['info'].="
        <li><a href='".$v[url]."'><h5>".$v[title]."</h5></a><span>".date("Y-m-d",$v[createtime])."</span></li>";
		}
	$data['info'].="</ul>
    <a href='".$this->categorys[47][url]."'><img src='".__ROOT__."/Public/img/1604.png' id='aa'/></a></div>
<div class='txt' id='txt1'>
    <ul>";
		foreach($jglist as $v){
	$data['info'].="
        <li><a href='".$v[url]."'><h5>".$v[title]."</h5></a><span>".date("Y-m-d",$v[createtime])."</span></li>";
		}
	$data['info'].="</ul>
    <a href='".$this->categorys[4][url]."'><img src='".__ROOT__."/Public/img/1604.png' id='aa'/></a>
</div>";
		echo json_encode($data);exit;
	}
	
    public function getDown()
    {
		$pagesiz='12';
		$module = M('Download');
		
		//$module = intval($_REQUEST['stype'])? M('Picture'):M('Article');
		//echo $_REQUEST['stype'];
		$p = intval($_REQUEST['p']);
		$id = intval($_REQUEST['id']);
		$firstlist=$p*$pagesiz;
		if ($this->Categorys[$id][child]){
			$where="status=1 and catid in(".$this->Categorys[$id][arrchildid].")";
		}else{
			$where='status=1 and catid='.$id;
		}
		$str="";
		$count = $module->where($where)->count();
		$pageTotal =ceil($count/$pagesiz);
if($count){
	$list = $module->where($where)->order('listorder desc,createtime desc,id desc')->limit($firstlist,$pagesiz)->select();
	if (intval($_REQUEST['stype']))
	{
		foreach ($list as $v){
			$str.="<li>
				<img src='/Public/img/212.png' id='O1'/>
				<a href='".$v[ext]."' target='_blank'><img src='/Public/img/213.png' id='O2'/></a>
				<a href='".$v[ext]."'><img src='".$v[thumb]."' id='O5'/></a>
				<h5>".$v[title]."</h5>
				<div class='wenzi'>
					".$v[content]."
				</div>
			</li>";
		}
	}else{
		foreach ($list as $v){
			$str.="<li>
				<img src='/Public/img/212.png' id='O1'/>
				<a href='".$v[url]."'><img src='/Public/img/201405290902.png' id='O2'/></a>
				<a href='".$v[url]."'><img src='".$v[thumb]."' id='O5'/></a>
				<h5>".$v[title]."</h5>
				<div class='wenzi'>
					".$v[description]."
				</div>
			</li>";
		}
	}
}
		$data=array();
		$data['li']= $str ;
		if($pageTotal <= intval($p)){
			$data["next_page"] = 0;
		}else{
			$data["next_page"] = intval($p) + 1;
		}
		echo json_encode($data); exit;
	 exit;
    }
    public function getPic()
    {
		$pagesiz='15';
		$module = M('Picture');
		$p = intval($_REQUEST['p']);
		$id = intval($_REQUEST['id']);
		$firstlist=$p*$pagesiz;
		if ($this->Categorys[$id][child]){
			$where="status=1 and catid in(".$this->Categorys[$id][arrchildid].")";
		}else{
			$where='status=1 and catid='.$id;
		}
		$str="";
		$count = $module->where($where)->count();
		$pageTotal =ceil($count/$pagesiz);
if($count){
	$list = $module->where($where)->order('listorder desc,createtime desc,id desc')->limit($firstlist,$pagesiz)->select();
	foreach ($list as $k=>$v){
		
		$list[$k]['answer']=M('Guestbook')->order('createtime desc,id desc')->where('linkid='.$v['id'].' and catid='.$v[catid])->field('username,content')->limit(1)->find();
		$list[$k]['answer']['counts'] = M('Guestbook')->where('linkid='.$v['id'].' and catid='.$v[catid])->count();
		
		
		$str.="<div class='grid'>
            	<img src='/Public/img/150.png' id='T'/>
                <a href='".$v[url]."'><img src='/Public/img/151.png' ID='B'/></a>
                <a href='".$v[url]."'><img src='".$v[thumb]."' id='height'/></a>
                <h4>".$v[title]."</h4>
                <div class='px'></div>
                <h5>发问人：".$v[username]."</h5>
                <h5>回答人：".$v[answer][username]."</h5>
                <div class='px'></div>
                <p>".$v[answer][content]."</p>
            </div>";
	}
}
		$data=array();
		$data['li']= $str ;
		if($pageTotal <= intval($p)){
			$data["next_page"] = 0;
		}else{
			$data["next_page"] = intval($p) + 1;
		}
		echo json_encode($data); exit;
	 exit;
    }
    public function getadmode()
    {
		$data=array();
		$showdiqu=$_POST['showdiqu'];
		//$showdiqu=str_cut($showdiqu,4);
/*
switch ($showdiqu)
{
case "祈福店":
case "番禺祈福":
  $showhdp='7';
  break;  
case "东圃店":
case "天河东圃":
  $showhdp='15';
  break;
case "中医院店":
case "番禺中医院":
  $showhdp='14';
  break;
case "前进路店":
case "海珠前进路":
  $showhdp='13';
  break;
case "珠江新城店":
case "天河珠江新城":
  $showhdp='12';
  break;
case "大石店":
case "番禺大石":
  $showhdp='11';
  break;
case "远景店":
case "白云远景路":
  $showhdp='10';
  break;
default:
  $showhdp='9';
}*/
$showhdp='7';

$where="fid=".$showhdp;
		$module = M('slide_data');
		$list = $module->where($where)->order('listorder desc,id desc')->select();
		
		$str="<div class='ad1'>";
	foreach($list as $k=>$v){
		$str.="<a href='".$v[link]."' target='_blank'><img src='".$v[pic]."'  class='adl'/></a>";
		if($k==2){
			$str.="</div><div class='ad2'>";
		}
	}
	$str.="</div>";
		
		$data['li']= $str;
		echo json_encode($data); exit;
	 exit;
    }
	public function showlike()
	{
		$id = $id ? $id : intval($_REQUEST['id']);
		M('Guestbook')->where("id=".$id)->setInc('ilike');
		$data = M('Guestbook')->find($id);
		echo json_encode($data['ilike']); exit;
	}
	public function showhate()
	{
		$id = $id ? $id : intval($_REQUEST['id']);
		M('Guestbook')->where("id=".$id)->setInc('ihate');
		$data = M('Guestbook')->find($id);
		echo json_encode($data['ihate']); exit;
	}
	public function mytest2()
	{
		//$ss="background:url(http://img.izaojiao.com/v3/jigou/tp8.jpg) no-repeat;background-position:top right;";
		//print_r(substr($ss,strpos($ss,"(")+1,strpos($ss,")")-strpos($ss,"(")-1));
//导出		
set_time_limit(0);
require_once(dirname(__FILE__).'/QueryList/QueryList.class.php');
//列表 第一页
$url = "http://www.izaojiao.com/jigou/guangzhou/all";
$reg = array("diqu"=>array(".gray2 a:eq(0)","html"),"url"=>array(".tu a:eq(0)","href"));
$rang = ".sou";
//使用curl抓取源码并以GBK编码格式输出
$hj = QueryList::Query($url,$reg,$rang,'curl','utf-8');
$arr = $hj->jsonArr;
//count($arr)
for ($i = 0;  $i< 1; $i++) 
{
	//详细页
	$url = "http://www.izaojiao.com".$arr[$i]['url'];
	$regs = array(
			//"catid"=>array("",""),
			"title"=>array(".tit","html"),
			"thumb"=>array(".g_fc li:eq(0) img","src"),
			//"pics"=>array(".tit","html"),
			//"diqu"=>array(".tit","html"),
			"ages"=>array(".jie ul li:eq(1)","html"),
			"sbanner"=>array(".g_fc li:eq(0) img","src"),
			"bbanner"=>array(".w_1000","style"),
			//"kecheng"=>array(".tit","html"),
			//"huodong"=>array(".tit","html"),
			"pinpai"=>array(".tit","html"),
			//"youhui"=>array(".tit","html"),
			//"wenzhang"=>array(".tit","html"),
			//"ditu"=>array(".tit","html"),
			//"jianjie"=>array(".tit","html"),
			//"links"=>array(".tit","html"),
			"dizhi"=>array(".jie ul li:eq(3) span:eq(1)","html"),
			"zongfen"=>array(".xing .m_b10 span","title"),
			"yjpf"=>array(".xing li:eq(2) span","title"),
			"rjpf"=>array(".xing li:eq(3) span","title"),
			"qfpf"=>array(".xing li:eq(4) span","title"),
			"hdpf"=>array(".xing li:eq(5) span","title"),
			//"createtime"=>array(".tit","html"),
			"content"=>array(".jie ul","html")
			);
	$hj = QueryList::Query($url,$regs);
	$tmps=$hj->jsonArr;
	//具体机构简介
	$url = "http://www.izaojiao.com".$arr[$i]['url']."/intro";
	$regs = array(
			"jianjie"=>array(".p_15","html")
			);
	$hj = QueryList::Query($url,$regs);
	$tmps_i= $hj->jsonArr;
	$tmps['0']['jianjie']=$tmps_i['0']['jianjie'];
	//具体机构图片
	$url = "http://www.izaojiao.com".$arr[$i]['url']."/photos";
	$regs = array(
			"pics"=>array("li img","src")
			);
	$rang = ".j_tp ul";
	$hj = QueryList::Query($url,$regs,$rang,'curl','utf-8');
	$tmps_p= $hj->jsonArr;
	$tmps['0']['pics']=$tmps_p;
	
	//具体机构体系
	$url = "http://www.izaojiao.com".$arr[$i]['url']."/kecheng";
	$regs = array(
			"title"=>array("img","alt"),
			"thumb"=>array("img","src"),
			"url"=>array("a","href")
			);
	$rang = ".main_left .g_tp";
	$hj = QueryList::Query($url,$regs,$rang,'curl','utf-8');
	$tmps_k= $hj->jsonArr;
	foreach($tmps_k as $x=>$y){
		$url = "http://www.izaojiao.com".$y['url'];
		$regs = array(
				"content"=>array(".main_left .hcon","html")
				);
		$hj = QueryList::Query($url,$regs);
		$tmps_k[$x]['content']=$hj->jsonArr['0']['content'];
	}
	$tmps['0']['kecheng']=$tmps_k;
	
	//具体机构中心活动
	$url = "http://www.izaojiao.com".$arr[$i]['url']."/huodong";
	$regs = array(
			"title"=>array(".g_tp img","alt"),
			"thumb"=>array(".g_tp img","src"),
			"times"=>array(".g_tx .green","html"),
			"jianjie"=>array(".g_jj","html"),
			//"content"=>array("img","src"),
			"url"=>array(".g_tp a","href")
			);
	$rang = ".main_left .hcon .clearfix";
	$hj = QueryList::Query($url,$regs,$rang,'curl','utf-8');
	$tmps_h= $hj->jsonArr;
	foreach($tmps_h as $x=>$y){
		$url = "http://www.izaojiao.com".$y['url'];
		$regs = array(
				"content"=>array(".main_left .hcontent:eq(1)","html")
				);
		$hj = QueryList::Query($url,$regs);
		$tmps_h[$x]['content']=$hj->jsonArr['0']['content'];
	}
	$tmps['0']['huodong']=$tmps_h;
	
	//具体机构最新优惠
	$url = "http://www.izaojiao.com".$arr[$i]['url']."/cuxiao";
	$regs = array(
			"title"=>array("a.f14","html"),
			"url"=>array("a.f14","href")
			);
	$rang = ".main_left .ayh tr:gt(0)";
	$hj = QueryList::Query($url,$regs,$rang,'curl','utf-8');
	$tmps_z= $hj->jsonArr;
	foreach($tmps_z as $x=>$y){
		$url = "http://www.izaojiao.com".$y['url'];
		$regs = array(
				"content"=>array("#page-content","html")
				);
		$hj = QueryList::Query($url,$regs);
		$tmps_z[$x]['content']=$hj->jsonArr['0']['content'];
	}
	$tmps['0']['youhui']=$tmps_z;
	
	//具体机构文章
	$url = "http://www.izaojiao.com".$arr[$i]['url'];
	$regs = array(
			"title"=>array("a","html"),
			"url"=>array("a","href")
			);
	$rang = ".main_right .hcon:eq(3) li";
	$hj = QueryList::Query($url,$regs,$rang,'curl','utf-8');
	$tmps_w= $hj->jsonArr;
	foreach($tmps_w as $x=>$y){
		$url = "http://www.izaojiao.com".$y['url'];
		$regs = array(
				"content"=>array(".hcontent div:eq(4)","html")
				);
		$hj = QueryList::Query($url,$regs);
		$tmps_w[$x]['content']=$hj->jsonArr['0']['content'];
	}
	$tmps['0']['wenzhang']=$tmps_w;
	
	//具体机构评论
	$url = "http://www.izaojiao.com".$arr[$i]['url']."/reviews";
	$regs = array(
			"touxiang"=>array(".d_yh img","src"),
			"content"=>array(".mid div:eq(1)","html"),
			"zongfen"=>array(".top span:eq(2)","title")
			);
	$rang = ".main_left .dp";
	$hj = QueryList::Query($url,$regs,$rang,'curl','utf-8');
	$tmps_p= $hj->jsonArr;
	$tmps['0']['pinglun']=$tmps_p;
	
	$arrd[]= $tmps;
}
//分页开始
/*
for ($j = 1; $j <= 1; $j++) 
{
	$url = "http://www.izaojiao.com/jigou/guangzhou/all/p".$j;
	$hj = QueryList::Query($url,$reg,$rang,'curl','utf-8');
	$arrs= $hj->jsonArr;
	for ($i = 0;  $i< count($arr); $i++) 
	{
		$url = "http://www.izaojiao.com".$arr[$i]['url'];
		$regs = array(
				"catid"=>array("",""),
				"title"=>array(".tit","html"),
				"thumb"=>array(".g_fc li:eq(0) img","src"),
				"pics"=>array(".tit","html"),
				"diqu"=>array(".tit","html"),
				"ages"=>array(".jie ul li:eq(1)","html"),
				"sbanner"=>array(".g_fc li:eq(0) img","src"),
				"bbanner"=>array(".w_1000","style"),
				"kecheng"=>array(".tit","html"),
				"huodong"=>array(".tit","html"),
				"pinpai"=>array(".tit","html"),
				"youhui"=>array(".tit","html"),
				"wenzhang"=>array(".tit","html"),
				"ditu"=>array(".tit","html"),
				"jianjie"=>array(".tit","html"),
				"links"=>array(".tit","html"),
				"dizhi"=>array(".jie ul li:eq(3) span:eq(1)","html"),
				"zongfen"=>array(".xing .m_b10 span","title"),
				"yjpf"=>array(".xing li:eq(2) span","title"),
				"rjpf"=>array(".xing li:eq(3) span","title"),
				"qfpf"=>array(".xing li:eq(4) span","title"),
				"hdpf"=>array(".xing li:eq(5) span","title"),
				"createtime"=>array(".tit","html"),
				"content"=>array(".jie ul","html")
				);
		$hj = QueryList::Query($url,$regs);
		$arrd[]= $hj->jsonArr;
	}
	
}*/
echo "<pre>";

foreach($arrd as $k=>$v){
	$arrd[$k][0]['catid']='5';
	$arrd[$k][0]['userid']='3';
	$arrd[$k][0]['lang']='1';
	$arrd[$k][0]['createtime']='1425804483';
	$arrd[$k][0]['thumb']='http://www.izaojiao.com'.$v[0]['thumb'];
	$arrd[$k][0]['sbanner']='http://www.izaojiao.com'.$v[0]['sbanner'];
	$arrd[$k][0]['bbanner']=substr($v[0]['bbanner'],strpos($v[0]['bbanner'],"(")+1,strpos($v[0]['bbanner'],")")-strpos($v[0]['bbanner'],"(")-1);
	$arrd[$k][0]['ages']=strip_tags($v[0]['ages']);
	//$arrd[$k][0]['content']=str_replace("\n","<br>",strip_tags($v[0]['content']));
	$arrd[$k][0]['content']=strip_tags($v[0]['content']);
	$arrd[$k][0]['content']=str_replace("\n","",$arrd[$k][0]['content']);
	$arrd[$k][0]['content']=str_replace("    ","<br>",$arrd[$k][0]['content']);
	$arrd[$k][0]['content']=str_replace("   ","<br>",$arrd[$k][0]['content']);
	$arrd[$k][0]['content']=str_replace("	<br>","",$arrd[$k][0]['content']);
	/*$arrd[$k][0]['content']=str_replace("\n","",$arrd[$k][0]['content']);
	*/
}
	$module = M('Product');
	//$module->add($arrd[0][0]);echo "done";exit;
print_r($arrd);

echo "</pre><hr/>";

	}
	
	
	
	
	
	
	
	
	
	//机构1
	public function jigou1(){
set_time_limit(0);
header('Content-type: text/html; charset=utf8');
require_once(dirname(__FILE__).'/QueryList/QueryList.class.php');
//列表 第一页
$url = "http://www.izaojiao.com/jigou/guangzhou/all";
$reg = array("diqu"=>array(".con li:eq(1) a:eq(0)","html"),"url"=>array(".tu a:eq(0)","href"));
$rang = ".sou";
$hj = QueryList::Query($url,$reg,$rang,'curl','utf-8');
$arr = $hj->jsonArr;
//count($arr)
for ($i = 0;  $i< count($arr); $i++) 
{
	//详细页
	$url = "http://www.izaojiao.com".$arr[$i]['url'];
	$regs = array(
		"title"=>array(".tit","html"),
		"thumb"=>array(".g_fc li:eq(0) img","src"),
		"ages"=>array(".jie ul li:eq(1)","html"),
		"sbanner"=>array(".g_fc li:eq(0) img","src"),
		"bbanner"=>array(".w_1000","style"),
		"dizhi"=>array(".jie ul li:eq(3) span:eq(1)","html"),
		"zongfen"=>array(".xing .m_b10 span","title"),
		"yjpf"=>array(".xing li:eq(2) span","title"),
		"rjpf"=>array(".xing li:eq(3) span","title"),
		"qfpf"=>array(".xing li:eq(4) span","title"),
		"hdpf"=>array(".xing li:eq(5) span","title"),
		"content"=>array(".jie ul","html")
		);
	$hj = QueryList::Query($url,$regs);
	$tmps=$hj->jsonArr;
	$tmps['0']['diqu']=$arr[$i]['diqu'];
	$tmps['0']['url']='http://www.izaojiao.com'.$arr[$i]['url'];
	//具体机构简介
	$url = "http://www.izaojiao.com".$arr[$i]['url']."/intro";
	$regs = array(
			"jianjie"=>array(".p_15","html")
			);
	$hj = QueryList::Query($url,$regs);
	$tmps_i= $hj->jsonArr;
	$tmps['0']['jianjie']=$tmps_i['0']['jianjie'];
	//具体机构图片
	$url = "http://www.izaojiao.com".$arr[$i]['url']."/photos";
	$regs = array(
			"pics"=>array("li img","src")
			);
	$rang = ".j_tp ul";
	$hj = QueryList::Query($url,$regs,$rang,'curl','utf-8');
	$tmps_p= $hj->jsonArr;
	foreach($tmps_p as $x=>$y){
		$tmps['0']['pics'] .= $y['pics'].'|:::';
	}
	$arrd[]= $tmps;
}
//分页开始
for ($j = 16; $j <= 33; $j++) 
{
	$url = "http://www.izaojiao.com/jigou/guangzhou/all/p".$j;
	$rang = ".sou";
	$hj = QueryList::Query($url,$reg,$rang,'curl','utf-8');
	$arr = $hj->jsonArr;
	for ($i = 0;  $i< count($arr); $i++) 
	{
		//详细页
		$url = "http://www.izaojiao.com".$arr[$i]['url'];
		$regs = array(
			"title"=>array(".tit","html"),
			"thumb"=>array(".g_fc li:eq(0) img","src"),
			"ages"=>array(".jie ul li:eq(1)","html"),
			"sbanner"=>array(".g_fc li:eq(0) img","src"),
			"bbanner"=>array(".w_1000","style"),
			"dizhi"=>array(".jie ul li:eq(3) span:eq(1)","html"),
			"zongfen"=>array(".xing .m_b10 span","title"),
			"yjpf"=>array(".xing li:eq(2) span","title"),
			"rjpf"=>array(".xing li:eq(3) span","title"),
			"qfpf"=>array(".xing li:eq(4) span","title"),
			"hdpf"=>array(".xing li:eq(5) span","title"),
			"content"=>array(".jie ul","html")
			);
		$hj = QueryList::Query($url,$regs);
		$tmps=$hj->jsonArr;
		$tmps['0']['diqu']=$arr[$i]['diqu'];
		$tmps['0']['url']='http://www.izaojiao.com'.$arr[$i]['url'];
		//具体机构简介
		$url = "http://www.izaojiao.com".$arr[$i]['url']."/intro";
		$regs = array(
				"jianjie"=>array(".p_15","html")
				);
		$hj = QueryList::Query($url,$regs);
		$tmps_i= $hj->jsonArr;
		$tmps['0']['jianjie']=$tmps_i['0']['jianjie'];
		//具体机构图片
		$url = "http://www.izaojiao.com".$arr[$i]['url']."/photos";
		$regs = array(
				"pics"=>array("li img","src")
				);
		$rang = ".j_tp ul";
		$hj = QueryList::Query($url,$regs,$rang,'curl','utf-8');
		$tmps_p= $hj->jsonArr;
		foreach($tmps_p as $x=>$y){
			$tmps['0']['pics'] .= $y['pics'].'|:::';
		}
		$arrd[]= $tmps;
	}
}

error_reporting(E_ALL);
date_default_timezone_set('Asia/Shanghai');
require_once dirname(__FILE__).'/PHPExcel/Classes/PHPExcel.php';

$objPHPExcel=new PHPExcel();
$objPHPExcel->getProperties()->setCreator('http://www.zomsky.com')
        ->setLastModifiedBy('http://www.zomsky.com')
        ->setTitle('Office 2007 XLSX Document')
        ->setSubject('Office 2007 XLSX Document')
        ->setDescription('Document for Office 2007 XLSX, generated using PHP classes.')
        ->setKeywords('office 2007 openxml php')
        ->setCategory('Result file');
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1','标题')
            ->setCellValue('B1','缩略图')
            ->setCellValue('C1','适合年龄')
            ->setCellValue('D1','小banner图')
            ->setCellValue('E1','大banner图')
            ->setCellValue('F1','机构地址')
            ->setCellValue('G1','总分')
            ->setCellValue('H1','硬件评分')
            ->setCellValue('I1','软件评分')
            ->setCellValue('J1','气氛评分')
            ->setCellValue('K1','活动评分')
            ->setCellValue('L1','内容')
            ->setCellValue('M1','图片')
            ->setCellValue('N1','机构简介')
            ->setCellValue('O1','所属地区')
            ->setCellValue('P1','链接地址');
$i=2;
foreach($arrd as $x=>$y){
	foreach($y as $k=>$v){
	$arrd[$x][$k]['thumb']='http://www.izaojiao.com'.$v['thumb'];
	$arrd[$x][$k]['sbanner']='http://www.izaojiao.com'.$v['sbanner'];
	$arrd[$x][$k]['bbanner']=substr($v['bbanner'],strpos($v['bbanner'],"(")+1,strpos($v['bbanner'],")")-strpos($v['bbanner'],"(")-1);
	$v['ages']=strip_tags($v['ages']);
	
	//适合年龄
	$tmpages="21";
	if (stristr($v['ages'],'-1'))
		$tmpages .=',22';
	if (stristr($v['ages'],'-2'))
		$tmpages .=',23';
	if (stristr($v['ages'],'-3'))
		$tmpages .=',24';
	if (stristr($v['ages'],'-4'))
		$tmpages .=',25';
	if (stristr($v['ages'],'-5'))
		$tmpages .=',26';
	if (stristr($v['ages'],'-6'))
		$tmpages .=',27';
	if (stristr($v['ages'],'6以'))
		$tmpages .=',28';
	$arrd[$x][$k]['ages']=$tmpages;
	
	//总分
	if (stristr($v['zongfen'],'一'))
		$tmpzong ='1';
	elseif (stristr($v['zongfen'],'二'))
		$tmpzong ='2';
	elseif (stristr($v['zongfen'],'三'))
		$tmpzong ='3';
	elseif (stristr($v['zongfen'],'四'))
		$tmpzong ='4';
	elseif (stristr($v['zongfen'],'五'))
		$tmpzong ='5';
	else
		$tmpzong ='0';
		
	//yjpf
	if (stristr($v['yjpf'],'一'))
		$tmpyjpf ='1';
	elseif (stristr($v['yjpf'],'二'))
		$tmpyjpf ='2';
	elseif (stristr($v['yjpf'],'三'))
		$tmpyjpf ='3';
	elseif (stristr($v['yjpf'],'四'))
		$tmpyjpf ='4';
	elseif (stristr($v['yjpf'],'五'))
		$tmpyjpf ='5';
	else
		$tmpyjpf ='0';
	//rjpf
	if (stristr($v['rjpf'],'一'))
		$tmprjpf ='1';
	elseif (stristr($v['rjpf'],'二'))
		$tmprjpf ='2';
	elseif (stristr($v['rjpf'],'三'))
		$tmprjpf ='3';
	elseif (stristr($v['rjpf'],'四'))
		$tmprjpf ='4';
	elseif (stristr($v['rjpf'],'五'))
		$tmprjpf ='5';
	else
		$tmprjpf ='0';
	//qfpf
	if (stristr($v['qfpf'],'一'))
		$tmpqfpf ='1';
	elseif (stristr($v['qfpf'],'二'))
		$tmpqfpf ='2';
	elseif (stristr($v['qfpf'],'三'))
		$tmpqfpf ='3';
	elseif (stristr($v['qfpf'],'四'))
		$tmpqfpf ='4';
	elseif (stristr($v['qfpf'],'五'))
		$tmpqfpf ='5';
	else
		$tmpqfpf ='0';
	//hdpf
	if (stristr($v['hdpf'],'一'))
		$tmphdpf ='1';
	elseif (stristr($v['hdpf'],'二'))
		$tmphdpf ='2';
	elseif (stristr($v['hdpf'],'三'))
		$tmphdpf ='3';
	elseif (stristr($v['hdpf'],'四'))
		$tmphdpf ='4';
	elseif (stristr($v['hdpf'],'五'))
		$tmphdpf ='5';
	else
		$tmphdpf ='0';
	//diqu
	if (stristr($v['diqu'],'天河'))
		$tmpdiqu ='9';
	elseif (stristr($v['diqu'],'越秀'))
		$tmpdiqu ='10';
	elseif (stristr($v['diqu'],'荔湾'))
		$tmpdiqu ='11';
	elseif (stristr($v['diqu'],'海珠'))
		$tmpdiqu ='12';
	elseif (stristr($v['diqu'],'白云'))
		$tmpdiqu ='13';
	elseif (stristr($v['diqu'],'黄埔'))
		$tmpdiqu ='14';
	elseif (stristr($v['diqu'],'萝岗'))
		$tmpdiqu ='15';
	elseif (stristr($v['diqu'],'南沙'))
		$tmpdiqu ='16';
	elseif (stristr($v['diqu'],'番禺'))
		$tmpdiqu ='17';
	elseif (stristr($v['diqu'],'从化'))
		$tmpdiqu ='18';
	elseif (stristr($v['diqu'],'花都'))
		$tmpdiqu ='19';
	else
		$tmpdiqu ='20';
	
	
	$arrd[$x][$k]['content']=strip_tags($v['content']);
	$arrd[$x][$k]['content']=str_replace("\n","",$arrd[$x][$k]['content']);
	$arrd[$x][$k]['content']=str_replace("    ","<br>",$arrd[$x][$k]['content']);
	$arrd[$x][$k]['content']=str_replace("   ","<br>",$arrd[$x][$k]['content']);
	$arrd[$x][$k]['content']=str_replace("	<br>","",$arrd[$x][$k]['content']);
 $objPHPExcel->setActiveSheetIndex(0)
	->setCellValue('A'.$i,$arrd[$x][$k]['title'])
	->setCellValue('B'.$i,$arrd[$x][$k]['thumb'])
	->setCellValue('C'.$i,$arrd[$x][$k]['ages'])
	->setCellValue('D'.$i,$arrd[$x][$k]['sbanner'])
	->setCellValue('E'.$i,$arrd[$x][$k]['bbanner'])
	->setCellValue('F'.$i,$arrd[$x][$k]['dizhi'])
	->setCellValue('G'.$i,$tmpzong)
	->setCellValue('H'.$i,$tmpyjpf)
	->setCellValue('I'.$i,$tmprjpf)
	->setCellValue('J'.$i,$tmpqfpf)
	->setCellValue('k'.$i,$tmphdpf)
	->setCellValue('L'.$i,$arrd[$x][$k]['content'])
	->setCellValue('M'.$i,$arrd[$x][$k]['pics'])
	->setCellValue('N'.$i,$arrd[$x][$k]['jianjie'])
	->setCellValue('O'.$i,$tmpdiqu)
	->setCellValue('P'.$i,$arrd[$x][$k]['url']);
 $i++;
	}
}
$objPHPExcel->setActiveSheetIndex(0);
$filename="机构1";

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="'.$filename.'.xls"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
	}
	
	
	
	
	
	//导出机构1最新优惠
	public function daochuz(){
set_time_limit(0);
header('Content-type: text/html; charset=utf8');
require_once(dirname(__FILE__).'/QueryList/QueryList.class.php');
//列表 第一页
$url = "http://www.izaojiao.com/jigou/guangzhou/all";
$reg = array("url"=>array(".tu a:eq(0)","href"));
$rang = ".sou";
$hj = QueryList::Query($url,$reg,$rang,'curl','utf-8');
$arr = $hj->jsonArr;
for ($i = 0;  $i< count($arr); $i++) 
{
	//具体机构最新优惠
	$url = "http://www.izaojiao.com".$arr[$i]['url']."/cuxiao";
	$regs = array(
			"title"=>array("a.f14","html"),
			"url"=>array("a.f14","href")
			);
	$rang = ".main_left .ayh tr:gt(0)";
	$hj = QueryList::Query($url,$regs,$rang,'curl','utf-8');
	$tmps_z= $hj->jsonArr;
	foreach($tmps_z as $x=>$y){
		$url = "http://www.izaojiao.com".$y['url'];
		$regs = array(
				"content"=>array(".main_left .hcon","html")
				);
		$hj = QueryList::Query($url,$regs);
		$tmps_z[$x]['content']=$hj->jsonArr['0']['content'];
		$tmps_z[$x]['furl']='http://www.izaojiao.com'.$arr[$i]['url'];
	}
	$arrd[]= $tmps_z;
	
}
//分页开始
for ($j = 1; $j <= 33; $j++) 
{
	$url = "http://www.izaojiao.com/jigou/guangzhou/all/p".$j;
	$rang = ".sou";
	$hj = QueryList::Query($url,$reg,$rang,'curl','utf-8');
	$arr = $hj->jsonArr;
	for ($i = 0;  $i< count($arr); $i++) 
	{
		//具体机构最新优惠
		$url = "http://www.izaojiao.com".$arr[$i]['url']."/cuxiao";
		$regs = array(
				"title"=>array("a.f14","html"),
				"url"=>array("a.f14","href")
				);
		$rang = ".main_left .ayh tr:gt(0)";
		$hj = QueryList::Query($url,$regs,$rang,'curl','utf-8');
		$tmps_z= $hj->jsonArr;
		foreach($tmps_z as $x=>$y){
			$url = "http://www.izaojiao.com".$y['url'];
			$regs = array(
					"content"=>array(".main_left .hcon","html")
					);
			$hj = QueryList::Query($url,$regs);
			$tmps_z[$x]['content']=$hj->jsonArr['0']['content'];
			$tmps_z[$x]['furl']='http://www.izaojiao.com'.$arr[$i]['url'];
		}
		$arrd[]= $tmps_z;
		
	}
}
error_reporting(E_ALL);
date_default_timezone_set('Asia/Shanghai');
require_once dirname(__FILE__).'/PHPExcel/Classes/PHPExcel.php';

$objPHPExcel=new PHPExcel();
$objPHPExcel->getProperties()->setCreator('http://www.zomsky.com')
        ->setLastModifiedBy('http://www.zomsky.com')
        ->setTitle('Office 2007 XLSX Document')
        ->setSubject('Office 2007 XLSX Document')
        ->setDescription('Document for Office 2007 XLSX, generated using PHP classes.')
        ->setKeywords('office 2007 openxml php')
        ->setCategory('Result file');
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1','标题')
            ->setCellValue('B1','内容')
            ->setCellValue('C1','链接')
            ->setCellValue('D1','机构链接');
$i=2;
foreach($arrd as $x=>$y){
	foreach($y as $k=>$v){		
 $objPHPExcel->setActiveSheetIndex(0)
	->setCellValue('A'.$i,$v['title'])
	->setCellValue('B'.$i,$v['content'])
	->setCellValue('C'.$i,'http://www.izaojiao.com'.$v['url'])
	->setCellValue('D'.$i,$v['furl']);
 $i++;
	}
}
$objPHPExcel->setActiveSheetIndex(0);
$filename="机构1最新优惠";

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="'.$filename.'.xls"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	//导出机构1课程体系
	public function mytest3(){
set_time_limit(0);
header('Content-type: text/html; charset=utf8');
require_once(dirname(__FILE__).'/QueryList/QueryList.class.php');
//列表 第一页
$url = "http://www.izaojiao.com/jigou/guangzhou/all";
$reg = array("url"=>array(".tu a:eq(0)","href"));
$rang = ".sou";/*
$hj = QueryList::Query($url,$reg,$rang,'curl','utf-8');
$arr = $hj->jsonArr;
for ($i = 0;  $i< count($arr); $i++) 
{
	//具体机构体系
	$url = "http://www.izaojiao.com".$arr[$i]['url']."/kecheng";
	$regs = array(
			"title"=>array("img","alt"),
			"thumb"=>array("img","src"),
			"url"=>array("a","href")
			);
	$rang = ".main_left .g_tp";
	$hj = QueryList::Query($url,$regs,$rang,'curl','utf-8');
	$tmps_k= $hj->jsonArr;
	foreach($tmps_k as $x=>$y){
		$url = "http://www.izaojiao.com".$y['url'];
		$regs = array(
				"content"=>array(".main_left .hcon","html")
				);
		$hj = QueryList::Query($url,$regs);
		$tmps_k[$x]['content']=$hj->jsonArr['0']['content'];
		$tmps_k['0']['furl']='http://www.izaojiao.com'.$arr[$i]['url'];
	}
	
	//具体机构中心活动
	$url = "http://www.izaojiao.com".$arr[$i]['url']."/huodong";
	$regs = array(
			"title"=>array(".g_tp img","alt"),
			"thumb"=>array(".g_tp img","src"),
			"times"=>array(".g_tx .green","html"),
			"jianjie"=>array(".g_jj","html"),
			"url"=>array(".g_tp a","href")
			);
	$rang = ".main_left .hcon .clearfix";
	$hj = QueryList::Query($url,$regs,$rang,'curl','utf-8');
	$tmps_h= $hj->jsonArr;
	foreach($tmps_h as $x=>$y){
		$url = "http://www.izaojiao.com".$y['url'];
		$regs = array(
				"content"=>array(".main_left .hcontent:eq(1)","html")
				);
		$hj = QueryList::Query($url,$regs);
		$tmps_h[$x]['content']=$hj->jsonArr['0']['content'];
		$tmps_h['0']['furl']='http://www.izaojiao.com'.$arr[$i]['url'];
	}
	$arrd[]= $tmps_h;
	
	
	//具体机构最新优惠
	$url = "http://www.izaojiao.com".$arr[$i]['url']."/cuxiao";
	$regs = array(
			"title"=>array("a.f14","html"),
			"url"=>array("a.f14","href")
			);
	$rang = ".main_left .ayh tr:gt(0)";
	$hj = QueryList::Query($url,$regs,$rang,'curl','utf-8');
	$tmps_z= $hj->jsonArr;
	foreach($tmps_z as $x=>$y){
		$url = "http://www.izaojiao.com".$y['url'];
		$regs = array(
				"content"=>array("#page-content","html")
				);
		$hj = QueryList::Query($url,$regs);
		$tmps_z[$x]['content']=$hj->jsonArr['0']['content'];
		$tmps_z['0']['furl']='http://www.izaojiao.com'.$arr[$i]['url'];
	}
	$arrd[]= $tmps_z;
	
	
	//具体机构文章
	$url = "http://www.izaojiao.com".$arr[$i]['url'];
	$regs = array(
			"title"=>array("a","html"),
			"url"=>array("a","href")
			);
	$rang = ".main_right .hcon:eq(3) li";
	$hj = QueryList::Query($url,$regs,$rang,'curl','utf-8');
	$tmps_w= $hj->jsonArr;
	foreach($tmps_w as $x=>$y){
		$url = "http://www.izaojiao.com".$y['url'];
		$regs = array(
				"content"=>array(".hcontent div:eq(4)","html")
				);
		$hj = QueryList::Query($url,$regs);
		$tmps_w[$x]['content']=$hj->jsonArr['0']['content'];
		$tmps_w['0']['furl']='http://www.izaojiao.com'.$arr[$i]['url'];
	}
	$arrd[]= $tmps_w;
	
	//具体机构评论
	$url = "http://www.izaojiao.com".$arr[$i]['url']."/reviews";
	$regs = array(
			"touxiang"=>array(".d_yh img","src"),
			"content"=>array(".mid div:eq(1)","html"),
			"zongfen"=>array(".top span:eq(2)","title")
			);
	$rang = ".main_left .dp";
	$hj = QueryList::Query($url,$regs,$rang,'curl','utf-8');
	$tmps_p= $hj->jsonArr;
	foreach($tmps_p as $x=>$y){
		$tmps_p['0']['furl']='http://www.izaojiao.com'.$arr[$i]['url'];
	}
	$arrd[]= $tmps_p;
	
}*/
//分页开始
for ($j = 26; $j <= 33; $j++) 
{
	$url = "http://www.izaojiao.com/jigou/guangzhou/all/p".$j;
	$rang = ".sou";
	$hj = QueryList::Query($url,$reg,$rang,'curl','utf-8');
	$arr = $hj->jsonArr;
	for ($i = 0;  $i< count($arr); $i++) 
	{
		/*//具体机构体系
		$url = "http://www.izaojiao.com".$arr[$i]['url']."/kecheng";
		$regs = array(
				"title"=>array("img","alt"),
				"thumb"=>array("img","src"),
				"url"=>array("a","href")
				);
		$rang = ".main_left .g_tp";
		$hj = QueryList::Query($url,$regs,$rang,'curl','utf-8');
		$tmps_k= $hj->jsonArr;
		foreach($tmps_k as $x=>$y){
			$url = "http://www.izaojiao.com".$y['url'];
			$regs = array(
					"content"=>array(".main_left .hcon","html")
					);
			$hj = QueryList::Query($url,$regs);
			$tmps_k[$x]['content']=$hj->jsonArr['0']['content'];
		    $tmps_k['0']['furl']='http://www.izaojiao.com'.$arr[$i]['url'];
		}
		$arrd[]= $tmps_k;
		
		//具体机构中心活动
		$url = "http://www.izaojiao.com".$arr[$i]['url']."/huodong";
		$regs = array(
				"title"=>array(".g_tp img","alt"),
				"thumb"=>array(".g_tp img","src"),
				"times"=>array(".g_tx .green","html"),
				"jianjie"=>array(".g_jj","html"),
				"url"=>array(".g_tp a","href")
				);
		$rang = ".main_left .hcon .clearfix";
		$hj = QueryList::Query($url,$regs,$rang,'curl','utf-8');
		$tmps_h= $hj->jsonArr;
		foreach($tmps_h as $x=>$y){
			$url = "http://www.izaojiao.com".$y['url'];
			$regs = array(
					"content"=>array(".main_left .hcontent:eq(1)","html")
					);
			$hj = QueryList::Query($url,$regs);
			$tmps_h[$x]['content']=$hj->jsonArr['0']['content'];
			$tmps_h['0']['furl']='http://www.izaojiao.com'.$arr[$i]['url'];
		}
		$arrd[]= $tmps_h;
		
		$url = "http://www.izaojiao.com".$arr[$i]['url']."/cuxiao";
		$regs = array(
				"title"=>array("a.f14","html"),
				"url"=>array("a.f14","href")
				);
		$rang = ".main_left .ayh tr:gt(0)";
		$hj = QueryList::Query($url,$regs,$rang,'curl','utf-8');
		$tmps_z= $hj->jsonArr;
		foreach($tmps_z as $x=>$y){
			$url = "http://www.izaojiao.com".$y['url'];
			$regs = array(
					"content"=>array("#page-content","html")
					);
			$hj = QueryList::Query($url,$regs);
			$tmps_z[$x]['content']=$hj->jsonArr['0']['content'];
			$tmps_z['0']['furl']='http://www.izaojiao.com'.$arr[$i]['url'];
		}
		$arrd[]= $tmps_z;
			
		//具体机构文章
		$url = "http://www.izaojiao.com".$arr[$i]['url'];
		$regs = array(
				"title"=>array("a","html"),
				"url"=>array("a","href")
				);
		$rang = ".main_right .hcon:eq(3) li";
		$hj = QueryList::Query($url,$regs,$rang,'curl','utf-8');
		$tmps_w= $hj->jsonArr;
		foreach($tmps_w as $x=>$y){
			$url = "http://www.izaojiao.com".$y['url'];
			$regs = array(
					"content"=>array(".hcontent div:eq(4)","html")
					);
			$hj = QueryList::Query($url,$regs);
			$tmps_w[$x]['content']=$hj->jsonArr['0']['content'];
			$tmps_w['0']['furl']='http://www.izaojiao.com'.$arr[$i]['url'];
		}
		$arrd[]= $tmps_w;*/
		
		//具体机构评论
		$url = "http://www.izaojiao.com".$arr[$i]['url']."/reviews";
		$regs = array(
				"touxiang"=>array(".d_yh img","src"),
				"content"=>array(".mid div:eq(1)","html"),
				"zongfen"=>array(".top span:eq(2)","title")
				);
		$rang = ".main_left .dp";
		$hj = QueryList::Query($url,$regs,$rang,'curl','utf-8');
		$tmps_p= $hj->jsonArr;
		foreach($tmps_p as $x=>$y){
			$tmps_p['0']['furl']='http://www.izaojiao.com'.$arr[$i]['url'];
		}
		$arrd[]= $tmps_p;
		
	}
}
error_reporting(E_ALL);
date_default_timezone_set('Asia/Shanghai');
require_once dirname(__FILE__).'/PHPExcel/Classes/PHPExcel.php';

$objPHPExcel=new PHPExcel();
$objPHPExcel->getProperties()->setCreator('http://www.zomsky.com')
        ->setLastModifiedBy('http://www.zomsky.com')
        ->setTitle('Office 2007 XLSX Document')
        ->setSubject('Office 2007 XLSX Document')
        ->setDescription('Document for Office 2007 XLSX, generated using PHP classes.')
        ->setKeywords('office 2007 openxml php')
        ->setCategory('Result file');
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1','头像')
            ->setCellValue('B1','内容')
            ->setCellValue('C1','总分')
            ->setCellValue('D1','机构链接');
$i=2;
foreach($arrd as $x=>$y){
	foreach($y as $k=>$v){
		
		
	if ($v['zongfen']=='')
		$v['zongfen'] ='3';
	elseif ($v['zongfen']=='好')
		$v['zongfen'] ='4';
	else
		$v['zongfen'] ='5';
		
 $objPHPExcel->setActiveSheetIndex(0)
	->setCellValue('A'.$i,'http://www.izaojiao.com'.$v['touxiang'])
	->setCellValue('B'.$i,$v['content'])
	->setCellValue('C'.$i,$v['zongfen'])
	->setCellValue('D'.$i,$arrd[$x]['0']['furl']);
 $i++;
	}
}
$objPHPExcel->setActiveSheetIndex(0);
$filename="机构1评论";

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="'.$filename.'.xls"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
	}
	
	
	
//导入机构 课程
	public function mytest4(){
//article表加furl 字段
set_time_limit(0);
header('Content-type: text/html; charset=utf8');

require_once dirname(__FILE__).'/PHPExcel/Classes/PHPExcel.php';
$objPHPExcel = new PHPExcel();
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objPHPExcel = PHPExcel_IOFactory::load('kecheng.xls');
$dates=$objPHPExcel->getActiveSheet()->toArray();
$model = M('Article');
$myurl="523";
for($i=1;$i<=count($dates)-1;$i++)
{
	//91 	      ├─ 课程体系
	$date['catid']='91';
	$date['status']='1';
	$date['createtime']='1411367113';
	$date['lang']='1';
	$date['userid']='3';
	$date['username']='zhibaobaby20130521';
	$date['url']='/index.php?m=Article&a=show&id='.$myurl;
	$date['title']=$dates[$i]['0'];
	$date['thumb']=$dates[$i]['1'];
	$date['content']=$dates[$i]['2'];
	$content = stripslashes($dates[$i]['2']);
	$date['description'] = str_cut(str_replace(array("\r\n","\t",'[page]','[/page]','&ldquo;','&rdquo;','　',' '), '', strip_tags($content)),200);
	$date['description'] = addslashes_array($date['description']);
	$date['furl']=$dates[$i]['4'];
	$myurl=$model->add($date)+1;
}
echo "done";
	}
	
	
//导入机构
	public function mytest5(){
//Product表加furl字段
set_time_limit(0);
header('Content-type: text/html; charset=utf8');

require_once dirname(__FILE__).'/PHPExcel/Classes/PHPExcel.php';
$objPHPExcel = new PHPExcel();
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objPHPExcel = PHPExcel_IOFactory::load('jigou.xls');
$dates=$objPHPExcel->getActiveSheet()->toArray();
$model = M('Product');
$modea = M('Article');

$myurl="322";
for($i=1;$i<=count($dates)-1;$i++)
{
	//5 	      ├─ 早教中心
	
	$date['catid']='5';
	$date['status']='1';
	$date['createtime']='1411367113';
	$date['lang']='1';
	$date['userid']='3';
	$date['username']='zhibaobaby20130521';
	$date['url']='/index.php?m=Product&a=show&id='.$myurl;
	$date['title']=$dates[$i]['0'];
	$date['thumb']=$dates[$i]['1'];
	$date['ages']=$dates[$i]['2'];
	$date['sbanner']=$dates[$i]['3'];
	$date['bbanner']=$dates[$i]['4'];
	$date['dizhi']=$dates[$i]['5'];
	$date['zongfen']=$dates[$i]['6'];
	$date['yjpf']=$dates[$i]['7'];
	$date['rjpf']=$dates[$i]['8'];
	$date['qfpf']=$dates[$i]['9'];
	$date['hdpf']=$dates[$i]['10'];
	$date['content']=$dates[$i]['11'];
	$date['pics']=$dates[$i]['12'];
	$date['jianjie']=$dates[$i]['13'];
	$date['diqu']=$dates[$i]['14'];
	$date['furl']=$dates[$i]['15'];
$art=$modea->where("catid=91 and furl='".$dates[$i][15]."'")->select();
$str="<ul id='plus' class='plus'>";
foreach($art as $v){
	$str.="<li>
		<div class='pix fl'>
			<img src='".$v[thumb]."' /> 
		</div>
		<div class='txtx fl'>
			<h5>
				".$v[title]."
			</h5>
<span>适合年龄：<em>3-4岁4-5岁5-6岁</em></span> 
			<p>".$v['description']."</p>
		</div>
		<div class='bt'>
			<a href='".$v[url]."'><img class='showbm' src='/Public/img/1354.png' /></a> 
		</div>
	</li>";
}
$str.="</ul>";
	$date['kecheng']=$str;
	$myurl=$model->add($date)+1;
}
echo "done";
	}
	
	/////////////////////////////////////////////////////////////////////////////////////////
	
	//机构2
	public function jigou2(){
header('Content-type: text/html; charset=utf8');
set_time_limit(0);
require_once(dirname(__FILE__).'/QueryList/QueryList.class.php');

//分页开始
for ($j = 5; $j <=5; $j++) 
{
	$url = "http://www.yun61.com/c/gz/corporation.php?catid=154&page=".$j;
	$reg = array("url"=>array(".img a","href"),"title"=>array(".tit a","html"));
	$rang = ".liststart .list";
	$hj = QueryList::Query($url,$reg,$rang,'curl','UTF-8');
	$arr = $hj->jsonArr;
	//第5页少4个美国悦宝园早教
	$arr=array(
			array(
			'url'=> 'http://www.yun61.com/school-650/',
			'title'=> '云山诗意社区少年宫'
			),
			array(
			'url'=> 'http://www.yun61.com/school-648/',
			'title'=> '精锐教育'
			),
			array(
			'url'=> 'http://www.yun61.com/school-645/',
			'title'=> '西周少儿研究院'
			),
			array(
			'url'=> 'http://www.yun61.com/school-632/',
			'title'=> '美国悦宝园早教'
			)
        );
	//count($arr)
	for ($i = 0;  $i<count($arr); $i++) 
	{
		//详细页
		$url = $arr[$i]['url'];
		$regs = array(
			"title"=>array(".conTop h1","html"),
			"thumb"=>array(".logo a img","src"),
			//"ages"=>array("",""),
			"sbanner"=>array(".logo a img","src"),
			"bbanner"=>array("body","class"),
			"dizhi"=>array(".conTop ul li:eq(2)","html"),
			"jianjie"=>array(".details","html"),
			"ditu"=>array("#show_bigmap_pic","html"),
			//"zongfen"=>array(".xing .m_b10 span","title"),
			//"yjpf"=>array(".xing li:eq(2) span","title"),
			//"rjpf"=>array(".xing li:eq(3) span","title"),
			//"qfpf"=>array(".xing li:eq(4) span","title"),
			//"hdpf"=>array(".xing li:eq(5) span","title"),
			"content"=>array(".conTop ul","html")
			);
		$hj = QueryList::Query($url,$regs,'','curl','utf-8');
		$tmps=$hj->jsonArr;
		//$tmps['0']['diqu']=$arr[$i]['diqu'];
		$tmps['0']['url']=$arr[$i]['url'];
		
		//具体机构图片
		$regs = array(
				"pics"=>array("a","href")
				);
		$rang = ".album li";
		$hj = QueryList::Query($url,$regs,$rang,'curl','utf-8');
		$tmps_p= $hj->jsonArr;
	 	if($tmps_p[0]['pics']){
			foreach($tmps_p as $x=>$y){
				$tmps['0']['pics'] .= "http://www.yun61.com".$y['pics'].'|:::';
			}
		}
		$arrd[]= $tmps;
	}
}

error_reporting(E_ALL);
date_default_timezone_set('Asia/Shanghai');
require_once dirname(__FILE__).'/PHPExcel/Classes/PHPExcel.php';

$objPHPExcel=new PHPExcel();
$objPHPExcel->getProperties()->setCreator('http://www.zomsky.com')
        ->setLastModifiedBy('http://www.zomsky.com')
        ->setTitle('Office 2007 XLSX Document')
        ->setSubject('Office 2007 XLSX Document')
        ->setDescription('Document for Office 2007 XLSX, generated using PHP classes.')
        ->setKeywords('office 2007 openxml php')
        ->setCategory('Result file');
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1','标题')
            ->setCellValue('B1','缩略图')
            ->setCellValue('C1','地图图片')
            ->setCellValue('D1','小banner图')
            ->setCellValue('E1','大banner图')
            ->setCellValue('F1','机构地址')
            ->setCellValue('G1','总分')
            ->setCellValue('H1','硬件评分')
            ->setCellValue('I1','软件评分')
            ->setCellValue('J1','气氛评分')
            ->setCellValue('K1','活动评分')
            ->setCellValue('L1','内容')
            ->setCellValue('M1','图片')
            ->setCellValue('N1','机构简介')
            ->setCellValue('O1','所属地区')
            ->setCellValue('P1','链接地址');
$i=2;
foreach($arrd as $x=>$y){
	foreach($y as $k=>$v){
	$v['bbanner']='http://www.yun61.com/template/spaces/school/images/'.$v['bbanner'].'_banner.jpg';
	$v['dizhi']=str_replace("联系地址：", "", $v['dizhi']);
	
	//diqu
	if (stristr($v['dizhi'],'天河'))
		$tmpdiqu ='9';
	elseif (stristr($v['dizhi'],'越秀'))
		$tmpdiqu ='10';
	elseif (stristr($v['dizhi'],'荔湾'))
		$tmpdiqu ='11';
	elseif (stristr($v['dizhi'],'海珠'))
		$tmpdiqu ='12';
	elseif (stristr($v['dizhi'],'白云'))
		$tmpdiqu ='13';
	elseif (stristr($v['dizhi'],'黄埔'))
		$tmpdiqu ='14';
	elseif (stristr($v['dizhi'],'萝岗'))
		$tmpdiqu ='15';
	elseif (stristr($v['dizhi'],'南沙'))
		$tmpdiqu ='16';
	elseif (stristr($v['dizhi'],'番禺'))
		$tmpdiqu ='17';
	elseif (stristr($v['dizhi'],'从化'))
		$tmpdiqu ='18';
	elseif (stristr($v['dizhi'],'花都'))
		$tmpdiqu ='19';
	else
		$tmpdiqu ='20';
	$v['title']=strip_tags($v['title']);
	/*
	$arrd[$x][$k]['content']=strip_tags($v['content']);
	$arrd[$x][$k]['content']=str_replace("\n","",$arrd[$x][$k]['content']);
	$arrd[$x][$k]['content']=str_replace("    ","<br>",$arrd[$x][$k]['content']);
	$arrd[$x][$k]['content']=str_replace("   ","<br>",$arrd[$x][$k]['content']);
	$arrd[$x][$k]['content']=str_replace("	<br>","",$arrd[$x][$k]['content']);*/
 $objPHPExcel->setActiveSheetIndex(0)
	->setCellValue('A'.$i,$v['title'])
	->setCellValue('B'.$i,$v['thumb'])
	->setCellValue('C'.$i,$v['ditu'])
	->setCellValue('D'.$i,$v['sbanner'])
	->setCellValue('E'.$i,$v['bbanner'])
	->setCellValue('F'.$i,$v['dizhi'])
	->setCellValue('G'.$i,3)
	->setCellValue('H'.$i,3)
	->setCellValue('I'.$i,3)
	->setCellValue('J'.$i,3)
	->setCellValue('k'.$i,3)
	->setCellValue('L'.$i,$v['content'])
	->setCellValue('M'.$i,$v['pics'])
	->setCellValue('N'.$i,$v['jianjie'])
	->setCellValue('O'.$i,$tmpdiqu)
	->setCellValue('P'.$i,$v['url']);
 $i++;
	}
}
$objPHPExcel->setActiveSheetIndex(0);
$filename="机构2";

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="'.$filename.'.xls"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
	}
	////////////////////////////////////////////////////////////////////////////////////
	//机构2 课程
	public function kecheng2(){
header('Content-type: text/html; charset=utf8');
set_time_limit(0);
require_once(dirname(__FILE__).'/QueryList/QueryList.class.php');

//分页开始
for ($j = 1; $j <=7; $j++) 
{
	$url = "http://www.yun61.com/c/gz/corporation.php?catid=154&page=".$j;
	$reg = array("url"=>array(".img a","href"));
	$rang = ".liststart .list";
	$hj = QueryList::Query($url,$reg,$rang,'curl','UTF-8');
	$arr = $hj->jsonArr;
	/*//第5页少4个美国悦宝园早教
	$arr=array(
			array(
			'url'=> 'http://www.yun61.com/school-650/'
			),
			array(
			'url'=> 'http://www.yun61.com/school-648/'
			),
			array(
			'url'=> 'http://www.yun61.com/school-645/'
			),
			array(
			'url'=> 'http://www.yun61.com/school-632/'
			)
        );*/
	//count($arr)
	for ($i = 0;  $i<count($arr); $i++) 
	{
		//详细页
		$url = $arr[$i]['url'].'course.html';
		$regs = array(
			"title"=>array("h3 a","html"),
			"thumb"=>array("a.thumb img","src"),
			"url"=>array("a.thumb","href")
			);
		$rang = ".items ul li";
		$hj = QueryList::Query($url,$regs,$rang,'curl','UTF-8');
		$tmps_p= $hj->jsonArr;
		if ($tmps_p[0][title]){
			foreach($tmps_p as $x=>$y){
				$url = $y['url'];
				$regs = array(
						"content"=>array(".intro","html")
						);
				$hj = QueryList::Query($url,$regs,'','curl','UTF-8');
				$tmps_p[$x]['content']=$hj->jsonArr['0']['content'];
				$tmps_p[$x]['furl']=$arr[$i]['url'];
			}
			$arrd[]= $tmps_p;
		}
	}
}
error_reporting(E_ALL);
date_default_timezone_set('Asia/Shanghai');
require_once dirname(__FILE__).'/PHPExcel/Classes/PHPExcel.php';

$objPHPExcel=new PHPExcel();
$objPHPExcel->getProperties()->setCreator('http://www.zomsky.com')
        ->setLastModifiedBy('http://www.zomsky.com')
        ->setTitle('Office 2007 XLSX Document')
        ->setSubject('Office 2007 XLSX Document')
        ->setDescription('Document for Office 2007 XLSX, generated using PHP classes.')
        ->setKeywords('office 2007 openxml php')
        ->setCategory('Result file');
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1','标题')
            ->setCellValue('B1','缩略图')
            ->setCellValue('C1','内容')
            ->setCellValue('D1','链接')
            ->setCellValue('E1','机构链接');
$i=2;
foreach($arrd as $x=>$y){
	foreach($y as $k=>$v){
 $objPHPExcel->setActiveSheetIndex(0)
	->setCellValue('A'.$i,$v['title'])
	->setCellValue('B'.$i,'http://www.yun61.com'.$v['thumb'])
	->setCellValue('C'.$i,$v['content'])
	->setCellValue('D'.$i,$v['url'])
	->setCellValue('E'.$i,$v['furl']);
 $i++;
	}
}
$objPHPExcel->setActiveSheetIndex(0);
$filename="机构2课程";

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="'.$filename.'.xls"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
	}
	
	//机构2 文章
	public function wenzhang2(){
header('Content-type: text/html; charset=utf8');
set_time_limit(0);
require_once(dirname(__FILE__).'/QueryList/QueryList.class.php');

//分页开始
for ($j = 1; $j <=7; $j++) 
{
	$url = "http://www.yun61.com/c/gz/corporation.php?catid=154&page=".$j;
	$reg = array("url"=>array(".img a","href"));
	$rang = ".liststart .list";
	$hj = QueryList::Query($url,$reg,$rang,'curl','UTF-8');
	$arr = $hj->jsonArr;
	/*//第5页少4个美国悦宝园早教
	$arr=array(
			array(
			'url'=> 'http://www.yun61.com/school-650/'
			),
			array(
			'url'=> 'http://www.yun61.com/school-648/'
			),
			array(
			'url'=> 'http://www.yun61.com/school-645/'
			),
			array(
			'url'=> 'http://www.yun61.com/school-632/'
			)
        );*/
	//count($arr)
	for ($i = 0;  $i<count($arr); $i++) 
	{
		//列表
		$url = $arr[$i]['url'].'document-typeid-6.html';
		$regs = array(
			"title"=>array("a","html"),
			"url"=>array("a","href")
			);
		$rang = ".lists ul li";
		$hj = QueryList::Query($url,$regs,$rang,'curl','UTF-8');
		$tmps_p= $hj->jsonArr;
		if ($tmps_p[0][title]){
			foreach($tmps_p as $x=>$y){
				$url = $y['url'];
				$regs = array(
						"content"=>array(".newsCont","html")
						);
				$hj = QueryList::Query($url,$regs,'','curl','UTF-8');
				$tmps_p[$x]['content']=$hj->jsonArr['0']['content'];
				$tmps_p[$x]['furl']=$arr[$i]['url'];
			}
			$arrd[]= $tmps_p;
		}
	}
}
error_reporting(E_ALL);
date_default_timezone_set('Asia/Shanghai');
require_once dirname(__FILE__).'/PHPExcel/Classes/PHPExcel.php';

$objPHPExcel=new PHPExcel();
$objPHPExcel->getProperties()->setCreator('http://www.zomsky.com')
        ->setLastModifiedBy('http://www.zomsky.com')
        ->setTitle('Office 2007 XLSX Document')
        ->setSubject('Office 2007 XLSX Document')
        ->setDescription('Document for Office 2007 XLSX, generated using PHP classes.')
        ->setKeywords('office 2007 openxml php')
        ->setCategory('Result file');
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1','标题')
            ->setCellValue('B1','内容')
            ->setCellValue('C1','链接')
            ->setCellValue('D1','机构链接');
$i=2;
foreach($arrd as $x=>$y){
	foreach($y as $k=>$v){
 $objPHPExcel->setActiveSheetIndex(0)
	->setCellValue('A'.$i,$v['title'])
	->setCellValue('B'.$i,$v['content'])
	->setCellValue('C'.$i,$v['url'])
	->setCellValue('D'.$i,$v['furl']);
 $i++;
	}
}
$objPHPExcel->setActiveSheetIndex(0);
$filename="机构2中心活动";

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="'.$filename.'.xls"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
	}
	//机构2评论
	public function pinglun2(){
header('Content-type: text/html; charset=utf8');
set_time_limit(0);
require_once(dirname(__FILE__).'/QueryList/QueryList.class.php');

//分页开始
for ($j = 1; $j <=7; $j++) 
{
	$url = "http://www.yun61.com/c/gz/corporation.php?catid=154&page=".$j;
	$reg = array("url"=>array(".img a","href"));
	$rang = ".liststart .list";
	$hj = QueryList::Query($url,$reg,$rang,'curl','UTF-8');
	$arr = $hj->jsonArr;
	/*//第5页少4个美国悦宝园早教
	$arr=array(
			array(
			'url'=> 'http://www.yun61.com/school-650/'
			),
			array(
			'url'=> 'http://www.yun61.com/school-648/'
			),
			array(
			'url'=> 'http://www.yun61.com/school-645/'
			),
			array(
			'url'=> 'http://www.yun61.com/school-632/'
			)
        );*/
	//count($arr)
	for ($i = 0;  $i<count($arr); $i++) 
	{
		//列表
		$url = $arr[$i]['url'].'comment.html';
		$regs = array(
			"touxiang"=>array(".pic img","src"),
			"content"=>array(".ut","html"),
			"zongfen"=>array(".starB li:eq(0) span:eq(1)","class")
			);
		$rang = ".commentpage .comment";
		$hj = QueryList::Query($url,$regs,$rang,'curl','UTF-8');
		$tmps_p= $hj->jsonArr;
		if ($tmps_p[0][content]){
			foreach($tmps_p as $x=>$y){
				$tmps_p[$x]['furl']=$arr[$i]['url'];
			}
			$arrd[]= $tmps_p;
		}
	}
}
error_reporting(E_ALL);
date_default_timezone_set('Asia/Shanghai');
require_once dirname(__FILE__).'/PHPExcel/Classes/PHPExcel.php';

$objPHPExcel=new PHPExcel();
$objPHPExcel->getProperties()->setCreator('http://www.zomsky.com')
        ->setLastModifiedBy('http://www.zomsky.com')
        ->setTitle('Office 2007 XLSX Document')
        ->setSubject('Office 2007 XLSX Document')
        ->setDescription('Document for Office 2007 XLSX, generated using PHP classes.')
        ->setKeywords('office 2007 openxml php')
        ->setCategory('Result file');
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1','头像')
            ->setCellValue('B1','内容')
            ->setCellValue('C1','总分')
            ->setCellValue('D1','机构链接');
$i=2;
foreach($arrd as $x=>$y){
	foreach($y as $k=>$v){
		
	if (stristr($v['zongfen'],'5'))
		$tmpdiqu ='5';
	elseif (stristr($v['diqu'],'4'))
		$tmpdiqu ='4';
	elseif (stristr($v['diqu'],'3'))
		$tmpdiqu ='3';
	elseif (stristr($v['diqu'],'2'))
		$tmpdiqu ='2';
	elseif (stristr($v['diqu'],'1'))
		$tmpdiqu ='1';
	else
		$tmpdiqu ='0';
	
 $objPHPExcel->setActiveSheetIndex(0)
	->setCellValue('A'.$i,$v['touxiang'])
	->setCellValue('B'.$i,$v['content'])
	->setCellValue('C'.$i,$tmpdiqu)
	->setCellValue('D'.$i,$v['furl']);
 $i++;
	}
}
$objPHPExcel->setActiveSheetIndex(0);
$filename="机构2评论";

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="'.$filename.'.xls"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
	}
	
	/////////////////////////////////////////////////////////////////////////////////////
	//机构3
	public function jigou3(){
	header('Content-type: text/html; charset=utf8');
	set_time_limit(0);
	require_once(dirname(__FILE__).'/QueryList/QueryList.class.php');
	
//分页开始
for ($j = 1; $j <=1; $j++) 
{
	$url = "http://www.dianping.com/search/category/4/70/g189p".$j;
	$reg = array("url"=>array("a:eq(0)","href"),"title"=>array(".title a:eq(0)","html"),"thumb"=>array(".pic img","src"),"ibook"=>array(".ibook","rel"));
	$rang = ".shop-list li";
	$hj = QueryList::Query($url,$reg,$rang,'curl','UTF-8');
	$arr = $hj->jsonArr;
	//count($arr)
	for ($i = 0;  $i<1; $i++) 
	{
		//详细页
		$url = 'http://www.dianping.com'.$arr[$i]['url'];
		//订 版面
		if ($arr[$i]['ibook'])
			$regs = array(
				//"ages"=>array("",""),
				"bbanner"=>array(".img:eq(0) a img","src"),
				"jianjie"=>array(".J_showWarp","html"),
				//"ditu"=>array("#show_bigmap_pic","html"),
				"diqu"=>array(".shop-addr .region","html"),
				"dizhi"=>array(".shop-addr span:eq(0)","title"),
				"zongfen"=>array(".comment-rst span:eq(0)","title"),
				//"yjpf"=>array(".xing li:eq(2) span","title"),
				//"rjpf"=>array(".xing li:eq(3) span","title"),
				//"qfpf"=>array(".xing li:eq(4) span","title"),
				//"hdpf"=>array(".xing li:eq(5) span","title"),
				"content"=>array(".J_showWarp","html")
				);
		else
			$regs = array(
				//"ages"=>array("",""),
				//"bbanner"=>array(".img a img","src"),
				"jianjie"=>array(".desc-list:eq(0)","html"),
				//"ditu"=>array(".link-dk .region","html"),
				"diqu"=>array(".link-dk .region","html"),
				"dizhi"=>array(".desc-list .shopDeal-Info-address .shop-info-content span:eq(1)","html"),
				"zongfen"=>array(".comment-rst span:eq(0)","title"),
				//"yjpf"=>array(".xing li:eq(2) span","title"),
				//"rjpf"=>array(".xing li:eq(3) span","title"),
				//"qfpf"=>array(".xing li:eq(4) span","title"),
				//"hdpf"=>array(".xing li:eq(5) span","title"),
				"content"=>array(".desc-list:eq(1)","html")
				);
		$hj = QueryList::Query($url,$regs);
		$tmps=$hj->jsonArr;
		print_r($hj);
		exit;
		$tmps[0]['title']=$arr[$i]['title'];
		$tmps[0]['url']=$arr[$i]['url'];
		$tmps[0]['thumb']=$arr[$i]['thumb'];
		
		//具体机构图片
		$regs = array("pics"=>array(".p-img img","src"));
		$hj = QueryList::Query($url.'/photos',$regs);
		$tmps_p= $hj->jsonArr;
	 	if($tmps_p[0]['pics']){
			foreach($tmps_p as $x=>$y){
				$tmps[0]['pics'] .= str_replace('220x1024','700x700',$y['pics']).'|:::';
			}
		}
		$arrd[]= $tmps;
	}
}
error_reporting(E_ALL);
date_default_timezone_set('Asia/Shanghai');
require_once dirname(__FILE__).'/PHPExcel/Classes/PHPExcel.php';

$objPHPExcel=new PHPExcel();
$objPHPExcel->getProperties()->setCreator('http://www.zomsky.com')
        ->setLastModifiedBy('http://www.zomsky.com')
        ->setTitle('Office 2007 XLSX Document')
        ->setSubject('Office 2007 XLSX Document')
        ->setDescription('Document for Office 2007 XLSX, generated using PHP classes.')
        ->setKeywords('office 2007 openxml php')
        ->setCategory('Result file');
$objPHPExcel->setActiveSheetIndex(0)
		->setCellValue('A1','标题')
		->setCellValue('B1','缩略图')
		->setCellValue('C1','链接地址')
		->setCellValue('D1','小banner图')
		->setCellValue('E1','大banner图')
		->setCellValue('F1','机构地址')
		->setCellValue('G1','总分')
		->setCellValue('H1','硬件评分')
		->setCellValue('I1','软件评分')
		->setCellValue('J1','气氛评分')
		->setCellValue('K1','活动评分')
		->setCellValue('L1','内容')
		->setCellValue('M1','图片')
		->setCellValue('N1','机构简介')
		->setCellValue('O1','所属地区');
$i=2;
foreach($arrd as $x=>$y){
	foreach($y as $k=>$v){
	//diqu
	if (stristr($v['diqu'],'天河'))
		$tmpdiqu ='9';
	elseif (stristr($v['diqu'],'越秀'))
		$tmpdiqu ='10';
	elseif (stristr($v['diqu'],'荔湾'))
		$tmpdiqu ='11';
	elseif (stristr($v['diqu'],'海珠'))
		$tmpdiqu ='12';
	elseif (stristr($v['diqu'],'白云'))
		$tmpdiqu ='13';
	elseif (stristr($v['diqu'],'黄埔'))
		$tmpdiqu ='14';
	elseif (stristr($v['diqu'],'萝岗'))
		$tmpdiqu ='15';
	elseif (stristr($v['diqu'],'南沙'))
		$tmpdiqu ='16';
	elseif (stristr($v['diqu'],'番禺'))
		$tmpdiqu ='17';
	elseif (stristr($v['diqu'],'从化'))
		$tmpdiqu ='18';
	elseif (stristr($v['diqu'],'花都'))
		$tmpdiqu ='19';
	else
		$tmpdiqu ='20';
		
	//总分
	if (stristr($v['zongfen'],'一'))
		$tmpzong ='1';
	elseif (stristr($v['zongfen'],'二'))
		$tmpzong ='2';
	elseif (stristr($v['zongfen'],'三'))
		$tmpzong ='3';
	elseif (stristr($v['zongfen'],'四'))
		$tmpzong ='4';
	elseif (stristr($v['zongfen'],'五'))
		$tmpzong ='5';
	else
		$tmpzong ='0';
		
	$v['content']=strip_tags($v['content']);
	/*
	$arrd[$x][$k]['content']=strip_tags($v['content']);
	$arrd[$x][$k]['content']=str_replace("\n","",$arrd[$x][$k]['content']);
	$arrd[$x][$k]['content']=str_replace("    ","<br>",$arrd[$x][$k]['content']);
	$arrd[$x][$k]['content']=str_replace("   ","<br>",$arrd[$x][$k]['content']);
	$arrd[$x][$k]['content']=str_replace("	<br>","",$arrd[$x][$k]['content']);*/
 $objPHPExcel->setActiveSheetIndex(0)
	->setCellValue('A'.$i,$v['title'])
	->setCellValue('B'.$i,$v['thumb'])
	->setCellValue('C'.$i,'http://www.dianping.com'.$v['url'])
	->setCellValue('D'.$i,$v['thumb'])
	->setCellValue('E'.$i,$v['bbanner'])
	->setCellValue('F'.$i,$v['dizhi'])
	->setCellValue('G'.$i,$tmpzong)
	->setCellValue('H'.$i,3)
	->setCellValue('I'.$i,3)
	->setCellValue('J'.$i,3)
	->setCellValue('k'.$i,3)
	->setCellValue('L'.$i,$v['content'])
	->setCellValue('M'.$i,$v['pics'])
	->setCellValue('N'.$i,$v['jianjie'])
	->setCellValue('O'.$i,$tmpdiqu);
 $i++;
	}
}
$objPHPExcel->setActiveSheetIndex(0);
$filename="机构3幼儿园";

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="'.$filename.'.xls"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
	}
	
	//机构3评论
	public function pinglun3(){
header('Content-type: text/html; charset=utf8');
set_time_limit(0);
require_once(dirname(__FILE__).'/QueryList/QueryList.class.php');

//分页开始
for ($j = 41; $j <=50; $j++) 
{
	$url = "http://www.dianping.com/search/category/4/70/g189p".$j;
	$reg = array("url"=>array("a:eq(0)","href"));
	$rang = ".shop-list li";
	$hj = QueryList::Query($url,$reg,$rang,'curl','UTF-8');
	$arr = $hj->jsonArr;
	//count($arr)
	for ($i = 0;  $i<count($arr); $i++) 
	{
		//列表
		$url = 'http://www.dianping.com'.$arr[$i]['url'].'/review_more';
		$regs = array(
			"touxiang"=>array(".avatar img","src"),
			"content"=>array(".comment-entry div:eq(1)","html"),
			"content2"=>array(".comment-entry div:eq(0)","html"),
			"zongfen"=>array(".comment-rst span:eq(0)","class")
			);
		$rang = ".comment-list-b li.comment-list-item";
		$hj = QueryList::Query($url,$regs,$rang,'curl','UTF-8');
		$tmps_p= $hj->jsonArr;
		foreach($tmps_p as $x=>$y){
			$tmps_p[$x]['furl']=$arr[$i]['url'];
		}
		$arrd[]= $tmps_p;
	}
}
error_reporting(E_ALL);
date_default_timezone_set('Asia/Shanghai');
require_once dirname(__FILE__).'/PHPExcel/Classes/PHPExcel.php';

$objPHPExcel=new PHPExcel();
$objPHPExcel->getProperties()->setCreator('http://www.zomsky.com')
        ->setLastModifiedBy('http://www.zomsky.com')
        ->setTitle('Office 2007 XLSX Document')
        ->setSubject('Office 2007 XLSX Document')
        ->setDescription('Document for Office 2007 XLSX, generated using PHP classes.')
        ->setKeywords('office 2007 openxml php')
        ->setCategory('Result file');
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1','头像')
            ->setCellValue('B1','内容')
            ->setCellValue('C1','总分')
            ->setCellValue('D1','机构链接');
$i=2;
foreach($arrd as $x=>$y){
	foreach($y as $k=>$v){
		
	if (stristr($v['zongfen'],'5'))
		$tmpdiqu ='5';
	elseif (stristr($v['zongfen'],'4'))
		$tmpdiqu ='4';
	elseif (stristr($v['zongfen'],'3'))
		$tmpdiqu ='3';
	elseif (stristr($v['zongfen'],'2'))
		$tmpdiqu ='2';
	elseif (stristr($v['zongfen'],'1'))
		$tmpdiqu ='1';
	else
		$tmpdiqu ='0';
	$v['content']?'':$v['content']=$v['content2'];
	
 $objPHPExcel->setActiveSheetIndex(0)
	->setCellValue('A'.$i,$v['touxiang'])
	->setCellValue('B'.$i,$v['content'])
	->setCellValue('C'.$i,$tmpdiqu)
	->setCellValue('D'.$i,'http://www.dianping.com'.$v['furl']);
 $i++;
	}
}
$objPHPExcel->setActiveSheetIndex(0);
$filename="机构3幼儿园评论";

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="'.$filename.'.xls"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
	}
	
///***********************************************************************************************************************/	
	
	
//导入机构 课程
	public function daoruk(){
//article表加furl 字段
set_time_limit(0);
header('Content-type: text/html; charset=utf8');

require_once dirname(__FILE__).'/PHPExcel/Classes/PHPExcel.php';
$objPHPExcel = new PHPExcel();
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objPHPExcel = PHPExcel_IOFactory::load('kecheng2.xls');
$dates=$objPHPExcel->getActiveSheet()->toArray();
$model = M('Article');
$myurl="2004";//493,2004
for($i=1;$i<=count($dates)-1;$i++)
{
	//91 	      ├─ 课程体系
	$date['catid']='91';
	$date['status']='1';
	$date['createtime']='1411367113';
	$date['lang']='1';
	$date['userid']='3';
	$date['username']='zhibaobaby20130521';
	$date['url']='/index.php?m=Article&a=show&id='.$myurl;
	$date['title']=$dates[$i]['0'];
	$date['thumb']=$dates[$i]['1'];
	$date['content']=$dates[$i]['2'];
	$content = stripslashes($dates[$i]['2']);
	$date['description'] = str_cut(str_replace(array("\r\n","\t",'[page]','[/page]','&ldquo;','&rdquo;','　',' '), '', strip_tags($content)),200);
	$date['description'] = addslashes_array($date['description']);
	$date['furl']=$dates[$i]['4'];
	$myurl=$model->add($date)+1;
}
echo "done";
	}
	public function daoruw(){
//article表加furl 字段
set_time_limit(0);
header('Content-type: text/html; charset=utf8');

require_once dirname(__FILE__).'/PHPExcel/Classes/PHPExcel.php';
$objPHPExcel = new PHPExcel();
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objPHPExcel = PHPExcel_IOFactory::load('wenzhang2.xls');
$dates=$objPHPExcel->getActiveSheet()->toArray();
$model = M('Article');
$myurl="2152";//1250,2152
for($i=1;$i<=count($dates)-1;$i++)
{
	//89 	      ├─ 文章
	$date['catid']='89';
	$date['status']='1';
	$date['createtime']='1411367113';
	$date['lang']='1';
	$date['userid']='3';
	$date['username']='zhibaobaby20130521';
	$date['url']='/index.php?m=Article&a=show&id='.$myurl;
	$date['title']=$dates[$i]['0'];
	//$date['thumb']=$dates[$i]['1'];
	$date['content']=$dates[$i]['1'];
	$content = stripslashes($dates[$i]['1']);
	$date['description'] = str_cut(str_replace(array("\r\n","\t",'[page]','[/page]','&ldquo;','&rdquo;','　',' '), '', strip_tags($content)),200);
	$date['description'] = addslashes_array($date['description']);
	$date['furl']=$dates[$i]['3'];
	$myurl=$model->add($date)+1;
}
echo "done";
	}
	public function daoruz(){
//article表加furl 字段
set_time_limit(0);
header('Content-type: text/html; charset=utf8');

require_once dirname(__FILE__).'/PHPExcel/Classes/PHPExcel.php';
$objPHPExcel = new PHPExcel();
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objPHPExcel = PHPExcel_IOFactory::load('zuixin.xls');
$dates=$objPHPExcel->getActiveSheet()->toArray();
$model = M('Article');
$myurl="1418";
for($i=1;$i<=count($dates)-1;$i++)
{
	//93 	      ├─ 最新优惠
	$date['catid']='93';
	$date['status']='1';
	$date['createtime']='1411367113';
	$date['lang']='1';
	$date['userid']='3';
	$date['username']='zhibaobaby20130521';
	$date['url']='/index.php?m=Article&a=show&id='.$myurl;
	$date['title']=$dates[$i]['0'];
	//$date['thumb']=$dates[$i]['1'];
	$date['content']=$dates[$i]['1'];
	$content = stripslashes($dates[$i]['1']);
	$date['description'] = str_cut(str_replace(array("\r\n","\t",'[page]','[/page]','&ldquo;','&rdquo;','　',' '), '', strip_tags($content)),200);
	$date['description'] = addslashes_array($date['description']);
	$date['furl']=$dates[$i]['3'];
	$myurl=$model->add($date)+1;
}
echo "done";
	}
	public function daoruh(){
//article表加furl 字段
set_time_limit(0);
header('Content-type: text/html; charset=utf8');

require_once dirname(__FILE__).'/PHPExcel/Classes/PHPExcel.php';
$objPHPExcel = new PHPExcel();
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objPHPExcel = PHPExcel_IOFactory::load('zhongxin2.xls');
$dates=$objPHPExcel->getActiveSheet()->toArray();
$model = M('Article');
$myurl="2297";//1484,2297
for($i=1;$i<=count($dates)-1;$i++)
{
	//92 	      ├─ 中心活动
	$date['catid']='92';
	$date['status']='1';
	$date['createtime']='1411367113';
	$date['lang']='1';
	$date['userid']='3';
	$date['username']='zhibaobaby20130521';
	$date['url']='/index.php?m=Article&a=show&id='.$myurl;
	$date['title']=$dates[$i]['0'];
	$date['thumb']=$dates[$i]['1'];
	$date['content']=$dates[$i]['2'];
	$content = stripslashes($dates[$i]['2']);
	$date['description'] = str_cut(str_replace(array("\r\n","\t",'[page]','[/page]','&ldquo;','&rdquo;','　',' '), '', strip_tags($content)),200);
	$date['description'] = addslashes_array($date['description']);
	$date['furl']=$dates[$i]['4'];
	$myurl=$model->add($date)+1;
}
echo "done";
	}
	
//导入机构
	public function daorujigou(){
//Product表加furl字段
set_time_limit(0);
header('Content-type: text/html; charset=utf8');

require_once dirname(__FILE__).'/PHPExcel/Classes/PHPExcel.php';
$objPHPExcel = new PHPExcel();
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objPHPExcel = PHPExcel_IOFactory::load('jigou.xls');
$dates=$objPHPExcel->getActiveSheet()->toArray();
$model = M('Product');
$modea = M('Article');

$myurl="311";
for($i=1;$i<=count($dates)-1;$i++)
{
	//5 7	      ├─ 早教中心
	if(!$dates[$i]['1'])
	{
		$date['catid']=$dates[$i]['0']=='1'?'5':'7';
		$date['status']='1';
		$date['createtime']='1411367113';
		$date['lang']='1';
		$date['userid']='3';
		$date['username']='zhibaobaby20130521';
		$date['url']='/index.php?m=Product&a=show&id='.$myurl;
		$date['title']=$dates[$i]['2'];
		$date['thumb']=$dates[$i]['3'];
		$date['ages']=$dates[$i]['4'];
		$date['sbanner']=$dates[$i]['5'];
		$date['bbanner']=$dates[$i]['6'];
		$date['dizhi']=$dates[$i]['7'];
		$date['zongfen']=$dates[$i]['8'];
		$date['yjpf']=$dates[$i]['9'];
		$date['rjpf']=$dates[$i]['10'];
		$date['qfpf']=$dates[$i]['11'];
		$date['hdpf']=$dates[$i]['12'];
		$date['content']=$dates[$i]['13'];
		$date['pics']=$dates[$i]['14'];
		$date['jianjie']=$dates[$i]['15'];
		$date['diqu']=$dates[$i]['16'];
		$date['furl']=$dates[$i]['17'];
		//关联课程91、92中心活动、89文章、93最新优惠
	$art=$modea->where("catid=91 and furl='".$dates[$i][17]."'")->select();
	$str="<ul id='plus' class='plus'>";
	foreach($art as $v){
		$str.="<li>
			<div class='pix fl'>
				<img src='".$v[thumb]."' /> 
			</div>
			<div class='txtx fl'>
				<h5>
					".$v[title]."
				</h5>
	<span>适合年龄：<em>3-4岁4-5岁5-6岁</em></span> 
				<p>".$v['description']."</p>
			</div>
			<div class='bt'>
				<a href='".$v[url]."'><img class='showbm' src='/Public/img/1354.png' /></a> 
			</div>
		</li>";
	}
	$str.="</ul>";
		$date['kecheng']=$str;
	$art=$modea->where("catid=92 and furl='".$dates[$i][17]."'")->select();
	$str="<ul id='plus' class='plus'>";
	foreach($art as $v){
		$str.="<li>
			<div class='pix fl'>
				<img src='".$v[thumb]."' /> 
			</div>
			<div class='txtx fl'>
				<h5>
					".$v[title]."
				</h5>
	<span>适合年龄：<em>3-4岁4-5岁5-6岁</em></span> 
				<p>".$v['description']."</p>
			</div>
			<div class='bt'>
				<a href='".$v[url]."'><img class='showbm' src='/Public/img/1354.png' /></a> 
			</div>
		</li>";
	}
	$str.="</ul>";
		$date['huodong']=$str;
	$art=$modea->where("catid=89 and furl='".$dates[$i][17]."'")->select();
	$str='';
	foreach($art as $v){
		$str.="<h4><a href='".$v[url]."'>".$v[title]."</a></h4><p>".$v['description']."</p>";
	}
		$date['wenzhang']=$str;
	$art=$modea->where("catid=93 and furl='".$dates[$i][17]."'")->select();
	$str='';
	foreach($art as $v){
		$str.="<h4><a href='".$v[url]."'>".$v[title]."</a></h4><p>".$v['description']."</p>";
	}
		$date['youhui']=$str;
		$myurl=$model->add($date)+1;
	}
}
echo "done";
	}
//导入机构评论
	public function daorupinglun(){
//Product表加furl字段
set_time_limit(0);
header('Content-type: text/html; charset=utf8');

require_once dirname(__FILE__).'/PHPExcel/Classes/PHPExcel.php';
$objPHPExcel = new PHPExcel();
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objPHPExcel = PHPExcel_IOFactory::load('pinglun3y.xls');
$dates=$objPHPExcel->getActiveSheet()->toArray();
$model = M('Guestbook');
$modea = M('Product');
for($i=1;$i<=count($dates)-1;$i++)
{
	$pro=$modea->field('id,catid,title')->where("furl='".$dates[$i][3]."'")->find();
	$date['catid']=$pro['catid'];
	$date['linkid']=$pro['id'];
	$date['status']='1';
	$date['createtime']='1411367113';
	$date['lang']='1';
	$date['title']=$pro['title'];
	$date['content']=strip_tags($dates[$i]['1']);
	$date['score']=$dates[$i]['2'];
	$model->add($date);
}
echo "done";
	}
//导入重复机构
	public function daoruchongfu(){
//Product表加furl字段
set_time_limit(0);
header('Content-type: text/html; charset=utf8');

require_once dirname(__FILE__).'/PHPExcel/Classes/PHPExcel.php';
$objPHPExcel = new PHPExcel();
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objPHPExcel = PHPExcel_IOFactory::load('jigou.xls');
$dates=$objPHPExcel->getActiveSheet()->toArray();
$model = M('Product');
$modea = M('Article');

for($i=1;$i<=count($dates)-1;$i++)
{
	//5 7	      ├─ 早教中心
	if($dates[$i]['1'])
	{
		
		$proid=$model->field('id')->where("title='".$dates[$i]['2']."'")->find();
		$date['id']=$proid['id'];
		$date['furl']=$dates[$i]['17'];
		if(!stristr($dates[$i]['1'],'show=6'))
		{
		//关联课程91、92中心活动、89文章、93最新优惠
	$art=$modea->where("catid=91 and furl='".$dates[$i][17]."'")->select();
	$str="<ul id='plus' class='plus'>";
	foreach($art as $v){
		$str.="<li>
			<div class='pix fl'>
				<img src='".$v[thumb]."' /> 
			</div>
			<div class='txtx fl'>
				<h5>
					".$v[title]."
				</h5>
	<span>适合年龄：<em>3-4岁4-5岁5-6岁</em></span> 
				<p>".$v['description']."</p>
			</div>
			<div class='bt'>
				<a href='".$v[url]."'><img class='showbm' src='/Public/img/1354.png' /></a> 
			</div>
		</li>";
	}
	$str.="</ul>";
		$date['kecheng']=$str;
	$art=$modea->where("catid=92 and furl='".$dates[$i][17]."'")->select();
	$str="<ul id='plus' class='plus'>";
	foreach($art as $v){
		$str.="<li>
			<div class='pix fl'>
				<img src='".$v[thumb]."' /> 
			</div>
			<div class='txtx fl'>
				<h5>
					".$v[title]."
				</h5>
	<span>适合年龄：<em>3-4岁4-5岁5-6岁</em></span> 
				<p>".$v['description']."</p>
			</div>
			<div class='bt'>
				<a href='".$v[url]."'><img class='showbm' src='/Public/img/1354.png' /></a> 
			</div>
		</li>";
	}
	$str.="</ul>";
		$date['huodong']=$str;
	$art=$modea->where("catid=89 and furl='".$dates[$i][17]."'")->select();
	$str='';
	foreach($art as $v){
		$str.="<h4><a href='".$v[url]."'>".$v[title]."</a></h4><p>".$v['description']."</p>";
	}
		$date['wenzhang']=$str;
	$art=$modea->where("catid=93 and furl='".$dates[$i][17]."'")->select();
	$str='';
	foreach($art as $v){
		$str.="<h4><a href='".$v[url]."'>".$v[title]."</a></h4><p>".$v['description']."</p>";
	}
		$date['youhui']=$str;
		}
		$model->save($date);
	}
}
echo "done";
	}
//导入机构2
	public function daorujigou2(){
//Product表加furl字段
set_time_limit(0);
header('Content-type: text/html; charset=utf8');

require_once dirname(__FILE__).'/PHPExcel/Classes/PHPExcel.php';
$objPHPExcel = new PHPExcel();
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objPHPExcel = PHPExcel_IOFactory::load('jigou2.xls');
$dates=$objPHPExcel->getActiveSheet()->toArray();
$model = M('Product');
$modea = M('Article');

$myurl="546";
for($i=1;$i<=count($dates)-1;$i++)
{
	if($dates[$i]['2'])
	{
		$date['catid']=$dates[$i]['0'];
		$date['status']='1';
		$date['createtime']='1411367113';
		$date['lang']='1';
		$date['userid']='3';
		$date['username']='zhibaobaby20130521';
		$date['url']='/index.php?m=Product&a=show&id='.$myurl;
		$date['title']=$dates[$i]['3'];
		$date['thumb']=$dates[$i]['4'];
		$date['ages']=$dates[$i]['1'];
		$date['ditu']=$dates[$i]['5'];
		$date['sbanner']=$dates[$i]['6'];
		$date['bbanner']=$dates[$i]['7'];
		$date['dizhi']=$dates[$i]['8'];
		$date['zongfen']=$dates[$i]['9'];
		$date['yjpf']=$dates[$i]['10'];
		$date['rjpf']=$dates[$i]['11'];
		$date['qfpf']=$dates[$i]['12'];
		$date['hdpf']=$dates[$i]['13'];
		$date['content']=str_replace(chr(10),'<br>',$dates[$i]['14']);
		$date['pics']=$dates[$i]['15'];
		$date['jianjie']=$dates[$i]['16'];
		$date['diqu']=$dates[$i]['17'];
		$date['furl']=$dates[$i]['18'];
		//关联课程91、92中心活动、89文章、93最新优惠
	$art=$modea->where("catid=91 and furl='".$dates[$i][18]."'")->select();
	$str="<ul id='plus' class='plus'>";
	foreach($art as $v){
		$str.="<li>
			<div class='pix fl'>
				<img src='".$v[thumb]."' /> 
			</div>
			<div class='txtx fl'>
				<h5>
					".$v[title]."
				</h5>
	<span>适合年龄：<em>3-4岁4-5岁5-6岁</em></span> 
				<p>".$v['description']."</p>
			</div>
			<div class='bt'>
				<a href='".$v[url]."'><img class='showbm' src='/Public/img/1354.png' /></a> 
			</div>
		</li>";
	}
	$str.="</ul>";
		$date['kecheng']=$str;
	$art=$modea->where("catid=92 and furl='".$dates[$i][18]."'")->select();
	$str="<ul id='plus' class='plus'>";
	foreach($art as $v){
		$str.="<li>
			<div class='pix fl'>
				<img src='".$v[thumb]."' /> 
			</div>
			<div class='txtx fl'>
				<h5>
					".$v[title]."
				</h5>
	<span>适合年龄：<em>3-4岁4-5岁5-6岁</em></span> 
				<p>".$v['description']."</p>
			</div>
			<div class='bt'>
				<a href='".$v[url]."'><img class='showbm' src='/Public/img/1354.png' /></a> 
			</div>
		</li>";
	}
	$str.="</ul>";
		$date['huodong']=$str;
	$art=$modea->where("catid=89 and furl='".$dates[$i][18]."'")->select();
	$str='';
	foreach($art as $v){
		$str.="<h4><a href='".$v[url]."'>".$v[title]."</a></h4><p>".$v['description']."</p>";
	}
		$date['wenzhang']=$str;
		$myurl=$model->add($date)+1;
	}
	/*else{
		$proid=$model->field('id')->where("title='".$dates[$i]['3']."'")->find();
		$date['id']=$proid['id'];
		$date['furl']=$dates[$i]['18'];
		$model->save($date);
	}*/
	
}
echo "done";
	}
//导入机构3
	public function daorujigou3(){
//Product表加furl字段
set_time_limit(0);
header('Content-type: text/html; charset=utf8');

require_once dirname(__FILE__).'/PHPExcel/Classes/PHPExcel.php';
$objPHPExcel = new PHPExcel();
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objPHPExcel = PHPExcel_IOFactory::load('jigou3m.xls');// jigou3s,jigou3l,jigou3y,jigou3m
$dates=$objPHPExcel->getActiveSheet()->toArray();
$model = M('Product');
$modea = M('Article');

$myurl="1986";//603,881,1236,1986
for($i=1;$i<=count($dates)-1;$i++)
{
	if(!$dates[$i]['1'])
	{
		$thumbs=stristr($dates[$i]['3'],'http:')?$dates[$i]['3']:'/Public/sbanner.jpg';
		$date['catid']=33; //13 亲子摄影 9 亲子乐园 6 幼儿园 33 母婴商超
		$date['status']='1';
		$date['createtime']='1411367113';
		$date['lang']='1';
		$date['userid']='3';
		$date['username']='zhibaobaby20130521';
		$date['url']='/index.php?m=Product&a=show&id='.$myurl;
		$date['title']=$dates[$i]['2'];
		$date['thumb']=$thumbs;
		$date['ages']=$dates[$i]['0'];
		$date['sbanner']=$thumbs;
		$date['bbanner']=$dates[$i]['6']?$dates[$i]['6']:'/Public/bbanner.jpg';
		$date['dizhi']=$dates[$i]['7'];
		$date['zongfen']=$dates[$i]['8'];
		$date['yjpf']=$dates[$i]['9'];
		$date['rjpf']=$dates[$i]['10'];
		$date['qfpf']=$dates[$i]['11'];
		$date['hdpf']=$dates[$i]['12'];
		$date['content']=str_replace(chr(10),'<br>',$dates[$i]['13']);
		$date['pics']=$dates[$i]['14'];
		$date['jianjie']=$dates[$i]['15'];
		$date['diqu']=$dates[$i]['16'];
		$date['furl']=$dates[$i]['4'];
		$myurl=$model->add($date)+1;
	}
	/*else{
		$proid=$model->field('id')->where("title='".$dates[$i]['3']."'")->find();
		$date['id']=$proid['id'];
		$date['furl']=$dates[$i]['4'];
		$model->save($date);
	}*/
	
}
echo "done";
	}
	
	
	
	
	//机构1分店
	public function fenzhan(){
set_time_limit(0);
header('Content-type: text/html; charset=utf8');
require_once(dirname(__FILE__).'/QueryList/QueryList.class.php');

$model = M('Product');
$url = "http://www.izaojiao.com/zaojiaopinpai/guangzhou";
$reg = array("pinpai"=>array("","href"));
$rang = "#brandList a";
$hj = QueryList::Query($url,$reg,$rang,'curl','utf-8');
$arr = $hj->jsonArr;
//count($arr)
for ($i = 0;  $i< count($arr); $i++) 
{
	$url = "http://www.izaojiao.com".$arr[$i]['pinpai'];
	$regs = array("fendian"=>array("a","href"));
	$rang = ".tu";
	$hj = QueryList::Query($url,$regs,$rang,'curl','utf-8');
	$tmps = $hj->jsonArr;
	if (count($tmps)>1){
		$str="<ul id='plus' class='plus'>";
		foreach($tmps as $k=>$y){
			$jigou[$k]=$model->field('id,title,thumb,dizhi,content,url')->where("furl='http://www.izaojiao.com".$y['fendian']."'")->find();
			$str.="
			<li>
				<div class='pix fl'><img src='".$jigou[$k]['thumb']."' /></div>
				<div class='txtx fl'>
					<h5>".$jigou[$k]['title']."</h5>
					<p class='mypp'>".strip_tags($jigou[$k]['content'])."</p>
				</div>
				<div class='bt'>
					<a href='".$jigou[$k]['url']."'><img class='showbm' src='/Public/img/1354.png' /></a> 
				</div>
			</li>";
		}
		$str.="</ul>";
		foreach($jigou as $k=>$y){
			$date['id']=$y['id'];
			$date['pinpai']=$str;
			$model->save($date);
		}
	}
}
echo "done";
exit;
	}
	
	
	//机构3分店
	public function fenzhan3(){
set_time_limit(0);
header('Content-type: text/html; charset=utf8');
require_once(dirname(__FILE__).'/QueryList/QueryList.class.php');

$model = M('Product');
//分页开始
for ($j = 1; $j <=20; $j++) 
{
	$url = "http://www.dianping.com/search/category/4/70/g193p".$j;
	$reg = array("branch"=>array(".shopbranch","href"));
	$rang = ".shop-list li";
	$hj = QueryList::Query($url,$reg,$rang,'curl','UTF-8');
	$arr[] = $hj->jsonArr;
}
foreach($arr as $x=>$y){
	foreach($y as $k=>$v){
		$v['branch']?$tmps[]= $v['branch']:'';
	}
}
$tmp=array_unique($tmps);
print_r($tmp);exit;
foreach ($tmp as $v){
	$url = "http://www.dianping.com".$v;
	$regs = array("fendian"=>array(".pic a","href"));
	$rang = "#shop-all-list li";
	$hj = QueryList::Query($url,$regs,$rang,'curl','utf-8');
	$tmps=$hj->jsonArr;
	if (count($tmps)>1){
		$str="<ul id='plus' class='plus'>";
		foreach($tmps as $k=>$y){
			$jigou[$k]=$model->field('id,title,thumb,dizhi,content,url')->where("furl='http://www.dianping.com".$y['fendian']."'")->find();
			//$jigou[$k]['furl']='http://www.dianping.com'.$y['fendian'];
			if ($jigou[$k])
			{
			$str.="
			<li>
				<div class='pix fl'><img src='".$jigou[$k]['thumb']."' /></div>
				<div class='txtx fl'>
					<h5>".$jigou[$k]['title']."</h5>
					<p class='mypp'>".strip_tags($jigou[$k]['content'])."</p>
				</div>
				<div class='bt'>
					<a href='".$jigou[$k]['url']."'><img class='showbm' src='/Public/img/1354.png' /></a> 
				</div>
			</li>";
			}
		}
		$str.="</ul>";
		foreach($jigou as $k=>$y){
			$date['id']=$y['id'];
			$date['pinpai']=$str;
			$model->save($date);
		}
	}
}
echo "done";
exit;
	}
	
	
	//导入会员
	public function daoruhuiyuan(){
//article表加furl 字段
set_time_limit(0);
header('Content-type: text/html; charset=utf8');

require_once dirname(__FILE__).'/PHPExcel/Classes/PHPExcel.php';
$objPHPExcel = new PHPExcel();
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objPHPExcel = PHPExcel_IOFactory::load('huiyuan.xls');
$dates=$objPHPExcel->getActiveSheet()->toArray();
$model = M('User');
for($i=1;$i<count($dates);$i++)
{
	$date['groupid']='3';
	$date['status']='1';
	$date['password']='3d1252ff5ecb15575557a2279637ac7ff58d7bfb';
	$date['username']=$dates[$i]['0'];
	$date['email']=$dates[$i]['1'];
	$date['mobile']=$dates[$i]['2'];
	$date['tel'] = $dates[$i]['3'];
	$date['createtime']=$dates[$i]['4'];
	$date['sex']=$dates[$i]['5']==1?2:1;
	$model->add($date);
}
echo "done";
	}
	
	//导入更新会员
	public function uphuiyuan(){
//article表加furl 字段
set_time_limit(0);
header('Content-type: text/html; charset=utf8');

require_once dirname(__FILE__).'/PHPExcel/Classes/PHPExcel.php';
$objPHPExcel = new PHPExcel();
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objPHPExcel = PHPExcel_IOFactory::load('uphuiyuan.xlsx');
$dates=$objPHPExcel->getActiveSheet()->toArray();
$model = M('User');
for($i=1;$i<count($dates);$i++)
{
	$date['id']=$dates[$i]['0'];
	$date['username']=$dates[$i]['1'];
	$date['mobile']=$dates[$i]['2'];
	$date['address'] = $dates[$i]['3'];
	$model->save($date);
}
echo "done";
	}
	//导入更新会员
	public function uphuiyuan2(){
//article表加furl 字段
set_time_limit(0);
header('Content-type: text/html; charset=utf8');

require_once dirname(__FILE__).'/PHPExcel/Classes/PHPExcel.php';
$objPHPExcel = new PHPExcel();
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objPHPExcel = PHPExcel_IOFactory::load('uphuiyuan2.xlsx');
$dates=$objPHPExcel->getActiveSheet()->toArray();
$model = M('User');
for($i=1;$i<count($dates);$i++)
{
	$date['id']=$dates[$i]['0'];
	$date['jiazhang']=$dates[$i]['1'];
	$date['baobao']=$dates[$i]['2'];
	$test=explode('-',$dates[$i]['3']);
	$date['briqi'] = '20'.$test[2].'/'.$test[0].'/'.$test[1];
	$model->save($date);
}
echo "done";
	}
	
	
	
	
//导入育儿文章
	public function yuer(){
//Product表加furl字段
set_time_limit(0);
header('Content-type: text/html; charset=utf8');

require_once dirname(__FILE__).'/PHPExcel/Classes/PHPExcel.php';
$objPHPExcel = new PHPExcel();
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objPHPExcel = PHPExcel_IOFactory::load('beiyun.xls');// yugu,yuhui,yuying,yuzhi,beiyun
$dates=$objPHPExcel->getActiveSheet()->toArray();
$model = M('Article');

$myurl="6521";//2817,4137,4343,6521
for($i=1;$i<=count($dates)-1;$i++)
{
		$date['catid']=$dates[$i]['0'];
		$date['status']='1';
		$date['createtime']='1374474313';
		$date['lang']='1';
		$date['userid']='3';
		$date['username']='zhibaobaby20130521';
		$date['copyfrom']='挚宝荟';
		$date['url']='/index.php?m=Article&a=show&id='.$myurl;
		$date['title']=$dates[$i]['1'];
		$date['thumb']=$dates[$i]['3'];
		$date['content']=$dates[$i]['2'];
		$myurl=$model->add($date)+1;
}
echo "done";
	}
	
	
//处理内容链接等
	public function chuli(){
//Product表加furl字段
set_time_limit(0);
header('Content-type: text/html; charset=utf8');
$model = M('Article');
$dates=$model->field('id,content')->where('id >493')->select();//id >493

foreach($dates as $v)
{
	$date['id']=$v['id'];
	$date['description'] = addslashes_array(str_cut(str_replace(array("\r\n","\t",'[page]','[/page]','&ldquo;','&rdquo;','　',' '), '', strip_tags($v['content'])),200));
	$date['content']=ereg_replace("<a [^>]*>|<\/a>","",$v['content']);
	$model->save($date);
}
	}
//处理内容链接等
	public function chuli2(){
//Product表加furl字段
set_time_limit(0);
header('Content-type: text/html; charset=utf8');
$model = M('Product');
$dates=$model->field('id,pinpai')->where('id =538')->select();//id >310
	print_r(str_replace("<li><div class='pix fl'><img src=''></div><div class='txtx fl'><h5></h5><p class='mypp'></p></div><div class='bt'><a href=''><img src='/Public/img/1354.png' class='showbm'></a></div></li>","",$dates[0]['pinpai']));
			//echo ereg_replace('<a([^>]*)>([^<]*'.$find.'[^>]*)</a>','<font color="red">\\2</font>',$content);
	exit;

foreach($dates as $v)
{
	$date['id']=$v['id'];
	//$date['content']=ereg_replace("<a [^>]*>|<\/a>","",$v['content']);
	str_replace("","",$v['pinpai']);
	//$content=$modelss->field('content')->where('id ='.$v['id'])->find();
	//$date['pinpai']=$content['content'];
	//$model->save($date);
}
	}
	
	
	
	
	
	
	
	
	
	//客户 马可波罗
	public function kehu(){
		echo "sd";exit;
//需要修改3个地方 $j页数，$url地址，$filename文件名称
set_time_limit(0);
header('Content-type:text/html;charset=utf-8');
require_once(dirname(__FILE__).'/QueryList/QueryList.class.php');
$filename="客户_".$_GET['words']."_马可波罗";
if ($_GET['words'] && !$_GET['str'])
{
	//$url = "http://caigou.makepolo.com/scw.php?pg=1&q=".urlencode($_GET['words'])."&search_flag=q1";
	$url = "http://caigou.makepolo.com/scw.php?pg=1&q=".urlencode($_GET['words'])."&search_flag=q1&ae=guangdong";
	$reg = array("url"=>array(".h_com_list .h_com_info h3 a","href"));
	$rang = "ul.corp_info";
	$hj = QueryList::Query($url,$reg,$rang,'curl','utf-8');
	$arr = $hj->jsonArr;
	print_r($arr);
	unset($arr);
	exit;
}else{
	for ($j =$_GET['str']; $j <=$_GET['end']; $j++) 
	{
		//
		$url = "http://caigou.makepolo.com/scw.php?q=".urlencode($_GET['words'])."&search_flag=q1&ae=guangdong&pg=".$j;
		$reg = array("url"=>array(".h_com_list .h_com_info h3 a","href"));
		$rang = "ul.corp_info";
		$hj = QueryList::Query($url,$reg,$rang,'curl','utf-8');
		$arr = $hj->jsonArr;
		for ($i = 0;  $i< count($arr); $i++) 
		{
			$url = $arr[$i]['url']."/corp/corp.html";
			$regs = array(
					"title"=>array(".company_names h1","html"),
					"url"=>array("#menu_select a","href"),
					"dizhi"=>array(".base_info:eq(0) ul li:eq(2)","html"),
					"faren"=>array(".base_info:eq(0) ul li:eq(1)","html"),
					"chengli"=>array(".base_info:eq(1) ul li:eq(0)","html"),
					"lianxiren"=>array(".com_messages span:eq(1)","html"),
					"qq"=>array(".qq_shou a:eq(0)","href"),
					"dianhui"=>array(".com_messages span:eq(3)","html")
					);
			$hj = QueryList::Query($url,$regs);
			$tmps_p= $hj->jsonArr;
			$arrd[]= $tmps_p;
		}
		unset($arr);
		unset($tmps_p);
	}
}

//分页开始
error_reporting(E_ALL);
date_default_timezone_set('Asia/Shanghai');
require_once dirname(__FILE__).'/PHPExcel/Classes/PHPExcel.php';

$objPHPExcel=new PHPExcel();
$objPHPExcel->getProperties()->setCreator('http://www.zomsky.com')
        ->setLastModifiedBy('http://www.zomsky.com')
        ->setTitle('Office 2007 XLSX Document')
        ->setSubject('Office 2007 XLSX Document')
        ->setDescription('Document for Office 2007 XLSX, generated using PHP classes.')
        ->setKeywords('office 2007 openxml php')
        ->setCategory('Result file');
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1','公司名称')
            ->setCellValue('B1','法人')
            ->setCellValue('C1','联系电话')
            ->setCellValue('D1','成立时间')
            ->setCellValue('E1','qq')
            ->setCellValue('F1','地址')
            ->setCellValue('G1','链接地址');
$i=2;
foreach($arrd as $x=>$y){
	foreach($y as $k=>$v){
		if (stristr($v['faren'],$v['lianxiren']) && $v['dianhui'])
		{
 $objPHPExcel->setActiveSheetIndex(0)
	->setCellValue('A'.$i,$v['title'])
	->setCellValue('B'.$i,$v['lianxiren'])
	->setCellValue('C'.$i,$v['dianhui'])
	->setCellValue('D'.$i,$v['chengli'])
	->setCellValue('E'.$i,$v['qq'])
	->setCellValue('F'.$i,$v['dizhi'])
	->setCellValue('G'.$i,$v['url']);
 $i++;
		}
	}
}
$objPHPExcel->setActiveSheetIndex(0);
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="'.$filename.'.xls"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
unset($arrd);
unset($objPHPExcel);
unset($objWriter);
exit;
	}
	
	//阿里巴巴
	public function kehua(){
set_time_limit(0);
//header('Content-type:text/html;charset=GBK');
require_once(dirname(__FILE__).'/QueryList/QueryList.class.php');
$filename="客户_女包公司_阿里巴巴";
/*
$url = 'http://7gmall.1688.com/page/creditdetail.htm';
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch,CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.0)");
$html = curl_exec($ch);
curl_close($ch);
//原网页是GB2312的，所以需要先转码一下
$html = iconv('GBK', 'UTF-8', $html);
//上面转换了网页编码，所以需要跟着替换网页charset，
//phpQuery会根据网页源码里面的charset来判断网页编码格式
$html = str_replace('gbk', 'utf-8', $html);
$reg = array(
			"title"=>array(".module-content:eq(0) dd:eq(0)","title"),
			"url"=>array("li.selected a","href"),
			"dizhi"=>array(".company-info:eq(0) ul:eq(1) li:eq(1)","html"),
			"chengli"=>array(".company-info:eq(0) ul:eq(0) li:eq(0)","html"),
			"lianxiren"=>array(".module-content:eq(0) dd:eq(0)","title"),
			"dianhui"=>array(".module-content:eq(0) dd:eq(1)","html")
		);
$hj = QueryList::Query($html,$reg,'','curl','utf-8');
$arr = $hj->jsonArr;
print_r($arr);
exit;*/
/*
header('Content-type:text/html;charset=utf-8');
require_once(dirname(__FILE__).'/QueryList/phpQuery/phpQuery.php');
phpQuery::newDocumentFile('http://s.1688.com/company/company_search.htm?keywords=%BB%AF%D7%B1%C6%B7%B9%AB%CB%BE&button_click=top&earseDirect=false&n=y'); 
$artlist = pq(".list-item-left .wrap"); 
foreach($artlist as $li){ 
   echo pq($li)->find('.list-item-title-text')->html().""; 
} 
exit;*/
/*
if ($_GET['words'] && !$_GET['str'])
{
	echo "请填写str & end";
	exit;
}else{
	//分页开始
	for ($j = $_GET['str']; $j <=$_GET['end']; $j++) 
	{
		$url = "http://s.1688.com/company/company_search.htm?keywords=%C5%AE%B0%FC%B9%AB%CB%BE&province=%B9%E3%B6%AB&n=y&filt=y&pageSize=30&beginPage=".$j;
		echo $url;
		$reg = array("url"=>array(".list-item-title-text","href"),"title"=>array(".list-item-title-text","title"));
		$rang = ".list-item-left .wrap";
		$hj = QueryList::Query($url,$reg,$rang,'curl');
		$arr = $hj->jsonArr;
		print_r($arr);
		exit;
		for ($i = 0;  $i< count($arr); $i++) 
		{
			$url = strrpos($arr[$i]['url'],'?')?substr($arr[$i]['url'],0, strrpos($arr[$i]['url'],'?') )."/page/creditdetail.htm":$arr[$i]['url']."/page/creditdetail.htm";
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch,CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.0)");
			$html = curl_exec($ch);
			curl_close($ch);
			//原网页是GB2312的，所以需要先转码一下
			$html = iconv('GBK', 'UTF-8', $html);
			//上面转换了网页编码，所以需要跟着替换网页charset，
			//phpQuery会根据网页源码里面的charset来判断网页编码格式
			$html = str_replace('gbk', 'utf-8', $html);
			$reg = array(
					"title"=>array(".company-title span:eq(0)","title"),
					"url"=>array("li.selected a","href"),
					"dizhi"=>array(".company-info:eq(0) ul:eq(1) li:eq(1)","html"),
					"chengli"=>array(".company-info:eq(0) ul:eq(0) li:eq(0)","html"),
					"lianxiren"=>array(".module-content:eq(0) dd:eq(0)","title"),
					"dianhui"=>array(".module-content:eq(0) dd:eq(1)","html")
				);
			$hj = QueryList::Query($html,$reg,'','curl','utf-8');
			$tmps_p= $hj->jsonArr;
			$arrd[]= $tmps_p;
		}
		unset($arr);
	}
}*/
	for ($j = 31; $j <=35; $j++) 
	{
		$url = "http://s.1688.com/company/company_search.htm?keywords=%C5%AE%B0%FC%B9%AB%CB%BE&province=%B9%E3%B6%AB&n=y&filt=y&pageSize=30&beginPage=".$j;
		
		//http://s.1688.com/company/company_search.htm?keywords=%C5%AE%B0%FC%B9%AB%CB%BE&n=y&from=&industryFlag=&_source=sug
		$reg = array("url"=>array(".list-item-title-text","href"),"title"=>array(".list-item-title-text","title"));
		$rang = ".list-item-left .wrap";
		$hj = QueryList::Query($url,$reg,$rang,'curl');
		$arr = $hj->jsonArr;
		for ($i = 0;  $i< count($arr); $i++) 
		{
			$url = strrpos($arr[$i]['url'],'?')?substr($arr[$i]['url'],0, strrpos($arr[$i]['url'],'?') )."/page/creditdetail.htm":$arr[$i]['url']."/page/creditdetail.htm";
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch,CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.0)");
			$html = curl_exec($ch);
			curl_close($ch);
			//原网页是GB2312的，所以需要先转码一下
			$html = iconv('GBK', 'UTF-8', $html);
			//上面转换了网页编码，所以需要跟着替换网页charset，
			//phpQuery会根据网页源码里面的charset来判断网页编码格式
			$html = str_replace('gbk', 'utf-8', $html);
			$reg = array(
					"title"=>array(".company-title span:eq(0)","title"),
					"url"=>array("li.selected a","href"),
					"dizhi"=>array(".company-info:eq(0) ul:eq(1) li:eq(1)","html"),
					"chengli"=>array(".company-info:eq(0) ul:eq(0) li:eq(0)","html"),
					"lianxiren"=>array(".module-content:eq(0) dd:eq(0)","title"),
					"dianhui"=>array(".module-content:eq(0) dd:eq(1)","html")
				);
			$hj = QueryList::Query($html,$reg,'','curl','utf-8');
			$tmps_p= $hj->jsonArr;
			$arrd[]= $tmps_p;
		}
		unset($arr);
	}
error_reporting(E_ALL);
date_default_timezone_set('Asia/Shanghai');
require_once dirname(__FILE__).'/PHPExcel/Classes/PHPExcel.php';
$objPHPExcel=new PHPExcel();
$objPHPExcel->getProperties()->setCreator('http://www.zomsky.com')
        ->setLastModifiedBy('http://www.zomsky.com')
        ->setTitle('Office 2007 XLSX Document')
        ->setSubject('Office 2007 XLSX Document')
        ->setDescription('Document for Office 2007 XLSX, generated using PHP classes.')
        ->setKeywords('office 2007 openxml php')
        ->setCategory('Result file');
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1','公司名称')
            ->setCellValue('B1','联系人')
            ->setCellValue('C1','联系电话')
            ->setCellValue('D1','成立时间')
            ->setCellValue('E1','地址')
            ->setCellValue('F1','链接地址');
$i=2;
foreach($arrd as $x=>$y){
	foreach($y as $k=>$v){
		if($v['dianhui']){
 $objPHPExcel->setActiveSheetIndex(0)
	->setCellValue('A'.$i,$v['title'])
	->setCellValue('B'.$i,$v['lianxiren'])
	->setCellValue('C'.$i,strip_tags($v['dianhui']))
	->setCellValue('D'.$i,strip_tags($v['chengli']))
	->setCellValue('E'.$i,strip_tags($v['dizhi']))
	->setCellValue('F'.$i,$v['url']);
 $i++;
 		}
	}
}
$objPHPExcel->setActiveSheetIndex(0);
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="'.$filename.'.xls"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
unset($arrd);
unset($objPHPExcel);
unset($objWriter);
exit;
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	//9chengming新闻抓取
	public function xinwen9(){

set_time_limit(0);
header('Content-type:text/html;charset=UTF-8');
require_once(dirname(__FILE__).'/QueryList/QueryList.class.php');

/*$url = "http://www.yixieshi.com/it/20642.html";
$reg = array(
		"title"=>array(".article h1:eq(0)","html"),
		"createtime"=>array(".txt-shadow span:eq(0)","html"),
		"content"=>array(".articleCon","html"),
		"content2"=>array(".artBox","html"),
		"content3"=>array(".artCon","html")
		);
$hj = QueryList::Query($url,$reg,'','curl','utf-8');
$arr = $hj->jsonArr;
print_r($arr);
exit;*/
//分页开始
for ($j = 26; $j <=32; $j++) 
{
	$url = "http://www.yixieshi.com/youqu/list_7_".$j.".html";
	$reg = array("url"=>array("h2 a","href"));
	$rang = ".post-list ul li";
	$hj = QueryList::Query($url,$reg,$rang,'curl','utf-8');
	$arr = $hj->jsonArr;//count($arr)
	for ($i = 0;  $i< count($arr); $i++) 
	{
		$url = $arr[$i]['url'];
		$regs = array(
				"title"=>array(".article h1:eq(0)","html"),
				"createtime"=>array(".txt-shadow span:eq(0)","html"),
				"content"=>array(".articleCon","html"),
				"content2"=>array(".artBox","html"),
				"content3"=>array(".artCon","html")
				);
		$hj = QueryList::Query($url,$regs,'','curl','utf-8');
		$tmps_p= $hj->jsonArr;
		$arrd[]= $tmps_p;
	}
}
$model = M('Article');
$myurl="7393";
foreach ($arrd as $v)
{
	if ($v['0']['content'])
		$contents=$v['0']['content'];
	elseif ($v['0']['content2'])
		$contents=$v['0']['content2'];
	else
		$contents=$v['0']['content3'];
		
	if($v['0']['title'] && $contents)
	{
	$date['catid']='10';
	$date['status']='1';
	$date['createtime']=strtotime(str_replace('时间：','',$v['0']['createtime']));
	$date['lang']='1';
	$date['userid']='3';
	$date['username']='admin';
	$date['url']='/m/interesting_'.$myurl.'.html';
	$date['title']=$v['0']['title'];
	$date['content']=$contents;
	$date['description'] = str_cut(str_replace(array("\r\n","\t",'[page]','[/page]','&ldquo;','&rdquo;','　',' '), '', strip_tags(stripslashes($contents))),200);
	$date['description'] = addslashes_array($date['description']);
	//$date['furl']=$dates[$i]['4'];
	$myurl=$model->add($date)+1;
	}
}
echo "done";
exie;
	}
	//9chengming新闻抓取
	public function xinwen10(){

set_time_limit(0);
header('Content-type:text/html;charset=UTF-8');
require_once(dirname(__FILE__).'/QueryList/QueryList.class.php');
/*
$url = "http://it.sohu.com/itguonei.shtml";
$reg = array(
		"title"=>array("h1 a","html"));
$rang=".txt01 div";
$hj = QueryList::Query($url,$reg,$rang,'curl','utf-8');
$arr = $hj->jsonArr;
print_r($arr);
exit;*/
//分页开始3456  3554
for ($j = 3506; $j <=3554; $j++) 
{
	$url = "http://it.sohu.com/itguoji_".$j.".shtml";
	$reg = array("url"=>array("h1 a","href"));
	$rang = ".txt01 div";
	$hj = QueryList::Query($url,$reg,$rang,'curl','utf-8');
	$arr = $hj->jsonArr;//count($arr)
	for ($i = 0;  $i< count($arr); $i++) 
	{
		$url = $arr[$i]['url'];
		$regs = array(
				"title"=>array(".content-box h1:eq(0)","html"),
				"createtime"=>array("#pubtime_baidu","html"),
				"content"=>array("#contentText","html")
				);
		$hj = QueryList::Query($url,$regs,'','curl','utf-8');
		$tmps_p= $hj->jsonArr;
		$arrd[]= $tmps_p;
	}
}
$model = M('Article');
$myurl="7164";
foreach ($arrd as $v)
{
	if($v['0']['title'])
	{
	$contents=$v['0']['content'];
	$date['catid']='3';
	$date['status']='1';
	$date['createtime']=strtotime(str_replace('时间：','',$v['0']['createtime']));
	$date['lang']='1';
	$date['userid']='3';
	$date['username']='admin';
	$date['url']='/m/cnnews_'.$myurl.'.html';
	$date['title']=$v['0']['title'];
	$date['content']=$contents;
	$date['description'] = str_cut(str_replace(array("\r\n","\t",'[page]','[/page]','&ldquo;','&rdquo;','　',' '), '', strip_tags(stripslashes($contents))),200);
	$date['description'] = addslashes_array($date['description']);
	//$date['furl']=$dates[$i]['4'];
	$myurl=$model->add($date)+1;
	}
}
echo "done";
exie;
	}
	
	//9chengming案例
	public function cases(){

set_time_limit(0);
header('Content-type:text/html;charset=utf-8');
require_once(dirname(__FILE__).'/QueryList/QueryList.class.php');


/*//http://www.ddwab.com/CaseList/list-132-1.html
$url = "http://www.ddwab.com/caselist/list-142-1.html";
$reg = array("url"=>array("dt a","href"),"thumb"=>array(".jobs_img","src"),"title"=>array(".jobs_img","title"));
$rang = ".case_one";
$hj = QueryList::Query($url,$reg,$rang,'curl','utf-8');
$url = "http://www.1000zhu.com/cases/7.html";
$reg = array("title"=>array(".words h1","html"));
$rang = ".case_one";
$hj = QueryList::Query($url,$reg,'','curl','utf-8');
$arr = $hj->jsonArr;
print_r($arr);
exit;*/
//分页开始
for ($j = 1; $j <=4; $j++) 
{
	$url = "http://www.1000zhu.com/cases/page-".$j."/";
	$reg = array("url"=>array("a","href"),"thumb"=>array("img","src"),"title"=>array("img","alt"));
	$rang = ".list-inline li";
	$hj = QueryList::Query($url,$reg,$rang,'curl','utf-8');
	$arr = $hj->jsonArr;//count($arr)
	for ($i = 0;  $i< count($arr); $i++) 
	{
		$url = 'http://www.1000zhu.com'.$arr[$i]['url'];
		$regs = array(
				"xinghao"=>array(".words .rel a","html"),
				"content"=>array(".words p:eq(0)","html")
				);
		$hj = QueryList::Query($url,$regs,'','curl','utf-8');
		$tmps_p= $hj->jsonArr;
		$tmps_p['0']['title'] = $arr[$i]['title'];
		$tmps_p['0']['thumb'] = 'http://www.1000zhu.com'.$arr[$i]['thumb'];
		
		$url = 'http://www.1000zhu.com'.$arr[$i]['url'];
		$regs = array("pics"=>array("","src"));
		$rang = ".caseshow p img";
		$hj = QueryList::Query($url,$regs,$rang,'curl','utf-8');
		$tmps_pic= $hj->jsonArr;
		foreach($tmps_pic as $y){
			$tmps_p['0']['pics'] .= 'http://www.1000zhu.com'.$y['pics'].'|:::';
		}
		$arrd[]= $tmps_p;
	}
}
$model = M('Product');
$myurl="1";
foreach ($arrd as $v)
{
	switch ($v[0]['xinghao'])
	{
	case '教育行业':
	case '科技行业':
	case '媒体行业':
		$catids='6';
		$urlname='jewelry';
	  break;  
	case '旅游行业':
	case '金融行业':
	case '医疗行业':
	case '其他行业':
		$catids='7';
		$urlname='culture';
	  break;
	case '房产行业':
	case '制造行业':
		$catids='5';
		$urlname='apparel';
	  break;
	default:
		$catids='9';
		$urlname='package';
	}
	if(stristr($v['0']['content'],'<img')||empty($v['0']['content']))
	{
		$contents="前期策划，用户体验沟通，网站设计，前端交互效果实现，网站程序开发，网站测试，上线！就成铭信息技术有限公司";
	}else{
		$contents=$v['0']['content'];
	}
	
	
	$date['catid']=$catids;
	$date['status']='1';
	$date['createtime']='1411367113';
	$date['lang']='1';
	$date['userid']='3';
	$date['username']='admin';
	$date['url']='/'.$urlname.'_'.$myurl.'.html';
	$date['title']=$v['0']['title'];
	$date['thumb']=$v['0']['thumb'];
	$date['xinghao']=$v['0']['xinghao'];
	$date['pics']=$v['0']['pics'];
	$date['content']=$contents;
	$date['description'] = str_cut(str_replace(array("\r\n","\t",'[page]','[/page]','&ldquo;','&rdquo;','　',' '), '', strip_tags(stripslashes($contents))),200);
	$date['description'] = addslashes_array($date['description']);
	//$date['furl']=$dates[$i]['4'];
	$myurl=$model->add($date)+1;
}
echo "done";
exie;
	}
	
	
	public function chongfu1(){
//Product表加furl字段
set_time_limit(0);
header('Content-type: text/html; charset=utf8');

require_once dirname(__FILE__).'/PHPExcel/Classes/PHPExcel.php';
$objPHPExcel = new PHPExcel();
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objPHPExcel = PHPExcel_IOFactory::load('chongfu2.xls');// jigou3s,jigou3l,jigou3y,jigou3m
$dates=$objPHPExcel->getActiveSheet()->toArray();
$model = M('Product');

for($i=1;$i<=count($dates)-1;$i++)
{
	if($dates[$i]['1'])
	{
		$date['id']=$dates[$i]['1'];
		$pics=$model->field('pics')->find($date);
		if(empty($pics['pics']) && $dates[$i]['14']) $date['pics']=$dates[$i]['14'];
		$date['furl']=$dates[$i]['4'];
		$model->save($date);
	}
	
}
echo "done";
	}
	public function pinglunzong(){
//Product表加furl字段
set_time_limit(0);
header('Content-type: text/html; charset=utf8');

$model = M('Product');
$modelg = M('Guestbook');
$modelgs = M('Guestbook2');
$dates=$model->field('id,catid,furl')->select();
foreach($dates as $v){
	if(!$modelg->where('linkid='.$v['id'].' and catid='.$v['catid'])->count())
	{
		$gbk=$modelgs->field('catid,linkid,status,createtime,lang,title,content,score')->where("furl='".$v['furl']."'")->select();
		foreach($gbk as $d){
			$modelg->add($d);
		}
	}
}
echo "done";
	}
	public function daorupinglun2(){
//Product表加furl字段
set_time_limit(0);
header('Content-type: text/html; charset=utf8');

require_once dirname(__FILE__).'/PHPExcel/Classes/PHPExcel.php';
$objPHPExcel = new PHPExcel();
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objPHPExcel = PHPExcel_IOFactory::load('pinglun.xls');
$dates=$objPHPExcel->getActiveSheet()->toArray();
$model = M('Guestbook2');
$modea = M('Product');
for($i=1;$i<=count($dates)-1;$i++)
{
	$pro=$modea->field('id,catid,title')->where("furl='".$dates[$i][3]."'")->find();
	$date['catid']=$pro['catid'];
	$date['linkid']=$pro['id'];
	$date['status']='1';
	$date['createtime']='1411367113';
	$date['lang']='1';
	$date['title']=$pro['title'];
	$date['content']=strip_tags($dates[$i]['1']);
	$date['score']=$dates[$i]['2'];
	$date['furl']=$dates[$i]['3'];
	$model->add($date);
}
echo "done";
	}
	
	//tinyshop导京东评论
	public function tinyshopJdCom(){
		//https://rate.tmall.com/list_detail_rate.htm?itemId=40963964538&spuId=294805433&sellerId=2165685983&order=3&currentPage=2&append=0&content=1&tagId=&posi=&picture=&ua=253UW5TcyMNYQwiAiwQRHhBfEF8QXtHcklnMWc%3D%7CUm5OcktyTHVNcExySnBEey0%3D%7CU2xMHDJ7G2AHYg8hAS8RLQMjDVEwVjpdI1l3IXc%3D%7CVGhXd1llXGVbYlpnW2VdZ1NsW2ZEcUtzS3dMc0txS3dOd0J%2FQG44%7CVWldfS0SMgY5GSEBLwovXSJLZTNl%7CVmhIGC0NOBgkGiMXNwI2CT0dIR8kHz8FPgsrFykSKQkzDDlvOQ%3D%3D%7CV25OHjAePgoxCysVLBMsDDMHPwc4AFYA%7CWGFBET8RMQQwCysSKxEoCDcDOQY%2FA1UD%7CWWBAED4QMAo1DCwVKxMtDTIGMws1DlgO%7CWmNDEz0TMwY6Dy8WKRQsDDIPNgI4DFoM%7CW2JCEjwSMgY5BiYfIB4jAz0AOAM%2FC10L%7CXGVFFTsVNQE%2FCioTLBItDTMOOgcyDVsN%7CXWVFFTsVNWVQZF19RHtGfV1oUmtJcVFtU2tLdU9vUWUzEy4OIA4uECwRKhYqfCo%3D%7CXmdaZ0d6WmVFeUB8XGJaYEB5WWVYeExsWXlDY1h4QGBcYjQ%3D&isg=05A8B3F2B797A8D9D0C9358733F6D3EB&_ksTS=1443450446590_2973&callback=jsonp2974
//$url ='https://rate.tmall.com/list_detail_rate.htm?itemId=40963964538&spuId=294805433&sellerId=2165685983&order=3&currentPage=2&append=0&content=1&tagId=&posi=&picture=&ua=253UW5TcyMNYQwiAiwQRHhBfEF8QXtHcklnMWc%3D%7CUm5OcktyTHVNcExySnBEey0%3D%7CU2xMHDJ7G2AHYg8hAS8RLQMjDVEwVjpdI1l3IXc%3D%7CVGhXd1llXGVbYlpnW2VdZ1NsW2ZEcUtzS3dMc0txS3dOd0J%2FQG44%7CVWldfS0SMgY5GSEBLwovXSJLZTNl%7CVmhIGC0NOBgkGiMXNwI2CT0dIR8kHz8FPgsrFykSKQkzDDlvOQ%3D%3D%7CV25OHjAePgoxCysVLBMsDDMHPwc4AFYA%7CWGFBET8RMQQwCysSKxEoCDcDOQY%2FA1UD%7CWWBAED4QMAo1DCwVKxMtDTIGMws1DlgO%7CWmNDEz0TMwY6Dy8WKRQsDDIPNgI4DFoM%7CW2JCEjwSMgY5BiYfIB4jAz0AOAM%2FC10L%7CXGVFFTsVNQE%2FCioTLBItDTMOOgcyDVsN%7CXWVFFTsVNWVQZF19RHtGfV1oUmtJcVFtU2tLdU9vUWUzEy4OIA4uECwRKhYqfCo%3D%7CXmdaZ0d6WmVFeUB8XGJaYEB5WWVYeExsWXlDY1h4QGBcYjQ%3D&isg=05A8B3F2B797A8D9D0C9358733F6D3EB&_ksTS=1443450446590_2973&callback=jsonp2974';
$url = 'http://club.jd.com/productpage/p-591119-s-0-t-0-p-1.html';
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//curl_setopt($ch,CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.0)");
$test = curl_exec($ch);
curl_close($ch);
$test = iconv('GBK', 'UTF-8', $test);
$result=json_decode($test,true);
//print_r($result);
$model = M('review');
$model2 = M('user_tiny');
foreach($result['comments'] as $v){
	//print_r($v);
	$user=$model2->field('id')->where("name='".$v['nickname']."'")->find();
	if($user['id'])
		$userid=$user['id'];
	else{
		$date2['name']=$v['nickname'];
		$date2['password']='02b7ba7ac4fd94b89ea9856dcad67837';
		$date2['email']=$v['nickname'].'@qq.com';
		$date2['head_pic']='http://'.$v['userImageUrl'];
		$date2['validcode']='K@!$>zd[';
		$date2['status']='1';
		$userid=$model2->add($date2);
	}
	$date['goods_id']=16;
	$date['order_no']='20150816223522659368';
	$date['user_id']=$userid;
	$date['content']=$v['content'];
	$date['point']=$v['score'];
	$date['status']='1';
	$date['buy_time']=$v['referenceTime'];
	$date['comment_time']=$v['creationTime'];
	$model->add($date);
}
echo "done";
exit;
	}
	
	
	public function baidu(){
$urls = array(
    'http://www.9chengming.com/m/server/',
    'http://www.9chengming.com/m/news/',
    'http://www.9chengming.com/m/contactus/',
    'http://www.9chengming.com/m/cnnews/',
    'http://www.9chengming.com/m/it/',
    'http://www.9chengming.com/m/interesting/',
    'http://www.9chengming.com/m/apparel/',
    'http://www.9chengming.com/m/jewelry/',
    'http://www.9chengming.com/m/culture/',
    'http://www.9chengming.com/m/package/',
    'http://www.9chengming.com/m/cnnews_6541.html',
    'http://www.9chengming.com/m/it_1.html',
    'http://www.9chengming.com/m/interesting_7164.html',
    'http://www.9chengming.com/m/apparel_46.html',
    'http://www.9chengming.com/m/jewelry_48.html',
    'http://www.9chengming.com/m/case/1.html',
    'http://www.9chengming.com/m/case/2.html',
    'http://www.9chengming.com/m/case/3.html',
    'http://www.9chengming.com/m/case/3.html',
    'http://www.9chengming.com/m/news/1.html',
    'http://www.9chengming.com/m/news/2.html',
    'http://www.9chengming.com/m/news/3.html',
    'http://www.9chengming.com/m/news/4.html',
    'http://www.9chengming.com/m/news/5.html',
    'http://www.9chengming.com/m/news/6.html',
    'http://www.9chengming.com/m/news/7.html',
    'http://www.9chengming.com/m/news/8.html',
    'http://www.9chengming.com/m/news/9.html',
    'http://www.9chengming.com/m/news/10.html',
    'http://www.9chengming.com/m/news/11.html',
    'http://www.9chengming.com/m/news/12.html',
    'http://www.9chengming.com/m/news/13.html',
    'http://www.9chengming.com/m/news/14.html',
    'http://www.9chengming.com/m/news/15.html',
    'http://www.9chengming.com/m/news/16.html',
    'http://www.9chengming.com/m/news/17.html',
    'http://www.9chengming.com/m/news/18.html',
    'http://www.9chengming.com/m/news/19.html',
    'http://www.9chengming.com/m/news/20.html',
    'http://www.9chengming.com/m/news/21.html',
    'http://www.9chengming.com/m/news/22.html',
    'http://www.9chengming.com/m/news/23.html',
    'http://www.9chengming.com/m/news/24.html',
    'http://www.9chengming.com/m/news/25.html',
    'http://www.9chengming.com/m/news/26.html',
    'http://www.9chengming.com/m/news/27.html',
    'http://www.9chengming.com/m/news/28.html',
);
$api = 'http://data.zz.baidu.com/urls?site=www.9chengming.com&token=lRtVIaOm8El08Rym';
$ch = curl_init();
$options =  array(
    CURLOPT_URL => $api,
    CURLOPT_POST => true,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POSTFIELDS => implode("\n", $urls),
    CURLOPT_HTTPHEADER => array('Content-Type: text/plain'),
);
curl_setopt_array($ch, $options);
$result = curl_exec($ch);
echo $result;
	}
	
	
	//导出
	public function dc(){
//需要修改3个地方 $j页数，$url地址，$filename文件名称
set_time_limit(0);
header('Content-type:text/html;charset=utf-8');
require_once(dirname(__FILE__).'/QueryList/QueryList.class.php');



   
$login_url = 'http://login.jiayuan.com/';//登录页地址   
$login_urls = 'https://passport.jiayuan.com/dologin.php';//登录提交页面   
$get_url = 'http://www.jiayuan.com/138465005'; //我的帖子   
$cookie_file = dirname(__FILE__) . '/cookie.txt';
  
$post_fields = array();
//用户名和密码，必须填写   
$post_fields['name'] = '1228192021@qq.com';   
$post_fields['password'] = 'cheneylv123456';   
//安全提问   
$post_fields['ljg_login'] = 1;   
$post_fields['m_p_l'] = '1';
$post_fields['channel'] = '0';
$post_fields['position'] = '0';


  
//获取表单FORMHASH   
$ch = curl_init($login_url);   
curl_setopt($ch, CURLOPT_HEADER, 0);   
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);   
$contents = curl_exec($ch);   
curl_close($ch);   

preg_match('/<input\s*type="hidden"\s*name="_s_x_id"\s*value="(.*?)"\s*\/>/i', $contents, $matches);   
if(!empty($matches)) {   
    $formhash = $matches[1];   
} else {   
    die('Not found the forumhash.');   
}   
$post_fields['_s_x_id'] = $formhash;
  
//POST数据，获取COOKIE   
$ch = curl_init($login_url);   
curl_setopt($ch, CURLOPT_HEADER, 0);   
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);   
curl_setopt($ch, CURLOPT_POST, 1);   
curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file);   
curl_exec($ch);   
curl_close($ch);



//带着上面得到的COOKIE获取需要登录后才能查看的页面内容   
$ch = curl_init($get_url);   
curl_setopt($ch, CURLOPT_HEADER, 0);   
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 0);   
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file);   
$contents = curl_exec($ch);   
curl_close($ch);   
  
var_dump($contents);
exit;






























$url = "http://www.jiayuan.com/138465005";
$reg = array(
	"name"=>array(".member_info_r h4","html"),//名字
	"ages"=>array(".member_name","html"),//年龄，来自
	"qingkuang"=>array(".member_info_list","html"),//基本信息
	"zwjs"=>array(".js_text","html"),//自我介绍
	"DNA"=>array(".zl_DNA_a","html"),//爱情DNA
	"zoyq"=>array(".js_list:eq(0)","html"),//择偶要求
	"shfs"=>array(".js_box:eq(1)","html"),//生活方式
	"jjsl"=>array(".js_box:eq(2)","html"),//经济实力
	"gzxx"=>array(".js_box:eq(3)","html"),//工作学习
	"hygn"=>array(".js_box:eq(4)","html")//婚姻观念
);
$rang = "";
$hj = QueryList::Query($url,$reg,$rang,'curl','utf-8');
$arr = $hj->jsonArr;
print_r($arr);
unset($arr);
exit;
	
	for ($j =$_GET['str']; $j <=$_GET['end']; $j++) 
	{
		$url = "http://caigou.makepolo.com/scw.php?q=".urlencode($_GET['words'])."&search_flag=q1&ae=guangdong&pg=".$j;
		$reg = array("url"=>array(".h_com_list .h_com_info h3 a","href"));
		$rang = "ul.corp_info";
		$hj = QueryList::Query($url,$reg,$rang,'curl','utf-8');
		$arr = $hj->jsonArr;
		for ($i = 0;  $i< count($arr); $i++) 
		{
			$url = $arr[$i]['url']."/corp/corp.html";
			$regs = array(
					"title"=>array(".company_names h1","html"),
					"url"=>array("#menu_select a","href"),
					"dizhi"=>array(".base_info:eq(0) ul li:eq(2)","html"),
					"faren"=>array(".base_info:eq(0) ul li:eq(1)","html"),
					"chengli"=>array(".base_info:eq(1) ul li:eq(0)","html"),
					"lianxiren"=>array(".com_messages span:eq(1)","html"),
					"qq"=>array(".qq_shou a:eq(0)","href"),
					"dianhui"=>array(".com_messages span:eq(3)","html")
					);
			$hj = QueryList::Query($url,$regs);
			$tmps_p= $hj->jsonArr;
			$arrd[]= $tmps_p;
		}
		unset($arr);
		unset($tmps_p);
	}
	
//分页开始
error_reporting(E_ALL);
date_default_timezone_set('Asia/Shanghai');
require_once dirname(__FILE__).'/PHPExcel/Classes/PHPExcel.php';

$objPHPExcel=new PHPExcel();
$objPHPExcel->getProperties()->setCreator('http://www.zomsky.com')
        ->setLastModifiedBy('http://www.zomsky.com')
        ->setTitle('Office 2007 XLSX Document')
        ->setSubject('Office 2007 XLSX Document')
        ->setDescription('Document for Office 2007 XLSX, generated using PHP classes.')
        ->setKeywords('office 2007 openxml php')
        ->setCategory('Result file');
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1','公司名称')
            ->setCellValue('B1','法人')
            ->setCellValue('C1','联系电话')
            ->setCellValue('D1','成立时间')
            ->setCellValue('E1','qq')
            ->setCellValue('F1','地址')
            ->setCellValue('G1','链接地址');
$i=2;
foreach($arrd as $x=>$y){
	foreach($y as $k=>$v){
		if (stristr($v['faren'],$v['lianxiren']) && $v['dianhui'])
		{
 $objPHPExcel->setActiveSheetIndex(0)
	->setCellValue('A'.$i,$v['title'])
	->setCellValue('B'.$i,$v['lianxiren'])
	->setCellValue('C'.$i,$v['dianhui'])
	->setCellValue('D'.$i,$v['chengli'])
	->setCellValue('E'.$i,$v['qq'])
	->setCellValue('F'.$i,$v['dizhi'])
	->setCellValue('G'.$i,$v['url']);
 $i++;
		}
	}
}
$objPHPExcel->setActiveSheetIndex(0);
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="'.$filename.'.xls"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
unset($arrd);
unset($objPHPExcel);
unset($objWriter);
exit;
	}
	
}
?>