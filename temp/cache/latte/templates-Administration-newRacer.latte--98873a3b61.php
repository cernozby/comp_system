<?php
// source: C:\xampp\htdocs\comp_system\app/templates/Administration/newRacer.latte

use Latte\Runtime as LR;

final class Template98873a3b61 extends Latte\Runtime\Template
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
		/* line 2 */
		echo Nette\Bridges\FormsLatte\Runtime::renderFormBegin($form = $_form = $this->global->formsStack[] = $this->global->uiControl["racerForm"], []);
?>

  <div class="cotainer">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card bg-gray-light">
          <div class="card-header bg-warning"><span class="panel-title">Přidání závodníka</span></div>
          <div class="card-body">

            <div class="form-group row">
              <div class="col-md-6">
                <div class="input-group">
                  <span class="input-group-addon bg-warning"> <i class="fa fa-user"></i> </span>
                  <?php echo end($this->global->formsStack)["first_name"]->getControl()->addAttributes(['class'=>"form-control"]) /* line 14 */ ?>

                </div>
              </div>
              <div class="col-md-6">
                <div class="input-group">
                  <span class="input-group-addon bg-warning"> <i class="fa fa-user"></i> </span>
                  <?php echo end($this->global->formsStack)["last_name"]->getControl()->addAttributes(['class'=>"form-control"]) /* line 20 */ ?>

                </div>
              </div>
            </div>

            <div class="form-group row">
              <div class="col-md-6">
                <div class="input-group">
                  <span class="input-group-addon bg-warning"> <i class="fa fa-venus-mars"></i> </span>
                  <?php echo end($this->global->formsStack)["gender"]->getControl()->addAttributes(['class'=>"form-control"]) /* line 29 */ ?>

                </div>
              </div>
              <div class="col-md-6">
                <div class="input-group">
                  <span class="input-group-addon bg-warning"> <i class="fa fa-birthday-cake"></i> </span>
                  <?php echo end($this->global->formsStack)["born"]->getControl()->addAttributes(['class'=>"form-control"]) /* line 35 */ ?>

                </div>
              </div>
            </div>

            <div class="form-group row">
              <div class="col-md-12">
                <div class="input-group">
                  <span class="input-group-addon bg-warning"> <i class="fa fa-flag"></i> </span>
                  <?php echo end($this->global->formsStack)["club"]->getControl()->addAttributes(['class'=>"form-control"]) /* line 44 */ ?>

                </div>
              </div>
            </div>

            <p>Pole označené * jsou povinné</p>

            <?php echo end($this->global->formsStack)["registration"]->getControl()->addAttributes(['class'=>"btn btn-warning btn-block text-dark"]) /* line 51 */ ?>

          </div>
        </div>
      </div>
    </div>
  </div>
<?php
		echo Nette\Bridges\FormsLatte\Runtime::renderFormEnd(array_pop($this->global->formsStack));
?>



<?php
	}

}
