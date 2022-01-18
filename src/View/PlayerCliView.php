<?php

namespace IdealOctoTelegram\View;

use IdealOctoTelegram\Model\Entity\Player;
use IdealOctoTelegram\View\AbstractView;

class PlayerCliView extends AbstractView
{
    /**
     * @param Player[] $players
     */
    protected function render(mixed $players): void
    {
        echo "Current Players: \n";
        foreach ($players as $player) {

            echo "\tName: $player->name\n";
            echo "\tAge: $player->age\n";
            echo "\tSalary: $player->salary\n";
            echo "\tJob: $player->job\n\n";
        }
    }
}