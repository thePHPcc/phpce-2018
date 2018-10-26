<?php declare(strict_types=1);

class CounterIncrementedEvent implements Event
{
    /**
     * @var int
     */
    private $counterValue;

    public function __construct(int $counterValue)
    {
        $this->counterValue = $counterValue;
    }

    public function counterValue(): int
    {
        return $this->counterValue;
    }
}
