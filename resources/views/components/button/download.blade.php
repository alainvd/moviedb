<x-button {{ $attributes->merge([
    'class' => 'inline-flex items-center px-3 py-2 bg-gray-300 hover:bg-gray-400 text-gray-800'
]) }}>
    <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
        <path d="M13 8V2H7v6H2l8 8 8-8h-5zM0 18h20v2H0v-2z" />
    </svg>
    <span><a href="{{ url('dossiers/'.$dossier->project_ref_id.'/download')  }}">Download PDF</a></span>
</x-button>
