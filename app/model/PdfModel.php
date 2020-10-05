<?php

use Mpdf\Mpdf;
use Nette\Utils\Html;

class PdfModel extends BaseModel {
  /**
   * ResultModel constructor.
   * @param \Nette\Database\Context $database
   * @param \Nette\DI\Container $container
   */
  public $CompModel;
  public $CatModel;
  public $RacerModel;
  public $ResultModel;

  const LOGOS = array(
        0 => 'monky_cup_logo.jpg',
        1 => 'chocen_logo.png',
        2 => 'duha_logo.png',
        3 => 'hk_la_logo.png',
        4 => 'horo_ct_logo.png',
        5 => 'monky_cup_logo.jpg'
  );

  const STYLE_RESULT = 'result',
        STYLE_STARTERS = 'starters',
        STYLE_NOTE_RESULT = 'noteResult';


  public function __construct(Nette\Database\Context $database, Nette\DI\Container $container) {
    parent::__construct($database, $container);
    $this->CompModel = $container->createService('CompModel');
    $this->CatModel = $container->createService('CatModel');
    $this->RacerModel = $container->createService('RacerModel');
    $this->ResultModel = $container->createService('ResultModel');

  }

  public function getStyle($type) {
    $result = '';

    if($type == self::STYLE_NOTE_RESULT) {
      $result = '
<style>
.result {
    text-align: center;
    border: thin solid black;
    border-collapse: collapse;
    border-spacing: unset;
    margin: 0px;
    font-size: 12px;
}
.result thead tr th {
    text-align: center;
    border: thin solid black;
    font-size: 14px;
}
.result tbody tr td {
    text-align: center;
    border-bottom: thin solid black;
    padding: 5px;
}
.result thead tr .left, .result  tbody tr .left  {
    text-align: left !important;
    padding-left: 5px;
}
.border {
    border-left: thin solid black;
}
.h1 {
    text-align: center;
    font-size: 15px;
    font-weight: bold;
}
.title {
    font-size: 17px;
}
.print {
    margin-left: auto;
    margin-right: auto;
    width: 100%;
}
.print .left{
    text-align: left;
}
.print .right {
    text-align: right;
}
.orange {
    background: orange;
}
</style>';

    } elseif ($type == self::STYLE_RESULT) {

      $result = '<style>
.result {
    text-align: center;
    border: thin solid black;
    border-collapse: collapse;
    border-spacing: unset;
    margin: 0px;
    font-size: 12px;
}
.result thead tr th {
    text-align: center;
    border: thin solid black;
}
.result tbody tr td {
    text-align: center;
    border-left: thin solid black;
}
.result thead tr .left, .result  tbody tr .left {
    text-align: left !important;
    padding-left: 5px;
}
.h1 {
    text-align: center;
    font-size: 15px;
    font-weight: bold;
}
.title {
    font-size: 17px;
}
.print {
    margin-left: auto;
    margin-right: auto;
    width: 100%;
}
.print .left{
    text-align: left;
}
.print .right {
    text-align: right;
}
.orange {
    background: orange;
}
</style>';

    } elseif ($type == self::STYLE_STARTERS) {
      $result = '<style>
.result {
    text-align: center;
    border: thin solid black;
    border-collapse: collapse;
    border-spacing: unset;
    margin: 0px;
    font-size: 12px;
}
.result thead tr th {
    text-align: center;
    border: thin solid black;
}
.result tbody tr td {
    text-align: center;
    border-left: thin solid black;
}
.result thead tr .left, .result  tbody tr .left  {
    text-align: left !important;
    padding-left: 5px;
}
.h1 {
    text-align: center;
    font-size: 15px;
    font-weight: bold;
}

.title {
    font-size: 17px;
}
.print {
    margin-left: auto;
    margin-right: auto;
    width: 100%;
}

.print .left{
    text-align: left;
}

.print .right {
    text-align: right;
}

.orange {
    background: orange;
}
</style>';
    }
    return $result;
  }


  public function tdWithImage($path) : Html {
    return Html::el('td')
               ->addHtml(Html::el('img')
               ->addAttributes(array(  'src' => $path, 'width' => 128)));
  }

