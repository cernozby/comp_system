<?php
// source: C:\xampp\htdocs\comp_system\app/templates/Administration/compSetting.latte

use Latte\Runtime as LR;

final class Templatec3a079eb3b extends Latte\Runtime\Template
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
			foreach (array_intersect_key(['c' => '129'], $this->params) as $_v => $_l) {
				trigger_error("Variable \$$_v overwritten in foreach on line $_l");
			}
		}
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	public function blockContent(array $_args): void
	{
		extract($_args);
?>
<div class="d-flex justify-content-around row margin-bottom">
  <button class="btn btn-warning text-dark col-lg-2 col-md-2 col-sm-2" id="first" aria-pressed="true"><b>Nastavení Kategorií</b></button>
  <button class="btn btn-warning text-dark col-lg-2 col-md-2 col-sm-2" id="second"aria-pressed="true"><b>Editace stranky zavodu</b></button>
  <button class="btn btn-warning text-dark col-lg-2 col-md-2 col-sm-2" id="third" aria-pressed="true"><b>Detailni nastavení závodu</b></button>

</div>

<div class="first" style="display:">
<?php
		/* line 10 */
		echo Nette\Bridges\FormsLatte\Runtime::renderFormBegin($form = $_form = $this->global->formsStack[] = $this->global->uiControl["catForm"], []);
?>

  <div class="cotainer">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card bg-gray-light">
          <div class="card-header bg-warning"><span class="panel-title">Přidání kategorie</span></div>
          <div class="card-body">

            <div class="row">
              <div class="col-md-6 "><?php if ($_label = end($this->global->formsStack)["name"]->getLabel()) echo $_label ?></div>
              <div class="col-md-6"><?php if ($_label = end($this->global->formsStack)["gender"]->getLabel()) echo $_label ?></div>
            </div>
            <div class="form-group row">
              <div class="col-md-6">
                <div class="input-group">
                  <span class="input-group-addon bg-warning"> <i class="fa fa-tag"></i> </span>
                  <?php echo end($this->global->formsStack)["name"]->getControl()->addAttributes(['class'=>"form-control"]) /* line 26 */ ?>

                </div>
              </div>
              <div class="col-md-6">
                <div class="input-group">
                  <span class="input-group-addon bg-warning"> <i class="fa fa-venus-mars"></i> </span>
                  <?php echo end($this->global->formsStack)["gender"]->getControl()->addAttributes(['class'=>"form-control"]) /* line 32 */ ?>

                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 "><?php if ($_label = end($this->global->formsStack)["year_from"]->getLabel()) echo $_label ?></div>
              <div class="col-md-6"><?php if ($_label = end($this->global->formsStack)["year_to"]->getLabel()) echo $_label ?></div>
            </div>
            <div class="form-group row">
              <div class="col-md-6">
                <div class="input-group">
                  <span class="input-group-addon bg-warning"> <i class="fa fa-calendar"></i> </span>
                  <?php echo end($this->global->formsStack)["year_from"]->getControl()->addAttributes(['class'=>"form-control"]) /* line 45 */ ?>

                </div>
              </div>
              <div class="col-md-6">
                <div class="input-group">
                  <span class="input-group-addon bg-warning"> <i class="fa fa-calendar"></i> </span>
                  <?php echo end($this->global->formsStack)["year_to"]->getControl()->addAttributes(['class'=>"form-control"]) /* line 51 */ ?>

                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6"><?php if ($_label = end($this->global->formsStack)["comp_type"]->getLabel()) echo $_label ?></div>
              <div class="col-md-6 "><?php if ($_label = end($this->global->formsStack)["result_system"]->getLabel()) echo $_label ?></div>
            </div>
            <div class="form-group row">
              <div class="col-md-6">
                <div class="input-group">
                  <span class="input-group-addon bg-warning"> <i class="fa fa-trophy"></i> </span>
                  <?php echo end($this->global->formsStack)["comp_type"]->getControl()->addAttributes(['class'=>"form-control"]) /* line 64 */ ?>

                </div>
              </div>
              <div class="col-md-6">
                <div class="input-group">
                  <span class="input-group-addon bg-warning"> <i class="fa fa-trophy"></i> </span>
                  <?php echo end($this->global->formsStack)["result_system"]->getControl()->addAttributes(['class'=>"form-control"]) /* line 70 */ ?>

                </div>
              </div>
            </div>


            <div id="chooseBoulderView" style="display: none">
              <div class="form-group row">
                <div class="col-md-6 d-flex align-items-center justify-content-end"><?php if ($_label = end($this->global->formsStack)["boulder_count"]->getLabel()) echo $_label ?></div>
                <div class="col-md-6">
                  <div class="input-group">
                    <span class="input-group-addon bg-warning"> <i class="fas fa-calculator		"></i> </span>
                    <?php echo end($this->global->formsStack)["boulder_count"]->getControl()->addAttributes(['class'=>"form-control"]) /* line 82 */ ?>

                  </div>
                </div>
              </div>
            </div>

            <div id="chooseResultSystemView" style="display: none">
              <div class="form-group row">
                <div class="col-md-6 d-flex align-items-center justify-content-end"><?php if ($_label = end($this->global->formsStack)["bonus_first_try"]->getLabel()) echo $_label ?></div>
                <div class="col-md-6">
                  <div class="input-group">
                    <span class="input-group-addon bg-warning"> <i class="fas fa-star		"></i> </span>
                    <?php echo end($this->global->formsStack)["bonus_first_try"]->getControl()->addAttributes(['class'=>"form-control"]) /* line 94 */ ?>

                  </div>
                </div>
              </div>
            </div>


            <p>Pole označené * jsou povinné</p>

            <?php echo end($this->global->formsStack)["registration"]->getControl()->addAttributes(['class'=>"btn btn-warning btn-block text-dark"]) /* line 103 */ ?>

          </div>
        </div>
      </div>
    </div>
  </div>
<?php
		echo Nette\Bridges\FormsLatte\Runtime::renderFormEnd(array_pop($this->global->formsStack));
?>

<?php
		if (count($cat) > 0) {
?>
  <br><br>
  <table class="table table-hover border text-center ">
    <thead class="bg-warning">
    <tr>
      <th scope="col" colspan="8">Zapsané kategorie</th>
    </tr>
    <tr>
      <th scope="col">Název</th>
      <th scope="col">pohlaví</th>
      <th scope="col">rok</th>
      <th scope="col">typ závodu</th>
      <th scope="col">vyhodnocení</th>
      <th scope="col">počet bouldrů</th>
      <th scope="col">bonus flash</th>
      <th scope="col">Úpravy</th>
    </tr>
    </thead>
    <tbody>
<?php
			$iterations = 0;
			foreach ($cat as $c) {
?>
      <tr>
        <td ><?php echo LR\Filters::escapeHtmlText($c->name) /* line 131 */ ?></td>
        <td ><?php echo LR\Filters::escapeHtmlText($c->gender) /* line 132 */ ?></td>
        <td ><?php echo LR\Filters::escapeHtmlText($c->year_from) /* line 133 */ ?> - <?php echo LR\Filters::escapeHtmlText($c->year_to) /* line 133 */ ?></td>
        <td ><?php echo LR\Filters::escapeHtmlText($c->comp_type) /* line 134 */ ?></td>
        <td ><?php echo LR\Filters::escapeHtmlText($c->result_system) /* line 135 */ ?></td>
        <td ><?php echo LR\Filters::escapeHtmlText($c->boulder_count) /* line 136 */ ?></td>
        <td ><?php echo LR\Filters::escapeHtmlText($c->bonus_first_try) /* line 137 */ ?></td>
        <td class="text-center">
          <a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiPresenter->link("Administration:compSetting", [$c->comp_id , $c->id_category])) ?>" title="upravit" class="btn">
            <i class="fas fa-pencil-alt fa"></i>
          </a>
          <a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiPresenter->link("deleteItem!", ['type'=>'CatModel', 'entity_id'=>$c->id_category])) ?>" title="smazat" class="confirn btn">
            <i class="fa fa-trash fa"></i>
          </a>
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
?>
</div>
<div class="second" style="display: none">
  aaaa</div>
<div class="third" style="display: none">
    <?php
		/* line 155 */
		echo Nette\Bridges\FormsLatte\Runtime::renderFormBegin($form = $_form = $this->global->formsStack[] = $this->global->uiControl["settingCompForm"], []);
?>

      <div class="cotainer">
        <div class="row justify-content-center">
          <div class="col-md-6">
            <div class="card bg-gray-light">
              <div class="card-header bg-warning"><span class="panel-title">Nastavení</span></div>
              <div class="card-body">

                <div class="form-group row">
                    <div class="col-md-6 "><?php if ($_label = end($this->global->formsStack)["open_result"]->getLabel()) echo $_label ?></div>
                    <div class="col-md-6 "><?php if ($_label = end($this->global->formsStack)["preregistration_open"]->getLabel()) echo $_label ?></div>

                    <div class="col-md-6">
                        <div class="input-group">
                            <?php echo end($this->global->formsStack)["open_result"]->getControl()->addAttributes(['class'=>"form-control"]) /* line 169 */ ?>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group">
                            <?php echo end($this->global->formsStack)["preregistration_open"]->getControl()->addAttributes(['class'=>"form-control"]) /* line 174 */ ?>

                        </div>
                    </div>
                </div>

                  <div class="form-group row">
                      <div class="col-md-6 "><?php if ($_label = end($this->global->formsStack)["preregistration_visible"]->getLabel()) echo $_label ?></div>
                      <div class="col-md-6 "><?php if ($_label = end($this->global->formsStack)["comp_edit"]->getLabel()) echo $_label ?></div>

                      <div class="col-md-6">
                          <div class="input-group">
                              <?php echo end($this->global->formsStack)["preregistration_visible"]->getControl()->addAttributes(['class'=>"form-control"]) /* line 185 */ ?>

                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="input-group">
                              <?php echo end($this->global->formsStack)["comp_edit"]->getControl()->addAttributes(['class'=>"form-control"]) /* line 190 */ ?>

                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="input-group">
                          </div>
                      </div>
                  </div>
                <?php echo end($this->global->formsStack)["send"]->getControl()->addAttributes(['class'=>"btn btn-warning btn-block text-dark"]) /* line 198 */ ?>

              </div>
            </div>
          </div>
        </div>
      </div>
    <?php
		echo Nette\Bridges\FormsLatte\Runtime::renderFormEnd(array_pop($this->global->formsStack));
?>

</div>

<script>

    var foo = function (view = "") {
        if(view !== "first") { $("div.first").hide();}
        if(view !== "second") { $("div.second").hide();}
        if(view !== "third") { $("div.third").hide(); }
    }

    var bar = function (view = "") {
        if(view !== "boulder") { $("#chooseBoulderView").hide();}

    }

    var fnc = function(){
        var str = $("#frm-catForm-result_system").val();
        var tmp = $("#frm-catForm-comp_type").val();
        if(str === 'amatérské' && tmp === 'boulder') {
            $("#chooseResultSystemView").show();
        } else {
            $("#chooseResultSystemView").hide();
        }
    };

    $("#first").click(function() {
        $("div.first").show();
        foo("first");
    });

    $("#second").click(function() {
        $("div.second").show();
        foo("second");
    });

    $("#third").click(function() {
        $("div.third").show();
        foo("third");
    });

    $(document).ready(function () {
        var str = $("#frm-catForm-result_system").val();
        var tmp = $("#frm-catForm-comp_type").val();
        if(str === 'amatérské' && tmp === 'boulder') {
            $("#chooseResultSystemView").show();
        }
        if(tmp === 'boulder') {
            $("#chooseBoulderView").show();
        }
    });

    $("#frm-catForm-comp_type").change(function(){
        var str = $("#frm-catForm-comp_type").val();
        if(str === 'boulder') {
            $("#chooseBoulderView").show();
        }
        bar(str);
    });

    $("#frm-catForm-comp_type").change(fnc);
    $("#frm-catForm-result_system").change(fnc)


</script><?php
	}

}
