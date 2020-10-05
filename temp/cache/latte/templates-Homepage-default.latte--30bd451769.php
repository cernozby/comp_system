<?php
// source: C:\xampp\htdocs\comp_system\app/templates/Homepage/default.latte

use Latte\Runtime as LR;

final class Template30bd451769 extends Latte\Runtime\Template
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
?>


<?php
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
?><div class="text">
  <p><br><br>
    <span class="name">
      Vítejte
    </span>
    <br>
    <br>
    <br>
    Bozala.cz - Pomocník pro správu malých lezeckých závodů.
  </p>
</div>





<?php
	}

}
