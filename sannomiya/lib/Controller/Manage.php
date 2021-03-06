<?php

namespace MyApp\Controller;

class Manage extends \MyApp\Controller {

  public function run() {
    if (!$this->isLoggedIn()) {
      // login
      header('Location: ' . SITE_URL . '/login.php');
    }
    // get users info
    $userModel = new \MyApp\Model\User();
    $this->setValues('users', $userModel->findAll());
    $this->setValues('adv', $userModel->findAll_sentence());
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $this->Output_json();
    }
  }

  //created by myself_stop
  protected function Output_json() {
    $userModel = new \MyApp\Model\User();
    if(isset($_POST['adv_id_num'])){
      $num = $_POST['adv_id_num'];
    }
    if(isset($_POST["accept"])){
      $userModel->flag_update_accept($num);


      //$json_dataでデータ所持
      $json_data = $userModel->get_json($num);
      $now = date('Y-m-d') . "-" . time();
      $filename = "/tmp/file_$now" . ".json";
      file_put_contents($filename, $json_data);
    }else if(isset($_POST["reject"])){
      $userModel->flag_update_reject($num);
    }
    if ($this->hasError()) {
      return;
    } else {
      // redirect to login
      header('Location: ' . SITE_URL . '/manage.php');
      exit;
    }
  }
  //created by myself_stop
}
