<?php

/**
 * Class CompModel
 */
class CompModel extends BaseModel {

  const
        TYPE_COMP_BOULDER = 'boulder',
        TYPE_COMP_LEAD = 'obtížnost',
        TYPE_COMP_SPEED = 'rychlost',
        TYPE_COMP_COMBINATION = 'kombinace';
  /**
   * CompModel constructor
   * @param \Nette\Database\Context $database
   * @param \Nette\DI\Container $container
   */
  public function __construct(Nette\Database\Context $database, Nette\DI\Container $container) {
    parent::__construct($database, $container);
    $this->table = 'comp';
  }

  public function getCountMyComp() {
    return $this->db->table($this->table)
                    ->where('user_id = ?', $this->id_user)
                    ->count('*');
  }

  public function getComps( $id = null): array {
    $id = $id ? $id : $this->id_user;
    return $this->db->table($this->table)
                    ->select('*')
                    ->where('user_id = ?', $id)
                    ->fetchAll();
  }

  public function getAgeRange($id_comp) {
    $youg = $this->db->table('category')
                     ->select('year_from')
                     ->where('comp_id = ?', $id_comp)
                     ->order('year_from DESC')
                     ->limit('1')
                     ->fetch();

    $alt = $this->db->table('category')
                    ->select('year_to')
                    ->where('comp_id = ?', $id_comp)
                    ->order('year_to')
                    ->limit('1')
                    ->fetch();
    if($alt && $youg) {
      return array('low' => $youg->year_from, 'height' => $alt->year_to);
    } else {
      return null;
    }
  }

  public function getCompForRegister($id_racer = null, $admin = false){
    if($admin) {
      $result = $this->db->table('comp')
                         ->where('online_registration_start < ?', new \Nette\Utils\DateTime())
                         ->order('start')
                         ->fetchAll();
    } else {
      $result = $this->db->table('comp')
                         ->where('online_registration_start < ?', new \Nette\Utils\DateTime())
                         ->where('online_registration_end > ?', new \Nette\Utils\DateTime())
                         ->order('start')
                         ->fetchAll();
    }
    if($id_racer) {
      $a = null;
      $racer = $this->getRow('racer', $id_racer);
      foreach ($result as $key => $r) {
        $category = $this->getCatByIdComp($r->id_comp);
        foreach ($category as $c) {
          if($racer->born <= $c->year_from && $racer->born >= $c->year_to && ( ($racer->gender == 'male' && $c->gender == 'muž') || ($racer->gender == 'female' &&  $c->gender == 'žena') || $c->gender == 'muž i žena')){
            $a[] = $r;
          }
        }
      }
      return $a;
    } else {
      return $result;
    }
  }

  public function isPrereg($id_racer, $id_comp){
    $result = $this->db->table('prereg')
                       ->select('id_prereg')
                       ->where('comp_id = ?', $id_comp)
                       ->where('racer_id = ?',$id_racer)
                       ->fetch();

    return $result ? $result->id_prereg : false;
  }

  public function getPreregistredCompsName($id_racer) {
    return $this->db->query('SELECT name FROM comp  
                                 JOIN prereg ON ( prereg.comp_id = comp.id_comp)
                                 WHERE prereg.racer_id = ?', $id_racer)->fetchAll();
  }


  public function isCompType($type, $id = null): bool {
    $id = $id ? $id : $this->id_user;
    $myType =  $this->db->table($this->table)
                    ->select('comp_type')
                    ->where('id_comp = ?', $id)->fetch();

    if($myType->comp_type == $type ) { return true;} else { return false; }
  }

  public function prepareValues($values) {

    $values['user_id'] = $this->getId_user();

    if($values['plan_url']->isOk()) {
      $name = str_replace(' ', '_', $values->name) . '_propozice.pdf';
      $values['plan_url']->move($this->basePath.'pdf/'.$name);
      $values['plan_url'] = $this->baseUrl .'pdf/'. $name;
    } else {
      unset($values['plan_url']);
    }
    foreach ($values as $k => $v) {
      if($v == "") {
        $values->$k = null;
      }
    }

    return $values;
  }

  public function prepareData(){
    foreach ($this->getRow() as $k => $i) {
      if($i instanceof \Nette\Utils\DateTime){
        $this->data[$k] = $this->getInputDatetime($i->getTimestamp());
      } else {
        $this->data[$k] = $i;
      }
    }
    return $this->data;
  }

  public function getPreregByIdComp($id_comp) {
    return $this->db->query('SELECT r.* FROM racer r 
                                 JOIN prereg g ON ( r.id_racer = g.racer_id)
                                 WHERE comp_id = ?', $id_comp)
                    ->fetchAll();
  }

  public function getCatByIdComp($id_comp) {
    return $this->db->query('SELECT * FROM category 
                                 WHERE comp_id = ?
                                 ORDER BY year_from DESC, name DESC', $id_comp)
                    ->fetchAll();
  }

  public function getPreregComp($id_comp) {
    $prereg = $this->getPreregByIdComp($id_comp);
    $category = $this->getCatByIdComp($id_comp);

    $result = array();
    foreach ($category as $c) {
      $result[$c->name .' '. $c->year_from .' - '. $c->year_to] = array();
    }

    foreach ($prereg as $p) {
      foreach ($category as $c) {
        if($p->born <= $c->year_from && $p->born >= $c->year_to && ( ($p->gender == 'male' && $c->gender == 'muž') || ($p->gender == 'female' &&  $c->gender == 'žena') || $c->gender == 'muž i žena'))
          $result[$c->name .' '. $c->year_from .' - '. $c->year_to][] = $p;
      }
    }
    return $result;
  }
  public function getOpenComps() {
    return $this->db->table('comp')
                    ->where('open_result = ?', true)
                    ->fetchAll();
  }

  public function getRacerByCategory($id_comp, $id_cat) {
    $prereg = $this->getPreregByIdComp($id_comp);
    $category = $this->getRow('category', $id_cat);
    $result = array();
    foreach ($prereg as $p) {
      if($p->born <= $category->year_from && $p->born >= $category->year_to && ( ($p->gender == 'male' && $category->gender == 'muž') || ($p->gender == 'female' &&  $category->gender == 'žena') || $category->gender == 'muž i žena')) {
        $result[]['racer_id'] = $p->id_racer;
      }
    }
    return $result;
  }
}
