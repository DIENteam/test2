<?php

// ユーザーの一覧

require_once(__DIR__ . '/../config/config.php');

// var_dump($_SESSION['me']);

$app = new MyApp\Controller\Manage();

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
      <?= h($app->me()->email); ?> <input type="submit" value="Log Out">
      <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
    </form>
    <h1>Users <span class="fs12">(<?= count($app->getValues()->users); ?>)</span></h1>
    <ul>
      <?php foreach ($app->getValues()->users as $user) : ?>
        <li><?= h($user->email); ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
    <!-- ここから利用許可 -->
    <h1>Sentences Permission <span class="fs12">(<?= count($app->getValues()->adv); ?>)</span></h1>
    <table>
      <tr><td>adv_id</td><td>u_id</td><td>title</td><td>body</td><td>ad_time</td><td>flag</td></tr>
      <?php foreach ($app->getValues()->adv as $adv) : ?>
      <tr>
        <td><?= h($adv->adv_id); ?></td>
        <td><?= h($adv->u_id); ?></td>
        <td><?= h($adv->title); ?></td>
        <td><?= h($adv->body); ?></td>
        <td><?= h($adv->ad_time); ?></td>
        <td><?= h($adv->flag); ?></td>
        <td><form action="" method="POST" id="selection">
          <input type="hidden" name="adv_id_num" value="<?= h($adv->adv_id); ?>">
          <input type="submit" name="accept" value="承認">
          <input type="submit" name="reject" value="拒否">
        </form></td>
      </tr>
      <?php endforeach; ?>
    </table>
</body>
</html>
