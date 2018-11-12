<?php

namespace Ekin42\OtoLapis;

use pocketmine\plugin\PluginBase;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use onebone\economyapi\EconomyAPI;
use pocketmine\event\Listener;
use pocketmine\utils\Config;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\item\Item;

class Main extends PluginBase implements Listener{

	public function onEnable(){
		@mkdir($this->getDataFolder());
		$cfg = new Config($this->getDataFolder()."oyuncular.yml", Config::YAML);
		$this->getLogger()->info("Eklenti aktif edildi by Ekin42!");
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
	}
	
	public function katilma(PlayerJoinEvent $e)
	{
		$oyuncu = $e->getPlayer();
		$cfg = new Config($this->getDataFolder()."oyuncular.yml", Config::YAML);
			$cfg->set($oyuncu->getName(), "kapali");
			$cfg->save();
	}

	public function onCommand(CommandSender $g, Command $komut, string $label, array $args) : bool{
		if($komut->getName() == "otolapis")
		{
			$cfg = new Config($this->getDataFolder()."oyuncular.yml", Config::YAML);
		 $acikmikapalimi = $cfg->get($g->getName());
		 if($cfg->get($g->getName()) == 1)
		 {
		 	$cfg->set($g->getName(), 0);
		 	$g->addTitle("","§8» §7OtoLapis : §cKAPALI!");
		 	$cfg->save();
		 }elseif($cfg->get($g->getName()) == 0)
		 {
		 	$cfg->set($g->getName(), 1);
		 	$g->addTitle("","§8» §7OtoLapis : §aAÇIK!");
		 		$cfg->save();
		 }
		}
		return true;<?php

namespace Ekin42\OtoLapis;

use pocketmine\plugin\PluginBase;

use onebone\economyapi\EconomyAPI;

use pocketmine\event\Listener;

use pocketmine\event\block\BlockBreakEvent;

use pocketmine\item\Item;

class Main extends PluginBase implements Listener

{

	

	public $otolapis = [];

	

	

	public function onEnable()

	{

		@mkdir($this->getDataFolder());

		$this->getServer()->getPluginManager()->registerEvents($this, $this);

		$this->getLogger()->info("Eklenti aktif edildi by Ekin42!");

		$this->getServer()->getCommandMap()->register("otolapis", new Komut($this));

	}

	

	public function blokKirinca(BlockBreakEvent $e)

	{

		$o = $e->getPlayer();

		$env = $o->getInventory();

		if(isset($this->otolapis[$o->getName()]))

		{

			if($env->contains(Item::get(351,4,64)))

			{

				$env->removeItem(Item::get(351,4,64));

				EconomyAPI::getInstance()->addMoney($o->getName(), 16);

				$o->sendMessage("§8» §e64 §7adet lapis §e16TL§7'ye satıldı!");

			}

		}

	}

}
	}
	
	
	public function blokKirinca(BlockBreakEvent $e)
	{
		$oyuncu = $e->getPlayer();
		$blok = $e->getBlock();
		$env = $oyuncu->getInventory();
		$cfg = new Config($this->getDataFolder()."oyuncular.yml", Config::YAML);
		if($cfg->get($oyuncu->getName()) == 1)
		{
			if($env->contains(Item::get(351,0,64)->setDamage(4)))
			{
				$env->removeItem(Item::get(351,0,64)->setDamage(4));
				EconomyAPI::getInstance()->addMoney($oyuncu->getName(), 16);
				$oyuncu->sendMessage("§8» §e64 §7adet lapis §e16TL§7'ye satıldı!");
			}
		}
	}
}
