<?php

namespace Tests\Feature;

use App\Models\Action;
use App\Models\Call;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CallStatusTest extends TestCase
{

    use RefreshDatabase, WithFaker;

    protected function init()
    {
        Action::factory()->create();
    }

    protected function assertScope($id, $scope)
    {
        $open = Call::open()->pluck('id');
        $closed = Call::closed()->pluck('id');
        $this->assertContains($id, $scope === 'open' ? $open : $closed);
        $this->assertNotContains($id, $scope === 'open' ? $closed : $open);
    }

    // Test published_at open / close
    /** @test */
    public function call_should_be_closed_before_published_open_after()
    {
        $this->init();

        $call = Call::factory()->create([
            'published_at' => Carbon::now()->addDay(1),
            'deadline1' => null,
            'deadline2' => null,
        ]);

        // Call should be closed before published_at date
        $this->assertEquals(true, $call->closed);
        $this->assertScope($call->id, 'closed');

        // Call should be open after published_at date
        $call->published_at = Carbon::now()->subDay(1);
        $call->save();

        $this->assertEquals(false, $call->closed);
        $this->assertScope($call->id, 'open');
    }

    // Test open with no deadline
    /** @test */
    public function call_should_be_open_if_no_deadline()
    {
        $this->init();

        $call = Call::factory()->create([
            'published_at' => Carbon::now()->subDay(1),
            'deadline1' => null,
            'deadline2' => null,
        ]);

        $this->assertEquals(false, $call->closed);
        $this->assertScope($call->id, 'open');
    }

    // Test deadline1 future / past
    /** @test */
    public function call_should_be_open_before_deadline1_closed_after()
    {
        $this->init();

        $call = Call::factory()->create([
            'published_at' => Carbon::now()->subDay(1),
            'deadline1' => Carbon::now()->addWeek(),
            'deadline2' => null,
        ]);

        $this->assertEquals(false, $call->closed);
        $this->assertScope($call->id, 'open');

        $call->deadline1 = Carbon::now()->subWeek();
        $call->save();

        $this->assertEquals(true, $call->closed);
        $this->assertScope($call->id, 'closed');
    }

    // Test deadline2 future / past
    /** @test */
    public function call_should_be_open_before_deadline2_closed_after()
    {
        $this->init();

        $call = Call::factory()->create([
            'published_at' => Carbon::now()->subMonth(1),
            'deadline1' => Carbon::now()->subWeek(1),
            'deadline2' => Carbon::now()->addWeek(1),
        ]);

        $this->assertEquals(false, $call->closed);
        $this->assertScope($call->id, 'open');

        $call->deadline2 = Carbon::now()->subDay(1);
        $call->save();

        $this->assertEquals(true, $call->closed);
        $this->assertScope($call->id, 'closed');
    }

    /** @test */
    public function call_should_be_open_5_mins_before_closed_after()
    {
        $this->init();

        $call = Call::factory()->create([
            'published_at' => Carbon::now()->subMinutes(5),
            'deadline1' => null,
            'deadline2' => null,
        ]);

        // Call should be closed before published_at date
        $this->assertEquals(false, $call->closed);
        $this->assertScope($call->id, 'open');

        $call->published_at = Carbon::now()->addMinutes(5);
        $call->save();

        $this->assertEquals(true, $call->closed);
        // $this->assertScope($call->id, 'closed');
    }

    /** @test */
    public function call_should_be_closed_at_exactly_after_deadline()
    {
        $this->init();

        $deadline = [2021, 8, 20, 17, 0, 0];

        $call = Call::factory()->create([
            'published_at' => Carbon::now()->subDay(1),
            'deadline1' => Carbon::create(...$deadline),
            'deadline2' => null,
        ]);

        // Call should be open one minute before deadline
        Carbon::setTestNow(Carbon::create(...$deadline)->subMinute());
        $this->assertEquals(false, $call->closed);
        $this->assertScope($call->id, 'open');

        // Call should be closed one minute after deadline
        Carbon::setTestNow(Carbon::create(...$deadline)->addMinute());
        $this->assertEquals(true, $call->closed);
        $this->assertScope($call->id, 'closed');
    }

    /** @test */
    public function call_should_be_closed_for_future_published_and_deadline()
    {
        $this->init();

        $call = Call::factory()->create([
            'published_at' => Carbon::now()->addHour(),
            'deadline1' => Carbon::now()->addWeek(),
            'deadline2' => null,
        ]);

        // Call should be closed
        $this->assertEquals(true, $call->closed);
        $this->assertScope($call->id, 'closed');

        Carbon::setTestNow(Carbon::now()->addDay());
        $this->assertEquals(false, $call->closed);
        $this->assertScope($call->id, 'open');
    }

    /** @test */
    public function call_is_closed_by_override()
    {
        $this->init();

        $call = Call::factory()->create([
            'published_at' => Carbon::now()->subHour(),
            'deadline1' => Carbon::now()->addHour(),
            'deadline2' => null,
            'status' => 'closed'
        ]);

        // Call should be closed
        $this->assertEquals(true, $call->closed);
        $this->assertScope($call->id, 'closed');
    }

    /** @test */
    public function call_is_open_by_override()
    {
        $this->init();

        $call = Call::factory()->create([
            'published_at' => Carbon::now()->addHour(),
            'deadline1' => Carbon::now()->addHour(),
            'deadline2' => null,
            'status' => 'open'
        ]);

        // Call should be open
        $this->assertEquals(false, $call->closed);
        $this->assertScope($call->id, 'open');
    }
}
