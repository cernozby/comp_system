<?php

namespace App\Presenters;

use Mpdf\Mpdf;
use Nette;
use Nette\Application\UI\Form;

class AdministrationPresenter extends \BasePresenter {
  public $RacerModel;
  public $CompModel;
  public $CatModel;
  public $ArticleModel;
  public $UserModel;

  public function startup() {
    parent::startup();
    if (!$this->user->isLoggedIn()) {
      $this->flashMessage('Nemáte dostatečná oprávnění. Přihlašte se prosím.');
      $this->redirect(':Homepage:login');
    }

    $this->RacerModel = $this->context->createInstance('RacerModel');
    $this->RacerModel->initId_user($this->user->getId());
    $this->CompModel = $this->context->createInstance('CompModel');
    $this->CompModel->initId_user($this->user->getId());
    $this->CatModel = $this->context->createInstance('CatModel');
    $this->CatModel->initId_user($this->user->getId());
    $this->ArticleModel = $this->context->createService('ArticleModel');
    $this->UserModel = $this->context->createService('UserModel');

  }
  /*  --------------Actions---------------*/

  public function actionNewRacer(int $id = null) {
    if($id) {
      $this->RacerModel->initIdEntit($id);
      $this->data = $this->RacerModel->getRow();
    }
  }

  public function actionNewComp(int $id = null) {
    if($id) {
      $this->CompModel->initIdEntit($id);
      $this->data = $this->CompModel->prepareData();
    }
  }


/*  --------------Renders---------------*/

  public function renderAdministration(){
    $this->template->myRacersCount = $this->RacerModel->getCountMyRacers();
    $this->template->myCompCount = $this->CompModel->getCountMyComp();
    $this->template->isAdmin = $this->user->isInRole('admin');

  }

  public function renderMyRacers() {
    if($this->user->isInRole('admin')) {
      $this->template->racers = $this->RacerModel->getAllRacers();
    } else {
      $this->template->racers = $this->RacerModel->getRacers();
    }
    $this->template->compModel = $this->CompModel;
  }

  public function renderMyComps( ) {
    $this->template->comps = $this->CompModel->getComps();
  }

  public function renderCompSetting($id, $cat) {
    $this->template->id_comp = $id;
    $this->template->compModel = $this->CompModel;
    $this->template->cat = "";
    if($this->getParameter('id')) {
      $this->CatModel->initIdEntit($this->getParameter('id'));
      $this->template->cat = $this->CatModel->getCat();
    }
  }

  public function renderPreRegistration() {
    $this->template->comps = $this->CompModel->getCompForRegister($this->getParameter('id'), $this->user->isInRole('admin'));
    $this->template->compModel = $this->CompModel;
    $this->template->id_racer = $this->getParameter('id');
  }

  public function renderMyArticles() {
    $this->template->articles = $this->ArticleModel->getArticles();
    $this->template->UserModel = $this->UserModel;
  }

  /*  --------------Components---------------*/

  public function createComponentRacerForm() {
    $form = new Form();
    $form->addText('first_name')
         ->setRequired('jméno: ' . \Constants::FORM_MSG_REQUIRED)
         ->addRule(FORM::MIN_LENGTH, \Constants::FORM_SHORT_FIRSTNAME, 3)
         ->addRule(FORM::MAX_LENGTH, \Constants::FORM_LONG_FIRSTNAME, 250)
         ->setHtmlAttribute('placeholder', 'jméno*');
    $form->addText('last_name')
         ->setRequired('přijmení: ' . \Constants::FORM_MSG_REQUIRED)
         ->addRule(FORM::MIN_LENGTH, \Constants::FORM_SHORT_LASTNAME, 3)
         ->addRule(FORM::MAX_LENGTH, \Constants::FORM_LONG_LASTNAME, 250)
         ->setHtmlAttribute('placeholder', 'přijmení*');
    $form->addText('club')
         ->addRule(FORM::MAX_LENGTH, \Constants::FORM_LONG, 250)
         ->setHtmlAttribute('placeholder', 'oddíl \ klub \ sponzor');
    $form->addSelect('gender', '', array('male' => 'závodník', 'female' => 'závodnice'))
         ->setPrompt('pohlaví*')
         ->setRequired('pohlaví: ' .\Constants::FORM_MSG_REQUIRED);
    $form->addSelect('born', '', $this->RacerModel->yearsForSelect())
         ->setPrompt('rok narození*')
         ->setRequired('rok narození:' .\Constants::FORM_MSG_REQUIRED);

    if($this->getParameter('id')) {
      $form->setDefaults($this->data);
    }

    $form->addSubmit('registration', 'přidat');
    $form->onSuccess[] = [$this, 'RacerFormSucceeded'];

    return $form;
  }

