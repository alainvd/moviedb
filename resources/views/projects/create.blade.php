<x-landing-layout>

    <div class="my-8 py-8 px-4 md:px-8 lg:px-16 bg-white">
        <!-- Title -->
        <h1 class="text-2xl leading-tight font-light">European Slate Development</h1>

        <form action="{{ route('projects.update', $dossier->id) }}" method="POST">
            @csrf
            {{ method_field('PATCH') }}
            <!-- Dossier details section -->
            <x-layout.section :title="'Application Information'">
                <div class="my-4 grid grid-cols-2 gap-4">
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
                            <div class="mt-1 text-red-500 text-sm">{{ $message }}</div>
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
                    @include(
                        "projects.activities.$activity->name",
                        [
                            'activity' => $activity,
                            'dossier' => $dossier,
                        ]
                    )
                @endforeach
            </x-layout.section>

             <div x-data class="flex justify-end items-center space-x-3">
                <x-button.primary type="submit">Save</x-button.primary>
             </div>
        </form>
    </div>
</x-landing-layout>
