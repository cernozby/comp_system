<?php
// source: C:\xampp\htdocs\comp_system\app/templates/Homepage/article.latte

use Latte\Runtime as LR;

final class Template6b76f8998c extends Latte\Runtime\Template
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
			foreach (array_intersect_key(['item' => '15'], $this->params) as $_v => $_l) {
				trigger_error("Variable \$$_v overwritten in foreach on line $_l");
			}
		}
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	public function blockContent(array $_args): void
	{
		extract($_args);
		if ($url) {
			$user = $userModel->getRow('user', $article->user_id);
?>
  <div class="row d-flex justify-content-center article-solo">
    <span class="col-lg-8 col-md-10 col-sm-10 col-xs-10 ">
      <h2 class="d-flex justify-content-center"><?php echo ($this->filters->upper)($article->title) /* line 6 */ ?></h2>
          <?php echo $article->text /* line 7 */ ?>

     <br>
     <br>
     <small class="article-date text-bold"> <?php echo LR\Filters::escapeHtmlText(($this->filters->date)($article->created, '%d. %m. %Y')) /* line 10 */ ?></small>
     <small class="pull-right article-name text-bold"><?php echo LR\Filters::escapeHtmlText($user->first_name) /* line 11 */ ?> <?php
			echo LR\Filters::escapeHtmlText($user->last_name) /* line 11 */ ?></small>
    </span>
  </div>
<?php
		}
		else {
			$iterations = 0;
			foreach ($articles as $item) {
?>
    <div class="row d-flex justify-content-center">
    <span class="col-lg-8 article">
      <h3><a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiPresenter->link("Homepage:Article", ['url' => $item->url])) ?>"
             class="text-warning nav-link"><?php echo ($this->filters->upper)($item->title) /* line 19 */ ?></a></h3>
      <div class="article-text">
        <?php echo $item->text_short /* line 21 */ ?>

      </div>
<?php
				$user = $userModel->getRow('user', $item->user_id);
?>
       <span class="row d-flex justify-content-center">
        <a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiPresenter->link("Homepage:Article", ['url' => $item->url])) ?>" class="text-dark nav-link">
          <i class="fa fa-chevron-down fa-5x article-icon d-flex justify-content-center align-items-end"></i>
        </a>
      </span>
      <small class="article-date text-bold"> <?php echo LR\Filters::escapeHtmlText(($this->filters->date)($item->created, '%d. %m. %Y')) /* line 29 */ ?></small>
      <small class="pull-right article-name text-bold"><?php echo LR\Filters::escapeHtmlText($user->first_name) /* line 30 */ ?> <?php
				echo LR\Filters::escapeHtmlText($user->last_name) /* line 30 */ ?></small>
      <br>
    </span>
    </div>
<?php
				$iterations++;
			}
		}
		
	}

}
