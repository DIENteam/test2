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
      $this->postProcess_check();
    }
  }

  //created by myself_stop
  protected function postProcess_check() {
    $userModel = new \MyApp\Model\User();
    if(isset($_POST['adv_id_num'])){
      $num = $_POST['adv_id_num'];
    }
    if(isset($_POST['accept'])){
      $userModel->flag_insert_accept($num);
    }else if(isset($_POST['reject'])){
      $userModel->flag_insert_reject($num);
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
