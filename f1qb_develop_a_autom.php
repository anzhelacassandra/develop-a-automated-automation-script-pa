<?php

class AutomationScriptParser {
    private $script;
    private $commands;

    public function __construct($script) {
        $this->script = $script;
        $this->commands = array();
    }

    public function parse() {
        $lines = explode("\n", $this->script);
        foreach ($lines as $line) {
            if (trim($line) != "") {
                $parts = explode(" ", $line);
                $command = array_shift($parts);
                $args = implode(" ", $parts);
                $this->commands[] = array("command" => $command, "args" => $args);
            }
        }
        return $this->commands;
    }

    public function execute() {
        foreach ($this->commands as $command) {
            switch ($command["command"]) {
                case "print":
                    echo $command["args"] . "\n";
                    break;
                case "wait":
                    sleep(intval($command["args"]));
                    break;
            }
        }
    }
}

$script = <<<SCRIPT
print Hello World!
wait 2
print Automation is awesome!
wait 1
print Bye!
SCRIPT;

$parser = new AutomationScriptParser($script);
$parser->parse();
$parser->execute();

?>