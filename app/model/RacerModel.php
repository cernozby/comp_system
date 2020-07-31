<?php

/**
 * Class RacerModel
 */

class RacerModel extends BaseModel {

  /**
   * RacerModel constructor.
   * @param \Nette\Database\Context $database
   * @param \Nette\DI\Container $container
   */
  public function __construct(Nette\Database\Context $database, Nette\DI\Container $container) {
    parent::__construct($database, $container);
    $this->table = 'racer';
  }

  /**
   * @return array
   */
  public function getRacers( $id = null): array {
    $id = $id ? $id : $this->id_user;
    return $this->db->table($this->table)
                    ->select('*')
                    ->where('user_id = ?', $id)
                    ->fetchAll();
  }

  public function getAllRacers(): array {
    return $this->db->table($this->table)
                    ->select('*')
                    ->order('first_name, last_name')
                    ->fetchAll();
  }

  public function getCountMyRacers() {
    return $this->db->table($this->table)
                    ->where('user_id = ?', $this->id_user)
                    ->count('*');
  }


  /**
   * @return array
   */
  public function yearsForSelect(): array {
    $years = array();
    for ($i = date('Y'); $i > date('Y') - 100; $i--) {
      $years[$i] = $i;
    }
    return $years;
  }
}