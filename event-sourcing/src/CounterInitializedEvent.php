<?php declare(strict_types=1);

class CounterInitializedEvent implements Event
{
    /**
     * @var int
     */
    private $initialValue;

    public function __construct(int $initialValue)
    {
        $this->initialValue = $initialValue;
    }

    public function initialValue(): int
    {
        return $this->initialValue;
    }
}
