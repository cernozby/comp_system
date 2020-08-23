<?php

declare(strict_types=1);

namespace App\Router;

use Nette\Application\IRouter;
use Nette\Application\Routers\Route;
use Nette\Application\Routers\RouteList;
use Nette\StaticClass;

final class RouterFactory
{
	use StaticClass;

	public static function createRouter(): RouteList
	{
		$router = new RouteList;
		$router->addRoute('registrace', 'Homepage:registration');
		$router->addRoute('login', 'Homepage:login');
		$router->addRoute('zapomenute-heslo', 'Homepage:forgetPasswd');
		$router->addRoute('zmena-hesla', 'Homepage:changePasswd');
		$router->addRoute('administrace', 'Administration:administration');
		$router->addRoute('administrace/novy-zavodnik[/<id>]', 'Administration:newRacer');
        $router->addRoute('administrace/moji-zavodnici', 'Administration:myRacers');
        $router->addRoute('administrace/moje-clanky', 'Administration:myArticles');
        $router->addRoute('administrace/novy-clanek[/<id>]', 'Administration:addArticle');
        $router->addRoute('administrace/nový-zavod[/<id>]', 'Administration:newComp');
        $router->addRoute('administrace/moje-zavody', 'Administration:myComps');
        $router->addRoute('administrace/zavod-nastaveni/<id>[/<cat>]', 'Administration:compSetting');
        $router->addRoute('administrace/predregistrace/<id>', 'Administration:preRegistration');
        $router->addRoute('zavod/seznam-prihlasenych[/<id>]', 'Competition:ListOfPrereg');
        $router->addRoute('zadani-vysledku[/<id>][/<cat>]', 'Competition:noteResults');
        $router->addRoute('vysledky[/<id>][/<cat>]', 'Competition:results');
        $router->addRoute('aktuality[/<url>]', 'Homepage:article');
        $router->addRoute('<presenter>/<action>[/<id>]', 'Homepage:default');

          return $router;
	}
}
