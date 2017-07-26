<?php

// ユーザーの一覧

require_once(__DIR__ . '/../config/config.php');

// var_dump($_SESSION['me']);

$app = new MyApp\Controller\Index();
$app1 = new MyApp\Controller\Manage();

$app->run();

// $app->me()
// $app->getValues()->users
// $user = new \MyApp\Model\User();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>WELCOME-入力フォーム</title>
  <link rel="stylesheet" href="index.css">
</head>
<body>
  <div id="container" class="image">
    <form action="logout.php" method="post" id="logout">
      <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
      <?= h($app->me()->name); ?> <input type="submit" value="ログアウト">
      <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
    </form>
    <h1>入力フォーム</h1>
    <div class="main">
      <form action="confirm.php" method="post" id="subm">
        <dl class="profile">
        <dt>タイトル</dt>
          <dd><textarea name="title" cols=40 rows=1 placeholder="所属・タイトル"></textarea></dd>
        <dt>本文</dt>
          <dd><textarea name="body" cols=40 rows=4 placeholder="本文・連絡先"></textarea></dd>
        </dl>
        <input type="hidden" name="u_id" value="<?= h($app->me()->id);?>">
        <input type="submit" value="送信する">
      </form>
    </div>
  </div>
</body>
</html>