  public function createComponentArticleForm() {
    $form = new Form();
    if($this->getParameter('id')) {
      $url = $this->ArticleModel->getAllUrlAdress($this->getParameter('id'));
    } else {
      $url = $this->ArticleModel->getAllUrlAdress();
    }

    $form->addText('title', 'Titulek');
    $form->addText('url', 'Url')
         ->addRule(FORM::PATTERN, 'url muze byt pouze z cislic, malich pismen bez diakritiky a pomlcky', '[a-z0-9-]*')
         ->addRule(FORM::NOT_EQUAL, 'Tato url adresa je jiz zabrana, zvolte prosim jinou', $url)
         ->addRule(FORM::MIN_LENGTH, 'url  musi byt delsi nez %d znaky.', 3);
    $form->addText('keywords', 'Kličová slova');
    $form->addTextArea('text', 'Článek')
         ->setRequired();
    $form->addTextArea('text_short', 'Vícuc článku ')
         ->setRequired();

    $form->addSubmit('add', 'vložit');
    $form->onSuccess[] = [$this, 'ArticleFormSucceeded'];

    if($this->getParameter('id')) {
      $form->setDefaults($this->ArticleModel->getRow(null,$this->getParameter('id') ));
      $form->setAction($this->getParameter('id' ));
    }

    return $form;
  }

  public function createComponentCompForm() {
    $form = new Form();
    $form->addText('name', 'název závodu')
         ->setRequired('Název závodu: ' . \Constants::FORM_MSG_REQUIRED)
         ->addRule(FORM::MIN_LENGTH, \Constants::FORM_SHORT_FIRSTNAME, 3)
         ->addRule(FORM::MAX_LENGTH, \Constants::FORM_LONG_FIRSTNAME, 250)
         ->setHtmlAttribute('placeholder', 'název závodu*');
    $form->addSelect('comp_type', 'typ závodu', array('rychlost' => 'rychlost', 'obtížnost' => 'obtížnost', 'boulder' => 'boulder', 'monky_cup' => 'monky cup'))
         ->setPrompt('-----');
    $form->addSelect('comp_for', 'závod pro', array('děti' => 'děti', 'dospělé' => 'dospělé', 'všechny' => 'všechny'))
         ->setPrompt('-----');
    $form->addText('start', 'Předpokládaný start závodu')
         ->setHtmlType('datetime-local');
    $form->addText('end',  'předpokládaný konec závodu')
         ->setHtmlType('datetime-local')
         ->setDefaultValue("2020-07-31T00:08");
    $form->addText('online_registration_start', 'start online registrace')
         ->setHtmlType('datetime-local');
    $form->addText('online_registration_end', 'konec online registrace')
         ->setHtmlType('datetime-local');
    $form->addUpload('plan_url', 'propozice v pdf')
         ->addRule(Form::MAX_FILE_SIZE, 'Maximum file size is 1 MB.', 1000 * 1024 /* size in Bytes */);

    if($this->getParameter('id')) {
      $form->setDefaults($this->data);
    }

    $form->addSubmit('registration', 'přidat');
    $form->onSuccess[] = [$this, 'CompFormSucceeded'];
    return $form;
  }

