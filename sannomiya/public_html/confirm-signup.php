<?php

// ユーザーの一覧

require_once(__DIR__ . '/../config/config.php');

// var_dump($_SESSION['me']);

$app = new MyApp\Controller\ConfirmSignup();

$app->run();

// $app->me()
// $app->getValues()->users

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>登録確認</title>
  <link rel="stylesheet" href="confirm.css">
</head>
<body>
  <div id="container" class="image">
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <h1>登録が完了しました。</h1>
    <p>下記ページよりログインしてお使いください。</p>
    <p><a href="login.php">ログインページへ</a></p>
  </div>
</body>
</html>
