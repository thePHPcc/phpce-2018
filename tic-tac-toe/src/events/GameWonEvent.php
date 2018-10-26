<?php declare(strict_types=1);

namespace phpce\tictactoe;

class GameWonEvent implements Event
{
    /**
     * @var string
     */
    private $symbol;

    public function __construct(string $symbol)
    {
        $this->symbol = $symbol;
    }

    public function winningSymbol(): string
    {
        return $this->symbol;
    }

    public function topic(): string
    {
        return 'tictactoe.game_won';
    }
}
