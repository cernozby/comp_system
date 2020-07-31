<?php


use Nette\Security\User;

abstract class BasePresenter extends Nette\Application\UI\Presenter {

  public $data;

  public function handleDeleteItem($type, $entity_id, $soft = false) {
    try {
      $entit = $this->context->createInstance($type);
      $entit->initIdEntit($entity_id);
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
