<?php
// source: C:\xampp\htdocs\comp_system\app/templates/Administration/preRegistration.latte

use Latte\Runtime as LR;

final class Template47d9c3bbea extends Latte\Runtime\Template
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
			foreach (array_intersect_key(['c' => '14'], $this->params) as $_v => $_l) {
				trigger_error("Variable \$$_v overwritten in foreach on line $_l");
			}
		}
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	public function blockContent(array $_args): void
	{
		extract($_args);
		if ($comps != null) {
?>
  <table class="table border text-center ">
    <thead class="bg-warning">
    <tr>
      <th scope="col">Jméno</th>
      <th scope="col">Datum</th>
      <th scope="col">Typ</th>
      <th scope="col">propozice</th>
      <th scope="col">Akce</th>
    </tr>
    </thead>
    <tbody>
<?php
			$iterations = 0;
			foreach ($comps as $c) {
				?>      <tr <?php
				if ($compModel->isPrereg($id_racer, $c->id_comp)) {
					?> class="bg-light-green"<?php
				}
?>>
        <td class="align-middle"><?php echo LR\Filters::escapeHtmlText($c->name) /* line 16 */ ?></td>
        <td class="align-middle"><?php echo LR\Filters::escapeHtmlText(($this->filters->date)($c->start, '%d.%m.%Y')) /* line 17 */ ?></td>
        <td class="align-middle"><?php echo LR\Filters::escapeHtmlText($c->comp_type) /* line 18 */ ?></td>
        <td class="align-middle">
<?php
				if ($c->plan_url) {
					?>          <a href="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($c->plan_url)) /* line 21 */ ?>" class="link" target="_blank">propozice</a></td>
<?php
				}
?>
        <td class="align-middle">
<?php
				if (!$compModel->isPrereg($id_racer, $c->id_comp)) {
					?>            <?php
					/* line 25 */
					echo Nette\Bridges\FormsLatte\Runtime::renderFormBegin($form = $_form = $this->global->formsStack[] = $this->global->uiControl["compRegistrationForm-$c->id_comp"], []);
?>

              <?php echo end($this->global->formsStack)["id_racer"]->getControl()->addAttributes(['class'=>'hidden']) /* line 26 */ ?>

              <?php echo end($this->global->formsStack)["registration"]->getControl()->addAttributes(['class'=>"btn btn-warning text-dark"]) /* line 27 */ ?>

            <?php
					echo Nette\Bridges\FormsLatte\Runtime::renderFormEnd(array_pop($this->global->formsStack));
?>

<?php
				}
				else {
					?>            <?php
					/* line 30 */
					echo Nette\Bridges\FormsLatte\Runtime::renderFormBegin($form = $_form = $this->global->formsStack[] = $this->global->uiControl["compUnregistrationForm-$c->id_comp"], []);
?>

              <?php echo end($this->global->formsStack)["id_racer"]->getControl()->addAttributes(['class'=>'hidden']) /* line 31 */ ?>

              <?php echo end($this->global->formsStack)["registration"]->getControl()->addAttributes(['class'=>"btn btn-warning text-dark"]) /* line 32 */ ?>

            <?php
					echo Nette\Bridges\FormsLatte\Runtime::renderFormEnd(array_pop($this->global->formsStack));
?>

<?php
				}
?>
        </td>
      </tr>
<?php
				$iterations++;
			}
?>
    </tbody>
  </table>
<?php
		}
		
	}

}
