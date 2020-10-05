<?php
// source: C:\xampp\htdocs\comp_system\app/templates/@layout.latte

use Latte\Runtime as LR;

final class Templatecdc11698f3 extends Latte\Runtime\Template
{
	public $blocks = [
		'scripts' => 'blockScripts',
	];

	public $blockTypes = [
		'scripts' => 'html',
	];


	public function main(): array
	{
		extract($this->params);
?>
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <link rel="stylesheet" href="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 8 */ ?>/css/AdminLTE.css">
  <link rel="icon" href="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 9 */ ?>/images/hk_la_logo.png">
  <!-- CSS only -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
          integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
          crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
          integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
          crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
          integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
          crossorigin="anonymous"></script>
  <script src="https://nette.github.io/resources/js/3/netteForms.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <title><?php
		if (isset($this->blockQueue["title"])) {
			$this->renderBlock('title', $this->params, function ($s, $type) {
				$_fi = new LR\FilterInfo($type);
				return LR\Filters::convertTo($_fi, 'html', $this->filters->filterContent('striphtml', $_fi, $s));
			});
			?> | <?php
		}
?>BOZALA - Bouldrové závody v Lanškrouně</title>
</head>
<div id="content">
  <body <?php
		if (!($this->global->fn->isLinkCurrent)('Homepage:default')) {
			?>class="bg-gray-light"<?php
		}
		else {
			?> class="frontPage" <?php
		}
?>} >
<?php
		$iterations = 0;
		foreach ($flashes as $flash) {
?>  <div>
    <div class="container">
      <!-- Trigger the modal with a button -->
      <button type="button" class="btn btn-info btn-lg" id="modal" data-toggle="modal" data-target="#myModal"
              hidden="true"></button>
      <!-- Modal -->
      <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
          <!-- Modal content-->
          <div class="modal-content alert text-center">
            <div class="modal-body">
              <h4><?php echo LR\Filters::escapeHtmlText($flash->message) /* line 44 */ ?><h4>
            </div>
            <div>
              <button type="button" class="btn btn-warning text-dark" data-dismiss="modal" style="width: 20%;">Zavřít
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php
			$iterations++;
		}
?>


  <nav class="navbar navbar-expand-lg navbar-light bg-warning d-flex justify-content-center" id="menu">
  <span class="container">
  <span class="d-flex align-items-center">
  <a class="" href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiPresenter->link(":Homepage:default")) ?>">
    <img src="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 61 */ ?>/images/hk_la_logo.png" height="64px">
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02"
          aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0 h3">
      <li class="nav-item d-flex align-items-center <?php
		if (($this->global->fn->isLinkCurrent)('Homepage:default')) {
			?>active<?php
		}
?>">
        <a class="nav-link" href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link(":Homepage:default")) ?>">
          <span class="fa fa-home"></span>
          Domů
        </a>
      </li>
      <li class="nav-item d-flex align-items-center <?php
		if (($this->global->fn->isLinkCurrent)('Homepage:article')) {
			?>active<?php
		}
?>">
        <a class="nav-link" href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link(":Homepage:article")) ?>">
          <span class="fa fa-newspaper" aria-hidden="true"></span>
          Aktuality
        </a>
      </li>
      <li class="nav-item d-flex align-items-center <?php
		if (($this->global->fn->isLinkCurrent)('Competition:listOfPrereg')) {
			?>active<?php
		}
?>">
        <a class="nav-link" href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link(":Competition:listOfPrereg")) ?>">
          <span class="fa fa-table"></span>
          Předregistrace
        </a>
      </li>
      <li class="nav-item d-flex align-items-center <?php
		if (($this->global->fn->isLinkCurrent)('Competition:results')) {
			?>active<?php
		}
?>">
        <a class="nav-link" href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link(":Competition:results")) ?>">
          <span class="fa fa-trophy"></span>
          Výsledky
        </a>
      </li>
<?php
		if (!$user->isLoggedIn()) {
			?>        <li class="nav-item d-flex align-items-center <?php
			if (($this->global->fn->isLinkCurrent)('Homepage:login')) {
				?>active<?php
			}
?>">
          <a class="nav-link" href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiPresenter->link(":Homepage:login")) ?>">
            <span class="glyphicon glyphicon-user"></span>
            <b>Přihlášení</b>
          </a>
        </li>
        <li class="nav-item d-flex align-items-center <?php
			if (($this->global->fn->isLinkCurrent)('Homepage:registration')) {
				?>active<?php
			}
?>">
          <a class="nav-link" href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiPresenter->link(":Homepage:registration")) ?>">
            <span class="glyphicon glyphicon-log-in"></span>
            <b>Registrace</b>
          </a>
        </li>
<?php
		}
		if ($user->isLoggedIn()) {
			?>        <li class="nav-item d-flex align-items-center <?php
			if (($this->global->fn->isLinkCurrent)('Administration:administration')) {
				?>active<?php
			}
?>">
          <a class="nav-link" href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiPresenter->link(":Administration:administration")) ?>">
            <span class="nav-link fa fa-wrench"></span>
            <b>Administrace</b>
          </a>
        </li>
        <li class="nav-item d-flex align-items-center <?php
			if (($this->global->fn->isLinkCurrent)('Homepage:Out')) {
				?>active<?php
			}
?>">
          <a class="nav-link" href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiPresenter->link(":Homepage:Out")) ?>">
            <span class="nav-link glyphicon glyphicon-log-out"></span>
            <b>Odhlásit</b>
          </a>
        </li>
<?php
		}
?>
    </ul>
  </div>
</span>
  </span>
  </nav>
  <article class="container bg-white margin-bottom pad">
<?php
		$this->renderBlock('content', $this->params, 'html');
?>
  </article>

</div>
<!-- Footer -->
<footer id="sticky-footer" class="py-4 bg-warning text-dark">
  <div class="container text-center">
    <small>Copyright &copy; 2020 Zbyšek Černohous</small>
  </div>
</footer>
<?php
		if ($this->getParentName()) {
			return get_defined_vars();
		}
		$this->renderBlock('scripts', get_defined_vars());
?>
</body>
</html>
<?php
		return get_defined_vars();
	}


	public function prepare(): void
	{
		extract($this->params);
		if (!$this->getReferringTemplate() || $this->getReferenceType() === "extends") {
			foreach (array_intersect_key(['flash' => '33'], $this->params) as $_v => $_l) {
				trigger_error("Variable \$$_v overwritten in foreach on line $_l");
			}
		}
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	public function blockScripts(array $_args): void
	{
		extract($_args);
?>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>



  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">

  <script type="text/javascript">
      document.getElementById("modal").click();
  </script>

  <script>
      // Add the following code if you want the name of the file appear on select
      $(".custom-file-input").on("change", function () {
          var fileName = $(this).val().split("\\").pop();
          $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
      });
  </script>

<?php
	}

}
