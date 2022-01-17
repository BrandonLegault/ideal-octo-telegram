<?php
# Entrypoint for our app

// Trigger autoloading using composer's built-in autoloader 
require __DIR__ . '/vendor/autoload.php';

use IdealOctoTelegram\Controller\PlayersObject;

// original behaviour
$playersObject = new PlayersObject();
$playersObject->display(php_sapi_name() === 'cli', 'file', './playerdata.json');

?>