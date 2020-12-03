<div>

    <livewire:select-component :options="$genres" :name="'selectedGenres'"></livewire:select-component>
    <livewire:select-component :options="$languages" :name="'selectedLanguages'"></livewire:select-component>


    @foreach($selected as $key => $item)
        {{$key}}
    @foreach($item as $value)
        {{$value}}
    @endforeach
        <br/>
    @endforeach

</div>
