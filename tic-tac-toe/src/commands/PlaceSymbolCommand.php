<?php declare(strict_types=1);

namespace phpce\tictactoe;

class PlaceSymbolCommand implements Command
{
    /**
     * @var string
     */
    private $symbol;

    /**
     * @var int
     */
    private $field;

    public function __construct(string $symbol, int $field)
    {
        $this->symbol = $symbol;
        $this->field = $field;
    }

    public function symbol(): string
    {
        return $this->symbol;
    }

    public function field(): int
    {
        return $this->field;
    }
}
