<?php

// ログイン

require_once(__DIR__ . '/../config/config.php');

$app = new MyApp\Controller\Login();

$app->run();

// echo "login screen";
// exit;

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>ログイン</title>
  <link rel="stylesheet" href="login.css">
</head>
<body>
  <div id="container" class="image">
    <form action="" method="post" id="login">
      <br><br><br><br><br><br><br><br><br><br><br><br><br><br>
      <p>
        <input type="text" name="email" placeholder="メールアドレス" value="<?= isset($app->getValues()->email) ? h($app->getValues()->email) : ''; ?>">
      </p>
      <p>
        <input type="password" name="password" placeholder="パスワード">
      </p>
      <p class="err"><?= h($app->getErrors('login')); ?></p>
      <div class="btn" onclick="document.getElementById('login').submit();">ログイン</div>
      <p class="fs12"><a href="/signup.php">新規登録</a></p>
      <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
    </form>
  </div>
</body>
</html>
