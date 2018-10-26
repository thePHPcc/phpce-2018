<?php declare(strict_types=1);

namespace phpce\tictactoe;

class SymbolPlacedEvent implements Event
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

    public function topic(): string
    {
        return 'tictactoe.symbol_placed';
    }
}
