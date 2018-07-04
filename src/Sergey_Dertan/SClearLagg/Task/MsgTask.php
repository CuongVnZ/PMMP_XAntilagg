<?php
namespace Sergey_Dertan\SClearLagg\Task;

use pocketmine\scheduler\Task;
use pocketmine\scheduler\TaskScheduler;
use pocketmine\scheduler\TaskHandler;
use pocketmine\Server;
use pocketmine\utils\TextFormat as F;
use Sergey_Dertan\SClearLagg\SClearLaggMainFolder\SClearLaggMain;

/**
 * Class MsgTask
 * @package Sergey_Dertan\SClearLagg\Task
 */
class MsgTask extends Task
{
	public $main;
    function __construct(SClearLaggMain $main)
    {
        $this->main = $main;
    }
    /**
     * @param SClearLaggMain $main
     *

    /**
     * @param $currentTick
     */
    function onRun($currentTick)
    {
        Server::getInstance()->broadcastMessage(F::RED . $this->main->config->get("PreClear-msg"));
    }
}