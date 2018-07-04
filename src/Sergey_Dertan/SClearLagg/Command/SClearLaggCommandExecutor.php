<?php
namespace Sergey_Dertan\SClearLagg\Command;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat as F;
use Sergey_Dertan\SClearLagg\SClearLaggMainFolder\SClearLaggMain;
use Sergey_Dertan\SClearLagg\Entity\EntityManager;

/**
 * Class SClearLaggCommandExecutor
 * @package Sergey_Dertan\SClearLagg\Command
 */
class SClearLaggCommandExecutor
{
    /**
     * @param CommandSender $s
     * @param Command $cmd
     * @param array $args
     */
	public $clear;
    function __construct(SClearLaggMain $main, CommandSender $s, Command $cmd, array $args)
    {
		$this->clear = new EntityManager($main);
        $this->executeCommand($s, $cmd, $args);
    }

    /**
     * @param CommandSender $s
     * @param Command $cmd
     * @param array $args
     * @return bool
     */
    private function executeCommand(CommandSender $s, Command $cmd, array $args)
    {
        $main = SClearLaggMain::getInstance();
        $entitiesManager = $this->clear;
        switch ($cmd->getName()) {
            case"scl":
                if (!isset($args[0])) {
                    $s->sendMessage(F::RED . "[SCL] SClearLagg V_" . $main->getDescription()->getVersion() . "\n /scl clear - remove entities\n /scl killmob - remove mobs");
                    return true;
                }
                if (!in_array(strtolower($args[0]), array("clear", "killmobs"))) {
                    $s->sendMessage(F::RED . "[AntiLagg] Khong hieu ' $args[0] '\n Nhap lenh ' /scl ' de biet them chi tiet");
                    return true;
                }
                switch (array_shift($args)) {
                    case"clear":
                        $s->sendMessage(F::YELLOW . "[AntiLagg] Removed " . $entitiesManager->removeEntities() . " entities");
                        return true;
                        break;
                    case"killmobs":
                        $s->sendMessage(F::YELLOW . "[AntiLagg] Removed " . $entitiesManager->removeMobs() . " mobs");
                        return true;
                        break;
                }
                break;
        }
        return true;
    }
}