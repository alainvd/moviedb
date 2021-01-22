<x-landing-layout>

    <div class="px-4 py-8 my-8 bg-white md:px-8 lg:px-16">
        <!-- Title -->
        <h1 class="text-3xl font-light leading-tight">European Slate Development</h1>

        <form action="{{ route('projects.update', $dossier->id) }}" method="POST">
            @csrf
            {{ method_field('PATCH') }}
            <!-- Dossier details section -->
            <x-layout.section :title="'Application Information'">
                <div class="grid grid-cols-2 gap-4 my-4">
                    <div class="col-span-1">
                        <x-form.input
                            :id="'call-reference'"
                            :label="'Call / Topic reference'"
                            :disabled="true"
                            name="call_name"
                            value="{{ $dossier->call->name  }}"></x-form.input>
                    </div>
                    <div class="col-span-1">
                        <x-form.input
                            :id="'sep-id'"
                            :label="'SEP Project ID'"
                            name="project_ref_id"
                            :disabled="true"
                            value="{{ $dossier->project_ref_id }}"></x-form.input>
                    </div>
                    <div class="col-span-1">
                        <x-form.input
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
                            :id="'contact-person'"
                            :label="'Contact Person'"
                            :disabled="true"
                            name="contact_person"
                            value="{{ $dossier->contact_person }}"></x-form.input>
                    </div>
                </div>
            </x-layout.section>

            <x-layout.section
                :title="'Development'">
                @foreach ($dossier->action->activities as $activity)

                    @foreach($activity->pivot->rules as $ruleName => $rule)
                        <input type="hidden" name="{{ $ruleName }}" value="{{ $rule }}">
                    @endforeach

                    @livewire(
                        "activities.$activity->name",
                        [
                            'activity' => $activity,
                            'dossier' => $dossier,
                        ]
                    )
                @endforeach
            </x-layout.section>

             <div x-data class="flex items-center justify-end mt-32 space-x-3">
                <x-button.primary type="submit">Save</x-button.primary>
             </div>
        </form>
    </div>
</x-landing-layout>
