<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Movie;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DashboardAccessTest extends TestCase
{

    use RefreshDatabase, WithFaker;

    /** @test */
    function anonumous_have_no_access_to_dashboard()
    {
        $this->seed(\Database\Seeders\RolesAndPermissionsSeeder::class);

        $applicant = User::factory()->create()->assignRole('applicant');
        $this->actingAs($applicant);

        $response = $this->get(route('dashboard'));
        $response->assertForbidden();
    }
    
    /** @test */
    function editors_dashboard()
    {
        $this->seed(\Database\Seeders\RolesAndPermissionsSeeder::class);

        $editor = User::factory()->create()->assignRole('editor');
        $this->actingAs($editor);

        $response = $this->get(route('root'));
        $response->assertRedirect('dashboard/dossiers');

        // Can't test with sqlite because it doesn't support function 'year' in DashboardComposer.php
        // $response = $this->get(route('datatables-dossiers'));
        // $response->assertOk();
    }

    /** @test */
    function super_admins_dashboard()
    {
        $this->seed(\Database\Seeders\RolesAndPermissionsSeeder::class);

        $superadmin = User::factory()->create()->assignRole('super admin');
        $this->actingAs($superadmin);

        $response = $this->get(route('root'));
        $response->assertRedirect('dashboard/dossiers');

        // ...
    }
}
