<?php

namespace AntiVoid;

use pocketmine\plugin\PluginBase;

use pocketmine\event\Listener;

use pocketmine\level\Position;

use pocketmine\level\sound\EndermanTeleportSound;

use pocketmine\event\player\PlayerMoveEvent;
use AntiVoid\Main;

class Main extends PluginBase implements Listener {
    
    public function onEnable(){
        $this->getLogger()->info("Enabled.");
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    public function onMove(PlayerMoveEvent $event){
        $player = $event->getPlayer();
        $level = $this->getServer()->getDefaultLevel();
        if($player->getLevel() == $level) {
            $x = $this->getServer()->getDefaultLevel()->getSafeSpawn()->getFloorX();
            $y = $this->getServer()->getDefaultLevel()->getSafeSpawn()->getFloorY();
            $z = $this->getServer()->getDefaultLevel()->getSafeSpawn()->getFloorZ();
            if($event->getTo()->getFloorY() < 0){
				$player->setGamemode(0);
				$player->setAllowFlight(false);
				$player->getLevel()->addSound(new EndermanTeleportSound($player));
				$player->teleport(new Position($x, $y, $z, $level));
			}
        }
    }

    public function onDisable(){
        $this->getLogger()->info("Disabled.");
    }
}