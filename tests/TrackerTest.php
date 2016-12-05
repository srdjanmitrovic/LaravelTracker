<?php namespace Arcanedev\LaravelTracker\Tests;

/**
 * Class     TrackerTest
 *
 * @package  Arcanedev\LaravelTracker\Tests
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class TrackerTest extends TestCase
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /** @var  \Arcanedev\LaravelTracker\Tracker  */
    private $tracker;

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    public function setUp()
    {
        parent::setUp();
        $this->migrate();

        $this->tracker = $this->app->make('arcanedev.tracker');
    }

    public function tearDown()
    {
        unset($this->tracker);

        parent::tearDown();
    }

    /* ------------------------------------------------------------------------------------------------
     |  Test Functions
     | ------------------------------------------------------------------------------------------------
     */
    /** @test */
    public function it_can_be_instantiated()
    {
        $expectations = [
            \Arcanedev\LaravelTracker\Contracts\Tracker::class,
            \Arcanedev\LaravelTracker\Tracker::class,
        ];

        foreach ($expectations as $expected) {
            $this->assertInstanceOf($expected, $this->tracker);
        }
        $this->assertTrue($this->tracker->isEnabled());
    }

    /** @test */
    public function it_can_be_instantiated_via_contract()
    {
        $this->tracker = $this->app->make(\Arcanedev\LaravelTracker\Contracts\Tracker::class);

        $expectations = [
            \Arcanedev\LaravelTracker\Contracts\Tracker::class,
            \Arcanedev\LaravelTracker\Tracker::class,
        ];

        foreach ($expectations as $expected) {
            $this->assertInstanceOf($expected, $this->tracker);
        }
        $this->assertTrue($this->tracker->isEnabled());
    }

    /** @test */
    public function it_can_enable_and_disable()
    {
        $this->assertTrue($this->tracker->isEnabled());

        $this->tracker->disable();

        $this->assertFalse($this->tracker->isEnabled());

        $this->tracker->enable();

        $this->assertTrue($this->tracker->isEnabled());
    }

    /** @test */
    public function it_can_track()
    {
        $this->call('GET', '/');

        // TODO: Complete the implementation
    }
}
