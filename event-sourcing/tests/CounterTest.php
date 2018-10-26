<?php declare(strict_types=1);

class CounterTest extends PHPUnit\Framework\TestCase
{
    public function testInitiallyIsZero()
    {
        $counter = Counter::initialize();

        $this->assertEquals(0, $counter->value());
    }

    public function testCounterCannotOverflow()
    {
        $counter = Counter::initialize(PHP_INT_MAX);

        $this->expectException(\OverflowException::class);
        $counter->increment();
    }

    public function testCounterCanBeInitializedWithPositiveInteger()
    {
        $counter = Counter::initialize(3);

        $this->assertEquals(3, $counter->value());
    }

    public function testCounterCannotBeInitializedWithNegativeInteger()
    {
        $this->expectException(OutOfBoundsException::class);
        Counter::initialize(-3);
    }

    public function testCounterInitializedEventIsPublished()
    {
        $counter = Counter::initialize(3);

        $events = $counter->emittedEvents();
        $this->assertCount(1, $events);
        $this->assertContainsOnlyInstancesOf(CounterInitializedEvent::class, $events);
        $this->assertEquals(3, $events[0]->initialValue());
    }

    public function testEmittedEventsCanOnlyBeRetrievedOnce()
    {
        $counter = Counter::initialize();

        $events = $counter->emittedEvents();

        $this->assertCount(0, $counter->emittedEvents());
    }

    public function testCounterCanBeIncremented()
    {
        $counter = Counter::initialize();
        $counter->increment();

        $this->assertEquals(1, $counter->value());
    }

    public function testCounterIncrementedEventIsPublished()
    {
        $counter = Counter::initialize();
        $counter->increment();
        $counter->increment();

        $events = $counter->emittedEvents();
        $this->assertCount(3, $events);
        $this->assertInstanceOf(CounterInitializedEvent::class, $events[0]);
        $this->assertInstanceOf(CounterIncrementedEvent::class, $events[1]);
        $this->assertInstanceOf(CounterIncrementedEvent::class, $events[2]);
        $this->assertEquals(1, $events[1]->counterValue());
        $this->assertEquals(2, $events[2]->counterValue());
    }

    public function testCounterCanBeSourcedFromEvents()
    {
        $events = [
            new CounterInitializedEvent(0),
            new CounterIncrementedEvent(1),
        ];

        $counter = Counter::fromEvents($events);

        $this->assertEquals(1, $counter->value());
    }

    /*
    public function testCounterCanBeSourcedFromEvents()
    {
        $events = [
            new CounterInitializedEvent(0),
            new CounterIncrementedEvent(1),
            new CounterIncrementedEvent(2),
            new CounterIncrementedEvent(3),
        ];

        $counter = Counter::fromEvents($events);
        $this->assertEquals(3, $counter->value());
    }
    */
}
