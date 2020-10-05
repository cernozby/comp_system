<?php
// source: C:\xampp\htdocs\comp_system\app/templates/Competition/results.latte

use Latte\Runtime as LR;

final class Template3726f7c402 extends Latte\Runtime\Template
{
	public $blocks = [
		'content' => 'blockContent',
	];

	public $blockTypes = [
		'content' => 'html',
	];


	public function main(): array
	{
		extract($this->params);
		if ($this->getParentName()) {
			return get_defined_vars();
		}
		$this->renderBlock('content', get_defined_vars());
		return get_defined_vars();
	}


	public function prepare(): void
	{
		extract($this->params);
		if (!$this->getReferringTemplate() || $this->getReferenceType() === "extends") {
			foreach (array_intersect_key(['c' => '7, 22', 'name' => '50', 'h' => '48', 'word' => '73', 'i' => '81', 'k' => '66', 'item' => '66', 'array' => '64'], $this->params) as $_v => $_l) {
				trigger_error("Variable \$$_v overwritten in foreach on line $_l");
			}
		}
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	public function blockContent(array $_args): void
	{
		extract($_args);
?>

<?php
		if (!$id_comp) {
?>
  <div class="text-center">
    <div class="row">
      <p class="h2">
<?php
			$iterations = 0;
			foreach ($comps as $c) {
?>
      <div class="col-lg-6 col-md-6 d-flex justify-content-center">
        <a class="btn col-lg-8 col-md-8 bg-warning mt-4 p-4" title="<?php echo LR\Filters::escapeHtmlAttr($c->name) /* line 9 */ ?>" href="<?php
				echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("this", ['id'=>$c->id_comp])) ?>">
          <i class=" fa fa-trophy fa-5x "></i>
          <br><br><b><?php echo LR\Filters::escapeHtmlText($c->name) /* line 11 */ ?></b>
        </a>
      </div>
<?php
				$iterations++;
			}
?>
      </p>
    </div>
  </div>
<?php
		}
		elseif ($id_comp && !$id_cat) {
?>
  <div class="text-center">
    <div class="row">
      <p class="h2">
<?php
			$iterations = 0;
			foreach ($cat as $c) {
?>
      <div class="col-lg-6 col-md-6 col-sm-6">
        <a class="btn btn-add-bg bg-warning" href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("this", ['id'=>$id_comp, 'cat'=>$c->id_category])) ?>"> <i
                  class=" fa fa-trophy fa-5x "></i> <br><br><b><?php echo LR\Filters::escapeHtmlText($c->name) /* line 25 */ ?></b></a>
      </div>
<?php
				$iterations++;
			}
?>
      </p>
    </div>
  </div>
<?php
		}
		elseif ($id_comp && $id_cat) {
?>
  <div class="table-responsive">
    <table class="table table-hover result-table">
      <colgroup>
        <col style="width:40%">
        <col style="width:30%">
        <col style="width:30%">
      </colgroup>
      <thead class="bg-warning border">
      <tr>
        <th colspan="100%" class="text-center"><?php echo LR\Filters::escapeHtmlText($cat_name) /* line 41 */ ?></th>
      </tr>
      <tr>
        <th class="text-center">pořadí</th>
        <th class="text-center">jméno</th>
        <th class="text-center ">ročník</th>
        <th class="text-center">oddíl</th>
<?php
			$iterations = 0;
			foreach ($iterator = $this->global->its[] = new LR\CachingIterator($results) as $h) {
				$a = array_keys($h);
				$iterations = 0;
				foreach ($iterator = $this->global->its[] = new LR\CachingIterator($a) as $name) {
					if ($name != 'racer_id' && $name !='result' && !$iterator->isLast()) {
						if ($name != 'place') {
							?>                  <th class="text-center"><?php echo LR\Filters::escapeHtmlText($name) /* line 53 */ ?></th>
<?php
						}
					}
					$iterations++;
				}
				array_pop($this->global->its);
				$iterator = end($this->global->its);
?>
          <th class="text-center"> celkem </th>
<?php
				if ($iterator->isFirst()) break;
				$iterations++;
			}
			array_pop($this->global->its);
			$iterator = end($this->global->its);
?>
      </tr>
      </thead>
      <tbody class="table-bordered" id="tbody">

<?php
			$iterations = 0;
			foreach ($iterator = $this->global->its[] = new LR\CachingIterator($results) as $array) {
?>
        <tr>
<?php
				$iterations = 0;
				foreach ($iterator = $this->global->its[] = new LR\CachingIterator($array) as $k => $item) {
					if ($iterator->isFirst()) {
						$racer = $racerModel->getRow('racer', $item);
						?>              <th class="text-center bg-warning"><?php echo LR\Filters::escapeHtmlText($array['place']) /* line 69 */ ?>.</th>
              <th><?php echo LR\Filters::escapeHtmlText($racer->first_name) /* line 70 */ ?>&nbsp;<?php echo LR\Filters::escapeHtmlText($racer->last_name) /* line 70 */ ?></th>
              <th class="text-center"> <?php echo LR\Filters::escapeHtmlText($racer->born) /* line 71 */ ?> </th>
              <th>
                <?php
						$iterations = 0;
						foreach (explode(' ', $racer->club) as $word) {
							echo LR\Filters::escapeHtmlText($word) /* line 73 */ ?>&nbsp;<?php
							$iterations++;
						}
?>

              </th>
<?php
					}
					elseif ($iterator->isLast()) {
						?>              <th class="text-center bg-warning"><?php
						if ($item == 0) {
							?> X <?php
						}
						else {
							?> <?php echo LR\Filters::escapeHtmlText($item) /* line 76 */ ?> <?php
						}
?></th>
<?php
					}
					elseif ($k[0] == 'Q') {
						?>              <th class="text-center bg-warning"><?php
						if ($item == 0) {
							?> X <?php
						}
						else {
							?> <?php echo LR\Filters::escapeHtmlText($item) /* line 78 */ ?> <?php
						}
?></th>
<?php
					}
					elseif ($k == 'celkem') {
?>
              <th>
                <?php
						$iterations = 0;
						foreach (explode(' ', $item) as  $i) {
							echo LR\Filters::escapeHtmlText($i) /* line 81 */ ?>&nbsp;<?php
							$iterations++;
						}
?>

              </th>
<?php
					}
					elseif ($k != 'place') {
						?>              <th class="text-center"><?php echo LR\Filters::escapeHtmlText($item) /* line 84 */ ?></th>
<?php
					}
					$iterations++;
				}
				array_pop($this->global->its);
				$iterator = end($this->global->its);
?>
        </tr>
<?php
				$iterations++;
			}
			array_pop($this->global->its);
			$iterator = end($this->global->its);
?>
      </tbody>
    </table>
  </div>
  <br>
<?php
			if ($user->isInRole('admin')) {
				?>  <p><a class="btn btn-warning col-lg-3 col-md-3 col-xs-3 col-sm-3 " target="_blank" href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("resultToPDf!", ['id_comp' => $id_comp, 'id_cat' => $id_cat])) ?>">Tisk</a></p>
<?php
			}
?>

<?php
		}
		
	}

}
