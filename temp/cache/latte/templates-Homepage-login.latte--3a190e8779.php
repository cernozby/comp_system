<?php
// source: C:\xampp\htdocs\comp_system\app/templates/Homepage/login.latte

use Latte\Runtime as LR;

final class Template3a190e8779 extends Latte\Runtime\Template
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
		echo Nette\Bridges\FormsLatte\Runtime::renderFormBegin($form = $_form = $this->global->formsStack[] = $this->global->uiControl["loginForm"], []);
?>


  <div class="cotainer">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card bg-gray-light">
          <div class="card-header bg-warning"><span class="panel-title">Přihlášení do systému BOZALA</span></div>
          <div class="card-body">


            <div class="form-group row">
              <div class="col-md-12">
                <div class="input-group">
                  <span class="input-group-addon bg-warning"> <i class="fa fa-envelope"></i> </span>
                  <?php echo end($this->global->formsStack)["email"]->getControl()->addAttributes(['class'=>"form-control"]) /* line 16 */ ?>

                </div>
              </div>
            </div>

            <div class="form-group row">
              <div class="col-md-12">
                <div class="input-group">
                  <span class="input-group-addon bg-warning"> <i class="fa fa-lock"></i> </span>
                  <?php echo end($this->global->formsStack)["passwd"]->getControl()->addAttributes(['class'=>"form-control"]) /* line 25 */ ?>

                </div>
              </div>
            </div>

            <?php echo end($this->global->formsStack)["login"]->getControl()->addAttributes(['class'=>"btn btn-warning btn-block text-dark"]) /* line 30 */ ?>

          </div>
        </div>
      </div>
    </div>
  </div>
  <br>
  <div class="container">
    <div class="row justify-content-center">
    <p>pokud jste zapoměli heslo, klidkněte <a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Homepage:forgetPasswd")) ?>">zde.</a></p>
    </div>
  </div>
<?php
		echo Nette\Bridges\FormsLatte\Runtime::renderFormEnd(array_pop($this->global->formsStack));
?>




<?php
	}

}
