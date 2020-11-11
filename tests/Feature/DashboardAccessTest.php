<?php

namespace Tests\Feature;

use App\Movie;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Tests\TestCase;

class DashboardAccessTest extends TestCase
{

    use DatabaseMigrations;

    public function setup(): void
    {
        parent::setUp();
        $this->seed('RolesAndPermissionsSeeder');

    }

    /** @test */
    function it_should_prevent_access_to_normal_users()
    {
        $response = $this->get(route('dashboard'));

        $response->assertForbidden();
    }

    /** @test */
    function it_should_grant_access_to_editors()
    {

        $editor = User::factory()->create()->assignRole('editor');
        $this->actingAs($editor);

        $response = $this->get(route('dashboard'));

        $response->assertOk();
    }

    /** @test */
    function it_should_grant_access_to_super_admin()
    {

        $superadmin = User::factory()->create()->assignRole('super admin');
        $this->actingAs($superadmin);

        $response = $this->get(route('dashboard'));

        $response->assertOk();
    }
}
