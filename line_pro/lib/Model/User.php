<?php

namespace MyApp\Model;

class User extends \MyApp\Model {

  public function create($values) {
    $stmt = $this->db->prepare("insert into users (email, password, created, modified) values (:email, :password, now(), now())");
    $res = $stmt->execute([
      ':email' => $values['email'],
      ':password' => password_hash($values['password'], PASSWORD_DEFAULT)
    ]);
    if ($res === false) {
      throw new \MyApp\Exception\DuplicateEmail();
    }
  }

  //created by myself_start
  public function create_sentence($values) {
    $stmt = $this->db->prepare("insert into adv (u_id, title, body, ad_time) values (1, :title, :body, now())");
    $res = $stmt->execute([
      ':title' => $values['title'],
      ':body' => $values['body']
    ]);
    if ($res === false) {
      throw new \MyApp\Exception\InvalidSentence();
    }
  }

  public function flag_insert_accept($num) {
    $stmt = $this->db->prepare("insert into adv (flag) values (1) where adv_id == $num");
    //if()
    $res = $stmt->execute();
    if ($res === false) {
      //throw new \MyApp\Exception\InvalidSentence();
    }
  }

  public function flag_insert_reject($num) {
    $stmt = $this->db->prepare("insert into adv (flag) values (0) where adv_id == $num");
    //if()
    $res = $stmt->execute();
    if ($res === false) {
      throw new \MyApp\Exception\InvalidSentence();
    }
  }

  public function check_sentence($values) {
    $stmt = $this->db->prepare("select adv_id, u_id, title, body, ad_time, flag from adv");
    $stmt->execute([
      ':adv_id' => $values['adv_id'],
      ':u_id' => $values['u_id'],
      ':title' => $values['title'],
      ':body' => $values['body'],
      ':ad_time' => $values['ad_time'],
      ':flag' => $values['flag']
    ]);
  }
  //created by myself_stop

  public function login($values) {
    $stmt = $this->db->prepare("select * from users where email = :email");
    $stmt->execute([
      ':email' => $values['email']
    ]);
    $stmt->setFetchMode(\PDO::FETCH_CLASS, 'stdClass');
    $user = $stmt->fetch();

    if (empty($user)) {
      throw new \MyApp\Exception\UnmatchEmailOrPassword();
    }

    if (!password_verify($values['password'], $user->password)) {
      throw new \MyApp\Exception\UnmatchEmailOrPassword();
    }

    return $user;
  }

  public function findAll() {
    $stmt = $this->db->query("select * from users order by id");
    $stmt->setFetchMode(\PDO::FETCH_CLASS, 'stdClass');
    return $stmt->fetchAll();
  }

  public function findAll_sentence() {
    $stmt = $this->db->query("select * from adv");
    $stmt->setFetchMode(\PDO::FETCH_CLASS, 'stdClass');
    return $stmt->fetchAll();
  }
}
