<?php
// source: C:\xampp\htdocs\comp_system\app/templates/Competition/noteResults.latte

use Latte\Runtime as LR;

final class Template6bc4167c75 extends Latte\Runtime\Template
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
			foreach (array_intersect_key(['c' => '7, 22', 'n' => '42, 58', 'd' => '49'], $this->params) as $_v => $_l) {
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
      <a class="btn col-lg-8 col-md-8 bg-warning mt-4 p-4" title="<?php echo LR\Filters::escapeHtmlAttr($c->name) /* line 9 */ ?>"  href="<?php
				echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("this", ['id'=>$c->id_comp])) ?>">
        <i class=" fa fa-pencil-alt fa-5x "></i>
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
        <div class="col-lg-6 col-md-6">
          <a class="btn btn-add-bg bg-warning"  href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("this", ['id'=>$id_comp, 'cat'=>$c->id_category])) ?>"> <i class=" fa fa-pencil-alt fa-5x "></i> <br><br><b><?php
				echo LR\Filters::escapeHtmlText($c->name) /* line 24 */ ?></b></a>
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
		elseif ($id_comp && 'id_cat') {
			?>  <?php
			/* line 31 */
			echo Nette\Bridges\FormsLatte\Runtime::renderFormBegin($form = $_form = $this->global->formsStack[] = $this->global->uiControl["resultForm"], []);
?>

    <div class="table-responsive">
    <table class="table table-hover result-table">
      <thead class="bg-warning border">
      <tr>
        <th colspan="100%" class="text-center"><?php echo LR\Filters::escapeHtmlText($cat_name) /* line 36 */ ?></th>
      </tr>
      <tr>
        <th class="col-md-8 col-sm-8 col-xs-8 text-center">jméno</th>
        <th class="text-center ">ročník</th>
        <th class="col-md-4 col-xs-4 col-sm-4 text-center">oddíl</th>
<?php
			$iterations = 0;
			foreach ($names as $n) {
				?>          <th class="text-center"><?php echo LR\Filters::escapeHtmlText($n) /* line 43 */ ?></th>
<?php
				$iterations++;
			}
?>
      </tr>
      </thead>
      <tbody class="table-bordered">
<?php
			$i = 1;
			$iterations = 0;
			foreach ($data as $d) {
				$this->global->formsStack[] = $formContainer = $_form = is_object($i) ? $i : end($this->global->formsStack)[$i];
?>

        <?php echo end($this->global->formsStack)["id"]->getControl() /* line 52 */ ?>

      <tr ng-repeat="name in getdrugnameNewArray">
<?php
				$racer = $racerModel->getRow('racer', $d->racer_id);
				?>        <th class="text-center"> <?php echo LR\Filters::escapeHtmlText($racer->first_name) /* line 55 */ ?> <?php
				echo LR\Filters::escapeHtmlText($racer->last_name) /* line 55 */ ?> </th>
        <th class="text-center"> <?php echo LR\Filters::escapeHtmlText($racer->born) /* line 56 */ ?> </th>
        <th class="text-center"> <?php echo LR\Filters::escapeHtmlText($racer->club) /* line 57 */ ?> </th>
<?php
				$iterations = 0;
				foreach ($names as $n) {
					?>            <td><?php
					$_input = is_object($n) ? $n : end($this->global->formsStack)[$n];
					echo $_input->getControl()->addAttributes(['class' => "form-control"]) /* line 59 */ ?></td>
<?php
					$iterations++;
				}
?>
      </tr>
<?php
				array_pop($this->global->formsStack);
				$formContainer = $_form = end($this->global->formsStack);
				$i = $i + 1;
				$iterations++;
			}
?>
      </tbody>
    </table>
      <span class="d-flex justify-content-between">
        <?php if ($_label = end($this->global->formsStack)["public"]->getLabel()) echo $_label ?>

        <?php echo end($this->global->formsStack)["save"]->getControl()->addAttributes(['class' => "btn btn-warning btn-block text-dark col-lg-3 col-md-3 col-sm-3"]) /* line 69 */ ?>

      </span>
      <?php echo end($this->global->formsStack)["public"]->getControl()->addAttributes(['class' => 'form-control col-lg-3 col-md-3 col-sm-3']) /* line 71 */ ?>

    </div>
  <?php
			echo Nette\Bridges\FormsLatte\Runtime::renderFormEnd(array_pop($this->global->formsStack));
?>


<?php
		}
		
	}

}
