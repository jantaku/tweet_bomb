<?php

// OAuthライブラリを読み込む
require_once 'vendor/autoload.php';
use Abraham\TwitterOAuth\TwitterOAuth;

// 認証情報
$consumerKey       = 'gxHEPMOPrzlv0rqdyYFcyUwaP';
$consumerSecret    = '6HIP01tDbfmfsaaefWSQkIccsRB9JyHxmAxbRMtT048UGFXFex';
$accessToken       = '1245750908-usHkqaIbetBAxidLdVizDASonGFHOKJUdMpczyQ';
$accessTokenSecret = 'kYPcY2IeVxlRvVIMXfA3MJp8u02cYRPdQU21YjJhWbqX2';

// 接続
$connection = new TwitterOAuth($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);

// タイムラインを取得
// 対象のユーザIDと取得するツイート数を指定
// スクリーンネームからユーザIDを調べるWebサイト => https://syncer.jp/twitter-screenname-userid-converter
$timeline = $connection->get('statuses/user_timeline', ['user_id' => '', 'count' => ]);

// 連想配列に変換
$timeline = json_decode(json_encode($timeline), true);

// ツイートにいいね
foreach ($timeline as $t) {
    $connection->post('favorites/create', ['id' => $t['id']]);
    sleep(1);
}
?>
