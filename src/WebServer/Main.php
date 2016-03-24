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

    set_time_limit(0);

    public function dataPath()
    {

      return $this->getDataFolder();

    }

    public function server()
    {

      return $this->getServer();

    }

    public function start($bindToIP, $port)
    {

      $socket = @stream_socket_server("tcp://" . $bindToIP . ":" . $port, $errno, $errstr);

      if(!($socket))
      {

        $this->server()->getLogger()->info("[WebServer] Failed to start WebServer: " . $errstr . " - " . $errno);

      }
      else
      {

        while($this->isEnabled)
        {

        }

      }

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

          if($args[0] === "start")
          {

            if($this->isEnabled)
            {

              $sender->sendMessage(TF::RED . "Error: WebServer is already running.");

              return true;

            }
            else
            {

              $port = $this->cfg->get("server-port");

              $this->start("0.0.0.0", $port);

              $sender->sendMessage(TF::GREEN . "WebServer was started.");

              return true;

            }

          }
          else if($args[0] === "stop")
          {

          }

        }

      }

    }

  }

?>
