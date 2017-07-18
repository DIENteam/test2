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
  <title>Home</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <div id="container">
    <form action="logout.php" method="post" id="logout">
      <?= h($app->me()->email); ?> <input type="submit" value="ログアウト">
      <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
    </form>
    <h1>入力フォーム</h1>
  </div>
  <div class="main">
    <form action="confirm.php" method="post" id="subm">
      <dl class="profile">
      <dt>タイトル</dt>
        <dd><textarea name="title" cols=40 rows=1></textarea></dd>
      <dt>本文</dt>
        <dd><textarea name="body" cols=40 rows=4></textarea></dd>
      </dl>
      <input type="hidden" name="u_id" value="<?= h($user->id); ?>">
      <input type="submit" value="送信する">
    </form>
  </div>
</body>
</html>