  public function createComponentCompRegistrationForm() {
    return new Nette\Application\UI\Multiplier(function () {
      $form = new Form();
      $form->addText('id_racer')
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
        $form->addText('id_racer')
             ->setDefaultValue($this->getParameter('id'));
        $form->addSubmit('registration', 'odhlásit');
        $form->onSuccess[] = [$this, 'CompUnregistrationFormSucceeded'];
        return $form;
      });
  }

  public function createComponentCatForm() {
    $form = new Form();
    $form->addText('name', 'název kategorie *')
         ->setRequired('název kategorie: ' . \Constants::FORM_MSG_REQUIRED)
         ->addRule(FORM::MAX_LENGTH, \Constants::FORM_LONG, 30);
    $form->addSelect('gender', 'kategorie *', array('muž' => 'mužská', 'žena' => 'ženska', 'muž i žena' => 'smíšená' ))
         ->setPrompt('-')
         ->setRequired('pohlaví: ' .\Constants::FORM_MSG_REQUIRED);
    $form->addSelect('year_from', 'od roku (nejmladší) *', $this->RacerModel->yearsForSelect())
         ->setPrompt('-')
         ->setRequired('nejmladší:' .\Constants::FORM_MSG_REQUIRED);
    $form->addSelect('year_to', 'do roku (nejstarší) *', $this->RacerModel->yearsForSelect())
         ->setPrompt('-')
         ->setRequired('nejstarší:' .\Constants::FORM_MSG_REQUIRED);
    $form->addSelect('result_system', 'vyhodnocení *', array('amatérské' => 'amatérské', 'závodní' => 'závodní', 'monkey_cup' => 'monky cup'))
         ->setDefaultValue('amatérské');
    $form->addSelect('comp_type', 'typ závodu', array('obtížnost' => 'obtížnost', 'boulder' => 'boulder', 'rychlost' => 'rychlost', 'monky_cup' => 'monky cup'))
         ->setRequired('Vyhodnocení: ' . \Constants::FORM_MSG_REQUIRED)
         ->setPrompt('-');
    $form->addSelect('bonus_first_try', 'Při shodném výsledku rozhoduje flash', array('0' => 'Ne', '1' => 'Ano'))
         ->setRequired('název kategorie: ' . \Constants::FORM_MSG_REQUIRED)
         ->setDefaultValue('0');
    $form->addText('boulder_count', 'počet bouldrů')
         ->addRule(FORM::RANGE, 'Mezi %d a %d',[0, 30] )
         ->setHtmlType("number");
    $form->addHidden('comp_id')
         ->setDefaultValue($this->getParameter('id'));

    if($this->getParameter('cat')) {
      $this->CatModel->initIdEntit($this->getParameter('cat'));
      $form->setDefaults($this->CatModel->getRow());
    }
    $form->addSubmit('registration', 'přidat');
    $form->onSuccess[] = [$this, 'CatFormSucceeded'];
    return $form;
  }

  public function createComponentSettingCompForm() {
    $form = new Form();
    $form->addSelect('open_result', 'povolit zadávání výsledků', array(1 => 'ano', 0 => 'ne'))
         ->setDefaultValue(0);
    $form->addSelect('preregistration_open', 'povolit předregistraci', array(1 => 'ano', 0 => 'ne'))
      ->setDefaultValue(0);
    $form->addSelect('preregistration_visible', 'přístupná předregistrace', array(1 => 'ano', 0 => 'ne'))
      ->setDefaultValue(0);
    $form->addSelect('comp_edit', 'možnost editovat závod', array(1 => 'ano', 0 => 'ne'))
      ->setDefaultValue(0);
    $form->addSubmit('send', 'nastavit');

    $form->setDefaults($this->CompModel->getRow(null, $this->getParameter('id')));
    $form->onSubmit[] = [$this, 'SettingCompFormSucceeded'];
    return $form;
  }

  /*  ---------FormSucceeded--------*/

