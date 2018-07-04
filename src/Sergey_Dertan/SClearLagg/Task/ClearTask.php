<?php
namespace Sergey_Dertan\SClearLagg\Task;

use pocketmine\utils\TextFormat as F;
use pocketmine\scheduler\Task;
use pocketmine\scheduler\TaskScheduler;
use pocketmine\scheduler\TaskHandler;
use pocketmine\Server;
use Sergey_Dertan\SClearLagg\Entity\EntityManager;
use Sergey_Dertan\SClearLagg\SClearLaggMainFolder\SClearLaggMain;

/**
 * Class ClearTask
 * @package Sergey_Dertan\SClearLagg\Task
 */
class ClearTask extends Task
{
	public $main;
	public $clear;
    function __construct(SClearLaggMain $main)
    {
		$this->clear = new EntityManager($main);
        $this->main = $main;
    }
    /**
     * @param SClearLaggMain $main
     */
    

    /**
     * @param $currentTick
     */
    function onRun($currentTick)
    {
        $msg = $this->main->config->get("Clear-msg");
        $msg = str_replace("@count", $this->clear->removeEntities(), $msg);
        Server::getInstance()->broadcastMessage(F::RED . $msg);
    }
}