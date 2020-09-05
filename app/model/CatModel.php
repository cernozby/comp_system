<?php

class CatModel extends BaseModel {

  /**
   * CompModel constructor.
   * @param \Nette\Database\Context $database
   * @param \Nette\DI\Container $container
   */
  public function __construct(Nette\Database\Context $database, Nette\DI\Container $container) {
    parent::__construct($database, $container);
    $this->table = 'category';
  }
  public function getCatPublicResult ($id_comp) {
    return $this->db->table('category')
                    ->select('*')
                    ->where( 'comp_id = ? AND public_result = ?', $id_comp, true )
                    ->order('year_from DESC, name DESC')
                    ->fetchAll();
  }

  public function getCat($id = null, $columm = null): array {
    $id = $id ? $id : $this->getIdEntit();
    $columm = $columm ? $columm : 'comp_id';
    return $this->db->table($this->table)
                    ->select('*')
                    ->where($columm . '= ?', $id)
                    ->order('year_from DESC, name DESC')
                    ->fetchAll();
  }

  public function getCatIfTableExist($id): array {
    return $this->db->table($this->table)
                    ->select('*')
                    ->where('comp_id = ? AND table_exist = ?', $id, true)
                    ->order('year_from DESC, name DESC')
                    ->fetchAll();
  }



  public function createCatName(int $id_cat): string {
    $c = $this->getRow(null, $id_cat);
    return $c->name .' '. $c->year_from .' - '. $c->year_to;
  }

  public function prepareCategoriesForMonkeyCup($id_comp) {

    $array = array();

    //boys
    $array[] = array(
      'comp_id'       => $id_comp,
      'name'          => 'Chlapci U8',
      'year_from'     => 2020,
      'year_to'       => date('Y') - 7,
      'result_system' => 'monkey_cup',
      'gender'        => 'muž',
      'boulder_count' => 2,
      'route_count'   => 2,
      'comp_type'     => 'monky_cup',
      'speed_count'   => 2);
    $array[] = array(
      'comp_id'       => $id_comp,
      'name'          => 'Chlapci U10',
      'year_from'     => 2012,
      'year_to'       => date('Y') - 9,
      'result_system' => 'monkey_cup',
      'gender'        => 'muž',
      'boulder_count' => 2,
      'route_count'   => 2,
      'comp_type'     => 'monky_cup',
      'speed_count'   => 2);
    $array[] = array(
      'comp_id'       => $id_comp,
      'name'          => 'Chlapci U12',
      'year_from'     => 2010,
      'year_to'       => date('Y') - 11,
      'result_system' => 'monkey_cup',
      'gender'        => 'muž',
      'boulder_count' => 2,
      'route_count'   => 2,
      'comp_type'     => 'monky_cup',
      'speed_count'   => 2);
    $array[] = array(
      'comp_id'       => $id_comp,
      'name'          => 'Chlapci U14',
      'year_from'     => 2008,
      'year_to'       => date('Y') - 13,
      'result_system' => 'monkey_cup',
      'gender'        => 'muž',
      'boulder_count' => 2,
      'route_count'   => 2,
      'comp_type'     => 'monky_cup',
      'speed_count'   => 2);
    $array[] = array(
      'comp_id'       => $id_comp,
      'name'          => 'Chlapci B',
      'year_from'     => 2006,
      'year_to'       => date('Y') - 15,
      'result_system' => 'monkey_cup',
      'gender'        => 'muž',
      'boulder_count' => 2,
      'route_count'   => 2,
      'comp_type'     => 'monky_cup',
      'speed_count'   => 2);
    $array[] = array(
      'comp_id'       => $id_comp,
      'name'          => 'Chlapci A',
      'year_from'     => 2004,
      'year_to'       => date('Y') - 17,
      'result_system' => 'monkey_cup',
      'gender'        => 'muž',
      'boulder_count' => 2,
      'route_count'   => 2,
      'comp_type'     => 'monky_cup',
      'speed_count'   => 2);
    $array[] = array(
      'comp_id'       => $id_comp,
      'name'          => 'Chlapci J',
      'year_from'     => 2002,
      'year_to'       => date('Y') - 19,
      'result_system' => 'monkey_cup',
      'gender'        => 'muž',
      'boulder_count' => 2,
      'route_count'   => 2,
      'comp_type'     => 'monky_cup',
      'speed_count'   => 2);

    //girls
    $array[] = array(
      'comp_id'       => $id_comp,
      'name'          => 'Dívky U8',
      'year_from'     => 2020,
      'year_to'       => date('Y') - 7,
      'result_system' => 'monkey_cup',
      'gender'        => 'žena',
      'boulder_count' => 2,
      'route_count'   => 2,
      'comp_type'     => 'monky_cup',
      'speed_count'   => 2);
    $array[] = array(
      'comp_id'       => $id_comp,
      'name'          => 'Dívky U10',
      'year_from'     => 2012,
      'year_to'       => date('Y') - 9,
      'result_system' => 'monkey_cup',
      'gender'        => 'žena',
      'boulder_count' => 2,
      'route_count'   => 2,
      'comp_type'     => 'monky_cup',
      'speed_count'   => 2);
    $array[] = array(
      'comp_id'       => $id_comp,
      'name'          => 'Dívky U12',
      'year_from'     => 2010,
      'year_to'       => date('Y') - 11,
      'result_system' => 'monkey_cup',
      'gender'        => 'žena',
      'boulder_count' => 2,
      'route_count'   => 2,
      'comp_type'     => 'monky_cup',
      'speed_count'   => 2);
    $array[] = array(
      'comp_id'       => $id_comp,
      'name'          => 'Dívky U14',
      'year_from'     => 2008,
      'year_to'       => date('Y') - 13,
      'result_system' => 'monkey_cup',
      'boulder_count' => 2,
      'gender'        => 'žena',
      'route_count'   => 2,
      'comp_type'     => 'monky_cup',
      'speed_count'   => 2);
    $array[] = array(
      'comp_id'       => $id_comp,
      'name'          => 'Dívky B',
      'year_from'     => 2006,
      'year_to'       => date('Y') - 15,
      'result_system' => 'monkey_cup',
      'boulder_count' => 2,
      'gender'        => 'žena',
      'route_count'   => 2,
      'comp_type'     => 'monky_cup',
      'speed_count'   => 2);
    $array[] = array(
      'comp_id'       => $id_comp,
      'name'          => 'Dívky A',
      'year_from'     => 2004,
      'year_to'       => date('Y') - 17,
      'result_system' => 'monkey_cup',
      'boulder_count' => 2,
      'gender'        => 'žena',
      'route_count'   => 2,
      'comp_type'     => 'monky_cup',
      'speed_count'   => 2);
    $array[] = array(
      'comp_id'       => $id_comp,
      'name'          => 'Dívky J',
      'year_from'     => 2002,
      'gender'        => 'žena',
      'year_to'       => date('Y') - 19,
      'result_system' => 'monkey_cup',
      'boulder_count' => 2,
      'route_count'   => 2,
      'comp_type'     => 'monky_cup',
      'speed_count'   => 2);

      foreach ($array as $a) {
        if(empty($this->db->table('category')->select('*')->where('comp_id = ? AND name = ? AND gender = ?', $id_comp, $a['name'], $a['gender'])->fetchAll())) {
          $this->insert($a);

        }
      }
  }
}
