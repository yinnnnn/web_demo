<?php

echo reponseMsg();
// 接收事件推送并回复
function reponseMsg() {
    //1.获取到微信推送过来post数据（xml格式）
    $postArr = $GLOBALS['HTTP_RAW_POST_DATA'];
    //2.处理消息类型，并设置回复类型和内容
    /* <xml>
      <ToUserName><![CDATA[toUser]]></ToUserName>
      <FromUserName><![CDATA[FromUser]]></FromUserName>
      <CreateTime>123456789</CreateTime>
      <MsgType><![CDATA[event]]></MsgType>
      <Event><![CDATA[subscribe]]></Event>
      </xml> */
    $postObj = simplexml_load_string($postArr);
    //$postObj->ToUserName = '';
    //$postObj->FromUserName = '';
    //$postObj->CreateTime = '';
    //$postObj->MsgType = '';
    //$postObj->Event = '';
    // gh_e79a177814ed
    //判断该数据包是否是订阅的事件推送
    if (strtolower($postObj->MsgType) == 'event') {
        //如果是关注 subscribe 事件
        if (strtolower($postObj->Event == 'subscribe')) {
            //回复用户消息(纯文本格式)	
            $toUser = $postObj->FromUserName;
            $fromUser = $postObj->ToUserName;
            $time = time();
            $msgType = 'text';
            $content = '欢迎关注我们的微信公众账号' . $postObj->FromUserName . '-' . $postObj->ToUserName;
            $template = "<xml>
                        <ToUserName><![CDATA[%s]]></ToUserName>
                        <FromUserName><![CDATA[%s]]></FromUserName>
                        <CreateTime>%s</CreateTime>
                        <MsgType><![CDATA[%s]]></MsgType>
                        <Content><![CDATA[%s]]></Content>
                        </xml>";
            $info = sprintf($template, $toUser, $fromUser, $time, $msgType, $content);
            echo $info;
            /* <xml>
              <ToUserName><![CDATA[toUser]]></ToUserName>
              <FromUserName><![CDATA[fromUser]]></FromUserName>
              <CreateTime>12345678</CreateTime>
              <MsgType><![CDATA[text]]></MsgType>
              <Content><![CDATA[你好]]></Content>
              </xml> */
        }
    }
}
