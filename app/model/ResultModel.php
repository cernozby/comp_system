<?php

class ResultModel extends BaseModel {


  const DEFAULT_BOULDER_POINTS = 100;
  /**
   * ResultModel constructor.
   * @param \Nette\Database\Context $database
   * @param \Nette\DI\Container $container
   */
  public $CompModel;

  public function __construct(Nette\Database\Context $database, Nette\DI\Container $container) {
    parent::__construct($database, $container);
    $this->CompModel = $container->createService('CompModel');

  }

  public function tableExist($id_cat) {
    return $this->getRow('category', $id_cat)->table_exist;
  }

  public function generateTableName($id_comp, $id_cat) {
    $cat = $this->getRow('category', $id_cat);
    $name = strtr(str_replace(' ', '', (mb_strtolower($id_comp . '_' . trim($cat->name)))), Constants::NO_CZECH_CHAR);
    return $name;
  }

  public function getResultToRender(int $id_comp, int $id_cat): array {
    $tableName = $this->generateTableName($id_comp, $id_cat);
    $cat = $this->getRow('category', $id_cat);
    $array = array();
    $pointsPerBoulder = array();

    //select category
    $sql = 'SELECT * FROM ' . $tableName;
    $result = $this->db->query($sql)
                       ->fetchAll();


    if ($cat->comp_type == 'boulder' && $cat->result_system == 'amatérské') {
      //get array of array of result, key is racer_id
      foreach ($result as $r) {
        foreach ($r as $key => $item) {
          if ($key != 'id_result') {
            $array[$r->racer_id][$key] = (int)$item;
            $pointsPerBoulder[$key] = 0;
          }
        }
      }

      //get count of climbers, which cliimb each top or bonus
      foreach ($array as $a) {
        foreach ($a as $key => $item) {
          if ($item != '0') {
            $pointsPerBoulder[$key]++;
          }
        }
      }

      //get value of each boulder
      foreach ($pointsPerBoulder as $key => $item) {
        $pointsPerBoulder[$key] = self::DEFAULT_BOULDER_POINTS / $item;
      }

      //add sum of point to each racer
      foreach ($array as $key => $item) {
        $points = 0;
        foreach ($item as $k => $result) {
          if ($result != 0 && $k != 'racer_id') {
            $points += $pointsPerBoulder[$k];
          }
        }
        $array[$key]['result'] = round($points, 2);
      }

      $sort = array_column($array, 'result');
      array_multisort($sort, SORT_DESC, $array);

      $array = $this->addPlace($array);

    }
    return $array;
  }

  public function addPlace(array $array ) : array {
    $before_keys = array(); $before_result = null; $i = 0;
    foreach ($array as $key => $item) {
      if ($before_result == $item['result']) {
        $before_keys[] = $key;
        $before_result = $item['result'];
      } else {
        if(count($before_keys) > 1) {
          $i  += count($before_keys) ;
          foreach ($before_keys as $bk) {
            $array[$bk]['place'] = ($i - count($before_keys))  .'. - '. ($i - 1).'. ' ;
          }
          $before_keys = array();
          $before_keys[0]  = $key;
          $before_result = $item['result'];
          $array[$key]['place'] = $i.'.';

        } else {
          $array[$key]['place'] = ++$i.'.';
          $before_result = $item['result'];
          $before_keys[0] = $key;
        }
      }
    }

    return $array;
  }


  public function createTable($id_comp, $id_cat) {
    $cat = $this->getRow('category', $id_cat);
    $name = $this->generateTableName($id_comp, $id_cat);
    $sql = '';

    if ($cat->comp_type == null || $cat->boulder_count == null) {
      throw new Exception('Nejsou vyplnene udaje u kategorie pro zadavani vysledku');
    }

    if ($cat->comp_type == "boulder") {
      $sql .= 'CREATE TABLE IF NOT EXISTS `bozala`.`' . $name . '` ( `id_result` INT(10) NOT NULL AUTO_INCREMENT , `racer_id` INT(10) NOT NULL ,';
      for ($i = 1; $i <= $cat->boulder_count; $i++) {
        $sql .= '`b' . $i . 'z` VARCHAR(10),';
        $sql .= '`b' . $i . 't` VARCHAR(10),';
      }
      $sql .= 'PRIMARY KEY (`id_result`)) ENGINE = InnoDB;';
    }
    return $this->db->query($sql);
  }

  public function prepareTable($id_comp, $id_cat) {
    $this->table = $this->generateTableName($id_comp, $id_cat);

    if (!$this->tableExist($id_cat)) {
      $this->createTable($id_comp, $id_cat);
      $this->fillResultTable($id_comp, $id_cat);
      $this->update(array('table_exist' => true), $id_cat, null, 'category');
    } else {
      $this->actualizedTable($id_comp, $id_cat);
    }

  }

  public function actualizedTable($id_comp, $id_cat) {
    $id_table = array();
    $id_category = array();

    foreach ($this->CompModel->getRacerByCategory($id_comp, $id_cat) as $item) {
      $id_category[] = $item['racer_id'];
    }
    foreach ($this->db->table($this->generateTableName($id_comp, $id_cat))->select('*')->fetchAll() as $item) {
      $id_table[] = $item->racer_id;
    }
    $result_plus = array_diff($id_category, $id_table);
    $result_minus = array_diff($id_table, $id_category);

    if (count($result_plus) > 0) {
      foreach ($result_plus as $item) {
        $r[]['racer_id'] = $item;
      }
      $this->db->table($this->generateTableName($id_comp, $id_cat))->insert($r);
    }

    if (count($result_minus) > 0) {
      foreach ($result_minus as $item) {
        $this->db->table($this->generateTableName($id_comp, $id_cat))->select('*')->where('racer_id = ?', $item)->delete();
      }
    }
  }


  public function fillResultTable($id_comp, $id_cat) {

    $racer = $this->CompModel->getRacerByCategory($id_comp, $id_cat);
    if (count($racer) > 0) {
      $this->db->table($this->generateTableName($id_comp, $id_cat))
               ->insert($racer);
    }
  }

  public function getComWithResult() {
    return $this->db->query('SELECT DISTINCT p.* 
                                 FROM category y 
                                 JOIN comp p ON (y.comp_id = p.id_comp) 
                                 WHERE public_result = 1 '
    )
                    ->fetchAll();


  }

}
