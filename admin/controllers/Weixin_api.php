<?php

// define ( 'TOKEN', 'qwert' );
class Weixin_api extends CI_Controller {

    public $wxsite;

    // 构造函数
    function __construct() {
        parent::__construct();
        $this->load->model(array(
            'wxback_model',
            'wxuser_model',
            'wxset_model',
            'member_model'
        ));
        
        $this->wxsite = $this->wxset_model->get_wxset();
    }

    // 默认url链接
    public function api() {
        if (isset($_GET['echostr'])) {
            $this->valid();
        } else {
            $this->responseMsg();
        }
    }

    // 响应消息
    // responseMsg()
    public function responseMsg() {
        // 1、接收XML数据包
        $postData = $GLOBALS[HTTP_RAW_POST_DATA];
        // 注意：这个需要设置成全局变量
        // 2、处理XML数据包
        $xmlObj = simplexml_load_string($postData, "SimpleXMLElement", LIBXML_NOCDATA);

        $toUserName = $xmlObj->ToUserName;
        // 获取开发者微信号
        $fromUserName = $xmlObj->FromUserName;
        // 获取用户的OpenID
        $msgType = $xmlObj->MsgType;
        // 消息的类型
        // 根据消息类型来进行业务处理
        switch ($msgType) {
            case 'event':
                // 接收事件推送
                echo $this->receiveEvent($xmlObj);
                break;

            case 'text':
                // 接收文本消息
                echo $this->receiveText($xmlObj);
                break;

            case 'image':
                // 接收图片消息
                echo $this->receiveImage($xmlObj);
                break;

            case 'location':
                // 接收图片消息
                echo $this->receivelocation($xmlObj);
                break;

            default:
                break;
        }
    }

    // 接收事件推送
    public function receiveEvent($obj) {
        switch ($obj->Event) {
            // 接收关注事件
            case 'subscribe':

                $ehckinfo = $this->wxuser_model->get_wxuserbyopenid($obj->FromUserName);

                if (empty($ehckinfo)) {
                    $arr['username'] = $obj->FromUserName;
                    $arr['phone'] = '';
                    $arr['address'] = '';
                    $arr['password'] = md5($obj->FromUserName);
                    $arr['email'] = '';
                    $arr['creattime'] = time();
//                     $arr['is_bang'] = 1;

                    $arr['score'] = 0;
                    $arr['logintime'] = time();
                    $arr['logo'] = '';
                    $arr['loginip'] = '';
                    $arr['group'] = 10;

                    $userinfo = $this->getuserinfo($this->obj->FromUserName);
                    if (!empty($userinfo)) {
                        $arr['username'] = $userinfo['nickname'];
                        $arr['logo'] = $userinfo['headimgurl'];
                    }

                    $query = $this->member_model->insert($arr);


                    $uid = $this->db->insert_id();
                    $data['uid'] = $uid;
                    $data['openid'] = $obj->FromUserName;

                    $data['is_bang'] = 1;

                    $this->wxuser_model->insert($data);

                    $replyContent = "终于等到你。\n 欢迎您关注！";
                } else {
                    $data = array();
                    $data['is_bang'] = 1;
                    $this->wxuser_model->updatebyopenid($data, $obj->FromUserName);
                    $replyContent = '欢迎回来!';
                }
                return $this->replyText($obj, $replyContent);

                break;
            // 接收取消关注事件
            case 'unsubscribe':
                // 账号的解绑
                $tempinfo = $this->wxuser_model->get_wxuserbyopenid($obj->FromUserName);

                if (empty($tempinfo)) {
                    echo '';
                    exit;
                }

                $data['access_token'] = '';
                $data['expires_in'] = '0';
                $data['refresh_token'] = '';
                $data['is_bang'] = 0;
                $this->wxuser_model->updatebyopenid($data, $obj->FromUserName);

                echo '';
                break;
            default:
                // code...
                break;
        }
    }

    // 接收文本消息
    public function receiveText($obj) {
        $content = trim($obj->Content);
        // 获取文本消息的内容
        // 关键字回复

        $rearr = $this->wxback_model->get_wxbackbycode($content);

        if ($rearr) {
            switch ($rearr['msgtype']) {
                case 1:
                    if (!empty($rearr['values'])) {

                        $newcontent = unserialize($rearr['values']);

                        if (isset($newcontent['lj_link'])) {
                            $links = $newcontent['lj_link'];
                            $string = '<a href="' . $links . '">' . $newcontent['lj_title'] . '</a>';
                            return $this->replyText($obj, $string);
                        }
                    }
                    break;
                case 2:
                    return $this->replyText($obj, $rearr['values']);
                    break;
                case 3:
                    if (!empty($rearr['values'])) {
                        $newcontent = unserialize($rearr['values']); // biaoti miaoshu
                        $newsArr = $newcontent;
                        return $this->replyNews($obj, $newsArr);
                    }
                    break;
                default:
                    return $this->replyText($obj, $rearr['msgtype']);
                    break;
            }
        } else {
            return $this->replyText($obj, $content);
        }
    }