  public function addLogosTable($logos = null) : Html {
    if(!$logos) {
      $logos = self::LOGOS;
    }
    $table = Html::el('table width=100%');
    $row = Html::el('tr');
    foreach ($logos as $logo) {
    $row->addHtml($this->tdWithImage("../www/images/". $logo));
    }
    return $table->addHtml($row);
  }

  public function addCompName($id_comp) : Html {
    $comp = $this->CompModel->db->table('comp')->get($id_comp);
    return Html::el('p')->class('h1')->addText($comp->name .' '. date('d. m. Y'));
  }

  public function addCompNameAndType($id_comp, $typeText) {
    $p = $this->addCompName($id_comp);
    $p->addHtml(Html::el('br'));
    $p->addHtml(Html::el('br'));
    $p->addHtml(Html::el('span')->class('title')->addText(mb_strtoupper($typeText)));
    return $p;
  }

  public function addAuthorAndTime() {
    $date = date('Y') == 2020 ? '2020' : '2020 - ' . date('Y');

    $tr = Html::el('tr')->addHtml(Html::el('td')->class('left')->addText('Tisk '. date('H: i: s')));
    $tr->addHtml( Html::el('td')->class('right')->addText('© Zbyšek Černohous '.$date));
    return Html::el("table text-align='center'")->class('print')->addHtml($tr);
  }

  public function getNoteResult($id_comp, $id_cat) {
    $cat_name = $this->CatModel->createCatName($id_cat);
    $category = $this->getRow('category', $id_cat);
    $countOfColums = 2*$category->boulder_count + $category->route_count + $category->speed_count + 3;
    $racers = $this->CompModel->getRacerByCategory($id_comp, $id_cat);

    $base = Html::el('null');
    $base->addHtml($this->addLogosTable());
    $base->addHtml($this->addCompNameAndType($id_comp,'Zapisovací listina'));

    //set table head
    $table = Html::el('table width="100%"')->class('result');
    $thead = Html::el('thead');

    $row = Html::el('tr');
    $row->addHtml(Html::el('th colspan="'.$countOfColums.'"')->addText('Kategorie: ' . $cat_name)->class('left'));
    $thead->addHtml($row);

    $row = Html::el('tr');
    $row->addHtml(Html::el('th')->class('left')->addText('Jméno'));
    $row->addHtml(Html::el('th')->addText('Ročník'));
    $row->addHtml(Html::el('th')->class('left')->addText('Oddíl'));

    for ($i = 1; $i <= $category->boulder_count; $i++) {
      $row->addHtml(Html::el('th')->addText("b{$i}z"));
      $row->addHtml(Html::el('th')->addText("b{$i}t"));
    }
    for ($i = 1; $i <= $category->route_count; $i++) {
      $row->addHtml(Html::el('th')->addText("cesta{$i}"));

    }
    for ($i = 1; $i <= $category->speed_count; $i++) {
      $row->addHtml(Html::el('th')->addText("cas{$i}"));
    }

    $table->addHtml($thead->addHtml($row));

    $tbody = Html::el('tbody');
    foreach ($racers as $r) {
      $row = Html::el('tr');
      $row->addHtml(Html::el('td')->class('border')->addText($r->first_name .' '. $r->last_name)->class('left'));
      $row->addHtml(Html::el('td')->class('border')->addText($r->born));
      $row->addHtml(Html::el('td')->class('left border')->addText($r->club));
      for($i = 1; $i <= ($countOfColums-3); $i++) {
        $row->addHtml(Html::el('td')->class('border'));
      }
      $tbody->addHtml($row);
    }

    $base->addHtml($table->addHtml($tbody));
    $base->addHtml($this->addAuthorAndTime());

    $base->addHtml($this->getStyle(self::STYLE_NOTE_RESULT));
    return $base;
  }

