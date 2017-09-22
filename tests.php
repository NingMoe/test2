<?php
header('Content-Type:text/html;charset=utf-8');
define('IN_ECS', true);
include('includes/cls_mysql.php');
class sqlsrv{
    var $error_log = array();
    var $sql_log = array();
    var $query_id;
    var $num_rows;
    var $conn;
    //connection
    function sqlsrv($server, $user, $pass, $dbname) {
        $this->conn = @sqlsrv_connect($server, array('UID' => $user ,'PWD'=> $pass, 'Database' => $dbname));
        if($this->conn === false) {
            $this->error_log[] = sqlsrv_errors();
            die();
        }
    }
    //query source
    function query($sql){
        $stmt = sqlsrv_query($this->conn, $sql);
        $this->sql_log[] = $sql;
        if($stmt === false) {
            $this->error_log[] = sqlsrv_errors();
        } else {
            $this->query_id = $stmt;
            $this->num_rows = $this->affectedRows();
        }
    }
    //fetch data
    function fetch_all($sql) {
        $this->query($sql);
        $data = array();
        while($row = @sqlsrv_fetch_array($this->query_id, SQLSRV_FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }
    // $DB->count(select   *   from  users)
    function fetch_one($sql){
   
        $this->query($sql);
        return  sqlsrv_fetch_array($this->query_id, SQLSRV_FETCH_ASSOC);
   
    }
    // $DB->count(select   count(*)   from  users)
    function count($sql){
   
        $count=$this->fetch_one($sql);
        return $count[""];
   
    }
    function affectedRows() {
        return ($this->query_id) ? @sqlsrv_num_rows($this->query_id) : false;
    }
}
$conn=new  sqlsrv("(local)","sa","Zhidasql1234","gzzd");
$db_host='localhost:3306';
$db_database='zhida';
$db_username='root';
$db_password='root';
$db_charset='utf8';
$db = new cls_mysql($db_host, $db_username, $db_password, $db_database, $db_charset);

// $sql = "update [gzzd].[dbo].[Fabric] set FabricName='GLITZ-25C' where GlobGID='3786'";
// $sql = "update [gzzd].[dbo].[Fabric] set IsAttestation=0 where Atype='10'";
// $sql = "delete from [gzzd].[dbo].[Fabric] where GlobGID in ('3714','3760','3759','3758','3757','3756','3755','3754','3753','3752','3751','3750','3601','3713','3712','3711','3710','3709','3708','3707','3716','3715','3706','3705','3704','3703','3702','3701','3700','3699','3698','3697','3749','3748','3747','3746','3745','3744','3743','3742','3741','3740','3739','3738','3737','3726','3725','3724','3723','3722')";
// // $sql = "update [gzzd].[dbo].[Fabric] set IsAttestation=1 where GlobGID in ('2529','2607','2616','2620','2621','2633','2637','2653','2669','2671','2673','2676','2680','2686','2690','2695','2701','3581','3585','3601')";
// $sql = "update [gzzd].[dbo].[Fabric] set IsAttestation=1 where GlobGID in ('2529','2607','2616','2620','2621','2633','2637','2653','2669','2671','2673','2676','2680','2686','2690','2695','2701','3581','3585','3601')";
// $baibs=$conn->query($sql);
// print_r($conn->error_log);
// print_r($baibs);
// exit;
// 6605,6625,6626,6627,6628,6629,6630,6631,6632,6633,6634,6635,6509,6606,6607,6608,6609,6610,6611,6612,6613,6614,6615,6616,6617,6618,6619,6620,6621,6622,6623,6624,6636,6637,6638,6639,6640,6641,6642,6643,6644,6645,6646,6647,6648,6649,6650,6651,6652,6653


// $sql = 'SELECT [Gid],[GlobGID] FROM [gzzd].[dbo].[Fabric]';
// $sql = "SELECT [Gid],[GlobGID],[FabricGraphiPath] FROM [gzzd].[dbo].[Fabric] where IsAttestation='1'";
// $sql = "SELECT [GlobGID],[TrueFabricShowGraphiPath] FROM [gzzd].[dbo].[Fabric] where TrueFabricShowGraphiPath like '%Fabrics%'";
// $sql = "SELECT [Gid],[GlobGID] FROM [gzzd].[dbo].[Fabric] where GlobGID in ('3168','3169','3170','3171','3172','3173','3174','3367','3429','3697','3698','3699','3700','3701','3702','3703','3704','3705','3706','3707','3708','3709','3710','3711','3712','3713','3714','3715','3716','3717','3718','3719','3720','3721','3722','3723','3724','3725','3726','3727','3728','3729','3730','3731','3732','3733','3734','3735','3736','3737','3738','3739','3740','3741','3742','3743','3744','3745','3746','3747','3748','3749','3750','3751','3752','3753','3754','3755','3756','3757','3758','3759','3760','3761','3762','3763','3765','3766','3767','3768','3769','3770','3771','3772','3773','3774','3775','3776','3777','3778','3779','3780','3781','3782','3783','3784','3785','3786','3787','3788','3789','3790','3791','3792','3793','3794','3795','3796','3797','3798','3799','3800','3801','3802','3803','3804','3805','3806','3807','3808','3809','3810','3811','3812','3813','3814','3815','3816','3817','3818','3819','3820','3821','3822','3823','3824','3825','3826','3827','3828','3829','3830','3831')";
// $sql = "SELECT [Gid],[GlobGID],[FabricGraphiPath],[TrueFabricShowGraphiPath],[IsAttestation],[FabricName] FROM [gzzd].[dbo].[Fabric] where GlobGID ='3601'";
// // // $sql = "Select GlobGID,count(*) From [gzzd].[dbo].[Fabric] Group By GlobGID Having Count(*) > 1";
// $sql = "Select * From [gzzd].[dbo].[Fabric] where Gid='5658'";
// $baibs=$conn->fetch_all($sql);
// print_r($baibs);exit;
// foreach ($baibs as $key => $value) {
//     $arr.=$value['GlobGID'].',';
// }
// print_r($arr);exit;
// 
// 
// 
// $sql = "SELECT [Gid],[GlobGID] FROM [gzzd].[dbo].[Fabric] where GlobGID in ('3367','3728','3729','3730','3732','3733','3860','3866','3894','3935','4058','4069','4076','4088','4090','4091','4095','4096','4097','4100','4101','4102','4103','4104','4105','4106','4107','4108','4109','4128','4129')";
// $baibs=$conn->fetch_all($sql);
// foreach ($baibs as $key => $value) {
//     $db->query("update hunuo_goods set gid='".$value['Gid']."' where goods_id='".$value['GlobGID']."'");
// }
// print_r('sss');
// exit;

// 精品
// $goods_list=$db->getAll("select goods_id,goods_img from hunuo_goods where is_delete=0 and is_on_sale=1 and is_best=1");
$goods_list=$db->getAll("select goods_id,goods_img from hunuo_goods where gid=''");
// print_r($goods_list);exit;
// $arr='';
foreach ($goods_list as $key => $value) {
    $arr.=$value['goods_id'].',';
}
print_r($arr);exit;


//匹配是否一致
$goods_list=$db->getAll("select goods_id,gid from hunuo_goods where gid<>0 order by goods_id desc limit 4000,1000");
foreach ($goods_list as $key => $value) {
    $sql = "Select Gid From [gzzd].[dbo].[Fabric] where GlobGID='$value[goods_id]'";
    $baibs=$conn->fetch_one($sql);
    if($value['gid']!=$baibs['Gid']){
        $db->query("update hunuo_goods set gid='$baibs[Gid]' where goods_id= '$value[goods_id]'");
        echo $value['goods_id'].'  '.$value['gid'].'  '.$baibs['Gid']."<br>";
    }
}
exit;









// 插入白布
// $goods_list=$db->getAll("select goods_id,goods_sn,goods_img from hunuo_goods where is_delete=0 and is_on_sale=1 order by goods_id asc limit 3000,1000");
// $goods_list=$db->getAll("select goods_id,goods_sn,goods_img from hunuo_goods where is_delete=0 and is_on_sale=1 and gid=0");
$goods_list=$db->getAll("select goods_id,goods_sn,goods_img from hunuo_goods where goods_id in ('3714','3760','3759','3758','3757','3756','3755','3754','3753','3752','3751','3750','3601','3713','3712','3711','3710','3709','3708','3707','3716','3715','3706','3705','3704','3703','3702','3701','3700','3699','3698','3697','3749','3748','3747','3746','3745','3744','3743','3742','3741','3740','3739','3738','3737','3726','3725','3724','3723','3722') and is_best=1");
print_r(($goods_list));exit;
$arr='';
$entname = iconv('UTF-8', 'GBK', '志达纺织');  
$usrname = iconv('UTF-8', 'GBK', '管理员');  
foreach ($goods_list as $key => $value) {
    $value['goods_sn']=iconv('UTF-8', 'GBK', $value['goods_sn']).'.jpg';
    $value['true_goods_img']='D:\WWW/'.$value['goods_img'];
    $value['goods_img']='Fabrics/'.$value['goods_img'];
    $arr.="('$value[goods_img]','$value[goods_img]','$value[goods_sn]','txtDescript',8,'$entname','51maibu',1090,4,1,'$value[goods_id]','sadmin','$usrname','240','240','1200',10010,1400,'$value[true_goods_img]','$value[true_goods_img]'),";
}
$arr=rtrim($arr,',');
$sql = "INSERT INTO [gzzd].[dbo].[Fabric] ([FabricGraphiPath],[FabricShowGraphiPath],[FabricName],[FabricDescript],[UsrGid],[EntName],[EntCode],[FabricKind],[DefaultScale],[IsAttestation],[GlobGID],[UsrCode],[UsrName],[simagewidth],[simageheight],[ColorCode],[UsrLavelCode],[JoinCode],[TrueFabricGraphiPath],[TrueFabricShowGraphiPath]) values $arr";
$conn->query($sql);
print_r($conn->error_log);
exit;

//     $goods_bubs['goods_id']='3696';
//     $goods_bubs['goods_sn']='test.jpg';
// 	$goods_bubs['goods_img']='Fabrics/images/201703/goods_img/3696_G_1488330897931.jpg';
//     // $goods_bubs['goods_img']='Fabrics/'.$goods_bubs['goods_img'];
//     // $days=local_date('Y-m-d H:i:s',$goods_bubs['add_time']);
//     $entname = iconv('UTF-8', 'GBK', '志达纺织');  
//     $usrname = iconv('UTF-8', 'GBK', '管理员');  
//     // $sql = "INSERT INTO [gzzd].[dbo].[Fabric] ([FabricGraphiPath],[FabricShowGraphiPath],[FabricName],[FabricDescript],[UsrGid],[EntName],[EntCode],[FabricKind],[DefaultScale],[IsAttestation],[GlobGID],[UsrCode],[UsrName],[simagewidth],[simageheight],[ColorCode],[UsrLavelCode],[JoinCode],[TrueFabricGraphiPath],[TrueFabricShowGraphiPath]) values ('$goods_bubs[goods_img]','$goods_bubs[goods_img]','$goods_bubs[goods_sn]','txtDescript',8,'$entname','51maibu',1090,4,1,'$goods_bubs[goods_id]','sadmin','$usrname','240','240','1200',10010,1400,'D:\WWW/$goods_bubs[goods_img]','D:\WWW/$goods_bubs[goods_img]')";
//     // $sql = "UPDATE [gzzd].[dbo].[Fabric] set [EntName]='$row2' where [Gid]=3016";
//     $sql = "SELECT count(*) FROM [gzzd].[dbo].[Fabric] where [Gid]=3016";
//     // echo $sql;exit;
//     echo $conn->count($sql);
//     exit;
// echo $conn->query($sql);
// print_r($conn->error_log);
// exit;

// $serverName = "(local)";
// $connectionInfo = array("UID"=>"sa","PWD"=>"Zhidasql1234","Database"=>"gzzd");
// $conn = sqlsrv_connect( $serverName, $connectionInfo);
// if( $conn ){
	// $goods['goods_id']='3696';
	// $goods['goods_sn']='高档割绒双色小格子';
	// $goods['goods_img']='images/201703/goods_img/3696_G_1488330897931.jpg';
	// $days=date('Y-m-d H:i:s',time());
  	// $sql = 'SELECT TOP 1000 [Gid],[FabricGraphiPath],[FabricShowGraphiPath],[FabricName],[FabricDescript],[Atype],[UsrGid],[EntName],[EntCode],[createdate],[FabricKind],[DefaultScale],[IsOneColor],[IsDel],[IsAttestation],[GlobGID],[UsrCode],[UsrName],[simagewidth],[simageheight],[ColorCode],[ColorName],[UsrLavelCode],[UsrLavelName],[JoinCode],[JoinName],[ContextCode],[ContextName],[PublishDate],[IsRecommended],[IsWeixinRecommended],[FlowerSource],[FlowerNo],[IsDesignRecommended],[TrueFabricGraphiPath],[TrueFabricShowGraphiPath],[hxbh] FROM [gzzd].[dbo].[Fabric]';
  	// $sql = "INSERT INTO [gzzd].[dbo].[Fabric] ([FabricGraphiPath],[FabricShowGraphiPath],[FabricName],[FabricDescript],[Atype],[UsrGid],[EntName],[EntCode],[createdate],[FabricKind],[DefaultScale],[IsOneColor],[IsDel],[IsAttestation],[GlobGID],[UsrCode],[UsrName],[simagewidth],[simageheight],[ColorCode],[UsrLavelCode],[JoinCode],[PublishDate],[TrueFabricGraphiPath],[TrueFabricShowGraphiPath]) values ('http://www.zhida.cc/$goods[goods_img]','http://www.zhida.cc/$goods[goods_img]','$goods[goods_sn]','txtDescript',10,8,'志达纺织','51maibu','$days',1090,4,0,0,1,'$goods[goods_id]','sadmin','管理员','240','240','1200',10010,1400,'$days','D:\WWW/$goods[goods_img]','D:\WWW/$goods[goods_img]')";
  	// $sql = "INSERT INTO [gzzd].[dbo].[Fabric] ([FabricGraphiPath]) values ('http://www.zhida.cc/$goods[goods_img]')";
  	

//     $goods_bubs['goods_id']='3696';
//     $goods_bubs['goods_sn']='高档割绒双色小格子';
// 	$goods_bubs['goods_img']='Fabrics/images/201703/goods_img/3696_G_1488330897931.jpg';
//     // $goods_bubs['goods_img']='Fabrics/'.$goods_bubs['goods_img'];
//     // $days=local_date('Y-m-d H:i:s',$goods_bubs['add_time']);
//     $sql = "INSERT INTO [gzzd].[dbo].[Fabric] ([FabricGraphiPath],[FabricShowGraphiPath],[FabricName],[FabricDescript],[UsrGid],[EntName],[EntCode],[FabricKind],[DefaultScale],[IsAttestation],[GlobGID],[UsrCode],[UsrName],[simagewidth],[simageheight],[ColorCode],[UsrLavelCode],[JoinCode],[TrueFabricGraphiPath],[TrueFabricShowGraphiPath]) values ('$goods_bubs[goods_img]','$goods_bubs[goods_img]','$goods_bubs[goods_sn]','txtDescript',8,'志达纺织','51maibu',1090,4,1,'$goods_bubs[goods_id]','sadmin','管理员','240','240','1200',10010,1400,'D:\WWW/$goods_bubs[goods_img]','D:\WWW/$goods_bubs[goods_img]')";
//     // echo $sql;exit;





// 	$res = sqlsrv_query($conn,$sql);
// 	echo $res;
// 	// $test = array();
//  //  	while ($row = sqlsrv_fetch_array($res)){
//  //  		$test[] = $row;
//  //  	}
//  //  	var_dump($test);
// }else{
// 	echo "Connection could not be established.\n";
// 	die( var_dump(sqlsrv_errors()));
// }
// sqlsrv_close( $conn);
?>