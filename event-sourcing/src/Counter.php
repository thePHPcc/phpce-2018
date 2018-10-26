<?php declare(strict_types=1);

class Counter
{
    /**
     * @var int
     */
    private $value = 0;

    /**
     * @var Event[]
     */
    private $events = [];

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
            $this->doInitialize($initialValue);
        }
    }

    public function value(): int
    {
        return $this->value;
    }

    public function increment(): void
    {
        $this->ensureCounterDoesNotOverflow($this->value);

        $event = new CounterIncrementedEvent($this->value + 1);
        $this->emit($event);
    }

    private function reconstituteFrom(array $events): void
    {
        foreach ($events as $event) {
            $this->apply($event);
        }
    }

    private function emit(Event $event): void
    {
        $this->apply($event);
        $this->events[] = $event;
    }

    public function emittedEvents(): array
    {
        $events = $this->events;
        $this->events = [];

        return $events;
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

    private function apply(Event $event)
    {
        switch (get_class($event)) {
            case CounterInitializedEvent::class:
                $this->applyCounterInitializedEvent($event);
                break;
            case CounterIncrementedEvent::class:
                $this->applyCounterIncrementedEvent($event);
                break;
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

    private function doInitialize(int $initialValue)
    {
        $this->ensureInitialValueIsPositive($initialValue);

        $event = new CounterInitializedEvent($initialValue);
        $this->emit($event);
    }
}
