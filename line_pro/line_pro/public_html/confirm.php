<?php

// ユーザーの一覧

require_once(__DIR__ . '/../config/config.php');

// var_dump($_SESSION['me']);

$app = new MyApp\Controller\Index();

$app->run();

// $app->me()
// $app->getValues()->users

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>送信確認</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <div id="container">
    <form action="logout.php" method="post" id="logout">
      <?= h($app->me()->email); ?> <input type="submit" value="ログアウト">
      <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
    </form>
    </ul>
    <h1>入力内容を送信しました</h1>
    <p>メッセージは承認後、LINEBOT上に表示されます。</p>
    <p><a href="index.php">戻る</a></p>
  </div>
</body>
</html>