  public function ArticleFormSucceeded( form $form) {
    $values = $form->values;
    try {
      if($this->getParameter('id')) {
          $values['user_id'] = $this->user->getId();
          $this->ArticleModel->update($values, $this->getParameter('id'), true);
      } else {
          $values['user_id'] = $this->user->getId();
          $this->ArticleModel->insert($values);
        }
      $this->flashMessage('Článek byl úspešně uložen do databáze.');
      $this->redirect('this');
    } catch (\Exception $e) {
      $this->flashMessage('Vložení dat do databáze se nepovedlo.'.$e->getMessage());
      $this->redirect('this');
    }
  }
  public function SettingCompFormSucceeded(Form $form) {
    $values = $form->values;
    bdump($values);

    try {
      $this->CompModel->update($values, $this->getParameter('id'));
      $this->flashMessage('Hodnoty uspesne ulozeny');
    } catch (\Exception $e) {
      $this->flashMessage('Uprava se nepovedla');
    }



  }
  public function CompRegistrationFormSucceeded(Form $form) {
    $values = $form->values;
    $this->RacerModel->insert(array('comp_id' => $form->getName(), 'racer_id' => $values->id_racer), 'prereg');
    $this->flashMessage('Závodník byl úspěšně přihlášen na závod.');
    $this->redirect('Administration:preRegistration', array('id' => $values->id_racer));
  }

  public function CompUnregistrationFormSucceeded(Form $form) {
    $values = $form->values;
    $id = $this->CompModel->isPrereg($values->id_racer,$form->getName() );
    $this->RacerModel->delete('prereg', $id);
    $this->flashMessage('Závodník byl úspěšně odhlášen ze závodu.');
    $this->redirect('Administration:preRegistration', array('id' => $values->id_racer));
  }
  public function RacerFormSucceeded(Form $form) {
    $values = $form->values;
    $values['user_id'] = $this->user->getId();

    try {
      if($this->getParameter('id')){
        $this->RacerModel->update($values);
        $this->flashMessage('Závodník byl úspěšně upraven.');
      } else {
        $this->RacerModel->insert($values);
        $this->flashMessage('Závodník byl úspěšně uložen.');
      }
    } catch (\Exception $e) {
      $this->flashMessage('Vložení dat do databáze se nepovedlo.');
    }
    $this->getParameter('id') ? $this->redirect('Administration:myRacers') : $this->redirect('Administration:myRacers');
  }

  public function CompFormSucceeded(Form $form) {
    $values = $form->values;
    try {
      $prepare_values = $this->CompModel->prepareValues($values);
      if($this->getParameter('id')){
        $this->CompModel->update($prepare_values);
        if($values['comp_type'] == 'monky_cup') {
          $this->CatModel->prepareCategoriesForMonkeyCup($this->getParameter('id'));
        }
        $this->flashMessage('Závod byl úspěšně upraven.');
      } else {
        $a = $this->CompModel->insert($prepare_values);
        if($values['comp_type'] == 'monky_cup') {
          $this->CatModel->prepareCategoriesForMonkeyCup($a->id_comp);
        }
        $this->flashMessage('Závod byl úspěšně uložen.');
      }
    } catch (\Exception $e) {
      $this->flashMessage($e->getMessage().'Vložení dat do databáze se nepovedlo.');
    }
    $this->getParameter('id') ? $this->redirect('Administration:myComps') : $this->redirect('Administration:Administration');
  }

  public function CatFormSucceeded(Form $form) {
    $values = $form->values;

    try {
      if($this->getParameter('cat')){
        $this->CatModel->update($values, $this->getParameter('cat'), false, 'category');
        $this->flashMessage('Kategorie byla úspěšně uložena.');
      } else {
        $this->CatModel->insert($values);
        $this->flashMessage('Kategorie byla úspěšně uložena.');
      }
    } catch (\Exception $e) {
      $this->flashMessage($e->getMessage().'Vložení dat do databáze se nepovedlo.');
    }
    $this->redirect('Administration:compSetting', array('id' => $values->comp_id));
  }
}