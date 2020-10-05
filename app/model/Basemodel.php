<?php


class BaseModel {
  use Nette\SmartObject;

  /**
   * @var
   */
  public $data;
  /**
   * @var
   */
  public $id_user;
  /**
   * @var
   */
  public $id_entit;

  public $table;
  /**
   * @var
   */
  public $primary;
  /**
   * @var string
   */
  public $defaultLang = 'cs';
  /**
   * @var string
   */
  public $prefixTable = '';

  /** @var Nette\Database\Context @inject */
  public $db;

  public $CompModel;

  /**
   *
   * @var Nette\DI\Container
   */
  public $container;

  /**
   * BaseModel constructor.
   * @param \Nette\Database\Context $database
   * @param \Nette\DI\Container $container
   */
  public function __construct(\Nette\Database\Context $database, Nette\DI\Container $container) {
    $this->db = $database;
    $this->container = $container;
  }
  /**
   * @param $values
   * @throws Exception
   */
  public function insert($values, $table = null){

      $table = $table ? $table : $this->table;
      $a = $this->db->table($table)->insert($values);
      if(!$a) {
        throw new Exception("Vložení dat do db se nepovedlo");
      }
      return $a;
    }

  /**
   * @param $values
   * @throws Exception
   */
  public function update($values, $id = null, $last_mod = false, $table = null){
    $id = $id ? $id : $this->id_entit;
    $table = $table ? $table : $this->table;
    if($last_mod) {
      $values->last_mod = new Nette\Utils\DateTime();
    }
    $this->db->table($table)->get($id)->update($values);
  }

  public function delete($table = null, $id = null){
    $id = $id ? $id : $this->id_entit;
    $table = $table ? $table : $this->table;
    if(!$this->db->table($table)->get($id)->delete('*') ) {
      throw new Exception("Odstranění dat se nepovedlo");
    }
  }

  public function getRow($table = null, $id = null){
    if(!$table) {$table = $this->table;}
    $id = $id ? $id : $this->id_entit;
    $result = $this->db->table($table)->get($id);
    if(!$result)  {
      throw new Exception("Získání dat z Db se nepovedlo");
    }
    return $result;
  }

  public function initId_user($id){
    $this->id_user = $id;
  }

  public function getId_user(){
    return $this->id_user;
  }

  public function initIdEntit($id){
    $this->id_entit = $id;
  }

  public function getIdEntit(){
    return $this->id_entit;
  }

  public function getColumnNames($table) {
    $result =  $this->db->query('SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = N\''.$table.'\'')->fetchAll();
    $names = array();
    foreach ($result as $r) {
      $names[] = $r->COLUMN_NAME;
    }
    return $names;
  }



  public function getInputDatetime($timestamp) {
    return date("Y-m-d\T:H:i", $timestamp);

  }
}
