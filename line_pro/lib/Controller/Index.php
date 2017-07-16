<?php

namespace MyApp\Controller;

class Index extends \MyApp\Controller {

  public function run() {
    if (!$this->isLoggedIn()) {
      // login
      header('Location: ' . SITE_URL . '/login.php');
    }
    // get users info
    $userModel = new \MyApp\Model\User();
    $this->setValues('users', $userModel->findAll());
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $this->postProcess();
    }
  }

  //created by myself_stop
  protected function postProcess() {
    $userModel = new \MyApp\Model\User();
    $this->setValues('title', $_POST['title']);
    $this->setValues('body', $_POST['body']);

    if ($this->hasError()) {
      return;
    } else {
      // create user
      try {
        $userModel->create_sentence([
          'title' => $_POST['title'],
          'body' => $_POST['body']
        ]);
      } catch (\MyApp\Exception\InvalidSentence $e) {
        $this->setErrors('title', $e->getMessage());
        return;
      }

      // redirect to login
      header('Location: ' . SITE_URL . '/confirm.php');
      exit;
    }
  }
  //created by myself_stop

}
