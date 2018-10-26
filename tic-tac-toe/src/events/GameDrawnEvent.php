<?php declare(strict_types=1);

namespace phpce\tictactoe;

class GameDrawnEvent implements Event
{
    public function topic(): string
    {
        return 'tictactoe.game_drawn';
    }
}
