<?php

require('config.php');

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>YouTubeAPIを使った検索</title>
</head>
<body>
    <h1>YouTubeAPIを使った検索</h1>
    <?php if ($response === false || isset($response['error'])) { ?>
        動画情報が取得できませんでした。
    <?php } elseif (count($response['items']) == 0) { ?>
        検索結果が0件でした。
    <?php } else { ?>
        <?php foreach ($response['items'] as $item) {
            $img = $item['snippet']['thumbnails']['default']; // 画像情報 (default, medium, highの順で画像が大きくなります)
            $id = $item['id']['videoId'];

            $t = new DateTime($item['snippet']['publishedAt']);
            $t->setTimeZone(new DateTimeZone('Asia/Tokyo'));
            $publishedAt = $t->format('Y/m/d H:i:s'); // 投稿日時 (日本時間)
            ?>
            <!-- <?php echo json_encode($item, JSON_UNESCAPED_UNICODE |  JSON_PRETTY_PRINT) ?> -->
            <a href="https://www.youtube.com/watch?v=<?php eh($id) ?>">
            <img src="<?php eh($img['url']) ?>">
            <?php eh($item['snippet']['title']) ?></a>
            <span class="item-publishedAt"><?php eh($publishedAt) ?></span>
            <hr>
        <?php } ?>
    <?php } ?>
</body>
</html>
