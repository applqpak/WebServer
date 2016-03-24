<?php

  namespace WebServer;

  use pocketmine\plugin\PluginBase;
  use pocketmine\utils\TextFormat as TF;
  use pocketmine\utils\Config;
  use pocketmine\command\Command;
  use pocketmine\command\CommandSender;

  class Main extends PluginBase
  {

    private $isEnabled = false;

    public function dataPath()
    {

      return $this->getDataFolder();

    }

    public function server()
    {

      return $this->getServer();

    }

    public function onEnable()
    {

      @mkdir($this->dataPath());

      @mkdir($this->dataPath() . "/html/");

      $this->cfg = new Config($this->dataPath() . "config.yml", Config::YAML, array("server-port" => 80, "html-directory" => "/html/"));

      $this->server()->getLogger()->info("[WebServer] Enabled.");

    }

    public function onCommand(CommandSender $sender, Command $cmd, $label, array $args)
    {

      if(strtolower($cmd->getName()) === "webserver")
      {

        if(!(isset($args[0])))
        {

          $sender->sendMessage(TF::RED . "Error: Not Enough Agrs. Usage: /webserver < start | stop >");

        }
        else
        {

        }

      }

    }

  }

?>
