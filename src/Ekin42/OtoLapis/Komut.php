<?php

namespace Ekin42\OtoLapis;

use pocketmine\command\Command;

use pocketmine\command\CommandSender;

use pocketmine\Player;

use Ekin42\OtoLapis\Main;

class Komut extends Command

{

		

	public function __construct(Main $main)

	{

		parent::__construct(

		"otolapis",

		"OtoLapisi aktif/devre dışı eder."

		);

		$this->main = $main;

	}

	

	public function execute(CommandSender $g, string $label, array $args)

	{

		if($g instanceof Player)

		{

			if(!isset($this->main->otolapis[$g->getName()]))

			{

				$g->sendMessage("§8» §7OtoLapis aktif edildi!");

				$this->main->otolapis[$g->getName()] = [];

			}else

			{

				$g->sendMessage("§8» §7OtoLapis devre dışı edildi!");

				unset($this->main->otolapis[$g->getName()]);

			}

		}else

		{

			$g->sendMessage("§8» §cBu komutu oyun içinde kullanabilirsin.");

		}

		return true;

	}

}
