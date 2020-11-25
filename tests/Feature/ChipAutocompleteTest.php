<?php

namespace Tests\Feature;

use App\Http\Livewire\ChipAutocomplete;
use App\Models\Language;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Collection;
use Livewire\Livewire;
use Tests\TestCase;

/**
 * Chip Autocomplete component tests
 */
class ChipAutocompleteTest extends TestCase
{
    use DatabaseMigrations, RefreshDatabase, WithFaker;

    /** @test */
    public function focusing_input_shows_dropdown_list()
    {
        $this->livewireSetup()
            ->set('search', '')
            ->assertSeeHtml('<ul class="w-full overflow-y-auto list-none bg-white rounded-lg absolute left-0 -bottom-2" style="max-height: 260px">');
    }

    /** @test */
    public function focusing_input_shows_all_options()
    {
        $this->createLanguages();
        $languages = Language::orderBy('code')
            ->get();
            // ->each(fn ($lang) => $lang->chipLabel = strtoupper($lang->code));

        $this->livewireSetup()
            ->set('search', '')
            ->assertSeeInOrder(
                $languages->map(fn ($lang) => $lang->label)->toArray()
            );
    }

    /** @test */
    public function typing_in_input_filters_results_accordingly()
    {
        $this->createLanguages(100);

        $search = 'en';

        $filtered = $this->getFiltered($search);

        $this->livewireSetup()
            ->set('search', $search)
            ->assertSeeInOrder(
                $filtered->map(fn ($lang) => $lang->label)->toArray()
            );
    }

    /** @test */
    public function searching_for_unexisting_item_shows_no_result()
    {
        $this->createLanguages();

        $search = 'aowaoihnapwhmapomp';

        $this->livewireSetup()
            ->set('search', $search)
            ->assertSee('No results found');
    }

    /** @test */
    public function searching_for_exact_label_shows_one_result()
    {
        $this->createLanguages();

        $search = Language::all()
            ->get($this->faker->numberBetween(0, 24))
            ->label;
        $filtered = Language::all()
            ->where('label', $search)
            ->only('label')
            ->toArray();

        $this->livewireSetup()
            ->set('search', $search)
            ->assertPayloadSet('options', $filtered);
    }

    // Add a single item
    /** @test */
    public function adding_item_shows_it_in_selected_container()
    {
        $this->createLanguages();

        $item = Language::all()
            ->get($this->faker->numberBetween(0, 24))
            ->label;

        $this->livewireSetup()
            ->call('addItem', $item)
            ->assertPayloadSet('selected', [$item]);
    }

    // Add multiple items
    /** @test */
    public function adding_multiple_items_shows_them_in_selected_container()
    {
        $this->createLanguages();

        $items = [];
        $languages = Language::all();
        $livewire = $this->livewireSetup();

        $count = $this->faker->numberBetween(2, 10);
        for ($i = 0; $i < $count; $i++) {
            $item = $languages->shift()->label;
            $items[] = $item;
            $livewire->call('addItem', $item);
        }

        $livewire->assertPayloadSet('selected', $items);
    }

    // Adding item makes it disappear from options list
    /** @test */
    // public function adding_item_makes_it_disappear_from_options()
    // {
    //     $this->createLanguages();

    //     $languages = Language::all();
    //     $item = $languages->get($this->faker->numberBetween(0, 24))
    //         ->label;

    //     $this->livewireSetup()
    //         ->call('addItem', $item)
    //         ->set('search', '')
    //         ->assertPayloadSet(
    //             'options',
    //             []
    //             // $languages->reject(fn ($lang) => $lang->label === $item)
    //             //     ->values()
    //             //     ->toArray()
    //         );
    // }

    // Remove item
    /** @test */
    public function removing_an_item_removes_it_from_selected()
    {
        $this->createLanguages();

        $item = Language::all()
            ->get($this->faker->numberBetween(0, 24))
            ->label;

        $this->livewireSetup()
            ->call('addItem', $item)
            ->emit('chipRemoved', $item)
            ->assertPayloadNotSet('selected', [$item]);
    }

    // Add then remove items randomly
    /** @test */
    public function adding_multiple_items_then_randomly_removing_preserves_order()
    {
        $this->createLanguages();

        $items = collect([]);
        $languages = Language::all();
        $livewire = $this->livewireSetup();

        $count = $this->faker->numberBetween(5, 20);
        for ($i = 0; $i < $count; $i++) {
            $item = $i % 2
                ? $languages->shift()->label : $languages->pop()->label;
            $items->push($item);
            $livewire->call('addItem', $item);
        }

        // Randomly remove items
        $removeCount = $this->faker->numberBetween(2, $count - 1);
        $randRemove = $items->intersectByKeys($items->random($removeCount));

        foreach ($randRemove as $rmItem) {
            $livewire->emit('chipRemoved', $rmItem);
        }

        // Diff from collection for easier reindex
        $livewire->assertPayloadSet(
            'selected',
            $items->diff($randRemove)->values()->toArray()
        );
    }

    protected function livewireSetup()
    {
        return Livewire::test(ChipAutocomplete::class);
    }

    protected function createLanguages($count = null): void
    {
        Language::factory($count ?? 25)
            ->create();
    }

    protected function getFiltered($search): Collection
    {
        return Language::where(function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                ->orWhere('code', 'like', "%{$search}%");
            })
            ->orderBy('code')
            ->get();
    }
}
