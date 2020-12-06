<?php

namespace varion\Snow;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\level\biome\Biome;
use pocketmine\event\level\ChunkLoadEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\network\mcpe\protocol\LevelEventPacket;

class Snow extends PluginBase implements Listener
{

	public function onEnable() : void
	{

		$this->levels = $this->getConfig()->getAll();
		
		$this->pk = new LevelEventPacket ();
		$this->pk->evid = LevelEventPacket::EVENT_START_RAIN;
		$this->pk->data = 10000;

		$this->getServer()->getPluginManager()->registerEvents ($this, $this);

	}
	
	public function onChunkLoadEvent(ChunkLoadEvent $event) : void
	{
		
		if (! in_array ($event->getLevel()->getFolderName(), $this->levels))
			return;

		for($x = 0; $x < 16; ++ $x)
			for($z = 0; $z < 16; ++ $z)
				$event->getChunk()->setBiomeId ($x, $z, Biome::ICE_PLAINS);

	}

	public function onPlayerJoin(PlayerJoinEvent $event) : void
	{

		if (in_array (($player = $event->getPlayer())->getLevel()->getFolderName(), $this->levels))
			$player->dataPacket (clone $this->pk);

	}

}
