<?php

namespace App\Presenters;

use Nette;
use Nette\Application\UI\Form;
use Nette\ComponentModel\IComponent;

class CompetitionPresenter extends \BasePresenter
{
  public $RacerModel;
  public $CompModel;
  public $CatModel;
  public $ResultModel;
  public $httpRequest;

  public $table;

  public function startup() {
    parent::startup();

    $this->RacerModel = $this->context->createInstance('RacerModel');
    $this->RacerModel->initId_user($this->user->getId());
    $this->CompModel = $this->context->createInstance('CompModel');
    $this->CompModel->initId_user($this->user->getId());
    $this->CatModel = $this->context->createInstance('CatModel');
    $this->CatModel->initId_user($this->user->getId());
    $this->ResultModel = $this->context->createInstance('ResultModel');
    $this->httpRequest = $this->getHttpRequest();

  }

  /*  --------------Renders---------------*/

  public function renderListOfPrereg(){
    $tmp = $this->CompModel->getCompForRegister(null, true);
    $id = $this->getParameter('id');
    $this->template->id = $id;
    if(count($tmp) == 1 && $id == null) {
      $this->redirect('this', array( 'id' => array_keys($tmp)[0]));
    } else {
      $this->template->CompPrereg = $tmp;
    }
    if($id) {
      $this->template->prereg = $this->CompModel->getPreregComp($id);
    }
  }

  public function renderResults() {
    $id = $this->getParameter('id');
    $cat = $this->getParameter('cat');

    $this->template->comps = $this->ResultModel->getComWithResult();
    $this->template->id_comp = $id;
    $this->template->id_cat = $cat;

    if($id && !$cat) {
      $this->template->cat = $this->CatModel->getCatPublicResult($id);
    }

    if($id && $cat) {
      $this->template->cat_name = $this->CatModel->createCatName($cat);
      $this->template->results = $this->ResultModel->getResultToRender($id, $cat);
      $this->template->racerModel = $this->RacerModel;
    }
  }

  public function renderNoteResults() {
    if (!$this->user->isInRole('admin')) {
      $this->flashMessage('Nemáte dostatečná oprávnění. Přihlašte se prosím.');
      $this->redirect(':Homepage:login');
    }

    $id = $this->getParameter('id');
    $cat = $this->getParameter('cat');

    $this->template->comps = $this->CompModel->getOpenComps();
    $this->template->id_comp = $id;
    $this->template->id_cat = $cat;
    if($id) {
      $this->template->cat = $this->CatModel->getCat($id);
    }
    if($id && $cat) {
      try {
        $this->ResultModel->prepareTable($id, $cat);
        $a = $this->ResultModel->getColumnNames($this->ResultModel->table);
        unset($a[0]);
        unset($a[1]);
      } catch (\Exception $e) {
        $this->flashMessage('priprava tabulky se nepovedla - '. $e->getMessage());
      }

      $this->table = $this->ResultModel->generateTableName($this->getParameter('id'), $this->getParameter('cat'));
      $this->template->names = $a;
      $this->template->data  = $this->ResultModel->db->table($this->ResultModel->table)->fetchAll();
      $this->template->cat_name  = $this->CatModel->createCatName($cat);
      $this->template->racerModel = $this->RacerModel;
    }
  }

  public function createComponentResultForm() {
    $table = $this->ResultModel->generateTableName($this->getParameter('id'), $this->getParameter('cat'));

    $names = $this->ResultModel->getColumnNames($table);
    $data = $this->ResultModel->db->table($table)->fetchAll();
    unset($names[0]);
    unset($names[1]);
    $form = new Form();
    $form->setAction($this->httpRequest->getUrl());
    $form->addSelect('public', 'Zveřejnit výsledky', array(false => 'Ne', true => 'Ano'))
         ->setDefaultValue($this->CatModel->getRow('category', $this->getParameter('cat'))->public_result);

    $i = 1;
      foreach ($data as  $d) {
        $sub[$i] = $form->addContainer((string)$i);
        $sub[$i]->addHidden('id')
                ->setDefaultValue($d->id_result);
        foreach ($names as $n) {
          $sub[$i]->addText($n)
                  ->setHtmlAttribute('maxlength', 3);
          $sub[$i]->setDefaults($d);
        }
        $i++;
      }
      $form->addSubmit('save', 'uložit');
     $form->onSuccess[] = [$this, 'ResultFormSucceeded'];
    return $form;
  }

  public function ResultFormSucceeded(Form $form) {
    $table = $this->ResultModel->generateTableName($this->getParameter('id'), $this->getParameter('cat'));
    $data = $form->getHttpData();


    $this->CatModel->update(array('public_result' => (bool)$data['public']), $this->getParameter('cat'), false, 'category');

    unset($data['save']);
    unset($data['_do']);
    unset($data['public']);


    try {
      foreach ($data as $d) {
        $id = $d['id'];
        unset($d['id']);
        $this->ResultModel->update($d, $id, false, $table);
      }

      $this->flashMessage('Uložení dat se povedlo');
    } catch (\Exception $e) {
      $this->flashMessage('Uložení dat se nepovedlo'. $e->getMessage());
    }
  }
}

