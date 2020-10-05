<?php
// source: C:\xampp\htdocs\comp_system\app/templates/Administration/administration.latte

use Latte\Runtime as LR;

final class Templatea4971c6b3c extends Latte\Runtime\Template
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
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	public function blockContent(array $_args): void
	{
		extract($_args);
?>
<div class="text-center">
  <div class="row">
    <p class="h2">
    <div class="col-lg-3 col-md-3">
      <a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Administration:newRacer")) ?>" class="btn btn-add-bg bg-warning" > <i class=" fa fa-plus fa-5x "></i> <br><br><b>Nový závodník</b></a>
    </div>
<?php
		if ($myRacersCount > 0) {
?>
      <div class="col-lg-3 col-md-3">
      <a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Administration:myRacers")) ?>" class="btn btn-add-bg bg-warning" > <i class=" fa fa-users fa-5x "></i> <br><br><b><?php
			if ($myRacersCount == 1) {
				?>Můj závodník<?php
			}
			elseif ($isAdmin) {
				?> Všichni závodníci<?php
			}
			else {
				?>Moji závodníci<?php
			}
?> </b></a>
    </div>
<?php
		}
		if ($isAdmin) {
?>
      <div class="col-lg-3 col-md-3">
      <a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Administration:newComp")) ?>" class="btn btn-add-bg bg-warning" > <i class=" fa fa-plus fa-5x "></i><br><br> <b>Nový závod</b></a>
    </div>
<?php
		}
		if ($isAdmin && $myCompCount > 0) {
?>
      <div class="col-lg-3 col-md-3">
        <a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Administration:myComps")) ?>" class="btn btn-add-bg bg-warning" > <i class=" fa fa-trophy fa-5x "></i><br><br> <b><?php
			if ($myCompCount == 1) {
				?> Můj závod<?php
			}
			else {
				?>Mé závody<?php
			}
?></b></a>
      </div>
<?php
		}
		if ($isAdmin) {
?>
      <div class="col-lg-3 col-md-3">
      <a class="btn btn-add-bg bg-warning"  href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Competition:noteResults")) ?>"> <i class=" fa fa-pencil-alt fa-5x "></i> <br><br><b>Zadat výsledky</b></a>
    </div>
    <div class="col-lg-3 col-md-3">
      <a class="btn btn-add-bg bg-warning"  href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Administration:addArticle")) ?>"> <i class=" fa fa-plus fa-5x "></i> <br><br> <b>přidat článek</b></a>
    </div>
    <div class="col-lg-3 col-md-3">
      <a class="btn btn-add-bg bg-warning"  href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Administration:MyArticles")) ?>"> <i class=" fa fa-newspaper fa-5x "></i> <br><br> <b>Všechny články</b></a>
    </div>
<?php
		}
?>
      <div class="col-lg-3 col-md-3">
        <a class="btn btn-add-bg bg-warning"  href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Homepage:newPasswd")) ?>"> <i class=" fa fa-lock fa-5x "></i> <br><br> <b>Změnit Heslo</b></a>
      </div>
  </p>
  </div>
</div>




<?php
	}

}
