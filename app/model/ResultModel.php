<?php

use Nette\Utils\Html;

class ResultModel extends BaseModel {


  const DEFAULT_BOULDER_POINTS = 100;
  const AMATER_RESULT_SYSTEM = 1;
  const COMP_RESULT_SYSTEM = 2;
  /**
   * ResultModel constructor.
   * @param \Nette\Database\Context $database
   * @param \Nette\DI\Container $container
   */
  public $CompModel;
  public $CatModel;
  public $RacerModel;

  public function __construct(Nette\Database\Context $database, Nette\DI\Container $container) {
    parent::__construct($database, $container);
    $this->CompModel = $container->createService('CompModel');
    $this->CatModel = $container->createService('CatModel');
    $this->RacerModel = $container->createService('RacerModel');

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

      $array = $this->addPlace($array, self::AMATER_RESULT_SYSTEM);
    } elseif ($cat->comp_type == 'boulder' && $cat->result_system == 'závodní') {

        //get array of result, no ordered
        foreach ($result as $r) {
          $T = 0; $PT = 0; $Z = 0; $PZ = 0;
          foreach ($r as $key => $item) {
            if ($key != 'id_result') {
              $array[$r->racer_id][$key] = (int)$item;
              $pointsPerBoulder[$key] = 0;
              if($key[-1] == 'z') {
                if($item != 0) {
                  $Z++;
                  $PZ += (int)$item;
                }
              } elseif($key[-1] == 't') {
                if($item != 0) {
                  $T++;
                  $PT+= (int)$item;
                }
              }
            }
          }
          $array[$r->racer_id]['T'] = $T;
          $array[$r->racer_id]['PT'] = $PT;
          $array[$r->racer_id]['Z'] = $Z;
          $array[$r->racer_id]['PZ'] = $PZ;
        }

      $sort_t = array_column($array, 'T');
      $sort_pt = array_column($array, 'PT');
      $sort_z = array_column($array, 'Z');
      $sort_pz = array_column($array, 'PZ');
      array_multisort($sort_t, SORT_DESC, $sort_pt, SORT_ASC, $sort_z, SORT_DESC, $sort_pz, SORT_ASC, $array);
      foreach ($array as $key=> $a) {
        $array[$key]['result'] = $a['T'] . 't' . $a['PT'] . ' ' . $a['Z'] . 'z' . $a['PZ'];
      }
      $array = $this->addPlace($array, self::COMP_RESULT_SYSTEM);

      foreach ($array as $key => $a) {
        unset($array[$key]['T']);
        unset($array[$key]['PT']);
        unset($array[$key]['Z']);
        unset($array[$key]['PZ']);
      }

    } elseif ($cat->comp_type == 'monky_cup') {

      $array = $this->codeResultLeadtoFlot($result);
      $array = $this->codeResultSpeedtoFlot($array);

      $array = $this->monkyCupResultBasicSet($array);
      $array = $this->setBestSpeedResult($array);
      $array = $this->getPlaceSpeed($array);
      $array = $this->getPlaceLead($array,$id_cat);
      $array = $this->getPlaceBoulder($array);
      $array = $this->getFinalyPlace($array);
      $array = $this->decodeResultLeadtoFlot($array);
      $array = $this->decodeResultSpeedtoFlot($array);
    }
    return $array;
  }
  public function getFinalyPlace($result) : array {
    foreach ($result as $key => $value) {
      $count = 0;
      $Q = 1;
      foreach ($value as $k => $item) {
        if($k[0] == 'Q') {
          $Q *= $item; $count++;
        }
      }
      $result[$key]['sum'] = round(pow($Q, 1/$count),2);
    }

    $sort = array_column($result,'sum');
    array_multisort($sort, SORT_ASC, $result);

    $before_keys = array();
    $before_result = array();
    $i = 0;
    foreach ($result as $key => $item) {
      if ($before_result == $item['sum']) {
        $before_keys[] = $key;
        $before_result = $item['sum'];
      } else {
        if (count($before_keys) > 1) {
          $i += count($before_keys);
          foreach ($before_keys as $bk) {
            $result[$bk]['place'] = ($i - count($before_keys)) . '.-' . ($i - 1);
          }
          $before_keys = array();
          $before_keys[0] = $key;
          $before_result = $item['sum'];
          $result[$key]['place'] = $i;

        } else {
          $result[$key]['place'] = ++$i;
          $before_result = $item['sum'];
          $before_keys[0] = $key;
        }
      }
    }
    if (count($before_keys) > 1) {
      $i += count($before_keys);
      foreach ($before_keys as $bk) {
        $result[$bk]['place'] = ($i - count($before_keys)) . '.-' . ($i - 1);
      }
    }
    return $result;
  }

  public function getPlaceBoulder($result) : array {
    $array = array();
    //dodelat spravne vysledky
    foreach ($result as $key => $value) {
      $t = 0;
      $pt = 0;
      $z = 0;
      $pz = 0;
      foreach ($value as $k => $item) {
        if ($k[0] == 'b' && $k[-1] == 'z') {
          if ($item >= 1) {
            $z++;
            $pz += $item;
          }
        } elseif ($k[0] == 'b' && $k[-1] == 't') {
            if ($item >= 1) {
              $t++;
              $pt += $item;
            }
          }
      }
      $result[$key]['T'] = $t;
      $result[$key]['PT'] = $pt;
      $result[$key]['Z'] = $z;
      $result[$key]['PZ'] = $pz;
    }

    $sort_t = array_column($result, 'T');
    $sort_pt = array_column($result, 'PT');
    $sort_z = array_column($result, 'Z');
    $sort_pz = array_column($result, 'PZ');
    array_multisort($sort_t, SORT_DESC, $sort_z, SORT_DESC, $sort_pt, SORT_ASC, $sort_pz, SORT_ASC, $result);
    foreach ($array as $key=> $a) {
      $array[$key]['result'] = $a['T'] . 't' . $a['PT'] . ' ' . $a['Z'] . 'z' . $a['PZ'];
    }
    $result = $this->addPlace($result, self::COMP_RESULT_SYSTEM);

    foreach ($result as $key => $a) {
      bdump(substr($result[$key]['place'], 0, 1));
      bdump(substr($result[$key]['place'], -2, 2));
      bdump(strlen($result[$key]['place']));
      if ( strlen($result[$key]['place']) == 6) {
        $result[$key]['Q1'] = (substr($result[$key]['place'], 0, 1) + substr($result[$key]['place'], -2, 2)) / 2;
      } elseif ( strlen($result[$key]['place']) == 7) {
        $result[$key]['Q1'] = (substr($result[$key]['place'], 0, 2) + substr($result[$key]['place'], -2, 2)) / 2;
      } else {
        $result[$key]['Q1'] = (substr($result[$key]['place'], 0, 1) + substr($result[$key]['place'], -1, 1)) / 2;
      }
      $keys = array_keys($result[$key]);
      $insertBefore = array_search('Q1', $keys);
      $value = array_values($result[$key]);
      array_splice($keys, $insertBefore, 0, 'celkem');
      array_splice($value, $insertBefore, 0, $result[$key]['T'] . 't' . $result[$key]['PT'] . ' ' . $result[$key]['Z'] . 'z' . $result[$key]['PZ']);
      $result[$key] = array_combine($keys, $value);
      unset($result[$key]['T']);
      unset($result[$key]['PT']);
      unset($result[$key]['Z']);
      unset($result[$key]['PZ']);
    }
    return $result;
  }

  public function getPlaceSpeed($result) : array {
    $array = array();
    $array[0] = array_count_values(array_column($result, 'nejlepsi'));
    ksort($array[0], SORT_ASC);

    $array = $this->addPlaceFromCountValues($array);

    foreach ($result as $key => $value) {
      foreach ($array as $k => $item) {
        $result[$key]['Q4'] = $item[$value['nejlepsi']];
      }
    }

    return $result;
  }
  public function addPlaceFromCountValues($array) : array {
    foreach ($array as $key => $value) {
      $i = 1;
      $null = false;
      foreach ($value as $k => $item) {
        $place = 0;
        if($k != 0) {
          for ($x = 1; $x <= $item; $x++) {
            $place += $i++;
          }
          $array[$key][$k] = $place/$item;
        } else {
          $null = true;
        }
      }
      if($null) {
        $place = 0;
        for ($x = 1; $x <= $value[0]; $x++) {
          $place += $i++;
        }
        $array[$key][0] = $place/$value[0];
      }
    }
    return $array;
  }
  public function getPlaceLead($result, $id_cat) : array {
    $array = array();
    for($i = 1; $i <= $this->db->table('category')->select('route_count')->where('id_category = ?', $id_cat)->fetch()->toArray()['route_count']; $i++) {
      $array[$i] = array_count_values(array_column($result, 'cesta' . $i));
      krsort($array[$i], SORT_NUMERIC);
      bdump($array[$i]);

    }

    $array = $this->addPlaceFromCountValues($array);

    //set place into result array
    foreach ($result as $key => $value) {
      $i = 1;
      foreach ($array as $k => $item) {
        $result[$key]['Q'.($i+1)] = $item[$value['cesta'.$i]];
        $i++;
      }
    }
    return $result;
  }

  public function setBestSpeedResult($result) : array {
    $array = $result;
    foreach ($result as $k => $r) {
      $bestTime = 0;
      foreach ($r as $key => $item) {
        if(substr($key, 0,3) == 'cas' && $item != 0) {
          if($bestTime == 0) {
            $bestTime = $item;
          } elseif($item < $bestTime) {
            $bestTime = $item;
          }
        }
      }
      $array[$k]['nejlepsi'] = $bestTime;
    }
    return $array;
  }
  public function monkyCupResultBasicSet($result) : array {
    $array = array();
    $pre_key = 'xxx';
    foreach ($result as $r) {
      $count_q = 0;
      foreach ($r as $key => $item) {
        if($pre_key[2] == 't' && $key[0] == 'c') {
          $array[$r->racer_id]['Q'.++$count_q] = '';
        } elseif(substr($pre_key, 0,5) == 'cesta') {
          $array[$r->racer_id]['Q'.++$count_q] = '';
        }
        if ($key != 'id_result') {
          $array[$r->racer_id][$key] = (int)$item;
        }
        $pre_key = $key;
      }
      $array[$r->racer_id]['nejlepsi'] = '';
      $array[$r->racer_id]['Q'. ++$count_q] = '';
    }
    return $array;
  }
  public function addPlace(array $array, int $type ) : array {

    if($type == self::AMATER_RESULT_SYSTEM) {
      $before_keys = array();
      $before_result = null;
      $i = 0;
      foreach ($array as $key => $item) {
        if ($before_result == $item['result']) {
          $before_keys[] = $key;
          $before_result = $item['result'];
        } else {
          if (count($before_keys) > 1) {
            $i += count($before_keys);
            foreach ($before_keys as $bk) {
              $array[$bk]['place'] = ($i - count($before_keys)) . '. - ' . ($i - 1);
            }
            $before_keys = array();
            $before_keys[0] = $key;
            $before_result = $item['result'];
            $array[$key]['place'] = $i . '.';

          } else {
            $array[$key]['place'] = ++$i . '.';
            $before_result = $item['result'];
            $before_keys[0] = $key;
          }
        }
      }
    } elseif ($type == self::COMP_RESULT_SYSTEM) {
      $before_keys = array();
      $before_result = array('T' =>  '0',
                             'PT' => '0',
                             'Z' =>  '0',
                             'PZ' => '0');
      $i = 0;
      foreach ($array as $key => $item) {
        if ($before_result['T'] == $item['T'] && $before_result['PT'] == $item['PT'] && $before_result['Z'] == $item['Z'] && $before_result['PZ'] == $item['PZ']) {
          $before_keys[] = $key;
          $before_result = $item;
  
        } else {
          if (count($before_keys) > 1) {
            $i += count($before_keys);
            foreach ($before_keys as $bk) {
              $array[$bk]['place'] = ($i - count($before_keys)) . '. - ' . ($i - 1) ;
            }
            $before_keys = array();
            $before_keys[0] = $key;
            $before_result = $item;
            $array[$key]['place'] = $i;

          } else {
            $array[$key]['place'] = ++$i;
            $before_result = $item;
            $before_keys[0] = $key;
          }
        }
      }
      
      if (count($before_keys) > 1) {
        $i += count($before_keys);
        foreach ($before_keys as $bk) {
          $array[$bk]['place'] = ($i - count($before_keys)) . '. -' . ($i - 1);
        }
      }
    }
    return $array;
  }


  public function createTable($id_comp, $id_cat) {

    if($_SERVER['HTTP_HOST'] == 'bozala.cz') {
      $db = 'bozalacz2';
    } else {
      $db = 'comp_system';
    }
    $cat = $this->getRow('category', $id_cat);
    $name = $this->generateTableName($id_comp, $id_cat);
    $sql = '';
    $sql .= 'CREATE TABLE IF NOT EXISTS `' .$db. '`.`' . $name . '` ( `id_result` INT(10) NOT NULL AUTO_INCREMENT , `racer_id` INT(10) NOT NULL ,';
    if ($cat->comp_type == "boulder") {
      for ($i = 1; $i <= $cat->boulder_count; $i++) {
        $sql .= '`b' . $i . 'z` VARCHAR(10),';
        $sql .= '`b' . $i . 't` VARCHAR(10),';
      }
    } elseif($cat->comp_type == 'monky_cup') {
      for ($i = 1; $i <= $cat->boulder_count; $i++) {
        $sql .= '`b' . $i . 'z` VARCHAR(10),';
        $sql .= '`b' . $i . 't` VARCHAR(10),';
      }
      for ($i = 1; $i <= $cat->route_count; $i++) {
        $sql .= '`cesta' . $i . '` VARCHAR(10),';
      }
      for ($i = 1; $i <= $cat->speed_count; $i++) {
        $sql .= '`cas' . $i . '` VARCHAR(10),';
      }
    }
    $sql .= 'PRIMARY KEY (`id_result`)) ENGINE = InnoDB;';
    return $this->db->query($sql);
  }

  public function prepareTable($id_comp, $id_cat) {
    $this->table = $this->generateTableName($id_comp, $id_cat);

    if (!$this->tableExist($id_cat)) {
      $this->createTable($id_comp, $id_cat);
      $this->fillResultTable($id_comp, $id_cat);
      $this->update(array('table_exist' => 1), $id_cat, null, 'category');
    } else {
      $this->actualizedTable($id_comp, $id_cat);
    }

  }

  public function actualizedTable($id_comp, $id_cat) {
    $id_table = array();
    $id_category = array();

    foreach ($this->CompModel->getRacerByCategory($id_comp, $id_cat) as $item) {
      $id_category[] = $item->id_racer;
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
      $name = $this->generateTableName($id_comp, $id_cat);
      foreach ($racer as $r) {
        $this->db->table($name)
                 ->insert(array( 'racer_id' => $r->id_racer));
      }
    }
  }

  public function getComWithResult() {
    return $this->db->query('SELECT DISTINCT p.* 
                                 FROM category y 
                                 JOIN comp p ON (y.comp_id = p.id_comp) 
                                 WHERE public_result = 1 '
    )->fetchAll();
  }

  public function codeResultLeadtoFlot ($data) {
    foreach ($data as $k => $d) {
      foreach ($d as $key => $value) {
        if(substr($key, 0, 5) == 'cesta') {
          if(strpos($value, '+')) {
            str_replace($data[$k][$key], '+', '');
            $data[$k][$key] = (float)$data[$k][$key] + 0.5;
          } elseif(strtolower($value) == 'top') {
            $data[$k][$key] = 99;
          }
          $data[$k][$key] = (float)$data[$k][$key] * 100;
        }
      }
    }
    return $data;
  }

  public function decodeResultLeadtoFlot ($data) {
    foreach ($data as $k => $d) {
      foreach ($d as $key => $value) {
        if(substr($key, 0, 5) == 'cesta') {
          $data[$k][$key] = (float)$data[$k][$key] / 100;
          if($value % 100 == 50) {
            $data[$k][$key] -= 0.5;
            $data[$k][$key] = (string)$data[$k][$key] ."+";
          } elseif($value % 1000 == 900) {
            $data[$k][$key] = 'TOP';
          }
        }
      }
    }
    return $data;
  }

  public function codeResultSpeedtoFlot ($data) {
    foreach ($data as $k => $d) {
      foreach ($d as $key => $value) {
        if(substr($key, 0, 3) == 'cas') {
          $data[$k][$key] = (float)$data[$k][$key] * 1000;
        }
      }
    }
    return $data;
  }

  public function decodeResultSpeedtoFlot ($data) {
    foreach ($data as $k => $d) {
      foreach ($d as $key => $value) {
        if(substr($key, 0, 3) == 'cas' || substr($key, 0, 3) == 'nej' ) {
          $data[$k][$key] = number_format($data[$k][$key] / 1000,2);
        }
      }
    }
    return $data;
  }
}
