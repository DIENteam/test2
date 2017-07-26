<?php

require_once __DIR__ . '/vendor/autoload.php';

$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient(getenv('CHANNEL_ACCESS_TOKEN'));
$bot = new \LINE\LINEBot($httpClient,['channelSecret' => getenv('CHANNEL_SECRET')]);
$signature = $_SERVER['HTTP_' . \LINE\LINEBot\Constant\HTTPHeader::LINE_SIGNATURE];


try{
    $events = $bot->parseEventRequest(file_get_contents('php://input'), $signature);
} catch(\LINE\LINEBot\Exception\InvalidSignatureException $e) {
    error_log('ParseEventRequest failed. InvalidSignatureException =>'.var_export($e,true));
} catch(\LINE\LINEBot\Exception\UnknownEventTypeException $e) {
    error_log('ParseEventRequest failed. UnknownEventTypeException =>'.var_export($e,true));
} catch(\LINE\LINEBot\Exception\UnknownMessageTypeException $e) {
    error_log('ParseEventRequest failed. UnknownMessageTypeException =>'.var_export($e,true));
} catch(\LINE\LINEBot\Exception\InvalidEventRequestException $e) {
    error_log('ParseEventRequest failed. InvalidEventRequestException =>'.var_export($e,true));
}

foreach ($events as $event) {
    error_log($event->getUserId());
    if (!($event instanceof \LINE\LINEBot\Event\MessageEvent)) {
        error_log('NO MESSAGE EVENT HAS COME');
        continue;
    }
    if (!($event instanceof \LINE\LINEBot\Event\MessageEvent\TextMessage)) {
        error_log('NO TEXT MESSAGE EVENT HAS COME');
        continue;
    }
    $bot->replyText($event->getReplyToken(), $event->getText());
}
