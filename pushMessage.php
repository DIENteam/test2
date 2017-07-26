<?php

require_once __DIR__ . '/vendor/autoload.php';
$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient(getenv('CHANNEL_ACCESS_TOKEN'));
$bot = new \LINE\LINEBot($httpClient,['channelSecret' => getenv('CHANNEL_SECRET')]);

$userId = 'Ufa6f7c5dc4917020610149feb9b2b424';
// $message = 'Hello Push API';
$db = new \PDO('mysql:host=us-cdbr-iron-east-03.cleardb.net;dbname=heroku_2bc58d930f89601;charset=utf8', 'b964721f74c983', '92fe3ff7');

  $stmt = $db->prepare("select * from adv where flag = 1");
  $stmt->execute();
  $message = array();

  while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
      $message[]=array(
        'title'=>$row['title'],
        'body'=>$row['body']
      );
  }

  $result = '';
  foreach ($message as $key => $value) {
    foreach ($message[$key] as $k => $v){
      if($k=='title') $result .="タイトル：";
      $result .= $message[$key][$k];
      if($k=='title') $result .="\n\n";
    }
    $response = $bot->pushMessage($userId,new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($result));
    if(!$response->isSucceeded()){
      error_log('Failed!' . $response->getHTTPStatus . ' ' . $response->getRawBody());
    }
    $result = '';
  }
  $stmt = $db->prepare("update adv set flag = 2 where flag = 1");
  $stmt->execute();
  exit;
