<?php

namespace IdealOctoTelegram\Controller;

use IdealOctoTelegram\Model\Source\SourceFactory;
use IdealOctoTelegram\View\PlayerCliView;
use IdealOctoTelegram\View\PlayerHtmlView;
use stdClass;

interface IReadWritePlayers 
{
    function readPlayers($source, $filename = null);
    function writePlayer($source, $player, $filename = null);
    function display($isCLI, $course, $filename = null);
}


class PlayersObject implements IReadWritePlayers 
{
    /**
     * @param $sourceType string Where we're retrieving the data from. 'json', 'array' or 'file'
     * @param $filename string Only used if we're reading players in 'file' mode.
     * @return iterable stdClass[]
     */
    public function readPlayers($sourceType, $filename = null): iterable
    {
        $source = SourceFactory::createFromTypeString($sourceType, stdClass::class, $filename);
        
        $players = $source->read();

        return $players;
    }

    /**
     * @param $sourceType string Where to write the data. 'json', 'array' or 'file'
     * @param $filename string Only used if we're writing in 'file' mode
     * @param $player \stdClass Class implementation of the player with name, age, job, salary.
     */
    public function writePlayer($sourceType, $player, $filename = null): void
    {
        $source = SourceFactory::createFromTypeString(source: $sourceType, entityClass: stdClass::class, filename: $filename);
        $source->write($player);
    }

    public function display($isCLI, $sourceType, $filename = null): void
    {
        $players = $this->readPlayers($sourceType, $filename);

        $view = $isCLI ? new PlayerCliView() : new PlayerHtmlView();
        
        $responseContent = $view->renderToString($players);

        echo $responseContent;
    }
}
