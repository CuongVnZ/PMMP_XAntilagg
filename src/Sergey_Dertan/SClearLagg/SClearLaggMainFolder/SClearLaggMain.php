<?php
namespace Sergey_Dertan\SClearLagg\SClearLaggMainFolder;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use Sergey_Dertan\SClearLagg\Command\SClearLaggCommandExecutor;
use Sergey_Dertan\SClearLagg\Entity\EntityManager;
use pocketmine\utils\TextFormat as F;
use Sergey_Dertan\SClearLagg\Task\TaskCreator;
use pocketmine\scheduler\Task;
use pocketmine\scheduler\TaskScheduler;
use pocketmine\scheduler\TaskHandler;

/**
 * Class SClearLaggMain
 * @package Sergey_Dertan\SClearLagg\SClearLaggMainFolder
 */
class SClearLaggMain extends PluginBase
{
    /**
     * @var SClearLaggMain
     */
    private static $instance;
    public $config;
    /**
     * @var \Sergey_Dertan\SClearLagg\Entity\EntityManager
     */
    private $entityManager;

    /**
     * @return SClearLaggMain
     */
    static function getInstance()
    {
        return self::$instance;
    }

    /**
     * @return EntityManager
     */
    function getEntityManager()
    {
        return $this->entityManager;
    }

    function onEnable()
    {
        @mkdir($this->getDataFolder());
        $this->config = new Config($this->getDataFolder() . "Config.yml", Config::YAML, array(
            "Clear-msg" => "[!] → Antilagg ← Đã dọn @count rác trên mặt đất!",
            "PreClear-msg" => "[!] → Antilagg ← Đang dọn rác...",
            "Clear-time" => 240
        ));
        new TaskCreator($this);
        $this->getLogger()->info(F::GREEN . "AntiLagg v" . $this->getDescription()->getVersion() . " by CuongDZ");
    }

    /**
     * @param CommandSender $s
     * @param Command $cmd
     * @param string $label
     * @param array $args
     * @return bool|SClearLaggCommandExecutor
     */
    function onCommand(CommandSender $s, Command $cmd, $label, array $args) : bool
    {
        new SClearLaggCommandExecutor($this, $s, $cmd, $args);
        return true;
    }

    function onDisable()
    {
        $this->config->save();
        $this->getLogger()->info(F::RED . "AntiLagg v" . $this->getDescription()->getVersion() . " by CuongDZ");
    }
}