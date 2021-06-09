<x-dynamic-component
    :component="$layout"
    :crumbs="$crumbs"
    :title="ucfirst($type) . ' History'"
    :class="'dossier-page'">

    @can('view advanced history')
        @livewire('dossiers.advanced-history', ['backUrl' => $backUrl, 'model' => $model,])
    @else
        <div class="px-4 mb-32 bg-white">
            <div class="flex flex-col w-full border border-gray-200">
                @foreach ($logs as $log)
                    <div class="px-24 py-8 flex flex-wrap text-gray-700 text-xl hover:bg-gray-100 rounded-md {{ $loop->iteration % 2 ? 'bg-gray-200' : 'bg-white' }}">
                        <div class="flex flex-grow w-1/2">
                            <div class="relative w-16 h-16 pt-4 font-bold text-center bg-yellow-500 rounded-full">
                                {{ $loop->iteration }}
                                @unless ($loop->last)
                                    <div class="absolute h-24 border-8 border-yellow-500 bottom-2" style="left: 50%; transform: translate(-50%, 0);"></div>
                                @endunless
                            </div>
                            <div class="ml-8">
                                <h3 class="font-bold">
                                    {{ $log['description'] }}
                                </h3>
                                <p class="text-gray-600 text-md">
                                    by {{ $log['user'] ? $log['user']->email : '' }}
                                </p>
                            </div>
                        </div>
                        <div class="w-1/4 font-bold text-center">
                            {{ $log['log_date']->format('d.m.Y') }}
                        </div>
                        <div class="w-1/4 font-bold text-center uppercase">
                            {{ $log['status'] }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endcan
</x-dynamic-component>