  public function getStartersToPrint($id_comp, $id_cat) {
    $racers = $this->CompModel->getRacerByCategory($id_comp, $id_cat);
    $cat_name = $this->CatModel->createCatName($id_cat);
    $base = Html::el('null');
    $base->addHtml($this->addLogosTable());
    $base->addHtml($this->addCompNameAndType($id_comp,'startovní listina'));

    //set table head
    $table = Html::el('table width="100%"')->class('result');
    $thead = Html::el('thead');

    $row = Html::el('tr');
    $row->addHtml(Html::el('th colspan="3"')->addText('Kategorie: ' . $cat_name)->class('left'));
    $thead->addHtml($row);

    $row = Html::el('tr');
    $row->addHtml(Html::el('th')->class('left')->addText('Jméno'));
    $row->addHtml(Html::el('th')->addText('Ročník'));
    $row->addHtml(Html::el('th')->class('left')->addText('Oddíl'));

    $table->addHtml($thead->addHtml($row));

    $tbody = Html::el('tbody');
    foreach ($racers as $r) {
      $row = Html::el('tr');
      $row->addHtml(Html::el('td')->addText($r->first_name .' '. $r->last_name)->class('left'));
      $row->addHtml(Html::el('td')->addText($r->born));
      $row->addHtml(Html::el('td')->class('left')->addText($r->club));
      $tbody->addHtml($row);
    }
    $table->addHtml($tbody);

    $base->addHtml($table);
    $base->addHtml($this->addAuthorAndTime());

    $base->addHtml($this->getStyle(self::STYLE_STARTERS));
    return $base->toHtml();

  }


  public function getResultToPrint($id_comp, $id_cat) {
    $results = $this->ResultModel->getResultToRender($id_comp, $id_cat);
    $cat_name = $this->CatModel->createCatName($id_cat);
    $base = Html::el('null');
    $base->addHtml($this->addLogosTable());
    $base->addHtml($this->addCompNameAndType($id_comp, 'výsledková listina'));



    //set table head
    $table = Html::el('table width="100%"')->class('result');
    $thead = Html::el('thead');
    $row = Html::el('tr');
    $row->addHtml(Html::el('th colspan="4"')->addText('Kategorie: ' . $cat_name)->class('left'));
    $row->addHtml(Html::el('th colspan="15"')->addText('Závod'));
    $thead->addHtml($row);
    $row = Html::el('tr');
    $row->addHtml(Html::el('th')->setAttribute('width', 60)->class('orange')->addText('Poř.'));
    $row->addHtml(Html::el('th')->setAttribute('width', 150)->addText('Jméno.'));
    $row->addHtml(Html::el('th')->setAttribute('width', 20)->addText('Ročník.'));
    $row->addHtml(Html::el('th')->setAttribute('width', 200)->addText('Oddíl'));

    foreach ($results as $r) {
      $iterator = 0;
      foreach (array_keys($r) as $name){
        if($name != 'racer_id' && count($r)-2 > $iterator) {
          if($name[0] == 'Q') {
            $row->addHtml(Html::el('th')->class('orange')->addText($name));
          } else {
            $row->addHtml(Html::el('th')->addText($name));

          }
        }
        $iterator++;
      }
      break;
    }
    $row->addHtml(Html::el('th')->addText('celkem.'));
    $thead->addHtml($row);

    //set table body
    $tbody = Html::el('tbody');
    foreach ($results as $r) {
      $row = Html::el('tr');

      foreach ($r as $key => $item) {
        if ($key == 'racer_id') {
          $racer = $this->RacerModel->getRow('racer', $item);
          $row->addHtml(Html::el('td')->class('orange')->addText($r['place'].'.'));
          $row->addHtml(Html::el('td')->addText($racer->first_name .' '. $racer->last_name)->class('left'));
          $row->addHtml(Html::el('td')->addText($racer->born));
          $row->addHtml(Html::el('td')->addText($racer->club)->class('left'));
        } elseif ($key[0] == 'Q') {
          $row->addHtml(Html::el('td')->class('orange')->addText($item));
        } elseif($key != 'place' ) {
          $row->addHtml(Html::el('td')->addText($item));
        }
      }
      $tbody->addHtml($row);
    }

    //add to base
    $table->addHtml($thead);
    $table->addHtml($tbody);
    $base->addHtml($table);
    $base->addHtml($this->addAuthorAndTime());

    $base->addHtml($this->getStyle(self::STYLE_RESULT));
    return $base->toHtml();
  }


}