<?php

/**
 * Class UserModel
 */
class UserModel extends BaseModel {
  /**
   * UserModel constructor.
   * @param \Nette\Database\Context $database
   * @param \Nette\DI\Container $container
   */
  public function __construct(Nette\Database\Context $database, Nette\DI\Container $container) {
    parent::__construct($database, $container);
    $this->table = 'user';
  }

  /**
   * @param $data
   * @throws Exception
   */
  public function newUser($data) {

    $this->emailExist($data['email']);
    $data['passwd'] = \Model\Passwords::hash($data['passwd']);
    $this->db->table($this->table)
             ->insert($data);
  }

  public function changePasswd($email, $passwd) {
    $this->db->table($this->table)
             ->where('email = ?', $email)
             ->update(['passwd' => \Model\Passwords::hash($passwd)]);
  }

  /**
   * @param $email
   * @throws Exception
   */
  public function emailExist($email) {
    if ($this->db->table($this->table)
                 ->where('email = ?', $email)
                 ->fetch()) {
      throw new Exception("Zadaný email je již někým používán, zvojte prosím jiný.");
    }
  }

  public function getAllMails() {
    $emails = array();
    $result = $this->db->table($this->table)
                       ->select('email')
                       ->fetchAll();
    foreach ($result as $r) {
      $emails[] = $r->email;
    }
    return $emails;
  }
}