<?php
// source: C:\xampp\htdocs\comp_system\app/templates/Competition/listOfPrereg.latte

use Latte\Runtime as LR;

final class Template8992b6e969 extends Latte\Runtime\Template
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
			foreach (array_intersect_key(['c' => '6', 'key' => '24, 30', 'p' => '24, 30', 'word' => '54', 'x' => '48, 66'], $this->params) as $_v => $_l) {
				trigger_error("Variable \$$_v overwritten in foreach on line $_l");
			}
		}
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	public function blockContent(array $_args): void
	{
		extract($_args);
		if (!$id) {
?>
    <div class="text-center">
      <div class="row">
        <p class="h2">
<?php
			$iterations = 0;
			foreach ($CompPrereg as $c) {
?>
        <div class="col-lg-6 col-md-6 d-flex justify-content-center">
          <a class="btn col-lg-8 col-md-8 bg-warning mt-4 p-4" title="<?php echo LR\Filters::escapeHtmlAttr($c->name) /* line 8 */ ?>"  href="<?php
				echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("this", ['id'=>$c->id_comp])) ?>">
            <i class=" fa fa-trophy fa-5x "></i>
            <br><b><?php echo LR\Filters::escapeHtmlText($c->name) /* line 10 */ ?></b>
            <br> datum: <?php echo LR\Filters::escapeHtmlText(($this->filters->date)($c->start, '%d.%m.%Y')) /* line 11 */ ?>

          </a>
        </div>
<?php
				$iterations++;
			}
?>
        </p>
      </div>
<?php
			if (!$CompPrereg) {
?>
        <h2>Není dostupná předregistrace žádného závodu.</h2>
<?php
			}
?>
    </div>
<?php
		}
		else {
?>
    <div class="text-center">
<?php
			$count = 0;
			;
			$iterations = 0;
			foreach ($prereg['prereg'] as $key => $p) {
				$count = $count + count($p);
				$iterations++;
			}
			?>    <h3>Celkový počet předregistrovaných závodníků: <span class="<?php
			if ($count < 110) {
				?>text-success<?php
			}
			elseif ($count < 120) {
				?> text-warning <?php
			}
			else {
				?> text-danger<?php
			}
			?>"><?php echo LR\Filters::escapeHtmlText($count) /* line 27 */ ?></span></h3>
    </div>

<?php
			$iterations = 0;
			foreach ($prereg['prereg'] as $key => $p) {
				$i = 1;
?>
    <table class="table table-hover border text-center">
      <thead class="bg-warning">
      <tr style="border-bottom: 3px solid black !important;">
        <th colspan="100%" class="text-left"><?php echo LR\Filters::escapeHtmlText(($this->filters->upper)($key)) /* line 35 */ ?> </th>
      </tr>
      <tr >
        <th scope="col" class="text-left" >#</th>
        <th scope="col" style="width: 30%">Jméno</th>
        <th scope="col" style="width: 30%">Rok Narození</th>
        <th scope="col" style="width: 30%">Oddíl / Sponzor</th>
<?php
				if ($user->isInRole('admin')) {
?>
          <th scope="col" style="width: 30%">Akce</th>
<?php
				}
?>
      </tr>
      </thead>
      <tbody>
<?php
				$iterations = 0;
				foreach ($p as $x) {
					$id_cat = $x->id_cat;
					?>        <tr <?php
					if ($user->isInRole('admin')) {
						?> class="bg-light-green" <?php
					}
?>>
          <td scope="row" class="align-middle text-left" ><?php echo LR\Filters::escapeHtmlText($i++) /* line 51 */ ?></td>
          <td class="align-middle" ><?php echo LR\Filters::escapeHtmlText($x->first_name) /* line 52 */ ?>&nbsp<?php
					echo LR\Filters::escapeHtmlText($x->last_name) /* line 52 */ ?></td>
          <td class="align-middle" ><?php echo LR\Filters::escapeHtmlText($x->born) /* line 53 */ ?></td>
          <td class="align-middle" ><?php
					$iterations = 0;
					foreach (explode(' ', $x->club) as  $word) {
						echo LR\Filters::escapeHtmlText($word) /* line 54 */ ?>&nbsp;<?php
						$iterations++;
					}
?>

          </td>
<?php
					if ($user->isInRole('admin')) {
?>
          <td class="align-middle" >
              <?php
						/* line 58 */
						echo Nette\Bridges\FormsLatte\Runtime::renderFormBegin($form = $_form = $this->global->formsStack[] = $this->global->uiControl["compUnregistrationForm-$x->id_racer"], []);
?>

                <?php echo end($this->global->formsStack)["id_comp"]->getControl()->addAttributes(['class'=>'hidden']) /* line 59 */ ?>

                <?php echo end($this->global->formsStack)["registration"]->getControl()->addAttributes(['class'=>"btn btn-warning text-dark "]) /* line 60 */ ?>

              <?php
						echo Nette\Bridges\FormsLatte\Runtime::renderFormEnd(array_pop($this->global->formsStack));
?>

          </td>
<?php
					}
?>
        </tr>
<?php
					$iterations++;
				}
				$iterations = 0;
				foreach ($prereg['unprereg'][$key] as $x) {
?>
          <tr class="bg-light-red">
            <td scope="row" class="align-middle text-left" ><?php echo LR\Filters::escapeHtmlText($i++) /* line 68 */ ?></td>
            <td class="align-middle" ><?php echo LR\Filters::escapeHtmlText($x->first_name) /* line 69 */ ?> <?php
					echo LR\Filters::escapeHtmlText($x->last_name) /* line 69 */ ?></td>
            <td class="align-middle" ><?php echo LR\Filters::escapeHtmlText($x->born) /* line 70 */ ?></td>
            <td class="align-middle" ><?php echo LR\Filters::escapeHtmlText($x->club) /* line 71 */ ?></td>
            <td class="align-middle">
                <?php
					/* line 73 */
					echo Nette\Bridges\FormsLatte\Runtime::renderFormBegin($form = $_form = $this->global->formsStack[] = $this->global->uiControl["compRegistrationForm-$x->id_racer"], []);
?>

                  <?php echo end($this->global->formsStack)["id_comp"]->getControl()->addAttributes(['class'=>'hidden']) /* line 74 */ ?>

                  <?php echo end($this->global->formsStack)["registration"]->getControl()->addAttributes(['class'=>"btn btn-warning text-dark"]) /* line 75 */ ?>

                <?php
					echo Nette\Bridges\FormsLatte\Runtime::renderFormEnd(array_pop($this->global->formsStack));
?>

            </td>
          </tr>
<?php
					$iterations++;
				}
				if ($user->isInRole('admin') && count($p) > 0) {
					if (isset($id_cat)) {
?>
            <tr>
              <td class="align-middle" colspan="5"><a class="btn btn-warning text-dark" target="_blank" href="<?php
						echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("startersToPdf!", ['id_comp' => $id, 'id_cat' => $id_cat])) ?>">generovat startovky</a> <a class="btn btn-warning text-dark" target="_blank" href="<?php
						echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("noteResultPdf!", ['id_comp' => $id, 'id_cat' => $id_cat])) ?>">generovat zapisovací listiny</a> </td>
            </tr>
<?php
					}
				}
?>
      </tbody>
    </table>
<?php
				$iterations++;
			}
		}
		
	}

}
