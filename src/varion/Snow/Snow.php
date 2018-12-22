<?php

namespace varion\Snow;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\Player;
use pocketmine\entity\Entity;
use pocketmine\block\Block;
use pocketmine\item\Item;
use pocketmine\network\mcpe\protocol\AddEntityPacket;
use pocketmine\level\Position;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat;
use pocketmine\event\level\ChunkLoadEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\network\mcpe\protocol\LevelEventPacket;;

class Snow extends PluginBase implements Listener {
    	public $cooltime = 0;
	public $m_version = 2, $pk;
	
	public function onEnable() {
        $this->getServer()->getPluginManager()->registerEvents($this,$this);
	}
	
	public function onChunkLoadEvent(ChunkLoadEvent $event) {
		for($x = 0; $x < 16; ++ $x)
			for($z = 0; $z < 16; ++ $z)
				$event->getChunk()->setBiomeId ( $x, $z, 12);
	}
	public function onPlayerJoinEvent(PlayerJoinEvent $event) {
		$player = $event->getPlayer ();
		$pk = new LevelEventPacket ();
		$pk->evid = 3001;
		$pk->data = 10000;
		$player->dataPacket ( $pk );
	}
}


