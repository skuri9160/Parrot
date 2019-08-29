<?php
DEFINE("ACCESS_TOKEN","srEsDTuULK9VJ99DbklXd4Rg0aoVtH+U1aqwKcYrjg5kVGXtzJC4xZ/MN6iHqN6qXTTs6goHAeTnIwFv7dcMcWiQ3NgDiP1GRNO7Zd9SW47CwAL7uWfDi0X50SHBEODEHiC0qzM3ki+wmoGAGAAIdgdB04t89/1O/w1cDnyilFU=");
DEFINE("SECRET_TOKEN","eb6a16a96935ac82207dc092cca715d2");

use \LINE\LINEBot\HTTPClient\CurlHTTPClient;
use \LINE\LINEBot;
use LINE\LINEBot\MessageBuilder\TextMessageBuilder;
use LINE\LINEBot\MessageBuilder\MultiMessageBuilder;
use \LINE\LINEBot\Constant\HTTPHeader;

//LINESDKの読み込み
require_once(__DIR__."/vendor/autoload.php");

//LINEから送られてきたらtrueになる
if(isset($_SERVER["HTTP_".HTTPHeader::LINE_SIGNATURE])){

//LINEBOTにPOSTで送られてきた生データの取得
  $inputData = file_get_contents("php://input");

//LINEBOTSDKの設定
  $httpClient = new CurlHTTPClient(ACCESS_TOKEN);
  $Bot = new LINEBot($HttpClient, ['channelSecret' => SECRET_TOKEN]);
  $signature = $_SERVER["HTTP_".HTTPHeader::LINE_SIGNATURE]; 
  $Events = $Bot->parseEventRequest($InputData, $Signature);

//大量にメッセージが送られると複数分のデータが同時に送られてくるため、foreachをしている。
  foreach($Events as $event){
    
    // $res = $bot->replyMessage($event->getReplyToken(), new TextMessageBuilder('メッセージが来たよ！'));
    // if ($res->isSucceeded()) {
    //   error_log('success!!');
    // } else {
    //   error_log("深刻な返信エラー" . $res->getHTTPStatus() . ' ' . $res->getRawBody());
    // }
  
  
    $SendMessage = new MultiMessageBuilder();
    $TextMessageBuilder = new TextMessageBuilder("よろぽん！");
    $SendMessage->add($TextMessageBuilder);
    $Bot->replyMessage($event->getReplyToken(), $SendMessage);
  }
}