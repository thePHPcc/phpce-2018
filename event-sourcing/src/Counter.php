<?php declare(strict_types=1);

class Counter
{
    use EventSourced;

    /**
     * @var int
     */
    private $value = 0;

    public static function fromEvents(array $events): Counter
    {
        return new Counter(0, $events);
    }

    public static function initialize(int $initialValue = 0): Counter
    {
        return new Counter($initialValue);
    }

    private function __construct(int $initialValue = 0, array $events = [])
    {
        if (count($events) > 0) {
            $this->reconstituteFrom($events);
        } else {
            $this->initializeCounterWith($initialValue);
        }
    }

    private function initializeCounterWith(int $initialValue)
    {
        $this->ensureInitialValueIsPositive($initialValue);

        $event = new CounterInitializedEvent($initialValue);
        $this->emit($event);
    }

    public function value(): int
    {
        return $this->value;
    }

    public function increment(): void
    {
        $this->ensureCounterDoesNotOverflow($this->value);

        $this->emit(new CounterIncrementedEvent($this->value + 1));
    }

    private function ensureInitialValueIsPositive(int $initialValue): void
    {
        if ($initialValue < 0) {
            throw new \OutOfBoundsException('Initial value must be positive');
        }
    }

    private function ensureCounterDoesNotOverflow(int $currentValue): void
    {
        if ($currentValue >= PHP_INT_MAX) {
            throw new OverflowException('Cannot count that far');
        }
    }

    private function applyCounterInitializedEvent(CounterInitializedEvent $event): void
    {
        $this->value = $event->initialValue();
    }

    private function applyCounterIncrementedEvent(CounterIncrementedEvent $event): void
    {
        $this->value = $event->counterValue();
    }
}
