<?php
// 此文件和其它文件是独立的 , 这是一个简单的微信少吗登录测试DEMO

//-------配置
$AppID = 'wxbdc5610cc59c1631';
$AppSecret = 'd4624c36333337af5443d';
$callback  =  'https%3A%2F%2Fpassport.yhd.com%2Fwechat%2Fcallback.do'; //回调地址

// 微信登录地址
session_start();
//-------生成唯一随机串防CSRF攻击
$state  = md5(uniqid(rand(), TRUE));
$_SESSION["wx_state"]    =   $state; //存到SESSION
//$callback = urlencode($callback);
$wxurl = "https://open.weixin.qq.com/connect/qrconnect?appid=".$AppID."&redirect_uri={$callback}&response_type=code&scope=snsapi_login&state={$state}#wechat_redirect";
header("Location: $wxurl");



// 回调地址
if($_GET['state']!=$_SESSION["wx_state"]){
      exit("5001");
}
$AppID = 'wx33333333334d4';
$AppSecret = 'd4624c363333330547af5443d';
$url='https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$AppID.'&secret='.$AppSecret.'&code='.$_GET['code'].'&grant_type=authorization_code';

$ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_URL, $url);
$json =  curl_exec($ch);
curl_close($ch);

$arr=json_decode($json,1);

//得到 access_token 与 openid
print_r($arr);    

$url='https://api.weixin.qq.com/sns/userinfo?access_token='.$arr['access_token'].'&openid='.$arr['openid'].'&lang=zh_CN';
$ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_URL, $url);
$json =  curl_exec($ch);
curl_close($ch);
$arr=json_decode($json,1);
得到 用户资料
print_r($arr);    