<?php

namespace Tests\Feature;

use App\Models\Action;
use App\Models\Activity;
use App\Models\Call;
use App\Models\Dossier;
use App\Models\User;
use Database\Seeders\ActionSeeder;
use Database\Seeders\ActivitySeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class DossierTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * Testing required parameters for dossier:
     * * call_id
     * * project_ref_id
     */
    /** @test */
    public function call_and_project_ref_required()
    {
        $this->init();
        $user = $this->getUser('applicant');

        $this->actingAs($user)
            ->get(route('dossiers.create', ['call_id' => 1]))
            ->assertSessionHasErrors(['project_ref_id']);

        $this->actingAs($user)
            ->get(route('dossiers.create', ['project_ref_id' => 'SEP-1234']))
            ->assertSessionHasErrors(['call_id']);
    }

    // test dossier create and redirect through dossiers.
    public function dossier_sep_creation_and_redirect()
    {
        $this->init();
        $user = $this->getUser('applicant');

        $call = Call::factory()->create();
        $projectRefId = sprintf('SEP-%d', $this->faker->randomNumber(9));

        $this->actingAs($user)
            ->get(route('dossiers.create', [
                'call_id' => $call->id,
                'project_ref_id' => $projectRefId,
            ]))->assertSessionHasNoErrors()->assertRedirect();

        $this->assertDatabaseHas('dossiers', [
            'project_ref_id' => $projectRefId,
            'call_id' => $call->id,
        ]);
    }

    // applicant can see page and sees instructions
    /** @test */
    public function an_applicant_can_view_and_sees_instructions()
    {
        $this->init();
        $applicant = $this->getUser('applicant');

        $dossier = Dossier::factory()->create();

        $this->actingAs($applicant)
            ->get(route('dossiers.show', $dossier))
            ->assertSeeText('Instructions')
            ->assertOk();
    }

    // editor can see page and does not see instructions
    /** @test */
    public function an_editor_can_view_and_does_not_see_instructions()
    {
        $this->init();
        $editor = $this->getUser('editor');

        $dossier = Dossier::factory()->create();

        $this->actingAs($editor)
            ->get(route('dossiers.show', $dossier))
            ->assertDontSeeText('Instructions')
            ->assertOk();
    }

    // dev dossiers have current / previous / short films
    /** @test */
    public function a_dev_dossier_has_current_previous_works_section()
    {
        $this->init();
        $user = $this->getUser('applicant');

        $dossier = Dossier::factory()->for(
            Action::where('name',
                $this->faker->randomElement([
                    'DEVSLATE',
                    'DEVSLATEMINI',
                    'CODEVELOPMENT'
            ]))->first()
        )->create();

        $this->actingAs($user)
            ->get(route('dossiers.show', $dossier))
            ->assertSeeLivewire('dossiers.activities.previous-work')
            ->assertSeeLivewire('dossiers.activities.current-work');
    }

    // distri have distributors and search and select
    /** @test */
    public function a_distri_dossier_has_search_and_distributors()
    {
        $this->init();
        $user = $this->getUser('applicant');

        $dossier = Dossier::factory()->for(
            Action::where('name', $this->faker->randomElement([
                'DISTSEL',
                'DISTSAG',
            ]))->first()
        )->create();

        $this->actingAs($user)
            ->get(route('dossiers.show', $dossier))
            ->assertSeeLivewire('dossiers.activities.description')
            ->assertSeeLivewire('dossiers.activities.distributors');
    }

    protected function getUser($role)
    {
        return User::factory()->create()->assignRole($role);
    }

    protected function init()
    {
        Role::create(['name' => 'applicant']);
        Role::create(['name' => 'editor']);

        // Seed actions and activities
        (new ActionSeeder)->run();
        (new ActivitySeeder)->run();
    }
}
