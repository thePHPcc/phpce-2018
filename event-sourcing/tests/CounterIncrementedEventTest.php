<?php declare(strict_types=1);

class CounterIncrementedEventTest extends PHPUnit\Framework\TestCase
{
    public function testHasCurrentValue()
    {
        $event = new CounterIncrementedEvent(1);
        $this->assertEquals(1, $event->counterValue());
    }
}
