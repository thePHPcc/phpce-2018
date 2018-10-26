<?php declare(strict_types=1);

namespace phpce\tictactoe;

class GameStartedEvent implements Event
{
    public function topic(): string
    {
        return 'tictactoe.game_started';
    }
}
