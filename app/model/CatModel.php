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

  public function createCatName(int $id_cat): string {
    $c = $this->getRow(null, $id_cat);
    return $c->name .' '. $c->year_from .' - '. $c->year_to;
  }
}
