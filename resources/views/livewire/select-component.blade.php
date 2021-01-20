<div x-data wire:ignore x-init="() => {

	var choices = new Choices($refs.mySelect, {
		removeItemButton: true,
		choices: {{ $options }},
	});

	choices.setValue({{ $items }})

	choices.passedElement.element.addEventListener(
	  'addItem',
	  function(event) {
	  	Livewire.emit('addItem', ['{{$name}}',event.detail])
	  },
	  false,
	);

	choices.passedElement.element.addEventListener(
	  'removeItem',
	  function(event) {
	  	Livewire.emit('removeItem', ['{{$name}}',event.detail])
	  },
	  false,
	);

};">
    <label class="block text-sm font-light leading-5 text-gray-700" for="{{$domId}}">
        {{$label}}
    </label>
    <select multiple id="{{$domId}}" x-ref="mySelect"></select>
</div>
