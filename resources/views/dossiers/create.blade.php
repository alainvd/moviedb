<x-dynamic-component
    :component="$layout"
    :crumbs="$crumbs"
    :title="$pageTitles[$dossier->action->name]"
    :class="'dossier-page'">

    <div class="px-4 bg-white">

        @include('dossiers.instructions.index', ['dossier' => $dossier])

        <form id="dossier-form" action="{{ route('dossiers.update', $dossier->id) }}" method="POST">
            @csrf
            {{ method_field('PATCH') }}
            <!-- Dossier details section -->
            <x-layout.section :title="'Application Information'">
                <div class="grid grid-cols-2 gap-4 my-4">
                    <div class="col-span-1">
                        <x-form.input
                            :print="$print"
                            :id="'call-reference'"
                            :label="'Call / Topic reference'"
                            :disabled="true"
                            name="call_name"
                            value="{{ $dossier->call->name }}"></x-form.input>
                    </div>
                    <div class="col-span-1">
                        <x-form.input
                            :print="$print"
                            :id="'sep-id'"
                            :label="'SEP Project ID'"
                            name="project_ref_id"
                            :disabled="true"
                            value="{{ $dossier->project_ref_id }}"></x-form.input>
                    </div>
                    <div class="col-span-1">
                        <x-form.input
                            :print="$print"
                            :id="'company-name'"
                            :label="'Company Name'"
                            :hasError="$errors->has('company')"
                            name="company"
                            value="{{$dossier->company}}"></x-form.input>

                        @error('company')
                            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-span-1">
                        <x-form.input
                            :print="$print"
                            :id="'contact-person'"
                            :label="'Contact Person'"
                            :disabled="true"
                            name="contact_person"
                            value="{{ $dossier->contact_person }}"></x-form.input>
                    </div>
                </div>
            </x-layout.section>



            <x-layout.section>
                @foreach ($dossier->action->activities as $activity)

                    @if ($activity->pivot->rules)
                        @foreach($activity->pivot->rules as $ruleName => $rule)
                            <input type="hidden" name="{{ $ruleName }}" value="{{ $rule }}">
                        @endforeach
                    @endif

                    @livewire(
                        "dossiers.activities.$activity->name",
                        [
                            'activity' => $activity,
                            'dossier' => $dossier,
                            'print' => $print,
                        ]
                    )
                @endforeach
            </x-layout.section>

            @if(empty($print))
            <div x-data class="flex items-center justify-end mt-32 space-x-3 print:hidden">
                @if ($hasHistory)
                    <a href="{{ route('dossier-history', $dossier) }}" class="block text-md text-indigo-700 hover:text-indigo-400">
                        View history
                    </a>
                @endif
                <x-button.download :dossier="$dossier"></x-button.download>
                <x-button.primary type="submit">Save</x-button.primary>
            </div>
            @endif
        </form>
    </div>

    <script>
        const form = document.getElementById('dossier-form');
        if ({{ $errors->count() }}) {
            form.scrollIntoView();
        }
    </script>
</x-dynamic-component>
