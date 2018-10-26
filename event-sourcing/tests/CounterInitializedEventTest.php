<?php declare(strict_types=1);

class CounterInitializedEventTest extends PHPUnit\Framework\TestCase
{
    public function testHasInitialValue()
    {
        $event = new CounterInitializedEvent(3);
        $this->assertEquals(3, $event->initialValue());
    }
}
