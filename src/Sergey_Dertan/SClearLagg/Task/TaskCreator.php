<?php
namespace Sergey_Dertan\SClearLagg\Task;

use pocketmine\plugin\Plugin;
use pocketmine\scheduler\Task;
use pocketmine\scheduler\TaskScheduler;
use pocketmine\scheduler\TaskHandler;
use pocketmine\Server;
use Sergey_Dertan\SClearLagg\SClearLaggMainFolder\SClearLaggMain;

/**
 * Class TaskCreator
 * @package Sergey_Dertan\SClearLagg\Task
 */
class TaskCreator
{
	public $main;
    function __construct(SClearLaggMain $main)
    {
        $this->main = $main;
        $this->createTasks();
    }

    /**
     * @param SClearLaggMain $main
     */
    private function createTasks()
    {
        $this->main->getScheduler()->scheduleRepeatingTask(new ClearTask($this->main), $this->main->config->getAll( )["Clear-time"] * 20);
        $this->main->getScheduler()->scheduleRepeatingTask(new MsgTask($this->main), ($this->main->config->getAll()["Clear-time"] - 10) * 20);
    }
}