<?php
namespace anyslab;

use pocketmine\network\protocol\AddEntityPacket;
use pocketmine\network\Network;
use pocketmine\Player;
use pocketmine\entity\Entity;

class CustomSlab extends Entity
{

    const NETWORK_ID = 66;

    public function spawnTo(Player $player)
    {

        $pk = new AddEntityPacket();
        $pk->eid = $this->getId();
        $pk->type = self::NETWORK_ID;
        $pk->x = $this->x;
        $pk->y = $this->y;
        $pk->z = $this->z;
        $pk->speedX = 0;
        $pk->speedY = 0;
        $pk->speedZ = 0;
        $pk->yaw = $this->yaw;
        $pk->pitch = $this->pitch;
        $pk->metadata = [
            15 => [0, 1]
        ];
        if (isset($this->namedtag->BlockID)) {
            $pk->metadata[20] = [2, $this->namedtag->BlockID->getValue()];
        } else {
            $pk->metadata[20] = [2, 1];
        }
        $player->dataPacket($pk);
        parent::spawnTo($player);
    }


}