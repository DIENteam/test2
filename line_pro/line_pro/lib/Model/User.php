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
    $stmt = $this->db->prepare("insert into adv (u_id, title, body, ad_time) values (:u_id, :title, :body, now())");
    $res = $stmt->execute([
      ':title' => $values['title'],
      ':body' => $values['body'],
      ':u_id' => $values['u_id']
    ]);
    if ($res === false) {
      throw new \MyApp\Exception\InvalidSentence();
    }
  }

  public function flag_update_accept($num) {
    $stmt = $this->db->prepare("update adv set flag = 1 where adv_id = $num");
    //if()
    $res = $stmt->execute();
    if ($res === false) {
      //throw new \MyApp\Exception\InvalidSentence();
    }
  }

  public function flag_update_reject($num) {
    $stmt = $this->db->prepare("update adv set flag = 0 where adv_id = $num");
    $res = $stmt->execute();
    //ここで下のif文を通ってしまっている

    if ($res === false) {
      throw new \MyApp\Exception\InvalidInsertFlag();
    }
  }

  public function get_json($num) {
    $stmt = $this->db->prepare("select * from adv where adv_id = $num");
    $stmt->execute();

    $userData = array();

    while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
        $userData[]=array(
        'adv_id'=>$row['adv_id'],
        'u_id'=>$row['u_id'],
        'title'=>$row['title'],
        'body'=>$row['body'],
        'ad_time'=>$row['ad_time'],
        'flag'=>$row['flag']
        );
    }
    //jsonとして出力
    // echo __LINE__;
    // var_dump(json_encode($userData));
    // exit;
    return json_encode($userData);//ここ超不安！！！！！！！！！！！！！
    // header('Content-type: application/json');
    // echo json_encode($userData);
  }

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
