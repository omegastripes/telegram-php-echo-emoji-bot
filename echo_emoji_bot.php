<?php

$writeLog = true;
$token = '0123456789:ABCDEFGHIJKLMNOPQRSTUVWXYZABCDEFGHI';
$payload = file_get_contents('php://input');
$data = json_decode($payload, true);
$updId = $data['update_id'];
$chatId = $data['message']['from']['id'];
$text = $data['message']['text'];
logger($updId . chr(9) . $chatId . chr(10) . $text);
echoUpd($chatId, $text);
exit;

function echoUpd($chatId, $text) {
	
	$enc = json_encode($text);
	$src = "php: json_decode('" . $enc . "')";
	$msg = $text . chr(10) . $src;
	botSendMsg($chatId, $msg);
	
}

function botSendMsg($id, $msg) {
	
	global $token;
	$url = 'https://api.telegram.org/bot' . $token . '/sendMessage?chat_id=' . $id . '&text=' . urlencode($msg);
	$data = fetchData($url);
	logger('botSendMsg ' . $msg);
	if(!$data) {
		logger('botSendMsg no data received ' . $url);
	} elseif($data['ok'] != 1) {
		logger('botSendMsg resp nok ' . $url);
	}
	return $data;
	
}

function fetchData($url) {
	
	$resp = file_get_contents($url);
	$data = json_decode($resp, true);
	if(!$data) {
		logger('fetchData no data received ' . $url);
	}
	return $data;
	
}

function logger($message) {
	
	global $writeLog;
	if($writeLog) {
		$filename = dirname(__FILE__) . '/' . basename(__FILE__, '.php') . '.' . date('Y-m-d') . '.log';
		$content = date('Y-m-d H:i:s') . chr(9) . $message . chr(10);
		try {
			file_put_contents($filename, $content, FILE_APPEND);
		} catch(Exception $e) {
			echo 'Exception: ' . $e->getMessage() . '<br />\n';
		}
	}
	
}

?>























