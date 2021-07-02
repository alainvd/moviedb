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
}