    // 接收图片消息
    public function receiveImage($obj) {
        $picUrl = $obj->PicUrl;
        // 获取图片的URL
        $mediaId = $obj->MediaId;
        // 获取图片消息媒体id
        $picArr = array(
            'picUrl' => $picUrl,
            'mediaId' => $mediaId
        );
        return $this->replyImage($obj, $picArr);

        // return $this->replyText($obj,$mediaId);
    }

    // 地址处理方法
    public function receiveLocation($obj) {
        $latitude = $obj->Location_X;
        $longitude = $obj->Location_Y;
        // 获取文本消息的内容
        $content = "你的纬度是{$latitude},经度是{$longitude},我已经锁定！";
        return $this->replyText($obj, $content);
    }

    //从微信上 获取用户信息
    public function getuserinfo($openid) {
        $url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=" . $this->wxsite['access_token'] . "&openid=" . $openid . "&lang=zh_CN";
        $result = $this->https_request($url);

        if (isset($result['errcode'])) {
            if ($result['errcode'] == 0) {
                return $result;
            } else {
                return null;
            }
        } else {
            return $result;
        }
    }

    //https请求(GET和POST) CURL
    public function https_request($url, $data = null) {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //将页面以文件流的形式保存

        if (!empty($data)) {
            curl_setopt($ch, CURLOPT_POST, 1); //模拟POST请求

            curl_setopt($ch, CURLOPT_POSTFIELDS, $data); //POST提交内容
        }
        $outopt = curl_exec($ch);

        curl_close($ch);

        return json_decode($outopt, true); //返回数组结果
    }

    //--------------------微信数据返回 公用方法------------------------
    // 回复文本消息
    public function replyText($obj, $content) {
        // 回复文本消息
        $replyTextMsg = "<xml>
								<ToUserName><![CDATA[%s]]></ToUserName>
								<FromUserName><![CDATA[%s]]></FromUserName>
								<CreateTime>%s</CreateTime>
								<MsgType><![CDATA[text]]></MsgType>
								<Content><![CDATA[%s]]></Content>
							</xml>";
        return sprintf($replyTextMsg, $obj->FromUserName, $obj->ToUserName, time(), $content);
    }

    // 回复图文消息
    public function replyNews($obj, $newsArr) {
        $itemStr = "";
        if (is_array($newsArr)) {

            foreach ($newsArr as $item) {
                $itemTmpl = "<item>
									<Title><![CDATA[%s]]></Title>
									<Description><![CDATA[%s]]></Description>
									<PicUrl><![CDATA[%s]]></PicUrl>
									<Url><![CDATA[%s]]></Url>
							</item>";
                $itemStr .= sprintf($itemTmpl, $item['Title'], $item['Description'], $item['PicUrl'], $item['Url']);
            }
            $replyNewsMsg = "<xml>
									<ToUserName><![CDATA[%s]]></ToUserName>
									<FromUserName><![CDATA[%s]]></FromUserName>
									<CreateTime>%s</CreateTime>
									<MsgType><![CDATA[news]]></MsgType>
									<ArticleCount>%s</ArticleCount>
									<Articles>" . $itemStr . "</Articles>
								</xml> ";

            return sprintf($replyNewsMsg, $obj->FromUserName, $obj->ToUserName, time(), count($newsArr));
        }
    }

    // 回复图片消息
    public function replyImage($obj, $array) {
        // 回复图片消息
        $replyImageMsg = "<xml>
								<ToUserName><![CDATA[%s]]></ToUserName>
								<FromUserName><![CDATA[%s]]></FromUserName>
								<CreateTime>%s</CreateTime>
								<MsgType><![CDATA[image]]></MsgType>
								<Image>
									<MediaId><![CDATA[%s]]></MediaId>
								</Image>
							</xml>";
        return sprintf($replyImageMsg, $obj->FromUserName, $obj->ToUserName, time(), $array['mediaId']);
    }

    //-----------------------微信url 验证---------------------------
    // 验证消息
    public function valid() {
        if ($this->checkSignature()) {
            echo $_GET['echostr'];
        } else {
            echo "Error";
        }
    }

    // 检验微信加密签名Signature
    private function checkSignature() {
        $signature = $_GET['signature'];
        // 微信加密签名
        $timestamp = $_GET['timestamp'];
        // 时间戳
        $nonce = $_GET['nonce'];
        // 随机数
        // 2、加密/校验
        // 1. 将token、timestamp、nonce三个参数进行字典序排序；
        // $this->config->load('wxsite');
        // $wx = $this->config->item('wechat');

        $token = $this->wxsite['token'];

        $tmpArr = array(
            $token,
            $timestamp,
            $nonce
        );
        sort($tmpArr, SORT_STRING);

        // 2. 将三个参数字符串拼接成一个字符串进行sha1加密；
        $tmpStr = implode($tmpArr);
        $tmpStr = sha1($tmpStr);

        // 3. 开发者获得加密后的字符串与signature对比。
        if ($tmpStr == $signature) {
            return true;
        } else {
            return false;
        }
    }

}
