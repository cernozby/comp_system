<?php
// source: C:\xampp\htdocs\comp_system\app/templates/Administration/myComps.latte

use Latte\Runtime as LR;

final class Template09264ffee7 extends Latte\Runtime\Template
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
			foreach (array_intersect_key(['c' => '21'], $this->params) as $_v => $_l) {
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
<div class="table-responsive">
<table class="table table-hover border text-center">
  <thead class="bg-warning">
  <tr>
    <th class="text-center">#</th>
    <th class="text-center" >Název</th>
    <th class="text-center">typ</th>
    <th class="text-center">pro</th>
    <th class="text-center overflow">Předpokládaný start</th>
    <th class="text-center">Předpokládaný konec</th>
    <th class="text-center">start online registrace</th>
    <th class="text-center">konec online registrace</th>
    <th class="text-center">propozice v pdf</th>
    <th class="text-center" style="width: 200px">Úpravy</th>
  </tr>
  </thead>
  <tbody>
<?php
		$iterations = 0;
		foreach ($comps as $c) {
?>
    <tr >
      <th scope="row"><?php echo LR\Filters::escapeHtmlText($i++) /* line 23 */ ?></th>
      <td <?php
			if (strlen($c->name) > 30) {
				?>title="<?php echo LR\Filters::escapeHtmlAttr($c->name) /* line 24 */ ?>" <?php
			}
			?> class="title"><?php echo LR\Filters::escapeHtmlText(($this->filters->truncate)($c->name, 31)) /* line 24 */ ?></td>
      <td><?php
			if (empty($c->comp_type)) {
				?><span class="text-danger text-bold h5" >X</span><?php
			}
			else {
				echo LR\Filters::escapeHtmlText($c->comp_type) /* line 25 */;
			}
?></td>
      <td><?php
			if (empty($c->comp_for)) {
				?><span class="text-danger text-bold h5" >X</span><?php
			}
			else {
				echo LR\Filters::escapeHtmlText($c->comp_for) /* line 26 */;
			}
?></td>
      <td><?php
			if (empty($c->start)) {
				?><span class="text-danger text-bold h5" >X</span><?php
			}
			else {
				echo LR\Filters::escapeHtmlText(($this->filters->date)($c->start, '%d.%m.%Y %H:%M')) /* line 27 */;
			}
?></td>
      <td><?php
			if (empty($c->end)) {
				?><span class="text-danger text-bold h5" >X</span><?php
			}
			else {
				echo LR\Filters::escapeHtmlText(($this->filters->date)($c->end, '%d.%m.%Y %H:%M')) /* line 28 */;
			}
?></td>
      <td><?php
			if (empty($c->online_registration_start)) {
				?><span class="text-danger text-bold h5" >X</span><?php
			}
			else {
				echo LR\Filters::escapeHtmlText(($this->filters->date)($c->online_registration_start, '%d.%m.%Y %H:%M')) /* line 29 */;
			}
?></td>
      <td><?php
			if (empty($c->online_registration_start)) {
				?><span class="text-danger text-bold h5" >X</span><?php
			}
			else {
				echo LR\Filters::escapeHtmlText(($this->filters->date)($c->online_registration_end, '%d.%m.%Y %H:%M')) /* line 30 */;
			}
?></td>
      <td><?php
			if (empty($c->plan_url)) {
				?><span class="text-danger text-bold h5" >X</span><?php
			}
			else {
				?><a class="link" href="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($c->plan_url)) /* line 31 */ ?>" target="_blank">Náhled</a><?php
			}
?> </td>
      <td class="text-center">
        <a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiPresenter->link("Administration:newComp", [$c->id_comp])) ?>" title="upravit" class="btn">
          <i class="fas fa-pencil-alt fa"></i>
        </a>
        <a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiPresenter->link("deleteItem!", ['type'=>'CompModel', 'entity_id'=>$c->id_comp])) ?>" title="smazat" class="btn">
          <i class="fa fa-trash fa"></i>
        </a>
        <a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiPresenter->link("Administration:compSetting", ['id'=>$c->id_comp])) ?>" title="nastavení závodu" class="btn">
          <i class="fas fa-cog"></i>
        </a>
      </td>
    </tr>
<?php
			$iterations++;
		}
?>
  </tbody>
</table>
</div>
<?php
	}

}
