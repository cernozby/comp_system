<?php

/**
 * Class ArticleModel
 */
class ArticleModel extends BaseModel {

  /**
   * CompModel constructor.
   * @param \Nette\Database\Context $database
   * @param \Nette\DI\Container $container
   */
  public function __construct(Nette\Database\Context $database, Nette\DI\Container $container) {
    parent::__construct($database, $container);
    $this->table = 'article';
  }

  /**
   * @param $url
   * @param int $id
   * @return bool
   */
  public function urlExist($url, $id = 1) :bool {
    $result = $this->db->table($this->table)
                       ->select('*')
                       ->where('id_article != ?', $id)
                       ->where('url = ?', $url)
                       ->limit(1)
                       ->fetch();

    return $result == true;
  }

  /**
   * @param int $id
   * @return array
   */
  public function getAllUrlAdress(int $id = 0) : array {
    $a = $this->db->table($this->table)
                  ->select('url')
                  ->where('id_article != ?', $id);

    $array = array();
    foreach ($a as $b) {
      $array[] = $b->url;
    }
    return $array;
  }

  /**
   * @return array
   */
  public function getArticles() : array {
    return $this->db->table($this->table)
                    ->select('*')
                    ->order('created DESC')
                    ->fetchAll();
  }

  /**
   * @param $url
   * @return \Nette\Database\IRow|\Nette\Database\Table\ActiveRow|null
   */
  public function getArticlebyUrl($url) {
    return $this->db->table($this->table)
                    ->select('*')
                    ->where('url = ?', $url)
                    ->fetch();
  }
}
