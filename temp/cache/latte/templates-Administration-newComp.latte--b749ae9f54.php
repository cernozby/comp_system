<?php
// source: C:\xampp\htdocs\comp_system\app/templates/Administration/newComp.latte

use Latte\Runtime as LR;

final class Templateb749ae9f54 extends Latte\Runtime\Template
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

<?php
		/* line 3 */
		echo Nette\Bridges\FormsLatte\Runtime::renderFormBegin($form = $_form = $this->global->formsStack[] = $this->global->uiControl["compForm"], []);
?>

  <div class="cotainer">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card bg-gray-light">
          <div class="card-header bg-warning"><span class="panel-title">Nový závod</span></div>
          <div class="card-body">

            <div class="form-group row">
              <div class="col-md-12">
                <div class="input-group">
                  <span class="input-group-addon bg-warning"> <i class="fa fa-tag"></i> </span>
                  <?php echo end($this->global->formsStack)["name"]->getControl()->addAttributes(['class'=>"form-control"]) /* line 15 */ ?>

                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 "><?php if ($_label = end($this->global->formsStack)["comp_type"]->getLabel()) echo $_label ?></div>
              <div class="col-md-6"><?php if ($_label = end($this->global->formsStack)["comp_for"]->getLabel()) echo $_label ?></div>
            </div>

            <div class="form-group row">
              <div class="col-md-6">
                <div class="input-group">
                  <?php echo end($this->global->formsStack)["comp_type"]->getControl()->addAttributes(['class'=>"form-control"]) /* line 28 */ ?>

                </div>
              </div>
              <div class="col-md-6">
                <div class="input-group">
                  <?php echo end($this->global->formsStack)["comp_for"]->getControl()->addAttributes(['class'=>"form-control"]) /* line 33 */ ?>

                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 "><?php if ($_label = end($this->global->formsStack)["start"]->getLabel()) echo $_label ?></div>
              <div class="col-md-6"><?php if ($_label = end($this->global->formsStack)["end"]->getLabel()) echo $_label ?></div>
            </div>
            <div class="form-group row">
              <div class="col-md-6">
                <div class="input-group">
                  <?php echo end($this->global->formsStack)["start"]->getControl()->addAttributes(['class'=>"form-control"]) /* line 45 */ ?>

                </div>
              </div>
              <div class="col-md-6">
                <div class="input-group">
                  <?php echo end($this->global->formsStack)["end"]->getControl()->addAttributes(['class'=>"form-control"]) /* line 50 */ ?>

                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 "><?php if ($_label = end($this->global->formsStack)["online_registration_start"]->getLabel()) echo $_label ?></div>
              <div class="col-md-6"><?php if ($_label = end($this->global->formsStack)["online_registration_end"]->getLabel()) echo $_label ?></div>
            </div>

            <div class="form-group row">
              <div class="col-md-6">
                <div class="input-group">
                  <?php echo end($this->global->formsStack)["online_registration_start"]->getControl()->addAttributes(['class'=>"form-control"]) /* line 63 */ ?>

                </div>
              </div>

              <div class="col-md-6">
                <div class="input-group custom-file">
                  <?php echo end($this->global->formsStack)["online_registration_end"]->getControl()->addAttributes(['class' => "form-control"]) /* line 69 */ ?>

                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12 "><?php if ($_label = end($this->global->formsStack)["plan_url"]->getLabel()) echo $_label ?></div>
            </div>
            <div class="form-group row">
              <div class="col-md-12">
                <div class="input-group">
                  <?php echo end($this->global->formsStack)["plan_url"]->getControl()->addAttributes(['class'=>"custom-file-input"]) /* line 80 */ ?>

                  <label class="custom-file-label" for="customFile">vyberte...</label>
                </div>
              </div>
            </div>


            <?php echo end($this->global->formsStack)["registration"]->getControl()->addAttributes(['class'=>"btn btn-warning btn-block text-dark"]) /* line 87 */ ?>

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
