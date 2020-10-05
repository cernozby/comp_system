<?php
// source: C:\xampp\htdocs\comp_system\app/templates/Administration/myRacers.latte

use Latte\Runtime as LR;

final class Template2041a036ff extends Latte\Runtime\Template
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
			foreach (array_intersect_key(['n' => '20', 'r' => '17'], $this->params) as $_v => $_l) {
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
		$i = 1;
?>
<table class="table table-hover border text-center">
  <thead class="bg-warning">
  <tr>
    <th scope="col">#</th>
    <th scope="col">Jméno</th>
    <th scope="col">Rok Narození</th>
    <th scope="col">Oddíl / Sponzor</th>
    <th scope="col">Závody</th>
    <th scope="col" class="text-center">Úpravy</th>
    <th scope="col" colspan="2">Předregistrace</th>
  </tr>
  </thead>
  <tbody>
<?php
		$iterations = 0;
		foreach ($iterator = $this->global->its[] = new LR\CachingIterator($racers) as $r) {
?>
  <tr>
<?php
			$comp=null;
			?>    <?php
			$iterations = 0;
			foreach ($iterator = $this->global->its[] = new LR\CachingIterator($compModel->getPreregistredCompsName($r->id_racer)) as $n) {
				?> <?php
				$comp .= $n->name;
				if (!$iterator->isLast()) {
					?> <?php
					$comp .= ', ';
				}
				$iterations++;
			}
			array_pop($this->global->its);
			$iterator = end($this->global->its);
?>

    <th scope="row" class="align-middle"><?php echo LR\Filters::escapeHtmlText($i++) /* line 21 */ ?></th>
    <td class="align-middle"><?php echo LR\Filters::escapeHtmlText($r->first_name) /* line 22 */ ?> <?php
			echo LR\Filters::escapeHtmlText($r->last_name) /* line 22 */ ?></td>
    <td class="align-middle"><?php echo LR\Filters::escapeHtmlText($r->born) /* line 23 */ ?></td>
    <td class="align-middle"><?php
			if (empty($r->club)) {
				?><span class="text-danger text-bold h5" >X</span><?php
			}
			else {
				echo LR\Filters::escapeHtmlText($r->club) /* line 24 */;
			}
?></td>
    <td class="align-middle" title="<?php echo LR\Filters::escapeHtmlAttr($comp) /* line 25 */ ?>"><?php
			echo LR\Filters::escapeHtmlText(($this->filters->truncate)($comp, 40)) /* line 25 */ ?></td>
    <td class="align-middle">
      <a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiPresenter->link("Administration:newRacer", [$r->id_racer])) ?>" class="btn" title="upravit">
        <i class="fas fa-pencil-alt fa-sm"></i>
      </a>
      <a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiPresenter->link("deleteItem!", ['type'=>'RacerModel', 'entity_id'=>$r->id_racer])) ?>" title="smazat" class="btn">
        <i class="fa fa-trash fa-sm"></i>
      </a>
    </td>
    <td class="align-middle">
<?php
			if (($compModel->getCompForRegister($r->id_racer) || $compModel->getPreregistredCompsName($r->id_racer)) || $user->isInRole('admin')) {
				?>      <a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiPresenter->link("Administration:preRegistration", ['id'=>$r->id_racer])) ?>" class="btn btn-warning text-dark">předregistrovat</a>
<?php
			}
			else {
?>
        Žádný závod k přeregistraci
<?php
			}
?>
    </td>
  </tr>
<?php
			$iterations++;
		}
		array_pop($this->global->its);
		$iterator = end($this->global->its);
?>
  </tbody>
</table>
<?php
	}

}
