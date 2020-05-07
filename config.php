<?php
define('YOUTUBE_API_KEY', 'AIzaSyCuQ-PrjsH9DhQPM8obEYn1JCS1BTt8608'); // APIキー (Google Developer Consoleから取得したものをセットしてください)

function json_get($url, $query = array(), $assoc = false) { // JSONデータ取得用
    if ($query) $url .= ('?' . http_build_query($query, '', '&', PHP_QUERY_RFC3986));

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url); // URL
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // リクエスト先が https の場合、証明書検証をしない
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); // curl_exec() 経由で応答データを直接取得できるようにする
    curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 5); // 接続タイムアウトの秒数
    $responseString = curl_exec($curl); // 応答データ取得
    curl_close($curl);
    return ($responseString !== false) ? json_decode($responseString, $assoc) : false;
}
function h($value, $encoding = 'UTF-8') { return htmlspecialchars($value, ENT_QUOTES, $encoding); } // HTMlエスケープ出力用
function eh($value, $encoding = 'UTF-8') { echo h($value, $encoding); } // 同上


$response = json_get('https://www.googleapis.com/youtube/v3/search', array(
    'key' => YOUTUBE_API_KEY,
    // 'channelId' => 'UCip8ve30-AoX2y2OtAAmqFA', // チャンネルID (チャンネルで絞り込む場合)
    'q' => 'プログラミング', // 検索キーワード (キーワードで絞り込む場合)
    'part' => 'snippet', // 取得するデータの種類 (タイトルや画像を含める場合はsnippet)
    'order' => 'date', // 日時降順
    'maxResults' => 10, // 検索数 (5～50)
    'type' => 'video', // 結果の種類 (channel,playlist,video)
), true);
?>
