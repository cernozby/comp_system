<?php

namespace App\Presenters;

use Mpdf\Mpdf;
use Nette;
use Nette\Application\UI\Form;
use Nette\ComponentModel\IComponent;
use Nette\Utils\Html;

class CompetitionPresenter extends \BasePresenter
{
  public $RacerModel;
  public $CompModel;
  public $CatModel;
  public $ResultModel;
  public $PdfModel;
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
    $this->PdfModel = $this->context->createInstance('PdfModel');
    $this->httpRequest = $this->getHttpRequest();

  }

  /*  --------------Handlers---------------*/

  public function handleResultToPDf($id_comp, $id_cat) {
    $html = $this->PdfModel->getResultToPrint($id_comp, $id_cat);
    $mpdf = new Mpdf(['orientation' => 'L', 'mode' => 'utf-8', 'margin_top' => 5]);
    $mpdf->WriteHTML($html);
    $mpdf->output();
  }

  public function handleStartersToPdf($id_comp, $id_cat) {
    $html = $this->PdfModel->getStartersToPrint($id_comp, $id_cat);
    $mpdf = new Mpdf(['orientation' => 'P', 'mode' => 'utf-8', 'margin_top' => 5]);
    $mpdf->WriteHTML($html);
    $mpdf->output();
  }

  public function handleNoteResultPdf($id_comp, $id_cat) {
    $html = $this->PdfModel->getNoteResult($id_comp, $id_cat);
    $mpdf = new Mpdf(['orientation' => 'L', 'mode' => 'utf-8', 'margin_top' => 5]);
    $mpdf->WriteHTML($html);
    $mpdf->output();
  }


  /*  --------------Renders---------------*/

  public function renderListOfPrereg(){
    $tmp = $this->CompModel->getCompForRegister(null, $this->user->isInRole('admin'), true);
    $id = $this->getParameter('id');
    $this->template->id = $id;
    if(count($tmp) == 1 && $id == null) {
      $this->redirect('this', array( 'id' => array_keys($tmp)[0]));
    } else {
      $this->template->CompPrereg = $tmp;
    }
    if($id) {
      $this->template->prereg = $this->CompModel->getPreregComp($id, $this->user->isInRole('admin'));
    }
  }

  public function renderResults() {
    $id = $this->getParameter('id');
    $cat = $this->getParameter('cat');

    $this->template->comps = $this->ResultModel->getComWithResult();
    $this->template->id_comp = $id;
    $this->template->id_cat = $cat;

    if($id && !$cat) {
      $this->template->cat = $this->user->isInRole('admin') ? $this->CatModel->getCatIfTableExist($id) : $this->CatModel->getCatPublicResult($id);
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
                  ->setHtmlAttribute('maxlength', 7);
          $sub[$i]->setDefaults($d);
        }
        $i++;
      }
      $form->addSubmit('save', 'uložit');
     $form->onSuccess[] = [$this, 'ResultFormSucceeded'];
    return $form;
  }

  public function createComponentCompRegistrationForm() {
    return new Nette\Application\UI\Multiplier(function () {
      $form = new Form();
      $form->addText('id_comp')
           ->setDefaultValue($this->getParameter('id'));
      $form->addSubmit('registration', 'předregistrovat');
      $form->onSuccess[] = [$this, 'CompRegistrationFormSucceeded'];
      return $form;
    }
    );
  }

  public function createComponentCompUnregistrationForm() {
    return new Nette\Application\UI\Multiplier( function (){
      $form = new Form();
      $form->addText('id_comp')
           ->setDefaultValue($this->getParameter('id'));
      $form->addSubmit('registration', 'odhlásit');
      $form->onSuccess[] = [$this, 'CompUnregistrationFormSucceeded'];
      return $form;
    });
  }

  public function CompRegistrationFormSucceeded(Form $form) {
    $values = $form->values;
    $this->RacerModel->insert(array('comp_id' => $values->id_comp, 'racer_id' => $form->getName()), 'prereg');
    $this->flashMessage('Závodník byl úspěšně přihlášen na závod.');
    $this->redirect('Competition:listOfPrereg', array('id' => $values->id_comp));
  }
  public function CompUnregistrationFormSucceeded(Form $form) {
    $values = $form->values;
    $id = $this->CompModel->isPrereg($form->getName(), $values->id_comp);
    $this->RacerModel->delete('prereg', $id);
    $this->flashMessage('Závodník byl úspěšně odhlášen ze závodu.');
    $this->redirect('Competition:listOfPrereg', array('id' => $values->id_comp));
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

