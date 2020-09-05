<?php


use Nette\Security\User;

abstract class BasePresenter extends Nette\Application\UI\Presenter {

  public $data;
  public $CatModel;
  public $RacerModel;
  public $ResultModel;

  public function startup() {
    parent::startup();
    $this->CatModel = $this->context->createService('CatModel');
    $this->RacerModel = $this->context->createService('RacerModel');
    $this->ResultModel = $this->context->createService('ResultModel');
  }
  public function handleDeleteItem($type, $entity_id, $soft = false) {
    try {
      $entit = $this->context->createInstance($type);
      $entit->initIdEntit($entity_id);

      if($type == 'CompModel') {
        $a = $this->CatModel->db->table('category')->select('id_category')->where('comp_id = ? AND table_exist = 1', $entity_id)->fetchAll();
        foreach ($a as $item) {
          $sql = 'DROP TABLE '. $this->ResultModel->generateTableName($entity_id, $item->id_category);
          $this->CatModel->db->query($sql);
        }
        $this->CatModel->db->table('prereg')->select('*')->where('comp_id = ?', $entity_id)->delete();
        $this->CatModel->db->table('category')->select('*')->where('comp_id = ?', $entity_id)->delete();
      } elseif ($type == 'RacerModel') {
        $this->RacerModel->db->table('prereg')->select('*')->where('racer_id= ?', $entity_id)->delete();
      }
      if ($soft) {
        $entit->set('deleted', new \Nette\Utils\DateTime());
      } else {
        $entit->delete();
      }
    } catch (Exception $e) {
      $this->flashMessage('Něco se pokazilo. Zkuste obnovit stránku', 'danger');
    }
    $this->flashMessage('Úspěšně smazáno', 'success');
    $this->redirect('this');
  }
}
