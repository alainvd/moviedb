<x-dynamic-component
    :component="$layout"
    :crumbs="$crumbs"
    :title="ucfirst($type) . ' History'"
    :class="'dossier-page'">

    @can('view advanced history')
        @livewire('dossiers.advanced-history', ['backUrl' => $backUrl, 'model' => $model,])
    @else
        <div class="px-4 mb-32 bg-white">
            <div class="w-full flex flex-col border border-gray-200">
                @foreach ($logs as $log)
                    <div class="px-24 py-8 flex flex-wrap text-gray-700 text-xl hover:bg-gray-100 rounded-md {{ $loop->iteration % 2 ? 'bg-gray-200' : 'bg-white' }}">
                        <div class="w-1/2 flex flex-grow">
                            <div class="bg-yellow-500 rounded-full h-16 w-16 pt-4 text-center font-bold relative">
                                {{ $loop->iteration }}
                                @unless ($loop->last)
                                    <div class="absolute border-8 border-yellow-500 bottom-2 h-24" style="left: 50%; transform: translate(-50%, 0);"></div>
                                @endunless
                            </div>
                            <div class="ml-8">
                                <h3 class="font-bold">
                                    {{ $log['description'] }}
                                </h3>
                                <p class="text-md text-gray-600">
                                    by {{ $log['user'] ? $log['user']->email : '' }}
                                </p>
                            </div>
                        </div>
                        <div class="w-1/4 font-bold text-center">
                            {{ $log['log_date']->format('d/m/Y') }}
                        </div>
                        <div class="w-1/4 font-bold uppercase text-center">
                            {{ $log['status'] }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endcan
</x-dynamic-component>
