<?php
// $rs = new Hxcall();
// 注册的用户
// $data=array(
//     array('username' => 'qwerasd333','password' => 'qazwsx','nickname' =>'福州3333'),
//     array('username' => 'qwerasd444','password' => 'qazwsx','nickname' =>'福州4444'),
//     );
//echo $rs->hx_register($data);
// 给IM用户的添加好友
// echo $rs->hx_contacts('test2', 'test1');
// 发送文本消息
// echo $rs->hx_send('qwerasd','test3','dfadsr214wefaedf');
// 消息数统计
// echo $rs->hx_msg_count('admin888');
// 获取IM用户[单个]
// echo $rs->hx_user_info('admin888');
// 获取IM用户[批量]
// echo $rs->hx_user_infos('20');
// 删除IM用户[单个]
// echo $rs->hx_user_delete('qwerasd');
// 修改用户昵称
// echo $rs->hx_user_update_nickname('asaxcfasdd','网络科技');
// 重置IM用户密码
// echo $rs->hx_user_update_password('asaxcfasdd','asdad');
// 解除IM用户的好友关系
// echo $rs->hx_contacts_delete('admin888', 'qqqqqqqq');
// 查看好友
//echo $rs->hx_contacts_user('admin888');

class Hxcall
{
    // private $app_key = 'zdfz#zdbf';
    // private $client_id = 'YXA6EXbHIDhDEea_vhF3UkLf9A';
    // private $client_secret = 'YXA6fAKH9idU_zI6UQrpuFWLnF32INc';
    // private $url = "https://a1.easemob.com/zdfz/zdbf";
    private $app_key = '1130170726115984#test';
    private $client_id = 'YXA6zwGAcHHeEeewF00m56PkNw';
    private $client_secret = 'YXA6uEVpIicMaaoNf3CIopC2GECFFpA';
    private $url = "https://a1.easemob.com/1130170726115984/test";
    /*
    * 获取APP管理员Token
    */
    function __construct()
    {
        $url = $this->url . "/token";
        $data = array(
            'grant_type' => 'client_credentials',
            'client_id' => $this->client_id,
            'client_secret' => $this->client_secret
        );
        $rs = json_decode($this->curl($url, $data), true);
        $this->token = $rs['access_token'];
    }
    /*
    * 注册IM用户(授权注册)
    */
    public function hx_register($data)
    {
        $url = $this->url . "/users";
        $header = array(
            'Content-Type: application/json',
            'Authorization: Bearer ' . $this->token
        );
        return $this->curl($url, $data, $header, "POST");
    }
    /*
    * 给IM用户的添加好友
    */
    public function hx_contacts($owner_username, $friend_username)
    {
        $url = $this->url . "/users/${owner_username}/contacts/users/${friend_username}";
        $header = array(
        'Authorization: Bearer ' . $this->token
        );
        return $this->curl($url, "", $header, "POST");
    }
    /*
    * 解除IM用户的好友关系
    */
    public function hx_contacts_delete($owner_username, $friend_username)
    {
        $url = $this->url . "/users/${owner_username}/contacts/users/${friend_username}";
        $header = array(
        'Authorization: Bearer ' . $this->token
        );
        return $this->curl($url, "", $header, "DELETE");
    }
    /*
    * 查看好友
    */
    public function hx_contacts_user($owner_username)
    {
        $url = $this->url . "/users/${owner_username}/contacts/users";
        $header = array(
        'Authorization: Bearer ' . $this->token
        );
        return $this->curl($url, "", $header, "GET");
    }
    /* 发送文本消息 */
    public function hx_send($sender, $receiver, $msg)
    {
        $url = $this->url . "/messages";
        $header = array(
            'Authorization: Bearer ' . $this->token
        );
        $data = array(
            'target_type' => 'users',
            'target' => array(
                '0' => $receiver
            ),
            'msg' => array(
                'type' => "txt",
                'msg' => $msg
            ),
            'from' => $sender,
            'ext' => array(
                'attr1' => 'v1',
                'attr2' => "v2"
            )
        );
        return $this->curl($url, $data, $header, "POST");
    }
    /* 查询离线消息数 获取一个IM用户的离线消息数 */
    public function hx_msg_count($owner_username)
    {
        $url = $this->url . "/users/${owner_username}/offline_msg_count";
        $header = array(
            'Authorization: Bearer ' . $this->token
        );
        return $this->curl($url, "", $header, "GET");
    }
    /*
    * 获取IM用户[单个]
    */
    public function hx_user_info($username)
    {
        $url = $this->url . "/users/${username}";
        $header = array(
            'Authorization: Bearer ' . $this->token
        );
        return $this->curl($url, "", $header, "GET");
    }
    /*
    * 获取IM用户[批量]
    */
    public function hx_user_infos($limit)
    {
        $url = $this->url . "/users?${limit}";
        $header = array(
            'Authorization: Bearer ' . $this->token
        );
        return $this->curl($url, "", $header, "GET");
    }
    /*
    * 重置IM用户密码
    */
    public function hx_user_update_password($username, $newpassword)
    {
        $url = $this->url . "/users/${username}/password";
        $header = array(
            'Authorization: Bearer ' . $this->token
        );
        $data['newpassword'] = $newpassword;
        return $this->curl($url, $data, $header, "PUT");
    }
    /*
    * 删除IM用户[单个]
    */
    public function hx_user_delete($username)
    {
        $url = $this->url . "/users/${username}";
        $header = array(
            'Authorization: Bearer ' . $this->token
        );
        return $this->curl($url, "", $header, "DELETE");
    }
    /*
    * 修改用户昵称
    */
    public function hx_user_update_nickname($username, $nickname)
    {
        $url = $this->url . "/users/${username}";
        $header = array(
            'Authorization: Bearer ' . $this->token
        );
        $data['nickname'] = $nickname;
        return $this->curl($url, $data, $header, "PUT");
    }
    /*
    * curl
    */
    private function curl($url, $data, $header = false, $method = "POST")
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        if ($header){
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        }
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        if ($data){
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        }
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        $ret = curl_exec($ch);
        return $ret;
    }
}